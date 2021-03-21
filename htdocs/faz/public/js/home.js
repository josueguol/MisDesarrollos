function setSwipeEl(el) {
  swipes.each(function (item, i) {
    $('collection-' + (i+1)).setStyle('display', 'none');
    if (item.get('data-id') != el.get('data-id')) {
      item.removeClass('active');
    } else item.addClass('active');
  });
  $('collection-' + parseInt(el.get('data-id'))).setStyle('display', 'block');
  $('collection-' + parseInt(el.get('data-id'))).fade('hide');
  $('collection-' + parseInt(el.get('data-id'))).fade(1);
}

var swipes;

const Slides = new Class({
  initialize: function () {
    this.items = $('slides').getChildren('a, img');
    this.cur = 0;
    setTimeout(() => {
      this.next();
    }, 8000);
  },
  next: function () {
    this.items[this.cur].setStyle('display', 'none');

    if(this.cur < this.items.length - 1)this.cur++;
    else this.cur = 0;

    this.items[this.cur].fade('hide');
    this.items[this.cur].setStyle('display', 'block');
    this.items[this.cur].fade(1);

    setTimeout(() => {
      this.next();
    }, 8000);
  }
});

window.addEvent('domready', function () {

  swipes = $('swipeBtns').getElements('button');

  swipes.each(function (item, i) {
    item.addEvent('click', function (e) {
      e.stopPropagation();
      if (!this.hasClass('active')) setSwipeEl(this);
    });
  });

  $('swipeBar').addEvent('scroll', function () {
    if( $('swipeBtns').getPosition().x == (window.innerWidth - $('swipeBar').getScrollSize().x) ) {
      $('indicator').fade(0);
    } else $('indicator').fade(1);
  });

  if($('slides'))new Slides();

});