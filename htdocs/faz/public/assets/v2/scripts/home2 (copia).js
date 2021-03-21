window.addEvent("domready", function() {
    firstItem();
    var a = 0;
    var b = sldItm.length;
    var j = 0;
    var sliderTime = setInterval(function(){
        if(j >= b){
            j=0;
        }
        changeSlide(j);
        j++;
    },6000);
    $("toLeft").addEvent("click", function(d) {
        d.preventDefault();
        if (a > 0) {
            a--;
            $$(".slideItem").setStyle("background-image", "url(" + sldItm[a].bckGnd + ")");
	    $$(".slideItem a").set('href', sldItm[a].url);
        }

    });
    $("toRight").addEvent("click", function(d) {
        d.preventDefault();
        if (a < b - 1) {
            a++;
            $$(".slideItem").setStyle("background-image", "url(" + sldItm[a].bckGnd + ")");
	    $$(".slideItem a").set('href', sldItm[a].url);
        }

    });

    var c = $$("html")[0];
    if (c.hasClass("no-touch")) {
        $$(".yellow")[0].addEvents({
            mouseover: function() {
                $$(".yellow").setStyle("width", "60%");
                $$(".red").setStyle("width", "20%");
                $$(".green").setStyle("width", "20%")
            },
            mouseleave: function() {
                $$(".yellow").setStyle("width", "33.33339%");
                $$(".red").setStyle("width", "33.33339%");
                $$(".green").setStyle("width", "33.33339%")
            }
        });
        $$(".red")[0].addEvents({
            mouseover: function() {
                $$(".red").setStyle("width", "60%");
                $$(".yellow").setStyle("width", "20%");
                $$(".green").setStyle("width", "20%")
            },
            mouseleave: function() {
                $$(".red").setStyle("width", "33.33339%");
                $$(".yellow").setStyle("width", "33.33339%");
                $$(".green").setStyle("width", "33.33339%")
            }
        });
        $$(".green")[0].addEvents({
            mouseover: function() {
                $$(".green").setStyle("width", "60%");
                $$(".yellow").setStyle("width", "20%");
                $$(".red").setStyle("width", "20%")
            },
            mouseleave: function() {
                $$(".green").setStyle("width", "33.33339%");
                $$(".yellow").setStyle("width", "33.33339%");
                $$(".red").setStyle("width", "33.33339%")
            }
        })
    } else {
        $$(".green").removeEvents("mouseover");
        $$(".yellow").removeEvents("mouseover");
        $$(".red").removeEvents("mouseover")
    }
});
var firedGreen = false;
var firedGray = false;
var h4cLogo = $$(".conLogo > h4");
var pcLogo = $$(".conLogo > p");
// window.addEventListener("scroll", function(a) {
//     if (window.scrollY >= 588 && firedGreen === false) {
//         animateValue("volun", 0, 5082350, 3500);
//         animateValue("briga", 0, 101647, 3500);
//         animateValue("trash", 0, 25412, 3500);
//         firedGreen = true
//     }
//     if (window.scrollY >= 1900 && firedGray === false) {
//         animateValue("pesos", 0, 7866453, 3500);
//         animateValue("chair", 0, 3026, 3500);
//         firedGray = true
//     }
//     if (window.scrollY >= 10) {
//         h4cLogo.removeClass("bounceOutLeft").addClass("bounceInLeft");
//         pcLogo.removeClass("bounceOutRight").addClass("bounceInRight")
//     } else {
//         h4cLogo.removeClass("bounceInLeft").addClass("bounceOutLeft");
//         pcLogo.removeClass("bounceInRight").addClass("bounceOutRight")
//     }
// }, true);

function firstItem() {
    $$(".slideItem").setStyle("background-image", "url(" + sldItm[0].bckGnd + ")")
	$$(".slideItem a").set('href', sldItm[0].url);
}

function animateValue(d, e, i, h) {
    var j = document.getElementById(d);
    var k = i - e;
    var a = 50;
    var b = Math.abs(Math.floor(h / k));
    b = Math.max(b, a);
    var f = new Date().getTime();
    var l = f + h;
    var c;

    function g() {
        var n = new Date().getTime();
        var o = Math.max((l - n) / h, 0);
        var p = Math.round(i - (o * k));
        var m = Intl.NumberFormat().format(p);
		if (j){//Si existe el elemento
        	j.innerHTML = m;
		}
        if (p == i) {
            clearInterval(c)
        }
    }
    c = setInterval(g, b);
    g()
};

function changeSlide(a) {
    $$(".slideItem").setStyle("background-image", "url(" + sldItm[a].bckGnd + ")");
    $$(".slideItem a").set('href', sldItm[a].url);
}
