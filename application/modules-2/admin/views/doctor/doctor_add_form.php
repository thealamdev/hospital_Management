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
      <div class="container">
        <div class="mt-sm-3 shadow-lg p-3 mb-5 rounded">  
          <form method="post" action="admin/doc_add_post" enctype="multipart/form-data">
            <div class="row">


              <div class="col-md-6">

               <div class="form-group">
                <label for="user_name" class="col-sm-12 control-label">Marketing Officer Name</label>
                <div class="col-sm-10">
                 <select class="custom-select select2"  name="marketing_officer_id" >
                  <option value="">--Select--</option>
                  <?php
                  foreach ($marketing_officer_list as $key => $value)
                    {?>


                      <option value="<?=$value['id']?>"><?=$value['name']?> (<?=$value['designation']?>)</option>;

                    <?php }

                    ?>
                  </select> 
                </div>
              </div>  

              <div class="form-group">
                <label for="user_name" class="col-sm-12 control-label">Doctor Type</label>
                <div class="col-sm-10">
                 <select class="custom-select select2"  name="doctor_type" >
                  <option value="0">--Select--</option>
                  <option value="1">MBBS</option>
                  <option value="2">Q/C</option>
                </select> 
              </div>
            </div>   

            <div class="form-group">
              <label for="user_name" class="col-sm-12 control-label">Doctor Category</label>
              <div class="col-sm-10">
               <select class="custom-select select2"  name="doc_cat" >
                <option value="">--Select--</option>
                <?php
                foreach ($doc_cat as $key => $value)
                  {?>

                    <option value='<?=$value['category']?>#<?=$value['id']?>'><?=$value['category']?></option>

                  <?php }

                  ?>
                </select> 
              </div>
            </div>  

            <div class="form-group">
             <label for="user_name" class="col-sm-12 control-label">Doc Name</label>
             <div class="col-sm-10">
               <input class="form-control" name="doc_name" id="doc_name" placeholder="Doctor Name" type="text">
             </div>
           </div>   
           <div class="form-group">
             <label for="email" class="col-sm-12 control-label">Details</label>
             <div class="col-sm-10">
               <input class="form-control" name="doc_experience"  placeholder="Details (M.B.B.S,FCPS etc)" type="text">
             </div>
           </div>

           <div class="form-group">
             <label for="mobile_no" class="col-sm-12 control-label">Mobile No</label>
             <div class="col-sm-10">
               <input class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile No" type="text">
             </div>
           </div>

           <div class="form-group">
             <label for="mobile_no" class="col-sm-12 control-label">Address</label>
             <div class="col-sm-10">
               <input class="form-control" name="address" id="address" placeholder="Address" type="text">
             </div>
           </div>

           <div class="form-group">
            <label for="hospital_logo" class="col-sm-12 control-label">Doctor Picture</label>
            <div class="fileinput fileinput-new" data-provides="fileinput">
              <div class=" border border-secondary fileinput-new thumbnail" style="width: 200px; height: 150px; margin-left: 15px;">
                <img style="width: 100%;height: 100%" src="" alt="...">
              </div>
              <div class="border border-secondary fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
              <div>
                <span class="border border-secondary btn btn-default btn-file" style="margin-left: 15px;"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" id="hospital_logo" name="doc_img"></span>
                <a href="#" class="border border-secondary btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-5">
         <button type="submit" class="btn btn-success">Submit</button>
       </div>
     </div>
   </form>
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



 </body>
 </html>