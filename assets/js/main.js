/**
 * NusaQu Theme - Combined JS (Navigation + Animations)
 */
(function() {
  'use strict';

  // === NAVIGATION ===
  var header = document.querySelector('.site-header');
  var menuToggle = document.querySelector('.menu-toggle');
  var navigation = document.querySelector('.main-navigation');
  var searchToggle = document.querySelector('.search-toggle');
  var searchOverlay = document.querySelector('.search-overlay');

  // Sticky header
  var ticking = false;
  window.addEventListener('scroll', function() {
    if (!ticking) {
      requestAnimationFrame(function() {
        header.classList.toggle('scrolled', window.pageYOffset > 50);
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

  // Search toggle
  if (searchToggle && searchOverlay) {
    searchToggle.addEventListener('click', function() {
      searchOverlay.classList.toggle('active');
      if (searchOverlay.classList.contains('active')) {
        searchOverlay.querySelector('input').focus();
      }
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
      if (searchOverlay && searchOverlay.classList.contains('active')) {
        searchOverlay.classList.remove('active');
      }
    }
  });

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

  // === READING PROGRESS (single posts) ===
  var progressBar = document.querySelector('.reading-progress');
  if (progressBar) {
    var progressTicking = false;
    window.addEventListener('scroll', function() {
      if (!progressTicking) {
        requestAnimationFrame(function() {
          var h = document.documentElement.scrollHeight - window.innerHeight;
          progressBar.style.width = Math.min((window.pageYOffset / h) * 100, 100) + '%';
          progressTicking = false;
        });
        progressTicking = true;
      }
    }, { passive: true });
  }
})();
