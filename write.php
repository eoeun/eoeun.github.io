<?php

$name = "data_".$_POST["fileName"];
if($name != "data_count.txt"){
	return;	
}

if($name === "data_"){
	return;
}
file_put_contents($name, $_POST["content"]);
?>
