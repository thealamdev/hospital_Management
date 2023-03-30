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
  <?php if($flag !="date_wise"){ ?>
   <div class="card my-3 no-b">
    <div class="card-body">
     <form method="POST" action="admin/opd_com_date_wise" target="_blank">
      <div class="form-row">
       <div class="form-group col-md-3">
        <label for="inputEmail4" class="col-form-label">Start Date</label>
        <div class="input-group ml-3">
         <input type="text" name="start_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
         data-options='{"timepicker":false, "format":"Y-m-d"}' value=""/>
         <span class="input-group-append">
          <span class="input-group-text add-on white">
           <i class="icon-calendar"></i>
         </span>
       </span>
     </div>
   </div>
   <div class="form-group col-md-3">
    <label for="inputEmail4" class="col-form-label">End Date</label>
    <div class="input-group ml-3">
     <input type="text" name="end_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
     data-options='{"timepicker":false, "format":"Y-m-d"}' value=""/>
     <span class="input-group-append">
      <span class="input-group-text add-on white">
       <i class="icon-calendar"></i>
     </span>
   </span>
 </div>
</div>

<div class="form-group col-md-3">

 <label for="inputEmail4" class="col-form-label">Doctor List</label>
 <select class="custom-select select2" name="doc_name">
  <option value="all">All</option>
  <?php foreach ($doc_list as $key => $value) { ?>

    <option value="<?=$value['doctor_id']?>"><?=$value['doctor_title']?></option>


  <?php }?>  

</select> 
</div>

<div class="form-group col-md-3">
  <label for="inputEmail4" class="col-form-label"></label>
  <label for="inputEmail4" class="col-form-label"></label>
  <div class="input-group ml-3">
   <button type="submit" class="btn btn-success">Submit</button>
 </div>
</div>
</div>
</form>
<div class="card my-3 no-b">
  <div class="card-body">
   <h4 align="center">Today Commission List</h4>
 <?php }  else { ?>
   <h5 align="center"> List From: <?=$start_date?> To <?=$end_date?></h5>
   <div class="card my-3 no-b">
    <div class="card-body">
    <?php } ?>    
    <table id="test_table" class="table table-bordered table-hover test_table_report">
      <thead>
       <tr>
        <th>SL NO</th>
        <th>Doctor Name</th>
        <th>Patient Id</th>
        <th>Patient Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Total Amount</th>
        <th>Gross Com.</th>
        <th>Discount Com.</th>
        <th>Net Com.</th>
        <th>Paid</th>
        <!-- <th>Doc Type</th> -->
        <th style="width:10%;">Status</th>
        <!-- <th style="width:10%;">Action</th> -->
        <th style="width:10%;">Details</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
     <?php
     $i=1;
     $total_amount=0;
     $total_paid_amount=0;
     $total_commission=0;
     $total_gross_commission=0;
     $total_dis_commission=0;
     foreach($comission_list as $key => $value1)
     {

      $total_amount+=$value1['total_amount'];
      $total_paid_amount+=$value1['paid_amount'];
      $total_commission+=$value1['total_commission'];
      $total_gross_commission+=$value1['total_gross_com'];
      $total_dis_commission+=$value1['total_gross_com']-$value1['total_commission'];

      ?>
      <tr>
        <td><?=$i++?></td>
        <td><?=$value1['doc_name']?></td>
        <td><?=$value1['patient_info_id']?></td>
        <td><?=$value1['patient_name']?></td>
        <td><?=$value1['age']?></td>
        <td><?=$value1['gender']?></td>
        <td><?=$value1['total_amount']?></td>
        <td><?=$value1['total_gross_com']?></td>
        <td><?=$value1['total_gross_com']-$value1['total_commission']?></td>
        <td><?=$value1['total_commission']?></td>
        <td><?=$value1['paid_amount']?></td>

        <td><?php
        $st=$value1['com_status'];
        if($st==0)
        {
          $sti="UNPAID".'<br>';
          echo  $sti;
          if($flag!="date_wise" && $value1['payment_status']=="paid"){?>

           <a href="admin/up_full_com_one_click/<?=$value1["id"]?>">Pay</a>
         <?php  } else if($value1['payment_status']=="paid" && $flag=="date_wise") 
         {?>

          <a href="admin/up_full_com_one_click/<?=$value1["id"].'/'.$start_date.'/'.$end_date?>">Pay</a>



        <?php }}
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
      <td>
        <?php if($value1['payment_status']=="paid"){ ?>
         <a href="admin/com_payment_details/<?=$value1['id']?>">Payment Details</a>
       <?php } else{ ?>
         <p style="color: red">Patient Payment Due</p>
       <?php } ?>
     </td>
     <td><?=date("d-m-Y h:i:s a", strtotime($value1['created_at']));?></td>
   </tr>
   <?php
 }

 ?>
</tbody>
<tfoot style="background:#ccc;font-weight: bold;">

</style>
<tr>
  <td colspan="6"></td>
  <td align="right">Total amount: <?php echo number_format($total_amount,2,'.','')?> </td>
  <td align="right">Total: <?php echo number_format($total_gross_commission,2,'.','')?> </td>
  <td align="right">Total: <?php echo number_format($total_dis_commission,2,'.','')?> </td>
  <td align="right">Total: <?php echo number_format($total_commission,2,'.','')?> </td>
  <td align="right">Total Paid Com.: <?php echo number_format($total_paid_amount,2,'.','')?> </td>
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