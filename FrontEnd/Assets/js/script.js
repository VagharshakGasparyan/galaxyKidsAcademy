function headerAdj() {
    const navList = document.querySelector(".nav-wrap .nav-list");
    const header = document.querySelector(".header");

    if (window.innerWidth < 767) {
        const headerHeight = header ? header.offsetHeight : 0;
        if (navList) navList.style.paddingTop = `${headerHeight}px`;
    } else {
        if (navList) navList.style.paddingTop = "0";
    }
}

function submenuToggle() {
    const submenuItems = document.querySelectorAll(".nav-list li.with-submenu");

    if (window.innerWidth < 767) {
        submenuItems.forEach((item) => {
            const clone = item.cloneNode(true);
            item.parentNode.replaceChild(clone, item); // remove all listeners
            clone.addEventListener("click", function () {
                this.classList.toggle("is-open");
                const submenu = this.querySelector(".submenu");
                if (submenu) {
                    submenu.style.display =
                        submenu.style.display === "block" ? "none" : "block";
                    submenu.style.transition = "all 0.5s ease";
                }
            });
        });
    }
}

function setupHamburgerAndOverlay() {
    const hamburger = document.querySelector(".hamburger");
    const overlay = document.querySelector(".overlay");
    const navWrap = document.querySelector(".nav-wrap");

    const openSidebar = () => {
        hamburger.classList.toggle("is-active");
        document.body.classList.toggle("sidebar-open");
        document.documentElement.classList.toggle("sidebar-open");
        navWrap.classList.toggle("is-open");
    };

    const closeSidebar = () => {
        hamburger.classList.remove("is-active");
        document.body.classList.remove("sidebar-open");
        document.documentElement.classList.remove("sidebar-open");
        navWrap.classList.remove("is-open");
    };

    if (window.innerWidth < 767) {
        if (hamburger) {
            const clone = hamburger.cloneNode(true);
            hamburger.parentNode.replaceChild(clone, hamburger);
            clone.addEventListener("click", openSidebar);
        }

        if (overlay) {
            const clone = overlay.cloneNode(true);
            overlay.parentNode.replaceChild(clone, overlay);
            clone.addEventListener("click", closeSidebar);
        }
    } else {
        if (hamburger) hamburger.classList.remove("is-active");
        document.body.classList.remove("sidebar-open");
        document.documentElement.classList.remove("sidebar-open");
        if (navWrap) navWrap.classList.remove("is-open");
    }
}

function initialize() {
    headerAdj();
    submenuToggle();
    setupHamburgerAndOverlay();
}

document.addEventListener("DOMContentLoaded", initialize);
window.addEventListener("resize", initialize);

// Lanaguage switcher
document.addEventListener("DOMContentLoaded", function () {
    const languageSwitcher = document.querySelector(".language-switcher");
    const languageTrigger = document.querySelector(".language-trigger");
    const languageFlag = languageTrigger.querySelector(".flag-icon");
    const languageDropdown = document.querySelector(".language-dropdown");
    const languageItems = document.querySelectorAll(".language-item a");

    // Toggle language dropdown
    languageTrigger.addEventListener("click", function (e) {
        e.stopPropagation();
        languageSwitcher.classList.toggle("active");
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", function (e) {
        if (!languageSwitcher.contains(e.target)) {
            languageSwitcher.classList.remove("active");
        }
    });

    // Handle language selection
    languageItems.forEach((item) => {
        item.addEventListener("click", function (e) {
            e.preventDefault();

            // Remove active class from all items
            languageItems.forEach((i) => {
                i.parentElement.classList.remove("active");
            });

            // Add active class to selected item
            this.parentElement.classList.add("active");

            // Get selected language
            const selectedLang = this.dataset.lang;
            console.log(`Language changed to: ${selectedLang}`);

            // Update the trigger flag
            updateTriggerFlag(selectedLang);

            // Close the dropdown
            languageSwitcher.classList.remove("active");

            // Here you would typically:
            // 1. Change the page language (via your i18n solution)
            // 2. Update the URL or make an API call if needed
        });
    });

    // Keyboard accessibility
    languageTrigger.addEventListener("keydown", function (e) {
        if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            this.click();
        }
    });

    // Function to update the visible flag in the trigger
    function updateTriggerFlag(selectedLang) {
        const flagMap = {
            en: "us",
            am: "am",
        };

        // Remove all flag-related classes
        languageFlag.classList.remove(
            "flag-icon-us",
            "flag-icon-am",
            "fi-us",
            "fi-am"
        );

        // Add the new flag classes
        languageFlag.classList.add(
            `flag-icon-${flagMap[selectedLang]}`,
            `fi`,
            `fi-${flagMap[selectedLang]}`
        );
    }
});

// Gallery script logic
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
