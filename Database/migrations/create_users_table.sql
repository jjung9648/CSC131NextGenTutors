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
CREATE TABLE tutors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);
CREATE TABLE assignments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tutor_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    grade INT NOT NULL,
    date DATE NOT NULL,
    FOREIGN KEY (tutor_id) REFERENCES tutors(id)
);