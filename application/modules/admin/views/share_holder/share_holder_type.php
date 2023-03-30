<?php $this->load->view('back/header_link'); ?>
<body class="light">
<!-- Pre loader -->
<?php $this->load->view('back/loader'); ?>
 
<div id="app">
    <aside class="main-sidebar fixed offcanvas shadow">
       <?php $this->load->view('back/sidebar'); ?> 
    </aside>
    <!--Sidebar End-->
  <div class="has-sidebar-left">
       <?php $this->load->view('back/navbar'); ?>   
  </div> 
    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <h4>
                            <i class="icon-box"></i>
                            <?= $page_title ?>
                        </h4>
                    </div>
                </div>
            </div>
        </header>
        

        <?php if (isset($message)) {?>
    <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
    <?php } ?>
  <?php echo validation_errors(); ?>

        <div class="section-wrapper">



            <div class="card my-3 no-b">
            <div class="card-body">
              
             

                  <div class="row">
                  <div class="col-md-2"></div>

                  <div class="col-md-6">
                  <form method="post">
                    <div class="form-group">
                       <label for="acc_head" class="col-sm-12 control-label">Title</label>
                       <div class="col-md-10">
                         <input id="title" required="" type="text" name="title" class="form-control ui-autocomplete-input" autocomplete="off">
                       </div>
                    </div>

                    <div class="col-md-10 form-group">
                    <label for="income_expense_title">Amount:</label>
                    <input id="amount" required="" type="text" name="amount" class="form-control ui-autocomplete-input" autocomplete="off">  
                  </div>

                    <div class="col-md-10 form-group">
                    <label for="income_expense_title">Return Amount:</label>
                    <input id="return_amount" required type="text" name="return_amount" class="form-control ui-autocomplete-input" autocomplete="off">  
                  </div>


                  <div class="form-group">
                       <label for="acc_head" class="col-sm-12 control-label">Gratuity Type</label>
                   <div class="col-md-10">
                         <select class="custom-select select2 form-control" name="gratuity_type" required="" id="gratuity_type" required>
                         <option value="">Select Type</option>
                          <option value="1">Monthly</option>
                           <option value="2">Yearly</option>
                           

                         
                        </select>
                       </div>

        <div class="row mt-5">
              <div class="col-md-5"></div>
               <div class="col-md-5">
                   <button type="submit" class="btn btn-success">Submit</button>
               </div>
        </div>
                 
                  </form>

                  </div>

                  
                </div>

              
            </div>
            </div>
          </div>
          </div>
        </div>
    </div>
                
    <!-- /.right-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg shadow white fixed"></div>
</div>

<?php $this->load->view('back/footer_link');?>

<style type="text/css">
  .form-check
  {
    padding-left: 0px !important;
  }
</style>

<script type="text/javascript">

  $(document).ready(function()
  {
  
  $('#check_details_div').hide();

  $('#bkash_details_div').hide();

   $(document).on('input', '#amount', function()
      {
      due_calculation();
      });

    $(document).on('input', '#paid_amount', function()
      {
      due_calculation();
      });

});


  function due_calculation()
  {

    // alert('hi');
    var total_paid=$('#paid_amount').val();
    var total_amount=$('#amount').val();

    var due=parseFloat(total_amount)-parseFloat(total_paid);

    $('#due').val(due.toFixed(2));
  }


function pass_radio_val(){

    var val=$("input[name='optradio']:checked").val();

    if(val==1)
    {
        $('#check_details_div').hide();

         $('#bkash_details_div').hide();

         $('#acc_no').prop('required',false);
         $('#check_no').prop('required',false);
         $('#check_pass_date').prop('required',false);
         $('#ref_no').prop('required',false);
          $('#bkash_no').prop('required',false);
          $('#tx_id').prop('required',false);
    }

    else if(val==2)
    {
        $('#check_details_div').show();

         $('#bkash_details_div').hide();

         $('#acc_no').prop('required',true);
         $('#check_no').prop('required',true);
         $('#check_pass_date').prop('required',true);
         $('#ref_no').prop('required',true);
         $('#bkash_no').prop('required',false);
         $('#tx_id').prop('required',false);
    }

    else
    {
      $('#check_details_div').hide();

      $('#bkash_details_div').show();

      $('#acc_no').prop('required',false);
         $('#check_no').prop('required',false);
         $('#check_pass_date').prop('required',false);
         $('#ref_no').prop('required',false);
          $('#bkash_no').prop('required',true);
          $('#tx_id').prop('required',true);

    }
  }

</script>


</body>
</html>