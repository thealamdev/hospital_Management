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
         data-options='{ "paging": false; "searching":false}'>
         <thead>
          <tr>
            <th>SL NO</th>
            <th>Doc Name</th>
            <!-- <th>Doc Degree.</th> -->
            <th>Gen ID</th>
            <th>Mobile No</th>
            <th>Doctor Image</th>
            <th>Doc Cat</th>
            <th>Address</th>    
            <th>Marketing Officer Name</th>    

            <th>Details (Com)</th>                                         
            <!-- <th>Type</th> -->
            <th>Edit/Delete</th>
            <!-- <th>Delete</th> -->
            <th>Assign Com.</th>
            <th>View Com.</th>
          </tr>
        </thead>
        <tbody>

          <?php $i=1;
          foreach ($doctor_list as $key => $value) {
            $doctor_id=$value['doctor_id'];
            $doctor_type=$value['doctor_type'];
            if($doctor_type==1)
            {
              $dt="M.B.B.S";
            }
            else
            {
              $dt="Q/C";
            }
            ?>
            <tr>
              <td><?=$i?></td>
              <td><b><?=$value['doctor_title']?></b><br>(<?=$value['doctor_degree']?>)</td>
              <td><?=$value['gen_id']?></td>
              <td><?=$value['doc_mobile_no']?></td> 
              <td><img style="border:2px solid black; height: 100px; width: 100px; max-width: none !important;" src="uploads/doctor_image/<?=$value['profile_img'];?>"></td>
              <td><?=$value['doc_cat']?></td>
              <td><?=$value['address']?></td>
              <td><?=$value['name']?> (<?=$value['designation']?>) <br> <?=$value['contact_no']?></td>
              <td><a target="_blank" class="btn-sm btn-primary" href="admin/opd_com_list_doc_id/<?php echo $doctor_id?>">Details</a></td>
              <td><a target="_blank" class="btn-sm btn-success" href="admin/doc_edit/<?php echo $doctor_id?>">Edit</a>/<a target="_blank" class="btn-sm btn-danger" href="admin/doc_dlt/<?php echo $doctor_id?>">Delete</a></td>
            
              <td><a target="_blank" href="admin/assign_doc_comission/<?php echo $doctor_id?>">Assign Com.</a></td>
              <td><a target="_blank" href="admin/assign_doc_comission_view/<?php echo $doctor_id?>">View Com. List</a></td>
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