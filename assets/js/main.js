/**
 * NusaQu Theme - Main JS
 */
(function() {
  'use strict';

  var header = document.querySelector('.site-header');
  var menuToggle = document.querySelector('.menu-toggle');
  var navigation = document.querySelector('.main-nav');
  var modal = document.getElementById('nqModal');
  var modalClose = document.getElementById('modalClose');

  // Sticky header with shadow
  var ticking = false;
  window.addEventListener('scroll', function() {
    if (!ticking) {
      requestAnimationFrame(function() {
        header.classList.toggle('scrolled', window.pageYOffset > 30);
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });

  // Mobile menu
  if (menuToggle && navigation) {
    menuToggle.addEventListener('click', function() {
      var expanded = this.getAttribute('aria-expanded') === 'true';
      this.setAttribute('aria-expanded', !expanded);
      navigation.classList.toggle('toggled');
      document.body.classList.toggle('menu-open');
    });
  }

  // Close on Escape
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      if (navigation && navigation.classList.contains('toggled')) {
        navigation.classList.remove('toggled');
        menuToggle.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('menu-open');
      }
      if (modal && modal.classList.contains('active')) {
        closeModal();
      }
    }
  });

  // === MODAL POPUP ===
  var modalShown = false;

  function showModal() {
    if (modalShown || !modal) return;
    if (sessionStorage.getItem('nq_modal_closed')) return;
    modal.classList.add('active');
    modalShown = true;
  }

  function closeModal() {
    if (!modal) return;
    modal.classList.remove('active');
    sessionStorage.setItem('nq_modal_closed', '1');
  }

  if (modalClose) {
    modalClose.addEventListener('click', closeModal);
  }

  if (modal) {
    modal.addEventListener('click', function(e) {
      if (e.target === modal) closeModal();
    });
  }

  // Show modal after 12 seconds OR 50% scroll
  setTimeout(showModal, 12000);

  var scrollTriggered = false;
  window.addEventListener('scroll', function() {
    if (scrollTriggered) return;
    var scrollPercent = (window.pageYOffset / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
    if (scrollPercent > 50) {
      scrollTriggered = true;
      showModal();
    }
  }, { passive: true });

  // === SCROLL ANIMATIONS ===
  var observer = new IntersectionObserver(function(entries) {
    for (var i = 0; i < entries.length; i++) {
      if (entries[i].isIntersecting) {
        entries[i].target.classList.add('visible');
        observer.unobserve(entries[i].target);
      }
    }
  }, { rootMargin: '0px 0px -40px 0px', threshold: 0.1 });

  document.addEventListener('DOMContentLoaded', function() {
    var els = document.querySelectorAll('.fade-in, .fade-in-left, .fade-in-right, .scale-in');
    for (var i = 0; i < els.length; i++) observer.observe(els[i]);
  });

  // === READING PROGRESS ===
  var progressBar = document.querySelector('.reading-progress');
  if (progressBar) {
    var pTicking = false;
    window.addEventListener('scroll', function() {
      if (!pTicking) {
        requestAnimationFrame(function() {
          var h = document.documentElement.scrollHeight - window.innerHeight;
          progressBar.style.width = Math.min((window.pageYOffset / h) * 100, 100) + '%';
          pTicking = false;
        });
        pTicking = true;
      }
    }, { passive: true });
  }
})();
