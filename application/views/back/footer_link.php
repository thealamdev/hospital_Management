<script src="back_assets/js/app.js"></script>
<script src="back_assets/js/notify.min.js"></script>
<script src="back_assets/js/alertify.min.js"></script>
<script src="back_assets/js/jasny-bootstrap.min.js"></script>
<script src="back_assets/js/custom.js"></script>
<script src="back_assets/js/Chart.bundle.js"></script>
<script src="back_assets/js/chart.js"></script>
<script src="back_assets/js/summernote.js"></script>
<script src="back_assets/js/summernote.js"></script>
<!-- <script src="//cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script> -->
<script src="back_assets/js/bootstrap3-typeahead.min.js"></script>

<script>
  $(document).ready(function() {
    $('#summernote').summernote({
      tabsize: 2,
        height: 500,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
  });
</script>


<script>

  function print_page(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }

  window.onafterprint = function(){
    location.reload();
  };
</script>


