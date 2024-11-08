CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO users (email, password)
VALUES (
        'tuan@example.com',
        '$2y$10$ThXyVunIPkBbJoidYYxBC.KmwE7dlPgdFLWKPjKQY59EraW735lgy'
    );