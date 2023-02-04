<?php

function isEmail($str) {
  return filter_var($str, FILTER_VALIDATE_EMAIL);
}

function debug_to_console($data) {
  $output = $data;
  if (is_array($output))
      $output = implode(',', $output);

  echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>