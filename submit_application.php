<?php
// Only process POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $fullName    = trim($_POST['fullName']);
    $email       = trim($_POST['email']);
    $phone       = trim($_POST['phone']);
    $position    = trim($_POST['position']);
    $coverLetter = trim($_POST['coverLetter']);

    // Check required fields
    if (empty($fullName) || empty($email) || empty($phone) || empty($position)) {
        die("Please fill in all required fields.");
    }

    // Define the uploads folder
    $uploadDirectory = "uploads/";
    // Create the folder if it doesn't exist
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0755, true);
    }

    $uploadedFilePath = "";
    // Check if file was uploaded without errors
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == UPLOAD_ERR_OK) {
        $allowedExtensions = array("pdf", "doc", "docx");
        $fileName = basename($_FILES['resume']['name']);
        $fileTmpPath = $_FILES['resume']['tmp_name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions)) {
            // Generate a unique file name to prevent collisions
            $newFileName = time() . "_" . preg_replace("/[^A-Za-z0-9_\-\.]/", '_', $fileName);
            $destination = $uploadDirectory . $newFileName;
            if (move_uploaded_file($fileTmpPath, $destination)) {
                $uploadedFilePath = $destination;
            } else {
                die("Error moving the uploaded file.");
            }
        } else {
            die("Invalid file type. Only PDF, DOC, and DOCX files are allowed.");
        }
    }

    // Prepare the application data to store in a text file
    $data = "Full Name: " . $fullName . "\n" .
            "Email: " . $email . "\n" .
            "Phone: " . $phone . "\n" .
            "Position: " . $position . "\n" .
            "Cover Letter: " . $coverLetter . "\n" .
            "Resume: " . ($uploadedFilePath ? $uploadedFilePath : "No file uploaded") . "\n" .
            "Submitted On: " . date("Y-m-d H:i:s") . "\n" .
            "-----------------------------\n";

    // Append the application data to a text file (creates file if not exists)
    file_put_contents("applications.txt", $data, FILE_APPEND);

    echo "Application submitted successfully!";
} else {
    echo "Invalid request.";
}
?>
