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
              <form method="post" action="admin/update_income/<?=$inc_info[0]['id']?>">
                <div class="form-group">
                 <label for="acc_head" class="col-sm-12 control-label">Acc Head</label>
                 <div class="col-md-10">
                   <select class="custom-select select2 form-control" name="acc_head" id="acc_head" required>
                     <option>Select Acc Head</option>

                     <?php 
                     foreach ($acc_head_info_inc as $key => $acc_head){ if($acc_head['head_id']==$inc_info[0]['acc_head_id']){ ?>
                      <option selected value="<?=$acc_head['head_id']?>"><?=$acc_head['acc_head_title']?></option>
                    <?php } else {?>
                     <option  value="<?=$acc_head['head_id']?>"><?=$acc_head['acc_head_title']?></option>
                   <?php }} ?>
                 </select>
               </div>
             </div>

             <div class="col-md-10 form-group">
              <label for="income_expense_title">Challan No:</label>
              <input id="challan_no" value="<?=$inc_info[0]['challan_no']?>" required="" type="text" name="challan_no" class="form-control ui-autocomplete-input" autocomplete="off">  
            </div>


            <div class="col-md-10 form-group">
              <label for="income_expense_purpose">Income Purpose:</label>
              <textarea id="income_expense_purpose"  type="text" name="income_expense_purpose" class="form-control ui-autocomplete-input" autocomplete="off"><?=$inc_info[0]['income_expense_purpose']?></textarea>

            </div>

            <div class="col-md-10 form-group">
              <label for="expense_ref">Income Ref:</label>
              <input id="expense_ref" value="<?=$inc_info[0]['inc_exp_ref']?>" required type="text" name="expense_ref" class="form-control ui-autocomplete-input" autocomplete="off">  
            </div>

            <div class="col-md-10 form-group">
              <label for="amount">Amount:</label>
              <input id="amount" value="<?=number_format($inc_info[0]['total_paid'],2,'.', '');?>" required type="text" name="amount" class="form-control ui-autocomplete-input" autocomplete="off">  
            </div>

                  <!-- <div class="col-md-10 form-group">
                    <label for="paid_amount">Advance/Paid:</label>
                    <input id="paid_amount" value="<?=number_format(0,2,'.', '');?>" required type="text" name="paid_amount" class="form-control ui-autocomplete-input" autocomplete="off">  
                  </div>

                  <div class="col-md-10 form-group">
                    <label for="due">Due:</label>
                    <input id="due" value="<?=number_format(0,2,'.', '');?>" required type="text" name="due" class="form-control ui-autocomplete-input" autocomplete="off">  
                  </div> -->


                  <div class="col-md-10 form-group">
                    <label  class="form-check">Paid By:</label>

                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" onclick="pass_radio_val()" <?php if($inc_info[0]['paid_by']==1) echo 'checked' ?>  value="1" name="optradio">Cash
                      </label>
                    </div>

                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" value="2" class="form-check-input" <?php if($inc_info[0]['paid_by']==2) echo 'checked' ?> onclick="pass_radio_val()" name="optradio">Check
                      </label>
                    </div>

                    <div class="form-check-inline ">
                      <label class="form-check-label">
                        <input type="radio" value="3" class="form-check-input" <?php if($inc_info[0]['paid_by']==3) echo 'checked'; ?> onclick="pass_radio_val()" name="optradio" >Bkash
                      </label>
                    </div>

                  </div>

                  <div  class="offset-md-1" id="check_details_div">
                    <div class="col-md-10 form-group">
                      <label for="acc_no">Account No:</label>
                      <input id="acc_no" value="<?php if($inc_info[0]['paid_by']==2) echo $exp_info[0]['bank_acc_no'];?>"  type="text" name="acc_no" class="form-control ui-autocomplete-input" autocomplete="off">  
                    </div>

                    <div class="col-md-10 form-group">
                      <label for="check_no">Check No:</label>
                      <input id="check_no" value="<?php if($inc_info[0]['paid_by']==2) echo $exp_info[0]['check_no'];?>"  type="text" name="check_no" class="form-control ui-autocomplete-input" autocomplete="off">  
                    </div>

                    <div class="form-group">
                     <label for="check_pass_date" class="col-sm-12 control-label">Check Pass Date </label>
                     <div class="input-group ml-3">
                      <input type="text" value="<?php if($inc_info[0]['paid_by']==2) echo $exp_info[0]['check_pass_date'];?>" name="check_pass_date" id="check_pass_date" class="col-sm-8 date-time-picker form-control check_pass_date"
                      data-options='{"timepicker":false, "format":"Y-m-d"}'/>
                      <span class="input-group-append">
                        <span class="input-group-text add-on white">
                          <i class="icon-calendar"></i>
                        </span>
                      </span>
                    </div>
                  </div>

                   <!-- <div class="col-md-10 form-group">
                    <label for="ref_no">Reference No:</label>
                    <input id="ref_no" value="<?php if($exp_info[0]['paid_by']==2) echo $exp_info[0]['inc_exp_ref'];?>" type="text" name="ref_no" class="form-control ui-autocomplete-input" autocomplete="off">  
                  </div> -->
                </div>

                <div class="offset-md-1" id="bkash_details_div">
                  <div class="col-md-10 form-group">
                    <label for="bkash_no">Bkash No:</label>
                    <input id="bkash_no" value="<?php if($inc_info[0]['paid_by']==3) echo $exp_info[0]['bkash_no'];?>"  type="text" name="bkash_no" class="form-control ui-autocomplete-input" autocomplete="off">  
                  </div>
                  <div class="col-md-10 form-group">
                    <label for="bkash_no">Tx Id:</label>
                    <input id="tx_id" value="<?php if($inc_info[0]['paid_by']==3) echo $exp_info[0]['tx_id'];?>" type="text" name="tx_id" class="form-control ui-autocomplete-input" autocomplete="off">  
                  </div>
                </div>

                <div align="right" class="col-md-10 form-group">
                  <button type="submit" class="btn btn-primary">Save</button>
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

      pass_radio_val();

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

    }
  }

</script>


</body>
</html>