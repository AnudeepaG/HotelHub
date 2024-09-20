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
    $sql = "INSERT INTO gym(name, email, date, time) VALUES ('$name', '$email', '$date', '$time')";

    if ($conn->query($sql) === TRUE) {
        // Display confirmation message
        echo "<script>alert('Gym session booked successfully!');</script>";
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
    <title>Book Gym</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: url('images/gym.jpg') no-repeat center center fixed; /* Gym image as background */
            background-size: cover; /* Cover the whole page */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative; /* For positioning overlay */
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
            z-index: 1; /* To ensure overlay is on top */
        }

        .container {
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            position: relative; /* For proper stacking context */
            z-index: 2; /* To ensure container is above the overlay */
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #34495e; /* Dark Gray */
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
            color: #2c3e50; /* Dark Blue */
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="time"],
        input[type="submit"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background for inputs */
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #3498db; /* Blue */
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #2980b9; /* Darker Blue */
        }
    </style>
</head>
<body>
    <div class="overlay"></div> <!-- Overlay for transparency -->
    <div class="container">
        <h1>Book Gym</h1>
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
