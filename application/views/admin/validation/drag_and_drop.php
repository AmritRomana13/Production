<script>
    jQuery(document).ready(function() {
        $(document).ready(function() {
            $.ajax({
                url: base_url + "cc_admin/file_upload/loadImages",
                type: 'POST',
                success: function(result) {
                    $("#media-files").html(result);
                }
            });
        });

        function reloadimages() {
            $.ajax({
                url: base_url + "cc_admin/file_upload/loadImages",
                type: 'POST',
                success: function(result) {
                    $("#media-files").html(result);
                }
            });
        }
        var img_zone = document.getElementById('img-zone'),
            collect = {
                filereader: typeof FileReader != 'undefined',
                zone: 'draggable' in document.createElement('span'),
                formdata: !!window.FormData
            },
            acceptedTypes = {
                'image/png': true,
                'image/jpeg': true,
                'image/jpg': true,
                'image/gif': true
            };

        // Function to show messages
        function ajax_msg(status, msg) {
            var the_msg = '<div class="alert alert-' + (status ? 'success' : 'danger') + '">';
            the_msg += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            the_msg += msg;
            the_msg += '</div>';
            $(the_msg).insertBefore(img_zone);
        }

        // Function to upload image through AJAX
        function ajax_upload(files) {
            $('#progress').removeClass('hidden');
            $('.progress-bar').css({
                "width": "0%"
            });
            $('.progress-bar span').html('0% complete');

            var formData = new FormData();
            //formData.append('any_var', 'any value');
            for (var i = 0; i < files.length; i++) {
                //formData.append('img_file_' + i, files[i]); 
                formData.append('images[]', files[i]);
            }

            $.ajax({
                url: base_url + "cc_admin/file_upload/",
                type: 'post',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                error: function(request) {
                    ajax_msg(false, 'An error has occured while uploading photo.');
                },
                success: function(json) {
                    $('#progress').addClass('hidden');
                    // reloadimages();
                    $("#media-files").prepend(json.img);
                    if (json.error != '')
                        ajax_msg(false, json.error);
                },
                progress: function(e) {
                    if (e.lengthComputable) {
                        var pct = (e.loaded / e.total) * 100;
                        $('.progress-bar').css({
                            "width": pct + "%"
                        });
                        $('.progress-bar').attr('aria-valuenow', pct);
                        $('.progress-bar span').html(Math.round(pct) + '% complete');
                        if (pct >= "90") {
                            $('.progress-bar').removeClass("bg-warning").addClass("bg-success");
                        } else if (pct >= "50" && pct < "90") {
                            $('.progress-bar').removeClass("bg-danger").addClass("bg-warning");
                        } else {
                            $('.progress-bar').addClass("bg-danger");
                        }

                    } else {
                        console.warn('Content Length not reported!');
                    }
                }
            });
        }

        // Call AJAX upload function on drag and drop event
        function dragHandle(element) {
            element.ondragover = function() {
                return false;
            };
            element.ondragend = function() {
                return false;
            };
            element.ondrop = function(e) {
                e.preventDefault();
                ajax_upload(e.dataTransfer.files);
            }
        }

        if (collect.zone) {
            dragHandle(img_zone);
        } else {
            alert("Drag & Drop isn't supported, use Open File Browser to upload photos.");
        }

        // Call AJAX upload function on image selection using file browser button
        $(document).on('change', '.btn-file :file', function() {
            ajax_upload(this.files);
        });

        // File upload progress event listener
        (function($, window, undefined) {
            var hasOnProgress = ("onprogress" in $.ajaxSettings.xhr());

            if (!hasOnProgress) {
                return;
            }

            var oldXHR = $.ajaxSettings.xhr;
            $.ajaxSettings.xhr = function() {
                var xhr = oldXHR();
                if (xhr instanceof window.XMLHttpRequest) {
                    xhr.addEventListener('progress', this.progress, false);
                }

                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', this.progress, false);
                }

                return xhr;
            };
        })(jQuery, window);
    });


    var iUrl = '';
    var iCount = 0;
    var type = '0';

    $(document).on("click", ".file-box", function() {
        if ($(this).hasClass("selected")) {
            $(this).removeClass("selected");
            iUrl = '';
        } else {
            $(this).addClass("selected");
            iUrl = $(this).data('file-path');
        }
    });

    $("#pImgClose").click(function() {
        $("#theImg").remove();
        $('#pImgClose').hide();
    });
    $(document).on("click", ".pGalClose", function() {
        $(this).parent('div').remove();
        $(".file-box").removeClass("selected");
    });

    function showImageGallery() {
        $(".selected").each(function() {
            var image_path = $(this).data('file-path');
            var image_thumb = $(this).data('file-thumb');

            $('#selected-images').append('<div class="additional-item"><input type="hidden" name="img_path[]" value="' + image_path + '"/><img  class="img-additional gimg" src="<?php echo base_url('uploads/') . 'products/' ?>' + image_thumb + '" alt=""><a type="button" class="btn btn-sm btn-delete-additional-image pGalClose" aria-hidden="true" ><i class="fa fa-times"></i></a></div>');

            iCount = iCount + 1;
        });
        $(".file-box").removeClass("selected");

        $("#imagemediamodel").modal('hide');

    }
</script>