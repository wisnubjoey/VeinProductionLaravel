<?php
// Check if the request is for a static file
if (preg_match('/\.(?:css|js|jpg|png|gif)$/', $_SERVER["REQUEST_URI"])) {
    return false;
}

require __DIR__ . '/../public/index.php';