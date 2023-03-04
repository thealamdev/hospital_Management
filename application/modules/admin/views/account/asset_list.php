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
    
    <div class="section-wrapper">



      <div class="card my-3 no-b">
        <div class="card-body">
         <div class="row">
          <form method="post" action="admin/add_asset_post">
            <div class="form-row">
              <form method="post">   
               <div class="col-md-2">
                 <label for="acc_head" class="col-sm-12 control-label">Acc Head</label>
                 <select class="custom-select select2 form-control" name="acc_head" required="" id="acc_head" required>
                   <option>Select Acc Head</option>

                   <?php 
                   foreach ($acc_head_info_asset as $key => $acc_head){  ?>
                    <option value="<?=$acc_head['head_id']?>"><?=$acc_head['acc_head_title']?></option>
                  <?php } ?>
                </select>
              </div>


              <div class="col-md-2 form-group">
                <label for="income_expense_title">Challan No:</label>
                <input id="challan_no" required="" type="text" name="challan_no" class="form-control ui-autocomplete-input" autocomplete="off">  
              </div>



              <div class="col-md-2 form-group">
                <label for="income_ref">Company:</label>
                <input id="income_ref" required type="text" name="inc_exp_ref" class="form-control ui-autocomplete-input" autocomplete="off">  
              </div>

              <div class="col-md-2 form-group">
                <label for="per_amount">Per Amount:</label>
                <input id="per_amount" onchange="calc_total()"   type="text" name="per_amount" class="form-control ui-autocomplete-input" autocomplete="off">  
              </div>

              <div class="col-md-2 form-group">
                <label for="qty">Qty:</label>
                <input id="qty" onchange="calc_total()"   type="text" name="qty" class="form-control ui-autocomplete-input" autocomplete="off">  
              </div>

              <div class="col-md-2 form-group">
                <label for="total_amount">Total Amount:</label>
                <input id="total_amount" readonly value="<?=number_format(0,2,'.', '');?>"  type="text" name="total_amount" class="form-control ui-autocomplete-input" autocomplete="off">  
              </div>

              <div class="col-md-2 form-group">
                <label for="income_expense_purpose">Asset Purpose:</label>
                <textarea id="income_expense_purpose" rows=1  type="text" name="income_expense_purpose" class="form-control ui-autocomplete-input" autocomplete="off"></textarea> 
              </div>

                  <!-- <div class="col-md-10 form-group">
                    <label for="paid_amount">Advance/Paid:</label>
                    <input id="paid_amount" value="<?=number_format(0,2,'.', '');?>"  type="text" name="paid_amount" class="form-control ui-autocomplete-input" autocomplete="off">  
                  </div>

                  <div class="col-md-10 form-group">
                    <label for="due">Due:</label>
                    <input id="due" value="<?=number_format(0,2,'.', '');?>"  type="text" name="due" class="form-control ui-autocomplete-input" autocomplete="off">  
                  </div> -->


                  <div class="col-md-2 form-group">
                    <label  class="form-check">Paid By:</label>

                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" checked onclick="pass_radio_val()" value="1" name="optradio">Cash
                      </label>
                    </div>

                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" value="2" class="form-check-input" onclick="pass_radio_val()" name="optradio">Check
                      </label>
                    </div>

                    <div class="form-check-inline ">
                      <label class="form-check-label">
                        <input type="radio" value="3" class="form-check-input" onclick="pass_radio_val()" name="optradio" >Bkash
                      </label>
                    </div>

                  </div>

                  <div  class="offset-md-1" id="check_details_div">
                    <div class="col-md-10 form-group">
                      <label for="acc_no">Account No:</label>
                      <input id="acc_no"  type="text" name="acc_no" class="form-control ui-autocomplete-input" autocomplete="off">  
                    </div>

                    <div class="col-md-10 form-group">
                      <label for="check_no">Check No:</label>
                      <input id="check_no"  type="text" name="check_no" class="form-control ui-autocomplete-input" autocomplete="off">  
                    </div>

                    <div class="form-group">
                     <label for="check_pass_date" class="col-sm-12 control-label">Check Pass Date </label>
                     <div class="input-group ml-3">
                      <input type="text" name="check_pass_date" id="check_pass_date" class="col-sm-8 date-time-picker form-control check_pass_date"
                      data-options='{"timepicker":false, "format":"Y-m-d"}' />
                      <span class="input-group-append">
                        <span class="input-group-text add-on white">
                          <i class="icon-calendar"></i>
                        </span>
                      </span>
                    </div>
                  </div>

                  <div class="col-md-10 form-group">
                    <label for="ref_no">Reference No:</label>
                    <input id="ref_no"  type="text" name="ref_no" class="form-control ui-autocomplete-input" autocomplete="off">  
                  </div>
                </div>

                <div class="offset-md-1" id="bkash_details_div">
                  <div class="col-md-10 form-group">
                    <label for="bkash_no">Bkash No:</label>
                    <input id="bkash_no"  type="text" name="bkash_no" class="form-control ui-autocomplete-input" autocomplete="off">  
                  </div>
                  <div class="col-md-10 form-group">
                    <label for="bkash_no">Tx Id:</label>
                    <input id="tx_id"  type="text" name="tx_id" class="form-control ui-autocomplete-input" autocomplete="off">  
                  </div>
                </div>

                <div align="left" class="col-md-2 form-group">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </form>
        </div>

       <!--  <div class="form-group ml-4 mt-4">
          <form method="POST" action="admin/asset_list_date_wise" target="_blank">
            <div class="form-row mt-3">
              <div class="form-group col-md-3">
                <label for="inputEmail4" class="col-form-label">Start Date</label>

                <div class="input-group ml-3">
                  <input type="text" autocomplete="off" name="start_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
                  data-options='{"timepicker":false, "format":"Y-m-d"}' value="" required="" />
                  <span class="input-group-append">
                    <span class="input-group-text add-on white">
                      <i class="icon-calendar"></i>
                    </span>
                  </span>
                </div>
              </div>
              <div class="form-group col-md-3">
                <label for="inputEmail4" class="col-form-label">End  Date</label>

                <div class="input-group ml-3">
                  <input autocomplete="off" type="text" name="end_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
                  data-options='{"timepicker":false, "format":"Y-m-d"}' value="" required="" />
                  <span class="input-group-append">
                    <span class="input-group-text add-on white">
                      <i class="icon-calendar"></i>
                    </span>
                  </span>
                </div>
              </div>
              <div class="form-group col-md-3">

               <label for="inputEmail4" class="col-form-label">Head List</label>
               <select class="custom-select select2" name="asset_head_id">

                <option value="all">All</option>

                <?php foreach ($acc_head_income as $key => $value) 
                { ?>
                  <option value="<?=$value['head_id']?>"><?=$value['acc_head_title']?></option>
                <?php } ?>

              </select> 
            </div>
            <div class="form-group col-md-3"> 
              <label for="inputEmail4" class="col-form-label"></label>
              <label for="inputEmail4" class="col-form-label"></label>
              <div class="input-group ml-3 mt-2">
                <button type="submit" class="btn btn-success">Submit</button>

              </div>

            </div>

          </div>
        </form>
      </div> -->
      <table id="test_table" class="table table-bordered table-hover test_table_report"
      >
      <thead>
        <tr>
         <th>SL NO</th>
         <th>Acc. Head</th>
         <th>Code</th>
         <th>Challan No</th>
         <th>Asset Purpose</th>
         <th>Asset Ref</th>
         <th>Paid By</th>
         <th>Per Amount</th>
         <th>Qty</th>
         <th>Total Paid</th>
         <th>Date</th>
         <th>Operator</th>
         <th>Print</th>
         <th>Action</th>
       </tr>
     </thead>

   </table>
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

   <script type="text/javascript" language="javascript" >  
     $(document).ready(function(){ 

      var dataTable = $('#test_table').DataTable({  
       "processing":true,  
       "serverSide":true,  
       "order":[],  
       "ajax":{  
        url:"<?php echo base_url()?>"+'admin/asset_list_dt/',  
        type:"POST"
      },  
      "columnDefs":[  
      {  
        "targets":[],  
        "orderable":false,  
      },  
      ],  
    });  
    });  
  </script> 

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

  function calc_total(argument) {

   var per_amount=$('#per_amount').val();
   var qty=$('#qty').val();
   var total_amount=parseFloat(per_amount=="" ? 0 : per_amount)*parseFloat(qty=="" ? 0 : qty);

   $('#total_amount').val(total_amount.toFixed(2));

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