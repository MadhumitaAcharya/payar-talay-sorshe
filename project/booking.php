<?php
// Start the session
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

// Process the booking form when submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'project');

    // Check the connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve form data
    $checkInDate = mysqli_real_escape_string($db, $_POST['check-in-date']);
    $checkOutDate = mysqli_real_escape_string($db, $_POST['check-out-date']);
    $roomType = mysqli_real_escape_string($db, $_POST['room-type']);
    $guests = (int)$_POST['guests'];
    $username = $_SESSION['username']; // Get the logged-in username

    // Check if there are any existing bookings for the same dates and room type
    $checkAvailabilityQuery = "
        SELECT * FROM bookings 
        WHERE room_type = '$roomType' 
        AND ('$checkInDate' BETWEEN check_in_date AND check_out_date
        OR '$checkOutDate' BETWEEN check_in_date AND check_out_date
        OR check_in_date BETWEEN '$checkInDate' AND '$checkOutDate')";
    
    $availabilityResult = mysqli_query($db, $checkAvailabilityQuery);

    if (mysqli_num_rows($availabilityResult) > 0) {
        // No available rooms
        $message = "No available rooms for the selected dates.";
        $button = "<a href='http://localhost/project/index.php' class='redirect-button'>Go to Home Page</a>";
    } else {
        // Insert the booking details into the database if available
        $query = "INSERT INTO bookings (check_in_date, check_out_date, room_type, guests, username) 
                  VALUES ('$checkInDate', '$checkOutDate', '$roomType', $guests, '$username')";

        if (mysqli_query($db, $query)) {
            $message = "Booking successful!";
            $button = "<a href='http://localhost/project/index.php' class='redirect-button'>Go to Profile</a>";
        } else {
            $message = "Error: " . mysqli_error($db);
            $button = "";
        }
    }

    // Close the database connection
    mysqli_close($db);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 50px;
        }
        
        .success-message {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            font-size: 18px;
        }

        .error-message {
            background-color: #f44336;
            color: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            font-size: 18px;
        }

        .redirect-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .redirect-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <?php if (isset($message)): ?>
        <div class="<?php echo (strpos($message, 'Error') === false) ? 'success-message' : 'error-message'; ?>">
            <?php echo $message; ?>
        </div>
        <?php echo $button; ?>
    <?php endif; ?>

</body>
</html>
