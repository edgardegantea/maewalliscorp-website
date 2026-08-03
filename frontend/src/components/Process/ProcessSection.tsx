import './ProcessSection.css'

const STEPS = [
  {
    number: '01',
    title: 'Diagnóstico',
    description: 'Entendemos el proceso real detrás del problema antes de proponer una sola línea de código.',
  },
  {
    number: '02',
    title: 'Propuesta',
    description: 'Definimos alcance, arquitectura y tiempos claros, sin sorpresas a mitad del proyecto.',
  },
  {
    number: '03',
    title: 'Desarrollo',
    description: 'Construimos en iteraciones cortas, con entregas visibles y retroalimentación constante.',
  },
  {
    number: '04',
    title: 'Entrega',
    description: 'Ponemos el sistema en producción y capacitamos a tu equipo para operarlo con confianza.',
  },
  {
    number: '05',
    title: 'Soporte',
    description: 'Damos seguimiento, monitoreo y mantenimiento una vez que el sistema ya está en uso real.',
  },
]

export default function ProcessSection() {
  return (
    <section id="proceso" className="mwc-section mwc-section--muted">
      <div className="mwc-container">
        <div className="mwc-section-head">
          <span className="mwc-section-eyebrow">Metodología</span>
          <h2>Cómo trabajamos</h2>
          <p>Un proceso simple y transparente, del diagnóstico inicial al soporte de largo plazo.</p>
        </div>

        <div className="mwc-process-grid">
          {STEPS.map((step) => (
            <div className="mwc-process-step" key={step.number}>
              <span className="mwc-process-number">{step.number}</span>
              <h3>{step.title}</h3>
              <p>{step.description}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
