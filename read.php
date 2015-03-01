<?php
$file = "data_".$_POST["fileName"];

return file_get_contents($file);
?>