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
    <div class="container-fluid">
      <div align="right" class="mt-3">
        <a href="" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-print"></i> Pdf</a>
       <!--  <a href="admin/get_patient_info_pdf" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-cloud-download"></i> Pdf</a> -->
      </div>
          <div class="card  no-b">
            <div class="card-body">
               <div class="row">
                <input  type="hidden" id="hidden_patient_id" value="<?=$patient_id?>" name="">
                <input  type="hidden" id="hidden_order_id" value="<?=$order_id?>" name="">
               <div class="col-md-4">
                  <div class="form-horizontal">
                      <label >Patient Name:</label>
                      <label id="patient_name"></label>
                  </div>
                  <div class="form-horizontal">
                      <label for="phone_no">Phone No:</label>
                      <label id="phone_no"></label>
                  </div>

                  <div class="form-horizontal">
                      <label for="age">Age:</label>
                      <label id="age"></label>
                  </div>
                  <div class="form-horizontal">
                      <label for="gender">Gender:</label>
                      <label id="gender"></label>
                  </div>
                  
               </div>
               <div class="col-md-4">
                <div class="form-horizontal">
                      <label for="invoice">Invoice:</label>
                      <label id="invoice"></label>
                  </div>
                 <div class="form-horizontal">
                      <label for="booked_by">Booked By:</label>
                      <label id="booked_by"></label>
                  </div>
                  <div class="form-horizontal">
                      <label for="printed_by">Printed By:</label>
                      <label id="printed_by"></label>
                  </div>
                  
                  <div class="form-horizontal">
                      <label for="ref_by">Ref By:</label>
                      <label id="ref_by"></label>
                  </div>
                  
                  
               </div>
               <div class="col-md-4">
                <div class="form-horizontal">
                      <label for="date_time">Date & Time:</label>
                      <label id="date_time"></label>
                  </div>
                  <div class="form-horizontal">
                      <label for="delivary_date_time">Delivary Date & Time:</label>
                      <label id="delivary_date_time"></label>
                  </div>
                  <div class="form-horizontal">
                      <label for="payment_status">Payment Status:</label>
                      <label id="payment_status" style="font-weight:bold;font-size:14px"></label>

                  </div>
               </div>
             </div>
             <div class="row mt-3" >
               <div class="col-md-3"></div>
               <div class="col-md-6">
                 <table class="table table-bordered test_table_report">
                   <thead>
                     <th>SL</th>
                     <th>Service Booked</th>
                     <th>Charges</th>
                   </thead>
                     <tbody id="patient_ordered_test_table">
                      

                   </tbody>

                 </table>

               </div>
               <div class="col-md-3"></div>
             </div>
            </div>
          </div>
  </div>
</div>
</div>
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>
<script type="text/javascript">

  $(document).ready(function(){
     // alert('hi');
    var patient_id=$('#hidden_patient_id').val();
    var order_id=$('#hidden_order_id').val();

    $.ajax({
            url:"<?=site_url("admin/get_patient_ordered_test_info")?>",
            method:"POST",
            dataType:"json",
            data:{patient_id:patient_id,order_id:order_id},
            success:function(data)
            {
              // var obj=$.parseJSON(data);
               $.each(data, function (key, value) {
                  $('#patient_name').text(value.patient_name);
                  $('#phone_no').text(value.mobile_no);
                  // $('#email').text(value.email);
                  $('#age').text(value.age);
                  $('#gender').text(value.gender);
                  $('#invoice').text(value.test_order_id);
                  $('#booked_by').text(value.operator_name);
                  $('#printed_by').text(value.operator_name);
                  $('#ref_by').text(value.ref_name);
                  $('#payment_status').text(value.payment_status);
                  $('#date_time').text(value.created_at);

                  // var result = new Date('27/07/1990');
                  // result.setDate(result.getDate() + parseInt(2));
                  // var dateEnd = result.getFullYear() + '-' + (result.getMonth()+1) + '-' + result.getDate();
                  // alert(dateEnd);
                  // var myDate = new Date($('#date_time').text(value.created_at)+(5*24*60*60*1000));
                  // alert(myDate);
                  // var date = new Date();
                  // // add a day
                  // alert(date.setDate($('#date_time').text(value.created_at)+ 1));
                  });
            },
                  error: function(e) 
                  {
                    alert(e);
                  }
            
           });

          var i=1;
          $.ajax({
            url:"<?=site_url("admin/get_patient_ordered_test_details_info")?>",
            method:"POST",
            dataType:"json",
            data:{order_id:order_id},
            success:function(data)
            {
               $.each(data, function (key, value) {
                $("#patient_ordered_test_table").append('<tr><td align="center">'+i+'</td><td align="center">'+value.sub_test_title+'</td><td align="center">'+parseFloat(value.price).toFixed(2)+'</td></tr>');
                  i++;
                  });


               $.ajax({
                        url:"<?=site_url("admin/get_order_info")?>",
                        method:"POST",
                        dataType:"json",
                        data:{order_id:order_id},
                        success:function(data){
                        $.each(data, function (key, value) {

                          var net_total=(parseFloat(value.total_amount)+parseFloat(value.total_amount*(value.vat/100)-value.total_amount*(value.total_discount/100))).toFixed(2);
                          var due=(parseFloat(net_total)-parseFloat(value.paid_amount)).toFixed(2);
                          // var total_amount=;

                        $("#patient_ordered_test_table").append('<tr><td colspan="2"align="right">Total</td><td align="center">'+parseFloat(value.total_amount).toFixed(2)+'</td></tr><tr><td colspan="2"align="right">Discount</td><td align="center">'+parseFloat(value.total_discount).toFixed(2)+'</td></tr><tr><td colspan="2"align="right">VAT</td><td align="center">'+parseFloat(value.vat).toFixed(2)+'</td></tr><tr><td colspan="2"align="right">Net Total</td><td align="center">'+net_total+'</td></tr><tr><td colspan="2"align="right">Total Paid</td><td align="center">'+parseFloat(value.paid_amount).toFixed(2)+'</td></tr><tr><td colspan="2"align="right">Due</td><td align="center">'+due+'</td></tr>');
                      });
                        }
                      });

            }
           });
});
</script>


</body>
</html>