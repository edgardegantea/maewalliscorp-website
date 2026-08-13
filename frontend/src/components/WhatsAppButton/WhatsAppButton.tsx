import { useEffect, useState } from 'react'
import { API_BASE } from '../../lib/api'
import './WhatsAppButton.css'

export default function WhatsAppButton() {
  const [number, setNumber] = useState<string | null>(null)

  useEffect(() => {
    fetch(`${API_BASE}/settings`)
      .then((r) => r.json())
      .then((settings) => setNumber(settings.whatsapp_number || null))
      .catch(() => {})
  }, [])

  if (!number) return null

  const message = encodeURIComponent('Hola, quiero más información sobre sus servicios.')

  return (
    <a
      href={`https://wa.me/${number}?text=${message}`}
      target="_blank"
      rel="noopener noreferrer"
      className="mwc-whatsapp-btn"
      aria-label="Escribir por WhatsApp"
    >
      <svg viewBox="0 0 32 32" width="28" height="28" aria-hidden="true">
        <path
          fill="currentColor"
          d="M16.004 3C9.376 3 4 8.373 4 15c0 2.34.66 4.523 1.804 6.383L4 29l7.79-1.77A11.93 11.93 0 0 0 16.004 27C22.63 27 28 21.627 28 15S22.63 3 16.004 3Zm6.988 16.98c-.297.836-1.47 1.54-2.402 1.735-.639.135-1.472.243-4.28-.914-3.594-1.482-5.906-5.088-6.086-5.32-.174-.232-1.463-1.933-1.463-3.69 0-1.756.918-2.62 1.246-2.98.328-.36.716-.45.955-.45.24 0 .478.003.687.013.22.011.516-.083.807.617.297.72 1.01 2.484 1.098 2.664.087.18.145.39.03.623-.116.233-.174.378-.343.583-.174.203-.362.454-.517.61-.174.174-.355.362-.152.712.202.35.898 1.484 1.928 2.404 1.324 1.18 2.44 1.545 2.79 1.72.35.174.554.146.76-.087.203-.232.87-1.015 1.102-1.363.232-.35.464-.29.783-.174.32.116 2.02.953 2.367 1.127.348.174.58.26.667.406.087.145.087.837-.21 1.673Z"
        />
      </svg>
    </a>
  )
}
