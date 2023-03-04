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
            <form action="admin/add_marketing_officer_post" method="post" enctype="multipart/form-data">

              <div class="row">

                <div class="col-md-12">

                 <div class="form-group">
                  <div class="row">
                    <label for="officer_name" class="col-md-4 text-right">Officer Name</label>
                    <div class="col-md-8"><input class="form-control form-control-sm"  type="text" id="officer_name" name="officer_name" placeholder="Officer Name" required></div>
                  </div>
                </div>


                <div class="form-group">
                  <div class="row">
                    <label for="designation" class="col-md-4 text-right">Designation</label>
                    <div class="col-md-8"><input class="form-control form-control-sm"   type="text" id="designation" name="designation" placeholder="Designation"></div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <label for="description" class="col-md-4 text-right">Description</label>
                    <div class="col-md-8">
                      <textarea class="form-control form-control-sm" id="description" name="description"></textarea>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                  
                     <label for="officer_img" class="col-md-4 text-right">Officer Image</label>
                     <div class="col-md-8">
                     <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class=" border border-secondary fileinput-new thumbnail" style="width: 200px; height: 150px;">
                        <img data-src="holder.js/100%x100%" alt="...">
                      </div>
                      <div class="border border-secondary fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                      <div>
                        <span class="border border-secondary btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="officer_image"></span>
                        <a href="#" class="border border-secondary btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <label for="contact_no" class="col-md-4 text-right">Contact No</label>
                  <div class="col-md-8"><input class="form-control form-control-sm"   type="text" name="contact_no" id="contact_no" placeholder="Contact No" ></div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <label for="address" class="col-md-4 text-right">Address</label>
                  <div class="col-md-8">
                    <textarea class="form-control form-control-sm" id="address" name="address"></textarea>
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