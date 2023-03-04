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
    <?php if($this->session->userdata('scc_alt')){ ?>
      <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        <a href="javascript:;" class="alert-link"><?=$this->session->userdata('scc_alt');?></a>
      </div>
    <?php } $this->session->unset_userdata('scc_alt');?>    
    <?php if (isset($message)) {?>
      <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
    <?php } ?>
    <?php echo validation_errors(); ?>         
    <div class="section-wrapper">
      <div class="card my-3 no-b">
        <div class="card-body">
          <div class="container">
            <form action="admin/edit_additional_test_post/<?=$additional_test_det[0]['id']?>" method="POST" class="ipd_form">
              <div class="row">
                <div class="col-md-12">
                 <div class="form-group">
                  <div class="row">
                    <label for="" class="col-md-4 text-right">Additional Test Name</label>
                    <div class="col-md-8"><input class="form-control form-control-sm"  type="text" name="additional_test_name" placeholder="Additional Test Name" value="<?=$additional_test_det[0]['sub_test_title']?>" required></div>
                  </div>
                </div>


                <div class="form-group">
                  <div class="row">
                    <label for="" class="col-md-4 text-right">Price</label>
                    <div class="col-md-8"><input class="form-control form-control-sm"   type="text" value="<?=$additional_test_det[0]['price']?>" name="price" placeholder="Price" required></div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <label for="" class="ml-2 col-md-4 text-right">Add Test Group</label>
                    <div class="col-md-7">
                      <select class="select2" id="add_test_group" name="add_test_group[]" multiple="multiple">
                        <?php foreach ($test_group as $key => $value) { 

                          if(in_array($value['test_id'], explode(',', $additional_test_det[0]['group_id'])) ){ ?>

                             <option selected="" value="<?=$value['test_id']?>"><?=$value['test_title']?></option>

                          <?php } else { ?>

                            <option value="<?=$value['test_id']?>"><?=$value['test_title']?></option>

                         <?php  }
                          ?>

                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>





                <div class="text-right"> 
                 <input type="submit" value="submit" class="btn btn-primary m-2">
               </div>
             </div>

           </div>

         </form>
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




 </body>
 </html>