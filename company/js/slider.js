const slider = document.querySelector(".slider");
const slides = Array.from(slider.querySelectorAll("img"));
const dotsContainer = document.querySelector(".slider-dots");

// Create dots dynamically
slides.forEach((slide, index) => {
  const dot = document.createElement("span");
  dot.classList.add("dot");
  dot.addEventListener("click", () => handleDotClick(index));
  dotsContainer.appendChild(dot);
});

const dots = Array.from(dotsContainer.getElementsByClassName("dot"));

let currentSlideIndex = 0;
let slideInterval;

// Function to switch to the next slide
function nextSlide() {
  slides[currentSlideIndex].classList.remove("active");
  dots[currentSlideIndex].classList.remove("active");
  currentSlideIndex = (currentSlideIndex + 1) % slides.length;
  slides[currentSlideIndex].classList.add("active");
  dots[currentSlideIndex].classList.add("active");
}

// Function to switch to the previous slide
function prevSlide() {
  slides[currentSlideIndex].classList.remove("active");
  dots[currentSlideIndex].classList.remove("active");
  currentSlideIndex = (currentSlideIndex - 1 + slides.length) % slides.length;
  slides[currentSlideIndex].classList.add("active");
  dots[currentSlideIndex].classList.add("active");
}

// Function to handle dot click
function handleDotClick(index) {
  slides[currentSlideIndex].classList.remove("active");
  dots[currentSlideIndex].classList.remove("active");
  currentSlideIndex = index;
  slides[currentSlideIndex].classList.add("active");
  dots[currentSlideIndex].classList.add("active");
}

// Start the slider interval
function startSlider() {
  slideInterval = setInterval(nextSlide, 1500);
}

// Stop the slider interval
function stopSlider() {
  clearInterval(slideInterval);
}

// Initialize slider
slides[currentSlideIndex].classList.add("active");
dots[currentSlideIndex].classList.add("active");
startSlider();

// Pause slider on hover
slider.addEventListener("mouseenter", stopSlider);
slider.addEventListener("mouseleave", startSlider);

// Swipe functionality
let touchStartX = 0;
let touchEndX = 0;

slider.addEventListener("touchstart", (event) => {
  touchStartX = event.touches[0].clientX;
});

slider.addEventListener("touchend", (event) => {
  touchEndX = event.changedTouches[0].clientX;
  handleSwipe();
});

function handleSwipe() {
  const swipeThreshold = 100;
  if (touchStartX - touchEndX > swipeThreshold) {
    nextSlide();
  } else if (touchEndX - touchStartX > swipeThreshold) {
    prevSlide();
  }
}

// Keyboard functionality
document.addEventListener("keydown", (event) => {
  if (event.key === "ArrowRight") {
    nextSlide();
  } else if (event.key === "ArrowLeft") {
    prevSlide();
  }
});
