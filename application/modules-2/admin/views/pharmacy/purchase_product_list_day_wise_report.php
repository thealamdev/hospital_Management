
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
              <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report From <?php echo $start_date?> to <?php echo $end_date?> </p>

              <table id="test_table" class="table table-bordered table-hover test_table_report"
              data-options='{ "paging": false; "searching":false}'>
              <thead>
                <tr>
                  <th>S.L</th>
                  <th>Bill No</th>
                  <th>Buy Code</th>
                  <th>Buy Date</th>
                  <th>Supplier Name</th>
                  <!-- <th>Expire Date</th> -->
                  <th>Print</th>
        <!-- <th>Total Amount</th> 
        <th>Net Total</th> 
        <th>Amount Paid</th> 
        <th>Discount</th> 
        <th>Vat</th> 
        <th>Due</th>  -->
        <!-- <th>Type</th>              -->
        <th>Status</th>             
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $i=1;
      foreach ($all_sell_product_list as $key => $value)
        {?>            
          <tr>
            <td><?=$i?></td>

            <td><span class=""><?=$value['bill_no'];?></span></td>


            <td><span class=""><?=$value['buy_code'];?></span></td>

            <td><span class=""><?=date("d-m-Y", strtotime($value['created_at']));?></span></td>
            <td><span class=""><?=$value['supp_name'];?></span></td>
            <!-- <td><span class=""><?=$value['expire_date'];?></span></td> -->
            <td><span class=""><a href="admin/purchage_product_details_pdf/<?=$value['buy_id']?>" type="button" class="btn btn-success btn-xs supplier_edit_button">Print</a></span></td>

           <!--  <td><span class=""><?=$value['credit'];?></span></td>
            <td><span class=""><?=$value['net_total'];?></span></td>
            <td><span class=""><?=$value['debit'];?></span></td>
            <td><span class=""><?=$value['discount'];?></span></td>
            <td><span class=""><?=$value['vat'];?></span></td>
            <td><span class=""><?=$value['net_total']-$value['debit'];?></span></td> -->
  

            <td align="center"><?php
            if($value['cost_total'] <= $value['debit']){?>

              <span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>

            <?php } 
            else{ ?>

              <span class="badge badge-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
            <?php }
            ?></td>

            <td align="center">
              <a href="admin/purchage_product_details/<?=$value['buy_id']?>" type="button" class="btn btn-success btn-xs supplier_edit_button">View Details</a>
            </td>
          </tr>

          <?php 
          $i++;
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


