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
						<form method="post" action="admin/staff_add_post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<div class="row">
											<label for="group_id" class="col-sm-4 control-label text-right">Groups(*)</label>
											<div class="col-sm-8">
												<select class="custom-select select2" name="group_id" id="group_id">
													<option value="">--Select--</option>
													<?php
													foreach ($group_list as $key => $value)
														{?>


															<option value="<?=$value['id']?>"><?=$value['group_name']?></option>;

														<?php }

														?>
													</select>
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="row">
												<label for="first_name" class="col-sm-4 control-label text-right">First Name(*)</label>
												<div class="col-sm-8">
													<input class="form-control" name="first_name" id="first_name" placeholder="First Name"
													type="text">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<label for="designation_id" class="col-sm-4 control-label text-right">Designation(*)</label>
												<div class="col-sm-8">
													<select class="custom-select select2" name="designation_id" for="designation_id">
														<option value="">--Select--</option>
														<?php
														foreach ($designation_list as $key => $value)
															{?>


																<option value="<?=$value['id']?>"><?=$value['name']?></option>;

															<?php }

															?>
														</select>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<label for="rate_type" class="col-sm-4 control-label text-right">Rate Type</label>
													<div class="col-sm-8">
														<select class="custom-select select2" id="rate_type" name="rate_type">
															<option value="">--Select--</option>
															<option value="Standard">Standard</option>
															<option value="High">High</option>
														</select>
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
													<label for="email" class="col-sm-4 control-label text-right">Email</label>
													<div class="col-sm-8">
														<input class="form-control" name="email" id="email" placeholder="Email" type="email">
													</div>
												</div>
											</div>


											<div class="form-group">
												<div class="row">
													<label for="permanent" class="col-sm-4 control-label text-right">Address Line1</label>
													<div class="col-sm-8">
														<textarea class="form-control" row="8" name="permanent" id="permanent"
														placeholder="Permanent Address" type="text"></textarea>
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
													<label for="present" class="col-sm-4 control-label text-right">Address Line2</label>
													<div class="col-sm-8">
														<textarea class="form-control" name="present" id="present" placeholder="Present Address"
														type="text"></textarea>
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
													<label for="nid_no" class="col-sm-4 control-label text-right">From Duty Time:</label>
													<div class="col-sm-8">
														<div class="input-group focused"data-target-input="nearest">
															<input required  id="from_duty_time" type="text" name="from_duty_time" class="form-control datetimepicker-input duty_time" data-target="#from_duty_time"/>
															<div class="input-group-append" data-target="#from_duty_time" data-toggle="datetimepicker">
																<div class="input-group-text"><i class="fa fa-clock-o"></i></div>
															</div>
														</div>

													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
													<label for="nid_no" class="col-sm-4 control-label text-right">To Duty Time:</label>
													<div class="col-sm-8">
														<div class="input-group focused"data-target-input="nearest">
															<input required  id="to_duty_time" type="text" name="to_duty_time" class="form-control datetimepicker-input duty_time" data-target="#to_duty_time"/>
															<div class="input-group-append" data-target="#to_duty_time" data-toggle="datetimepicker">
																<div class="input-group-text"><i class="fa fa-clock-o"></i></div>
															</div>
														</div>

													</div>
												</div>
											</div>
										</div>


										<div class="col-md-5">
											<div class="form-group">
												<div class="row">
													<label for="last_name" class="col-sm-4 control-label text-right">Last Name(*)</label>
													<div class="col-sm-8">
														<input class="form-control" name="last_name" id="last_name" placeholder="Last Name" type="text">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<label for="father_name" class="col-sm-4 control-label text-right">Father Name</label>
													<div class="col-sm-8">
														<input class="form-control" name="father_name" id="father_name" placeholder="Father Name"
														type="text">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<label for="mother_name" class="col-sm-4 control-label text-right">Mother Name</label>
													<div class="col-sm-8">
														<input class="form-control" name="mother_name" id="mother_name" placeholder="Mother Name"
														type="text">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<label for="mobile_no" class="col-sm-4 control-label text-right">Phone(*)</label>
													<div class="col-sm-8">
														<input class="form-control" name="mobile_no" id="mobile_no" placeholder="Phone" type="text">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<label for="total_salary" class="col-sm-4 control-label text-right">Monthly / Salary</label>
													<div class="col-sm-8">
														<input class="form-control" name="total_salary" id="total_salary"
														placeholder="Hourly Rate / Salary" type="text">
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
													<label for="blood_group" class="col-sm-4 control-label text-right">Blood Group</label>
													<div class="col-sm-8">
														<input class="form-control" name="blood_group" id="blood_group" placeholder="Blood Group"
														type="text">
													</div>
												</div>
											</div>


											<div class="form-group">
												<div class="row">
													<label for="nid_no" class="col-sm-4 control-label text-right">NID No</label>
													<div class="col-sm-8">
														<input class="form-control" name="nid_no" id="nid_no" placeholder="NID No" type="text">
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
													<label for="joining_date" class="col-sm-4 control-label text-right">Joining Date:</label>
													<div class="col-sm-8">
														<input placeholder="dd/mm/yy" autocomplete="off" type="text"  name="joining_date" id="joining_date" class="col-sm-8 date-time-picker form-control joining_date"
														data-options='{"timepicker":false,"format":"Y-m-d"}' value="" tabindex="6"/>
													</div>
												</div>
											</div>



										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="hospital_logo" class="col-sm-12 control-label">Photo</label>
												<div class="fileinput fileinput-new" data-provides="fileinput">
													<div class=" border border-secondary fileinput-new thumbnail"
													style="width: 115px; height: 100px; margin-left: 15px;">
													<img style="width: 100%;height: 100%" src="" alt="...">
												</div>
												<div class="border border-secondary fileinput-preview fileinput-exists thumbnail"
												style="max-width: 200px; max-height: 150px;"></div>
												<div>
													<span class="border border-secondary btn btn-default btn-file" style="margin-left: 15px;"><span
														class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input
														type="file" id="hospital_logo" name="staff_img"></span>
														<a href="#" class="border border-secondary btn btn-default fileinput-exists"
														data-dismiss="fileinput">Remove</a>
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

	<script src="back_assets/js/moment.min.js"></script>
	<script src="back_assets/js/tempusdominus-bootstrap-4.min.js"></script>


	<link rel="stylesheet" href="back_assets/css/tempusdominus-bootstrap-4.min.css">


	<script type="text/javascript">

		$(document).ready(function()
		{ 
			$(function () {

				$('#from_duty_time').datetimepicker({
					format: 'LT'
				});
			});


			$(function () {

				$('#to_duty_time').datetimepicker({
					format: 'LT'
				});
			});

		});
	</script>

</body>

</html>
