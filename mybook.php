<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location:first.php");
    exit();
}

$user_id = (int) $_SESSION['user_id'];

$query = "SELECT bookings.*, events.title, events.event_date 
          FROM bookings 
          JOIN events ON bookings.event_id = events.event_id 
          WHERE bookings.user_id = $user_id 
          ORDER BY bookings.booking_date DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo mysqli_error($conn);
    exit();
}
$total_bookings = mysqli_num_rows($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Bookings</title>
    <link rel="stylesheet" href="css/mybook.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav id="navm">
        <div class="calendar-icon-wrapperm">
            <!-- Calendar SVG -->
            <svg class="calendar-svgm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
        </div>
        <h3 id="hnem">EventHub</h3>
        <h3 id="hn1m" onclick="window.location.href='index.php'">Home</h3>
        <h3 id="hn2m" onclick="window.location.href='eventcat.php'">Event Catalog</h3>
        <h3 id="hn3m" onclick="window.location.href='eventbook.php'">Event Booking</h3>
        <h3 id="hn5m" class="text-gradient1" onclick="window.location.href='mybook.php'">My bookings</h3>
        <h3 id="hn4m" onclick="window.location.href='index.php'">Contact Us</h3>
    </nav>

    <!-- Page 1 -->
    <div id="pg1">
        <div id="topm">
            <div id="dat1m">
                <h4 id="hav1m">MANAGE YOUR BOOKINGS</h4>
            </div>
            <h1 id="hat1m">My Ticket Pass Dashboard</h1>
            <h3 id="hat2m">Browse, filter, and discover upcoming live experiences in real-time</h3>

            <button id="book-event-btn" onclick="window.location.href='eventcat.php'">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path
                        d="M4 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v4a2 2 0 0 0 0 4v4a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-4a2 2 0 0 0 0-4V5z">
                    </path>
                    <line x1="12" y1="8" x2="12" y2="16" stroke-dasharray="3 4"></line>
                </svg>
                Book New Event
            </button>

            <button id="logout-btn"
                onclick="if(confirm('Are you sure, you want to logout?')){window.location.href='logout.php'}">
                <i class="fa-solid fa-power-off"></i> Logout
            </button>
        </div>
    </div>

    <!-- Page 2 -->
    <div id="pg2">
        <h2 id="h2m">Active Ticket Bookings Of <?php echo $_SESSION['username'] ?> (<span
                id="spm1"><?php echo $total_bookings; ?></span>)</h2>
        <div id="lm1">

            <?php
            if ($total_bookings > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    $b_code = htmlspecialchars($row['booking_code']);
                    $e_title = htmlspecialchars($row['title']);
                    $e_date = date("F j, Y", strtotime($row['event_date']));
                    $tickets = htmlspecialchars($row['ticket_quantity']);
                    $amount = htmlspecialchars($row['total_amount']);
                    $purchase_date = date("M j, Y", strtotime($row['booking_date']));

                    // TIME COMPARISON LOGIC
                    $current_date = strtotime(date('Y-m-d')); // Today's date in seconds
                    $event_date_stamp = strtotime($row['event_date']); // Event date in seconds
            
                    if ($event_date_stamp < $current_date) {
                        // If the event is in the past, show a "Completed" text badge
                        $action_html = "<span style='color: #10b981; font-size: 16px; font-weight: 600; padding: 10px 0; display: inline-block;'><i class='fa-solid fa-circle-check'></i> Completed</span>";
                    } else {
                        // If the event is in the future, show Cancel button
                        $hours = ($event_date_stamp - $current_date) / 3600;
                        if ($hours < 24) {
                            $action_html = "<button class='cancel-btn' onclick=\"alert('Bookings can only be cancelled 24 hrs before the event timings!')\">
                                            <i class='fa-solid fa-xmark'></i> Cancel
                                        </button>";
                        } else {
                            $action_html = "<button class='cancel-btn' onclick=\"if(confirm('Are you sure you want to cancel this registration?')) { window.location.href='cancel.php?booking_code=$b_code'; }\">
                                            <i class='fa-solid fa-xmark'></i> Cancel
                                        </button>";
                        }
                    }

                    // ticket UI
                    echo "
                    <div class='premium-ticket'>
                        <div class='ticket-left'>
                            <div class='ticket-header'>
                                <span class='event-title'>$e_title</span>
                                <span class='event-date'><i class='fa-regular fa-calendar'></i> $e_date</span>
                            </div>
                            <div class='ticket-body'>
                                <div class='ticket-detail'>
                                    <span class='detail-label'>Tickets</span>
                                    <span class='detail-value'><i class='fa-solid fa-ticket'></i> $tickets</span>
                                </div>
                                <div class='ticket-detail'>
                                    <span class='detail-label'>Total Paid</span>
                                    <span class='detail-value'>Rs. $amount</span>
                                </div>
                                <div class='ticket-detail'>
                                    <span class='detail-label'>Purchased On</span>
                                    <span class='detail-value'>$purchase_date</span>
                                </div>
                            </div>
                        </div>

                        <!-- The Perforated Divider Line -->
                        <div class='ticket-divider'></div>

                        <div class='ticket-right'>
                            <div class='booking-code-box'>
                                <span class='code-label'>Booking Code</span>
                                <span class='code-value'>$b_code</span>
                            </div>
                            
                            <!-- dynamic action area -->
                            $action_html
                            
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "<p style='color: #94a3b8; margin-top: 20px; font-size: 16px;'>No active bookings found. Book an event to see it appear here!</p>";
            }
            ?>

        </div>
        <div id="diiv" style="height:100px; width:100%"></div>
    </div>
</body>

</html>