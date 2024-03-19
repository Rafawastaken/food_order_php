<?php

function flash_message($message, $category)
{
  $_SESSION['flash_message'] = array(
    "message" => $message,
    "category" => $category
  );
}
