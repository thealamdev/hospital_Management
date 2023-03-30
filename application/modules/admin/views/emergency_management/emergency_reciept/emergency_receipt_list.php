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
            <th>Emegency No</th>
            <th>Patient Name</th>
            <th>Mobile No</th>
            <th>Date</th>
            <th>Diagnosis</th>
            <th>Service Fee</th>
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
          foreach ($emergency_reciept_list as $key => $value) {
            $emergency_reciept_id=$value['emergency_reciept_id'];
            ?>
            <tr>
              <td><?=$i?></td>
              <td><?=$value['emergency_no']?></td>
              <td><?php 
					$patient_type = $value['patient_type'];
					if($patient_type == 1){
		                $patient_name = $this->admin_model->anyName_Opd_patient_list('id',$value['patient_name'],'patient_name');
		                $patient_age = $this->admin_model->anyName_Opd_patient_list('id',$value['patient_name'],'age');
		                $mobile_no = $this->admin_model->anyName_Opd_patient_list('id',$value['patient_name'],'mobile_no');
						
		               }else if($patient_type == 2){
		                $patient_name = $this->admin_model->anyName_Ipd_patient_list('id',$value['patient_name'],'patient_name');
		                $mobile_no = $this->admin_model->anyName_Ipd_patient_list('id',$value['patient_name'],'mobile_no');
		                $patient_age="";
						}else{
		                $patient_name = $value['patient_name']; 
		                $mobile_no = "";
		                $patient_age="";
			           }
					   echo $patient_name;
					
					?></td>
              <td><?=$value['mobile_no']?></td> 
              <td><?php echo date('d-M-y',strtotime($value['date']));?></td> 
              <td><?=$value['diagnosis']?></td> 
              <td><?=$value['hospital_amount']?></td>
              <td><?php if($value['status'] == '1'){ echo "Active";}else{ echo "InActive";}?></td>
              <!-- <td><a target="_blank" class="btn-sm btn-info" href="admin/emergency_reciept_report_view?emrg_reciept_id=<?php echo $emergency_reciept_id?>">Details</a></td> -->
              <td><a target="_blank" class="btn-sm btn-success" href="admin/emergency_receipt_edit/<?php echo $emergency_reciept_id?>">Edit</a></td>
              <td><a target="_blank" href="admin/emergency_reciept_report_view?emrg_reciept_id=<?php echo $emergency_reciept_id?>">Print</a></td>
              <td><a class="btn-sm btn-danger" href="admin/emergency_receipt_dlt/<?php echo $emergency_reciept_id?>">Delete</a></td>
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