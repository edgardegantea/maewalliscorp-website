import type { JSX } from 'react'
import { Link } from 'react-router-dom'

/**
 * Renders the small markup subset used by admin-editable long-form content
 * (legal pages): blank line = new paragraph, "## " prefix = subheading,
 * [label](url) = link (internal links use React Router, external ones a
 * plain <a>).
 */
export function renderSimpleMarkdown(content: string): JSX.Element[] {
  const blocks = content.split(/\n\s*\n/).map((block) => block.trim()).filter(Boolean)

  return blocks.map((block, index) => {
    if (block.startsWith('## ')) {
      return <h2 key={index}>{renderInline(block.slice(3))}</h2>
    }

    return <p key={index}>{renderInline(block)}</p>
  })
}

function renderInline(text: string): (string | JSX.Element)[] {
  const parts: (string | JSX.Element)[] = []
  const linkPattern = /\[([^\]]+)\]\(([^)]+)\)/g
  let lastIndex = 0
  let match: RegExpExecArray | null
  let key = 0

  while ((match = linkPattern.exec(text)) !== null) {
    if (match.index > lastIndex) {
      parts.push(text.slice(lastIndex, match.index))
    }

    const [, label, url] = match

    parts.push(
      url.startsWith('/#') || url.startsWith('/') ? (
        <Link to={url} key={key++}>{label}</Link>
      ) : (
        <a href={url} key={key++} target="_blank" rel="noopener noreferrer">{label}</a>
      )
    )

    lastIndex = match.index + match[0].length
  }

  if (lastIndex < text.length) {
    parts.push(text.slice(lastIndex))
  }

  return parts
}
