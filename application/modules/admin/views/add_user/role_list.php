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
            <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
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
    <a href="admin/add_role" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Add Role</a>
  </div>
  <div class="card my-3 no-b">
    <div class="card-body">
      <!-- <div class="card-title">Simple usage</div> -->
      <table id="test_table" class="table table-bordered table-hover data-tables"
      data-options='{ "paging": false; "searching":false}'>
      <thead>
        <tr>
          <th>SL NO</th>
          <th>Role Name</th>
          <th>Permissions</th>
          <th>Date</th>
          <th style="width:10%;">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $i=1;
        foreach ($role_info as $key => $value)
          {?>
            <tr>
              <td><?=$i?></td>

              <td><span class="mt-2 mb-2 badge badge-pill badge-danger"><?=$value['name'];?></span></td>
              <td>
                <?php foreach ($permission_info as $key => $value1)
                { if($value['id']==$value1['role_id']) {?>

                  <span class="mt-1 mb-1 badge badge-pill badge-danger"><?=$value1['display_name'];?></span>

                <?php } } ?>


              </td>

              <td><?=$value['created_at']?></td>

              <td align="center">
               
                <a href="admin/edit_role/<?=$value['id']?>" class="btn btn-success btn-xs edit_button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <button type="button" id="" data-role_id="<?=$value['id']?>" class="btn btn-danger btn-xs delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
  $(document).ready(function(){ 

   $(document).on('click','.delete_button', function(event)
   {

     var role_id=$(this).data("role_id");
     
     alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
      function()
      {
        $.ajax({  

          url:"<?=site_url('admin/delete_role')?>",  
          method:"POST",  
          data:{role_id:role_id},
          dataType:"json",  
          success:function(data)  
          { 

           window.location="admin/role_list";

          }
        });

      },
      function()
      {

      }
      );
   });
 });

</script>
</body>
</html>