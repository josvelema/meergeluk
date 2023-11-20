<?php
include 'main.php';


// SQL query that will retrieve all the posts from the database ordered by the ID column
$stmt = $pdo->prepare('SELECT * FROM posts ORDER BY post_id DESC');
$stmt->execute();
$media = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['delete'])) {
  $stmt = $pdo->prepare('DELETE p, pc FROM posts p LEFT JOIN comments pc ON pc.comment_post_id = p.post_id WHERE p.post_id = ?');
  $stmt->bindParam(1, $_GET['delete'], PDO::PARAM_INT);
  $stmt->execute();

  header("Location: posts.php");
}


if (isset($_GET['reset'])) {
  $stmt = $pdo->prepare('UPDATE posts SET post_views = 0 WHERE post_id = ? ');
  $stmt->bindParam(1, $_GET['reset'], PDO::PARAM_INT);
  $stmt->execute();

  header("Location: posts.php");
}

?>

<?= template_admin_header('All posts', 'posts') ?>

<form action="" method="post">
  <label class="my-custom-checkbox">
    <input type="checkbox" class="my-checkbox-input">
    <span class="my-checkbox-indicator"></span>
  </label>
</form>
<style>
.my-custom-checkbox {
  --custom-color: #26a69a;
  position: relative;
}

.my-checkbox-input {
  display: none;
}

.my-checkbox-input:checked ~ .my-checkbox-indicator {
  background-color: var(--custom-color);
  border-color: var(--custom-color);
  background-size: 80%;
}

.my-checkbox-indicator {
  border-radius: 3px;
  display: inline-block;
  position: absolute;
  top: 4px;
  left: 0;
  width: 16px;
  height: 16px;
  border: 2px solid #aaa;
  transition: .3s;
  background: transparent;
  background-size: 0%;
  background-position: center;
  background-repeat: no-repeat;
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3E%3C/svg%3E");
}

</style>
<script>
  document.addEventListener("DOMContentLoaded", function() {
  const checkboxes = document.querySelectorAll('.my-checkbox-input');

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      const indicator = this.nextElementSibling;
      if (this.checked) {
        indicator.style.backgroundSize = '80%';
      } else {
        indicator.style.backgroundSize = '0%';
      }
    });
  });
});

</script>
  <div id="bulkOptionContainer">

    <select class="form-control" name="bulk_options" id="">
      <option value="">Select Bulk operation</option>
      <option value="published">Publish</option>
      <option value="draft">Draft</option>
      <option value="delete">Delete</option>
      <option value="clone">Clone</option>
    </select>

  </div>
<h2>All Posts</h2>

<?php
// include("delete_modal.php");
if (isset($_POST['checkBoxArray'])) {



  foreach ($_POST['checkBoxArray'] as $postValueId) {

    $bulk_options = $_POST['bulk_options'];

    switch ($bulk_options) {
      case 'published':
        // $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";
        // $update_to_published_status = mysqli_query($connection, $query);
        // confirmQuery($update_to_published_status);

        $stmt = $pdo->prepare('UPDATE posts SET post_status = ? WHERE post_id = ?');
        $stmt->bindParam(1, $bulk_options, PDO::PARAM_STR);
        $stmt->bindParam(2, $postValueId, PDO::PARAM_STR);
        $stmt->execute();

        // while ($row = $stmt->fetch()) {
        //   $post_title = $row['post_title'];
        //   $post_author = $row['post_author'];
        //   $post_date = $row['post_date'];
        //   $post_image = $row['post_image'];
        //   $post_content = $row['post_content'];
        //   $post_views = $row['post_views_count'];
        // }
        break;
      case 'draft':
        $stmt = $pdo->prepare('UPDATE posts SET post_status = ? WHERE post_id = ?');
        $stmt->bindParam(1, $bulk_options, PDO::PARAM_STR);
        $stmt->bindParam(2, $postValueId, PDO::PARAM_STR);
        $stmt->execute();
        break;



      case 'delete':
        // $query = "DELETE FROM posts WHERE post_id = {$postValueId}  ";
        $stmt = $pdo->prepare('DELETE FROM posts  WHERE post_id = ?');
        $stmt->bindParam(1, $postValueId, PDO::PARAM_STR);
        $stmt->execute();
        break;
      case 'clone':

        $stmt = $pdo->prepare('SELECT * FROM posts WHERE post_id = ? ');
        $stmt->bindParam(1, $postValueId, PDO::PARAM_STR);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
          $post_category_id   = $row['post_cat_id'];
          $post_title         = $row['post_title'];
          $post_author        = $row['post_author'];
          $post_date          = $row['post_date'];
          $post_image         = $row['post_image'];
          $post_content       = $row['post_content'];
          $post_tags          = $row['post_tags'];
          $post_status        = $row['post_status'];
        }

        $query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date,post_image,post_content,post_tags,post_status) ";
        $query .= "VALUES(? , ? , ? , now() , ? , ? , ? , ?') ";
        // $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $post_cat_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $post_title, PDO::PARAM_STR);
        $stmt->bindParam(3, $post_author, PDO::PARAM_STR);
        $stmt->bindParam(4, $post_image, PDO::PARAM_STR);
        $stmt->bindParam(5, $post_content, PDO::PARAM_STR);
        $stmt->bindParam(6, $post_tags, PDO::PARAM_STR);
        $stmt->bindParam(7, $post_status, PDO::PARAM_STR);
        $stmt->execute();
        break;
    }
  }
}




?>




<form action="" method="post">
  <label class="my-custom-checkbox">
    <input type="checkbox" class="my-checkbox-input">
    <span class="my-checkbox-indicator"></span>
  </label>
</form>
<style>
.my-custom-checkbox {
  --custom-color: #26a69a;
  position: relative;
}

.my-checkbox-input {
  display: none;
}

.my-checkbox-input:checked ~ .my-checkbox-indicator {
  background-color: var(--custom-color);
  border-color: var(--custom-color);
  background-size: 80%;
}

.my-checkbox-indicator {
  border-radius: 3px;
  display: inline-block;
  position: absolute;
  top: 4px;
  left: 0;
  width: 16px;
  height: 16px;
  border: 2px solid #aaa;
  transition: .3s;
  background: transparent;
  background-size: 0%;
  background-position: center;
  background-repeat: no-repeat;
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3E%3C/svg%3E");
}

</style>
<script>
  document.addEventListener("DOMContentLoaded", function() {
  const checkboxes = document.querySelectorAll('.my-checkbox-input');

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      const indicator = this.nextElementSibling;
      if (this.checked) {
        indicator.style.backgroundSize = '80%';
      } else {
        indicator.style.backgroundSize = '0%';
      }
    });
  });
});

</script>
  <div id="bulkOptionContainer">

    <select class="form-control" name="bulk_options" id="">
      <option value="">Select Bulk operation</option>
      <option value="published">Publish</option>
      <option value="draft">Draft</option>
      <option value="delete">Delete</option>
      <option value="clone">Clone</option>
    </select>

  </div>



  <div class="rj-flexer">
    <a class="btn" href="addpost.php">Create Blog Post</a>
    <div>
      <span><small>selecteer posts voor bulk</small></span>
      <input type="submit" name="submit" class="btn btn-success" value="Uitvoeren">
    </div>


  </div>

  <table class="jostable ">
    <thead>
      <tr>
        <!-- <th><input id="selectAllBoxes" type="checkbox"></th>         -->
        <th>
          <label for="checker">Post</label>
          <input type="checkbox" onClick="toggle(this)" id="checker" />
        </th>


        <th>Title</th>
        <th>Date / Blog</th>


        <th>image</th>
        <th>content</th>

        <th>views</th>
        <th>reactions</th>
        <th>actions</th>
      </tr>
    </thead>
    <tbody>


      <?php
      $stmt = $pdo->query('SELECT * FROM posts ORDER BY post_id DESC ');
      foreach ($stmt as $key => $row) {

        $post_id            = $row['post_id'];
        $post_author        = $row['post_author'];
        $post_title         = $row['post_title'];
        $post_slug         = $row['post_slug'];
        $post_category_id   = $row['post_cat_id'];
        $post_status        = $row['post_status'];
        $post_date          = date('d/m/y', strtotime($row['post_date']));
        $post_image         = $row['post_image'];
        $post_thumb         = $row['post_thumb'];
        $post_content       = $row['post_content'];
        $post_content_short = substr($post_content, 0, 100);

        $post_tags          = $row['post_tags'];
        $post_views         = $row['post_views'];
        $post_comment_count = $row['post_comment_count'];
      ?>
        <tr>
          <td class="rj-td-first">
            <input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?= $post_id ?>'>
            <?= $post_id ?>
          </td>
          <td>
            <?= $post_title ?>
            <br>
            <a href="https://www.meergeluk.com/blogpost/<?= $post_slug ?>" class="copy-link" id="copyLink<?= $key ?>">Copy link</a>
    <span class="rj-tooltip" id="rj-tooltip<?= $key ?>">Copied!</span>
        </td>

          <td>
            <?php
            // todo make function
            $stmt = $pdo->prepare('SELECT * FROM categories WHERE id = ?');
            $stmt->bindParam(1, $post_category_id, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
              $cat_id = $row['id'];
              $cat_title = $row['title'];
              echo  $post_date . "<br>" . $cat_title;
            }
            ?>
          </td>

          <td>
            <img width="100" src="../assets/blogMedia/<?= ($cat_title !== 'Blog') ? $post_thumb : $post_image ?>" alt='<?= $post_title ?>' loading="lazy">
          </td>

          <td>
            <div class='rj-td-wrap'><?= $post_content ?> </div>
          </td>

          <?php
          // todo make function
          $stmt = $pdo->prepare('SELECT * FROM comments WHERE comment_post_id = ?');
          $stmt->bindParam(1, $post_id, PDO::PARAM_INT);
          $stmt->execute();
          $count_comments = $stmt->rowCount();
          ?>

          <td>
            <?= $post_views ?>
            <br>
            <a href='#' onClick='resetViewsModal($post_id)'>reset</a>
          </td>

          <td>
            <?= $count_comments ?>
          </td>

          <td class='rj-action-td'>
            <a href='editpost.php?&p_id=<?= $post_id ?>' class='rj-action-edit'>Edit</a>

            <a href='#' onClick='deleteModal(<?= $post_id ?>)' class='rj-action-del'>Del</a>
          </td>

        </tr>

      <?php
      };
      ?>

    </tbody>
  </table>
</form>

<div class="delModalWrap"></div>
<div class="resetViewsModalWrap"></div>




<script>

      
  document.addEventListener("DOMContentLoaded", function() {
    // Get all elements with class="copy-link"
    const copyLinks = document.querySelectorAll('.copy-link');

    copyLinks.forEach((copyLink, index) => {
        copyLink.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default action (navigation)
            
            // Get the href attribute
            const link = copyLink.getAttribute('href');
            
            // Copy to clipboard
            navigator.clipboard.writeText(link).then(() => {
                // Show tooltip
                const tooltip = document.getElementById(`rj-tooltip${index}`);
                tooltip.classList.add('rj-tooltip-visible')
                
                // Hide tooltip after 2 seconds
                setTimeout(() => {
                  tooltip.classList.remove('rj-tooltip-visible')

                }, 2000);
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        });
    });
});


  function toggle(source) {
    checkboxes = document.getElementsByName('checkBoxArray[]');
    for (var i = 0, n = checkboxes.length;; i++) {
      checkboxes[i].checked = source.checked;
    }
  }

  modalBg = document.querySelector('.rj-modal-background');
  modal = document.querySelector('.rj-modal');
  delModal = document.querySelector('.delModalWrap');
  resetModal = document.querySelector('.resetViewsModalWrap');


  let delModalContent = `<label for="rj-modal" class="rj-modal-background"></label>
          <div class="rj-modal">
          <div class="modal-header">
          <h3>Confirm deletion</h3>
            <label for="rj-modal">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAdVBMVEUAAABNTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU0N3NIOAAAAJnRSTlMAAQIDBAUGBwgRFRYZGiEjQ3l7hYaqtLm8vsDFx87a4uvv8fP1+bbY9ZEAAAB8SURBVBhXXY5LFoJAAMOCIP4VBRXEv5j7H9HFDOizu2TRFljedgCQHeocWHVaAWStXnKyl2oVWI+kd1XLvFV1D7Ng3qrWKYMZ+MdEhk3gbhw59KvlH0eTnf2mgiRwvQ7NW6aqNmncukKhnvo/zzlQ2PR/HgsAJkncH6XwAcr0FUY5BVeFAAAAAElFTkSuQmCC" width="16" height="16" alt="" onclick="closeDelModal()">
            </label>
            </div>
            <p>
            Delete post?<br>
            `;

  let resetViewsContent = `<label for="rj-modal" class="rj-modal-background"></label>
          <div class="rj-modal">
          <div class="modal-header">
          <h3>Confirm reset</h3>
            <label for="rj-modal">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAdVBMVEUAAABNTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU0N3NIOAAAAJnRSTlMAAQIDBAUGBwgRFRYZGiEjQ3l7hYaqtLm8vsDFx87a4uvv8fP1+bbY9ZEAAAB8SURBVBhXXY5LFoJAAMOCIP4VBRXEv5j7H9HFDOizu2TRFljedgCQHeocWHVaAWStXnKyl2oVWI+kd1XLvFV1D7Ng3qrWKYMZ+MdEhk3gbhw59KvlH0eTnf2mgiRwvQ7NW6aqNmncukKhnvo/zzlQ2PR/HgsAJkncH6XwAcr0FUY5BVeFAAAAAElFTkSuQmCC" width="16" height="16" alt="" onclick="closeResetModal()" style="cursor: pointer">
            </label>
            </div>
            <p>
            reset Views?<br>
            `;


  function deleteModal(id) {
    let post_id = id;
    let link = `<a href="posts.php?delete=` + post_id + `" class="rj-modal-btn">Confirm</a><br><a href="posts.php" onClick="closeDelModal()" class="rj-modal-btn">Cancel</a> </p></div>`
    document.querySelector(".delModalWrap").innerHTML = delModalContent + link;
  }

  function resetViewsModal(id) {
    let post_id = id;
    let link = `<a href="posts.php?reset=` + post_id + `" class="rj-modal-btn">Confirm</a><br><a href="posts.php" onClick="closeResetModal()" class="rj-modal-btn">Cancel</a> </p></div>`
    document.querySelector(".resetViewsModalWrap").innerHTML = resetViewsContent + link;
  }

  function closeDelModal() {
    delModal.style.display = "none";

  }

  function closeResetModal() {
    resetModal.style.display = "none";

  }

</script>






<?php if (isset($_SESSION['message'])) {

  unset($_SESSION['message']);
}

?>


<?= template_admin_footer() ?>