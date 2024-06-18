document.addEventListener('DOMContentLoaded', () => {
    // Handle navigation link activation
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            navLinks.forEach(link => link.classList.remove('active'));
            event.currentTarget.classList.add('active');
        });
    });

    // Slide navigation functionality
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dots span');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
            dots[i].classList.toggle('active', i === index);
        });
    }

    window.prevSlide = function() {
        currentSlide = (currentSlide === 0) ? slides.length - 1 : currentSlide - 1;
        showSlide(currentSlide);
    };

    window.nextSlide = function() {
        currentSlide = (currentSlide === slides.length - 1) ? 0 : currentSlide + 1;
        showSlide(currentSlide);
    };

    window.goToSlide = function(index) {
        currentSlide = index;
        showSlide(currentSlide);
    };

    // Initialize slide display
    showSlide(currentSlide);

    // Auto move to the next slide every 7 seconds
    setInterval(() => {
        window.nextSlide();
    }, 10000);

    // Handle modal functionality
    const modal = document.getElementById("warningModal");
    const btns = document.querySelectorAll(".visit-website");
    const span = document.getElementsByClassName("close")[0];
    const confirmBtn = document.getElementById("confirmBtn");
    let targetUrl = "";

    btns.forEach(btn => {
        btn.onclick = function() {
            targetUrl = this.getAttribute("data-url");
            modal.style.display = "block";
        }
    });

    span.onclick = function() {
        modal.style.display = "none";
    }

    confirmBtn.onclick = function() {
        window.location.href = targetUrl;
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

