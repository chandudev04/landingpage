<?php
// Retrieve data from the form
$cname = $_POST['cname'];
$bname = $_POST['bname'];
$bemail = $_POST['bemail'];
$industry = $_POST['industry'];
// database connection
$conn = new mysqli('localhost', 'root', 'root', 'clients');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die('Connection failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO info(cname, bname, bemail, industry) VALUES (?, ?, ?, ?)");

    // Check if the prepare statement was successful
    if ($stmt) {
        $stmt->bind_param("ssss", $cname, $bname, $bemail, $industry);
        $execval = $stmt->execute();

        if ($execval) {
            // echo "Registration successfully...";
            header("Location: thankyou.html");
        } else {
            echo "Error during registration: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Prepare statement failed: " . $conn->error;
    }

    // Start the session
    $conn->close();
}
?>