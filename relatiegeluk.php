<?php
include 'functions.php';
?>
<?= template_header('Relatie Geluk - Meer Geluk') ?>
<?= template_nav() ?>

      <main class="relatieGeluk">
        <div class="home-wrapper">
          <section aria-labelledby="Relatie Geluk" class="full hero-container">
            <header class="c-header-container">
              <div id="changeNavColor">
                <div class="header-container rise subheading">
                  <img src="assets/img/meerGelukLogoFull3.png" alt="Meer Geluk in je leven, relatie & werk">
                  <!-- <h1>Meer <span id="geluk">Geluk</span></h1> -->
                  <h2>In je leven <br> relatie & werk</h2>
                </div>
              </div>
              <div class="hero-title">
                <h1>Relatie Geluk</h1>
              </div>
            </header>
          </section>
                <section class="container">
          <div class="svg-wrapper">
            <button class="arrow-down" aria-controls="scroll-down" aria-label="scroll down" onclick="scrollToContent()"
              id="scrollDown">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-circle" width="44"
                height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="#f0f0f0"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <circle cx="12" cy="12" r="8" />
                <line x1="8" y1="12" x2="12" y2="16" />
                <line x1="12" y1="8" x2="12" y2="16" />
                <line x1="16" y1="12" x2="12" y2="16" />
              </svg>
            </button>
          </div>
          <article class="geluk-page container">
          <!-- <div class="c-header">
           <h2 class="h3">subheader hier</h2>
            <div class="clover">
              <img src="assets/svg/clover.svg" alt="Clover symbol" />
            </div>
          </div> -->
            <div class="coach-content auto-grid">
              <div class="auto-grid-item">
                <p class="c-larger-p">
                Een bruisende relatie vol passie!
                </p>
                  
                <p>Wil je het vuur voor je geliefde weer voelen zoals in het begin? Met mijn 8 stappen-relatie-plan creëer je een diepe en unieke verbinding die voor een intens samenzijn zal zorgen.
</p>
                   <p>Uniek aan dit traject is dat jullie eerst individuele coaching en vervolgens gezamenlijke op-maat-coaching ontvangen. En dat allemaal in 8 afspraken.</p>
                   <p> Beleef echte eye-openers, leer jezelf én elkaar kennen op een ander niveau en voel de vlinders weer!</p>
                </p>
              </div>
              <div class="auto-grid-item">
                <p class="c-larger-p">
                  Tijdens het Relatie Geluk Traject zullen jullie binnen 8 afspraken merken dat:
                  </p>
                            <ul class="c-list">
                    <li>Je (individueel) inzicht en verwerking krijgt van oude patronen en overtuigingen</li>
                    <li>Er zelfs na heftige situaties in jullie relatie hoop is</li>
                    <li>Je je partner écht leert kennen en begrijpen op een diep niveau</li>
                    <li>Jullie een praktische handleiding van elkaar krijgen</li>
                    <li>De emotionele verbinding wordt hersteld/vernieuwd</li>
                    <li>Je leert omgaan met emoties van jezelf en je partner</li>
                    <li>Jullie voelen meer begrip, waardering en passie</li>
                    <li>De intimiteit tussen jullie zal opvlammen</li>
                    <li>Je ervaart écht geluk en ziet weer een zonnige toekomst samen</li>
                  </ul>
              </div>
                <div class="auto-grid-item">
                  <p class="c-larger-p">Met unieke en snelwerkende technieken krijg je:</p>
                  <ul class="c-list">
                    <li>Individuele en gezamenlijke intensieve coaching</li>
                    <li>Verwerking van oude pijnen en eventuele trauma’s die je tegenhouden 100% jezelf te zijn</li>
                    <li>Een persoonlijke handleiding van jezelf en je partner (heel handig!)</li>
                    <li>Emotionele verbindings-oefening en begeleiding</li>
                    <li>Leuke tools, tips, e-books en geschenken om jullie relatie te laten opbloeien alsof jullie weer een verliefd stelletje zijn.</li>
                  </ul>
                </div>
                <div class="auto-grid-item">
                  <p>
                  Wil je meer informatie over het Relatie Geluk Traject en de inhoud ervan?
                  <br>
                   Neem contact met me op en ik beantwoord graag al je vragen.
                   
                   Of plan direct een gratis en vrijblijvend intake/kennismakingsgesprek in.
          
                  </p>
                  <p>
              <a href="contact" class="btn btn--accent cta-button">Gratis intake-gesprek</a>

            </p>
                </div>
                <div class="auto-grid-item-span">
                <div class="cta-buttons">
                    <a href="contact" class="btn btn--accent"><i class="fa-regular fa-comment-dots"></i><span>Contact</span></a>
                    <a href="https://wa.me/0031612204799" class="btn btn--accent" data-social="whatsapp">
                        <i class="fa-brands fa-whatsapp"></i>
                        <span>WhatsApp</span>
                    </a>
                    <a href="tel:0612204799"" class="btn btn--accent">
                        <i class="fa-solid fa-phone"></i>
                        <span>telefoon</span>
                    </a>
                  </div>
                </div>
              </div>
             
          </article>
          
          
           </section>
           <section class="container ervaringen" aria-labelledby="ervaringen">

<header class="section-header">
  <!-- <img src="assets/img/meerGelukLogoKlaver.png" alt="Meer Geluk Klaver" class="klaverLogo"> -->
  <h2>Ervaringen</h2>

</header>

<div class="review-container auto-grid">
  <div class="review-content">


    <div class="reviews no-slider">

    </div>


  </div>
</div>


</section>
        </div>

    </main>

    
<?= template_footer() ?>

  <script src="assets/js/reviews.js"></script>

    <script>
      function scrollToContent() {
        var section = document.getElementById("scrollDown");
        section.scrollIntoView({ behavior: "smooth" });
      }
  
      fetchReviews("relatie"); // Load all reviews by default
  
  
    </script>



  </body>
</html>
