<?php
$url = "index.html";
$htmlContent = file_get_contents($url);

if ($htmlContent === FALSE) {
    echo "Failed to load HTML from frontend container.";
} else {
    echo $htmlContent;
}
?>