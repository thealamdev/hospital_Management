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
          <form method="POST" action="admin/day_wise_collection_pharmacy_report" target="_blank">
           <div class="form-row">
            <div class="form-group col-md-3">

             <label for="inputEmail4" class="col-form-label">Start Date</label>
             <div class="input-group ml-3">
              <input type="text" name="start_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
              data-options='{"timepicker":false, "format":"Y-m-d"}' value="" required="" autocomplete="off" />
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
            data-options='{"timepicker":false, "format":"Y-m-d"}' value="" required="" autocomplete="off" />
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

    <hr>
    <hr>
    <table id="test_table" class="table table-bordered table-hover table-striped test_table_report"
    >
    <thead>
      <tr>
        <th>SL NO</th>
        <th>Customer Name</th>
        <!-- <th></th> -->
        <th>Invoice ID</th>
        <th>Total Amount</th>
        <th>Total Collection</th>
        <th>Vat</th>

        <th>Discount</th>

        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1;
      $total_col=0;
      $total=0;
      $total_discount=0;
      $total_vat=0;

      $due=0;
      foreach ($sell_info as $key => $value) {
// $value['due']=$value['total_amount']-($value['paid_amount']+$value['total_discount']);

        $total_col+=$value['paid_due'];

        $total_discount+=$value['discount'];

        $total_vat+=$value['vat'];

        ?>
        <tr>
         <td><?=$i?></td>
         <td><?=$value['cust_name']?></td>
         <!-- <td><?=$value['patient_info_id']?></td> -->
         <td><?=$value['order_id']?></td>

         <td><?=$value['total_amount']?></td>
         <td align="right"><?=$value['paid_due']?></td>

         <td align="right"><?=$value['vat']?></td>

         <td align="right"><?=$value['discount']?></td>

         <td><?=date('d M,Y h:i a',strtotime($value['created_at']))?></td>


       </tr>

       <?php $i++;

// $toatl+=$value['total_amount'];
// $toatlp+=$value['paid_amount'];
// $total_discount+=$value['total_discount']; 
// $total_vat+=$value['total_vat']; 
// $due+=$toatl-($toatlp+$total_discount);  
     }?>


   </tbody>
   <tfoot style="background:#ccc;font-weight: bold;">

   </style>
   <tr>
    <td colspan="4"></td>
    <td>Total Col: <?php echo number_format($total_col,2,'.','')?> </td>
    <td>Total Vat: <?php echo number_format($total_vat,2,'.','')?> </td>


    <td>Total Dis: <?php echo number_format($total_discount,2,'.','')?> </td>
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