import { useEffect, useState } from 'react'
import { API_BASE } from '../../lib/api'
import './FaqSection.css'

type Faq = {
  id: number
  question: string
  answer: string
  position: number
}

export default function FaqSection() {
  const [faqs, setFaqs] = useState<Faq[]>([])
  const [openIndex, setOpenIndex] = useState<number | null>(0)

  useEffect(() => {
    fetch(`${API_BASE}/faqs`)
      .then((r) => r.json())
      .then(setFaqs)
      .catch(() => {})
  }, [])

  if (faqs.length === 0) return null

  return (
    <section id="faq" className="mwc-section">
      <div className="mwc-container">
        <div className="mwc-section-head">
          <span className="mwc-section-eyebrow">Dudas frecuentes</span>
          <h2>Preguntas frecuentes</h2>
          <p>Lo que más nos preguntan antes de empezar un proyecto.</p>
        </div>

        <div className="mwc-faq-list">
          {faqs.map((faq, index) => {
            const isOpen = openIndex === index

            return (
              <div className={`mwc-faq-item ${isOpen ? 'mwc-faq-item--open' : ''}`} key={faq.id}>
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
