var processed = {},
  options = {
    debug: true,
    width: 100,
    height: 100
  };



// process images from html with smartcrop()
console.log("index.js");
$('img[class="imagencrop"]').each(function(e) {
console.log(">>"+e);
  $(this).load(function() {
    window.setTimeout(function() {
      var img = this;
 	console.log(img);
      if (processed[img.src]) return;
      processed[img.src] = true;
      SmartCrop.crop(img, options, function(result) {
        var crop = result.topCrop,
          canvas = $('<canvas>')[0],
          ctx = canvas.getContext('2d');
        canvas.width = options.width;
        canvas.height = options.height;
        ctx.drawImage(img, crop.x, crop.y, crop.width, crop.height, 0, 0, canvas.width, canvas.height);
        $(img)
          .after(canvas)
          .after(result.debugCanvas);
      });
    }.bind(this), 100);
  });
  if (this.complete)
    $(this).load();
});
