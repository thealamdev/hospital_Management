<!-- <script type="text/javascript"> 
   setTimeout(function() { 
        window.print();
        self.close();
   }, 1000);
 </script> -->
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
             </div>


           </div>
           <!-- Table row -->
           <div class="row pl-5 pr-5 my-3">
            <div class="col-12 table-responsive">
              <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report of OPD Due Collection Between <?php echo $from_date?> to <?php echo $end_date?> </p>
              <table id="test_table" class="table table-bordered table-hover test_table_report"
              >
              <thead>
                <tr>
                  <th>SL NO</th>

                  <th>Patient Id</th>
                  <th>Imvoice Id</th>
                  <th>Patient Name</th>

                  <th>Total Amount</th>
                  <th>Due Collection</th>
                  <th>Details</th>
                  <th>Date & Time</th>
                  <!-- <th>Others Day Collection</th> -->
                  <!-- <th>Due</th> -->
                  <th>Operator Name</th>

                  <!-- <th style="width:10%;">Details</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $i=1;
                $total_due_c=0;
                $total_due=0;
                $total_others_day_collection=0;

                foreach($due_collection_info as $key => $value1)
                {
                  $total_due_c+=$value1['paid_due'];

                  $total_due+=$value1['total_amount']-$value1['paid_amount'];
                  $total_others_day_collection+=$value1['total_amount']-(($value1['total_amount']-$value1['paid_amount'])+$value1['paid_due']);

                  

                  ?>
                  <tr>
                   <td><?=$i++?></td>

                   <td><?=$value1['patient_info_id']?></td>
                   <td><?=$value1['test_order_id']?></td>
                   <td><?=$value1['patient_name']?></td>
                   <td align="right"><?=$value1['total_amount']?></td>
                   <td align="right"><?=$value1['paid_due']?></td>
                   <td><a target="_blank" href="admin/opd_each_billing_details/<?=$value1['patient_id']?>/<?=$value1['order_id']?>">Payment Details</a></td>

                   <!-- <td><?=$value1['total_amount']-(($value1['total_amount']-$value1['paid_amount'])+$value1['paid_due'])?></td> -->

                   <!-- <td><?=$value1['total_amount']-$value1['paid_amount']?></td> -->
                   <td><?=date("d-m-Y h:i:s a", strtotime($value1['c_at']))?></td>
                   <td><?=$value1['o_name']?></td>

                 </tr> 
                 <?php


               }
               ?>

             </tbody>

             <tfoot>

               <tr>
                 <td align="right" colspan="6">Total Due Collection : <?php echo $total_due_c?></td>
                 <!-- <td align="right">Total Other Day Collection: <?php echo $total_others_day_collection?></td> -->
                 <!-- <td>Total Due: <?php echo $total_due?></td> -->
                 <td></td>
                 <td></td>
                 <td></td>

               </tr>
             </tfoot>
           </table>

         </div>
         <!-- /.col -->
       </div>
       <!-- /.row -->


       <!-- /.row -->

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

   <?php $this->load->view('back/footer_link');?>




 </body>
 </html>
