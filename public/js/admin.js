pusher = new Pusher(pusher_app_key, {
    cluster: pusher_cluster
});


channel = pusher.subscribe('admin-chanel');
channel.bind('admin-event', function (data) {
    if (data['type'] == 'create-job') {

        toastr.info("employer " + data['author'] + " created a new job");

        var menu = $('.menu-jobs').parent();
        if (menu.find('.badge').length) {
            menu.find('.badge').html(parseInt(menu.find('.badge').html()) + 1)
        } else {
            menu.append('<span class="badge badgeOwn badge-secondary">1</span>');

        }
        $('#audio').html('<iframe src="/sounds/tweet.mp3" allow="autoplay" style="display:none" id="iframeAudio">\n' +
            '    </iframe>');
        setTimeout(function () {
            $('#iframeAudio').remove()
        }, 1000)
    }
    if (data['type'] == 'support-job')
    {
        toastr.info(data['author'] + " send you Message");

        var menu = $('.manue-support').parent('a');

        if (menu.find('.badge').length) {
            console.log(45821);
            menu.find('.badge').html(parseInt(menu.find('.badge').html()) + 1)
        } else {
            menu.append('<span class="badge badgeOwn badge-secondary">1</span>');

        }
        $('#audio').html('<iframe src="/sounds/tweet.mp3" allow="autoplay" style="display:none" id="iframeAudio">\n' +
            '    </iframe>');
        setTimeout(function () {
            $('#iframeAudio').remove()
        }, 1000)
    }
});



$(document).ready(function () {
   if (parseInt(note_job_not_read) > 0) {
       $('.menu-jobs').parent().append('<span class="badge badgeOwn badge-secondary">'+note_job_not_read+'</span>');
       $('.manue-support').parent().append('<span class="badge badgeOwn badge-secondary">'+not_seen_support_messages+'</span>');
   }

});
