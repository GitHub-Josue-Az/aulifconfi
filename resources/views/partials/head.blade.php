<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Nunito">

<!-- jquery -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>

<!-- CHART JS-->
<script src="{{ asset('bower_components/chartjs/Chart.min.js') }}"></script>
<script src="{{ asset('bower_components/chartjs/utils.js') }}"></script>


  <!-- Pie Novus JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js" charset="utf-8"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Optional SmartWizard theme -->
<link href="{{ asset('bower_components/steps/dist/css/smart_wizard.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{ asset('bower_components/steps/dist/css/smart_wizard_theme_circles.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{ asset('bower_components/steps/dist/css/smart_wizard_theme_arrows.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{ asset('bower_components/steps/dist/css/smart_wizard_theme_dots.css') }}" type="text/css" rel="stylesheet"/>


<!-- Datapicker-->
<link href="{{ asset('bower_components/jquery/dist/jquery.datetimepicker.min.css') }}" rel="stylesheet"/>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js" rel="stylesheet">


<!-- moment -->
<script src="{{ asset('bower_components/moment/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/moment-timer/lib/moment-timer.js') }}"></script>


<!-- popper.js -->
<!--<script src="{{ asset('bower_components/popper.js/dist/umd/popper.min.js') }}"></script>-->

<!-- bootstrap -->
<!--<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>-->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- bootbox -->
<script src="{{ asset('bower_components/bootbox.js/dist/bootbox.all.min.js') }}"></script>

<!-- selectize -->
<!--<link rel="stylesheet" href="{{ asset('bower_components/selectize/dist/css/selectize.bootstrap3.css') }}">-->
<link rel="stylesheet" href="{{ asset('css/selectize.bootstrap4.css') }}">
<script src="{{ asset('bower_components/selectize/dist/js/standalone/selectize.min.js') }}"></script>

<!-- Datatables -->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
    // DataTable - Setting defaults: https://datatables.net/release-datatables/examples/advanced_init/defaults.html
    $.extend( true, $.fn.dataTable.defaults, {
        language: { // https://datatables.net/examples/advanced_init/language_file
            url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        }
    });
</script>

    <!-- PARA QUE SIRVE : ESTO MALOGRA EL DATATABLE -->
     <!--jquery-->
     <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  -->
     <!--  <link rel="stylesheet" href="/resources/demos/style.css">   -->
     <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>  -->
     <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  -->

<!-- https://ckeditor.com/cke4/builder -->
<script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>

<script>
        
    // CKEDITOR: Define changes to default configuration here. For example:

    CKEDITOR.config.language = 'es';
    // config.uiColor = '#AADC6E';

    CKEDITOR.config.extraPlugins = 'sourcedialog,confighelper,youtube,autogrow,quicktable,save-to-pdf';   //embedbase,embed,

    CKEDITOR.config.removePlugins = 'iframe';

    CKEDITOR.config.allowedContent = true;	// allow all html tags and attributes

    // CKEDITOR.config.removeButtons = 'Underline,Subscript,Superscript';

    // Set the most common block elements.
    // CKEDITOR.config.format_tags = 'p;h1;h2;h3;pre';

    // Simplify the dialog windows.
    CKEDITOR.config.removeDialogTabs = 'image:advanced;link:advanced;table:advanced';

    CKEDITOR.config.height = '100px';
    
    // autogrow
    CKEDITOR.config.autoGrow_minHeight = 100;
    CKEDITOR.config.autoGrow_onStartup = true;  // Si tiene contenido se ajusta

    // youtube
    CKEDITOR.config.youtube_responsive = true;

//    CKEDITOR.config.scayt_sLang = 'es_ES'; // Corrector ortografico scayt
//    CKEDITOR.config.scayt_autoStartup = true;

    // embed
    //CKEDITOR.config.embed_provider = '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}';

    //quicktable
    CKEDITOR.config.qtWidth = '100%';
    CKEDITOR.config.qtStyle = { 'border-collapse' : 'collapse' };

    CKEDITOR.config.toolbar = [
        ['Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates'],
        ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'],
        ['Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt'],
        ['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
        '/',
        ['Bold','Italic','Underline','Strike','Subscript','Superscript','-','CopyFormatting','RemoveFormat' ],
        ['NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl','Language'],
        ['Link','Unlink','Anchor','-','Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
        '/',
        ['Styles','Format','Font','FontSize','-','TextColor','BGColor','-','Maximize', 'ShowBlocks','-','About'],
    ];

    CKEDITOR.config.toolbar = 'Full';

    CKEDITOR.config.toolbar_Full = [
        //['Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates'],
        ['Find','Replace','SpellChecker',/* 'Scayt'*/],
        //['Undo','Redo','-','Cut','Copy','Paste','PasteText','PasteFromWord'],
        //['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
        //'/',
        ['Styles','Format','Font','FontSize','TextColor','BGColor'/*,'-','Maximize', 'ShowBlocks','-','About'*/],
        ['Bold','Italic','Underline',/*'Strike','Subscript','Superscript',*/'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        [/*'NumberedList'*/'BulletedList'/*'-','Outdent'*/,'Indent','-',/*'Blockquote','CreateDiv','-','CopyFormatting',*/'RemoveFormat'/*,'-','BidiLtr','BidiRtl','Language'*/],
        ['Link','Unlink',/*'Anchor',*/'-',/*'Image',*/ 'base64image','Youtube', /*FMathEditor'*/,/*'Embed',/*'Flash',*/'Table',/*'HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'*/],
        [/*'Source',*/ 'Sourcedialog'],
    ];

    CKEDITOR.config.toolbar_Basic = [
        ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','About']
    ];
       
    // http://sdk.ckeditor.com/samples/devtools.html
    CKEDITOR.on('dialogDefinition', function (ev) {
        // Take the dialog name and its definition from the event data.
        var dialogName = ev.data.name;
        var dialogDefinition = ev.data.definition;

        // Check if the definition is from the dialog window you are interested in (the "Link" dialog window).
        if (dialogName === 'link') {
            var informationTab = dialogDefinition.getContents('target');
            var targetField = informationTab.get('linkTargetType');
            targetField['default'] = '_blank';

            //var infoTab = dialogDefinition.getContents('info');
            //infoTab.get('linkType').style = 'display: none';
            //infoTab.get('protocol').style = 'display: none';
            //infoTab.remove('protocol');
            //infoTab.remove('linkType');

            //dialogDefinition.removeContents('target');
            //dialogDefinition.removeContents('advanced');

        }

    });
</script>

<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/main.css') }}">

<style>
    /* ckeditor notification behind top-bar */
    .app-header {
        /*z-index: 9999;*/
    }
    .cke_notifications_area {
        z-index: 9 !important;
    }
    
    /* ckeditor was-validated style */
    .was-validated .form-control:valid + div.cke, .form-control.is-valid + div.cke {
        border-color: #3ac47d;
    }
    .was-validated .form-control:invalid + div.cke, .form-control.is-invalid + div.cke {
        border-color: #d92550;
    }
    /* radio button was-validated style */
    .was-validated [type="radio"]:valid + span {
        /*color: #3ac47d;*/
    }
    .was-validated [type="radio"]:invalid + span {
        color: #d92550;
    }


</style>

@yield('style')

<script src="{{ asset('js/main.js') }}"></script>

<script>
    // Agregar class="needs-validation" a los form y se utilizará la validación javascript en lugar del html5
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<script>

    $(function(){
        
    });

    function go(url){
        window.location.href=url;
    }

    bootbox.setDefaults({
        locale: "es",
    });

    function destroy(uri){
        bootbox.confirm({
            message: "\u00bfRealmente desea eliminar el registro seleccionado?",
            callback: function (result) {
                if (result) {
                    //$('#form-destroy').attr('action', uri).submit();
                    $('<form method="post"/>').append('@method("DELETE")').append('@csrf').attr('action', uri).appendTo(document.body).submit();
                }
            }
        });
    }

    function showError(message, callback){
        bootbox.dialog({
            title: "Error Inesperado",
            message: message
        }, callback);
    }
</script>

@yield('javascript')






