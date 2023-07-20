
<!-- Footer -->
<footer id="page-footer">
    <div class="content py-3">
        <div class="row fs-sm">

            <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                <a class="fw-semibold" href="https://1.envato.market/95j" target="_blank">Speakede</a> &copy; <span data-toggle="year-copy"></span>
            </div>
        </div>
    </div>
</footer>
<!-- END Footer -->
</div>
<!-- END Page Container -->

<!--
    Codebase JS

    Core libraries and functionality
    webpack is putting everything together at assets/_js/main/app.js
-->
<script src="{{asset("admin/assets/js/codebase.app.min.js")}}"></script>

<!-- Page JS Plugins -->
<script src="{{asset("admin/assets/js/plugins/sweetalert2/sweetalert2.min.js")}}"></script>

<!-- Page JS Code -->
<script src="{{asset("admin/assets/js/pages/be_comp_dialogs.min.js")}}"></script>

<!-- Page JS Plugins -->
<script src="{{asset("admin/assets/js/plugins/chart.js/chart.umd.js")}}"></script>

<!-- Page JS Code -->
<script src="{{asset("admin/assets/js/pages/be_pages_dashboard.min.js")}}"></script>

<script src="{{asset("admin/assets/js/plugins/simplemde/simplemde.min.js")}}"></script>
<script src="{{asset("admin/assets/js/plugins/ckeditor/ckeditor.js")}}"></script>


<!-- Page JS Helpers (SimpleMDE + CKEditor plugins) -->
<script>Codebase.helpersOnLoad(['js-ckeditor', 'js-simplemde']);</script>


</body>
</html>
