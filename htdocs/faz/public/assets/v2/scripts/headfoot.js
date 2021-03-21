window.addEvent('domready', function () {

    $('openMenu').addEvent('click', function (e){
        e.preventDefault();
        $('menuTab').setStyles({
            display: 'block',
            opacity: 1
        })
    });
    $('closeMenu').addEvent('click', function (e){
        e.preventDefault();
        $('menuTab').setStyles({
            display: 'none',
            opacity: 0
        })
    });
    document.querySelector('.nosotros').addEventListener('click', function(e) {
        [].map.call(document.querySelectorAll('.nosotros ul'), function(el) {
            el.classList.toggle('active');
        });
    });
});