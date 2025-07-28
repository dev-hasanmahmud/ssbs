// src/pages/Login.jsx
import { useState } from 'react';
import API from '../api/axios';
import endpoints from '../api/endpoints';
import { useAuth } from '../context/AuthContext';
import { useNavigate } from 'react-router-dom';

export default function Login() {
  const [form, setForm] = useState({ email: '', password: '' });
  const { login } = useAuth();
  const navigate = useNavigate();

  const handleLogin = async (e) => {
    e.preventDefault();
    try {
      const res = await API.post(endpoints.login, form);
      login(res.data.user, res.data.token);
      navigate('/');
    } catch {
      alert('Login failed');
    }
  };

  return (
    <div className="text-center container mt-5" style={{ maxWidth: '400px' }}>
      <form onSubmit={handleLogin}>
        <h1 className="h3 mb-3 font-weight-normal">Please sign in</h1>

        <input
          type="email"
          className="form-control mb-2"
          placeholder="Email address"
          required
          onChange={(e) => setForm({ ...form, email: e.target.value })}
        />
        <input
          type="password"
          className="form-control mb-2"
          placeholder="Password"
          required
          onChange={(e) => setForm({ ...form, password: e.target.value })}
        />

        <button className="btn btn-lg btn-primary btn-block w-100" type="submit">
          Sign in
        </button>
      </form>
    </div>
  );
}
