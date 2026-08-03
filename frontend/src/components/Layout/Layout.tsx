import { useEffect, useState } from 'react'
import { Link, Outlet, useLocation } from 'react-router-dom'
import Logo from '../Brand/Logo'
import ChatWidget from '../Chatbot/ChatWidget'
import { useTheme } from '../../hooks/useTheme'
import '../../App.css'
import './Layout.css'

export default function Layout() {
  const [menuOpen, setMenuOpen] = useState(false)
  const location = useLocation()
  const { theme, toggleTheme } = useTheme()

  useEffect(() => {
    setMenuOpen(false)
  }, [location.pathname, location.hash])

  return (
    <div className="mwc-site">
      <header className="mwc-header">
        <div className="mwc-container mwc-header-inner">
          <Link to="/" className="mwc-header-brand">
            <Logo size={38} withWordmark />
          </Link>

          <div className="mwc-header-actions">
            <nav className={menuOpen ? 'mwc-nav-open' : ''}>
              <ul className="mwc-nav">
                <li><Link to="/#servicios">Servicios</Link></li>
                <li><Link to="/#proyectos">Proyectos</Link></li>
                <li><Link to="/#nosotros">Nosotros</Link></li>
                <li><Link to="/#contacto" className="mwc-nav-cta">Contacto</Link></li>
              </ul>
            </nav>

            <button
              type="button"
              className="mwc-theme-toggle"
              aria-label={theme === 'dark' ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro'}
              onClick={toggleTheme}
            >
              {theme === 'dark' ? '☀️' : '🌙'}
            </button>

            <button
              type="button"
              className="mwc-nav-toggle"
              aria-label={menuOpen ? 'Cerrar menú' : 'Abrir menú'}
              aria-expanded={menuOpen}
              onClick={() => setMenuOpen((open) => !open)}
            >
              <span />
              <span />
              <span />
            </button>
          </div>
        </div>
      </header>

      <main>
        <Outlet />
      </main>

      <footer className="mwc-footer">
        <div className="mwc-container">
          <div className="mwc-footer-grid">
            <div className="mwc-footer-brand">
              <Logo size={30} withWordmark />
              <p>Desarrollo de software, consultoría tecnológica y soporte.</p>
            </div>

            <div className="mwc-footer-col">
              <h4>Sitio</h4>
              <ul>
                <li><Link to="/#servicios">Servicios</Link></li>
                <li><Link to="/#proceso">Cómo trabajamos</Link></li>
                <li><Link to="/#proyectos">Proyectos</Link></li>
                <li><Link to="/#nosotros">Nosotros</Link></li>
                <li><Link to="/#faq">Preguntas frecuentes</Link></li>
                <li><Link to="/#contacto">Contacto</Link></li>
              </ul>
            </div>

            <div className="mwc-footer-col">
              <h4>Legal</h4>
              <ul>
                <li><Link to="/aviso-de-privacidad">Aviso de privacidad</Link></li>
                <li><Link to="/terminos-y-condiciones">Términos y condiciones</Link></li>
              </ul>
            </div>
          </div>

          <div className="mwc-footer-bottom">
            <small>© {new Date().getFullYear()} MAEWALLISCORP. Todos los derechos reservados.</small>
          </div>
        </div>
      </footer>

      <ChatWidget />
    </div>
  )
}
