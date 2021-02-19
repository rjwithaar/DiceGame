<?php

// Set smart Directory Separator
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

// Include all classes
foreach (glob(implode(DS, [__DIR__, 'functions', '*.php'])) as $file) {
    require_once($file);
}

// Show page
include_once('header.php');
$page = 'content';
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = $_GET['page'];
}
include(sprintf(implode(DS, ['pages', '%s.php']), $page));
include_once('footer.php');