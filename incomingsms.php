<?php
// Include necessary files for database connection and menu handling
include_once 'menu.php';
include_once "config.php";
include_once 'util.php';
//https://d55f-197-243-106-90.ngrok-free.app/iwacu/incomingsms.php
// Create a database connection instance
$c = new My_connection();
$conn = $c->open();

// Function to check if the phone number is not registered
function isNotRegistered($phoneNumber) {
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE phonenumber = ?");
    $stmt->execute([$phoneNumber]);
    $count = $stmt->fetchColumn();
    return $count == 0; 
}

// Retrieve data from the incoming SMS POST request
$phoneNumber = $_POST['from'];
$text = $_POST['text']; 

// Split the text of the SMS into an array
$textArray = explode(" ", $text);

// Check if the required data (name, address, password) is provided in the SMS
if(isset($textArray[0]) && isset($textArray[1]) && isset($textArray[2])) {
    $username = $textArray[0];
    $address = $textArray[1];
    $passwordofuser = $textArray[2];

    // Create a new database connection instance
    $c = new My_connection();
    $conn = $c->open();

    // Check if the phone number is not already registered
    if(isNotRegistered($phoneNumber)) {
        // If not registered, insert the user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, address, phonenumber, passwordofuser) VALUES (:username, :address, :phonenumber, :passwordofuser)");
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':phonenumber', $phoneNumber);
        $stmt->bindValue(':passwordofuser', $passwordofuser);

        // Execute the SQL statement to register the user
        if ($stmt->execute()) {
            // If registration is successful, fetch user details and provide confirmation
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($result as $value) {
                echo "END Thank you $username, you have been successfully registered!";
            }
        } else {
            echo "END Registration failed. Please try again later.";
        }
    } else {
        echo "END User is already registered.";
    }
} else {
    // If name or password is missing in the SMS, prompt the user to provide both
    echo "END Your SMS must contain name, address, and password.";
}
?>
