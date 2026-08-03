import { Link, Outlet } from 'react-router-dom'
import Logo from '../Brand/Logo'
import ChatWidget from '../Chatbot/ChatWidget'
import '../../App.css'
import './Layout.css'

export default function Layout() {
  return (
    <div className="mwc-site">
      <header className="mwc-header">
        <div className="mwc-container mwc-header-inner">
          <Link to="/" className="mwc-header-brand">
            <Logo size={38} withWordmark />
          </Link>
          <nav>
            <ul className="mwc-nav">
              <li><Link to="/#servicios">Servicios</Link></li>
              <li><Link to="/#proyectos">Proyectos</Link></li>
              <li><Link to="/#nosotros">Nosotros</Link></li>
              <li><Link to="/#contacto" className="mwc-nav-cta">Contacto</Link></li>
            </ul>
          </nav>
        </div>
      </header>

      <main>
        <Outlet />
      </main>

      <footer className="mwc-footer">
        <div className="mwc-container mwc-footer-inner">
          <Logo size={28} withWordmark />
          <small>© {new Date().getFullYear()} MAEWALLISCORP. Todos los derechos reservados.</small>
        </div>
      </footer>

      <ChatWidget />
    </div>
  )
}
