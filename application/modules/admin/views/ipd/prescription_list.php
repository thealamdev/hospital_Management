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
          <a href="admin/add_prescription"><button class="btn btn-info btn-md mb-2">Add Discharge</button></a>
          <table id="test_table" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>SL NO</th>
              <th>Patient ID</th>
              <th>Patient Name</th>
              <th>Prescribed By</th>
              <th>Medicine + Dose Qty + Max Day</th>
              <th>Discharge Copy</th>
              <!-- <th>Max Day</th> -->
              <!-- <th>Doses Schedule</th> -->
              <!-- <th>Action</th> -->
              <th>Date</th>
              <th style="width:10%;">Action</th>
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
    function dlt_confirm(val) {

     alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
      function()
      {
        window.location="admin/delete_prescription/"+val;
      },
      function()
      {
        event.stopPropagation(); event.preventDefault();
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
      url:"<?php echo base_url()?>"+'admin/prescription_list_dt/',  
      type:"POST"
    },  
    "columnDefs":[  
    {  
      "targets":[4,5],  
      "orderable":false,  
    },  
    ],  
  });  
  });  
</script> 



</body>
</html>