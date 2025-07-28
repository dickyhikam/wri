<?php
session_start(); // <- Tambahkan ini di awal agar session aktif

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

    // Check if the email, phone number, or name already exists
    $emailExists = false;

    // Iterate through each user
    foreach ($existingData as $user) {
        // Check if any user credential matches the form data
        foreach ($user['user_cred'] as $user_cred) {
            if (
                $user_cred['email'] === $email ||
                $user_cred['phone_number'] === $formData['phone_number'] ||
                $user_cred['name'] === $formData['name']
            ) {
                $emailExists = true;
                break 2;  // Break out of both loops immediately
            }
        }
    }

    // If the email, phone number, or name exists, return an error
    if ($emailExists) {
        echo json_encode([
            'status' => 'error',
            'message' => 'The email address, phone number, or name is already registered. Please use a different one.'
        ]);
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
            'phone_number' => $formData['phone_number'],
            'type_user' => $formData['type_user'],
            'register_date' => $formattedDate
        ];

        // Add the new user data to the existing arrays
        $existingData[0]['user_cred'][] = $user_cred;
        $existingData[0]['user_profile'][] = $user_profile;

        // Save the updated data back to the JSON file
        file_put_contents($jsonFile, json_encode($existingData, JSON_PRETTY_PRINT));

        // Simpan email ke session
        $_SESSION['email'] = $email;

        // Return a response indicating success
        echo json_encode(['status' => 'success', 'message' => 'Your registration has been successfully completed.']);
    }
} else {
    // Return an error response if the data is invalid
    echo json_encode(['status' => 'error', 'message' => 'There was an error processing your registration. Please check the details and try again.']);
}
