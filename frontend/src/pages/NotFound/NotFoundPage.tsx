import { Link } from 'react-router-dom'
import './NotFoundPage.css'

export default function NotFoundPage() {
  return (
    <section className="mwc-notfound">
      <div className="mwc-container mwc-notfound-inner">
        <span className="mwc-notfound-code">404</span>
        <h1>No encontramos esta página.</h1>
        <p>
          El enlace que seguiste puede estar roto o la página pudo haberse movido. Vuelve al
          inicio para seguir explorando MAEWALLISCORP.
        </p>
        <Link to="/" className="mwc-btn mwc-btn--dark">Volver al inicio</Link>
      </div>
    </section>
  )
}
