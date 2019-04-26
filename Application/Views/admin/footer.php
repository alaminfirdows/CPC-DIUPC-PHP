    </main>
    <footer id="main-footer" class="bg-dark text-white p-2">
        <div class="container text-center">
            Developed at <a href="https://devxpart.com/" target="_blank" style="color: #fff">DevXpart</a>, by <a
                href="https://alamin.me" target="_blank" style="color: #fff">Al-Amin Firdows</a>
        </div>
    </footer>
    <!-- Essential javascripts for application to work-->
    <script type="text/javascript" src="<?= base_url('assets'); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets'); ?>/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?= base_url('assets'); ?>/js/jquery.stellar.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets'); ?>/js/admin.js"></script>

    <script type="text/javascript" src="<?= base_url('assets'); ?>/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets'); ?>/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets'); ?>/js/plugins/select2.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets'); ?>/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets'); ?>/js/plugins/chart.js"></script>
    <script type="text/javascript" src="<?= base_url('assets'); ?>/js/plugins/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
$('.datepicker').datepicker({
    format: "dd M yyyy",
    autoclose: true,
    todayHighlight: true
});
if ($('.ckeditor').length) {
    CKEDITOR.replace('.ckeditor');
}
if ($('.select2').length) {
    $('.select2').select2();
}
if ($('.jsDataTable').length) {
    $('.jsDataTable').DataTable();
}
    </script>
    </body>

    </html>