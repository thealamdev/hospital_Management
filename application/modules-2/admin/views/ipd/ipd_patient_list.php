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
          <a href="admin/ipd_registration"><button class="btn btn-info btn-md mb-2">Add Patient</button></a>
          <table id="test_table" class="table table-bordered table-hover data-tables"
          data-options='{ "paging": false; "searching":false}'>
          <thead>
            <tr>
              <th>SL NO</th>
              <th>Patient ID</th>
              <th>Patient Name</th>
              <th>Phone No</th>
              <th>Ref.Doc</th>
              <th>Q/C.Doc</th>
              <th>Cabin No</th>
              <th>Admit Date</th>
              <!---<th style="width:10%;">Action</th>-->
            </tr>
          </thead>
          <tbody>
            <?php $i=1;
            foreach ($ipd_all_patient as $key => $value) {?>
              <tr>
                <td><?=$i?></td>
                <td><?=$value['patient_info_id']?></td>
                <td><?=$value['patient_name']?></td>
                <td><?=$value['mobile_no']?></td>
                <td><?=$value['ref_doctor_name']?></td>
                <td><?=$value['ref_doc_name_t']?></td>

                <td>
                  <?php
                  foreach ($room as $key => $val) 
                  {
                    $room_id=$val['id'];
                    $ipd_room_id=$value['cabin_no'];
                    if($room_id==$ipd_room_id)
                    {
                     echo $val['room_title'];
                     
                   }
                 }
                 
                 ?></td>
                 <td><?=$value['created_at']?></td>
                 <td>
                   <a href="admin/patient_details/<?=$value['id']?>" class="btn btn-primary btn-sm">
                   Details</a>
                 </br></br>
									<!--<a href="admin/add_operation/<?//=$value['patient_info_id']?>/<?//=$value['id']?>/<?php //echo $room_id?>" class="btn btn-primary btn-sm">Add Operation</a>
									</br></br>
									<a href="admin/add_service/<?//=$value['patient_info_id']?>/<?//=$value['id']?>/<?php //echo $room_id?>" class="btn btn-primary btn-sm">
									Add Service</a>-->
               </td>
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