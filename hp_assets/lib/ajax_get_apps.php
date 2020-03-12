<?php

  // AJAX call to fetch all Cloudron apps

  require(__DIR__ . "/_request.php");

  $config = json_decode(file_get_contents(dirname(__FILE__) . "/../../config.json"), true);

  if (!empty($config['cloudron_api_url'])
      && !empty($config['protected']['cloudron_api_access_token'])) {
    $url = "{$config['cloudron_api_url']}/api/v1/apps?access_token={$config['protected']['cloudron_api_access_token']}";
    $json = json_decode(curl_get_contents($url), true);

    echo json_encode(array('success' => 1, 'apps' => $json['apps']));
  }

  die();

?>