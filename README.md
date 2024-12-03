# CSC131NextGenTutors
This is a class group project for CSC131.
This document explains how to set up the project using Docker and MySQL client.

---

## Step 1: Run Docker

1. Use Docker Compose to stop and rebuild containers:
   ```bash
   docker-compose down --remove-orphans
   docker-compose up --build
   ```

---

## Step 2: Install MySQL Client and Connect to the Database

1. Run the following commands in a terminal (make sure you navigate to your project repository first):
   ```bash
   docker exec -it php_container bash
   ```
2. Install the MySQL client:
   ```bash
   apt-get update
   apt-get install default-mysql-client -y
   ```
3. Connect to the MySQL server:
   ```bash
   mysql -h mysql -u user -p
   ```
   - When prompted, enter the password: `password`.

---

## Step 3: Test Database Connection

1. Open your web browser and go to the following URL to test the database connection:
   ```
   http://localhost:8080/test_db_connection.php
   ```

---

## Notes

If you encounter any issues during the setup process, please check the logs and review the steps carefully.
