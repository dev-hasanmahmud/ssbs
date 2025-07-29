import { useEffect, useState } from 'react';
import API from '../../api/axios';
import endpoints from '../../api/endpoints';

export default function Home() {
  const [services, setServices] = useState([]);

  useEffect(() => {
    API.get(endpoints.services)
      .then((res) => {
        setServices(res.data.data);
      })
      .catch((err) => console.error(err));
  }, []);

  return (
    <div className="container mt-4">
      <div className="text-center mb-4">
        <h2>All Services</h2>
        <p className="text-muted">View your services</p>
      </div>

      <div className="table-responsive">
        <table className="table table-bordered table-striped align-middle">
          <thead className="table-light">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Price</th>
              <th>Description</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            {services.length > 0 ? (
              services.map((service, index) => (
                <tr key={service.id}>
                  <td>{index + 1}</td>
                  <td>{service.name}</td>
                  <td>${service.price}</td>
                  <td>{service.description}</td>
                  <td>{service.status}</td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="5" className="text-center">No services found.</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
}

function formatDate(dateStr) {
  const date = new Date(dateStr);
  const options = {
    day: '2-digit',
    month: 'long',
    year: 'numeric',
    hour: 'numeric',
    minute: '2-digit',
    hour12: true,
  };
  return date.toLocaleString('en-US', options);
}
