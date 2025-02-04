document.addEventListener("DOMContentLoaded", function () {
  // Mood Tracker Form Submission
  document.getElementById("mood-form").addEventListener("submit", function (e) {
    e.preventDefault();
    const mood = document.querySelector('input[name="mood"]:checked').value;
    alert(`Mood submitted: ${mood}`);
    // Disable button after submission
    document.querySelector(".mood-button").disabled = true;
  });

  // Scroll Visibility for Features (Feature Cards)
  function checkVisibility() {
    const features = document.querySelectorAll(".feature-card, .feature");
    features.forEach((feature) => {
      const rect = feature.getBoundingClientRect();
      if (rect.top < window.innerHeight && rect.bottom >= 0) {
        feature.classList.add("visible");
      }
    });
  }

  window.addEventListener("scroll", checkVisibility);
  checkVisibility(); // Initial check to make sure features that are in view are animated

  // Animation for CTA buttons (after a short delay)
  setTimeout(() => {
    const ctaButtons = document.querySelectorAll(".cta-button");
    ctaButtons.forEach((button) => {
      button.style.transform = "translateY(0)";
      button.style.opacity = "1";
      button.style.transition = "transform 0.5s ease, opacity 0.5s ease";
    });
  }, 500); // Delay for smooth appearance
});

