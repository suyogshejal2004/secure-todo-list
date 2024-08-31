# secure-todo-list
# Secure To-Do List Application with User Authentication

## Overview

This is a secure to-do list application where users can sign up, log in, and manage their personal tasks. The application is built with PHP and MySQL, featuring secure user authentication and CRUD operations for tasks.

## Features

- **User Authentication**: Sign up, log in, and manage sessions securely.
- **Task Management**: Add, edit, delete, and categorize tasks by status (Pending, In Progress, Completed).
- **Responsive Design**: The interface is mobile-friendly and easy to use.
- **Dynamic Task Updates**: AJAX used for dynamic updates without refreshing the page.
- **Password Hashing**: Secure password storage using PHP password hashing functions.

## Additional Features

- **Email Verification** during sign-up.
- **Password Reset Functionality** with email validation.
- **Task Reminders** with notifications.
- **Activity Log** showing recent task updates.
- **Labels and Tags** for task categorization.

## Project Setup Instructions

1. **Clone the repository**:
   ```bash
   git clone https://github.com/suyogshejal2004/secure-todo-list.git
   # Secure To-Do List Application with User Authentication

This project is a secure to-do list application where users can sign up, log in, and manage their personal tasks. Each user has their own list of tasks protected by authentication.

## Features

- User Registration and Login
- Password hashing and secure user authentication
- Task Management (CRUD operations)
- Responsive design
- Dynamic updates using JavaScript and AJAX
- Form validation

## Technologies Used

- PHP
- MySQL
- JavaScript
- HTML/CSS
- AJAX

## Setup Instructions

### Prerequisites

1. [XAMPP](https://www.apachefriends.org/index.html) (or any local server environment that supports PHP and MySQL)
2. [Visual Studio Code (VS Code)](https://code.visualstudio.com/)
3. Git (optional, for cloning the repository)

### Step-by-Step Guide

#### 1. Clone the Repository

You can clone the repository from GitHub using the following command in your terminal or Git Bash:

```bash
git clone https://github.com/suyogshejal2004/secure-todo-list.git

   
Or you can download the repository as a ZIP file from GitHub and extract it.

2. Move the Project to XAMPP's htdocs Folder
Copy the entire secure-todo-list folder to your XAMPP htdocs directory. The htdocs directory is usually located at:

makefile
Copy code
C:\xampp\htdocs\
So, your project path should look like:

makefile
Copy code
C:\xampp\htdocs\secure-todo-list\
3. Start XAMPP Services
Open the XAMPP Control Panel.
Start the Apache and MySQL services.
4. Import the Database
Open your web browser and go to phpMyAdmin.
Click on the Databases tab.
Create a new database named todo_app.
Click on the Import tab.
Click Choose File and select the todo_app.sql file from the secure-todo-list/database directory.
Click Go to import the database.
5. Configure the Database Connection
Open the project in Visual Studio Code (VS Code).
Locate the db.php file in the includes directory.
Update the database connection details as per your configuration. If you are using XAMPP with the default settings, the configuration should look like this:
php
Copy code
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todo_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
6. Run the Project
Open your web browser.
Navigate to http://localhost/secure-todo-list.
You should see the login page of the Secure To-Do List Application.
7. Register a New User
Click on the Sign Up link.
Fill in the required details and register a new account.
Log in with the credentials you just created.
8. Manage Tasks
Add, edit, or delete tasks from the dashboard.
Use filters to view tasks by category or status.
Additional Features (if implemented)
Password reset functionality.
Email verification during sign-up.
Task reminders and notifications.
Activity log for recent task updates.
Contributing
Contributions are welcome! Please fork the repository and submit a pull request for any changes or improvements.



If you encounter any issues or have any questions, please feel free to open an issue on the repository or contact me directly.

