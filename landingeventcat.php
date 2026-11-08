<?php
include("config/db.php");

//  Fetch Categories for the sidebar
$cat_query = "SELECT * FROM categories";
$cat_result = mysqli_query($conn, $cat_query);

// Fetch Events for the cards
$event_query = "SELECT events.*, categories.category_name, categories.slug 
                FROM events 
                LEFT JOIN categories ON events.category_id = categories.category_id 
                WHERE events.status = 'upcoming' 
                ORDER BY events.event_date ASC";
$event_result = mysqli_query($conn, $event_query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="css/landingeventcat.css?v=3">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <nav id="event-nav">
        <div class="calendar-icon-wrapper">
            <!-- Calendar SVG -->
            <svg class="calendar-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
        </div>
        <h3 id="hene">EventHub</h3>
        <h3 id="hen1" onclick="window.location.href='first.php'">Home</h3>
        <h3 id="hen2" class="text-gradient2" onclick="window.location.href='landingeventcat.php'">Event Catalog</h3>
        <h3 id="hen3" onclick="alert('Login to book events!');window.location.href='login.php'">Event Booking</h3>
        <h3 id="hen5" onclick="alert('Login to see bookings!');window.location.href='login.php'">My bookings</h3>
        <button id="logsign" name="logsign" onclick="window.location.href='login.php'">Login <span id="logs" style="position:relative;left:2px;font-weight:600">&#8594;</span></button>
    </nav>
    <div id="top-page">
        <div id="dt1">
            <h4 id="hev1">EVENT MANAGEMENT</h4>
        </div>
        <h1 id="ht1">Event Discovery Catalog</h1>
        <h3 id="ht2">Browse, filter, and discover upcoming live experiences in real-time</h3>
    </div>
    
    <div id="div-center">
        <!-- Sidebar -->
        <div id="left">
            <h2 id="hl1"><i class="fa-solid fa-filter" style="color:oklch(67.3% 0.182 276.935)"></i> Filter Events</h2>
            <div id="dl1"></div>
            <h3 id="hl2">Category</h3>
            
            <!-- Pass 'all'  -->
            <h3 class="filter-tag" onclick="filterEvents(event, 'all')"><i class="fa-solid fa-tag"></i> All</h3>
            
            <?php
            if (mysqli_num_rows($cat_result) > 0) {
                while ($cat = mysqli_fetch_assoc($cat_result)) {
                    $cat_name = htmlspecialchars($cat['category_name']);
                    $slug = htmlspecialchars($cat['slug']);
                    
                    // Pass the dynamic $slug to our new JavaScript function
                    echo "<h3 class='filter-tag' onclick=\"filterEvents(event, '$slug')\"><i class='fa-solid fa-tag'></i> $cat_name</h3>";
                }
            }
            ?>
        </div>

        <!-- Responsive Cards -->
        <div id="right">
            <?php
            if (mysqli_num_rows($event_result) > 0) {
                while ($event = mysqli_fetch_assoc($event_result)) {
                    
                    $id = $event['event_id'];
                    $title = htmlspecialchars($event['title']);
                    $venue = htmlspecialchars($event['venue']);
                    $date = date("F j, Y", strtotime($event['event_date']));
                    $price = htmlspecialchars($event['ticket_price']);
                    $seats = htmlspecialchars($event['available_seats']);
                    $slug = htmlspecialchars($event['slug']); 
                    $cat_name = htmlspecialchars($event['category_name']);
                    $image = htmlspecialchars($event['image_url']); // Pull image from the DB
                    $url_title = urlencode($title);

                    echo "
                    <div class='dynamic-card $slug'>
                        <!-- Injecting the database image directly here -->
                        <div class='card-img' style='background-image: url($image);'></div>
                        
                        <div class='card-info'>
                            <h3 class='card-cat-date'><span>$cat_name </span> • $date</h3>
                            <h2 class='card-title'>$title</h2>
                            <h2 class='card-venue'>$venue</h2>
                        </div>
                        
                        <div class='card-pricing'>
                            <h2 class='card-price'>Rs.$price</h2>
                            <h3 class='card-seats'>$seats seats<br/> left</h3>
                        </div>
                        
                        <button class='card-btn' onclick=\"alert('Login to Book Events!');window.location.href='login.php'\">Book</button>
                    </div>
                    ";
                }
            } else {
                echo "<h2 style='color: white;'>No upcoming events found.</h2>";
            }
            ?>
        </div>
    </div>
    
    <div id="space"></div>

    <!-- <script src="js/eventcat.js"></script> -->
</body>
</html>