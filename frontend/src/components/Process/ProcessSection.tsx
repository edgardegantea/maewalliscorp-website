import { useEffect, useState } from 'react'
import { API_BASE } from '../../lib/api'
import './ProcessSection.css'

type ProcessStep = {
  id: number
  title: string
  description: string
  position: number
}

export default function ProcessSection() {
  const [steps, setSteps] = useState<ProcessStep[]>([])

  useEffect(() => {
    fetch(`${API_BASE}/process`)
      .then((r) => r.json())
      .then(setSteps)
      .catch(() => {})
  }, [])

  if (steps.length === 0) return null

  return (
    <section id="proceso" className="mwc-section mwc-section--muted">
      <div className="mwc-container">
        <div className="mwc-section-head">
          <span className="mwc-section-eyebrow">Metodología</span>
          <h2>Cómo trabajamos</h2>
          <p>Un proceso simple y transparente, del diagnóstico inicial al soporte de largo plazo.</p>
        </div>

        <div className="mwc-process-grid">
          {steps.map((step, index) => (
            <div className="mwc-process-step" key={step.id}>
              <span className="mwc-process-number">{String(index + 1).padStart(2, '0')}</span>
              <h3>{step.title}</h3>
              <p>{step.description}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
