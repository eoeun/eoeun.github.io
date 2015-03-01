<?php

$name = "data_".$_POST["fileName"];

if($name === "data_"){
	return;
}
file_put_contents($name, $_POST["content"]);
?>