import { useEffect, useRef } from 'react'
import './NetworkBackground.css'

type Node = {
  x: number
  y: number
  vx: number
  vy: number
}

const NODE_COUNT = 70
const LINK_DISTANCE = 130
const POINTER_LINK_DISTANCE = 200
const POINTER_RADIUS = 160

export default function NetworkBackground() {
  const canvasRef = useRef<HTMLCanvasElement>(null)

  useEffect(() => {
    const canvas = canvasRef.current
    if (!canvas) return

    const ctx = canvas.getContext('2d')
    if (!ctx) return

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches

    let width = 0
    let height = 0
    let nodes: Node[] = []
    let animationFrame = 0
    const pointer = { x: -9999, y: -9999, active: false }

    function resize() {
      const parent = canvas!.parentElement
      if (!parent) return
      width = parent.clientWidth
      height = parent.clientHeight
      canvas!.width = width * window.devicePixelRatio
      canvas!.height = height * window.devicePixelRatio
      canvas!.style.width = `${width}px`
      canvas!.style.height = `${height}px`
      ctx!.setTransform(window.devicePixelRatio, 0, 0, window.devicePixelRatio, 0, 0)
    }

    function createNodes() {
      nodes = Array.from({ length: NODE_COUNT }).map(() => ({
        x: Math.random() * width,
        y: Math.random() * height,
        vx: (Math.random() - 0.5) * 0.35,
        vy: (Math.random() - 0.5) * 0.35,
      }))
    }

    function step() {
      ctx!.clearRect(0, 0, width, height)

      for (const node of nodes) {
        node.x += node.vx
        node.y += node.vy

        if (node.x <= 0 || node.x >= width) node.vx *= -1
        if (node.y <= 0 || node.y >= height) node.vy *= -1

        node.x = Math.min(Math.max(node.x, 0), width)
        node.y = Math.min(Math.max(node.y, 0), height)

        // gentle pull toward the pointer so the mesh visibly follows it
        if (pointer.active) {
          const dx = pointer.x - node.x
          const dy = pointer.y - node.y
          const dist = Math.hypot(dx, dy)
          if (dist < POINTER_RADIUS && dist > 0.01) {
            const force = (1 - dist / POINTER_RADIUS) * 0.02
            node.vx += (dx / dist) * force
            node.vy += (dy / dist) * force
          }
        }

        // clamp speed so nodes don't runaway
        const speed = Math.hypot(node.vx, node.vy)
        const maxSpeed = 0.8
        if (speed > maxSpeed) {
          node.vx = (node.vx / speed) * maxSpeed
          node.vy = (node.vy / speed) * maxSpeed
        }
      }

      for (let i = 0; i < nodes.length; i++) {
        for (let j = i + 1; j < nodes.length; j++) {
          const a = nodes[i]
          const b = nodes[j]
          const dist = Math.hypot(a.x - b.x, a.y - b.y)
          if (dist < LINK_DISTANCE) {
            ctx!.strokeStyle = `rgba(255, 255, 255, ${0.12 * (1 - dist / LINK_DISTANCE)})`
            ctx!.lineWidth = 1
            ctx!.beginPath()
            ctx!.moveTo(a.x, a.y)
            ctx!.lineTo(b.x, b.y)
            ctx!.stroke()
          }
        }

        if (pointer.active) {
          const dist = Math.hypot(nodes[i].x - pointer.x, nodes[i].y - pointer.y)
          if (dist < POINTER_LINK_DISTANCE) {
            ctx!.strokeStyle = `rgba(255, 255, 255, ${0.35 * (1 - dist / POINTER_LINK_DISTANCE)})`
            ctx!.lineWidth = 1
            ctx!.beginPath()
            ctx!.moveTo(nodes[i].x, nodes[i].y)
            ctx!.lineTo(pointer.x, pointer.y)
            ctx!.stroke()
          }
        }
      }

      for (const node of nodes) {
        ctx!.fillStyle = 'rgba(255, 255, 255, 0.55)'
        ctx!.beginPath()
        ctx!.arc(node.x, node.y, 1.6, 0, Math.PI * 2)
        ctx!.fill()
      }

      if (!prefersReducedMotion) {
        animationFrame = requestAnimationFrame(step)
      }
    }

    function handlePointerMove(event: PointerEvent) {
      const rect = canvas!.getBoundingClientRect()
      pointer.x = event.clientX - rect.left
      pointer.y = event.clientY - rect.top
      pointer.active = true
    }

    function handlePointerLeave() {
      pointer.active = false
    }

    resize()
    createNodes()
    step()

    const parent = canvas.parentElement
    parent?.addEventListener('pointermove', handlePointerMove)
    parent?.addEventListener('pointerleave', handlePointerLeave)

    const resizeObserver = new ResizeObserver(() => {
      resize()
    })
    if (parent) resizeObserver.observe(parent)

    if (prefersReducedMotion) {
      step()
    }

    return () => {
      cancelAnimationFrame(animationFrame)
      parent?.removeEventListener('pointermove', handlePointerMove)
      parent?.removeEventListener('pointerleave', handlePointerLeave)
      resizeObserver.disconnect()
    }
  }, [])

  return <canvas ref={canvasRef} className="mwc-network-bg" aria-hidden="true" />
}
