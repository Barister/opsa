

//my whay to hide menu to burger after link click

const headerLink = document.querySelectorAll('.header__link');
const burgerActive = document.querySelector('.header__menu');

headerLink.forEach(link => {
   link.addEventListener('click', event => {
      if (burgerActive.classList.contains('active')) {
         event.preventDefault();
         $('.header__burger, .header__menu').toggleClass('active');
         $('body').toggleClass('lock');
         window.location.href = link.href;
      }
   });
});


// scroll up event

window.addEventListener('scroll', function () {
   let scrollPosition = window.scrollY || document.documentElement.scrollTop;
   let secondScreenOffset = window.innerHeight * 1.5;

   let scrollUpButton = document.querySelector('.scroll-up');

   if (scrollPosition > secondScreenOffset) {
      scrollUpButton.style.display = 'flex';
      scrollUpButton.style.opacity = "1";

   } else {
      scrollUpButton.style.opacity = "0";
   }
});
