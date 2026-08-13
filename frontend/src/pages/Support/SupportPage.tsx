import { useState, type FormEvent } from 'react'
import { API_BASE } from '../../lib/api'
import './SupportPage.css'

type TicketStatus = {
  folio: string
  subject: string
  status: 'abierto' | 'en_progreso' | 'cerrado'
  created_at: string
  updated_at: string | null
}

const STATUS_LABELS: Record<TicketStatus['status'], string> = {
  abierto: 'Abierto',
  en_progreso: 'En progreso',
  cerrado: 'Cerrado',
}

export default function SupportPage() {
  const [folio, setFolio] = useState('')
  const [email, setEmail] = useState('')
  const [ticket, setTicket] = useState<TicketStatus | null>(null)
  const [status, setStatus] = useState<'idle' | 'loading' | 'not-found'>('idle')

  async function handleSubmit(event: FormEvent) {
    event.preventDefault()
    setStatus('loading')
    setTicket(null)

    try {
      const params = new URLSearchParams({ folio: folio.trim(), email: email.trim() })
      const response = await fetch(`${API_BASE}/tickets/lookup?${params}`)

      if (!response.ok) {
        setStatus('not-found')
        return
      }

      setTicket(await response.json())
      setStatus('idle')
    } catch {
      setStatus('not-found')
    }
  }

  return (
    <section className="mwc-support">
      <div className="mwc-container mwc-support-inner">
        <span className="mwc-section-eyebrow">Soporte</span>
        <h1>Consulta el estado de tu ticket</h1>
        <p>Ingresa el folio que te dimos y el correo con el que lo creaste.</p>

        <form className="mwc-support-form" onSubmit={handleSubmit}>
          <div className="mwc-field">
            <label htmlFor="folio">Folio</label>
            <input id="folio" type="text" placeholder="TCK-XXXXXX" value={folio} onChange={(e) => setFolio(e.target.value)} required />
          </div>
          <div className="mwc-field">
            <label htmlFor="email">Correo</label>
            <input id="email" type="email" value={email} onChange={(e) => setEmail(e.target.value)} required />
          </div>
          <button type="submit" className="mwc-btn mwc-btn--dark" disabled={status === 'loading'}>
            {status === 'loading' ? 'Buscando...' : 'Consultar'}
          </button>
        </form>

        {status === 'not-found' && (
          <p className="mwc-support-error">No encontramos un ticket con ese folio y correo.</p>
        )}

        {ticket && (
          <div className="mwc-support-result">
            <span className={`mwc-support-status mwc-support-status--${ticket.status}`}>
              {STATUS_LABELS[ticket.status]}
            </span>
            <h3>{ticket.subject}</h3>
            <p>Folio: {ticket.folio}</p>
            <p>Creado: {new Date(ticket.created_at).toLocaleString('es-MX')}</p>
          </div>
        )}
      </div>
    </section>
  )
}
