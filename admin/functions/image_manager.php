<?php

// Function to upload ONLY images
function upload_image($image_name, $source_path, $upload_path, $error_redirect)
{
  $image_extenstion = pathinfo($image_name, PATHINFO_EXTENSION);
  $final_image_name = uniqid() . "." . $image_extenstion;
  $upload_path = $upload_path . $final_image_name;
  $upload = move_uploaded_file($source_path, $upload_path);

  if (!$upload) {
    $_SESSION['flash_message'] = array(
      "message" => "Couldn't upload image",
      "category" => "danger"
    );

    header("location:" . $error_redirect);
    die();
  }

  return $final_image_name;
}

// Function to delete iamges
function delete_image($remove_path, $error_redirect)
{
  $remove = unlink($remove_path);

  if (!$remove) {
    $_SESSION['flash_message'] = array(
      "message" => "Failed to remove old image",
      "category" => "Danger"
    );
    header("location:" . $error_redirect);
    die();
  }

  return $remove;
}

// Function to update images
function update_image($image_name, $source_path, $error_redirect, $upload_path, $remove_path)
{
  // Upload new image
  $upload_image_name = upload_image($image_name, $source_path, $upload_path, $error_redirect);

  // Delete old image
  $delete_image = delete_image($remove_path, $error_redirect);


  return $upload_image_name;
}
