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
          <form method="post" action="admin/insert_tecnologiest" enctype="multipart/form-data">
            <div class="row">
        
              <div class="col-md-6">
                <div class="form-group">
                 <label for="user_name" class="col-sm-12 control-label">Specimen</label>
                 <div class="col-sm-10">
                  
                    <select name="specimen_id" class="form-control">
                      <?php 
                      foreach($speciman as $s_men){
                        ?>
                        <option value="<?php echo $s_men['id'] ?>"><?php echo $s_men['specimen'] ?></option>
                        <?php 
                         }
                        ?>
                      

                      
                         
                    </select>
                   <!-- <input class="form-control" required="" name="specimen" id="specimen" placeholder="" type="text"> -->
                 </div>
               </div>   
               

             </div>
           </div>

           <div style="text-align: center; font-size: 22px;font-weight: bold; color:black; margin-bottom: 15px;margin-top: 10px; text-decoration: underline;">Technologist Area</div>

           <div class="row">
            <!-- first column -->
            <div class="col-md-4">

             <div class="form-group">
               <label for="checked_by" class="col-sm-12 control-label">Checked By</label>
               <div class="col-sm-12">
                <input class="form-control"  name="checked_by" id="checked_by"   type="text">
              </div>
            </div>

            <div class="form-group">
             <label for="checked_by_designation" class="col-sm-12 control-label">Checked By (Designation)</label>
             <div class="col-sm-12">
               <input class="form-control" name="checked_by_designation" id="checked_by_designation"  type="text">
             </div>
           </div>

           <div class="form-group">
             <label for="checked_by_address" class="col-sm-12 control-label">Checked By (Address)</label>
             <div class="col-sm-12">
               <input class="form-control" name="checked_by_address" id="checked_by_address"  type="text">
             </div>
           </div>

           <div class="form-group">
             <label for="checked_by_address" class="col-sm-12 control-label">Additional 1</label>
             <div class="col-sm-12">
               <input class="form-control" name="checked_add_1" id="checked_by_address"  placeholder="" type="text">
             </div>
           </div>

           <div class="form-group">
             <label for="checked_by_address" class="col-sm-12 control-label">Additional 2</label>
             <div class="col-sm-12">
               <input class="form-control" name="checked_add_2" id="checked_by_address"  placeholder="" type="text">
             </div>
           </div>

         </div>

         <div class="col-md-4">

          <div class="form-group">
           <label for="prepared_by" class="col-sm-12 control-label">Prepared By</label>
           <div class="col-sm-12">
             <input class="form-control" name="prepared_by" id="prepared_by"   type="text">
           </div>
         </div>

         <div class="form-group">
           <label for="prepared_by_designation" class="col-sm-12 control-label">Prepared By (Designation)</label>
           <div class="col-sm-12">
             <input class="form-control"  name="prepared_by_designation" id="prepared_by_designation"  placeholder="" type="text">
           </div>
         </div>

         <div class="form-group">
           <label for="prepared_by_address" class="col-sm-12 control-label">Prepared By (Address)</label>
           <div class="col-sm-12">
             <input class="form-control" name="prepared_by_address" id="prepared_by_address"  placeholder="" type="text">
           </div>
         </div>

         <div class="form-group">
           <label for="technologist_address" class="col-sm-12 control-label">Additional 1</label>
           <div class="col-sm-12">
             <input class="form-control" name="prepared_add_1" id="technologist_address"  placeholder="" type="text">
           </div>
         </div>

         <div class="form-group">
           <label for="technologist_address" class="col-sm-12 control-label">Additional 2</label>
           <div class="col-sm-12">
             <input class="form-control"  name="prepared_add_2" id="technologist_address"  placeholder="" type="text">
           </div>
         </div>

       </div>

       <div class="col-md-4">

        <div class="form-group">
         <label for="technologist_name" class="col-sm-12 control-label">Technologist Name</label>
         <div class="col-sm-12">
           <input class="form-control"  name="technologist_name" id="technologist_name"  placeholder="" type="text">
         </div>
       </div>

       <div class="form-group">
         <label for="technologist_designation" class="col-sm-12 control-label">Technologist Designation</label>
         <div class="col-sm-12">
           <input class="form-control"  name="technologist_designation" id="technologist_designation" placeholder="" type="file">
         </div>
       </div>

       <div class="form-group">
         <label for="technologist_address" class="col-sm-12 control-label">Technologist Address</label>
         <div class="col-sm-12">
           <input class="form-control"  name="technologist_address" id="technologist_address"  placeholder="" type="text">
         </div>
       </div>

       <div class="form-group">
         <label for="technologist_address" class="col-sm-12 control-label">Additional 1</label>
         <div class="col-sm-12">
           <input class="form-control"  name="technologist_add_1" id="technologist_address"  placeholder="" type="text">
         </div>
       </div>

       <div class="form-group">
         <label for="technologist_address" class="col-sm-12 control-label">Additional 2</label>
         <div class="col-sm-12">
           <input class="form-control"  name="technologist_add_2" id="technologist_address"  placeholder="" type="text">
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