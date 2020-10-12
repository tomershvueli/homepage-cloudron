# Homepage, Customized for Cloudron

This project is a clone of [this homepage project](https://github.com/tomershvueli/homepage), but retrofitted to be a simple [Cloudron](https://cloudron.io/) dashboard alternative. 

It is your minimalist corner of the internet. The background will update with a gorgeous (and royalty free) image from [Unsplash](https://unsplash.com/), or a custom source every 20 seconds. With it, a simple menu is available to you listing your installed Cloudron applications. 

All the assets needed are part of the repo so it can run offline (though it won't fetch pretty background images for you). 

This project uses:
- Apache
- PHP and PHP cURL
- jQuery
- Bootstrap CSS
- Mousetrap.js
- Font Awesome
- Unsplash

## Screenshots
Homepage w/o Menu:
![Homepage w/o Menu](example_img/homepage-wo-menu.png?raw=true)

Homepage with Menu Toggled:
![Homepage with Menu](example_img/homepage-w-menu.png?raw=true)


## To Use
Copy the config.sample.json file and rename to config.json. Be sure to update the fields as you see appropriate. You have the option to use the Unsplash API to fetch background images, or use a custom URL and JSON selector. If you choose to use Unsplash, will need to create a developer profile at [Unsplash](https://unsplash.com/) to use the background image functionality properly. 

## Configure Homepage
- `unlock_pattern` => Choose unlock pattern from [Mousetrap](https://craig.is/killing/mice)
- `clock_format` => Choose pattern format from [PHP's date function](http://php.net/manual/en/function.date.php)
- `hover_color` => The CSS color for menu items when hovered over. Defaults to `#999`. 
- `time_to_refresh_bg` => Time, in milliseconds, until it will fetch the next background image. Defaults to `20000`. 
- `show_menu_on_page_load` => Boolean as to whether the menu should be shown when you first load the page. Defaults to `false`.
- `idle_timer` => Set a number of milliseconds here if you'd like to automatically hide the menu after a certain time of inactivity. Leave this attribute out entirely if you don't want an idle timer. 
- `show_menu_on_page_load` => Boolean whether to show the menu on page load, otherwise hide it. Defaults to false, i.e. hidden. 
- `open_links_in_new_tab` => Boolean whether to open all links in a new tab. Defaults to false, i.e. open links in current tab. 
- `cloudron_api_url` => The url of your Cloudron dashboard, i.e. `https://my.example.com`. This will be automatically filled out upon Cloudron installation. 
- `custom_links` => An optional array of objects for custom links to add to the dashboard. Objects can accept the following attributes: 
  - `url` => `https://` or `http://` prefixed URL of site
  - `title` => Title of page, i.e. Apple, or Nextcloud
  - `image` => URL of image. Can be remote or local file. Provide either `image` or `icon`. 
  - `icon` => [Font Awesome icon name](https://fontawesome.com/icons). Provide either `image` or `icon`. 
  - `ordinal` => Ordinal integer for where you want the icon to show up in the dashboard
- `cloudron_app_ordinals` => An optional object to provide ordinal values for your Cloudron apps. The key should be your Cloudron app GUID, i.e. a 36 character string. The value should be the ordinal integer you want for this link. If not supplied, each Cloudron app will automatically get assigned an ordinal of `100 * index` in the order they come back from the API call, e.g. the first app returned will have an ordinal of 0, the second app will have an ordinal of 100, etc. 
- `cloudron_api_access_token` => An API access token so that we can query the apps installed in the Cloudron instance. You can get an API access token by visiting your Cloudron dashboard and adding an `/profile` to the end of the url instead of `/apps`, i.e. `https://my.example.com/#/profile`.

__NOTE__: PHP cURL is required for fetching external images.

### Unsplash Background Images
- `unsplash_client_id` => Get Unsplash client ID from [Unsplash](https://unsplash.com/developers)

### Custom Background Images
- `custom_url` => Input a custom URL that will return proper JSON
- `custom_url_headers` => Add any headers that may be needed to complete a cURL request to the aforementioned URL properly
- `custom_url_selector` => Input a proper PHP array selector to be used on the JSON received above. For example, if I were to fetch from Github's user API with a 'custom_url' of 'https://api.github.com/users/octocat', the 'custom_url_selector' would simply be `['avatar_url']`. `[{random}]` can be replaced for a random index in an array. 