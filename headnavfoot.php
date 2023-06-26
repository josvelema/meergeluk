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

// make an unique id in day,hour,minute,second format

function template_header($title)
{
    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    $unique_id = date('dHis');

    echo <<<EOT
    <!DOCTYPE html>
    <html lang="nl">
    
    <head>
      <!-- Google tag (gtag.js) -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-CH6GHDSSJF"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
      
        gtag('config', 'G-CH6GHDSSJF');
      </script>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Meer Geluk biedt professionele coaching voor je leven, relatie en werk. Ontdek hoe je meer geluk kunt ervaren met de hulp van Sabine Bezemer, een ervaren relatie- en levenscoach en kunstzinnig therapeut."> 
      <meta name="keywords" content="relatie therapie, trauma therapie, loopbaan begeleiding, werk coach, relatiecoach, relatietherapeut, levenscoach, gelukscoach, therapeut, coaching, begeleiding, relatieproblemen, burn-out, stress, depressief, ongelukkig, gratis intake gesprek, Papendrecht, Dordrecht, Zuid Holland">
      <meta name="author" content="Sabine Bezemer">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="robots" content="index, follow">
      <meta property="og:title" content="Meer Geluk - Levens- en relatiecoaching in Zuid-Holland">
      <meta property="og:description" content="Meer Geluk biedt professionele coaching voor je leven, relatie en werk. Ontdek hoe je meer geluk kunt ervaren met de hulp van Sabine Bezemer, een ervaren relatie- en levenscoach en kunstzinnig therapeut.">
      <meta property="og:image" content="https://www.meergeluk.com/assets/img/visitekaartje.png">
      <meta property="og:url" content="https://www.meergeluk.com">
      <meta property="og:type" content="website">
      <meta property="og:site_name" content="Meer Geluk">
      <meta property="og:locale" content="nl_NL">
      <meta property="og:locale:alternate" content="en_US">
      <link rel="canonical" href="https://www.meergeluk.com">
      <link rel="icon" type="image/svg+xml" href="{$base_url}/assets/img/favicon.svg">
      <link rel="icon" type="image/png" href="{$base_url}/assets/img/favicon.png">
      <title>Meer Geluk - Levens- en relatiecoaching</title>
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&family=Libre+Franklin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
      <link rel="stylesheet" href="{$base_url}/assets/css/style.css?v=$unique_id" />
    </head>
    
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
  $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

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
                        <a href="{$base_url}/eigengeluk" class="dropdown-item btn" role="menuitem">Eigen Geluk</a>
                      </li>
                      <li role="none">
                        <a href="{$base_url}/relatiegeluk" class="dropdown-item btn" role="menuitem">Relatie Geluk</a>
                      </li>
                      <li role="none">
                        <a href="{$base_url}/werkgeluk" class="dropdown-item btn" role="menuitem">Werk Geluk</a>
                      </li>
                      <li role="none">
                        <a href="{$base_url}/creatiefgeluk" class="dropdown-item btn" role="menuitem">Creatief Geluk</a>
                      </li>
                      <hr>
                      <li role="none">
                        <a href="{$base_url}/overmij" class="dropdown-item btn" role="menuitem">Over mij</a>
                      </li>
                      <li role="none">
                        <a href={$base_url}/tarieven" class="dropdown-item btn" role="menuitem">Tarieven</a>
                      </li>
                  
                    </ul>
                  </li>
                  <li role="none">
                    <a href="{$base_url}/blog" class="nav-link btn" role="menuitem">
                      Blog</a>
                  </li>
                  <li role="none">
                    <a href="{$base_url}/gratisgeluk" class="nav-link btn" role="menuitem">Gratis Geluk</a>
                  </li>

                  <li role="none">
                    <a href="{$base_url}/contact" class="nav-link btn btn--accent" role="menuitem">
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
  $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

    echo <<<EOT
    <footer>

    <div class="footer-wrapper">
      <div class="footer-column">
        <address>
          <small class="block">Sabine Bezemer</small>
          <small class="block">Coaching & Begeleiding</small>
          <small class="block">Praktijk locaties in Dordrecht en Papendrecht</small>
          
          <small class="block"><a href="mailto:info@meergeluk.com">info@meergeluk.com</a></small>
          <small class="block"> <a href="tel:+31(0)612204799">+31 (0)6 1220 4799</a> </small>
        </address>
      <div class="social-icons">
      <a href="https://www.facebook.com/profile.php?id=100090384705707" target="_blank" class="social-icon"><i class="fa-brands fa-facebook"></i></a>
      <a href="https://www.instagram.com/meergelukcoaching/" target="_blank" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
      <a href="https://www.linkedin.com/in/meer-geluk-961b98274/" target="_blank" class="social-icon"><i class="fa-brands fa-linkedin"></i></a>
      </div>
      </div>
      <div class="footer-column">
        <div class="footer-nav">
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="overmij">Over mij</a></li>
            <li><a href="contact">Contact</a></li>
            <li><i class="fa-regular fa-file-pdf"></i> <a href="{$base_url}/assets/pdf/Algmene Voorwaarden Meer Geluk.pdf" target="_blank">Algemene Voorwaarden Meer Geluk  </a></li>
            <li><i class="fa-regular fa-file-pdf"></i> <a href="{$base_url}/assets/pdf/Gedragscode Meer Geluk 2023.pdf" target="_blank">Privacyverklaring Meer Geluk  </a></li>
          </ul>
          <div class="footer-certificat">
          <img src="{$base_url}/assets/img/certificaten2.png" alt="Certificaten">
        </div>
        </div>
      </div>
    </div>

    <p class="codette">Designed & Developped by Codette web & media - 2023</p>

  </footer>
  <script src="{$base_url}/assets/js/nav.js" type="module"></script>
  <script src="{$base_url}/assets/js/joscript.js"></script>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ProfessionalService",
    "name": "Relatie Therapie, Trauma Therapie & Loopbaan Begeleiding in Zuid-Holland",
    "description": "Wij bieden professionele relatie therapie, trauma therapie en loopbaan begeleiding in Papendrecht, Dordrecht en omliggende gebieden. Ontvang een gratis intake gesprek en praktische, efficiënte sessies voor een gelukkiger en energieker leven.",
    "areaServed": {
      "@type": "AdministrativeArea",
      "name": "Zuid-Holland"
    },
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Papendrecht",
      "addressRegion": "Zuid-Holland",
      "addressCountry": "NL"
    },
    "hasOfferCatalog": {
      "@type": "OfferCatalog",
      "name": "Diensten",
      "itemListElement": [
        {
        "@type": "OfferCatalog",
        "name": "Relatie Therapie",
        "itemListElement": [
        {
        "@type": "Offer",
        "itemOffered": {
        "@type": "Service",
        "name": "Relatie Therapie"
        },
        "description": "Professionele begeleiding voor koppels met relatieproblemen, sleur, passie, intimiteit en communicatie-uitdagingen. Versterk vertrouwen en verbeter de kwaliteit van uw liefdesleven."
        }
        ]
        },
        {
        "@type": "OfferCatalog",
        "name": "Trauma Therapie",
        "itemListElement": [
        {
        "@type": "Offer",
        "itemOffered": {
        "@type": "Service",
        "name": "Trauma Therapie"
        },
        "description": "Begeleiding bij het verwerken en herstellen van traumatische ervaringen, met ondersteuning voor het opbouwen van zelfvertrouwen en het vinden van balans."
        }
        ]
        },
        {
        "@type": "OfferCatalog",
        "name": "Loopbaan Begeleiding",
        "itemListElement": [
        {
        "@type": "Offer",
        "itemOffered": {
        "@type": "Service",
        "name": "Loopbaan Begeleiding"
        },
        "description": "Werk coaching en loopbaan therapie voor het navigeren van professionele uitdagingen, stress, burn-out en het ontdekken van een bevredigend en gelukkig carrièrepad."
        }
        ]
        }
      ]
    },
    "telephone": "+31 6 1220 4799",
    "email": "info@meergeluk.com",
    "url": "https://www.meergeluk.com",
    "image": "https://www.meergeluk.com/assets/img/visitekaartje.png",
    "priceRange": "$$",
    "openingHoursSpecification": {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": [
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday"
      ],
      "opens": "09:00",
      "closes": "17:00"
    }
  }
      </script>

EOT;
}
