<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Add your root password if any
$dbname = "hotel_booking";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $date = $conn->real_escape_string($_POST['date']);
    $time = $conn->real_escape_string($_POST['time']);

    // Insert data into database
    $sql = "INSERT INTO tourist(name, email, date, time) VALUES ('$name', '$email', '$date', '$time')";

    if ($conn->query($sql) === TRUE) {
        // Display confirmation message
        echo "<script>alert('Tour session booked successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tours</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background: linear-gradient(135deg, #ffd1dc, #ffecb3); /* Soft pastel gradient */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        video {
            position: fixed;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1;
            transform: translate(-50%, -50%);
            object-fit: contain;
        }

        .container {
            max-width: 320px;
            width: 100%;
            background-color: #fff0f5; /* Light pink */
            padding: 30px;
            border-radius: 25px;
            border: 2px solid #ffd1dc; /* Soft pink border */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
            text-align: center;
        }

        h1 {
            color: #ff6f91; /* Soft pink */
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #ff85a1; /* Slightly darker pink */
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="time"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ffb3c1;
            border-radius: 12px;
            background-color: #fff7f8; /* Lightest pink */
            font-size: 14px;
            color: #333;
            text-align: center;
        }

        input[type="submit"] {
            background-color: #ff85a1; /* Pink */
            color: #fff;
            cursor: pointer;
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            transition: background-color 0.3s ease;
            font-size: 14px;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #ff6f91; /* Darker pink */
        }

        input[type="submit"]:active {
            background-color: #ff4d6d; /* Even darker pink on click */
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus,
        input[type="time"]:focus {
            outline: none;
            border-color: #ff85a1;
        }

        input::placeholder {
            color: #ffb3c1; /* Lighter pink placeholder */
        }

    </style>
</head>
<body>
    <video autoplay muted loop>
        <source src="videos/nature.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="container">
        <h1>Book Tours</h1>
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required>

            <input type="submit" name="submit" value="Book Now">
        </form>
    </div>
</body>
</html>
