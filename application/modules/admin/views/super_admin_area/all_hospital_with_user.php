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
     <div class="modal fade" id="edit_hospital_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Hospital Title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="md-form mb-2">
              <i class="fa fa-h-square" aria-hidden="true"></i>
              <label data-error="wrong" data-success="right" for="edit_hospital_text">Hospital</label>
              <input type="text" id="edit_hospital_text" class="form-control validate">
              <input type="hidden" name="hidden_hospital_id" id="hidden_hospital_id">
            </div>

          </div>
          <div class="modal-footer">
            <button class="btn btn-outline-primary btn-sm"  id="update_hospital_button">Update<i class="fa fa-plus ml-1"></i></button>
            <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group ml-4 mt-4">
    <a href="admin/add_user" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Add New User</a>
  </div>
  <div class="card my-3 no-b">
    <div class="card-body">
      <!-- <div class="card-title">Simple usage</div> -->
      <table id="test_table" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>SL NO</th>
            <th>Hospital Title</th>
            <th>User Name (Password)</th>
            <!-- <th style="width:10%;">Action</th> -->
          </tr>
        </thead>

      </table>
    </div>
  </div>
</div>
</div> 
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
      url:"<?php echo base_url()?>"+'admin/all_hospital_user_list_dt/',  
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

<script type="text/javascript">

  $(document).on('click','.product_delete_button', function(event)
  {
       //var row_id = 
       var log_id=$(this).attr("id");;

       alert(log_id);
       
       alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
        function()
        {
          $.ajax({  

            url:"<?=site_url('admin/delete_user')?>",  
            method:"POST",  
            data:{log_id:log_id},
            dataType:"json",  
            success:function(data)  
            { 
              setTimeout( my_fun_delete,500);
            },
            error: function (e) {
              setTimeout( my_fun_delete,500);
            }   
          });

        },
        function()
        {

        });
     });
  function my_fun() {
   $('#add_modal').modal('hide');
   location.reload();
 }
 function my_fun_sub() {
   $('#add_sub_modal').modal('hide');
   location.reload();
 }
 function my_fun_delete() {
       // location.reload();
       window.location="admin/all_hospital_user_list";
     }
     function my_fun_update() {
      $('#edit_modal').modal('hide');
      location.reload();
    }
    function my_fun_sub_update() {
      $('#edit_sub_test_modal').modal('hide');
      location.reload();
    }
  </script>
</body>
</html>