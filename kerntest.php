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
            <h3>Vraag 1</h3>
            <p>een stelling voorbeeld , mee eens?.</p>
            <div class="form-group" data-category="1">
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

            </div>
            <!-- Add more questions for Category 1 -->
          </div>

          <div id="step-2" class="form-section">
            <h3>Vraag 2</h3>
            <p>een stelling voorbeeld , mee eens?.</p>
            <div class="form-group" data-category="1">
              <label for="question-2">Vraag 2:</label>
              <div class="radio-group">
                <input type="radio" id="question-2-option-1" name="question-2" value="0">
                <label for="question-2-option-1">0</label>
                <input type="radio" id="question-2-option-2" name="question-2" value="50">
                <label for="question-2-option-2">50</label>
                <input type="radio" id="question-2-option-3" name="question-2" value="100">
                <label for="question-2-option-3">100</label>
                <input type="radio" id="question-2-option-4" name="question-2" value="150">
                <label for="question-2-option-4">150</label>
                <input type="radio" id="question-2-option-5" name="question-2" value="200">
                <label for="question-2-option-5">200</label>
              </div>
            </div>
            <!-- Add more questions for Category 1 -->
          </div>

          <div id="step-3" class="form-section">
            <h3>Vraag 3</h3>
            <p>een stelling voorbeeld , mee eens?.</p>
            <div class="form-group" data-category="1">
              <label for="question-3">Vraag 3:</label>
              <div class="radio-group">
                <input type="radio" id="question-3-option-1" name="question-3" value="0">
                <label for="question-3-option-1">0</label>
                <input type="radio" id="question-3-option-2" name="question-3" value="50">
                <label for="question-3-option-2">50</label>
                <input type="radio" id="question-3-option-3" name="question-3" value="100">
                <label for="question-3-option-3">100</label>
                <input type="radio" id="question-3-option-4" name="question-3" value="150">
                <label for="question-3-option-4">150</label>
                <input type="radio" id="question-3-option-5" name="question-3" value="200">
                <label for="question-3-option-5">200</label>
              </div>
            </div>
          </div>


          <div id="step-4" class="form-section" data-category="3">
            <h3>Vraag 4</h3>
            <p>een stelling voorbeeld , mee eens?.</p>
            <div class="form-group">
              <label for="question-4">Vraag 4:</label>
              <div class="radio-group">
                <input type="radio" id="question-4-option-1" name="question-4" value="0">
                <label for="question-4-option-1">0</label>
                <input type="radio" id="question-4-option-2" name="question-4" value="50">
                <label for="question-4-option-2">50</label>
                <input type="radio" id="question-4-option-3" name="question-4" value="100">
                <label for="question-4-option-3">100</label>
                <input type="radio" id="question-4-option-4" name="question-4" value="150">
                <label for="question-4-option-4">150</label>
                <input type="radio" id="question-4-option-5" name="question-4" value="200">
                <label for="question-4-option-5">200</label>
              </div>
            </div>
          </div>

          <input type="hidden" id="score" name="score">

          <!-- ... Existing HTML code ... -->

          <!-- Result screen -->
          <div id="result-screen" class="form-section">
            <h3>Score Resultaten</h3>
            <div id="category-results"></div>
            <div id="total-score"></div>
            <button id="submit-btn" type="button">Verzenden</button>
          </div>



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
// open and read the data from kerntest.JSON file and convert it to a JavaScript object
const data = JSON.parse(`<?= file_get_contents('kerntest.json') ?>`);




// Convert the JSON data into JavaScript objects
const [questionsKey, questionsData, categoriesKey, categoriesData, userInfoKey, userInfoData] = data;

const questions = questionsData.reduce((acc, question) => {
  acc[question.questionId] = question;
  return acc;
}, {});

const categories = categoriesData.reduce((acc, category) => {
  acc[category.categoryId] = category;
  return acc;
}, {});

const userInfo = userInfoData[0];

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

      // Store user information in userInfo object
      userInfo.name = nameInput.value.trim();
      userInfo.email = emailInput.value.trim();
      userInfo.telephone = document.getElementById('phone').value.trim();
    }

    // Proceed to the next step
    currentStep++;
    showStep(currentStep);
  } else {
    // Handle form submission
    calculateScores();
    // Submit the form or perform other actions
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

// Function to calculate scores
const calculateScores = () => {
  // Reset question and category scores
  Object.values(questions).forEach((question) => {
    question.score = 0;
  });

  Object.values(categories).forEach((category) => {
    category.categoryScore = 0;
    category.top3questionScores = [0, 0, 0];
  });

  // Loop through all the questions
  formSections.forEach((section) => {
    const categoryId = section.getAttribute('data-category');
    const category = categories[categoryId];

    const questionsInCategory = Array.from(section.querySelectorAll('.form-group[data-category="' + categoryId + '"]'));

    questionsInCategory.forEach((question) => {
      const questionId = question.getAttribute('id');
      const questionValue = getSelectedValue(question);

      // Update the question score
      questions[questionId].score = questionValue;

      // Update the category score
      category.categoryScore += questionValue;

      // Update the top 3 question scores in the category
      if (questionValue > Math.min(...category.top3questionScores)) {
        const minScoreIndex = category.top3questionScores.indexOf(Math.min(...category.top3questionScores));
        category.top3questionScores[minScoreIndex] = questionValue;
      }
    });
  });

  // Log the scores for testing purposes
  console.log('Questions:', questions);
  console.log('Categories:', categories);
  console.log('User Info:', userInfo);
};

// Function to retrieve the selected value of a radio button group
const getSelectedValue = (question) => {
  const selectedOption = question.querySelector('input[type="radio"]:checked');
  return selectedOption ? parseInt(selectedOption.value) : 0;
};

// Show the initial step
showStep(currentStep);
</script>
<?= template_footer() ?>
</body>

</html>