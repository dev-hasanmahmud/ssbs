import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import API from '../../api/axios';
import endpoints from '../../api/endpoints';

export default function ServiceList() {
  const [services, setServices] = useState([]);

  const fetchServices = async () => {
    const res = await API.get(endpoints.services);
    setServices(res.data.data);
  };

  const handleDelete = async (id) => {
    if (window.confirm('Are you sure?')) {
      await API.delete(endpoints.deleteService(id));
      fetchServices();
    }
  };

  useEffect(() => {
    fetchServices();
  }, []);

  return (
    <div className="container mt-4">
      <div className="d-flex justify-content-between align-items-center mb-3">
        <h4>All Services</h4>
        <Link to="/services/create" className="btn btn-primary btn-sm">Create Service</Link>
      </div>

      <table className="table table-bordered table-striped align-middle">
        <thead className="table-light">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Status</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          {services.length > 0 ? (
            services.map((service, i) => (
              <tr key={service.id}>
                <td>{i + 1}</td>
                <td>{service.name}</td>
                <td>${service.price}</td>
                <td>{service.description}</td>
                <td>{service.status}</td>
                <td>{formatDate(service.created_at)}</td>
                <td>
                  <Link to={`/services/${service.id}/edit`} className="btn btn-info btn-sm me-2">Edit</Link>
                  <button onClick={() => handleDelete(service.id)} className="btn btn-danger btn-sm">Delete</button>
                </td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan="7" className="text-center">No services found.</td>
            </tr>
          )}
        </tbody>
      </table>
    </div>
  );
}

function formatDate(dateStr) {
  const date = new Date(dateStr);
  return date.toLocaleString('en-US', {
    day: '2-digit',
    month: 'short',
    year: 'numeric',
    hour: 'numeric',
    minute: '2-digit',
    hour12: true,
  });
}
