<script>
document.addEventListener("DOMContentLoaded", function () {

    const slides = document.querySelectorAll(".banner-slide");
    const dots = document.querySelectorAll(".dot");
    let current = 0;
    let interval;

    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove("active"));
        dots.forEach(dot => dot.classList.remove("active"));

        slides[index].classList.add("active");
        dots[index].classList.add("active");

        current = index;
    }

    function nextSlide() {
        let next = (current + 1) % slides.length;
        showSlide(next);
    }

    function startAutoSlide() {
        interval = setInterval(nextSlide, 5000);
    }

    function resetAutoSlide() {
        clearInterval(interval);
        startAutoSlide();
    }

    dots.forEach(dot => {
        dot.addEventListener("click", function () {
            let index = this.dataset.index;
            showSlide(index);
            resetAutoSlide();
        });
    });

    slides.forEach(slide => {
        slide.addEventListener("click", function () {
            window.location.href = this.dataset.url;
        });
    });

    startAutoSlide();
});
</script>