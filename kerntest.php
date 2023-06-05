<?php include 'functions.php'; ?>
<?= template_header('Meer Geluk - home') ?>
<?= template_nav() ?>

<main class="gratis">
  <div class="home-wrapper">
    <section class="full hero-container hero-home">
      <header class="c-header-container">
        <div id="changeNavColor">
          <div class="header-container rise subheading">
            <img src="assets/img/meerGelukLogoFull3.png" alt="Meer Geluk in je leven, relatie & werk">
            <!-- <h1>Meer <span id="geluk">Geluk</span></h1> -->
            <h2>In je leven <br> relatie & werk</h2>
          </div>
        </div>
        <div class="hero-title">
          <h1>KernTest</h1>
        </div>
      </header>
    </section>
    <section aria-labelledby="coaching trajecten" class="container">
      <div class="form-container">
        <div class="progress-bar">
          <div class="progress"></div>
        </div>
        <form id="multistep-form">
          <div id="user-details-form" class="form-section">
            <div class="form-group">
              <label for="name">Naam:</label>
              <input type="text" id="name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="phone">Telefoonnummer:</label>
              <input type="tel" id="phone" class="form-control">
            </div>
          </div>


          <!-- Add the multistep form here -->
          <!-- ... Existing code ... -->

          <div id="step-1" class="form-section">
            <h3>Stap 1: Categorie 1</h3>
            <p>Korte toelichting van categorie 1.</p>
            <div class="form-group">
              <label for="question-1">Vraag 1:</label>
              <div class="radio-group">
                <input type="radio" id="question-1-option-1" name="question-1" value="0">
                <label for="question-1-option-1">0</label>
                <input type="radio" id="question-1-option-2" name="question-1" value="50">
                <label for="question-1-option-2">50</label>
                <input type="radio" id="question-1-option-3" name="question-1" value="100">
                <label for="question-1-option-3">100</label>
                <input type="radio" id="question-1-option-4" name="question-1" value="150">
                <label for="question-1-option-4">150</label>
                <input type="radio" id="question-1-option-5" name="question-1" value="200">
                <label for="question-1-option-5">200</label>
              </div>
              <button class="explanation-btn" data-question="1">?</button>
              <div class="explanation-popup" id="explanation-popup-1" aria-hidden="true">
                <div class="explanation-popup-content">
                  <a class="explanation-popup-close">&times;</a>
                  <p>Explanation for Question 1.</p>
                </div>
              </div>
            </div>
            <!-- Add more questions for Category 1 -->
          </div>

          <!-- ... More category sections ... -->

          <div id="step-6" class="form-section">
            <h3>Stap 6: Categorie 6</h3>
            <p>Korte toelichting van categorie 6.</p>
            <div class="form-group">
              <label for="question-26">Vraag 26:</label>
              <div class="radio-group">
                <input type="radio" id="question-26-option-1" name="question-26" value="0">
                <label for="question-26-option-1">0</label>
                <input type="radio" id="question-26-option-2" name="question-26" value="50">
                <label for="question-26-option-2">50</label>
                <input type="radio" id="question-26-option-3" name="question-26" value="100">
                <label for="question-26-option-3">100</label>
                <input type="radio" id="question-26-option-4" name="question-26" value="150">
                <label for="question-26-option-4">150</label>
                <input type="radio" id="question-26-option-5" name="question-26" value="200">
                <label for="question-26-option-5">200</label>
              </div>
              <button class="explanation-btn" data-question="26">?</button>
              <div class="explanation-popup" id="explanation-popup-1" aria-hidden="true">
                <div class="explanation-popup-content">
                  <a class="explanation-popup-close">&times;</a>
                  <p>Explanation for Question 1.</p>
                </div>
              </div>
            </div>
            <!-- Add more questions for Category 6 -->
          </div>

          <!-- ... Existing code ... -->


          <div class="form-navigation">
            <button type="button" id="prev-btn" disabled>Terug</button>
            <button type="button" id="next-btn">Volgende</button>
          </div>
        </form>
      </div>
    </section>
  </div>
</main>
<script>
  // Get the form element and step sections
  const form = document.getElementById('multistep-form');
  const formSections = Array.from(document.querySelectorAll('.form-section'));

  // Get the previous and next buttons
  const prevBtn = document.getElementById('prev-btn');
  const nextBtn = document.getElementById('next-btn');

  // Get the progress bar element
  const progress = document.querySelector('.progress');

  // Store the current step index
  let currentStep = 0;

  // Function to update the progress bar based on the current step
  const updateProgressBar = () => {
    const progressPercentage = ((currentStep + 1) / formSections.length) * 100;
    progress.style.width = `${progressPercentage}%`;
  };

  // Add an event listener to the explanation buttons
  const explanationButtons = document.querySelectorAll('.explanation-btn');
  explanationButtons.forEach((button) => {
    button.addEventListener('click', handleExplanationClick);
  });

  // Function to handle the explanation button click
  function handleExplanationClick(event) {
    event.preventDefault();
    const button = event.target;
    const questionNumber = button.dataset.question;

    const popup = document.getElementById(`explanation-popup-${questionNumber}`);


    // Toggle the aria-hidden attribute to show/hide the popup
    const isHidden = popup.getAttribute('aria-hidden') === 'true';
    popup.setAttribute('aria-hidden', !isHidden);
  }
  // JavaScript code
  document.addEventListener('DOMContentLoaded', function() {
    const explanationPopups = document.querySelectorAll('.explanation-popup');
    const explanationPopupContents = document.querySelectorAll('.explanation-popup-content');

    explanationPopups.forEach(function(popup) {
      const closeButton = popup.querySelector('.explanation-popup-close');

      // Close popup when close button is clicked
      closeButton.addEventListener('click', function() {
        closePopup(popup);
      });

      // Close popup when the ESC key is pressed  
      document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
          closePopup(popup);
        }
      });

      // Close popup when the user clicks outside of the popup
      popup.addEventListener('click', function(event) {
        if (event.target === popup) {
          closePopup(popup);
        }
      });
    });

    function closePopup(popup) {
      popup.setAttribute('aria-hidden', 'true');
    }
  });



  // Function to show the current step
  const showStep = (stepIndex) => {
    // Hide all form sections
    formSections.forEach((section) => {
      section.style.display = 'none';
    });

    // Show the current form section
    formSections[stepIndex].style.display = 'block';

    // Update the progress bar
    updateProgressBar();

    // Enable or disable the previous and next buttons based on the current step
    if (stepIndex === 0) {
      prevBtn.disabled = true;
    } else {
      prevBtn.disabled = false;
    }

    if (stepIndex === formSections.length - 1) {
      nextBtn.textContent = 'Verzenden';
    } else {
      nextBtn.textContent = 'Volgende';
    }
  };


  // Function to handle the next button click
  const handleNextClick = () => {
    // Move to the next step if available
    if (currentStep < formSections.length - 1) {
      // Perform form validation if needed
      if (currentStep === 0) {
        // Validate user information details
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');

        // Check if the name and email inputs are filled
        if (nameInput.value.trim() === '' || emailInput.value.trim() === '') {
          alert('Vul alstublieft uw naam en e-mailadres in.');
          return;
        }

        // Hide the user details form
        const userDetailsForm = document.getElementById('user-details-form');
        userDetailsForm.style.display = 'none';
      }
      // Get the current step section
      const currentStepSection = formSections[currentStep];

      // Get the unanswered questions in the current step
      const unansweredQuestions = currentStepSection.querySelectorAll('input[type="radio"]:not(:checked)');

      // Check if there are any unanswered questions
      if (unansweredQuestions.length > 0) {
        alert('Beantwoord alstublieft alle vragen.');
        // reset unansewered questions
        
        return;
      }


      // Proceed to the next step
      currentStep++;
      showStep(currentStep);
    } else {
      // Handle form submission
      form.submit();
    }
  };


  // Function to handle the previous button click
  const handlePrevClick = () => {
    // Move to the previous step if available
    if (currentStep > 0) {
      currentStep--;
      showStep(currentStep);
    }
  };

  // Add event listeners to the previous and next buttons
  prevBtn.addEventListener('click', handlePrevClick);
  nextBtn.addEventListener('click', handleNextClick);

  // Show the initial step
  showStep(currentStep);
</script>
<?= template_footer() ?>
</body>

</html>