import { useEffect, useState } from 'react'
import { API_BASE } from '../../lib/api'
import { renderSimpleMarkdown } from '../../lib/simpleMarkdown'
import './LegalPage.css'

type LegalPage = {
  title: string
  content: string
  updated_at: string | null
}

export default function TermsPage() {
  const [page, setPage] = useState<LegalPage | null>(null)

  useEffect(() => {
    fetch(`${API_BASE}/legal/terms`)
      .then((r) => r.json())
      .then(setPage)
      .catch(() => {})
  }, [])

  if (!page) return null

  return (
    <section className="mwc-legal">
      <div className="mwc-container mwc-legal-inner">
        <h1>{page.title}</h1>
        {page.updated_at && (
          <p className="mwc-legal-updated">
            Última actualización: {new Date(page.updated_at).toLocaleDateString('es-MX', { year: 'numeric', month: 'long' })}
          </p>
        )}
        {renderSimpleMarkdown(page.content)}
      </div>
    </section>
  )
}
