const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slide');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');

let currentIndex = 0;
const totalSlides = slides.length;

function updateSlider() {
    slider.style.transform = `translateX(-${currentIndex * 100}%)`;
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    updateSlider();
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    updateSlider();
}

let autoSlide = setInterval(nextSlide, 3000);

nextButton.addEventListener('click', () => {
    nextSlide();
    resetTimer();
});

prevButton.addEventListener('click', () => {
    prevSlide();
    resetTimer();
}
);

function resetTimer() {
    clearInterval(autoSlide);
    autoSlide = setInterval(nextSlide, 3000);
}
