<?php
function downloadFile($filePath) {
    // Check if the file exists
    if (file_exists($filePath)) {
        // Set headers for file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        ob_clean();
        flush();

        // Read the file and output it to the browser
        readfile($filePath);
        exit;
    } else {
        // File not found
        die('Error: The file does not exist.');
    }
}

// Get the file path from the query parameter
$file = isset($_GET['file']) ? $_GET['file'] : '';

// Download the file
downloadFile($file);
?>
