<?php $this->load->view('back/header_link'); ?>
<!-- <?php $role=$this->session->userdata['logged_in']['role']; ?> -->
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
          <!-- <div class="card-title">Simple usage</div> -->
          <table id="test_table" class="table table-bordered table-hover table-striped test_table_report"
          >
          <thead>
            <tr>
              <th>SL NO</th>
              <th>Reg No</th>
              <th>Patient Name</th>
              <th>Father Name</th>
              <th>Mother Name</th>
              
              <th>Date of Birth</th>
              <th>Date of Death</th>
              <th>Place of Birth</th>
              <th>Height</th>
              <th>Weight</th>
              <th>Ref Dr.</th>
              <th>Gender</th>
              <th>Cabin</th>
              <th>Image</th>
              <th>Mobile No</th>
              <th>Date</th>
              <th>Operatore Name</th>
              <th>Print</th>
              <th>Edit/Delete</th>
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

   <script type="text/javascript">
     function delete_uhid(uhid) {



      alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
        function()
        {

          $("#o_id").val(uhid);
          $('#delete_reason_modal').modal('show');

        },
        function()
        {

        });
    }
  </script>

  <script type="text/javascript" language="javascript" >  
   $(document).ready(function(){ 

    var dataTable = $('#test_table').DataTable({  
     "processing":true,  
     "serverSide":true,  
     "order":[],  
     "ajax":{  
      url:"<?php echo base_url()?>"+'admin/death_certificate_list_dt/',  
      type:"POST"
    },  
    "columnDefs":[  
    {  
      "targets":[1,6,7,8,9],  
      "orderable":false,  
    },  
    ],  
  });  
  });  
</script>  




</body>
</html>