
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
        <th>Sell Code</th>
        <th>Sell Date</th>
        <th>Customer Name</th>
        <th>Print</th>
        <th>Total Amount</th> 
        <th>Net Total</th> 
        <th>Amount Paid</th> 
        <th>Discount</th> 
        <th>Vat</th> 
        <th>Due</th> 
        <th>Type</th> 
        <th>P-ID</th>                        
        <th>Cabin No</th>             
        <th>Released</th>             
        <th>Status</th>             
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $i=1;

      $total_amount=0;
      $net_total=0;
      $total_paid=0;
      $total_discount=0;
      $total_vat=0;
      $total_due=0;

      foreach ($all_sell_product_list as $key => $value)
      {
        $total_amount+=$value['credit'];
        $net_total+=$value['net_total'];
        $total_paid+=$value['debit'];
        $total_discount+=$value['discount'];
        $total_vat+=$value['vat'];
        $total_due+=$value['net_total']-$value['debit'];

        ?>            
        <tr>
          <td><?=$i?></td>

          <!-- <td><span class="badge badge-secondary"><?=$value['bill_no'];?></span></td> -->


          <td><span class=""><?=$value['sell_code'];?></span></td>

          <td><span class=""><?=date("d-m-Y", strtotime($value['created_at']));?></span></td>
          <td><span class=""><?=$value['cust_name'];?></span></td>
          <td><span class=""><a href="admin/sell_product_details_pdf/<?=$value['sell_id']?>" type="button" class="btn btn-success btn-xs supplier_edit_button">Print</a></span></td>

          <td><span class=""><?=$value['credit'];?></span></td>
          <td><span class=""><?=$value['net_total'];?></span></td>
          <td><span class=""><?=$value['debit'];?></span></td>
          <td><span class=""><?=$value['discount'];?></span></td>
          <td><span class=""><?=$value['vat'];?></span></td>
          <td><span class=""><?=$value['net_total']-$value['debit'];?></span></td>
          <?php if($value['type']==1)
          { $opd_info=$this->admin_model->select_with_where2('*','status=1 and id= "'.$value['p_id'].'"','opd_patient_info'); ?>
          <td><span>Opd</span></td>
          <td><span><?=$opd_info[0]['patient_info_id']?></span></td>
          <td><span>--</span></td>
          <td><span>--</span></td>
        <?php } 
        else if ($value['type']==2) { 
          $ipd_info=$this->admin_model->select_join_where('*','ipd_patient_info i','room r','r.id=i.cabin_no','i.status=1 and  i.id="'.$value['p_id'].'"');

          ?>
          <td><span>Ipd</span></td>
          <td><span><?=$ipd_info[0]['patient_info_id']?></span></td>
          <td><span><?=$ipd_info[0]['room_title']?></span></td>
          <td><span><?=$ipd_info[0]['type'] == 3 ? "Yes" : "No";?></span></td>
        <?php } else if ($value['type']==4) { 
          $uhid_info=$this->admin_model->select_with_where2('*','status=1 and id= "'.$value['p_id'].'"','uhid');
          ?>

          <td><span>UHID</span></td>
          <td><span><?=$uhid_info[0]['gen_id']?></span></td>
          <td><span>--</span></td>
          <td><span>--</span></td>

        <?php } else 
        { ?>
         <td><span>Pharmacy Only</span></td>
         <td><span>--</span></td>
         <td><span>--</span></td>
         <td><span>--</span></td>
       <?php }

       ?>

       <td align="center"><?php
       if($value['net_total'] <= $value['debit']){?>

        <span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>

      <?php } 
      else{ ?>

        <span class="badge badge-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
      <?php }
    ?></td>

    <td align="center">
      <a href="admin/sell_product_details/<?=$value['sell_id']?>" type="button" class="btn btn-success btn-xs supplier_edit_button">View Details</a>
    </td>
  </tr>

  <?php 
  $i++;
}?>   
</tbody>

 <tfoot>
                  <tr >
                    <td colspan="5"></td>
                    <td>
                     <?php echo $total_amount?>
                   </td>


                   <td>
                     <?php echo $net_total?>
                   </td>


                   <td>
                     <?php echo $total_paid?>
                   </td>


                   <td>
                     <?php echo $total_discount?>
                   </td>


                   <td>
                     <?php echo $total_vat?>
                   </td>

                    <td>
                     <?php echo $total_due?>
                   </td>

                   <td></td>  
                   <td></td>  
                 </tr>

               </tfoot>
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


