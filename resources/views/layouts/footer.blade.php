<footer class="site-footer">
    <div class="site-footer-legal">© 2018 <a href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">Remark</a></div>
    <div class="site-footer-right">
        Crafted with <i class="red-600 wb wb-heart"></i> by <a href="https://themeforest.net/user/creation-studio">Creation Studio</a>
    </div>
</footer>
<!-- Core  -->
<script src="{{asset('template/vendor/babel-external-helpers/babel-external-helpers.js')}}"></script>
<script src="{{asset('template/vendor/jquery/jquery.js')}}"></script>
<script src="{{asset('template/vendor/popper-js/umd/popper.min.js')}}"></script>
<script src="{{asset('template/vendor/bootstrap/bootstrap.js')}}"></script>
<script src="{{asset('template/vendor/animsition/animsition.js')}}"></script>
<script src="{{asset('template/vendor/mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('template/vendor/asscrollbar/jquery-asScrollbar.js')}}"></script>
<script src="{{asset('template/vendor/asscrollable/jquery-asScrollable.js')}}"></script>
<script src="{{asset('template/vendor/ashoverscroll/jquery-asHoverScroll.js')}}"></script>

<!-- Plugins -->
<script src="{{asset('template/vendor/switchery/switchery.js')}}"></script>
<script src="{{asset('template/vendor/intro-js/intro.js')}}"></script>
<script src="{{asset('template/vendor/screenfull/screenfull.js')}}"></script>
<script src="{{asset('template/vendor/slidepanel/jquery-slidePanel.js')}}"></script>
<script src="{{asset('template/vendor/jquery-ui/jquery-ui.js')}}"></script>
<script src="{{asset('template/vendor/asprogress/jquery-asProgress.js')}}"></script>
<script src="{{asset('template/vendor/blueimp-tmpl/tmpl.js')}}"></script>
<script src="{{asset('template/vendor/blueimp-canvas-to-blob/canvas-to-blob.js')}}"></script>
<script src="{{asset('template/vendor/blueimp-load-image/load-image.all.min.js')}}"></script>
<script src="{{asset('template/vendor/blueimp-file-upload/jquery.fileupload.js')}}"></script>
<script src="{{asset('template/vendor/blueimp-file-upload/jquery.fileupload-process.js')}}"></script>
<script src="{{asset('template/vendor/blueimp-file-upload/jquery.fileupload-image.js')}}"></script>
<script src="{{asset('template/vendor/blueimp-file-upload/jquery.fileupload-audio.js')}}"></script>
<script src="{{asset('template/vendor/blueimp-file-upload/jquery.fileupload-video.js')}}"></script>
<script src="{{asset('template/vendor/blueimp-file-upload/jquery.fileupload-validate.js')}}"></script>
<script src="{{asset('template/vendor/blueimp-file-upload/jquery.fileupload-ui.js')}}"></script>
<script src="{{asset('template/vendor/summernote/summernote.min.js')}}"></script>

<!-- Scripts -->
<script src="{{asset('template/js/Component.js')}}"></script>
<script src="{{asset('template/js/Plugin.js')}}"></script>
<script src="{{asset('template/js/Base.js')}}"></script>
<script src="{{asset('template/js/Config.js')}}"></script>

<script src="{{asset('template/js/Section/Menubar.js')}}"></script>
<script src="{{asset('template/js/Section/GridMenu.js')}}"></script>
<script src="{{asset('template/js/Section/Sidebar.js')}}"></script>
<script src="{{asset('template/js/Section/PageAside.js')}}"></script>
<script src="{{asset('template/js/Plugin/menu.js')}}"></script>

<script src="{{asset('template/js/config/colors.js')}}"></script>
<script src="{{asset('template/js/config/tour.js')}}"></script>
{{--<script>Config.set('assets', '../../assets');</script>--}}

<!-- Page -->
<script src="{{asset('template/js/Site.js')}}"></script>
<script src="{{asset('template/js/Plugin/asscrollable.js')}}"></script>
<script src="{{asset('template/js/Plugin/slidepanel.js')}}"></script>
<script src="{{asset('template/js/Plugin/switchery.js')}}"></script>
<script src="{{asset('template/js/Plugin/asprogress.js')}}"></script>
<script src="{{asset('template/js/Plugin/summernote.js')}}"></script>

<script src="{{asset('template/examples/js/pages/project.js')}}"></script>

<!-- Jsgrid -->
<script src="{{asset('template/vendor/jsgrid/jsgrid.js')}}"></script>


<script src="{{asset('template/vendor/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('template/js/Plugin/bootstrap-datepicker.js')}}"></script>

<script src="{{asset('template/js/Plugin/input-group-file.js')}}"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        'use strict';
    })
</script>
@yield('insert-js')