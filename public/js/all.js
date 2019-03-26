$(document).ready(function () {
    //SEARCH PANEL
    var login_redirect = '';
    // setTimeout(function () {
    //     if ($('.search-block').hasClass('open')) {
    //         $('.search-block').removeClass('open')
    //     }
    // }, 2000);
    $('.search-link').click(function (e) {
        e.preventDefault();
        if (!$('.search-block').hasClass('open')) {
            $('.search-block').addClass('open')
        } else {
            $('.search-block').removeClass('open')
        }
    });
    //CLOSE MODAL
    $('.to-login').click(function (e) {
        e.preventDefault();
        showLoginModal();
    });


    $(document).on('click', '.close-modal',function (e) {
        e.preventDefault();
        $(".login-modal").addClass('close-own-modal')
    });
    $(document).on('click', '.login-modal', function (e) {
        if (e.target.className == 'bg') {
            $(".login-modal").addClass('close-own-modal')
        }
    });

    $('.btn-login-post').click(function (e) {
        e.preventDefault();
        login_redirect = $(this).attr('href');
        showLoginModal('<div class="alert alert-info mt-4" role="alert">To post project you need to register or log in.! </div>');
    });


    function showLoginModal(info = false) {
        $(".login-modal").removeClass('close-own-modal');
        $('.info-container').html(info ? info : '')
    }

    $('#form-login').submit(function (form) {
        form.preventDefault();
        var $this = $(this);
        var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ';
        if ($this.find('input#email').val() && $this.find('input#password').val()) {
            if ($this.find('button').html() !== loadingText) {
                $this.find('button').data('original-text', $this.find('button').html());
                $this.find('button').html(loadingText);
                $this.find('button').attr('disabled', true);
            }
            axios.post($this.attr('action'), $(this).serialize())
                .then(function (response) {
                    location.href = login_redirect;
                }).catch(function (error) {
                toastr.warning(error.response.data.message);
                $this.find('button').attr('disabled', false);
                $this.find('button').html($this.find('button').data('original-text'));
            });
        }
    });

    $('#form-register').submit(function (form) {
        form.preventDefault();
        var $this = $(this);

        $.ajax({
            url: $this.attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                location.href = '';
            },
            error: function (response) {
                $errors = response.responseJSON.errors;
                if ($errors.password) {
                    $this.find('#user-password').next('.invalid-feedback').html('<strong>' + $errors.password[0] + '</strong>').show()
                }
                if ($errors.first_name) {
                    $this.find('#first-name').next('.invalid-feedback').html('<strong>' + $errors.first_name[0] + '</strong>').show()
                }
                if ($errors.last_name) {
                    $this.find('#user-surname').next('.invalid-feedback').html('<strong>' + $errors.last_name[0] + '</strong>').show()
                }
                if ($errors.email) {
                    $this.find('#user-email').next('.invalid-feedback').html('<strong>' + $errors.email[0] + '</strong>').show()
                }
                if ($errors.agree) {
                    $this.find('.agree-container').find('.invalid-feedback').html('<br><strong>' + $errors.agree[0] + '</strong>').show()
                }
            }
        });


    })
});

