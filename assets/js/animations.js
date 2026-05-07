/**
 * NusaQu Theme - Scroll Animations
 */
(function() {
  'use strict';

  // Intersection Observer for scroll animations
  const observerOptions = {
    root: null,
    rootMargin: '0px 0px -50px 0px',
    threshold: 0.1
  };

  const observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Observe all animated elements
  document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('.fade-in, .fade-in-left, .fade-in-right, .scale-in');
    animatedElements.forEach(function(el) {
      observer.observe(el);
    });
  });

  // Smooth image loading
  document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.post-card img, .featured-card img');
    images.forEach(function(img) {
      img.addEventListener('load', function() {
        this.classList.add('loaded');
      });
      if (img.complete) {
        img.classList.add('loaded');
      }
    });
  });
})();
