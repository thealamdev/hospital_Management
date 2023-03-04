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
    <a href="admin/add_hospital_form" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Add Hospital</a>
  </div>
  <div class="card my-3 no-b">
    <div class="card-body">
      <!-- <div class="card-title">Simple usage</div> -->
      <table id="test_table" class="table table-bordered table-hover data-tables"
      data-options='{ "paging": false; "searching":false}'>
      <thead>
        <tr>
          <th>SL NO</th>
          <th>Hospital Title</th>
          <th>Logo</th>
          <th>Director Name</th>
          <th>Email</th>
          <th>Mobile No</th>
          <th>Date Summary</th>
          <th>Add Expire Date</th>
          <th style="width:10%;">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $i=1;
        foreach ($hospital as $key => $value)
          {?>            
            <tr>
              <td><?=$i?></td>
              <td><span class="badge badge-secondary"><?=$value['hospital_title'];?></span></td>
              <td><span class="badge badge-secondary"><img style="width: 50px; width: 50px;" src="uploads/hospital_logo/<?=$value['hospital_logo'];?>"></span></td>
              <td><span class="badge badge-secondary"><?=$value['director'];?></span></td>
              <td><span class="badge badge-secondary"><?=$value['email'];?></span></td>
              <td><span class="badge badge-secondary"><?=$value['mobile_no'];?></span></td>
              <td>
                Warning Date 1: <span class="badge badge-success"><?=openssl_decrypt(base64_decode($value['msg_date_1']),"AES-256-CBC",  hash('sha256',"encryptedexpiredaterecently"), 0, substr(hash('sha256','This is my secret iv'), 0, 16));?></span><br><br>
                Warning Date 2: <span class="badge badge-success"><?=openssl_decrypt(base64_decode($value['msg_date_2']),"AES-256-CBC",  hash('sha256',"encryptedexpiredaterecently"), 0, substr(hash('sha256','This is my secret iv'), 0, 16));?></span><br><br>
                Warning Date 3: <span class="badge badge-success"><?=openssl_decrypt(base64_decode($value['msg_date_3']),"AES-256-CBC",  hash('sha256',"encryptedexpiredaterecently"), 0, substr(hash('sha256','This is my secret iv'), 0, 16));?></span><br><br>
                Expire Date: <span class="badge badge-danger"><?=openssl_decrypt(base64_decode($value['expire_date']),"AES-256-CBC",  hash('sha256',"encryptedexpiredaterecently"), 0, substr(hash('sha256','This is my secret iv'), 0, 16));?></span>
              </td>
              <td align="center"><a href="admin/add_expire_date/<?=$value['hospital_id']?>" type="button"  id=""class="btn btn-success btn-xs hospital_edit_button"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a></td>
              <td align="center">
                <a href="admin/edit_hospital_form/<?=$value['hospital_id']?>" type="button"  id="hospital_edit_<?=$value['hospital_id']?>"class="btn btn-success btn-xs hospital_edit_button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <button type="button" id="hospital_delete_<?=$value['hospital_id']?>"class="btn btn-danger btn-xs hospital_delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
              </td>
              <tr>

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

   $(document).on('click','.hospital_delete_button', function(event)
   {
     var row_id = $(this).attr("id");
     var hospital_id=row_id.replace('hospital_delete_','');

     alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
      function()
      {
        $.ajax({  

          url:"<?=site_url('admin/hospital_delete_test')?>",  
          method:"POST",  
          data:{hospital_id:hospital_id},
          dataType:"json",  
          success:function(data)  
          { 
                    // alert(row_id);

                    $.notify
                    (
                      "Successfully Deleted","success", 

                      );
                    setTimeout( my_fun, 1000 );
                    
                  },
                  error: function (e) {

                    $.notify
                    (
                      "Failed", 
                      { position:"bottom" }
                      );
                  }   
                });

      },
      function()
      {

      });
   });

   $(document).on('click','.hospital_edit_button', function(event)
   {
      // $('#edit_hospital_modal').modal('show');
      var row_id = $(this).attr("id");
      var hospital_id=row_id.replace('hospital_edit_','');
       // var hospital_id;
       $('#hidden_hospital_id').val(row_id);
       $.ajax({  

        url:"<?=site_url('admin/get_all_hospital_title')?>",  
        method:"POST", 
        dataType:"json",  
        success:function(data)  
        {
          $.each(data['hospital_name'], function (key, value) {
            if(value.hospital_id==hospital_id)
            {
              $('#edit_hospital_text').val(value.hospital_title);
            }

          });
        },
        error: function (e) {
        }   
      });

     });

   $(document).on('click','#update_hospital_button', function(event)
   {
     var row_id = $('#hidden_hospital_id').val();
     var hospital_id=row_id.replace('hospital_edit_','');
     var hospital_title=$('#edit_hospital_text').val();
     $.ajax({  

      url:"<?=site_url('admin/update_hospital')?>",  
      method:"POST",
      data:{hospital_id:hospital_id,hospital_title:hospital_title},  
      dataType:"json",  
      success:function(data)  
      { 
       $("#update_hospital_button").notify
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

   function my_fun() {
     location.reload();
   }
   function my_fun_update() {
    location.reload();
  }
});
</script>
</body>
</html>