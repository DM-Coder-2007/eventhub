<?php
session_start();

//  IMPORT PHPMAILER CLASSES
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


include("config/db.php");

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['book_ticket'])){
    
    if(!isset($_SESSION['user_id'])){
        header("Location:first.php");
        exit();
    }
    
    // Generate a random booking code
    $booking_code = "BKG-" . strtoupper(substr(uniqid(), -5));
    $user_id = (int)$_SESSION['user_id'];
    $event_id = (int)$_POST['event_id'];
    $ticket_quantity = (int)$_POST['ticket_quantity'];
    $total_amount = (float)$_POST['total_amount'];


    $seats_query="SELECT available_seats FROM events WHERE event_id=$event_id";
    $seats_number=mysqli_query($conn,$seats_query);
    if($seats_number==0){
        echo "<script>alert('Seat limit full!')</script>";
        exit();
    }
    if($seats_number<$ticket_quantity){
        echo "<script>alert('Seat limit full!')</script>";
        exit();
    }

    
    $query = "INSERT INTO bookings(booking_code, user_id, event_id, ticket_quantity, total_amount) 
              VALUES ('$booking_code', $user_id, $event_id, $ticket_quantity, $total_amount)";
              
    if(mysqli_query($conn, $query)){
        
        // Deduct the purchased seats
        $update_seats = "UPDATE events 
                         SET available_seats = available_seats - $ticket_quantity 
                         WHERE event_id = $event_id " ;
        mysqli_query($conn, $update_seats);

        //MAIL CREATION AND SENDING
        $user_query="SELECT email,full_name FROM users WHERE user_id=$user_id";
        $user_result=mysqli_query($conn,$user_query);
        if($user_result && mysqli_num_rows($user_result)>0){
            $user_data=mysqli_fetch_assoc($user_result);
            $send_mail=$user_data['email'];
            $send_name=$user_data['full_name'];

            $mail=new PHPMailer(true);

            try{
                // SMTP Server Settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; 
                $mail->SMTPAuth   = true;
                
                $mail->Username   = ''; //UPDATE THIS
                $mail->Password   = 'YOUR_16_CHAR_APP_PASSWORD'; //UPDATE THIS
                
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Sender and Recipient
                $mail->setFrom('', 'EventHub Tickets'); // UPDATE THIS
                $mail->addAddress($send_mail, $send_name);

                // Email HTML Content
                $mail->isHTML(true);
                $mail->Subject = "Ticket Confirmed: $booking_code";
                $mail->Body    = "
                <div style='font-family: Arial, sans-serif; background-color: #070718; padding: 20px; color: #ffffff; border-radius: 10px;'>
                    <h2 style='color: #818cf8;'>EventHub Booking Confirmed! 🎉</h2>
                    <p>Hi $send_name,</p>
                    <p>Your tickets have been successfully booked. Please keep this code handy:</p>
                    <div style='background-color: #0f172b; padding: 15px; border-radius: 8px; border: 1px solid #232a3b; margin: 20px 0;'>
                        <p style='margin: 5px 0; color: #818cf8;'><strong>Booking Code:</strong> <span style='color: white; font-size: 18px;'>$booking_code</span></p>
                        <p style='margin: 5px 0; color: #818cf8;'><strong>Tickets:</strong> <span style='color: white;'>$ticket_quantity</span></p>
                        <p style='margin: 5px 0; color: #818cf8;'><strong>Total Paid:</strong> <span style='color: white;'>Rs. $total_amount</span></p>
                    </div>
                    <p>See you at the event!</p>
                </div>";

                $mail->send();
            }
            catch(Exception $e){
                // Fails if email doesn't send
                error_log("Email failed: {$mail->ErrorInfo}");
            }
        }

        echo "<script>
                alert('Booking Successful!');
                window.location.href='mybook.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Booking Failed: " . mysqli_error($conn) . "');
                window.history.back();
              </script>";
    }
}
?>