//Nodejs dependencies (try/catch constructie dient om webbrowser gerust te stellen)
try {
    window.jQuery = window.$ = require('jquery');
    window.Slideout = require('slideout');
    window.slidesjs = require('../js/jquery.slides');
} catch (e) {
}

var isIE = /*@cc_on!@*/false || !!document.documentMode;
var isMobile = screen.width <= 992;
var mainView = {
    init: function () {
        if (isIE) {
            this.showIEWarning();
        }
        this.loadPage('index');
        this.initMenu();
        this.setTitle();
        this.setHeaderText();
        $("#langswitch").change(function () {
            mainView.changeLocale($("#langswitch").val());
        });

    },
    loadPage: function (page) {
        $('#main').load('html/' + page + '.php', function () {
            switch (page) {
                case 'index':
                    mainView.initSlides();
                    break;
                case 'talent1':
                case'talent2':
                    mainView.initAssignments();
                    break;
                case 'contact':
                    initForm();
            }
            $('html, body').animate({scrollTop: '0px'}, 300);
            mainView.setHeaderText();
            mainView.setTitle();
        });
    },

    setTitle: function () {
        $("title").text($(".current").text() + " - Nicolas' e-portfolio")
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
        $("#menu").find("a").each(function (index, value) {
            $(this).addClass("ripple");
        });

        $("#list").click(function () {
            $(this).next().slideToggle(500);
        });

        $('#menu').find('a').each(function () {
            $(this).click(function (e) {
                e.preventDefault();
                $('.current').removeClass('current');
                $(this).addClass('current');
                if ($(this).attr('href')) {
                    mainView.loadPage($(this).attr('href').split('#')[1]);
                }
            });
        });
    },

    setHeaderText: function () {
        if (isMobile) {
            $("#title").text($(".current").text());
        }
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

    initAssignments: function () {
        $("#assSelect").change(function () {
            mainView.loadAssignment($("#assSelect").val());
        });
    },

    loadAssignment: function (ass) {
        if (ass !== "") {
            $("#verslag").slideUp(300, function () {
                var folder = $('.current').attr('href').split('#')[1];
                $("#verslag").load('html/' + folder + "/" + ass + ".html", function () {
                    $("#verslag").slideDown();
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
    mainView.init();
};