import { BrowserRouter, Routes, Route } from 'react-router-dom'
import Layout from './components/Layout/Layout'
import HomePage from './pages/Home/HomePage'
import PartnerPage from './pages/Partner/PartnerPage'

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route element={<Layout />}>
          <Route index element={<HomePage />} />
          <Route path="nosotros/:slug" element={<PartnerPage />} />
        </Route>
      </Routes>
    </BrowserRouter>
  )
}

export default App
