
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
              <div class="col-md-9">

               <?=$hos_head_report?>
             </div> 


             <div class="col-md-12" style="border-bottom:#000 solid 1px">
             </div>


           </div>
           <!-- Table row -->
           <div class="row pl-5 pr-5 my-3">
            <div class="col-12 table-responsive">
              <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report of Other Expense Between <?php echo $from_date?> to <?php echo $end_date?> </p>





              <table id="test_table" class="table table-bordered table-hover test_table_report"
              >
              <thead>
                <tr>
                  <th>SL NO</th>
                  <th>Head Name</th>
                  <th>Head Code</th>
                  <th>Amount</th>
                  <th>Expense Ref</th>
                  <th>Operated By</th>
                  <th>Date</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $i=1;
                $total_amount=0;

                foreach($exp_info as $key => $value1)
                {

                  $total_amount+=$value1['total_paid'];

                  ?>
                  <tr>
                   <td><?=$i++?></td>
                   <td><?=$value1['acc_head_title']?></td>
                   <td><?=$value1['acc_head_code']?></td>
                   <td><?=$value1['total_paid']?></td>
                   <td><?=$value1['inc_exp_ref']?></td>
                   <td><?=$value1['operator_name']?></td>

                   <td><?=$value1['created_at']?></td>

            <!--  <td>
             <a href="admin/com_payment_details/<?=$value1['id']?>">Payment Details</a>
           </td> -->
         </tr> 
         <?php

       }

       ?>

     </tbody>

     <tfoot>
       <tr>
         <td colspan="3"></td>
         <td><?=number_format($total_amount,2,'.', '')?></td>
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
