<?php
include 'functions.php';
?>
<?= template_header('Meer Geluk - home') ?>
<?= template_nav() ?>

  <main class="full">
    <div class="home-wrapper">
      <section class="full contact">
  
        <header class="hero-title" id="changeNavColor">
          <div class="card-3d"><img class="card-3d-logo" src="assets/img/visitekaartje.png" alt="Visitekaartje"></div>
          <h1 class="h1">Contact</h1>
          
          
          
        </header>
        <!-- Calendly inline widget begin -->
<div class="calendly-inline-widget" data-url="https://calendly.com/meergelukgesprek?hide_gdpr_banner=1&background_color=f0ecec&text_color=1b251b&primary_color=cf9cd7" style="min-width:320px;height:630px;"></div>
<!-- Calendly inline widget end -->

<div class="form-container">
  <form id="contact-form">
    <div class="form-group">
      <label for="naam">Naam</label>
      <input type="text" id="naam" class="form-control" name="naam" required>
    </div>
    <div class="form-group">
      <label for="achternaam">Achternaam</label>
              <input type="text" id="achternaam" class="form-control" name="achternaam">
            </div>
            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" id="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
              <label for="telefoonnummer">Telefoonnummer</label>
              <input type="tel" id="telefoonnummer" class="form-control" pattern="^\d{10}$" name="telefoonnummer">
            </div>
            <input type="hidden" name="subject" value="meergeluk.com mail van ">
            <div class="form-group">
              <label for="bericht">Bericht</label>
              <textarea id="bericht" class="form-control" rows="5" required name="bericht">Ik wil graag een eerste afspraak maken</textarea>
            </div>
            <div class="g-recaptcha" data-sitekey="6Lcke1YlAAAAANoZdNud9lBqKzu3lFFPsyg4Wozz"></div>
            
            <div class="form-group">
              <button type="submit" class="btn submit-btn">Verstuur</button>
            </div>
          </form>
          <div id="response"></div>
          
        </section>
      </div>
      
    </main>
    
    

  <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>

  <script>
    document.getElementById('contact-form').addEventListener('submit', async (e) => {
      console.log('submitting form');
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);

        const responseDiv = document.getElementById('response');
        responseDiv.innerHTML = '';

        try {
            const response = await fetch('contactform.php', {
                method: 'POST',
                body: formData,
            });
            const responseText = await response.text(); // Get the response text
            console.log(responseText); // Log the response text
            const result = JSON.parse(responseText); // Parse the response text as JSON

            if (result.success) {
              console.log('success');
                responseDiv.innerHTML = result.success;
                form.reset();
                grecaptcha.reset();
            } else if (result.errors) {
              responseDiv.innerHTML = '';
              result.errors.forEach(error => {
                  const errorParagraph = document.createElement('p');
                  errorParagraph.textContent = error;
                  responseDiv.appendChild(errorParagraph);
              });
                console.log(result.errors);
            } else {
                responseDiv.innerHTML = 'An unexpected error occurred.';
                console.log(result);
            }
        } catch (err) {
            console.error(err);
            responseDiv.innerHTML = 'An error occurred while submitting the form. Please try again.';
        }
    });
</script>

  <!-- <script>
    const contactForm = document.getElementById("contact-form");
    const formResult = document.getElementById("form-result");
    
    contactForm.addEventListener("submit", (e) => {
      e.preventDefault();
    
      const naam = document.getElementById("naam");
      const achternaam = document.getElementById("achternaam");
      const email = document.getElementById("email");
      const telefoonnummer = document.getElementById("telefoonnummer");
      const bericht = document.getElementById("bericht");
    
      if (
        naam.checkValidity() &&
        achternaam.checkValidity() &&
        email.checkValidity() &&
        telefoonnummer.checkValidity() &&
        bericht.checkValidity()
      ) {
        formResult.textContent = "Form submitted successfully!";
        formResult.style.color = "green";
        contactForm.reset();
      } else {
        formResult.textContent = "Please check your inputs!";
        formResult.style.color = "red";
      }
    });
    

    document.addEventListener('DOMContentLoaded', () => {
      const readMoreButtons = document.querySelectorAll('[data-read-more]');
      const closeButtons = document.querySelectorAll('[data-close]');
      const dropdownToggle = document.querySelector('.dropdown-toggle');
      const dropdownMenu = document.querySelector('.dropdown-menu');

      dropdownToggle.addEventListener('click', function () {
        const expanded = dropdownToggle.getAttribute('aria-expanded') === 'true';
        dropdownToggle.setAttribute('aria-expanded', !expanded);
      });

      window.addEventListener('click', function (event) {
        if (!event.target.closest('.dropdown')) {
          dropdownToggle.setAttribute('aria-expanded', 'false');
        }
      });
      readMoreButtons.forEach(button => {
        button.addEventListener('click', () => {
          const coachImage = button.closest('.review').querySelector('.review-content');
          coachImage.classList.add('expanded');
        });
      });

      closeButtons.forEach(button => {
        button.addEventListener('click', () => {
          const coachImage = button.closest('.review').querySelector('.review-content');
          coachImage.classList.remove('expanded');
        });
      });
    });


    const faqItems = document.querySelectorAll('.faq-item');

    // Add click event listener to each question button
    faqItems.forEach(function (item) {
      const button = item.querySelector('.faq-question');
      const answer = item.querySelector('.faq-answer');
      button.addEventListener('click', function () {
        item.classList.toggle('active');
        const expanded = button.getAttribute('aria-expanded') === 'true' || false;
        button.setAttribute('aria-expanded', !expanded);
        answer.setAttribute('aria-hidden', expanded);
        if (item.classList.contains('active')) {
          answer.style.height = answer.scrollHeight + 'px';
        } else {
          answer.style.height = 0;
        }
      });
    });

    let reviews;
    let slideIndex = 0;
    let intervalId = null;
    let playSvg = document.querySelector('.play');
    let pauseSvg = document.querySelector('.pause');
    let playPauseButton = document.querySelector('#play-pause-button');

    function loadStars(stars) {
      const calculatedStars = [];
      for (let i = 0; i < Math.floor(stars); i++) {
        calculatedStars.push(`<img src="images/full-star.svg">`);
      }
      if (stars === 5) {
        return calculatedStars.map((item) => item).join('');
      }
      if (Number.isInteger(stars)) {
        for (let i = 0; i < 5 - stars; i++) {
          calculatedStars.push(`<img src="images/empty-star.svg">`);
        }
      } else {
        calculatedStars.push(`<img src="images/half-star.svg">`);
        for (let i = 0; i < 4 - Math.floor(stars); i++) {
          calculatedStars.push(`<img src="images/empty-star.svg">`);
        }
      }
      return calculatedStars.map((item) => item).join('');
    }

    function loadReviews(review) {
      return `
          <div class="review">
            <p class="review__name"><strong>${review.name}</strong></p>
            <p class="review__quote"><strong>${review.quote}</strong></p>
            
          <p class="review__body">${review.body}</p>
        </div>
          `;
    }

    function moveSlider(e) {
      if (e && e.currentTarget.id.includes('right')) {
        slideIndex === reviews.length - 1 ? (slideIndex = 0) : slideIndex++;
      } else {
        slideIndex === 0 ? (slideIndex = reviews.length - 1) : slideIndex--;
      }
      document.querySelector('.reviews').style.transform = `translate(${-100 * slideIndex}%)`;
    }

    function startSlider() {
      if (intervalId === null) {
        console.log('Starting slider...');
        intervalId = setInterval(moveSlider, 8000);
      } else {
        console.warn('Slider is already playing.');
      }
    }

    function stopSlider() {
      if (intervalId !== null) {
        console.log('Stopping slider...');
        clearInterval(intervalId);
        intervalId = null;
      } else {
        console.warn('Slider is already paused.');
      }
    }

    // 1. Fetch the 'data' from our API
    async function fetchReviews() {
      try {
        const response = await fetch('assets/js/reviews.json');
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        const data = await response.json();
        reviews = data;
        // 2. Parse the data and create the 'review' divs
        document.querySelector('.reviews').innerHTML = data.map(loadReviews).join('');
        startSlider(); // Start the automatic slider
        pauseSvg.style.display = 'block'; // Display pause button by default
        playPauseButton.style.display = 'block';
      } catch (error) {
        console.error('There has been a problem with your fetch operation:', error);
      }
    }
    fetchReviews();

    // 3. Add event listeners to move the slider left and right
    document.querySelector('#arrow--right').addEventListener('click', () => {
      stopSlider(); // Stop the automatic slider when the user clicks on the arrow
      moveSlider(event);
    });
    document.querySelector('#arrow--left').addEventListener('click', () => {
      stopSlider(); // Stop the automatic slider when the user clicks on the arrow
      moveSlider(event);
    });

    // 4. Add event listener to the play/pause button
    document.querySelector('#play-pause-button').addEventListener('click', () => {
      const isSliderPlaying = intervalId !== null;
      if (isSliderPlaying) {
        stopSlider(); // If the slider is playing, stop it
        playSvg.style.display = 'block';
        pauseSvg.style.display = 'none';
        console.log('Slider is paused');
      } else {
        startSlider(); // If the slider is paused, start it
        playSvg.style.display = 'none';
        pauseSvg.style.display = 'block';
        console.log('Slider is playing');
      }
    });

    // 5. Hide the play button and show the pause button since the slider is playing by default
    playSvg.style.display = 'none';
    pauseSvg.style.display = 'block';






  </script> -->
<?= template_footer(); ?>