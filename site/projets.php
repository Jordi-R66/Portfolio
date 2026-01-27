<?php
require_once __DIR__ . '/backend/pageloader/PageLoader.php';

$content = PageLoader::loadHTML("projets");

echo $content;
exit;
?>