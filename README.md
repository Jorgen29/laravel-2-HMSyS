# Hotel Management System (HMS)

A modern Hotel Management System built with Laravel 12, featuring comprehensive room management, user authentication, and admin dashboard with role-based access control.

## Technologies Used

### Backend
- **Laravel 12** - Modern PHP web application framework
- **PHP 8.x** - Server-side programming language
- **MySQL** - Relational database for data persistence
- **Eloquent ORM** - Object-Relational Mapping for database interactions
- **Laravel Fortify** - Lightweight authentication scaffolding
- **Laravel Jetstream** - Application scaffolding with Livewire and Inertia support

### Frontend
- **Bootstrap 4** - Responsive CSS framework for UI design
- **jQuery** - JavaScript library for DOM manipulation and AJAX
- **Font Awesome** - Icon library for intuitive UI elements
- **Blade Templating** - Laravel's powerful templating engine
- **HTML5 & CSS3** - Standard web technologies

### Development Tools
- **Composer** - PHP dependency manager
- **NPM** - JavaScript package manager
- **Vite** - Modern frontend build tool
- **Artisan** - Laravel command-line interface

## Key Features

### Authentication & Authorization
- User registration and login functionality
- Two user types: Admin and Regular User
- Role-based dashboard routing (Admin → Admin Panel, User → User Dashboard)
- Two-factor authentication support via Fortify
- Secure logout functionality

### Room Management (Admin Only)
- **Create Room** - Add new rooms with title, price, type, WiFi status, and images
- **View Rooms** - Display all rooms in a professional table format with:
  - Room details (title, description, price, WiFi status, type)
  - Room images with full-size image viewer modal
  - Search functionality to filter rooms in real-time
- **Edit Room** - Update room information via modal popup without page navigation
- **Delete Room** - Remove rooms with confirmation dialog
- **Image Management** - Upload and display room images with automatic file handling

### User Dashboard
- Displays available rooms for browsing
- View room details and images
- Role-restricted access

### Admin Dashboard
- Comprehensive room management interface
- Dynamic navigation with active state detection
- Professional table layout with action buttons
- Responsive design compatible with mobile and desktop

### Search Functionality
- Real-time search across room titles, types, and WiFi status
- Search from header search panel
- Case-insensitive matching with partial search support
- Instant table filtering without page reload

### User Interface
- DarkAdmin professional template design
- Bootstrap modal popups for editing and image viewing
- Responsive sidebar navigation
- Dynamic navigation highlighting based on current route
- Professional color scheme and typography
- AJAX-powered interactions for smooth user experience

## Database Structure

### Users Table
- `id` - Primary key
- `name` - User full name
- `email` - User email address (unique)
- `password` - Encrypted password
- `phone` - User phone number (nullable)
- `usertype` - User role (admin/user)
- `two_factor_secret` - Two-factor authentication secret
- `two_factor_recovery_codes` - Recovery codes for 2FA
- Timestamps (created_at, updated_at)

### Rooms Table
- `id` - Primary key
- `room_title` - Name of the room
- `description` - Detailed room description
- `price` - Room price per night
- `room_type` - Room category (Regular, Premium, Deluxe)
- `wifi` - WiFi availability (yes/no)
- `image` - Room image filename
- Timestamps (created_at, updated_at)

## API Endpoints

### Authentication Routes
- `POST /login` - User login
- `POST /register` - User registration
- `POST /logout` - User logout
- `GET /dashboard` - Role-based dashboard routing

### Admin Routes
- `GET /create_room` - Room creation form
- `POST /add_room` - Create new room
- `GET /view_room` - View all rooms
- `GET /get_room/{id}` - Get room details (AJAX/JSON)
- `POST /update_room/{id}` - Update room information
- `POST /delete_room/{id}` - Delete room

## Installation & Setup

1. Clone the repository
2. Install PHP dependencies: `composer install`
3. Install JavaScript dependencies: `npm install`
4. Copy `.env.example` to `.env` and configure database
5. Generate application key: `php artisan key:generate`
6. Run migrations: `php artisan migrate`
7. Seed database (optional): `php artisan db:seed`
8. Build assets: `npm run build`
9. Start development server: `php artisan serve`

## File Storage

- Room images are stored in `public/rooms/` directory
- Images are automatically handled with timestamp-based naming for uniqueness
- Old images are deleted when rooms are updated or deleted

## Security Features

- CSRF protection on all forms
- Password encryption using bcrypt
- SQL injection prevention via Eloquent ORM
- CORS configuration for API security
- Two-factor authentication support
- Role-based access control (RBAC)

## License

This project is open-sourced software licensed under the MIT license.
