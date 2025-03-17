document.addEventListener('DOMContentLoaded', function() {
    // Mobile Navigation Toggle
    const navToggle = document.getElementById('nav-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    
    if (navToggle) {
      navToggle.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
        // Rotate hamburger icon when toggled
        hamburgerIcon.classList.toggle('rotate-90');
      });
    }
    
    // Application Form Validation (if the form exists)
    const applicationForm = document.getElementById('applicationForm');
    if (applicationForm) {
      applicationForm.addEventListener('submit', function(e) {
        const fullName = document.getElementById("fullName").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const position = document.getElementById("position").value;
    
        if (!fullName || !email || !phone || !position) {
          alert("Please fill in all required fields.");
          e.preventDefault();
          return;
        }
    
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
          alert("Please enter a valid email address.");
          e.preventDefault();
          return;
        }
    
        const phonePattern = /^[0-9\-+()\s]+$/;
        if (!phonePattern.test(phone)) {
          alert("Please enter a valid phone number.");
          e.preventDefault();
          return;
        }
    
        // If all validation passes, allow the form to submit
        alert("Application submitted successfully!");
      });
    }
  });
  