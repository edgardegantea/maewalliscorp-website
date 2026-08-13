import './Skeleton.css'

export default function SkeletonCard() {
  return (
    <div className="mwc-skeleton-card">
      <div className="mwc-skeleton mwc-skeleton-icon" />
      <div className="mwc-skeleton mwc-skeleton-line" style={{ width: '70%' }} />
      <div className="mwc-skeleton mwc-skeleton-line" style={{ width: '100%' }} />
      <div className="mwc-skeleton mwc-skeleton-line" style={{ width: '85%' }} />
    </div>
  )
}
