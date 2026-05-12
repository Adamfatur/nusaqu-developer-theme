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
        if (header) header.classList.toggle('scrolled', window.pageYOffset > 30);
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });

  // === MOBILE MENU ===
  function openMenu() {
    if (!menuToggle || !navigation) return;
    menuToggle.setAttribute('aria-expanded', 'true');
    navigation.classList.add('toggled');
    document.body.classList.add('menu-open');
  }

  function closeMenu() {
    if (!menuToggle || !navigation) return;
    menuToggle.setAttribute('aria-expanded', 'false');
    navigation.classList.remove('toggled');
    document.body.classList.remove('menu-open');
  }

  if (menuToggle && navigation) {
    menuToggle.addEventListener('click', function() {
      var expanded = this.getAttribute('aria-expanded') === 'true';
      if (expanded) {
        closeMenu();
      } else {
        openMenu();
      }
    });

    // Close menu when clicking a nav link
    var navLinks = navigation.querySelectorAll('a');
    for (var i = 0; i < navLinks.length; i++) {
      navLinks[i].addEventListener('click', function() {
        closeMenu();
      });
    }

    // Close menu on outside click (tap on overlay area)
    navigation.addEventListener('click', function(e) {
      if (e.target === navigation) {
        closeMenu();
      }
    });
  }

  // Close on Escape
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      if (navigation && navigation.classList.contains('toggled')) {
        closeMenu();
      }
      if (modal && modal.classList.contains('active')) {
        closeModal();
      }
    }
  });

  // Close menu on resize to desktop
  var resizeTimer;
  window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
      if (window.innerWidth > 768 && navigation && navigation.classList.contains('toggled')) {
        closeMenu();
      }
    }, 100);
  });

  // === MODAL POPUP ===
  var modalShown = false;

  function showModal() {
    if (modalShown || !modal) return;
    if (sessionStorage.getItem('nq_modal_closed')) return;
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    modalShown = true;
  }

  function closeModal() {
    if (!modal) return;
    modal.classList.remove('active');
    document.body.style.overflow = '';
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
    var docHeight = document.documentElement.scrollHeight - window.innerHeight;
    if (docHeight <= 0) return;
    var scrollPercent = (window.pageYOffset / docHeight) * 100;
    if (scrollPercent > 50) {
      scrollTriggered = true;
      showModal();
    }
  }, { passive: true });

  // === SCROLL ANIMATIONS ===
  if ('IntersectionObserver' in window) {
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
  }

  // === READING PROGRESS ===
  var progressBar = document.querySelector('.reading-progress');
  if (progressBar) {
    var pTicking = false;
    window.addEventListener('scroll', function() {
      if (!pTicking) {
        requestAnimationFrame(function() {
          var h = document.documentElement.scrollHeight - window.innerHeight;
          if (h > 0) {
            progressBar.style.width = Math.min((window.pageYOffset / h) * 100, 100) + '%';
          }
          pTicking = false;
        });
        pTicking = true;
      }
    }, { passive: true });
  }

  // === HERO SLIDER ===
  var slider = document.querySelector('.hero-slider');
  if (slider) {
    var track = slider.querySelector('.slider-track');
    var slides = slider.querySelectorAll('.slider-slide');
    var prevBtn = slider.querySelector('.slider-prev');
    var nextBtn = slider.querySelector('.slider-next');
    var dotsContainer = slider.querySelector('.slider-dots');
    var currentSlide = 0;
    var slideCount = slides.length;
    var autoSlideInterval;

    if (dotsContainer && slideCount > 0) {
      // Create dots
      for (var d = 0; d < slideCount; d++) {
        var dot = document.createElement('button');
        dot.className = 'slider-dot' + (d === 0 ? ' active' : '');
        dot.setAttribute('aria-label', 'Slide ' + (d + 1));
        dot.dataset.index = d;
        dotsContainer.appendChild(dot);
      }
      var dots = dotsContainer.querySelectorAll('.slider-dot');

      function goToSlide(index) {
        if (index < 0) index = slideCount - 1;
        if (index >= slideCount) index = 0;
        currentSlide = index;
        track.style.transform = 'translateX(-' + (currentSlide * 100) + '%)';
        for (var i = 0; i < dots.length; i++) {
          dots[i].classList.toggle('active', i === currentSlide);
        }
      }

      function nextSlide() { goToSlide(currentSlide + 1); }
      function prevSlide() { goToSlide(currentSlide - 1); }

      if (nextBtn) nextBtn.addEventListener('click', function() { nextSlide(); resetAutoSlide(); });
      if (prevBtn) prevBtn.addEventListener('click', function() { prevSlide(); resetAutoSlide(); });

      dotsContainer.addEventListener('click', function(e) {
        var dotEl = e.target.closest('.slider-dot');
        if (dotEl) { goToSlide(parseInt(dotEl.dataset.index)); resetAutoSlide(); }
      });

      // Auto-slide every 5 seconds
      function startAutoSlide() { autoSlideInterval = setInterval(nextSlide, 5000); }
      function resetAutoSlide() { clearInterval(autoSlideInterval); startAutoSlide(); }
      startAutoSlide();

      // Pause on hover
      slider.addEventListener('mouseenter', function() { clearInterval(autoSlideInterval); });
      slider.addEventListener('mouseleave', startAutoSlide);

      // Touch/swipe support
      var touchStartX = 0;
      slider.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
      }, { passive: true });
      slider.addEventListener('touchend', function(e) {
        var touchEndX = e.changedTouches[0].screenX;
        var diff = touchStartX - touchEndX;
        if (Math.abs(diff) > 50) {
          if (diff > 0) nextSlide(); else prevSlide();
          resetAutoSlide();
        }
      }, { passive: true });
    }
  }
})();
