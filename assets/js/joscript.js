      
      document.addEventListener('DOMContentLoaded', () => {
        const readMoreButtons = document.querySelectorAll('[data-read-more]');
        const closeButtons = document.querySelectorAll('[data-close]');
        const dropdownToggle = document.querySelector('.dropdown-toggle');
        const dropdownMenu = document.querySelector('.dropdown-menu');
    
        dropdownToggle.addEventListener('click', function() {
          const expanded = dropdownToggle.getAttribute('aria-expanded') === 'true';
          dropdownToggle.setAttribute('aria-expanded', !expanded);
        });
    
        window.addEventListener('click', function(event) {
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
      faqItems.forEach(function(item) {
        const button = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        button.addEventListener('click', function() {
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