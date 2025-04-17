$(document).ready(function() {
    $('.card-wrap').slick({
        infinite:true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows:true,
        autoplay:false,
        prevArrow: $('.left-arrow'),
        nextArrow: $('.right-arrow'),
     
    });

});

$(document).ready(function() {
    $('.works-slide').slick({
        infinite:true,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows:true,
        autoplay:false,
        prevArrow: $('.left-arr'),
        nextArrow: $('.right-arr'),
     
    });

});

document.addEventListener("DOMContentLoaded", function () {
    const faqItems = document.querySelectorAll(".faq-item");

    faqItems.forEach(item => {
        const button = item.querySelector(".toggle-btn");
        const answer = item.querySelector(".faq-answer");

        button.addEventListener("click", function () {
            const isOpen = answer.style.display === "block";
            document.querySelectorAll(".faq-answer").forEach(ans => ans.style.display = "none");
            document.querySelectorAll(".toggle-btn").forEach(btn => btn.textContent = "+");

            if (!isOpen) {
                answer.style.display = "block";
                button.textContent = "−";
            }
        });
    });
});