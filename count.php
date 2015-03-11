<?php
$currentVar = explode("\n", file_get_contents("data_count.txt"));

if(count($currentVar) === 0){
  $currentVar = [0, 0, time()];
}

$now = time();
if($currentVar[2] - $now > 86400000){
  $currentVar[1] = 0;
  $currentVar[2] = $now;
}
$currentVar[0]++;
$currentVar[1]++;
file_put_contents("data_count.txt", implode("\n", $currentVar));
?>
