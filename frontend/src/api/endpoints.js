import { API_BASE } from '../constants';

const endpoints = {
  register: `${API_BASE}/register`,
  login: `${API_BASE}/login`,
  services: `${API_BASE}/services`,
  bookings: `${API_BASE}/bookings`,
  adminBookings: `${API_BASE}/admin/bookings`,
  createService: `${API_BASE}/services`,
  updateService: (id) => `${API_BASE}/services/${id}`,
  deleteService: (id) => `${API_BASE}/services/${id}`,
};

export default endpoints;
