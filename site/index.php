<?php
require_once __DIR__ . '/backend/pageloader/PageLoader.php';

$content = PageLoader::loadHTML("index");

echo $content;
exit;
?>