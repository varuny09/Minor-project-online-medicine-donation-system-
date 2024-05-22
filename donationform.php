
<?php

session_start();

// Check if the user is signed in
if (!isset($_SESSION['username'])) {
    // User is not signed in, display a pop-up
    echo "<script>alert('Please sign in to fill the donation form.');</script>";
    // Redirect the user to the login page
    header("Location: login_required.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "my_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve POST data
$donorName = $_POST['donor_name'];
$donorEmail = $_POST['donor_email'];
$medicineName = $_POST['medicine_name'];
$quantity = $_POST['quantity'];
$message = $_POST['message'];

// Insert data into the donations table
$sql = "INSERT INTO donations (donor_name, donor_email, medicine_name, quantity,  message) 
        VALUES ('$donorName', '$donorEmail', '$medicineName', $quantity,  '$message')";

if ($conn->query($sql) === TRUE) {
    $response = array('status' => 'success', 'message' => 'Donation received successfully');
    header('location: thankyou.html');
} else {
    $response = array('status' => 'error', 'message' => 'Error: ' . $sql . '<br>' . $conn->error);
}

// Close the connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);

?>
