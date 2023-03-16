const navBtn = document.querySelector("#menu-btn");
const nav = document.querySelector("nav");
const navLinks = document.querySelector(".nav-links");
const navLink = document.querySelectorAll(".nav-link");
const header = document.querySelector("header");


// active page
navLink.forEach(link => {
  console.log((link.href , window.location.href));
  if(link.href === window.location.href) {
    link.setAttribute('aria-current', 'page')
  };
})

// --

navBtn.addEventListener('click' , () => {
  navLinks.classList.add('activated')
  const isExpanded = JSON.parse(navBtn.getAttribute('aria-expanded'));
  navBtn.setAttribute('aria-expanded' , !isExpanded);

  !isExpanded && nav.classList.add('active')

})

// window.addEventListener('DOMContentLoaded', () => {
// })


// INTERSECTION OBSERVERS
const navObserver = new IntersectionObserver((watchEntry) => {
  !watchEntry[0].isIntersecting ? nav.classList.add('active') : nav.classList.remove('active');
}, {threshold: 0.85});

navObserver.observe(document.querySelector('.profile-picture'));

const fadeUpObserver = new IntersectionObserver((elsToWatch) => {
  elsToWatch.forEach((el) => {
    if (el.isIntersecting) {
      el.target.classList.add('faded');
      fadeUpObserver.unobserve(el.target);
    }
  });
}, {threshold: 0.10});

document.querySelectorAll('.fade-up').forEach((item) => {
  fadeUpObserver.observe(item);
});

const readMoreButton = document.querySelector('.btn--accent');
const overlay = document.querySelector('.overlay');
const tab = document.querySelector('.tab');
const closeButton = document.querySelector('.tab-close');

readMoreButton.addEventListener('click', () => {
overlay.classList.add('active');
tab.classList.add('active');
});

closeButton.addEventListener('click', () => {
overlay.classList.remove('active');
tab.classList.remove('active');
});

