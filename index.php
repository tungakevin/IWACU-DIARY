<?php
//https://d55f-197-243-106-90.ngrok-free.app/iwacu/index.php
// Include necessary files for menu handling
include_once 'menu.php';
include_once "config.php";
include_once 'util.php';

// Retrieve data from the POST request
$sessionId = $_POST['sessionId'];
$phoneNumber = $_POST['phoneNumber'];
$serviceCode = $_POST['serviceCode'];
$text = $_POST['text'];

// Check if the phone number is registered
$isRegistered = isRegistered($phoneNumber);

// Create a new Menu instance to handle menu interactions
$menu = new Menu($text, $sessionId, $isRegistered);

// Determine the appropriate action based on user input
if ($text == "" && !$isRegistered) {
    // Display main menu for unregistered users if input is empty
    $menu->mainMenuUnregistered();
} elseif ($text == "" && $isRegistered) {
    // Display main menu for registered users if input is empty
    $menu->mainMenuRegistered();
} elseif (!$isRegistered) {
    // Handle actions for unregistered users based on the input
    $textArray = explode("*", $text);
    switch ($textArray[0]) {
        case 1:
            // Perform registration menu action
            $menu->menuRegister($textArray);
            break;
        default:
            // Display error message for invalid option
            echo "END Invalid option, Retry";
            break;
    }
} else {
    // Handle actions for registered users based on the input
    $textArray = explode("*", $text);
    switch ($textArray[0]) {
        case 1:
            // Perform user command menu action
            $menu->Usercommand($textArray, $phoneNumber);
            break;
        case 2:
            // Perform check order menu action
            $menu->Checkorder($textArray, $phoneNumber);
            break;
        default:
            // Display error message for invalid choice
            echo "END Invalid choice\n";
            break;
    }
}
?>
