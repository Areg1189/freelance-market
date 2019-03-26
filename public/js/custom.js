"use strict";

// ==== Initial Google Map ====
function initialize(latitude, longitude, address, zoom) {
    var latlng = new google.maps.LatLng(latitude, longitude);

    var myOptions = {
        zoom: zoom,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: "location : " + address
    });
}

// ==== Go to top ====
function goup() {
    // to top
    $(".go-up").hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 400) {
            $('.go-up').fadeIn();
        } else {
            $('.go-up').fadeOut();
        }
    });
    $('.go-up a').on('click', function (e) {
        e.preventDefault();
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
}

$(document).ready(function () {
    goup();

    // ==== Create menu for mobile ====
    $('#all').after('<div id="off-mainmenu"><div class="off-mainnav"><div class="close-menu"><i class="fa fa-close"></i></div></div></div>');
    $('#main-nav').clone().appendTo('.off-mainnav');

    $('#btn-menu').on('click', function (e) {
        e.preventDefault();
        $('body').addClass('mainmenu-active');
    });

    $('.close-menu').on('click', function (e) {
        e.preventDefault();
        $('body').removeClass('mainmenu-active');
    });

    // ==== Display menu when resize window ====
    $(window).on('resize', function () {
        var win = $(this); //this = window
        if (win.width() >= 1024) {
            $('#main-nav').css({
                display: 'block'
            });
        }
    });

    // Advanced search
    $(".job-advancedsearch a").on('click', function (e) {
        e.preventDefault();
        $(".job-searchform").toggleClass('open');
    });

    $(".job-searchform .btn-close").on('click', function (e) {
        e.preventDefault();
        $(".job-searchform").toggleClass('open');
    });

    // google map
    var address = jQuery('.contact-address').html();
    var width = '100%';
    var height = '500px';
    var zoom = 16;

    // Create map html
    if (address) {
        $('#map').html('<div id="map_canvas" style="width:' + width + '; height:' + height + '"></div>');

        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({'address': address}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                initialize(latitude, longitude, address, zoom);
            }
        });
    }

    // // ===== Price filter ======
    // $("#price-filter").slider({
    // 	from: 0,
    // 	to: 100,
    // 	step: 1,
    // 	smooth: true,
    // 	round: 0,
    // 	dimension: "&nbsp;$",
    // 	skin: "plastic"
    // });

    // ====== Support ========
    $('.support-list .support-item').on('click', function (e) {
        $('html, body').animate({
            scrollTop: $(".support-list .support-content").offset().top
        }, 1000);

        $('.support-list .support-item').each(function (index) {
            $(this).closest('li').removeClass('active');
        });
    });

    // ======= Load more page recruitment =======

    var loadUrl = false;
    $(".load-more a").on('click', function (e) {
        e.preventDefault();
        if (!loadUrl) {
            loadUrl = $(this).attr('href');
        }
        $.ajax({
            type: 'GET',
            url: loadUrl,
            success: function (data) {
                if (data.success) {
                    $('.load-content').append(data.html);
                    if (!data.nextUrl) {
                        $('.load-more a').remove();
                    } else {
                        loadUrl = data.nextUrl;
                        $('html,body').animate({
                            scrollTop: $(this).offset().top
                        }, 1500);
                    }
                }
            },
            error: function (data) {

            },
        })


    });

    $(document).on('click', '.job-save', function () {
        var button = $(this);
        var img = $(this).find('img');
        button.attr('disabled', true);
        var url = button.data('href');
        $.ajax({
            url: url,
            success: function (data) {
                img.attr('src', data);
                button.attr('disabled', false);
            }
        })
    })
}); //end


// ======= Skills finding =======


// ======= OFFER ACCEPT AND CANCEL =======


$('.offer-btn').click(function (event) {
    event.preventDefault();
    var $this = $(this);
    $this.button('loading');
    var offer_content = $('.offer-content[data-status="' + $(this).data('target') + '"]');
    $.ajax({
        url: $(this).attr('href'),
        success: function (data) {
            if (data.success) {
                offer_content.html('');
                if (data.accept == 'accepted') {
                    offer_content.html('<i class="fa fa-chevron-circle-down fa-2x" aria-hidden="true"></i> ' + data.message);
                    toastr.success(data.message);
                } else if (data.accept == 'canceled') {
                    offer_content.html('<i class="fa fa-ban fa-2x"></i> ' + data.message);
                    toastr.warning(data.message);
                } else if (data.accept == 'impossible') {
                    offer_content.html('<i class="fa fa-ban fa-2x"></i> ' + data.message);
                    toastr.warning(data.message);
                }
            }
            $this.button('reset');
        }

    })

});


function getIconFromFilename(file) {
    // get the extension
    var ext = file.name.split('.').pop().toLowerCase();

    // if its not an image
    if (file.type.indexOf('image') === -1) {

        // handle the alias for extensions
        if (ext === 'docx' || ext === 'doc') {
            ext = 'doc'
        } else if (ext === 'xlsx' || ext === 'xls') {
            ext = 'xls'
        } else if (ext === 'csv') {
            ext = 'csv'
        } else if (ext === 'pdf') {
            ext = 'pdf'
        } else {
            return '/images/icon/txt.svg';
        }

        return "/images/icon/" + ext + ".svg";
    }
}


$(document).on('click', '.single-job-show', function () {
    var url = $(this).data('url');
    axios.get(url).then(function (response) {
        $('#job-show').remove();
        if (response.data.html) {
            $('body').append(response.data.html)
        }
    })
});
$(document).on('click', '.search-tags', function (e) {
    e.stopPropagation();
});

// ======= NOTIFICATIONS =======
$('.show-notify').on('click', function () {
    $.ajax({
        url: $(this).data('href'),
        beforeSend: function () {
            $('#not-list').html('</div><div class="spinner-grow text-dark" role="status">' +
                '</div><div class="spinner-grow text-dark" role="status">' +
                '</div><div class="spinner-grow text-dark" role="status">');
        },
        success: function (data) {
            if (data.view) {
                $('#not-list').html(data.view);
            }
        }
    });
});
$(document).on('click', '.close', function (event) {
    event.preventDefault();
    var _this = $(this);
    $.ajax({
        url: $(this).data('href'),
        type: 'POST',
        success: function (data) {
            if (data.success) {
                $('.show-notify').click();
                var notifsec = $('.notif-count-notification');
                notifsec.text(parseInt(notifsec.text()) - 1);
                if (parseInt(notifsec.text()) < 1) notifsec.removeClass('active');
            }
        }
    });
});


$(document).on('change', '.cancel-reason', function () {
    var textarea = $('.other-text');
    $(textarea).val($(this).val());
});

$('.cancel-contract').click(function () {
    var url = $(this).data('url');
    axios.get(url).then((response) => {
        $('#cancel-contract').remove();
        $('body').append(response.data.html);
        return response.data.message
    })
})