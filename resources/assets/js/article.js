$(document).ready(function() {
    $(".selectTags").select2({
        placeholder: "Select a tag",
        tags: true,
        createTag: function(newTag) {
            return {
                id: 'new:' + newTag.term,
                text: newTag.term + ' (new)'
            };
        },
        maximumSelectionLength: 5
    });
    var editor_config = {
        path_absolute : '/',
        selector: '.editor',
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        image_class_list: [
            {title: 'None', value: ''},
            {title: 'Image Responsive', value: 'img-responsive'}
        ],
        templates: [
            {title: 'one column', content: '<div class="row"><div class="col-md-12">text goes here</div></div>'},
            {title: 'two column', content: '<div class="row"><div class="col-sm-6">text goes here</div><div class="col-sm-6">text goes here</div></div>'},
            {title: 'two column left bigger', content: '<div class="row"><div class="col-sm-8">text goes here</div><div class="col-sm-4">text goes here</div></div>'},
            {title: 'two column right bigger', content: '<div class="row"><div class="col-sm-4">text goes here</div><div class="col-sm-8">text goes here</div></div>'}
        ],
        file_browser_callback : function(field_name, url, type, win) {
            var w = window,
                d = document,
                e = d.documentElement,
                g = d.getElementsByTagName('body')[0],
                x = w.innerWidth || e.clientWidth || g.clientWidth,
                y = w.innerHeight|| e.clientHeight|| g.clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;

            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });

        }
    };
    tinymce.init(editor_config);

});