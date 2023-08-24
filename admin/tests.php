<?php
include 'main.php';


template_admin_header('Test resultaten', 'tests')
?>

<div class="test-result-btns">
  <button id="generate-pdf" style="display: none;">Download PDF</button>
  <button id="back-button" style="display: none;">Terug naar alles tests</button>
</div>
<style id="test-result-style">
  * {
    font-family: -apple-system, BlinkMacSystemFont, "segoe ui", roboto, oxygen, ubuntu, cantarell, "fira sans", "droid sans", "helvetica neue", Arial, sans-serif;
  }

  .test-result-sum {
    display: flex;
    justify-content: space-between;
    padding: 1em;
    margin-bottom: 1em;
    border-bottom: 1px solid #2d2d2d;
  }

  .test-result-sum p {
    width: min(100%, 66ch);
    display: flex;
    justify-content: space-between;
    background-color: #f0f0f0;
    border: 1px solid #5a5a5a;
  }

  .category {
    padding: 1em 0.5em;
    margin-bottom: 2em;
    border-bottom: 3px double #2d2d2d;
  }

  p,
  ol,
  ul,
  h3,
  h4 {
    padding: 0.5em;

  }

  h3,
  h4 {
    text-align: center;
    border: 1px solid #5555;
    background-color: rgb(221 238 170 / 13%);
  }

  strong {
    text-align: left;
    padding-right: 1em;
  }

  ol,
  ul {
    border: 1px solid #0005;
    background-color: #dedeee;

  }

  .questions li,
  .top-3-questions li,
  .test-result-sum li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    line-height: 1.8;
    padding: 0.25em;
    border-bottom: 1px solid #fff3;
    background-color: rgb(222 222 238 / 0.7);

  }


  .questions li:nth-child(even),
  .top-3-questions li:nth-child(even),
  .test-result-sum li:nth-child(even) {
    background-color: rgb(222 212 222 / 0.8);
  }


  li span {
    padding: 0.25em;
    min-width: 86px;
    text-align: justify;
  }

  li span:last-of-type {
    border: 1px solid #5d5d5d;
  }

  span.score-0 {
    background-color: rgb(236 200 202 / 80%);
  }

  span.score-50 {
    background-color: rgb(216 200 202 / 80%);
  }

  span.score-100 {
    background-color: rgb(210 230 210 / 80%);
  }

  span.score-150 {
    background-color: rgb(170 250 200 / 80%);
  }

  span.score-200 {
    background-color: rgb(120 250 150 / 80%);
  }
</style>
<div id="test-result-container">

  <h2>Test Resultaten</h2>



  <table class="jostable ">
    <thead>
      <tr>
        <th>ID</th>
        <th>Gecreeerd</th>
        <th>Naam</th>
        <th>Email</th>
        <th>Telefoon</th>
        <th>Intake</th>
        <th>Resultaat</th>
        <th>PDF user</th>
        <th>PDF admin</th>
      </tr>
    </thead>
    <tbody>


      <?php
      $stmt = $pdo->query('SELECT * FROM test_results ORDER BY date_created DESC');

      foreach ($stmt as $row) {

        $test_id            = $row['id'];
        $test_name          = $row['name'];
        $test_email         = $row['email'];
        $test_telephone     = $row['telephone'];
        $test_wants_intake  = $row['wants_intake'];
        $test_json          = $row['json_file_url'];
        $test_pdf           = $row['pdf_file_url'];
        $test_pdf_full      = $row['pdf_full_url'];
        $date_created       = date("d-m-y", strtotime($row['date_created']));
        $time_created       = $row['time_created'];
        echo "<tr>"
      ?>
        <td id="test-id-<?= $test_id ?>"> <?= $test_id ?></td>
        <td><?= $date_created ?> </td>
        <td><?= $test_name ?></td>
        <td><?= $test_email ?></td>
        <td><?= $test_telephone ?></td>
        <td><?= ($test_wants_intake) ? 'Ja' : 'Nee' ?></td>
        <td><a href="#" class="json-link" data-json="<?= $test_json ?>" data-user-id="<?= $test_id ?>" data-user-name="<?= $test_name ?>" data-user-email="<?= $test_email ?>" data-created="<?= $date_created ?>">Bekijken</a></td>
        <td><a href="../<?= $test_pdf  ?>" target="_blank">Open</td>
        <td>
          <?php
          if ($test_pdf_full !== null) {
            echo "<a href='" . $test_pdf_full . "' target='_blank'>Open</a>";
          } else {
            echo "*";
          }
          ?>
        </td>
        </tr>

      <?php
      };

      ?>

    </tbody>
  </table>
</div>




<?php if (isset($_SESSION['message'])) {

  unset($_SESSION['message']);
}

?>


<?= template_admin_footer() ?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const jsonLinks = document.querySelectorAll('.json-link');
    const resultContainer = document.getElementById('test-result-container');
    const generatePdfButton = document.getElementById('generate-pdf');
    const backButton = document.getElementById('back-button');


    let originalContent = null;
    let userName;
    let userEmail;
    let userId;
    let userDate;



    function attachEventListeners() {
      const jsonLinks = document.querySelectorAll('.json-link');
      jsonLinks.forEach(link => {
        link.addEventListener('click', function(event) {
          event.preventDefault();
          const jsonFileName = this.getAttribute('data-json');
          userName = this.getAttribute('data-user-name')
          userEmail = this.getAttribute('data-user-email')
          userId = this.getAttribute('data-user-id')

          userDate = this.getAttribute('data-created')
          const jsonFilePath = jsonFileName.replace('admin/', ''); // Remove the "admin/" part
          fetch(jsonFilePath)
            .then(response => response.json())
            .then(data => {
              // Save the original content before displaying the JSON data
              originalContent = resultContainer.innerHTML;

              // Format and display JSON data
              const formattedData = formatData(data);
              resultContainer.innerHTML = formattedData;

              // Show the "Generate PDF" button
              generatePdfButton.style.display = 'block';
              backButton.style.display = 'block';

              // Attach event listeners to newly added "Bekijken" links
              attachEventListeners();
            })
            .catch(error => {
              console.error('Error fetching JSON:', error);
            });
        });
      });
    }

    // Attach event listeners to initial "Bekijken" links
    attachEventListeners();

    function formatData(data) {

      function calculateCategoryScores(data) {
        const categoryScores = {};
        let totalCategoryScore = 0;
        let totalMaxScore = 0;

        for (const categoryId in data.categories) {
          const category = data.categories[categoryId];
          const categoryScore = category.categoryScore;
          const maxScore = category.maxScore;

          categoryScores[categoryId] = {
            score: categoryScore,
            maxScore: maxScore
          };
          totalCategoryScore += categoryScore;
          totalMaxScore += maxScore;
        }

        return {
          categoryScores,
          totalCategoryScore,
          totalMaxScore
        };
      }

      // Calculate category scores and totals
      const {
        categoryScores,
        totalCategoryScore,
        totalMaxScore
      } = calculateCategoryScores(data);


      // Format the user info
      const userInfo = `
      <div class="test-result-sum">
      <div class="info">
        <h2>KernTest Resultaten</h2>
        <p><strong>Naam:</strong> ${data.userinfo.name}</p>

        <p><strong>Email:</strong> ${data.userinfo.email}</p>
        <p><strong>Telefoon:</strong> ${data.userinfo.telephone}</p>
        <p><strong>Gecreeerd op:</strong> ${userDate} </p>
       </div>
      <div class="total-scores">
        <p>Totaal Categorie Scores:</p>
        <ul>
        ${Object.keys(categoryScores).map(categoryId => `
          <li><span>Categorie ${categoryId}:</span> <span>${categoryScores[categoryId].score} / ${categoryScores[categoryId].maxScore}</span></li>
        `).join('')}
      </ul>
      <p>Totale score: ${totalCategoryScore} / ${totalMaxScore}</p>
      </div>
      </div>


      `;

      // Format the category data
      let categoryInfo = '';
      for (const categoryId in data.categories) {
        const category = data.categories[categoryId];
        const allCategoryQuestions = Object.values(data.questions)
          .filter(question => question.categoryId === Number(categoryId))
          .map(question => `
            <li><span>Vraag: ${question.questionId} - ' ${question.content} '</span> <span class="score-${question.score}">Score: ${question.score}</span></li>
          `).join('');

        const top3CategoryQuestions = category.top3questionIds.map((questionId, index) => {
          const question = data.questions[questionId];
          const score = category.top3questionScores[index];
          return `
            <li><span> Vraag: ${questionId} - ' ${question.content} </span>' <span class="score-${score}"> Score: ${score}</span></li>
          `;
        }).join('');

        categoryInfo += `
          <div class="category">
            <h3>Category ${category.categoryId} - ${category.content}</h3>
            <ol class="questions">
              ${allCategoryQuestions}
            </ol>
            <p style="text-align: right;">Max Score: ${category.maxScore} - Total Score: ${category.categoryScore}</p>
            <h4>Top 3 vragen</h4>
            <ol class="top-3-questions">
              ${top3CategoryQuestions}
            </ol>
          </div>
        `;
      }

      return userInfo + categoryInfo;



    }




    generatePdfButton.addEventListener('click', function() {
      // Get the formatted data from the resultContainer

      const formattedData = document.getElementById('test-result-container').innerHTML;

      const headerData = `<html>
      <head>
      <link rel="stylesheet" type="text/css" href="fullPDFstyle.css">
      </head>
      <body>
      ${formattedData}
      </body>
      </html>
      `


      // Send the formatted data to the server
      fetch('generate_pdf.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            headerData,
            id: Number(userId),
            name: userName,
            email: userEmail

          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.pdfUrl) {
            // Redirect to the generated PDF for download
            console.log('hier ben ik')
            window.open(data.pdfUrl, '_blank');
          }
        })
        .catch(error => {
          console.error('Error generating PDF:', error);
        });
    });
    // Handle "Back" button click
    backButton.addEventListener('click', function() {
      if (originalContent !== null) {
        // Restore the original content
        resultContainer.innerHTML = originalContent;

        // Hide the "Generate PDF" button
        generatePdfButton.style.display = 'none';
        backButton.style.display = 'none';

        originalContent = null;
        attachEventListeners()
      }
    });
  });
</script>