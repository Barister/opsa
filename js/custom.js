

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