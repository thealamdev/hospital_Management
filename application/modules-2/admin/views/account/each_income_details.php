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

    <div class="section-wrapper">
          <div class="card no-b">
            <div class="card-body">
             
            <div class="row">
              
                  <div class="col-md-6">
                  <h2 style="margin-top:0px;" class="">Code: <?=$inc_due_details[0]['auto_id'];?></h2>
                 </div>
                  <div class="col-md-5 offset-md-1">
                    <h2 style="margin-top:0px;" class="">Challan-No: <?=$inc_due_details[0]['challan_no'];?></h2>
                  </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-6">
                <div class="col-md-12">
                    <label><strong>Accounting Head:</strong></label> &nbsp;<?=$inc_due_details[0]['acc_head_title'];?>
                  </div> 
                  <div class="col-md-12">
                    <label><strong>Income By:</strong></label> &nbsp;<?=$inc_due_details[0]['income_expense_title'];?>
                  </div> 
                 <?php if($inc_due_details[0]['paid_by']==1) {?>
                  
                  <div class="col-md-12">
                    <label><strong>Payment Type:</strong></label> &nbsp;Cash
                  </div>  
                
              <?php } else if($inc_due_details[0]['paid_by']==2) {?>

                
                  <div class="col-md-12">
                    <label><strong>Payment Type:</strong></label> &nbsp;Check
                  </div>  
               
               <?php } else if($inc_due_details[0]['paid_by']==3) {?>

                 
                  <div class="col-md-12">
                    <label><strong>Payment Type:</strong></label> &nbsp;Bkash
                  </div>  
               

              <?php } else {?>

               
                  <div class="col-md-12">
                    <label><strong>Payment Type:</strong></label> &nbsp;
                  </div>  
               

              <?php } ?>

              <div class="col-md-12">
                    <label><strong>Purchase Date:</strong></label> &nbsp;
                  <?php $only_date_array=explode(' ', $inc_due_details[0]['created_at']);
                      $only_date=$only_date_array[0];
                     echo date('d M Y', strtotime($only_date));
                    // echo " ".date('h:i:a', strtotime($only_date_array[1]));
                  ?>                    
                  </div> 

              </div>
              <div class="col-md-6">
                <?php if($inc_due_details[0]['paid_by']==2) {?>

                  <div class="col-md-12">
                    <label><strong>Bank Account No:</strong></label> &nbsp;<?=$inc_due_details[0]['bank_acc_no'];?>
                  </div>

                  <div class="col-md-12">
                    <label><strong>Check No:</strong></label> &nbsp;<?=$inc_due_details[0]['check_no'];?>
                  </div>

                  <div class="col-md-12">
                    <label><strong>Check Pass Date:</strong></label> &nbsp;<?=$inc_due_details[0]['check_pass_date'];?>
                  </div>

                  <div class="col-md-12">
                    <label><strong>Reference:</strong></label> &nbsp;<?=$inc_due_details[0]['reference'];?>
                  </div>  

                <?php } ?>

                <?php if($inc_due_details[0]['paid_by']==3) {?>

                  <div class="col-md-12">
                    <label><strong>Bkash No:</strong></label> &nbsp;<?=$inc_due_details[0]['bkash_no'];?>
                  </div>

                  <div class="col-md-12">
                    <label><strong>Tx Id:</strong></label> &nbsp;<?=$inc_due_details[0]['tx_id'];?>
                  </div>

                  

                <?php } ?>
              </div>

            </div>
              

               
                <div class="row mt-4">
                  <div class="col-md-8 offset-md-2">
                    <table class="table table-striped table-bordered table-hover sell_cart">
                      
                      <tbody class="mytable_style" >

                        <tr>
                          <td colspan="4" align="right">
                            <strong>Total Amount:</strong>
                          </td>
                          <td align="right">
                            <?=number_format($inc_due_details[0]['total_amount'],2);?>&nbsp;৳
                          </td>
                        </tr>

                         <tr>
                          <td colspan="4" align="right">
                            <strong>Total Paid:</strong>
                          </td>
                          <td align="right">
                            <?=number_format($inc_due_details[0]['total_paid'],2);?>&nbsp;৳
                          </td>

                        </tr>

                        <tr>
                          <td colspan="4" align="right">
                            <?php $ad= $inc_due_details[0]['total_paid']-$inc_due_details[0]['total_amount'];?>
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

                       
                        <?php if($inc_due_details[0]['total_paid'] < $inc_due_details[0]['total_amount']) {?>
                        
                        <form action="admin/update_income_expense_due/<?=$inc_due_details[0]['id']?>" method="POST">
                                    <tr><td colspan="4"align="right"><button class="btn-xs btn-success" type="submit">Pay</button></td><td><input  style="text-align: right" value="<?=number_format(0,2,'.','')?>" class="form-control" type="text" name="update_inc_exp"></td></tr>
                                  </form>
                          <?php } ?>        
                      </tbody>                    
                    </table>
                  </div>

                  
                </div>
              </div>
            </div><!-- /.row --> 
            </div>
            </div>
  </div>
  </div> 
  <div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>