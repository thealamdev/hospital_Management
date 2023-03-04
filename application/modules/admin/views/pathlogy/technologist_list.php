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
         <!--  <a href="admin/ipd_registration"><button class="btn btn-info btn-md mb-2">Add Patient</button></a> -->

         <table id="test_table" class="table table-bordered table-hover data-tables"
         data-options='{ "paging": false; "searching":false}'>
         <thead>
          <tr>
            <th>SL NO</th>
            <th>Specimen</th>
            <th>Checked By</th>
            <th>Prepared By</th>
            <th>Techonologist Name</th>
           

            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1;
          foreach ($technologist_list as $key => $value) {?>
            <tr>
              <td align="center"><?=$i?></td>
              <td align="center"><?=$value['specimen']?></td>
              <td align="center"><?=$value['checked_by_name']?></br><?=$value['checked_by_designation']?></br><?=$value['checked_by_address']?></br><?=$value['checked_add_1']?><br><?=$value['checked_add_2']?></td>

              <td align="center"><?=$value['prepared_by_name']?></br><?=$value['prepared_by_designation']?></br><?=$value['prepared_by_address']?></br><?=$value['prepared_add_1']?><br><?=$value['prepared_add_2']?></td>

             <td align="center"><?=$value['technologist_name']?></br><?=$value['technologist_designation']?></br><?=$value['technologist_address']?></br><?=$value['technologist_add_1']?></br><?=$value['technologist_add_2']?></td>
             

               <td align="center">
                 <a href="admin/edit_specimen/<?=$value['id']?>" class="btn btn-primary btn-sm">
                 Edit</a>
        
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