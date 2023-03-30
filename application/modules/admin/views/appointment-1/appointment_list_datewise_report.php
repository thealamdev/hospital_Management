
<?php $this->load->view('back/header_link'); ?>  
<body class="light">
  <!-- Pre loader -->
  <?php $this->load->view('back/loader'); ?> 

  <?php 
  $hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
  $hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];
  ?>
  <div align="center"><button id="btn_print" onclick="print_page('app')" style="width: 80px;height: 50px;background-color: #759ddd; margin:0px">Print</button></div>
  <div id="app" style="color:#000;font-weight:bold;">


    <div class="section-wrapper">
      <div class="card my-3 no-b">
        <div class="card-body">
          <div class="container">
            <div class="">
             <div class="row pl-5 pr-5">
               <div class="col-md-2">
                <img style="height: 110px;width: 110px;" src="uploads/hospital_logo/<?=$hos_logo?>" alt="">  
              </div>      
              <div class="col-md-8">

               <?=$hos_head_report?>
             </div> 

             <div class="col-md-12" style="border-bottom:#000 solid 1px">

              <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report From <?php echo $from_date?> to <?php echo $end_date?> </p>
            </div>


          </div>

          <!-- Table row -->
          <div class="row pl-5 pr-5 my-3">
            <div class="col-md-12">

              <?php if($doc_id=="All"){ 

                foreach ($doc_info as $key => $doc_in) { ?>
                  

                  <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report Type: <?=$doc_in['doctor_title']?> ( <?=$doc_in['doctor_degree']?> ) ( <?=$doc_in['doc_mobile_no']?> )</p>


                  <table class="table table-bordered test_table_report" id="test_table">
                   <thead>
                    <tr>
                      <th>S.L</th>
                      <th>Appointment Date & Time</th>
                      <th>Appointment Id</th>
                      <th>Serial</th>
                      <th>Doctor</th>
                      <th>Patient Name</th>
                      <th>Ref By</th>
                      <th>Patient Type</th>
                      <th>Mobile</th>
                      <th>Total Amount</th>
                      <th>Discount</th>
                      <th>Net Amount</th>
                      <th>Paid Amount</th>
                      <th>Due</th>
                      <th>Date</th>
                      <th>Details</th>
                      <th>Print</th>
                      <th>Prescription</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php 

                    $total_amount=0;
                    $due=0;
                    $total_paid=0;
                    $net_amount=0;
                    $discount=0;

                    foreach ($appointment_info as $key => $value) { 

                      if($value['doc_id']==$doc_in['doctor_id']){

                        $total_amount+=$value['total_amount'];
                        $due+=$value['net_amount']-$value['total_paid'];
                        $total_paid+=$value['total_paid'];
                        $net_amount+=$value['net_amount'];
                        $discount+=$value['discount'];


                        ?>
                        <tr>
                          <td><?=$key+1?></td>
                          <td><?=$value['schedule_day'].', '.date('d-m-Y', strtotime($value['appointment_date'])).' '.date('h:i a', strtotime($value['appointment_time']))?></td>
                          <td><?=$value['appointment_gen_id']?></td>
                          <td><?=$value['serial_no']?></td>
                          <td><?=$value['doc_name']?> (<?=$value['doc_designation']?>)</td>
                          <td><?=$value['patient_name']?></td>
                          <td><?=$value['ref_doc_name']?></td>
                          <td><?=$value['patient_type']?></td>
                          <td><?=$value['mobile_no']?></td>
                          <td><?=$value['total_amount']?></td>
                          <td><?=$value['discount']?></td>
                          <td><?=$value['net_amount']?></td>
                          <td><?=$value['total_paid']?></td>
                          <td><?=$value['net_amount']-$value['total_paid']?></td>
                          <td><?=date("d-m-Y", strtotime($value['created_at']))?></td>
                          <td><a href="admin/appointment_pay_details/<?=$value['id']?>"class="btn btn-primary btn-xs">Details</a></td>
                          <td><a href="admin/appointment_receipt/<?=$value['id']?>" class="btn btn-primary btn-xs">Print</a></td>
                          <td><a href="admin/add_appointment_prescription/<?=$value['id']?>" class="btn btn-primary btn-xs">Add Presc.</a></td>
                          <td><a href="admin/appointment_prescription/<?=$value['id']?>" class="btn btn-primary btn-xs">Prescription</a></td>
                          <td><button type="button" data-id="<?=$value['id']?>" class="btn btn-danger btn-xs delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
                        </tr>
                      <?php } } ?>
                    </tbody>

                    <tfoot>
                      <tr>
                        <td colspan="9"></td>
                        <td colspan=""><?=$total_amount?></td>
                        <td colspan=""><?=$discount?></td>
                        <td colspan=""><?=$net_amount?></td>
                        <td colspan=""><?=$total_paid?></td>
                        <td colspan=""><?=$due?></td>
                      </tr>
                    </tfoot>

                  </table>

                <?php  } } else { 

                  foreach ($doc_info as $key => $doc_in) { ?>

                   <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report Type: <?=$doc_in['doctor_title']?> ( <?=$doc_in['doctor_degree']?> ) ( <?=$doc_in['doc_mobile_no']?> )</p>


                   <table class="table table-bordered test_table_report" id="test_table">
                     <thead>
                      <tr>
                        <th>S.L</th>
                        <th>Appointment Date & Time</th>
                        <th>Appointment Id</th>
                        <th>Serial</th>
                        <th>Doctor</th>
                        <th>Patient Name</th>
                        <th>Ref By</th>
                        <th>Patient Type</th>
                        <th>Mobile</th>
                        <th>Total Amount</th>
                        <th>Discount</th>
                        <th>Net Amount</th>
                        <th>Paid Amount</th>
                        <th>Due</th>
                        <th>Date</th>
                        <th>Details</th>
                        <th>Print</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php 

                      $total_amount=0;
                      $due=0;
                      $total_paid=0;
                      $net_amount=0;
                      $discount=0;

                      foreach ($appointment_info as $key => $value) { 


                        $total_amount+=$value['total_amount'];
                        $due+=$value['net_amount']-$value['total_paid'];
                        $total_paid+=$value['total_paid'];
                        $net_amount+=$value['net_amount'];
                        $discount+=$value['discount'];


                        ?>
                        <tr>
                          <td><?=$key+1?></td>
                          <td><?=$value['schedule_day'].', '.date('d-m-Y', strtotime($value['appointment_date'])).' '.$value['start_time'].'-'.$value['end_time']?></td>
                          <td><?=$value['appointment_gen_id']?></td>
                          <td><?=$value['serial_no']?></td>
                          <td><?=$value['doc_name']?> (<?=$value['doc_designation']?>)</td>
                          <td><?=$value['patient_name']?></td>
                          <td><?=$value['ref_doc_name']?></td>
                          <td><?=$value['patient_type']?></td>
                          <td><?=$value['mobile_no']?></td>
                          <td><?=$value['total_amount']?></td>
                          <td><?=$value['discount']?></td>
                          <td><?=$value['net_amount']?></td>
                          <td><?=$value['total_paid']?></td>
                          <td><?=$value['net_amount']-$value['total_paid']?></td>
                          <td><?=date("d-m-Y", strtotime($value['created_at']))?></td>
                          <td><a href="admin/appointment_pay_details/<?=$value['id']?>"class="btn btn-primary btn-xs">Details</a></td>
                          <td><a href="admin/appointment_receipt/<?=$value['id']?>" class="btn btn-primary btn-xs">Print</a></td>
                          <td><button type="button" data-id="<?=$value['id']?>" class="btn btn-danger btn-xs delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
                        </tr>
                      <?php  } ?>
                    </tbody>

                    <tfoot>
                      <tr>
                        <td colspan="9"></td>
                        <td colspan=""><?=$total_amount?></td>
                        <td colspan=""><?=$discount?></td>
                        <td colspan=""><?=$net_amount?></td>
                        <td colspan=""><?=$total_paid?></td>
                        <td colspan=""><?=$due?></td>
                      </tr>
                    </tfoot>

                  </table>

                <?php } } ?>

              </div>

            </div>


            <!-- this row will not appear when printing -->
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

   <style type="text/css">
    .card-body
    {
      padding-top: 5px !important;
      padding-bottom:5px !important;
      padding-left: 5px !important;
      padding-right:5px !important;

    }
  </style>

  <?php $this->load->view('back/footer_link');?>

<!--   <script type="text/javascript" language="javascript" >  
   $(document).ready(function(){ 

    $('#test_table').dataTable({
      "paging": false,
      "searching": true
    }); 
  });  
</script>   -->




</body>
</html>


