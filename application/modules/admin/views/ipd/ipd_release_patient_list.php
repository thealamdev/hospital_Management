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

          <input type="hidden" value="<?=$flag?>" id="flag_id" name="">
         <table id="test_table" class="table table-bordered table-hover "
       >
         <thead>
          <tr>
            <th>SL NO</th>
            <th>Patient Code</th>
            <th>Patient Name</th>
            <th>Phone No</th>
            <!-- <th>Email</th> -->
            <th>Reg Form</th>
            <th style="width:10%;">Service By OPD</th>
            <th style="width:10%;">Phar Info</th>
            <th>Print</th>
            <th>Admit Date</th>
            <th>Released Date</th>
            <th>Edit</th>
            <th>Delete</th>

            <!-- <th>View</th> -->

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
        url:"<?php echo base_url()?>"+'admin/ipd_patient_release_unrelese_list_dt/'+$('#flag_id').val(),  
        type:"POST"
      },  
      "columnDefs":[  
      {  
        "targets":[],  
        "orderable":false,  
      },  
      ],  
    });  
    });  
  </script> 


</body>
</html>