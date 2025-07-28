import { useEffect, useState } from 'react';
import API from '../api/axios';
import endpoints from '../api/endpoints';

export default function Dashboard() {
  const [services, setServices] = useState([]);

  useEffect(() => {
    API.get(endpoints.services).then((res) => setServices(res.data));
  }, []);

  return (
    <div className="container mt-5">
      <h3>Available Services</h3>
      <ul className="list-group">
        {services.map(service => (
          <li key={service.id} className="list-group-item d-flex justify-content-between align-items-center">
            {service.name}
            <span>${service.price}</span>
          </li>
        ))}
      </ul>
    </div>
  );
}
