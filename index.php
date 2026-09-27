<?php
require __DIR__ . "/php/config.php";
require __DIR__ . "/php/header.php";

// Keep page routing constrained to a single path component. Program IDs are
// routed to the application details page; all other pages must be simple
// alphanumeric/underscore/dash names.
$page = $_SESSION['page'] ?? 'home';

if (preg_match('/^\d{4}(?:[-_][A-Za-z0-9_-]+)?$/', $page) && isset($prog[$page])) {
    require __DIR__ . "/php/content/application-details.php";
} elseif (preg_match('/^[A-Za-z0-9_-]+$/', $page)) {
    $contentFile = __DIR__ . "/php/content/" . $page . ".php";
    if (is_file($contentFile)) {
        require $contentFile;
    } else {
        http_response_code(404);
        require __DIR__ . "/php/content/home.php";
    }
} else {
    http_response_code(400);
    require __DIR__ . "/php/content/home.php";
}

require __DIR__ . "/php/footer.php";
?>