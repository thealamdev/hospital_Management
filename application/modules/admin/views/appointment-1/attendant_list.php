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
           <a href="admin/add_attendant" id="" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Add Attendant</a>
         </div>
         <table class="table table-bordered  data-tables">
           <thead>
            <tr>
              <th>S.L</th>
              <th>Attendant User Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i=1;
            foreach ($attendant_list as $key => $value)
              {?>            
                <tr>
                  <td><?=$i?></td>
                  <td><?=$value['username']?></td>
                  
                  <td>                            

                    <button type="button" data-id="<?=$value['id']?>" class="btn btn-danger btn-xs delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>


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

    $(document).on('click','.delete_button', function(event)
    {

      var id=$(this).data('id');

      alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
        function()
        {
          $.ajax({  

            url:"<?=site_url('admin/delete_attendant')?>",  
            method:"POST",  
            data:{id:id},
            dataType:"json",  
            success:function(data)  
            { 

              $("#delete_button_modal").notify
              (
                "Successfully Deleted","success", 
                { position:"bottom" }

                );

              setTimeout( my_fun_delete, 500 );
            },
            error: function (e) {

              $("#delete_button_modal").notify
              (
                "Failed", 
                { position:"bottom" }
                );
              setTimeout( my_fun_delete, 500 );
            }   
          });

        },
        function()
        {

        });
    });


    function my_fun_delete() {

     // window.location="admin/attendant_list";
   }

 </script>