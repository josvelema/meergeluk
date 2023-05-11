<?php
include 'functions.php';
?>
<?= template_header('Werk Geluk - Meer Geluk') ?>
<?= template_nav() ?>
<main class="werkGeluk">
  <div class="home-wrapper">
    <section aria-labelledby="Werk Geluk" class="full hero-container ">
      <header class="c-header-container ">
        <div id="changeNavColor">
          <div class="header-container rise subheading">
            <img src="assets/img/meerGelukLogoFull3.png" alt="Meer Geluk in je leven, relatie & werk">
            <!-- <h1>Meer <span id="geluk">Geluk</span></h1> -->
            <h2>In je leven <br> relatie & werk</h2>
          </div>
        </div>
        <div class="hero-title">
          <h1>Werk Geluk</h1>
        </div>
      </header>
    </section>
    <section class="container">
      <div class="svg-wrapper">
        <button class="arrow-down" aria-controls="scroll-down" aria-label="scroll down" onclick="scrollToContent()" id="scrollDown">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-circle" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="#f0f0f0" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <circle cx="12" cy="12" r="8" />
            <line x1="8" y1="12" x2="12" y2="16" />
            <line x1="12" y1="8" x2="12" y2="16" />
            <line x1="16" y1="12" x2="12" y2="16" />
          </svg>
        </button>
      </div>
      <article class="geluk-page container">
        <div class="coach-content auto-grid">
          <div class="auto-grid-item">
            <p class="c-larger-p"">
            Passioneel en gedreven werken
          </p>
          <p>
            Mis je plezier en voldoening uit je werk en wil je nu eindelijk eens uitzoeken welke loopbaan écht bij jou past? 
             Gebaseerd op wie je bent en waar je gelukkig van wordt.

            </p>
            <p>
            Samen gaan maken we jouw blauwdruk duidelijk en hieruit volgt een uniek en persoonlijk plan voor jouw loopbaan. 
            Je krijgt duidelijke antwoorden, waarmee je praktische vervolgstappen kunt zetten, zodat je vervolgens heel gericht aan de slag kunt met jouw toekomstplannen! In 5 tot 8 afspraken heb je al resultaat!
            </p>
          </div>
              <div class=" auto-grid-item">
            <p class="c-larger-p">
              Jouw persoonlijk traject:
            </p>
            <ul class=" c-list">
              <li>Werkt snel en simpel en geeft diep inzicht</li>
              <li>Maakt duidelijk wat je drijft en motiveert</li>
              <li>Laat je ervaren waar jij écht gelukkig van wordt</li>
              <li>Haalt oude pijnen en patronen weg</li>
              <li>Geeft je toekomstperspectief en handvaten</li>
              <li>Maakt je zelfverzekerd, krachtig en energiek</li>
              <li>Geeft je praktische tips en tools</li>
              <li>Bied je persoonlijke ondersteuning en begeleiding</li>
              <li>Verzekerd je van een coach die jou ten diepste ziet</li>
              <li>Zal je brengen naar loopbaan met geluk en voldoening</li>
            </ul>
          </div>

          <div class="auto-grid-item">
            <p>
              Dit traject is uit te breiden met persoonlijke ondersteuning en begeleiding om jou naar dat ultieme werk geluk te brengen.
              Denk aan hulp bij het maken van een sollicitatiebrief, power-talk voor een sollicitatiegesprek of
              spar-partner.
            </p>
          </div>
          <div class="auto-grid-item">
            <p class="c-larger-p">
              Ontdek welke loopbaan perfect bij jou past!

            </p>
            <p>
              <a href="contact" class="btn btn--accent cta-button">Gratis intake-gesprek</a>

            </p>

          </div>

          <div class="auto-grid-item-span">
            <div class="cta-buttons">
              <a href="/contact" class="btn btn--accent"><i class="fa-regular fa-comment-dots"></i><span>Contact</span></a>
              <a href="whatsapp" " class=" btn btn--accent" data-social="whatsapp">
                <i class="fa-brands fa-whatsapp"></i>
                <span>WhatsApp</span>
              </a>
              <a href="tel:0612204799"" class=" btn btn--accent">
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
    section.scrollIntoView({
      behavior: "smooth"
    });
  }

  fetchReviews("werk"); // Load all reviews by default
</script>

</body>

</html>