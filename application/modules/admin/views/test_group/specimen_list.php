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
      <div class="form-group ml-4 mt-4">
        <a href="admin/add_specimen"><button type="button"  class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Add Specimen</button></a>

      </div>


      <div class="card my-3 no-b">
        <div class="card-body">

         <table id="test_table" class="table table-bordered table-hover data-tables test_table_report"
         data-options='{ "paging": false; "searching":false}'>
         <thead>
          <tr>
            <th>SL NO</th> 
            <th>Specimen</th>                
            <th>Date</th>
            <th>Edit/Delete</th>
          </tr>
        </thead>
        <tbody>

          <?php $i=1;
          foreach ($specimen_list as $key => $value) {?>
            <tr>
              <td><?=$i?></td>
              <td><?=$value['specimen']?></td>
              <td><?=date('d-M-Y h:i:s a',strtotime($value['created_at']))?></td>
              <td align="center"><a href="admin/edit_specimen/<?=$value['id']?>"><i class="fa fa-pencil"></i></a>
               &nbsp;&nbsp; &nbsp;&nbsp; <a href="admin/delete_specimen/<?=$value['id']?>"><i class="fa fa-trash"></i></a>
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