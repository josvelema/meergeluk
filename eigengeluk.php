<?php
include 'functions.php';
?>
<?= template_header('Eigen Geluk - Meer Geluk') ?>
<?= template_nav() ?>
<main class="eigenGeluk">
  <div class="home-wrapper">

    <section class="full hero-container">
      <header class="c-header-container ">
        <div id="changeNavColor">
          <div class="header-container rise subheading">
            <img src="assets/img/meerGelukLogoFull3.png" alt="Meer Geluk in je leven, relatie & werk">
            <!-- <h1>Meer <span id="geluk">Geluk</span></h1> -->
            <h2>In je leven <br> relatie & werk</h2>
          </div>
        </div>
        <div class="hero-title">
          <h1>Eigen Geluk</h1>
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
            <p class="first-line">
              Meer geluk! Dat wil je!
              <br> Maar het leven loopt niet lekker of lijkt tegen te zitten.
              <br>
              Je kan zelfs last hebben van stress, burn-out, depressiviteit, trauma's, PTSS, rouw, verslaving of andere obstakels die je
              tegenhouden van een gelukkig leven.
              <br>
              Ik maak samen met jou een <strong>persoonlijk plan</strong> om het roer om te gooien.

              <br>
              Pak deze kans om jezelf te bevrijden en ga leven zoals jij dat wilt, met meer vertrouwen, voldoening en levensgeluk! En dat in 8 afspraken!
            </p>
          </div>
          <div class="auto-grid-item">
            <p class="first-line">
              In slechts 8 stappen krijg je:
            </p>
            <ul class="c-list">
              <li>inzicht hoe je écht in elkaar steekt</li>
              <li>weten wie je ten diepste bent (jouw blauwdruk)</li>
              <li>weten wat je écht wilt en wat je drijft</li>
              <li>weten wat je tegenhoud in je geluk</li>
              <li>een <strong>persoonlijk plan</strong> van aanpak</li>
              <li>verwerking van eventuele trauma's</li>
              <li>motivatie en begeleiding in dit proces</li>
              <li>zelfvertrouwen, kracht en energie</li>
              <li>handige tools, e-books en nog meer extra's</li>
            </ul>
          </div>
          <div class="auto-grid-item">
            <p>
              Je zult merken dat je je weer krachtig en energiek voelt om te gaan staan en leven zoals jij wilt.
              <br>
              Het effect dat je bereikt is blijvend.
              </p>
               <p>
                 Na het traject houden we contact om te zorgen dat je op koers blijft.
                               Dat is mijn manier van coachen, zodat jij meer geluk blijft ervaren.
               </p>
            
          </div>
          <div class="auto-grid-item">
            <p>
              Kun je niet wachten om je leven een prachtige wending te geven?
            </p>
            <p>
              <a href="contact" class="btn btn--accent cta-button">Gratis intake-gesprek</a>

            </p>
            <p>
              Ervaar welk effect je in een sessie kunt bereiken en of je een
              gezamenlijke klik voelt met mij als coach. Er zijn geen lange wachttijden en ik hanteer flexibele tijden.
              <br>
              Kies nu voor je eigen geluk!
            </p>
          </div>

        </div>

        <div class="cta-buttons ">
          <a href="contact" class="btn btn--accent"><i class="fa-regular fa-comment-dots"></i><span>Contact</span></a>
          <a href="whatsapp" " class=" btn btn--accent" data-social="whatsapp">
            <i class="fa-brands fa-whatsapp"></i>
            <span>WhatsApp</span>
          </a>
          <a href="tel:0612204799"" class=" btn btn--accent">
            <i class="fa-solid fa-phone"></i>
            <span>telefoon</span>
          </a>
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


<script src="assets/js/reviews.js"></script>
<script>
  function scrollToContent() {
    var section = document.getElementById("scrollDown");
    section.scrollIntoView({
      behavior: "smooth"
    });
  }

  fetchReviews("eigen"); // Load all reviews by default
</script>

<?= template_footer() ?>
</body>

</html>