import { useState, type FormEvent } from 'react'
import './ContactForm.css'

type Status = 'idle' | 'sending' | 'success' | 'error'

type FieldErrors = Record<string, string>

const API_URL = `${import.meta.env.VITE_API_URL ?? '/api'}/contact`

export default function ContactForm() {
  const [name, setName] = useState('')
  const [email, setEmail] = useState('')
  const [message, setMessage] = useState('')
  const [status, setStatus] = useState<Status>('idle')
  const [errors, setErrors] = useState<FieldErrors>({})
  const [feedback, setFeedback] = useState<string | null>(null)

  async function handleSubmit(event: FormEvent) {
    event.preventDefault()
    setStatus('sending')
    setErrors({})
    setFeedback(null)

    try {
      const response = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, email, message }),
      })

      const data = await response.json()

      if (response.status === 422) {
        setErrors(data.errors ?? {})
        setStatus('error')
        return
      }

      if (!response.ok) {
        throw new Error('request failed')
      }

      setStatus('success')
      setFeedback(data.message ?? 'Gracias por contactarnos.')
      setName('')
      setEmail('')
      setMessage('')
    } catch {
      setStatus('error')
      setFeedback('No se pudo enviar tu mensaje. Intenta de nuevo en unos minutos.')
    }
  }

  return (
    <form className="mwc-contact-form" onSubmit={handleSubmit} noValidate>
      <div className="mwc-field">
        <label htmlFor="contact-name">Nombre</label>
        <input
          id="contact-name"
          type="text"
          value={name}
          onChange={(e) => setName(e.target.value)}
          required
        />
        {errors.name && <span className="mwc-field-error">{errors.name}</span>}
      </div>

      <div className="mwc-field">
        <label htmlFor="contact-email">Correo</label>
        <input
          id="contact-email"
          type="email"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
          required
        />
        {errors.email && <span className="mwc-field-error">{errors.email}</span>}
      </div>

      <div className="mwc-field">
        <label htmlFor="contact-message">Mensaje</label>
        <textarea
          id="contact-message"
          rows={5}
          value={message}
          onChange={(e) => setMessage(e.target.value)}
          required
        />
        {errors.message && <span className="mwc-field-error">{errors.message}</span>}
      </div>

      <button type="submit" className="mwc-btn mwc-btn--primary" disabled={status === 'sending'}>
        {status === 'sending' ? 'Enviando...' : 'Enviar mensaje'}
      </button>

      {feedback && (
        <p className={`mwc-form-feedback mwc-form-feedback--${status}`} role="status">
          {feedback}
        </p>
      )}
    </form>
  )
}
