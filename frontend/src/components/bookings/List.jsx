import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import API from '../../api/axios';
import endpoints from '../../api/endpoints';

export default function Home() {
  const [bookings, setBookings] = useState([]);

  useEffect(() => {
    API.get(endpoints.adminBookings)
      .then((res) => {
        setBookings(res.data.data);
      })
      .catch((err) => console.error(err));
  }, []);

  return (
    <div className="container mt-2">
      <div className="row">
        <div className="col-12">
          <h6>All Bookings</h6>
          <p className="text-muted">Admin Panel / Bookings / List</p>
        </div>
      </div>
      <div className="table-responsive">
        <table className="table table-bordered table-striped align-middle">
          <thead className="table-light">
            <tr>
              <th>#</th>
              <th>Customer</th>
              <th>Service</th>
              <th>Booking Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            {bookings.length > 0 ? (
              bookings.map((booking, index) => (
                <tr key={booking.id}>
                  <td>{index + 1}</td>
                  <td>{booking.user?.name || 'N/A'}</td>
                  <td>{booking.service?.name || 'N/A'}</td>
                  <td>{formatDate(booking.booking_date)}</td>
                  <td>{booking.status}</td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="5" className="text-center">No bookings found.</td>
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
