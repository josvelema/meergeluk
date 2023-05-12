<?php
include 'functions.php';
?>
<?= template_header('Meer Geluk - home') ?>
<?= template_nav() ?>

  <main class="full">
    <div class="home-wrapper">
      <section class="full hero-container hero-home">
        <header class="c-header-container ">
          <div class="hero" id="changeNavColor">
            <div class="header-container rise subheading">
              <div class="header-content">
                <img src="assets/img/meerGelukLogoFull3.png" alt="Meer Geluk in je leven, relatie & werk">
                <!-- <h1>Meer <span id="geluk">Geluk</span></h1> -->
                <h2>In je leven <br> relatie & werk</h2>
              </div>
            </div>
            <div class="hero-image-container rise">
              <div class="profile-picture">
                <img src="assets/img/sabineNoBg.png" alt="Sabine profiel foto" />
              </div>
              <div class="profile-text">
                <h3>Sabine Bezemer</h3>
                <p>Relatie- en levenscoach
                  <br>
                  Kunstzinnig therapeut
                </p>
              </div>

            </div>

          </div>
          <aside class="home-cta">

            <div class="home-cta-flex">
              <div class="home-cta-content">
                <p>
                  Klaar voor een prachtige wending in je leven?
                </p>
                  <p>
                    <a href="contact" class="btn btn--accent cta-button">Gratis intake-gesprek</a>
                    
                  </p>
                  <p><strong>Geen lange wachttijden!</strong></p>
                
              </div>
              <div class="cta-buttons no-text">
                <a href="contact" class="btn btn--accent"><i class="fa-regular fa-envelope"></i></a>
                <a href="whatsapp" " class=" btn btn--accent" data-social="whatsapp">
                  <i class="fa-brands fa-whatsapp"></i>
                  <!-- <span>WhatsApp</span> -->
                </a>
                <a href="tel:0612204799"" class=" btn btn--accent">
                  <i class="fa-solid fa-phone"></i>
                  <!-- <span>telefoon</span> -->
                </a>
              </div>
            </div>
          </aside>
        </header>
        <!-- 
        <div class="post-it">
            <p class="note">
              <strong>Geluk vinden</strong> <br>
              is geen kwestie van <br>
              <strong>Geluk hebben</strong>
            </p>
          </div> -->
      </section>
      <section aria-labelledby="coaching trajecten" class="container coaching-trajecten">

        <div class="section-wrapper">

          <!-- <div class="svg-wrapper">

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
          </div> -->
          <!-- <img src="assets/img/meerGelukLogoKlaver.png" alt="Meer Geluk Klaver" class="klaverLogo"> -->
          <h2 class="sr-only">Coaching en begeleiding trajecten</h2>
          </header>
          <div class="container coaching-flex">
            <article class="coaching">

              <div class="image-wrapper">
                <h2 class="h2">Eigen Geluk</h2>
                <div class="clover">
                  <svg height="16px" width="16px" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                    stroke="currentColor" fill="#e2887e" class="clover-svg">

                    <g>
                      <path class="st0" d="M384.666,268.189c-40.783,3.87-74.411-2.838-100.612-12.41c26.045-10.036,59.55-17.293,100.392-14.116
		c81.211,6.336,138.581-45.509,123.556-100.81c-14.721-54.126-75.111-57.666-90.2-49.379c8.043-15.24,3.481-75.559-50.886-89.364
		c-55.537-14.1-106.412,44.116-98.72,125.217c3.861,40.788-2.851,74.411-12.435,100.616
		c-10.028-26.046-17.293-59.559-14.104-100.396c6.328-81.202-45.5-138.582-100.806-123.544
		C86.725,18.711,83.172,79.106,91.455,94.194c-15.222-8.034-75.551-3.48-89.342,50.883C-11.991,200.63,46.238,251.48,127.322,243.8
		c40.783-3.861,74.41,2.847,100.625,12.435c-26.046,10.02-59.564,17.293-100.406,14.108C46.343,264.016-11.04,315.845,3.985,371.137
		c14.721,54.135,75.107,57.684,90.2,49.387c-8.031,15.224-3.468,75.56,50.886,89.364c55.55,14.108,106.412-44.116,98.724-125.217
		c-3.865-40.788,2.856-74.402,12.431-100.616c10.028,26.045,17.306,59.567,14.116,100.404
		c-6.344,81.195,45.501,138.574,100.794,123.545c54.135-14.717,57.679-75.112,49.383-90.2c15.236,8.042,75.564,3.481,89.368-50.882
		C523.99,311.376,465.75,260.519,384.666,268.189z" />
                    </g>
                  </svg>
                </div>
              </div>


              <div class="coach-content">


                <p class="short-text">
                  Is gelukkig zijn nog niet gelukt? Door allerlei klachten of gebeurtenissen kun je wel wat hulp
                  gebruiken.

                  Ervaar hoe je snel meer geluk kunt ervaren in 8 stappen.
                </p>
              </div>
              <a class="btn btn--accent" href="eigengeluk">Lees meer</a>

            </article>
            <article class="coaching">

              <div class="image-wrapper">
                <h2 class="h2">Relatie Geluk</h2>
                <div class="clover">
                  <svg height="16px" width="16px" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                    stroke="currentColor" fill="#e2887e" class="clover-svg">

                    <g>
                      <path class="st0" d="M384.666,268.189c-40.783,3.87-74.411-2.838-100.612-12.41c26.045-10.036,59.55-17.293,100.392-14.116
		c81.211,6.336,138.581-45.509,123.556-100.81c-14.721-54.126-75.111-57.666-90.2-49.379c8.043-15.24,3.481-75.559-50.886-89.364
		c-55.537-14.1-106.412,44.116-98.72,125.217c3.861,40.788-2.851,74.411-12.435,100.616
		c-10.028-26.046-17.293-59.559-14.104-100.396c6.328-81.202-45.5-138.582-100.806-123.544
		C86.725,18.711,83.172,79.106,91.455,94.194c-15.222-8.034-75.551-3.48-89.342,50.883C-11.991,200.63,46.238,251.48,127.322,243.8
		c40.783-3.861,74.41,2.847,100.625,12.435c-26.046,10.02-59.564,17.293-100.406,14.108C46.343,264.016-11.04,315.845,3.985,371.137
		c14.721,54.135,75.107,57.684,90.2,49.387c-8.031,15.224-3.468,75.56,50.886,89.364c55.55,14.108,106.412-44.116,98.724-125.217
		c-3.865-40.788,2.856-74.402,12.431-100.616c10.028,26.045,17.306,59.567,14.116,100.404
		c-6.344,81.195,45.501,138.574,100.794,123.545c54.135-14.717,57.679-75.112,49.383-90.2c15.236,8.042,75.564,3.481,89.368-50.882
		C523.99,311.376,465.75,260.519,384.666,268.189z" />
                    </g>
                  </svg>
                </div>
              </div>


              <div class="coach-content">


                <p class="short-text">
                  Jullie relatie begon zo sprankelend en rooskleurig, maar voelt nu niet meer zo toekomstbestendig. Wil
                  je werken aan het terugvinden van dat eerste gevoel?

                  Mijn (op jullie afgestemd) <strong>relatieplan</strong> geeft jullie in 8 stappen meer begrip,
                  verbinding, passie en is ook nog eens leuk om te doen!
                </p>
              </div>
              <a class="btn btn--accent" href="relatiegeluk">Lees meer</a>

            </article>
            <article class="coaching">

              <div class="image-wrapper">
                <h2 class="h2">Werk Geluk</h2>
                <div class="clover">
                  <svg height="16px" width="16px" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                    stroke="currentColor" fill="#e2887e" class="clover-svg">

                    <g>
                      <path class="st0" d="M384.666,268.189c-40.783,3.87-74.411-2.838-100.612-12.41c26.045-10.036,59.55-17.293,100.392-14.116
		c81.211,6.336,138.581-45.509,123.556-100.81c-14.721-54.126-75.111-57.666-90.2-49.379c8.043-15.24,3.481-75.559-50.886-89.364
		c-55.537-14.1-106.412,44.116-98.72,125.217c3.861,40.788-2.851,74.411-12.435,100.616
		c-10.028-26.046-17.293-59.559-14.104-100.396c6.328-81.202-45.5-138.582-100.806-123.544
		C86.725,18.711,83.172,79.106,91.455,94.194c-15.222-8.034-75.551-3.48-89.342,50.883C-11.991,200.63,46.238,251.48,127.322,243.8
		c40.783-3.861,74.41,2.847,100.625,12.435c-26.046,10.02-59.564,17.293-100.406,14.108C46.343,264.016-11.04,315.845,3.985,371.137
		c14.721,54.135,75.107,57.684,90.2,49.387c-8.031,15.224-3.468,75.56,50.886,89.364c55.55,14.108,106.412-44.116,98.724-125.217
		c-3.865-40.788,2.856-74.402,12.431-100.616c10.028,26.045,17.306,59.567,14.116,100.404
		c-6.344,81.195,45.501,138.574,100.794,123.545c54.135-14.717,57.679-75.112,49.383-90.2c15.236,8.042,75.564,3.481,89.368-50.882
		C523.99,311.376,465.75,260.519,384.666,268.189z" />
                    </g>
                  </svg>
                </div>
              </div>


              <div class="coach-content">


                <p class="short-text">
                  Ontdek waar je passie en talent samenkomen.
                  Je wilt je leven niet voorbij laten gaan met werk waar je niet blij van wordt.

                  Weten wat je wilt en wat bij je past mét een uniek stappenplan op jou afgestemd!
                </p>
              </div>
              <a class="btn btn--accent" href="werkgeluk">Lees meer</a>

            </article>
            <article class="coaching">

              <div class="image-wrapper">
                <h2 class="h2">Creatief Geluk</h2>
                <div class="clover">
                  <svg height="16px" width="16px" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                    stroke="currentColor" fill="#e2887e" class="clover-svg">

                    <g>
                      <path class="st0" d="M384.666,268.189c-40.783,3.87-74.411-2.838-100.612-12.41c26.045-10.036,59.55-17.293,100.392-14.116
		c81.211,6.336,138.581-45.509,123.556-100.81c-14.721-54.126-75.111-57.666-90.2-49.379c8.043-15.24,3.481-75.559-50.886-89.364
		c-55.537-14.1-106.412,44.116-98.72,125.217c3.861,40.788-2.851,74.411-12.435,100.616
		c-10.028-26.046-17.293-59.559-14.104-100.396c6.328-81.202-45.5-138.582-100.806-123.544
		C86.725,18.711,83.172,79.106,91.455,94.194c-15.222-8.034-75.551-3.48-89.342,50.883C-11.991,200.63,46.238,251.48,127.322,243.8
		c40.783-3.861,74.41,2.847,100.625,12.435c-26.046,10.02-59.564,17.293-100.406,14.108C46.343,264.016-11.04,315.845,3.985,371.137
		c14.721,54.135,75.107,57.684,90.2,49.387c-8.031,15.224-3.468,75.56,50.886,89.364c55.55,14.108,106.412-44.116,98.724-125.217
		c-3.865-40.788,2.856-74.402,12.431-100.616c10.028,26.045,17.306,59.567,14.116,100.404
		c-6.344,81.195,45.501,138.574,100.794,123.545c54.135-14.717,57.679-75.112,49.383-90.2c15.236,8.042,75.564,3.481,89.368-50.882
		C523.99,311.376,465.75,260.519,384.666,268.189z" />
                    </g>
                  </svg>
                </div>
              </div>


              <div class="coach-content">


                <p class="short-text">
                  On-the-spot coaching tijdens een creatieve bezigheid.
                  Krijg direct ontspanning en inzicht en verminder je stress, angst en onzekerheid.
                  Ook leuk om samen te doen.
                </p>
              </div>
              <a class="btn btn--accent" href="creatiefgeluk">Lees meer</a>

            </article>

          </div>
        </div>
      </section>
      <section class="container" aria-labelledby="ervaringen">
        <header class="section-header">
          <!-- <img src="assets/img/meerGelukLogoKlaver.png" alt="Meer Geluk Klaver" class="klaverLogo"> -->
          <h2>Ervaringen</h2>

        </header>

        <div class="container review-container">

          <div class="review-content with-slider">
            <button id="play-pause-button">
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>Play/Pause</title>
                <circle cx="12" cy="12" r="10" fill="currentColor" stroke="#0e0e0e" stroke-width="2" />
                <polygon class="play" points="10 8 16 12 10 16" fill="#0e0e0e" />
                <svg id="pause-svg" class="pause" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <rect x="9" y="8" width="2" height="8" />
                  <rect x="13" y="8" width="2" height="8" />
                </svg>
              </svg>

            </button>
            <button class="rj-arrow" id="arrow--left">
              <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" viewBox="0 0 256 256">
                <rect width="256" height="256" fill="none"></rect>
                <line x1="216" y1="128" x2="40" y2="128" fill="none" stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="16"></line>
                <polyline points="112 56 40 128 112 200" fill="none" stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="16"></polyline>
              </svg>
            </button>
            <div class="reviews">

            </div>
            <button class="rj-arrow" id="arrow--right">
              <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" viewBox="0 0 256 256">
                <rect width="256" height="256" fill="none"></rect>
                <line x1="40" y1="128" x2="216" y2="128" fill="none" stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="16"></line>
                <polyline points="144 56 216 128 144 200" fill="none" stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="16"></polyline>
              </svg>
            </button>

          </div>
        </div>


      </section>


      <!-- contact faq section -->
      <section class="container">


        <header class="section-header">
          <!-- <img src="assets/img/meerGelukLogoKlaver.png" alt="Meer Geluk Klaver" class="klaverLogo"> -->
          <h2>Contact / FAQ</h2>

        </header>

        <article class="container about">
          <div class="coach-content auto-grid">

            <div class="auto-grid-item-span">
              <h3 class="h3 all-center black-text-white-outline">Een klik met elkaar en je veilig voelen!</h3>
            </div>

            <div class="auto-grid-item">
              <p class="c-larger-p"> Ontdek of wij matchen in een <strong>gratis en vrijblijvend</strong> eerste gesprek
                waarin we:</p>
              <br>
              <ul class="cta-list">
                <li>Elkaar leren kennen</li>
                <li>Jouw hulpvraag duidelijk krijgen</li>
                <li>Mijn werkwijze uitleggen en je met een duidelijk beeld naar huis laten gaan</li>
              </ul>
            </div>

            <div class="auto-grid-item">
              <div class="cta-button-container">
                <p class="c-larger-p">Ja, dit wil ik:
                
                </p>
                <p>
                  
                  <a href="contact" class="btn btn--accent cta-button">Gratis intake-gesprek</a>
                </p>
              </div>
              <p>Je kunt me uiteraard ook gewoon <a href="whatsapp">appen</a>, <a href="tel:0612204799">bellen</a> of <a
                  href="mailto:info@meergeluk.com">mailen</a> voor meer informatie.
                <br> Ik zit regelmatig in sessies met klanten, waardoor ik niet altijd de telefoon kan beantwoorden.
                Laat
                een
                bericht achter en ik bel je dezelfde dag nog terug.
              </p>
            </div>
            <div class="auto-grid-item auto-grid-item-span">
            <p class="c-larger-p"><strong>Vertrouwelijkheid en discretie zijn altijd gegarandeerd.</strong></p>

            </div>
            <div class="auto-grid-item-span">
              <div class="faq-section">
                <h3 class="faq-heading">FAQ - (Veelgestelde vragen)</h3>
                <div class="faq-items" role="list">
                  <div class="faq-item" role="listitem">
                    <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-1">Hoe lang duurt een
                      sessie?<span class="arrow"></span></button>
                    <div class="faq-answer" id="faq-answer-1" aria-hidden="true">
                      Een intakegesprek duurt gemiddeld 1,5 uur.
                      De daaropvolgende sessies zullen tussen de 2,5 en 3 uur duren.
                      Ik neem echt de tijd voor je, zodat we in korte tijd aan het grootste effect kunnen werken.
                    </div>
                  </div>
                  <div class="faq-item" role="listitem">
                    <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-2">Hoe lang duurt een
                      traject? <span class="arrow"></span></button>
                    <div class="faq-answer" id="faq-answer-2" aria-hidden="true">
                      Het gemiddelde traject bestaat uit 8 afspraken, waarbij de meeste mensen een prachtige
                      transformatie
                      hebben
                      ervaren en met een duurzaam resultaat naar huis gaan. Het kan zijn dat jij meer of minder
                      afspraken
                      nodig hebt. Dit is geen probleem. We bespreken samen wat voor jou het beste is.
                    </div>
                  </div>
                  <div class="faq-item" role="listitem">
                    <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-3">Kost een traject
                      veel
                      tijd? <span class="arrow"></span></button>
                    <div class="faq-answer" id="faq-answer-3" aria-hidden="true">
                      Het meeste "werk" zal plaatsvinden tijdens de sessies. Je hoeft geen boekwerken thuis door te
                      spitten,
                      oneindig durende testen in te vullen en je zult merken dat je een coachingstraject gemakkelijk
                      kunt
                      combineren met je agenda. We maken het passend voor jou.
                    </div>
                  </div>
                  <div class="faq-item" role="listitem">
                    <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-4">Zijn losse sessies
                      mogelijk?<span class="arrow"></span></button>
                    <div class="faq-answer" id="faq-answer-4" aria-hidden="true">
                      Het is ook mogelijk om losse sessies in te plannen. Laat me weten wat je hulpvraag is, zodat we
                      een
                      persoonlijk en op maat gemaakt plan voor je kunnen ontwerpen.
                    </div>
                  </div>
                  <div class="faq-item" role="listitem">
                    <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-5">Hoe en wanneer kan
                      ik
                      een
                      afspraak inplannen?<span class="arrow"></span></button>
                      <div class="faq-answer" id="faq-answer-5" aria-hidden="true">
                        Een gratis intakegesprek kun je aanvragen per mail via <a href="/contact">deze link</a>.
                        Maar je kunt ook bellen of appen om direct een afspraak in te plannen.
                        Ik ben vrij flexibel qua uren en tijden. Avonden zijn zelfs ook mogelijk.
                      </div>
                    </div>
                    <div class="faq-item" role="listitem">
                      <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-4">Wat kost een sessie?<span class="arrow"></span></button>
                      <div class="faq-answer" id="faq-answer-4" aria-hidden="true">
                      Ik bied verschillende soorten pakketten aan.
                        Kijk bij <a href="tarieven">tarieven</a> voor meer informatie over de kosten van de verschillende trajecten.
                      </div>
                    </div>
                    <div class="faq-item" role="listitem">
                    <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-6">Hoe snel en hoe vaak
                      kunnen de sessies ingepland worden? <span class="arrow"></span></button>
                    <div class="faq-answer" id="faq-answer-6" aria-hidden="true">
                      Afhankelijk van jouw agenda en die van mij kun je snel afspraken inplannen. Ik kan ook 's avonds
                      met je afspreken. Voor het grootste en snelste effect is het mogelijk en zelfs aan te raden om
                      meerdere afspraken in één week in te plannen. Dan zal je binnen enkele weken effect
                      merken. Maar het blijft maatwerk, wat we aanpassen naar jouw hulpvraag, wens en mogelijkheden.
                    </div>
                  </div>
                  <div class="faq-item" role="listitem">
                    <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-7">Waar vinden de
                      sessies
                      plaats?<span class="arrow"></span></button>
                    <div class="faq-answer" id="faq-answer-7" aria-hidden="true">
                      Ik heb 2 locaties in de Drechtsteden waar ik mijn praktijk houd: Papendrecht en Dordrecht. Beide
                      zijn
                      heel
                      makkelijk bereikbaar en er zijn gratis parkeermogelijkheden. Het eerste gesprek vindt plaats op
                      één
                      van deze locaties. Daarna kunnen we ook bij jou thuis of op een andere locatie afspreken.
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </article>
      </section>

      <!-- end of faq section -->
    </div>

  </main>
  <script src="assets/js/reviews.js"></script>
  <script>
    function scrollToContent() {
      var section = document.getElementById("scrollDown");
      section.scrollIntoView({ behavior: "smooth" });
    }

    fetchReviews()


  </script>

<?= template_footer() ?>
  </body>
  </html>
  