<?php

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_FILES['zip_file']) && $_FILES['zip_file']['error'] === 0) {

        $uploadDir = __DIR__ . '/uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $zipName = basename($_FILES['zip_file']['name']);
        $zipPath = $uploadDir . $zipName;

        // Move uploaded file
        if (move_uploaded_file($_FILES['zip_file']['tmp_name'], $zipPath)) {

            $zip = new ZipArchive;

            if ($zip->open($zipPath) === TRUE) {

                // Extract to folder with same name as zip
                $extractFolder = $uploadDir . pathinfo($zipName, PATHINFO_FILENAME) . '/';

                if (!is_dir($extractFolder)) {
                    mkdir($extractFolder, 0777, true);
                }

                $zip->extractTo($extractFolder);
                $zip->close();

                $message = "ZIP extracted successfully to: " . htmlspecialchars($extractFolder);

            } else {
                $message = "Failed to open ZIP file.";
            }

        } else {
            $message = "Failed to upload ZIP file.";
        }

    } else {
        $message = "Please select a valid ZIP file.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Unzipper</title>
</head>
<body>

<h2>Upload and Extract ZIP</h2>

<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="zip_file" accept=".zip" required>
    <button type="submit">Upload & Extract</button>
</form>

</body>
</html>