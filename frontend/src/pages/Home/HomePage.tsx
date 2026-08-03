import { useEffect } from 'react'
import { Link, useLocation } from 'react-router-dom'
import Logo from '../../components/Brand/Logo'
import ContactForm from '../../components/ContactForm/ContactForm'
import { PARTNERS } from '../../data/partners'
import '../../App.css'

const SERVICES = [
  {
    icon: '⚙️',
    title: 'Desarrollo de software a medida',
    description:
      'Sistemas web y plataformas propias diseñadas alrededor de los procesos reales de cada organización.',
  },
  {
    icon: '🧭',
    title: 'Consultoría tecnológica',
    description:
      'Diagnóstico y acompañamiento para elegir la arquitectura, herramientas y proveedores correctos antes de construir.',
  },
  {
    icon: '📋',
    title: 'Gestión de proyectos digitales',
    description:
      'Coordinación end-to-end de proyectos de software: planeación, seguimiento y entrega, sin sorpresas.',
  },
  {
    icon: '🛠️',
    title: 'Soporte técnico continuo',
    description:
      'Mantenimiento, monitoreo y resolución de incidencias una vez que el sistema ya está en producción.',
  },
]

const PORTFOLIO = [
  {
    category: 'Gestión municipal',
    title: 'Plataformas de administración pública',
    description: 'Sistemas para digitalizar trámites y procesos internos de gobiernos locales.',
  },
  {
    category: 'Consultoría',
    title: 'Portales de servicios profesionales',
    description: 'Plataformas de gestión para despachos y firmas de consultoría.',
  },
  {
    category: 'Gestión de proyectos',
    title: 'Herramientas de seguimiento y control',
    description: 'Sistemas internos para planear, dar seguimiento y reportar avance de proyectos.',
  },
  {
    category: 'Bibliotecas',
    title: 'Sistemas de gestión bibliotecaria',
    description: 'Catalogación, préstamos y consulta de acervos para instituciones educativas.',
  },
]

export default function HomePage() {
  const location = useLocation()

  useEffect(() => {
    if (!location.hash) return
    const el = document.querySelector(location.hash)
    el?.scrollIntoView({ behavior: 'smooth' })
  }, [location.hash])

  return (
    <>
      <section className="mwc-hero">
        <div className="mwc-container mwc-hero-inner">
          <div>
            <span className="mwc-hero-eyebrow">MAEWALLISCORP</span>
            <h1>Avanzamos en todas direcciones.</h1>
            <p>
              Diseñamos, desarrollamos y damos soporte a plataformas de software para
              organizaciones que necesitan resolver procesos reales, no solo tener una app más.
            </p>
            <div className="mwc-hero-actions">
              <a href="#contacto" className="mwc-btn mwc-btn--primary">Hablemos de tu proyecto</a>
              <a href="#servicios" className="mwc-btn mwc-btn--ghost">Ver servicios</a>
            </div>
          </div>
          <div className="mwc-hero-visual">
            <Logo variant="full" size={360} />
          </div>
        </div>
      </section>

      <section id="servicios" className="mwc-section">
        <div className="mwc-container">
          <div className="mwc-section-head">
            <span className="mwc-section-eyebrow">Qué hacemos</span>
            <h2>Servicios</h2>
            <p>
              Acompañamos el ciclo completo: desde entender el problema hasta mantener el sistema
              funcionando después del lanzamiento.
            </p>
          </div>
          <div className="mwc-grid">
            {SERVICES.map((service) => (
              <article className="mwc-card" key={service.title}>
                <div className="mwc-card-icon">{service.icon}</div>
                <h3>{service.title}</h3>
                <p>{service.description}</p>
              </article>
            ))}
          </div>
        </div>
      </section>

      <section id="proyectos" className="mwc-section mwc-section--muted">
        <div className="mwc-container">
          <div className="mwc-section-head">
            <span className="mwc-section-eyebrow">Portafolio</span>
            <h2>Proyectos</h2>
            <p>Algunas de las áreas donde hemos construido soluciones a medida.</p>
          </div>
          <div className="mwc-grid">
            {PORTFOLIO.map((project) => (
              <article className="mwc-portfolio-card" key={project.title}>
                <div className="mwc-portfolio-tag">
                  <span>{project.category}</span>
                </div>
                <div className="mwc-portfolio-body">
                  <h3>{project.title}</h3>
                  <p>{project.description}</p>
                </div>
              </article>
            ))}
          </div>
        </div>
      </section>

      <section id="nosotros" className="mwc-section">
        <div className="mwc-container">
          <div className="mwc-about">
            <div>
              <span className="mwc-section-eyebrow">Quiénes somos</span>
              <h2>Sobre nosotros</h2>
              <p style={{ marginTop: 12, color: 'var(--mwc-ink-muted)', fontSize: 16 }}>
                MAEWALLISCORP es un grupo de desarrollo y consultoría tecnológica. Construimos
                software propio y trabajamos junto a otras organizaciones para digitalizar sus
                procesos, combinando desarrollo a medida con acompañamiento estratégico en cada
                etapa del proyecto.
              </p>
            </div>
            <div className="mwc-about-panel">
              <Logo variant="full" size={220} />
            </div>
          </div>

          <div className="mwc-section-head" style={{ marginTop: 64 }}>
            <span className="mwc-section-eyebrow">Equipo</span>
            <h2>Socios fundadores</h2>
            <p>Conoce a las personas detrás de MAEWALLISCORP.</p>
          </div>
          <div className="mwc-grid">
            {PARTNERS.map((partner) => (
              <Link to={`/nosotros/${partner.slug}`} className="mwc-partner-card" key={partner.slug}>
                <div className="mwc-partner-avatar">
                  {partner.name
                    .split(' ')
                    .slice(0, 2)
                    .map((w) => w[0])
                    .join('')}
                </div>
                <h3>{partner.name}</h3>
                <p>{partner.role}</p>
                <span className="mwc-partner-link">Ver semblanza →</span>
              </Link>
            ))}
          </div>
        </div>
      </section>

      <section id="contacto" className="mwc-section mwc-section--muted">
        <div className="mwc-container mwc-contact">
          <div>
            <span className="mwc-section-eyebrow">Contacto</span>
            <h2>Cuéntanos tu proyecto</h2>
            <p style={{ marginTop: 12, color: 'var(--mwc-ink-muted)', fontSize: 16, marginBottom: 24 }}>
              Escríbenos con el detalle de lo que necesitas y un asesor te contactará. También
              puedes usar el asistente virtual en la esquina inferior para resolver dudas rápidas.
            </p>
            <div className="mwc-contact-info">
              <div className="mwc-contact-info-item">
                <strong>Tiempo de respuesta</strong>
                <span>Normalmente respondemos en 24–48 horas hábiles.</span>
              </div>
              <div className="mwc-contact-info-item">
                <strong>Soporte</strong>
                <span>Clientes activos pueden usar el chat para abrir tickets de soporte.</span>
              </div>
            </div>
          </div>
          <ContactForm />
        </div>
      </section>
    </>
  )
}
