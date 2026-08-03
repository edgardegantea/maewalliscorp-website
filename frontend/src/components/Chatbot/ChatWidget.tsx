import { useEffect, useRef, useState, type FormEvent } from 'react'
import './ChatWidget.css'

type ChatMessage = {
  id: string
  role: 'user' | 'bot'
  text: string
}

type ChatbotApiResponse = {
  session_id: string
  reply: string
  intent: string
  escalate: boolean
}

const API_URL = `${import.meta.env.VITE_API_URL ?? '/api'}/chatbot/message`
const SESSION_STORAGE_KEY = 'mwc_chat_session_id'

function getStoredSessionId(): string | null {
  try {
    return sessionStorage.getItem(SESSION_STORAGE_KEY)
  } catch {
    return null
  }
}

function storeSessionId(id: string) {
  try {
    sessionStorage.setItem(SESSION_STORAGE_KEY, id)
  } catch {
    // storage unavailable, chat still works within the current page load
  }
}

export default function ChatWidget() {
  const [isOpen, setIsOpen] = useState(false)
  const [messages, setMessages] = useState<ChatMessage[]>([
    {
      id: 'welcome',
      role: 'bot',
      text: 'Hola, soy el asistente de MAEWALLISCORP. ¿En qué puedo ayudarte hoy?',
    },
  ])
  const [input, setInput] = useState('')
  const [isSending, setIsSending] = useState(false)
  const sessionIdRef = useRef<string | null>(getStoredSessionId())
  const scrollRef = useRef<HTMLDivElement>(null)

  useEffect(() => {
    scrollRef.current?.scrollTo({ top: scrollRef.current.scrollHeight, behavior: 'smooth' })
  }, [messages, isOpen])

  async function sendMessage(event: FormEvent) {
    event.preventDefault()

    const text = input.trim()
    if (!text || isSending) return

    const userMessage: ChatMessage = { id: crypto.randomUUID(), role: 'user', text }
    setMessages((prev) => [...prev, userMessage])
    setInput('')
    setIsSending(true)

    try {
      const response = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          message: text,
          session_id: sessionIdRef.current ?? undefined,
        }),
      })

      if (!response.ok) {
        throw new Error(`Request failed with ${response.status}`)
      }

      const data = (await response.json()) as ChatbotApiResponse
      sessionIdRef.current = data.session_id
      storeSessionId(data.session_id)

      setMessages((prev) => [
        ...prev,
        { id: crypto.randomUUID(), role: 'bot', text: data.reply },
      ])
    } catch {
      setMessages((prev) => [
        ...prev,
        {
          id: crypto.randomUUID(),
          role: 'bot',
          text: 'Ocurrió un problema al enviar tu mensaje. Intenta de nuevo en unos segundos.',
        },
      ])
    } finally {
      setIsSending(false)
    }
  }

  return (
    <div className="mwc-chat">
      {isOpen && (
        <div className="mwc-chat-panel" role="dialog" aria-label="Chat de soporte">
          <div className="mwc-chat-header">
            <span>MAEWALLISCORP · Asistente</span>
            <button
              type="button"
              className="mwc-chat-close"
              onClick={() => setIsOpen(false)}
              aria-label="Cerrar chat"
            >
              ×
            </button>
          </div>

          <div className="mwc-chat-messages" ref={scrollRef}>
            {messages.map((message) => (
              <div key={message.id} className={`mwc-chat-bubble mwc-chat-bubble--${message.role}`}>
                {message.text}
              </div>
            ))}
            {isSending && (
              <div className="mwc-chat-bubble mwc-chat-bubble--bot mwc-chat-bubble--typing">
                <span />
                <span />
                <span />
              </div>
            )}
          </div>

          <form className="mwc-chat-form" onSubmit={sendMessage}>
            <input
              type="text"
              value={input}
              onChange={(event) => setInput(event.target.value)}
              placeholder="Escribe tu mensaje..."
              disabled={isSending}
              aria-label="Mensaje"
            />
            <button type="submit" disabled={isSending || !input.trim()}>
              Enviar
            </button>
          </form>
        </div>
      )}

      <button
        type="button"
        className="mwc-chat-toggle"
        onClick={() => setIsOpen((open) => !open)}
        aria-label={isOpen ? 'Cerrar chat' : 'Abrir chat'}
      >
        {isOpen ? '×' : '💬'}
      </button>
    </div>
  )
}
