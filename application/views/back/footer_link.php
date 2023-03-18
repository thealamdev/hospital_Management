<script src="back_assets/js/app.js"></script>
<script src="back_assets/js/notify.min.js"></script>
<script src="back_assets/js/alertify.min.js"></script>
<script src="back_assets/js/jasny-bootstrap.min.js"></script>
<script src="back_assets/js/custom.js"></script>
<script src="back_assets/js/Chart.bundle.js"></script>
<!-- <script src="back_assets/js/chart.js"></script> -->
<!-- <script src="back_assets/js/ckeditor.js"></script> -->
<script src="back_assets/js/summernote.js"></script>
<script src="back_assets/js/summernote.js"></script>

 


<script>
  $(document).ready(function() {
    // CKEDITOR.replace("ckeditor",
    //         {
    //             height: 400
    //         });
    $('#summernote').summernote({
      tabsize: 2,
        height: 1000,
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


