var scrollPos = 0;
window.addEvent('scroll', function () {
    var niupos = window.pageYOffset || document.documentElement.scrollTop;

    if (window.innerWidth <= 649) {
        if ((document.body.getBoundingClientRect()).top < scrollPos) {
            // console.log('goes up');
            $$('.shouldMove').setStyle('margin-top', (-niupos)+'px');
            $$('.shouldMove').setStyle('transition', 'none');
            $$('.marg0').setStyle('margin-bottom', '0');
            $$('.marg0').setStyle('transition', 'margin-bottom 500ms ease-out');
            console.log(niupos);
    
        } else {
            // console.log('goes down');
            console.log(niupos);
            $$('.shouldMove').setStyle('margin-top', niupos+'px');
            $$('.shouldMove').setStyle('transition', 'all 100ms ease-out');
            $$('.marg0').setStyle('margin-bottom', '100px');
            $$('.marg0').setStyle('transition', 'margin-bottom 500ms ease-out');
        }
    }
    scrollPos = (document.body.getBoundingClientRect()).top;
});
