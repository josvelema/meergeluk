<?php

include 'main.php';

// SQL query that will retrieve all the posts from the database ordered by the ID column
// $stmt = $pdo->prepare('SELECT * FROM posts ORDER BY post_id DESC');
// $stmt->execute();
// $media = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?= template_admin_header('Edit Post', 'posts') ?>

<h2>Edit post</h2>


<?php
$post_id = null;
if (isset($_GET['p_id'])) {
  $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
  $root_url  = str_replace('/admin', '', $base_url);

  $post_id = $_GET['p_id'];

  $stmt = $pdo->prepare('SELECT * FROM posts WHERE post_id = ? ');
  $stmt->bindParam(1, $post_id, PDO::PARAM_INT);
  $stmt->execute();

  while ($row = $stmt->fetch()) {
    $post_id            = $row['post_id'];
    $post_author          = $row['post_author'];
    $post_title         = $row['post_title'];
    $post_slug         = $row['post_slug'];
    $post_category_id   = $row['post_cat_id'];
    $post_status        = $row['post_status'];
    $post_image         = $row['post_image'];
    // $post_content       = str_replace("assets", "../assets", $row['post_content']) ;
    $post_content = str_replace($base_url . 'assets', 'assets', $row['post_content']);

    $post_intro         = $row['post_intro'];

    $post_url           = $row['post_url'];

    $post_tags          = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date          = $row['post_date'];
  }
}

if (isset($_POST['update_post'])) {
  $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');



  // $post_author         =  $_POST['post_author'];
  $post_author       =  'Sabine';  

  $post_title = $_POST['post_title'];

  // Remove special characters except for hyphens and alphanumeric characters
  // $sanitized_title = preg_replace('/[^a-zA-Z0-9-]/', '', $post_title);
  $sanitized_title = preg_replace('/[^a-zA-Z0-9-\s]/', '', $post_title);

  
  // Replace spaces with hyphens
  $slug = strtolower(str_replace(' ', '-', $sanitized_title));

  $post_category_id    =  $_POST['post_category'];
  // $post_status         =  $_POST['post_status'];
  $post_status         =  "published";

  $post_image          =  $_FILES['image']['name'];
  $post_image_temp     =  $_FILES['image']['tmp_name'];
  // $post_content = str_replace("../assets", "assets", ($_POST['post_content']));
  $post_content = str_replace($base_url . 'assets', 'assets', $_POST['post_content']);


  $post_intro          =  $_POST['post_intro'];
  $post_url            =  $_POST['post_url'];

  $post_tags           =  $_POST['post_tags'];
  $post_author       =  'Sabine';  


  if (empty($post_image)) {

    $stmt = $pdo->prepare('SELECT * FROM posts WHERE post_id = ? ');
    $stmt->bindParam(1, $post_id, PDO::PARAM_INT);
    $stmt->execute();


    while ($row = $stmt->fetch()) {

      $post_image = $row['post_image'];
    }
  } else {
    // Add date time string to the beginning of the file name

    $date_time_string = date("y-m-d-H-i");
    $new_post_image = $date_time_string . "-" . $post_image;



    move_uploaded_file($post_image_temp, "../assets/blogMedia/$new_post_image");

    // Update $post_image variable to store the new file name in the database
    $post_image = $new_post_image;
  }


  $query = "UPDATE posts SET ";
  $query .= "post_title  = ? , ";
  $query .= "post_slug  = ? , ";
  $query .= "post_cat_id = ? , ";
  $query .= "post_date   = now(), ";
  $query .= "post_author = ? , ";
  $query .= "post_status = ? , ";
  $query .= "post_tags   = ? , ";
  $query .= "post_intro  = ? , ";
  $query .= "post_content= ? , ";
  $query .= "post_url    = ? , ";
  $query .= "post_image  = ? ";
  $query .= "WHERE post_id = ? ";


  $stmt = $pdo->prepare($query);
  $stmt->bindParam(1, $post_title, PDO::PARAM_STR);
  $stmt->bindParam(2, $slug, PDO::PARAM_STR);
  $stmt->bindParam(3, $post_category_id, PDO::PARAM_INT);
  $stmt->bindParam(4, $post_author, PDO::PARAM_STR);
  $stmt->bindParam(5, $post_status, PDO::PARAM_STR);
  $stmt->bindParam(6, $post_tags, PDO::PARAM_STR);
  $stmt->bindParam(7, $post_intro, PDO::PARAM_STR);
  $stmt->bindParam(8, $post_content, PDO::PARAM_STR);
  $stmt->bindParam(9, $post_url, PDO::PARAM_STR);

  $stmt->bindParam(10, $post_image, PDO::PARAM_STR);
  $stmt->bindParam(11, $post_id, PDO::PARAM_INT);
  $stmt->execute();


  echo '
  
  <label for="rj-modal" class="rj-modal-background"></label>
<div class="rj-modal">
	<div class="modal-header">
		<h3>Post updated!</h3>
        <label for="rj-modal">
        	<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAdVBMVEUAAABNTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU0N3NIOAAAAJnRSTlMAAQIDBAUGBwgRFRYZGiEjQ3l7hYaqtLm8vsDFx87a4uvv8fP1+bbY9ZEAAAB8SURBVBhXXY5LFoJAAMOCIP4VBRXEv5j7H9HFDOizu2TRFljedgCQHeocWHVaAWStXnKyl2oVWI+kd1XLvFV1D7Ng3qrWKYMZ+MdEhk3gbhw59KvlH0eTnf2mgiRwvQ7NW6aqNmncukKhnvo/zzlQ2PR/HgsAJkncH6XwAcr0FUY5BVeFAAAAAElFTkSuQmCC" width="16" height="16" alt="" onclick="closeModal()">
        </label>
    </div>
    <p>
    <a href="' . $root_url . '/blogpost/' . $slug . '" class="rj-modal-btn">View Post on site</a>
    </p>
    <p>
    <a href="posts.php" class="rj-modal-btn">Go back to all posts table</a>
    </p>
    <p>
    <a href="#" onclick="closeModal()" class="rj-modal-btn">Close and stay on this page</a>
    </p>
</div>
  
  ';
}



?>






<form action="" method="post" enctype="multipart/form-data" class="form responsive-width-100">


  <div class="form-group">
    <label for="title">Post Title</label>
    <input value="<?php echo htmlspecialchars(stripslashes($post_title)); ?>" type="text" class="form-control" name="post_title">
  </div>

  <div class="form-group">
    <label for="categories">Categories</label>
    <select name="post_category" id="">

      <?php
      $stmt = $pdo->query('SELECT * FROM categories');
      while ($row = $stmt->fetch()) {
        $cat_id = $row['id'];
        $cat_title = $row['title'];
        if ($cat_id == $post_category_id) {


          echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
        } else {

          echo "<option value='{$cat_id}'>{$cat_title}</option>";
        }
      }
      ?>


    </select>

  </div>

  <!-- <div class="form-group">
    <label for="users">Users</label>
    <select name="post_user" id="">


      <?php
      //  echo "<option value=" . $post_author . ">" . $post_author . "</option>";
      ?>

    </select>

  </div> -->
  <!-- <div class="form-group">
    <select name="post_status" id="">

      <option value=' -->
  <?php
  // echo $post_status 
  ?>
  <!-- '> -->
  <?php
  //  echo $post_status; 
  ?>
  <!-- </option> -->
  <?php
  // echo ($post_status == 'published') ? "<option value='draft'>Draft</option>"
  //   : "<option value='published'>Publish</option>";
  ?>
  <!-- </select>
  </div> -->

  <div class="form-group">

    <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
    <input type="file" name="image">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_intro">Post Content</label>
    <textarea class="form-control " name="post_intro" id="body" cols="30" rows="10">
      <?php echo trim($post_intro); ?>
    </textarea>
  </div>
  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control " name="post_content" id="post_content" cols="30" rows="10">
      <?php echo trim($post_content); ?>
    </textarea>
  </div>


  <div class="form-group">
    <label for="post_url">reference URL</label>
    <input value="<?php echo $post_url; ?>" type="text" class="form-control" name="post_url">
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
  </div>


</form>

<script>
  modalBg = document.querySelector('.rj-modal-background');
  modal = document.querySelector('.rj-modal');

  function closeModal() {
    modalBg.style.display = "none";
    modal.style.display = "none";

  }
</script>

<script>
  const example_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.withCredentials = false;
    xhr.open('POST', 'postAcceptor.php');

    xhr.upload.onprogress = (e) => {
      progress(e.loaded / e.total * 100);
    };

    xhr.onload = () => {
      if (xhr.status === 403) {
        reject({
          message: 'HTTP Error: ' + xhr.status,
          remove: true
        });
        return;
      }

      if (xhr.status < 200 || xhr.status >= 300) {
        reject('HTTP Error: ' + xhr.status);
        return;
      }

      const json = JSON.parse(xhr.responseText);

      if (!json || typeof json.location != 'string') {
        reject('Invalid JSON: ' + xhr.responseText);
        return;
      }

      resolve(json.location);
    };

    xhr.onerror = () => {
      reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
    };

    const formData = new FormData();
    formData.append('file', blobInfo.blob(), blobInfo.filename());

    xhr.send(formData);
  });
  tinymce.init({
    selector: '#post_content', // Replace "#post_content" with the ID or class of the textarea where you want to enable TinyMCE
    height: 600, // Set the height of the editor as needed
    plugins: 'link image code fontsizeselect formatselect', // Add any additional plugins you want to use
    toolbar: 'image | bold italic underline | link |  fontsizeselect | formatselect',
    images_upload_handler: example_image_upload_handler


    // images_upload_handler: function (blobInfo, success, failure) {
    //             let xhr, formData;
    //             xhr = new XMLHttpRequest();
    //             xhr.withCredentials = false;
    //             xhr.open('POST', 'postMediaUpload.php'); 
    //             xhr.onload = function() {
    //               console.log("xhr onload");
    //                 var json;

    //                 if (xhr.status !== 200) {
    //                     failure('HTTP Error: ' + xhr.status);
    //                     return;
    //                 }
    //                 console.log("kjjs" , xhr.responseText);
    //                 json = JSON.parse(xhr.responseText);

    //                 if (!json || typeof json.location !== 'string') {
    //                     failure('Invalid JSON: ' + xhr.responseText);
    //                     return;
    //                 }
    //                 console.log("successsss")

    //                 success(json.location);
    //             };
    //             formData = new FormData();
    //             formData.append('post_images[]', blobInfo.blob(), blobInfo.filename());
    //             console.log("formdata", formData);
    //             xhr.send(formData);
    //         }
  });
</script>


<?= template_admin_footer() ?>