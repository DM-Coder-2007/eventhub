<?php
session_start();
include("../config/db.php");

// if (!isset($_SESSION['user_id'])) {
//     header("Location:../first.php");
//     exit();
// }

// Fetch Total Events
$events_query = "SELECT COUNT(*) AS total_events FROM events";
$events_result = mysqli_query($conn, $events_query);
$events_data = mysqli_fetch_assoc($events_result);
$total_events = $events_data['total_events'] ? $events_data['total_events'] : 0;

// Fetch Total Revenue & Total Attendees from the bookings table
$stats_query = "SELECT SUM(total_amount) AS total_revenue, SUM(ticket_quantity) AS total_attendees FROM bookings";
$stats_result = mysqli_query($conn, $stats_query);
$stats_data = mysqli_fetch_assoc($stats_result);

$total_revenue = $stats_data['total_revenue'] ? $stats_data['total_revenue'] : 0;
$total_attendees = $stats_data['total_attendees'] ? $stats_data['total_attendees'] : 0;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dash</title>
    <link rel="stylesheet" href="admin.css?v=<?php echo time(); ?>">
</head>

<body>
    <div id="top">
        <div id="dat1">
            <h4 id="hav1">ADMIN MANAGEMENT</h4>
        </div>
        <h1 id="hat1">Organizer Event Management Portal</h1>
        <h3 id="hat2">Browse, filter, and discover upcoming live experiences in real-time</h3>
    </div>


    <div id="da1">
        <div id="da2">
            <div id="da3">
                <div class="icon-container">
                    <!-- SVG used to draw the chart icon purely in HTML -->
                    <svg class="chart-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- L-Shaped Axis -->
                        <path d="M4 3V17C4 18.1046 4.89543 19 6 19H20" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <!-- Short left bar -->
                        <path d="M9 14V15" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <!-- Tall middle bar -->
                        <path d="M14 7V15" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <!-- Medium right bar -->
                        <path d="M19 10V15" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
            <h2 id="ha1">Total Events Published<br />
                <span id="spa1"><span id="change"><?php echo $total_events; ?></span> Events</span>
            </h2>
        </div>
        <div id="da2_1">
            <div id="da3">
                <div class="icon-container2">
                    <!-- SVG used to draw the dollar icon purely in HTML -->
                    <svg class="dollar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <!-- Vertical line -->
                        <line x1="12" y1="2" x2="12" y2="22"></line>
                        <!-- S-curve -->
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
            </div>
            <h2 id="ha1">Ticket Revenue Sales<br />
                <span id="spa1">Rs.<span id="change"><?php echo number_format($total_revenue, 2); ?></span></span>
            </h2>
        </div>
        <div id="da2_2">
            <div id="da3">
                <div class="icon-container3">
                    <!-- Pure SVG Users Icon -->
                    <svg class="users-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <!-- Left full user head -->
                        <circle cx="8" cy="9" r="4"></circle>
                        <!-- Right shadow user head (arc) -->
                        <path d="M16 5a4 4 0 0 1 0 8"></path>
                        <!-- Left full user body (U-shape) -->
                        <path d="M2 19c0-3.314 2.686-6 6-6s6 2.686 6 6H2z"></path>
                        <!-- Right shadow user body (arc segment) -->
                        <path d="M16 13c1.9 1 3 3.1 3 5a1 1 0 0 1-1 1H15"></path>
                    </svg>
                </div>
            </div>
            <h2 id="ha1">Total Registered Attendees<br />
                <span id="spa1"><span id="change"><?php echo number_format($total_attendees); ?></span> Attendees</span>
            </h2>
            </h2>
        </div>
    </div>


    <form action="create_event.php" id="create-event" method="post">
        <h2 id="hf1">
            <div class="circle-plus"></div>
            Create & Publish New Event
        </h2>
        <h4 id="hf2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, sit consequatur.</h4>
        <div id="df1"></div>
        <label for="" id="lf1"><span id="spf1">Event Title</span></label><br>
        <input name="title" type="text" id="inf1"><br />
        <label for="" id="lf2">Category</label><br>
        <select name="category" id="category">
            <option value="1">Technology</option>
            <option value="2">Music & Concerts</option>
            <option value="3">Design & Craft</option>
            <option value="4">Business</option>
            <option value="5">Food & Beverage</option>
        </select><br>
        <label for="" id="lf4">Venue Name</label><br>
        <input name="venue" type="text" id="inf3">
        <label for="" id="lf5">City/Location</label><br>
        <input name="location" type="text" id="inf4"><br>
        <label for="" id="lf6">Ticket Price($)</label><br>
        <input name="price" type="number" id="inf5">
        <label for="" id="lf7">Total Seats</label><br>
        <input name="seats" type="number" id="inf6"><br>
        <label for="" id="lf8">Event Description</label>
        <!-- New Date & Time Row -->
        <label for="" id="lf9">Event Date</label><br>
        <input name="event_date" type="date" id="inf7" required>
        <label for="" id="lf10">Event Time</label><br>
        <input name="event_time" type="time" id="inf8" required><br>

        <!-- New Full-Width Image Row -->
        <label for="" id="lf11">Event Thumbnail URL</label><br>
        <input name="image_url" type="text" id="inf9" placeholder="images/my_event_banner.jpg" required><br>
        <textarea name="description" name="" id="tf1"
            placeholder="Detail vent agenda, keynote speakers, and ticket benfits..."></textarea><br>
        <input name="submit" type="submit" id="subf" value="Simulate Publishing Event">
    </form>


    <script src="../js/admin.js"></script>
</body>

</html>