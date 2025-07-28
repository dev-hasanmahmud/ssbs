import { useState } from 'react';
import API from '../api/axios';
import endpoints from '../api/endpoints';

export default function ServiceCard({ service }) {
  const [bookingDate, setBookingDate] = useState('');

  const book = async () => {
    try {
      await API.post(endpoints.bookings, {
        service_id: service.id,
        booking_date: bookingDate,
      });
      alert('Service Booked.');
    } catch {
      alert('Something went wrong.');
    }
  };

  return (
    <div className="card mb-4 box-shadow h-100 text-center">
      <div className="card-header">
        <h4 className="my-0 font-weight-normal">{service.name}</h4>
      </div>
      <div className="card-body d-flex flex-column">
        <h1 className="card-title pricing-card-title">${service.price}</h1>
        <p className="text-muted">{service.description}</p>
        <input
          type="date"
          className="form-control my-2"
          value={bookingDate}
          required
          onChange={(e) => setBookingDate(e.target.value)}
        />
        <button onClick={book} className="btn btn-lg btn-outline-primary mt-auto">
          Book
        </button>
      </div>
    </div>
  );
}
