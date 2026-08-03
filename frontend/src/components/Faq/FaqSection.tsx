import { useState } from 'react'
import './FaqSection.css'

const FAQS = [
  {
    question: '¿Qué tipo de proyectos aceptan?',
    answer:
      'Desarrollo de software a medida (web y móvil), consultoría tecnológica, y sistemas de gestión para organizaciones públicas y privadas. Si tu proyecto no encaja exactamente en estas categorías, escríbenos de todas formas — evaluamos caso por caso.',
  },
  {
    question: '¿Cuánto tiempo toma un proyecto?',
    answer:
      'Depende del alcance: un sitio institucional puede tomar unas semanas, mientras que una plataforma con backend a medida puede tomar varios meses. Durante el diagnóstico inicial te damos un estimado concreto antes de comenzar.',
  },
  {
    question: '¿Cómo se cotiza un proyecto?',
    answer:
      'Primero platicamos sobre tu problema y objetivos. Con eso preparamos una propuesta con alcance, tiempos y costo definidos, sin compromiso. Escríbenos por el formulario de contacto para agendar esa primera plática.',
  },
  {
    question: '¿Dan mantenimiento después de la entrega?',
    answer:
      'Sí. Ofrecemos soporte técnico continuo una vez que el sistema está en producción: monitoreo, resolución de incidencias y mejoras posteriores.',
  },
  {
    question: '¿Trabajan con clientes fuera de México?',
    answer:
      'Sí, trabajamos de forma remota con organizaciones dentro y fuera del país. La coordinación se hace por videollamada y herramientas colaborativas.',
  },
]

export default function FaqSection() {
  const [openIndex, setOpenIndex] = useState<number | null>(0)

  return (
    <section id="faq" className="mwc-section">
      <div className="mwc-container">
        <div className="mwc-section-head">
          <span className="mwc-section-eyebrow">Dudas frecuentes</span>
          <h2>Preguntas frecuentes</h2>
          <p>Lo que más nos preguntan antes de empezar un proyecto.</p>
        </div>

        <div className="mwc-faq-list">
          {FAQS.map((faq, index) => {
            const isOpen = openIndex === index

            return (
              <div className={`mwc-faq-item ${isOpen ? 'mwc-faq-item--open' : ''}`} key={faq.question}>
                <button
                  type="button"
                  className="mwc-faq-question"
                  onClick={() => setOpenIndex(isOpen ? null : index)}
                  aria-expanded={isOpen}
                >
                  <span>{faq.question}</span>
                  <span className="mwc-faq-icon">{isOpen ? '−' : '+'}</span>
                </button>
                {isOpen && <p className="mwc-faq-answer">{faq.answer}</p>}
              </div>
            )
          })}
        </div>
      </div>
    </section>
  )
}
