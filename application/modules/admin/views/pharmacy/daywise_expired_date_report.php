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
            <div class="invoice white shadow">
             <div class="row pl-5 pr-5">
               <div class="col-md-3">
                <img style="height: 130px;width: 150px;" src="uploads/hospital_logo/<?=$hos_logo?>" alt="">  
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
              <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report of Expire Date Between <?php echo $start_date?> to <?php echo $end_date?> </p>


              <table id="test_table" class="table table-bordered table-hover test_table_report">
               <thead>
                <tr>
                 <tr>
                  <th>SL NO</th>
                  <th>Code</th>
            
                  <th>Product Name</th>
                  <!-- <th>Unit</th> -->
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Expire Days</th>
                  <th>Expire Date</th>
                </tr>
              </tr>
            </thead>
            <tbody>

              <?php 
              $i=1;
              foreach ($product_list as $key => $row) { 

                $current_date=date_create(date('Y-m-d',strtotime(date('Y-m-d'))));
                $next_date=date_create(date('Y-m-d',strtotime($row['expire_date'])));
                $diff=date_diff($next_date,$current_date);

                ?>
                <tr>

                  <td><?=$i?></td>
                  <td><?=$row['p_code'];?></td>
         
                  <td align="center"> 
                    <a href="#" target="_blank" class="hide-option" title="Click to see the Product details"><?=$row['p_name'];?></a>
                  </td>

                  <!--   <td class="hidden-480"><?=$row['sub_cat_name'];?></td> -->
                  <!-- <td><?=$row['unit'];?></td> -->

                  <td align="center"><?=number_format($row['p_sell_price'],2);?> ৳</td>

                  <td align="center" class="hidden-480">
                    <div class="badge <?php if($row['p_current_stock']>$row['p_reorder_qty']){ echo "badge-success";}else{echo "badge-danger";}?>">
                      <?=$row['current_stock'];?>&nbsp;
                      <i class="ace-icon fa <?php if($row['p_current_stock']>$row['p_reorder_qty']){ echo "fa-arrow-up";}else{echo "fa-arrow-down";}?>"></i>
                    </div>
                  </td>
                  <?php if ($diff->y== 0 && $diff->m==0 && $diff->d< 7 && $current_date < $next_date){ ?>

                   <td align="center" style="background:orange;color: white !important;">Only <?=$diff->format('%y year %m month %d day');?> left</td>

                 <?php  } else if($current_date > $next_date)
                 { ?>
                  <td align="center" style="background:red;color: white !important;">Expired <?=$diff->format('%y year %m month %d day');?> ago </td>

                 <?php  }
                 else { ?>

                  <td align="center" style="background:green;color: white !important;"><?=$diff->format('%y year %m month %d day');?></td>

                <?php }  ?>

                <td align="center"><?=date('d-m-Y', strtotime($row['expire_date']));?></td>

              </tr>

            <?php } $i++;?>

          </tbody>

          <tfoot>

           <tr>


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












