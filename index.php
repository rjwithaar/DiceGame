<?php
include_once('header.php');

$page = 'content';
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = $_GET['page'];
}
include(sprintf('pages/%s.php', $page));

include_once('footer.php');