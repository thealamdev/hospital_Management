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
    <?php if (isset($message)) {?>
      <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <!-- Add Supplier Modal -->
    <form method="post" action="admin/insert_rack">
     <div class="modal fade" id="add_rack_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Rack</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="md-form mb-2">
              <i class="fa fa-medkit" aria-hidden="true"></i>
              <label data-error="wrong" data-success="right" for="rack_name">Rack Name</label>
              <input type="text" name="rack_name" id="rack_name" required class="form-control validate">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-outline-primary btn-sm"  id="add_supplier_name_button">Add<i class="fa fa-plus ml-1"></i></button>
            <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- Add Supplier Modal End -->

  <!-- Edit Supplier Modal Starts -->

  <div class="modal fade" id="edit_rack_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit rack</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="add_rack_hidden" id="add_rack_hidden">

          <div class="md-form mb-2">
            <i class="fa fa-medkit" aria-hidden="true"></i>
            <label data-error="wrong" data-success="right" for="up_rack">rack Name</label>
            <input type="text" name="up_rack" id="up_rack" class="form-control validate">
          </div>



        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary btn-sm"  id="up_rack_name_button">Add<i class="fa fa-plus ml-1"></i></button>
          <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Supplier Modal Ends -->
  <div class="section-wrapper">

    <div class="form-group ml-4 mt-4">
     <button type="button" id="" data-toggle="modal" data-target="#add_rack_modal" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Add rack</button>
   </div>
   <div class="card my-3 no-b">
    <div class="card-body">
      <!-- <div class="card-title">Simple usage</div> -->
      <table id="test_table" class="table table-bordered table-hover data-tables"
      data-options='{ "paging": false; "searching":false}' style="text-align: center;">
      <thead>
        <tr>
          <th>SL NO</th>
          <th>Rack Name</th>
          <th style="width:10%;">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $i=1;
        foreach ($rack_all_info as $key => $value)
          {?>            
            <tr>
              <td><?=$i?></td>
              <td><span class="badge badge-secondary"><?=$value['rack_title'];?></span></td>

              <td align="center">
                <button type="button" id="rack_edit_<?=$value['id']?>"class="btn btn-success btn-xs up_rack_edit_button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                <button type="button" id="rack_delete_<?=$value['id']?>"class="btn btn-danger btn-xs up_rack_delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
              </td>
            </tr>

            <?php 
            $i++;
          }?>   
        </tbody>
      </table>
    </div>
  </div>
</div>
</div> 
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>


<script type="text/javascript">
  $(document).ready(function()
  {
   $(document).on('click','.up_rack_edit_button', function(event)
   {
    $('#edit_rack_modal').modal('show');

    var row_id = $(this).attr("id");
    var u_id=row_id.replace('rack_edit_','');
    $('#add_rack_hidden').val(u_id);



    $.ajax({  
      url:"<?=site_url('admin/get_specific_rack_details')?>",  
      method:"POST", 
      data:{u_id:u_id},  
      dataType:"json",  
      success:function(data)  
      {
        $("#up_rack").val(data[0]["rack_title"]); 


      }

    });
  });

   $(document).on('click','#up_rack_name_button', function(event)
   {
     var u_id = $('#add_rack_hidden').val();


     var u_name=$('#up_rack').val();

       // alert(type_id);

       $.ajax({  

        url:"<?=site_url('admin/update_rack')?>",  
        method:"POST",
        data:{u_id:u_id,u_name:u_name},  
        dataType:"json",  
        success:function(data)  
        { 
         $("#up_rack_name_button").notify
         (
          "Successfully Updated","success", 
          { position:"bottom" }

          );

         setTimeout( my_fun_update, 2000 );

       },
       error: function (e) {
       }   
     });


     });

   // *********************** Delete Test *******************


   $(document).on('click','.up_rack_delete_button', function(event)
   {
    var row_id = $(this).attr("id");
    var u_id=row_id.replace('rack_delete_','');


    alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
      function()
      {
        $.ajax({  

          url:"<?=site_url('admin/delete_rack')?>",  
          method:"POST",  
          data:{u_id:u_id},
          dataType:"json",  
          success:function(data)  
          { 

            setTimeout( my_fun_delete,0);
          },
          error: function (e) {
            setTimeout( my_fun_delete,0);
          }   
        });

      },
      function()
      {

      });
  });

 });
  function my_fun() {
   $('#add_modal').modal('hide');
   window.location="admin/add_rack"
 }
 function my_fun_sub() {
   $('#add_sub_modal').modal('hide');
   window.location="admin/add_rack"
 }
 function my_fun_delete() {
   window.location="admin/add_rack";
 }
 function my_fun_update() {
  $('#edit_modal').modal('hide');
  window.location="admin/add_rack";
}
function my_fun_sub_update() {
  $('#edit_sub_test_modal').modal('hide');
  window.location="admin/add_rack";
}
</script>