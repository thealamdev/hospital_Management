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
            <th>Name</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>

          <?php $i=1;
          foreach ($staff_group_list as $key => $value) {
            $staff_group_id=$value['id'];
            ?>
            <tr>
              <td><?=$i?></td>
              <td><?=$value['group_name']?></td>
              <td><a target="_blank" class="btn-sm btn-success" href="admin/staff_groups_edit/<?php echo $staff_group_id?>">Edit</a></td>
              <td><a class="btn-sm btn-danger" href="admin/staff_group_dlt/<?php echo $staff_group_id?>">Delete</a></td>
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