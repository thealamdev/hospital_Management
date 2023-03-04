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
      <input type="hidden" name="" id="flag_id" value="<?=$flag?>">

      <div class="card my-3 no-b">
        <div class="card-body">
          <a href="admin/opd_registration"><button class="btn btn-info btn-md mb-2">Add Patient</button></a>
          <table id="test_table" class="table table-bordered table-hover test_table_report">
          <thead>
            <tr>
              <th>SL NO</th>
              <th style="width:20%;">Patient ID</th>
              <th>Patient Name</th>
              <th>Phone No</th>
              <th>Dr. Name</th>
              <th>Ref Dr. Name</th>
              <th>Date</th>
              <th style="width:10%;">Status</th>
              <th style="width:10%;">Action</th>
              <th style="width:10%;">Edit/Delete</th>
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




    function delete_patient(patient_id) {



      alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
        function()
        {

          $("#p_id").val(patient_id);
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
      url:"<?php echo base_url()?>"+'admin/show_opd_patient_dt/'+$('#flag_id').val(),  
      type:"POST"
    },  
    "columnDefs":[  
    {  
      "targets":[5,6,7],  
      "orderable":false,  
    },  
    ],  
  });  
  });  
</script>  



</body>
</html>