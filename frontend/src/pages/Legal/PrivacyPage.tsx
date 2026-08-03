import './LegalPage.css'

export default function PrivacyPage() {
  return (
    <section className="mwc-legal">
      <div className="mwc-container mwc-legal-inner">
        <h1>Aviso de privacidad</h1>
        <p className="mwc-legal-updated">Última actualización: agosto de 2026</p>

        <p>
          MAEWALLISCORP ("nosotros") es responsable del tratamiento de los datos personales que
          nos proporcionas a través de este sitio web, conforme a la Ley Federal de Protección de
          Datos Personales en Posesión de los Particulares (LFPDPPP).
        </p>

        <h2>Datos que recopilamos</h2>
        <p>A través del formulario de contacto de este sitio recopilamos únicamente:</p>
        <ul>
          <li>Nombre</li>
          <li>Correo electrónico</li>
          <li>El contenido del mensaje que nos escribes</li>
          <li>Tu dirección IP, con fines de seguridad y para prevenir abuso del formulario</li>
        </ul>
        <p>
          El asistente virtual (chatbot) del sitio procesa el texto que escribes únicamente para
          generarte una respuesta en el momento; no almacenamos un historial permanente de esas
          conversaciones.
        </p>

        <h2>Finalidad del tratamiento</h2>
        <p>Usamos estos datos exclusivamente para:</p>
        <ul>
          <li>Responder a tu solicitud de contacto o cotización</li>
          <li>Dar seguimiento y soporte a clientes activos</li>
          <li>Prevenir el uso indebido de nuestros formularios</li>
        </ul>
        <p>No usamos tus datos con fines de mercadotecnia no solicitada ni los vendemos.</p>

        <h2>Cookies y almacenamiento local</h2>
        <p>
          Este sitio no utiliza cookies de rastreo publicitario ni analítica de terceros.
          Utilizamos almacenamiento local del navegador únicamente para recordar tu preferencia de
          tema visual (claro/oscuro) y para mantener la continuidad de una conversación con el
          chatbot durante tu sesión; ninguno de estos datos se comparte con terceros.
        </p>

        <h2>Con quién compartimos tus datos</h2>
        <p>
          No compartimos, vendemos ni transferimos tus datos personales a terceros, salvo que una
          autoridad competente lo requiera conforme a la ley.
        </p>

        <h2>Derechos ARCO</h2>
        <p>
          Tienes derecho a acceder, rectificar, cancelar u oponerte (derechos ARCO) al tratamiento
          de tus datos personales. Para ejercer cualquiera de estos derechos, escríbenos a través
          del <a href="/#contacto">formulario de contacto</a> de este sitio, indicando claramente
          tu solicitud.
        </p>

        <h2>Cambios a este aviso</h2>
        <p>
          Podemos actualizar este aviso de privacidad periódicamente. Cualquier cambio será
          publicado en esta misma página con su fecha de actualización correspondiente.
        </p>
      </div>
    </section>
  )
}
