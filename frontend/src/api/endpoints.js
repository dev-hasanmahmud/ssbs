import { API_BASE } from '../constants';

const endpoints = {
  register: `${API_BASE}/register`,
  login: `${API_BASE}/login`,
  services: `${API_BASE}/services`,
  profile: `${API_BASE}/profile`,
  logout: `${API_BASE}/logout`,
  bookings: `${API_BASE}/bookings`,
  createBooking: `${API_BASE}/bookings`,
  createService: `${API_BASE}/services`,
  updateService: (id) => `${API_BASE}/services/${id}`,
  deleteService: (id) => `${API_BASE}/services/${id}`,
  adminBookings: `${API_BASE}/admin/bookings`,
};

export default endpoints;
