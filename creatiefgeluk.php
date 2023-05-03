<?php
include 'functions.php';
?>
<?= template_header('Creatief Geluk - Meer Geluk') ?>
<?= template_nav() ?>

  <main class="creatiefGeluk">
    <div class="home-wrapper">
      <section aria-labelledby="coaching trajecten" class="full hero-container ">

        <header class="c-header-container ">
          <div id="changeNavColor">
            <div class="header-container rise subheading">
              <img src="assets/img/meerGelukLogoFull3.png" alt="Meer Geluk in je leven, relatie & werk">
              <!-- <h1>Meer <span id="geluk">Geluk</span></h1> -->
              <h2>In je leven <br> relatie & werk</h2>
            </div>
          </div>
          <div class="hero-title">
            <h1>Creatief Geluk</h1>
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

          <div class="coach-content auto-grid">
            <div class="auto-grid-item">
              <p class="c-larger-p">Krijg meer balans, inzicht en zelfvertrouwen. Vermindert stress en angst</p>
              <p>
                Kunstzinnige therapie brengt snel balans en inzicht in je leven.
                <br>
                Je leert jezelf op een andere manier kennen en je kunt het leven daardoor beter aan.
                <br>
                Er zijn veel onderzoeken uitgevoerd en steeds meer mensen worden zich bewust van de helende proces van
                creatief bezig zijn.
              </p>
            </div>

            <div class="auto-grid-item">
              <p class="c-larger-p">Creatief Geluk:</p>
              <ul class="c-list">
                <li>Combineert coaching met creativiteit</li>
                <li>Geeft je meer zelfvertrouwen en inzicht</li>
                <li>Laat zien wat er onbewust bij jou speelt en dit wordt direct besproken</li>
                <li>Vermindert stresshormonen (binnen 45 min. kunst maken met 75%)</li>
                <li>Stimuleert een ander gedeelte van je hersenen</li>
                <li>Zorgt dat je meer risico’s durft te nemen en nieuwe dingen uitprobeert</li>
                <li>Haalt remmingen weg en geeft je een gevoel van vrijheid</li>
                <li>Laat je in mogelijkheden en oplossingen denken</li>
                <li>Zal je stimuleren dit in alle aspecten van je leven te ervaren</li>
              </ul>
            </div>
            <div class="auto-grid-item-span">
              <img src="assets/img/creatiefGelukBanner.png" alt="A banner with images of art supplies"
                class="article-img">
            </div>

            <div class="auto-grid-item">
              <p class="c-larger-p">Voor een sessie Creatief Geluk:</p>
              <ul class="c-list">
                <li>Heb je geen ervaring nodig</li>
                <li>Gaat het om het proces, niet om het resultaat</li>
                <li>Vind vooraf altijd een coachgesprek plaats (1/2 uur)</li>
                <li>Werk je onder begeleiding aan een creatief project </li>
                <li>Bijv. een mindmap creëren, verven op canvas, vaas of servies enz.</li>
                <li>Hoef je niets voor te bereiden of mee te nemen</li>
                <li>Wordt je tijdens je proces continue begeleid</li>
                <li>Wordt duidelijk wat er onbewust bij jou speelt</li>
                <li>Leer je leuke creatieve technieken en verras je jezelf met wat je kan</li>
                <li>Ben je ongeveer 2 uur lekker creatief bezig</li>
                <li>Mag je je project meenemen en thuis verder gaan</li>
                <li>Kun je ook vervolg sessies inplannen voor meer Creatief Geluk</li>
              </ul>
            </div>
            <div class="auto-grid-item">
              <p>
                Wat deze sessie zo waardevol maakt is dat je tegelijkertijd gecoached wordt.
                <br>
                Een normale coachingsessie kost al snel €200 - €250 en deze sessie kost jou slechts €135 inclusief
                on-the-spot-coaching, alle materialen en het leren van technieken.
              </p>
              <p>Je kunt deze creatieve en leerzame sessie ook samen met iemand doen.
                Nodig een vriend of vriendin uit en beleef samen dit creatief helende proces.
                Kom je samen, betaal je slechts €99 per persoon. </p>
                <p>App, bel of mail voor meer informatie of voor het maken van een Creatieve Geluks Sessie </p>
                <div class="cta-buttons">
                  <a href="contact.html" class="btn btn--accent"><i
                      class="fa-regular fa-comment-dots"></i><span>Contact</span></a>
                  <a href="whatsapp" " class=" btn btn--accent" data-social="whatsapp">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span>WhatsApp</span>
                  </a>
                  <a href="tel:0623232323"" class=" btn btn--accent">
                    <i class="fa-solid fa-phone"></i>
                    <span>telefoon</span>
                  </a>
                </div>
              </div>
              <div class="auto-grid-item-span"><img src="assets/img/kunstSabine.png" alt="Sabine die voor een canvas poseert" class="article-img contain"></div>
              
 
          </div>

        </article>


      </section>

      <section class="container ervaringen" aria-labelledby="ervaringen">

        <div>
          <h2>Ervaringen</h2>
          <!-- <p>We partner with some pretty amazing people! Here’s what they say about us.</p> -->
        </div>
        <div class="review-container">
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
      section.scrollIntoView({ behavior: "smooth" });
    }

    fetchReviews("creatief"); // Load all reviews by default


  </script>

 <?= template_footer(); ?> 

</body>
</html>

