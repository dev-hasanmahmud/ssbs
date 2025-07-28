import { Link, useNavigate } from 'react-router-dom';
import { useEffect, useState } from 'react';

export default function Header() {
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [userName, setUserName] = useState('');
  const [isAdmin, setIsAdmin] = useState(false);
  const navigate = useNavigate();

  useEffect(() => {
    const token = localStorage.getItem('token');
    const user = JSON.parse(localStorage.getItem('auth_user'));

    if (token && user) {
      setIsLoggedIn(true);
      setUserName(user.name);
      setIsAdmin(user.is_admin === 1);
    }
  }, []);

  const handleLogout = () => {
    localStorage.removeItem('token');
    localStorage.removeItem('auth_user');
    setIsLoggedIn(false);
    navigate('/login');
  };

  return (
    <nav className="navbar navbar-expand-lg navbar-dark bg-white border-bottom px-3">
      <Link className="navbar-brand" to="/">SSBS</Link>

      <div className="collapse navbar-collapse">
        <ul className="navbar-nav me-auto">
          <li className="nav-item">
            <Link className="nav-link text-dark" to="/">Home</Link>
          </li>
          {isLoggedIn && isAdmin && (
          <li className="nav-item dropdown">
            <a
              className="nav-link text-dark dropdown-toggle"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
            >
              Admin Panel
            </a>
            <ul className="dropdown-menu dropdown-menu-end">
              <li>
                <Link className="dropdown-item text-dark" to="/services">Services</Link>
              </li>
              <li>
                <Link className="dropdown-item text-dark" to="/bookings">Bookings</Link>
              </li>
            </ul>
          </li>
          )}
        </ul>

        <ul className="navbar-nav ms-auto">
          {!isLoggedIn ? (
            <>
              <li className="nav-item">
                <Link className="nav-link text-dark" to="/login">Login</Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link text-dark" to="/register">Register</Link>
              </li>
            </>
          ) : (
            <li className="nav-item dropdown">
              <a
                className="nav-link text-dark dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
              >
                {userName}
              </a>
              <ul className="dropdown-menu dropdown-menu-end">
                <li>
                  <Link className="dropdown-item text-dark" to="/profile">Profile</Link>
                </li>
                <li>
                  <button className="dropdown-item text-dark" onClick={handleLogout}>
                    Logout
                  </button>
                </li>
              </ul>
            </li>
          )}
        </ul>
      </div>
    </nav>
  );
}
