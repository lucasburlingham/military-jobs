<?php

function consoleLog($message, $title=null) {
	echo "<script>console.log('" . $title . $message . "');</script>";
}