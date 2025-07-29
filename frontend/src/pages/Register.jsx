import { useState } from 'react';
import API from '../api/axios';
import endpoints from '../api/endpoints';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

export default function Register() {
  const [form, setForm] = useState({ name: '', email: '', password: '', password_confirmation: '' });
  const navigate = useNavigate();
  const { login } = useAuth();

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const res = await API.post(endpoints.register, form);
      const { user, token } = res.data.data;

      login(user, token);
      navigate('/');
    } catch (err) {
      alert('Registration failed. Please check your inputs.');
      console.error("Registration error:", error);
    }
  };

  return (
    <div className="text-center container mt-5" style={{ maxWidth: '400px' }}>
      <form onSubmit={handleSubmit}>
        <h1 className="h3 mb-3 font-weight-normal">Create an account</h1>

        <input
          type="text"
          className="form-control mb-2"
          placeholder="Full name"
          required
          onChange={(e) => setForm({ ...form, name: e.target.value })}
        />

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

        <input
          type="password"
          className="form-control mb-2"
          placeholder="Confirm password"
          required
          onChange={(e) => setForm({ ...form, password_confirmation: e.target.value })}
        />

        <button className="btn btn-lg btn-primary btn-block w-100" type="submit">
          Register
        </button>
      </form>
    </div>
  );
}
