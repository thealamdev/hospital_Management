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
				<div class="card my-3 no-b">
					<form method="post" action="admin/all_staff_payment_list_by_search" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<div class="row">
										<label for="staff_id" class="col-sm-4 control-label text-right">Salary Month(*)</label>
										<div class="col-sm-8">
											<input type="text" placeholder="Date" name="generated_date" id="date_of_birth"
											class="date-time-picker form-control date_of_birth"
											data-options='{"timepicker":false, "format":"Y-m-d"}' value="" autocomplete="off" required="" />
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4"><button type="submit" class="btn btn-success mb-2">Search</button>
							</div>
						</div>
					</form>
					<form method="post" action="admin/payment_complete" enctype="multipart/form-data">
						<div class="card-body table-responsive">

							<table id="test_table" class="table table-bordered table-hover data-tables"
							data-options='{ "paging": false; "searching":false}'>
							<thead>
								<tr>
									<th><input id="checkall" type="checkbox" onclick="toggle(this);"
										style="width: 20px; height: 20px; background-color:green;"></th>
										<th>SL NO</th>
										<th>Staff Name</th>
										<th>Designation</th>
										<th>Salary Month</th>
										<th>Total Salary</th>
										<th>Total Working Days</th>
										<th>Total Absent Days</th>
										<th>Total Late Days</th>
										<th>Total Overtime Days</th>
										<th>Payment Type</th>
										<th>Status</th>
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
										$salary_gen_id =$value['salary_gen_id'];?>
										<td class="text-center text-nowrap">
											<input type="checkbox" onclick="toggleSingle(this);" name="salary_gen_id[]" id="salary_gen_id"
											class="selectedId" value="<?= $value['salary_gen_id']?>">
											<input type="hidden" name="pay_status[]" value="<?=$value['pay_status']?>" />
											<input type="hidden" name="total_payble_salary[]" value="<?=$value['total_payble_salary']?>" />
										</td>
										<td class="text-center text-nowrap"><?=$i?></td>
										<td class="text-center text-nowrap"><?=$value['first_name'].' '.$value['last_name']?></td>
										<td class="text-center text-nowrap">
											<?php echo $this->admin_model->anyName_Designation('id',$value['designation_id'],'name');?></td>
											<td class="text-center text-nowrap"><?= date('F Y',strtotime($value['month_year']));?></td>
											<td class="text-center text-nowrap"><?=number_format($value['total_payble_salary'], 2, '.', '')?></td>
											<td class="text-center text-nowrap"><?=$value['t_working_days']?> days</td>
											<td class="text-center text-nowrap"><?=$value['t_absent']?> days</td>
											<td class="text-center text-nowrap"><?=$value['t_late']?> days</td>
											<td class="text-center text-nowrap"><?=$value['t_overtime']?> days</td>
											<td class="text-center text-nowrap"><?=$value['payment_type']?></td>
											<td class="text-center text-nowrap"><?=$value['pay_status'] == 2 ? "<span style='background:green;color:white;font-weight:bold;'> Paid </span>" : "<span style='background:red;color:white;font-weight:bold;'> UnPaid </span>" ?></td>
											
											<td class="text-center text-nowrap"><?=$value['payment_date']?></td>

											<td class="text-center text-nowrap"><?=$value['operator_name']?></td>
											<td class="text-center text-nowrap">
												<?php if($value['pay_status'] == '1'){?>
													<a class="btn-sm btn-info" href="admin/staff_salary_generate_pay/<?php echo $salary_gen_id ?>">Pay
													Now?</a>
												<?php }else{?>
													<a class="btn-sm btn-primary"
													href="admin/staff_salary_generate_payslip/<?php echo $salary_gen_id ?>">Pay Slip</a>
												<?php }?>
											</td>
										</tr>
										<?php $i++; }
										?>
									</tbody>

								</table>
								<div class="col-md-12 text-center" id="pay_button">
									<button type="submit" class="btn btn-success mb-2">Pay</button>
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

	<script>
		function toggle(source) {
			var checkboxes = document.querySelectorAll('input[type="checkbox"]');
			for (var i = 0; i < checkboxes.length; i++) {
				if (checkboxes[i] != source)
					checkboxes[i].checked = source.checked;
			}

			if (checkboxes.length > 0) {
				$('#pay_button').show();
			} else {
				$('#pay_button').hide();
			}
		}

		// function toggleSingle(source) {
		// 	var checkboxes = $('.selectedId').is(":checked");

		// 	if (checkboxes.length > 0) {
		// 		$('#pay_button').show();
		// 	} else {
		// 		$('#pay_button').hide();
		// 	}
		// }

	</script>

</body>

</html>
