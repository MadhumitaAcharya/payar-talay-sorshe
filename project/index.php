<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }

  // Database connection
  $db = mysqli_connect('localhost', 'root', '', 'project');

  // Fetch bookings for the logged-in user
  $username = $_SESSION['username'];
  $query = "SELECT * FROM bookings WHERE username='$username'";
  $result = mysqli_query($db, $query);

  // Delete booking if the 'delete' parameter is passed
  if (isset($_GET['delete'])) {
    $booking_id = $_GET['delete'];

    // Ensure it's a valid ID
    if (is_numeric($booking_id)) {
      $delete_query = "DELETE FROM bookings WHERE id='$booking_id' AND username='$username'";
      if (mysqli_query($db, $delete_query)) {
        // Redirect after successful deletion
        header("Location: index.php"); // Redirect to index.php
        exit();
      } else {
        echo "Error deleting booking: " . mysqli_error($db);
      }
    } else {
      echo "Invalid booking ID.";
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 30px;
        }

        .content {
            max-width: 1000px;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .content a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }

        .content a:hover {
            color: #ff6347;
        }

        .error.success {
            background-color: #28a745;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .table-container {
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .no-bookings {
            font-size: 18px;
            color: #555;
        }

        .goback-button {
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            display: inline-block;
            margin: 20px 0;
            transition: background-color 0.3s ease;
        }

        .goback-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>Home Page</h2>
</div>

<div class="content">
    <!-- Notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success">
        <h3>
            <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
            ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- Logged in user information -->
    <?php if (isset($_SESSION['username'])) : ?>
        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
        <p><a href="index.php?logout='1'" style="color: red;">Logout</a></p>
    <?php endif ?>

    <!-- Booking list -->
    <h3>Your Bookings:</h3>
    <div class="table-container">
        <?php if (mysqli_num_rows($result) > 0) : ?>
            <table>
                <tr>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Room Type</th>
                    <th>Number of Guests</th>
                    <th>Actions</th>
                </tr>
                <?php while ($booking = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $booking['check_in_date']; ?></td>
                        <td><?php echo $booking['check_out_date']; ?></td>
                        <td><?php echo $booking['room_type']; ?></td>
                        <td><?php echo $booking['guests']; ?></td>
                        <td>
                            <!-- Delete booking button -->
                            <a href="index.php?delete=<?php echo $booking['id']; ?>" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p class="no-bookings">No bookings found.</p>
        <?php endif; ?>
    </div>

    <!-- Go to Home button -->
    <a href="http://localhost/project/Hotel_2.0/index.html" class="goback-button">Go to Home Page</a>

</div>

</body>
</html>
