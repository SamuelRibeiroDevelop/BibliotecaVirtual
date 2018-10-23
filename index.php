<?php

require_once "classes/template.php";

$template = new template();

$template->head();
$template->navbartop();
$template->sidebar();
$template->bodypage();
$template->footer();

?>