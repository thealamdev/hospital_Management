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
      <div class="container">
        <div class="mt-sm-3 shadow-lg p-3 mb-5 rounded">  
          <form method="post" action="admin/update_technologist/<?=$technologist_list[0]['id']?>">

            <div class="row">
              <div class="col-md-4">
               <div class="form-group">
                <label for="checked_by" class="col-sm-12 control-label">Select Specimen</label>
                <div class="col-sm-12">
                  <select id="" name="" class=" custom-select select2"  required>
                    <option value="">--Select--</option>
                    <?php foreach ($specimen_list as $key => $specimen) { ?>
                        
                        <option value="<?=$specimen['id']?>"><?=$specimen['specimen']?></option>

                    <?php } ?>

                  </select>

                </div>

              </div>
            </div>

          </div>

          <div class="row">
            <!-- first column -->
            <div class="col-md-4">

             <div class="form-group">
               <label for="checked_by" class="col-sm-12 control-label">Checked By</label>
               <div class="col-sm-12">
                 <input class="form-control" value="<?=$technologist_list[0]['checked_by_name']?>" name="checked_by" id="checked_by"  placeholder="Checked By" type="text">
               </div>
             </div>

             <div class="form-group">
               <label for="checked_by_designation" class="col-sm-12 control-label">Checked By (Designation)</label>
               <div class="col-sm-12">
                 <input class="form-control" value="<?=$technologist_list[0]['checked_by_designation']?>" name="checked_by_designation" id="checked_by_designation" placeholder="Designation" type="text">
               </div>
             </div>

             <div class="form-group">
               <label for="checked_by_address" class="col-sm-12 control-label">Checked By (Address)</label>
               <div class="col-sm-12">
                 <input class="form-control" value="<?=$technologist_list[0]['checked_by_address']?>"name="checked_by_address" id="checked_by_address"  placeholder="Address" type="text">
               </div>
             </div>

             <div class="form-group">
               <label for="checked_by_address" class="col-sm-12 control-label">Additional 1</label>
               <div class="col-sm-12">
                 <input class="form-control" value="<?=$technologist_list[0]['checked_add_1']?>"name="checked_add_1" id="checked_by_address"  placeholder="" type="text">
               </div>
             </div>

             <div class="form-group">
               <label for="checked_by_address" class="col-sm-12 control-label">Additional 2</label>
               <div class="col-sm-12">
                 <input class="form-control" value="<?=$technologist_list[0]['checked_add_2']?>"name="checked_add_2" id="checked_by_address"  placeholder="" type="text">
               </div>
             </div>

           </div>

           <div class="col-md-4">

            <div class="form-group">
             <label for="prepared_by" class="col-sm-12 control-label">Prepared By</label>
             <div class="col-sm-12">
               <input class="form-control" value="<?=$technologist_list[0]['prepared_by_name']?>" name="prepared_by" id="prepared_by"  placeholder="Prepared By" type="text">
             </div>
           </div>

           <div class="form-group">
             <label for="prepared_by_designation" class="col-sm-12 control-label">Prepared By (Designation)</label>
             <div class="col-sm-12">
               <input class="form-control" value="<?=$technologist_list[0]['prepared_by_designation']?>" name="prepared_by_designation" id="prepared_by_designation"  placeholder="" type="text">
             </div>
           </div>

           <div class="form-group">
             <label for="prepared_by_address" class="col-sm-12 control-label">Prepared By (Address)</label>
             <div class="col-sm-12">
               <input class="form-control" value="<?=$technologist_list[0]['prepared_by_address']?>" name="prepared_by_address" id="prepared_by_address"  placeholder="" type="text">
             </div>
           </div>

           <div class="form-group">
             <label for="technologist_address" class="col-sm-12 control-label">Additional 1</label>
             <div class="col-sm-12">
               <input class="form-control" value="<?=$technologist_list[0]['prepared_add_1']?>" name="prepared_add_1" id="technologist_address"  placeholder="" type="text">
             </div>
           </div>

           <div class="form-group">
             <label for="technologist_address" class="col-sm-12 control-label">Additional 2</label>
             <div class="col-sm-12">
               <input class="form-control" value="<?=$technologist_list[0]['prepared_add_2']?>" name="prepared_add_2" id="technologist_address"  placeholder="" type="text">
             </div>
           </div>

         </div>

         <div class="col-md-4">

          <div class="form-group">
           <label for="technologist_name" class="col-sm-12 control-label">Technologist Name</label>
           <div class="col-sm-12">
             <input class="form-control" value="<?=$technologist_list[0]['technologist_name']?>" name="technologist_name" id="technologist_name"  placeholder="" type="text">
           </div>
         </div>

         <div class="form-group">
           <label for="technologist_designation" class="col-sm-12 control-label">Technologist Designation</label>
           <div class="col-sm-12">
             <input class="form-control" value="<?=$technologist_list[0]['technologist_designation']?>" name="technologist_designation" id="technologist_designation" placeholder="" type="text">
           </div>
         </div>

         <div class="form-group">
           <label for="technologist_address" class="col-sm-12 control-label">Technologist Address</label>
           <div class="col-sm-12">
             <input class="form-control" value="<?=$technologist_list[0]['technologist_address']?>" name="technologist_address" id="technologist_address"  placeholder="" type="text">
           </div>
         </div>

         <div class="form-group">
           <label for="technologist_address" class="col-sm-12 control-label">Additional 1</label>
           <div class="col-sm-12">
             <input class="form-control" value="<?=$technologist_list[0]['technologist_add_1']?>" name="technologist_add_1" id="technologist_address"  placeholder="" type="text">
           </div>
         </div>

         <div class="form-group">
           <label for="technologist_address" class="col-sm-12 control-label">Additional 2</label>
           <div class="col-sm-12">
             <input class="form-control" value="<?=$technologist_list[0]['technologist_add_2']?>" name="technologist_add_2" id="technologist_address"  placeholder="" type="text">
           </div>
         </div>



       </div>


       <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-5">
         <button type="submit" class="btn btn-success">Update</button>
       </div>
     </div>
   </form>
 </div>
</div>
</div>
</div> 
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>
<script src="back_assets/js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
<script src="back_assets/js/ckeditor.js"></script>
</body>
</html>