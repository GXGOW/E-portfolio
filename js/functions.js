//Nodejs dependencies (try/catch constructie dient om webbrowser gerust te stellen)
try {
    window.jQuery = window.$ = require('jquery');
    window.Slideout = require('slideout');
    window.slidesjs = require('../js/jquery.slides');
} catch (e) {
}

var loc = location.pathname.split('/').slice(-1)[0];
var isIE = /*@cc_on!@*/false || !!document.documentMode;
var mainView = {
    init: function () {
        if (isIE) {
            this.showIEWarning();
        }
        this.initMenu();
        this.slideOpen();
        this.setHeaderText();
        this.setTitle();
        if (screen.width <= 992) {
            this.setTitle(document.title);
        }
        if ($("#slides").length) {
            this.initSlides();
        }
        $("#langswitch").change(function () {
            mainView.changeLocale($("#langswitch").val())
        });
        if ($('#assSelect').length) {
            $("#assSelect").change(function () {
                mainView.loadAssignment($("#assSelect").val());
            });
        }
    },

    setTitle: function () {
        $("title").text($("title").text() + " - Nicolas' e-portfolio")
    },

    initMenu: function () {
        var slideout = new Slideout({
            'panel': document.getElementById('panel'),
            'menu': document.getElementById('menu'),
            'padding': 256,
            'tolerance': 70
        });

        document.querySelector('.toggle-button').addEventListener('click', function () {
            slideout.toggle();
        });
        $("#menu").find("ul li a").each(function () {
            $(this).addClass("ripple");
        })
    },

    slideOpen: function () {
        $("#item").click(function () {
            $("#talent").slideToggle(500);
        });
    },

    setHeaderText: function (title) {
        $("#title").text($("title").text());
    },

    initSlides: function () {
        /*var width, height;
         var url = $('#slides').find('img')[0].src;
         var folder = url.split('/');
         folder = folder[folder.length - 2];
         case 'slideshow': width=1500;height=400;*/
        $("#slides").slidesjs({
            width: 1500,
            height: 400,
            navigation: {
                active: false,
                effect: "slide"
            },
            pagination: {
                active: false
            },
            play: {
                active: false,
                auto: true,
                effect: 'slide',
                interval: 6000,
                pauseOnHover: true
            },
            callback: {
                loaded: function (number) {
                    $("#slides").show();
                    $("#slides").find("i").hide();
                }
            }
        });
    },

    changeLocale: function (locale) {
        var title = location.pathname.split('/').slice(-1)[0];
        var prefix = "../";
        if (title === "" || title === 'index.php')
            prefix = "";
        $.ajax({
            url: prefix + "php/changeLocale.php",
            type: 'post',
            data: {'newLang': locale},
            success: function (response) {
                location.reload();
            }
        });
    },

    loadAssignment: function (ass) {
        if (ass !== "") {
            $("#verslag").slideUp(300, function () {
                var folder = loc.slice(0, -4);
                $("#verslag").load(folder + "/" + ass + ".html", function () {
                    $("#verslag").slideDown()
                });
            });
        }
        else {
            $("#verslag").slideUp(300, function () {
                $("#verslag").empty();
            });
        }
    },

    showIEWarning: function () {
        //TODO: Functie schrijven die IE-gebruikers enorm neig kloot of waarschuwt fzo
    }
};

window.onload = function () {
    replaceSvg();
    mainView.init();
};

function replaceSvg() {
    jQuery('img.svg').each(function () {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function (data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
            if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');

    });
}