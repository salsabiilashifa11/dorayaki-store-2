<?php
require_once __DIR__ . '/../config/constants.php';

function issueAuthCookie($id) {
  $cookie_name = COOKIE_AUTH;
  $exp = time() + COOKIE_AUTH_TIME;
  $cookie_value = "$id-$exp";
  $cookie_value_encoded = base64_encode($cookie_value);
  $cookie_secret = $cookie_value . '-' . COOKIE_AUTH_SECRET;
  $cookie_secret_hashed = hash('sha256', $cookie_secret);
  $cookie_value_secret = $cookie_value_encoded . '.' . $cookie_secret_hashed;

  setcookie($cookie_name, $cookie_value_secret, $exp, '/');
}

function validateAuthCookie($all_cookies) {
  if (!isset($all_cookies[COOKIE_AUTH])) {
    return false;
  }

  $cookie = $all_cookies[COOKIE_AUTH];
  $cookie_split = explode('.', $cookie);
  $cookie_value_encoded = $cookie_split[0];
  $cookie_secret_hashed = $cookie_split[1];
  $cookie_value = base64_decode($cookie_value_encoded);
  $cookie_secret = $cookie_value .'-' . COOKIE_AUTH_SECRET;
  $cookie_secret_hashed_validate = hash('sha256', $cookie_secret);
  if ($cookie_secret_hashed_validate !== $cookie_secret_hashed) {
    return false;
  }

  $cookies = explode('-', $cookie_value);
  $id = $cookies[0];
  $exp = $cookies[1];

  if (empty($id) || time() > $exp) {
    return false;
  }

  return $id;
}

function removeCookie() {
  $cookie_name = COOKIE_AUTH;
  $exp = time() - COOKIE_AUTH_TIME;

  $cookie_value = '';
  $cookie_value = base64_encode($cookie_value);
  setcookie($cookie_name, $cookie_value, $exp, '/');
}

?>