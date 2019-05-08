<?php

require_once("routes.php");

$route = isset($_GET['route']) ? $_GET['route'] : 'index';

require_once("pages/".$routes[$route].".php");