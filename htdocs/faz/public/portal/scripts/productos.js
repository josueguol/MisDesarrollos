const showProdMenu = () => {
  $('nav').removeClass('hidden');
  $('productos').set('data-state', 'on');
  $('prodInfo').setStyle('filter', 'blur(4px)');
  $$('footer').setStyle('filter', 'blur(4px)');
  $('prodMenu').addClass('prodOn');
}

const hideProdMenu = () => {
  $('prodMenu').removeClass('prodOn');
  $('productos').set('data-state', 'off');
  $('prodInfo').setStyle('filter', 'blur(0px)');
  $$('footer').setStyle('filter', 'blur(0px)');
}

const toggleProducts = () => {
  if ($('productos').get('data-state') == 'off') {
    showProdMenu();
  } else {
    hideProdMenu();
  }
}

window.addEvent('domready', function () {
  $('productos').addEvent('click', function () {
    toggleProducts();
  });

  let prods = $('prodMenu').getElements('a');

  prods.each(function (item, i) {
    item.addEvent('click', function () {
      var cur = $$('a.active').get('data-prod');
      $$('a.active').removeClass('active');
      $$('div[data-prod=' + cur + ']').setStyle('display', 'none');
      item.addClass('active');
      $$('div[data-prod=' + item.get('data-prod') + ']').setStyle('display', 'block');
      $$('div[data-prod=' + item.get('data-prod') + ']').fade('hide');
      $$('div[data-prod=' + item.get('data-prod') + ']').fade(1);
      if (window.innerWidth <= 960) hideProdMenu();
    });
  });

  $('comisionesBtn').active = false;
  $('comisionesBtn').addEvent('click', function () {
    if ($('comisionesBtn').active == false) {
      $('comisionesBtn').active = true;
      $('comisiones').setStyle('display', 'block');
      if (window.innerWidth < 1100) $('indRow').setStyle('display', 'block');
    } else {
      $('comisionesBtn').active = false;
      $('comisiones').setStyle('display', 'none');
      $('indRow').setStyle('display', 'none');
    }
  });

  let uri = new URI(window.location.href);
  if (uri.getData('prod') != null) {
    switch (uri.getData('prod')) {
      case 'diario':
        prods[0].click();
        break;
      case 'corp':
        prods[1].click();
        break;
      case 'fibras':
        prods[2].click();
        break;
      case 'mex':
        prods[3].click();
        break;
      case 'plus':
        prods[4].click();
        break;
      case 'global':
        prods[5].click();
        break;
    }
  }
});