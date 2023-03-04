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
			<form class="form-inline" method="GET" action="admin/all_staff_payment_list">

				<div class="section-wrapper" style="width:100%">
					<div class="form-group">
						<label for="user_name" class="col-sm-2 control-label">Month</label>
						<div class="col-sm-4">
							<select class="custom-select select2" name="months1">
								<option value="0">--Select--</option>
								<option value="1">January</option>
								<option value="2">February</option>
								<option value="3">March</option>
								<option value="4">April</option>
								<option value="5">May</option>
								<option value="6">June</option>
								<option value="7">July</option>
								<option value="8">August</option>
								<option value="9">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>

							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="user_name" class="col-sm-2 control-label">Year</label>
						<div class="col-sm-4">
							<select class="custom-select select2" name="year1">
								<option value="0">--Select--</option>
								<option value="2019">2019</option>
								<option value="2020">2020</option>
								<option value="2021">2021</option>
								<option value="2022">2022</option>
								<option value="2023">2023</option>
								<option value="2024">2024</option>
								<option value="2025">2025</option>
								<option value="2026">2026</option>
								<option value="2027">2027</option>
								<option value="2028">2028</option>
								<option value="2029">2029</option>
								<option value="2030">2030</option>

							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Payment Date(*)</label>
						<div class="col-sm-4">
							<div class="form-group">
								<div class="input-group">
									<input type="text" placeholder="Start Date" name="payment_date1" id="date_of_birth"
										class="col-sm-8 date-time-picker form-control date_of_birth"
										data-options='{"timepicker":false, "format":"Y-m-d"}' value="" autocomplete="off" required="" />
									<span class="input-group-append">
										<span class="input-group-text add-on white">
											<i class="icon-calendar"></i>
										</span>
									</span>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="user_name" class="col-sm-2 control-label">Staff Name</label>
						<div class="col-sm-4">
							<select class="custom-select select2" name="designation_id1">
								<option value="">--Select--</option>
								<?php
                  foreach ($staff_payment_list_show as $key => $value)
                  {?>


								<option value="<?=$value['staff_id']?>"><?=$value['staff_name']?></option>;

								<?php }

                  ?>
							</select>
						</div>
					</div>

					<div class="col-md-12 text-center">
						<button type="submit" class="btn btn-success mb-2">Search</button>
					</div>
			</form>

			<form class="form-inline" method="POST" action="admin/payment_complete">
				<input type="hidden" value="<?php if(!empty($_GET['payment_date1'])){echo $_GET['payment_date1'];}?>"
					placeholder="Start Date" name="payment_date" id="payment_date" />
				<input type="hidden" value="<?php if(!empty($_GET['months1'])){echo $_GET['months1'];}?>"
					placeholder="Start Date" name="months" id="months" />
				<input type="hidden" value="<?php if(!empty($_GET['year1'])){echo $_GET['year1'];}?>" placeholder="Start Date"
					name="year" id="year" />

				<div class="card my-3 no-b">
					<div class="card-body">

						<table id="test_table" class="table table-bordered table-hover"
							data-options='{ "paging": false; "searching":false}'>
							<thead>
								<tr>
									<th>SL NO</th>
									<th>Staff Name</th>
									<th>Designation</th>
									<th>Salary Month</th>
									<th>Total Salary</th>
									<th>Total Working Days</th>
									<th>Total Absent Days</th>
									<th>Payment Type</th>
									<th>Payment Date</th>
									<th>Paid By</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>

								<?php $i=1;
								// echo'<pre>';
								// print_r($staff_payment_list);
										foreach ($staff_payment_list as $key => $value) {
											$staff_id=$value['staff_id'];?>
											<td class="text-center"><?=$i?></td>
											<td class="text-center"><?=$value['first_name'].' '.$value['last_name']?></td>
              								<td class="text-center"><?php echo $this->admin_model->anyName_Designation('id',$value['designation_id'],'name');?></td>
              								<td class="text-center"><?= date('F Y',strtotime($value['month_year']));?></td>
											<td class="text-center"><?=$value['total_salary']?></td>
											<td class="text-center"><?=$value['t_working_days']?></td>
											<td class="text-center"><?=$value['t_absent']?></td>
											<td class="text-center"><?=$value['payment_type']?></td>
											<td class="text-center"><?=$value['payment_date']?></td>
											<td class="text-center"><a class="btn-sm btn-danger" href="admin/staff_dlt/<?php echo $staff_id?>">Delete</a></td>
								</tr>
								<?php $i++; }
            ?>
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-md-12">
					<button type="submit" class="btn btn-success mb-2">Pay</button>
				</div>
		</div>

		</form>
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
