window.onload = function () {
    // Variables
    const IMAGENES = [
        'images/slide1-low.jpg',
        'images/slide2-low.jpg',
        'images/slide3-low.jpg',
        'images/slide4-low.jpg',
        'images/slide5-low.jpg',
        'images/slide6-low.jpg',
        'images/slide7-low.jpg'
    ];
    const TEXTOS = [
        'INMUNOHISTOQUÍMICA',
        'HIBRIDACIÓN IN SITU',
        'HISTOLOGÍA',
        'BIOLOGÍA MOLECULAR',
        'REACTIVOS Y COLORANTES',
        'CONSUMIBLES Y MATERIAL DE LABORATORIO',
        'EQUIPOS'
    ];
    const TIEMPO_INTERVALO_MILESIMAS_SEG = 4000;
    let posicionActual = 0;
    let $botonRetroceder = document.querySelector('#retroceder');
    let $botonAvanzar = document.querySelector('#avanzar');
    let $contenedorGuia = document.querySelector('.container-image-slide');
    /*let $botonPlay = document.querySelector('#play');
    let $botonStop = document.querySelector('#stop');*/
    let intervalo;

    // Funciones

    /**
     * Funcion que cambia la foto en la siguiente posicion
     */
    function pasarFoto() {
        let $imagenes = document.querySelectorAll('.image-slide');
        $imagenes[posicionActual].style.display = 'none';
        if(posicionActual >= IMAGENES.length - 1) {
            posicionActual = 0;
        } else {
            posicionActual++;
        }
        renderizarImagen();
    }

    /**
     * Funcion que cambia la foto en la anterior posicion
     */
    function retrocederFoto() {
        let $imagenes = document.querySelectorAll('.image-slide');
        $imagenes[posicionActual].style.display = 'none';
        if(posicionActual <= 0) {
            posicionActual = IMAGENES.length - 1;
        } else {
            posicionActual--;
        }
        renderizarImagen();
    }

    /**
     * Funcion que actualiza la imagen de imagen dependiendo de posicionActual
     */
    function renderizarImagen() {
        let $imagenes = document.querySelectorAll('.image-slide');
        $imagenes[posicionActual].style.display = 'block';
    }

    /**
     * Funcion que actualiza la imagen de imagen dependiendo de posicionActual
     */
    function crearSlides() {
        for(let i = 0; i < IMAGENES.length; i++) {
            let divImagen = document.createElement('div');
            divImagen.setAttribute('class', 'image-slide');
            divImagen.style.display = 'none';
            divImagen.style.backgroundImage = `url(${IMAGENES[i]})`;

            let divFloater = document.createElement('div');
            divFloater.setAttribute('class', 'slide-text-floater');

            let divContainer = document.createElement('div');
            divContainer.setAttribute('class', 'slide-text-container');

            let divText = document.createElement('div');
            divText.setAttribute('class', 'slider-text ');
            divText.innerHTML = `${TEXTOS[i]}`;
            
            divContainer.appendChild(divText);
            divFloater.appendChild(divContainer);
            divImagen.appendChild(divFloater);

            $contenedorGuia.appendChild(divImagen);
        }
    }

    /**
     * Activa el autoplay de la imagen
     */
    function playIntervalo() {
        intervalo = setInterval(pasarFoto, TIEMPO_INTERVALO_MILESIMAS_SEG);
        // Desactivamos los botones de control
        /*$botonAvanzar.setAttribute('disabled', true);
        $botonRetroceder.setAttribute('disabled', true);*/
        /*$botonPlay.setAttribute('disabled', true);
        $botonStop.removeAttribute('disabled');*/

    }

    /**
     * Para el autoplay de la imagen
     */
    function stopIntervalo() {
        clearInterval(intervalo);
        // Activamos los botones de control
        /*$botonAvanzar.removeAttribute('disabled');
        $botonRetroceder.removeAttribute('disabled');*/
        /*$botonPlay.removeAttribute('disabled');
        $botonStop.setAttribute('disabled', true);*/
    }

    // Eventos
    $botonAvanzar.addEventListener('click', pasarFoto);
    $botonRetroceder.addEventListener('click', retrocederFoto);
    /*$botonPlay.addEventListener('click', playIntervalo);
    $botonStop.addEventListener('click', stopIntervalo);*/
    
    // Iniciar
    crearSlides();
    renderizarImagen();
    playIntervalo();
} 