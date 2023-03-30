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

      <!-- Add test Modal -->

      <form method="POST" id="modal_form" action="admin/delete_reason_text/bill">

       <div class="modal fade" id="delete_reason_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Test Group</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <input type="hidden" value="" id="o_id" name="o_id">

            <div class="modal-body">
              <div class="form-group">
                <label for="delete_reason">Delete Reason</label>
                <textarea class="form-control" rows="5" name="delete_reason" id="delete_reason"></textarea>
              </div>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-outline-primary btn-sm"  id="add_button_modal">Save<i class="fa fa-plus ml-1"></i></button>
              <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
            </div>
          </div>
        </div>
      </div>
      <!-- end modal -->

    </form>


    <div class="card my-3 no-b">
      <div class="card-body">
        <!-- <div class="card-title">Simple usage</div> -->
        <table id="test_table" class="table table-bordered table-hover table-striped test_table_report"
        >
        <thead>
          <tr>
            <th>SL NO</th>
            <th>Patient ID</th>
            <th>Patient Name</th>
            <th>Mobile No</th>
            <th>Order Id</th>
            <th>Date</th>
            <th>Status</th>
            <th>Details</th>
            <th>Phar. Info</th>
            <th>Print</th>
            <th>Tag</th>
            <th>File Tag</th>
            
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
     function delete_patient(order_id) {



      alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
        function()
        {

          $("#o_id").val(order_id);
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
      url:"<?php echo base_url()?>"+'admin/opd_all_billing_info_dt/<?=$uhid?>',  
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