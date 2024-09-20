<?php
// Database connection
$servername = "localhost";
$username = "root";
$dbname = "hotel_booking";

$conn = new mysqli($servername, $username, null, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Insert data into database
    $sql = "INSERT INTO spa(name, email, date, time) VALUES ('$name', '$email', '$date', '$time')";

    if ($conn->query($sql) === TRUE) {
        // Display confirmation message
        echo "<script>alert('Spa session booked successfully!');</script>";
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
    <title>Book Spa</title>
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #4A90E2, #D1C4E9); /* New gradient */
            --container-bg: rgba(255, 255, 255, 0.95); /* Light background */
            --primary-color: #6A1B9A; /* Purple */
            --secondary-color: #FFC107; /* Yellow */
            --button-bg: #2196F3; /* Blue */
            --button-hover-bg: #1976D2; /* Dark Blue */
            --text-color: #333; /* Darker text color */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            height: 100vh; /* Full viewport height */
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-gradient);
            color: var(--text-color);
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
            z-index: -1; /* Send video behind content */
            transform: translate(-50%, -50%);
            object-fit: cover; /* Cover the entire viewport */
        }

        .container {
            width: 100%;
            max-width: 350px; /* Smaller box */
            background-color: var(--container-bg); /* Updated background */
            padding: 30px;
            border-radius: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2); /* Softer shadow */
            text-align: center;
            position: relative;
            z-index: 1; /* Ensure the container is above the video */
        }

        h1 {
            color: var(--primary-color); /* Updated color */
            font-size: 24px;
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            color: var(--secondary-color); /* Updated color */
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="time"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: none;
            border-radius: 10px;
            background-color: #f2f2f2;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: var(--button-bg); /* Updated button color */
            color: #fff;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: var(--button-hover-bg); /* Updated hover color */
            transform: scale(1.05); /* Slight scaling effect */
        }

        input[type="submit"]:active {
            transform: scale(0.95); /* Slight scaling effect when active */
        }
    </style>
</head>
<body>
    <video autoplay muted loop>
        <source src="videos/hotel1.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="container">
        <h1>Book Spa</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required>

            <input type="submit" name="submit" value="Book Now">
        </form>
    </div>
</body>
</html>
