<?php

  // AJAX call to fetch all Cloudron apps

  require(__DIR__ . "/_request.php");

  $config = json_decode(file_get_contents(dirname(__FILE__) . "/../../config.json"), true);

  if (!empty($config['cloudron_api_url'])
      && !empty($config['protected']['cloudron_api_access_token'])) {
    $url = "{$config['cloudron_api_url']}/api/v1/apps?access_token={$config['protected']['cloudron_api_access_token']}";
    $json = json_decode(curl_get_contents($url), true);

    // Let's clean up our 'apps' response object to only send back pertinent information
    $apps = $json['apps'];
    foreach ($apps as $key => &$app) {
      $app_id = $app['id'];
      $app = array(
        'id' => $app_id,
        'url' => "https://{$app['fqdn']}",
        'title' => $app['manifest']['title'],
        'image' => "hp_assets/lib/render_cloudron_app_icon.php?cloudron_app_id={$app_id}",
        // Ordinal will either be pulled from config file if set, otherwise it'll be 100 times its index in the array
        'ordinal' => $config['cloudron_app_ordinals'][$app_id] ? $config['cloudron_app_ordinals'][$app_id] : $key * 100
      );
    }

    echo json_encode(array('success' => 1, 'apps' => $apps));
  }

  die();

?>