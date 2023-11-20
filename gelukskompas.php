<?php include 'functions.php'; ?>
<?= template_header('Meer Geluk - GeluksKompas') ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?= template_nav() ?>
<div class="redirect-wrap">
  <div class="redirect-msg">
    <h3>Bedankt!</h3>
    <p>Je wordt doorgestuurd naar de home pagina</p>
  </div>
</div>
<main class="gelukskompas">
  <div class="home-wrapper">
    <section>

            <!-- <img src="assets/img/meerGelukLogoFull3.png" alt="Meer Geluk in je leven, relatie & werk"> -->
            <header class="header-container">
              <h1 class="rise logo-h1">Meer Geluk</h1>
              <h2 class="rise subheading">Geluks Kompas</h2>
            </header>

      
    </section>
    <section aria-labelledby="coaching trajecten" class="container">
      <article class="start-screen">
        <header style="position: relative;">
          <div class="floating-img"><img src="assets/img/kompas300.png" alt="Geluks kompas" width=100></div> <button class="btn btn--acccent cta-button" id="startBtn">Begin test</button>
        </header>
        <h3>Hoe Werkt Het?</h3>
        <p>
          Stel je voor dat je leven een avontuurlijke reis is en dat geluk jouw route én bestemming is.
          Je wilt graag weten welke richting je op moet. Net zoals een kompas meerdere richtingen aangeeft,
          kun je voor geluk meerdere kanten op. Om jou persoonlijke richting te ontdekken heb ik een speciale test ontwikkeld.
          Reageer snel en makkelijk op de stellingen in de test en ontdek de 2 wegen die leiden naar jouw persoonlijke geluk.
        </p>
        <h3>Wat Krijg Je?</h3>
        <p>
          Na de test ontvang je direct jouw persoonlijke scores en een optioneel gedetailleerd PDF-rapport per e-mail (en geen reclame achteraf!).
        </p>

        <h3>Wat zegt het over mij?</h3>
        <p>
          De test zal een score geven in 6 verschillende richtingen. De top 2 hiervan wijzen je de weg naar Meer Geluk. Wat die weg met zich meebrengt,
          ups & downs, valkuilen, obstakels, maar ook tips en trucs kun je verder lezen in het gratis bijgaande E-book.

        </p>
        <ul>
          <span class="list-title">Jouw kompas kan wijzen naar bijvoorbeeld:</span>

          <li><span class="li-span-highlight">Zekerheid</span> De behoefte aan stabiliteit en veiligheid in het leven.</li>
          <li><span class="li-span-highlight">Variatie</span> De zoektocht naar avontuur, nieuwe ervaringen en afwisseling.</li>
          <li><span class="li-span-highlight">Liefde</span> Het versterken van relaties en verbondenheid met anderen.</li>
          <li><span class="li-span-highlight">Bijdrage</span> Het ervaren van geluk door een positieve impact op anderen te hebben.</li>
          <li><span class="li-span-highlight">Betekenis</span> Het zoeken naar diepere betekenis en doel in het leven.</li>
          <li><span class="li-span-highlight">Groei</span> De drang naar persoonlijke ontwikkeling en voortdurende groei.</li>
        </ul>

        <h3>Extra's</h3>
        <p>
          Als bonus ontvang je het uitgebreide gratis E-book ‘Jouw Route naar Geluk’, boordevol tips en aanwijzingen om je verder te helpen op weg naar jouw geluk.
          Deze test wordt normaal gesproken gebruikt als basisonderzoek in een coachingstraject bij Meer Geluk Coaching volgt en wordt je nu gratis en vrijblijvend aangeboden.
          In een Meer Geluk Traject wordt de uitkomst van deze test echter zeer uitgebreid en persoonlijk gemaakt. Een unieke handleiding van jou zelf.
        </p>

      </article>
      <div class="form-container">
        <span class="progress-text">0%</span>
        <div class="progress-bar">
          <div class="progress"></div>

        </div>
        <form id="multistep-form">
          <div id="user-details-form" class="form-section">
            <div class="form-group">
              <label for="name">Naam</label>
              <input type="text" id="name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="phone">Telefoonnummer <small>(optioneel)</small></label>
              <input type="tel" id="phone" class="form-control">
            </div>
            <!-- <div class="g-recaptcha" data-sitekey="6Lcke1YlAAAAANoZdNud9lBqKzu3lFFPsyg4Wozz"></div> -->


          </div>

          <div id="question-steps">
            <!-- Questions steps will be dynamically generated -->
          </div>

          <div id="result-screen" class="form-section">
            <div class="result-screen-last-question">
              <p>Bedankt voor het invullen van de vragenlijst. Uw resultaten worden nu berekend.</p>
              <p>
                Wilt U het complete overzicht met toelichting op de scores als PDF ontvangen?
                <br>
                Lees onze <a href="privacy.php">privacyverklaring</a> voor meer informatie over hoe wij met uw gegevens omgaan.
              </p>
              <div class="form-group-checkbox">
                <input type="checkbox" name="wantsPDF" id="wantsPDF">
                <label for="wantsPDF">Ja, ik ga akkoord met de privacyverklaring en ontvang graag het PDF document in mijn e-mail</label>
              </div>
              <p>
                Wilt U ook graag een vrijblijvend en gratis intake gesprek?
              </p>
              <div class="form-group-checkbox">
                <input type="checkbox" name="wantsIntake" id="wantsIntake">
                <label for="wantsIntake">Ja, ik wil graag een intake gesrpek </label>
              </div>

            </div>
            <div class="result-screen-content">
              <h3>Score Resultaten</h3>
              <p class="form-question">Uw totaal score is:
                <br>
                <span id="score-result"></span>
              </p>
              <h3>Score per Categorie</h3>
              <div id="category-results">
              </div>

            </div>

          </div>

          <div class="form-msg"></div>

          <div class="form-navigation">
            <button type="button" id="prev-btn" disabled class="btn btn--form">Terug</button>
            <button type="button" id="next-btn" class="btn btn--form">


            </button>
          </div>
        </form>
      </div>
    </section>

  </div>
</main>
<script src="assets/js/kompas.js"></script>
<script>
  const formContainer = document.querySelector('.form-container')
  const startScreen = document.querySelector('.start-screen')

  const startBtn = document.querySelector('#startBtn')


  startBtn.addEventListener('click', () => {

    // Toggle the 'minimized' class for startScreen
    startScreen.classList.toggle('minimized');

  });

  startScreen.addEventListener('transitionend', () => {
    // Check if 'minimized' class is present after the transition
    if (startScreen.classList.contains('minimized')) {
      startScreen.style.display = 'none';

      // Toggle the 'maximized' class for formContainer
      formContainer.classList.toggle('maximized');

      formContainer.style.display = 'block'
    } else {
      startScreen.style.display = ''; // Reset display to its default when maximized
      // formContainer.style.display = 'none'
    }

  });
  const data = JSON.parse(`<?= file_get_contents('assets/js/detest.JSON') ?>`);
startTest(data)

  // getTest()
</script>

<?= template_footer() ?>
</body>

</html>