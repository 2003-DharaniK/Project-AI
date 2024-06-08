/*=============== SHOW MENU ===============*/
const navMenu = document.getElementById('nav-menu'),
navToggle = document.getElementById('nav-toggle'),
navClose = document.getElementById('nav-close');





/*===============Deals timing ===============*/
document.addEventListener('DOMContentLoaded', function() {
  // Function to initialize and update the countdown
  function updateCountdown() {
      // Get all the deals items
      const dealsItems = document.querySelectorAll('.deals__item');

      dealsItems.forEach(function(item) {
          // Get the countdown end time from the data attribute
          const endTime = new Date(item.getAttribute('data-countdown')).getTime();

          // Calculate the difference between now and the end time
          const now = new Date().getTime();
          const timeLeft = endTime - now;

          // Calculate days, hours, minutes and seconds left
          const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
          const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
          const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

          // Update the countdown for this item
          item.querySelector('.countdown__amount .countdown__period').innerText = days;
          item.querySelectorAll('.countdown__amount')[1].querySelector('.countdown__period').innerText = hours;
          item.querySelectorAll('.countdown__amount')[2].querySelector('.countdown__period').innerText = minutes;
          item.querySelectorAll('.countdown__amount')[3].querySelector('.countdown__period').innerText = seconds;
      });
  }

  // Update the countdown every 1 second
  setInterval(updateCountdown, 1000);
});


/*===== Menu Show =====*/
/* Validate if constant exists */
if (navToggle) {
  navToggle.addEventListener('click', () => {
    navMenu.classList.add('show-menu');
  });
}

/*===== Hide Show =====*/
/* Validate if constant exists */
if (navClose) {
  navClose.addEventListener('click', () => {
    navMenu.classList.remove('show-menu');
  });
}

/*=============== IMAGE GALLERY ===============*/

function imgGallery() {
  const mainImg= document.querySelector('.details__img'),
  smallImg = document.querySelectorAll('.details__small-img');

  smallImg.forEach((img) => {
    img.addEventListener('click', function() {
      mainImg.src = this.src;
    });
  });
}

imgGallery();

/*=============== SWIPER CATEGORIES ===============*/
    var swiperCategories = new Swiper(".categories__container", {
      spaceBetween: 24,
      loop: true,
      
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        350: {
          slidesPerView: 2,
          spaceBetween: 24,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 24,
        },
        992: {
          slidesPerView: 4,
          spaceBetween: 24,
        },
        1200: {
          slidesPerView: 5,
          spaceBetween: 24,
        },
        1400: {
          slidesPerView: 6,
          spaceBetween: 24,
        },
      },
    });
  
/*=============== SWIPER PRODUCTS ===============*/
var swiperProducts = new Swiper(".new__container", {
  spaceBetween: 24,
  loop: true,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
    768: {
      slidesPerView: 2,
      spaceBetween: 24,
    },
    992: {
      slidesPerView: 3,
      spaceBetween: 24,
    },
    1400: {
      slidesPerView: 4,
      spaceBetween: 24,
    },
  },
});


/*=============== PRODUCTS TABS ===============*/
const tabs =document.querySelectorAll('[data-target]'),
tabContents = document.querySelectorAll('[content]');

tabs.forEach((tab) => {
  tab.addEventListener('click', () => {
     const target = document.querySelector(tab.dataset.target);
     tabContents.forEach((tabContent) => {
      tabContent.classList.remove('active-tab');
     });

     target.classList.add('active-tab');

     tabs.forEach((tab) => {
      tab.classList.remove('active-tab');
     });
  
      tab.classList.add('active-tab');
  });
});

