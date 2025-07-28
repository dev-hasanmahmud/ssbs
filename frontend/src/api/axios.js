import axios from 'axios';
import { API_BASE, TOKEN_KEY } from '../constants';

const API = axios.create({
  baseURL: API_BASE,
  headers: {
    Accept: 'application/json',
  },
});

API.interceptors.request.use((config) => {
  const token = localStorage.getItem(TOKEN_KEY);
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export default API;
