<?php

echo '<!DOCTYPE html>';

function consoleLog($message, $title=null) {
	echo "<script>console.log('" . $title . $message . "');</script>";
}