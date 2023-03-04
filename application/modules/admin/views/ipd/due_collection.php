<?php $this->load->view('back/header_link'); ?>
<body class="light">
<!-- Pre loader -->
<?php $this->load->view('back/loader'); ?>
 <script>
function sum() {
      var total_amnt = document.getElementById('total_amnt').value;
      var total_paid = document.getElementById('total_paid').value;
      var result = parseInt(Operation_cost) - parseInt(discount_operation);
      if (!isNaN(result)) {
         document.getElementById('total_operation').value = result;
      }
}
 </script>
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
      <div class="container">
      <div class="mt-sm-3 shadow-lg p-3 mb-5 rounded">
	          <form method="post" action="admin/ipd_old_due_collection">
          <div class="row">
		  
		  <input type="hidden" value="<?php echo $order_id;?>" name="order_id"/>
		    <input type="hidden" value="<?php echo $order_type;?>" name="order_type"/>
                  <input type="hidden" value="<?php echo $username;?>" name="user_id"/>
				   <input type="hidden" value="<?php echo $hospital_id?>" name="hospital_id"/>
				   <input type="hidden" value="<?php echo $patient_id?>" name="patient_id"/>
            <div class="col-md-4">
              <div class="form-group">
               <label for="user_name" class="col-sm-12 control-label">Patient ID</label>
               <div class="col-sm-10">
	<input class="form-control form-control-sm" type="text" name="patient_info_id" value="<?php echo $patient_info_id?>" placeholder="Patient ID" readonly required>		   
                
               </div>
            </div> 
			</div>
			            <div class="col-md-4">
              <div class="form-group">
               <label for="user_name" class="col-sm-12 control-label">Patient Name</label>
               <div class="col-sm-10">
	<input class="form-control form-control-sm" type="text" name="patient_name" value="<?php echo $patient_name?>" placeholder="Patient Name" required>		   
                
               </div>
            </div> 
			</div>
			<div class="col-md-4">
              <div class="form-group">
               <label for="user_name" class="col-sm-12 control-label">Total Amount</label>
               <div class="col-sm-10">
	<input class="form-control form-control-sm" type="text" id="total_amnt" name="total_amnt" placeholder="Total Amount" value="<?php echo $Operation_cost?>" readonly required>		   
                
               </div>
            </div> 
			</div>
			<div class="col-md-4">
              <div class="form-group">
               <label for="user_name" class="col-sm-12 control-label">Total Paid</label>
               <div class="col-sm-10">
	<input class="form-control form-control-sm" type="text" name="total_paid" id="total_paid"  placeholder="Total Paid" value="<?php echo $advance?>" readonly required>		   
                
               </div>
            </div> 
			</div>
			<div class="col-md-4">
              <div class="form-group">
               <label for="user_name" class="col-sm-12 control-label">Due</label>
               <div class="col-sm-10">
	<input class="form-control form-control-sm" type="text" name="due" id="due" value="<?php echo $due?>" placeholder="Total Due" readonly required>		   
                
               </div>
            </div> 
			</div>
			<div class="col-md-4">
              <div class="form-group">
               <label for="user_name" class="col-sm-12 control-label">Discount</label>
               <div class="col-sm-10">
	<input class="form-control form-control-sm" type="text" id="discount" name="discount" placeholder="Discount"  required>		   
                
               </div>
            </div> 
			</div>
			<div class="col-md-4">
              <div class="form-group">
               <label for="user_name" class="col-sm-12 control-label">Gross Paid</label>
               <div class="col-sm-10">
	<input class="form-control form-control-sm" type="text" name="gross_paid" placeholder="Gross Paid"  required>		   
                
               </div>
            </div> 
			</div>
						<div class="col-md-4">
              <div class="form-group">
               <label for="user_name" class="col-sm-12 control-label">Paid Amount</label>
               <div class="col-sm-10">
	<input class="form-control form-control-sm" type="text" name="gross_paid" placeholder="Gross Paid"  required>		   
                
               </div>
            </div> 
			</div>
						<div class="col-md-4">
              <div class="form-group">
               <label for="user_name" class="col-sm-12 control-label">Total Due</label>
               <div class="col-sm-10">
	<input class="form-control form-control-sm" type="text" name="gross_paid" placeholder="Gross Paid"  required>		   
                
               </div>
            </div> 
			</div>
			<div class="col-md-4">
              <div class="form-group">
               <label for="user_name" class="col-sm-12 control-label">Discount Ref</label>
               <div class="col-sm-10">
	<input class="form-control form-control-sm" type="text" name="discount_ref" placeholder="Discount Ref"  required>		   
                
               </div>
            </div> 
			</div>
			 <div class="text-right"> 
                   <input type="submit" value="submit" class="btn btn-primary m-2">
                </div>
        </div>
		 </form>


    
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