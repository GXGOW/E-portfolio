//Nodejs dependencies (try/catch constructie dient om webbrowser gerust te stellen)
try {
    window.jQuery = window.$ = require('jquery');
    window.$.validate = window.jQuery.validate = require('jquery-validation');
    window.Slideout = require('slideout');
    window.slidesjs = require('../js/jquery.slides.js');
    window.Headroom = require('headroom.js');
    window.$.headroom = require('headroom.js/dist/jQuery.headroom');
} catch (e) {}

var isIE = !!window.MSInputMethodContext && !!document.documentMode;
var isMobile = screen.width <= 992;
var mainView = {
    slideout: null,
    init: function() {
        if (history.state != null) {
            this.loadPage(history.state.page);
            this.changeSelected($('#menu').find('a[href="#' + history.state.page + '"]'));
        } else this.loadPage('index', true);
        this.initAnim();
        this.initMenu();
        this.setTitle();
        this.setHeaderText();
        if (isMobile) {
            $('header').headroom();
        }
        $("#langswitch").change(function() {
            mainView.changeLocale($("#langswitch").val());
        });

    },
    initAnim: function() {
        $('#panel').fadeIn(1000);
        isMobile ? $('#menu').css('width', '256px') : $('#menu').delay(1000).animate({ width: '256px' }, 750);
    },
    loadPage: function(page, push) {
        $('#main').fadeOut(300, function() {
            mainView.changeSelected($('#menu').find('a[href$=' + page + ']'));
            $('html, body').animate({ scrollTop: '0px' }, 300);
            $('#main').load('html/' + page + '.php', function() {
                $('#main').fadeIn(300, function() {
                    switch (page) {
                        case 'index':
                            mainView.initSlides();
                            break;
                        case 'talent1':
                        case 'talent2':
                            mainView.initAssignments();
                            break;
                        case 'portfolio':
                            mainView.initProjects();
                            break;
                        case 'contact':
                            formView.getErrorMessages();
                            break;
                        case 'cv':
                            $('#cv').find('a').last().click(function(e) {
                                e.preventDefault();
                                mainView.loadPage('portfolio');
                            });
                            break;
                        default:
                            break;
                    }
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
        });
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
                mainView.changeSelected($(this));
                if ($(this).attr('href')) {
                    mainView.loadPage($(this).attr('href').split('#')[1], true);
                }
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

    initAssignments: function() {
        $("#assSelect").change(function() {
            mainView.loadAssignment($("#assSelect").val());
        });
    },

    loadAssignment: function(ass) {
        if (ass !== "") {
            $("#verslag").slideUp(300, function() {
                var folder = $('.current').attr('href').split('#')[1];
                $("#verslag").load('html/' + folder + "/" + ass + ".html", function() {
                    $("#verslag").slideDown();
                });
            });
        } else {
            $("#verslag").slideUp(300, function() {
                $("#verslag").empty();
            });
        }
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

var formView = {
    errors: null,
    getErrorMessages: function() {
        $.ajax({
            url: "php/validationMsg.php",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                formView.errors = data;
                formView.initForm();
            }
        });
    },
    initForm: function() {
        $.getScript('https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js', function() {
            $('#form').ajaxForm({
                beforeSubmit: function() {
                    $('#form').validate();
                }
            });
        });
        $(function() {
            $("#form").validate({
                rules: {
                    naam: {
                        required: true,
                        minlength: 2
                    },
                    voornaam: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    onderwerp: {
                        required: true,
                        minlength: 3
                    },
                    bericht: {
                        required: true,
                        minlength: 20
                    }
                },
                messages: {
                    naam: {
                        required: formView.errors['required'],
                        minlength: formView.errors['minlengthLN']
                    },
                    voornaam: {
                        required: formView.errors['required'],
                        minlength: formView.errors['minlengthFN']
                    },
                    email: formView.errors['email'],
                    onderwerp: formView.errors['required'],
                    bericht: formView.errors['required']
                },
                submitHandler: function() {
                    $('#form').ajaxSubmit({
                        url: '../php/form.php',
                        type: 'post',
                        success: function(data) {
                            if (data !== 'success') {
                                var err;
                                switch (data) {
                                    case 'err_captcha':
                                        err = formView.errors['captcha'];
                                        break;
                                    case 'err_email':
                                        err = formView.errors['email'];
                                        break;
                                    case 'err_null':
                                        err = formView.errors['required'];
                                        break;
                                }
                                $('#err').append('<p class="error">' + err + '</p>');
                            }
                            $('#err').fadeOut(500);
                            $('#form').fadeOut(500, function() {
                                $('#content').empty();
                                $('#content').append('<p class="success">Het formulier werd met succes ingediend!</p>');
                                $('.success').fadeIn(500);
                            });
                        }
                    });
                }
            })
        });
    }
}

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