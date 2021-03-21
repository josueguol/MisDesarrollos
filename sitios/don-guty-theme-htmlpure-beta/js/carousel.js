carousel = function() {
   var init = function () {
      window.addEventListener("resize", resizeCarousel);
      $('#myCarousel').bind('slide.bs.carousel', function (e) {
         resizeCarousel();
      });
   };

   var resizeCarousel = function() {
      var carouselContent = document.getElementById('myCarousel');
      width = carouselContent.offsetWidth;
      height = width * 0.4;
      var ARi = height / width;
      carouselContent.setAttribute("style", "height:" + height + "px");
      // .carousel .item
      var innerCarousel = document.getElementsByClassName("carousel-inner")[0].getElementsByClassName('item');
      for (var i = 0; i < innerCarousel.length; i++) {
         innerCarousel[i].setAttribute("style", "height:" + height + "px");

         // Ajusta la imagen proporcionalmente sin descuadrar
         var image = {
            width: innerCarousel[i].getElementsByTagName("img")[0].naturalWidth,
            height: innerCarousel[i].getElementsByTagName("img")[0].naturalHeight,
         };

         image.ARx = image.height / image.width; 

         if (ARi <= image.ARx) {
            innerCarousel[i].getElementsByTagName("img")[0].style.height = "auto";
            innerCarousel[i].getElementsByTagName("img")[0].style.width = width + "px"; //.setAttribute("style", "width:100%");
         } else {
            innerCarousel[i].getElementsByTagName("img")[0].style.width = "auto";
            innerCarousel[i].getElementsByTagName("img")[0].style.height = height + "px";  //.setAttribute("style", "height:100%");
         }
      }

   };

   return { init:init, resizeCarousel: resizeCarousel };
}();

carousel.init();
window.onload = function () { carousel.resizeCarousel(); }

