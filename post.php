<?php
include 'functions.php';
// Connect to MySQL
$pdo = pdo_connect_mysql();


if (isset($_GET['p_id'])) {

  $the_post_id = $_GET['p_id'];


  //todo toPDO
  // $update_statement = mysqli_prepare($connection, "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = ?");
  // mysqli_stmt_bind_param($update_statement, "i", $the_post_id);
  // mysqli_stmt_execute($update_statement);

  $stmt = $pdo->prepare('UPDATE posts SET post_views = post_views + 1 WHERE post_id = ?');
  $stmt->bindParam(1, $the_post_id, PDO::PARAM_INT);
  $stmt->execute();

  // $stmt2 = mysqli_prepare($connection , "SELECT post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_id = ? AND post_status = ? ");
  // mysqli_stmt_bind_param($stmt2, "is", $the_post_id, $published);
  // mysqli_stmt_execute($stmt2);
  // mysqli_stmt_bind_result($stmt2, $post_title, $post_author, $post_date, $post_image, $post_content);
  // $stmt = $stmt2;

  $published = 'published';

  $stmt = $pdo->prepare('SELECT * FROM posts WHERE post_id = ? AND post_status = ? ');
  $stmt->bindParam(1, $the_post_id, PDO::PARAM_INT);
  $stmt->bindParam(2, $published, PDO::PARAM_STR);
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $date = new DateTime($row['post_date']);
    $post_tags = $row['post_tags'];

    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_url = $row['post_url'];

    $post_views = $row['post_views'];
  }


  // Format the date as "Woensdag 17 april 2023"
  if (version_compare(PHP_VERSION, '8.1.0') >= 0) {
    $formatter = new IntlDateFormatter('nl_NL', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
    $formatted_date = ucfirst($formatter->format($date));
  } else {
    setlocale(LC_TIME, 'nl_NL'); // set the locale to Dutch
    $formatted_date = ucfirst(strftime('%A %e %B %Y', $date->getTimestamp())); // use strftime for PHP versions below 8.1.0
  }

  // Calculate the difference in days between the post date and today
  $today = new DateTime();
  $diff = $today->diff($date)->days;

  // Determine how long ago the post was made
  if ($diff == 0) {
    $time_ago = 'Vandaag';
  } elseif ($diff == 1) {
    $time_ago = 'Gisteren';
  } elseif ($diff < 7) {
    $time_ago = $diff . ' dagen geleden';
  } elseif ($diff == 7) {
    $time_ago = '1 week geleden';
  } elseif ($diff < 30) {
    $time_ago = ceil($diff / 7) . ' weken geleden';
  } elseif ($diff == 30) {
    $time_ago = '1 maand geleden';
  } elseif ($diff < 365) {
    $time_ago = ceil($diff / 30) . ' maanden geleden';
  } elseif ($diff == 365 || $diff < 730) {
    $time_ago = '1 jaar geleden';
  } else {
    $time_ago = 'meer dan een jaar geleden';
  }

  // Combine the formatted date and time ago into one string
  $outputDateInfo = $formatted_date . ' (' . $time_ago . ')';



?>
  <?= template_header($post_title) ?>
  </head>

  <body>
    <?= template_nav() ?>



    <main class="blog-post-main">
      <div class="home-wrapper">
        <section class="container blog-post-page">

          <article class="blog-item">

            <header class="blog-item-header">
              <h1 class="blog-item-title"><?= $post_title; ?></h1>
              <p>Gepost door <?= $post_author ?> op <?= $outputDateInfo ?> - <?= $post_views; ?> views</p>
              <p class="blog-item-tags"><?= $post_tags ?> </p>
            </header>

            <div class="blog-item-img">
              <img src="assets/blogMedia/<?= $post_image; ?>" alt="<?= $post_title; ?>">
            </div>

            <div class="blog-item-content">
              <?php echo "<div class='blog-item-text'>" . trim($post_content) . "</div>"; ?>
              <?php if ($post_url != null) {
                echo "<p><a href='" . $post_url . "' target='" . "_blank'>"
                  . $post_url . "</a></p>";
              }
              ?>
          </article>



          <?php
          $query = "SELECT * FROM comments WHERE comment_post_id = ? ";
          $query .= "AND comment_status = 'approved' ";
          $query .= "ORDER BY comment_id DESC ";
          // $select_comment_query = mysqli_query($connection, $query);
          $stmt = $pdo->prepare($query);
          $stmt->bindParam(1, $the_post_id, PDO::PARAM_INT);
          $stmt->execute();
          // while ($row = mysqli_fetch_array($select_comment_query)) {
          $count = $stmt->rowCount();
          if ($count !== 0) {
            while ($row = $stmt->fetch()) {
              $comment_date   = $row['comment_date'];
              $comment_content = $row['comment_content'];
              $comment_author = $row['comment_author'];
          ?>
              <div class="blog-item blog-comment">
                <header class="blog-item-header">
                  <p>
                    <small>

                      <i class="fa-regular fa-message"></i> reactie van <?= ucfirst($comment_author); ?> - <?= $comment_date; ?>
                    </small>
                  </p>
                </header>
                <div class="blog-item-content">
                  <p><?= $comment_content; ?></p>
                </div>
              </div>
            <?php
            }
          } else {
            ?>
            <div class="blog-item">

              <header class="blog-comment">
                <p>Nog geen reacties</p>
              </header>

            </div>
        <?php
          }
        } else {
          header("Location: index.php");
        }
        ?>











        <aside class="form-container">
          <div class="form-header">
            <h3>Plaats een reactie:</h3>
          </div>
          <form method="POST" role="form" class="form">
            <div class="form-group">
              <label for="Author">Je naam</label>
              <input type="text" name="comment_author" class="form-control" name="comment_author">
            </div>
            <div class="form-group">
              <label for="Author">E-mail</label>
              <input type="email" name="comment_email" class="form-control" name="comment_email">
            </div>
            <div class="form-group">
              <label for="comment">Je reactie</label>
              <textarea name="comment_content" class="form-control" rows="5"></textarea>
            </div>
            <button type="submit" name="create_comment" class="btn btn--accent">Verstuur</button>
          </form>
      </div>
      </aside>




      <?php
      if (isset($_POST['create_comment'])) {

        $the_post_id = $_GET['p_id'];
        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];


        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
          $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status,comment_date)";
          // $query .= "VALUES ($the_post_id ,'{$comment_author}', '{$comment_email}', '{$comment_content }', 'unapproved',now())";
          $query .= "VALUES (? , ? , ? , ? , 'unapproved' , now())";
          // $create_comment_query = mysqli_query($connection, $query);

          $stmt = $pdo->prepare($query);
          $stmt->bindParam(1, $the_post_id, PDO::PARAM_INT);
          $stmt->bindParam(2, $comment_author, PDO::PARAM_STR);
          $stmt->bindParam(3, $comment_email, PDO::PARAM_STR);
          $stmt->bindParam(4, $comment_content, PDO::PARAM_STR);
          $stmt->execute();

          echo '
  
        <label for="rj-modal" class="rj-modal-background"></label>
      <div class="rj-modal">
        <div class="rj-modal-header">
          <h3>Reactie verstuurd!</h3>
              <label for="rj-modal">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAdVBMVEUAAABNTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU0N3NIOAAAAJnRSTlMAAQIDBAUGBwgRFRYZGiEjQ3l7hYaqtLm8vsDFx87a4uvv8fP1+bbY9ZEAAAB8SURBVBhXXY5LFoJAAMOCIP4VBRXEv5j7H9HFDOizu2TRFljedgCQHeocWHVaAWStXnKyl2oVWI+kd1XLvFV1D7Ng3qrWKYMZ+MdEhk3gbhw59KvlH0eTnf2mgiRwvQ7NW6aqNmncukKhnvo/zzlQ2PR/HgsAJkncH6XwAcr0FUY5BVeFAAAAAElFTkSuQmCC" width="16" height="16" alt="" onclick="closeModal()">
              </label>
          </div>
           <p>
           Bedankt!<br>
          Je reactie zal na goedkeuring worden geplaatst.
          </p>
          <p>
          <a href="" onclick="closeModal()" class="rj-modal-btn">Ga terug</a>
          </p>
      </div>
        
        ';



      ?>
          <script>
            commentForm.style.display = "none";
          </script>
      <?php
        }
      }
      ?>



      </div>
      </div>
      </section>
      </div>
    </main>

    <hr>


    <div class="media-popup"></div>
    <script>
      // let commentForm = document.querySelector(".form-wrapper");
      // let commentBtn = document.querySelector(".button");

      // commentBtn.addEventListener('click', function() {
      //   commentForm.style.display = "flex";
      //   commentBtn.style.display = "none";
      // })

      let modalBg = document.querySelector('.rj-modal-background');
      let modal = document.querySelector('.rj-modal');

      function closeModal() {
        modalBg.style.display = "none";
        modal.style.display = "none";

      }
    </script>

    <?= template_footer() ?>