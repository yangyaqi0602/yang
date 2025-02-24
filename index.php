<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>Yang Yaqi</title>

<meta name="description" content="Yang Yaqi">

<meta name="author" content="">

<meta property="og:type" content="website">

<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script>
$(document).ready(function(){

$("#visible").click(function() {
$('#invisible').toggleClass("show");
$('#back').toggleClass("show");
$('#front').toggleClass("hide");
$('.name').toggleClass("hide");
});

});
</script>

<link rel="stylesheet" href="style.css">

</head>

<body>

<p id="visible">Yang Yaqi</p><br>
<div id="invisible" class="hide">
<?php
if (file_exists('info.txt')) {
    echo nl2br(file_get_contents('info.txt'));
} else {
    echo "File not found.";
}
?>
</div>

<div id="back" class="hide"></div>

<!------ hanger ------>

<?php
$directory = __DIR__ . '/asset'; // Adjust this path if needed

// Get all folders in the directory
$folders = array_filter(glob($directory . '/*'), 'is_dir');

// Extract numbers and sort folders
$numbers = [];
foreach ($folders as $folder) {
    if (preg_match('/\d+/', basename($folder), $match)) {
        $numbers[] = (int)$match[0];
    }
}

// Sort folders based on extracted numbers
array_multisort($numbers, SORT_ASC, $folders);

foreach ($folders as $index => $folder) {
    $name = basename($folder);
    $position = $numbers[$index]; // Directly use the extracted number as position
    $folderPath = 'asset/' . rawurlencode($name) . '/index.php'; // Encode for URL safety

    // Extract text inside brackets
    preg_match('/\[(.*?)\]/', $name, $bracketText);
    $displayName = $bracketText[1] ?? ""; // Show only text in brackets, or empty if not found

    // Convert name into a valid CSS class (replace spaces and special chars)
    $className = preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);

    if (!empty($displayName)) {
        echo "<div id='$className' class='name' style='position:absolute; top:{$position}px;'>
                <a href='$folderPath'>$displayName</a>
              </div>";
    }
}
?>

<!------ hanger ------>

<img src="asset/winters day-200px.webp" id="front" class="winter">

</body>

</html>