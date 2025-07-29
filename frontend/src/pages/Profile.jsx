import { useEffect, useState } from 'react';
import API from '../api/axios';
import endpoints from '../api/endpoints';

export default function Profile() {
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(true);

  const formatDateTime = (isoString) => {
    const date = new Date(isoString);
    const options = {
      day: '2-digit',
      month: 'long',
      year: 'numeric',
      hour: 'numeric',
      minute: '2-digit',
      hour12: true,
    };
    return date.toLocaleString('en-US', options);
  };

  useEffect(() => {
    const fetchProfile = async () => {
      try {
        const res = await API.get(endpoints.profile);
        setUser(res.data.data);
      } catch (err) {
        console.error('Failed to fetch profile:', err);
      } finally {
        setLoading(false);
      }
    };

    fetchProfile();
  }, []);

  if (loading) {
    return (
      <div className="container mt-5 text-center">
        <h3>Loading profile...</h3>
      </div>
    );
  }

  if (!user) {
    return (
      <div className="container mt-5 text-center">
        <h3>User not found</h3>
      </div>
    );
  }

  return (
    <div className="container mt-5" style={{ maxWidth: '700px' }}>
      <h2 className="mb-4">Your Profile</h2>
      <div className="card mb-4">
        <div className="card-body">
          <p><strong>Name:</strong> {user.name}</p>
          <p><strong>Email:</strong> {user.email}</p>
          <p><strong>Role:</strong> {user.is_admin ? 'Admin' : 'User'}</p>
          <p><strong>Joined:</strong> {formatDateTime(user.created_at)}</p>
        </div>
      </div>

      <h4 className="mb-3">Your Bookings</h4>
      {user.bookings && user.bookings.length > 0 ? (
        <div className="table-responsive">
          <table className="table table-bordered table-striped">
            <thead className="table-light">
              <tr>
                <th>#</th>
                <th>Service Name</th>
                <th>Booking Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              {user.bookings.map((booking, index) => (
                <tr key={booking.id}>
                  <td>{index + 1}</td>
                  <td>{booking.service.name}</td>
                  <td>{formatDateTime(booking.booking_date)}</td>
                  <td>{booking.status}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      ) : (
        <p className="text-muted">You have no bookings yet.</p>
      )}
    </div>
  );
}
