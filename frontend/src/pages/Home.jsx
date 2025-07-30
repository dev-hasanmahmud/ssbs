import { useEffect, useState } from 'react';
import API from '../api/axios';
import endpoints from '../api/endpoints';
import ServiceCard from '../components/ServiceCard';

export default function Home() {
  const [services, setServices] = useState([]);

  useEffect(() => {
    API.get(endpoints.services)
      .then((res) => {
        const activeServices = res.data.data.filter(service => service.status === 'active');
        setServices(activeServices);
      })
      .catch((err) => console.error(err));
  }, []);

  return (
    <div className="container mt-2">
      <div className="text-center mb-2">
        <h5 className="display-6">Our Services</h5>
        <p className="lead">Choose a service and book your preferred date</p>
      </div>

      <div className="row row-cols-1 row-cols-md-3 g-4">
        {services.map((service) => (
          <div className="col" key={service.id}>
            <ServiceCard service={service} />
          </div>
        ))}
      </div>
    </div>
  );
}
