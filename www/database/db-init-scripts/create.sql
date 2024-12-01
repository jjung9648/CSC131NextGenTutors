-- Students Table
CREATE TABLE students (
    studentFName VARCHAR(50) NOT NULL,
    studentLName VARCHAR(50) NOT NULL,
    student_id VARCHAR(50) PRIMARY KEY,
    student_password VARCHAR(255) NOT NULL,
    student_email VARCHAR(50) NOT NULL,
    sessionschedulenoti BOOL,
    sessioncancelnoti BOOL,
    paynoti BOOL,
    AssiDue BOOL,
    SMSnoti BOOL,
    emailnoti BOOL
);

-- Tutors Table
CREATE TABLE tutors (
    tutorFName VARCHAR(50) NOT NULL,
    tutorLName VARCHAR(50) NOT NULL,
    tutor_id VARCHAR(50) PRIMARY KEY,
    tutor_password VARCHAR(255) NOT NULL,
    tutor_email VARCHAR(50) NOT NULL,
    enrollnoti BOOL,
    paynoti BOOL,
    cancelnoti BOOL,
    bio VARCHAR(1000)
);

-- Session Table
CREATE TABLE session (
    sessionid INT AUTO_INCREMENT PRIMARY KEY,
    starttime DATETIME NOT NULL,
    endtime DATETIME,
    studentID VARCHAR(50),
    tutorID VARCHAR(50),
    courseName VARCHAR(100),
    FOREIGN KEY (studentID) REFERENCES students(student_id),
    FOREIGN KEY (tutorID) REFERENCES tutors(tutor_id)
);

-- Assignment Table
CREATE TABLE assignment (
    sessionid INT,
    assiid INT AUTO_INCREMENT PRIMARY KEY,
    did BOOL,
    due DATE,
    FOREIGN KEY (sessionid) REFERENCES session(sessionid)
);

-- Message for Student Table
CREATE TABLE messageforStudent (
    messageID INT AUTO_INCREMENT PRIMARY KEY,
    StudentId VARCHAR(50),
    contents VARCHAR(1000),
    `read` BOOL,
    FOREIGN KEY (StudentId) REFERENCES students(student_id)
);

-- Message for Tutor Table
CREATE TABLE messagefortutor (
    messageID INT AUTO_INCREMENT PRIMARY KEY,
    TutorId VARCHAR(50),
    contents VARCHAR(1000),
    `read` BOOL,
    FOREIGN KEY (TutorId) REFERENCES tutors(tutor_id)
);

-- Insert Data into Students Table
INSERT INTO students VALUES
('Alice', 'Smith', 'S001', '$2b$12$61zCvU.IkK6u7LLpgK3mIeB95rMmfvNwxtjHLTShrlz5nEM/lJfnm', 'alice@example.com', 1, 0, 1, 1, 0, 1),
('Bob', 'Brown', 'S002', '$2b$12$61zCvU.IkK6u7LLpgK3mIeB95rMmfvNwxtjHLTShrlz5nEM/lJfnm', 'bob@example.com', 1, 1, 0, 0, 1, 0),
('Charlie', 'Davis', 'S003', '$2b$12$61zCvU.IkK6u7LLpgK3mIeB95rMmfvNwxtjHLTShrlz5nEM/lJfnm', 'charlie@example.com', 0, 0, 1, 1, 0, 1),
('David', 'Evans', 'S004', '$2b$12$61zCvU.IkK6u7LLpgK3mIeB95rMmfvNwxtjHLTShrlz5nEM/lJfnm', 'david@example.com', 1, 1, 1, 0, 1, 0),
('Eve', 'Foster', 'S005', '$2b$12$61zCvU.IkK6u7LLpgK3mIeB95rMmfvNwxtjHLTShrlz5nEM/lJfnm', 'eve@example.com', 0, 1, 0, 1, 0, 1);

-- Insert Data into Tutors Table
INSERT INTO tutors VALUES
('Frank', 'Green', 'T001', '$2b$12$61zCvU.IkK6u7LLpgK3mIeB95rMmfvNwxtjHLTShrlz5nEM/lJfnm', 'frank@example.com', 1, 0, 1, 'Experienced Math Tutor'),
('Grace', 'Hall', 'T002', '$2b$12$61zCvU.IkK6u7LLpgK3mIeB95rMmfvNwxtjHLTShrlz5nEM/lJfnm', 'grace@example.com', 0, 1, 0, 'Experienced Science Tutor'),
('Hank', 'Ivy', 'T003', '$2b$12$61zCvU.IkK6u7LLpgK3mIeB95rMmfvNwxtjHLTShrlz5nEM/lJfnm', 'hank@example.com', 1, 1, 1, 'Experienced English Tutor'),
('Ivy', 'Jones', 'T004', '$2b$12$61zCvU.IkK6u7LLpgK3mIeB95rMmfvNwxtjHLTShrlz5nEM/lJfnm', 'ivy@example.com', 0, 0, 1, 'Experienced History Tutor'),
('Jack', 'King', 'T005', '$2b$12$61zCvU.IkK6u7LLpgK3mIeB95rMmfvNwxtjHLTShrlz5nEM/lJfnm', 'jack@example.com', 1, 1, 0, 'Experienced Physics Tutor');

-- Insert Data into Session Table
INSERT INTO session (starttime, endtime, studentID, tutorID, courseName) VALUES
('2024-11-01 10:00:00', '2024-11-01 11:00:00', 'S001', 'T001', 'Math'),
('2024-11-01 12:00:00', '2024-11-01 13:30:00', 'S002', 'T002', 'Science'),
('2024-11-02 14:00:00', '2024-11-02 15:00:00', 'S003', 'T003', 'English'),
('2024-11-02 16:00:00', '2024-11-02 17:00:00', 'S004', 'T004', 'History'),
('2024-11-03 09:00:00', '2024-11-03 10:00:00', 'S005', 'T005', 'Physics');

INSERT INTO session (starttime, studentID, tutorID, courseName) VALUES
('2024-12-01 10:00:00', 'S001', 'T001', 'Computer Science'),
('2024-12-01 12:00:00', 'S002', 'T002', 'Number Theory'),
('2024-12-02 14:00:00', 'S003', 'T003', 'English Literature'),
('2024-12-02 16:00:00', 'S004', 'T004', 'Nursing'),
('2024-12-03 09:00:00', 'S005', 'T005', 'Psychology');

-- Insert Data into Assignment Table
INSERT INTO assignment (sessionid, did, due) VALUES
(1, 1, '2024-11-05'),
(2, 0, '2024-11-06'),
(3, 1, '2024-11-07'),
(4, 0, '2024-11-08'),
(5, 1, '2024-11-09');

-- Insert Data into Message for Student Table
INSERT INTO messageforStudent (StudentId, contents, `read`) VALUES
('S001', 'Your session has been scheduled.', 1),
('S002', 'Your payment has been processed.', 0),
('S003', 'Assignment is due soon.', 1),
('S004', 'Session has been canceled.', 0),
('S005', 'New session is available.', 1);

-- Insert Data into Message for Tutor Table
INSERT INTO messagefortutor (TutorId, contents, `read`) VALUES
('T001', 'New student enrolled.', 1),
('T002', 'Payment has been received.', 0),
('T003', 'Your session has been scheduled.', 1),
('T004', 'Session has been canceled.', 0),
('T005', 'New assignment is available.', 1);
