/**
 * This JS file applies only for messenger page.
 */
;(function () {
    messagesCount = 78;
    var take       = (messagesCount < 20) ? 0 : 20, // represents the number of messages to be displayed.
        $messenger = $('.messenger'),
        $loader    = $('#messages-preloader'),
        channel    = pusher.subscribe('messenger-channel');

    /**
     * Do action when a message event is triggered.
     */
    channel.bind('messenger-event', function (data) {
        if (data.withId == authId){
            if (withId){
                if (data.senderId == withId  && data.withId != data.senderId) { // current conversation thread.
                    newMessage(data, 'replies');
                    makeSeen(authId, withId);
                }  else if ( data.withId != data.senderId) { // not opened thread.
                    loadThreads();
                }
            }else{
                var not_see =    $('.notif-count-message');
                not_see.html(parseInt(not_see.html()?not_see.html() : 0) + 1).addClass('active');
            }
            playTweet();
        }

    });

    /**
     * Make a message seen.
     */
    function makeSeen(authId, withId) {
        $.ajax({
            url: '/messenger/ajax/make-seen',
            method: 'POST',
            data: {authId: authId, withId: withId}
        }).done(function (res) {
            if (res.success) {
                loadThreads();
            }
        });
    }

    /**
     * Delete confirmation.
     */
    function confirmDelete() {
        return confirm('Are your sure you want to delete this message');
    }

    /**
     * Create a new menu for the new message.
     */
    // function newMenu(messageClass, messageId) {
    //     var pull = (messageClass === 'sent') ? 'pull-right' : 'pull-left';
    //
    //     return '\
    //         <i class="fa fa-ellipsis-h fa-2x '+ pull +'" aria-hidden="true">\
    //             <div class="delete" data-id="'+ messageId +'">Delete</div>\
    //         </i>\
    //     ';
    // }

    /**
     * Append a new message to chat body.
     */
    function newMessage(message, messageClass, failed = 0) {
        if (failed) {
            $('.messenger-body').append('\
                <a class="unsent">\
                    <small>\
                        This message didn\'t send. Check your internet connection and try again.\
                    </small>\
                </a><br>\
            ');
        } else {
            $('.messenger-body').append('\
                <li class="' + messageClass + '">' +
                '<img src="'+message.avatar+'">' +
                '<p>' +(message.message.message?message.message.message:'') + '</p>'
                +(message.files_html?message.files_html:'')+'\
                </li>\
        ');
            $('#message-body').val('');
            $('.dz-preview.dz-processing.dz-image-preview.dz-complete').html('<div class="dz-content">\n' +
                '                                    <div class="dz-message">\n' +
                '                                        <div class="col-xs-8">\n' +
                '                                                <p>Drop files here or Click to Upload</p>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    \n' +
                '                                </div>');
        }
        scrollMessagesDown();
    }

    /**
     * Scroll messages down to some height or bottom.
     */
    function scrollMessagesDown(height = 0) {
        var scrollTo = height || $messenger.prop('scrollHeight');

        $messenger.scrollTop(scrollTo);
    }

    /**
     * Reload threads.
     */
    function loadThreads() {
        $.ajax({
            url: '/messenger/threads',
            method: 'GET',
            data: {withId: withId}
        }).done(function (view) {
            $('.threads').html(view);
        });
    }

    /**
     * Load more messages.
     */
    function loadMessages() {
        $.ajax({
            url: '/messenger/more/messages',
            method: 'GET',
            data: {
                withId: withId,
                take: take
            }
        }).done(function (res) {
            console.log(res);
            var prevHeight = $messenger.prop('scrollHeight');

            $('.messenger-body').html(res.view);
            var newHeight  = $messenger.prop('scrollHeight');
            scrollMessagesDown(newHeight - prevHeight); // stop at the current height.
            if (res.messagesCount < take) { // load no more messages.
                take = 0;
                $loader.after('<p class="start-conv">Conversation started</p>');
                $loader.remove();
            }
        });
    }

    /**
     * Play message notification sound.
     */
    function playTweet() {
        var audio = new Audio('/sounds/tweet.mp3');
        audio.play();
    }

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        scrollMessagesDown();

        /**
         * Send message to backend and handle responses.
         */
        $(document).on('click', '#send-btn', function (e) {
            var message = $('#message-body').val();
            var message_files = [];
            if ($('.file-ids').length > 0){
                $('.file-ids').each(function (i) {
                    message_files.push($('.file-ids').eq(i).val())
                })
            }
            if (message || message_files.length > 0) {
                var JqHXR = $.ajax({
                    url: '/messenger/send',
                    method: 'POST',
                    data: {
                        message: message,
                        withId: withId,
                        message_files: message_files,
                    }
                });

                JqHXR.done(function (res) { // message sent.
                    if (res.success) {
                        newMessage(res, 'sent');
                        loadThreads();
                        $('.file-ids').remove();
                        $('.message-dropzone').hide();
                    }
                });
                JqHXR.error(function (res) { // message didn't send.
                    newMessage(res, 'sent', true);
                });
            }
        });

        /**
         * Load more messages when scroll to top.
         */
        $messenger.on('scroll', function (e) {
            if (!$messenger.scrollTop() && take) {
                take += 20;
                loadMessages();
            }
        });

        /**
         * Hover to messages to show menu dots.
         */
        $(document).on('mouseover', '.message-row', function (e) {
            $(this).find('.fa-ellipsis-h').show();
        });

        /**
         * Mouse up to remove menu dots.
         */
        $(document).on('mouseout', '.message-row', function (e) {
            var deleteBtn = $(this).find('.delete').css('display');

            if (deleteBtn !== 'block') {
                $(this).find('.fa-ellipsis-h').hide(); // only hide if delete popup is not poped up.
            }
        });

        /**
         * CLick on menu dots to show up delete message option.
         */
        $(document).on('click', '.fa-ellipsis-h', function (e) {
            // Hide all other opened menus.
            $('.delete').not($(this).find('.delete')).hide();
            $('.fa-ellipsis-h').not($(this).find('.fa-ellipsis-h')).hide();
            // Only show this menu.
            $(this).find('.delete').toggle();
        });

        /**
         * Hide opened delete menu when click anywhere.
         */
        $('body').on('click', function (e) {
            if ($(e.target).hasClass('fa-ellipsis-h')) { // toggle delete menu on clicking on dots.
                return true;
            } else if ($(e.target).hasClass('message-row')) { // don't hide on hover dots when click on message row.
                $('.fa-ellipsis-h').not($(e.target).find('.fa-ellipsis-h')).hide();
            } else {
                $('.fa-ellipsis-h').hide();
            }
            $('.delete').hide();
        });

        /**
         * Delete message.
         */
        $(document).on('click', '.delete', function (e) {
            var confirm = confirmDelete();
            if (confirm) {
                var id       = $(this).attr('data-id'),
                    $message = $(this).parent().parent();

                $.ajax({
                    url: '/messenger/delete/' + id,
                    method: 'DELETE'
                }).done(function (res) {
                    if (res.success) {
                        $message.hide(function () {
                            $message.remove();
                        });
                    }
                });
            }
        });
    });
}());
