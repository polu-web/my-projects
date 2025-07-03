// A $( document ).ready() block.
const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("show-items");
    } else {
      entry.target.classList.remove("show-items");
    }
  });
});
const scrollScale = document.querySelectorAll(".scroll-scale");
scrollScale.forEach((el) => observer.observe(el));

const scrollBottom = document.querySelectorAll(".scroll-bottom");
scrollBottom.forEach((el) => observer.observe(el));

const scrollBottomLeft = document.querySelectorAll(".scroll-bottom-left");
scrollBottomLeft.forEach((el) => observer.observe(el));

const scrollTop = document.querySelectorAll(".scroll-top");
scrollTop.forEach((el) => observer.observe(el));

$(document).ready(function () {
  $('.testimonial-slider').slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    autoplay: true,
    dots: false,
    autoplaySpeed: 1500,
    arrows: false,
    responsive: [
      {
        breakpoints: 575,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }

      },
      {
        breakpoints: 320,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      }
    ]
  });
});


const scrollRevealOption = {
  distance: "50px",
  origin: "bottom",
  duration: 1000,
};

// header container
ScrollReveal().reveal(".header__container .section__subheader", {
  ...scrollRevealOption,
});

ScrollReveal().reveal(".header__container h1", {
  ...scrollRevealOption,
  delay: 500,
});

ScrollReveal().reveal(".header__container .btn", {
  ...scrollRevealOption,
  delay: 1000,
});

// room container
ScrollReveal().reveal(".room__card", {
  ...scrollRevealOption,
  interval: 200,
});

let menuIcon = document.querySelector("#menu-icon");
let listItems = document.querySelector(".nav-links");

menuIcon.onclick = () => {
  menuIcon.classList.toggle("fa-x");
  listItems.classList.toggle("open");
}

window.onscroll = () => {
  menuIcon.classList.remove("fa-x");
  listItems.classList.remove("open");
}


var playBtn = document.getElementById('playBtn');
var thumbnail = document.getElementById('thumbnail');
var video = document.getElementById('video');

playBtn.addEventListener('click', () => {
  thumbnail.style.display = 'none';
  playBtn.style.display = 'none';
  video.style.display = 'block';

  video.play();
});


var playBtn1 = document.getElementById('playBtn1');
var thumbnail1 = document.getElementById('thumbnail1');
var video1 = document.getElementById('video1');

playBtn.addEventListener('click', () => {
  thumbnail1.style.display = 'none';
  playBtn1.style.display = 'none';
  video1.style.display = 'block';

  video.play();
});






