/**
* Projeta USA - Final Animated JS
*/

document.addEventListener('DOMContentLoaded', () => {
  "use strict";

  // 1. Preloader
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove();
    });
  }

  // 2. STICKY HEADER LOGIC
  const selectHeader = document.querySelector('#header');
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('sticked');
      } else {
        selectHeader.classList.remove('sticked');
      }
    }
    window.addEventListener('load', headerScrolled);
    document.addEventListener('scroll', headerScrolled);
  }

  // 3. Mobile Nav Toggle
  const mobileNavShow = document.querySelector('.mobile-nav-show');
  const mobileNavHide = document.querySelector('.mobile-nav-hide');

  document.querySelectorAll('.mobile-nav-toggle').forEach(el => {
    el.addEventListener('click', function (event) {
      event.preventDefault();
      document.querySelector('body').classList.toggle('mobile-nav-active');
      mobileNavShow.classList.toggle('d-none');
      mobileNavHide.classList.toggle('d-none');
    });
  });

  // 4. Scroll Top Button
  const scrollTop = document.querySelector('.scroll-top');
  if (scrollTop) {
    const togglescrollTop = function () {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
    window.addEventListener('load', togglescrollTop);
    document.addEventListener('scroll', togglescrollTop);
    scrollTop.addEventListener('click', window.scrollTo({ top: 0, behavior: 'smooth' }));
  }

  // 5. ANIMATIONS ON SCROLL (Intersection Observer)
  const observerOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0.15 // Ativa quando 15% do elemento está visível
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        // observer.unobserve(entry.target); // Opcional: animar apenas uma vez
      }
    });
  }, observerOptions);

  // MUDANÇA: Agora observa tanto texto quanto imagens
  const animatedElements = document.querySelectorAll('.animate-on-scroll, .animate-image-reveal');
  animatedElements.forEach((el) => observer.observe(el));

  // 6. Init Plugins
  const glightbox = GLightbox({ selector: '.glightbox' });
  new PureCounter();

});