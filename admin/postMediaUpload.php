<?php
ob_start();
if (isset($_FILES['post_images'])) {
  // echo "Received " . count($_FILES['post_images']['name']) . " image(s)";
  $images = $_FILES['post_images'];
  $imageUrls = array(); // Create an array to store the image URLs
  // Loop through the uploaded images and process them as needed
  for ($i = 0; $i < count($images['name']); $i++) {
      $image_name = $images['name'][$i];
      $image_tmp = $images['tmp_name'][$i];
      // Process the image (e.g., move to a desired location, save to database, etc.)
      // You can use PHP functions like move_uploaded_file() to move the image to the desired location
      move_uploaded_file($image_tmp, '../assets/blogMedia/' . $image_name);
      // Generate the URL of the uploaded image (e.g., 'path/to/uploads/image.jpg')
      $image_url = 'localhost/meergeluk/assets/blogMedia/' . $image_name;
      // Add the image URL to the array
      $imageUrls[] = $image_url;
}

  // Return the image URLs as a JSON response
  echo json_encode(array('location' => $imageUrls));
  
} else {
  
  echo "No images received";
}

?>