<?php

function issueLoginSession() {
  $_SESSION['login'] = true;
}

function validateLoginSession() {
  if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    return false;
  }
  return true;
}

?>