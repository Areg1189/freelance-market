Dropzone.options.myDropzone = {
    uploadMultiple: false,
    parallelUploads: 2,
    maxFilesize: 10,
    addRemoveLinks: true,
    dictRemoveFile: 'Remove file',
    dictFileTooBig: 'File is larger than 16MB',
    timeout: 10000,
    clickable: '.dz-attachment',

    init: function () {
        this.on("success", function (file, response) {
            file.id = response.uuid;
            var thumb = getIconFromFilename(file);
            $(file.previewElement).find(".dz-image img").attr("src", thumb);
            $('.attachment-file-content').append('<input type="hidden" data-uuid="' + file.upload.uuid + '" class="file-ids" name="attachment_id[]" value="' + response.uuid + '">');
        });
        this.on("addedfile", function(file) {
            $('#my-dropzone').show();
        });
        this.on("removedfile", function (file) {

            $('input.file-ids[data-uuid="' + file.upload.uuid + '"]').remove();
            var url = "/attachments/dropzone/" + file.id;
            axios.delete(url);
            if ($('.attachment-file-content').find('.file-ids').length < 1){{
                $('.message-dropzone').hide();
            }}
        });
    }

};


$('#w-id').val(withId);