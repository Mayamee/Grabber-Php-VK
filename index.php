<?php

	require_once "./lib/lib.php";
	require_once "./conf.php";

	$group = get_rand_elem($CONF_GROUPS);
	$Grabber = new Grabber($CONF_TOKEN, "-209114859", $group, 100);
	$Grabber->do();
?>
