# Job Portal Project

Welcome to the Job Portal Project repository! This web application is a job portal system developed using HTML, CSS, PHP, and MySQL. It enables job seekers and employers to connect, browse job listings, post jobs, apply for openings, and generate admin reports.

## Version

- **Version:** 1.0.0
- **Developer:** Sanaya Yadav

## Features

- **User Authentication:** Secure registration and login for job seekers and employers.
- **Job Listings:** Browse available job opportunities.
- **Advanced Search:** Search jobs by location, industry, and type.
- **Job Application:** Apply for jobs and save favorite listings.
- **Employer Accounts:** Post and manage job vacancies.
- **Responsive Design:** Optimized for desktop and mobile devices.
- **Report Generation:** Admin panel report export features.

## Technologies Used

- **Front-end:** HTML, CSS
- **Back-end:** PHP
- **Database:** MySQL

## Server Requirements

- PHP 7.0 or higher
- MySQL / MariaDB
- Apache web server
- Local development stack such as XAMPP, WAMP, or Laragon

## Local Deployment

1. Install a local server environment such as XAMPP.
2. Copy the project folder into `htdocs` (XAMPP) or the equivalent web root directory.
3. Start Apache and MySQL from the control panel.
4. Open phpMyAdmin and create a database named `jobportal`.
5. Import `JobPortal.sql` into the new database.
6. Open the browser and visit: `http://localhost/Job-Portal-Project-PHP-MySql-CSS-main/index.php`

You can also run the included `setup-local.bat` script from the project root to copy the application into XAMPP's `htdocs` folder and launch the XAMPP control panel.

## Ngrok Integration

To make the job portal accessible over the internet via ngrok:

1. Ensure your local server is running (Apache and MySQL started).
2. Download and install ngrok from https://ngrok.com/download.
3. Run ngrok with the command: `ngrok http 80` (assuming Apache is on port 80).
4. Ngrok will provide a public URL, e.g., `https://wreckage-eggnog-google.ngrok-free.dev`.
5. Access the job portal via: `https://wreckage-eggnog-google.ngrok-free.dev/JobPortal/index.php`

The app is configured with dynamic base paths, so it should work seamlessly with ngrok URLs.

To configure the database connection without editing code, copy `.env.example` to `.env` and update the values.

## Database Configuration

The default database connection is defined in `includes/conn.php`:

```php
$conn = mysqli_connect("localhost", "root", "", "jobportal");
```

If your MySQL username or password differs, update `includes/conn.php` accordingly.

## Admin Credentials

- Username: `adminsabbir@gmail.com`
- Password: `admin5678`

## Optional Setup

- `tcpdf` library is required for PDF report generation in the admin report section.
- If the `tcpdf` folder is missing, download and place it in the project root or follow the library setup instructions.

## Notes

- The app is configured for local development and localhost deployment.
- If you rename the project folder, update the browser URL path accordingly.

## License

This project is licensed under the MIT License. See [LICENSE](LICENSE) for details.

## Contact

For questions or support, contact Sanaya Yadav.
