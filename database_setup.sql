-- SQL script to create database and table for feedback system

-- Create database
CREATE DATABASE IF NOT EXISTS basketball_club;

-- Use the database
USE basketball_club;

-- Create feedback table
CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    experience VARCHAR(50) NOT NULL,
    comments TEXT,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Show table structure
DESCRIBE feedback;

-- Insert sample data (optional)
INSERT INTO feedback (name, email, experience, comments) VALUES
('John Doe', 'john@example.com', 'Excellent', 'Great facilities and coaching!'),
('Jane Smith', 'jane@example.com', 'Good', 'Nice club, could improve equipment.');