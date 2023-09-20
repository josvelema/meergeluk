<?php include 'functions.php'; ?>
<?= template_header('Meer Geluk - GeluksKompas') ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?= template_nav() ?>

<main class="gelukskompas">
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
          <h1>Geluks Kompas</h1>
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
     
      <p class="form-question">${question.content}</p>
      <div class="form-group" data-category="${question.categoryId}">
        
        <div class="radio-group">
          <input type="radio" id="question-${question.questionId}-option-1" name="question-${question.questionId}" value="0">
          <label for="question-${question.questionId}-option-1">Totaal niet!</label>
          <input type="radio" id="question-${question.questionId}-option-2" name="question-${question.questionId}" value="50">
          <label for="question-${question.questionId}-option-2">Oneens</label>
          <input type="radio" id="question-${question.questionId}-option-3" name="question-${question.questionId}" value="100">
          <label for="question-${question.questionId}-option-3">Neutraal</label>
          <input type="radio" id="question-${question.questionId}-option-4" name="question-${question.questionId}" value="150">
          <label for="question-${question.questionId}-option-4">Mee eens</label>
          <input type="radio" id="question-${question.questionId}-option-5" name="question-${question.questionId}" value="200">
          <label for="question-${question.questionId}-option-5">Ja, dit is typisch mij</label>
        </div>
        </div>
    </div>
  `;
  };

  // get the form
  const form = document.getElementById('multistep-form');

  // get the question steps container
  const questionSteps = document.getElementById('question-steps');
  // Generate the HTML structure for each question and add it to the form
  // Store the current step index
  let currentStep = 0;

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



  const formMsg = document.querySelector('.form-msg');

  // function to show msg in the form
  const showFormMessage = (message) => {
    formMsg.textContent = message;
    formMsg.style.display = 'block';
  };

  // Function to hide the form message

  const hideFormMessage = () => {
    formMsg.textContent = '';
    formMsg.style.display = 'none';
  };

  // Function to update the progress bar based on the current step
  const updateProgressBar = () => {
    const adjustedTotalSteps = formSections.length - 2;
    const adjustedCurrentStep = currentStep - 1;

    const progressPercentage = (adjustedCurrentStep / adjustedTotalSteps) * 100;
    progress.style.width = `${progressPercentage}%`;

    progressText.textContent = `${Math.round(progressPercentage)}% van de vragen beantwoord.`;
  };


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
      nextBtn.innerHTML = 'Bereken uw scores';
      nextBtn.classList.add('btn--scoreCalculation');
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

    // check if next btn contains class btn--scoreCalculation
    nextBtn.classList.contains('btn--scoreCalculation') ? nextBtn.addEventListener('click', calculateScores) : nextBtn.removeEventListener('click', calculateScores);


    // Update the progress bar
    (currentStep !== 0 && currentStep !== formSections.length - 1) ? updateProgressBar(): null;
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
          showFormMessage('Vul alstublieft uw naam en e-mailadres in.');
          return;
        }
        // validate the email address using a regular expression
        const emailRegex = /\S+@\S+\.\S+/;
        if (!emailRegex.test(emailInput.value)) {
          showFormMessage('Vul alstublieft een geldig e-mailadres in.');
          return;
        }
        // validate the telephone number using a regular expression , allow for spaces, dashes, and parentheses in the number
        const phoneRegex = /^\(?[\d\s]{3}\)?[\s-]?[\d\s]{3}[\s-]?[\d\s]{4}$/;
        if (!phoneRegex.test(document.getElementById('phone').value)) {
          showFormMessage('Vul alstublieft een geldig telefoonnummer in.');
          return;
        }

        hideFormMessage();

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

        // check if current step is motitvating message 1 or 2 or the last step (switch statement)

        switch (currentStep) {
          case motivatingMessage1Index:
            showFormMessage('U bent al op de helft van de vragenlijst. Ga zo door!');
            break;
          case motivatingMessage2Index:
            showFormMessage('U bent bijna klaar met de vragenlijst. Nog even volhouden!');
            break;
          case formSections.length - 1:
            showFormMessage('Klik op score berekenen om uw resultaten te zien.');
            break;
          default:
            hideFormMessage();
        }


        // Check if all questions in the current step are answered
        const questionInputs = questionsInCategory.map((question) => {
          return question.querySelector('input[type="radio"]:checked');
        });

        if (questionInputs.some((input) => !input)) {
          showFormMessage('Beantwoord alstublieft alle vragen voordat u doorgaat.');
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



      document.getElementById('wantsPDF').checked ? userInfo.wantsPDF = true : userInfo.wantsPDF = false;
      document.getElementById('wantsIntake').checked ? userInfo.wantsIntake = true : userInfo.wantsIntake = false;





    }


  };



  // Function to handle the previous button click
  const handlePrevClick = () => {
    // Move to the previous step if available
    hideFormMessage();
    if (currentStep > 0) {
      currentStep--;
      showStep(currentStep);
    }
  };

  // Add event listeners to the previous and next buttons
  prevBtn.addEventListener('click', handlePrevClick);
  nextBtn.addEventListener('click', handleNextClick);

  const calculateScores = () => {
    // complete the progress bar
    progress.style.width = '100%';
    progressText.textContent = '100% van de vragen beantwoord.';
    // hide the prev and next buttons
    prevBtn.style.display = 'none';
    nextBtn.style.display = 'none';
    // get the last question and result screen
    const lastQuestion = document.querySelector('.result-screen-last-question');
    const resultContent = document.querySelector('.result-screen-content');
    // hide lastQuestion with visibility hidden and timeout of 1 second
    lastQuestion.style.visibility = 'hidden';
    resultContent.style.visibility = 'visible';
    setTimeout(() => {
      lastQuestion.style.display = 'none';
    }, 600);
    resultContent.style.display = 'block';




    console.log('Calculating scores...');
    console.log('Questions:', questions);
    console.log('Categories:', categories);
    console.log('User Info:', userInfo);

    // Loop through all the questions
    Object.values(categories).forEach((category) => {
      const categoryId = category.categoryId;
      const questionsInCategory = Object.values(questions).filter((question) => question.categoryId === categoryId);

      console.log('Questions in Category:', questionsInCategory);

      // total questions in category
      const totalQuestionsInCategory = questionsInCategory.length;

      // max score for category
      category.maxScore = totalQuestionsInCategory * 200;



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

    userResultscreen()


  };


  // show the user the result screen
  const userResultscreen = () => {
    // Log the updated scores
    console.log('Updated Questions:', questions);
    console.log('Updated Categories:', categories);


    // get the max total score
    const maxTotalScore = Object.values(categories).reduce((total, category) => {
      return total + category.maxScore;
    }, 0);

    // get the category results container
    const categoryResultsContainer = document.getElementById('category-results');

    // get the score result container
    const scoreResultContainer = document.getElementById('score-result');

    // calculate the total score and display it
    const totalScore = Object.values(categories).reduce((total, category) => {
      return total + category.categoryScore;
    }, 0);

    scoreResultContainer.innerHTML = `<strong>${totalScore}</strong> van de ${maxTotalScore} punten`;

    // create a html template for the category results
    const categoryResultsHTML = Object.values(categories).map((category) => {
      return `
      <div class="category-result">
        <h4>${category.content}</h4>
        
        <div><p>Score:</p> <p><strong>${category.categoryScore}</strong> punten</p><p>van ${category.maxScore}</p></div>

      </div>
    `;
    });

    // Insert the category results HTML into the category results container
    categoryResultsContainer.innerHTML = categoryResultsHTML.join('');

    // if wantsPDF goto generatePDF function else show html element with exit button
    let exitHTML = `
    <p>
      Bedankt voor het doen van de test, uw resultaten worden niet opgeslagen. U kunt terug gaan naar de home pagina.
    </p>
    <button id="exit-btn" class="btn btn--form">Sluit test</button>`

    let submitHTML = `
    <p>
      Bedankt voor het doen van de test, U kunt op verzenden klikken om de uitgebreide resultaten te ontvangen in uw e-mail.
      Daarna wordt u doorgestuurd naar de home pagina.
      <button id="submit-btn" class="btn btn--form">Verzenden</button>
    </p>`

    if (userInfo.wantsPDF) {

      document.getElementById('result-screen').insertAdjacentHTML('beforeend', submitHTML);
      document.getElementById('submit-btn').addEventListener('click', submitResults);

    } else {
      document.getElementById('result-screen').insertAdjacentHTML('beforeend', exitHTML);
      // add event listener to exit button
      document.getElementById('exit-btn').addEventListener('click', () => {
        window.location.href = '/';
      });
    }



  }



  // Show the initial step
  showStep(currentStep);

  const submitResults = (event) => {
    // Prevent the form from submitting
    event.preventDefault();

    console.log('Submitting results...');

    // Create the data object to be submitted
    const data = {
      [userInfoKey]: userInfo,
      [questionsKey]: questions,
      [categoriesKey]: categories,
    };

    // Generate the HTML snippet with the score results per category
    const categoryResultsHTML = Object.values(categories).map((category) => {
      // Get the top 3 question IDs and scores in the category
      const top3QuestionIds = category.top3questionIds;
      const top3QuestionScores = category.top3questionScores;

      // Retrieve the question content for the top 3 questions
      // const top3Questions = top3QuestionIds.map((questionId) => questions[questionId].content);
      const top3Questions = top3QuestionIds.map((questionId) => questions[questionId]?.content || '');

      return `
      <div class="category-result-pdf">
        <h3>${category.content}</h3>
        <div>
          <p>Score: <strong>${category.categoryScore}</strong> punten van ${category.maxScore}</p>
          <p>
          Top 3
          </p>
          <ol>
            <li> "${top3Questions[0]}" lsd</li>
            <li> "${top3Questions[1]}"</li>
            <li> "${top3Questions[2]}"</li>
            
          </ol>
        </div>
      </div>
    `;
    });

    //   ${category.top3QuestionScores[0]}
    // ${category.top3QuestionScores[1]}
    // ${category.top3QuestionScores[2]}

    // Convert the category results HTML to a string
    const categoryResultsString = categoryResultsHTML.join('');

    // Include the HTML snippet in the data object
    data.categoryResultsHTML = categoryResultsString;

    // Use the Fetch API to send a POST request to the server
    fetch('admin/submitTestResults.php', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
          'Content-Type': 'application/json',
        },
      })
      .then((response) => response.json())
      .then((response) => {
        if(response.success)  {
          
        console.log('Results submitted successfully! Email to:');
        console.log(response.userEmail)
        console.log(response.userId)

        const emailData = {
          userEmail: response.userEmail,
          userId: response.userId,

        }
        // Call the sendEmail.php script to send the email
        fetch('admin/sendEmail.php', {
            method: 'POST',
            body: JSON.stringify(emailData),
            headers: {
              'Content-Type': 'application/json',
            },
          })
          .then((emailResponse) => emailResponse.text())
          .then((emailResponse) => {
            if(emailResponse.success) {
              alert("Gelukt!")
            } else {
              console.log(emailResponse.errors);
            }
          })
          .catch((emailError) => {
            console.error('Email sending error:', emailError);
          });

        }else {
      console.log('Results submission failed.');
      // Handle the case when the submission failed, e.g., show an error message to the user.
    }

      })
      .catch((error) => {
        console.error(error);
      });
  };

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