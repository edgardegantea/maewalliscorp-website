import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import { resolve } from 'path'

const BACKEND_PUBLIC = resolve(__dirname, '../backend/public')

// https://vite.dev/config/
export default defineConfig(({ command }) => ({
  plugins: [react()],
  base: command === 'build' ? '/build/' : '/',
  server: {
    origin: 'http://localhost:5173',
    cors: true,
    strictPort: true,
    port: 5173,
  },
  build: {
    manifest: true,
    outDir: resolve(BACKEND_PUBLIC, 'build'),
    emptyOutDir: true,
    rollupOptions: {
      input: resolve(__dirname, 'src/main.tsx'),
    },
  },
}))
