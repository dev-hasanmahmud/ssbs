import { BrowserRouter, Routes, Route, Link } from 'react-router-dom';
import Home from './pages/Home';
import Login from './pages/Login';
import Register from './pages/Register';
import Header from './components/Header';
import Footer from './components/Footer';
import Profile from './pages/Profile';
import ServiceList from './components/services/List';
import BookingList from './components/bookings/List';

function App() {
  return (
    <BrowserRouter>
      <Header />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/profile" element={<Profile />} />
        <Route path="/service-list" element={<ServiceList />} />
        <Route path="/booked-list" element={<BookingList />} />
      </Routes>
      <Footer />
    </BrowserRouter>
  );
}

export default App;
