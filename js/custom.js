

//my whay to hide menu to burger after link click

const headerLink = document.querySelectorAll('.header__link');

if ($('.header__burger').css('display') === 'block') {
   $(headerLink).each(function () {
      $(this).on('click', function (event) {
         event.preventDefault();
         $('.header__burger, .header__menu').toggleClass('active');
         $('body').toggleClass('lock');
         window.location.href = this.href;
      });
   });
}


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
