<!-- process.php -->
<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "clients";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect data from the form
$name = $_POST['name'];
$bnam = $_POST['bname'];
$bemail = $_POST['bemail'];
$industry = $_POST['industry'];

// Validate data if needed

// Insert data into the database
$sql = "INSERT INTO clientsDeatails (name, email) VALUES ('$name', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
