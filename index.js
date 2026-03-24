
$(document).ready(function () {
  $('.banner-wrap').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    dots: false,
    arrows: false,
    autoplaySpeed: 1500,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
        }
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 1,
        }
      }
    ]
  });
});

//--------------------------------------------------------------------------------------------------------------------------------------

// Generate random percentage with + or - sign
function randomPercent() {
  const sign = Math.random() > 0.5 ? "+" : "-";
  const value = (Math.random() * 8).toFixed(2);
  return `${sign}${value}%`;
}

function updatePercents() {
  const percentBoxes = document.querySelectorAll(".percent-box");

  percentBoxes.forEach(box => {
    const span = box.querySelector(".percent");
    const icon = box.querySelector("i");
    const newValue = randomPercent();

    span.textContent = newValue;

    if (newValue.startsWith("+")) {
      // Positive value
      span.style.color = "#00ff7f";
      box.style.background = "#32d5942d";
      icon.classList.remove("fa-chevron-down");
      icon.classList.add("fa-chevron-up");
      icon.style.background = "#2FE075";
      icon.style.transform = "rotate(0deg)";
    } else {
      // Negative value
      span.style.color = "#ff4040";
      box.style.background = "#ff40402d";
      icon.classList.remove("fa-chevron-up");
      icon.classList.add("fa-chevron-down");
      icon.style.background = "#ff4040";
      icon.style.transform = "rotate(0deg)";
    }

    // Little animation bounce
    span.classList.add("changed");
    setTimeout(() => span.classList.remove("changed"), 200);
  });
}

// Update every 2 seconds
setInterval(updatePercents, 2000);


//-------------------------------------------------------------------------------------------------------------------------------------------

$(document).ready(function () {

  // Initialize slick on each .video-scroll element
  $(".video-scroll").each(function () {
    // initialize slick individually so each instance is independent
    $(this).slick({
      infinite: true,
      slidesToShow: 2 / 3 + 3 + 2 / 3,
      slidesToScroll: 1,
      autoplay: true,
      dots: false,
      arrows: false,
      autoplaySpeed: 1000,
      adaptiveHeight: false,
      responsive: [
        { breakpoint: 1199, settings: { slidesToShow: 4 } },
        { breakpoint: 992, settings: { slidesToShow: 3 } },
        { breakpoint: 767, settings: { slidesToShow: 2 } },
        { breakpoint: 575, settings: { slidesToShow: 1 } }
      ]
    });
  });

  //-----------------------------------------------------------------------------------------------------------------------------------------

  // ensure only the default group is visible at start
  $(".updates-group").show();
  $(".alerts-group").hide();

  // Use 'change' on radio inputs for toggling (works for keyboard too)
  $('input[name="videoType"]').on('change', function () {
    const id = $(this).attr('id');

    if (id === 'alerts') {
      // hide updates, show alerts
      $(".updates-group").hide();
      $(".alerts-group").show();

      setTimeout(function () {
        $(".alerts-group").slick('setPosition');
      }, 20);
    } else if (id === 'updates') {
      $(".alerts-group").hide();
      $(".updates-group").show();

      setTimeout(function () {
        $(".updates-group").slick('setPosition');
      }, 20);
    }
  });

});

//--------------------------------------------------------------------------------------------------------------------------------------------

document.querySelectorAll(".typed-text").forEach(function (el) {
  const parts = JSON.parse(el.getAttribute("data-parts"));
  let currentPart = 0, charIndex = 0, fullText = "";

  function type() {
    if (currentPart < parts.length) {
      const part = parts[currentPart];
      const text = part.text;
      const color = part.color;

      if (charIndex < text.length) {
        const span = `<span class="${color}">${text.slice(0, charIndex + 1)}</span>`;
        const before = parts
          .slice(0, currentPart)
          .map(p => `<span class="${p.color}">${p.text}</span>`)
          .join("");
        el.innerHTML = before + span;
        charIndex++;
        setTimeout(type, 100);
      } else {
        currentPart++;
        charIndex = 0;
        setTimeout(type, 150);
      }
    }
  }

  type();
});

//------------------------------------------------------------------------------------------------------------------------


let menuIcon = document.querySelector("#menu-icon");
let listItems = document.querySelector(".list-items");

menuIcon.onclick = () => {
  menuIcon.classList.toggle("fa-x");
  listItems.classList.toggle("open");
}

window.onscroll = () => {
  menuIcon.classList.remove("fa-x");
  listItems.classList.remove("open");
}

//----------------------------------------------------------------------------------------------------------------------------

const readMoreLinks = document.querySelectorAll(".read-more");

readMoreLinks.forEach(link => {
  link.addEventListener("click", function () {
    const moreText = this.previousElementSibling; // gets the .more-text before the link
    if (moreText.style.display === "inline") {
      moreText.style.display = "none";
      this.textContent = "Read more";
    } else {
      moreText.style.display = "inline";
      this.textContent = "Read less";
    }
  });
});


//--------------------------------------------------------------------------------------------------------------------------

// const arrow = document.getElementById("expandArrow");
// const textPart = document.querySelector(".s4-text-part");

// arrow.addEventListener("click", () => {
//   textPart.classList.toggle("show");
//   arrow.classList.toggle("rotate");
// });

document.addEventListener("DOMContentLoaded", () => {
  const arrow = document.querySelector(".expand-arrow");
  const moreText = document.querySelector(".more-text2");

  // Hide section when page loads
  moreText.style.display = "none";

  // Add click event
  arrow.addEventListener("click", () => {
    const isHidden = moreText.style.display === "none";
    moreText.style.display = isHidden ? "block" : "none";
    arrow.classList.toggle("active", isHidden);
  });
});

//-------------------------------------------------------------------------------------------------------------------------

$(document).ready(function(){
      $('.center-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: true,
        arrows: false,
        dots: true,
        speed: 500,
        // centerPadding: '20px',
        infinite: true,
        autoplaySpeed: 1000,
        autoplay: true
      });
    });


//-----------------------------------------------------------------------------------------------------------------------------------
document.addEventListener("DOMContentLoaded", () => {
  const items = document.querySelectorAll(".timeline-item");
  const section = document.querySelector(".timeline");
  let running = false, timeouts = [];

  const observer = new IntersectionObserver(
    ([entry]) => {
      if (entry.isIntersecting && !running) {
        running = true;
        // clear any old timeouts just in case
        timeouts.forEach(clearTimeout);
        timeouts = [];

        // animate dot-by-dot
        items.forEach((it, i) => {
          const t = setTimeout(() => it.classList.add("show"), i * 500);
          timeouts.push(t);
        });
      } 
      // Reset quickly when timeline leaves view (prevents leftover elements)
      else if (!entry.isIntersecting && entry.intersectionRatio < 0.2) {
        running = false;
        timeouts.forEach(clearTimeout);
        items.forEach((it) => it.classList.remove("show"));
      }
    },
    { threshold: [0, 0.2, 0.4] }
  );

  observer.observe(section);
});





//----------------------------------------------------------------------------------------------------------------------------


AOS.init({
  duration: 1000,
  // onscroll: true
});

document.addEventListener("DOMContentLoaded", function () {
  AOS.init(); // Initialize AOS
  setTimeout(function () {
    AOS.refresh(); // Refresh after a short delay
  }, 500); // Adjust delay as needed
});

Fancybox.bind("[data-fancybox]", {
  //
});