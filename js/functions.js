//Nodejs dependencies (try/catch constructie dient om webbrowser gerust te stellen)
try {
    window.jQuery = window.$ = require('jquery');
    window.$.validate = window.jQuery.validate = require('jquery-validation');
    window.Slideout = require('slideout');
    window.slidesjs = require('../js/jquery.slides.js');
    window.Headroom = require('headroom.js');
    window.$.headroom = require('headroom.js/dist/jQuery.headroom');
    window.KonamiCode = require('konami-code');
} catch (e) {}

var isIE = !!window.MSInputMethodContext && !!document.documentMode;
var isMobile = screen.width <= 992;
var mainView = {
    slideout: null,
    init: function() {
        this.initMenu();
        if (history.state != null) {
            this.simpleLoad(history.state.page);
            this.changeSelected($('#menu').find('a[href="#' + history.state.page + '"]'));
        } else this.simpleLoad('index', true);
        this.setTitle();
        this.setHeaderText();
        this.easter();
        if (isMobile) {
            $('header').headroom();
        }
        $("#langswitch").change(function() {
            mainView.changeLocale($("#langswitch").val());
        });
        $('#panel').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
            $(this).removeClass('animated zoomIn');
        });

    },
    initAnim: function() {
        $('#panel').fadeIn(1000);
        isMobile ? $('#menu').css('width', '256px') : $('#menu').delay(1000).animate({ width: '256px' }, 750);
    },
    loadPage: function(page, push) {
        $('body').css('overflow', 'hidden');
        $('#main').addClass('animated slideOutUp');
        mainView.changeSelected($('#menu').find('a[href$=' + page + ']'));
        $('html, body').animate({ scrollTop: '0px' }, 300);
        $('#main').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
            mainView.simpleLoad(page, push);
        });

    },

    simpleLoad: function(page, push) {
        $('#main').load('html/' + page + '.php', function() {
            switch (page) {
                case 'index':
                    mainView.initSlides();
                    break;
                case 'portfolio':
                    mainView.initProjects();
                    break;
                case 'cv':
                    $('#cv').find('a').last().click(function(e) {
                        e.preventDefault();
                        mainView.loadPage('portfolio');
                    });
                    break;
                case 'experience':
                    mainView.initLoader();
                    break;
                default:
                    break;
            }
            $(this).removeClass('slideOutUp').addClass('slideInDown');
            $('#main').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
                $('body').css('overflow', 'initial');
                $(this).removeClass('animated slideInDown');
            });
        });
        if (isMobile) {
            mainView.slideout.close();
        }
        if (push) {
            history.pushState({
                page: page
            }, null, page);
        }
        mainView.setHeaderText();
        mainView.setTitle();
    },

    setTitle: function() {
        $("title").text($(".current").text() + " - Nicolas' e-portfolio")
    },

    initMenu: function() {
        this.slideout = new Slideout({
            'panel': document.getElementById('panel'),
            'menu': document.getElementById('menu'),
            'padding': 256,
            'tolerance': 70
        });

        document.querySelector('.toggle-button').addEventListener('click', function() {
            mainView.slideout.toggle();
        });
        $("#menu").find("a").each(function() {
            $(this).addClass("ripple");
        });

        $("#list").click(function() {
            $(this).next().slideToggle(500);
        });

        $('#menu').find('a').each(function() {
            $(this).click(function(e) {
                e.preventDefault();
                if (($(this).text() !== $('.current').text())) {
                    mainView.changeSelected($(this));
                    if ($(this).attr('href')) {
                        mainView.loadPage($(this).attr('href').split('#')[1], true);
                    }
                }
            });
        });
        if (isMobile) {
            $("#menu").removeClass('animated slideInLeft');
        } else {
            $('#menu').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
                $(this).removeClass('animated slideInLeft');
            });
        }


    },
    initLoader: function() {
        $('#expList').find('a').click(function() {
            $('#loader').load('html/expfiles/' + $(this).attr('id') + '.html', function() {
                $('#loader').fadeIn(800);
            });
        });
    },
    //Highlight de huidige pagina in het menu
    changeSelected: function(elem) {
        //Verwijder klasse current van huidige element + toevoegen aan nieuwe element
        $('.current').removeClass('current');
        $(elem).addClass('current');
        //Slideup/down activeren van iTalent-menu wanneer nodig
        //Voorkomt ook dat het iTalent-menu niet verdwijnt als één van de links binnenin actief is
        (($(elem).attr('href') || $(elem).parent().attr('id') === 'list') && !($(elem).attr('href').indexOf('talent') >= 0)) ? $('#list').next().slideUp(500): $('#list').next().slideDown();
    },
    //Verander tekst van de header volgens de huidige pagina
    setHeaderText: function() {
        if (isMobile) {
            $("#title").text($(".current").text());
        }
    },

    initSlides: function() {
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
                loaded: function() {
                    $("#slides").show();
                    $("#slides").find("i").hide();
                }
            }
        });
    },

    easter: function() {
        var konami = new KonamiCode();
        konami.listen(function() {
            var audio = new Audio('audio/lememe.ogg');
            audio.play();
            $("#panel").css({
                "background-image": "url('images/worstenbroodman.jpg')",
                "background-size": "cover"
            });
            $('#menu').find('ul').first().append('<img style="width: 256px" src="images/anim.gif" />');
            setTimeout(function() {
                $('#menu').find('ul img').first().remove();
                $('#panel').css({ 'background-image': 'inherit', 'background-size': 'inherit' });
                audio.pause();
            }, 30000);
        });
    },

    changeLocale: function(locale) {
        $.ajax({
            url: "php/changeLocale.php",
            type: 'post',
            data: { 'newLang': locale },
            success: function() {
                location.reload();
            }
        });
    },

    initProjects: function() {
        $('#description').find('p').show();
        $('#projects').find('a').click(function() {
            var current = $(this);
            $('#projects').find('a').not(this).removeAttr('style');
            current.css('filter', 'initial');
            $('#description').children().fadeOut(500);
            $('#description').slideUp(500, function() {
                $.ajax({
                    url: "php/getProject.php",
                    type: 'GET',
                    data: { 'project': current.attr('id') },
                    dataType: 'json',
                    success: function(response) {
                        $('#description').html(response);
                        $('#description').children().fadeIn(500);
                        $('#description').slideDown();
                    }
                });
            });


        });
        if (isMobile) {
            $('#left').click(function() {
                $('#scroller').animate({ scrollLeft: $('#scroller').scrollLeft() - 290 }, 500);
            });
            $('#right').click(function() {
                $('#scroller').animate({ scrollLeft: 290 + $('#scroller').scrollLeft() }, 500);
            });
        } else {
            $('#left').hover(function() {
                $('#scroller').animate({ scrollLeft: 0 }, 1000, 'linear');
            }, function() {
                $('#scroller').stop();
            });
            $('#right').hover(function() {
                $('#scroller').animate({ scrollLeft: 200 }, 1000, 'linear');
            }, function() {
                $('#scroller').stop();
            });
        }
    }
};

window.onload = function() {
    if (isIE) {
        window.location = 'html/lap.html';
    }
    mainView.init();
};

window.onpopstate = function(event) {
    var page = 'index';
    if (event.state) {
        page = event.state.page;
    }
    mainView.loadPage(page);
    mainView.changeSelected($('#menu').find('a[href="#' + page + '"]'));
};