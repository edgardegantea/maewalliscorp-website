import { BrowserRouter, Routes, Route } from 'react-router-dom'
import Layout from './components/Layout/Layout'
import HomePage from './pages/Home/HomePage'
import PartnerPage from './pages/Partner/PartnerPage'
import PrivacyPage from './pages/Legal/PrivacyPage'
import TermsPage from './pages/Legal/TermsPage'
import NotFoundPage from './pages/NotFound/NotFoundPage'

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route element={<Layout />}>
          <Route index element={<HomePage />} />
          <Route path="nosotros/:slug" element={<PartnerPage />} />
          <Route path="aviso-de-privacidad" element={<PrivacyPage />} />
          <Route path="terminos-y-condiciones" element={<TermsPage />} />
          <Route path="*" element={<NotFoundPage />} />
        </Route>
      </Routes>
    </BrowserRouter>
  )
}

export default App
