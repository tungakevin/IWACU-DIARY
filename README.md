Iwacu Dailry
This repository contains a USSD application for managing a dairy products ordering system called "Iwacu Dailry". Users can register, view products, place orders, and view her/his orders , they can use sms to register   or use ussd code with her /his phone by press *384*45087#.

Contents
-	Overview
-	Features
-	Setup
-	Usage
-	Contributing

Overview
"Iwacu Dailry" is a USSD application built using PHP and MySQL that allows users to interact with the system via ussd code or  SMS  for registration . The application provides the following functionalities:

- User Registration: Users can register by sending an SMS with their details (name, address, phone number, password) or using ussd code on phone.
- Product Management: Admins can manage dairy products in the database, including adding, updating, and deleting products and order management.
- Order Placement: Registered users can place orders by press USSD code commands with product IDs and quantities.

 Features
- User Registration:
  - SMS-based registration with name, address, phone number, and password  or use ussd code , by providing required information .
  - Database storage of registered user information.

- Product Management:
  - Admin interface to add, update, and delete products and order .
  - Products are stored in a MySQL database with attributes such as name, company name, unit price, and quantity.

- Order Placement:
  - Registered users can place orders via press USSD code and follow instruction.
  - Orders are stored in the database and linked to user accounts.
-Registered users can view progress of their order 

 Setup
To run this application locally, follow these steps:
1.Clone the Repository:
   bash
   git clone https://github.com/davidniyonkur15/Iwacu-dailry.git
   

2. Database Configuration:
   - Create a MySQL database.
   - Import the iwacu.sql file provided in the repository to set up the required tables.

3. Configuration File:
   - Update the config.php file with your database credentials.

4. Run the Application:
   - Set up a local PHP server (e.g., using XAMPP, WAMP, or MAMP).
   - Place the repository files in the web server's root directory.
   - Access the application in your web browser.
  - open african’s talking sign in and open simulator 

Usage
1. User Registration:
   - Send an SMS with the format: `username address phonenumber password ` to register as a new user.
  - For ussd code format :` username address phonenumber password confirm_password` by follow ussd instructions to register as a new user

2. Product Management (Admin):
   - Use the admin interface to manage products in the database.

3. Order Placement:
   - Registered users can press USSD code provided to place orders with the format: 1 product_id quantity quantity pin.
