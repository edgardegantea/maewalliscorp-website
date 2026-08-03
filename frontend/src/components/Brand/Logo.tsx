import type { CSSProperties } from 'react'
import iconPng from '../../assets/brand/logo-icon.png'
import iconWebp from '../../assets/brand/logo-icon.webp'
import fullPng from '../../assets/brand/logo-full.png'
import fullWebp from '../../assets/brand/logo-full.webp'
import './Logo.css'

type LogoProps = {
  /** 'icon' shows just the hummingbird mark (transparent, tightly cropped); 'full' shows the complete lockup (icon + wordmark + tagline). */
  variant?: 'icon' | 'full'
  withWordmark?: boolean
  withTagline?: boolean
  size?: number
  /** Set true for above-the-fold placements (e.g. the Hero) so the image loads eagerly instead of lazily. */
  priority?: boolean
}

export default function Logo({
  variant = 'icon',
  withWordmark = true,
  withTagline = false,
  size = 48,
  priority = false,
}: LogoProps) {
  if (variant === 'full') {
    return (
      <picture>
        <source srcSet={fullWebp} type="image/webp" />
        <img
          src={fullPng}
          alt="MAEWALLISCORP — Avanzamos en todas direcciones"
          className="mwc-logo-full"
          style={{ width: size, height: 'auto' }}
          loading={priority ? 'eager' : 'lazy'}
          fetchPriority={priority ? 'high' : 'auto'}
        />
      </picture>
    )
  }

  return (
    <div className="mwc-logo">
      <picture>
        <source srcSet={iconWebp} type="image/webp" />
        <img src={iconPng} alt="" aria-hidden="true" className="mwc-logo-icon" style={{ width: size }} />
      </picture>

      {(withWordmark || withTagline) && (
        <div className="mwc-logo-text" style={{ '--mwc-logo-size': `${size}px` } as CSSProperties}>
          {withWordmark && <span className="mwc-logo-wordmark">MAEWALLIS CORP</span>}
          {withTagline && <span className="mwc-logo-tagline">Avanzamos en todas direcciones.</span>}
        </div>
      )}
    </div>
  )
}
