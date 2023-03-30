<?php $role=$this->session->userdata['logged_in']['role']; ?>

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
    <?php if (isset($message)) {?>
      <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
    <?php } ?>
    <?php echo validation_errors(); ?>

    <div class="card my-3 no-b">
      <div class="card-body">
        <div class="form-group">
         <a href="admin/sell_product" id="" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Sell Product</a>
       </div>
       <form method="POST" action="admin/sell_product_list_day_wise_report" target="_blank">
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
            <label for="inputEmail4" class="col-form-label">End  Date</label>

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

          <div class="col-md-3">
           <label for="inputEmail4" class="col-form-label">Dept</label>

           <select class="custom-select select2 form-control" name="dept_id" id="dept_id" required>
        
            <option value="all">All</option>
            <option value="1">OPD</option>
            <option value="2">IPD</option>
            <option value="4">UHID</option>
            <option value="3">Pharmacy</option>   
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



    <br><h3 style="text-align: center;">Todays Sale Report</h3><br>
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
</div>
</div> 
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>