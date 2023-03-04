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
          <div class="card-title">Date Wise Other Asset Report</div>
          <form method="POST" action="admin/other_asset_report_date_wise" target="_blank">
           <div class="form-row">
            <div class="form-group col-md-3">

             <label for="inputEmail4" class="col-form-label">Start Date</label>
             <div class="input-group ml-3">
              <input type="text" name="start_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
              data-options='{"timepicker":false, "format":"Y-m-d"}' value="" autocomplete="off" required="" />
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
            data-options='{"timepicker":false, "format":"Y-m-d"}' value="" autocomplete="off" required="" />
            <span class="input-group-append">
              <span class="input-group-text add-on white">
                <i class="icon-calendar"></i>
              </span>
            </span>
          </div>
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
    <hr/>


    <h4 align="center">Today Other Asset Report</h4>

  </div>
</div>

<div class="card my-3 no-b">
  <div class="card-body">

    <table id="test_table" class="table table-bordered table-hover test_table_report"
    >
    <thead>
      <tr>
        <th>SL NO</th>
        <th>Head Name</th>
        <th>Head Code</th>
        <th>Amount</th>

        <th>Operated By</th>
        <th>Date</th>

      </tr>
    </thead>
    <tbody>
      <?php
      $i=1;
      $total_amount=0;

      foreach($asset as $key => $value1)
      {

        $total_amount+=$value1['total_paid'];

        ?>
        <tr>
         <td><?=$i++?></td>
         <td><?=$value1['acc_head_title']?></td>
         <td><?=$value1['acc_head_code']?></td>
         <td align="right"><?=number_format($value1['total_paid'],2,'.', '');?></td>

         <td><?=$value1['operator_name']?></td>
         <td align="right"><?=$value1['created_at']?></td>

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
       </tr>
     </tfoot>
   </table>



 </div>
</div>
<!-- cart one end -->



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