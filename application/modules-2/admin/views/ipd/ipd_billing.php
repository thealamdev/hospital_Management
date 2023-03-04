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
                <!-- <div class="card-title">Simple usage</div> -->
                <table id="test_table" class="table table-bordered table-hover data-tables"
                       data-options='{ "paging": false; "searching":false}'>
                    <thead>
                    <tr>
                        <th>SL NO</th>
                        <th>Patient Name</th>
                        <th>Mobile No</th>
                        <th style="width:10%;">Email</th>
                        <th style="width:10%;">Status</th>
                        <th style="width:10%;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                           <?php $i=1;
                            foreach ($ipd_all_released_patient as $key => $value) { ?>
                              
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=$value['patient_name']?></td>
                                    <td><?=$value['mobile_no']?></td>
                                    <td><?=$value['email']?></td>
                                    <td align="center"><?php

                                          if($value['total_amount']==$value['paid_amount']+($value['total_amount']*$value['total_discount']/100)-($value['total_amount']*$value['vat']/100) && $value['total_amount']!=0 ){?>

                                            <span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>

                                          <?php } 
                                          else{ ?>

                                              <span class="badge badge-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
                                         <?php }
                                    ?></td>
									 <td><a href="admin/ipd_payment_details/<?=$value['id']?>/<?=$value['order_id']?>" class="btn btn-success btn-sm">Payment Details</a></td>
                                    <!-- <td><a href="admin/insert_ipd_patient_order_info/<?=$value['order_id']?>/<?=$value['id']?>" class="btn btn-success btn-sm">Payment Details</a></td> -->
                                </tr>
                           <?php $i++; } ?>
                     </tbody>
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