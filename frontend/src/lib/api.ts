export const API_BASE = import.meta.env.VITE_API_URL ?? '/api'

export type Service = {
  id: number
  icon: string
  title: string
  description: string
  position: number
}

export type PortfolioItem = {
  id: number
  category: string
  title: string
  description: string
  position: number
}

export type Partner = {
  slug: string
  name: string
  role: string
  semblanza: string
  academico: string[]
  profesional: string[]
  publicaciones: string[]
  links: { label: string; url: string }[]
  pendingReview: boolean
}

export type SiteSettings = Record<string, string>
