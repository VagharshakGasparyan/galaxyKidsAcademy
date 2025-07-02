const galleryItems = document.querySelectorAll(".gallery-item");
const slideshow = document.getElementById("slideshow");
const slideshowImg = document.getElementById("slideshow-img");
const closeBtn = document.querySelector(".close");
const prevBtn = document.querySelector(".prev");
const nextBtn = document.querySelector(".next");

let currentIndex = 0;

// Show clicked image
galleryItems.forEach((item, index) => {
    item.addEventListener("click", () => {
        currentIndex = index;
        showSlide();
    });
});

function showSlide() {
    slideshow.style.display = "flex";
    slideshowImg.src = galleryItems[currentIndex].src;
}

// Next/prev
nextBtn.addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % galleryItems.length;
    showSlide();
});
prevBtn.addEventListener("click", () => {
    currentIndex =
        (currentIndex - 1 + galleryItems.length) % galleryItems.length;
    showSlide();
});

// Close
closeBtn.addEventListener("click", () => (slideshow.style.display = "none"));

// Close when clicking outside image
slideshow.addEventListener("click", (e) => {
    if (e.target === slideshow) slideshow.style.display = "none";
});
