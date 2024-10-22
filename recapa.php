<?php
$recaptcha_secret = "6Ldwm00nAAAAAP1EnoMb4yLJeIkkVy5qSTDn-O9Q";
$response = $_POST['g-recaptcha-response'];

$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
    'secret' => $recaptcha_secret,
    'response' => $response
);

$options = array(
    'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$result_array = json_decode($result, true);

if ($result_array['success']) {
   
} else {
  
}
?>


<form action="recapa.php" method="post">

<div class="g-recaptcha" data-sitekey="6Ldwm00nAAAAAIGWemOYGTjXhuyS9Tyoc9SXa6-V"></div>

                </form>