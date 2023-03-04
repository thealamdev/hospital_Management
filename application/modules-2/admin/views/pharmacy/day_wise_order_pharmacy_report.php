
<?php $this->load->view('back/header_link'); ?>  
<body class="light">
  <!-- Pre loader -->
  <?php $this->load->view('back/loader'); ?> 

  <?php 
  $hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
  $hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];
  ?>
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
              <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report From <?php echo $start_date?> to <?php echo $end_date?> </p>

              <table id="test_table" class="table table-bordered table-hover table-striped test_table_report">
          <thead>
            <tr>
              <th>SL NO</th>
              <th>Order ID</th>
              <th>Supplier Name</th>
              <th>Supplier Name</th>
              <th>Operator Name</th>
              <th>Date</th>
              <th>Order Status</th>
              <th>Order Action</th>
              <th>Details</th>
              <th>Action</th>



              <!-- <th>Date</th> -->
            </tr>
          </thead>
          <tbody>
            <?php $i=1;
            foreach ($order_list as $key => $value) {
              ?>
              <tr>
               <td><?=$i?></td>
               <td><?=$value['order_id']?></td>
               <td><?=$value['supp_name']?></td>
               <td><?=$value['supp_phone']?></td>
               <td><?=$value['operator_name']?></td>
               <td><?=date("d-m-Y h:i a", strtotime($value['created_at']))?></td>

               <td align="center">
                 <?php if($value['is_order_conf']==1) 
                 {
                    echo "<span style='color:green'>order confirmed</span>";
                 } else
                 {
                    echo "<span style='color:red'>order not confirmed</span>";
                 }

                 ?>
               </td>
               <td align="center"><a  class="btn-sm btn-primary" href="admin/order_conf/<?=$value['order_id']?>/yes">Yes</a> / <a target="_blank"  class="btn-sm btn-danger" href="admin/order_conf/<?=$value['order_id']?>/no">No</a></td>

               <td align="center"><a target="_blank" class="btn-sm btn-primary" href="admin/order_phar_pdf/<?=$value['order_id']?>">Print</a></td>
               <td align="center"><a class="btn-sm btn-primary" href="admin/dlt_order/<?=$value['order_id']?>">Delete</a></td>

             </tr>

             <?php $i++;
           }?>

         </tbody>
      </table>


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




</body>
</html>


