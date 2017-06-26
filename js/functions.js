window.jQuery = window.$ = require('jquery');
window.Slideout = require('slideout');
window.slidesjs = require('../js/jquery.slides');
var loc = location.pathname.split('/').slice(-1)[0];
var isIE = /*@cc_on!@*/false || !!document.documentMode;
var mainView = {
    init: function () {
        if(isIE){
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
        if($('#assSelect').length) {
            $("#assSelect").change(function () {
                mainView.loadAssignment($("#assSelect").val());
            });
        }
    },

    setTitle:function() {
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
        $("#menu").find("ul li a").each(function(){
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
                loaded: function(number){
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
    
    showIEWarning:function () {
        //TODO: Functie schrijven die IE-gebruikers enorm neig kloot of waarschuwt fzo
    }
};

window.onload = function() {
    mainView.init();
}