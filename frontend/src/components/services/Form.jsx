import { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import API from '../../api/axios'; // Axios config
import endpoints from '../../api/endpoints'; // Endpoint definitions

export default function ServiceForm() {
  const [form, setForm] = useState({
    name: '',
    price: '',
    description: '',
    status: 'active',
  });

  const [loading, setLoading] = useState(true);
  const { id } = useParams();
  const navigate = useNavigate();
  const isEdit = !!id;

  useEffect(() => {
    if (isEdit) {
      API.get(endpoints.getService(id))
        .then((res) => {
          const data = res.data.data;

          setForm({
            name: data.name ?? '',
            price: data.price != null ? String(data.price) : '',
            description: data.description ?? '',
            status: data.status ?? 'active',
          });
        })
        .catch((err) => {
          console.error('Error loading service:', err);
          alert('Service not found.');
          navigate('/service-list');
        })
        .finally(() => setLoading(false));
    } else {
      setLoading(false);
    }
  }, [id, isEdit, navigate]);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setForm((prev) => ({ ...prev, [name]: value }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const formData = new FormData();

      Object.entries(form).forEach(([key, value]) => {
        formData.append(key, value);
      });

      if (isEdit) {
        formData.append('_method', 'PUT');
        await API.post(endpoints.updateService(id), formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
      } else {
        await API.post(endpoints.createService, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
      }

      navigate('/service-list');
    } catch (err) {
      console.error('Error saving service:', err);
      alert('Validation failed. Please check form inputs.');
    }
  };

  if (loading) return <div className="container mt-4">Loading...</div>;

  return (
    <div className="container mt-4">
      <h6>{isEdit ? 'Edit' : 'Create'} Service</h6>
      <form onSubmit={handleSubmit} className="mt-3">
        <div className="mb-3">
          <label>Name</label>
          <input
            type="text"
            name="name"
            className="form-control"
            required
            value={form.name}
            onChange={handleChange}
          />
        </div>

        <div className="mb-3">
          <label>Price</label>
          <input
            type="number"
            name="price"
            className="form-control"
            required
            value={form.price}
            onChange={handleChange}
          />
        </div>

        <div className="mb-3">
          <label>Description</label>
          <textarea
            name="description"
            className="form-control"
            required
            value={form.description}
            onChange={handleChange}
          />
        </div>

        <div className="mb-3">
          <label>Status</label>
          <select
            name="status"
            className="form-select"
            value={form.status}
            onChange={handleChange}
          >
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>

        <button type="submit" className="btn btn-success">
          {isEdit ? 'Update' : 'Create'}
        </button>
      </form>
    </div>
  );
}
