<?php
session_start(); // Start the session

$message = ""; // Initialize message variable

// Check if the booking details are set in the session for cancellation
if (isset($_SESSION['booking'])) {
    // Unset or remove the booking details from the session
    unset($_SESSION['booking']);
    $message = "Booking has been cancelled successfully.";
} else {
    $message = "No booking found to cancel.";
}

// Database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_booking";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $room_name = $_POST['room_name'];
    $guest_name = $_POST['guest_name'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $total_nights = $_POST['total_nights'];
    $total_price = $_POST['total_price'];

    // Store booking details in session
    $_SESSION['booking'] = [
        'room_name' => $room_name,
        'guest_name' => $guest_name,
        'check_in_date' => $check_in_date,
        'check_out_date' => $check_out_date,
        'total_nights' => $total_nights,
        'total_price' => $total_price
    ];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert booking details into the database
    $sql = "INSERT INTO rooms (room_name, guest_name, check_in_date, check_out_date, total_nights, total_price)
            VALUES ('$room_name', '$guest_name', '$check_in_date', '$check_out_date', '$total_nights', '$total_price')";

    if ($conn->query($sql) === TRUE) {
        $message = "Booking saved successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking</title>
    <style>
        body {
    margin: 0;
    font-family: Arial, sans-serif;
    color: white;
    overflow: hidden; /* Prevent scrolling */
    display: flex; /* Use flexbox to center the container */
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    height: 100vh; /* Full height of the viewport */
}

.video-background {
    position: fixed;
    top: 0;
    left: 0;
    min-width: 100%;
    min-height: 100%;
    z-index: -1;
    opacity: 0.7; /* Slightly transparent video */
}

.container {
    background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black box */
    max-width: 400px;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    position: relative; /* Position relative to allow z-index stacking */
    z-index: 1; /* Bring the container above the video */
}

h1 {
    color: goldenrod;
}

p {
    margin-bottom: 20px;
}

a {
    color: goldenrod;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <video autoplay loop muted class="video-background">
        <source src="videos/rooms video.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="container">
        <h1>Cancel Booking</h1>
        <p><?php echo $message; ?></p>
    </div>
</body>
</html>
