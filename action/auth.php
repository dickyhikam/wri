<?php
// Get the raw POST data
$data = file_get_contents("php://input");

// Decode the JSON data into a PHP array
$formData = json_decode($data, true);

// Check if the data was decoded successfully
if ($formData) {
    // Capture the current date and time
    $currentDate = new DateTime();
    $formattedDate = $currentDate->format('Y-m-d H:i:s');  // Format it as 'YYYY-MM-DD HH:MM:SS'

    // Capture the email and extract the username (without the '@' and domain part)
    $email = $formData['email'];

    // Read the existing data from the JSON file
    $jsonFile = '../data/new_user.json';  // Update the path to your JSON file
    if (file_exists($jsonFile)) {
        // If the file exists, read the current data
        $existingData = json_decode(file_get_contents($jsonFile), true);
    } else {
        // If the file doesn't exist, initialize an empty array
        $existingData = [];
    }

    // Check if the email already exists
    $emailExists = false;
    foreach ($existingData as $user) {
        foreach ($user['user_cred'] as $user_cred) {
            if ($user_cred['email'] === $email) {
                $emailExists = true;
                break;
            }
        }
        if ($emailExists) {
            break;
        }
    }

    if ($emailExists) {
        // Return an error response if the email already exists
        echo json_encode(['status' => 'error', 'message' => 'The email address is already registered. Please use a different email.']);
    } else {
        // Generate a unique email by appending a random string
        $username = strstr($email, '@', true); // Get everything before '@' as the username

        // Collect user credentials data
        $user_cred = [
            'id' => time(),  // Use time as a unique ID
            'username' => $username,
            'email' => $email,
            'password' => $formData['password'],
            'status' => ''
        ];

        // Collect user profile data
        $user_profile = [
            'id' => time(),  // Use time as a unique ID
            'name' => $formData['name'],
            'type_user' => $formData['type_user'],
            'register_date' => $formattedDate
        ];

        // Add the new user data to the existing arrays
        $existingData[0]['user_cred'][] = $user_cred;
        $existingData[0]['user_profile'][] = $user_profile;

        // Save the updated data back to the JSON file
        file_put_contents($jsonFile, json_encode($existingData, JSON_PRETTY_PRINT));

        // Return a response indicating success
        echo json_encode(['status' => 'success', 'message' => 'Your registration has been successfully completed.']);
    }
} else {
    // Return an error response if the data is invalid
    echo json_encode(['status' => 'error', 'message' => 'There was an error processing your registration. Please check the details and try again.']);
}
