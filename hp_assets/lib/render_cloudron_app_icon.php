<?php

  // Script to render a Cloudron app's icon so we can hide the access token from the front end, with caching

  $config = json_decode(file_get_contents(dirname(__FILE__) . "/../../config.json"), true);

  $cloudron_app_id = $_GET['cloudron_app_id'];

  $cache_dir = "../img/cache/";
  $cache_image_file_path = $cache_dir.$cloudron_app_id.'.png';

  $url = "{$config['cloudron_api_url']}/api/v1/apps/{$cloudron_app_id}/icon?access_token={$config['protected']['cloudron_api_access_token']}";

  header('Content-type: image/png');

  if (is_file($cache_image_file_path)) {
    // If CACHE exists, use it
    list($width_orig, $height_orig) = getimagesize($cache_image_file_path);
    $cache_image_p = imagecreatetruecolor($width_orig, $height_orig);
    $cache_image = imagecreatefrompng($cache_image_file_path);

    // Make sure the transparency information is saved
    imagesavealpha($cache_image_p, true);

    // Create a fully transparent background (127 means fully transparent)
    $trans_background = imagecolorallocatealpha($cache_image_p, 0, 0, 0, 127);

    // Fill the image with a transparent background
    imagefill($cache_image_p, 0, 0, $trans_background);

    imagecopyresampled($cache_image_p, $cache_image, 0, 0, 0, 0, $width_orig, $height_orig, $width_orig, $height_orig);

    echo imagepng($cache_image_p, null, -1);
    die();
  }

  list($width_orig, $height_orig) = getimagesize($url);

  $image_p = imagecreatetruecolor($width_orig, $height_orig);
  $image = imagecreatefrompng($url);

  // Make sure the transparency information is saved
  imagesavealpha($image_p, true);

  // Create a fully transparent background (127 means fully transparent)
  $trans_background = imagecolorallocatealpha($image_p, 0, 0, 0, 127);

  // Fill the image with a transparent background
  imagefill($image_p, 0, 0, $trans_background);

  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width_orig, $height_orig, $width_orig, $height_orig);

  // Output the image
  echo imagepng($image_p, null, -1);

  // Save image to cache
  imagepng($image_p, $cache_image_file_path);

  imagedestroy($image_p);

  die();

?>