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

         <form method="POST" action="admin/search_pathology_list">
          <div class="row">
            <div class="form-group col-md-3">
              <label for="inputEmail4" class="col-form-label">Patient ID</label>
              
              <div class="input-group ml-3">
                <input type="text" name="patient_id" class="col-sm-12 form-control">

              </div>
            </div>
            
            <div class="form-group col-md-3"> 

              <div class="input-group ml-3">
                <button type="submit" style="margin-top: 35px;" class="btn btn-success">Submit</button>

              </div>

            </div>

          </div>
        </form>

        <table id="test_table" class="table table-bordered table-hover data-tables"
        data-options='{ "paging": false; "searching":false}'>
        <thead>
          <tr>
            <th>SL NO</th>
            <th>Patient ID</th>
            <th>Patient Name</th>
            <th>Order ID</th>
            <th>Group Title</th>
            <th>Test Title</th>
            <th>Total Test</th>
            <th>Payment</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
            
            
          </tr>
        </thead>
        <tbody>

          <?php $i=1;
          foreach ($pathology as $key => $value) {

           $p_patient_info_id=$value['patient_info_id'];
           $p_test_id=$value['test_id'];

           ?>
           <tr>
            <td><?=$i?></td>
            <td><?=$value['patient_info_id']?></td>
            <td><?=$value['patient_name']?></td>
            <td><?=$value['test_order_id']?></td>

            <td><?=$value['test_title']?></td>
            <td><?=$value['sub_test_title']?></td>
            <td><?=$value['total_t']?></td>
            <td><?=$value['payment_status']?></td>
            <td><?=date('d-m-Y h:i a', strtotime($value['created_at']));?></td>

            <td><?php if($value['is_multi_print']==1){echo '<span class="badge badge-danger">Printed</span>';} else {echo '<span class="badge badge-success">Received</span>';}?></td>
            <td>
              <a target="_blank" href="admin/add_report_multi/<?=$value['patient_info_id']?>/<?=$value['test_id']?>/<?=$value['specimen_id']?>/<?=$value['order_id']?>" class="btn btn-primary btn-sm">Report Provide</a>
            </td>

                    <td>
                <?php if($value['is_multi_print']==1 && $value['payment_status'] == "paid") {?>
                  <a target="_blank" href="admin/view_report_order_id/<?=$value['patient_info_id']?>/<?=$value['test_id']?>/<?=$value['order_id']?>" class="btn btn-primary btn-sm">Report Print</a>

                <?php } elseif ($value['is_multi_print']==1 && $report_lock[0]['flag']==0 && $value['is_ipd_patient'] == 0) { ?>
                 <a target="_blank" href="admin/view_report_order_id/<?=$value['patient_info_id']?>/<?=$value['test_id']?>/<?=$value['order_id']?>" class="btn btn-primary btn-sm">Report Print</a>

               <?php } elseif($value['is_multi_print']==1 && $report_lock[0]['flag_ipd']==0 && $value['is_ipd_patient'] == 1) {?>

                <a target="_blank" href="admin/view_report_order_id/<?=$value['patient_info_id']?>/<?=$value['test_id']?>/<?=$value['order_id']?>" class="btn btn-primary btn-sm">Report Print</a>

              <?php } else{ ?>

               <a href="javascript:void(0)" class="btn btn-primary btn-sm">Report Print</a>

             <?php } ?>
           </td>



          </tr>
          <?php $i++; 
        }
        ?>
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