import { useEffect, useRef, useState, type FormEvent } from 'react'
import './ChatWidget.css'

type ChatMessage = {
  id: string
  role: 'user' | 'bot'
  text: string
  escalate?: boolean
}

type ChatbotApiResponse = {
  session_id: string
  reply: string
  intent: string
  escalate: boolean
}

const API_BASE = import.meta.env.VITE_API_URL ?? '/api'
const CHAT_API_URL = `${API_BASE}/chatbot/message`
const TICKETS_API_URL = `${API_BASE}/tickets`
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

  const [showTicketForm, setShowTicketForm] = useState(false)
  const [ticketName, setTicketName] = useState('')
  const [ticketEmail, setTicketEmail] = useState('')
  const [ticketStatus, setTicketStatus] = useState<'idle' | 'sending' | 'error'>('idle')

  useEffect(() => {
    scrollRef.current?.scrollTo({ top: scrollRef.current.scrollHeight, behavior: 'smooth' })
  }, [messages, isOpen, showTicketForm])

  async function sendMessage(event: FormEvent) {
    event.preventDefault()

    const text = input.trim()
    if (!text || isSending) return

    const userMessage: ChatMessage = { id: crypto.randomUUID(), role: 'user', text }
    setMessages((prev) => [...prev, userMessage])
    setInput('')
    setIsSending(true)

    try {
      const response = await fetch(CHAT_API_URL, {
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
        { id: crypto.randomUUID(), role: 'bot', text: data.reply, escalate: data.escalate },
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

  async function submitTicket(event: FormEvent) {
    event.preventDefault()
    if (!ticketName.trim() || !ticketEmail.trim()) return

    setTicketStatus('sending')

    const transcript = messages.map((m) => `${m.role === 'user' ? 'Cliente' : 'Asistente'}: ${m.text}`).join('\n')
    const lastUserMessage = [...messages].reverse().find((m) => m.role === 'user')?.text ?? 'Consulta desde el chat'

    try {
      const response = await fetch(TICKETS_API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          name: ticketName.trim(),
          email: ticketEmail.trim(),
          subject: lastUserMessage.slice(0, 150),
          description: transcript,
          source: 'chatbot',
        }),
      })

      const data = await response.json()

      if (!response.ok) {
        throw new Error('request failed')
      }

      setMessages((prev) => [
        ...prev,
        {
          id: crypto.randomUUID(),
          role: 'bot',
          text: `Listo, abrí el ticket ${data.folio}. Te contactaremos a ${ticketEmail}. Puedes consultar el estado en /soporte con este folio.`,
        },
      ])
      setShowTicketForm(false)
      setTicketName('')
      setTicketEmail('')
      setTicketStatus('idle')
    } catch {
      setTicketStatus('error')
    }
  }

  const lastEscalate = [...messages].reverse().find((m) => m.role === 'bot')?.escalate

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

            {lastEscalate && !showTicketForm && (
              <button type="button" className="mwc-chat-ticket-cta" onClick={() => setShowTicketForm(true)}>
                🎫 Abrir ticket de soporte
              </button>
            )}

            {showTicketForm && (
              <form className="mwc-chat-ticket-form" onSubmit={submitTicket}>
                <input
                  type="text"
                  placeholder="Tu nombre"
                  value={ticketName}
                  onChange={(e) => setTicketName(e.target.value)}
                  required
                />
                <input
                  type="email"
                  placeholder="Tu correo"
                  value={ticketEmail}
                  onChange={(e) => setTicketEmail(e.target.value)}
                  required
                />
                <button type="submit" disabled={ticketStatus === 'sending'}>
                  {ticketStatus === 'sending' ? 'Creando ticket...' : 'Crear ticket'}
                </button>
                {ticketStatus === 'error' && (
                  <span className="mwc-chat-ticket-error">No se pudo crear el ticket. Intenta de nuevo.</span>
                )}
              </form>
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
