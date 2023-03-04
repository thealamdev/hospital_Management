<?php $this->load->view('back/header_link'); ?>
<body class="light">
<!-- Pre loader -->
<?php $this->load->view('back/loader'); ?>
 
<div id="app">
   
      <div class="section-wrapper">
          <div class="card no-b">
            <div class="card-body">
             
            <div class="row">
              <div class="col-md-10 offset-md-1">
                  <img class="mb-4" style="height:140px; width: 100%;" src="uploads/hospital_logo/<?=$this->session->userdata['logged_in']['hospital_logo']?>" alt="">
              </div>
              <div class="col-md-10 offset-md-2">
                <div class="row">
                  <div class="col-md-6">
                  <h2 style="margin-top:0px;" class="">Purchase-Code: <?=$buy_details[0]['buy_code'];?></h2>
                  </div>
                  <div class="col-md-6">
                    <h2 style="margin-top:0px;" class="">Bill-No: <?=$buy_details[0]['bill_no'];?></h2>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <label><strong>Supplier Name:</strong></label> &nbsp;<?=$buy_details[0]['supp_name'];?>
                  </div>  
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <label><strong>Purchase Date:</strong></label> &nbsp;
                  <?php $only_date_array=explode(' ', $buy_details[0]['created_at']);
                      $only_date=$only_date_array[0];
                     echo date('d M Y', strtotime($only_date));
                    // echo " ".date('h:i:a', strtotime($only_date_array[1]));
                  ?>                    
                  </div>  
                  
                </div>
                <div class="space-6"></div>
                <div class="row mt-4">
                  <div class="col-md-10">
                    <table class="table table-striped table-bordered table-hover sell_cart">
                      <thead>
                        <tr>
                        <th>S.L</th>
                        <th >Product Name</th>
                        <th >Qty</th>
                        <th >Price</th>
                        <th >Price*Qty</th>
                        </tr>
                      </thead>
                      <tbody class="mytable_style" >
                      
                        <tr>
                          <?php foreach ($buy_details as $key => $row) { ?>
                            
                          <td align="center"><?=$key+1;?></td>
                          <td align="center"><?=$row['p_name'];?></td>
                          <td align="center"><?=$row['buy_qty'];?>&nbsp;<?=$row['unit'];?>
                          </td>
                          <td align="right"><?=number_format($row['buy_price'],2);?>&nbsp;৳ 
                          </td>
                          <td align="right"><?=number_format(($row['buy_price']*$row['buy_qty']),2);?>&nbsp;৳ 
                          </td> 
                        </tr>
                        <?php } ?>
                        
                        <tr>
                          <td colspan="4" align="right">
                            <strong>Total:</strong>
                          </td>
                          <td align="right">
                            <?=number_format($row['credit'],2);?>&nbsp;৳
                          </td>
                        </tr>
                        
                        <tr>
                          <td colspan="4" align="right">
                            <strong>Paid:</strong>
                          </td>
                          <td align="right">
                            <?=number_format($row['debit'],2);?>&nbsp;৳
                          </td>

                        </tr>

                        
                        
                        <tr>
                          <td colspan="4" align="right">
                            <?php $ad= $row['debit']-$row['credit'];?>
                          <?php if($ad>0){ ?>
                            <strong class="text-success">Advance</strong>
                          <?php } else if($ad<0){  ?>

                            <strong class="text-danger">Due</strong>
                          <?php }  else {?>
                            <strong class="text-default">Due/Advance</strong>
                          <?php } ?>

                          </td>
                          <td align="right">
                            <?php if($ad>=0){ ?>
                            <?=number_format($ad,2);?>&nbsp;৳
                            <?php } if($ad<0){ ?>
                            <?=number_format(($ad*(-1)),2);?>&nbsp;৳
                            <?php }  ?>                   
                          </td>   
                        </tr>

                        <tr>
                          <td colspan="4" align="right">
                            <strong>Unload Cost:</strong>
                          </td>
                          <td align="right">
                            <?=number_format($row['unload_cost'],2);?>&nbsp;৳
                          </td>

                        </tr>
                      </tbody>                    
                    </table>
                  </div>

                  
                </div>
              </div>
            </div><!-- /.row --> 
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












