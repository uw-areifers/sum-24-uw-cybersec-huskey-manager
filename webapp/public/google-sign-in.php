<?php

session_start();

// Replace with your actual Google Client ID and Google API Key

$googleClientId = $_ENV["GOOGLECLIENTID"];
$googleApiKey = $_ENV["GOOGLEAPIKEY"];


// Function to verify and decode the JWT token
// Function to verify and decode the JWT token
function verifyJwt($jwt, $clientId, $apiKey)
{
    try {
        // Decode the JWT token
        
        // echo "PRINTING JWT <br>";
        // print_r($jwt);
  
        // //decode($jwt, new Key($key, 'HS256'), $headers = new stdClass());        
         $decoded = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $jwt)[1]))));     

        // echo "PRINTING decoded <br>";

        // print_r($decoded);
        // exit();
       
        // Validate the token claims (you may add more checks based on your requirements)
        if (
            
            isset($decoded->iss) && $decoded->iss === 'https://accounts.google.com' &&
            isset($decoded->aud) && $decoded->aud === $clientId &&
            isset($decoded->exp) && $decoded->exp >= time()

        ) {
            return $decoded;
        } else {
            return null; // Invalid token claims
        }
    } catch (\Firebase\JWT\ExpiredException $e) {
        echo 'Error Occurred: ' . $e;                
        return null; // Token has expired
    } catch (\Exception $e) {
        echo 'Generic Error Occurred: ' . $e;
        return null; // Invalid token
    }
}


$jwtToken = isset($_POST['credential']) ? $_POST['credential'] : '';

// print_r($jwtToken);

// Verify and decode the JWT token
$userInfo = verifyJwt($jwtToken, $googleClientId, $googleApiKey);

// Check if the token is valid
if ($userInfo) {
    // Token is valid, extract user information
    $userId = $userInfo->sub; // User ID
    $userEmail = $userInfo->email; // User email
    $userName = $userInfo->name; // User name
    $firstName = $userInfo->given_name;
    $lastName = $userInfo->family_name;

    // Now you can use $userId, $userEmail, $userName as needed
    // Insert the user into the database or perform any other actions

    // Example: Insert the user into the database
    // Ensure you have a database connection established

    // Database connection parameters

    $host = "mysql-database";
    $dbUserName = "user";
    $dbPassword = "supersecretpw";
    $database = "password_manager";    

    // Connect to the database
    $conn = new mysqli($host, $dbUserName, $dbPassword, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user already exists based on the email address
    $sqlCheckUser = "SELECT user_id FROM users WHERE email = '$userEmail'";
    $resultCheckUser = $conn->query($sqlCheckUser);

    if ($resultCheckUser->num_rows > 0) {
        // User already exists, perform any additional actions if needed
       // echo "User with email $userEmail already exists.";
       $_COOKIE['authenticated'] = $userName;
       header("Location: index.php");
    } else {
        // User does not exist, insert into the users table
        $sqlInsertUser = "INSERT INTO users (email, username, first_name, last_name, password_hash) 
                          VALUES ('$userEmail', '$userName', '$firstName', '$lastName', 'google-oauth-sso')";

        if ($conn->query($sqlInsertUser) === TRUE) {
           // echo "New user inserted successfully.";
           $_COOKIE['authenticated'] = $userName;
           header("Location: index.php");
        } else {
            echo "Error: " . $sqlInsertUser . "<br>" . $conn->error;
            exit();
        }
    }


    
    // Close the database connection
    $conn->close();
    

} else {
    // Invalid token, handle accordingly (e.g., redirect to an error page)
    echo "Invalid token";

}
?>