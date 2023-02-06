<?php

if (isset($_FILES['data']) && $_FILES['data']['error'] == 0) {
  $file = fopen($_FILES['data']['tmp_name'], "r") or die("Unable to open file!");
  while (!feof($file)) {
    $url = trim(fgets($file));
    if ($url) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, true);
      curl_setopt($ch, CURLOPT_NOBODY, true);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
      $header = substr($response, 0, $header_size);
      $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
      
      echo "$url - HTTP Status Code: $http_code<br>";
    }
  }
  fclose($file);
} else {
  echo "No file was uploaded";
}
?>
