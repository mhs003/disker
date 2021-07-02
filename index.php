<?php
error_reporting(0);
$bin_files = glob("*.bin");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Big files</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <style>
	body{
	  font-family: Courier;
	  tab-size: 4;
	  word-spacing: -1px;
	  line-height: 1.3;
	  font-size: 120%;
	  max-width: 600px;
	  margin: auto;
	  padding: 10px;
	}
	table, th, td {
	  border: 1px solid black;
	  border-collapse: collapse;
	}
	th, td {
	  padding: 5px;
	  text-align: left;
	}
    </style>
  </head>
  <body>

    <h2>Downloadable files..</h2>

	<table style="width:100%">
	  <caption>File links</caption>
	  <tr>
	    <th>File name</th>
	    <th>Size</th>
	  </tr>
	  <?php
	    foreach($bin_files as $k => $v){
	      echo "<tr>\n<td>";
	      echo '<a href="'.$v.'">'.$v.'</a>';
	      echo "</td>";
	      echo "<td>";
	      $fs = filesize($v);
	      echo HumanBytes($fs);
	      echo "</td>\n</tr>";
	    }
	  ?>
	</table>
	
  </body>
</html>
<?php
// Functions
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
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . " " .  @$sz[$factor];
}
?>
