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

function loadReviews(review, isCategoryPage) {
  if (isCategoryPage) {
    return `
      <div class="review">
        <p class="review__name"><strong>${review.name}</strong></p>
        <p class="review__quote"><strong>${review.quote}</strong></p>
        <p class="review__body">${review.body}</p>
      </div>
    `;
  } else {
    return `
    
    <div class="review">
      <p class="review__name"><strong>${review.name}</strong></p>
      <p class="review__quote"><strong>${review.quote}</strong></p>
      </div>
  
    `;
  }
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
    intervalId = setInterval(moveSlider, 4500);
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
async function fetchReviews(category = null) {
  try {
    const response = await fetch('assets/js/reviews.json');
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const data = await response.json();
    reviews = category ? data.filter(review => review.category === category) : data;
    // 2. Parse the data and create the 'review' divs
    const isCategoryPage = category !== null;
    document.querySelector('.reviews').innerHTML = reviews.map(review => loadReviews(review, isCategoryPage)).join('');
    if (isCategoryPage) {
      // Don't start the automatic slider if it's a category page
      pauseSvg.style.display = 'none';
      playPauseButton.style.display = 'none';
    } else {
      startSlider(); // Start the automatic slider
      pauseSvg.style.display = 'block'; // Display pause button by default
      playPauseButton.style.display = 'block';
    }
  } catch (error) {
    console.error('There has been a problem with your fetch operation:', error);
  }
}

// 3. Add event listeners to move the slider left and right
document.querySelector('#arrow--right').addEventListener('click', () => {
  stopSlider(); // Stop the automatic slider when the user clicks on the arrow
  moveSlider(event);
});
document.querySelector('#arrow--left').addEventListener('click', () => {
  stopSlider(); // Stop the automatic slider when the user clicks on the arrow
  moveSlider(event);
});


// Add event listener to the play/pause button
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

// Hide the play button and show the pause button since the slider is playing by default
playSvg.style.display = 'none';
pauseSvg.style.display = 'block';
