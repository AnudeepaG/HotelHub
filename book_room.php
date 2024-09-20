<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Room</title>
  <style>
    body {
      background-color: #1a1a2e; /* Dark background */
      color: #e0e0e0; /* Light text color */
      font-family: 'Arial', sans-serif;
      transition: background-color 0.5s ease;
    }

    h1, h2 {
      color: #ff6f61; /* Coral color for headings */
    }

    input[type="text"],
    input[type="date"],
    input[type="number"],
    button {
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ff6f61; /* Coral border */
      border-radius: 5px;
      background-color: #162447; /* Darker input background */
      color: #ff6f61; /* Coral text color */
      transition: border-color 0.3s, background-color 0.3s;
    }

    input[type="text"]:focus,
    input[type="date"]:focus,
    input[type="number"]:focus {
      border-color: #ff6f61; /* Highlight border on focus */
      background-color: #1f4068; /* Lighter input background */
    }

    button {
      cursor: pointer;
    }

    button:hover {
      background-color: #ff6f61; /* Coral background on hover */
      color: #1a1a2e; /* Dark background for button text */
      transition: background-color 0.3s, color 0.3s;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    .container {
      position: relative;
      padding: 20px;
      border-radius: 10px;
      margin-top: 50px;
      background-color: rgba(22, 36, 71, 0.9); /* Semi-transparent background */
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); /* Shadow for depth */
    }

    video {
      position: fixed;
      top: 0;
      left: 0;
      min-width: 100%;
      min-height: 100%;
      z-index: -1;
      opacity: 0.6; /* Slightly transparent video */
    }

    .button {
      background-color: #4CAF50; /* Green background */
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin-top: 20px;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .button:hover {
      background-color: #45a049; /* Darker green on hover */
    }
  </style>
</head>
<body>
  <div class="container">
    <video autoplay loop muted>
      <source src="videos/interior.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <h1>Book Room</h1>
    <?php
    session_start(); // Start the session

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

        // Redirect to confirmation page
        header("Location: confirm_booking.php");
        exit;
    }

    // Retrieve room and price from parameters
    $room_name = isset($_GET['room']) ? $_GET['room'] : ''; // Check if 'room' key exists
    $total_price = isset($_GET['price']) ? $_GET['price'] : ''; // Check if 'price' key exists
    ?>
    <div>
      <h2><?php echo htmlspecialchars($room_name); ?></h2>
      <p>Price: $<?php echo htmlspecialchars($total_price); ?>/night</p>

      <form action="" method="post">
        <input type="hidden" name="room_name" value="<?php echo htmlspecialchars($room_name); ?>">
        <label for="guest_name">Guest Name:</label>
        <input type="text" id="guest_name" name="guest_name" required><br>
        <label for="check_in_date">Check-in Date:</label>
        <input type="date" id="check_in_date" name="check_in_date" required><br>
        <label for="check_out_date">Check-out Date:</label>
        <input type="date" id="check_out_date" name="check_out_date" required><br>
        <label for="total_nights">Total Nights:</label>
        <input type="number" id="total_nights" name="total_nights" min="1" required onchange="calculateTotalPrice()"><br>
        <input type="hidden" name="total_price" id="total_price" value="<?php echo htmlspecialchars($total_price); ?>">
        <button type="submit">Book Now</button>
      </form>
      <a href="cancel_booking.php" class="button">Cancel Booking</a>
    </div>

    <script>
      function calculateTotalPrice() {
        var totalNights = parseInt(document.getElementById('total_nights').value);
        var pricePerNight = <?php echo json_encode($total_price); ?>;
        var totalPrice = totalNights * pricePerNight;
        document.getElementById('total_price').value = totalPrice;
      }
    </script>

  </div>
</body>
</html>
