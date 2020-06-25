<?php

// http://stackoverflow.com/a/24707821 => use instead of file_get_contents for external URL's
function curl_get_contents($url, $headers = null) {
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $url);

  // Include potential headers with request
  if (!empty($headers)) {
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  }

  $data = curl_exec($ch);
  curl_close($ch);

  return $data;
}

?>