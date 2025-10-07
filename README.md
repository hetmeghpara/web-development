# 🏀 National Basketball Club Website

A comprehensive web application for managing a basketball club with modern features including event management, feedback systems, user authentication, and JSON API integration.

## 📋 Table of Contents
- [Features](#features)
- [Project Structure](#project-structure)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Usage](#usage)
- [API Documentation](#api-documentation)
- [Technologies Used](#technologies-used)
- [Security Features](#security-features)
- [Contributing](#contributing)

## ✨ Features

### 🏠 Core Pages
- **Home Page** (`page1.html`) - Main landing page with club information
- **Careers** (`page2.html`) - Basketball career opportunities
- **Star Players** (`page3.html`) - Showcase of club's top players
- **Rule Book** (`page4.html`) - Official basketball rules and regulations
- **Enrollment** (`page5.html`) - Player registration system
- **Scholarship** (`page6.php`) - Scholarship portal with login system
- **Student Profiles** (`page7.php`) - Student authentication and dashboard
- **Events** (`page8.html`) - Dynamic events display with JSON integration
- **Feedback** (`page9.html`) - Feedback collection system
- **Contact Us** (`page10.html`) - Contact information

### 🔐 Authentication System
- **Session Management** - Secure login/logout with session timeout
- **Cookie Support** - "Remember Me" functionality
- **Protected Routes** - Access control for sensitive pages
- **User Dashboard** - Personalized user experience

### 📊 Event Management
- **CRUD Operations** - Create, Read, Update, Delete events
- **Image Upload** - Poster upload functionality
- **Status Management** - Open/Closed event status
- **JSON API** - RESTful API for event data
- **Dashboard** - Interactive event management interface

### 💬 Feedback System
- **Database Storage** - MySQL integration for feedback
- **JSON Logging** - Dual storage system
- **Export Functionality** - JSON export capabilities
- **Dashboard View** - Admin feedback management

### 🔄 JSON Integration
- **Events API** - Full RESTful API for events
- **Data Export** - JSON export functionality
- **Dynamic Loading** - AJAX-based content loading
- **Statistics** - Real-time data analytics

## 📁 Project Structure

```
National Basketball Club/
├── 📄 Core Pages
│   ├── page1.html          # Home page
│   ├── page2.html          # Careers
│   ├── page3.html          # Star Players
│   ├── page4.html          # Rule Book
│   ├── page5.html          # Enrollment
│   ├── page6.php           # Scholarship (Protected)
│   ├── page7.php           # Student Login
│   ├── page8.html          # Events
│   ├── page9.html          # Feedback Form
│   └── page10.html         # Contact Us
│
├── 🔧 PHP Backend
│   ├── b.php               # Event Manager
│   ├── process_feedback.php # Feedback Processing
│   ├── export_feedback_json.php # Feedback JSON API
│   ├── events_api.php      # Events REST API
│   ├── student_dashboard.php # Student Dashboard
│   ├── logout.php          # Logout Handler
│   ├── session_check.php   # Session Validation
│   └── view_feedback.php   # Feedback Dashboard
│
├── 📊 Data Files
│   ├── events.json         # Events Data
│   ├── feedback_log.json   # Feedback Log
│   ├── database_setup.sql  # Database Schema
│   └── data.json          # Additional Data
│
├── 🎨 Assets
│   ├── page1.css          # Styling
│   ├── enrol.js           # JavaScript
│   ├── pg3.js             # Page 3 Scripts
│   └── 📁 Images/         # Various image files
│
└── 📋 Dashboard
    ├── events_dashboard.html # Events Management
    └── JSON.html           # JSON Viewer
```

## 🚀 Installation

### Prerequisites
- **XAMPP** or **WAMP** server
- **PHP 7.4+**
- **MySQL 5.7+**
- **Web Browser** (Chrome, Firefox, Safari)

### Step 1: Download & Setup
```bash
# Clone or download the project
git clone https://github.com/hetmeghpara/web-development.git

# Move to XAMPP htdocs directory
mv "National Basketball Club" C:/xampp/htdocs/basketball_club/
```

### Step 2: Start Services
1. Open **XAMPP Control Panel**
2. Start **Apache** and **MySQL** services
3. Ensure both services are running (green status)

### Step 3: Create Upload Directory
```bash
# Create upload directory for event posters
mkdir C:/xampp/htdocs/basketball_club/upload
```

## 🗄️ Database Setup

### Automatic Setup
1. Open your browser and go to `http://localhost/phpmyadmin`
2. Click on **"SQL"** tab
3. Copy and paste the content from `database_setup.sql`
4. Click **"Go"** to execute

### Manual Setup
```sql
-- Create main database
CREATE DATABASE basketball_club;
USE basketball_club;

-- Create feedback table
CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    experience VARCHAR(50) NOT NULL,
    comments TEXT,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create events database
CREATE DATABASE event_db;
USE event_db;

-- Create events table
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    date DATE,
    status ENUM('open', 'closed') DEFAULT 'open',
    poster VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## 📖 Usage

### Accessing the Website
- **Main Website**: `http://localhost/basketball_club/page1.html`
- **Event Manager**: `http://localhost/basketball_club/b.php`
- **Student Login**: `http://localhost/basketball_club/page7.php`
- **Events Dashboard**: `http://localhost/basketball_club/events_dashboard.html`

### Demo Credentials

#### Student Portal
- **Email**: `student1@nbc.com` | **Password**: `pass123`
- **Email**: `admin@nbc.com` | **Password**: `admin123`

#### Features to Test
1. **Event Management** - Add, edit, delete events with poster upload
2. **Feedback System** - Submit and view feedback
3. **Authentication** - Login with "Remember Me" functionality
4. **JSON API** - Test API endpoints
5. **Session Management** - Login timeout and security

## 🔌 API Documentation

### Events API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/events_api.php` | Get all events |
| `GET` | `/events_api.php?id=1` | Get specific event |
| `POST` | `/events_api.php` | Create new event |
| `PUT` | `/events_api.php` | Update existing event |
| `DELETE` | `/events_api.php` | Delete event |

### Feedback API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/export_feedback_json.php` | Get all feedback as JSON |
| `POST` | `/process_feedback.php` | Submit new feedback |

### Example API Usage

```javascript
// Get all events
fetch('events_api.php')
  .then(response => response.json())
  .then(data => console.log(data));

// Add new event
fetch('events_api.php', {
  method: 'POST',
  headers: {'Content-Type': 'application/json'},
  body: JSON.stringify({
    title: 'New Tournament',
    description: 'Annual basketball tournament',
    date: '2025-12-01',
    location: 'NBC Arena',
    category: 'tournament',
    registration_fee: 500,
    max_participants: 64
  })
});
```

## 🛠️ Technologies Used

### Frontend
- **HTML5** - Semantic markup
- **CSS3** - Modern styling with gradients and animations
- **JavaScript** - Interactive functionality and AJAX
- **Responsive Design** - Mobile-friendly layouts

### Backend
- **PHP 7.4+** - Server-side processing
- **MySQL** - Database management
- **JSON** - Data interchange format
- **Sessions & Cookies** - Authentication management

### Features
- **File Upload** - Image handling for event posters
- **Form Validation** - Client and server-side validation
- **Security** - XSS protection, SQL injection prevention
- **API Development** - RESTful API endpoints

## 🔒 Security Features

### Authentication Security
- ✅ **Session Management** - Secure session handling
- ✅ **Password Protection** - Encrypted authentication
- ✅ **Session Timeout** - Automatic logout (30 minutes)
- ✅ **Cookie Security** - Secure cookie implementation

### Data Security
- ✅ **SQL Injection Prevention** - Prepared statements and escaping
- ✅ **XSS Protection** - Input sanitization with `htmlspecialchars()`
- ✅ **File Upload Security** - Safe file handling
- ✅ **Input Validation** - Server-side validation

### Best Practices
- ✅ **HTTPS Ready** - SSL/TLS compatible
- ✅ **Error Handling** - Proper error management
- ✅ **Access Control** - Protected routes
- ✅ **Data Sanitization** - Clean input/output

## 📊 Features Overview

| Feature | Status | Description |
|---------|--------|-------------|
| 🏠 **Multi-page Website** | ✅ Complete | 10 interconnected pages |
| 🔐 **Authentication System** | ✅ Complete | Login, logout, session management |
| 📅 **Event Management** | ✅ Complete | CRUD operations with file upload |
| 💬 **Feedback System** | ✅ Complete | Database + JSON storage |
| 🔌 **REST API** | ✅ Complete | Full CRUD API for events |
| 📊 **Dashboard** | ✅ Complete | Interactive management interface |
| 📱 **Responsive Design** | ✅ Complete | Mobile-friendly layouts |
| 🔒 **Security** | ✅ Complete | Multiple security layers |

## 🤝 Contributing

1. **Fork** the repository
2. **Create** a feature branch (`git checkout -b feature/AmazingFeature`)
3. **Commit** your changes (`git commit -m 'Add some AmazingFeature'`)
4. **Push** to the branch (`git push origin feature/AmazingFeature`)
5. **Open** a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👥 Authors

- **Het Meghpara** - *Lead Developer* - [@hetmeghpara](https://github.com/hetmeghpara)

## 🙏 Acknowledgments

- **Basketball Community** - For inspiration and requirements
- **Open Source Libraries** - For enabling rapid development
- **XAMPP Team** - For the local development environment

## 📞 Support

For support, email hetmeghpara@example.com or create an issue in the repository.

---

**Made with ❤️ for the Basketball Community** 🏀

*Last Updated: October 7, 2025*