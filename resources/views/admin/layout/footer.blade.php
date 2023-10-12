
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

<script>
    document.onreadystatechange = function () {
        var state = document.readyState
        if (state == 'interactive') {
            $('#loading').addClass('loading');
            $('#loading-content').addClass('loading-content');
        } else if (state == 'complete') {
            setTimeout(function(){
                $('#loading').removeClass('loading');
                $('#loading-content').removeClass('loading-content');
            },1000);
        }
    }

</script>

<script src="{{asset("admin/assets/js/codebase.app.min.js")}}"></script>

<!-- jQuery (required for DataTables plugin) -->
<script src="{{asset("admin/assets/js/lib/jquery.min.js")}}"></script>
<script src="{{asset("admin/assets/js/plugins/select2/js/select2.full.min.js")}}"></script>

<!-- Page JS Plugins -->
<script src="{{asset("admin/assets/js/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("admin/assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js")}}"></script>
<script src="{{asset("admin/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
<script src="{{asset("admin/assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js")}}"></script>
<script src="{{asset("admin/assets/js/plugins/datatables-buttons/dataTables.buttons.min.js")}}"></script>
<script src="{{asset("admin/assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js")}}"></script>
<script src="{{asset("admin/assets/js/plugins/datatables-buttons-jszip/jszip.min.js")}}"></script>
<script src="{{asset("admin/assets/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js")}}"></script>
<script src="{{asset("admin/assets/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js")}}"></script>
<script src="{{asset("admin/assets/js/plugins/datatables-buttons/buttons.print.min.js")}}"></script>
<script src="{{asset("admin/assets/js/plugins/datatables-buttons/buttons.html5.min.js")}}"></script>

<script src="{{asset("admin/assets/js/plugins/ckeditor5-classic/build/ckeditor.js")}}"></script>

<script>Codebase.helpersOnLoad(['jq-maxlength', 'jq-select2','js-ckeditor5']);</script>

<!-- Page JS Code -->
<script src="{{asset("admin/assets/js/pages/be_tables_datatables.min.js")}}"></script>



</body>
</html>
