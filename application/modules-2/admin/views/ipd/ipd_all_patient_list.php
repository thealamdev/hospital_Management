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
          <table id="test_table" class="table table-bordered table-hover table-responsive test_table_report"
          >
          <thead>
            <tr>
              <th>SL NO</th>
              <th>Patient ID</th>
              <th>Reg No</th>
              <th>Patient Name</th>
              <!-- <th>Phone No</th> -->
              <th>Dr.</th>
              <th>Ref Dr.</th>
              <th>Disease Name</th>
              <th>Cabin No</th>
              <th>Admit Date</th>
              <th style="width:10%;">Reg Form</th>
              <th style="width:10%;">Release/UnRelease</th>
              <th style="width:10%;">Edit</th>
            </tr>
          </thead>
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

   <script type="text/javascript" language="javascript" >  
     $(document).ready(function(){ 

      var dataTable = $('#test_table').DataTable({  
       "processing":true,  
       "serverSide":true,  
       "order":[],  
       "ajax":{  
        url:"<?php echo base_url()?>"+'admin/ipd_all_patient_list_dt',  
        type:"POST"
      },  
      "columnDefs":[  
      {  
        "targets":[8,9,10],  
        "orderable":false,  
      },  
      ],  
    });  
    });  
  </script> 



</body>
</html>