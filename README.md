# College Attendance Tracking System

A web application for managing student attendance in a college. Professors can log in, select the division (Div A / Div B), and mark students as present or absent for any specific date. The system also allows adding/removing students from the database and viewing individual student attendance per month.

## Table of Contents
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Configuration](#configuration)
- [Database Structure](#database-structure)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)

## Features

- **User Authentication**: Secure authentication for professors.
- **Division Selection**: Choose between Div A and Div B to mark attendance.
- **Mark Attendance**: Mark students as present or absent for any specific date.
- **Attendance Records**: Prevent duplicate attendance records for the same student on the same date.
- **Remarks**: Optional remarks field for noting absence reasons.
- **Student Management**: Add or remove students from the database.
- **Monthly Attendance Summary**: View individual student attendance per month.
- **Date Selection**: Flexible date selection for marking attendance.
- **Visual Feedback**: Present/absent counts for better visual feedback.
- **Audit Trail**: Timestamps for audit purposes.

## Requirements

- PHP 7.4 or higher
- Composer
- Node.js and npm
- MySQL or any other supported database

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/nikhiljoshi1012/internship-app.git
    cd internship-app
    ```

2. Install dependencies:

    ```bash
    composer install
    npm install
    ```

3. Environment configuration:

    Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

    Update the `.env` file with your database credentials and other environment variables.

4. Generate application key:

    ```bash
    php artisan key:generate
    ```

5. Run migrations and seed the database:

    ```bash
    php artisan migrate --seed
    ```

6. Build frontend assets:

    ```bash
    npm run dev
    ```

## Usage

1. Starting the development server:

    ```bash
    php artisan serve
    ```

2. Visit [http://localhost:8000](http://localhost:8000) in your browser.

3. Accessing the system:

    Default admin credentials:
    - Email: admin@example.com
    - Password: password

    Update credentials in the `.env` file for security.

## Configuration

- **Mail configuration**:

    Update the mail settings in the `.env` file to enable email notifications.

- **API configuration**:

    Configure API tokens and permissions in the `.env` file for secure API access.

## Database Structure

The database structure tracks the following information:

### Students:

- `id`: Primary key
- `name`: Student name
- `division`: Division (Div A / Div B)
- `roll_number`: Unique roll number
- `photo`: Student photo
- Timestamps

### Attendance Records:

- `id`: Primary key
- `student_id`: Foreign key referencing students
- `date`: Date of attendance
- `status`: Present or Absent
- `remarks`: Optional remarks for absences
- Timestamps

## Testing

Running tests:

```bash
php artisan test

Ensure all tests pass before deploying or contributing.

##Contributing
Fork the repository.
Create a new branch for your feature or bugfix.
Submit a pull request with a detailed description of your changes.

##License
This project is licensed under the MIT License. See the LICENSE file for more details.
Feel free to use and modify this template as needed!
