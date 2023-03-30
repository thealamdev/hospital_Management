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
						<form method="post" action="admin/staff_designation_add_post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="row">
											<label for="designation" class="col-sm-3 control-label text-right">Designation(*)</label>
											<div class="col-sm-8">
												<input class="form-control" name="designation" id="designation" placeholder="Designation"
													type="text">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<label for="details" class="col-sm-3 control-label text-right">Details</label>
											<div class="col-sm-8">
												<textarea class="form-control" name="details" id="details" placeholder="Details"
													type="text"></textarea>
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
