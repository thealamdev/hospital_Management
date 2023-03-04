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
       <!--  <div align="right" class="mt-3 mr-3">
          <a href="admin/get_ipd_patient_billing_info_pdf1/<?=$patient_info[0]['id']?>/<?=$order_id?>" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-cloud-download"></i> Pdf</a>
        </div> -->

        <div class="section-wrapper">
          <div class="card  no-b">
            <div class="card-body">
              <div class="container">
                <div class="invoice white shadow">
                 <div class="row pl-5 pr-5 pt-2">
                  <div  class="col-md-4">
                    <img class="mb-4" style="width: 120px;" src="uploads/hospital_logo/<?=$hospital_info[0]['hospital_logo']?>" alt="">
                  </div> 
                  <div class="col-md-4">
                    <table>
                      <tbody>
                        <tr>
                          <td class="font-weight-normal"><h2><b><?=$hospital_info[0]['hospital_title']?></b></h2>
                            <address class="ml-3">
                              Address: <?=$hospital_info[0]['address_1']?><br>
                              Telephone: <?=$hospital_info[0]['telephone']?><br>
                              Mobile: <?=$hospital_info[0]['mobile_no']?>
                            </address>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div> 
                  <div class="col-md-4"></div>
                </div>

                <div class="row pl-5 pr-5">
                  <div class="col-md-4"></div>
                  <div class="col-md-9">
                    <table>
                      <tbody>
                        <tr>
                          <td>Patient Name: </td>
                          <td><?=$patient_info[0]['patient_name']?></td>
                        </tr>
                        <tr>
                          <td>Age: </td>
                          <td><?=$patient_info[0]['age']?></td>
                        </tr>
                        <tr>
                          <td>Gender: </td>
                          <td><?=$patient_info[0]['gender']?></td>
                        </tr>
                        <tr>
                          <td>Date Of Birth: </td>
                          <td><?=date('d M,Y',strtotime($patient_info[0]['date_of_birth']))?></td>
                        </tr>
                        <tr>
                          <td>Mobile No: </td>
                          <td><?=$patient_info[0]['mobile_no']?></td>
                        </tr>
                        <tr>
                          <td>Address: </td>
                          <td><?=$patient_info[0]['address']?></td>
                        </tr>

                      </tbody>
                    </table>      
                  </div>
                  <div class="col-md-3">
                    <table>
                      <tbody>
                       <tr>
                        <td>Booked By: </td>
                        <td><?=$patient_info[0]['operator_name']?></td>
                      </tr>
                      <tr>
                        <td>Ref Doctor Name: </td>
                        <td><?=$patient_info[0]['ref_doctor_name']?></td>
                      </tr>
                    </tbody>
                  </table>

                </div>
                
              </div>

              <!-- Table row -->
              <div class="row mt-5 pl-5">
                <h4>Admission Fee</h4>
              </div>

              <div class="row pl-5 pr-5 my-2">
                <div class="col-12 table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <th>Admission Fee</th>
                      <th>Admission Fee Paid</th>
                    </thead>
                    <tbody>
                      <td align="right"><?=$patient_info[0]['admission_fee']?></td>
                      <td align="right"><?=$patient_info[0]['admission_fee_paid']?></td>
                    </tbody>
                  </table>
                </div>
              </div>



                    <!-- Table row -->
                    <div class="row mt-5 pl-5">
                      <h4>Cabin Bill</h4>
                    </div>


                    <div class="row pl-5 pr-5 my-2">
                      <div class="col-12 table-responsive">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <th>SL NO</th>
                            <th>Room No</th>
                            <th>Day</th>
                            <th>Price</th>
                            <th style="width:20%">Total</th>
                          </thead>
                          <tbody>
                            <?php $i=1;
                            $days=0;
                            $total_cabin=0;

                          // $last_date=0;
                            foreach ($patient_timeline as $key => $value) { if($key < count($patient_timeline)-1) {?>

                              <tr>
                                <td align="center"><?=$i?></td>
                                <td align="center"><?=$value['room_title']?></td>
                                <td align="right">
                                 <?php 
                                 // echo date('Y-m-d',strtotime($value['created_at']));
                                 // echo date('Y-m-d',strtotime($patient_timeline[$key+1]['created_at']));

                                 $current_date=date_create(date('Y-m-d',strtotime($value['created_at'])));
                                 // echo  $current_date;
                                 // echo  $next_date;
                                 $next_date=date_create(date('Y-m-d',strtotime($patient_timeline[$key+1]['created_at'])));

                                 $diff=date_diff($next_date,$current_date);

                                 $days=$diff->format("%a");
                                 $total_cabin= $total_cabin+($days*$value['room_price']);
                                 echo $days;?>
                               </td>
                               <td align="right"><?=$value['room_price']?></td>




                               <td align="right"><?=$days*$value['room_price']?></td>
                             </tr>

                             <?php $i++;} else { ?>

                              <tr>
                                <td align="center"><?=$i?></td>
                                <td align="center"><?=$value['room_title']?></td>

                                <td  align="right">

                                 <?php $current_date=date('Y-m-d');

                                 $current_date=date_create(date('Y-m-d',strtotime($current_date)));

                                 $next_date=date_create(date('Y-m-d',strtotime($patient_timeline[$key]['created_at'])));

                                 $diff=date_diff($next_date,$current_date);

                                 $days=$diff->format("%a");

                                 if($days==0)
                                 {
                                  $days=1;
                                }

                                echo $days;

                                $total_cabin= $total_cabin+($days*$value['room_price']);

                            // "<pre>";print_r($next_date);die();

                                ?>

                              </td>

                              <td align="right"><?=$value['room_price']?></td>

                              <td align="right"><?=$days*$value['room_price']?></td>

                            <?php } }?>

                            <tr><td colspan="4"align="right">Total</td><td  align="right"> <input style="text-align: right" class="form-control" readonly type="text" name="total" value="<?=number_format($total_cabin,2,'.','')?>"></td></tr>

                          </tbody>
                        </table>
                      </div>
                      <!-- /.col -->

                    </div>



                    <div class="row  pl-5">
                      <h4>Service Bill</h4>
                    </div>

                    <div class="row pl-5 pr-5 my-3">
                      <div class="col-12 table-responsive">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <th>SL NO</th>
                            <th>Service Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th style="width:20%">Total</th>
                          </thead>
                          <tbody>
                            <?php $i=1;

                            $total_ser=0;
                          // $last_date=0;
                            foreach ($service_info as $key => $value) { ?>

                              <tr>
                                <td align="center"><?=$i?></td>
                                <td align="center"><?=$value['service_name']?></td>
                                <td align="right"><?=$value['price']?></td>
                                <td align="right"><?=$value['qty']?></td>
                                <td align="right"><?=$value['price']*$value['qty']?></td>
                              </tr>



                              <?php $total_ser+=$value['price']*$value['qty'];
                              $i++;}  


                              ?>

                              <tr><td colspan="4"align="right">Total</td><td  align="right"> <input style="text-align: right" class="form-control" readonly type="text" name="total" value="<?=number_format($total_ser,2,'.','')?>"></td></tr>
                            </tbody>
                          </table>

                          
                        </div>
                        <!-- /.col -->

                      </div>


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












