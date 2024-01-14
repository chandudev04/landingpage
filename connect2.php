<?php
// Retrieve data from the form
$onlyNum = $_POST['onlyNum'];

// database connection
$conn = new mysqli('localhost', 'root', 'root', 'clients');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die('Connection failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO info2(onlyNum) VALUES (?)");

    // Check if the prepare statement was successful
    if ($stmt) {
        $stmt->bind_param("s",$onlyNum);
        $execval = $stmt->execute();

        if ($execval) {
            echo "Registration successfully...";
            // header("Location: index.html");
            if (strpos($_SERVER['HTTP_REFERER'], 'openModal=true') === false) {
                // If not present, add the parameter
                $redirectURL = $_SERVER['HTTP_REFERER'] . (strpos($_SERVER['HTTP_REFERER'], '?') !== false ? '&' : '?') . 'openModal=true';
            } else {
                // If already present, use the original URL
                $redirectURL = $_SERVER['HTTP_REFERER'];
            }
            
            // Redirect to the modified URL
            header("Location: " . $redirectURL);
        } else {
            echo "Error during registration: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Prepare statement failed: " . $conn->error;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $onlyNum = $_POST["onlyNum"];
    
      // Perform server-side validation
      if (isValidMobileNumber($onlyNum)) {
        // Mobile number is valid, proceed with login logic
        echo "Login successful!";
      } else {
        // Invalid mobile number, handle accordingly
        echo "Invalid mobile number!";
      }
    }
    
    function isValidMobileNumber($onlyNum) {
      // Implement your server-side validation logic here
      // For example, you could check if $mobileNumber is a valid 10-digit number
      return preg_match("/^[0-9]{10}$/", $onlyNum);
    }

    $conn->close();
}
?>



