var lastScrollTop = 0;
window.addEvent('domready', function () {
  $('menuToggle').addEvent('click', function (e) {
    e.stopPropagation();
    if ($('menuToggle').get('data-active') === 'false') {
      $('drop').setStyle('display', 'block');
      setTimeout(function () {
        $('drop').addClass('dropActive');
      }, 50);
      $('menuToggle').set('data-active', 'true');
    } else {
      $('drop').removeClass('dropActive');
      setTimeout(function () {
        $('drop').setStyle('display', 'none');
      }, 200);
      $('menuToggle').set('data-active', 'false');
    }
  });
  window.addEvent('orientationchange', function () {
    $('menuToggle').set('data-active', 'false');
    $('drop').setStyle('display', 'none');
    $('drop').removeClass('dropActive');
  });
  // window.addEvent('scroll', function () {
  //   if (window.innerWidth > 960) {
  //     if (window.scrollY > 160) $('nav').addClass('dim');
  //     else $('nav').removeClass('dim');
  //   } else if (window.innerWidth > 768) {
  //     if (window.scrollY > 130) $('nav').addClass('dim');
  //     else $('nav').removeClass('dim');
  //   } else {
  //     if (window.scrollY > 60)$('nav').addClass('dim');
  //     else $('nav').removeClass('dim');
  //   } 
  // });
  window.addEvent('scroll', function (e) {
    var prodActive;
    if($('productos'))prodActive = $('productos').get('data-state') == 'on';
    else prodActive = false;
    if ($('menuToggle').get('data-active') != 'true' && prodActive == false) {
      var st = this.getScroll().y;
      if (st > lastScrollTop) {
        if (st > 200) $('nav').addClass('hidden');
      } else $('nav').removeClass('hidden');
      lastScrollTop = st;
    }
  });
});