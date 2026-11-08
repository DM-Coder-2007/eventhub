<?php
session_start();
include("config/db.php"); 
// If the user is not logged in, redirect them to the public landing page
if(!isset($_SESSION['user_id'])){
    header("Location: first.php");
    exit();
}

// Catch the event_id from the URL
if (isset($_GET['event_id'])) {
    $event_id = intval($_GET['event_id']);
    
    // Fetch the LIVE event data from the database
    $query = "SELECT title, ticket_price, available_seats FROM events WHERE event_id = $event_id";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $event = mysqli_fetch_assoc($result);
        $event_name = htmlspecialchars($event['title']);
        $ticket_price = intval($event['ticket_price']);
        $available_seats = intval($event['available_seats']);
    } else {
        // If someone types a fake ID in the URL, send them back
        echo "<script>alert('Event not found.'); window.location.href='eventcat.php';</script>";
        exit();
    }
} else {
    // If someone visits the page without clicking a button, send them back
    echo "<script>alert('Please select an event first.'); window.location.href='eventcat.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Event - <?php echo $event_name; ?></title>
    <link rel="stylesheet" href="css/eventbook.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

    <!-- Wrap the card in a form so it can submit to processbook.php -->
    <form action="processbook.php" method="POST" id="booking-form">
        
        <!-- HIDDEN INPUTS: These securely pass the data to your backend -->
        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
        <input type="hidden" name="ticket_quantity" id="hidden_ticket_quantity" value="1">
        <input type="hidden" name="total_amount" id="hidden_total_amount" value="<?php echo $ticket_price; ?>">

        <!-- Pass the base price and seats to JavaScript secretly -->
        <input type="hidden" id="js-base-price" value="<?php echo $ticket_price; ?>">
        <input type="hidden" id="js-available-seats" value="<?php echo $available_seats; ?>">

        <div class="ticket-card">
            
            <!-- Show the user what they are booking -->
            <!-- <h2 style="color: white; text-align: center; margin-bottom: 20px; font-weight: 500; font-family: sans-serif;">
                <?php echo $event_name; ?>
            </h2> -->

            <div class="card-header">
                <div class="price-info">
                    <span class="price-label">Ticket Price</span>
                    <!-- Inject PHP Price -->
                    <span class="price-value">Rs.<?php echo $ticket_price; ?></span>
                </div>
                <!-- Inject PHP Seats -->
                <div class="seats-badge"><span id="seats"><?php echo $available_seats; ?></span> Seats Available</div>
            </div>

            <div class="divider"></div>

            <div class="quantity-section">
                <span class="section-label">Select Quantity</span>
                <div class="quantity-controls">
                    <button type="button" id="minus" class="qty-btn" onclick="decr(event)">-</button>
                    <div class="qty-display"><span id="number">1 </span> Ticket(s)</div>
                    <button type="button" id="plus" class="qty-btn" onclick="incr(event)">+</button>
                </div>
            </div>

            <div class="summary-box">
                <div class="summary-row">
                    <span class="label">Subtotal (<span id="number1">1</span> x Rs.<?php echo $ticket_price; ?>)</span>
                    <span class="value" id="subtotal-val">Rs.<?php echo $ticket_price; ?></span>
                </div>
                <div class="summary-row">
                    <span class="label">Service Fee & Tax</span>
                    <span class="value free">FREE</span>
                </div>

                <div class="inner-divider"></div>

                <div class="summary-row total-row">
                    <span class="label">Total Amount:</span>
                    <span class="value">Rs. <span id="price"><?php echo $ticket_price; ?></span></span>
                </div>
            </div>

            <button type="submit" name="book_ticket" class="book-btn">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M15 5.25h1.5a2.25 2.25 0 012.25 2.25v2.062c0 .546.33 1.033.829 1.229l.17.067a1.5 1.5 0 010 2.796l-.17.067a1.353 1.353 0 00-.829 1.229v2.062a2.25 2.25 0 01-2.25 2.25H15M9 5.25H7.5a2.25 2.25 0 00-2.25 2.25v2.062c0 .546-.33 1.033-.829 1.229l-.17.067a1.5 1.5 0 000 2.796l.17.067c.498.196.829.683.829 1.229v2.062a2.25 2.25 0 002.25 2.25H9m-3-12h12m-12 12h12m-6-10.5v9">
                    </path>
                </svg>
                Book Ticket Now
            </button>

            <div class="card-footer">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z">
                    </path>
                </svg>
                <span>Instant ticket generation</span>
            </div>
        </div>
    </form>

    <script src="js/eventbook.js"></script>
</body>
</html>