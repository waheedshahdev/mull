<?php 
ob_start();
require_once 'index_ci.php'; // adjust path accordingly
ob_get_clean();
return $CI;
?>
