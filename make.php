<?php
function HumanBytes($bytes, $decimals = 2) {
  //$sz = 'BKMGTP';
  $sz = array(
    0 => 'B',
    1 => 'KB',
    2 => 'MB',
    3 => 'GB',
    4 => 'TB',
    5 => 'PB'
  );
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}
function Makefile($name, $size){
  define('SIZE', $size );
  $fp = fopen($name . '.bin', 'w');
  fseek($fp, SIZE-1,SEEK_CUR);
  fwrite($fp,'a');
  fclose($fp);
  return true;
}
$s = "";
if(!isset($_GET['make']) && isset($_GET['intg'])){
  $intg = (int) $_GET['intg'];
  $hbint = HumanBytes($intg);
  $s = $intg;
  echo "<p>Entered Bytes: <b>" . $intg . "</b><br>In Human Format: <b>" . $hbint . "</b><br><a href='?make={$hbint}&intg={$intg}'>Make this file</a></p>";
} elseif(isset($_GET['make']) && isset($_GET['intg'])){
  $size = (int) $_GET['intg'];
  $name = trim($_GET['make']);
  $mk = Makefile($name, $size);
  if($mk){
    echo "<p>File Made: <b><a href='{$name}.bin'>{$name}.bin</a></b> ; Size: <b>" . HumanBytes($size) . "</b></p>";
  } else {
    echo "Can't make the file!! Try again later!";
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Makefile</title>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <style>

    </style>
  </head>
  <body>
    <form method="get">
      <input type="number" name="intg" value="<?= $s ?>" placeholder="File size.."/>
      <input type="submit" value="Check"/>
    </form>
  </body>
</html>
