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

         <table id="test_table" class="table table-bordered table-hover data-tables"
         data-options='{"paging": false; "searching":false}'>
         <thead>
          <tr>
            <th>SL NO</th>
            <th>Ambulance No</th>
            <th>Trip No</th>
            <th>Patient Name</th>
            <th>Mobile No</th>
            <th>Date</th>
            <th>Road Name</th>
            <th>Driver Name</th>
            <th>Driver Mobile No</th>
            <th>Status</th>
            <!-- <th>View</th> -->
            <th>Edit</th>
            <th>Print</th>
            <th>Delete</th>
            <th>User</th>
          </tr>
        </thead>
        <tbody>

          <?php $i=1;
          foreach ($ambulance_reciept_list as $key => $value) {
            $amb_reciept_id=$value['amb_reciept_id'];
            ?>
            <tr>
              <td><?=$i?></td>
              <td><?=$value['ambulance_no']?> (<?=$value['gen_id']?>)</td>
              <td><?=$value['trip_no']?></td>
              <td><?=$value['patient_name']?></td>
              <td><?=$value['patient_mobile_no']?></td>
              <td><?php echo date('d-M-y',strtotime($value['date']));?></td> 
              <td><?=$value['road_name']?></td>
              <td><?=$value['driver_name']?></td> 
              <td><?=$value['driver_mobile_no']?></td>
              <td><?php if($value['status'] == '1'){ echo "Active";}else{ echo "InActive";}?></td>
              <!-- <td><a target="_blank" class="btn-sm btn-info" href="admin/ambulance_reciept_report_view?amb_reciept_id<?php echo $amb_reciept_id?>">View</a></td> -->
              <td><a target="_blank" class="btn-sm btn-success" href="admin/ambulance_receipt_edit/<?php echo $amb_reciept_id?>">Edit</a></td>
              <td><a target="_blank" href="admin/ambulance_reciept_report_view/<?php echo $amb_reciept_id?>">Print</a></td>
              <td><a class="btn-sm btn-danger" href="admin/ambulance_receipt_dlt/<?php echo $amb_reciept_id?>">Delete</a></td>
              <td><?=$value['operator_name']?></td>
            </tr>
            <?php $i++; }
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