<?php
include_once("config.php");
class Util{
    // About static variables
    static $GO_BACK = "98";
    static $GO_TO_MAIN_MENU = "99";

    // Method to handle going back
    static function goBack() {
        return Util::$GO_BACK;
    }

    // Method to handle going to the main menu
    static function goToMainMenu() {
        return Util::$GO_TO_MAIN_MENU;
    }


// Function to check if a user is registered





}
// function to chech whether the  phonenumber is exits

function isRegistered($phonenumber) {
    // Database connection parameters
   $sc=new My_connection();
   $conn=$sc->open();
    
    try {
        // Create a new PDO instance
        $sc=new My_connection();
        $conn=$sc->open();
        
        // Prepare a SQL statement to query the users table
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE phonenumber = :phonenumber");
        
        // Bind the phone number parameter
        $stmt->bindParam(':phonenumber', $phonenumber);
        
        // Execute the query
        $stmt->execute();
        
        // Fetch the result
        $count = $stmt->fetchColumn();
        
        return $count > 0;
    } catch(PDOException $e) {
       
        error_log("Database Error: " . $e->getMessage());
        return false;
    }
    
}
?>
