    </main>
    <footer id="main-footer" class="bg-dark text-white p-2">
      <div class="container text-center">
        Develop with <i class="fa fa-heart-o"></i> by <a href="https://alamin.me" target="_blank" style="color: #fff">Al-Amin Firdows</a>
      </div>
    </footer>
    <!-- Essential javascripts for application to work-->
    <script type="text/javascript" src="<?=base_url('assets');?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets');?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets');?>/js/jquery.stellar.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets');?>/js/admin.js"></script>

    <script type="text/javascript" src="<?=base_url('assets');?>/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets');?>/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets');?>/js/plugins/select2.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets');?>/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets');?>/js/plugins/chart.js"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
      if ( $('.ckeditor').length ) { CKEDITOR.replace( '.ckeditor' ); }
      if ( $('.select2').length ) { $('.select2').select2(); }
      if ( $('.jsDataTable').length ) { $('.jsDataTable').DataTable(); }
    </script>
  </body>
</html>