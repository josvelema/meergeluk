<?php
include 'functions.php';

$currentPage = "blog";
// Connect to MySQL
$pdo = pdo_connect_mysql();
// Retrieve the categories
$stmt = $pdo->prepare('SELECT * FROM categories ORDER BY title');
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Retrieve the requested category

// The current pagination page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

?>
<?= template_header('Blog') ?>

</head>

<body>


  <?= template_nav() ?>


  <?php

  $per_page = 6;


  (isset($_GET['page'])) ? $page = $_GET['page'] : $page = "";

  ($page == "" || $page == 1) ? $page_1 = 0 : $page_1 = ($page * $per_page) - $per_page;

  $stmt = $pdo->query("SELECT * FROM posts WHERE post_status = 'published' AND post_cat_id = 1 ORDER BY post_id DESC");

  $count = $stmt->rowCount();
  $total_posts = $count;

  if ($count < 1) {

    echo "<h1 class='text-center'>Er zijn geen posts</h1>";
  } else {
    $count  = ceil($count / $per_page);
    $published = "published";
  ?>


    <main class="full">
      <div class="home-wrapper">
        <section class="full hero-container hero-home">
          <header class="c-header-container ">
            <div class="hero" id="changeNavColor">
              <div class="header-container rise subheading">
                <div class="header-content">
                  <img src="assets/img/meerGelukLogoFull3.png" alt="Meer Geluk in je leven, relatie & werk">

                  <h1 class="hero-h1">Blog</h1>
                </div>
              </div>

              <aside class="home-cta">
                <p class="c-larger-p">
                  Welkom op de 'Meer Geluk' blog!

                </p>
                <p>
                  Hier vind je compacte, inspirerende artikelen die je helpen geluk te vinden in je leven, relaties en
                  werk. Duik in de wereld van persoonlijke groei en ontdek jouw pad naar een gelukkiger leven. Veel
                  leesplezier!
                </p>
              </aside>

            </div>

          </header>
        </section>
        <aside class="blog-pager">
          <small>Blog posts:
            <?php echo $total_posts . ' | Pagina ' . $current_page . ' van ' . $count; ?>
          </small>
          <ul>
            <span>page </span>
            <?php
            $number_list = array();
            for ($i = 1; $i <= $count; $i++) {
              echo ($i == $page) ? "<li><a class='rj-active-page' href='blog.php?page={$i}'>{$i}</a></li>"
                : "<li><a href='blog.php?page={$i}'>{$i}</a></li>";
            }
            ?>
          </ul>
        </aside>
        <section aria-labelledby="Blog artikelen" class="full">
          <div class="section-wrapper">


            <div data-component class="blog-grid">
              <?php
              $stmt = $pdo->prepare('SELECT * FROM posts WHERE post_status = ?  AND post_cat_id = 1 ORDER BY post_id DESC LIMIT ? , ?');
              $stmt->bindParam(1, $published, PDO::PARAM_STR);
              $stmt->bindParam(2, $page_1, PDO::PARAM_INT);
              $stmt->bindParam(3, $per_page, PDO::PARAM_INT);
              $stmt->execute();

              // while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
              while ($row = $stmt->fetch()) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $date = new DateTime($row['post_date']);
                $post_tags = $row['post_tags'];
                $post_image = $row['post_image'];
                $post_intro = $row['post_intro'];
                // $post_intro = substr($row['post_content'], 0, 250) . "..."; 
                $post_status = $row['post_status'];
                $post_views = $row['post_views'];


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


                <article class="blog-item">
                  <div class="blog-item-header">
                    <h2 class="blog-item-title"><?= $post_title ?></h2>
                    <p>Gepost door <?= $post_author ?> </p>
                    <p><small><?= $outputDateInfo ?> - <?= $post_views; ?> views</small></p>
                    <p class="blog-item-tags"><?= $post_tags ?> </p>
                  </div>

                  <div class="blog-item-img">
                    <img src="assets/blogMedia/<?= $post_image; ?>" alt="<?= $post_title; ?>">
                  </div>

                  <div class="blog-item-content">
                    <p class="blog-item-text"><?= $post_intro ?></p>
                    <a href="post.php?p_id=<?= $post_id ?>" class="blog-item-link">Lees meer</a>

                  </div>

                </article>
            <?php }
            } ?>

            </div>
          </div>

        </section>

      </div>
    </main>


    <div class="media-popup"></div>

    <?= template_footer() ?>