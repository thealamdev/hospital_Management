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

    <div class="section-wrapper">
      <div class="card my-3 no-b">
        <div class="card-body">
         <div class="form-group">
           <a href="admin/add_user" id="" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Add New User</a>
         </div>
         <table id="test_table" class="table table-bordered table-hover data-tables test_table_report"
         data-options='{ "paging": false; "searching":false}'>
         <thead>
          <tr>
            <th>S.L</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Mobile No</th>
            <th>Password</th>
            <th>Role</th>
            <th>Discount Limit</th>
            <th>Dr. / User</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $i=1;
          foreach ($all_user_info as $key => $value)
            {?>            
              <tr>
                <td><?=$i?></td>
                <td><span class="badge badge-secondary"><?=$value['username'];?></span></td>
                <td><span class="badge badge-secondary"><?=$value['email'];?></span></td>
                <td><span class="badge badge-secondary"><?=$value['mobile_no'];?></span></td>

                <td><span class="badge badge-secondary"><?=openssl_decrypt(base64_decode($value['password']), "AES-256-CBC",  hash('sha256',"Lf6Q5htqdgnSn0AABqlsSddj1QNu0fJs"), 0, substr(hash('sha256','This is my secret iv'), 0, 16));?></span></td>

                <td><?=$value['role_name']?></td>
                <td><?=$value['discount_percent'] != 0 ? $value['discount_percent'] . "%" : $value['discount_amount']?></td>
                <td><?=$value['doctor_title'] ? $value['doctor_title'] : "user"?></td>

                <td align="center">
                  <a href="admin/edit_user/<?=$value['id']?>" type="button" class="btn btn-success btn-xs supplier_edit_button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>



                  <button type="button" id="<?=$value['id']?>"class="btn btn-danger btn-xs product_delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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

  $(document).on('click','.product_delete_button', function(event)
  {
       //var row_id = 
       var log_id=$(this).attr("id");;

       // alert(pro_id);
       
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
       window.location="admin/user_list";
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