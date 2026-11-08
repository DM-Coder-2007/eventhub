<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../first.php");
    exit();
}

if (isset($_POST['submit'])) {
    
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category_id = (int)$_POST['category']; // Grabs the 1, 2, 3, 4, 5 from your select options according to the ones in categories table
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $price = (float)$_POST['price'];
    $total_seats = (int)$_POST['seats'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $event_time = mysqli_real_escape_string($conn, $_POST['event_time']);
    $image_url = mysqli_real_escape_string($conn, $_POST['image_url']);
    
    $available_seats = $total_seats;

    // Insert into the events table
    $insert_query = "INSERT INTO events 
                    (title, category_id, venue, location, ticket_price, total_seats, available_seats, event_date, event_time, description, image_url) 
                    VALUES 
                    ('$title', $category_id, '$venue', '$location', $price, $total_seats, $available_seats, '$event_date', '$event_time', '$description', '$image_url')";

    if (mysqli_query($conn, $insert_query)) {
        echo "<script>
                alert('Event published successfully!');
                window.location.href = 'admin.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Database Error: " . mysqli_error($conn) . "');
                window.location.href = 'admin.php';
              </script>";
        exit();
    }
} else {
    header("Location: admin.php");
    exit();
}
?>