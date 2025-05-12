
const navigation = document.querySelector('.nav-bar');
let lastScrollTop = 0;

window.addEventListener('scroll', () => {
    const currentScroll = window.scrollY;

    if (currentScroll > lastScrollTop) {
        // Scroll προς τα κάτω -> Κρύψε navbar
        navigation.style.top = "-200px";
    } else {
        // Scroll προς τα πάνω -> Εμφάνισε navbar
        navigation.style.top = "0";
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Για να μην πάει αρνητικό
});


const scrollFadeEl = document.querySelector(".scroll-fade");

window.addEventListener("scroll", () => {
    const scrollY = window.scrollY;
    const offset = Math.min(scrollY / 2, 200);
    const opacity = Math.max(1 - scrollY / 300, 0);

    scrollFadeEl.style.transform = `translateY(${offset}px)`;
    scrollFadeEl.style.opacity = opacity;
});


const searchIcon = document.querySelector(".search");
const searchPopup = document.getElementById("searchPopup");
const closeBtn = document.getElementById("closeSearchPopup");



searchIcon.addEventListener("click", () => {
    searchPopup.classList.add("active");
});

// Κλείσιμο όταν πατηθεί ESC ή εκτός
window.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        searchPopup.classList.remove("active");
    }
});

searchPopup.addEventListener("click", (e) => {
    if (e.target === searchPopup) {
        searchPopup.classList.remove("active");
    }
});

window.addEventListener("scroll", () => {
    const image = document.querySelector(".hero-image");
    const scrollY = window.scrollY;

    // Parallax effect
    const translateY = scrollY * 0.7;
    image.style.transform = `translateY(${translateY}px)`;

    // Dynamic blur based on scroll depth
    const blurAmount = Math.min(scrollY / 300, 3); // Μέγιστο 5px blur
    image.style.filter = `blur(${blurAmount}px)`;
});

const hamburger = document.getElementById('hamburger');
const menu = document.getElementById('menu');

hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    menu.classList.toggle('active');
});

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target); // Αν θέλεις να σταματήσει να παρακολουθεί το στοιχείο μόλις το εμφανίσει
        }
    });
});

// Παρακολουθούμε όλα τα στοιχεία με την κλάση "reveal"
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));