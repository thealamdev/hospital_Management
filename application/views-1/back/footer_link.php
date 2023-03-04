<script src="back_assets/js/app.js"></script>
<script src="back_assets/js/notify.min.js"></script>
<script src="back_assets/js/alertify.min.js"></script>
<script src="back_assets/js/jasny-bootstrap.min.js"></script>
<script src="back_assets/js/custom.js"></script>
<script src="back_assets/js/Chart.bundle.js"></script>
<script src="back_assets/js/chart.js"></script>
<script src="back_assets/js/summernote.js"></script>
<script src="back_assets/js/summernote.js"></script>
<script src="back_assets/js/bootstrap3-typeahead.min.js"></script>

<script>
  $(document).ready(function() {
    $('#summernote').summernote();
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


