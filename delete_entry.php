<?php
$servername = "localhost";
$username = "root";
$password = "sandesh";
$database = "carrental";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
// Assuming you have a database connection established
// Include your database connection code here
// include_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if car_id is set
    if (isset($_POST["car_id"])) {
        // Sanitize and get the car_id
        $car_id = mysqli_real_escape_string($connection, $_POST["car_id"]);

        // Perform the delete operation
        $query = "DELETE FROM clientcars WHERE car_id = '$car_id'";
        $result = mysqli_query($connection, $query);
        $sql2 = "UPDATE cars SET car_availability = 'no' WHERE car_id = '$car_id'";
        $result2 = mysqli_query($connection, $sql2);
        if ($result) {
            echo "Entry deleted successfully!";
        } else {
            echo "Error deleting entry: " . mysqli_error($connection);
        }
    } else {
        echo "Invalid car_id";
    }
} else {
    echo "Invalid request method";
}

// Close your database connection
mysqli_close($connection);
?>
