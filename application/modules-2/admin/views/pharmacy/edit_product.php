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
          <form method="post" enctype="multipart/form-data">
            <div class="row"> 
              <div class="col-md-4 offset-md-4 form-group">
                <label for="form-field-9">Product Image</label>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class="fileinput-new thumbnail" style="width: 120px; height: 80px;background: white">
                    <img src="uploads/product_image/<?=$all_product_info[0]['p_img']?>" alt="...">
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 120px; max-height: 80px;"></div>
                  <div>
                    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                    <input type="file" name="p_img"></span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                  </div>
                  <span class="text-warning"><i class="ace-icon fa fa-exclamation-triangle bigger-120"></i> Please choose 100x 100px image</span>
                </div>
              </div>

            </div><!-- /.row -->

            <div class="row"> 
              <div class="col-md-6 form-group">
                <label for="p_name">Product Name:</label>
                <input id="p_name"  value="<?=$all_product_info[0]['p_name']?>" type="text" name="p_name" class="form-control ui-autocomplete-input" autocomplete="off">  
              </div>

              <div class="col-md-6 form-group" id="product_unit_div">
                <label for="p_unit">Product Unit:</label>
                <select class="custom-select select2 form-control" name="p_unit" id="p_unit" required>
                 <option>Select Product Unit</option>
                 <?php 
                 foreach ($all_unit as $key => $unit){ 
                  if($unit['id']==$all_product_info[0]['p_unit_id']){
                   ?>
                   <option selected value="<?=$unit['id']?>"><?=$unit['unit']?></option>


                 <?php } else {?>
                  <option  value="<?=$unit['id']?>"><?=$unit['unit']?></option>
                <?php } } ?>
              </select>
            </div>  
          </div><!-- /.row -->


          <div class="space-6"></div>

          <div class="row"> 
            <div class="col-md-6 form-group" >
              <label for="p_generic_name">Generic Name</label>
              <select class="custom-select select2 form-control" name="p_generic_name" id="p_generic_name" >
               <option>Select Generic Name</option>
               <?php 
               foreach ($all_generic_name as $key => $generic){if($generic['id']==$all_product_info[0]['p_generic_id']){
                 ?>
                 <option selected value="<?=$generic['id']?>"><?=$generic['generic_name']?></option>


               <?php } else{?>
                <option  value="<?=$generic['id']?>"><?=$generic['generic_name']?></option>
              <?php } } ?>
            </select>
          </div> 

          <div class="col-md-6 form-group">
            <label for="vat">Vat %</label>
            <input type="number" value="<?=$all_product_info[0]['vat']?>"  required name="vat" class="form-control" id="vat"/>
          </div>

          <div class="col-md-6 form-group">
            <label for="tax">Tax %</label>
            <input type="text" value="<?=$all_product_info[0]['tax']?>" required name="tax" class="form-control" id="tax"/>
          </div> 


          <div class="col-md-6 form-group">
            <label for="p_alert_qty">Alert Quantity:</label>
            <input value="<?=$all_product_info[0]['p_reorder_qty']?>" type="number" name="p_alert_qty" class="form-control" id="p_alert_qty"/>
          </div>




        </div>

        <div class="space-6"></div>

        <div class="row"> 
          <div class="col-md-6 form-group">
            <label for="p_buy_price">Buy Price:</label>
            <input  value="<?=$all_product_info[0]['p_buy_price']?>" name="p_buy_price" class="form-control" required type="text" id="p_buy_price"/>
          </div>
          <div class="col-md-6 form-group">
            <label for="p_sell_price">Sell Price:</label>
            <input  value="<?=$all_product_info[0]['p_sell_price']?>" name="p_sell_price" class="form-control" required type="text"  id="p_sell_price"/>
          </div>
        </div><!-- /.row -->


        <div class="row"> 
          <div class="col-md-6 form-group">
            <label for="p_category">Product Category</label>
            <select class="custom-select select2 form-control" name="p_category" id="p_category" required>
             <option>Select Product Category</option>
             <?php 
             foreach ($all_product_category as $key => $category){
               if($category['id']==$all_product_info[0]['p_cat_id']){
                 ?>
                 <option selected value="<?=$category['id']?>"><?=$category['p_category_name']?></option>


               <?php } else{?>
                <option  value="<?=$category['id']?>"><?=$category['p_category_name']?></option>
              <?php } } ?>

            </select>
          </div>

             <!--  <div class="col-md-6 form-group">
                    <label for="p_opening_qty">Opening Quantity:</label>
                    <input name="p_opening_qty" class="form-control"  type="number" min="0" step="1" id="p_opening_qty"/>
                  </div> -->

                  <div class="col-md-6 form-group">
                    <label for="p_category">Company</label>
                    <select class="custom-select select2 form-control" name="company_name" id="company_name" required>
                     <option>Select Company Name</option>
                     <?php 
                     foreach ($all_company_name as $key => $company){
                       if($company['id']==$all_product_info[0]['p_company_id']){
                         ?>
                         <option selected value="<?=$company['id']?>"><?=$company['comp_name']?></option>


                       <?php } else{ ?>
                        <option  value="<?=$company['id']?>"><?=$company['comp_name']?></option>
                      <?php } } ?>
                    </select>
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="rack_id">Rack Title</label>
                    <select class="custom-select select2 form-control" name="rack_id" id="rack_id" required>
                     <option>Select Rack</option>
                     <?php 
                     foreach ($rack_all_info as $key => $rack){
                      if($rack['id']==$all_product_info[0]['rack_id']){
                       ?>
                       <option selected value="<?=$rack['id']?>"><?=$rack['rack_title']?></option>
                     <?php } else{?>
                      <option  value="<?=$rack['id']?>"><?=$rack['rack_title']?></option>
                    <?php } } ?>


                  </select>
                  
                </div>



                 <!--  <div class="col-md-6 form-group">
                    <label for="product_sell_price">Product Sub category:</label>
                     <select class="custom-select select2 form-control" name="country" id="country" required>
                       <option>Select Country</option>
                      <option value="">  </option>
                    </select> 
                  </div> -->


                </div><!-- /.row -->

                <div class="space-6"></div>





                <!-- oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" -->

                <div class="space-6"></div>
                
                <!-- <div class="row">  
                  <div class="checkbox">
                    <label>
                      <input id="category_check" name="category_check" class="ace ace-checkbox-2" type="checkbox">
                      <span class="lbl"> Category Include</span>
                    </label>
                  </div>
                </div> -->

                <div class="space-6"></div>


                <div class="row">
                  <div class="col-md-12" id="validation_msg">

                  </div>
                </div>

                <div class="row" align="right"> 
                  <div class="col-md-12 form-group">
                    <button type="submit" class="btn btn-white btn-primary btn-bold">
                      <i class="ace-icon fa fa-floppy-o align-top bigger-125"></i>
                      Update Product
                    </button>
                  </div>
                </div><!-- /.row -->

              </form>  
            </div>
          </div>
        </div>
      </div> 
      <div class="control-sidebar-bg shadow white fixed"></div>
    </div>
    <?php $this->load->view('back/footer_link');?>
  </body>
  </html>