<!DOCTYPE html>
<html>

<head>
  <title>Maintenance mode</title>
  <meta name="keywords" content="Maintenance Mode" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="robots" content="index, follow" />
  <style>
    html { width: 100%; height: 100%; }
body { text-align: center; margin: 0px; padding: 0px; height: 100%; color: #fff; font-family: sans-serif;
background: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB);
background-size: 400% 400%;
-webkit-animation: Gradient 15s ease infinite;
-moz-animation: Gradient 15s ease infinite;
animation: Gradient 15s ease infinite;}
.vh { height: 100%; align-items: center; display: flex; }
.vh > div { width: 100%; text-align: center; vertical-align: middle; }
img { max-width: 100%; }
.wrap {text-align: center;}
.wrap h1 {font-size: 30px;font-weight: 700;margin: 0 0 90px;}
.wrap h2 {font-size: 24px;font-weight: 400;line-height: 1.6;margin: 0 0 80px;}
@-webkit-keyframes Gradient {
0% {background-position: 0% 50%}
50% {background-position: 100% 50%}
100% {background-position: 0% 50%}
}
@-moz-keyframes Gradient {
0% {background-position: 0% 50%}
50% {background-position: 100% 50%}
100% {background-position: 0% 50%}
}
@keyframes Gradient {
0% {background-position: 0% 50%}
50% {background-position: 100% 50%}
100% {background-position: 0% 50%}
}
  </style>
</head>

<body>
  <div class="vh">
  <div>
   <div class="wrap">
	<h1>Maintenance mode</h1>
	<h2><p>Sorry for the inconvenience.<br>Our website is currently undergoing scheduled maintenance.<br><br></p></h2>
	<p>Thank you for your understanding.</p>
	</div>
  </div>
</div>
</body>

</html>
<?php
die();
//phpinfo(); die();
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';
