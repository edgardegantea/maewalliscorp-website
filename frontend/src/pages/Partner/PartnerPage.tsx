import { useEffect, useState } from 'react'
import { Link, useParams } from 'react-router-dom'
import { API_BASE, type Partner as PartnerData } from '../../lib/api'
import './PartnerPage.css'

type LoadState = 'loading' | 'ready' | 'not-found'

export default function PartnerPage() {
  const { slug } = useParams<{ slug: string }>()
  const [partner, setPartner] = useState<PartnerData | null>(null)
  const [state, setState] = useState<LoadState>('loading')

  useEffect(() => {
    setState('loading')
    setPartner(null)

    fetch(`${API_BASE}/partners/${slug}`)
      .then(async (res) => {
        if (!res.ok) {
          setState('not-found')
          return
        }
        const data = await res.json()
        setPartner(data)
        setState('ready')
      })
      .catch(() => setState('not-found'))
  }, [slug])

  if (state === 'loading') {
    return (
      <section className="mwc-section">
        <div className="mwc-container">
          <p style={{ color: 'var(--mwc-ink-muted)' }}>Cargando…</p>
        </div>
      </section>
    )
  }

  if (state === 'not-found' || !partner) {
    return (
      <section className="mwc-section">
        <div className="mwc-container">
          <h1>Socio no encontrado</h1>
          <p style={{ marginTop: 12 }}>
            <Link to="/#nosotros">← Volver a Nosotros</Link>
          </p>
        </div>
      </section>
    )
  }

  const initials = partner.name
    .split(' ')
    .slice(0, 2)
    .map((w) => w[0])
    .join('')

  return (
    <>
      <section className="mwc-partner-hero">
        <div className="mwc-container mwc-partner-hero-inner">
          <div className="mwc-partner-hero-avatar">{initials}</div>
          <div>
            <Link to="/#nosotros" className="mwc-partner-back">← Nosotros</Link>
            <h1>{partner.name}</h1>
            <p className="mwc-partner-role">{partner.role}</p>
          </div>
        </div>
      </section>

      <section className="mwc-section">
        <div className="mwc-container mwc-partner-body">
          <div className="mwc-partner-block">
            <h2>Semblanza</h2>
            <p>{partner.semblanza}</p>
            {partner.pendingReview && partner.academico.length === 0 && partner.profesional.length === 0 && (
              <p className="mwc-partner-pending">
                Esta semblanza está pendiente de confirmación directa con el socio — no se
                encontró información pública suficiente y verificable para completarla.
              </p>
            )}
          </div>

          {partner.academico.length > 0 && (
            <div className="mwc-partner-block">
              <h2>Historial académico</h2>
              <ul>
                {partner.academico.map((item) => (
                  <li key={item}>{item}</li>
                ))}
              </ul>
            </div>
          )}

          {partner.profesional.length > 0 && (
            <div className="mwc-partner-block">
              <h2>Historial profesional</h2>
              <ul>
                {partner.profesional.map((item) => (
                  <li key={item}>{item}</li>
                ))}
              </ul>
            </div>
          )}

          {partner.publicaciones && partner.publicaciones.length > 0 && (
            <div className="mwc-partner-block">
              <h2>Publicaciones y proyectos</h2>
              <ul>
                {partner.publicaciones.map((item) => (
                  <li key={item}>{item}</li>
                ))}
              </ul>
            </div>
          )}

          {partner.pendingReview && (partner.academico.length > 0 || partner.profesional.length > 0) && (
            <p className="mwc-partner-pending">
              Esta información se obtuvo de fuentes públicas y está pendiente de confirmación
              directa con el socio.
            </p>
          )}

          {partner.links && partner.links.length > 0 && (
            <div className="mwc-partner-block">
              <h2>Perfiles</h2>
              <ul className="mwc-partner-links">
                {partner.links.map((link) => (
                  <li key={link.url}>
                    <a href={link.url} target="_blank" rel="noopener noreferrer">
                      {link.label} ↗
                    </a>
                  </li>
                ))}
              </ul>
            </div>
          )}
        </div>
      </section>
    </>
  )
}
