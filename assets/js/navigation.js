/**
 * NusaQu Theme - Navigation
 */
(function() {
  'use strict';

  const header = document.querySelector('.site-header');
  const menuToggle = document.querySelector('.menu-toggle');
  const navigation = document.querySelector('.main-navigation');

  // Sticky header scroll effect
  let lastScroll = 0;
  window.addEventListener('scroll', function() {
    const currentScroll = window.pageYOffset;
    if (currentScroll > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
    lastScroll = currentScroll;
  }, { passive: true });

  // Mobile menu toggle
  if (menuToggle && navigation) {
    menuToggle.addEventListener('click', function() {
      navigation.classList.toggle('toggled');
      menuToggle.classList.toggle('active');
      document.body.classList.toggle('menu-open');

      const expanded = menuToggle.getAttribute('aria-expanded') === 'true';
      menuToggle.setAttribute('aria-expanded', !expanded);
    });

    // Close menu on link click
    navigation.querySelectorAll('a').forEach(function(link) {
      link.addEventListener('click', function() {
        navigation.classList.remove('toggled');
        menuToggle.classList.remove('active');
        document.body.classList.remove('menu-open');
      });
    });

    // Close menu on escape
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && navigation.classList.contains('toggled')) {
        navigation.classList.remove('toggled');
        menuToggle.classList.remove('active');
        document.body.classList.remove('menu-open');
        menuToggle.focus();
      }
    });
  }

  // Reading progress bar (single posts)
  const progressBar = document.querySelector('.reading-progress');
  if (progressBar) {
    window.addEventListener('scroll', function() {
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;
      const scrolled = (window.pageYOffset / docHeight) * 100;
      progressBar.style.width = Math.min(scrolled, 100) + '%';
    }, { passive: true });
  }
})();
