<?php
if(isset($_GET['url']) && isset($_GET['name'])){
  $name = trim($_GET['name']);
  $url = trim($_GET['url']);
  $headers = get_headers($url, 1);
  if(isset($headers['Content-Disposition'])){
    $cdp = $headers['Content-Disposition'];
    preg_match_all("/[^\'\']+$/", $cdp, $ofname);

    if(empty($name)){
      $base_name = $ofname[0][0];
    } else {
      $base_name = $name;
    }
  } else {
     if(empty($name)){
       $base_name = basename($url);
     } else {
      $base_name = $name;
    } 
  }
  downloadd($url, $base_name);
}

function downloadd($url, $outFileName)
{
    //file_put_contents($xmlFileName, fopen($link, 'r'));
    //copy($link, $xmlFileName); // download xml file

    if(is_file($url)) {
        copy($url, $outFileName); // download xml file
    } else {
        $options = array(
          CURLOPT_FILE    => fopen($outFileName, 'w'),
          CURLOPT_TIMEOUT =>  28800, // set this to 8 hours so we dont timeout on big files
          CURLOPT_URL     => $url
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        curl_exec($ch);
        curl_close($ch);
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Downloader</title>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <style>

    </style>
  </head>
  <body>
    <form method="get">
      <input type="text" name="name" placeholder="File name"/><br>
      <input type="url" name="url" placeholder="File link"/><br>
      <input type="submit" value="Download"/>
    </form>
  </body>
</html>
