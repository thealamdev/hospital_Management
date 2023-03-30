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

    <div class="card my-3 no-b">
      <div class="card-body">
       <div class="card my-3 no-b">
        <div class="card-body">

          <table id="test_table" class="table table-bordered table-hover test_table_report">
           <thead>
            <tr>
             <th>SL NO</th>
             <th>Doctor Name</th>
             <th>Patient Id</th>
             <th>Invoice Id</th>
             <th>Patient Name</th>
             <th>Operation Name</th>
             <th>Operation Cost</th>
             <th>Cost Paid</th>
             <th>Discount</th>
             <!-- <th>Discount Ref</th> -->
             <th>Status</th>
             <th>Details</th>
             <th>Date</th>
             <th>Operator ID</th>


           </tr>
         </thead>
         <tbody>

          <?php 
          $i=1;
          $total_operation_cost=0;
          $total_cost_paid=0;
          $total_discount=0;
          foreach ($service_info as $key => $value1) { 

           $total_operation_cost+=$value1['price'];
           $total_cost_paid+=$value1['cost_paid'];
           $total_discount+=$value1['discount'];
           ?>

           <tr>
            <td><?=$i++?></td>
            <td><?=$value1['operated_name']?></td>
            <td><?=$value1['patient_info_id']?></td>
            <td><?=$value1['invoice_order_id']?></td>
            <td><?=$value1['patient_name']?></td>
            <td><?=$value1['service_name']?></td>
            <td><?=$value1['price']?></td>
            <td><?=$value1['cost_paid']?></td>
            <td><?=$value1['discount']?></td>
            <!-- <td><?=$value1['discount_ref']?></td> -->
            <td align="center">
              <?php if($value1['price']-$value1['discount'] <= $value1['cost_paid']) {

                echo "paid";

              } else {
                echo "unpaid"; ?>


                <br><a class="btn btn-sm btn-primary" href="admin/one_click_payment_operation_cost/<?=$value1["s_id"]?>/pay_to_doc">Pay</a>
              <?php  }
              ?>



            </td>




            <td>

             <a target="_blank" href="admin/operation_cost_details/<?=$value1['s_id']?>">Payment Details</a>

           </td>


           <td><?=date('d-m-Y h:i a', strtotime($value1['created_at']))?></td>
           <td><?=$value1['operator_name']?></td>
         </tr>

       <?php } $i++;?>

     </tbody>

     <tfoot>

       <tr>
         <td align="right" colspan="7">Total Cost: <?=$total_operation_cost?></td>
         <td align="">Total Paid:<?=$total_cost_paid?> </td>
         <td>Total Discount:<?=$total_discount?></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>

       </tr>
     </tfoot>

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
   </body>
   </html>