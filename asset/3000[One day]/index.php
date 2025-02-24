<?php
// Directory where the images are stored
$directory = './';

// Get all files in the directory
$files = scandir($directory);

// Filter out non-image files
$imageFiles = array_values(array_filter($files, function($file) {
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    return in_array($extension, $imageExtensions);
}));

// Sort the image files alphabetically
sort($imageFiles);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>Yang Yaqi</title>

<meta name="description" content="Yang Yaqi">

<meta name="author" content="">

<meta property="og:type" content="website">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="/squire.css">

</head>

<body>

<a href="/"><img class="pin" src="/thread1.gif"></a>

<?php if (!empty($imageFiles)): ?>
    <img id="imageDisplay" src="<?php echo $directory . $imageFiles[0]; ?>" alt="Image" onclick="changeImage()">
<?php else: ?>
<?php endif; ?>

<script>
    const images = <?php echo json_encode($imageFiles); ?>;
    let currentIndex = 0;

    function changeImage() {
        currentIndex = (currentIndex + 1) % images.length;
        document.getElementById("imageDisplay").src = images[currentIndex];
    }
</script>

<br>

<?php
// Define the directory where your .txt files are located
$directory = "./";

// Get all .txt files in the directory
$files = glob($directory . "*.txt");

// Loop through each file and echo its contents with line breaks
foreach ($files as $file) {
    echo nl2br(file_get_contents($file)) . "<br><br>";
}
?>

</body>
</html>