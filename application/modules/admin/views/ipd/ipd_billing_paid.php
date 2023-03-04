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
          <!-- <div class="card-title">Simple usage</div> -->
          <table id="test_table" class="table table-bordered table-hover test_table_report"
          >
          <thead>
            <tr>
              <th>SL NO</th>
              <th>Invoice NO</th>
              <!-- <th>Patient Code</th> -->
              <th>Patient Name</th>
              <th>Mobile No</th>
              <!-- <th style="width:10%;">Reg Form</th> -->
              <th style="width:10%;">Print Invoice</th>
              <th style="width:10%;">Phar Info</th>
              <th style="width:10%;">Service By OPD</th>
              <th style="width:10%;">Status</th>
              <th style="width:10%;">Action</th>
              <th style="width:10%;">Admit Date</th>
              <th style="width:10%;">Release Date</th>
              <th style="width:10%;">Edit</th>
              <th style="width:10%;">Delete</th>
              <th style="width:10%;">Operation Cost Det.</th>
              <th style="width:10%;">Operation Det. (Print)</th>
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
        url:"<?php echo base_url()?>"+'admin/ipd_patient_billing_list_all_dt/paid',  
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