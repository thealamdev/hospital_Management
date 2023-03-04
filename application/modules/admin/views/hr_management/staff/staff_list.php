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
            <th>Staff Name</th>
            <th>Staff Designation</th>
            <th>Mobile No</th>
            <th>Email</th>
            <th>Staff Image</th>
            <th>Salary</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>

          <?php $i=1;
          foreach ($staff_list as $key => $value) {
            $staff_id=$value['staff_id'];
            ?>
            <tr>
              <td><?=$i?></td>
              <td><?=$value['first_name'].' '.$value['last_name']?></td>
              <td><?=$this->admin_model->anyName_Designation('id',$value['designation_id'],'name');?></td>
              <td><?=$value['mobile']?></td>         
              <td><?=$value['email']?></td>      
              <td><img style="border:2px solid black; height: 100px; width: 100px; max-width: none !important;" src="uploads/staff_images/<?=$value['profile_image'];?>"></td>
              <td><?=$value['total_salary']?></td> 
               <td><a target="_blank" class="btn-sm btn-primary" href="admin/staff_view/<?php echo $staff_id?>">View</a></td>
               <td><a target="_blank" class="btn-sm btn-success" href="admin/staff_edit/<?php echo $staff_id?>">Edit</a></td>
              <td><a class="btn-sm btn-danger" href="admin/staff_dlt/<?php echo $staff_id?>">Delete</a></td>
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