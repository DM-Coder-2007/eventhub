# EventHub: Event Management System

A dynamic, full-stack web application built with PHP and MySQL that allows users to discover upcoming events, book tickets, and manage their reservations. It also features a secure administrative dashboard for organizers to publish new events and track real-time ticketing analytics.

## 🚀 Key Features

**User Experience:**
* **Secure Authentication:** Complete registration and login system with session management.
* **Event Catalog:** Browse upcoming events with details on pricing, location, and seat availability.
* **Smart Ticketing Dashboard:** A dynamic user portal that tracks active bookings, automatically locks past events with a "Completed" badge, and enforces a strict 24-hour cancellation window for upcoming events.
* **Automated Email Confirmations:** Integrated PHPMailer sends secure, HTML-formatted ticket receipts upon successful booking.

**Admin Portal:**
* **Real-Time Analytics:** Tracks total published events, total registered attendees, and gross ticket revenue.
* **Event Publication System:** A seamless form to publish new events directly to the public catalog, supporting categories, dates, times, total seat capacities, and thumbnail image URLs.

## 🛠️ Tech Stack
* **Frontend:** HTML5, CSS3, JavaScript
* **Backend:** PHP
* **Database:** MySQL
* **Integrations:** PHPMailer (SMTP Email Automation)

## ⚙️ Setup & Installation
1. Clone the repository: `git clone https://github.com/yourusername/event-management-system.git`
2. Import the database schema from the `sql` folder into your local MySQL server (e.g., via phpMyAdmin).
3. Create a `config/db.php` file and add your local database credentials. *(Note: This file is ignored by Git for security).*
4. Update the PHPMailer SMTP credentials in `processbook.php` with your own App Password.
5. Run the project on a local server environment like XAMPP or MAMP.
