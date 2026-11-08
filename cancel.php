<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if a booking code was passed in the URL
if (isset($_GET['booking_code'])) {
    
    $booking_code = mysqli_real_escape_string($conn, $_GET['booking_code']);
    $user_id = (int)$_SESSION['user_id'];

    // Find the booking FIRST to get the event_id and ticket_quantity
    // We must do this before deleting it, otherwise we won't know how many seats to restore!
    $find_query = "SELECT event_id, ticket_quantity FROM bookings 
                   WHERE booking_code = '$booking_code' AND user_id = $user_id";
    $find_result = mysqli_query($conn, $find_query);

    if (mysqli_num_rows($find_result) > 0) {
        $booking_data = mysqli_fetch_assoc($find_result);
        $event_id = (int)$booking_data['event_id'];
        $returned_seats = (int)$booking_data['ticket_quantity'];

        // Delete the booking from the database securely
        $delete_query = "DELETE FROM bookings WHERE booking_code = '$booking_code' AND user_id = $user_id";
        
        if (mysqli_query($conn, $delete_query)) {
            
            $restore_seats = "UPDATE events 
                              SET available_seats = available_seats + $returned_seats 
                              WHERE event_id = $event_id";
            mysqli_query($conn, $restore_seats);

            echo "<script>
                    alert('Registration successfully canceled. Tickets have been refunded.');
                    window.location.href = 'mybook.php';
                  </script>";
            exit();
            
        } else {
            echo "<script>
                    alert('Error canceling registration. Please try again.');
                    window.location.href = 'mybook.php';
                  </script>";
        }
    } else {
        // if someone types a random booking code in the URL
        echo "<script>
                alert('Invalid booking code or unauthorized access.');
                window.location.href = 'mybook.php';
              </script>";
    }
} else {
    // if they visit cancel.php without a booking code
    header("Location: mybook.php");
    exit();
}
?>