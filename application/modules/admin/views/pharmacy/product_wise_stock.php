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
        <!-- <form method="POST" action="admin/stock_details_pdf"> -->
        <div align="right" class="mt-3 mr-3">
          <button onclick="stock_report_pdf()" class="btn btn-lg  btn-default"><i class="icon icon-cloud-download"></i> Pdf</button>
        </div>  
                    
        <div class="section-wrapper">
            <div class="card  no-b">
            <div class="card-body">
         			<div class="row">
						
							<div class="col-md-9 offset-md-1">
								<div class="row">
									<div class="offset-md-1 col-md-3" id="supplier_div">
										<label for="p_id">Product Name:</label>
										<select id="p_id" name="p_id" class="chosen-select form-control select2"  data-placeholder="Select a Product">
											<option value="0">All Product</option>
											<?php foreach ($product_list as $row) { ?>
												<option value="<?=$row['id'];?>"><?=$row['p_name'];?></option>
											<?php } ?>

										</select>	
									</div>	


									
					<!-- </form>				 -->
									<div class="col-md-2">
										<label for="product_category" style="visibility: hidden;">Btn</label>
										<a href="javascript:void(0)" onclick="get_stock_chart()" class="btn btn-white btn-primary btn-bold">
												<i class="ace-icon fa fa-search"></i>
												Get Stock Report
										</a>
									</div>
								</div>
								<div class="space-6"></div>
								
								<div class="row" id="validation_err_div" style="display: none">
									<div class="alert alert-block alert-danger">
										<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><i class="ace-icon fa fa-exclamation-triangle red"></i>
										<strong id="validation_err_msg">&nbsp;</strong>
									</div>
								</div>

								<div class="row" id="stock_chart_div">
									
								</div>

							</div>

						
						</div><!-- /.row -->
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

<script type="text/javascript">
	function get_stock_chart() 
		{
			
		
			
			var p_id=$("#p_id").val();
			

				$.ajax({
					      type: 'POST',
					      cache: false,
					      url: "<?=base_url();?>admin/get_product_stock",
					      data: {p_id:p_id },
					      success: function(msg) 
					      { 

					      	//console.log(msg);
					      	$("#stock_chart_div").html(msg);
					  	  }
						});
			

		}

		function stock_report_pdf(argument) {

			

			var p_id=$("#p_id").val();
			

			window.open('<?=base_url();?>admin/product_wise_stock_details_pdf/'+p_id,'_blank','width=560,height=340,toolbar=0,menubar=0,location=0');
			
		}
</script>

</body>
</html>
						