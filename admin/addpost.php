<?php
include 'main.php';

// SQL query that will retrieve all the posts from the database ordered by the ID column
$stmt = $pdo->prepare('SELECT * FROM posts ORDER BY post_id DESC');
$stmt->execute();
$media = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?= template_admin_header('Add Blog Post', 'posts') ?>

<h2>Add Blog Post</h2>

<?php
if (isset($_POST['create_post'])) {

  $post_title        = ($_POST['title']);
  $post_category_id  = ($_POST['post_category']);
  // $post_status       = ($_POST['post_status']);
  $post_status       = "published";


  $post_image        = ($_FILES['image']['name']);
  $post_image_temp   = ($_FILES['image']['tmp_name']);


  $post_tags         = ($_POST['post_tags']);

  $post_content = str_replace("../assets", "assets", ($_POST['post_content']));

  $post_intro      = ($_POST['post_intro']);
  $post_url      = ($_POST['post_url']);

  $post_date         = (date('d-m-y'));



   // Add date time string to the beginning of the file name
   $date_time_string = date("y-m-d-H-i");
   $new_post_image = $date_time_string . "-" . $post_image;
 
   move_uploaded_file($post_image_temp, "../assets/blogMedia/$new_post_image");
 
   
   $post_image = $new_post_image;


  //todo 1 user ???
  $sabine = "Sabine";
  $query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date,post_image,post_intro,post_content,post_url,post_tags,post_status) ";
  $query .= "VALUES(? , ? , ? , now() , ? , ? , ? , ? , ? , ?) ";

  $stmt = $pdo->prepare($query);
  $stmt->bindParam(1, $post_category_id, PDO::PARAM_INT);
  $stmt->bindParam(2, $post_title, PDO::PARAM_STR);
  $stmt->bindParam(3, $sabine, PDO::PARAM_STR);
  $stmt->bindParam(4, $post_image, PDO::PARAM_STR);
  $stmt->bindParam(5, $post_intro, PDO::PARAM_STR);
  $stmt->bindParam(6, $post_content, PDO::PARAM_STR);
  
  $stmt->bindParam(7, $post_url, PDO::PARAM_STR);
  $stmt->bindParam(8, $post_tags, PDO::PARAM_STR);
  $stmt->bindParam(9, $post_status, PDO::PARAM_STR);
  $stmt->execute();

  $the_post_id = $pdo->lastInsertId();

  
  echo '
  
  <label for="rj-modal" class="rj-modal-background"></label>
<div class="rj-modal">
	<div class="modal-header">
		<h3>Post Added to blog!</h3>
        <label for="rj-modal">
        	<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAdVBMVEUAAABNTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU0N3NIOAAAAJnRSTlMAAQIDBAUGBwgRFRYZGiEjQ3l7hYaqtLm8vsDFx87a4uvv8fP1+bbY9ZEAAAB8SURBVBhXXY5LFoJAAMOCIP4VBRXEv5j7H9HFDOizu2TRFljedgCQHeocWHVaAWStXnKyl2oVWI+kd1XLvFV1D7Ng3qrWKYMZ+MdEhk3gbhw59KvlH0eTnf2mgiRwvQ7NW6aqNmncukKhnvo/zzlQ2PR/HgsAJkncH6XwAcr0FUY5BVeFAAAAAElFTkSuQmCC" width="16" height="16" alt="" onclick="closeModal()">
        </label>
    </div>
    ' ;

  if ($post_status == 'published') {

    echo '
    <p>
    <a href="../post.php?p_id=' . $the_post_id . '">View Post on site</a>
    </p>
    '; 
  };
  echo '
    <p>
    <a href="posts.php">Go back to all posts table</a>
    </p>
    <p>
    <a href="#" onclick="closeModal()">Close and stay on this page</a>
    </p>
</div>
  
  ';

}




?>

<form action="" method="post" enctype="multipart/form-data" class="form responsive-width-100">


  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
  </div>

  <div class="form-group">
    <label for="category">Category</label>
    <select name="post_category" id="">

      <?php
      $stmt = $pdo->query('SELECT * FROM categories');
      while ($row = $stmt->fetch()) {
        $cat_id = $row['id'];
        $cat_title = $row['title'];
        echo "<option value='$cat_id'>{$cat_title}</option>";
      }
      ?>
    </select>
  </div>


  <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="image">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_intro">Post Introductie</label>
    <textarea class="form-control " name="post_intro" id="body" cols="30" rows="10">
        </textarea>
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea name="post_content" id="post_content"></textarea>

  </div>

  <div class="form-group">
    <label for="post_url">URL for reference </label>
    <input type="text" class="form-control" name="post_url">
  </div>



  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
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
      reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
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