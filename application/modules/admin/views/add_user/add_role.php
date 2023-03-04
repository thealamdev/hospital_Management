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

    </div>


    <div class="card my-3 no-b">
      <div class="card-body">

        <span style="color: red;"><?=$this->session->flashdata('error')?></span>

        <form action="admin/add_role_post" method="POST">
          <div class="row">

            <div class="col-md-3 form-group ">
              <label>Role Name</label>
              <input class="form-control" required="" name="role_name" type="text">
            </div>

            <div  class="mt-4" align="right">
              <button class="btn btn-lg btn-success" style="width: 150px;" type="submit">Save</button>
            </div>

         <!--    <div class="col-md-3 form-group ">
              <label>Display Name</label>
              <input class="form-control" required="" name="display_name" type="text">
            </div> -->

            <div class="col-md-12 form-check ml-3 mb-3">
              <label class="form-check-label">
                <input id="all_permission" onchange="check_fun('all_permission')"  class="form-check-input" type="checkbox"> All
              </label>
            </div>

            <div class="col-md-12">
              <h4 style="font-weight: bold;">Dashboard</h4>
              <div class="row ml-3 mb-3">
                <div class="col-md-2 form-check">
                  <label class="form-check-label">
                    <input id="dashboard" value="486" name="dashboard"  class="form-check-input all_permission" type="checkbox">Dashboard 
                  </label>
                </div>
              </div>
            </div>



            <?php foreach ($permission_group_info as $key => $value) { ?>

              <div class="col-md-12">
                <h4 style="font-weight: bold;"><?=$value['group_name']?></h4>



                <div class="row ml-3 mb-3">
                  <div class="col-md-2 form-check">
                    <label class="form-check-label">
                      <input id="<?=trim($value['name'])?>" onchange="check_fun('<?=trim($value['name'])?>')"  class="form-check-input" type="checkbox"> All
                    </label>
                  </div>

                  <?php foreach ($permission_info as $key => $value1) {

                    if($value1['group_id']==$value['id']){
                      ?>


                      <div class="col-md-2 form-check">
                        <label class="form-check-label">
                          <input name="permission_id[]" value="<?=$value1['id']?>" class="form-check-input <?=trim($value['name'])?> all_permission" type="checkbox"> <?=$value1['display_name']?>
                        </label>
                      </div>

                    <?php } }?>



                  </div>


                </div>

              <?php } ?>

            </div>


            

          </form>




        </div>
      </div>
    </div>
  </div> 
  <div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>
<script type="text/javascript">
  $(document).ready(function(){ 

  });

  function check_fun(id) {


    if($('#'+id).prop('checked')==true)
    {

      $('.'+id).prop('checked',true);
    }
    else
    {
      $('.'+id).prop('checked',false);
    }


  }


</script>
</body>
</html>