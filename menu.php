<?php
// Include necessary files for database connection and utility functions
include_once("config.php");
include_once("util.php");
// Define a class named Menu
class Menu {
   
    protected $text;
    protected $sessionId;
        // Constructor to initialize text and session ID
    function __construct($text, $sessionId) {
        $this->text = $text;
        $this->sessionId = $sessionId;
       
    }
    // Display main menu for unregistered users
    public function mainMenuUnregistered() {
        $response = "CON Welcome to Iwacu dialry  \n";
        $response .= "1. Iyandikishe \n";
        echo $response;
    }
// Handle user registration process
    public function menuRegister($textArray) {
        $level = count($textArray);

        if ($level == 1) {
            echo "CON shyiramo amazina \n";
        } elseif ($level == 2) {
            echo "CON enter Aho utuye \n";
        }  elseif ($level == 3) {
            echo "CON enter phone \n";
        }elseif ($level == 4) {
            echo "CON shyiramo ijambo banga \n";
        } elseif ($level == 5) {
            echo "CON Ongera ushyiremo  ijambo banga \n";


        } else {
            $username = $textArray[1];
            $address = $textArray[2];
            $phonenumber = $textArray[3];
            $passwordofuser = $textArray[4];
            $confirm_pin = $textArray[5];
            
            if ($passwordofuser != $confirm_pin) {
                echo "END Ijambo banga ntirihura , Ongera ";
            } else {
                try {
                   
                    $c=new My_connection();
                    $conn = $c->open();
                    // Prepare and execute SQL query to insert user data
                    $stmt = $conn->prepare("INSERT INTO users (username, address,phonenumber,passwordofuser) 
                               VALUES (:username,:address,:phonenumber, :passwordofuser)");

                    $stmt->bindValue(':username', $username);
                    $stmt->bindValue(':address', $address);
                    $stmt->bindValue(':phonenumber', $phonenumber);
                    $stmt->bindValue(':passwordofuser', $passwordofuser);


                    if ($stmt->execute()) {
                         // If registration is successful, fetch user details and provide confirmation

                        $username = $textArray[1];
                        $stmt=$conn->prepare("SELECT * FROM users WHERE username= :username ");
                        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                        $stmt->execute();
                        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach($result as $value){
                            echo "END Urakoze  $username, kwiyandikisha byagenz neza !";
                        }
                       
                    } else {
                        echo "END kwiyandikisha ntibyakunda.";
                    }
                } catch (PDOException $e) {
                    echo "END Error: " . $e->getMessage();
                }
            }
        }
    }
    // Display main menu for registered users
    public function mainMenuRegistered() {
        $response = "CON Urakaza neza kuri Iwacu Dairly\n";
        $response .= "1. tanga komande\n"; 
        $response .= "2. Reba komande aho igeze \n"; 
        echo $response;
    }
// Handle user commands (place an order)
    public function Usercommand($textArray,$phonenumber) {
        $level = count($textArray);

        if ($level == 1) {
            echo "CON Hitamo igicuruzwa \n";
            $c = new My_connection();
            $conn = $c->open();
            $stmet = $conn->prepare("SELECT * FROM products");
            $stmet->execute();
            $result = $stmet->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $value) {
                echo " " . $value['pid'] . " " . $value['productname'] . "\n";
            }
        } elseif ($level == 2) {
            echo "CON Shyiramo umubare wa litiro / ingano \n";
        } elseif ($level == 3) {
            echo "CON Shyiramo pin \n";
        } 
        
        elseif ($level == 4) {
            $pid = $textArray[1];
            $quantity = $textArray[2];
            $passwordofuser = $textArray[3];
        
            // Check if the usercode exists in the users table
            try {
                
                $c = new My_connection();
                $conn = $c->open();
                
                $stmt_check = $conn->prepare("SELECT *,COUNT(*) as num FROM users WHERE phonenumber = '$phonenumber' and  passwordofuser = :passwordofuser");
                $stmt_check->bindParam(':passwordofuser', $passwordofuser, PDO::PARAM_STR);
                $stmt_check->execute();
                $count = $stmt_check->fetch(PDO::FETCH_ASSOC);
        
                if ($count['num'] > 0) {
                    // If user is validated, proceed with order processing
                    $userid=$count['userid'];
                   
                    try {
                        $stmt_check_quantity = $conn->prepare("SELECT quantity FROM products WHERE pid = :pid");
                        $stmt_check_quantity->bindParam(':pid', $pid, PDO::PARAM_STR);

                        $stmt_check_quantity->execute();
                        $available_quantity = $stmt_check_quantity->fetchColumn();
    
                        if ($available_quantity >= $quantity) {
                           
                            // If requested quantity is available, proceed with inserting into the orders table
                            $stmt = $conn->prepare("INSERT INTO orders (quantity, pid,userid) VALUES ('$quantity','$pid','$userid')");
                            $stmt->execute();
                            // Fetch the last inserted order ID
                            $last_insert_id = $conn->lastInsertId();
                            // Provide order confirmation with order ID
                            echo "END Urakoze komande yagenze neza nimero ya command yawe ni: $last_insert_id\n";
                            echo "98. Subira inyuma\n";
                            echo "99. Ahabanza\n";
                        } else {
                            // If requested quantity is not available, display error message
                            echo "END Requested quantity exceeds available quantity!\n";
                            echo "98. Subira inyuma\n";
                            echo "99. Ahabanza\n";
                        }
                    } catch (PDOException $e) {
                        echo "END Komande yanze subiramo!: " . $e->getMessage() . "\n";
                        echo "98. Subira inyuma \n";
                        echo "99. Ahabanza\n";
                    }
                } else {
                    
                    echo "END ihangane ijambo banga siyo\n";
                    echo "98. Subira Inyuma \n";
                    echo "99. Ahabanza\n";
                }
            } catch (PDOException $e) {
                echo "END Error checking userid: " . $e->getMessage() . "\n";
                echo "98. Subira inyuma\n";
                echo "99. Ahabanza\n";
                return;
            }
        } elseif ($level == 5) {
            echo "CON Hitamo igicuruzwa \n";
            $c = new My_connection();
            $conn = $c->open();
            $stmet = $conn->prepare("SELECT * FROM products");

            $stmet->execute();
            $result = $stmet->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $value) {
                echo " " . $value['pid'] . " " . $value['productname'] . "350/ltr\n";
            }
            echo "98. Subira inyuma\n";
            echo "99. Ahabanza\n";
        } elseif ($level == 6) {
            if ($textArray[5] == 98) { // Go back option
                echo "CON Hitamo igicuruzwa \n";
                $c = new My_connection();
                $conn = $c->open();
                $stmet = $conn->prepare("SELECT * FROM products");
                $stmet->execute();
                $result = $stmet->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $value) {
                    echo " " . $value['pid'] . " " . $value['productname'] . "350/ltr\n";
                }
            } elseif ($textArray[5] == 99) { // Go home option
                $this->mainMenuRegistered();
            } else {
                echo "END Invalid option";
            }
        } else {
            echo "END Invalid entry";
        }
    }
        // Handle checking order status
    public function Checkorder($textArray,$phonenumber) {
        $level = count($textArray); 
        if ($level == 1) {

                $c = new My_connection();
                $conn = $c->open();
                    $stmt_check = $conn->prepare("SELECT *,COUNT(*) as num FROM users WHERE phonenumber = '$phonenumber'");
                    $stmt_check->execute();
                    $count = $stmt_check->fetch(PDO::FETCH_ASSOC);
                    $userid=$count['userid'];
                    $stmet = $conn->prepare("SELECT * FROM orders where userid= '$userid' ORDER  BY dateofcreation ");
                    $stmet->execute();
                    $result = $stmet->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $value) {
                        // echo $value['userid'];
                        echo "  " . "Ingano | : " . $value['quantity'] . " | Aho bigeze  : ". $value['status'] ." "." | Date ".$value['dateofcreation'] . "\n";
                        
                        

                    }
                    echo "99. Ahabanza\n";
                }elseif ($level == 2) {
                    if  ($textArray[1] == 99) { // Go home option
                        $this->mainMenuRegistered();
                    } else {
                        echo "END Invalid option";
                    }
                } else {
                    echo "END Invalid entry";
                }
                
            }
    
        
    }

?>