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
<?= template_header('Gratis Geluk - Meer Geluk') ?>

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


    <main class="gratis">
      <div class="home-wrapper">
        <section class="full hero-container hero-home">
          <header class="c-header-container ">
            <div id="changeNavColor">
              <div class="header-container rise subheading">
                <img src="assets/img/meerGelukLogoFull3.png" alt="Meer Geluk in je leven, relatie & werk">
                <!-- <h1>Meer <span id="geluk">Geluk</span></h1> -->
                <h2>In je leven <br> relatie & werk</h2>
              </div>
            </div>
            <div class="hero-title">
              <h1>Gratis Geluk</h1>
            </div>
          </header>
        </section>

        <section aria-labelledby="Blog artikelen" class="container">
          <div class="">

            <div class="auto-grid">

            <div class="auto-grid-item auto-grid-item-span">
              <p class="c-larger-p ">Omdat ik iedereen zoveel mogelijk <strong>geluk gun</strong> zal ik hier regelmatig
                <strong>gratis geluksbrengers</strong> plaatsen.
              </p>
              <p>Deze mag je printen, gebruiken, delen en aanraden. Zolang het jouw maar <strong>meer geluk </strong>
                brengt.
              </p>
            </div>

              <?php
              $stmt = $pdo->prepare('SELECT * FROM posts WHERE post_status = ?  AND post_cat_id = 2 ORDER BY post_id DESC LIMIT ? , ?');
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
                $post_content = $row['post_content'];
                $post_url = $row['post_url'];
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


                <article class="auto-grid-item auto-grid-item-span">
                  <div class="blog-item-header">
                    <h2 class="blog-item-title"><?= $post_title ?></h2>

                  </div>

                  <div class="blog-item-content">

                    <?php if (empty($post_intro)) { ?>
                      <p class="blog-item-text"><?= $post_content ?></p>
                    <?php } else { ?>
                      <p class="blog-item-text"><?= $post_intro ?></p>
                      <p class="blog-item-text"><?= $post_content ?></p>
                    <?php } ?>


                    <?php if (strpos($post_image, '.pdf') !== false) { ?>
                      <a href="assets/blogMedia/<?= $post_image ?>" class="blog-item-link" target="_blank">Download hier de PDF</a>
                    <?php } else { ?>
                      <br>

                    <?php } ?>
                    
                    <?php if (isset($post_url) && !empty($post_url)) { ?>
                      <a href=<?= $post_url ?> class="blog-item-link" target="_blank">Meer informatie</a>
                    <?php } else { ?>
                      <br>

                    <?php } ?>




                  </div>

                </article>
            <?php }
            } ?>
            <div class="auto-grid-item">
              <p><strong>TIP!</strong> Kijk ook eens in mijn <a href="blog">blog </a>voor interessante artikelen,
                tips en weetjes over geluk, relatie en werk.
                <br>
                Of volg me via Facebook en Instagram voor wekelijkse inspirerende posts.
              </p>
              <div class="cta-buttons">
                <a href="contact.html" class="btn btn--accent"><i class="fa-brands fa-facebook" target="_blank"></i><span>Facebook</span></a>
                
                <a href="https://www.instagram.com/meer.geluk/" class="btn btn--accent" target="_blank"><i class="fa-brands fa-instagram"></i><span>Instagram</span></a>
                
                <a href="https://www.linkedin.com/in/meer-geluk-961b98274/" class="btn btn--accent" target="_blank"><i class="fa-brands fa-linkedin"></i><span>LinkedIn</span></a>
                




              </div>
            </div>
            <div class="auto-grid-item">
              <p>Wil je snel en effectief aan jezelf of aan je relatie werken en ben je benieuwd naar de mogelijkheden,
                dan is het eerste kennismakingsgesprek bij mij ook 100% gratis en vrijblijvend.
              </p>
              <p>
              <a href="contact" class="btn btn--accent cta-button">Gratis intake-gesprek</a>

            </p>
             

    
            </div>
            <div class="auto-grid-item-span">
            <div class="cta-buttons">
                <a href="contact" class="btn btn--accent"><i class="fa-regular fa-comment-dots"></i><span>Contact</span></a>
                <a href="whatsapp" " class=" btn btn--accent" data-social="whatsapp">
                  <i class="fa-brands fa-whatsapp"></i>
                  <span>WhatsApp</span>
                </a> <a href="tel:061220479"" class=" btn btn--accent">
                  <i class="fa-solid fa-phone"></i>
                  <span>telefoon</span>
                </a>
              </div>
            </div>
            </div>
          </div>

      </div>



      </section>

      </div>
    </main>


    <div class="media-popup"></div>

    <?= template_footer() ?>

</body>

</html>