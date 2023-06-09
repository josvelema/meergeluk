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
            <div class="form-msg">
              <!-- <p>Deze test bestaat uit 30 vragen. Het invullen duurt ongeveer 10 minuten.</p>
              <p>De test is gratis en vrijblijvend. Je ontvangt de uitslag per e-mail.</p> -->
              tekksss
            </div>
          </div>




          <input type="hidden" id="score" name="score">

          <div id="question-steps">
            <!-- Questions steps will be dynamically generated -->
          </div>

          <div id="result-screen" class="form-section">
            <h3>Score Resultaten</h3>
            <div id="category-results"></div>
            <div id="total-score"></div>
            <button id="submit-btn" type="button">Verzenden</button>
          </div>



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
<script>
  // open and read the data from kerntest.JSON file and convert it to a JavaScript object
  const data = JSON.parse(`<?= file_get_contents('detest.json') ?>`);

  // Convert the JSON data into JavaScript objects
  const [questionsKey, questionsData, categoriesKey, categoriesData, userInfoKey, userInfoData] = data;

  const questions = questionsData.reduce((acc, question) => {
    acc[question.questionId] = question;
    return acc;
  }, {});

  console.log(questions)

  const categories = {};
  categoriesData.forEach((category) => {
    categories[category.categoryId] = {
      ...category,
      categoryScore: 0,
      top3questionIds: [0, 0, 0],
      top3questionScores: [0, 0, 0],
    };
  });



  const userInfo = userInfoData[0];

  // Function to generate the HTML structure for each question
  const generateQuestionHTML = (question) => {
    return `
    <div id="step-${question.questionId}" class="form-section">
      <h3>Vraag ${question.questionId}</h3>
      <p>${question.content}</p>
      <div class="form-group" data-category="${question.categoryId}">
        <label for="question-${question.questionId}">Vraag ${question.questionId}:</label>
        <div class="radio-group">
          <input type="radio" id="question-${question.questionId}-option-1" name="question-${question.questionId}" value="0">
          <label for="question-${question.questionId}-option-1">0</label>
          <input type="radio" id="question-${question.questionId}-option-2" name="question-${question.questionId}" value="50">
          <label for="question-${question.questionId}-option-2">50</label>
          <input type="radio" id="question-${question.questionId}-option-3" name="question-${question.questionId}" value="100">
          <label for="question-${question.questionId}-option-3">100</label>
          <input type="radio" id="question-${question.questionId}-option-4" name="question-${question.questionId}" value="150">
          <label for="question-${question.questionId}-option-4">150</label>
          <input type="radio" id="question-${question.questionId}-option-5" name="question-${question.questionId}" value="200">
          <label for="question-${question.questionId}-option-5">200</label>
        </div>
        </div>
        <div class="form-msg"></div>
    </div>
  `;
  };

  // get the form
  const form = document.getElementById('multistep-form');

  // get the question steps container
  const questionSteps = document.getElementById('question-steps');
  // Generate the HTML structure for each question and add it to the form
  Object.values(questions).forEach((question) => {
    const questionHTML = generateQuestionHTML(question);
    questionSteps.insertAdjacentHTML('beforeend', questionHTML);
  });

  // Get the step sections
  const formSections = Array.from(document.querySelectorAll('.form-section'));

  // Get the previous and next buttons
  const prevBtn = document.getElementById('prev-btn');
  const nextBtn = document.getElementById('next-btn');

  // Get the progress bar element
  const progressBar = document.querySelector('.progress-bar');

  const progress = document.querySelector('.progress');

  const progressText = document.querySelector('.progress-text');




  // Store the current step index
  let currentStep = 0;

  // Function to update the progress bar based on the current step
  const updateProgressBar = () => {

    const progressPercentage = ((currentStep) / formSections.length) * 100;
    progress.style.width = `${progressPercentage}%`;
    progressText.textContent = `${Math.round(progressPercentage)}% van de vragen beantwoord.`;
  };

  // // Function to update the form message
  // const updateFormMessage = (message, className) => {
  //   formMsg.textContent = message;
  //   formMsg.className = `form-msg ${className}`;
  // };
  // Define the step indexes for motivating message screens
  const motivatingMessage1Index = Math.ceil(Object.keys(questions).length * 0.4);
    const motivatingMessage2Index = Math.ceil(Object.keys(questions).length * 0.7);
  // Function to show the current step
  const showStep = (stepIndex) => {

    // Hide all form sections
    formSections.forEach((section) => {
      section.style.display = 'none';
    });
    console.log(stepIndex + typeof(stepIndex))

    // Show the current form section
    formSections[stepIndex].style.display = 'block';


    // Enable or disable the previous and next buttons based on the current step
    if (stepIndex === 0) {
      prevBtn.disabled = true;
      progressBar.style.visibility = 'hidden';
      progressText.textContent = 'Vul uw gegevens in om te beginnen.';
    } else {
      prevBtn.disabled = false;
      progressBar.style.visibility = 'visible';
    }



    if (stepIndex === formSections.length - 1) {
      nextBtn.innerHTML = 'Verzenden';
    } else {
      nextBtn.innerHTML = `
      <span>
      Volgende
      </span>
      <span class="btn-icon">
      <i class="fas fa-chevron-right"></i>
      </span>
      `
    }
    // Update the progress bar
    (currentStep !== 0 && currentStep !== formSections.length - 1) ? updateProgressBar(): null;
  };

  // Function to handle the next button click

  const handleNextClick = () => {
    // Move to the next step if available
    if (currentStep < formSections.length - 1) {
      const formMsgSection = formSections[currentStep + 1];

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
        // validate the email address using a regular expression
        const emailRegex = /\S+@\S+\.\S+/;
        if (!emailRegex.test(emailInput.value)) {
          alert('Vul alstublieft een geldig e-mailadres in.');
          return;
        }
        // validate the telephone number using a regular expression , allow for spaces, dashes, and parentheses in the number
        const phoneRegex = /^\(?[\d\s]{3}\)?[\s-]?[\d\s]{3}[\s-]?[\d\s]{4}$/;
        if (!phoneRegex.test(document.getElementById('phone').value)) {
          alert('Vul alstublieft een geldig telefoonnummer in.');
          return;
        }





        // Store user information in userInfo object
        userInfo.name = nameInput.value.trim();
        userInfo.email = emailInput.value.trim();
        userInfo.telephone = document.getElementById('phone').value.trim();
      } else {

        
        // Validate the current step before proceeding
        
        const currentSection = formSections[currentStep];
       
        const categoryId = currentSection.querySelector('.form-group').getAttribute('data-category');
        // const categoryId = currentSection.getAttribute('data-category');
        const category = categories[categoryId];
        const questionsInCategory = Array.from(currentSection.querySelectorAll(`.form-group[data-category="${categoryId}"]`));
        
        // check if current step is motitvating message 1
        if (currentStep === motivatingMessage1Index) {
          formMsgSection.querySelector('.form-msg').style.display = 'block';
          let formMsg = formMsgSection.querySelector('.form-msg');  
          
          formMsg.innerHTML = `<p>
          Je bent al op de helft!
          </p>`
        } else if (currentStep === motivatingMessage2Index) {
          formMsgSection.querySelector('.form-msg').style.display = 'block';
          let formMsg = formMsgSection.querySelector('.form-msg');  
          
          formMsg.innerHTML = `<p>
          Je bent er bijna!
          </p>`
        } else if (currentStep === formSections.length - 1) {
          formMsgSection.querySelector('.form-msg').style.display = 'block';
          let formMsg = formMsgSection.querySelector('.form-msg');  
          
          formMsg.innerHTML = `<p>
          Je bent bijna klaar!
          </p>`
        }  else {
        // formMsgSection.querySelector('.form-msg').style.display = 'none';

        }

        // Check if all questions in the current step are answered
        const questionInputs = questionsInCategory.map((question) => {
          return question.querySelector('input[type="radio"]:checked');
        });

        if (questionInputs.some((input) => !input)) {
          alert('Beantwoord alstublieft alle vragen voordat u doorgaat.');
          return;
        }

        // Update the scores for the answered questions
        questionInputs.forEach((input) => {
          const questionId = input.name.split('-')[1];
          const questionValue = parseInt(input.value);
          console.log(questionId + ' score van ' + questionValue)
          questions[questionId].score = questionValue;

          category.categoryScore = category.categoryScore + questionValue
        });
        
      }

      // Proceed to the next step
      currentStep++;
      
      
      showStep(currentStep);
    } else {
      console.log('Form submitted!');
      // Handle form submission
      calculateScores();
      // Submit the form or perform other actions
      // form.submit();
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

  const calculateScores = () => {
    console.log('Calculating scores...');
    console.log('Questions:', questions);
    console.log('Categories:', categories);
    console.log('User Info:', userInfo);

    // Loop through all the questions
    Object.values(categories).forEach((category) => {
      const categoryId = category.categoryId;
      const questionsInCategory = Object.values(questions).filter((question) => question.categoryId === categoryId);

      console.log('Questions in Category:', questionsInCategory);

      const questionsInCategoryScores = questionsInCategory.map((question) => {
        const questionId = question.questionId;
        const questionValue = question.score;

        console.log('Question ID:', questionId);
        console.log('Question Value:', questionValue);

        return {
          questionId,
          score: questionValue,
        };
      });

      // Update the category score
      category.categoryScore = questionsInCategoryScores.reduce((total, question) => {
        return total + question.score;
      }, 0);

      // Sort the questions in the category by score
      const sortedQuestions = questionsInCategoryScores.sort((a, b) => b.score - a.score);

      // Update the top 3 question scores and IDs in the category
      category.top3questionScores = sortedQuestions.slice(0, 3).map((question) => question.score);
      category.top3questionIds = sortedQuestions.slice(0, 3).map((question) => question.questionId);
    });

    // Log the updated scores
    console.log('Updated Questions:', questions);
    console.log('Updated Categories:', categories);
  };




  // Show the initial step
  showStep(currentStep);

  // function to show validation error messages in the form
  const showErrorMessage = (input, message) => {
    const formField = input.parentElement;
    formField.classList.remove('success');
    formField.classList.add('error');

    // show the error message
    const error = formField.querySelector('small');
    error.textContent = message;
  };
</script>

<?= template_footer() ?>
</body>

</html>