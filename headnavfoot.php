<?php
// Set the time period for which the page should be cached (in seconds)
$cache_time = 60; // 3600 1 hour

// Get the last modified time of the page
$last_modified = filemtime(__FILE__);

// Set the cache control headers
header("Cache-Control: public, max-age=$cache_time");
header("Expires: " . gmdate('D, d M Y H:i:s', time() + $cache_time) . ' GMT');
header("Last-Modified: " . gmdate('D, d M Y H:i:s', $last_modified) . ' GMT');

// Check if the browser has a cached version of the page
if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) || isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
    header('HTTP/1.1 304 Not Modified');
    exit;
}
// Template header, feel free to customize this
function template_header($title)
{
    echo <<<EOT
    <!DOCTYPE html>
    <html lang="nl">
    
    <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="theme-color" content="#050307" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Meer geluk</title>
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&family=Libre+Franklin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
      <link rel="stylesheet" href="./assets/css/style.css?v=28" />
    EOT;
}
function template_header_other()
{
    echo <<<EOT
    <link href="assets/css/painting.css?v=4" rel="stylesheet" type="text/css">
    <link href="assets/css/science.css?v=4" rel="stylesheet" type="text/css">
EOT;
}

link:
function template_nav()
{

echo <<<EOT
            <nav>
            <div class="nav-container">
            <a href="/"" class=" btn btn--home" aria-label="Go to homepage" aria-current="page">
                <i class="fa-solid fa-house"></i>
                <span>home</span>
            </a>



            <div class="nav-wrapper">
                <button class="btn btn--menu" id="menu-btn" aria-expanded="false" aria-controls="menu"
                aria-label="Open mobile navigation">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.25"
                    stroke="currentColor" class="w-6 h-6" width="32" height="32">
                    <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                </svg>
                </button>
                <ul class="nav-links" id="menu" role="menubar">
                <!-- <li role="none">
                    <a href="overmij.html" class="nav-link btn" role="menuitem">
                    Over mij</a>
                </li> -->
                <li role="none" class="dropdown">
                    <button class="dropdown-toggle " role="menuitem" aria-haspopup="true" aria-expanded="false"
                    id="coaching-dropdown">
                    Coaching & Begeleiding&nbsp;
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="dropdown-arrow"
                        width="18" height="18">
                        <path fill-rule="evenodd"
                            d="M4.293 7.293a1 1 0 011.414 0L10 11.586l4.293-4.293a1 1 0 011.414 1.414l-5 5a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                        </svg>
                    </span>
                    </button>
                    <ul class="dropdown-menu" id="coaching-dropdown-menu" role="menu" aria-labelledby="coaching-dropdown">
                    <li role="none">
                        <a href="eigengeluk.html" class="dropdown-item btn" role="menuitem">Eigen Geluk</a>
                    </li>
                    <li role="none">
                        <a href="relatiegeluk.html" class="dropdown-item btn" role="menuitem">Relatie Geluk</a>
                    </li>
                    <li role="none">
                        <a href="werkgeluk.html" class="dropdown-item btn" role="menuitem">Werk Geluk</a>
                    </li>
                    <li role="none">
                        <a href="creatiefgeluk.html" class="dropdown-item btn" role="menuitem">Creatief Geluk</a>
                    </li>
                    <hr>
                    <li role="none">
                        <a href="overmij.html" class="dropdown-item btn" role="menuitem">Over mij</a>
                    </li>
                    <li role="none">
                        <a href="tarieven.html" class="dropdown-item btn" role="menuitem">Tarieven</a>
                    </li>
                    <li role="none">
                        <a href="gratis.html" class="dropdown-item btn" role="menuitem">Gratis Geluk</a>
                    </li>
                    </ul>
                </li>
                <li role="none">
                    <a href="/blog.html" class="nav-link btn" role="menuitem">
                    Blog</a>
                </li>

                <li role="none">
                    <a href="contact.html" class="nav-link btn btn--accent" role="menuitem">
                    Contact</a>
                </li>
                </ul>
            </div>
            </div>
            </nav>

            EOT;
}
// <a href="music.php" id="music"><i class="fa-solid fa-music"></i>Music</a>
// <a href="gallery.php" id="gallery"><i class="fas fa-photo-video"></i>Gallery</a>

// Template footer
function template_footer()
{
    echo <<<EOT
    <footer>
    <div class="footer-certificat">
      <img src="assets/img/certificaten2.png" alt="Certificaten">
    </div>
    <div class="footer-wrapper">
      <div class="footer-column">
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro reiciendis quibusdam aut!
      </div>
      <div class="footer-column">
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro reiciendis quibusdam aut!
      </div>
    </div>
    <p class="codette">Designed & Developped by Codette web & media - 2023</p>

  </footer>
  <script src="assets/js/nav.js" type="module"></script>
  <script src="assets/js/joscript.js"></script>

  <script src="assets/js/reviews.js"></script>
  <script>
    function scrollToContent() {
      var section = document.getElementById("scrollDown");
      section.scrollIntoView({ behavior: "smooth" });
    }

    fetchReviews()


  </script>
</body>

</html>
EOT;
}
