
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
              <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report of Doctor Commission Between <?php echo $from_date?> to <?php echo $end_date?> </p>


              <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report Type: <?=$paid_status?> </p>






              <table id="test_table" class="table table-bordered table-hover test_table_report"
              >
              <thead>
                <tr>
                  <th>SL NO</th>
                  <th>Doctor Name</th>
                  <th>Patient Id</th>
                  <th>Order Id</th>
                  <th>Patient Name</th>
                  <th>Age</th>
                  <th>Gender</th>
                  <th>Mobile</th>
                  <th>Commission</th>
                  <th>Paid</th>
                  <th style="width:10%;">Status</th>
                  <th>Date</th>
                  <th>Operator</th>
                  <!-- <th style="width:10%;">Details</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $i=1;
                $total_com=0;
                $paid_com=0;
                foreach($comission_list as $key => $value1)
                {
                 $total_com+=$value1['total_commission'];
                 $paid_com+=$value1['paid_amount'];

                 ?>
                 <tr>
                   <td><?=$i++?></td>
                   <td><?=$value1['doc_name']?></td>
                   <td><?=$value1['patient_info_id']?></td>
                   <td><?=$value1['test_order_id']?></td>
                   <td><?=$value1['patient_name']?></td>
                   <td><?=$value1['age']?></td>
                   <td><?=$value1['gender']?></td>
                   <td><?=$value1['mobile_no']?></td>
                   <td><?=$value1['total_commission']?></td>
                   <td><?=$value1['paid_amount']?></td>
                   <td><?php
                   $st=$value1['com_status'];
                   if($st==0)
                   {
                     $sti="UNPAID";
                     echo  $sti;

                   }
                   else if($st==1)
                   {
                     $sti="PAID";
                     echo  $sti;


                   }

                   else
                   {
                    $sti="Advance";
                    echo  $sti;
                  }


                  ?></td>

                  <td><?=$value1['created_at']?></td>
                  <td><?=$this->session->userdata['logged_in']['username']?></td>
            <!--  <td>
             <a href="admin/com_payment_details/<?=$value1['id']?>">Payment Details</a>
           </td> -->
         </tr> 
         <?php

       }

       ?>

     </tbody>
     <tfoot>

     </style>
     <tr>
      <td colspan="8"></td>
      <!-- <td align="right">Total Due: <?php echo number_format($total_due,2,'.','')?> </td> -->
      <td align="right"> <?php echo number_format($total_com,2,'.','')?> </td>
      <td align="right"> <?php echo number_format($paid_com,2,'.','')?> </td>

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












