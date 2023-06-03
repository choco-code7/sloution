//////////////////////
// Features
///////////////////

// Function to animate the features
function animateFeatures(entries, observer) {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      const feature = entry.target;
      feature.style.opacity = "1";
      feature.style.transform = "translateY(0)";
      feature.style.transitionDelay = `${feature.dataset.index * 0.2}s`; // Add delay to stagger the animation
    }
  });
}

// Create a new Intersection Observer
const featureObserver = new IntersectionObserver(animateFeatures, {
  root: null,
  rootMargin: "0px",
  threshold: 0.2, // Trigger the animation when 20% of the element is visible
});

// Observe each feature element
const features = document.querySelectorAll(".feature");
features.forEach((feature, index) => {
  feature.style.opacity = "0";
  feature.style.transform = "translateY(100px)";
  feature.dataset.index = index; // Store the index as a data attribute
  featureObserver.observe(feature);
});
