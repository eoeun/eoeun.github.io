<?php
$file = "data_".$_POST["fileName"];

if($file !== "data_count.txt"){
	return;
}

return file_get_contents($file);
?>