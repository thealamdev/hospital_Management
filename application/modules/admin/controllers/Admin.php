<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller
{


	function __construct()
	{
		// $this->session->set_userdata('logged_in');


		$this->load->model('admin_model');
		date_default_timezone_set('Asia/Dhaka');


		if (empty($this->session->userdata['logged_in'])) {

			redirect('login', 'refresh');
		}


		if ($this->session->userdata('msg') != "") {

			echo '<script language="javascript">';
			echo 'alert("' . $this->session->userdata('msg') . '")';
			echo '</script>';

			$this->session->set_userdata("warn_msg", $this->session->userdata('msg'));
			$this->session->unset_userdata('msg');
		}

		// if($this->session->userdata['logged_in']['role']==0)
		// {
		// 	redirect('login','refresh');
		// }


		if (!in_array(0, explode(',', $this->session->userdata['logged_in']['role']))) {

			if (!in_array(1, explode(',', $this->session->userdata['logged_in']['role']))) {

				$this->auth->route_access();
			}
		}
	}


	public	function decryptIt_expire($string)
	{
		$output = "";
		$output = openssl_decrypt(base64_decode($string), "AES-256-CBC",  hash('sha256', "encryptedexpiredaterecently"), 0, substr(hash('sha256', 'This is my secret iv'), 0, 16));

		// echo "<pre>";print_r($output);

		return $output;
	}


	// ***************** BACK Up DB start ***********

	public function backup_db($value = '')
	{

		exec('c:\WINDOWS\system32\cmd.exe /C START f:\Db_Backup.bat');

		redirect('admin');
	}

	// ***************** BACK Up DB End ***********


	//*************** DashBoard***************


	public function index()
	{
		$data['active'] = 'dashboard';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$data['id'] = $this->session->userdata['logged_in']['id'];

		$data['page_title'] = 'Dashboard';

		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['outdoor_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'due_type=1 AND date(created_at)="' . date('Y-m-d') . '" AND status=1');

		$data['outdoor_commission_expense'] = $this->admin_model->get_charge_sum_where('paid_com', 'commission_payment', 'date(created_at)="' . date('Y-m-d') . '" AND doc_type IN (1,2) AND status=1');
		$data['opd_test_order_info'] = $this->admin_model->select_with_where2('*', 'status=1 and date(created_at)="' . date('Y-m-d') . '"', 'opd_patient_test_order_info');

		$data['indoor_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'due_type=2 AND date(created_at)="' . date('Y-m-d') . '" and status=1');


		$data['indoor_total_paid'] = $this->admin_model->get_charge_sum_where('total_paid', 'ipd_final_bill', 'date(created_at)="' . date('Y-m-d') . '"');
		$data['indoor_adm_fee_income'] = $this->admin_model->get_charge_sum_where('admission_fee_paid', 'due_collection', 'due_type=2 AND date(created_at)="' . date('Y-m-d') . '" and status=1');

		$data['ipd_patient_info'] = $this->admin_model->select_with_where2('*', 'status=1 and date(created_at)="' . date('Y-m-d') . '"', 'ipd_patient_info');

		$data['indoor_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'due_type=2 AND date(created_at)="' . date('Y-m-d') . '" and status=1');

		$data['operation_expense'] = $this->admin_model->get_charge_sum_where('paid_cost', 'service_payment_details', 'date(created_at)="' . date('Y-m-d') . '"');



		$data['pharmacy_total_paid'] = $this->admin_model->get_charge_sum_where('debit', 'sell', 'date(created_at)="' . date('Y-m-d') . '"');

		$data['pharmacy_supplier_expense'] = $this->admin_model->get_charge_sum_where('paid_due', 'pharmacy_due_collection', 'date(created_at)="' . date('Y-m-d') . '" AND due_type=1 AND status=1');

		$data['pharmacy_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'pharmacy_due_collection', 'date(created_at)="' . date('Y-m-d') . '" AND due_type=2 AND status=1 and is_due_collection=0');

		$data['total_sales_return_paid'] = $this->admin_model->get_charge_sum_where('total_paid', 'return_product', 'date(created_at)="' . date('Y-m-d') . '" and type=2');

		$data['total_purchase_return_paid'] = $this->admin_model->get_charge_sum_where('total_paid', 'return_product', 'date(created_at)="' . date('Y-m-d') . '" and type=1');

		$data['appointment_info'] = $this->admin_model->select_join_four_table2_limit_order('*,l.address,a.id,date(appointment_date) as appointment_date,TIME_FORMAT(a.start_time,"%h:%i %p") as start_time,TIME_FORMAT(a.end_time,"%h:%i %p") as end_time', 'doctor_schedule ds', 'doc_appointment a', 'local_patient_info l', 'doctor d', 'ds.id=a.schedule_id', 'a.appointed_p_id=l.id', 'a.doc_id=d.doctor_id', 'schedule_status=1 AND appointment_status=1', 'a.created_at');

		$data['opd_patient_info'] = $this->admin_model->select_with_where2_limit_order('*', 'status=1', 'opd_patient_info', 'id');

		$this->load->view('index', $data);
	}

	//*************** DashBoard End ***************


	//*************** Manage ***************

	public function marketing_officer_list($value = '')
	{

		$data['active'] = 'marketing_officer_list';
		$data['page_title'] = 'Add Marketing Officer';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['marketing_officer_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'marketing_officer');

		$this->load->view('manage/marketing_officer_list', $data);
	}


	public function add_marketing_officer($value = '')
	{

		$data['active'] = 'add_marketing_officer';
		$data['page_title'] = 'Add Marketing Officer';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$this->load->view('manage/add_marketing_officer', $data);
	}


	public function add_marketing_officer_post($value = '')
	{
		$val = array(
			'name' => $this->input->post('officer_name'),
			'designation' => $this->input->post('designation'),
			'description' => $this->input->post('description'),
			'address' => $this->input->post('address'),
			'contact_no' => $this->input->post('contact_no'),
			'image' => 'default.jpg',
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],

			'created_at' => date('Y-m-d H:i:s')
		);

		$id = $this->admin_model->insert_ret('marketing_officer', $val);


		if ($_FILES['officer_image']['name']) {
			$name_generator = $this->name_generator($_FILES['officer_image']['name'], $id);
			$i_ext = explode('.', $_FILES['officer_image']['name']);
			$target_path = $name_generator . '.' . end($i_ext);
			$size = getimagesize($_FILES['officer_image']['tmp_name']);

			if (move_uploaded_file($_FILES['officer_image']['tmp_name'], 'uploads/officer_image/' . $target_path)) {
				$officer_image = $target_path;
			}

			$data_img['image'] = $officer_image;

			$this->admin_model->update_function('id', $id, 'marketing_officer', $data_img);
		}

		redirect("admin/marketing_officer_list", 'refresh');
	}

	public function delete_marketing_officer($id = '')
	{
		$val = array(

			'status' => 2
		);

		$this->admin_model->update_function('id', $id, 'marketing_officer', $val);

		redirect("admin/marketing_officer_list", 'refresh');
	}

	public function edit_marketing_officer($id = '')
	{
		$data['active'] = 'edit_marketing_officer';
		$data['page_title'] = 'Edit Marketing Officer';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['marketing_officer_list'] = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $id . '"', 'marketing_officer');

		$this->load->view('manage/edit_marketing_officer', $data);
	}


	public function edit_marketing_officer_post($id = '')
	{
		$val = array(
			'name' => $this->input->post('officer_name'),
			'designation' => $this->input->post('designation'),
			'description' => $this->input->post('description'),
			'address' => $this->input->post('address'),
			'contact_no' => $this->input->post('contact_no'),
			'image' => 'default.jpg',
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],

			'created_at' => date('Y-m-d H:i:s')
		);

		$this->admin_model->update_function('id', $id, 'marketing_officer', $val);

		if ($_FILES['officer_image']['name']) {
			$name_generator = $this->name_generator($_FILES['officer_image']['name'], $id);
			$i_ext = explode('.', $_FILES['officer_image']['name']);
			$target_path = $name_generator . '.' . end($i_ext);;
			$size = getimagesize($_FILES['officer_image']['tmp_name']);

			if (move_uploaded_file($_FILES['officer_image']['tmp_name'], 'uploads/officer_image/' . $target_path)) {
				$officer_image = $target_path;
			}

			$val['image'] = $officer_image;

			$this->admin_model->update_function('id', $id, 'marketing_officer', $val);
		}

		redirect("admin/marketing_officer_list", 'refresh');
	}


	public function test_group()
	{
		$data['active'] = 'test_group';
		$data['page_title'] = 'Test List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['test'] = $this->admin_model->select_with_where('*', 1, 'diagnostic_test_group', 'status');

		$data['sub_test'] = $this->admin_model->select_join_where_left('*,ds.id', 'diagnostic_test_subgroup ds', 'sh_tbl_lab_product lp', 'ds.reagent_p_id=lp.id', 'ds.status=1');

		$data['specimen'] = $this->admin_model->select_with_where2('*', 'status=1', 'add_specimen');

		$data['hospital'] = $this->admin_model->select_with_where2('*', 'status=1 and hospital_id="' . $this->session->userdata['logged_in']['hospital_id'] . '"', 'hospital');


		$data['regent_product_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'sh_tbl_lab_product');

		//echo "<pre>";print_r($data['sub_test']);die();
		$this->load->view('test_group/test_group', $data);
	}


	public function add_specimen($value = '')
	{
		$data['active'] = 'add_specimen';
		$data['page_title'] = 'Add Specimen';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$this->form_validation->set_error_delimiters('<div>', '</div>');
		//Validating Name Field
		$this->form_validation->set_rules('specimen', 'Specimen', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('test_group/add_specimen', $data);
		} else {


			$val = array(
				'specimen' => $this->input->post('specimen'),

				'created_at' => date('Y-m-d H:i:s')
			);

			$specimen_id = $this->admin_model->insert_ret('add_specimen', $val);

			$technologist_data = array(
				'specimen_id' => $specimen_id,
				'checked_by_name' => $this->input->post('checked_by'),
				'checked_by_designation' => $this->input->post('checked_by_designation'),
				'checked_by_address' => $this->input->post('checked_by_address'),
				'checked_add_1' => $this->input->post('checked_add_1'),
				'checked_add_2' => $this->input->post('checked_add_2'),

				'prepared_by_name' => $this->input->post('prepared_by'),
				'prepared_by_designation' => $this->input->post('prepared_by_designation'),
				'prepared_by_address' => $this->input->post('prepared_by_address'),
				'prepared_add_1' => $this->input->post('prepared_add_1'),
				'prepared_add_2' => $this->input->post('prepared_add_2'),

				'technologist_name' => $this->input->post('technologist_name'),
				'technologist_designation' => $this->input->post('technologist_designation'),
				'technologist_address' => $this->input->post('technologist_address'),
				'technologist_add_1' => $this->input->post('technologist_add_1'),
				'technologist_add_2' => $this->input->post('technologist_add_2'),
				'created_at' => date('Y-m-d H:i:s')

			);

			$this->admin_model->insert('add_technologist', $technologist_data);


			redirect("admin/specimen_list", 'refresh');
		}
	}

	public function specimen_list($value = '')
	{
		$data['active'] = 'specimen_list';
		$data['page_title'] = 'Specimen List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['specimen_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'add_specimen');

		$this->load->view('test_group/specimen_list', $data);
	}

	public function delete_specimen($id = '')
	{
		$val = array('status' => 2);

		$this->admin_model->update_function2('id="' . $id . '"', 'add_specimen', $val);

		redirect("admin/specimen_list", 'refresh');
	}



	public function edit_specimen($id = '')
	{
		$data['active'] = 'specimen_list';
		$data['page_title'] = 'Specimen List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['specimen_list'] = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $id . '"', 'add_specimen');

		$data['technologist_list'] = $this->admin_model->select_with_where2('*', 'specimen_id="' . $id . '"', 'add_technologist');

		$data['specimen_id'] = $id;

		$this->load->view('test_group/edit_specimen', $data);
	}


	public function edit_specimen_post($id = '')
	{
		$val = array('specimen' => $this->input->post('specimen'));

		$this->admin_model->update_function2('id="' . $id . '"', 'add_specimen', $val);

		if ($this->admin_model->check_row('*', 'specimen_id="' . $id . '"', 'add_technologist')) {
			$technologist_data = array(

				'checked_by_name' => $this->input->post('checked_by'),
				'checked_by_designation' => $this->input->post('checked_by_designation'),
				'checked_by_address' => $this->input->post('checked_by_address'),
				'checked_add_1' => $this->input->post('checked_add_1'),
				'checked_add_2' => $this->input->post('checked_add_2'),

				'prepared_by_name' => $this->input->post('prepared_by'),
				'prepared_by_designation' => $this->input->post('prepared_by_designation'),
				'prepared_by_address' => $this->input->post('prepared_by_address'),
				'prepared_add_1' => $this->input->post('prepared_add_1'),
				'prepared_add_2' => $this->input->post('prepared_add_2'),

				'technologist_name' => $this->input->post('technologist_name'),
				'technologist_designation' => $this->input->post('technologist_designation'),
				'technologist_address' => $this->input->post('technologist_address'),
				'technologist_add_1' => $this->input->post('technologist_add_1'),
				'technologist_add_2' => $this->input->post('technologist_add_2'),

			);

			$this->load->admin_model->update_function2('specimen_id="' . $id . '"', 'add_technologist', $technologist_data);
		} else {
			$technologist_data = array(

				'checked_by_name' => $this->input->post('checked_by'),
				'checked_by_designation' => $this->input->post('checked_by_designation'),
				'checked_by_address' => $this->input->post('checked_by_address'),
				'checked_add_1' => $this->input->post('checked_add_1'),
				'checked_add_2' => $this->input->post('checked_add_2'),

				'prepared_by_name' => $this->input->post('prepared_by'),
				'prepared_by_designation' => $this->input->post('prepared_by_designation'),
				'prepared_by_address' => $this->input->post('prepared_by_address'),
				'prepared_add_1' => $this->input->post('prepared_add_1'),
				'prepared_add_2' => $this->input->post('prepared_add_2'),

				'technologist_name' => $this->input->post('technologist_name'),
				'technologist_designation' => $this->input->post('technologist_designation'),
				'technologist_address' => $this->input->post('technologist_address'),
				'technologist_add_1' => $this->input->post('technologist_add_1'),
				'technologist_add_2' => $this->input->post('technologist_add_2'),
				'specimen_id' => $id

			);

			$this->load->admin_model->insert('add_technologist', $technologist_data);
		}



		redirect("admin/edit_specimen/" . $id, 'refresh');
	}



	public function get_last_user_id()
	{
		$data = $this->load->admin_model->get_last_id('id', 'login');
		echo json_encode($data);
	}


	// ************ Super Admin Area Start ***********

	public function add_hospital()
	{
		$data['active'] = 'add_hospital';
		$data['page_title'] = 'Add Hospital';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['hospital'] = $this->admin_model->select_where_left_join_order('*, h.hospital_id', 'hospital h', 'expire_date e', 'h.hospital_id=e.hospital_id', 'h.status=1', 'h.hospital_id', 'ASC');

		$this->load->view('super_admin_area/add_hospital', $data);
	}

	public function add_expire_date($hospital_id = '')
	{
		$data['active'] = 'add_expire_date';
		$data['page_title'] = 'Add Expire Date';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['hospital_id'] = $hospital_id;
		$data['expire_date_info'] = $this->admin_model->select_with_where2('*', 'hospital_id="' . $hospital_id . '"', 'expire_date');

		$this->load->view('super_admin_area/add_expire_date', $data);
	}

	public function save_expire_date($hospital_id = '')
	{

		$expire_date_info = $this->admin_model->select_with_where2('*', 'hospital_id="' . $hospital_id . '"', 'expire_date');

		if (count($expire_date_info) > 0) {

			$val = array(
				'hospital_id' => $hospital_id,
				'msg_date_1' => $this->encryptIt_expire($this->input->post('warning_date_1')),
				'msg_date_2' => $this->encryptIt_expire($this->input->post('warning_date_2')),
				'msg_date_3' => $this->encryptIt_expire($this->input->post('warning_date_3')),
				'expire_date' => $this->encryptIt_expire($this->input->post('expire_date'))
			);

			$this->admin_model->update_function2('hospital_id="' . $hospital_id . '"', 'expire_date', $val);
		} else {

			$val = array(
				'hospital_id' => $hospital_id,
				'msg_date_1' => $this->encryptIt_expire($this->input->post('warning_date_1')),
				'msg_date_2' => $this->encryptIt_expire($this->input->post('warning_date_2')),
				'msg_date_3' => $this->encryptIt_expire($this->input->post('warning_date_3')),
				'expire_date' => $this->encryptIt_expire($this->input->post('expire_date'))
			);

			$id = $this->admin_model->insert_ret('expire_date', $val);
		}

		redirect("admin/add_hospital");
	}





	public function add_hospital_form()
	{
		$data['active'] = 'add_hospital_form';
		$data['page_title'] = 'Add Hospital Form';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$this->form_validation->set_error_delimiters('<div>', '</div>');
		//Validating Name Field
		$this->form_validation->set_rules('hospital_title', 'Hospital Title', 'required');
		$this->form_validation->set_rules('director', 'Director', 'required');
		// $this->form_validation->set_rules('telephone', 'Telephone', 'required');
		// $this->form_validation->set_rules('file1', 'Hospital Logo', 'required');
		// $this->form_validation->set_rules('email', 'Email', 'required');
		// $this->form_validation->set_rules('fax', 'Fax', 'required');
		// $this->form_validation->set_rules('address_1', 'Address No 1', 'required');
		// $this->form_validation->set_rules('address_2', 'Address No 2', 'required');
		// $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required');
		// $this->form_validation->set_rules('country', 'Country', 'required');
		// // $this->form_validation->set_rules('branch', 'Branch', 'required');
		// $this->form_validation->set_rules('division', 'Division', 'required');
		// $this->form_validation->set_rules('district', 'District', 'required');
		// $this->form_validation->set_rules('area', 'Area', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('add_hospital/add_hospital_form', $data);
		} else {
			$hospital_logo = 'default_hospital.png';
			$dashboard_img = 'default_dashboard.png';
			$data['active'] = 'add_hospital_form';
			$data['page_title'] = 'Add Hospital Form';

			$hospital_head_report = '<h1 style="text-align:center">"' . $this->input->post('hospital_title_r_ban') . '"</h1>
			<h1 style="margin:0 auto;text-align:center;font-size:16px; padding-bottom: 5px; color:blue;" >"' . $this->input->post('hospital_title_r_eng') . '"</h1>
			<p style="text-align:center;font-size:14px;margin-top:5px">"' . $this->input->post('address_r') . '"<br>"' . $this->input->post('mobile_no_r') . '"
			</p>';

			$hospital_head_money_receipt = '<h1 style=" font-size:14px;  color:red; text-align: center">"' . $this->input->post('hospital_title_r_ban') . '"</h1>
			<h1 style="margin-left: 25px; font-size:14px; padding-bottom: 5px; color:blue;" >"' . $this->input->post('hospital_title_r_eng') . '"</h1>
			<p style="font-size:9px;margin-top:5px">"' . $this->input->post('address_r') . '"<br>"' . $this->input->post('mobile_no_r') . '"</p>';

			$val = array(
				'hospital_title' => $this->input->post('hospital_title'),
				'director' => $this->input->post('director'),
				'telephone' => $this->input->post('telephone'),
				'hospital_logo' => $hospital_logo,
				'dashboard_img' => $dashboard_img,
				'email' => $this->input->post('email'),
				'fax' => $this->input->post('fax'),
				'address_1' => $this->input->post('address_1'),
				'address_2' => $this->input->post('address_2'),
				'mobile_no' => $this->input->post('mobile_no'),
				'country_id' => $this->input->post('country_id'),
				// 'branch_id' => $this->input->post('branch'),
				'division_id' => $this->input->post('division'),
				'district_id' => $this->input->post('district'),
				'area_id' => $this->input->post('area'),
				'hospital_title_ban_report' => $this->input->post('hospital_title_r_ban'),
				'hospital_title_eng_report' => $this->input->post('hospital_title_r_eng'),
				'mobile_report' => $this->input->post('mobile_no_r'),
				'address_report' => $this->input->post('address_r'),
				'hospital_head_report' => $hospital_head_report,
				'hospital_head_money_receipt' => $hospital_head_money_receipt,

				'created_at' => date('Y-m-d H:i:s')
			);

			$id = $this->admin_model->insert_ret('hospital', $val);


			if ($_FILES['file']['name']) {
				$name_generator = $this->name_generator($_FILES['file']['name'], $id);
				$i_ext = explode('.', $_FILES['file']['name']);
				$target_path = $name_generator . '.' . end($i_ext);;
				$size = getimagesize($_FILES['file']['tmp_name']);

				if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/hospital_logo/' . $target_path)) {
					$hospital_logo = $target_path;
				}

				$data_logo['hospital_logo'] = $hospital_logo;
				$this->admin_model->update_function('hospital_id', $id, 'hospital', $data_logo);
			}


			if ($_FILES['dashboard_img']['name']) {
				$name_generator = $this->name_generator($_FILES['dashboard_img']['name'], $id);
				$i_ext = explode('.', $_FILES['dashboard_img']['name']);
				$target_path = $name_generator . '.' . end($i_ext);;
				$size = getimagesize($_FILES['dashboard_img']['tmp_name']);

				if (move_uploaded_file($_FILES['dashboard_img']['tmp_name'], 'uploads/dashboard_img/' . $target_path)) {
					$dashboard_img = $target_path;
				}

				$data_img['dashboard_img'] = $dashboard_img;
				$this->admin_model->update_function('hospital_id', $id, 'hospital', $data_img);
			}



			$data['message'] = 'Data Inserted Successfully';
			$this->load->view('add_hospital/add_hospital_form', $data);
		}
		// $this->load->view(); 
	}



	public function edit_hospital_form($value = '')
	{
		$data['active'] = 'add_hospital_form';
		$data['page_title'] = 'Add Hospital Form';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['hospital_info'] = $this->admin_model->select_with_where2('*', 'hospital_id="' . $this->session->userdata['logged_in']['hospital_id'] . '"', 'hospital');

		$data['country_info'] = $this->admin_model->select_all('country');
		$data['divisions_info'] = $this->admin_model->select_all('divisions');
		$data['districts_info'] = $this->admin_model->select_all('districts');
		$data['area_info'] = $this->admin_model->select_all('area');

		// "<pre>";print_r($data['hospital_info']);die();


		$this->load->view('super_admin_area/edit_hospital_form', $data);
	}

	public function edit_hospital_form_post($value = '')
	{


		$this->db->select('hospital_logo,dashboard_img');
		$this->db->from('hospital');
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			// do something with the results
			foreach($query->result() as $row) {
				 $row->hospital_logo;
				 $row->dashboard_img;
			}
		}
		
		$hospital_logo = $row->hospital_logo;
		$dashboard_img = $row->dashboard_img;

		$data['active'] = 'add_hospital_form';
		$data['page_title'] = 'Add Hospital Form';

		$id = $this->uri->segment(3);

		$hospital_head_report = '<h1 style="text-align:center;font-size:26px;color:black;font-weight:bold;">' . $this->input->post('hospital_title_r_eng') . '</h1>
		<h1 style="text-align:center;font-size:20px;color:black;font-weight:bold;">' . $this->input->post('hospital_title_r_ban') . '</h1>
		<p style="text-align:center;font-size:18px;color:black;margin-top:-8px;">' . $this->input->post('address_r') . '<br>' . $this->input->post('others_r') . '
		</p>';



		$val = array(
			'hospital_title' => $this->input->post('hospital_title'),
			'director' => $this->input->post('director'),
			'telephone' => $this->input->post('telephone'),
			'email' => $this->input->post('email'),
			'fax' => $this->input->post('fax'),
			'address_1' => $this->input->post('address_1'),
			'address_2' => $this->input->post('address_2'),
			'mobile_no' => $this->input->post('mobile_no'),
			'country_id' => $this->input->post('country_id'),
			'division_id' => $this->input->post('division'),
			'district_id' => $this->input->post('district'),
			'area_id' => $this->input->post('area'),
			'hospital_head_report' => $hospital_head_report,
			'hospital_title_eng_report' => $this->input->post('hospital_title_r_eng'),
			'hospital_title_ban_report' => $this->input->post('hospital_title_r_ban'),
			'others_report' => $this->input->post('others_r'),
			'address_report' => $this->input->post('address_r'),
			'created_at' => date('Y-m-d H:i:s')
		);

		$this->admin_model->update_function2('hospital_id="' . $id . '"', 'hospital', $val);


		if ($_FILES['file']['name']) {
			$name_generator = $this->name_generator($_FILES['file']['name'], $id);
			$i_ext = explode('.', $_FILES['file']['name']);
			$target_path = $name_generator . '.' . end($i_ext);;
			$size = getimagesize($_FILES['file']['tmp_name']);

			if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/hospital_logo/' . $target_path)) {
				$hospital_logo = $target_path;
			}

			$data_logo['hospital_logo'] = $hospital_logo;
			$this->admin_model->update_function('hospital_id', $id, 'hospital', $data_logo);
		}

		$this->session->userdata['logged_in']['hospital_logo'] = $hospital_logo;


		if ($_FILES['dashboard_img']['name']) {
			$name_generator = $this->name_generator($_FILES['dashboard_img']['name'], $id);
			$i_ext = explode('.', $_FILES['dashboard_img']['name']);
			$target_path = $name_generator . '.' . end($i_ext);;
			$size = getimagesize($_FILES['dashboard_img']['tmp_name']);

			if (move_uploaded_file($_FILES['dashboard_img']['tmp_name'], 'uploads/dashboard_img/' . $target_path)) {
				$dashboard_img = $target_path;
			}

			$data_img['dashboard_img'] = $dashboard_img;
			$this->admin_model->update_function('hospital_id', $id, 'hospital', $data_img);
		}

		$this->session->userdata['logged_in']['dashboard_img'] = $dashboard_img;



		$data['message'] = 'Data Updated Successfully';

		redirect('admin/edit_hospital_form');
	}

	public function all_hospital_user_list($value = '')
	{
		$data['active'] = 'add_user';
		$data['page_title'] = 'Edit User';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$this->load->view('super_admin_area/all_hospital_with_user', $data);

		// "<pre>";print_r($data['get_all_hospital']);die();

	}


	public function all_hospital_user_list_dt()
	{

		$condition = "status=1";

		$select_column = array('h.*');
		$order_column = array('h.hospital_id');
		$search_column = array('h.hospital_id');

		$user_info = $this->admin_model->select_with_where2('*', 'status=1', 'login');

		$fetch_data = $this->admin_model->make_datatables('hospital h', $condition, $select_column, $order_column, $search_column, 'h.hospital_id');

		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->hospital_title;
			$user = "";

			foreach ($user_info as $key => $value) {

				if ($value['hospital_id'] == $row->hospital_id) {
					$user .= $value['username'] . " (" . openssl_decrypt(base64_decode($value['password']), "AES-256-CBC",  hash('sha256', "Lf6Q5htqdgnSn0AABqlsSddj1QNu0fJs"), 0, substr(hash('sha256', 'This is my secret iv'), 0, 16)) . ')<br>';
				}
			}

			$sub_array[] = $user;
			$data[] = $sub_array;
			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data($select_column, 'hospital', $condition),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data('hospital h', $condition, $select_column, $order_column, $search_column, 'h.hospital_id'),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}



	// *********** Super Admin Area End ***************


	// *********** Manage User and Role Start ***************

	public function delete_role()
	{
		$data = $this->admin_model->delete_function_cond('role', 'id="' . $_POST['role_id'] . '"');
		$this->admin_model->delete_function_cond('permission_role', 'role_id="' . $_POST['role_id'] . '"');

		echo json_encode($data);
	}


	public function edit_role($role_id = '')
	{
		$data['active'] = 'role_list';
		$data['page_title'] = 'Role List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['permission_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'permissions');
		$data['permission_group_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'permissions_group');

		$data['role_info'] = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $role_id . '"', 'role');

		$data['role_id'] = $role_id;



		$this->load->view('add_user/edit_role', $data);
	}


	public function edit_role_post($role_id = '')
	{


		$this->admin_model->delete_function_cond('permission_role', 'role_id="' . $role_id . '"');

		$permissions = $this->input->post('permission_id');


		for ($i = 0; $i < count($permissions); $i++) {

			$data['role_id'] = $role_id;
			$data['permission_id'] = $permissions[$i];


			$this->admin_model->insert('permission_role', $data);
		}

		if ($this->input->post('dashboard') != "") {
			$data['role_id'] = $role_id;
			$data['permission_id'] = $this->input->post('dashboard');
			$this->admin_model->insert('permission_role', $data);
		}

		redirect('admin/role_list');
	}


	public function allowed_permission_list($value = '')
	{
		$data['permission_role_info'] = $this->admin_model->select_with_where2('*', 'role_id="' . $_POST['role_id'] . '"', 'permission_role');

		echo json_encode($data);
	}

	public function role_list($value = '')
	{
		$data['active'] = 'role_list';
		$data['page_title'] = 'Role List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['role_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'role');

		$data['permission_info'] = $this->admin_model->select_join_where('*', 'permission_role pr', 'permissions p', 'pr.permission_id=p.id', 'p.status=1');


		// "<pre>";print_r($data['role_info']);die();

		$this->load->view('add_user/role_list', $data);
	}


	public function add_role($msg = '')
	{
		$data['active'] = 'add_Role';
		$data['page_title'] = 'Add Role';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['permission_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'permissions');
		$data['permission_group_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'permissions_group');


		$this->load->view('add_user/add_role', $data);
	}


	public function add_role_post($value = '')
	{


		$permissions = $this->input->post('permission_id');


		$val['name'] = $this->input->post('role_name');


		// "<pre>";print_r($this->admin_model->check_row('*','name="'.$val['name'].'"','role'));die();

		if ($this->admin_model->check_row('*', 'name="' . $val['name'] . '"', 'role') == 1) {
			$msg = "This role name already exists";
			$this->session->set_flashdata('error', 'This role name already exists');
			redirect('admin/add_role');
		} else {
			// $val['display_name']=$this->input->post('display_name');
			$val['created_at'] = date('Y-m-d');

			$id = $this->admin_model->insert_ret('role', $val);

			for ($i = 0; $i < count($permissions); $i++) {

				$data['role_id'] = $id;
				$data['permission_id'] = $permissions[$i];


				$this->admin_model->insert('permission_role', $data);
			}

			if ($this->input->post('dashboard') != "") {
				$data['role_id'] = $id;
				$data['permission_id'] = $this->input->post('dashboard');
				$this->admin_model->insert('permission_role', $data);
			}




			redirect('admin/role_list');
		}
	}

	public function add_user()
	{

		$data['active'] = 'add_user';
		$data['page_title'] = 'Add User';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['role_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'role');

		$data['dr_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$this->form_validation->set_error_delimiters('<div>', '</div>');

		$this->form_validation->set_rules('hospital', 'Hospital', 'required');

		$this->form_validation->set_rules('user_name', 'User Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');


		if ($this->form_validation->run() == FALSE) {
			$this->load->view('add_user/add_user', $data);
		} else {


			$roles = $this->input->post('role');

			for ($i = 0; $i < count($roles); $i++) {

				$var = explode('#', $roles[$i]);

				$role_id[$i] = $var[0];
				$role_name[$i] = $var[1];
			}



			// "<pre>";print_r($role_name);die();

			$val = array(
				'hospital_id' => $this->input->post('hospital'),
				'username' => $this->input->post('user_name'),
				'role' => implode(', ', $role_id),
				'role_name' => implode(', ', $role_name),
				'doc_id' => $this->input->post('doc_id'),
				'password' => $this->encryptIt($this->input->post('password')),
				'email' => $this->input->post('email'),
				'mobile_no' => $this->input->post('mobile_no'),
				'created_at' => date('Y-m-d H:i:s'),
				'status' => 1,
				'discount_amount' => $this->input->post('discount_amount'),
				'discount_percent' => $this->input->post('discount_percent')
			);

			$id = $this->admin_model->insert_ret('login', $val);

			// $generate_name= $this->user_name_generate($this->input->post('user_name'),$id);



			$val_reg = array(
				'login_id' => $id,
				'user_name' => $this->input->post('user_name'),
				'email' => $this->input->post('email'),
				'password' => $this->encryptIt($this->input->post('password')),
				'phone_no' => $this->input->post('mobile_no'),
				'created_at' => date('Y-m-d H:i:s')
			);

			$this->admin_model->insert('registration', $val_reg);


			$data['message'] = 'Data Inserted Successfully';

			redirect('admin/user_list');
		}
	}


	public function user_list($value = '')
	{
		$data['active'] = 'add_user';
		$data['page_title'] = 'Add User';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['role_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'admin_type');

		$data['all_user_info'] = $this->admin_model->select_where_left_join('*', 'login l', 'doctor d', 'l.doc_id=d.doctor_id', 'role!=0 and l.status=1');

		$this->load->view('add_user/user_list', $data);
	}



	public function edit_user($value = '')
	{
		$data['active'] = 'add_user';
		$data['page_title'] = 'Edit User';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$log_id = $this->uri->segment(3);
		$hos_id = $this->uri->segment(4);

		if ($hos_id != null) {
			$data['hos_id'] = $hos_id;
		} else {
			$data['hos_id'] = "";
		}

		$data['role_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'role');
		$data['dr_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$this->form_validation->set_error_delimiters('<div>', '</div>');
		//Validating Name Field
		// $this->form_validation->set_rules('hospital', 'Hospital', 'required');

		// $this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_rules('user_name', 'User Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		// $this->form_validation->set_rules('email', 'Email', 'required');
		// $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required');
		// $this->load->view('add_user/add_user', $data);

		if ($this->form_validation->run() == FALSE) {
			$data['user_info'] = $this->admin_model->select_with_where2('*', 'id="' . $log_id . '"', 'login');

			$this->load->view('add_user/edit_user', $data);
		} else {

			$roles = $this->input->post('role');

			for ($i = 0; $i < count($roles); $i++) {

				$var = explode('#', $roles[$i]);

				$role_id[$i] = $var[0];
				$role_name[$i] = $var[1];
			}

			$val = array(

				'username' => $this->input->post('user_name'),
				'role' => implode(', ', $role_id),
				'role_name' => implode(', ', $role_name),
				'password' => $this->encryptIt($this->input->post('password')),
				'email' => $this->input->post('email'),
				'mobile_no' => $this->input->post('mobile_no'),
				'discount_amount' => $this->input->post('discount_amount'),
				'discount_percent' => $this->input->post('discount_percent'),
				// 'created_at'=>date('Y-m-d H:i:s'),
				// 'status'=>1
			);

			$this->admin_model->update_function2('id="' . $log_id . '"', 'login', $val);



			// // $generate_name= $this->user_name_generate($this->input->post('user_name'),$id);

			$val_reg = array(
				'user_name' => $this->input->post('user_name'),
				'email' => $this->input->post('email'),
				'password' => $this->encryptIt($this->input->post('password')),
				'phone_no' => $this->input->post('mobile_no'),
				'created_at' => date('Y-m-d H:i:s')
			);

			$this->admin_model->update_function2('id="' . $log_id . '"', 'registration', $val_reg);

			// // $generate_name=array('username' =>$this->user_name_generate($this->input->post('user_name'),$id));

			// $this->admin_model->insert('registration',$val_reg);

			// $this->admin_model->update_function('id',$id,'login',$generate_name);


			$data['message'] = 'Data Updated Successfully';

			// redirect('admin/user_list');
			if ($hos_id == null) {
				redirect('admin/user_list');
			} else {
				redirect('admin/all_hospital_user_list');
			}
		}
	}


	public function delete_user($value = '')
	{
		$data = array('status' => 2);

		$this->admin_model->update_function('id', $_POST['log_id'], 'login', $data);
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function user_name_generate($value, $id)
	{
		$name['name_title'] = str_replace(' ', '', $value);
		$name['name_title'] = $name['name_title'] . '_' . $id;
		return $name['name_title'];
		// echo $name; 
	}


	// *********** Manage User and Role End ***************


	function encryptIt($string)
	{
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'Lf6Q5htqdgnSn0AABqlsSddj1QNu0fJs';
		$secret_iv = 'This is my secret iv';
		// hash
		$key = hash('sha256', $secret_key);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);

		return $output;
	}

	function encryptIt_expire($string)
	{
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'encryptedexpiredaterecently';
		$secret_iv = 'This is my secret iv';
		// hash
		$key = hash('sha256', $secret_key);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);

		return $output;
	}


	public function decryptIt($string)
	{
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		return $output;
	}



	private function set_upload_options($file_name, $folder_name)
	{
		//upload an image options
		$url = base_url();

		$config = array();
		$config['file_name'] = $file_name;
		$config['upload_path'] = 'uploads/' . $folder_name;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = '0';
		$config['overwrite']     = TRUE;

		return $config;
	}

	public function name_generator($name = '', $id)
	{
		$data_link['title_link'] = preg_replace('/[ ,]+/', '_', trim($name));
		$data_link['title_link'] = $data_link['title_link'] . '_' . $id;
		$data_link['title_link'] = str_replace("'", '', $data_link['title_link']);
		$data_link['title_link'] = str_replace("@", '', $data_link['title_link']);
		$data_link['title_link'] = str_replace("/", '', $data_link['title_link']);
		$data_link['title_link'] = str_replace(".", '_', $data_link['title_link']);
		return $data_link['title_link'];
	}

	public function get_all_admin()
	{

		$data = $this->admin_model->select_with_where('*', 1, 'admin_type', 'status');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function get_all_hospital_title()
	{
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		if ($data['admin_type'] == 0) {
			$data['hospital_name'] = $this->admin_model->select_with_where('*', 1, 'hospital', 'status');
		} else {
			$data['hospital_name'] = $this->admin_model->select_with_where2('*', 'hospital_id="' . $this->session->userdata['logged_in']['hospital_id'] . '" and status=1', 'hospital');
		}

		echo json_encode($data);
	}



	public function get_all_test_by_hospital_id()
	{
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$hospital_id_sub = $this->input->post('hospital_id_sub');
		$data = $this->admin_model->select_with_where_test('*', $hospital_id_sub, 'diagnostic_test_group', 'hospital_id');
		echo json_encode($data);
	}
	public function add_test()
	{

		$data = array(
			'test_title' => $this->input->post('test_title'),
			'hospital_id' => $this->input->post('hospital_id'),
			'speciman' => $this->input->post('speciman'),
			'specimen_id' => $this->input->post('specimen_id'),
			'add_machine_text' => $this->input->post('add_machine_text'),
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->admin_model->insert('diagnostic_test_group', $data);
		echo json_encode($data);
	}

	public function add_sub_test()
	{

		$data = array(
			'mtest_id' => $this->input->post('test_id'),
			'hospital_id' => $this->input->post('hospital_id'),
			'sub_test_title' => $this->input->post('sub_test_title'),
			'price' => $this->input->post('price'),
			'reagent_qty' => $this->input->post('reagent_qty'),
			'reagent_p_id' => $this->input->post('reagent_p_id'),
			// 'doc_ref_com'=>"",
			// 'quk_ref_com'=>$this->input->post('quk_ref_com'),
			// 'ref_val'=>$this->input->post('ref_val'),
			'unit' => $this->input->post('unit'),
			'created_at' => date('Y-m-d H:i:s'),
			'test_template' => '<div class="bio-chemestry"><table class="farhana-table-4"><tbody><tr><th class="farhana-table-4-tr-1" colspan="5">Test name : ' . $this->input->post('sub_test_title') . '</th></tr><tr><td>' . $this->input->post('sub_test_title') . '<b></b></td><td></td><td></td><td><br></td></tr></tbody></table></div>',
		);
		$this->admin_model->insert('diagnostic_test_subgroup', $data);
		echo json_encode($data);
	}

	public function delete_test()
	{
		$data = array('status' => 2);
		$this->admin_model->update_function('test_id', $this->input->post('test_id'), 'diagnostic_test_group', $data);
		echo json_encode($data);
	}

	public function delete_sub_test()
	{
		$data = array('status' => 2);
		$this->admin_model->update_function('id', $this->input->post('sub_test_id'), 'diagnostic_test_subgroup', $data);
		echo json_encode($data);
	}

	public function get_specific_hospital_and_test()
	{
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['test'] = $this->admin_model->select_two_where_join(array('h.hospital_id', 'd.test_title', 'd.test_id', 'd.speciman', 'd.specimen_id', 'h.hospital_title', 'd.add_machine_text'), 'diagnostic_test_group d', 'hospital h', 'h.hospital_id=d.hospital_id', 'd.test_id', $this->input->post('test_id'), 'd.status', 1);

		$data['hospital'] = $this->admin_model->select_with_where('*', 1, 'hospital', 'status');

		$data['specimen'] = $this->admin_model->select_with_where2('*', 'status=1', 'add_specimen');


		echo json_encode($data);
	}

	public function get_specific_hospital_and_test_sub_test()
	{
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['sub_test'] = $this->admin_model->select_join_three_table2_left('*,ds.id', 'diagnostic_test_subgroup ds', 'sh_tbl_lab_product lp', 'diagnostic_test_group dt', 'ds.reagent_p_id=lp.id', 'ds.mtest_id=dt.test_id', 'ds.status=1 and ds.type=1 and ds.id="' . $_POST['id'] . '"');

		// 	$data['sub_test']=$this->admin_model->select_join_three_table('*','diagnostic_test_subgroup ds','hospital h','diagnostic_test_group d','h.hospital_id=ds.hospital_id','ds.mtest_id=d.test_id','id',$this->input->post('id'),'d.status',1
		// );
		$data['test'] = $this->admin_model->select_with_where('*', 1, 'diagnostic_test_group', 'status');

		$data['regent_product_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'sh_tbl_lab_product');

		echo json_encode($data);
	}
	public function update_hospital()
	{
		$data = array('hospital_title' => $this->input->post('hospital_title'));
		$data = $this->admin_model->update_function('hospital_id', $this->input->post('hospital_id'), 'hospital', $data);
		echo json_encode($data);
	}

	public function update_test()
	{
		$data = array(
			'test_title' => $this->input->post('test_title_edit'),
			'hospital_id' => $this->input->post('hospital_id'),
			'speciman' => $this->input->post('edit_speciman'),
			'specimen_id' => $this->input->post('specimen_id'),
			'add_machine_text' => $this->input->post('add_machine_text'),
		);
		$data = $this->admin_model->update_function('test_id', $this->input->post('test_id'), 'diagnostic_test_group', $data);
		echo json_encode($data);
	}
	public function update_sub_test()
	{
		$data = array(
			'mtest_id' => $this->input->post('test_id'),
			'sub_test_title' => $this->input->post('sub_test_title'),
			'price' => $this->input->post('price'),
			// 'quk_ref_com'=>$this->input->post('edit_quk_ref_com'),
			// 'doc_ref_com'=>'',
			// 'ref_val' =>$this->input->post('edit_ref_val'),
			'unit' => $this->input->post('edit_unit'),
			'reagent_p_id' => $this->input->post('reagent_p_id_edit'),
			'reagent_qty' => $this->input->post('reagent_qty_edit')

		);
		$data = $this->admin_model->update_function('id', $this->input->post('id'), 'diagnostic_test_subgroup', $data);
		echo json_encode($data);
	}

	public function get_all_country()
	{
		$data = $this->admin_model->select_all('country');
		echo json_encode($data);
	}
	public function get_all_division()
	{
		$data = $this->admin_model->select_all('divisions');
		echo json_encode($data);
	}
	public function get_all_district()
	{
		$data = $this->admin_model->select_with_where('*', $this->input->post('division_id'), 'districts', 'division_id');
		echo json_encode($data);
	}

	public function get_all_area()
	{
		$data = $this->admin_model->select_with_where('*', $this->input->post('district_id'), 'area', 'district_id');
		echo json_encode($data);
	}

	public function hospital_delete_test()
	{
		$data = array('status' => 2);
		$this->admin_model->update_function('hospital_id', $this->input->post('hospital_id'), 'hospital', $data);
		echo json_encode($data);
	}



	//*************** Manage Test End ***************


	// *********************  Manage Birth/Death Certificate Starts *************

	public function add_birth_certificate($value = '')
	{
		$data['active'] = 'add_birth_certificate';
		$data['page_title'] = 'Add Birth Certificate';

		$data['room'] = $this->admin_model->select_with_where2('*', 'status=1', 'room');
		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$this->load->view('birth_death_certificate/add_birth_certificate', $data);
	}

	public function add_birth_certificate_post($value = '')
	{

		$ref_doc_name = explode('#', $this->input->post('ref_doc'));

		$fileName = "default.png";

		$data = array(
			'patient_name' => $this->input->post('patient_name'),
			'mobile_no' => $this->input->post('mobile_no'),
			'father_name' => $this->input->post('father_name'),
			'mother_name' => $this->input->post('mother_name'),
			'height' => $this->input->post('height'),
			'weight' => $this->input->post('weight'),
			'gender' => $this->input->post('gender'),
			'cabin_no' => $this->input->post('cabin_no'),
			'place_of_birth' => $this->input->post('place_of_birth'),

			'date_of_birth' => $this->input->post('date_of_birth'),
			'email' => $this->input->post('email'),
			'patient_image' => $fileName,
			'ref_doc_id' => $ref_doc_name[1],
			'ref_doc_name' => $ref_doc_name[0],
			'created_at' => date('Y-m-d'),
			'is_birth_death' => 1,
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],
		);


		$id = $this->admin_model->insert_ret('birth_death_certificate', $data);


		if ($this->input->post('image') != "") {
			$img = $_POST['image'];
			$folderPath = "uploads/birth_death_certificate/";

			$image_parts = explode(";base64,", $img);
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];

			$image_base64 = base64_decode($image_parts[1]);
			$fileName = uniqid() . '.png';

			$file = $folderPath . $fileName;
			file_put_contents($file, $image_base64);

			$data_logo['patient_image'] = $fileName;

			$this->admin_model->update_function('id', $id, 'uhid', $data_logo);
		} else if ($_FILES['file']['name'] != "") {
			$name_generator = $this->name_generator($_FILES['file']['name'], $id);
			$i_ext = explode('.', $_FILES['file']['name']);
			$target_path = $name_generator . '.' . end($i_ext);;
			$size = getimagesize($_FILES['file']['tmp_name']);

			if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/birth_death_certificate/' . $target_path)) {
				$fileName = $target_path;
			}

			$data_logo['patient_image'] = $fileName;

			$this->admin_model->update_function('id', $id, 'birth_death_certificate', $data_logo);
		}

		$rows = $this->admin_model->select_with_where2('*', 'status=1 and is_birth_death=1', 'birth_death_certificate');

		$gen_id['gen_id'] = sprintf("%'.06d", (count($rows)));

		$this->admin_model->update_function('id', $id, 'birth_death_certificate', $gen_id);

		redirect('admin/add_birth_certificate', 'refresh');
	}

	public function birth_certificate_list()
	{
		$data['active'] = 'birth_certificate_list';
		$data['page_title'] = 'Birth Certificate List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['id'] = $this->session->userdata['logged_in']['id'];

		$this->load->view('birth_death_certificate/birth_certificate_list', $data);
	}

	public function birth_certificate_list_dt($value = '')
	{
		$select_column = '*,b.id,b.created_at as c_date';
		$order_column = array('p_id', null, 'patient_name', 'mobile_no', null, null, null, null, null);

		$search_column = array('patient_name', 'gen_id', 'mobile_no');

		$fetch_data = $this->admin_model->make_datatables_two_table_join('birth_death_certificate b', 'b.status=1 and is_birth_death=1', $select_column, $order_column, $search_column, 'room r', 'r.id=b.cabin_no', 'b.id');

		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {

			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->gen_id;
			$sub_array[] = $row->patient_name;
			$sub_array[] = $row->father_name;
			$sub_array[] = $row->mother_name;
			$sub_array[] = $row->date_of_birth;
			$sub_array[] = $row->place_of_birth;
			$sub_array[] = $row->height;
			$sub_array[] = $row->weight;
			$sub_array[] = $row->ref_doc_name;
			$sub_array[] = $row->gender;
			$sub_array[] = $row->room_title;
			$sub_array[] = '<img style="border:2px solid black; height: 100px; width: 100px; max-width: none !important;" src="uploads/birth_death_certificate/' . $row->patient_image . '">';
			$sub_array[] = $row->mobile_no;
			$sub_array[] = date('d-M-y', strtotime($row->c_date));
			$sub_array[] = $row->operator_name;


			$sub_array[] = '<a target="_blank" href="admin/birth_certificate_pdf/' . $row->id . '" class="btn btn-primary btn-sm">Print</a>';

			if (($this->auth->can('edit_birth_certificate-admin'))) {
				$sub_array[] = '<a href ="admin/edit_birth_certificate/' . $row->id . '" class="btn btn-success btn-xs edit_button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

				<a href ="admin/delete_birth_certificate/' . $row->id . '" class="btn btn-xs btn-danger "><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
			}

			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('birth_death_certificate b', 'b.status=1 and is_birth_death=1', $select_column, 'room r', 'r.id=b.cabin_no'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
				'birth_death_certificate b',
				'b.status=1 and is_birth_death=1',
				$select_column,
				$order_column,
				$search_column,
				'room r',
				'r.id=b.cabin_no',
				'b.id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	public function edit_birth_certificate($id = '')
	{
		$data['active'] = 'edit_birth_certificate';
		$data['page_title'] = 'Birth Certificate Edit';

		$data['room'] = $this->admin_model->select_with_where2('*', 'status=1', 'room');
		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['birth_info'] = $this->admin_model->select_where_left_join('*,b.id', 'birth_death_certificate b', 'room r', 'b.cabin_no=r.id', 'b.status=1 and b.id="' . $id . '"');

		$this->load->view('birth_death_certificate/edit_birth_certificate', $data);
	}

	public function edit_birth_certificate_post($id = '')
	{

		$id = $id;

		$ref_doc_name = explode('#', $this->input->post('ref_doc'));

		$data = array(
			'patient_name' => $this->input->post('patient_name'),
			'mobile_no' => $this->input->post('mobile_no'),
			'father_name' => $this->input->post('father_name'),
			'mother_name' => $this->input->post('mother_name'),
			'cabin_no' => $this->input->post('cabin_no'),
			'height' => $this->input->post('height'),
			'weight' => $this->input->post('weight'),
			'gender' => $this->input->post('gender'),
			'date_of_birth' => $this->input->post('date_of_birth'),
			'place_of_birth' => $this->input->post('place_of_birth'),
			'email' => $this->input->post('email'),
			'ref_doc_id' => $ref_doc_name[1],
			'ref_doc_name' => $ref_doc_name[0],
			'created_at' => date('Y-m-d'),
			'is_birth_death' => 1,
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],
		);


		$this->admin_model->update_function('id', $id, 'birth_death_certificate', $data);


		if ($this->input->post('image') != "") {
			$img = $_POST['image'];
			$folderPath = "uploads/birth_death_certificate/";

			$image_parts = explode(";base64,", $img);
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];

			$image_base64 = base64_decode($image_parts[1]);
			$fileName = uniqid() . '.png';

			$file = $folderPath . $fileName;
			file_put_contents($file, $image_base64);

			$data_logo['patient_image'] = $fileName;

			$this->admin_model->update_function('id', $id, 'uhid', $data_logo);
		} else if ($_FILES['file']['name'] != "") {
			$name_generator = $this->name_generator($_FILES['file']['name'], $id);
			$i_ext = explode('.', $_FILES['file']['name']);
			$target_path = $name_generator . '.' . end($i_ext);;
			$size = getimagesize($_FILES['file']['tmp_name']);

			if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/birth_death_certificate/' . $target_path)) {
				$fileName = $target_path;
			}

			$data_logo['patient_image'] = $fileName;

			$this->admin_model->update_function('id', $id, 'birth_death_certificate', $data_logo);
		}

		redirect('admin/birth_certificate_list', 'refresh');
	}

	public function delete_birth_certificate($id = '')
	{
		$data['status'] = 2;
		$this->admin_model->update_function2('id="' . $id . '"', 'birth_death_certificate', $data);

		redirect('admin/birth_certificate_list');
	}

	public function birth_certificate_pdf($id = '')
	{
		$data['birth_info'] = $this->admin_model->select_where_left_join('*,b.id', 'birth_death_certificate b', 'room r', 'b.cabin_no=r.id', 'b.status=1 and b.id="' . $id . '"');

		$this->load->view('birth_death_certificate/birth_certificate_pdf', $data);
	}



	public function add_death_certificate($value = '')
	{
		$data['active'] = 'add_birth_certificate';
		$data['page_title'] = 'Add Birth Certificate';

		$data['room'] = $this->admin_model->select_with_where2('*', 'status=1', 'room');
		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$this->load->view('birth_death_certificate/add_death_certificate', $data);
	}

	public function add_death_certificate_post($value = '')
	{

		$ref_doc_name = explode('#', $this->input->post('ref_doc'));

		$fileName = "default.png";

		$data = array(
			'patient_name' => $this->input->post('patient_name'),
			'mobile_no' => $this->input->post('mobile_no'),
			'father_name' => $this->input->post('father_name'),
			'mother_name' => $this->input->post('mother_name'),
			'height' => $this->input->post('height'),
			'cabin_no' => $this->input->post('cabin_no'),
			'weight' => $this->input->post('weight'),
			'gender' => $this->input->post('gender'),
			'date_of_birth' => $this->input->post('date_of_birth'),
			'date_of_death' => $this->input->post('date_of_death'),
			'place_of_birth' => $this->input->post('place_of_birth'),
			'email' => $this->input->post('email'),
			'patient_image' => $fileName,
			'ref_doc_id' => $ref_doc_name[1],
			'ref_doc_name' => $ref_doc_name[0],
			'created_at' => date('Y-m-d'),
			'is_birth_death' => 2,
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],
		);


		$id = $this->admin_model->insert_ret('birth_death_certificate', $data);


		if ($this->input->post('image') != "") {
			$img = $_POST['image'];
			$folderPath = "uploads/birth_death_certificate/";

			$image_parts = explode(";base64,", $img);
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];

			$image_base64 = base64_decode($image_parts[1]);
			$fileName = uniqid() . '.png';

			$file = $folderPath . $fileName;
			file_put_contents($file, $image_base64);

			$data_logo['patient_image'] = $fileName;

			$this->admin_model->update_function('id', $id, 'uhid', $data_logo);
		} else if ($_FILES['file']['name'] != "") {
			$name_generator = $this->name_generator($_FILES['file']['name'], $id);
			$i_ext = explode('.', $_FILES['file']['name']);
			$target_path = $name_generator . '.' . end($i_ext);;
			$size = getimagesize($_FILES['file']['tmp_name']);

			if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/birth_death_certificate/' . $target_path)) {
				$fileName = $target_path;
			}

			$data_logo['patient_image'] = $fileName;

			$this->admin_model->update_function('id', $id, 'birth_death_certificate', $data_logo);
		}

		$rows = $this->admin_model->select_with_where2('*', 'status=1 and is_birth_death=2', 'birth_death_certificate');

		$gen_id['gen_id'] = sprintf("%'.06d", (count($rows)));

		$this->admin_model->update_function('id', $id, 'birth_death_certificate', $gen_id);

		redirect('admin/add_death_certificate', 'refresh');
	}

	public function death_certificate_list()
	{
		$data['active'] = 'death_certificate_list';
		$data['page_title'] = 'Death Certificate List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['id'] = $this->session->userdata['logged_in']['id'];

		$this->load->view('birth_death_certificate/death_certificate_list', $data);
	}

	public function death_certificate_list_dt($value = '')
	{
		$select_column = '*,b.id,b.created_at as c_date';
		$order_column = array('p_id', null, 'patient_name', 'mobile_no', null, null, null, null, null);

		$search_column = array('patient_name', 'gen_id', 'mobile_no');

		$fetch_data = $this->admin_model->make_datatables_two_table_join('birth_death_certificate b', 'b.status=1 and is_birth_death=2', $select_column, $order_column, $search_column, 'room r', 'r.id=b.cabin_no', 'b.id');

		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {

			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->gen_id;
			$sub_array[] = $row->patient_name;
			$sub_array[] = $row->father_name;
			$sub_array[] = $row->mother_name;
			$sub_array[] = $row->date_of_birth;
			$sub_array[] = $row->date_of_death;
			$sub_array[] = $row->place_of_birth;
			$sub_array[] = $row->height;
			$sub_array[] = $row->weight;
			$sub_array[] = $row->ref_doc_name;
			$sub_array[] = $row->gender;
			$sub_array[] = $row->room_title;
			$sub_array[] = '<img style="border:2px solid black; height: 100px; width: 100px; max-width: none !important;" src="uploads/birth_death_certificate/' . $row->patient_image . '">';
			$sub_array[] = $row->mobile_no;
			$sub_array[] = date('d-M-y', strtotime($row->c_date));
			$sub_array[] = $row->operator_name;


			$sub_array[] = '<a target="_blank" href="admin/death_certificate_pdf/' . $row->id . '" class="btn btn-primary btn-sm">Print</a>';

			if (($this->auth->can('edit_death_certificate-admin'))) {
				$sub_array[] = '<a href ="admin/edit_death_certificate/' . $row->id . '" class="btn btn-success btn-xs edit_button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

				<a href ="admin/delete_death_certificate/' . $row->id . '" class="btn btn-xs btn-danger "><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
			}

			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('birth_death_certificate b', 'b.status=1 and is_birth_death=2', $select_column, 'room r', 'r.id=b.cabin_no'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
				'birth_death_certificate b',
				'b.status=1 and is_birth_death=2',
				$select_column,
				$order_column,
				$search_column,
				'room r',
				'r.id=b.cabin_no',
				'b.id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	public function edit_death_certificate($id = '')
	{
		$data['active'] = 'edit_death_certificate';
		$data['page_title'] = 'Death Certificate Edit';

		$data['room'] = $this->admin_model->select_with_where2('*', 'status=1', 'room');
		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['birth_info'] = $this->admin_model->select_where_left_join('*,b.id', 'birth_death_certificate b', 'room r', 'b.cabin_no=r.id', 'b.status=1 and b.id="' . $id . '"');

		$this->load->view('birth_death_certificate/edit_death_certificate', $data);
	}

	public function edit_death_certificate_post($id = '')
	{

		$id = $id;

		$ref_doc_name = explode('#', $this->input->post('ref_doc'));

		$data = array(
			'patient_name' => $this->input->post('patient_name'),
			'mobile_no' => $this->input->post('mobile_no'),
			'father_name' => $this->input->post('father_name'),
			'mother_name' => $this->input->post('mother_name'),
			'cabin_no' => $this->input->post('cabin_no'),
			'height' => $this->input->post('height'),
			'weight' => $this->input->post('weight'),
			'gender' => $this->input->post('gender'),
			'date_of_birth' => $this->input->post('date_of_birth'),
			'place_of_birth' => $this->input->post('place_of_birth'),
			'email' => $this->input->post('email'),
			'ref_doc_id' => $ref_doc_name[1],
			'ref_doc_name' => $ref_doc_name[0],
			'created_at' => date('Y-m-d'),
			'is_birth_death' => 2,
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],
		);


		$this->admin_model->update_function('id', $id, 'birth_death_certificate', $data);


		if ($this->input->post('image') != "") {
			$img = $_POST['image'];
			$folderPath = "uploads/birth_death_certificate/";

			$image_parts = explode(";base64,", $img);
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];

			$image_base64 = base64_decode($image_parts[1]);
			$fileName = uniqid() . '.png';

			$file = $folderPath . $fileName;
			file_put_contents($file, $image_base64);

			$data_logo['patient_image'] = $fileName;

			$this->admin_model->update_function('id', $id, 'uhid', $data_logo);
		} else if ($_FILES['file']['name'] != "") {
			$name_generator = $this->name_generator($_FILES['file']['name'], $id);
			$i_ext = explode('.', $_FILES['file']['name']);
			$target_path = $name_generator . '.' . end($i_ext);;
			$size = getimagesize($_FILES['file']['tmp_name']);

			if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/birth_death_certificate/' . $target_path)) {
				$fileName = $target_path;
			}

			$data_logo['patient_image'] = $fileName;

			$this->admin_model->update_function('id', $id, 'birth_death_certificate', $data_logo);
		}

		redirect('admin/death_certificate_list', 'refresh');
	}

	public function delete_death_certificate($id = '')
	{
		$data['status'] = 2;
		$this->admin_model->update_function2('id="' . $id . '"', 'birth_death_certificate', $data);

		redirect('admin/death_certificate_list');
	}

	public function death_certificate_pdf($id = '')
	{
		$data['birth_info'] = $this->admin_model->select_where_left_join('*,b.id', 'birth_death_certificate b', 'room r', 'b.cabin_no=r.id', 'b.status=1 and b.id="' . $id . '"');

		$this->load->view('birth_death_certificate/death_certificate_pdf', $data);
	}




	// *********************  Manage Birth/Death Certificate Ends **************




	//************ UHID Module Starts ***********************//


	//************ UHID Module Starts ***********************//

	public function uhid_patient_all_info($value = '')
	{
		$data['active'] = 'uhid_patient_all_info';
		$data['page_title'] = 'UHID Patient';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['all_uhid_patient_id'] = $this->admin_model->select_with_where2('*', 'status=1', 'uhid');


		$this->load->view('uhid_management/uhid_patient_all_info', $data);
	}

	public function uhid_patient_all_info_post($value = '')
	{

		$data['active'] = 'uhid_patient_all_info_post';
		$data['page_title'] = 'UHID Patient All Info Show';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$uhid = $_POST['uhid'];

		$data['uhid'] = $uhid;

		$data['all_uhid_info'] = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $uhid . '"', 'uhid');

		$data['all_opd_info'] = $this->admin_model->select_with_where2('*', 'status=1 and uhid="' . $uhid . '"', 'opd_patient_test_order_info');

		$data['all_ipd_info'] = $this->admin_model->select_with_where2('*', 'status=1 and uhid="' . $uhid . '"', 'ipd_patient_info');

		$this->load->view('uhid_management/uhid_patient_all_info_show', $data);
	}



	public function uhid_reg($value = '')
	{
		$data['active'] = 'uhid_reg';
		$data['page_title'] = 'UHID Registration';

		$data['all_blood_group'] = $this->admin_model->select_with_where2('*', 'status=1', 'blood_group');
		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$this->load->view('uhid_management/uhid_reg', $data);
	}

	public function uhid_reg_post($value = '')
	{

		$Day = $this->input->post('Day');
		$Month = $this->input->post('Month');
		$Year = $this->input->post('Year');

		if (($Day != 0) and ($Month != 0) and ($Year != 0)) {
			$age = $Day . " D " . $Month . " M " . $Year . " Y";
		} elseif (($Day == 0) and ($Month != 0) and ($Year != 0)) {
			$age = $Year . " Y " . $Month . " M";
		} elseif (($Day != 0) and ($Month == 0) and ($Year != 0)) {
			$age = $Day . " D " . $Year . " Y";
		} elseif (($Day != 0) and ($Month != 0) and ($Year == 0)) {
			$age = $Day . " D " . $Month . " M";
		} elseif (($Day == 0) and ($Month == 0) and ($Year != 0)) {
			$age = $Year . " Y";
		} elseif (($Day == 0) and ($Month != 0) and ($Year == 0)) {
			$age = $Month . " M";
		} elseif (($Day != 0) and ($Month == 0) and ($Year == 0)) {
			$age = $Day . " D";
		} else {
			$age = "";
		}

		$ref_doc_name = explode('#', $this->input->post('ref_doc'));

		$fileName = "default.png";

		$data = array(
			'patient_name' => $this->input->post('patient_name'),
			'mobile_no' => $this->input->post('mobile_no'),
			'address' => $this->input->post('address'),
			'gender' => $this->input->post('gender'),
			'date_of_birth' => $this->input->post('date_of_birth'),
			'blood_group' => $this->input->post('blood_group'),
			'email' => $this->input->post('email'),
			'age' => $age,
			'patient_image' => $fileName,
			'ref_doc_id' => $ref_doc_name[1],
			'ref_doc_name' => $ref_doc_name[0],
			'created_at' => date('Y-m-d'),
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],
		);


		$id = $this->admin_model->insert_ret('uhid', $data);


		if ($this->input->post('image') != "") {
			$img = $_POST['image'];
			$folderPath = "uploads/uhid_patient/";

			$image_parts = explode(";base64,", $img);
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];

			$image_base64 = base64_decode($image_parts[1]);
			$fileName = uniqid() . '.png';

			$file = $folderPath . $fileName;
			file_put_contents($file, $image_base64);

			$data_logo['patient_image'] = $fileName;

			$this->admin_model->update_function('id', $id, 'uhid', $data_logo);
		} else if ($_FILES['file']['name'] != "") {
			$name_generator = $this->name_generator($_FILES['file']['name'], $id);
			$i_ext = explode('.', $_FILES['file']['name']);
			$target_path = $name_generator . '.' . end($i_ext);;
			$size = getimagesize($_FILES['file']['tmp_name']);

			if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/uhid_patient/' . $target_path)) {
				$fileName = $target_path;
			}

			$data_logo['patient_image'] = $fileName;

			$this->admin_model->update_function('id', $id, 'uhid', $data_logo);
		}

		$gen_id['gen_id'] = sprintf("%'.06d", ($id));

		$this->admin_model->update_function('id', $id, 'uhid', $gen_id);

		redirect('admin/uhid_reg', 'refresh');
	}


	public function uhid_list()
	{
		$data['active'] = 'uhid_list';
		$data['page_title'] = 'UHID List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['id'] = $this->session->userdata['logged_in']['id'];

		$this->load->view('uhid_management/uhid_list', $data);
	}

	public function uhid_list_dt($value = '')
	{
		$select_column = '*,u.id,u.created_at as c_date';
		$order_column = array('p_id', null, 'patient_name', 'mobile_no', null, null, null, null, null);

		$search_column = array('patient_name', 'gen_id', 'mobile_no');

		$fetch_data = $this->admin_model->make_datatables_two_table_join('uhid u', 'u.status=1', $select_column, $order_column, $search_column, 'blood_group b', 'b.id=u.blood_group', 'u.id');




		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {

			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->gen_id;
			$sub_array[] = $row->patient_name;
			$sub_array[] = $row->age;
			$sub_array[] = $row->ref_doc_name;
			$sub_array[] = $row->gender;
			$sub_array[] = $row->blood_group_title;
			$sub_array[] = $row->address;
			$sub_array[] = '<img style="border:2px solid black; height: 100px; width: 100px; max-width: none !important;" src="uploads/uhid_patient/' . $row->patient_image . '">';
			$sub_array[] = $row->mobile_no;
			$sub_array[] = date('d-M-y', strtotime($row->c_date));
			$sub_array[] = $row->operator_name;


			$sub_array[] = '<a target="_blank" href="admin/uhid_patient_pdf/' . $row->id . '" class="btn btn-primary btn-sm">Print</a>';

			if (($this->auth->can('edit_uhid-admin'))) {
				$sub_array[] = '<a href ="admin/edit_uhid/' . $row->id . '" class="btn btn-success btn-xs edit_button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

				<a href ="admin/delete_uhid/' . $row->id . '" class="btn btn-xs btn-danger "><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
			}

			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('uhid u', 'u.status=1', $select_column, 'blood_group b', 'b.id=u.blood_group'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
				'uhid u',
				'u.status=1',
				$select_column,
				$order_column,
				$search_column,
				'blood_group b',
				'b.id=u.blood_group',
				'u.id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}


	public function edit_uhid($uhid = '')
	{
		$data['active'] = 'edit_uhid';
		$data['page_title'] = 'UHID Edit';

		$data['all_blood_group'] = $this->admin_model->select_with_where2('*', 'status=1', 'blood_group');
		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['uhid_info'] = $this->admin_model->select_where_left_join('*', 'uhid u', 'blood_group b', 'u.blood_group=b.id', 'u.status=1 and u.id="' . $uhid . '"');

		$this->load->view('uhid_management/edit_uhid', $data);
	}

	public function edit_uhid_post($uhid = '')
	{

		$id = $uhid;

		$ref_doc_name = explode('#', $this->input->post('ref_doc'));

		$data = array(
			'patient_name' => $this->input->post('patient_name'),
			'mobile_no' => $this->input->post('mobile_no'),
			'address' => $this->input->post('address'),
			'gender' => $this->input->post('gender'),
			'date_of_birth' => $this->input->post('date_of_birth'),
			'blood_group' => $this->input->post('blood_group'),
			'email' => $this->input->post('email'),
			'age' => $this->input->post('age'),
			'ref_doc_id' => $ref_doc_name[1],
			'ref_doc_name' => $ref_doc_name[0],
			'created_at' => date('Y-m-d'),
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],
		);


		$this->admin_model->update_function('id', $id, 'uhid', $data);


		if ($this->input->post('image') != "") {
			$img = $_POST['image'];
			$folderPath = "uploads/uhid_patient/";

			$image_parts = explode(";base64,", $img);
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];

			$image_base64 = base64_decode($image_parts[1]);
			$fileName = uniqid() . '.png';

			$file = $folderPath . $fileName;
			file_put_contents($file, $image_base64);

			$data_logo['patient_image'] = $fileName;

			$this->admin_model->update_function('id', $id, 'uhid', $data_logo);
		} else if ($_FILES['file']['name'] != "") {
			$name_generator = $this->name_generator($_FILES['file']['name'], $id);
			$i_ext = explode('.', $_FILES['file']['name']);
			$target_path = $name_generator . '.' . end($i_ext);;
			$size = getimagesize($_FILES['file']['tmp_name']);

			if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/uhid_patient/' . $target_path)) {
				$fileName = $target_path;
			}

			$data_logo['patient_image'] = $fileName;

			$this->admin_model->update_function('id', $id, 'uhid', $data_logo);
		}

		$gen_id['gen_id'] = sprintf("%'.06d", ($id));

		$this->admin_model->update_function('id', $id, 'uhid', $gen_id);

		redirect('admin/uhid_list', 'refresh');
	}

	public function delete_uhid($uhid = '')
	{
		$data['status'] = 2;
		$this->admin_model->update_function2('id="' . $uhid . '"', 'uhid', $data);

		redirect('admin/uhid_list');
	}

	public function uhid_patient_pdf($uhid = '')
	{
		$data['uhid_info'] = $this->admin_model->select_where_left_join('*', 'uhid u', 'blood_group b', 'u.blood_group=b.id', 'u.status=1 and u.id="' . $uhid . '"');

		$this->load->view('uhid_management/uhid_patient_pdf', $data);
	}







	//************ UHID Module Ends ***********************//


	//************ UHID Module Ends ***********************//





	//************ OPD Module Starts ***********************//


	//************ OPD Module Starts ***********************//


	public function opd_file_tag_print_datewise($value = '')
	{
		$data['active'] = 'opd_file_tag_print';
		$data['page_title'] = 'OPD File Tag Print Datewise';

		$this->load->view('opd/opd_file_tag_print_datewise', $data);
	}

	public function opd_file_tag_print_datewise_post($value = '')
	{

		$start_date = $this->input->post('start_date');

		$end_date = $this->input->post('end_date');

		redirect('admin/opd_file_tag_print_datewise_post_next/' . $start_date . '/' . $end_date);
	}

	public function opd_file_tag_print_datewise_post_next($start_date = '', $end_date = '')
	{

		$data["patient_order_info"] = $this->admin_model->select_join_where('*', 'opd_patient_test_order_info o', 'opd_patient_info op', 'o.patient_id=op.id', 'date(o.created_at) between "' . $start_date . '" AND "' . $end_date . '" and o.status=1 and op.status=1');

		$this->load->view('opd/opd_file_tag_print_datewise_post_next', $data);
	}

	public function opd_sample_tag_print_datewise($value = '')
	{
		$data['active'] = 'opd_sample_tag_print_datewise';
		$data['page_title'] = 'OPD Sample Tag Print Datewise';

		$this->load->view('opd/opd_sample_tag_print_datewise', $data);
	}

	public function opd_sample_tag_print_datewise_post($value = '')
	{

		$start_date = $this->input->post('start_date');

		$end_date = $this->input->post('end_date');

		redirect('admin/opd_sample_tag_print_datewise_post_next/' . $start_date . '/' . $end_date);
	}

	public function opd_sample_tag_print_datewise_post_next($start_date = '', $end_date = '')
	{

		$data["patient_order_info"] = $this->admin_model->select_join_where('*', 'opd_patient_test_order_info o', 'opd_patient_info op', 'o.patient_id=op.id', 'date(o.created_at) between "' . $start_date . '" AND "' . $end_date . '" and o.status=1 and op.status=1');

		$this->load->view('opd/opd_sample_tag_print_datewise_post_next', $data);
	}


	public function opd_sample_tag_print_selective($value = '')
	{
		$data['active'] = 'opd_sample_tag_print_selective';
		$data['page_title'] = 'OPD Sample Tag Print';


		$data["opd_test_order_info"] = $this->admin_model->select_with_where2('*', 'status=1', 'opd_patient_test_order_info');

		$this->load->view('opd/opd_sample_tag_print_selective', $data);
	}

	public function opd_sample_tag_print_selective_print($value = '')
	{
		$data['active'] = 'opd_sample_tag_print_selective_print';
		$data['page_title'] = 'OPD Sample Tag Print';

		$id_list = implode('_', $this->input->post('id_list'));

		// "<pre>";print_r($id_list);die();

		$data["patient_order_info"] = $this->admin_model->select_join_where_sample_tag('*', 'opd_patient_test_order_info o', 'opd_patient_info op', 'o.patient_id=op.id', 'o.status=1 and op.status=1', $id_list);

		// "<pre>";print_r($data["patient_order_info"]);die();


		redirect('admin/opd_sample_tag_print_selective_print_next/' . $id_list);
	}

	public function opd_sample_tag_print_selective_print_next($id_list = '')
	{

		$id_list = explode('_', $id_list);

		$data["patient_order_info"] = $this->admin_model->select_join_where_sample_tag('*', 'opd_patient_test_order_info o', 'opd_patient_info op', 'o.patient_id=op.id', 'o.status=1 and op.status=1', $id_list);

		// "<pre>";print_r($data["patient_order_info"]);die();

		$this->load->view('opd/opd_sample_tag_print_datewise_post_next', $data);
	}

	public function opd_file_tag_print_selective($value = '')
	{
		$data['active'] = 'opd_file_tag_print_selective';
		$data['page_title'] = 'OPD File Tag Print';


		$data["opd_test_order_info"] = $this->admin_model->select_with_where2('*', 'status=1', 'opd_patient_test_order_info');

		$this->load->view('opd/opd_file_tag_print_selective', $data);
	}


	public function opd_file_tag_print_selective_print($value = '')
	{
		$data['active'] = 'opd_file_tag_print_selective_print';
		$data['page_title'] = 'OPD File Tag Print';

		$id_list = implode('_', $this->input->post('id_list'));

		// "<pre>";print_r($id_list);die();

		$data["patient_order_info"] = $this->admin_model->select_join_where_sample_tag('*', 'opd_patient_test_order_info o', 'opd_patient_info op', 'o.patient_id=op.id', 'o.status=1 and op.status=1', $id_list);

		// "<pre>";print_r($data["patient_order_info"]);die();


		redirect('admin/opd_file_tag_print_selective_print_next/' . $id_list);
	}

	public function opd_file_tag_print_selective_print_next($id_list = '')
	{

		$id_list = explode('_', $id_list);

		$data["patient_order_info"] = $this->admin_model->select_join_where_sample_tag('*', 'opd_patient_test_order_info o', 'opd_patient_info op', 'o.patient_id=op.id', 'o.status=1 and op.status=1', $id_list);

		// "<pre>";print_r($data["patient_order_info"]);die();

		$this->load->view('opd/opd_file_tag_print_datewise_post_next', $data);
	}


	public function additional_test_list($value = '')
	{
		$data['active'] = 'marketing_officer_wise_collection';
		$data['page_title'] = 'Marketing Officer Wise Collection';

		$data["additional_test_list"] = $this->admin_model->get_all_additional_test_comma_join();

		$this->load->view('opd/additional_test_list', $data);
	}


	public function add_additional_test($value = '')
	{
		$data['active'] = 'add_additional_test';
		$data['page_title'] = 'Add Additional Test';

		$data['test_group'] = $this->admin_model->select_with_where2('*', 'status=1', 'diagnostic_test_group');

		$this->load->view('opd/add_additional_test', $data);
	}

	public function add_additional_test_post($value = '')
	{
		$data = array(
			'sub_test_title' => $this->input->post('additional_test_name'),
			'price' => $this->input->post('price'),
			'group_id' => implode(',', $this->input->post('add_test_group')),
			'type' => 2
		);

		$this->admin_model->insert_ret('diagnostic_test_subgroup', $data);

		redirect('admin/additional_test_list');
	}

	public function delete_additional_test($sub_test_id = '')
	{
		$data['status'] = 2;
		$this->admin_model->update_function2('id="' . $sub_test_id . '"', 'diagnostic_test_subgroup', $data);

		redirect('admin/additional_test_list');
	}


	public function edit_additional_test($additional_test_id = '')
	{

		$data['active'] = 'edit_additional_test';
		$data['page_title'] = 'Edit Additional Test';

		$data['additional_test_det'] = $this->admin_model->select_with_where2('*', 'status=1 and type=2 and id="' . $additional_test_id . '"', 'diagnostic_test_subgroup');

		$data['test_group'] = $this->admin_model->select_with_where2('*', 'status=1', 'diagnostic_test_group');

		$this->load->view('opd/edit_additional_test', $data);
	}

	public function edit_additional_test_post($additional_test_id = '')
	{

		$data = array(
			'sub_test_title' => $this->input->post('additional_test_name'),
			'price' => $this->input->post('price'),
			'group_id' => implode(',', $this->input->post('add_test_group')),
			'type' => 2
		);

		$this->admin_model->update_function2('id="' . $additional_test_id . '"', 'diagnostic_test_subgroup', $data);

		redirect('admin/additional_test_list');
	}


	public function get_all_appointment_id_info()
	{
		$data = $this->admin_model->select_join_where('*', 'local_patient_info l', 'doc_appointment d', 'l.id=d.appointed_p_id', 'd.appointment_status=1', 'local_patient_info');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function get_all_appointment_id_info_selected()
	{
		$data = $this->admin_model->select_join_where('*', 'local_patient_info l', 'doc_appointment d', 'l.id=d.appointed_p_id', 'd.appointment_status=1 and d.id="' . $_POST['appointment_patient_id'] . '"', 'local_patient_info');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}


	public function marketing_officer_wise_collection($value = '')
	{
		$data['active'] = 'marketing_officer_wise_collection';
		$data['page_title'] = 'Marketing Officer Wise Collection';

		$data["marketing_officer_info"] = $this->admin_model->select_with_where2('*', 'status=1', 'marketing_officer');

		$this->load->view('opd/marketing_officer_wise_collection', $data);
	}


	public function marketing_officer_wise_collection_date_wise()
	{

		$start_date = $this->input->post('start_date');

		$end_date = $this->input->post('end_date');

		$marketing_officer_id = $this->input->post('marketing_officer_id');


		redirect('admin/marketing_officer_wise_collection_date_wise_next/' . $start_date . '/' . $end_date . '/' . $marketing_officer_id);
	}


	public function marketing_officer_wise_collection_date_wise_next($start_date, $end_date, $marketing_officer_id)
	{


		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		if ($marketing_officer_id == "all") {

			$data['flag'] = "all";

			$data["marketing_officer_info"] = $this->admin_model->select_with_where2('*', 'status=1', 'marketing_officer');

			$data["marketing_officer_wise_info"] = $this->admin_model->select_five_join_where('*,d.created_at, d.operator_name,d.operator_id', 'opd_patient_info o', 'due_collection d', 'opd_patient_test_order_info op', 'doctor do', 'marketing_officer m', 'o.id=d.patient_id', 'op.test_order_id=d.order_id', 'op.quack_doc_id=do.doctor_id', 'do.marketing_officer_id=m.id', 'date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '" AND d.due_type=1 and d.status=1 and op.status=1');
		} else {

			$data['flag'] = "individual";

			$data["marketing_officer_wise_info"] = $this->admin_model->select_five_join_where('*,d.created_at, d.operator_name,d.operator_id', 'opd_patient_info o', 'due_collection d', 'opd_patient_test_order_info op', 'doctor do', 'marketing_officer m', 'o.id=d.patient_id', 'op.test_order_id=d.order_id', 'op.quack_doc_id=do.doctor_id', 'do.marketing_officer_id=m.id', 'date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '" AND d.due_type=1 and m.id="' . $marketing_officer_id . '" and d.status=1 and op.status=1');
		}





		$this->load->view('opd/marketing_officer_wise_collection_report', $data);
	}

	public function check_opd_test_info($value = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'OPD Registration';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['test_info'] = $this->get_all_test_and_subtest();


		$this->load->view('opd/check_opd_test_info', $data);
	}

	public function all_test_cart_info($value = '')
	{
		$data['quack_doc_id'] = $this->input->post('doc_id');
		$data['test_info'] = $this->get_all_test_and_subtest();
		$data['discount_commission_type'] = $this->admin_model->select_all('discount_commission_type');
		$this->cart->destroy();
		$this->load->view('opd/all_test_cart_info', $data);
	}

	public function opd_registration($order_id = "", $patient_id = "", $is_ipd_patient = "")
	{
		$data['order_id'] = "";
		$data['patient_id'] = "";
		$data['is_ipd_patient'] = "";

		if ($order_id != "" && $patient_id != "" && $is_ipd_patient != "") {
			$data['order_id'] = $order_id;
			$data['patient_id'] = $patient_id;
			$data['is_ipd_patient'] = $is_ipd_patient;
		}


		$data['active'] = 'opd';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['total_additional_test'] = 0;


		$data['page_title'] = 'OPD Registration';
		$this->form_validation->set_error_delimiters('<div>', '</div>');

		//Validating Name Field
		$this->form_validation->set_rules('patient_name', 'Patient Name', 'required');
		$this->form_validation->set_rules('quack_doc_name', 'Quack Doctor Name', 'required');

		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');



		// $this->form_validation->set_rules('patient_address', 'Patient Address', 'required');
		// $this->form_validation->set_rules('age', 'Age', 'required');
		// $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'required');
		// $this->form_validation->set_rules('gender', 'Gender', 'required');
		// $this->form_validation->set_rules('blood_group', 'Blood Group', 'required');
		// $this->form_validation->set_rules('patient_mobile_no', 'Patient Mobile No', 'required');
		// $this->form_validation->set_rules('operator_name', 'Operator Name', 'required');



		if ($this->form_validation->run() == FALSE) {
			$data['test_info'] = $this->get_all_test_and_subtest();
			$data['quack_doc_id'] = 0;
			$this->cart->destroy();
			$data['discount_commission_type'] = $this->admin_model->select_all('discount_commission_type');
			$this->load->view('opd/opd_patient_info', $data);
		}
	}

	public function add()
	{
		$login_id = $this->session->userdata['logged_in']['id'];

		$user_info = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $login_id . '"', 'login');


		$discount_percent = $user_info[0]['discount_percent'];
		$discount_amount = $user_info[0]['discount_amount'];

		$data['total_additional_test'] = 0;

		$cart = $this->cart->contents();

		foreach ($cart as $item) {
			if ($item['options']['type'] == 2) {
				$data['total_additional_test'] += 1;
			}
		}

		foreach ($cart as $item) {
			if ($item['id'] == $_POST["sub_test_id"]) {
				$this->load->view('opd/test_cart_details', $data);
				return; //return rowid 
			}
		}

		// $total_quk_ref=$total_quk_ref+$_POST["quk_ref_com"];

		$data = array(
			"id"  => $_POST["sub_test_id"],
			"name"  => $_POST["test_name"],
			"qty"  => 1,
			"price"  => $_POST["test_price"],
			"options" => array("quk_ref_com" => $_POST["quk_ref_com"], "type" => $_POST["type"], "discount_amount" => $discount_amount, "discount_percent" => $discount_percent)
		);

		$this->cart->insert($data);

		$data['group_id'] = $this->admin_model->select_with_where2('*', 'id="' . $_POST['sub_test_id'] . '"', 'diagnostic_test_subgroup');

		$data['all_additional_test'] = $this->admin_model->select_with_where2('*', 'type=2 and status=1', 'diagnostic_test_subgroup');

		$rowid = "";
		$flag = 0;
		$data3 = array();

		foreach ($data['all_additional_test'] as $key => $value) {

			if (in_array($data['group_id'][0]['mtest_id'], explode(',', $value['group_id']))) {

				$data1 = array(
					"id"  => $value['id'],
					"name"  => $value['sub_test_title'],
					"qty"  => 1,
					"price"  => $value["price"],
					"options" => array("type" => $value["type"], "quk_ref_com" => 0, "discount_amount" => $discount_amount, "discount_percent" => $discount_percent)
				);

				$this->cart->insert($data1);

				$data['total_additional_test'] = 0;

				foreach ($this->cart->contents() as $key => $value1) {

					if ($value1['options']['type'] == 2) {
						$data['total_additional_test'] = $data['total_additional_test'] + 1;

						$data3[$key]['id'] = $value1['id'];
						$data3[$key]['name'] = $value1['name'];
						$data3[$key]['qty'] = $value1['qty'];
						$data3[$key]['price'] = $value1['price'];
						$data3[$key]['options'] = array("type" => $value1['options']["type"], "quk_ref_com" => 0, "discount_amount" => $discount_amount, "discount_percent" => $discount_percent);

						$rowid = $value1['rowid'];

						$data2 = array(
							'rowid' => $rowid,
							'qty' => 0
						);
						$this->cart->update($data2);
					}
				}

				$this->cart->insert($data3);
			} else {
				$data['total_additional_test'] = 0;

				foreach ($this->cart->contents() as $key => $value1) {

					if ($value1['options']['type'] == 2) {
						$data['total_additional_test'] = $data['total_additional_test'] + 1;

						$data3[$key]['id'] = $value1['id'];
						$data3[$key]['name'] = $value1['name'];
						$data3[$key]['qty'] = $value1['qty'];
						$data3[$key]['price'] = $value1['price'];
						$data3[$key]['options'] = array("type" => $value1['options']["type"], "quk_ref_com" => 0, "discount_amount" => $discount_amount, "discount_percent" => $discount_percent);

						$rowid = $value1['rowid'];

						$data2 = array(
							'rowid' => $rowid,
							'qty' => 0
						);
						$this->cart->update($data2);
					}
				}

				$this->cart->insert($data3);
			}
		}

		foreach ($this->cart->contents() as $item1) {
			if ($item1['qty'] > 1) {
				$rowid = $item1['rowid'];
				$data4 = array(
					'rowid' => $rowid,
					'qty' => 1
				);
				$this->cart->update($data4);
			}
		}


		echo $this->load->view('opd/test_cart_details', $data);
	}




	public function add_edit_invoice()
	{
		// $data['patient_id']=$_POST['patient_id'];

		$data_add['main_test'] = 0;

		$cart = $this->cart->contents();

		foreach ($cart as $item) {

			if ($item['options']['type'] == 1) {
				$data_add['main_test'] += 1;
			}
		}

		foreach ($cart as $item) {

			if ($item['id'] == $_POST["sub_test_id"]) {
				$this->load->view('opd/opd_edit_invoice_cart_details', $data_add);
				return; //return rowid 
			}
		}

		$data['group_id'] = $this->admin_model->select_with_where2('*', 'id="' . $_POST['sub_test_id'] . '"', 'diagnostic_test_subgroup');

		$data['last_row_info'] = $this->admin_model->get_last_row3('doc_com_id', 'doc_comission_distribution', 'group_id="' . $data['group_id'][0]['mtest_id'] . '" and testid=0 and doc_id="' . $_POST['doc_id'] . '"');

		$data['last_row_info1'] = $this->admin_model->get_last_row3('doc_com_id', 'doc_comission_distribution', 'group_id="' . $data['group_id'][0]['mtest_id'] . '" and testid="' . $_POST['sub_test_id'] . '" and doc_id="' . $_POST['doc_id'] . '"');

		// echo json_encode($data['last_row_info']);
		// echo json_encode($data['last_row_info1']);


		$com = 0;

		if ($data['last_row_info'] == null && $data['last_row_info1'] != null) {
			if ($data['last_row_info1'][0]['com_type'] == 1) {
				$com = $_POST['test_price'] * ($data['last_row_info1'][0]['doc_comission'] / 100);
			} else if ($data['last_row_info1'][0]['com_type'] == 2) {
				$com = $data['last_row_info1'][0]['doc_comission'];
			}
		} else if ($data['last_row_info1'] == null && $data['last_row_info'] != null) {
			if ($data['last_row_info'][0]['com_type'] == 1) {
				$com = $_POST['test_price'] * ($data['last_row_info'][0]['doc_comission'] / 100);
			} else if ($data['last_row_info'][0]['com_type'] == 2) {
				$com = $data['last_row_info'][0]['doc_comission'];
			}
		} else if ($data['last_row_info'] != null && $data['last_row_info1'] != null) {
			if ($data['last_row_info'][0]['doc_com_id'] > $data['last_row_info1'][0]['doc_com_id']) {
				if ($data['last_row_info'][0]['com_type'] == 1) {
					$com = $_POST['test_price'] * ($data['last_row_info'][0]['doc_comission'] / 100);
				} else if ($data['last_row_info'][0]['com_type'] == 2) {
					$com = $data['last_row_info'][0]['doc_comission'];
				}
			} else {

				if ($data['last_row_info1'][0]['com_type'] == 1) {
					$com = $_POST['test_price'] * ($data['last_row_info1'][0]['doc_comission'] / 100);
				} else if ($data['last_row_info1'][0]['com_type'] == 2) {
					$com = $data['last_row_info1'][0]['doc_comission'];
				}
			}
		} else {
			$com = 0;
		}

		$per_discount = $_POST["total_discount"] / $data_add['main_test'];
		$net_amount = $_POST["test_price"] - $per_discount;
		$sub_amount = $com - $per_discount;


		$data = array(

			'id' => $_POST["sub_test_id"],
			'name' => $_POST["test_name"],
			'qty' => 1,
			'price' => $_POST["test_price"],
			"options" => array(
				"quk_ref_com" => $com,
				"discount" => $_POST["total_discount"],
				"vat" => $_POST["vat"], "paid_amount" => $_POST["total_pa"], "per_discount" => $per_discount, "net_amount" => $net_amount, "sub_com" => $sub_amount, "type" => $_POST["type"]
			)
		);

		$this->cart->insert($data);

		$data['group_id'] = $this->admin_model->select_with_where2('*', 'id="' . $_POST['sub_test_id'] . '"', 'diagnostic_test_subgroup');

		$data['all_additional_test'] = $this->admin_model->select_with_where2('*', 'type=2 and status=1', 'diagnostic_test_subgroup');

		$rowid = "";
		$flag = 0;
		$data3 = array();

		foreach ($data['all_additional_test'] as $key => $value) {

			if (in_array($data['group_id'][0]['mtest_id'], explode(',', $value['group_id']))) {

				$data1 = array(
					"id"  => $value['id'],
					"name"  => $value['sub_test_title'],
					"qty"  => 1,
					"price"  => $value["price"],
					"options" => array(
						"quk_ref_com" => 0,
						"discount" => $_POST["total_discount"],
						"vat" => 0, "paid_amount" => $_POST["total_pa"], "per_discount" => $per_discount, "net_amount" => $net_amount, "sub_com" => $sub_amount, "type" => $value['type']
					)
				);

				$this->cart->insert($data1);

				foreach ($this->cart->contents() as $key => $value1) {

					if ($value1['options']['type'] == 2) {
						$data3[$key]['id'] = $value1['id'];
						$data3[$key]['name'] = $value1['name'];
						$data3[$key]['qty'] = 1;
						$data3[$key]['price'] = $value1['price'];
						$data3[$key]['options'] = array(
							"quk_ref_com" => 0,
							"discount" => $_POST["total_discount"],
							"vat" => 0, "paid_amount" => $_POST["total_pa"], "per_discount" => 0, "net_amount" => 0, "sub_com" => 0, "type" => $value1['options']['type']
						);

						$rowid = $value1['rowid'];

						$data2 = array(
							'rowid' => $rowid,
							'qty' => 0
						);
						$this->cart->update($data2);
					}
				}

				$this->cart->insert($data3);
			} else {
				foreach ($this->cart->contents() as $key => $value1) {

					if ($value1['options']['type'] == 2) {
						$data3[$key]['id'] = $value1['id'];
						$data3[$key]['name'] = $value1['name'];
						$data3[$key]['qty'] = 1;
						$data3[$key]['price'] = $value1['price'];
						$data3[$key]['options'] = array(
							"quk_ref_com" => 0,
							"discount" => $_POST["total_discount"],
							"vat" => 0, "paid_amount" => $_POST["total_pa"], "per_discount" => 0, "net_amount" => 0, "sub_com" => 0, "type" => $value1['options']['type']
						);

						$rowid = $value1['rowid'];

						$data2 = array(
							'rowid' => $rowid,
							'qty' => 0
						);
						$this->cart->update($data2);
					}
				}

				$this->cart->insert($data3);
			}
		}

		$data_add['main_test'] = 0;

		foreach ($this->cart->contents() as $item1) {

			if ($item1['qty'] > 1) {
				$rowid = $item1['rowid'];
				$data4 = array(
					'rowid' => $rowid,
					'qty' => 1
				);
				$this->cart->update($data4);
			}



			if ($item1['options']['type'] == 1) {
				$data_add['main_test'] += 1;
			}
		}

		echo $this->load->view('opd/opd_edit_invoice_cart_details', $data_add);
	}



	public function remove_edit_invoice()
	{



		$row_id = $_POST["row_id"];
		$data = array(
			'rowid' => $row_id,
			'qty' => 0
		);
		$this->cart->update($data);

		$data_add['main_test'] = 0;

		foreach ($this->cart->contents() as $item1) {

			if ($item1['options']['type'] == 1) {
				$data_add['main_test'] += 1;
			}
		}


		$this->load->view('opd/opd_edit_invoice_cart_details', $data_add);
	}


	// public function update_price_qty()
	// {
	// 	$this->load->library("cart");
	//  	$row_id=$_POST["row_id"];
	//  	$quantity=$_POST["quantity"];
	//  	$price=$_POST["price"];

	//  	$data=array(
	//  		'rowid' => $row_id,
	//  		'qty'=> $quantity,
	//  		 'price'=> $price  );
	//  	$this->cart->update($data);
	//  	$this->load->view('test_cart_details');
	// }



	public function remove()
	{
		$row_id = $_POST["row_id"];
		$data = array(
			'rowid' => $row_id,
			'qty' => 0
		);
		$this->cart->update($data);
		$this->load->view('opd/test_cart_details');
	}



	public function update_opd_order_data($value = '')
	{


		$cart = $this->cart->contents();


		$login_id = $this->session->userdata['logged_in']['id'];
		$order_id = $this->input->post('bill_no');
		$long_order_id = $this->input->post('long_order_id');

		// "<pre>";print_r($long_order_id);die();

		// insert into opd_test_order_histroy start

		$val = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $order_id . '"', 'opd_patient_test_order_info');

		$val1 = $this->admin_model->select_with_where2('*', 'id="' . $val[0]['patient_id'] . '"', 'opd_patient_info');

		// "<pre>";print_r($val);die();

		foreach ($val as $key => $value) {

			$opd_data['patient_id'] = $value['patient_id'];

			$opd_data['patient_name'] = $val1[0]['patient_name'];
			$opd_data['mobile_no'] = $val1[0]['mobile_no'];

			$opd_data['parent_order_id'] = $order_id;

			$opd_data['vat'] = $value['vat'];

			$opd_data['test_order_id'] = $value['test_order_id'];

			$opd_data['total_discount'] = $value['total_discount'];
			$opd_data['quack_doc_id'] = $value['quack_doc_id'];
			$opd_data['ref_doc_id'] = $value['ref_doc_id'];

			$opd_data['total_amount'] = $value['total_amount'];

			$opd_data['paid_amount'] = $value['paid_amount'];
			$opd_data['deleted_at'] = $value['deleted_at'];
			$opd_data['delete_reason_text'] = $value['delete_reason_text'];

			$opd_data['status'] = 1;
			$opd_data['created_at'] = date('Y-m-d H:i:s');
			$opd_data['reason'] = 1;


			$order_history_id = $this->admin_model->insert_ret('opd_patient_test_order_info_history', $opd_data);
		}

		//  end


		// insert into opd_test_order_details_histroy start

		$val4 = $this->admin_model->select_with_where2('*', 'patient_test_order_id="' . $order_id . '"', 'opd_patient_test_details_info');

		foreach ($val4 as $key => $value) {

			$sd_data['patient_test_order_id'] = $order_history_id;
			$sd_data['patient_sub_test_id'] = $value['patient_sub_test_id'];
			$sd_data['sub_test_price'] = $value['sub_test_price'];
			$sd_data['discount'] = $value['discount'];
			$sd_data['status'] = 1;
			$sd_data['created_at'] = date('Y-m-d H:i:s');
			$sd_data['reason'] = 1;

			$this->admin_model->insert('opd_patient_test_details_info_history', $sd_data);
		}

		// end


		$val2 = $this->admin_model->select_with_where2('*', 'order_id="' . $order_id . '"', 'doc_commission');

		$val3 = $this->admin_model->select_with_where2('*', 'com_id="' . $val2[0]['id'] . '"', 'doc_commission_details');



		// insert into doc_commission history Start

		foreach ($val2 as $key => $value) {

			$co_data['order_id'] = $value['order_id'];
			$co_data['total_commission'] = $value['total_commission'];

			$co_data['total_test_amount'] = $value['total_test_amount'];
			$co_data['total_test_discount'] = $value['total_test_discount'];
			$co_data['total_vat'] = $value['total_vat'];
			$co_data['operator_name'] = $value['operator_name'];
			$co_data['paid_amount'] = $value['paid_amount'];
			$co_data['created_at'] = $value['created_at'];
			$co_data['patient_id'] = $value['patient_id'];

			$co_data['doc_name'] = $value['doc_name'];
			$co_data['doc_id'] = $value['doc_id'];
			$co_data['doc_type'] = $value['doc_type'];
			$co_data['reason'] = 1;

			$order_history_id = $this->admin_model->insert_ret('doc_commission_history', $co_data);
		}

		// end



		// insert into doc_commission_details history Start

		foreach ($val3 as $key => $value) {


			$co_data1['patient_id'] = $value['patient_id'];

			$co_data1['com_id'] = $value['com_id'];
			$co_data1['doc_type'] = $value['doc_type'];
			$co_data1['patient_type'] = $value['patient_type'];
			$co_data1['doc_title'] = $value['doc_title'];
			$co_data1['service_type'] = $value['service_type'];
			$co_data1['service_id'] = $value['service_id'];
			$co_data1['amount'] = $value['amount'];
			$co_data1['created_at'] = $value['created_at'];
			$co_data1['reason'] = 1;

			$order_history_id = $this->admin_model->insert_ret('doc_commission_details_history', $co_data1);
		}

		// end

		// insert into due colletion history table

		$due_col_old_info = $this->admin_model->select_with_where2('*', 'order_id="' . $long_order_id . '" ', 'due_collection');

		// "<pre>";print_r($due_col_old_info);die();


		foreach ($due_col_old_info as $key => $value) {


			$due_col_data['order_id'] = $value['order_id'];

			$due_col_data['patient_id'] = $value['patient_id'];
			$due_col_data['total_amount'] = $value['total_amount'];
			$due_col_data['discount'] = $value['discount'];
			$due_col_data['vat'] = $value['vat'];
			$due_col_data['current_due'] = $value['current_due'];
			$due_col_data['paid_due'] = $value['paid_due'];
			$due_col_data['advance_payment'] = $value['advance_payment'];
			$due_col_data['admission_fee'] = $value['admission_fee'];
			$due_col_data['admission_fee_paid'] = $value['admission_fee_paid'];
			$due_col_data['admission_fee_discount'] = $value['admission_fee_discount'];
			$due_col_data['admission_fee_discount'] = $value['admission_fee_discount'];
			$due_col_data['discount_ref'] = $value['discount_ref'];
			$due_col_data['old_due'] = $value['old_due'];
			$due_col_data['status'] = $value['status'];
			$due_col_data['created_at'] = $value['created_at'];
			$due_col_data['operator_name'] = $value['operator_name'];
			$due_col_data['operator_id'] = $value['operator_id'];
			$due_col_data['table_created_at'] = date('Y-m-d h:i:s');
			$due_col_data['reason'] = 1;


			$due_history_id = $this->admin_model->insert_ret('due_collection_history', $due_col_data);
		}


		// end


		$discount_commission_type = $this->admin_model->select_all('discount_commission_type');

		// delete from multi result table


		$this->admin_model->delete_function_cond('multi_result', 'order_id="' . $order_id . '"');

		// set product id zero whose are deleted


		$all_delete_t_id = explode('_', $this->input->post('delete_t_id_list'));

		for ($i = 1; $i < count($all_delete_t_id); $i++) {




			$this->admin_model->delete_function_cond('opd_patient_test_details_info', 'patient_test_order_id="' . $order_id . '" AND patient_sub_test_id="' . $all_delete_t_id[$i] . '"');

			$this->admin_model->delete_function_cond('doc_commission_details', 'com_id="' . $val2[0]['id'] . '" AND service_id="' . $all_delete_t_id[$i] . '"');

			// delete from pathology

			$this->admin_model->delete_function_cond('pathologoy', 'order_id="' . $order_id . '" AND test_id="' . $all_delete_t_id[$i] . '"');
		}



		// update opd patient info table

		$val_t_o = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $order_id . '"', 'opd_patient_test_order_info');

		$val_p = $this->admin_model->select_with_where2('*', 'id="' . $val1[0]['id'] . '"', 'opd_patient_info');

		if ($this->input->post('vat') == "") {
			$vat = 0;
		} else {
			$vat = $this->input->post('vat');
		}

		if ($this->input->post('discount') == "") {
			$discount = 0;
		} else {
			$discount = $this->input->post('discount');
		}

		if ($this->input->post('total') == "") {
			$total_amount = 0;
		} else {
			$total_amount = $this->input->post('total');
		}

		if ($this->input->post('total_paid') == "") {
			$paid_amount = 0;
		} else {
			$paid_amount = $this->input->post('total_paid');
		}


		$data_exp_ref = explode('#', $this->input->post('ref_doc_name'));
		$data_exp_quack = explode('#', $this->input->post('quack_doc_name'));




		$p_data = array(
			'total_bill' => $val_p[0]['total_bill'] + $total_amount - $val_t_o[0]['total_amount'],
			'total_paid' => $val_p[0]['total_paid'] + $paid_amount - $val_t_o[0]['paid_amount'],
			'total_discount_p' => $val_p[0]['total_discount_p'] + $discount - $val_t_o[0]['total_discount'],
			'total_vat_p' => $val_p[0]['total_vat_p'] + $vat - $val_t_o[0]['vat']
		);


		$p_data['ref_doctor_name'] = $data_exp_ref[1];

		$p_data['quack_doc_name'] = $data_exp_quack[1];


		$p_data['ref_doctor_id'] = $data_exp_ref[0];

		$p_data['quack_doc_id'] = $data_exp_quack[0];

		$p_data['operator_name'] = $this->session->userdata['logged_in']['username'];

		$p_data['operator_id'] = $this->session->userdata['logged_in']['id'];

		$this->admin_model->update_function2('id="' . $val1[0]['id'] . '"', 'opd_patient_info', $p_data);

		// end



		// update test order table

		$order_data1['total_amount'] = $this->input->post('total');
		$order_data1['paid_amount'] = $this->input->post('total_paid');
		$order_data1['total_discount'] = $this->input->post('discount');
		$order_data1['vat'] = $this->input->post('vat');

		// "<pre>";print_r($this->input->post('ref_doc_name'));die();


		$order_data1['ref_doc_id'] = $data_exp_ref[0];
		$order_data1['quack_doc_id'] = $data_exp_quack[0];

		$order_data1['ref_doc_name'] = $data_exp_ref[1];
		$order_data1['quack_doc_name'] = $data_exp_quack[1];

		$order_data1['operator_name'] = $this->session->userdata['logged_in']['username'];
		$order_data1['operator_id'] = $this->session->userdata['logged_in']['id'];



		if ($this->input->post('due') == 0) {
			$order_data1['payment_status'] = "paid";
		} else {
			$order_data1['payment_status'] = "unpaid";
		}

		$order_data1['updated_at'] = date('Y-m-d H:i:s');

		$order_data1['discount_ref'] = $this->input->post('discount_ref');;

		$this->admin_model->update_function2('id="' . $order_id . '"', 'opd_patient_test_order_info', $order_data1);

		// end


		// update Doc Commission table

		// "<pre>";print_r($this->input->post('discount'));die();

		if ($discount_commission_type[0]['type'] == 2) {
			$dis = $this->input->post('discount') / 2;

			$com_data['discount_commission_type'] = 2;
		} else {
			$dis = $this->input->post('discount');
			$com_data['discount_commission_type'] = 1;
		}

		$com_data['total_commission'] = (float)$this->input->post('total_c_o') - (float)$dis;
		$com_data['total_gross_com'] = $this->input->post('total_c_o');
		$com_data['total_test_amount'] = $this->input->post('total');
		$com_data['total_test_discount'] = $dis;
		$com_data['total_vat'] = $this->input->post('vat');


		$com_data['doc_id'] = $data_exp_quack[0];

		$com_data['doc_type'] = 2;

		$com_data['doc_name'] = $data_exp_quack[1];

		$com_data['doc_name'] = $data_exp_quack[1];
		$com_data['doc_name'] = $data_exp_quack[1];

		$com_data['operator_name'] = $this->session->userdata['logged_in']['username'];

		$com_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$com_data['updated_at'] = date('Y-m-d H:i:s');




		$this->admin_model->update_function2('order_id="' . $order_id . '"', 'doc_commission', $com_data);

		// end



		//update order details table  start ///

		$cart = $this->cart->contents();

		$cart_count = 0;

		foreach ($cart as $key => $value) {

			if ($value['options']['type'] != 2) {
				$cart_count = $cart_count + 1;
			}
		}



		$com_reduction_each = round($dis / $cart_count, 2);

		foreach ($cart as $key => $value) {


			if (($this->admin_model->check_row('*', 'patient_test_order_id="' . $order_id . '" AND patient_sub_test_id="' . $value['id'] . '"', 'opd_patient_test_details_info')) == false) {
				$sd_data['patient_test_order_id'] = $order_id;
				$sd_data['patient_sub_test_id'] = $value['id'];
				$sd_data['sub_test_price'] = $value['price'];
				$sd_data['type'] = $value['options']['type'];

				$sd_data['status'] = 1;
				$sd_data['created_at'] = date('Y-m-d H:i:s');

				$this->admin_model->insert('opd_patient_test_details_info', $sd_data);
			}

			if (($this->admin_model->check_row('*', 'order_id="' . $order_id . '" AND test_id="' . $value['id'] . '"', 'pathologoy')) == false && $value['options']['type'] != 2) {


				// insert into pathology

				$patient_sub_test_id = $value['id'];
				$test_group_id = $this->admin_model->select_with_where2('*', 'id="' . $patient_sub_test_id . '"', 'diagnostic_test_subgroup');

				$datam = array(

					'patient_id' => $val1[0]['id'],
					'pdate' => date('Y-m-d'),
					'order_id' => $order_id,
					'padate' => date('Y-m-d H:i:s'),
					'test_id' => $patient_sub_test_id,
					'group_id' => $test_group_id[0]['mtest_id'],

				);

				$this->load->admin_model->insert_ret('pathologoy', $datam);

				// end




				// update doc comission details table Starts

				if (($this->admin_model->check_row('*', 'com_id="' . $val2[0]['id'] . '" AND service_id="' . $value['id'] . '"', 'doc_commission_details')) == false) {

					$sd_data1['com_id'] = $val2[0]['id'];
					$sd_data1['service_id'] = $value['id'];
					$sd_data1['amount'] = $value['options']['quk_ref_com'] - $com_reduction_each;
					$sd_data1['gross_amount'] = $value['options']['quk_ref_com'];
					$sd_data1['sub_amount'] = $com_reduction_each;

					$sd_data1['service_type'] = 1;
					$sd_data1['patient_id'] = $val1[0]['id'];
					$sd_data1['created_at'] = date('Y-m-d H:i:s');

					$this->admin_model->insert('doc_commission_details', $sd_data1);
				} else {
					$data1['amount'] = $value['options']['quk_ref_com'] - $com_reduction_each;
					$data1['gross_amount'] = $value['options']['quk_ref_com'];

					$data1['sub_amount'] = $com_reduction_each;

					// "<pre>";print_r($val2[0]['id'].'  '.$value['id']);

					$this->load->admin_model->update_function2('com_id="' . $val2[0]['id'] . '" AND service_id="' . $value['id'] . '"', 'doc_commission_details', $data1);
				}


				// update doc comission details table Ends

			}
		}




		// update due collection table

		$due_data['status'] = 2;

		$this->admin_model->update_function2('order_id="' . $val[0]['test_order_id'] . '" and due_type=1', 'due_collection', $due_data);

		// update commission payment table

		$this->admin_model->update_function2('com_id="' . $val2[0]['id'] . '"', 'commission_payment', $due_data);


		// insert data into due collection table

		$this->admin_model->delete_function_cond('due_collection', 'order_id="' . $long_order_id . '" AND due_type=1');

		$d_data['old_due'] = $this->input->post('total');
		$d_data['order_id'] = $val[0]['test_order_id'];
		$d_data['total_amount'] = $this->input->post('total');
		$d_data['patient_id'] = $val[0]['patient_id'];
		$d_data['vat'] = $this->input->post('vat');
		$d_data['discount'] = $this->input->post('discount');
		$d_data['current_due'] = $this->input->post('due');
		$d_data['paid_due'] = $this->input->post('total_paid');
		$d_data['created_at'] = $due_col_old_info[0]['created_at'];
		$d_data['discount_ref'] = $this->input->post('discount_ref');
		$d_data['due_type'] = 1;
		$d_data['status'] = 1;

		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];

		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];

		$this->load->admin_model->insert('due_collection', $d_data);

		// end


		// insert data into commission payment

		$data = array(
			'current_com' => $this->input->post('discount'),
			'gross_com' => $this->input->post('discount'),
			'sub_com' => $_POST['total_c_o'],
			'old_com' => $_POST['total_c_o'],
			'com_id' => $val2[0]['id'],
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],
			'created_at' => date('Y-m-d H:i:s'),
			'patient_id' => $val[0]['patient_id'],
			'status' => 1

		);

		// end

		$this->load->admin_model->insert('commission_payment', $data);


		$this->cart->destroy();

		redirect('admin/opd_all_billing_info', 'refresh');
	}


	public function save_test_order_info()
	{

		$discount_commission_type = $this->admin_model->select_all('discount_commission_type');

		if ($this->input->post('ipd_patient_id') != "") {
			$is_ipd_patient = 1;
		} else {
			$is_ipd_patient = 0;
		}

		// opd reg start

		$age = "";

		$Day = $this->input->post('Day');
		$Month = $this->input->post('Month');
		$Year = $this->input->post('Year');

		
		if (($Day != 0) and ($Month != 0) and ($Year != 0)) {
			$age = $Day . " D " . $Month . " M " . $Year . " Y";
		} elseif (($Day == 0) and ($Month != 0) and ($Year != 0)) {
			$age = $Year . " Y " . $Month . " M";
		} elseif (($Day != 0) and ($Month == 0) and ($Year != 0)) {
			$age = $Day . " D " . $Year . " Y";
		} elseif (($Day != 0) and ($Month != 0) and ($Year == 0)) {
			$age = $Day . " D " . $Month . " M";
		} elseif (($Day == 0) and ($Month == 0) and ($Year != 0)) {
			$age = $Year . " Y";
		} elseif (($Day == 0) and ($Month != 0) and ($Year == 0)) {
			$age = $Month . " M";
		} elseif (($Day != 0) and ($Month == 0) and ($Year == 0)) {
			$age = $Day . " D";
		} else {
			// $age="0 D 0 M 0 Y";
			$age = "";
		}


		if ($this->input->post('mobile_no') == "") {
			$mobile_no = "none";
		} else {
			$mobile_no = $this->input->post('mobile_no');
		}


		$ref_doc_name = explode('#', $this->input->post('ref_doc_name'));

		$quack_doc_name = explode('#', $this->input->post('quack_doc_name'));

		$last_patient_info_id = $this->admin_model->get_last_row3('patient_info_id', 'opd_patient_info', 'status=1');

		// "<pre>";print_r($last_patient_info_id);die();

		if ($last_patient_info_id == null) {
			$patient_info_id = 1;
		} else {
			$patient_info_id = $last_patient_info_id[0]['patient_info_id'] + 1;
		}

		// "<pre>";print_r($this->input->post('date_of_birth'));die();

		$data = array(
			'patient_name' => $this->input->post('patient_name'),
			'ref_doctor_name' => $ref_doc_name[0],
			'quack_doc_name' => $quack_doc_name[0],
			'ref_doctor_id' => $ref_doc_name[1],
			'address' => $this->input->post('patient_address'),
			'age' => $age,
			'patient_info_id' => $patient_info_id,
			'date_of_birth' => $this->input->post('date_of_birth'),
			'gender' => $this->input->post('gender'),
			// 'blood_group' => $this->input->post('blood_group'),
			'mobile_no' => $mobile_no,
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],
			'hospital_id' => $this->session->userdata['logged_in']['hospital_id'],
			'created_at' => date('Y-m-d H:i:s'),
			'quack_doc_id' => $quack_doc_name[1]

		);



		if ($this->input->post('already_reg_p') == "" && $this->input->post('ipd_patient_id') == "" && $this->input->post('uhid_patient_id') == "") {

			$patient_id = $this->load->admin_model->insert_ret('opd_patient_info', $data);

			$data['profile_img'] = "default_img";

			if ($this->input->post('file_count') > 0) {
				if ($_FILES['file']['name']) {
					$name_generator = $this->name_generator($_FILES['file']['name'], $patient_id);
					$i_ext = explode('.', $_FILES['file']['name']);
					$target_path = $name_generator . '.' . end($i_ext);;
					$size = getimagesize($_FILES['file']['tmp_name']);

					if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/patient_image/' . $target_path)) {
						$data['profile_img'] = $target_path;
					}

					$p_info_id = array('profile_img' => $data['profile_img']);
					$this->load->admin_model->update_function('id', $patient_id, 'opd_patient_info', $p_info_id);
				}
			}
		} else if ($this->input->post('already_reg_p') == "" && $this->input->post('ipd_patient_id') != "") {

			$is_exist_ipd_patient = $this->load->admin_model->select_with_where2('*', 'status=1 and ipd_patient_id ="' . $this->input->post('ipd_patient_id') . '" ', 'opd_patient_test_order_info');



			if (count($is_exist_ipd_patient) < 1) {
				$patient_id = $this->load->admin_model->insert_ret('opd_patient_info', $data);

				$data['profile_img'] = "default_img";

				if ($this->input->post('file_count') > 0) {

					if ($_FILES['file']['name']) {
						$name_generator = $this->name_generator($_FILES['file']['name'], $patient_id);
						$i_ext = explode('.', $_FILES['file']['name']);
						$target_path = $name_generator . '.' . end($i_ext);;
						$size = getimagesize($_FILES['file']['tmp_name']);

						if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/patient_image/' . $target_path)) {
							$data['profile_img'] = $target_path;
						}
					}


					$patient_info_id = $patient_id;

					$p_info_id = array(
						'patient_info_id' => $patient_info_id,
						'profile_img' => $data['profile_img']
					);

					$this->load->admin_model->update_function('id', $patient_id, 'opd_patient_info', $p_info_id);
				}

				// $data['patient_id']=$patient_id;
			} else {
				$patient_id = $is_exist_ipd_patient[0]['patient_id'];
			}
		} else if ($this->input->post('already_reg_p') == "" && $this->input->post('uhid_patient_id') != "") {

			$is_exist_uhid_patient = $this->load->admin_model->select_with_where2('*', 'status=1 and uhid ="' . $this->input->post('uhid_patient_id') . '" ', 'opd_patient_test_order_info');

			// "<pre>";print_r($is_exist_uhid_patient);die();

			if (count($is_exist_uhid_patient) < 1) {
				$patient_id = $this->load->admin_model->insert_ret('opd_patient_info', $data);

				$data['profile_img'] = "default_img";

				if ($this->input->post('file_count') > 0) {

					if ($_FILES['file']['name']) {
						$name_generator = $this->name_generator($_FILES['file']['name'], $patient_id);
						$i_ext = explode('.', $_FILES['file']['name']);
						$target_path = $name_generator . '.' . end($i_ext);;
						$size = getimagesize($_FILES['file']['tmp_name']);

						if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/patient_image/' . $target_path)) {
							$data['profile_img'] = $target_path;
						}
					}


					$patient_info_id = $patient_id;

					$p_info_id = array(
						'patient_info_id' => $patient_info_id,
						'profile_img' => $data['profile_img']
					);

					$this->load->admin_model->update_function('id', $patient_id, 'opd_patient_info', $p_info_id);
				}

				// $data['patient_id']=$patient_id;
			} else {
				$patient_id = $is_exist_uhid_patient[0]['patient_id'];
			}
		} else {

			$patient_id = $this->input->post('already_reg_p');
		}


		// opd reg end

		// insert data into opd patient test order table

		if ($_POST["vat"] == "") {
			$vat = 0;
		} else {
			$vat = $_POST["vat"];
		}

		if ($_POST["total_discount"] == "") {
			$discount = 0;
		} else {
			$discount = $_POST["total_discount"];
		}

		if ($_POST['total_amount'] == "") {
			$total_amount = 0;
		} else {
			$total_amount = $_POST['total_amount'];
		}

		if ($_POST['paid_amount'] == "") {
			$paid_amount = 0;
		} else {
			$paid_amount = $_POST['paid_amount'];
		}

		if ($_POST['discount_ref'] == "") {
			$discount_ref = "";
		} else {
			$discount_ref = $_POST['discount_ref'];
		}


		//echo $_POST['total_amount'];die();

		if ((float)$_POST["paid_amount"] >= (float)$_POST["net_total"]) {
			$payment_status = "paid";
		} else {
			$payment_status = "unpaid";
		}

		if (isset($_POST['ipd_patient_id'])) {
			$ipd_patient_id = $_POST['ipd_patient_id'];
		} else {
			$ipd_patient_id = 0;
		}


		if (isset($_POST['uhid_patient_id'])) {
			$uhid_patient_id = $_POST['uhid_patient_id'];
		} else {
			$uhid_patient_id = 0;
		}


		$data = array(
			'patient_id' => $patient_id,
			'age' => $age,
			'total_discount' => (float)$discount,
			'vat' => (float)$vat,
			'ref_doc_id' => $ref_doc_name[1],
			'quack_doc_id' => $quack_doc_name[1],

			'ref_doc_name' => $ref_doc_name[0],
			'quack_doc_name' => $quack_doc_name[0],

			'total_amount' => (float)str_replace(',', '', $total_amount),
			'paid_amount' => (float)str_replace(',', '', $paid_amount),
			'payment_status' => $payment_status,
			'created_at' => date('Y-m-d H:i:s'),
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],
			'discount_ref' => $discount_ref,
			'is_ipd_patient' => $is_ipd_patient,
			'ipd_patient_id' => $ipd_patient_id,
			'uhid' => $uhid_patient_id,
			'entry_date' => date('Y-m-d'),
			'status' => 1
		);
		$order_id = $this->load->admin_model->insert_ret('opd_patient_test_order_info', $data);



		$p_id = sprintf("%'.06d", ($order_id));

		$test_order_id = $p_id . '_' . date('dmy') . '_' . $patient_id;

		$data['test_order_id'] = $test_order_id;

		$this->load->admin_model->update_function('id', $order_id, 'opd_patient_test_order_info', $data);

		// update payment in opd patien info

		$val = $this->load->admin_model->select_with_where2('*', 'id="' . $patient_id . '"', 'opd_patient_info');



		$total_vat = $vat;
		$total_discnt = $discount;
		$total_amount = $total_amount;


		$data = array(
			'total_bill' => (float)$total_amount + $val[0]['total_bill'],
			'total_paid' => (float)$paid_amount + $val[0]['total_paid'],
			'total_discount_p' => (float)$total_discnt + $val[0]['total_discount_p'],
			'total_vat_p' => (float)$total_vat + $val[0]['total_vat_p']
		);
		$this->load->admin_model->update_function('id', $patient_id, 'opd_patient_info', $data);



		// insert data into doc commission

		// if($_POST['quack_doc_id']!=0 && $_POST['ref_doc_id']==0)
		// {
		// 		$doc_type=2;
		// 		$doc_title=$_POST['quack_doc_name'];
		// 		$doc_id=$_POST['quack_doc_id'];
		// }
		// else if($_POST['ref_doc_id']!=0 && $_POST['quack_doc_id']==0)
		// {
		// 		$doc_type=1;
		// 		$doc_title=$_POST['ref_doc_name'];
		// 		$doc_id=$_POST['ref_doc_id'];
		// }
		// else if($_POST['quack_doc_id']!=0 && $_POST['ref_doc_id']!=0)
		// {
		// 		$doc_type=2;
		// 		$doc_title=$_POST['quack_doc_name'];
		// 		$doc_id=$_POST['quack_doc_id'];
		// }

		$hospital_id = $this->session->userdata['logged_in']['hospital_id'];

		$data['doc_comission_style_type'] = $this->admin_model->select_with_where2('*', 'hospital_id="' . $hospital_id . '"', 'doc_comission_style_type');

		$data['comission_style'] = $data['doc_comission_style_type']['0']['comission_style'];

		if ($discount_commission_type[0]['type']  == 2) {
			$discount = $discount / 2;
			$discount_com_typ = 2;
		} else {
			$discount_com_typ = 1;
		}


		if ($quack_doc_name[1] != 0) {
			$doc_type = 2;
			$doc_title = $quack_doc_name[0];
			$doc_id = $quack_doc_name[1];
		} else {
			$doc_type = 3;
			$doc_title = "self";
			$doc_id = 0;
		}

		if ($_POST['total_c_o'] >= $discount) {
			$total_com = $_POST['total_c_o'] - $discount;
		} else {
			$total_com = 0;
		}


		$data = array(
			'total_commission' => $total_com,
			'total_test_amount' => $total_amount,
			'total_test_discount' => $discount,
			'total_gross_com' => $_POST['total_c_o'],
			'total_vat' => $vat,
			'order_id' => $order_id,
			'com_status' => 0,
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],
			'created_at' => date('Y-m-d H:i:s'),
			'patient_id' => $patient_id,
			'doc_name' => $doc_title,
			'doc_id' => $doc_id,
			'doc_type' => $doc_type,
			'status' => 1,
			'discount_commission_type' => $discount_com_typ

		);

		$com_id = $this->load->admin_model->insert_ret('doc_commission', $data);


		// insert data into doc commission details

		$cart_count = 0;

		$cart = $this->cart->contents();

		foreach ($cart as $key => $value) {

			if ($value['options']['type'] != 2) {
				$cart_count = $cart_count + 1;
			}
		}

		$cart_count = $cart_count;

		// "<pre>";print_r($cart_count);die();

		$com_reduction_each = 0;

		if ($discount != 0) {
			$com_reduction_each = number_format($discount / $cart_count, 2, '.', '');
		}



		foreach ($cart as $item) {

			if ($item['options']['type'] != 2) {
				$amount1 = $item['options']['quk_ref_com'] - $com_reduction_each;
				$val = array(
					'com_id' => $com_id,
					'patient_id' => $patient_id,
					'patient_type' => 1,
					'doc_type' => $doc_type,
					'doc_title' => $doc_title,
					'service_type' => 1,
					'service_id' => $item['id'],
					'amount' => $amount1,
					'gross_amount' => $item['options']['quk_ref_com'],
					'sub_amount' => $com_reduction_each,
					'created_at' => date('Y-m-d H:i:s')

				);


				$this->load->admin_model->insert('doc_commission_details', $val);
			}
		}



		// "<pre>";print_r($discount_commission_type);die();


		if ($discount_commission_type[0]['type'] == 2) {
			$discount = $discount * 2;
		}


		// insert data into due collection table

		$d_data['old_due'] = $total_amount;
		$d_data['order_id'] = $test_order_id;
		$d_data['total_amount'] = $total_amount;
		$d_data['patient_id'] = $patient_id;
		$d_data['vat'] = $vat;
		$d_data['discount'] = $discount;
		$d_data['current_due'] = $this->input->post('due');
		$d_data['paid_due'] = $paid_amount;
		$d_data['created_at'] = date('Y-m-d H:i:s');
		$d_data['discount_ref'] = $this->input->post('discount_ref');;
		$d_data['due_type'] = 1;
		$d_data['status'] = 1;
		$d_data['operator_name'] = $data['username'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $data['username'] = $this->session->userdata['logged_in']['id'];

		$this->load->admin_model->insert_ret('due_collection', $d_data);


		// insert data into commission payment


		$data = array(
			'gross_com' => $_POST['total_c_o'],
			'sub_com' => $discount,
			'current_com' => $total_com,
			'old_com' => 0,
			'com_id' => $com_id,
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'created_at' => date('Y-m-d H:i:s'),
			'patient_id' => $patient_id,
			'doc_name' => $doc_title,
			'doc_id' => $doc_id,
			'doc_type' => $doc_type,
			'status' => 1

		);

		$this->load->admin_model->insert_ret('commission_payment', $data);

		// pass data into save test order details and stock

		$this->save_test_order_details($order_id, $patient_id, $is_ipd_patient);


		// insert data into pathology

		$test_details = $this->admin_model->select_with_where2('*', 'patient_test_order_id="' . $order_id . '"', 'opd_patient_test_details_info');

		foreach ($test_details as $key => $val) {
			if ($val['type'] != 2) {

				$patient_sub_test_id = $val['patient_sub_test_id'];
				$test_group_id = $this->admin_model->select_with_where2('*', 'id="' . $patient_sub_test_id . '"', 'diagnostic_test_subgroup');

				$datam = array(
					'patient_id' => $patient_id,
					'pdate' => date('Y-m-d'),
					'order_id' => $order_id,
					'padate' => date('Y-m-d H:i:s'),
					'test_id' => $patient_sub_test_id,
					'group_id' => $test_group_id[0]['mtest_id'],

				);


				$this->load->admin_model->insert_ret('pathologoy', $datam);
			}
		}



		redirect('admin/opd_registration/' . $order_id . '/' . $patient_id . '/' . $is_ipd_patient);

		// $this->patient_ordered_test_info($order_id,$patient_id,$is_ipd_patient);

	}


	public function save_test_order_details($order_id, $patient_id, $is_ipd_patient = "")
	{
		$cart = $this->cart->contents();
		foreach ($cart as $item) {
			$data = array(
				'patient_test_order_id' => $order_id,
				'patient_sub_test_id' => $item['id'],
				'sub_test_price' => $item['price'],
				'created_at' => date('Y-m-d H:i:s'),
				'type' => $item['options']['type']

			);


			$this->load->admin_model->insert('opd_patient_test_details_info', $data);

			if ($item['options']['type'] != 2) {

				$test_details = $this->admin_model->select_with_where2('*', 'id="' . $item['id'] . '"', 'diagnostic_test_subgroup');

				$stock['sell_buy_id'] = $order_id;
				$stock['p_id'] = $test_details[0]['reagent_p_id'];

				$get_last_val = $this->admin_model->get_last_row('sh_tbl_stock', 'p_id=' . $test_details[0]['reagent_p_id']);

				$stock['st_open'] = 0;
				if (count($get_last_val) > 0) {
					$stock['st_open'] = $get_last_val[0]['st_close'];
				}
				$stock['st_in'] = 0;
				$stock['st_out'] = $test_details[0]['reagent_qty'];
				$stock['st_close'] = $stock['st_open'] - $stock['st_out'];
				$stock['type'] = 1;
				$stock['created_at'] = date('Y-m-d H:i:s');

				$this->admin_model->insert('sh_tbl_stock', $stock);

				$lab_p_data['p_current_stock'] = $stock['st_open'] - $test_details[0]['reagent_qty'];

				$this->admin_model->update_function2('id="' . $test_details[0]['reagent_p_id'] . '"', "sh_tbl_lab_product", $lab_p_data);
			}
		}
		$this->cart->destroy();

		// insert into patient transaction

		$amount_to_pay = (float)str_replace(',', '', $_POST['total_amount']);
		$amount_paid = (float)str_replace(',', '', $_POST['paid_amount']);
		$transaction_id = $patient_id . '_' . date('YmdHis') . '_' . $this->session->userdata['logged_in']['hospital_id'];
		$data = array(
			'amount_to_pay' => $amount_to_pay,
			'amount_paid' => $amount_paid,
			'patient_test_order_id' => $order_id,
			'transaction_id' => $transaction_id,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->load->admin_model->insert('patient_transaction_info', $data);
	}

	public function patient_ordered_test_info($order_id = '', $patient_id = '', $is_ipd_patient = "")
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Patient Ordered Test and Other Information ';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		// "<pre>";print_r($patient_id);
		// "<pre>";print_r("  ".$order_id);die();



		$data['is_ipd_patient'] = $is_ipd_patient;

		$data['test_info'] = $this->admin_model->select_four_where_join('*, p.created_at,p.age,p.ref_doc_name,p.quack_doc_name,p.quack_doc_id', 'opd_patient_info o', 'opd_patient_test_order_info p', 'o.id=p.patient_id', 'o.status', 1, 'p.status', 1, 'o.id', $patient_id, 'p.id', $order_id);

		// "<pre>";print_r($data['test_info']);

		$data['order_info'] = $this->admin_model->select_join_where('*', 'opd_patient_test_details_info p', 'diagnostic_test_subgroup d', 'd.id=p.patient_sub_test_id', 'p.status=1 and d.status=1 and p.patient_test_order_id="' . $order_id . '"');

		// "<pre>";print_r($data['order_info']);die();


		$data['ipd_info'] = "";

		if ($data['test_info'][0]['is_ipd_patient'] == 1) {

			$data['ipd_info'] = $this->admin_model->select_join_where('*', 'ipd_patient_info i', 'room r', 'r.id=i.cabin_no', 'i.id="' . $data['test_info'][0]['ipd_patient_id'] . '"');
		}

		$data['doctor_info_ref'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['doctor_info_quack'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');


		$this->load->view('money_receipt/opd_money_receipt_new', $data);
	}



	public function get_patient_info_pdf()
	{

		require_once($_SERVER['DOCUMENT_ROOT'] . '/hospital_erp1/application/vendor/autoload.php');

		$mpdf = new \Mpdf\Mpdf();
		$html = $this->load->view('pdf', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	public function get_patient_ordered_test_info()
	{
		$data['test_info'] = $this->admin_model->select_four_where_join('*, p.created_at,p.age,p.ref_doc_name,p.quack_doc_name,p.quack_doc_id', 'opd_patient_info o', 'opd_patient_test_order_info p', 'o.id=p.patient_id', 'o.status', 1, 'p.status', 1, 'o.id', $_POST['patient_id'], 'p.id', $_POST['order_id']);


		$data['ipd_info'] = "";

		if ($data['test_info'][0]['is_ipd_patient'] == 1) {

			$data['ipd_info'] = $this->admin_model->select_join_where('*', 'ipd_patient_info i', 'room r', 'r.id=i.cabin_no', 'i.id="' . $data['test_info'][0]['ipd_patient_id'] . '"');
		}

		$data['doctor_info_ref'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['doctor_info_quack'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		echo json_encode($data);
	}
	public function get_patient_ordered_test_details_info()
	{
		$data = $this->admin_model->select_three_where_join('*', 'opd_patient_test_details_info p', 'diagnostic_test_subgroup d', 'd.id=p.patient_sub_test_id', 'p.status', 1, 'd.status', 1, 'p.patient_test_order_id', $_POST['order_id']);
		echo json_encode($data);
	}

	public function get_doc_img($value = '')
	{
		# code...

		$data = $this->admin_model->select_with_where2('*', 'doctor_id="' . $_POST['doc_id'] . '"', 'doctor');
		echo json_encode($data);
	}

	public function get_order_info($value = '')
	{
		$data = $this->admin_model->select_with_where2('*', 'id="' . $_POST['order_id'] . '" and status=1', 'opd_patient_test_order_info');
		echo json_encode($data);
	}

	public function get_order_info_all($value = '')
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1', 'opd_patient_test_order_info');
		echo json_encode($data);
	}

	public function get_all_test_and_subtest()
	{
		return $this->admin_model->select_where_right_join('*', 'diagnostic_test_group d', 'diagnostic_test_subgroup ds', 'd.test_id=ds.mtest_id', 'ds.status=1');
	}

	public function get_patient_id($value)
	{
		return $this->load->admin_model->select_with_where_opd_patient('*', $value, 'opd_patient_info', 'mobile_no');
	}

	public function get_all_phar_info_by_cust_id()
	{

		$data = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $_POST['phar_cust_id'] . '"', 'customer');
		echo json_encode($data);
	}

	public function get_all_opd_by_patient_id()
	{

		$data = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $_POST['opd_patient_id'] . '"', 'opd_patient_info');
		echo json_encode($data);
	}


	public function is_mobile_exist($value)
	{
		$data = $this->load->admin_model->check_row('*', 'mobile_no="' . $value . '"', 'opd_patient_info');
		return $data;
		// echo "<pre>";print_r($data);die();

	}

	public function get_blood_group_by_id($value)
	{
		$data['blood_group_title'] = $this->admin_model->select_with_where_condition_two('*', 1, 'blood_group', 'status', $value, 'id');
		return $data['blood_group_title'];
	}

	// public function show_patient_data($value)
	// {
	// 	$this->load->view('show_patient_data',$value);
	// }

	public function get_all_blood_group()
	{
		$data = $this->admin_model->select_with_where_orer_by_desc2('*', 'status=1', 'blood_group');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function get_all_mobile_no()
	{
		$data = $this->admin_model->select_with_where_group_by('mobile_no', 'status=1', 'opd_patient_info', 'mobile_no');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}
	public function get_ref_doc_name()
	{
		$data = $this->admin_model->select_with_where('concat(doctor_title,' . ',doctor_degree)', 1, 'doctor', 'doctor_type');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function get_all_ipd_phone_no()
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1', 'ipd_patient_info');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function get_all_ipd_info()
	{
		$data = $this->admin_model->select_join_where('*', 'ipd_patient_info i', 'room r', 'r.id=i.cabin_no', 'i.id="' . $_POST['patient_id'] . '"');
		echo json_encode($data);
	}

	public function get_last_ipd_reg_no($value = '')
	{
		$data = $this->admin_model->get_last_row2('ipd_patient_info', 'status=1');
		echo json_encode($data);
	}

	public function get_all_ipd_id()
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1 and type !=3', 'ipd_patient_info');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function get_all_ipd_info_by_ipd_id()
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $_POST['ipd_patient_id'] . '"', 'ipd_patient_info');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function get_all_doc_name()
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function get_all_info_by_mobile_no()
	{
		// $data=$this->admin_model->select_with_where_condition_two('*',1,'opd_patient_info','status',$this->input->post('patient_mobile_no'),'mobile_no');

		$data = $this->admin_model->select_with_where2('*', 'status=1 AND mobile_no="' . $_POST['patient_mobile_no'] . '"', 'opd_patient_info');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function get_all_info_by_mobile_no_p_id()
	{
		$this->cart->destroy();
		$data = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $_POST['patient_id'] . '"', 'opd_patient_info');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}


	public function opd_all_billing_info($uhid = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Opd All Billing List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['uhid'] = $uhid;


		$data['id'] = $this->session->userdata['logged_in']['id'];

		// $data["patient_test_order_info"]=$this->admin_model->select_join_where_order('*,p.id as p_id,p.created_at as c_date','opd_patient_test_order_info p','opd_patient_info o','o.id=p.patient_id','p.status=1 AND o.status=1','c_date','DESC');

		// "<pre>";print_r($data["patient_test_order_info"]);die();

		$this->load->view('opd/opd_all_billing_info', $data);
	}

	public function opd_all_billing_info_dt($uhid = '')
	{

		// "<pre>";print_r($uhid);die();

		$select_column = '*,p.id as p_id,p.created_at as c_date';
		$order_column = array('p_id', null, 'patient_name', 'mobile_no', 'test_order_id', null, null, null, null, null);

		$search_column = array('patient_name', 'patient_info_id', 'mobile_no', 'test_order_id');

		if ($uhid == "") {
			$fetch_data = $this->admin_model->make_datatables_two_table_join('opd_patient_test_order_info p', 'p.status=1 AND o.status=1', $select_column, $order_column, $search_column, 'opd_patient_info o', 'o.id=p.patient_id', 'p_id');
		} else {
			$fetch_data = $this->admin_model->make_datatables_two_table_join('opd_patient_test_order_info p', 'p.status=1 AND o.status=1 AND p.uhid="' . $uhid . '"', $select_column, $order_column, $search_column, 'opd_patient_info o', 'o.id=p.patient_id', 'p_id');
		}


		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {

			$is_phar = $this->admin_model->select_with_where2('*', 'status=1 and p_id="' . $row->id . '" and type=1', 'customer');

			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->patient_info_id;
			$sub_array[] = $row->patient_name;
			$sub_array[] = $row->mobile_no;
			$sub_array[] = $row->test_order_id;
			$sub_array[] = date('d-M-y', strtotime($row->c_date));
			if ($row->payment_status == "paid") {
				$sub_array[] = '<span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>';
			} else {
				$sub_array[] = '<span class="badge badge-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
			}

			$sub_array[] = '<a href="admin/opd_each_billing_details/' . $row->patient_id . '/' . $row->p_id . '" class="btn btn-primary btn-sm">Details</a>';

			if ($is_phar != null) {
				$phar_cust_info = $this->admin_model->select_with_where2('*', 'p_id="' . $row->patient_id . '"', 'customer');

				$sub_array[] = '<span style="color:green;">Yes</span><br><a target="_blank" href="admin/billing_details_for_one_customer/' . $phar_cust_info[0]['id'] . '/' . $phar_cust_info[0]['type'] . '" class="btn btn-primary btn-sm">Info</a>';
			} else {
				$sub_array[] = '<p style="color:red;">No</p>';
			}



			$sub_array[] = '<a class="btn btn-danger" href="admin/opd_each_patient_pdf/' . $row->patient_id . '/' . $row->p_id . '/' . $row->is_ipd_patient . '" onclick="window.open(this.href, ' . "windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable" . '); return false;">Print</a>';

			$sub_array[] = '<a href="admin/tag_receipt/' . $row->patient_id . '/' . $row->p_id . '" class="btn btn-primary btn-sm">Tag</a>';

			$sub_array[] = '<a target="_blank" href="admin/file_tag_receipt/' . $row->patient_id . '/' . $row->p_id . '" class="btn btn-primary btn-sm">File Tag</a>';

			if (($this->auth->can('edit_opd_invoice-admin'))) {
				$sub_array[] = '<a href ="admin/edit_opd_invoice/' . $row->p_id . '" class="btn btn-success btn-xs edit_button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

	 			<button type="button" id=""  onclick="delete_patient(' . $row->p_id . ')" class="btn btn-danger btn-xs delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
			}



			$data[] = $sub_array;

			$i++;
		}

		if ($uhid == "") {

			$output = array(
				"draw"                   =>      intval($_POST["draw"]),
				"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('opd_patient_test_order_info p', 'p.status=1 AND o.status=1 ', $select_column, 'opd_patient_info o', 'o.id=p.patient_id'),
				"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
					'opd_patient_test_order_info p',
					'p.status=1 AND o.status=1 ',
					$select_column,
					$order_column,
					$search_column,
					'opd_patient_info o',
					'o.id=p.patient_id',
					'p_id'
				),
				"data"                    =>     $data
			);
		} else {

			$output = array(
				"draw"                   =>      intval($_POST["draw"]),
				"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('opd_patient_test_order_info p', 'p.status=1 AND o.status=1 AND p.uhid="' . $uhid . '"', $select_column, 'opd_patient_info o', 'o.id=p.patient_id'),
				"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
					'opd_patient_test_order_info p',
					'p.status=1 AND o.status=1 AND p.uhid="' . $uhid . '"',
					$select_column,
					$order_column,
					$search_column,
					'opd_patient_info o',
					'o.id=p.patient_id',
					'p_id'
				),
				"data"                    =>     $data
			);
		}


		echo json_encode($output);
	}




	// ------

	public function opd_patient_data()
	{
		$data['active'] = 'opd_patient_data';
		$data['page_title'] = 'Opd Patient Data';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['id'] = $this->session->userdata['logged_in']['id'];

		// $data["patient_test_order_info"]=$this->admin_model->select_join_where_order('*,p.id as p_id,p.created_at as c_date','opd_patient_test_order_info p','opd_patient_info o','o.id=p.patient_id','p.status=1 AND o.status=1','c_date','DESC');

		// "<pre>";print_r($data["patient_test_order_info"]);die();

		$this->load->view('opd/opd_patient_data', $data);
	}

	public function opd_patient_data_dt($value = '')
	{
		$select_column = '*,p.id as p_id,p.created_at as c_date';
		$order_column = array('p_id', null, 'patient_name', 'mobile_no', 'test_order_id', null, null, null, null, null);

		$search_column = array('patient_name', 'patient_info_id', 'mobile_no', 'test_order_id');

		$fetch_data = $this->admin_model->make_datatables_two_table_join('opd_patient_test_order_info p', 'p.status=1 AND o.status=1', $select_column, $order_column, $search_column, 'opd_patient_info o', 'o.id=p.patient_id', 'p_id');

		$test_data = $this->admin_model->select_join_where('*', 'diagnostic_test_subgroup d', 'opd_patient_test_details_info o', 'd.id=o.patient_sub_test_id', 'o.status=1 and d.status=1');

		$data = array();

		$i = $_POST['start'];

		foreach ($fetch_data as $key => $row) {
			$test_name = "";
			$due = ($row->total_amount - $row->total_discount + $row->vat) - $row->paid_amount;

			$transaction = "Total Amount:" . $row->total_amount . '<br>' . 'Total Discount:' . $row->total_discount . '<br> Total Vat:' . $row->vat . '<br>Total Paid:' . $row->paid_amount . '<br>Due:' . $due;

			foreach ($test_data as $key => $value) {

				if ($value['patient_test_order_id'] == $row->p_id) {
					$test_name .= $value['sub_test_title'] . ', ';
				}
			}

			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->patient_info_id;
			$sub_array[] = $row->patient_name;
			$sub_array[] = $row->test_order_id;
			$sub_array[] = substr($test_name, 0, -2);
			$sub_array[] = $transaction;
			$sub_array[] = $row->ref_doc_name;
			$sub_array[] = $row->quack_doc_name;
			$sub_array[] = date('d-M-y', strtotime($row->c_date));
			$sub_array[] = $row->operator_name;
			$sub_array[] = '<a class="btn btn-primary" href="admin/opd_each_patient_pdf/' . $row->patient_id . '/' . $row->p_id . '/' . $row->is_ipd_patient . '" onclick="window.open(this.href, ' . "windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable" . '); return false;">Print</a>';

			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('opd_patient_test_order_info p', 'p.status=1 AND o.status=1', $select_column, 'opd_patient_info o', 'o.id=p.patient_id'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
				'opd_patient_test_order_info p',
				'p.status=1 AND o.status=1',
				$select_column,
				$order_column,
				$search_column,
				'opd_patient_info o',
				'o.id=p.patient_id',
				'p_id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	public function tag_receipt($value = '')
	{
		$patient_id = $this->uri->segment(3);
		$order_id = $this->uri->segment(4);

		$data["patient_info"] = $this->admin_model->select_with_where2('*', 'id="' . $patient_id . '"', 'opd_patient_info');

		$data["patient_order_info"] = $this->admin_model->select_with_where2('*', 'patient_id="' . $patient_id . '" AND id="' . $order_id . '" and status=1', 'opd_patient_test_order_info');

		$this->load->view('money_receipt/tag_receipt', $data);
	}

	public function file_tag_receipt($value = '')
	{
		$patient_id = $this->uri->segment(3);
		$order_id = $this->uri->segment(4);

		$data["patient_info"] = $this->admin_model->select_with_where2('*', 'id="' . $patient_id . '"', 'opd_patient_info');

		$data["patient_order_info"] = $this->admin_model->select_with_where2('*', 'patient_id="' . $patient_id . '" AND id="' . $order_id . '" and status=1', 'opd_patient_test_order_info');

		$this->load->view('money_receipt/file_tag_receipt', $data);
	}

	public function opd_each_billing_details()
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Opd Individual Billing Details';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$patient_id = $this->uri->segment(3);
		$order_id = $this->uri->segment(4);

		$flag = $this->uri->segment(5);

		// if($order_id==null)
		// {
		// 	$order_id=$this->admin_model->select_with_where2('*','patient_id="'.$patient_id.'"','opd_patient_test_order_info');
		// 	$order_id=$order_id[0]['id'];
		// }

		$data['patient_id'] = $patient_id;
		$data['order_id'] = $order_id;


		if ($flag != null) {
			$data['flag'] = $flag;
		} else {
			$data['flag'] = "others";
		}




		// echo "<pre>";print_r($patient_id);
		// echo "<pre>";print_r($order_id);
		// die();
		$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];

		$data['hospital_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND hospital_id="' . $data['hospital_id'] . '"', 'hospital');

		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'id="' . $patient_id . '"', 'opd_patient_info');

		$data['doctor_info_ref'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');


		if ($flag == "cancel") {
			$data["patient_order_info"] = $this->admin_model->select_with_where2('*', 'patient_id="' . $patient_id . '" AND id="' . $order_id . '" AND status=2', 'opd_patient_test_order_info');

			$data["patient_test_details_info"] = $this->admin_model->select_join_where('*', 'opd_patient_test_details_info p', 'diagnostic_test_subgroup d', 'd.id=p.patient_sub_test_id', 'p.status=2 AND d.status=2 AND p.patient_test_order_id="' . $order_id . '"');
		} else {
			$data["patient_order_info"] = $this->admin_model->select_with_where2('*', 'patient_id="' . $patient_id . '" AND id="' . $order_id . '" AND status=1', 'opd_patient_test_order_info');

			$data["patient_test_details_info"] = $this->admin_model->select_join_where('*', 'opd_patient_test_details_info p', 'diagnostic_test_subgroup d', 'd.id=p.patient_sub_test_id', 'p.status=1 AND d.status=1 AND p.patient_test_order_id="' . $order_id . '"');
		}





		$this->load->view('opd/opd_each_billing_details', $data);
	}

	public function opd_patient_billing_print_view1($value = '')
	{

		$data['active'] = 'opd';
		$data['page_title'] = 'Opd Billing Print View1';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$id = $this->uri->segment(3);

		$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];

		$data["patient_info"] = $this->admin_model->select_with_where2('*', 'id="' . $id . '" AND status=1', 'opd_patient_info');

		$data["patient_order_info"] = $this->admin_model->select_with_where2('*', 'patient_id="' . $id . '" AND status=1', 'opd_patient_test_order_info');

		$data["patient_test_details_info"] = $this->admin_model->select_join_where('*', 'opd_patient_test_details_info p', 'diagnostic_test_subgroup d', 'd.id=p.patient_sub_test_id', 'p.status=1 AND d.status=1');

		$data['hospital_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND hospital_id="' . $data['hospital_id'] . '"', 'hospital');

		// echo "<pre>";print_r($data['hospital_info']);die();

		$this->load->view('opd/opd_patient_billing_print_view1', $data);
	}

	public function opd_update_payment_each_bill($value = '')
	{

		$data['active'] = 'opd';
		$data['page_title'] = 'Opd Billing';

		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$order_id = $this->uri->segment(3);
		$patient_id = $this->uri->segment(4);
		$flag = $this->uri->segment(5);


		// <<<<<<<<<<<< History Table Start >>>>>>>>>>>>>

		$val2 = $this->admin_model->select_with_where2('*', 'order_id="' . $order_id . '"', 'doc_commission');

		$val3 = $this->admin_model->select_with_where2('*', 'com_id="' . $val2[0]['id'] . '"', 'doc_commission_details');

		// insert into doc_commission history Start

		foreach ($val2 as $key => $value) {

			$co_data['order_id'] = $value['order_id'];
			$co_data['total_commission'] = $value['total_commission'];

			$co_data['total_test_amount'] = $value['total_test_amount'];
			$co_data['total_test_discount'] = $value['total_test_discount'];
			$co_data['total_vat'] = $value['total_vat'];
			$co_data['operator_name'] = $value['operator_name'];
			$co_data['paid_amount'] = $value['paid_amount'];
			$co_data['created_at'] = $value['created_at'];
			$co_data['patient_id'] = $value['patient_id'];

			$co_data['doc_name'] = $value['doc_name'];
			$co_data['doc_id'] = $value['doc_id'];
			$co_data['doc_type'] = $value['doc_type'];



			$order_history_id = $this->admin_model->insert_ret('doc_commission_history', $co_data);
		}



		// insert into doc_commission_details history Start

		foreach ($val3 as $key => $value) {


			$co_data1['patient_id'] = $value['patient_id'];

			$co_data1['com_id'] = $value['com_id'];
			$co_data1['doc_type'] = $value['doc_type'];
			$co_data1['patient_type'] = $value['patient_type'];
			$co_data1['doc_title'] = $value['doc_title'];
			$co_data1['service_type'] = $value['service_type'];
			$co_data1['service_id'] = $value['service_id'];
			$co_data1['amount'] = $value['amount'];
			$co_data1['created_at'] = $value['created_at'];




			$order_history_id = $this->admin_model->insert_ret('doc_commission_details_history', $co_data1);
		}

		// <<<<<<<<<< History Table End >>>>>>>>>>>>


		// echo $patient_id;
		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'id="' . $patient_id . '" AND status=1', 'opd_patient_info');

		$data['patient_order_info'] = $this->admin_model->select_with_where2_decending('*', 'id="' . $order_id . '" AND status=1', 'opd_patient_test_order_info', 'created_at');

		$data['doctor_info_ref'] = $this->admin_model->select_with_where2('*', 'doctor_type=1', 'doctor');

		$data['doctor_info_quack'] = $this->admin_model->select_with_where2('*', 'doctor_type=2', 'doctor');




		$paid_amount = $this->input->post('update_payment') + $data['patient_order_info'][0]['paid_amount'];

		$discount = ($this->input->post('discount_due')) + $data['patient_order_info'][0]['total_discount'];



		if ($paid_amount >= $data['patient_order_info'][0]['total_amount'] + $data['patient_order_info'][0]['vat'] - $discount) {
			$val = array(
				'paid_amount' => $paid_amount,
				'total_discount' => $discount,
				'payment_status' => 'paid'
			);
		} else {
			$val = array(
				'paid_amount' => $paid_amount,
				'total_discount' => $discount
			);
		}

		$this->load->admin_model->update_function('id', $order_id, 'opd_patient_test_order_info', $val);


		// update into opd patient info table


		$val = $this->load->admin_model->select_with_where2('*', 'id="' . $patient_id . '"', 'opd_patient_info');




		$total_discnt = $this->input->post('discount_due');


		$data1 = array(
			'total_paid' => (float)$this->input->post('update_payment') + $val[0]['total_paid'],
			'total_discount_p' => (float)$total_discnt + $val[0]['total_discount_p']

		);
		$this->load->admin_model->update_function('id', $patient_id, 'opd_patient_info', $data1);




		$data['order_id'] = $order_id;
		$data['patient_id'] = $patient_id;



		// insert data into due collection table

		$d_data['is_due_collection'] = 0;

		if (date("Y-m-d", strtotime($data['patient_order_info'][0]['created_at'])) != date('Y-m-d')) {
			$d_data['is_due_collection'] = 1;
		}

		$d_data['old_due'] = $this->input->post('due');
		$d_data['order_id'] = $data["patient_order_info"][0]['test_order_id'];
		$d_data['total_amount'] = $data["patient_order_info"][0]['total_amount'];
		$d_data['patient_id'] = $patient_id;
		$d_data['discount'] = $this->input->post('discount_due');
		$d_data['current_due'] = $this->input->post('grand_due') - $this->input->post('update_payment');
		$d_data['paid_due'] = $this->input->post('update_payment');
		$d_data['created_at'] = date('Y-m-d H:i:s');
		$d_data['discount_ref'] = $this->input->post('discount_ref');;
		$d_data['due_type'] = 1;
		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		// "<pre>";print_r($d_data['paid_due']);die();
		$this->load->admin_model->insert('due_collection', $d_data);


		// update data into doc commission

		$doc_commission = $this->admin_model->select_with_where2('*', 'order_id="' . $order_id . '"', 'doc_commission');

		$data1 = array(
			'total_commission' => $doc_commission[0]['total_commission'] - $this->input->post('discount_due'),
			'total_test_discount' => $doc_commission[0]['total_test_discount'] + $this->input->post('discount_due'),
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'updated_at' => date('Y-m-d H:i:s')

		);

		$this->load->admin_model->update_function('order_id', $order_id, 'doc_commission', $data1);



		// update data into doc commission details

		$doc_com_details = $this->admin_model->select_with_where2('*', 'com_id="' . $doc_commission[0]['id'] . '"', 'doc_commission_details');

		// "<pre>";print_r($doc_com_details);die();


		foreach ($doc_com_details as $key => $value) {

			$val1['amount'] = $value['amount'] - $this->input->post('discount_due') / count($doc_com_details);
			$val1['sub_amount'] = $value['sub_amount'] + $this->input->post('discount_due') / count($doc_com_details);

			$this->load->admin_model->update_function('id', $value['id'], 'doc_commission_details', $val1);
		}

		// die();



		// update data into commission payment

		$commission_payment_details = $this->admin_model->select_with_where2('*', 'com_id="' . $doc_commission[0]['id'] . '"', 'commission_payment');

		$data1 = array(
			'sub_com' => $commission_payment_details[0]['sub_com'] + $this->input->post('discount_due'),
			'current_com' => $commission_payment_details[0]['current_com'] - $this->input->post('discount_due'),
			'old_com' => $commission_payment_details[0]['current_com'],
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],
			'updated_at' => date('Y-m-d H:i:s'),

		);

		$this->load->admin_model->update_function('com_id', $doc_commission[0]['id'], 'commission_payment', $data1);




		if ($flag == "opd_due") {
			redirect("admin/outdoor_due_collection");
		} else {
			redirect("admin/opd_each_billing_details/" . $data['patient_id'] . '/' . $data['order_id']);
		}



		// redirect('admin/opd_update_payment_each_bill/'+$data['order_id']+'/'+$data['patient_id']);

	}

	public function opd_each_patient_pdf($patient_id = '', $order_id = '', $is_ipd_patient = '')
	{

		$data['is_ipd_patient'] = $is_ipd_patient;

		$data['test_info'] = $this->admin_model->select_four_where_join('*,p.uhid, p.created_at,p.age,p.ref_doc_name,p.quack_doc_name,p.quack_doc_id', 'opd_patient_info o', 'opd_patient_test_order_info p', 'o.id=p.patient_id', 'o.status', 1, 'p.status', 1, 'o.id', $patient_id, 'p.id', $order_id);


		$data['uhid_info'] = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $data['test_info'][0]['uhid'] . '"', 'uhid');

		// "<pre>";print_r($data['test_info']);

		$data['order_info'] = $this->admin_model->select_join_where('*', 'opd_patient_test_details_info p', 'diagnostic_test_subgroup d', 'd.id=p.patient_sub_test_id', 'p.status=1 and d.status=1 and p.patient_test_order_id="' . $order_id . '"');

		// "<pre>";print_r($data['order_info']);die();


		$data['ipd_info'] = "";

		if ($data['test_info'][0]['is_ipd_patient'] == 1) {

			$data['ipd_info'] = $this->admin_model->select_join_where('*', 'ipd_patient_info i', 'room r', 'r.id=i.cabin_no', 'i.id="' . $data['test_info'][0]['ipd_patient_id'] . '"');
		}

		$data['doctor_info_ref'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['doctor_info_quack'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$this->load->view('money_receipt/opd_money_receipt_new', $data);
	}
	public function show_all_opd_patient($value = '')
	{
		$data['active'] = 'opd_patient_list';
		$data['page_title'] = 'Opd Patient List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['opd_all_patient'] = $this->admin_model->select_with_where2('*,(total_bill-total_discount_p+total_vat_p) as net_total', 'status=1', 'opd_patient_info');

		// "<pre>";print_r($data['opd_all_patient']);die();

		// $data["opd_all_patient"]=$this->admin_model->select_join_where('*,p.id as p_id,o.id as o_id','opd_patient_test_order_info p','opd_patient_info o','o.id=p.patient_id','o.status=1');

		$data["flag"] = "all";
		$this->load->view('opd/opd_all_patient_list', $data);
	}



	public function show_all_paid_opd_patient($value = '')
	{
		$data['active'] = 'opd_patient_list';
		$data['page_title'] = 'Opd Paid Patient List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data["flag"] = "paid";

		// $data['opd_all_patient']=$this->admin_model->select_with_where2('*,(total_bill-total_discount_p+total_vat_p) as net_total','status=1 AND (total_bill-total_discount_p+total_vat_p) <= total_paid','opd_patient_info');

		$this->load->view('opd/opd_all_patient_list', $data);
	}
	public function show_all_unpaid_opd_patient($value = '')
	{

		$data['active'] = 'opd_patient_list';
		$data['page_title'] = 'Opd Unpaid Patient List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$data['username'] = $this->session->userdata['logged_in']['username'];

		// $data['opd_all_patient']=$this->admin_model->select_with_where2('*,(total_bill-total_discount_p+total_vat_p) as net_total','status=1 AND (total_bill-total_discount_p+total_vat_p) > total_paid','opd_patient_info');


		$data["flag"] = "unpaid";

		$this->load->view('opd/opd_all_patient_list', $data);
	}


	public function show_opd_patient_dt($flag)
	{

		$select_column = '*';
		$order_column = array('patient_info_id', 'patient_name', 'mobile_no', null, null, null, null);

		$search_column = array('patient_name', 'patient_info_id', 'mobile_no');

		$condition = "";

		if ($flag == "all") {
			$select_column = '*';
			$condition = "status=1";
		} else if ($flag == "paid") {
			$select_column = '*,(total_bill-total_discount_p+total_vat_p) as net_total';

			$condition = "status=1 AND (total_bill-total_discount_p+total_vat_p) <= total_paid";
		} else {
			$select_column = '*,(total_bill-total_discount_p+total_vat_p) as net_total';

			$condition = "status=1 AND (total_bill-total_discount_p+total_vat_p) > total_paid";
		}

		$fetch_data = $this->admin_model->make_datatables('opd_patient_info', $condition, $select_column, $order_column, $search_column, 'id');

		// "<pre>";print_r(expression);die();

		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->patient_info_id;
			$sub_array[] = $row->patient_name;
			$sub_array[] = $row->mobile_no;
			$sub_array[] = $row->ref_doctor_name;
			$sub_array[] = $row->quack_doc_name;
			$sub_array[] = date('d-M-Y h:i:s a', strtotime($row->created_at));

			if ($row->total_bill - $row->total_discount_p > $row->total_paid + $row->total_vat_p) {
				$sub_array[] = '<span class="badge badge-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
			} else {


				$sub_array[] = '<span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>';
			}

			$sub_array[] = '<a href="admin/opd_patient_billing_details/' . $row->id . '" class="btn btn-primary btn-sm">Details</a>';


			$sub_array[] = '<a href ="admin/edit_opd_patient_info/' . $row->id . '/' . $flag . '" class="btn btn-success btn-xs edit_button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

			// <button type="button" id=""  onclick="delete_patient('.$row->id.')" class="btn btn-danger btn-xs delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>

			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data($select_column, 'opd_patient_info o', $condition),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data(
				'opd_patient_info',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}


	// public function opd_patient_delete($value='')
	// {
	// 	$patient_id=$_POST['patient_id'];

	// 	$val['status']=2;

	// 	$this->load->admin_model->update_function2('id="'.$patient_id.'"','opd_patient_info',$val);


	// 	echo json_encode($val);

	// }

	public function opd_today_collection()
	{

		$data['active'] = 'opd_today_collection';
		$data['page_title'] = 'Opd Today Collection';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$id = $this->uri->segment(3);

		$curdate = date('Y-m-d');

		//DATE_FORMAT("2017-06-15", "%m");
		$co_title = "Todays Collection";
		$data["patient_test_order_info"] = $this->admin_model->select_join_where('*,d.created_at, d.operator_name,d.operator_id', 'due_collection d', 'opd_patient_info o', 'd.patient_id=o.id', 'date(d.created_at)="' . $curdate . '" AND d.due_type=1 and d.status=1');


		$this->load->view('opd/opd_collection', $data);
	}

	public function opd_datewise_collection_summary($value = '')
	{
		$data['active'] = 'opd_datewise_collection_summary';
		$data['page_title'] = 'Opd Datewise Collection Summary';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data["patient_test_order_info"] = $this->admin_model->select_join_three_table2('*,opd_patient_test_order_info.patient_id,patient_info_id,patient_name,opd_patient_test_order_info.operator_name, opd_patient_info.age,gender,total_amount,opd_patient_test_order_info.paid_amount,vat,doc_commission.paid_amount as com_paid,
	 		(total_amount-opd_patient_test_order_info.paid_amount) as due,total_discount,vat as total_vat,opd_patient_test_order_info.created_at,mobile_no', 'opd_patient_info', 'opd_patient_test_order_info', 'doc_commission', 'opd_patient_info.id=opd_patient_test_order_info.patient_id', 'doc_commission.order_id=opd_patient_test_order_info.id', 'date(opd_patient_test_order_info.created_at)="' . date('Y-m-d') . '"  AND opd_patient_test_order_info.status=1 AND opd_patient_info.status=1');
		$this->load->view('opd/opd_collection_daywise_amnt', $data);
	}

	public function opd_due_collection_by_operator($value = '')
	{
		$data['active'] = 'opd_due_collection_by_operator';
		$data['page_title'] = 'Opd Due By Operator';

		$data["user_info"] = $this->admin_model->select_with_where2('*', 'status=1', 'login');

		$this->load->view('opd/opd_due_collection_by_operator', $data);
	}

	public function opd_due_collection_by_operator_date_wise()
	{

		$start_date = $this->input->post('start_date');

		$end_date = $this->input->post('end_date');

		$operator_id = $this->input->post('operator_id');


		redirect('admin/opd_due_collection_by_operator_date_wise_next/' . $start_date . '/' . $end_date . '/' . $operator_id);
	}


	public function opd_due_collection_by_operator_date_wise_next($start_date, $end_date, $operator_id)
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Opd Doctor Commission';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;


		$data['due_collection_info'] = $this->load->admin_model->select_join_three_table2('d.paid_due,d.operator_name as o_name,d.created_at as c_at, p.*,o.*, p.id as order_id, o.id as patient_id,d.operator_id', 'due_collection d', 'opd_patient_test_order_info p', 'opd_patient_info o', 'p.test_order_id=d.order_id', 'o.id=p.patient_id', 'd.due_type=1 AND p.status=1 AND d.operator_id="' . $operator_id . '" AND date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '" AND date(p.created_at) not between "' . $start_date . '"  AND "' . $end_date . '" and d.status=1');


		$this->load->view('opd/outdoor_due_collection_report_day_wise', $data);
	}


	public function opd_collection_by_operator($value = '')
	{
		$data['active'] = 'opd_collection_by_operator';
		$data['page_title'] = 'Opd Collection By Operator';

		$data["user_info"] = $this->admin_model->select_with_where2('*', 'status=1 and role not in (0)', 'login');

		$this->load->view('opd/opd_collection_by_operator', $data);
	}

	public function opd_collection_by_operator_date_wise()
	{

		$start_date = $this->input->post('start_date');

		$end_date = $this->input->post('end_date');

		$operator_id = $this->input->post('operator_id');


		redirect('admin/opd_collection_by_operator_date_wise_next/' . $start_date . '/' . $end_date . '/' . $operator_id);
	}


	public function opd_collection_by_operator_date_wise_next($start_date, $end_date, $operator_id)
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Opd Doctor Commission';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		if ($operator_id == "all") {

			$data['flag'] = "all";

			$data["user_info"] = $this->admin_model->select_with_where2('*', 'status=1 and role not in (0)', 'login');

			$data["patient_test_order_info"] = $this->admin_model->select_join_where('*,d.created_at, d.operator_name,d.operator_id', 'due_collection d', 'opd_patient_info o', 'd.patient_id=o.id', 'date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '" AND d.due_type=1 and d.status=1');
		} else {

			$data['flag'] = "individual";
			$data["patient_test_order_info"] = $this->admin_model->select_join_where('*,d.created_at, d.operator_name,d.operator_id', 'due_collection d', 'opd_patient_info o', 'd.patient_id=o.id', 'date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '" AND d.due_type=1 AND d.operator_id="' . $operator_id . '" and d.status=1');
		}





		$this->load->view('opd/opd_collection_by_operator_report', $data);
	}



	public function opd_patient_billing_details()
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Opd Billing';

		$p_id = $this->uri->segment(3);
		$flag = $this->uri->segment(4);

		if ($flag != null) {
			$data['flag'] = $flag;
		} else {
			$data['flag'] = "";
		}

		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data["patient_info"] = $this->admin_model->select_with_where2('*', 'id="' . $p_id . '" AND status=1', 'opd_patient_info');

		$data['doctor_info_ref'] = $this->admin_model->select_with_where2('*', 'doctor_type=1', 'doctor');

		$data['doctor_info_quack'] = $this->admin_model->select_with_where2('*', 'doctor_type=2', 'doctor');

		$data["patient_order_info"] = $this->admin_model->select_with_where2_decending('*', 'patient_id="' . $p_id . '" AND status=1', 'opd_patient_test_order_info', 'created_at');

		$data['doctor_info_ref'] = $this->admin_model->select_with_where2('*', 'doctor_type=1', 'doctor');

		$data['doctor_info_quack'] = $this->admin_model->select_with_where2('*', 'doctor_type=2', 'doctor');

		$data["patient_test_details_info"] = $this->admin_model->select_join_where('*', 'opd_patient_test_details_info p', 'diagnostic_test_subgroup d', 'd.id=p.patient_sub_test_id', 'p.status=1 AND d.status=1');

		$this->load->view('opd/opd_patient_billing_details', $data);
	}


	public function opd_patient_billing_print_view($value = '')
	{

		$data['active'] = 'opd';
		$data['page_title'] = 'Opd Billing Print View';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$p_id = $this->uri->segment(3);

		$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];

		$data["patient_info"] = $this->admin_model->select_with_where2('*', 'id="' . $p_id . '" AND status=1', 'opd_patient_info');

		$data["patient_order_info"] = $this->admin_model->select_with_where2('*', 'patient_id="' . $p_id . '" AND status=1', 'opd_patient_test_order_info');

		$data["patient_test_details_info"] = $this->admin_model->select_join_where('*', 'opd_patient_test_details_info p', 'diagnostic_test_subgroup d', 'd.id=p.patient_sub_test_id', 'p.status=1 AND d.status=1');

		$data['hospital_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND hospital_id="' . $data['hospital_id'] . '"', 'hospital');

		// echo "<pre>";print_r($data['hospital_info']);die();


		$data['test_order_id'] = $data['patient_order_info']['0']['test_order_id'];
		$data['total_amnt'] = $data['patient_order_info']['0']['total_amount'];

		$data['total_discount'] = $data['patient_order_info']['0']['total_discount'];
		$data['vat'] = $data['patient_order_info']['0']['vat'];

		$data['net_amnt'] = $data['total_amnt'] - $data['total_discount'] + $data['vat'];


		$data['paid_amount'] = $data['patient_order_info']['0']['paid_amount'];

		$data['due'] = $data['net_amnt'] - $data['paid_amount'];

		$data['doctor_info_ref'] = $this->admin_model->select_with_where2('*', 'doctor_type=1', 'doctor');

		$data['doctor_info_quack'] = $this->admin_model->select_with_where2('*', 'doctor_type=2', 'doctor');

		$this->load->view('opd/opd_patient_billing_print_view2', $data);
		//$this->load->view('money_receipt/opd_patient_billing_print_view2', $data);
	}



	public function opd_update_payment($value = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Opd Individual Bill';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$order_id = $this->uri->segment(3);
		$patient_id = $this->uri->segment(4);

		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'id="' . $patient_id . '" AND status=1', 'opd_patient_info');
		$data['patient_order_info'] = $this->admin_model->select_with_where2_decending('*', 'id="' . $order_id . '" AND status=1', 'opd_patient_test_order_info', 'created_at');

		$total_paid = $this->input->post('update_payment') + $data['patient_info'][0]['total_paid'];

		$paid_amount = $this->input->post('update_payment') + $data['patient_order_info'][0]['paid_amount'];

		$data['doctor_info_ref'] = $this->admin_model->select_with_where2('*', 'doctor_type=1', 'doctor');

		$data['doctor_info_quack'] = $this->admin_model->select_with_where2('*', 'doctor_type=2', 'doctor');
		//$discount=($this->input->post('discount')/100)+$data['patient_order_info'][0]['total_discount'];	

		if ($paid_amount >= $data['patient_order_info'][0]['total_amount'] + $data['patient_order_info'][0]['vat'] - $data['patient_order_info'][0]['total_discount']) {
			$val = array(
				'paid_amount' => $paid_amount,
				'payment_status' => 'paid'
			);
		} else {
			$val = array('paid_amount' => $paid_amount);
		}

		$this->load->admin_model->update_function('id', $order_id, 'opd_patient_test_order_info', $val);

		$val = array('total_paid' => $total_paid);

		$this->load->admin_model->update_function('id', $patient_id, 'opd_patient_info', $val);

		$data["patient_info"] = $this->admin_model->select_with_where2('*', 'id="' . $patient_id . '" AND status=1', 'opd_patient_info');
		$data["patient_order_info"] = $this->admin_model->select_with_where2('*', 'patient_id="' . $patient_id . '" AND status=1', 'opd_patient_test_order_info');
		$data["patient_test_details_info"] = $this->admin_model->select_join_where('*', 'opd_patient_test_details_info p', 'diagnostic_test_subgroup d', 'd.id=p.patient_sub_test_id', 'p.status=1 AND d.status=1');


		// insert data into due collection table

		$d_data['old_due'] = $this->input->post('due');
		$d_data['order_id'] = $data["patient_order_info"][0]['test_order_id'];
		$d_data['patient_id'] = $patient_id;
		$d_data['discount'] = $this->input->post('discount_due');
		$d_data['current_due'] = $this->input->post('grand_due') - $this->input->post('update_payment');
		$d_data['paid_due'] = $this->input->post('update_payment');
		$d_data['created_at'] = date('Y-m-d H:i:s');
		$d_data['discount_ref'] = $this->input->post('discount_ref');
		$d_data['due_type'] = 1;
		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$this->load->admin_model->insert_ret('due_collection', $d_data);

		$this->load->view('opd/opd_patient_billing_details', $data);


		// echo "<pre>";print_r($order_id);
		// echo "<pre>";print_r($patient_id);
		// die();


	}

	public function opd_com_list()
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Opd Doctor Commission';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['flag'] = "today";


		$data['comission_list'] = $this->admin_model->select_three_join_where_group_by('opd_patient_test_order_info.total_amount,opd_patient_test_order_info.test_order_id,doc_commission.operator_name,doc_commission.id,doc_commission.doc_type,patient_info_id,patient_name,opd_patient_info.age,gender,mobile_no,opd_patient_test_order_info.patient_id,doc_commission.patient_id,total_commission,doc_commission.total_gross_com,doc_commission.paid_amount,doc_commission.status,doc_commission.paid_amount,doc_commission.doc_name,doc_commission.created_at,doc_commission.com_status,opd_patient_test_order_info.payment_status,opd_patient_test_order_info.status', 'opd_patient_info', 'opd_patient_test_order_info', 'opd_patient_info.id=opd_patient_test_order_info.patient_id', 'doc_commission', 'doc_commission.patient_id=opd_patient_info.id', ' date(doc_commission.created_at)="' . date('Y-m-d') . '" AND doc_commission.doc_type != 3 AND doc_commission.total_commission > 0 AND opd_patient_test_order_info.status=1', 'doc_commission.id');

		$data['doc_list'] = $this->admin_model->select_join_where_group_by('*', 'doc_comission_distribution dc', 'doctor d', 'd.doctor_id=dc.doc_id', 'd.status=1 and dc.active_status=1', 'd.doctor_id');

		$this->load->view('opd/opd_com_list', $data);
	}



	public function opd_com_date_wise($start_date = '', $end_date = '')
	{
		if ($start_date == null && $end_date == null) {
			$start_date = $this->input->post('start_date');

			$end_date = $this->input->post('end_date');
		}

		$doc_id = $this->input->post('doc_name');


		redirect('admin/opd_com_date_wise_next/' . $start_date . '/' . $end_date . '/' . $doc_id);
	}

	public function opd_com_date_wise_next($start_date = '', $end_date = '', $doc_id = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Opd Doctor Commission';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['flag'] = "date_wise";

		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;

		if ($doc_id == "all") {
			$data['comission_list'] = $this->admin_model->select_three_join_where_group_by('opd_patient_test_order_info.total_amount,opd_patient_test_order_info.test_order_id,doc_commission.operator_name,doc_commission.id,doc_commission.doc_type,patient_info_id,patient_name,opd_patient_test_order_info.age,gender,mobile_no,opd_patient_test_order_info.patient_id,doc_commission.patient_id,doc_commission.total_gross_com,total_commission,doc_commission.paid_amount,doc_commission.status,doc_commission.paid_amount,doc_commission.doc_name,doc_commission.created_at,doc_commission.com_status,opd_patient_test_order_info.payment_status,opd_patient_test_order_info.status', 'opd_patient_info', 'opd_patient_test_order_info', 'opd_patient_info.id=opd_patient_test_order_info.patient_id', 'doc_commission', 'doc_commission.patient_id=opd_patient_info.id', 'date(doc_commission.created_at)  between "' . $start_date . '" AND "' . $end_date . '" AND doc_commission.doc_type != 3 AND opd_patient_test_order_info.status=1 and doc_commission.total_commission > 0', 'doc_commission.id');
		} else {
			$data['comission_list'] = $this->admin_model->select_three_join_where_group_by('opd_patient_test_order_info.total_amount,opd_patient_test_order_info.test_order_id,doc_commission.operator_name,doc_commission.id,doc_commission.doc_type,patient_info_id,patient_name,opd_patient_test_order_info.age,gender,mobile_no,opd_patient_test_order_info.patient_id,doc_commission.patient_id,doc_commission.total_gross_com,total_commission,doc_commission.paid_amount,doc_commission.status,doc_commission.paid_amount,doc_commission.doc_name,doc_commission.created_at,doc_commission.com_status,opd_patient_test_order_info.payment_status,opd_patient_test_order_info.status', 'opd_patient_info', 'opd_patient_test_order_info', 'opd_patient_info.id=opd_patient_test_order_info.patient_id', 'doc_commission', 'doc_commission.patient_id=opd_patient_info.id', 'date(doc_commission.created_at)  between "' . $start_date . '" AND "' . $end_date . '" AND doc_commission.doc_type != 3 AND opd_patient_test_order_info.status=1 and doc_commission.total_commission > 0 and doc_commission.doc_id="' . $doc_id . '"', 'doc_commission.id');
		}




		$this->load->view('opd/opd_com_list', $data);
	}

	public function opd_com_list_doc_id($doc_id = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Opd Doctor Commission';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$data['flag'] = "today";

		$data['comission_list'] = $this->admin_model->select_three_join_where_group_by('opd_patient_test_order_info.test_order_id,doc_commission.operator_name,doc_commission.id,doc_commission.doc_id,doc_commission.doc_type,patient_info_id,patient_name,opd_patient_info.age,gender,mobile_no,opd_patient_test_order_info.patient_id,doc_commission.patient_id,total_commission,doc_commission.paid_amount,doc_commission.status,doc_commission.paid_amount,doc_commission.doc_name,doc_commission.created_at,doc_commission.com_status,opd_patient_test_order_info.payment_status,opd_patient_test_order_info.status', 'opd_patient_info', 'opd_patient_test_order_info', 'opd_patient_info.id=opd_patient_test_order_info.patient_id', 'doc_commission', 'doc_commission.patient_id=opd_patient_info.id', ' date(doc_commission.created_at)="' . date('Y-m-d') . '" AND doc_commission.doc_type != 3 AND doc_commission.total_commission > 0 AND opd_patient_test_order_info.status=1 and doc_commission.doc_id="' . $doc_id . '"', 'doc_commission.id');

		$data['doc_id'] = $doc_id;

		$this->load->view('opd/opd_com_list_doc_info', $data);
	}




	public function opd_com_date_wise_doc_id($doc_id = '', $start_date = '', $end_date = '')
	{
		if ($start_date == null && $end_date == null) {
			$start_date = $this->input->post('start_date');

			$end_date = $this->input->post('end_date');

			$doc_id = $this->uri->segment(3);
		}



		redirect('admin/opd_com_date_wise_doc_id_next/' . $doc_id . '/' . $start_date . '/' . $end_date);
	}


	public function opd_com_date_wise_doc_id_next($doc_id = '', $start_date = '', $end_date = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Opd Doctor Commission';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['flag'] = "date_wise";

		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;


		$data['comission_list'] = $this->admin_model->select_three_join_where_group_by('opd_patient_test_order_info.test_order_id,doc_commission.operator_name,doc_commission.doc_id,doc_commission.id,doc_commission.doc_type,patient_info_id,patient_name,opd_patient_test_order_info.age,gender,mobile_no,opd_patient_test_order_info.patient_id,doc_commission.patient_id,total_commission,doc_commission.paid_amount,doc_commission.status,doc_commission.paid_amount,doc_commission.doc_name,doc_commission.created_at,doc_commission.com_status,opd_patient_test_order_info.payment_status,opd_patient_test_order_info.status', 'opd_patient_info', 'opd_patient_test_order_info', 'opd_patient_info.id=opd_patient_test_order_info.patient_id', 'doc_commission', 'doc_commission.patient_id=opd_patient_info.id', 'date(doc_commission.created_at)  between "' . $start_date . '" AND "' . $end_date . '" AND doc_commission.total_commission > 0 AND doc_commission.doc_type != 3 AND opd_patient_test_order_info.status=1 and doc_commission.doc_id="' . $doc_id . '"', 'doc_commission.id');

		$data['doc_id'] = $doc_id;


		$this->load->view('opd/opd_com_list_doc_info', $data);
	}



	public function opd_today_com_list($value = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Opd Doctor Commission';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];




		$flag = $this->uri->segment(3);

		$flag1 = $this->uri->segment(4);


		$start_date = $this->input->post('start_date');

		$end_date = $this->input->post('end_date');

		$data['flag'] = $flag;

		$data["total_com"] = $this->admin_model->select_three_join_where('d.*,o.*,d.id as d_id,ot.*,d.paid_amount', 'doc_commission d', 'opd_patient_info o', 'o.id=d.patient_id', 'opd_patient_test_order_info ot', 'ot.id=d.order_id', 'date(d.created_at)="' . date('Y-m-d') . '" AND o.status=1 and d.doc_type !=3 and d.total_gross_com != 0');

		$data["total_com_info"] = $this->admin_model->select_join_where('*', 'doc_commission_details dc', 'diagnostic_test_subgroup dt', 'dt.id=dc.service_id', 'date(dc.created_at)="' . date('Y-m-d') . '"');

		// "<pre>";print_r($data["total_com"]);die();
		// "<pre>";print_r($data["total_com_info"]);die();





		$data['date'] = "show";



		if ($flag1 == "search") {
			redirect('admin/opd_com_list_date_wise/' . $start_date . '/' . $end_date . '/' . $flag);
		} else {
			$this->load->view('opd/today_com_payment_details', $data);
		}
	}

	public function opd_com_list_date_wise($start_date, $end_date, $flag)
	{

		$data['active'] = 'opd';
		$data['page_title'] = 'Opd Doctor Commission';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['flag'] = $flag;

		$data['date'] = "hide";


		$data["total_com"] = $this->admin_model->select_three_join_where('d.*,o.*,d.id as d_id,ot.*,d.paid_amount', 'doc_commission d', 'opd_patient_info o', 'o.id=d.patient_id', 'opd_patient_test_order_info ot', 'ot.id=d.order_id', 'date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '" AND o.status=1 and d.doc_type !=3 and d.total_gross_com != 0');

		$data["total_com_info"] = $this->admin_model->select_join_where('*', 'doc_commission_details dc', 'diagnostic_test_subgroup dt', 'dt.id=dc.service_id', 'date(dc.created_at) between "' . $start_date . '" AND "' . $end_date . '"');


		$this->load->view('opd/today_com_payment_details', $data);
	}


	public function com_payment_details($value = '')
	{

		$data['active'] = 'opd';
		$data['page_title'] = 'Doctor Commission Details';

		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$com_id = $this->uri->segment(3);
		$data['doc_name'] = $this->uri->segment(4);

		$data["total_com_info"] = $this->admin_model->select_five_join_where_group_by('*,op.created_at,d.id,d.paid_amount,dt.price', 'doc_commission d', 'opd_patient_info o', 'doc_commission_details dc', 'opd_patient_test_order_info op', 'diagnostic_test_subgroup dt', 'o.id=d.patient_id', 'd.id=dc.com_id', 'op.patient_id=o.id', 'dt.id=dc.service_id', 'd.id="' . $com_id . '" and op.status=1', 'dc.id');

		$this->load->view('opd/com_payment_details', $data);
	}


	public function com_update_payment($value = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Doctor Commission Details';

		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$com_id = $this->uri->segment(3);

		$flag = $this->uri->segment(4);

		$flag1 = $this->uri->segment(5);


		$total = $this->admin_model->select_with_where2('*', 'id="' . $com_id . '"', 'doc_commission');

		$test_order_id = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $total[0]['order_id'] . '"', 'opd_patient_test_order_info');

		$total_paid = $this->input->post('update_payment') + $total[0]['paid_amount'];

		$total_amount = $total[0]['total_commission'];

		if ($total_amount <= $total_paid) {
			$val['com_status'] = 1;
		} else if ($total_amount > $total_paid) {
			$val['com_status'] = 0;
		}


		$val['paid_amount'] = $total_paid;



		$this->admin_model->update_function2('id="' . $com_id . '" ', 'doc_commission', $val);

		// insert data into commission payment

		$data = array(
			'gross_com' => $total[0]['total_gross_com'],
			'sub_com' => $total[0]['total_test_discount'],
			'current_com' => $this->input->post('due') - $this->input->post('update_payment'),
			'old_com' => $this->input->post('due'),
			'com_id' => $com_id,
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'com_status' => $val['com_status'],
			'paid_com' => $this->input->post('update_payment'),
			'created_at' => date('Y-m-d H:i:s'),
			'doc_name' => $total[0]['doc_name'],
			'doc_id' => $total[0]['doc_id'],
			'doc_type' => $total[0]['doc_type']

		);
		$this->load->admin_model->insert('commission_payment', $data);

		if ($flag == "today") {
			redirect("admin/opd_today_com_list/" . $flag1);
		} else {
			redirect("admin/com_payment_details/" . $com_id);
		}
	}

	public function up_full_com_one_click($value = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Doctor Commission Details';

		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$com_id = $this->uri->segment(3);
		$start_date = $this->uri->segment(4);
		$end_date = $this->uri->segment(5);


		$total = $this->admin_model->select_with_where2('*', 'id="' . $com_id . '"', 'doc_commission');

		$test_order_id = $this->admin_model->select_with_where2('*', 'id="' . $total[0]['order_id'] . '" and status=1', 'opd_patient_test_order_info');

		$total_paid = $total[0]['total_commission'];

		$total_amount = $total[0]['total_commission'];

		if ($total_amount <= $total_paid) {
			$val['com_status'] = 1;
		} else if ($total_amount > $total_paid) {
			$val['com_status'] = 0;
		}


		$val['paid_amount'] = $total_paid;



		$this->admin_model->update_function2('id="' . $com_id . '" ', 'doc_commission', $val);

		$com_payment_info = $this->admin_model->get_last_row2('commission_payment', 'com_id="' . $com_id . '"');

		// insert data into commission payment

		$data = array(
			'gross_com' => $total[0]['total_gross_com'],
			'sub_com' => $total[0]['total_test_discount'],
			'current_com' => 0,
			'old_com' => $com_payment_info[0]['current_com'],
			'com_id' => $com_id,
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'com_status' => $val['com_status'],
			'paid_com' => $total_paid - $com_payment_info[0]['paid_com'],
			'created_at' => date('Y-m-d H:i:s'),
			'doc_name' => $total[0]['doc_name'],
			'doc_id' => $total[0]['doc_id'],
			'doc_type' => $total[0]['doc_type']

		);
		$this->load->admin_model->insert('commission_payment', $data);



		if ($start_date == null && $end_date == null) {
			redirect("admin/opd_com_list");
		} else {
			redirect("admin/opd_com_date_wise/" . $start_date . '/' . $end_date);
		}
	}


	public function up_full_com_one_click_doc_id($value = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Doctor Commission Details';

		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$com_id = $this->uri->segment(3);
		$doc_id = $this->uri->segment(4);
		$start_date = $this->uri->segment(5);
		$end_date = $this->uri->segment(6);


		$total = $this->admin_model->select_with_where2('*', 'id="' . $com_id . '"', 'doc_commission');

		$test_order_id = $this->admin_model->select_with_where2('*', 'id="' . $total[0]['order_id'] . '" and status=1', 'opd_patient_test_order_info');

		$total_paid = $total[0]['total_commission'];

		$total_amount = $total[0]['total_commission'];

		if ($total_amount <= $total_paid) {
			$val['com_status'] = 1;
		} else if ($total_amount > $total_paid) {
			$val['com_status'] = 0;
		}


		$val['paid_amount'] = $total_paid;



		$this->admin_model->update_function2('id="' . $com_id . '" ', 'doc_commission', $val);

		$com_payment_info = $this->admin_model->get_last_row2('commission_payment', 'com_id="' . $com_id . '"');

		// insert data into commission payment

		$data = array(
			'gross_com' => $total[0]['total_gross_com'],
			'sub_com' => $total[0]['total_test_discount'],
			'current_com' => 0,
			'old_com' => $com_payment_info[0]['current_com'],
			'com_id' => $com_id,
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'com_status' => $val['com_status'],
			'paid_com' => $total_paid - $com_payment_info[0]['paid_com'],
			'created_at' => date('Y-m-d H:i:s'),
			'doc_name' => $total[0]['doc_name'],
			'doc_id' => $total[0]['doc_id'],
			'doc_type' => $total[0]['doc_type']

		);
		$this->load->admin_model->insert('commission_payment', $data);



		if ($start_date == null && $end_date == null) {
			redirect("admin/opd_com_list_doc_id/" . $doc_id);
		} else {
			redirect("admin/opd_com_date_wise_doc_id/" . $doc_id . '/' . $start_date . '/' . $end_date);
		}
	}

	public function edit_opd_invoice($value = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Edit Outdoor Invoice';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$this->cart->destroy();

		$data['passed_order_id'] = $this->uri->segment(3);

		if ($data['passed_order_id'] != null) {
			$data['doc_id'] = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $data['passed_order_id'] . '"', 'opd_patient_test_order_info');
			$data['doc_id'] = $data['doc_id'][0]['quack_doc_id'];
		} else {
			$data['doc_id'] = 0;
		}

		// "<pre>";print_r($data['doc_id'][0]['quack_doc_id']);die();

		$data['test_info'] = $this->admin_model->select_join_where('*', 'diagnostic_test_group d', 'diagnostic_test_subgroup ds', 'd.test_id=ds.mtest_id', 'ds.status=1');

		$data['test_order_info'] = $this->admin_model->select_with_where2_decending('*', 'status=1', 'opd_patient_test_order_info', 'id');

		$data['doctor_info_ref'] = $this->admin_model->select_with_where2('*', 'doctor_type=1', 'doctor');

		$data['doctor_info_quack'] = $this->admin_model->select_with_where2('*', 'doctor_type=2', 'doctor');

		$data['discount_commission_type'] = $this->admin_model->select_all('discount_commission_type');

		$this->load->view('opd/edit_invoice', $data);
	}


	public function edit_opd_invoice_ajax($value = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Edit Outdoor Invoice';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];




		$data['passed_order_id'] = explode('#', $_POST['quack_doc_id']);

		// if($data['passed_order_id'][0]!=null)
		// {
		// 	$data['doc_id']=$this->admin_model->select_with_where2('*','status=1 and id="'.$data['passed_order_id'][0].'"','opd_patient_test_order_info'); 
		// }
		// else
		// {
		// 	$data['doc_id']=0;
		// }

		$data['doc_id'] = $data['passed_order_id'][0];

		// "<pre>";print_r($data['doc_id']);die();

		$data['test_info'] = $this->admin_model->select_join_where('*', 'diagnostic_test_group d', 'diagnostic_test_subgroup ds', 'd.test_id=ds.mtest_id', 'd.status=1 AND ds.status=1');

		$data['test_order_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'opd_patient_test_order_info');

		$data['doctor_info_ref'] = $this->admin_model->select_with_where2('*', 'doctor_type=1', 'doctor');

		$data['doctor_info_quack'] = $this->admin_model->select_with_where2('*', 'doctor_type=2', 'doctor');

		$this->load->view('opd/opd_edit_invoice_all_test', $data);
	}

	public function get_info_by_invoice_opd($value = '')
	{

		$val = $this->admin_model->select_join_five_table2('*,o.paid_amount,o.total_discount', 'opd_patient_info p', 'opd_patient_test_order_info o', 'doc_commission do', 'doc_commission_details dc', 'diagnostic_test_subgroup d', 'o.patient_id=p.id', 'do.order_id=o.id', 'dc.com_id=do.id', 'd.id=dc.service_id', 'o.test_order_id="' . $this->input->post('bill_no') . '" and o.status=1');

		$val1 = $this->admin_model->select_join_three_table2('*,o.paid_amount', 'opd_patient_test_order_info o', 'opd_patient_test_details_info ot', 'diagnostic_test_subgroup ds', 'o.id=ot.patient_test_order_id', 'ds.id=ot.patient_sub_test_id', 'o.test_order_id="' . $this->input->post('bill_no') . '" and o.status=1 and ot.type=2');


		$this->cart->destroy();

		foreach ($val as $key => $value) {

			$amount = 0;

			if ($value["amount"] < 0) {
				$amount = 0;
			} else {
				$amount = $value["amount"];
			}


			$data = array(
				"id"  => $value["id"],
				"name"  => $value["sub_test_title"],
				"qty"  => 1,
				"price"  => $value["price"],
				"options" => array("quk_ref_com" => $value["gross_amount"], "discount" => $value["total_discount"], "vat" => $value["vat"], "paid_amount" => $value["paid_amount"], "per_discount" => $value["sub_amount"], "net_amount" => $value["price"] - $value["total_discount"] + $value["vat"], "sub_com" => $amount, 'type' => $value['type'])

			);



			$this->cart->insert($data);
		}

		foreach ($val1 as $key => $value1) {


			$data = array(
				"id"  => $value1["id"],
				"name"  => $value1["sub_test_title"],
				"qty"  => 1,
				"price"  => $value1["price"],
				"options" => array("quk_ref_com" => 0, "discount" => $value["total_discount"], "vat" => $value["vat"], "paid_amount" => $value1["paid_amount"], "per_discount" => 0, "net_amount" => 0, "sub_com" => 0, 'type' => $value1['type'])
			);



			$this->cart->insert($data);
		}

		$data_add['main_test'] = count($val);

		// "<pre>";print_r($this->cart->contents());die();


		echo $this->load->view('opd/opd_edit_invoice_cart_details', $data_add);
	}


	public function get_com_this_test($value = '')
	{

		$data_add['main_test'] = 0;

		$cart = $this->cart->contents();

		foreach ($cart as $item) {

			if ($item['options']['type'] == 1) {
				$data_add['main_test'] += 1;
			}
		}


		$data['group_id'] = $this->admin_model->select_with_where2('*', 'id="' . $_POST['test_id'] . '"', 'diagnostic_test_subgroup');

		$data['last_row_info'] = $this->admin_model->get_last_row3('doc_com_id', 'doc_comission_distribution', 'group_id="' . $data['group_id'][0]['mtest_id'] . '" and testid=0 and doc_id="' . $_POST['doc_id'] . '"');

		$data['last_row_info1'] = $this->admin_model->get_last_row3('doc_com_id', 'doc_comission_distribution', 'group_id="' . $data['group_id'][0]['mtest_id'] . '" and testid="' . $_POST['test_id'] . '"
	 		and doc_id="' . $_POST['doc_id'] . '"');

		// echo json_encode($data['last_row_info']);
		// echo json_encode($data['last_row_info1']);


		$com = 0;

		if ($data['last_row_info'] == null && $data['last_row_info1'] != null) {
			if ($data['last_row_info1'][0]['com_type'] == 1) {
				$com = $_POST['price'] * ($data['last_row_info1'][0]['doc_comission'] / 100);
			} else if ($data['last_row_info1'][0]['com_type'] == 2) {
				$com = $data['last_row_info1'][0]['doc_comission'];
			}
		} else if ($data['last_row_info1'] == null && $data['last_row_info'] != null) {
			if ($data['last_row_info'][0]['com_type'] == 1) {
				$com = $_POST['price'] * ($data['last_row_info'][0]['doc_comission'] / 100);
			} else if ($data['last_row_info'][0]['com_type'] == 2) {
				$com = $data['last_row_info'][0]['doc_comission'];
			}
		} else if ($data['last_row_info'] != null && $data['last_row_info1'] != null) {
			if ($data['last_row_info'][0]['doc_com_id'] > $data['last_row_info1'][0]['doc_com_id']) {
				if ($data['last_row_info'][0]['com_type'] == 1) {
					$com = $_POST['price'] * ($data['last_row_info'][0]['doc_comission'] / 100);
				} else if ($data['last_row_info'][0]['com_type'] == 2) {
					$com = $data['last_row_info'][0]['doc_comission'];
				}
			} else {

				if ($data['last_row_info1'][0]['com_type'] == 1) {
					$com = $_POST['price'] * ($data['last_row_info1'][0]['doc_comission'] / 100);
				} else if ($data['last_row_info1'][0]['com_type'] == 2) {
					$com = $data['last_row_info1'][0]['doc_comission'];
				}
			}
		} else {
			$com = 0;
		}

		$per_discount = round($_POST["total_discount"] / $data_add['main_test'], 2);
		// $per_vat=round($_POST["total_vat"]/$data_add['main_test'],2);

		$dis_com_type = $this->admin_model->select_all('discount_commission_type');



		if ($dis_com_type[0]['type'] == 2) {
			$per_discount = round($per_discount / 2, 2);
		}


		$net_amount = $_POST["price"] - $_POST["total_discount"] + $_POST["vat"];

		$sub_amount = $com - $per_discount;

		if ($sub_amount < 0) {
			$sub_amount = 0;
		}

		$data = array(
			'rowid' => $_POST["row_id"],
			'id' => $_POST["test_id"],
			'name' => $_POST["test_name"],
			'qty' => 1,
			'price' => $_POST["price"],
			"options" => array(
				"quk_ref_com" => $com,
				"discount" => $_POST["total_discount"],
				"vat" => $_POST["vat"], "paid_amount" => $_POST["total_pa"], "per_discount" => $per_discount, "net_amount" => $net_amount, "sub_com" => $sub_amount, "type" => $_POST["type"]
			)
		);

		$this->cart->update($data);

		$data['group_id'] = $this->admin_model->select_with_where2('*', 'id="' . $_POST['test_id'] . '"', 'diagnostic_test_subgroup');

		$data['all_additional_test'] = $this->admin_model->select_with_where2('*', 'type=2 and status=1', 'diagnostic_test_subgroup');

		$rowid = "";
		$flag = 0;
		$data3 = array();

		foreach ($data['all_additional_test'] as $key => $value) {

			if (in_array($data['group_id'][0]['mtest_id'], explode(',', $value['group_id']))) {

				$data1 = array(
					"id"  => $value['id'],
					"name"  => $value['sub_test_title'],
					"qty"  => 1,
					"price"  => $value["price"],
					"options" => array(
						"quk_ref_com" => 0,
						"discount" => $_POST["total_discount"],
						"vat" => $_POST["vat"], "paid_amount" => $_POST["total_pa"], "per_discount" => $per_discount, "net_amount" => $net_amount, "sub_com" => $sub_amount, "type" => $value['type']
					)
				);

				$this->cart->insert($data1);

				foreach ($this->cart->contents() as $key => $value1) {

					if ($value1['options']['type'] == 2) {
						$data3[$key]['id'] = $value1['id'];
						$data3[$key]['name'] = $value1['name'];
						$data3[$key]['qty'] = 1;
						$data3[$key]['price'] = $value1['price'];
						$data3[$key]['options'] = array(
							"quk_ref_com" => 0,
							"discount" => $_POST["total_discount"],
							"vat" => $_POST["vat"], "paid_amount" => $_POST["total_pa"], "per_discount" => 0, "net_amount" => 0, "sub_com" => 0, "type" => $value1['options']['type']
						);

						$rowid = $value1['rowid'];

						$data2 = array(
							'rowid' => $rowid,
							'qty' => 0
						);
						$this->cart->update($data2);
					}
				}

				$this->cart->insert($data3);
			}
		}

		$data_add['main_test'] = 0;

		foreach ($this->cart->contents() as $item1) {

			if ($item1['qty'] > 1) {
				$rowid = $item1['rowid'];
				$data4 = array(
					'rowid' => $rowid,
					'qty' => 1
				);
				$this->cart->update($data4);
			}

			if ($item1['options']['type'] == 1) {
				$data_add['main_test'] += 1;
			}
		}

		echo $this->load->view('opd/opd_edit_invoice_cart_details', $data_add);
	}

	public function get_patient_info_by_bill($value = '')
	{
		$data['patient_info'] = $this->admin_model->select_join_where('*', 'opd_patient_info o', 'opd_patient_test_order_info p', 'o.id=p.patient_id', 'p.status=1 and p.test_order_id="' . $_POST['bill_no'] . '"');


		$data['doctor_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		// $data['doctor_info_quack']=$this->admin_model->select_with_where2('*','doctor_type=2','doctor');



		echo json_encode($data);
	}

	public function opd_daywise_collection_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		$data['active'] = 'opd';
		$data['page_title'] = 'OPD Daywise Collection';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$data['opd_collection'] = $this->admin_model->select_daywise_opd_report($start_date, $end_date);
		$this->load->view('opd/opd_patient_daywise_collection_print_view', $data);
	}

	////upper function for opd daywise collection search//////////////////


	public function opd_daywise_amnt_collection_report($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		$data['active'] = 'opd';
		$data['page_title'] = 'OPD Daywise amount Collection';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];




		$flag = $this->uri->segment(3);


		redirect('admin/opd_daywise_amnt_collection_report_next/' . $start_date . '/' . $end_date . '/' . $flag);
	}

	public function date_wise_balance_sheet_opd()
	{
		redirect('admin/date_wise_balance_sheet/opd');
	}



	public function opd_daywise_amnt_collection_report_next($start_date, $end_date, $flag)
	{


		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		if ($flag == "sum") {
			$data["patient_test_order_info"] = $this->admin_model->select_join_three_table2('*,opd_patient_test_order_info.patient_id,patient_info_id,patient_name,opd_patient_test_order_info.operator_name,
	 			opd_patient_info.age,gender,total_amount,opd_patient_test_order_info.paid_amount,vat,doc_commission.paid_amount as com_paid,
	 			(total_amount-opd_patient_test_order_info.paid_amount) as due,total_discount,vat as total_vat,opd_patient_test_order_info.created_at,mobile_no', 'opd_patient_info', 'opd_patient_test_order_info', 'doc_commission', 'opd_patient_info.id=opd_patient_test_order_info.patient_id', 'doc_commission.order_id=opd_patient_test_order_info.id', 'date(opd_patient_test_order_info.created_at) between "' . $start_date . '" and "' . $end_date . '" AND opd_patient_test_order_info.status=1 AND opd_patient_info.status=1');

			$this->load->view('opd/opd_payment_collection', $data);
		} else {
			$data["patient_test_order_info"] = $this->admin_model->select_join_where('*,d.created_at, d.operator_name,d.operator_id', 'due_collection d', 'opd_patient_info o', 'd.patient_id=o.id', 'date(d.created_at)between "' . $start_date . '" and "' . $end_date . '" AND d.due_type=1 and d.status=1');


			$this->load->view('opd/opd_datewise_collection', $data);
		}
	}



	public function opd_com_list_report()
	{
		$data['active'] = 'Doctor Commission Report';
		$data['page_title'] = 'Manage Doctor Commission Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['comission_list'] = $this->admin_model->select_three_join_where('doc_commission.id,patient_info_id,patient_name,opd_patient_info.age,gender,mobile_no,opd_patient_test_order_info.patient_id,doc_commission.patient_id,total_commission,doc_commission.paid_amount,doc_commission.com_status,doc_commission.created_at,doc_commission.paid_amount,doc_commission.doc_name,opd_patient_test_order_info.status', 'opd_patient_info', 'opd_patient_test_order_info', 'opd_patient_info.id=opd_patient_test_order_info.patient_id', 'doc_commission', 'doc_commission.patient_id=opd_patient_info.id', 'date(doc_commission.created_at) = "' . date('Y-m-d') . '"  AND doc_commission.doc_type=2 AND opd_patient_test_order_info.status=1');

		$this->load->view('opd/doc_com_report', $data);
	}


	public function commission_summary($value = '')
	{

		$data['active'] = 'Doctor Commission Report';
		$data['page_title'] = 'Manage Doctor Commission Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$curdate = date('Y-m-d');

		$flag = $this->uri->segment(3);

		$data['flag'] = $flag;

		if ($flag == "qc") {
			$data["com_info"] = $this->admin_model->get_charge_sum_where_group_by_four_join('*,commission_payment.created_at', 'paid_com', 'doc_commission', 'date(commission_payment.created_at)="' . $curdate . '" AND doc_commission.doc_type=2 AND doc_commission.status=1 and opd_patient_test_order_info.status=1', 'doc_commission.id', 'commission_payment', 'doc_commission.id=commission_payment.com_id', 'doctor', 'doctor.doctor_id=doc_commission.doc_id', 'opd_patient_info', 'opd_patient_info.id=doc_commission.patient_id', 'opd_patient_test_order_info', 'opd_patient_test_order_info.id=doc_commission.order_id');

			// "<pre>";print_r($data["com_info"]);die();

			$this->load->view('opd/commission_summary', $data);
		} else {
			$data["com_info"] = $this->admin_model->get_charge_sum_where_group_by_four_join('*,commission_payment.created_at', 'paid_com', 'doc_commission', 'date(commission_payment.created_at)="' . $curdate . '" AND doc_commission.doc_type=1 AND doc_commission.status=1 and opd_patient_test_order_info.status=1', 'doc_commission.id', 'commission_payment', 'doc_commission.id=commission_payment.com_id', 'doctor', 'doctor.doctor_id=doc_commission.doc_id', 'opd_patient_info', 'opd_patient_info.id=doc_commission.patient_id', 'opd_patient_test_order_info', 'opd_patient_test_order_info.id=doc_commission.order_id');

			// "<pre>";print_r($data["com_info"]);die();

			$this->load->view('opd/commission_summary', $data);
		}
	}


	public function commission_summary_report($value = '')
	{

		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		$flag = $this->uri->segment(3);
		// $paid_status=$this->input->post('paid_status');

		redirect('admin/commission_summary_report_next/' . $start_date . '/' . $end_date . '/' . $flag);
	}


	public function commission_summary_report_next($start_date, $end_date, $flag)
	{

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		if ($flag = "qc") {
			$data["com_info"] = $this->admin_model->get_charge_sum_where_group_by_four_join('*,commission_payment.created_at', 'paid_com', 'doc_commission', 'date(commission_payment.created_at) between "' . $start_date . '" AND "' . $end_date . '" AND doc_commission.doc_type=2 AND doc_commission.status=1 and opd_patient_test_order_info.status=1', 'doc_commission.id', 'commission_payment', 'doc_commission.id=commission_payment.com_id', 'doctor', 'doctor.doctor_id=doc_commission.doc_id', 'opd_patient_info', 'opd_patient_info.id=doc_commission.patient_id', 'opd_patient_test_order_info', 'opd_patient_test_order_info.id=doc_commission.order_id');

			$this->load->view('opd/commission_summary_report', $data);
		} else {
			$data["com_info"] = $this->admin_model->get_charge_sum_where_group_by_four_join('*,commission_payment.created_at', 'paid_com', 'doc_commission', 'date(commission_payment.created_at) between "' . $start_date . '" AND "' . $end_date . '" AND doc_commission.doc_type=1 AND doc_commission.status=1 and opd_patient_test_order_info.status=1', 'doc_commission.id', 'commission_payment', 'doc_commission.id=commission_payment.com_id', 'doctor', 'doctor.doctor_id=doc_commission.doc_id', 'opd_patient_info', 'opd_patient_info.id=doc_commission.patient_id', 'opd_patient_test_order_info', 'opd_patient_test_order_info.id=doc_commission.order_id');

			$this->load->view('opd/commission_summary_report', $data);
		}
	}

	public function opd_com_list_report_print_view()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$paid_status = $this->input->post('paid_status');

		redirect('admin/opd_com_list_report_print_view_next/' . $start_date . '/' . $end_date . '/' . $paid_status);


		// $data['comission_list']=$this->admin_model->select_three_join('doc_commission.id,patient_info_id,patient_name,age,gender,mobile_no,opd_patient_test_order_info.patient_id,doc_commission.patient_id,total_commission,doc_commission.paid_amount,doc_commission.status,doc_commission.paid_amount,doc_commission.doc_name','opd_patient_info','opd_patient_test_order_info','opd_patient_info.id=opd_patient_test_order_info.patient_id','doc_commission','doc_commission.patient_id=opd_patient_info.id');

		// redirect('admin/opd_doc_com_pview',$data);

	}

	public function opd_com_list_report_print_view_next($start_date, $end_date, $paid_status)
	{

		$data['active'] = '';
		$data['page_title'] = 'Doc Commission Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		if ($paid_status == 1) {
			$data['comission_list'] = $this->admin_model->select_three_join_where('opd_patient_test_order_info.test_order_id,doc_commission.id,patient_info_id,patient_name,opd_patient_info.age,gender,mobile_no,opd_patient_test_order_info.patient_id,doc_commission.patient_id,total_commission,doc_commission.paid_amount,doc_commission.com_status,doc_commission.created_at,opd_patient_test_order_info.status,doc_commission.paid_amount,doc_commission.doc_name', 'opd_patient_info', 'opd_patient_test_order_info', 'opd_patient_info.id=opd_patient_test_order_info.patient_id', 'doc_commission', 'doc_commission.patient_id=opd_patient_info.id', 'date(doc_commission.created_at) between "' . $start_date . '" and "' . $end_date . '" AND opd_patient_test_order_info.status=1 and doc_commission.doc_type !=3');

			$data['paid_status'] = "All";
		} else if ($paid_status == 2) {

			$data['comission_list'] = $this->admin_model->select_three_join_where('opd_patient_test_order_info.test_order_id,doc_commission.id,patient_info_id,patient_name,opd_patient_info.age,gender,mobile_no,opd_patient_test_order_info.patient_id,doc_commission.patient_id,total_commission,doc_commission.paid_amount,doc_commission.com_status,doc_commission.created_at,doc_commission.paid_amount,doc_commission.doc_name,opd_patient_test_order_info.status', 'opd_patient_info', 'opd_patient_test_order_info', 'opd_patient_info.id=opd_patient_test_order_info.patient_id', 'doc_commission', 'doc_commission.patient_id=opd_patient_info.id', 'date(doc_commission.created_at) between "' . $start_date . '" and "' . $end_date . '" AND opd_patient_test_order_info.status=1 AND doc_commission.com_status=1 and doc_commission.doc_type !=3');

			$data['paid_status'] = "Paid";
		} else {
			$data['comission_list'] = $this->admin_model->select_three_join_where('opd_patient_test_order_info.test_order_id,doc_commission.id,patient_info_id,patient_name,opd_patient_info.age,gender,mobile_no,opd_patient_test_order_info.patient_id,doc_commission.patient_id,total_commission,doc_commission.paid_amount,doc_commission.com_status,doc_commission.created_at,doc_commission.paid_amount,doc_commission.doc_name,opd_patient_test_order_info.status', 'opd_patient_info', 'opd_patient_test_order_info', 'opd_patient_info.id=opd_patient_test_order_info.patient_id', 'doc_commission', 'doc_commission.patient_id=opd_patient_info.id', 'date(doc_commission.created_at) between "' . $start_date . '" and "' . $end_date . '" AND opd_patient_test_order_info.status=1 AND doc_commission.com_status=0 and doc_commission.doc_type !=3');

			$data['paid_status'] = "UnPaid";
		}

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;




		$this->load->view('opd/doc_com_report_print_view', $data);
	}

	// public function opd_com_summary()
	// {
	// 	$data['active']='Doctor Commission Report';
	//     $data['page_title']='Manage Doctor Commission Report';
	//     $data['admin_type']=$this->session->userdata['logged_in']['role'];
	//     if($data['admin_type']==3)
	//     {
	//       $data['username']=$this->session->userdata['logged_in']['username'];
	//       $data['hospital_id']=$this->session->userdata['logged_in']['hospital_id'];
	//       $id=$data['hospital_id'];
	//       $data['hospital']=$this->admin_model->select_with_where2('*','hospital_id="'.$id.'"','hospital');
	//       $data['hospital_ttile']=$data['hospital'][0]['hospital_title'];
	//       }
	//           else
	//       {

	//       $data['username']=$this->session->userdata['logged_in']['username'];
	//       $data['hospital_id']="";
	//       $id="";
	//       $data['hospital']="";
	//       $data['hospital_ttile']="Admin";

	//       }




	//    $this->load->view('opd/doc_com_report',$data);


	// }



	public function doc_com_summary($value = '')
	{

		$data['active'] = '';
		$data['page_title'] = 'Doc Commission Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['doc_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['comission_summary'] = $this->admin_model->select_join_three_table2('*,d.status,d.created_at', 'doc_commission d', 'doc_commission_details dc', 'diagnostic_test_subgroup dt', 'd.id=dc.com_id', 'dt.id=dc.service_id', 'DATE(d.created_at)="' . date('Y-m-d') . '"  AND d.doc_type IN (1,2) AND d.status=1');

		$this->load->view('opd/doc_com_summary', $data);
	}



	public function opd_com_summary_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$doc_id = $this->input->post('doc_name');

		redirect('admin/opd_com_summary_report_next/' . $start_date . '/' . $end_date . '/' . $doc_id);


		// $data['comission_list']=$this->admin_model->select_three_join('doc_commission.id,patient_info_id,patient_name,age,gender,mobile_no,opd_patient_test_order_info.patient_id,doc_commission.patient_id,total_commission,doc_commission.paid_amount,doc_commission.status,doc_commission.paid_amount,doc_commission.doc_name','opd_patient_info','opd_patient_test_order_info','opd_patient_info.id=opd_patient_test_order_info.patient_id','doc_commission','doc_commission.patient_id=opd_patient_info.id');

		// redirect('admin/opd_doc_com_pview',$data);

	}

	public function opd_com_summary_report_next($start_date, $end_date, $doc_id)
	{

		$data['active'] = '';
		$data['page_title'] = 'Doc Commission Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		if ($doc_id == 0) {
			$data['comission_summary'] = $this->admin_model->select_join_three_table2('*,d.status,d.created_at', 'doc_commission d', 'doc_commission_details dc', 'diagnostic_test_subgroup dt', 'd.id=dc.com_id', 'dt.id=dc.service_id', 'DATE(d.created_at) between "' . $start_date . '" and "' . $end_date . '" AND d.doc_type IN (1,2) AND d.status=1');

			$data['doc_id'] = "All";


			// "<pre>";print_r($data['comission_summary']);die();

		} else {
			$data['comission_summary'] = $this->admin_model->select_join_three_table2('*,d.status,d.created_at', 'doc_commission d', 'doc_commission_details dc', 'diagnostic_test_subgroup dt', 'd.id=dc.com_id', 'dt.id=dc.service_id', 'd.doc_id="' . $doc_id . '" AND DATE(d.created_at) between "' . $start_date . '" and "' . $end_date . '" AND d.doc_type IN (1,2) AND d.status=1');

			if ($data['comission_summary'] != null) {
				$data['doc_id'] = $data['comission_summary'][0]['doc_name'];
			} else {
				$data['doc_id'] = "";
			}
		}

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;


		$this->load->view('opd/doc_com_summary_report', $data);
	}




	public function doc_com_testwise($value = '')
	{

		$data['active'] = '';
		$data['page_title'] = 'Doc Commission Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];




		$data['test_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'diagnostic_test_subgroup');

		$this->load->view('opd/doc_com_testwise', $data);
	}



	public function doc_com_testwise_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$test_id = $this->input->post('test_id');

		redirect('admin/doc_com_testwise_report_next/' . $start_date . '/' . $end_date . '/' . $test_id);


		// $data['comission_list']=$this->admin_model->select_three_join('doc_commission.id,patient_info_id,patient_name,age,gender,mobile_no,opd_patient_test_order_info.patient_id,doc_commission.patient_id,total_commission,doc_commission.paid_amount,doc_commission.status,doc_commission.paid_amount,doc_commission.doc_name','opd_patient_info','opd_patient_test_order_info','opd_patient_info.id=opd_patient_test_order_info.patient_id','doc_commission','doc_commission.patient_id=opd_patient_info.id');

		// redirect('admin/opd_doc_com_pview',$data);

	}

	public function doc_com_testwise_report_next($start_date, $end_date, $test_id)
	{

		$data['active'] = '';
		$data['page_title'] = 'Doc Commission Test Wise Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		if ($test_id == 0) {

			$data['comission_testwise'] = $this->admin_model->get_charge_sum_where_group_by_two_join('*', 'dc.amount', 'doc_commission d', 'DATE(d.created_at) between "' . $start_date . '" and "' . $end_date . '"', 'dc.service_id', 'doc_commission_details dc', 'd.id=dc.com_id', 'diagnostic_test_subgroup dt', 'dt.id=dc.service_id');


			$data['comission_info'] = $this->admin_model->select_join_where('*,d.created_at', 'doc_commission d', 'doc_commission_details dc', 'd.id=dc.com_id', 'DATE(d.created_at) between "' . $start_date . '" and "' . $end_date . '"');



			// "<pre>";print_r($data['comission_testwise']);
			// "<pre>";print_r($data['comission_info']);
			// die();

			$data['test_id'] = "All";
		} else {
			$data['comission_testwise'] = $this->admin_model->get_charge_sum_where_group_by_two_join('*', 'dc.amount', 'doc_commission d', 'DATE(d.created_at) between "' . $start_date . '" and "' . $end_date . '" and dc.service_id="' . $test_id . '"', 'dc.service_id', 'doc_commission_details dc', 'd.id=dc.com_id', 'diagnostic_test_subgroup dt', 'dt.id=dc.service_id');



			$data['comission_info'] = $this->admin_model->select_join_where('*,d.created_at', 'doc_commission d', 'doc_commission_details dc', 'd.id=dc.com_id', 'DATE(d.created_at) between "' . $start_date . '" and "' . $end_date . '" and dc.service_id="' . $test_id . '"');


			$data['test_id'] = "Individual";
		}

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;


		$this->load->view('opd/doc_com_testwise_report', $data);
	}


	public function test_group_wise_collection($value = '')
	{
		$data['active'] = '';
		$data['page_title'] = 'Group Wise Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['specimen'] = $this->admin_model->select_with_where2('*', 'status=1', 'add_specimen');

		$this->load->view('opd/test_group_wise_collection', $data);
	}


	public function test_group_wise_collection_report($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$specimen = $this->input->post('specimen');

		redirect('admin/test_group_wise_collection_report_next/' . $start_date . '/' . $end_date . '/' . $specimen);
	}





	public function test_group_wise_collection_report_next($start_date, $end_date, $specimen)
	{

		if ($specimen == "all") {




			$data['test_info'] = $this->admin_model->select_three_join_where_group_by('*,o.created_at,o.status,count(o.patient_sub_test_id) as total_test', 'opd_patient_test_details_info o', 'diagnostic_test_subgroup ds', 'o.patient_sub_test_id=ds.id', 'diagnostic_test_group d', 'd.test_id=ds.mtest_id', 'o.status=1 and date(o.created_at) between "' . $start_date . '" and "' . $end_date . '"', 'ds.id');


			$data['specimen_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'add_specimen');

			$data['specimen'] = "All";

			// "<pre>";print_r($data['test_info']);die();




		} else {


			$data['test_info'] = $this->admin_model->select_three_join_where_group_by('*,o.created_at,o.status,count(o.patient_sub_test_id) as total_test', 'opd_patient_test_details_info o', 'diagnostic_test_subgroup ds', 'o.patient_sub_test_id=ds.id', 'diagnostic_test_group d', 'd.test_id=ds.mtest_id', 'o.status=1 and date(o.created_at) between "' . $start_date . '" and "' . $end_date . '"', 'ds.id');


			$data['specimen_info'] = $this->admin_model->select_with_where2('*', 'id="' . $specimen . '"', 'add_specimen');


			if ($data['test_info'] != null) {
				$data['specimen'] = $data['test_info'][0]['speciman'];
			} else {
				$data['specimen'] = "";
			}
		}

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;




		$this->load->view('opd/test_group_wise_collection_report', $data);
	}


	public function outdoor_due_collection($value = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'outdoor due collection';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['all_opd_patient_id'] = $this->admin_model->select_join_where('*,o.id', 'opd_patient_info o', 'opd_patient_test_order_info p', 'o.id=p.patient_id', 'p.status=1 AND p.payment_status="unPaid"');

		$this->load->view('opd/outdoor_due_collection', $data);
	}


	public function get_patient_bill_info_by_patient_id($value = '')
	{
		$patient_id = $_POST['p_id'];

		$data['patient_id'] = $patient_id;


		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'id="' . $patient_id . '"', 'opd_patient_info');

		$data['doctor_info_ref'] = $this->admin_model->select_with_where2('*', 'doctor_type=1', 'doctor');

		$data['doctor_info_quack'] = $this->admin_model->select_with_where2('*', 'doctor_type=2', 'doctor');



		$data["patient_order_info"] = $this->admin_model->select_with_where2('*', 'patient_id="' . $patient_id . '" AND status=1', 'opd_patient_test_order_info');

		$data["patient_test_details_info"] = $this->admin_model->select_join_where('*', 'opd_patient_test_details_info p', 'diagnostic_test_subgroup d', 'd.id=p.patient_sub_test_id', 'p.status=1 AND d.status=1 AND p.patient_test_order_id="' . $data["patient_order_info"][0]['id'] . '"');

		$data['order_id'] = $data["patient_order_info"][0]['id'];

		$this->load->view('opd/get_patient_bill_info_ajax', $data);
	}


	public function delete_reason_text($value = '')
	{


		$flag = $this->uri->segment(3);


		$order_id = $this->input->post('o_id');

		$long_order_id = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $order_id . '"', 'opd_patient_test_order_info');

		$com_id = $this->admin_model->select_with_where2('*', 'id="' . $order_id . '"', 'doc_commission');


		$val['status'] = 2;

		$val['deleted_at'] = date('Y-m-d h:i:s');

		$val['delete_reason_text'] = $this->input->post('delete_reason');


		// update opd test order table

		$this->load->admin_model->update_function2('id="' . $order_id . '"', 'opd_patient_test_order_info', $val);



		// update due collection table

		$due_data['status'] = 2;

		$this->admin_model->update_function2('order_id="' . $long_order_id[0]['test_order_id'] . '" and due_type=1', 'due_collection', $due_data);

		// update pathology

		$this->load->admin_model->update_function2('order_id="' . $order_id . '"', 'pathologoy', $due_data);

		// update multi result table

		$this->load->admin_model->update_function2('order_id="' . $order_id . '"', 'multi_result', $due_data);



		// update commission payment table

		$this->admin_model->update_function2('com_id="' . $com_id[0]['id'] . '"', 'commission_payment', $due_data);


		// update doc com table

		$this->admin_model->update_function2('order_id="' . $order_id . '"', 'doc_commission', $due_data);


		// update opd test order details table

		$this->admin_model->update_function2('patient_test_order_id="' . $order_id . '"', 'opd_patient_test_details_info', $due_data);


		if ($flag == "all") {
			redirect("admin/show_all_opd_patient");
		} else if ($flag == "paid") {
			redirect("admin/show_all_paid_opd_patient");
		} else if ($flag == "unpaid") {
			redirect("admin/show_all_unpaid_opd_patient");
		} else {
			redirect("admin/opd_all_billing_info");
		}
	}

	public function edit_opd_patient_info($value = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Edit Outdoor Patient Info';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$patient_id = $this->uri->segment(3);

		$data['flag'] = $this->uri->segment(4);

		$data['all_blood_group'] = $this->admin_model->select_with_where2('*', 'status=1', 'blood_group');

		$data['patient_info'] = $this->admin_model->select_with_where2('*,date(date_of_birth)', 'id="' . $patient_id . '"', 'opd_patient_info');

		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$this->load->view('opd/edit_opd_patient_info', $data);
	}


	public function update_edit_info_opd($value = '')
	{

		$flag = $this->uri->segment(3);



		$age1 = explode(" ", $this->input->post('age'));

		if ($this->input->post('age_code') == 1) {
			$age = $age1[0] . " Day";
		} else if ($this->input->post('age_code') == 2) {
			$age = $age1[0] . " Month";
		} else {
			$age = $age1[0] . " Year";
		}


		$ref_doc_name = explode('#', $this->input->post('ref_doc_name'));

		$quack_doc_name = explode('#', $this->input->post('quack_doc_name'));




		// "<pre>";print_r($ref_doc_name[0]);die();

		$id = $this->input->post('p_id');

		if ($_FILES['file']['name']) {
			$name_generator = $this->name_generator($_FILES['file']['name'], $id);
			$i_ext = explode('.', $_FILES['file']['name']);
			$target_path = $name_generator . '.' . end($i_ext);;
			$size = getimagesize($_FILES['file']['tmp_name']);

			if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/patient_image/' . $target_path)) {
				$patient_image = $target_path;
			}
		}

		$data = array(
			'ref_doctor_name' => $ref_doc_name[0],
			'quack_doc_name' => $quack_doc_name[0],
			'patient_name' => $this->input->post('patient_name'),
			'ref_doctor_id' => $ref_doc_name[1],
			'address' => $this->input->post('patient_address'),
			'age' => $age,
			'date_of_birth' => $this->input->post('date_of_birth'),
			'gender' => $this->input->post('gender'),
			'blood_group' => $this->input->post('blood_group'),
			'mobile_no' => $this->input->post('patient_mobile_no'),
			'operator_name' => $this->input->post('operator_name'),
			'hospital_id' => $this->input->post('hospital_id'),
			'created_at' => date('Y-m-d H:i:s'),
			'quack_doc_id' => $quack_doc_name[1],
			'profile_img' => $patient_image

		);

		// if(!$this->is_mobile_exist($this->input->post('patient_mobile_no')))
		// {
		$this->load->admin_model->update_function2('id="' . $this->input->post('p_id') . '"', 'opd_patient_info', $data);

		if ($flag == "all") {
			redirect("admin/show_all_opd_patient");
		} else if ($flag == "paid") {
			redirect("admin/show_all_paid_opd_patient");
		} else if ($flag == "unpaid") {
			redirect("admin/show_all_unpaid_opd_patient");
		}
	}

	public function cancel_invoice_list($value = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Cancel Invoice List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		// $data['cancel_patient_info']=$this->load->admin_model->select_join_where('*,p.created_at as c_date,p.id as o_id','opd_patient_info o','opd_patient_test_order_info p','p.patient_id=o.id','o.status=2 AND p.status=2');

		$this->load->view('opd/cancel_invoice_list', $data);
	}


	public function cancel_invoice_list_dt()
	{

		$select_column = '*,p.created_at as c_date,p.id as p_id';
		$order_column = array('p_id', 'patient_info_id', 'patient_name', 'mobile_no', 'test_order_id', null, null, null);

		$search_column = array('patient_name', 'patient_info_id', 'mobile_no', 'reason');

		$condition = "p.status=2";


		$fetch_data = $this->admin_model->make_datatables_two_table_join('opd_patient_test_order_info p', $condition, $select_column, $order_column, $search_column, 'opd_patient_info o', 'o.id=p.patient_id', 'p_id');

		// "<pre>";print_r(expression);die();

		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->patient_info_id;
			$sub_array[] = $row->patient_name;
			$sub_array[] = $row->mobile_no;
			$sub_array[] = $row->test_order_id;
			$sub_array[] = date('d-M-y', strtotime($row->c_date));
			$sub_array[] = $row->delete_reason_text;

			if ($row->payment_status == "paid") {
				$sub_array[] = '<span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>';
			} else {
				$sub_array[] = '<span class="badge badge-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
			}


			$sub_array[] = '<a href="admin/opd_each_billing_details/' . $row->patient_id . '/' . $row->p_id . '/cancel" class="btn btn-primary btn-sm">Details</a>';


			$sub_array[] = '<a href="admin/opd_each_patient_pdf/' . $row->patient_id . '/' . $row->p_id . '/' . $row->is_ipd_patient . '" onclick="window.open(this.href, ' . "windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable" . '); return false;">Print</a>';

			$sub_array[] = date('d-M-y', strtotime($row->deleted_at));


			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('opd_patient_test_order_info p', $condition, $select_column, 'opd_patient_info o', 'o.id=p.patient_id'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
				'opd_patient_test_order_info p',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'opd_patient_info o',
				'o.id=p.patient_id',
				'p_id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	public function outdoor_due_collection_report($value = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Outdoor Due Collection';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['due_collection_info'] = $this->admin_model->select_join_three_table2('d.paid_due,d.operator_name as o_name,d.created_at as c_at, p.*,o.*, p.id as order_id, o.id as patient_id', 'due_collection d', 'opd_patient_test_order_info p', 'opd_patient_info o', 'p.test_order_id=d.order_id', 'o.id=p.patient_id', 'd.status=1 and d.due_type=1 AND d.paid_due > 0 and p.status=1 AND date(d.created_at)="' . date('Y-m-d') . '" AND date(p.created_at)!="' . date('Y-m-d') . '"');

		// $data['due_collection_info']=$this->load->admin_model->select_join_three_table2_group_by_sum('d.paid_due','p.*,o.*','due_collection d','opd_patient_test_order_info p','opd_patient_info o','p.test_order_id=d.order_id','o.id=p.patient_id','d.due_type=1 AND p.created_at != "'.date('Y-m-d').'" AND p.status=1 AND date(d.created_at)="'.date('Y-m-d').'"','p.id');

		// $data['today_collection_id']=$this->admin_model->select_with_where2('*','status=1 AND created_at="'.date('Y-m-d').'"','opd_patient_test_order_info');

		$this->load->view('opd/outdoor_due_collection_report', $data);
	}

	public function outdoor_due_collection_report_date_wise()
	{

		$start_date = $this->input->post('start_date');

		$end_date = $this->input->post('end_date');


		redirect('admin/outdoor_due_collection_report_date_wise_next/' . $start_date . '/' . $end_date);
	}


	public function outdoor_due_collection_report_date_wise_next($start_date, $end_date)
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'Opd Doctor Commission';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;


		$data['due_collection_info'] = $this->admin_model->select_join_three_table2('d.paid_due,d.operator_name as o_name,d.created_at as c_at, p.*,o.*, p.id as order_id, o.id as patient_id', 'due_collection d', 'opd_patient_test_order_info p', 'opd_patient_info o', 'p.test_order_id=d.order_id', 'o.id=p.patient_id', 'd.status=1 and d.due_type=1 AND p.status=1 and d.paid_due > 0 AND date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '" AND date(p.created_at) != date(d.created_at)');

		// $data['due_collection_info']=$this->load->admin_model->select_join_three_table2('*','due_collection d','opd_patient_test_order_info p','opd_patient_info o','p.test_order_id=d.order_id','o.id=p.patient_id','d.due_type=1 AND p.status=1 AND date(d.created_at) between "'.$start_date.'" AND "'.$end_date.'"');

		$this->load->view('opd/outdoor_due_collection_report_day_wise', $data);
	}


	public function get_all_patient_id_opd()
	{
		$data = $this->admin_model->select_with_where('patient_info_id', 1, 'opd_patient_info', 'status');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}



	// Ratul Vai Part


	public function assign_doc_comission($doc_id)
	{
		$doc_id = $doc_id;
		$data['active'] = 'Assign Doc Comission';
		$data['page_title'] = 'Manage  Doc Comission';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['doc_id'] = $doc_id;
		$data['doctor'] = $this->admin_model->select_with_where2('*', 'doctor_id="' . $doc_id . '"', 'doctor');
		$data['doctor_title'] = $data['doctor'][0]['doctor_title'];

		$data['test_group'] = $this->admin_model->select_with_where2('test_id,test_title', 'status=1', 'diagnostic_test_group');

		$data['test'] = $this->admin_model->select_with_where2('*', 'status=1', 'diagnostic_test_subgroup');


		$exists_count = $this->admin_model->count_with_where('*', 'status=1', 'diagnostic_test_group');

		$data['group_count'] = $exists_count;

		$this->load->view('doctor/doc_com_assign', $data);
	}


	public function select_test_name()
	{
		$group_id = $this->input->post('group_id');
		$test = $this->admin_model->select_with_where2('*', 'mtest_id=' . $group_id, 'diagnostic_test_subgroup');



		echo '<option  disabled="disabled">Choose Test</option>';
		echo '<option value="all" onclick=fun_test()>All</option>';


		foreach ($test as $key => $row) {
			echo "<option value=" . $row['id'] . ">" . $row['sub_test_title'] . " (" . $row['price'] . " /=BDT)" . "</option>";
		}
	}

	public function select_test_name_selected()
	{
		$group_id = $this->input->post('val1');
		$test = $this->admin_model->select_with_where2('*', 'mtest_id=' . $group_id, 'diagnostic_test_subgroup');



		echo '<option  disabled="disabled">Choose Test</option>';
		echo '<option value="all" selected>All</option>';
		foreach ($test as $key => $row) {
			echo "<option value=" . $row['id'] . ">" . $row['sub_test_title'] . " (" . $row['price'] . " /=BDT)" . "</option>";
		}
	}

	// public function doc_comission_add()
	//    {
	//    	echo "Test";
	//    	echo "</br>";
	//    	$add_by=$this->input->post('add_by');   	
	//    	$hospital_id=$this->input->post('hospital_id');
	//    	echo $hospital_id;
	//    	$doc_id=$this->input->post('doc_id');
	//    	$group_id=$this->input->post('group_id');
	//    	$test_name=$this->input->post('test_name');
	//    	$com_type=$this->input->post('com_type');
	//    	$com_amnt=$this->input->post('com_amnt');
	//     echo $group_id;

	//    }	


	public function doc_comission_add()
	{
		$add_by = $this->input->post('add_by');
		$hospital_id = $this->input->post('hospital_id');
		$doc_id = $this->input->post('doc_id');
		$group_id = $this->input->post('group_id');
		// $test_name=$this->input->post('test_name_1');
		$com_type = $this->input->post('com_type');
		$com_amnt = $this->input->post('com_amnt');



		$add_date = date('Y-m-d H:i:s');
		$add_date_time = date('Y-m-d H:i:s');
		$tcnt = count($group_id);

		for ($i = 0; $i < $tcnt; $i++) {
			$k = $i + 1;
			$test_name = $this->input->post('test_name_' . $k);

			if ($test_name['0'] == "all") {
				$data['add_by'] = $add_by;
				$data['hospital_id'] = $hospital_id;
				$data['doc_id'] = $doc_id;
				$data['group_id'] = $group_id[$i];
				$data['testid'] = 0;
				$data['price'] = 0;
				$data['doc_comission'] = $com_amnt[$i];
				$data['com_type'] = $com_type[$i];
				$data['add_date_time'] = date('Y-m-d H:i:s');
				$data['add_date'] = date('Y-m-d');

				if ($com_amnt[$i] != null) {
					$id = $this->admin_model->insert_ret('doc_comission_distribution', $data);
				}
			} else {
				$total_test = count($test_name);
				for ($j = 0; $j < $total_test; $j++) {

					$datam['diagnostic_test_subgroup'] = $this->admin_model->select_with_where2('price', 'id="' . $test_name[$j] . '"', 'diagnostic_test_subgroup');
					$price = $datam['diagnostic_test_subgroup'][0]['price'];
					$doc_comission = $com_amnt[$i];
					$data['add_by'] = $add_by;
					$data['hospital_id'] = $hospital_id;
					$data['doc_id'] = $doc_id;
					$data['group_id'] = $group_id[$i];
					$data['testid'] = $test_name[$j];
					$data['price'] = $price;
					$data['doc_comission'] = $doc_comission;
					$data['com_type'] = $com_type[$i];
					$data['add_date_time'] = date('Y-m-d H:i:s');
					$data['add_date'] = date('Y-m-d');

					if ($doc_comission != null) {
						$id = $this->admin_model->insert_ret('doc_comission_distribution', $data);
					}
				}
			}
		}
		$this->session->set_flashdata('Successfully', 'Successfully Done');
		redirect('admin/all_doc_list/1', 'refresh');
	}

	public function assign_doc_comission_view($doctor_id)
	{
		$doctor_id = $doctor_id;

		$data['active'] = 'View Doc Comission';
		$data['page_title'] = 'View  Doc Comission';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['comission_list'] = $this->admin_model->select_three_join_where_left_order('doc_com_id,add_by,doc_comission_distribution.hospital_id,doc_id,doc_comission_distribution.group_id,doc_comission_distribution.testid,doc_comission,diagnostic_test_group.test_title,diagnostic_test_subgroup.sub_test_title,doc_comission_distribution.com_type', 'doc_comission_distribution', 'diagnostic_test_group', 'doc_comission_distribution.group_id=diagnostic_test_group.test_id', 'diagnostic_test_subgroup', 'doc_comission_distribution.testid=diagnostic_test_subgroup.id', 'doc_id="' . $doctor_id . '" and active_status=1', 'doc_com_id', 'DESC');

		// "<pre>";print_r($data['comission_list']);die();

		$data['doctor'] = $this->admin_model->select_with_where2('*', 'doctor_id="' . $doctor_id . '"', 'doctor');

		$data['doctor_title'] = $data['doctor'][0]['doctor_title'];
		$this->load->view('doctor/doc_com_assign_view', $data);
	}


	public function assign_doc_comission_view_list()
	{


		$data['active'] = 'View Doc Comission';
		$data['page_title'] = 'View  Doc Comission';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['comission_list'] = $this->admin_model->select_four_join_left_where_order('doc_com_id,doc_comission_distribution.add_by,doc_comission_distribution.hospital_id,doc_id,doc_comission_distribution.group_id,testid,doc_comission,doc_comission_distribution.com_type,
	 		diagnostic_test_group.test_title,diagnostic_test_subgroup.sub_test_title,doctor.doctor_title', 'doc_comission_distribution', 'diagnostic_test_group', 'doc_comission_distribution.group_id=diagnostic_test_group.test_id', 'diagnostic_test_subgroup', 'doc_comission_distribution.testid=diagnostic_test_subgroup.id', 'doctor', 'doc_comission_distribution.doc_id=doctor.doctor_id', 'active_status=1', 'doc_com_id', 'DESC');

		$this->load->view('doctor/doc_comission_list', $data, FALSE);
	}

	public function comission_cancel($doc_id, $doc_com_sl_id, $test_id)
	{
		$data['active_status'] = 0;
		$doc_com_sl_id = $doc_com_sl_id;
		$this->load->admin_model->update_function2('doc_com_id="' . $doc_com_sl_id . '"', 'doc_comission_distribution', $data);
		// $this->load->admin_model->update_function2('id="'.$subtestid.'"','diagnostic_test_subgroup',$data);
		$this->session->set_flashdata('Successfully', 'Test  Successfully Updated');
		redirect('admin/all_doc_list', 'refresh');
	}

	public function comission_cancel_all($doc_id)
	{
		$data['active_status'] = 0;
		$this->load->admin_model->update_function2('doc_id="' . $doc_id . '"', 'doc_comission_distribution', $data);

		$this->session->set_flashdata('Successfully', 'Test  Successfully Updated');
		redirect('admin/all_doc_list', 'refresh');
	}

	public function opd_col_from_doc($value = '')
	{
		$data['active'] = 'opd_col_from_doc';
		$data['page_title'] = 'Doctor Wise Collection';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['doc_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$this->load->view('opd/opd_col_from_doc', $data);
	}

	public function opd_col_from_doc_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$doc_id = $this->input->post('doc_name');




		redirect('admin/opd_col_from_doc_next/' . $start_date . '/' . $end_date . '/' . $doc_id);
	}

	public function opd_col_from_doc_next($start_date, $end_date, $doc_id)
	{

		if ($doc_id != "all") {
			$data["col_from_doc"] = $this->admin_model->select_join_five_table2_sum_six_count_group_by('d.paid_amount,count(o.id) as total_test,o.id as order_id,,o.test_order_id,dt.test_title,dt.test_id,dts.sub_test_title,dts.price,o.patient_id,o.total_amount,o.vat,o.total_discount as discount,o.created_at as c_date,o.quack_doc_id,d.total_commission,d.paid_amount,d.total_gross_com', 'doc_commission d', 'doc_commission_details dc', 'opd_patient_test_order_info o', 'diagnostic_test_subgroup dts', 'diagnostic_test_group dt', 'd.id=dc.com_id', 'd.order_id=o.id', 'dc.service_id=dts.id', 'dts.mtest_id=dt.test_id', 'd.doc_id="' . $doc_id . '" AND date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '"', 'o.vat', 'o.total_discount', 'dts.price', 'o.total_amount', 'dc.gross_amount', 'dc.sub_amount', 'dt.test_id');

			// "<pre>";print_r($data["col_from_doc"]);die();


			$data['doc_info'] = $this->admin_model->select_with_where2('*', 'doctor_id="' . $doc_id . '"', 'doctor');

			$data['doc_name'] = $data['doc_info'][0]['doctor_title'];
			$data['doc_degree'] = $data['doc_info'][0]['doctor_degree'];

			$data['doc_mobile_no'] = $data['doc_info'][0]['doc_mobile_no'];
			$data['quack_doc_id'] = $doc_id;

			$data['flag'] = "";

			// "<pre>";print_r($data["test_count"]);die();
		} else {
			$data["col_from_doc"] = $this->admin_model->select_join_five_table2_sum_six_count_group_by_two('o.quack_doc_id,d.paid_amount,count(o.id) as total_test,o.id as order_id,,o.test_order_id,dt.test_title,dt.test_id,dts.sub_test_title,dts.price,o.patient_id,o.total_amount,o.vat,o.total_discount as discount,o.created_at as c_date,o.quack_doc_id,dc.amount,dc.gross_amount,d.total_commission,d.paid_amount,d.total_gross_com', 'doc_commission d', 'doc_commission_details dc', 'opd_patient_test_order_info o', 'diagnostic_test_subgroup dts', 'diagnostic_test_group dt', 'd.id=dc.com_id', 'd.order_id=o.id', 'dc.service_id=dts.id', 'dts.mtest_id=dt.test_id', 'date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '"', 'o.vat', 'o.total_discount', 'dts.price', 'dc.amount', 'dc.sub_amount', 'dc.gross_amount', 'dt.test_id', 'd.doc_id');

			$data['doc_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

			$data['flag'] = "all";
		}


		// "<pre>";print_r($data["ipd_collection_info"]);die();

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;


		$this->load->view('opd/opd_col_from_doc_report', $data);
	}



	public function date_wise_paid_invoice_list($value = '')
	{
		$data['active'] = 'paid_invoice';
		$data['page_title'] = 'Paid Invoice List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$this->load->view('opd/date_wise_paid_invoice_list', $data);
	}

	public function date_wise_paid_invoice_list_report()
	{

		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		redirect('admin/date_wise_paid_invoice_list_report_next/' . $start_date . '/' . $end_date);
	}

	public function date_wise_paid_invoice_list_report_next($start_date, $end_date)
	{


		$data['paid_invoice_info'] = $this->admin_model->select_join_where('*,op.age,op.created_at', 'opd_patient_info o', 'opd_patient_test_order_info op', 'o.id=op.patient_id', 'op.payment_status="paid" and date(op.created_at) between "' . $start_date . '" AND "' . $end_date . '"');

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('opd/date_wise_paid_invoice_list_report', $data);
	}


	public function date_wise_due_invoice_list($value = '')
	{
		$data['active'] = 'due_invoice';
		$data['page_title'] = 'Due Invoice List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$this->load->view('opd/date_wise_due_invoice_list', $data);
	}

	public function date_wise_due_invoice_list_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		redirect('admin/date_wise_due_invoice_list_report_next/' . $start_date . '/' . $end_date);
	}

	public function date_wise_due_invoice_list_report_next($start_date, $end_date)
	{
		$data['due_invoice_info'] = $this->admin_model->select_join_where('*,op.age,op.created_at', 'opd_patient_info o', 'opd_patient_test_order_info op', 'o.id=op.patient_id', 'op.payment_status="unpaid" and date(op.created_at) between "' . $start_date . '" AND "' . $end_date . '"');

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('opd/date_wise_due_invoice_list_report', $data);
	}


	public function opd_col_from_doc_with_com($value = '')
	{
		$data['active'] = 'opd_col_from_doc_with_com';
		$data['page_title'] = 'Opd Comission Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['doc_list'] = $this->admin_model->select_join_where_group_by('*', 'doc_comission_distribution dc', 'doctor d', 'd.doctor_id=dc.doc_id', 'd.status=1 and dc.active_status=1', 'd.doctor_id');


		$this->load->view('opd/opd_col_from_doc_with_com', $data);
	}

	public function opd_col_from_doc_with_com_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$doc_id = $this->input->post('doc_name');




		redirect('admin/opd_col_from_doc_with_com_next/' . $start_date . '/' . $end_date . '/' . $doc_id);
	}

	public function opd_col_from_doc_with_com_next($start_date, $end_date, $doc_id)
	{

		if ($doc_id != "all") {
			$data["col_from_doc"] = $this->admin_model->select_join_five_table2_sum_six_count_group_by('d.paid_amount,count(o.id) as total_test,o.id as order_id,,o.test_order_id,dt.test_title,dt.test_id,dts.sub_test_title,dts.price,o.patient_id,o.total_amount,o.vat,o.total_discount as discount,o.created_at as c_date,o.quack_doc_id,d.total_commission,d.paid_amount,d.total_gross_com', 'doc_commission d', 'doc_commission_details dc', 'opd_patient_test_order_info o', 'diagnostic_test_subgroup dts', 'diagnostic_test_group dt', 'd.id=dc.com_id', 'd.order_id=o.id', 'dc.service_id=dts.id', 'dts.mtest_id=dt.test_id', 'd.doc_id="' . $doc_id . '" AND date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '"', 'o.vat', 'o.total_discount', 'dts.price', 'dc.amount', 'dc.gross_amount', 'dc.sub_amount', 'o.id');

			// "<pre>";print_r($data["col_from_doc"]);die();


			$data['doc_info'] = $this->admin_model->select_with_where2('*', 'doctor_id="' . $doc_id . '"', 'doctor');

			$data['doc_name'] = $data['doc_info'][0]['doctor_title'];
			$data['doc_degree'] = $data['doc_info'][0]['doctor_degree'];

			$data['doc_mobile_no'] = $data['doc_info'][0]['doc_mobile_no'];
			$data['quack_doc_id'] = $doc_id;

			$data['flag'] = "";

			// "<pre>";print_r($data["test_count"]);die();
		} else {
			$data["col_from_doc"] = $this->admin_model->select_join_five_table2_sum_six_count_group_by('o.quack_doc_id,d.paid_amount,count(o.id) as total_test,o.id as order_id,,o.test_order_id,dt.test_title,dt.test_id,dts.sub_test_title,dts.price,o.patient_id,o.total_amount,o.vat,o.total_discount as discount,o.created_at as c_date,o.quack_doc_id,dc.amount,dc.gross_amount,d.total_commission,d.paid_amount,d.total_gross_com', 'doc_commission d', 'doc_commission_details dc', 'opd_patient_test_order_info o', 'diagnostic_test_subgroup dts', 'diagnostic_test_group dt', 'd.id=dc.com_id', 'd.order_id=o.id', 'dc.service_id=dts.id', 'dts.mtest_id=dt.test_id', 'date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '"', 'o.vat', 'o.total_discount', 'dts.price', 'dc.amount', 'dc.sub_amount', 'dc.gross_amount', 'o.id');

			// $data['doc_info']=$this->admin_model->select_with_where2('*','status=1','doctor');

			$data['doc_info'] = $this->admin_model->select_join_where_group_by('*', 'doc_commission dc', 'doctor d', 'd.doctor_id=dc.doc_id', 'd.status=1 and dc.status=1 and date(dc.created_at) between "' . $start_date . '" AND "' . $end_date . '"', 'd.doctor_id');

			$data['flag'] = "all";
		}



		// "<pre>";print_r($data["ipd_collection_info"]);die();

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('opd/opd_col_from_doc_with_com_report', $data);
	}


	public function opd_col_from_doc_with_com_details($value = '')
	{
		$data['active'] = 'cabin';
		$data['page_title'] = 'Opd Commission Details Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['doc_list'] = $this->admin_model->select_join_where_group_by('*', 'doc_comission_distribution dc', 'doctor d', 'd.doctor_id=dc.doc_id', 'd.status=1 and dc.active_status=1', 'd.doctor_id');

		$this->load->view('opd/opd_col_from_doc_with_com_details', $data);
	}

	public function opd_col_from_doc_with_com_details_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$doc_id = $this->input->post('doc_name');

		redirect('admin/opd_col_from_doc_with_com_details_next/' . $start_date . '/' . $end_date . '/' . $doc_id);
	}

	public function opd_col_from_doc_with_com_details_next($start_date, $end_date, $doc_id)
	{

		if ($doc_id != "all") {
			$data["col_from_doc"] = $this->admin_model->select_join_five_table2('dts.price,dc.amount,d.paid_amount,o.id as order_id,,o.test_order_id,dt.test_title,dt.test_id,dts.sub_test_title,dts.price,o.patient_id,o.total_amount,o.vat,o.total_discount as discount,o.created_at as c_date,o.quack_doc_id,dc.amount,dc.gross_amount,d.total_commission,d.paid_amount,d.total_gross_com,dc.sub_amount', 'doc_commission d', 'doc_commission_details dc', 'opd_patient_test_order_info o', 'diagnostic_test_subgroup dts', 'diagnostic_test_group dt', 'd.id=dc.com_id', 'd.order_id=o.id', 'dc.service_id=dts.id', 'dts.mtest_id=dt.test_id', 'd.doc_id="' . $doc_id . '" AND date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '"');


			$data["total_test_count"] = $this->admin_model->select_join_five_table2_count('d.total_commission,d.paid_amount,d.total_gross_com,count(o.id) as test_count,dts.price,dc.amount,o.id as order_id,,o.test_order_id,dt.test_title,dt.test_id,dts.sub_test_title,dts.price,o.patient_id,o.total_amount,o.vat,o.total_discount as discount,o.created_at as c_date,o.quack_doc_id,dc.amount,dc.gross_amount,d.total_commission,d.paid_amount,dc.sub_amount', 'doc_commission d', 'doc_commission_details dc', 'opd_patient_test_order_info o', 'diagnostic_test_subgroup dts', 'diagnostic_test_group dt', 'd.id=dc.com_id', 'd.order_id=o.id', 'dc.service_id=dts.id', 'dts.mtest_id=dt.test_id', 'd.doc_id="' . $doc_id . '" AND date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '"', 'o.id');

			// "<pre>";print_r($data["total_test_count"]);die();

			$data['group_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'diagnostic_test_group');

			$data['test_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'diagnostic_test_subgroup');



			$data['doc_info'] = $this->admin_model->select_with_where2('*', 'doctor_id="' . $doc_id . '"', 'doctor');

			$data['doc_name'] = $data['doc_info'][0]['doctor_title'];
			$data['doc_degree'] = $data['doc_info'][0]['doctor_degree'];

			$data['doc_mobile_no'] = $data['doc_info'][0]['doc_mobile_no'];

			$data['quack_doc_id'] = $doc_id;

			$data['flag'] = "";

			// "<pre>";print_r($data["test_count"]);die();
		} else {
			$data["col_from_doc"] = $this->admin_model->select_join_five_table2('dts.price,dc.amount,d.paid_amount,o.id as order_id,,o.test_order_id,dt.test_title,dt.test_id,dts.sub_test_title,dts.price,o.patient_id,o.total_amount,o.vat,o.total_discount as discount,o.created_at as c_date,o.quack_doc_id,dc.amount,dc.gross_amount,d.total_commission,d.paid_amount,d.total_gross_com,dc.sub_amount', 'doc_commission d', 'doc_commission_details dc', 'opd_patient_test_order_info o', 'diagnostic_test_subgroup dts', 'diagnostic_test_group dt', 'd.id=dc.com_id', 'd.order_id=o.id', 'dc.service_id=dts.id', 'dts.mtest_id=dt.test_id', ' date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '"');


			$data["total_test_count"] = $this->admin_model->select_join_five_table2_count('d.total_commission,d.paid_amount,d.total_gross_com,count(o.id) as test_count,dts.price,dc.amount,o.id as order_id,,o.test_order_id,dt.test_title,dt.test_id,dts.sub_test_title,dts.price,o.patient_id,o.total_amount,o.vat,o.total_discount as discount,o.created_at as c_date,o.quack_doc_id,dc.amount,dc.gross_amount,d.total_commission,d.paid_amount,dc.sub_amount', 'doc_commission d', 'doc_commission_details dc', 'opd_patient_test_order_info o', 'diagnostic_test_subgroup dts', 'diagnostic_test_group dt', 'd.id=dc.com_id', 'd.order_id=o.id', 'dc.service_id=dts.id', 'dts.mtest_id=dt.test_id', 'date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '"', 'o.id');



			$data['doc_info'] = $this->admin_model->select_join_where_group_by('*', 'doc_commission dc', 'doctor d', 'd.doctor_id=dc.doc_id', 'd.status=1 and dc.status=1 and date(dc.created_at) between "' . $start_date . '" AND "' . $end_date . '"', 'd.doctor_id');

			// "<pre>";print_r($data['doc_info']);die();

			$data['flag'] = "all";
		}




		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('opd/opd_col_from_doc_with_com_details_report', $data);
	}


	public function discount_summary($value = '')
	{
		$data['active'] = 'discount_summary';
		$data['page_title'] = 'Discount Summary';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['discount_summary'] = $this->admin_model->select_join_three_table2('dc.*, o.*,op.*, op.id as op_id, o.id as o_id, dc.created_at', 'opd_patient_info o', 'opd_patient_test_order_info op', 'due_collection dc', 'op.patient_id=o.id', 'op.test_order_id=dc.order_id', 'op.status=1 and o.status=1 and dc.due_type=1 and dc.status=1 and date(dc.created_at)="' . date('Y-m-d') . '"');

		$this->load->view('opd/discount_summary', $data);
	}


	public function discount_summary_report($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		redirect('admin/discount_summary_report_next/' . $start_date . '/' . $end_date);
	}

	public function discount_summary_report_next($start_date, $end_date)
	{
		$data['discount_summary'] = $this->admin_model->select_join_three_table2('dc.*, o.*,op.*, op.id as op_id, o.id as o_id', 'opd_patient_info o', 'opd_patient_test_order_info op', 'due_collection dc', 'op.patient_id=o.id', 'op.test_order_id=dc.order_id', 'dc.status=1 and op.status=1 and o.status=1 and dc.due_type=1 and date(dc.created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('opd/discount_summary_report', $data);
	}




	/***********************CABIN MODULE STARTS**************************/

	public function indoor_cabin_summary($value = '')
	{
		$data['active'] = 'cabin';
		$data['page_title'] = 'Cabin Class & Room List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['cabin_class'] = $this->admin_model->select_with_where2('*', 'status=1', 'cabin_class');
		$data['sub_cabin'] = $this->admin_model->select_with_where2('*', 'status=1', 'cabin_sub_class');
		$data['room'] = $this->admin_model->select_where_left_join('*', 'room r', 'ipd_patient_info i', 'r.p_id=i.id', 'r.status=1');


		$this->load->view('cabin_management/indoor_cabin_summary', $data);
	}

	public function cabin_class_room_list($flag = '')
	{
		$data['active'] = 'cabin';
		$data['page_title'] = 'Cabin Class & Room List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['cabin_hospital'] = $this->admin_model->select_three_where_join('*', 'hospital h', 'cabin_class c', 'h.hospital_id=c.hospital_id', 'h.hospital_id', $this->session->userdata['logged_in']['hospital_id'], 'c.status', 1, 'h.status', 1);

		$data['sub_cabin'] = $this->admin_model->select_with_where2('*', 'status=1', 'cabin_sub_class');
		$data['room'] = $this->admin_model->select_with_where2('*', 'status=1 and type="' . $flag . '"', 'room');

		$this->load->view('cabin_management/cabin_class_room_list', $data);
	}
	public function add_cabin_class()
	{

		$data = array(
			'cabin_class_title' => $this->input->post('cabin_class_title'),
			'hospital_id' => $this->input->post('hospital_id'),
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->admin_model->insert('cabin_class', $data);
		echo json_encode($data);
	}



	public function get_all_cabin_by_hospital_id()
	{
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$hospital_id_sub = $this->input->post('hospital_id_sub');
		$data = $this->admin_model->select_with_where_test('*', $hospital_id_sub, 'cabin_class', 'hospital_id');
		echo json_encode($data);
	}

	public function add_sub_cabin()
	{

		$data = array(
			'cabin_class_id' => $this->input->post('cabin_class_id'),
			'hospital_id' => $this->input->post('hospital_id'),
			'cabin_sub_class_title' => $this->input->post('sub_cabin_title'),
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->admin_model->insert('cabin_sub_class', $data);
		echo json_encode($data);
	}

	public function get_all_sub_cabin_by_cabin_id()
	{
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$cabin_room_select_id = $this->input->post('cabin_room_select_id');
		$data = $this->admin_model->select_with_where_test('*', $cabin_room_select_id, 'cabin_sub_class', 'cabin_class_id');
		echo json_encode($data);
	}
	public function add_room()
	{

		$data = array(
			'cabin_class_id' => $this->input->post('cabin_class_id'),
			'hospital_id' => $this->input->post('hospital_id'),
			'cabin_sub_class_id' => $this->input->post('cabin_sub_class_id'),
			'room_title' => $this->input->post('cabin_room_title'),
			'room_price' => $this->input->post('room_price'),
			'type' => $this->input->post('room_type'),
			'seat_capacity' => $this->input->post('seat_capacity'),
			'created_at' => date('Y-m-d H:i:s')

		);
		$this->admin_model->insert('room', $data);
		echo json_encode($data);
	}

	public function get_specific_hospital_and_cabin()
	{
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$data['cabin'] = $this->admin_model->select_two_where_join(array('h.hospital_id', 'c.cabin_class_title', 'c.id', 'h.hospital_title'), 'cabin_class c', 'hospital h', 'h.hospital_id=c.hospital_id', 'c.id', $this->input->post('cabin_id'), 'c.status', 1);
		$data['hospital'] = $this->admin_model->select_with_where('*', 1, 'hospital', 'status');
		echo json_encode($data);
	}

	public function update_cabin()
	{
		$data = array(
			'cabin_class_title' => $this->input->post('cabin_class_title_edit_cabin'),
			'hospital_id' => $this->input->post('hospital_id')
		);
		$data = $this->admin_model->update_function('id', $this->input->post('cabin_id'), 'cabin_class', $data);
		echo json_encode($data);
	}

	public function get_specific_hospital_and_cabin_sub_cabin()
	{
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$data['sub_cabin'] = $this->admin_model->select_join_three_table(
			'*',
			'cabin_sub_class cs',
			'hospital h',
			'cabin_class c',
			'h.hospital_id=cs.hospital_id',
			'cs.cabin_class_id=c.id',
			'cs.id',
			$this->input->post('sub_cabin_id'),
			'c.status',
			1
		);
		$data['hospital'] = $this->admin_model->select_with_where('*', 1, 'hospital', 'status');
		if ($data['admin_type'] == 1) {
			$data['cabin'] = $this->admin_model->select_with_where('*', 1, 'cabin_class', 'status');
		} else if ($data['admin_type'] == 2) {
			$data['cabin'] = $this->admin_model->select_with_where('*', 1, 'cabin_class', 'status');
		} else if ($data['admin_type'] == 3 || $data['admin_type'] == 5) {
			$data['cabin'] = $this->admin_model->select_with_where_condition_two('*', 1, 'cabin_class', 'status', $this->session->userdata['logged_in']['hospital_id'], 'hospital_id');
		}

		echo json_encode($data);
	}

	public function update_sub_cabin()
	{
		$data = array(
			'cabin_class_id' => $this->input->post('cabin_id'),
			'cabin_sub_class_title' => $this->input->post('sub_cabin_title')
		);
		$data = $this->admin_model->update_function('id', $this->input->post('id'), 'cabin_sub_class', $data);
		echo json_encode($data);
	}


	public function get_specific_hospital_and_cabin_sub_cabin_room()
	{
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$data['room'] = $this->admin_model->select_join_four_table(
			'*',
			'room r',
			'hospital h',
			'cabin_class c',
			'cabin_sub_class cs',
			'h.hospital_id=r.hospital_id',
			'r.cabin_class_id=c.id',
			'r.cabin_sub_class_id=cs.id',
			'r.id',
			$this->input->post('room_id'),
			'c.status',
			1
		);
		$data['sub_cabin'] = $this->admin_model->select_with_where('*', 1, 'cabin_sub_class', 'status');

		echo json_encode($data);
	}

	public function update_room()
	{
		$data = array(
			'cabin_sub_class_id' => $this->input->post('sub_cabin_id'),
			'room_title' => $this->input->post('room_title'),
			'room_price' => $this->input->post('room_price'),
			'seat_capacity' => $this->input->post('seat_capacity'),
			'type' => $this->input->post('edit_room_type')

		);
		$data = $this->admin_model->update_function('id', $this->input->post('id'), 'room', $data);
		echo json_encode($data);
	}

	public function delete_cabin()
	{
		$data = array('status' => 2);
		$this->admin_model->update_function('id', $this->input->post('cabin_id'), 'cabin_class', $data);
		echo json_encode($data);
	}



	/***********************CABIN MODULE ENDS**************************/






	/*********************** IPD MODULE STARTS**************************/

	public function ipd_adv_pay_daywise($value = '')
	{
		$data['active'] = 'ipd_adv_pay_daywise';
		$data['page_title'] = 'Ipd Adv Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['ipd_adv_pay'] = $this->admin_model->select_join_three_order_table2('*,dc.created_at,dc.operator_name', 'ipd_patient_info i', 'ipd_final_bill if', 'due_collection dc', 'i.id=if.p_id', 'if.p_id=dc.patient_id', 'if.status=1 and i.status=1 and dc.due_type=2 and dc.status=1 and date(dc.created_at)="' . date('Y-m-d') . '"', 'dc.id', 'desc');

		$this->load->view('ipd/ipd_adv_pay_daywise', $data);
	}
	public function ipd_adv_pay_daywise_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		redirect('admin/ipd_adv_pay_daywise_next/' . $start_date . '/' . $end_date);
	}

	public function ipd_adv_pay_daywise_next($start_date, $end_date)
	{
		$data['ipd_adv_pay'] = $this->admin_model->select_join_three_order_table2('*,dc.created_at,dc.operator_name', 'ipd_patient_info i', 'ipd_final_bill if', 'due_collection dc', 'i.id=if.p_id', 'if.p_id=dc.patient_id', 'if.status=1 and i.status=1 and dc.due_type=2 and dc.status=1 and date(dc.created_at) between "' . $start_date . '" and "' . $end_date . '"', 'dc.id', 'desc');


		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;
		$this->load->view('ipd/ipd_adv_pay_daywise_report', $data);
	}

	public function ipd_adv_pay_pdf($p_id = '')
	{
		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $p_id . '"', 'ipd_patient_info');
		$data['due_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND patient_id="' . $p_id . '" and due_type=2 and advance_payment !=0', 'due_collection');

		$data['ipd_final_bill'] = $this->admin_model->select_with_where2('*', 'status=1 AND p_id="' . $p_id . '"', 'ipd_final_bill');

		$this->load->view('ipd/ipd_adv_pay_pdf', $data);
	}



	public function ipd_adv_pay($p_id = '')
	{
		$data['active'] = 'Ipd Adv Payment';
		$data['page_title'] = 'Ipd Adv Payment';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $p_id . '"', 'ipd_patient_info');
		$data['due_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND patient_id="' . $p_id . '" and due_type=2 and advance_payment !=0', 'due_collection');

		$this->load->view('ipd/ipd_adv_pay', $data);
	}

	public function ipd_adv_pay_post($patient_id = '')
	{

		// insert into due collection

		$ipd_patient_info = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $patient_id . '"', 'ipd_patient_info');

		$due_info = $this->admin_model->get_last_row2('due_collection', 'status=1 and patient_id="' . $patient_id . '" and due_type=2');

		$d_data['old_due'] = $due_info[0]['old_due'];

		$d_data['order_id'] = $ipd_patient_info[0]['patient_info_id'];
		$d_data['total_amount'] = $due_info[0]['total_amount'];
		$d_data['patient_id'] = $patient_id;

		$d_data['current_due'] = $due_info[0]['current_due'] - $this->input->post('adv_pay');

		$d_data['paid_due'] = $this->input->post('adv_pay');

		$d_data['admission_fee'] = $due_info[0]['admission_fee'];

		$d_data['advance_payment'] = $this->input->post('adv_pay');

		// $d_data['admission_fee_paid']=$due_info[0]['admission_fee_paid'];

		$d_data['created_at'] = date('Y-m-d H:i:s');
		$d_data['due_type'] = 2;
		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$this->admin_model->insert('due_collection', $d_data);

		// update ipd final bill 
		$ipd_final_bill = $this->admin_model->select_with_where2('*', 'status=1 AND p_id="' . $patient_id . '"', 'ipd_final_bill');

		$data = array(
			'advance_payment' => $ipd_final_bill[0]['advance_payment'] + $_POST['adv_pay'],
			'total_paid' => $ipd_final_bill[0]['total_paid'] + $d_data['paid_due'],
			'updated_at' => date("Y-m-d H:i:s")

		);
		$this->admin_model->update_function2('p_id="' . $patient_id . '"', 'ipd_final_bill', $data);

		redirect('admin/ipd_adv_pay/' . $patient_id);
	}

	public function date_wise_balance_sheet_ipd()
	{
		redirect('admin/date_wise_balance_sheet/ipd');
	}

	public function service_list()
	{
		$data['active'] = 'Service List';
		$data['page_title'] = 'Manage Service List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$this->load->view('ipd/service_list', $data);
	}

	public function service_list_dt()
	{

		$select_column = "id,service_name,service_price";
		$order_column = array('id', 'service_name', null, null);
		$search_column = array('service_price', 'service_name');

		$condition = 'service_status=1';

		$fetch_data = $this->admin_model->make_datatables('service_info', $condition, $select_column, $order_column, $search_column, 'id');
		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->service_name;
			$sub_array[] = $row->service_price;
			$sub_array[] = '<a href="admin/edit_service/' . $row->id . '"><i class="fa fa-plus-square"></i></a>
	 		&nbsp;&nbsp; &nbsp;&nbsp; <a href="admin/delete_service/' . $row->id . '"><i class="fa fa-trash"></i></a>';
			$data[] = $sub_array;
			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data('*', 'service_info', $condition),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data(
				'service_info',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	public function add_service()
	{
		$data['active'] = 'add_service';
		$data['page_title'] = 'Add Service';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$this->load->view('ipd/add_service', $data);
	}

	public function add_service_post()
	{

		$service_code = 'ser-000001';
		$get_last_service_code = $this->admin_model->get_last_row_no_where('service_info', 'id');

		if (count($get_last_service_code) > 0) {
			$service_code = $get_last_service_code[0]['service_code'];
			$service_code_explode = explode('-', $service_code);
			$service_code_int = $service_code_explode[1];
			$service_code_number = str_pad(($service_code_int + 1), 6, "0", STR_PAD_LEFT);
			$service_code = $service_code_explode[0] . '-' . $service_code_number;
		}


		$data['user_id'] = $this->input->post('user_id');
		$data['service_code'] = $service_code;
		$data['hospital_id'] = $this->input->post('hospital_id');
		$data['service_name'] = $this->input->post('service_name');
		$data['service_type'] = $this->input->post('service_type');
		$data['service_price'] = $this->input->post('service_price');
		$data['created_at'] = date('Y-m-d H:i:s');
		$this->admin_model->insert_ret('service_info', $data);
		$this->session->set_flashdata('Successfully', 'Service Successfully Done..!');

		redirect('admin/service_list', 'refresh');
	}

	public function edit_service($service_id)
	{
		$service_id = $service_id;

		$data['active'] = 'Edit Service';
		$data['page_title'] = 'Manage Service';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['service'] = $this->admin_model->select_with_where2('*', 'id="' . $service_id . '"', 'service_info');

		$data['id'] = $data['service'][0]['id'];
		$data['service_price'] = $data['service'][0]['service_price'];
		$data['service_name'] = $data['service'][0]['service_name'];
		$data['service_type'] = $data['service'][0]['service_type'];
		$this->load->view('ipd/edit_service', $data);
	}


	public function edit_service_post()
	{

		$service_id = $this->input->post('service_id');

		$data['service_name'] = $this->input->post('service_name');
		$data['service_type'] = $this->input->post('service_type');
		$data['service_price'] = $this->input->post('service_price');
		$data['updated_at'] = date('Y-m-d H:i:s');

		$this->admin_model->update_function2('id="' . $service_id . '"', 'service_info', $data);
		$this->session->set_flashdata('Successfully', 'Service Successfully Updated..!');
		redirect('admin/service_list', 'refresh');
	}

	public function delete_service($service_id)
	{

		$service_id = $service_id;


		$data['service_status'] = 2;


		$data['updated_at'] = date('Y-m-d H:i:s');

		$this->admin_model->update_function2('id="' . $service_id . '"', 'service_info', $data);

		$this->session->set_flashdata('Successfully', 'Operation Successfully Deleted..!');
		redirect('admin/service_list');
	}

	public function operation_cost_dr_wise($value = '')
	{
		$data['active'] = 'operation_cost_dr_wise';
		$data['page_title'] = 'Operation Cost Doc Wise';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['doc_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$this->load->view('ipd/operation_cost_dr_wise', $data);
	}

	public function operation_cost_dr_wise_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$doc_id = $this->input->post('doc_name');


		redirect('admin/operation_cost_dr_wise_report_next/' . $start_date . '/' . $end_date . '/' . $doc_id);
	}

	public function operation_cost_dr_wise_report_next($start_date, $end_date, $doc_id)
	{

		if ($doc_id == "all") {
			$data["service_info"] = $this->admin_model->select_four_join_where('*,s.id as s_id,s.created_at', 'ipd_patient_info ip', 'ipd_final_bill if', 'service_details s', ' service_info si', 'ip.id=if.p_id', 's.p_id=ip.id', 's.service_id=si.id', 'date(s.created_at) between "' . $start_date . '" and "' . $end_date . '"');
		} else {
			$data["service_info"] = $this->admin_model->select_four_join_where('*,s.id as s_id,s.created_at', 'ipd_patient_info ip', 'ipd_final_bill if', 'service_details s', ' service_info si', 'ip.id=if.p_id', 's.p_id=ip.id', 's.service_id=si.id', 'date(s.created_at) between "' . $start_date . '" and "' . $end_date . '" and s.operated_id ="' . $doc_id . '"');
		}


		$data['doc_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['doc_id'] = $doc_id;

		$this->load->view('ipd/operation_cost_dr_wise_report', $data);
	}


	public function operation_cost($value = '')
	{
		$data['active'] = 'operation_cost';
		$data['page_title'] = 'Operation Cost';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data["service_info"] = $this->admin_model->select_four_join_where('*,s.id as s_id,s.created_at', 'ipd_patient_info ip', 'ipd_final_bill if', 'service_details s', ' service_info si', 'ip.id=if.p_id', 's.p_id=ip.id', 's.service_id=si.id', 'date(s.created_at)="' . date('Y-m-d') . '" and s.operated_id != 0');

		$this->load->view('ipd/operation_cost', $data);
	}


	public function operation_cost_details($service_details_id = '')
	{
		$data['active'] = 'operation_cost_details';
		$data['page_title'] = 'Operation Cost Details';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data["service_info"] = $this->admin_model->select_four_join_where('*,s.id as s_id,s.created_at', 'ipd_patient_info ip', 'ipd_final_bill if', 'service_details s', ' service_info si', 'ip.id=if.p_id', 's.p_id=ip.id', 's.service_id=si.id', 's.operated_id != 0 and s.id="' . $service_details_id . '"');


		$this->load->view('ipd/operation_cost_details', $data);
	}

	public function update_operation_cost($s_id = '')
	{

		$data["service_details_info"] = $this->admin_model->select_with_where2('*', 'id="' . $s_id . '"', 'service_details');

		$amount['cost_paid'] = $data["service_details_info"][0]['cost_paid'] + $this->input->post('update_payment');
		$amount['discount'] = $data["service_details_info"][0]['discount'] + $this->input->post('discount');

		$this->admin_model->update_function2('id="' . $s_id . '"', 'service_details', $amount);

		// insert into service payment details

		$data = array(
			'paid_cost' => $this->input->post('update_payment'),
			'discount' => $this->input->post('discount'),
			'service_details_id' => $s_id,
			'old_cost'	=> $data["service_details_info"][0]['price'] - $data["service_details_info"][0]['cost_paid'] - $data["service_details_info"][0]['discount'],

			'current_cost' => $data["service_details_info"][0]['price'] - $data["service_details_info"][0]['cost_paid'] - $this->input->post('update_payment') - $this->input->post('discount') - $data["service_details_info"][0]['discount'],


			'discount_ref' => $this->input->post('discount_ref'),
			'operator_id' => $this->session->userdata['logged_in']['id'],
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'created_at' => date('Y-m-d H:i:s')
		);

		$this->admin_model->insert('service_payment_details', $data);


		redirect('admin/operation_cost_details/' . $s_id);
	}


	public function operation_cost_day_wise_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');


		redirect('admin/operation_cost_day_wise_report_next/' . $start_date . '/' . $end_date);
	}

	public function operation_cost_day_wise_report_next($start_date, $end_date)
	{


		$data["service_info"] = $this->admin_model->select_four_join_where('*,s.id as s_id,s.created_at', 'ipd_patient_info ip', 'ipd_final_bill if', 'service_details s', ' service_info si', 'ip.id=if.p_id', 's.p_id=ip.id', 's.service_id=si.id', 'date(s.created_at) between "' . $start_date . '" and "' . $end_date . '" and s.operated_id != 0');

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('ipd/operation_cost_day_wise_report', $data);
	}


	public function one_click_payment_operation_cost($service_details_id = '', $from = '', $to = '')
	{


		$data["service_details_info"] = $this->admin_model->select_with_where2('*', 'id="' . $service_details_id . '"', 'service_details');

		$patient_id = $data["service_details_info"][0]['p_id'];

		$amount['cost_paid'] = $data["service_details_info"][0]['price'] - $data["service_details_info"][0]['discount'];

		$this->admin_model->update_function2('id="' . $service_details_id . '"', 'service_details', $amount);

		$data = array(
			'paid_cost' => $data["service_details_info"][0]['price'] - $data["service_details_info"][0]['cost_paid'] - $data["service_details_info"][0]['discount'],

			'service_details_id' => $service_details_id,
			'old_cost'	=> $data["service_details_info"][0]['price'] - $data["service_details_info"][0]['cost_paid'] - $data["service_details_info"][0]['discount'],

			'operator_id' => $this->session->userdata['logged_in']['id'],
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'created_at' => date('Y-m-d H:i:s')
		);

		$this->admin_model->insert('service_payment_details', $data);

		if ($this->uri->segment(4) == "pay_to_doc") {
			redirect('admin/operation_cost_pay_to_doctor/' . $patient_id);
		}

		if ($from == "" && $to == "") {
			redirect('admin/operation_cost');
		} else {
			redirect('admin/operation_cost_day_wise_report_next/' . $from . '/' . $to);
		}
	}

	public function ipd_collection_by_opd($value = '')
	{
		$data['active'] = 'ipd_collection_by_opd';
		$data['page_title'] = 'Ipd Collection by OPD';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data["ipd_collection_by_opd"] = $this->admin_model->select_join_where('ip.*, ip.id, o.*,o.created_at', 'ipd_patient_info ip', 'opd_patient_test_order_info o', 'ip.id=o.ipd_patient_id', 'date(o.created_at)="' . date('Y-m-d') . '"');

		$this->load->view('ipd/ipd_collection_by_opd', $data);
	}

	public function ipd_collection_by_opd_day_wise_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');


		redirect('admin/ipd_collection_by_opd_day_wise_report_next/' . $start_date . '/' . $end_date);
	}

	public function ipd_collection_by_opd_day_wise_report_next($start_date, $end_date)
	{


		$data["ipd_collection_by_opd"] = $this->admin_model->select_join_where('ip.*, ip.id, o.*,o.created_at', 'ipd_patient_info ip', 'opd_patient_test_order_info o', 'ip.id=o.ipd_patient_id', 'date(o.created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('ipd/ipd_collection_by_opd_day_wise_report', $data);
	}


	public function edit_prescription($value = '')
	{
		$data['active'] = 'cabin';
		$data['page_title'] = 'Edit Prescription';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['product_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'product');

		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['dose_schedule_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'dose_schedule');

		$data['patient_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'ipd_patient_info');

		$data['prescription_info'] = $this->admin_model->select_five_join_where_left('*,p.id,pr.id as pr_id,pr.type,pr.description', 'prescription p', 'prescription_details pr', 'ipd_patient_info i', 'product pd', 'doctor d', 'product_category pc', 'p.id=pr.prescription_id', 'i.id=p.patient_id', 'pd.id=pr.medicine_id', 'd.doctor_id=p.doctor_id', 'pc.id=pd.p_cat_id', 'i.status=1 and p.status=1 and p.id="' . $value . '" and pr.status=1');

		// "<pre>";print_r($data['prescription_info']);die();

		$this->load->view('ipd/edit_prescription', $data);
	}


	public function edit_prescription_post($value = '')
	{

		$val['patient_id'] = $this->input->post('patient_id');
		$val['doctor_id'] = $this->input->post('doctor_id');
		$val['note'] = $this->input->post('note');
		$val['created_at'] = date('Y-m-d');

		$this->admin_model->update_function2('id="' . $this->input->post('prescription_id') . '"', 'prescription', $val);


		$med_id = $this->input->post('med_id');
		$type = $this->input->post('type');
		$p_details_id = $this->input->post('p_details_id');



		$dose_qty = $this->input->post('dose_qty');
		$max_day = $this->input->post('max_day');
		$description = $this->input->post('description');

		$unknown_medicine_name = $this->input->post('unknown_medicine_name');


		for ($i = 0; $i < count($med_id); $i++) {
			if ($this->admin_model->check_row('*', 'id="' . $p_details_id[$i] . '"', 'prescription_details')) {

				if ($med_id[$i] != "") {
					$val = explode('#', $med_id[$i]);
					$data['medicine_id'] = $val[0];
					$data['medicine_name'] = $val[1];
				} else {
					$data['medicine_id'] = 0;
					$data['medicine_name'] = $unknown_medicine_name[$i];
				}

				$data['medicine_id'] = $med_id[$i];
				$data['type'] = $type[$i];
				$data['dose_qty'] = $dose_qty[$i];
				$data['max_day'] = $max_day[$i];
				$data['description'] = $description[$i];
				$data['prescription_id'] = $this->input->post('prescription_id');


				$daily_dose = $this->input->post('day_dose_' . $i);
				$data['daily_dose'] = implode(',', $daily_dose);

				$this->admin_model->update_function2('id="' . $p_details_id[$i] . '"', 'prescription_details', $data);
			} else {

				if ($med_id[$i] != "") {
					$val = explode('#', $med_id[$i]);
					$data['medicine_id'] = $val[0];
					$data['medicine_name'] = $val[1];
				} else {
					$data['medicine_id'] = 0;
					$data['medicine_name'] = $unknown_medicine_name[$i];
				}

				$data['type'] = $type[$i];
				$data['dose_qty'] = $dose_qty[$i];
				$data['max_day'] = $max_day[$i];
				$data['description'] = $description[$i];
				$data['prescription_id'] = $this->input->post('prescription_id');

				$data['created_at'] = date('d-m-Y h:i:s');


				$daily_dose = $this->input->post('day_dose_' . $i);


				$data['daily_dose'] = implode(',', $daily_dose);


				$this->admin_model->insert_ret('prescription_details', $data);
			}
		}

		redirect('admin/prescription_list');
	}

	public function delete_prescription($value = '')
	{
		$data['status'] = 2;
		$this->admin_model->update_function2('id="' . $value . '"', 'prescription', $data);
		$this->admin_model->update_function2('prescription_id="' . $value . '"', 'prescription_details', $data);

		redirect('admin/prescription_list');
	}

	public function delete_prescription_individual()
	{
		$data['status'] = 2;
		$this->admin_model->update_function2('id="' . $_POST['p_id'] . '"', 'prescription_details', $data);

		$val = $this->admin_model->select_with_where2('*', 'prescription_id="' . $_POST['prescription_id'] . '" and status=1', 'prescription_details');

		if ($val == null) {

			$this->admin_model->update_function2('id="' . $_POST['prescription_id'] . '"', 'prescription', $data);
		}

		echo json_encode($val);
	}

	public function prescription_list($value = '')
	{
		$data['active'] = 'prescription';
		$data['page_title'] = 'Discharge List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		// $data['prescription_info']=$this->admin_model->select_three_join_where('*,p.id','prescription p','ipd_patient_info i','i.id=p.patient_id','doctor d','d.doctor_id=p.doctor_id','i.status=1 and p.status=1');																					

		$this->load->view('ipd/prescription_list', $data);
	}

	public function prescription_list_dt($value = '')
	{


		// $prescription_details=$this->admin_model->select_join_where('*,pd.id','product p','p.id=pd.medicine_id','p.status=1 and pd.status=1');


		$select_column = 'i.*,p.*,p.id as pres_id,p.created_at as c_date,d.*';

		$order_column = array('p_id', 'patient_info_id', 'patient_name', 'doctor_title');

		$search_column = array('patient_info_id', 'patient_name', 'doctor_title');


		$condition = "i.status=1 and p.status=1";



		$fetch_data = $this->admin_model->make_datatables_three_table_join('prescription p', $condition, $select_column, $order_column, $search_column, 'ipd_patient_info i', 'i.id=p.patient_id', 'doctor d', 'd.doctor_id=p.doctor_id', 'p.id');

		$prescription_details = $this->admin_model->select_with_where2('*', 'status=1', 'prescription_details');


		// "<pre>";print_r($prescription_details);die();

		$data = array();

		$i = $_POST['start'];

		$dose_qty = "";


		foreach ($fetch_data as $key => $row) {
			$med_name = "";
			foreach ($prescription_details as $key1 => $row1) {
				if ($row1['prescription_id'] == $row->id) {
					$med_name .= $row1['medicine_name'] . ' (' . $row1['dose_qty'] . ') (' . $row1['max_day'] . ' day)<br>';
				}
			}

			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->patient_info_id;
			$sub_array[] = $row->patient_name;
			$sub_array[] = $row->doctor_title;
			$sub_array[] = $med_name;
			$sub_array[] = '<a target="_blank" href="admin/discharge_certificate/' . $row->pres_id . '/' . $row->patient_id . '" type="button" id=""class="btn btn-success btn-xs edit_button"><i class="fa fa-file" aria-hidden="true"></i></a>';


			$sub_array[] = date('d-M-Y h:i:s a', strtotime($row->c_date));

			$sub_array[] = '<a target="_blank" href="admin/edit_prescription/' . $row->pres_id . '" type="button" id=""class="btn btn-success btn-xs edit_button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

	 		<a href="admin/delete_prescription/" onclick="dlt_confirm(' . $row->pres_id . ')" type="button" id="" class="btn btn-danger btn-xs delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';



			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_three_table_join('prescription p', $condition, $select_column, 'ipd_patient_info i', 'i.id=p.patient_id', 'doctor d', 'd.doctor_id=p.doctor_id', 'product pr', 'pr.id=pd.medicine_id'),

			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_three_table_join(
				'prescription p',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'ipd_patient_info i',
				'i.id=p.patient_id',
				'doctor d',
				'd.doctor_id=p.doctor_id',
				'p.id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	public function discharge_certificate($pres_id = '', $patient_id = '')
	{
		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $patient_id . '"', 'ipd_patient_info');

		$data['final_bill_info'] = $this->admin_model->select_with_where2('*', 'p_id="' . $patient_id . '"', 'ipd_final_bill');

		$data['prescription_info'] = $this->admin_model->select_join_where('*', 'prescription p', 'prescription_details pd', 'p.id=pd.prescription_id', 'p.status=1 and pd.status=1 and p.id="' . $pres_id . '"');

		$this->load->view('ipd/discharge_certificate', $data);
	}


	public function add_prescription($value = '')
	{
		$data['active'] = 'cabin';
		$data['page_title'] = 'Add Prescription';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['product_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'product');

		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['patient_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'ipd_patient_info');

		$data['dose_schedule_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'dose_schedule');

		$this->load->view('ipd/add_prescription', $data);
	}


	public function add_prescription_post($value = '')
	{


		$val['patient_id'] = $this->input->post('patient_id');
		$val['doctor_id'] = $this->input->post('doctor_id');
		$val['note'] = $this->input->post('note');
		$val['created_at'] = date('Y-m-d h:i:s');

		$id = $this->admin_model->insert_ret('prescription', $val);

		$med_id = $this->input->post('med_id');
		$unknown_medicine_name = $this->input->post('unknown_medicine_name');
		$type = $this->input->post('type');

		$dose_qty = $this->input->post('dose_qty');

		$max_day = $this->input->post('max_day');
		$description = $this->input->post('description');

		for ($i = 0; $i < count($med_id); $i++) {

			if ($med_id[$i] != "") {
				$val = explode('#', $med_id[$i]);
				$data['medicine_id'] = $val[0];
				$data['medicine_name'] = $val[1];
			} else {
				$data['medicine_id'] = 0;
				$data['medicine_name'] = $unknown_medicine_name[$i];
			}

			$data['type'] = $type[$i];
			$data['dose_qty'] = $dose_qty[$i];
			$data['max_day'] = $max_day[$i];
			$data['description'] = $description[$i];
			$data['prescription_id'] = $id;
			$data['created_at'] = date('Y-m-d h:i:s');;


			$daily_dose = $this->input->post('day_dose_' . $i);;

			$data['daily_dose'] = implode(',', $daily_dose);


			$this->admin_model->insert_ret('prescription_details', $data);
		}

		redirect('admin/prescription_list');
	}

	public function ajax_ipd_cabin_chk()
	{
		$cabin_no = $this->input->post('cabin_no');
		if ($this->admin_model->check_row('*', 'status in (1,4) and cabin_no="' . $this->input->post('cabin_no') . '"', 'ipd_patient_info')) {
			$data['message'] = "Cabin is Already in Used Mood";
		} else {
			$data['message'] = "Cabin is Empty";
		}
	}

	public function ipd_reg_form($ipd_patient_id = '')
	{
		$data['active'] = 'ipd_reg_form';
		$data['page_title'] = 'IPD Registration Form';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['ipd_patient_info'] = $this->admin_model->select_join_three_table2_left('*,i.created_at', 'ipd_patient_info i', 'room r', 'blood_group b', 'i.cabin_no=r.id', 'b.id=i.blood_group', 'i.status=1 and i.id="' . $ipd_patient_id . '"');

		$this->load->view('ipd/ipd_registration_receipt', $data);
	}

	public function ipd_registration($ipd_patient_id = '')
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD Registration';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		if ($ipd_patient_id == "") {
			$data['ipd_patient_id'] = "";
		} else {
			$data['ipd_patient_id'] = $ipd_patient_id;
		}

		// $data['head_data']=$this->head_data();
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div>', '</div>');
		// Validating Name Field
		$this->form_validation->set_rules('patient_name', 'Patient Name', 'required');
		$this->form_validation->set_rules('phone_no', 'Phone No', 'required');

		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['room'] = $this->admin_model->select_with_where2('*', 'status=1 and type=1', 'room');
		$data['uhid'] = $this->admin_model->select_with_where2('*', 'status=1', 'uhid');

		$data['cabin_available_info'] = $this->admin_model->select_with_where2('*', 'type != 3', 'ipd_patient_info');


		// $this->form_validation->set_rules('age', 'Age', 'required');
		// $this->form_validation->set_rules('email', 'Email', 'required');
		// $this->form_validation->set_rules('gender', 'Gender', 'required');
		// $this->form_validation->set_rules('cabin_no', 'Cabin No', 'required');
		// $this->form_validation->set_rules('blood_group', 'Blood Group', 'required');

		if ($this->form_validation->run() == FALSE) {
			// $this->load->view('ipd/ipd_registration',$data);
			$this->load->view('ipd/ipd_registration', $data);
		} else {
			//check the cabin name is empty or not
			if ($this->admin_model->check_row('*', 'type!=3 and cabin_no="' . $this->input->post('cabin_no') . '"', 'ipd_patient_info')) {
				$data['message'] = "Cabin is Already in Used Mood";
				$this->load->view('ipd/ipd_registration', $data);
			} else {

				$patient_id = 'ipd-p-000001';
				$get_last_patient_code = $this->admin_model->get_last_row_no_where('ipd_patient_info', 'id');

				if (count($get_last_patient_code) > 0) {
					$patient_id = $get_last_patient_code[0]['patient_info_id'];
					$patient_code_explode = explode('-', $patient_id);
					$patient_code_int = $patient_code_explode[2];
					$patient_code_number = str_pad(($patient_code_int + 1), 6, "0", STR_PAD_LEFT);
					$patient_id = $patient_code_explode[0] . '-' . $patient_code_explode[1] . '-' . $patient_code_number;
				}

				// "<pre>";print_r($this->input->post('uhid'));die();

				$doc_name = explode('#', $this->input->post('doc_name'));

				$ref_doc_name = explode('#', $this->input->post('ref_doc_name'));


				$val = array(
					'patient_name' => $this->input->post('patient_name'),
					'reg_id' => $this->input->post('reg_no'),
					'uhid' => $this->input->post('uhid'),
					'patient_info_id' => $patient_id,
					'mobile_no' => $this->input->post('phone_no'),
					'description' => $this->input->post('description'),
					'village' => $this->input->post('village'),
					'post_office' => $this->input->post('post_office'),
					'police_station' => $this->input->post('police_station'),
					'district' => $this->input->post('district'),
					'guardian_name' => $this->input->post('guardian_name'),
					'disease_name' => $this->input->post('disease_name'),
					'age' => $this->input->post('age'),
					'gender' => $this->input->post('gender'),
					'cabin_no' => $this->input->post('cabin_no'),
					'blood_group' => $this->input->post('blood_group'),
					'date_of_birth' => $this->input->post('date_of_birth'),
					'email' => $this->input->post('email'),
					'password' => $this->encryptIt("123456"),
					'ref_doc_name' => $ref_doc_name[0],
					'ref_doc_id' => $ref_doc_name[1],
					'doc_name' => $doc_name[0],
					'doc_id' => $doc_name[1],
					'advance_payment' => $this->input->post('adv_pay') == "" ? 0 : $this->input->post('adv_pay'),
					'admission_fee' => $this->input->post('adm_fee') == "" ? 0 : $this->input->post('adm_fee'),
					'admission_fee_paid' => $this->input->post('adm_fee_paid') == "" ? 0 : $this->input->post('adm_fee_paid'),
					'operator_name' => $this->session->userdata['logged_in']['username'],
					'operator_id' => $this->session->userdata['logged_in']['id'],
					'hospital_id' => $this->session->userdata['logged_in']['hospital_id'],
					'patient_image' => "default_patient.jpg",
					'created_at' => date('Y-m-d H:i:s')
				);

				if ($this->admin_model->check_row('*', 'uhid="' . $this->input->post('uhid') . '" and uhid!=0', 'ipd_patient_info')) {
					$p_info = $this->admin_model->select_with_where2('*', 'status=1 and uhid="' . $this->input->post('uhid') . '"', 'ipd_patient_info');

					$id = $p_info[0]['id'];

					$val1 = array(
						'patient_name' => $this->input->post('patient_name'),
						'reg_id' => $this->input->post('reg_no'),
						'uhid' => $this->input->post('uhid'),
						'mobile_no' => $this->input->post('phone_no'),
						'description' => $this->input->post('description'),
						'village' => $this->input->post('village'),
						'post_office' => $this->input->post('post_office'),
						'police_station' => $this->input->post('police_station'),
						'district' => $this->input->post('district'),
						'guardian_name' => $this->input->post('guardian_name'),
						'disease_name' => $this->input->post('disease_name'),
						'age' => $this->input->post('age'),
						'gender' => $this->input->post('gender'),
						'cabin_no' => $this->input->post('cabin_no'),
						'blood_group' => $this->input->post('blood_group'),
						'date_of_birth' => $this->input->post('date_of_birth'),
						'email' => $this->input->post('email'),
						'password' => $this->encryptIt("123456"),
						'ref_doc_name' => $ref_doc_name[0],
						'ref_doc_id' => $ref_doc_name[1],
						'doc_name' => $doc_name[0],
						'doc_id' => $doc_name[1],
						'advance_payment' => $this->input->post('adv_pay') == "" ? 0 : $this->input->post('adv_pay'),
						'admission_fee' => $this->input->post('adm_fee') == "" ? 0 : $this->input->post('adm_fee'),
						'admission_fee_paid' => $this->input->post('adm_fee_paid') == "" ? 0 : $this->input->post('adm_fee_paid'),
						'operator_name' => $this->session->userdata['logged_in']['username'],
						'operator_id' => $this->session->userdata['logged_in']['id'],
						'hospital_id' => $this->session->userdata['logged_in']['hospital_id'],
						'patient_image' => "default_patient.jpg",
						'created_at' => date('Y-m-d H:i:s')
					);

					$this->admin_model->update_function('id', $id, 'ipd_patient_info', $val1);
				} else {
					$id = $this->admin_model->insert_ret('ipd_patient_info', $val);
				}



				if ($_FILES['patient_image']['name']) {
					$name_generator = $this->name_generator($_FILES['patient_image']['name'], $id);
					$i_ext = explode('.', $_FILES['patient_image']['name']);
					$target_path = $name_generator . '.' . end($i_ext);;
					$size = getimagesize($_FILES['patient_image']['tmp_name']);

					if (move_uploaded_file($_FILES['patient_image']['tmp_name'], 'uploads/ipd_patient_image/' . $target_path)) {
						$patient_image = $target_path;
					}

					$data_logo1['patient_image'] = $patient_image;
					$this->admin_model->update_function('id', $id, 'ipd_patient_info', $data_logo1);
				}


				$service_code = 'ipd-000001';
				$get_last_service_code = $this->admin_model->get_last_row_no_where('ipd_final_bill', 'id');

				if (count($get_last_service_code) > 0) {
					$service_code = $get_last_service_code[0]['invoice_order_id'];
					$service_code_explode = explode('-', $service_code);
					$service_code_int = $service_code_explode[1];
					$service_code_number = str_pad(($service_code_int + 1), 6, "0", STR_PAD_LEFT);
					$service_code = $service_code_explode[0] . '-' . $service_code_number;
				}

				$admission_fee = $this->input->post('adm_fee') == "" ? 0 : $this->input->post('adm_fee');
				$admission_fee_paid = $this->input->post('adm_fee_paid') == "" ? 0 : $this->input->post('adm_fee_paid');
				$adv_pay = $this->input->post('adv_pay') == "" ? 0 : $this->input->post('adv_pay');


				$val1 = array(
					'p_id' => $id,
					'uhid' => $this->input->post('uhid'),
					'invoice_order_id' => $service_code,
					'advance_payment' => $this->input->post('adv_pay') == "" ? 0 : $this->input->post('adv_pay'),
					'admission_fee' => $this->input->post('adm_fee') == "" ? 0 : $this->input->post('adm_fee'),
					'admission_fee_paid' => $this->input->post('adm_fee_paid') == "" ? 0 : $this->input->post('adm_fee_paid'),
					'total_amount' => $this->input->post('adm_fee') == "" ? 0 : $this->input->post('adm_fee'),
					'total_paid' => $adv_pay + $admission_fee_paid,
					'created_at' => date('Y-m-d H:i:s')
				);

				$this->admin_model->insert('ipd_final_bill', $val1);

				$d_data['old_due'] = $admission_fee;

				$d_data['order_id'] = $patient_id;
				$d_data['total_amount'] = $admission_fee;
				$d_data['patient_id'] = $id;

				$d_data['current_due'] = $admission_fee - ($adv_pay + $admission_fee_paid);

				$d_data['paid_due'] = $adv_pay + $admission_fee_paid;

				$d_data['admission_fee'] = $admission_fee;

				$d_data['advance_payment'] = $adv_pay;

				$d_data['admission_fee_paid'] = $admission_fee_paid;

				$d_data['created_at'] = date('Y-m-d H:i:s');
				$d_data['due_type'] = 2;
				$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
				$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];

				$this->load->admin_model->insert_ret('due_collection', $d_data);




				$busy_flag['is_busy'] = 1;
				$room_id = $this->input->post('cabin_no');


				$this->admin_model->update_function('id', $room_id, 'room', $busy_flag);

				$val = array(
					'patient_id' => $id,
					'cabin_no' => $this->input->post('cabin_no'),
					'type' => 1,
					'created_at' => date('Y-m-d H:i:s')
				);

				$this->admin_model->insert('patient_timeline', $val);

				$data['message'] = "New Patient Registered Successfully Done";


				redirect("admin/ipd_registration/" . $id, 'refresh');
			}
		}
	}

	public function get_all_cabin_room_no()
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1', 'room');
		echo json_encode($data);
	}

	public function get_all_medicine()
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1', 'product');
		echo json_encode($data);
	}


	public function ipd_all_patient_list()
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD All Patient List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];
		$id = $data['hospital_id'];;
		$data['ipd_all_patient'] = $this->admin_model->select_with_where2('*', 'status=1', 'ipd_patient_info');

		$data['room'] = $this->admin_model->select_with_where2('*', 'hospital_id="' . $id . '"', 'room');



		$this->load->view('ipd/ipd_all_patient_list', $data);
	}


	public function ipd_all_patient_list_dt($value = '')
	{


		$select_column = '*,i.id,i.created_at';
		$order_column = array('id', 'patient_info_id', 'reg_id', 'patient_name', 'ref_doc_name', 'doc_name', 'disease_name', 'cabin_no');

		$search_column = array('patient_name', 'patient_info_id', 'disease_name', 'reg_id', 'ref_doc_name', 'doc_name', 'room_title');

		$condition = 'i.status=1';

		$fetch_data = $this->admin_model->make_datatables_two_table_join('ipd_patient_info i', $condition, $select_column, $order_column, $search_column, 'room r', 'r.id=i.cabin_no', 'i.id');

		// "<pre>";print_r($fetch_data);die();

		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->patient_info_id;
			$sub_array[] = $row->reg_id;
			$sub_array[] = $row->patient_name;
			$sub_array[] = $row->doc_name;
			$sub_array[] = $row->ref_doc_name;
			$sub_array[] = $row->disease_name;
			$sub_array[] = $row->room_title;
			$sub_array[] = date('d-M-y', strtotime($row->created_at));

			$sub_array[] = '<a href="admin/ipd_reg_form/' . $row->id . '" class="btn btn-primary btn-sm" target="_blank">Reg Form</a>';

			if ($row->type == 3) {
				$sub_array[] = '<span class="badge badge-success">Released</span>';
			} else {
				$sub_array[] = '<span class="badge badge-danger">Unreleased</span>';
			}

			$sub_array[] = '<a href="admin/patient_details/' . $row->id . '" class="btn btn-primary btn-sm">View Details</a>';

			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('ipd_patient_info i', $condition, $select_column, 'room r', 'r.id=i.cabin_no'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
				'ipd_patient_info i',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'room r',
				'r.id=i.cabin_no',
				'i.id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}





	public function ipd_billing()
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD Billing';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$this->load->view('ipd/ipd_billing', $data);
	}

	public function ipd_billing_details()
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD Billing Details';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$this->load->view('ipd/ipd_billing_details', $data);
	}

	public function patient_details()
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'Patient Details';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$id = $this->uri->segment(3);
		$data['patient_details_info'] = $this->admin_model->select_join_three_table2_left('*,b.id as b_id,r.id as r_id,i.id as i_id,r.room_price as room_price', 'ipd_patient_info i', 'room r', 'blood_group b', 'i.cabin_no=r.id', 'i.blood_group=b.id', 'i.id="' . $id . '" and i.status=1');


		// "<pre>";print_r($data['patient_details_info']);die();

		$data['all_cabin_room'] = $this->admin_model->select_with_where('*', 1, 'room', 'status');
		$data['all_blood_group'] = $this->admin_model->select_with_where('*', 1, 'blood_group', 'status');
		$data['patient_timeline'] = $this->admin_model->select_join_where_order('*,p.created_at', 'patient_timeline p', 'room r', 'r.id=p.cabin_no', 'patient_id="' . $id . '" AND r.status=1', 'p.id', 'ASC');
		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');
		$this->load->view('ipd/patient_details', $data);
	}

	public function update_patient_image()
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'Patient Details';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$id = $this->uri->segment(3);
		if ($_FILES['patient_image']['name']) {
			$name_generator = $this->name_generator($_FILES['patient_image']['name'], $id);
			$i_ext = explode('.', $_FILES['patient_image']['name']);
			$target_path = $name_generator . '.' . end($i_ext);;
			$size = getimagesize($_FILES['patient_image']['tmp_name']);

			if (move_uploaded_file($_FILES['patient_image']['tmp_name'], 'uploads/patient_image/' . $target_path)) {
				$patient_image = $target_path;
			}

			$data_image['patient_image'] = $patient_image;;
			$this->admin_model->update_function('id', $id, 'ipd_patient_info', $data_image);
			$this->patient_details();
		}
	}

	public function update_patient_data()
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'Patient Details';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$id = $this->uri->segment(3);
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div style="color:red;height:50px;" align="center">', '</div>');
		$this->form_validation->set_rules('patient_name', 'Patient Name', 'required');
		// $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required|exact_length[11]');

		if ($this->form_validation->run() == FALSE) {
			$this->patient_details();
		} else {

			$id = $this->uri->segment(3);

			$doc_name = explode('#', $this->input->post('doc_name'));

			$ref_doc_name = explode('#', $this->input->post('ref_doc_name'));


			$val = array(
				'cabin_no' => $this->input->post('cabin_no'),
				'blood_group' => $this->input->post('blood_group'),
				'admission_fee' => $this->input->post('adm_fee'),
				'advance_payment' => $this->input->post('adv_pay'),
				'admission_fee_paid' => $this->input->post('adm_fee_paid'),
				'email' => $this->input->post('email'),
				'gender' => $this->input->post('gender'),
				'mobile_no' => $this->input->post('mobile_no'),
				'date_of_birth' => $this->input->post('date_of_birth'),
				'patient_name' => $this->input->post('patient_name'),
				'ref_doc_name' => $ref_doc_name[0],
				'ref_doc_id' => $ref_doc_name[1],
				'doc_name' => $doc_name[0],
				'doc_id' => $doc_name[1],
				'age' => $this->input->post('age'),
				'disease_name' => $this->input->post('disease_name'),
				'guardian_name' => $this->input->post('guardian_name'),
				'address' => $this->input->post('address'),
				'blood_pressure' => $this->input->post('blood_pressure'),
				'pulse_rate' => $this->input->post('pulse_rate'),
				'description' => $this->input->post('description'),
				'operator_name' => $this->session->userdata['logged_in']['username'],
				'operator_id' => $this->session->userdata['logged_in']['id']
			);

			$this->admin_model->update_function('id', $id, 'ipd_patient_info', $val);

			$adm_info['admission_fee'] = $this->input->post('adm_fee');
			$adm_info['advance_payment'] = $this->input->post('adv_pay');
			$adm_info['admission_fee_paid'] = $this->input->post('adm_fee_paid');
			$adm_info['total_paid'] = $this->input->post('adm_fee_paid') + $this->input->post('adv_pay');
			$adm_info['total_amount'] = $this->input->post('adm_fee');


			$this->admin_model->update_function2('p_id="' . $id . '"', 'ipd_final_bill', $adm_info);


			$d_data['old_due'] = $this->input->post('adm_fee');

			$d_data['total_amount'] = $this->input->post('adm_fee');

			$d_data['current_due'] = $this->input->post('adm_fee') - ($this->input->post('adv_pay') + $this->input->post('adm_fee_paid'));

			$d_data['paid_due'] = $this->input->post('adv_pay') + $this->input->post('adm_fee_paid');

			$d_data['admission_fee'] = $this->input->post('adm_fee');

			$d_data['advance_payment'] = $this->input->post('adv_pay');

			$d_data['admission_fee_paid'] = $this->input->post('adm_fee_paid');

			$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
			$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];


			$this->admin_model->update_function2('order_id="' . $this->input->post('ipd_long_id') . '" and due_type=2', 'due_collection', $d_data);




			$data['patient_details_info'] = $this->admin_model->select_join_three_table('*,b.id as b_id,r.id as r_id,i.id as i_id', 'ipd_patient_info i', 'room r', 'blood_group b', 'i.cabin_no=r.id', 'i.blood_group=b.id', 'i.id', $id, 'i.status', 1);
			$data['all_cabin_room'] = $this->admin_model->select_with_where('*', 1, 'room', 'status');
			$data['all_blood_group'] = $this->admin_model->select_with_where('*', 1, 'blood_group', 'status');
			$data['message'] = "Updated Successfully";

			redirect("admin/ipd_all_patient_list", 'refresh');
		}
	}



	public function ipd_patient_unrelease_list($uhid = '')
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD Unrelease Patient List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['flag'] = "unrelease";

		$data['uhid'] = $uhid;
		$this->load->view('ipd/ipd_unrelease_patient_list', $data);
	}


	public function ipd_patient_release_list()
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD Release Patient List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['flag'] = "release";
		$this->load->view('ipd/ipd_release_patient_list', $data);
	}


	public function ipd_patient_release_unrelese_list_dt($flag = '', $uhid = '')
	{
		$select_column = array("*");
		$order_column = array('id');
		$search_column = array('patient_info_id');

		if ($flag == 'release') {
			$condition = 'status=1 and type=3';
		} else {
			$condition = 'status=1 and type!=3';
		}

		if ($uhid != "") {
			$condition .= ' AND uhid="' . $uhid . '"';
		}



		$fetch_data = $this->admin_model->make_datatables('ipd_patient_info', $condition, $select_column, $order_column, $search_column, 'id');
		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {

			$check_opd_service = $this->admin_model->select_with_where2('*', 'ipd_patient_id="' . $row->id . '"', 'opd_patient_test_order_info');

			$is_phar = $this->admin_model->select_join_where('*', 'customer c', 'sell s', 'c.id=s.cust_id', 'c.status=1 and s.status=1 and p_id="' . $row->id . '" and type=2');

			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->patient_info_id;
			$sub_array[] = $row->patient_name;
			$sub_array[] = $row->mobile_no;
			// $sub_array[] = $row->email; 
			$sub_array[] = '<a href="admin/ipd_reg_form/' . $row->id . '" class="btn btn-primary btn-sm" target="_blank">Reg Form</a>';

			if (count($check_opd_service) < 1) {
				$sub_array[] = "<span style='text-align:center; color:red;'>No</span>";
			} else {
				$sub_array[] = '<span style="text-align:center; color:green;">Yes<br><a href="admin/opd_patient_billing_details/' . $check_opd_service[0]['patient_id'] . '/ipd" class="btn btn-primary btn-sm">Details</a>';
			}



			if (count($is_phar) > 0) {
				$sub_array[] = '<span style="color:green;">Yes</span><br><a target="_blank" href="admin/sell_product_details/' . $is_phar[0]['sell_id'] . '" class="btn btn-primary btn-sm">Info</a>';
			} else {
				$sub_array[] = '<p style="color:red;">No</p>';
			}


			$sub_array[] = '<a href="admin/get_ipd_patient_billing_info_pdf1/' . $row->id . '" class="btn btn-primary btn-sm" target="_blank">Print</a>';


			$sub_array[] = date('d-M-Y h:i:s a', strtotime($row->created_at));

			if ($flag == 'release') {
				$sub_array[] = date('d-M-Y h:i:s a', strtotime($row->released_date));
			}

			if ($flag == 'unrelease') {

				$sub_array[] = '<a href="admin/ipd_adv_pay/' . $row->id . '" class="btn btn-primary btn-sm">Adv pay</a>';

				$sub_array[] = '<a href="admin/patient_details/' . $row->id . '" class="btn btn-primary btn-sm">
	 			Edit Info</a>';

				$sub_array[] = '<a href="admin/ipd_payment_details/' . $row->id . '/' . $flag . '" class="btn btn-success btn-sm">View Det</a>';
			}


			if ($flag == 'unrelease') {
				$sub_array[] = '<a href="admin/add_ipd_patient_service/' . $row->id . '" class="btn btn-success btn-sm">Add Service</a>';

				$sub_array[] = '<a  href="admin/release_patient/' . $row->id . '" onclick="clickAndDisable(this);" class="btn btn-success btn-sm release_btn">Release</a>';
			}

			if ($this->auth->can('edit_ipd_bill-admin') && $flag == 'unrelease') {
				$sub_array[] = '<a href="admin/edit_ipd_bill/' . $row->id . '" class="btn btn-success btn-sm">Edit</a>';

				$sub_array[] = '<a href="admin/delete_ipd_bill/' . $row->id . '/ipd_patient_unrelease_list" class="btn btn-danger btn-sm">Delete</a>';
			}

			if ($this->auth->can('edit_ipd_bill-admin') && $flag == 'release') {
				$sub_array[] = '<a href="admin/edit_ipd_bill/' . $row->id . '" class="btn btn-success btn-sm">Edit</a>';

				$sub_array[] = '<a href="admin/delete_ipd_bill/' . $row->id . '/ipd_patient_release_list" class="btn btn-danger btn-sm">Delete</a>';
			}

			$data[] = $sub_array;
			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data('*', 'ipd_patient_info', $condition),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data(
				'ipd_patient_info',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}




	public function release_patient($value = '')
	{

		// die();

		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD Release Patient List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$patient_id = $this->uri->segment(3);

		$total_cabin = 0;

		$val = array(
			'type' => 3,
			'released_date' => date('Y-m-d H:i:s')
		);

		$this->admin_model->update_function('id', $patient_id, 'ipd_patient_info', $val);

		$ipd_patient_info = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $patient_id . '"', 'ipd_patient_info');

		$val = array(
			'patient_id' => $patient_id,
			'cabin_no' => $ipd_patient_info[0]['cabin_no'],
			'type' => 3,
			'created_at' => date('Y-m-d H:i:s')
		);

		$this->admin_model->insert('patient_timeline', $val);

		$old_room_info = array(
			'is_busy' => 0,
			'p_id' => $patient_id
		);
		$this->admin_model->update_function('id', $ipd_patient_info[0]['cabin_no'], 'room', $old_room_info);


		$patient_timeline = $this->admin_model->select_join_where_order('*,p.created_at', 'patient_timeline p', 'room r', 'r.id=p.cabin_no', 'patient_id="' . $patient_id . '" AND r.status=1', 'p.id', 'ASC');


		$total_service_bill = $this->admin_model->get_sum_ipd_service($patient_id);


		if ($total_service_bill == null) {
			$total_service_bill = 0;
		}


		$total_cabin = 0;

		foreach ($patient_timeline as $key => $value) {
			if ($key < count($patient_timeline) - 1) {

				$current_date = date_create(date('Y-m-d H:i:s', strtotime($value['created_at'])));
				// echo  $current_date;
				// echo  $next_date;
				$next_date = date_create(date('Y-m-d H:i:s', strtotime($patient_timeline[$key + 1]['created_at'])));
				$diff = date_diff($next_date, $current_date);
				$hours = $diff->h;
				$days = $diff->d;

				$price_per_hour = $value['room_price'] / 24;

				$total_cabin = round($total_cabin + ($days * $value['room_price'] + $hours * $price_per_hour));
			}
		}


		$ipd_bill_info = $this->admin_model->select_with_where2('*', 'p_id="' . $patient_id . '"', 'ipd_final_bill');


		$val = array(
			'total_amount' => $total_cabin + $total_service_bill + $ipd_bill_info[0]['admission_fee'],
			'amount_cabin' => $total_cabin,
			'total_paid' => $ipd_bill_info[0]['advance_payment'] + $ipd_bill_info[0]['admission_fee_paid'],
			'amount_service' => $total_service_bill,
			'advance_payment' => $ipd_bill_info[0]['advance_payment'],
			'admission_fee' => $ipd_bill_info[0]['admission_fee'],
			'admission_fee_paid' => $ipd_bill_info[0]['admission_fee_paid'],
			'updated_at' => date("Y-m-d H:i:s"),
			'released_date' => date("Y-m-d H:i:s"),

		);

		$this->admin_model->update_function2('p_id="' . $patient_id . '"', 'ipd_final_bill', $val);

		$d_data['old_due'] = $total_cabin + $total_service_bill + $ipd_bill_info[0]['admission_fee'];

		$d_data['order_id'] = $ipd_patient_info[0]['patient_info_id'];


		$d_data['total_amount'] = $total_cabin + $total_service_bill + $ipd_bill_info[0]['admission_fee'];
		$d_data['patient_id'] = $patient_id;

		$d_data['current_due'] = $total_cabin + $total_service_bill + $ipd_bill_info[0]['admission_fee'] - ($ipd_bill_info[0]['advance_payment'] + $ipd_bill_info[0]['admission_fee_paid']);

		$d_data['paid_due'] = 0;

		$d_data['admission_fee'] = $ipd_bill_info[0]['admission_fee'];

		$d_data['advance_payment'] = 0;

		$d_data['admission_fee_paid'] = 0;

		$d_data['created_at'] = date('Y-m-d H:i:s');

		$d_data['due_type'] = 2;

		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];

		$this->load->admin_model->insert_ret('due_collection', $d_data);


		redirect("admin/ipd_patient_billing_list_due", 'refresh');
	}

	public function edit_indoor_patient_bill($value = '')
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD Edit Patient';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['all_ipd_patient_id'] = $this->admin_model->select_with_where2('*', 'status=1', 'ipd_patient_info');


		$this->load->view('ipd/edit_indoor_patient_bill', $data);
	}

	public function edit_ipd_bill($patient_id = '')
	{

		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD Edit Patient';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		if ($patient_id == '') {
			redirect('admin/edit_ipd_bill/' . $_POST['patient_id']);
		}

		$this->cart->destroy();

		// $data['flag']=$flag;

		$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];

		// $patient_id = $this->uri->segment(3);



		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $patient_id . '"', 'ipd_patient_info');

		$data['flag'] = $data['patient_info'][0]['type'] == 3 ? "release" : "unrelease";

		$data['patient_timeline'] = $this->admin_model->select_join_where_order('*,p.created_at,r.room_price', 'patient_timeline p', 'room r', 'r.id=p.cabin_no', 'patient_id="' . $patient_id . '" AND r.status=1 ', 'p.id', 'ASC');

		$data['hospital_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND hospital_id="' . $data['hospital_id'] . '"', 'hospital');


		$data['total_bill_info'] = $this->admin_model->select_with_where2('*', 'p_id="' . $patient_id . '"', 'ipd_final_bill');

		$data['service_info'] = $this->admin_model->select_join_where('*', 'service_info si', 'service_details sd', 'si.id=sd.service_id', 'sd.p_id="' . $patient_id . '"');

		$data['room_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'room');

		$data['last_room'] = $this->admin_model->get_last_row2('patient_timeline', 'patient_id="' . $patient_id . '"');

		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['service_info_edit'] = $this->admin_model->select_with_where2('*', 'service_status=1', 'service_info');

		$data['ipd_all_patient'] = $this->admin_model->select_with_where2('*', 'type!=3', 'ipd_patient_info');

		// "<pre>";print_r($date['last_room']);die();

		$this->load->view('ipd/edit_ipd_bill', $data);
	}

	public function edit_ipd_bill_post()
	{

		$patient_id = $this->input->post('patient_id');

		$ipd_patient_info = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $patient_id . '"', 'ipd_patient_info');

		$admit_date = $this->input->post('admit_date');

		// "<pre>";print_r($admit_date);die();

		$release_unlease = $this->input->post('release_unrelease');

		// delete all info from patient_timeline

		$room_id = $this->input->post('r_id');

		foreach ($admit_date as $key => $date) {

			if ($date == "" && $room_id[0] != '') {
				$this->session->set_flashdata('error', 'Admit date can not be empty');
				redirect('admin/edit_ipd_bill/' . $patient_id, 'refresh');
			} elseif ($date > date('Y-m-d H:i:s') && $room_id[0] != '') {
				// "<pre>";print_r(new DateTime($date));die();
				$this->session->set_flashdata('date_error', 'Admit date can not be greater than today date');
				redirect('admin/edit_ipd_bill/' . $patient_id, 'refresh');
			}
		}


		// "<pre>";print_r(count($room_id));die();

		$last_row = $this->admin_model->get_last_row2('patient_timeline', 'patient_id="' . $patient_id . '"');

		if ($room_id[0] != '') {
			$this->admin_model->delete_function_cond('patient_timeline', 'patient_id="' . $patient_id . '"');
			$value = array(
				'is_busy' => 0,
				'p_id' => 0
			);
			$this->admin_model->update_function2('id="' . $last_row[0]['cabin_no'] . '"', 'room', $value);
		} elseif ($release_unlease == "unrelease" && $ipd_patient_info[0]['type'] == 3) {

			$this->admin_model->delete_function_cond('patient_timeline', 'id="' . $last_row[0]['id'] . '"');
			$value = array(
				'is_busy' => 1,
				'p_id' => $patient_id
			);
			$this->admin_model->update_function2('id="' . $last_row[0]['cabin_no'] . '"', 'room', $value);
		} elseif ($release_unlease == "release" && $ipd_patient_info[0]['type'] != 3) {

			$last_data['patient_id'] = $last_row[0]['patient_id'];
			$last_data['type'] = 3;
			$last_data['cabin_no'] = $last_row[0]['cabin_no'];
			$last_data['created_at'] = date('Y-m-d H:i:s');

			$this->admin_model->insert('patient_timeline', $last_data);

			$value = array(
				'is_busy' => 0,
				'p_id' => 0
			);
			$this->admin_model->update_function2('id="' . $last_row[0]['cabin_no'] . '"', 'room', $value);
		}




		// delete all info from due_collection

		$this->admin_model->delete_function_cond('due_collection', 'patient_id="' . $patient_id . '" and due_type = 2');

		// delete all info from service_details

		if (count($this->cart->contents()) > 0) {
			$this->admin_model->delete_function_cond('service_details', 'p_id="' . $patient_id . '"');
		}


		// update ipd_patient_info

		if ($this->input->post('release_unrelease') == "release") {
			$val = array(
				'type' => 3,
				'released_date' => date('Y-m-d H:i:s'),
				'is_edited' => 2,
				'admission_fee' => $this->input->post('adm_fee'),
				'admission_fee_paid' => $this->input->post('adm_fee_paid'),
				'advance_payment' => $this->input->post('adv_payment')
			);
		} else {
			$val = array(
				'type' => 1,
				'is_edited' => 2,
				'admission_fee' => $this->input->post('adm_fee'),
				'admission_fee_paid' => $this->input->post('adm_fee_paid'),
				'advance_payment' => $this->input->post('adv_payment')
			);
		}

		$this->admin_model->update_function('id', $patient_id, 'ipd_patient_info', $val);

		// Insert into patient timeline

		for ($i = 0; $i < count($room_id) and $room_id[0] != ''; $i++) {
			$bd_data['patient_id'] = $patient_id;
			$bd_data['cabin_no'] = $room_id[$i];
			$bd_data['created_at'] = $admit_date[$i];

			if ($i == 0) {
				$type = 1;
			} else {
				$type = 2;
			}

			$bd_data['type'] = $type;

			$this->admin_model->insert('patient_timeline', $bd_data);

			if ($release_unlease == "release") {
				if ($i == count($room_id) - 1) {
					$type = 3;
					$bd_data['type'] = $type;
					$bd_data['created_at'] = date('Y-m-d H:i:s');
					$this->admin_model->insert('patient_timeline', $bd_data);
				}
			} else {
				if ($i == count($room_id) - 1) {
					$value = array(
						'is_busy' => 1,
						'p_id' => $patient_id
					);
					$this->admin_model->update_function2('id="' . $room_id[$i] . '"', 'room', $value);
				}
			}
		}


		// Insert into service_detials

		$cart = $this->cart->contents();

		foreach ($cart as $item) {
			$data = array(
				'service_id' => $item['id'],
				'p_id' => $patient_id,

				'price' => $item['price'],
				'qty' => $item['qty'],
				'operated_id' => $item['options']['s_doctor_id'],
				'operated_name' => $item['options']['s_doctor_name'],
				'operator_name' => $this->session->userdata['logged_in']['username'],
				'operator_id' => $this->session->userdata['logged_in']['id'],
				'created_at' => date('Y-m-d H:i:s')
			);

			$id = $this->load->admin_model->insert_ret('service_details', $data);


			$data = array(

				'service_details_id' => $id,
				'old_cost'	=> $item['price'],
				'current_cost' => $item['price'],
				'discount_ref' => $this->input->post('discount_ref'),
				'operator_id' => $this->session->userdata['logged_in']['id'],
				'operator_name' => $this->session->userdata['logged_in']['username'],
				'created_at' => date('Y-m-d H:i:s')
			);

			$this->admin_model->insert('service_payment_details', $data);
		}

		$this->cart->destroy();

		// Update into ipd_final_bill

		$val1 = array(
			'p_id' => $patient_id,
			'advance_payment' => $this->input->post('adv_payment'),
			'admission_fee' => $this->input->post('adm_fee'),
			'admission_fee_paid' => $this->input->post('adm_fee_paid'),
			'total_amount' => $this->input->post('adm_fee'),
			'payment_status' => "unpaid",
			'total_paid' => $this->input->post('adv_pay') + $this->input->post('adm_fee_paid'),
			'updated_at' => date('Y-m-d H:i:s')
		);

		$this->admin_model->update_function('id', $patient_id, 'ipd_final_bill', $val1);

		if ($release_unlease == "release") {
			$patient_timeline = $this->admin_model->select_join_where_order('*,p.created_at', 'patient_timeline p', 'room r', 'r.id=p.cabin_no', 'patient_id="' . $patient_id . '" AND r.status=1', 'p.id', 'ASC');

			$total_service_bill = $this->admin_model->get_sum_ipd_service($patient_id);


			if ($total_service_bill == null) {
				$total_service_bill = 0;
			}


			$total_cabin = 0;

			foreach ($patient_timeline as $key => $value) {
				if ($key < count($patient_timeline) - 1) {

					$current_date = date_create(date('Y-m-d H:i:s', strtotime($value['created_at'])));
					// echo  $current_date;
					// echo  $next_date;
					$next_date = date_create(date('Y-m-d H:i:s', strtotime($patient_timeline[$key + 1]['created_at'])));
					$diff = date_diff($next_date, $current_date);
					$hours = $diff->h;
					$days = $diff->d;

					$price_per_hour = $value['room_price'] / 24;

					$total_cabin = round($total_cabin + ($days * $value['room_price'] + $hours * $price_per_hour));
				}
			}


			$val = array(
				'total_amount' => $total_cabin + $total_service_bill + $this->input->post('adm_fee'),
				'amount_cabin' => $total_cabin,
				'total_paid' => $this->input->post('adv_payment') + $this->input->post('adm_fee_paid'),
				'amount_service' => $total_service_bill,
				'updated_at' => date('Y-m-d H:i:s'),

			);

			$this->admin_model->update_function2('p_id="' . $patient_id . '"', 'ipd_final_bill', $val);
		}

		// Insert into due_collection

		// "<pre>";print_r($patient_id);die();

		$d_data['old_due'] = $this->input->post('adm_fee');

		$d_data['order_id'] = $ipd_patient_info[0]['patient_info_id'];
		$d_data['total_amount'] = $this->input->post('adm_fee');
		$d_data['patient_id'] = $patient_id;

		$d_data['current_due'] = $this->input->post('adm_fee') - ($this->input->post('adv_payment') + $this->input->post('adm_fee_paid'));

		$d_data['paid_due'] = $this->input->post('adv_payment') + $this->input->post('adm_fee_paid');

		$d_data['admission_fee'] = $this->input->post('adm_fee');

		$d_data['advance_payment'] = $this->input->post('adv_payment');

		$d_data['admission_fee_paid'] = $this->input->post('adm_fee_paid');

		$d_data['created_at'] = date('Y-m-d H:i:s');
		$d_data['due_type'] = 2;
		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];

		$this->load->admin_model->insert_ret('due_collection', $d_data);



		if ($release_unlease == "release") {

			$d_data['old_due'] = $total_cabin + $total_service_bill + $ipd_patient_info[0]['admission_fee'];

			$d_data['order_id'] = $ipd_patient_info[0]['patient_info_id'];


			$d_data['total_amount'] = $total_cabin + $total_service_bill + $ipd_patient_info[0]['admission_fee'];
			$d_data['patient_id'] = $patient_id;

			$d_data['current_due'] = $total_cabin + $total_service_bill + $ipd_patient_info[0]['admission_fee'] - ($ipd_patient_info[0]['advance_payment'] + $ipd_patient_info[0]['admission_fee_paid']);

			$d_data['paid_due'] = 0;

			$d_data['admission_fee'] = $ipd_patient_info[0]['admission_fee'];

			$d_data['advance_payment'] = $ipd_patient_info[0]['advance_payment'];

			$d_data['admission_fee_paid'] = 0;

			$d_data['created_at'] = date('Y-m-d H:i:s');

			$d_data['due_type'] = 2;

			$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
			$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];

			$this->load->admin_model->insert_ret('due_collection', $d_data);
		}

		redirect('admin/edit_ipd_bill/' . $patient_id, 'refresh');
	}

	public function delete_ipd_bill($patient_id = '', $route = '')
	{

		$val = array(
			'status' => 0
		);
		$this->admin_model->update_function2('p_id="' . $patient_id . '"', 'ipd_final_bill', $val);
		$this->admin_model->update_function2('id="' . $patient_id . '"', 'ipd_patient_info', $val);

		redirect('admin/' . $route);
	}

	public function ipd_patient_billing_list_all($uhid = '')
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD All Billing List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['uhid'] = $uhid;

		$data['ipd_all_bill'] = $this->admin_model->select_join_where('*', 'ipd_final_bill if', 'ipd_patient_info ip', 'ip.id=if.p_id', 'ip.status=1');

		$this->load->view('ipd/ipd_billing_all', $data);
	}

	public function ipd_patient_billing_list_all_dt($flag = '', $uhid = '')
	{

		$select_column = '*,if.id,ip.created_at,ip.released_date';
		$order_column = array('p_id', 'patient_info_id', 'patient_name', 'mobile_no', 'test_order_id', null, null, null);

		$search_column = array('patient_name', 'patient_info_id', 'mobile_no', 'invoice_order_id', 'email', 'ip.created_at', 'ip.released_date');

		if ($flag == "all") {
			$condition = "ip.status=1 and ip.type=3";
		} else if ($flag == "paid") {
			$condition = "ip.status=1 and if.payment_status='paid' and ip.type=3";
		} else {
			$condition = "ip.status=1 and if.payment_status='unpaid' and ip.type=3";
		}

		if ($uhid != "") {
			$condition .= " AND ip.uhid='" . $uhid . "'";
		}




		$fetch_data = $this->admin_model->make_datatables_two_table_join('ipd_final_bill if', $condition, $select_column, $order_column, $search_column, 'ipd_patient_info ip', 'ip.id=if.p_id', 'ip.released_date');

		// "<pre>";print_r(expression);die();

		$data = array();

		$i = $_POST['start'];

		$flag = "release";



		foreach ($fetch_data as $key => $row) {

			$check_opd_service = $this->admin_model->select_with_where2('*', 'ipd_patient_id="' . $row->p_id . '"', 'opd_patient_test_order_info');

			$is_phar = $this->admin_model->select_join_where('*', 'customer c', 'sell s', 'c.id=s.cust_id', 'c.status=1 and s.status=1 and p_id="' . $row->id . '" and type=2');

			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->invoice_order_id;
			// $sub_array[] = $row->patient_info_id;  
			$sub_array[] = $row->patient_name;
			$sub_array[] = $row->mobile_no;

			// $sub_array[] = '<a href="admin/ipd_reg_form/'.$row->p_id.'" class="btn btn-primary btn-sm" target="_blank">Form</a>';

			$sub_array[] = '<a href="admin/get_ipd_patient_billing_info_pdf1/' . $row->p_id . '" class="btn btn-primary btn-sm">Print</a>';

			if (count($is_phar) > 0) {
				$sub_array[] = '<span style="color:green;">Yes</span><br><a target="_blank" href="admin/sell_product_details/' . $is_phar[0]['sell_id'] . '" class="btn btn-primary btn-sm">Info</a>';
			} else {
				$sub_array[] = '<p style="color:red;">No</p>';
			}


			if (count($check_opd_service) < 1) {
				$sub_array[] = "<span style='text-align:center; color:red;'>No</span>";
			} else {

				foreach ($check_opd_service as $key => $value) {
					if ($value["payment_status"] == "unpaid") {
						$payment_status = "unpaid";
					} else {
						$payment_status = "paid";
					}
				}

				if ($payment_status == "paid") {
					$sub_array[] = '<span style="text-align:center; color:green;">Yes</span>/<span style="text-align:center; color:green;">' . $payment_status . '</span><br><a href="admin/opd_patient_billing_details/' . $check_opd_service[0]['patient_id'] . '/ipd" class="btn btn-primary btn-sm">Details</a>';
				} else {
					$sub_array[] = '<span style="text-align:center; color:green;">Yes</span>/<span style="text-align:center; color:red;">' . $payment_status . '</span><br><a href="admin/opd_patient_billing_details/' . $check_opd_service[0]['patient_id'] . '/ipd" class="btn btn-primary btn-sm">Details</a>';
				}
			}


			if ($row->payment_status == "paid") {
				$sub_array[] = '<span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>';
			} else {
				$sub_array[] = '<span class="badge badge-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
			}


			$sub_array[] = '<a href="admin/ipd_payment_details/' . $row->p_id . '/' . $flag . '" class="btn btn-primary btn-sm">Pay</a>';
			$sub_array[] = date('d-M-y h:i:s a', strtotime($row->created_at));


			$sub_array[] = date('d-M-y h:i:s', strtotime($row->released_date));

			if ($this->auth->can('edit_ipd_bill-admin')) {
				$sub_array[] = '<a href="admin/edit_ipd_bill/' . $row->p_id . '" class="btn btn-success btn-sm">Edit</a>';

				$sub_array[] = '<a href="admin/delete_ipd_bill/' . $row->p_id . '/ipd_patient_billing_list_all" class="btn btn-danger btn-sm">Delete</a>';
			}

			$sub_array[] = '<a href="admin/operation_cost_pay_to_doctor/' . $row->p_id . '" class="btn btn-primary btn-sm" target="_blank">Cost</a>';

			$sub_array[] = '<a href="admin/operation_cost_pay_to_doctor_print/' . $row->p_id . '" class="btn btn-primary btn-sm" target="_blank">Print</a>';




			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('ipd_final_bill if', $condition, $select_column, 'ipd_patient_info ip', 'ip.id=if.p_id'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
				'ipd_final_bill if',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'ipd_patient_info ip',
				'ip.id=if.p_id',
				'if.id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}


	public function operation_cost_pay_to_doctor($patient_id = '')
	{
		$data['active'] = 'operation_cost';
		$data['page_title'] = 'Operation Cost';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data["service_info"] = $this->admin_model->select_four_join_where('*,s.id as s_id,s.created_at', 'ipd_patient_info ip', 'ipd_final_bill if', 'service_details s', ' service_info si', 'ip.id=if.p_id', 's.p_id=ip.id', 's.service_id=si.id', 'date(s.created_at)="' . date('Y-m-d') . '" and s.operated_id != 0 and s.p_id = "' . $patient_id . '"');

		$this->load->view('ipd/operation_cost_pay_to_doctor', $data);
	}

	public function operation_cost_pay_to_doctor_print($patient_id = '')
	{
		$data['active'] = 'operation_cost';
		$data['page_title'] = 'Operation Cost';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data["service_info"] = $this->admin_model->select_four_join_where('*,s.id as s_id,s.created_at', 'ipd_patient_info ip', 'ipd_final_bill if', 'service_details s', ' service_info si', 'ip.id=if.p_id', 's.p_id=ip.id', 's.service_id=si.id', 'date(s.created_at)="' . date('Y-m-d') . '" and s.operated_id != 0 and s.p_id = "' . $patient_id . '"');



		$this->load->view('ipd/operation_cost_pay_to_doctor_print', $data);
	}


	public function ipd_patient_billing_list_due($value = '')
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD All Due List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		// $data['ipd_all_bill_due']=$this->admin_model->select_join_where('*','ipd_final_bill if','ipd_patient_info ip','ip.id=if.p_id','if.payment_status="unpaid" AND ip.status=1');

		$this->load->view('ipd/ipd_billing_due', $data);
	}

	public function ipd_patient_billing_list_paid($value = '')
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD All Paid Bill List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];





		// $data['ipd_all_bill_paid']=$this->admin_model->select_join_where('*','ipd_final_bill if','ipd_patient_info ip','ip.id=if.p_id','if.payment_status="paid" AND ip.status=1');

		$this->load->view('ipd/ipd_billing_paid', $data);
	}


	public function ipd_payment_details()
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD Payment Details';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		// $data['flag']=$flag;

		$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];

		$patient_id = $this->uri->segment(3);

		$data['flag'] = $this->uri->segment(4);

		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $patient_id . '"', 'ipd_patient_info');

		$data['patient_timeline'] = $this->admin_model->select_join_where_order('*,p.created_at,r.room_price', 'patient_timeline p', 'room r', 'r.id=p.cabin_no', 'patient_id="' . $patient_id . '" AND r.status=1 ', 'p.id', 'ASC');

		$data['hospital_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND hospital_id="' . $data['hospital_id'] . '"', 'hospital');


		$data['total_bill_info'] = $this->admin_model->select_with_where2('*', 'p_id="' . $patient_id . '"', 'ipd_final_bill');

		$data['service_info'] = $this->admin_model->select_join_where('*', 'service_info si', 'service_details sd', 'si.id=sd.service_id', 'sd.p_id="' . $patient_id . '"');

		// $data['service_info']=$this->admin_model->select_join_where_sum_group_by('*','sd.qty','service_info si','service_details sd','si.id=sd.service_id','sd.p_id="'.$patient_id.'"','sd.operated_id','sd.service_id');

		$this->load->view('ipd/ipd_billing_details', $data);
	}

	public function insert_ipd_patient_order_info()
	{

		$data['active'] = 'ipd';
		$data['page_title'] = '';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$order_id = $this->uri->segment(3);
		$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];
		$data['order_id'] = $order_id;
		$patient_id = $this->uri->segment(4);
		$p_id = sprintf("%'.06d", ($patient_id));
		$invoice_order_id = $p_id . '_' . date('YmdHis') . '_' . $this->session->userdata['logged_in']['hospital_id'];



		$order_info = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $order_id . '"', 'ipd_patient_order_info');
		if ($this->input->post('due') == 0) {
			$payment_status = "paid";
		} else {
			$payment_status = "unpaid";
		}



		if ($this->input->post('total') != "") {
			$val = array(
				'invoice_order_id' => $invoice_order_id,
				'total_amount' => $this->input->post('total'),
				'vat' => $this->input->post('vat'),
				'total_discount' => $this->input->post('discount'),
				'total_paid' => $order_info[0]['total_paid'] + $this->input->post('total_paid'),
				'payment_status' => $payment_status,
				'created_at' => date('Y-m-d H:i:s')
			);

			$this->admin_model->update_function('id', $order_id, 'ipd_patient_order_info', $val);

			$paid_amount = $this->admin_model->select_with_where2('paid_amount', 'status=1 AND id="' . $patient_id . '"', 'ipd_patient_info');
			$val = array(
				'total_amount' => $this->input->post('total'),
				'paid_amount' => $paid_amount[0]['paid_amount'] + $this->input->post('total_paid'),

			);

			$this->admin_model->update_function('id', $patient_id, 'ipd_patient_info', $val);
		}




		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $patient_id . '"', 'ipd_patient_info');

		$data['patient_timeline'] = $this->admin_model->select_join_where_order('*,p.created_at', 'patient_timeline p', 'room r', 'r.id=p.cabin_no', 'patient_id="' . $patient_id . '" AND r.status=1', 'p.id', 'ASC');

		$data['hospital_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND hospital_id="' . $data['hospital_id'] . '"', 'hospital');
		$data['order_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $order_id . '"', 'ipd_patient_order_info');																																															// "<pre>";print_r($data['patient_timeline']);die();
		$this->load->view('ipd/ipd_billing_details', $data);
	}


	public function get_ipd_patient_billing_info_pdf()
	{

		require_once($_SERVER['DOCUMENT_ROOT'] . '/hospital_erp1/application/vendor/autoload.php');

		$mpdf = new \Mpdf\Mpdf();

		$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];

		$patient_id = $this->uri->segment(3);
		$order_id = $this->uri->segment(4);

		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $patient_id . '"', 'ipd_patient_info');

		$data['patient_timeline'] = $this->admin_model->select_join_where_order('*,p.created_at', 'patient_timeline p', 'room r', 'r.id=p.cabin_no', 'patient_id="' . $patient_id . '" AND r.status=1 AND order_id="' . $order_id . '"', 'p.id', 'ASC');

		$data['hospital_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND hospital_id="' . $data['hospital_id'] . '"', 'hospital');
		$data['order_id'] = $order_id;

		$data['order_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND patient_id="' . $patient_id . '" AND id="' . $order_id . '"', 'ipd_patient_order_info');
		$html = $this->load->view('pdf', $data, true);
		$stylesheet1 = '<style>' . file_get_contents('back_assets/css/style.css') . '</style>';

		// apply external css
		$mpdf->WriteHTML($stylesheet1, 1);																																																	// $mpdf->WriteHTML($stylesheet2,1);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	public function get_ipd_patient_billing_info_pdf1()
	{
		$data['active'] = 'ipd';
		$data['page_title'] = '';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];

		$patient_id = $this->uri->segment(3);


		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $patient_id . '"', 'ipd_patient_info');

		$data['patient_timeline'] = $this->admin_model->select_join_where_order('*,p.created_at', 'patient_timeline p', 'room r', 'r.id=p.cabin_no', 'patient_id="' . $patient_id . '" AND r.status=1', 'p.id', 'ASC');

		$data['hospital_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND hospital_id="' . $data['hospital_id'] . '"', 'hospital');



		$data['final_bill_info'] = $this->admin_model->select_with_where2('*', 'p_id="' . $patient_id . '"', 'ipd_final_bill');

		$data['service_info'] = $this->admin_model->select_join_where('*,sd.price', 'service_info si', 'service_details sd', 'si.id=sd.service_id', 'sd.p_id="' . $patient_id . '"');


		$this->load->view('ipd/pdf_print_view_ipd', $data);
	}

	public function get_ipd_patient_billing_info_report()
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD Patient List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];

		$patient_id = $this->uri->segment(3);
		$order_id = $this->uri->segment(4);

		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $patient_id . '"', 'ipd_patient_info');

		$data['patient_timeline'] = $this->admin_model->select_join_where_order('*,p.created_at', 'patient_timeline p', 'room r', 'r.id=p.cabin_no', 'patient_id="' . $patient_id . '" AND r.status=1 AND order_id="' . $order_id . '"', 'p.id', 'ASC');

		$data['hospital_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND hospital_id="' . $data['hospital_id'] . '"', 'hospital');
		$data['order_id'] = $order_id;

		$data['order_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND patient_id="' . $patient_id . '" AND id="' . $order_id . '"', 'ipd_patient_order_info');

		$this->load->view('ipd/pdf_print_view_ipd', $data);
	}

	public function get_all_mobile_no_ipd()
	{
		$data = $this->admin_model->select_with_where2_group_by('mobile_no', 'status=1', 'ipd_patient_info', 'mobile_no');

		echo json_encode($data);
	}

	public function get_all_patient_info_by_ipd_id()
	{
		$data = $this->admin_model->select_with_where2('*', 'id="' . $_POST['patient_id'] . '"', 'ipd_patient_info');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function get_product_type()
	{
		$data = $this->admin_model->select_join_where('*,p.id', 'product p', 'product_category pc', 'p.p_cat_id=pc.id', 'p.id="' . $_POST['med_id'] . '"');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function outdoor_service_ipd($value = '')
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'Outdoor Diagnostic Service';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$this->cart->destroy();

		$data['service_info'] = $this->admin_model->select_with_where2('*', 'service_status=1', 'service_info');

		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');


		$data['room'] = $this->admin_model->select_with_where2('*', 'status=1', 'room');

		$data['cabin_available_info'] = $this->admin_model->select_with_where2('*', 'type != 3', 'ipd_patient_info');

		$data['reg_id'] = '000001';
		$get_last_service_code = $this->admin_model->get_last_row_no_where('outdoor_service_order_info', 'id');

		if (count($get_last_service_code) > 0) {
			$service_code = $get_last_service_code[0]['reg_id'];																						// $service_code_explode=explode('-', $service_code);
			// $service_code_int=$service_code_explode[1];
			$service_code_number = str_pad(($service_code + 1), 6, "0", STR_PAD_LEFT);
			$data['reg_id'] = $service_code_number;
		}

		$this->load->view('ipd/outdoor_service_ipd', $data);
	}




	public function outdoor_add_service_cart($value = '')
	{


		$data = array(
			"id"  => $_POST["s_id"],
			"name"  => $_POST["s_name"],
			"qty"  => $_POST["quantity"],
			"price"  => $_POST["s_price"],
			'options' => array('s_doctor_name' => $_POST["s_doctor"], 's_doctor_id' => $_POST["s_doctor_val"])
		);

		$val = $this->cart->insert($data);


		$this->load->view('ipd/outdoor_service_cart');
	}


	public function outdoor_remove_service_cart()
	{
		$row_id = $_POST["row_id"];
		$data = array(
			'rowid' => $row_id,
			'qty' => 0
		);
		$this->cart->update($data);

		$this->load->view('ipd/outdoor_service_cart');
	}

	public function update_outdoor_service_cart($value = '')
	{

		$row_id = $_POST["row_id"];

		$data = array(

			'rowid' => $row_id,
			'qty' => $_POST['qty'],
			'price' => $_POST['price']
		);
		$this->cart->update($data);

		$this->load->view('ipd/outdoor_service_cart');
	}

	public function insert_outdoor_service_data()
	{
		$data = array(
			'patient_name' => $this->input->post('patient_name'),
			'reg_id' => $this->input->post('reg_no'),
			// 'cabin_no' =>$this->input->post('b_cabin_no'),

			'total_amount' => $this->input->post('total_amount'),
			'mobile_no' => $this->input->post('mobile_no'),
			'total_paid' => $this->input->post('total_paid'),
			'total_discount' => $this->input->post('discount'),
			'total_vat' => $this->input->post('vat'),
			'net_total' => $this->input->post('net_total'),
			'created_at' => date('Y-m-d H:i:s'),
			'operator_id' => $this->session->userdata['logged_in']['id'],
			'operator_name' => $this->session->userdata['logged_in']['username']
		);

		$order_id = $this->load->admin_model->insert_ret('outdoor_service_order_info', $data);

		$d_data['old_due'] = $this->input->post('due');
		$d_data['order_id'] = $this->input->post('reg_no');
		$d_data['total_amount'] = $this->input->post('total_amount');
		$d_data['vat'] = $this->input->post('vat');
		$d_data['discount'] = $this->input->post('discount');
		$d_data['current_due'] = $this->input->post('due') - $this->input->post('total_paid');
		$d_data['paid_due'] = $this->input->post('total_paid');
		$d_data['created_at'] = date('Y-m-d H:i:s');
		$d_data['due_type'] = 3;
		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$this->load->admin_model->insert_ret('due_collection', $d_data);



		$cart = $this->cart->contents();

		foreach ($cart as $item) {
			$data = array(
				'service_id' => $item['id'],
				'order_id' => $order_id,

				'price' => $item['price'],
				'qty' => $item['qty'],
				'created_at' => date('Y-m-d H:i:s')
			);

			$this->load->admin_model->insert('outdoor_service_details', $data);
		}



		$this->cart->destroy();
		redirect('admin/outdoor_service_order_list', 'refresh');
	}

	public function outdoor_service_order_list($value = '')
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'Outdoor Service List Datewise';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['service_info'] = $this->admin_model->select_with_where2('*', 'service_status=1', 'service_info');


		// $data['outdoor_service_info']=$this->admin_model->select_join_where_order('*,os.id,os.created_at','outdoor_service_order_info os','room r','r.id=os.cabin_no','r.status=1','os.id','DESC');

		$data['outdoor_service_info'] = $this->admin_model->select_with_where2_decending('*', 'status=1', 'outdoor_service_order_info', 'id');

		$this->load->view('ipd/outdoor_service_order_list', $data);
	}


	public function outdoor_service_details($value = '')
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'Outdoor Service Details';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$order_id = $this->uri->segment(3);



		$data['outdoor_service_order_info'] = $this->admin_model->select_join_three_table2('*,os.id,os.created_at', 'outdoor_service_order_info os', 'outdoor_service_details o', 'service_info s', 'o.order_id=os.id', 's.id=o.service_id', 'os.id="' . $order_id . '"');

		$this->load->view('ipd/outdoor_service_details', $data);
	}

	public function update_outdoor_payment($value = '')
	{
		$data['active'] = 'ipd';
		$data['page_title'] = '';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$order_id = $this->uri->segment(3);


		$val1 = $this->admin_model->select_with_where2('*', 'id="' . $order_id . '"', 'outdoor_service_order_info');
		$total_paid = $val1[0]['total_paid'] + $this->input->post('update_payment_outdoor');


		$val = array(
			'total_paid' => $total_paid,
			'total_vat' => $val1[0]['total_vat'] + $this->input->post('vat'),
			'total_discount' => $val1[0]['total_discount'] + $this->input->post('discount')

			// 'net_total' =>$val1[0]['net_total']+$this->input->post('discount')
		);

		$this->load->admin_model->update_function('id', $order_id, 'outdoor_service_order_info', $val);
		$d_data['old_due'] = $this->input->post('due');
		$d_data['order_id'] = $val1[0]['reg_id'];
		$d_data['total_amount'] = $val1[0]['total_amount'];


		$d_data['vat'] = $this->input->post('vat');
		$d_data['discount'] = $this->input->post('discount');
		$d_data['current_due'] = $this->input->post('due') - $this->input->post('update_payment_outdoor');
		$d_data['paid_due'] = $this->input->post('update_payment_outdoor');
		$d_data['created_at'] = date('Y-m-d H:i:s');
		$d_data['due_type'] = 3;

		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$this->load->admin_model->insert_ret('due_collection', $d_data);



		redirect("admin/outdoor_service_details/" . $order_id, 'refresh');
	}


	public function outdoor_service_details_pdf($value = '')
	{

		$data['active'] = 'ipd';
		$data['page_title'] = '';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$order_id = $this->uri->segment(3);

		$data['outdoor_service_order_info'] = $this->admin_model->select_join_three_table2('*,os.id,os.created_at', 'outdoor_service_order_info os', 'outdoor_service_details o', 'service_info s', 'o.order_id=os.id', 's.id=o.service_id', 'os.id="' . $order_id . '"');

		$this->load->view('ipd/outdoor_service_details_pdf', $data);
	}

	// Ipd Diagnostic order list

	public function outdoor_his_details($value = '')
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'Outdoor History';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		$company_id = $this->input->post('company_id');

		$data['from_date'] = $this->input->post('start_date');
		$data['end_date'] = $this->input->post('end_date');
		$data['company_id'] = $this->input->post('company_id');
		$data['outdoor_service_history'] = $this->admin_model->select_with_where2('*', 'created_at between "' . $start_date . '" and "' . $end_date . '"', 'outdoor_service_order_info');

		$this->load->view('ipd/outdoor_his_details', $data);
	}

	public function add_ipd_patient_service()
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'Ipd Service';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$this->cart->destroy();

		$p_id = $this->uri->segment(3);

		$p_name = $this->admin_model->select_with_where2('*', 'id="' . $p_id . '"', 'ipd_patient_info');;

		if ($p_id != null) {
			$data['p_id'] = $p_id;
		} else {
			$data['p_id'] = 0;
		}

		if ($p_name != null) {
			$data['p_name'] = $p_name[0]['patient_name'];
		} else {
			$data['p_name'] = "";
		}


		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['service_info'] = $this->admin_model->select_with_where2('*', 'service_status=1', 'service_info');

		$data['ipd_all_patient'] = $this->admin_model->select_with_where2('*', 'type!=3', 'ipd_patient_info');


		$this->load->view('ipd/add_ipd_patient_service', $data);
	}

	public function get_all_ipd_info_by_patient_info_id()
	{
		$data = $this->admin_model->select_with_where2('*', 'patient_info_id="' . $_POST['p_info_id'] . '"', 'ipd_patient_info');
		echo json_encode($data);
	}


	public function add_service_cart($value = '')
	{


		$data = array(
			"id"  => $_POST["s_id"],
			"name"  => $_POST["s_name"],
			"qty"  => $_POST["quantity"],
			"price"  => $_POST["s_price"],
			'options' => array('s_doctor_name' => $_POST["s_doctor"], 's_doctor_id' => $_POST["s_doctor_val"])
		);

		$val = $this->cart->insert($data);


		$this->load->view('ipd/service_cart_details');
	}



	public function update_service_cart($value = '')
	{

		$row_id = $_POST["row_id"];

		$data = array(

			'rowid' => $row_id,
			'qty' => $_POST['qty'],
			'price' => $_POST['price']
		);
		$this->cart->update($data);

		$this->load->view('ipd/service_cart_details');
	}

	public function remove_service_cart()
	{
		$row_id = $_POST["row_id"];
		$data = array(
			'rowid' => $row_id,
			'qty' => 0
		);
		$this->cart->update($data);
		echo $this->load->view('ipd/service_cart_details');
	}


	public function edit_ipd_add_service_cart($value = '')
	{


		$data = array(
			"id"  => $_POST["s_id"],
			"name"  => $_POST["s_name"],
			"qty"  => $_POST["quantity"],
			"price"  => $_POST["s_price"],
			'options' => array('s_doctor_name' => $_POST["s_doctor"], 's_doctor_id' => $_POST["s_doctor_val"])
		);

		$val = $this->cart->insert($data);


		$this->load->view('ipd/edit_ipd_bill_cart');
	}

	public function edit_ipd_update_service_cart($value = '')
	{

		$row_id = $_POST["row_id"];

		$data = array(

			'rowid' => $row_id,
			'qty' => $_POST['qty'],
			'price' => $_POST['price']
		);
		$this->cart->update($data);

		$this->load->view('ipd/edit_ipd_bill_cart');
	}

	public function edit_ipd_remove_service_cart()
	{
		$row_id = $_POST["row_id"];
		$data = array(
			'rowid' => $row_id,
			'qty' => 0
		);
		$this->cart->update($data);
		echo $this->load->view('ipd/edit_ipd_bill_cart');
	}





	public function insert_service_data()
	{

		$cart = $this->cart->contents();

		foreach ($cart as $item) {
			$data = array(
				'service_id' => $item['id'],
				'p_id' => $this->input->post('patient_id'),

				'price' => $item['price'],
				'qty' => $item['qty'],
				'operated_id' => $item['options']['s_doctor_id'],
				'operated_name' => $item['options']['s_doctor_name'],
				'operator_name' => $this->session->userdata['logged_in']['username'],
				'operator_id' => $this->session->userdata['logged_in']['id'],
				'created_at' => date('Y-m-d H:i:s')
			);

			$id = $this->load->admin_model->insert_ret('service_details', $data);


			$data = array(

				'service_details_id' => $id,
				'old_cost'	=> $item['price'],
				'current_cost' => $item['price'],
				'discount_ref' => $this->input->post('discount_ref'),
				'operator_id' => $this->session->userdata['logged_in']['id'],
				'operator_name' => $this->session->userdata['logged_in']['username'],
				'created_at' => date('Y-m-d H:i:s')
			);

			$this->admin_model->insert('service_payment_details', $data);
		}



		$this->cart->destroy();

		redirect('admin/ipd_patient_unrelease_list', 'refresh');
	}

	public function ipd_service_details($value = '')
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD Service Details';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];

		$patient_id = $this->uri->segment(3);
		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $patient_id . '"', 'ipd_patient_info');

		$data['patient_timeline'] = $this->admin_model->select_join_where_order('*,p.created_at', 'patient_timeline p', 'room r', 'r.id=p.cabin_no', 'patient_id="' . $patient_id . '" AND r.status=1', 'p.id', 'ASC');

		$data['hospital_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND hospital_id="' . $data['hospital_id'] . '"', 'hospital');
		$data['service_info'] = $this->admin_model->select_join_where('*', 'service_info si', 'service_details sd', 'si.id=sd.service_id', 'sd.p_id="' . $patient_id . '"');
		$this->load->view('ipd/ipd_service_details', $data);
	}


	public function ipd_update_payment($value = '')
	{

		$data['active'] = 'ipd';
		$data['page_title'] = '';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$patient_id = $this->uri->segment(3);
		$flag = $this->uri->segment(4);

		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $patient_id . '"', 'ipd_patient_info');

		$data['ipd_final_bill_info'] = $this->admin_model->select_with_where2('*', 'p_id="' . $patient_id . '"', 'ipd_final_bill');
		$total_paid = $this->input->post('update_payment') + $data['ipd_final_bill_info'][0]['total_paid'];

		$total_paid_adm_fee = 0;

		if ($data['ipd_final_bill_info'][0]['admission_fee_paid'] < $data['ipd_final_bill_info'][0]['admission_fee'] && $data['ipd_final_bill_info'][0]['admission_fee'] <= $data['ipd_final_bill_info'][0]['admission_fee_paid'] + $this->input->post('update_payment')) {
			$total_paid_adm_fee = $data['ipd_final_bill_info'][0]['admission_fee'] - $data['ipd_final_bill_info'][0]['admission_fee_paid'];
		} else if ($data['ipd_final_bill_info'][0]['admission_fee_paid'] < $data['ipd_final_bill_info'][0]['admission_fee'] && $data['ipd_final_bill_info'][0]['admission_fee'] >= $data['ipd_final_bill_info'][0]['admission_fee_paid'] + $this->input->post('update_payment')) {
			$total_paid_adm_fee = $this->input->post('update_payment');
		}


		if ($total_paid + $this->input->post('discount') + $data['ipd_final_bill_info'][0]['total_discount'] >= $data['ipd_final_bill_info'][0]['total_amount'] + $this->input->post('vat') + $data['ipd_final_bill_info'][0]['total_vat']) {
			$val = array(
				'total_paid' => $total_paid,
				'total_vat' => $data['ipd_final_bill_info'][0]['total_vat'] + $this->input->post('vat'),
				'total_discount' => $data['ipd_final_bill_info'][0]['total_discount'] + $this->input->post('discount'),
				'admission_fee_paid' => $data['ipd_final_bill_info'][0]['admission_fee_paid'] + $total_paid_adm_fee,
				'payment_status' => 'paid'
			);
		} else {
			$val = array(
				'total_paid' => $total_paid,
				'total_vat' => $data['ipd_final_bill_info'][0]['total_vat'] + $this->input->post('vat'),
				'total_discount' => $data['ipd_final_bill_info'][0]['total_discount'] + $this->input->post('discount'),
				'admission_fee_paid' => $data['ipd_final_bill_info'][0]['admission_fee_paid'] + $total_paid_adm_fee
			);
		}

		$val['discount_ref'] = $data['ipd_final_bill_info'][0]['discount_ref'] == "" ? $_POST['discount_ref'] : $data['ipd_final_bill_info'][0]['discount_ref'] . ', ' . $_POST['discount_ref'];
		$val['updated_at'] = date('Y-m-d');

		// "<pre>"	;print_r($val);die();

		$this->load->admin_model->update_function('p_id', $patient_id, 'ipd_final_bill', $val);

		$d_data['is_due_collection'] = 0;

		if (date("Y-m-d", strtotime($data['ipd_final_bill_info'][0]['created_at'])) != date('Y-m-d')) {
			$d_data['is_due_collection'] = 1;
		}

		$d_data['old_due'] = $this->input->post('due');
		$d_data['order_id'] = $data['patient_info'][0]['patient_info_id'];
		$d_data['total_amount'] = $data["ipd_final_bill_info"][0]['total_amount'];
		$d_data['patient_id'] = $patient_id;
		$d_data['vat'] = $this->input->post('vat');
		$d_data['discount'] = $this->input->post('discount');
		$d_data['current_due'] = $this->input->post('due') - $this->input->post('update_payment');
		$d_data['paid_due'] = $this->input->post('update_payment');
		$d_data['admission_fee'] = $data['ipd_final_bill_info'][0]['admission_fee'];
		$d_data['admission_fee_paid'] = $total_paid_adm_fee;
		$d_data['created_at'] = date('Y-m-d H:i:s');
		$d_data['due_type'] = 2;
		$d_data['discount_ref'] = $_POST['discount_ref'];
		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];

		$this->load->admin_model->insert_ret('due_collection', $d_data);

		if ($flag == "ipd_due") {
			redirect('admin/indoor_due_collection');
		}
		if ($flag == "release") {
			redirect('admin/ipd_payment_details/' . $patient_id . '/release', 'refresh');
		} else {
			redirect('admin/ipd_payment_details/' . $patient_id, 'refresh');
		}
	}


	public function ipd_old_due_collection()
	{
		$order_type = $this->input->post('order_type');
		$order_id = $this->input->post('order_id');
		$patient_id = $this->input->post('patient_id');
		$patient_name = $this->input->post('patient_name');
		$total_amnt = $this->input->post('total_amnt');
		$total_paid = $this->input->post('total_paid');
		$due = $this->input->post('due');
		$discount = $this->input->post('discount');
		$gross_paid = $this->input->post('gross_paid');
		$discount_ref = $this->input->post('discount_ref');

		$due_data = array(
			'service_type' => $order_type,
			'service_id' => $order_id,
			'patient_id' => $patient_id,
			'patient_info_id' => $this->input->post('patient_info_id'),
			'total_amnt' => $total_amnt,
			'total_due' => $gross_paid,
			'total_paid' => $total_paid,
			'recv_by' => $this->input->post('user_id'),
			'add_date' => date('Y-m-d H:i:s')
		);

		$this->load->admin_model->insert_ret('ipd_patient_due_history', $due_data);

		if ($order_type == 1) {
			$data['service_de'] = $this->admin_model->select_with_where2('*', 'opid="' . $order_id . '"', 'operation_patient_list');
			$data['advance'] = $data['service_de'][0]['advance'];
			$data['due'] = $data['service_de'][0]['due'];
			$udata['due'] = $data['due'] - $gross_paid;
			$udata['advance'] = $data['advance'] + $total_paid;
			$this->admin_model->update_function('opid', $order_id, 'operation_patient_list', $udata);

			redirect('admin/add_ipd_patient_operation', 'refresh');
		} elseif ($order_type == 2) {
			$data['service_de'] = $this->admin_model->select_with_where2('*', 'sid="' . $order_id . '"', 'service_patient_list');
			$data['advance'] = $data['service_de'][0]['advance'];
			$data['due'] = $data['service_de'][0]['due'];
			$udata['due'] = $data['due'] - $gross_paid;
			$udata['advance'] = $data['advance'] + $total_paid;

			$this->admin_model->update_function('sid', $order_id, 'service_patient_list', $udata);
			redirect('admin/add_ipd_patient_service', 'refresh');
		}
	}

	public function ipd_summary_day_wise()
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'Manage IPD Collection';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$this->load->view('ipd/ipd_summary_day_wise', $data);
	}


	public function ipd_summary_day_wise_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');


		redirect('admin/ipd_summary_day_wise_report_next/' . $start_date . '/' . $end_date);
	}

	public function ipd_summary_day_wise_report_next($start_date, $end_date)
	{

		$data["ipd_collection_info"] = $this->admin_model->select_join_where('*', 'ipd_patient_info ip', 'ipd_final_bill if', 'ip.id=if.p_id', 'date(if.created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('ipd/ipd_summary_day_wise_report', $data);
	}



	public function ipd_collection_service_wise()
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'Manage IPD Collection';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		if ($data['admin_type'] == 3) {
			$data['username'] = $this->session->userdata['logged_in']['username'];
			$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];
			$id = $data['hospital_id'];
			$data['hospital'] = $this->admin_model->select_with_where2('*', 'hospital_id="' . $id . '"', 'hospital');
			$data['hospital_ttile'] = $data['hospital'][0]['hospital_title'];
		} else {

			$data['username'] = $this->session->userdata['logged_in']['username'];
			$data['hospital_id'] = "";
			$id = "";
			$data['hospital'] = "";
			$data['hospital_ttile'] = "Admin";
		}



		$data['service_info'] = $this->admin_model->select_with_where2('*', 'service_status=1', 'service_info');
		$this->load->view('ipd/ipd_collection_service_wise', $data);
	}



	public function ipd_collection_service_wise_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$service_id = $this->input->post('service_id');




		redirect('admin/ipd_collection_service_wise_report_next/' . $start_date . '/' . $end_date . '/' . $service_id);
	}

	public function ipd_collection_service_wise_report_next($start_date, $end_date, $service_id)
	{

		if ($service_id == "all") {
			$data['total_service'] = $this->admin_model->get_charge_sum_where_group_by_join('*', 'qty', 'service_details sd', ' sd.created_at between "' . $start_date . '" and "' . $end_date . '"', 'si.id', 'service_info si', 'si.id=sd.service_id');
		} else {
			$data['total_service'] = $this->admin_model->get_charge_sum_where_group_by_join('*', 'qty', 'service_details sd', ' sd.created_at between "' . $start_date . '" and "' . $end_date . '" AND si.id="' . $service_id . '"', 'si.id', 'service_info si', 'si.id=sd.service_id');
		}



		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('ipd/ipd_collection_service_wise_report', $data);
	}


	public function ipd_service_wise_patient()
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'Manage IPD Collection';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		if ($data['admin_type'] == 3) {
			$data['username'] = $this->session->userdata['logged_in']['username'];
			$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];
			$id = $data['hospital_id'];
			$data['hospital'] = $this->admin_model->select_with_where2('*', 'hospital_id="' . $id . '"', 'hospital');
			$data['hospital_ttile'] = $data['hospital'][0]['hospital_title'];
		} else {

			$data['username'] = $this->session->userdata['logged_in']['username'];
			$data['hospital_id'] = "";
			$id = "";
			$data['hospital'] = "";
			$data['hospital_ttile'] = "Admin";
		}



		$data['service_info'] = $this->admin_model->select_with_where2('*', 'service_status=1', 'service_info');
		$this->load->view('ipd/ipd_service_wise_patient', $data);
	}



	public function ipd_service_wise_patient_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$service_id = $this->input->post('service_id');




		redirect('admin/ipd_service_wise_patient_report_next/' . $start_date . '/' . $end_date . '/' . $service_id);
	}

	public function ipd_service_wise_patient_report_next($start_date, $end_date, $service_id)
	{

		if ($service_id == "all") {
			$data['total_service'] = $this->admin_model->get_charge_sum_where_group_by_two_join('*', 'qty', 'service_details sd', ' sd.created_at between "' . $start_date . '" and "' . $end_date . '"', 'si.id', 'service_info si', 'si.id=sd.service_id', 'ipd_patient_info i', 'i.id=sd.p_id');
		} else {
			$data['total_service'] = $this->admin_model->get_charge_sum_where_group_by_two_join('*', 'qty', 'service_details sd', ' sd.created_at between "' . $start_date . '" and "' . $end_date . '" AND si.id="' . $service_id . '"', 'si.id', 'service_info si', 'si.id=sd.service_id', 'ipd_patient_info i', 'i.id=sd.p_id');
		}



		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('ipd/ipd_service_wise_patient_report', $data);
	}





	public function ipd_operation_operation_daywise()
	{

		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$operation_title = $this->input->post('operation_title');
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['ipd_operation_collection'] = $this->admin_model->select_daywise_ipd_operation_report($start_date, $end_date, $operation_title);

		$this->load->view('ipd/ipd_patient_op_coll_daywise_view', $data, FALSE);
	}
	public function ipd_operation_service_daywise()
	{

		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$service_title = $this->input->post('service_title');
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['ipd_operation_collection'] = $this->admin_model->select_daywise_ipd_service_report($start_date, $end_date, $service_title);

		$this->load->view('ipd/ipd_patient_ser_daywise_col_view', $data, FALSE);
	}


	public function indoor_due_collection($value = '')
	{
		$data['active'] = 'opd';
		$data['page_title'] = 'outdoor due collection';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['all_ipd_patient_id'] = $this->admin_model->select_join_where('*', 'ipd_patient_info i', 'ipd_final_bill b', 'i.id=b.p_id', 'type =3  and i.status=1 AND b.payment_status="unpaid"');

		$this->load->view('ipd/ipd_due_collection', $data);
	}


	public function ipd_get_patient_bill_info_by_patient_id($value = '')
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD Payment Details';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];

		$patient_id = $_POST['p_id'];


		$data['patient_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $patient_id . '"', 'ipd_patient_info');

		$data['patient_timeline'] = $this->admin_model->select_join_where_order('*,p.created_at', 'patient_timeline p', 'room r', 'r.id=p.cabin_no', 'patient_id="' . $patient_id . '" AND r.status=1 ', 'p.id', 'ASC');

		$data['hospital_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND hospital_id="' . $data['hospital_id'] . '"', 'hospital');


		$data['total_bill_info'] = $this->admin_model->select_with_where2('*', 'p_id="' . $patient_id . '"', 'ipd_final_bill');

		$data['service_info'] = $this->admin_model->select_join_where('*', 'service_info si', 'service_details sd', 'si.id=sd.service_id', 'sd.p_id="' . $patient_id . '"');

		$this->load->view('ipd/get_ipd_patient_info_ajax', $data);
	}



	public function date_wise_indoor_collection($value = '')
	{
		$data['active'] = 'ipd';
		$data['page_title'] = 'IPD Payment Details';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data["patient_test_order_info"] = $this->admin_model->get_four_charge_sum_where_group_by_join_two('*,due_collection.created_at,ipd_final_bill.total_amount', 'paid_due', 'discount', 'due_collection.admission_fee_paid', 'due_collection.advance_payment', 'due_collection.patient_id', 'ipd_patient_info', 'due_collection', 'ipd_patient_info.id=due_collection.patient_id', 'ipd_final_bill', 'ipd_final_bill.p_id=ipd_patient_info.id', ' due_collection.status=1 and date(due_collection.created_at)="' . date('Y-m-d') . '" AND due_collection.due_type in(2,3)');

		$this->load->view('ipd/ipd_collection', $data);
	}


	public function date_wise_indoor_collection_report($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		redirect('admin/date_wise_indoor_collection_report_next/' . $start_date . '/' . $end_date);
	}

	public function date_wise_indoor_collection_report_next($start_date, $end_date)
	{
		$data["patient_test_order_info"] = $this->admin_model->get_three_charge_sum_where_group_by_join_two('*,due_collection.created_at,ipd_final_bill.total_amount', 'paid_due', 'discount', 'due_collection.admission_fee_paid', 'due_collection.patient_id', 'ipd_patient_info', 'due_collection', 'ipd_patient_info.id=due_collection.patient_id', 'ipd_final_bill', 'ipd_final_bill.p_id=ipd_patient_info.id', 'date(due_collection.created_at) between "' . $start_date . '" and "' . $end_date . '" AND due_collection.status=1 and due_collection.due_type in(2,3)');



		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('ipd/ipd_datewise_collection', $data);
	}





	public function cabin_transfer()

	{
		$data['active'] = 'cabin_transfer';
		$data['page_title'] = 'Cabin Transfer Details';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div>', '</div>');																																																								// Validating Name Field
		$this->form_validation->set_rules('cabin_transfer_phone_no', 'Phone No', 'required');
		$this->form_validation->set_rules('update_cabin_no', ' New Cabin No', 'required');
		$data['room'] = $this->admin_model->select_with_where2('*', 'status=1', 'room');

		$data['cabin_available_info'] = $this->admin_model->select_with_where2('*', 'type != 3', 'ipd_patient_info');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('ipd/cabin_transfer', $data);
		} else {
			$id = $this->input->post('hidden_ipd_id');
			$val = array(
				'cabin_no' => $this->input->post('update_cabin_no'),
				'type' => 2,
				'cabin_no' => $this->input->post('update_cabin_no')
			);
			$this->admin_model->update_function('id', $id, 'ipd_patient_info', $val);

			$val = array(
				'cabin_no' => $this->input->post('update_cabin_no'),
				'patient_id' => $id,
				'type' => 2,
				'created_at' => date('Y-m-d H:i:s')

			);

			$this->admin_model->insert('patient_timeline', $val);

			$room_info = array(
				'is_busy' => 1,
				'p_id' => $patient_id
			);
			$this->admin_model->update_function('id', $this->input->post('update_cabin_no'), 'room', $room_info);

			$old_room_info = array(
				'is_busy' => 0,
				'p_id' => 0
			);
			$this->admin_model->update_function('id', $this->input->post('cabin_no'), 'room', $old_room_info);
			redirect('admin/cabin_transfer', 'refresh');
		}
	}


	public function get_all_phone_no_ipd()
	{
		$data = $this->admin_model->select_with_where('mobile_no', 1, 'ipd_patient_info', 'status'); 																																																								//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function get_all_patient_code_ipd()
	{
		$data = $this->admin_model->select_with_where('patient_info_id', 1, 'ipd_patient_info', 'status'); 																																																									//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function get_all_info_by_mobile_no_ipd()
	{
		$data = $this->admin_model->select_with_where_condition_two('*', 1, 'ipd_patient_info', 'status', $this->input->post('patient_mobile_no'), 'mobile_no'); 																																																										//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function get_all_info_by_patient_code_ipd()
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1 AND patient_info_id="' . $this->input->post('patient_info_id') . '"', 'ipd_patient_info'); 																																																											//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function get_all_info_by_unrelease_patient_id_ipd()
	{
		$data = $this->admin_model->select_with_where2('*', 'type != 3 AND status=1', 'ipd_patient_info'); 																																																											//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}


	public function get_all_room_info_by_cabin_room_id()
	{
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$update_cabin_no_id = $this->input->post('update_cabin_no_id');
		$data = $this->admin_model->select_join_three_table('*', 'room r', 'cabin_class c', 'cabin_sub_class cs', 'r.cabin_class_id=c.id', 'r.cabin_sub_class_id=cs.id', 'r.id', $update_cabin_no_id, 'r.status', 1);
		echo json_encode($data);
	}

	//*************** Pharmacy Module Starts *******************/


	public function sales_return_report($value = '')
	{
		$data['active'] = 'sales_return_report';
		$data['page_title'] = 'Sales Return Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$this->load->view('pharmacy/sales_return_report', $data);
	}

	public function daywise_sales_return_report()
	{

		$start_date = $_GET['start_date'];
		$end_date = $_GET['end_date'];
		$data['all_sell_product_list'] = $this->admin_model->select_join_three_table2('*,s.created_at', 'sell s', 'customer c', 'return_product r', 's.cust_id=c.id', 's.sell_id=r.sell_buy_id', 'date(r.created_at) between "' . $start_date . '" and "' . $end_date . '" and r.status=1');

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('pharmacy/daywise_sales_return_report', $data);
	}


	public function purchase_return_report($value = '')
	{
		$data['active'] = 'purchase_return_report';
		$data['page_title'] = 'Purchase Return Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$this->load->view('pharmacy/purchase_return_report', $data);
	}

	public function daywise_purchase_return_report()
	{
		$data['all_purchased_product_list'] = $this->admin_model->select_three_join_where_left_order_four_sum('r.total_paid', 'r.total_amount', 'r.charge', 'rd.ret_qty', '*,buy.created_at', 'buy', 'return_product r', 'buy.buy_code=r.buy_sell_code', 'return_product_det rd', 'r.id=rd.ret_id', 'date(buy.created_at) between "' . $_GET['start_date'] . '" and "' . $_GET['end_date'] . '" and  r.type=1 and r.status=1', 'r.created_at', 'DESC', 'r.buy_sell_code');

		// "<pre>";print_r($data['all_purchased_product_list']);die();

		$data['from_date'] = $_GET['start_date'];
		$data['end_date'] = $_GET['end_date'];

		$this->load->view('pharmacy/daywise_purchase_return_report', $data);
	}

	public function daywise_expired_date($value = '')
	{
		$data['active'] = 'daywise_expired_date';
		$data['page_title'] = 'Expire Date Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['product_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'product');

		$this->load->view('pharmacy/daywise_expired_date', $data);
	}

	public function daywise_expired_date_report($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$p_id = $this->input->post('p_name');

		redirect('admin/daywise_expired_date_report_next/' . $start_date . '/' . $end_date . '/' . $p_id);
	}

	public function daywise_expired_date_report_next($start_date = '', $end_date = '', $p_id = '')
	{
		$start_date = $start_date;
		$end_date = $end_date;

		if ($p_id == "all") {
			$data['product_list'] = $this->admin_model->select_three_join_where_group_by_one_left_sum('*,product.id,buy_details.created_at', 'buy_details.current_stock', 'product', 'unit_info', 'unit_info.id=product.p_unit_id', 'buy_details', 'product.id=buy_details.p_id', 'date(buy_details.expire_date) between "' . $start_date . '" and "' . $end_date . '" and product.status=1 and buy_details.current_stock > 0', 'buy_details.p_id,buy_details.expire_date,');
		} else {
			$data['product_list'] = $this->admin_model->select_three_join_where_group_by_one_left_sum('*,product.id,buy_details.created_at', 'buy_details.current_stock', 'product', 'unit_info', 'unit_info.id=product.p_unit_id', 'buy_details', 'product.id=buy_details.p_id', 'date(buy_details.expire_date) between "' . $start_date . '" and "' . $end_date . '" and product.id="' . $p_id . '" and product.status=1 and buy_details.current_stock > 0', 'buy_details.p_id,buy_details.expire_date,');
		}

		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('pharmacy/daywise_expired_date_report', $data);
	}


	public function make_an_order($value = '')
	{
		$data['active'] = 'make_an_order';
		$data['page_title'] = 'Make Order';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$this->cart->destroy();


		$data['product_list'] = $this->admin_model->select_three_join_where('*,p.id', 'product p', 'unit_info u', 'u.id=p.p_unit_id', 'company c', 'c.id=p.p_company_id', 'p.status=1');
		$data['supplier_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'supplier');

		$this->load->view('pharmacy/make_an_order', $data);
	}

	public function make_an_order_post($value = '')
	{
		$order_id = 'order-phar-000001';
		$get_last_order_code = $this->admin_model->get_last_row_no_where('make_order_pharmacy', 'id');

		if (count($get_last_order_code) > 0) {
			$order_id = $get_last_order_code[0]['order_id'];
			$order_id_explode = explode('-', $order_id);
			$order_id_int = $order_id_explode[2];
			$order_id_number = str_pad(($order_id_int + 1), 6, "0", STR_PAD_LEFT);
			$order_id = $order_id_explode[0] . '-' . $order_id_explode[1] . '-' . $order_id_number;
		}

		$supp_name = explode('#', $this->input->post('supp_id'));

		// "<pre>";print_r($supp_name);die();

		$s_name = $supp_name[1];
		$s_id = $supp_name[0];

		$cart = $this->cart->contents();

		foreach ($cart as $key => $value) {


			$sd_data['order_id'] = $order_id;
			$sd_data['p_id'] = $value['id'];
			$sd_data['p_name'] = $value['name'];
			$sd_data['qty'] = $value['qty'];
			$sd_data['unit'] = $value['options']['unit'];
			$sd_data['unit_id'] = $value['options']['unit_id'];
			$sd_data['comp_id'] = $value['options']['comp_id'];
			$sd_data['comp_name'] = $value['options']['comp_name'];
			$sd_data['supp_name'] = $s_name;
			$sd_data['supp_id'] = $s_id;
			$sd_data['operator_id'] = $this->session->userdata['logged_in']['id'];
			$sd_data['operator_name'] = $this->session->userdata['logged_in']['username'];

			$sd_data['status'] = 1;
			$sd_data['created_at'] = date('Y-m-d H:i:s');

			$id = $this->admin_model->insert_ret('make_order_pharmacy', $sd_data);
		}

		$order_id = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $id . '"', 'make_order_pharmacy');


		$data['order_info'] = $this->admin_model->select_with_where2('*', 'status=1 and order_id="' . $order_id[0]['order_id'] . '"', 'make_order_pharmacy');
		$this->load->view('pharmacy/order_phar_pdf', $data);
	}


	public function make_an_order_list($value = '')
	{
		$data['active'] = 'make_an_order';
		$data['page_title'] = 'Make Order';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['order_list'] = $this->admin_model->select_join_where_group_by('*', 'make_order_pharmacy m', 'supplier s', 's.id=m.supp_id', 's.status=1 and m.status=1 and date(m.created_at)="' . date('Y-m-d') . '"', 'order_id');

		$this->load->view('pharmacy/day_wise_order_pharmacy', $data);
	}

	public function order_conf($order_id, $value = '')
	{

		if ($value == "yes") {
			$data['is_order_conf'] = 1;
		} else {
			$data['is_order_conf'] = 0;
		}
		$this->admin_model->update_function2('order_id="' . $order_id . '"', 'make_order_pharmacy', $data);

		redirect('admin/make_an_order_list', "refresh");
	}

	public function make_an_order_report($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		redirect('admin/make_an_order_report_next/' . $start_date . '/' . $end_date);
	}

	public function make_an_order_report_next($start_date = '', $end_date = '')
	{
		$start_date = $start_date;
		$end_date = $end_date;

		$data['order_list'] = $this->admin_model->select_join_where_group_by('*', 'make_order_pharmacy m', 'supplier s', 's.id=m.supp_id', 'm.status=1 and date(m.created_at) between "' . $start_date . '" and "' . $end_date . '"', 'order_id');

		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('pharmacy/day_wise_order_pharmacy_report', $data);
	}

	public function order_phar_pdf($order_id = '')
	{
		$data['order_info'] = $this->admin_model->select_with_where2('*', 'status=1 and order_id="' . $order_id . '"', 'make_order_pharmacy');

		$this->load->view('pharmacy/order_phar_pdf', $data);
	}


	public function dlt_order($order_id = '')
	{
		$data['status'] = 2;
		$this->admin_model->update_function2('order_id="' . $order_id . '"', 'make_order_pharmacy', $data);

		redirect("admin/make_an_order_list", "refresh");
	}

	public function date_wise_balance_sheet_phar()
	{
		redirect('admin/date_wise_balance_sheet/phar');
	}

	public function get_last_pharmacy_bill_no($value = '')
	{
		$data = $this->admin_model->get_last_row3('buy_id', 'buy', 'status=1');
		echo json_encode($data);
	}


	public function billing_details_for_one_customer($cust_id = '', $type = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Add customer';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['sell_info'] = $this->admin_model->select_with_where2('*', 'status=1 and cust_id= "' . $cust_id . '"', 'sell');


		$data['sell_info_sum'] = $this->admin_model->select_with_where_two_sum('*', 'debit', 'net_total', 'status=1 and cust_id= "' . $cust_id . '"', 'sell');

		// "<pre>";print_r($data['sell_info']);die();

		$data['sell_details'] = $this->admin_model->select_join_five_table2('*,s.created_at,d.created_at as c_date,s.sell_id,c.p_id', 'sell s', 'customer c', 'sell_details d', 'product p', 'unit_info u', 's.cust_id=c.id', 's.sell_id=d.sell_id', 'p.id=d.p_id', 'u.id=p.p_unit_id', 'c.id="' . $cust_id . '" and c.type="' . $type . '"');

		// "<pre>";print_r($data['sell_details']);die();

		if ($data['sell_details'] != null) {
			$data['opd_info'] = $this->admin_model->select_with_where2('*', 'status=1 and id= "' . $data['sell_details'][0]['p_id'] . '"', 'opd_patient_info');

			$data['ipd_info'] = $this->admin_model->select_join_where('*', 'ipd_patient_info i', 'room r', 'r.id=i.cabin_no', 'i.status=1 and  i.id="' . $data['sell_details'][0]['p_id'] . '"');


			$data['return_info'] = $this->admin_model->select_join_five_table2_group_by('*', 'return_product r', 'return_product_det d', 'sell_details s', 'product p', 'unit_info u', 'r.id=d.ret_id', 's.sell_code=r.buy_sell_code', 'p.id=s.p_id', 'u.id=p.p_unit_id', 'r.status=1 and r.type=2', 'p.id');

			// "<pre>";print_r($data['ipd_info']);die();

			$data['total_charge'] = $this->admin_model->get_charge_sum_where('charge', 'return_product', 'buy_sell_code="' . $data['sell_details'][0]['sell_code'] . '" and type=2');

			$data['total_ret_paid'] = $this->admin_model->get_charge_sum_where('total_paid', 'return_product', 'buy_sell_code="' . $data['sell_details'][0]['sell_code'] . '" and type=2');
		} else {
			$data['return_info'] = null;
		}




		$this->load->view('pharmacy/billing_details_for_one_customer', $data);
	}


	public function add_customer($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Add customer';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div>', '</div>');
		$this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
		$data['director_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'director');


		if ($this->form_validation->run() == FALSE) {

			$this->load->view('pharmacy/add_customer', $data);
		} else {
			$cust_gen_id = 1;

			$cust_info = $this->admin_model->get_last_row2('customer', 'status=1');

			if ($cust_info != null) {
				$cust_gen_id = $cust_info[0]['cust_gen_id'] + 1;
			}


			$dir = explode("#", $this->input->post('ref_dir_id'));

			if ($this->input->post('hidden_field') == 1) {
				$type_in_word = "opd";
			} else if ($this->input->post('hidden_field') == 2) {
				$type_in_word = "ipd";
			} else {
				$type_in_word = "others";
			}

			$val = array(
				'cust_phone' => $this->input->post('customer_phone'),
				'cust_name' => $this->input->post('customer_name'),
				'cust_gen_id' => $cust_gen_id,
				'cust_address' => $this->input->post('customer_address'),
				'ref_dir_id' => $dir[0],
				'ref_dir_name' => $dir[1],
				// 'p_id'=>$this->input->post('patient_id'),
				'type' => $this->input->post('hidden_field'),
				'type_in_word' => $type_in_word,
				'created_at' => date('Y-m-d H:i:s')

			);



			$this->admin_model->insert('customer', $val);

			// $data['customer']=$this->admin_model->select_with_where2('*','status=1','customer');

			$this->load->view('pharmacy/add_customer', $data);
		}
	}


	public function add_customer_dt($value = '')
	{

		$select_column = "*,id";
		$order_column = array('id', 'cust_name', 'cust_phone', 'cust_address', 'ref_dir_name');
		$search_column = array('id', 'cust_name', 'cust_phone', 'cust_address', 'ref_dir_name', 'type', 'type_in_word');

		$condition = 'status=1';

		$fetch_data = $this->admin_model->make_datatables('customer', $condition, $select_column, $order_column, $search_column, 'id');
		$data = array();

		$i = $_POST['start'];

		$type = "";
		$opd_ipd_id = "";


		foreach ($fetch_data as $key => $row) {

			if ($row->type == 1) {
				$type = "Opd";
				// $opd_id=$this->admin_model->select_with_where2('*','status=1','opd_patient_info');
				// $opd_ipd_id=$opd_id[0]['patient_info_id'];
			} else if ($row->type == 2) {
				$type = "Ipd";

				// $ipd_id=$this->admin_model->select_with_where2('*','status=1','ipd_patient_info');
				// $opd_ipd_id=$opd_id[0]['patient_info_id'];
			} else {
				$type = "Others";
				// $opd_ipd_id="None";
			}


			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = '<span class="badge badge-secondary">' . $row->cust_gen_id . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->cust_name . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->cust_phone . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->cust_address . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->ref_dir_name . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $type . '</span>';
			// $sub_array[] = '<span class="badge badge-secondary">'.$opd_ipd_id.'</span>';  
			$sub_array[] = '<a target="_blank" class="btn-sm btn-primary" href="admin/billing_details_for_one_customer/' . $row->id . '/' . $row->type . '">Details</a>';

			$sub_array[] = '<button type="button" id="customer_edit_' . $row->id . '" class="btn btn-success btn-xs customer_edit_button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>

	 		<button type="button" id="customer_delete_' . $row->id . '" class="btn btn-danger btn-xs customer_delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
			$data[] = $sub_array;
			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data('*', 'customer', $condition),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data(
				'customer',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	public function add_supplier($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Add supplier';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		if ($data['admin_type'] == 3) {
			$data['username'] = $this->session->userdata['logged_in']['username'];
			$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];
			$id = $data['hospital_id'];
			$data['hospital'] = $this->admin_model->select_with_where2('*', 'hospital_id="' . $id . '"', 'hospital');
			$data['hospital_ttile'] = $data['hospital']['0']['hospital_title'];
		} else {
			$data['username'] = $this->session->userdata['logged_in']['username'];
			$data['hospital_id'] = "";
			$id = "";
			$data['hospital'] = "";
			$data['hospital_ttile'] = "Admin";
		}

		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div>', '</div>');
		// Validating Name Field
		$this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');

		$data['supplier'] = $this->admin_model->select_with_where2('*', 'status=1', 'supplier');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('pharmacy/add_supplier', $data);
		} else {

			$val = array(
				'supp_phone' => $this->input->post('supplier_phone'),
				'supp_name' => $this->input->post('supplier_name'),
				'supp_address' => $this->input->post('supplier_address'),
				'created_at' => date('Y-m-d H:i:s')

			);

			$this->admin_model->insert('supplier', $val);

			// $data['supplier']=$this->admin_model->select_with_where2('*','status=1','supplier');
			$this->load->view('pharmacy/add_supplier', $data);
		}
	}

	public function add_supplier_dt($value = '')
	{
		$select_column = "*,id";
		$order_column = array('id', 'supp_name', 'supp_phone', 'supp_address', 'ref_dir_name');
		$search_column = array('id', 'supp_name', 'supp_phone', 'supp_address');

		$condition = 'status=1';

		$fetch_data = $this->admin_model->make_datatables('supplier', $condition, $select_column, $order_column, $search_column, 'id');
		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = '<span class="badge badge-secondary">' . $row->supp_name . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->supp_phone . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->supp_address . '</span>';

			$sub_array[] = '<button type="button" id="supplier_edit_' . $row->id . '" class="btn btn-success btn-xs up_supplier_edit_button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>

	 		<button type="button" id="supplier_delete_' . $row->id . '" class="btn btn-danger btn-xs up_supplier_delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
			$data[] = $sub_array;
			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data('*', 'supplier', $condition),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data(
				'supplier',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	public function insert_new_supplier($value = '')
	{
		$val = array(
			'supp_phone' => $this->input->post('supp_phone'),
			'supp_name' => $this->input->post('supp_name'),
			'supp_address' => $this->input->post('supp_address'),
			'created_at' => date('Y-m-d H:i:s')

		);

		$this->admin_model->insert('supplier', $val);
	}

	public function insert_new_customer($value = '')
	{
		$val = array(
			'cust_phone' => $this->input->post('cust_phone'),
			'cust_name' => $this->input->post('cust_name'),
			'cust_address' => $this->input->post('cust_address'),
			'created_at' => date('Y-m-d H:i:s')

		);


		$this->admin_model->insert('customer', $val);

		$customer_list = $this->admin_model->select_with_where2('*', 'status=1', 'customer');

		$output = "";
		$output .= '<label for="customer_name">Customer Name:</label>
	 	<select id="customer_name" required="" name="cust_id" class="custom-select select2 form-control">
	 	<option value="0"></option>';
		foreach ($customer_list as $row) {
			$output .= '<option value="' . $row['id'] . '">' . $row['cust_name'] . '</option>';
		}

		$output .= '<option value="new_cust">Add New Customer</option>
	 	</select> ';

		echo $output;
	}

	public function product_list($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Product List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		// $data['product']=$this->admin_model->select_join_three_table2('*,p.id','company c','product p','unit_info u','c.id=p.p_company_id','u.id=p_unit_id','p.status=1');	

		$this->load->view('pharmacy/product_list', $data);
	}


	public function product_list_dt($value = '')
	{

		$select_column = '*,p.id';
		$order_column = array('p.id', 'p_code', 'p_name', 'comp_name', 'p_buy_price', 'p_current_stock', 'unit');

		$search_column = array('p.id', 'p_code', 'p_name', 'comp_name', 'p_buy_price', 'p_current_stock', 'unit');


		$condition = "p.status=1";

		$fetch_data = $this->admin_model->make_datatables_three_table_join('company c', $condition, $select_column, $order_column, $search_column, 'product p', 'c.id=p.p_company_id', 'unit_info u', 'u.id=p_unit_id', 'p.id');


		$data = array();

		$i = $_POST['start'];


		$medicine = "";

		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = '<span>' . $row->p_code . '</span>';
			$sub_array[] = '<span>' . $row->p_name . '</span>';
			$sub_array[] = '<span>' . $row->comp_name . '</span>';
			$sub_array[] = '<img style="border:2px solid black; height: 100px; width: 100px; max-width: none !important;" src="uploads/product_image/' . $row->p_img . '">';
			$sub_array[] = '<span>' . $row->p_buy_price . '</span>';
			$sub_array[] = '<span>' . $row->unit . '</span>';



			// $stock="";

			// if($row->p_current_stock > $row->p_reorder_qty)
			// {
			// 	$stock='<div class="badge badge-success">
			// 	'.$row->p_current_stock.'&nbsp;
			// 	<i class="ace-icon fa fa-arrow-up"></i>
			// 	</div>';
			// }
			// else
			// {
			// 	$stock='<div  class="badge badge-danger">
			// 	'.$row->p_current_stock.'&nbsp;
			// 	<i class="ace-icon fa fa-arrow-down"></i>
			// 	</div>';
			// }

			// $sub_array[] =$stock; 

			$sub_array[] = '<a href="admin/edit_product/' . $row->id . '" type="button" class="btn btn-success btn-xs supplier_edit_button">View/Edit</a>';

			$sub_array[] = '<button type="button" id="' . $row->id . '"class="btn btn-danger btn-xs product_delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';



			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_three_table_join('company c', $condition, $select_column, 'product p', 'c.id=p.p_company_id', 'unit_info u', 'u.id=p_unit_id'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_three_table_join(
				'company c',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'product p',
				'c.id=p.p_company_id',
				'unit_info u',
				'u.id=p_unit_id',
				'p.id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	public function add_product($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Add product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['all_unit'] = $this->admin_model->select_with_where2('*', 'status=1', 'unit_info');
		$data['all_generic_name'] = $this->admin_model->select_with_where2('*', 'status=1', 'generic_info');
		$data['all_product_category'] = $this->admin_model->select_with_where2('*', 'status=1', 'product_category');
		$data['all_company_name'] = $this->admin_model->select_with_where2('*', 'status=1', 'company');

		$data["rack_all_info"] = $this->admin_model->select_with_where2('*', 'status=1', 'rack');


		$this->form_validation->set_error_delimiters('<div>', '</div>');

		$this->form_validation->set_rules('p_name', 'Product Name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('pharmacy/add_product', $data);
		} else {

			$product_image = "default.jpg";

			$p_code = '000001';
			$get_last_product_code = $this->admin_model->get_last_product_code();


			if (count($get_last_product_code) > 0) {
				$p_code = (int)$get_last_product_code[0]['p_code'];
				$p_code = sprintf("%'.06d", ($p_code + 1));
			}

			$val = array(
				'p_code' => $p_code,
				'p_img' => $product_image,
				'p_name' => $this->input->post('p_name'),
				'p_unit_id' => $this->input->post('p_unit'),
				'p_generic_id' => $this->input->post('p_generic_name'),

				'rack_id' => $this->input->post('rack_id'),
				'tax' => $this->input->post('tax'),
				'vat' => $this->input->post('vat'),
				'p_buy_price' => $this->input->post('p_buy_price'),
				'p_sell_price' => $this->input->post('p_sell_price'),
				'p_cat_id' => $this->input->post('p_category'),
				'p_reorder_qty' => $this->input->post('p_alert_qty'),
				'p_company_id' => $this->input->post('company_name'),
				'created_at' => date('Y-m-d H:i:s')

			);

			$img_id = $this->admin_model->insert_ret('product', $val);

			if ($_FILES['p_img']['name']) {
				$name_generator = $this->name_generator($_FILES['p_img']['name'], $img_id);
				$i_ext = explode('.', $_FILES['p_img']['name']);
				$target_path = $name_generator . '.' . end($i_ext);;
				$size = getimagesize($_FILES['p_img']['tmp_name']);

				if (move_uploaded_file($_FILES['p_img']['tmp_name'], 'uploads/product_image/' . $target_path)) {
					$product_image = $target_path;
				}

				$data_logo['p_img'] = $product_image;
				$this->admin_model->update_function('id', $img_id, 'product', $data_logo);
			};
			redirect("admin/product_list");
		}
	}

	public function edit_product($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Add supplier';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$product_id = $this->uri->segment(3);

		$data['all_product_info'] = $this->admin_model->select_with_where2('*', 'id="' . $product_id . '" AND status=1', 'product');

		$data['all_unit'] = $this->admin_model->select_with_where2('*', 'status=1', 'unit_info');
		$data['all_generic_name'] = $this->admin_model->select_with_where2('*', 'status=1', 'generic_info');
		$data['all_product_category'] = $this->admin_model->select_with_where2('*', 'status=1', 'product_category');
		$data['all_company_name'] = $this->admin_model->select_with_where2('*', 'status=1', 'company');
		$data['all_pack_size'] = $this->admin_model->select_with_where2('*', 'status=1', 'pack_size_info');
		$data["rack_all_info"] = $this->admin_model->select_with_where2('*', 'status=1', 'rack');

		$this->form_validation->set_error_delimiters('<div>', '</div>');
		$this->form_validation->set_rules('p_name', 'Product Name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('pharmacy/edit_product', $data);
		} else {
			$product_image = "Default_image";
			if ($_FILES['p_img']['name']) {
				$name_generator = $this->name_generator($_FILES['p_img']['name'], $product_id);
				$i_ext = explode('.', $_FILES['p_img']['name']);
				$target_path = $name_generator . '.' . end($i_ext);;
				$size = getimagesize($_FILES['p_img']['tmp_name']);

				if (move_uploaded_file($_FILES['p_img']['tmp_name'], 'uploads/product_image/' . $target_path)) {
					$product_image = $target_path;
				}
			}


			$val = array(
				'p_img' => $product_image,
				'p_name' => $this->input->post('p_name'),
				'p_unit_id' => $this->input->post('p_unit'),
				'p_generic_id' => $this->input->post('p_generic_name'),
				'vat' => $this->input->post('vat'),
				'tax' => $this->input->post('tax'),
				'rack_id' => $this->input->post('rack_id'),
				'pack_size_id' => $this->input->post('p_pack_size'),
				'p_buy_price' => $this->input->post('p_buy_price'),
				'p_sell_price' => $this->input->post('p_sell_price'),
				'p_cat_id' => $this->input->post('p_category'),
				'p_reorder_qty' => $this->input->post('p_alert_qty'),
				'p_company_id' => $this->input->post('company_name'),
				'updated_at' => date('Y-m-d H:i:s')

			);
			$this->admin_model->update_function('id', $product_id, 'product', $val);

			$data['all_product_info'] = $this->admin_model->select_with_where2('*', 'id="' . $product_id . '" AND status=1', 'product');

			$data['message'] = "update Successfully";
			$this->load->view('pharmacy/edit_product', $data);
		}
	}

	public function purchage_product_list($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchase Product List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['all_purchased_product_list'] = $this->admin_model->select_join_order('*,b.created_at ', 'buy b', 'supplier s', 'supp_id=id', 'b.buy_id', 'desc');



		$this->load->view('pharmacy/purchage_product_list', $data);
	}
	public function purchage_product($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchage Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['product_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'product');


		$data['supplier_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'supplier');

		$this->load->view('pharmacy/purchage_product', $data);
	}

	public function purchage_product_details($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchage Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$buy_id = $this->uri->segment(3);

		$data['buy_details'] = $this->admin_model->select_join_five_table2('*,b.created_at,b.buy_id', 'buy b', 'supplier s', 'buy_details d', 'product p', 'unit_info u', 'b.supp_id=s.id', 'b.buy_id=d.buy_id', 'p.id=d.p_id', 'u.id=p.p_unit_id', 'b.buy_id="' . $buy_id . '"');

		$last_ret_id = $this->admin_model->get_last_row2('return_product', 'buy_sell_code="' . $data['buy_details'][0]['buy_code'] . '" and type=1');

		if ($last_ret_id != null) {
			$data['return_info'] = $this->admin_model->select_join_where('*', 'return_product r', 'return_product_det d', 'r.id=d.ret_id', 'r.id="' . $last_ret_id[0]['id'] . '" and r.status=1 and r.type=1');

			$data['total_charge'] = $this->admin_model->get_charge_sum_where('charge', 'return_product', 'buy_sell_code="' . $data['buy_details'][0]['buy_code'] . '" and type=1');

			$data['total_ret_paid'] = $this->admin_model->get_charge_sum_where('total_paid', 'return_product', 'buy_sell_code="' . $data['buy_details'][0]['buy_code'] . '" and type=1');
		} else {
			$data['return_info'] = null;
		}

		$this->load->view('pharmacy/purchage_product_details', $data);
	}
	public function purchage_product_details_pdf($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchage Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$buy_id = $this->uri->segment(3);

		$data['buy_details'] = $this->admin_model->select_join_five_table2('*,b.created_at,b.buy_id', 'buy b', 'supplier s', 'buy_details d', 'product p', 'unit_info u', 'b.supp_id=s.id', 'b.buy_id=d.buy_id', 'p.id=d.p_id', 'u.id=p.p_unit_id', 'b.buy_id="' . $buy_id . '"');

		$last_ret_id = $this->admin_model->get_last_row2('return_product', 'buy_sell_code="' . $data['buy_details'][0]['buy_code'] . '" and type=1');

		if ($last_ret_id != null) {
			$data['return_info'] = $this->admin_model->select_join_where('*', 'return_product r', 'return_product_det d', 'r.id=d.ret_id', 'r.id="' . $last_ret_id[0]['id'] . '" and r.status=1 and r.type=1');

			$data['total_charge'] = $this->admin_model->get_charge_sum_where('charge', 'return_product', 'buy_sell_code="' . $data['buy_details'][0]['buy_code'] . '" and type=1');

			$data['total_ret_paid'] = $this->admin_model->get_charge_sum_where('total_paid', 'return_product', 'buy_sell_code="' . $data['buy_details'][0]['buy_code'] . '" and type=1');
		} else {
			$data['return_info'] = null;
		}

		$this->load->view('pharmacy/purchage_product_details_pdf', $data);
	}

	public function sell_product_details($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Sell Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['opd_info'] = "";
		$data['ipd_info'] = "";
		$data['uhid_info'] = "";

		$sell_id = $this->uri->segment(3);

		$sell_info = $this->admin_model->select_with_where2('*', 'status=1 and sell_id="' . $sell_id . '"', 'sell');

		$data['sell_details'] = $this->admin_model->select_join_five_table2('*,s.created_at,d.created_at as c_date,s.sell_id,c.p_id', 'sell s', 'customer c', 'sell_details d', 'product p', 'unit_info u', 's.cust_id=c.id', 's.sell_id=d.sell_id', 'p.id=d.p_id', 'u.id=p.p_unit_id', 's.sell_id="' . $sell_id . '" and s.status=1');

		if ($sell_info[0]['patient_type'] == 1) {
			$data['opd_info'] = $this->admin_model->select_with_where2('*', 'status=1 and id= "' . $data['sell_details'][0]['p_id'] . '"', 'opd_patient_info');
		} else if ($sell_info[0]['patient_type'] == 2) {
			$data['ipd_info'] = $this->admin_model->select_join_where('*', 'ipd_patient_info i', 'room r', 'r.id=i.cabin_no', 'i.status=1 and  i.id="' . $data['sell_details'][0]['p_id'] . '"');
		} else if ($sell_info[0]['patient_type'] == 4) {
			$data['uhid_info'] = $this->admin_model->select_with_where2('*', 'status=1 and id= "' . $data['sell_details'][0]['p_id'] . '"', 'uhid');
		}






		$val = $data["sell_details"][0]["sell_code"];


		$last_ret_id = $this->admin_model->get_last_row2('return_product', 'buy_sell_code="' . $val . '" and status=1 and type=2');

		if ($last_ret_id != null) {
			$data['return_info'] = $this->admin_model->select_join_where('*', 'return_product r', 'return_product_det d', 'r.id=d.ret_id', 'r.id="' . $last_ret_id[0]['id'] . '" and r.status=1 and r.type=2');

			$data['total_charge'] = $this->admin_model->get_charge_sum_where('charge', 'return_product', 'buy_sell_code="' . $data['sell_details'][0]['sell_code'] . '" and type=2');

			$data['total_ret_paid'] = $this->admin_model->get_charge_sum_where('total_paid', 'return_product', 'buy_sell_code="' . $data['sell_details'][0]['sell_code'] . '" and type=2');
		} else {
			$data['return_info'] = null;
		}




		$this->load->view('pharmacy/sell_product_details', $data);
	}

	public function sell_product_details_pdf($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchage Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$sell_id = $this->uri->segment(3);

		$sell_info = $this->admin_model->select_with_where2('*', 'status=1 and sell_id="' . $sell_id . '"', 'sell');

		if ($sell_info[0]['patient_type'] == 2) {

			$data['sell_details'] = $this->admin_model->select_join_five_table2('*,s.created_at,d.created_at as c_date,s.sell_id,c.type,c.p_id', 'sell s', 'customer c', 'sell_details d', 'product p', 'unit_info u', 's.cust_id=c.id', 's.sell_id=d.sell_id', 'p.id=d.p_id', 'u.id=p.p_unit_id', 's.sell_id="' . $sell_id . '"');
		} else {
			$data['sell_details'] = $this->admin_model->select_join_five_table2_group_by_sum('*,s.created_at,d.created_at as c_date,s.sell_id,c.type,c.p_id', 'd.sell_qty', 'sell s', 'customer c', 'sell_details d', 'product p', 'unit_info u', 's.cust_id=c.id', 's.sell_id=d.sell_id', 'p.id=d.p_id', 'u.id=p.p_unit_id', 's.sell_id="' . $sell_id . '"', 'd.p_id');
		}

		$data['opd_info'] = "";
		$data['ipd_info'] = "";
		$data['uhid_info'] = "";

		if ($sell_info[0]['patient_type'] == 1) {
			$data['opd_info'] = $this->admin_model->select_with_where2('*', 'status=1 and id= "' . $data['sell_details'][0]['p_id'] . '"', 'opd_patient_info');
		} else if ($sell_info[0]['patient_type'] == 2) {
			$data['ipd_info'] = $this->admin_model->select_join_where('*', 'ipd_patient_info i', 'room r', 'r.id=i.cabin_no', 'i.status=1 and  i.id="' . $data['sell_details'][0]['p_id'] . '"');
		} else if ($sell_info[0]['patient_type'] == 4) {
			$data['uhid_info'] = $this->admin_model->select_with_where2('*', 'status=1 and id= "' . $data['sell_details'][0]['p_id'] . '"', 'uhid');
		}




		$last_ret_id = $this->admin_model->get_last_row2('return_product', 'buy_sell_code="' . $data['sell_details'][0]['sell_code'] . '" and type=2');

		if ($last_ret_id != null) {
			$data['return_info'] = $this->admin_model->select_join_where('*', 'return_product r', 'return_product_det d', 'r.id=d.ret_id', 'r.id="' . $last_ret_id[0]['id'] . '" and r.status=1 and r.type=2');

			$data['total_charge'] = $this->admin_model->get_charge_sum_where('charge', 'return_product', 'buy_sell_code="' . $data['sell_details'][0]['sell_code'] . '" and type=2');

			$data['total_ret_paid'] = $this->admin_model->get_charge_sum_where('total_paid', 'return_product', 'buy_sell_code="' . $data['sell_details'][0]['sell_code'] . '" and type=2');
		} else {
			$data['return_info'] = null;
		}

		$this->load->view('pharmacy/sell_product_details_pdf', $data);
	}


	public function insert_purchage_product()
	{

		$login_id = $this->session->userdata['logged_in']['id'];
		$buy_code = 'pur-000001';
		$get_last_buy_code = $this->admin_model->get_last_buy_code();

		if (count($get_last_buy_code) > 0) {
			$buy_code = $get_last_buy_code[0]['buy_code'];
			$buy_code_explode = explode('-', $buy_code);
			$buy_code_int = $buy_code_explode[1];
			$buy_code_number = sprintf("%'.06d", ($buy_code_int + 1));
			$buy_code = $buy_code_explode[0] . '-' . $buy_code_number;
		}

		$buy_data['user_id'] = $login_id;
		$buy_data['buy_code'] = $buy_code;
		$buy_data['supp_id'] = $this->input->post('supp_id');
		$buy_data['bill_no'] = $this->input->post('bill_no');
		$buy_data['credit'] = $this->input->post('credit');
		$buy_data['debit'] = $this->input->post('debit');
		$buy_data['unload_cost'] = $this->input->post('unload_cost');

		$buy_data['created_at'] = date('Y-m-d H:i:s');
		$buy_data['cost_total'] = $buy_data['credit'] + $buy_data['unload_cost'];
		$buy_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$buy_data['operator_name'] = $this->session->userdata['logged_in']['username'];

		$buy_id = $this->admin_model->insert_ret('buy', $buy_data);

		$p_id = $this->input->post('p_id');
		$buy_price = $this->input->post('buy_price');
		$buy_qty = $this->input->post('buy_qty');

		$expire_date = $this->input->post('expire_date');

		for ($i = 0; $i < count($p_id); $i++) {
			$bd_data['buy_id'] = $buy_id;

			$bd_data['p_id'] = $p_id[$i];
			$bd_data['buy_price'] = $buy_price[$i];
			$bd_data['buy_qty'] = $buy_qty[$i];
			// $bd_data['current_stock']=$buy_qty[$i];
			$bd_data['created_at'] = date('Y-m-d H:i:s');
			$bd_data['expire_date'] = $expire_date[$i];

			$this->admin_model->insert('buy_details', $bd_data);
		}

		$d_data['old_due'] = $this->input->post('credit');
		$d_data['order_id'] = $buy_code;
		$d_data['total_amount'] = $this->input->post('credit');
		$d_data['supp_cust_id'] = $this->input->post('supp_id');
		$d_data['unload_cost'] = $this->input->post('unload_cost');
		$d_data['current_due'] = $buy_data['cost_total'] - $this->input->post('debit');
		$d_data['paid_due'] = $this->input->post('debit');
		$d_data['due_type'] = 1;
		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$d_data['created_at'] = date('Y-m-d H:i:s');
		$this->load->admin_model->insert_ret('pharmacy_due_collection', $d_data);


		$pay_data['user_id'] = $login_id;
		$pay_data['sell_buy_id'] = $buy_id;
		$pay_data['cust_supp_id'] = $this->input->post('supp_id');
		$pay_data['amount'] = $buy_data['debit'];
		$pay_data['payment_type'] = 1;
		$pay_data['type'] = 1;
		$pay_data['created_at'] = date('Y-m-d H:i:s');

		$payment_id = $this->admin_model->insert_ret('payment', $pay_data);

		for ($i = 0; $i < count($p_id); $i++) {
			$stock['sell_buy_id'] = $buy_id;
			$stock['p_id'] = $p_id[$i];

			$get_last_val = $this->admin_model->get_last_row('stock', 'p_id="' . $p_id[$i] . '" and expire_date="' . $expire_date[$i] . '"');

			$stock['st_open'] = 0;
			if (count($get_last_val) > 0) {
				$stock['st_open'] = $get_last_val[0]['st_close'];
			}
			$stock['st_in'] = $buy_qty[$i];

			$stock['st_out'] = 0;
			$stock['st_close'] = $stock['st_open'] + $stock['st_in'];
			$stock['type'] = 1;
			$stock['created_at'] = date('Y-m-d H:i:s');
			$stock['expire_date'] = $expire_date[$i];

			$this->admin_model->insert('stock', $stock);
		}

		//quantity update in product table

		for ($i = 0; $i < count($p_id); $i++) {

			$prev_qty = $this->admin_model->select_with_where2('current_stock', 'p_id="' . $p_id[$i] . '" and status=1 and expire_date="' . $expire_date[$i] . '"', 'buy_details');

			if ($prev_qty[0]['current_stock'] == 0) {
				$data_update['current_stock'] = $buy_qty[$i];
			} else {
				$data_update['current_stock'] = $prev_qty[0]['current_stock'] + $buy_qty[$i];
			}

			// $prev_qty=$get_p_data[0]['p_current_stock'];



			$this->admin_model->update_function2('p_id="' . $p_id[$i] . '" and status=1 and expire_date="' . $expire_date[$i] . '"', 'buy_details', $data_update);
		}

		redirect('admin/purchage_product_list', 'refresh');
	}



	public function insert_sell_data()
	{

		$login_id = $this->session->userdata['logged_in']['id'];
		$sell_code = 'inv-000001';
		$get_last_sell_code = $this->admin_model->get_last_sell_code();

		if (count($get_last_sell_code) > 0) {
			$sell_code = $get_last_sell_code[0]['sell_code'];
			$sell_code_explode = explode('-', $sell_code);
			$sell_code_int = $sell_code_explode[1];
			$sell_code_number = sprintf("%'.06d", ($sell_code_int + 1));
			$sell_code = $sell_code_explode[0] . '-' . $sell_code_number;
		}


		$p_id = $this->input->post('p_id');
		$sell_price = $this->input->post('sell_price');
		$sell_qty = $this->input->post('sell_qty');
		$credit = 0;

		for ($i = 0; $i < count($p_id); $i++) {
			$credit += $sell_price[$i] * $sell_qty[$i];
		}

		$ref_dir_id = explode('#', $this->input->post('ref_dir_id'));

		$cust_gen_id = 1;

		$cust_info = $this->admin_model->get_last_row2('customer', 'status=1');

		if ($cust_info != null) {
			$cust_gen_id = $cust_info[0]['cust_gen_id'] + 1;
		}

		$expire_date = $this->input->post('expire_date');


		// optradio 3 and 4 only phar pateint 

		// fresh new cust

		if ($this->input->post('optradio') == 4) {

			$patient_data['cust_name'] = $this->input->post('patient_name');
			$patient_data['cust_gen_id'] = $cust_gen_id;
			$patient_data['cust_phone'] = $this->input->post('mobile_no');
			$patient_data['cust_address'] = $this->input->post('address');
			$patient_data['type'] = 3;
			$patient_data['type_in_word'] = "others";
			$patient_data['ref_dir_id'] = $ref_dir_id[0];
			$patient_data['ref_dir_name'] = $ref_dir_id[1];
			$patient_data['created_at'] = date('Y-m-d H:i:s');
			$cust_id = $this->admin_model->insert_ret('customer', $patient_data);

			$sell_data['cust_id'] = $cust_id;
			$sell_data['patient_type'] = 3; // 3 -> only phar customer 
		}

		// uhid
		else if ($this->input->post('optradio') == 5) {

			$already_phar_cust = $this->admin_model->select_with_where2('*', 'p_id="' . $this->input->post('uhid_customer_id') . '" and type=4', 'customer');


			$patient_data['cust_name'] = $this->input->post('patient_name');

			$patient_data['cust_phone'] = $this->input->post('mobile_no');
			$patient_data['cust_address'] = $this->input->post('address');
			$patient_data['type'] = 4;
			$patient_data['type_in_word'] = "uhid";

			$patient_data['p_id'] = $this->input->post('uhid_customer_id');
			$sell_data['patient_type'] = 4;

			if ($already_phar_cust == null) {
				// $patient_data['ref_dir_id']=$ref_dir_id[0];
				// $patient_data['ref_dir_name']=$ref_dir_id[1];
				$patient_data['cust_gen_id'] = $cust_gen_id;
				$patient_data['created_at'] = date('Y-m-d H:i:s');
				$cust_id = $this->admin_model->insert_ret('customer', $patient_data);
				$sell_data['cust_id'] = $cust_id;
			} else {
				$patient_data['updated_at'] = date('Y-m-d H:i:s');
				$this->admin_model->update_function2('id="' . $already_phar_cust[0]['id'] . '"', 'customer', $patient_data);

				$cust_id = $already_phar_cust[0]['id'];

				$sell_data['cust_id'] = $already_phar_cust[0]['id'];
			}
		}

		// opd
		else if ($this->input->post('optradio') == 1) {

			$already_phar_cust = $this->admin_model->select_with_where2('*', 'p_id="' . $this->input->post('opd_cust_id') . '" and type=1', 'customer');

			$patient_data['cust_name'] = $this->input->post('patient_name');

			$patient_data['cust_phone'] = $this->input->post('mobile_no');
			$patient_data['cust_address'] = $this->input->post('address');
			$patient_data['type'] = 1;
			$patient_data['type_in_word'] = "opd";
			$patient_data['p_id'] = $this->input->post('opd_cust_id');

			$sell_data['patient_type'] = 1;
			if ($already_phar_cust == null) {
				$patient_data['cust_gen_id'] = $cust_gen_id;
				// $patient_data['ref_dir_id']=$ref_dir_id[0];
				// $patient_data['ref_dir_name']=$ref_dir_id[1];
				$patient_data['created_at'] = date('Y-m-d H:i:s');
				$cust_id = $this->admin_model->insert_ret('customer', $patient_data);
				$sell_data['cust_id'] = $cust_id;
			} else {
				$patient_data['updated_at'] = date('Y-m-d H:i:s');
				$this->admin_model->update_function2('id="' . $already_phar_cust[0]['id'] . '"', 'customer', $patient_data);

				$sell_data['cust_id'] = $already_phar_cust[0]['id'];
				$cust_id = $already_phar_cust[0]['id'];
			}
		}
		// ipd
		elseif ($this->input->post('optradio') == 2) {
			$already_phar_cust = $this->admin_model->select_with_where2('*', 'p_id="' . $this->input->post('ipd_cust_id') . '" and type=2', 'customer');

			$patient_data['cust_name'] = $this->input->post('patient_name');

			$patient_data['cust_phone'] = $this->input->post('mobile_no');
			$patient_data['cust_address'] = $this->input->post('address');
			$patient_data['type'] = 2;
			$patient_data['type_in_word'] = "ipd";

			$patient_data['p_id'] = $this->input->post('ipd_cust_id');

			$sell_data['patient_type'] = 2;

			if ($already_phar_cust == null) {
				$patient_data['cust_gen_id'] = $cust_gen_id;
				// $patient_data['ref_dir_id']=$ref_dir_id[0];
				// $patient_data['ref_dir_name']=$ref_dir_id[1];
				$patient_data['created_at'] = date('Y-m-d H:i:s');
				$cust_id = $this->admin_model->insert_ret('customer', $patient_data);

				$sell_data['cust_id'] = $cust_id;
			} else {
				$patient_data['updated_at'] = date('Y-m-d H:i:s');
				$this->admin_model->update_function2('id="' . $already_phar_cust[0]['id'] . '"', 'customer', $patient_data);

				$cust_id = $already_phar_cust[0]['id'];

				$cust_sell_det = $this->admin_model->select_with_where2('*', 'cust_id="' . $cust_id . '"', 'sell');

				$sell_id = $cust_sell_det[0]['sell_id'];

				$sell_data['cust_id'] = $already_phar_cust[0]['id'];
				$sell_data['patient_type'] = 2;

				// update sell table
				$sell_data['credit'] = $credit + $cust_sell_det[0]['credit']; //total amount
				$sell_data['debit'] = $this->input->post('total_paid') + $cust_sell_det[0]['debit'];
				$sell_data['discount'] = round($this->input->post('discount')) + $cust_sell_det[0]['discount'];
				$sell_data['vat'] = round($this->input->post('vat')) + $cust_sell_det[0]['vat'];
				$sell_data['net_total'] = $sell_data['credit'] + $sell_data['vat'] - $sell_data['discount'];
				$sell_id = $cust_sell_det[0]['sell_id'];
				$this->admin_model->update_function2('sell_id="' . $sell_id . '"', 'sell', $sell_data);

				// insert due collection for IPD

				$d_data['order_id'] = $cust_sell_det[0]['sell_code'];
				$d_data['old_due'] = $cust_sell_det[0]['net_total'] - $cust_sell_det[0]['debit'];
				$d_data['total_amount'] = $credit;
				$d_data['supp_cust_id'] = $cust_sell_det[0]['cust_id'];
				$d_data['vat'] = $this->input->post('vat');
				$d_data['discount'] = $this->input->post('discount');
				$d_data['current_due'] = $d_data['old_due'] - $this->input->post('total_paid');
				$d_data['paid_due'] = $this->input->post('total_paid');

				$d_data['due_type'] = 2;
				$d_data['created_at'] = date('Y-m-d H:i:s');
				$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
				$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];
				$this->load->admin_model->insert_ret('pharmacy_due_collection', $d_data);

				// insert into sell details for IPD


				$p_id = $this->input->post('p_id');
				$sell_price = $this->input->post('sell_price');
				$sell_qty = $this->input->post('sell_qty');

				for ($i = 0; $i < count($p_id); $i++) {
					$sd_data['sell_id'] = $sell_id;
					$sd_data['sell_code'] = $cust_sell_det['0']['sell_code'];
					$sd_data['p_id'] = $p_id[$i];
					$sd_data['sell_price'] = $sell_price[$i];
					$sd_data['sell_qty'] = $sell_qty[$i];
					$sd_data['created_at'] = date('Y-m-d H:i:s');
					$sd_data['expire_date'] = $expire_date[$i];

					$this->admin_model->insert('sell_details', $sd_data);
				}

				// insert into payment for IPD

				$pay_data['user_id'] = $login_id;
				$pay_data['sell_buy_id'] = $sell_id;
				$pay_data['cust_supp_id'] = $this->input->post('cust_id');
				$pay_data['amount'] = $this->input->post('total_paid');
				$pay_data['payment_type'] = 1;

				$pay_data['type'] = 2;
				$pay_data['created_at'] = date('Y-m-d H:i:s');

				$payment_id = $this->admin_model->insert_ret('payment', $pay_data);

				// insert into stock for IPD


				for ($i = 0; $i < count($p_id); $i++) {
					$stock['sell_buy_id'] = $sell_id;
					$stock['p_id'] = $p_id[$i];
					$stock['expire_date'] = $expire_date[$i];

					$get_last_val = $this->admin_model->get_last_row('stock', 'p_id="' . $p_id[$i] . '" and expire_date="' . $expire_date[$i] . '"');

					$stock['st_open'] = 0;
					if (count($get_last_val) > 0) {
						$stock['st_open'] = $get_last_val[0]['st_close'];
					}
					$stock['st_in'] = 0;
					$stock['st_out'] = $sell_qty[$i];
					$stock['st_close'] = $stock['st_open'] - $stock['st_out'];
					$stock['type'] = 2;
					$stock['created_at'] = date('Y-m-d H:i:s');

					$this->admin_model->insert('stock', $stock);
				}
				// update product/buy det table


				for ($i = 0; $i < count($p_id); $i++) {


					$prev_qty = $this->admin_model->select_with_where2('current_stock', 'p_id="' . $p_id[$i] . '" and status=1 and expire_date="' . $expire_date[$i] . '"', 'buy_details');

					if ($prev_qty[0]['current_stock'] == 0) {
						$data_update['current_stock'] = $buy_qty[$i];
					} else {
						$data_update['current_stock'] = $prev_qty[0]['current_stock'] - $sell_qty[$i];
					}


					$this->admin_model->update_function2('p_id="' . $p_id[$i] . '" and expire_date="' . $expire_date[$i] . '" and  date(buy_details.expire_date) >= "' . date('Y-m-d') . '" and buy_details.current_stock > 0', 'buy_details', $data_update);
				}

				$this->cart->destroy();

				redirect('admin/sell_product_list', 'refresh');

				// >>>>>>>>>>> ipd done  <<<<<<<<<
			}
		} else {
			$sell_data['cust_id'] = $this->input->post('cust_id');
			$sell_data['patient_type'] = 3; //phar customer

			$cust_id = $this->input->post('cust_id');
		}

		$sell_data['user_id'] = $login_id;
		$sell_data['sell_code'] = $sell_code;


		$sell_data['credit'] = $credit; //total amount
		$sell_data['debit'] = $this->input->post('total_paid');
		$sell_data['discount'] = round($this->input->post('discount'));
		$sell_data['vat'] = round($this->input->post('vat'));
		$sell_data['net_total'] = ($credit + $this->input->post('vat')) - $this->input->post('discount');
		$sell_data['created_at'] = date('Y-m-d H:i:s');
		$sell_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$sell_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$sell_data['ref_dir_id'] = $ref_dir_id[0];
		$sell_data['ref_dir_name'] = $ref_dir_id[1];

		$sell_id = $this->admin_model->insert_ret('sell', $sell_data);

		// insert into due collection

		$d_data['old_due'] = $credit;
		$d_data['order_id'] = $sell_code;
		$d_data['total_amount'] = $credit;
		$d_data['supp_cust_id'] = $cust_id;
		$d_data['vat'] = $this->input->post('vat');
		$d_data['discount'] = $this->input->post('discount');
		$d_data['current_due'] = $sell_data['net_total'] - $this->input->post('total_paid');
		$d_data['paid_due'] = $this->input->post('total_paid');

		$d_data['due_type'] = 2;
		$d_data['created_at'] = date('Y-m-d H:i:s');
		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$this->load->admin_model->insert_ret('pharmacy_due_collection', $d_data);


		// insert into sell details


		$p_id = $this->input->post('p_id');
		$sell_price = $this->input->post('sell_price');
		$sell_qty = $this->input->post('sell_qty');


		for ($i = 0; $i < count($p_id); $i++) {
			$sd_data['sell_id'] = $sell_id;
			$sd_data['sell_code'] = $sell_code;
			$sd_data['p_id'] = $p_id[$i];
			$sd_data['sell_price'] = $sell_price[$i];
			$sd_data['sell_qty'] = $sell_qty[$i];
			$sd_data['created_at'] = date('Y-m-d H:i:s');
			$sd_data['expire_date'] = $expire_date[$i];

			$this->admin_model->insert('sell_details', $sd_data);
		}


		// insert into payment

		$pay_data['user_id'] = $login_id;
		$pay_data['sell_buy_id'] = $sell_id;
		$pay_data['cust_supp_id'] = $this->input->post('cust_id');
		$pay_data['amount'] = $this->input->post('total_paid');
		$pay_data['payment_type'] = 1;

		$pay_data['type'] = 2;
		$pay_data['created_at'] = date('Y-m-d H:i:s');

		$payment_id = $this->admin_model->insert_ret('payment', $pay_data);


		// insert into stock


		for ($i = 0; $i < count($p_id); $i++) {
			$stock['sell_buy_id'] = $sell_id;
			$stock['p_id'] = $p_id[$i];
			$stock['expire_date'] = $expire_date[$i];
			$get_last_val = $this->admin_model->get_last_row('stock', 'p_id=' . $p_id[$i]);
			$stock['st_open'] = 0;
			if (count($get_last_val) > 0) {
				$stock['st_open'] = $get_last_val[0]['st_close'];
			}
			$stock['st_in'] = 0;
			$stock['st_out'] = $sell_qty[$i];
			$stock['st_close'] = $stock['st_open'] - $stock['st_out'];
			$stock['type'] = 2;
			$stock['created_at'] = date('Y-m-d H:i:s');

			$this->admin_model->insert('stock', $stock);
		}

		// update product det table


		for ($i = 0; $i < count($p_id); $i++) {


			$prev_qty = $this->admin_model->select_with_where2('current_stock', 'p_id="' . $p_id[$i] . '" and status=1 and expire_date="' . $expire_date[$i] . '"', 'buy_details');

			if ($prev_qty[0]['current_stock'] == 0) {
				$data_update['current_stock'] = $buy_qty[$i];
			} else {
				$data_update['current_stock'] = $prev_qty[0]['current_stock'] - $sell_qty[$i];
			}


			$this->admin_model->update_function2('p_id="' . $p_id[$i] . '" and expire_date="' . $expire_date[$i] . '" and  date(buy_details.expire_date) >= "' . date('Y-m-d') . '" and buy_details.current_stock > 0', 'buy_details', $data_update);
		}

		$this->cart->destroy();

		redirect('admin/sell_product_list', 'refresh');
	}


	public function update_sell_data($flag = '')
	{


		$login_id = $this->session->userdata['logged_in']['id'];
		$sell_id = $this->input->post('sell_id');
		$p_id = $this->input->post('p_id');
		$sell_price = $this->input->post('sell_price');


		$all_delete_p_id = explode('_', $this->input->post('delete_p_id_list'));


		$val = $this->admin_model->select_with_where2('*', 'sell_id="' . $sell_id . '"', 'sell');

		foreach ($val as $key => $value) {

			$sell_data['sell_table_id'] = $value['sell_id'];
			$sell_data['sell_code'] = $value['sell_code'];
			$sell_data['bill_no'] = $value['bill_no'];
			$sell_data['export_no'] = $value['export_no'];
			$sell_data['cust_id'] = $value['cust_id'];
			$sell_data['credit'] = $value['credit'];
			$sell_data['debit'] = $value['debit'];
			$sell_data['discount'] = $value['discount'];
			$sell_data['vat'] = $value['vat'];
			$sell_data['net_total'] = $value['net_total'];
			$sell_data['created_at'] = date('Y-m-d H:i:s');
			$this->admin_model->insert('sell_history', $sell_data);
		}

		$val = $this->admin_model->select_with_where2('*', 'sell_id="' . $sell_id . '"', 'sell_details');

		foreach ($val as $key => $value) {

			$sd_data['sell_det_table_id'] = $value['sell_det_id'];
			$sd_data['sell_id'] = $value['sell_id'];
			$sd_data['p_id'] = $value['p_id'];
			$sd_data['sell_price'] = $value['sell_price'];
			$sd_data['sell_qty'] = $value['sell_qty'];
			$sd_data['created_at'] = date('Y-m-d H:i:s');

			$this->admin_model->insert('sell_details_history', $sd_data);
		}

		$val = $this->admin_model->select_with_where2('*', 'sell_buy_id="' . $sell_id . '"', 'payment');

		foreach ($val as $key => $value) {


			$pay_data['amount'] = $value['amount'];
			$pay_data['payment_type'] = $value['payment_type'];
			$pay_data['sell_buy_id'] = $value['sell_buy_id'];
			$pay_data['cust_supp_id'] = $value['cust_supp_id'];
			$pay_data['type'] = 4;
			$this->admin_model->insert('payment_history', $pay_data);
		}

		$val = $this->admin_model->select_with_where2('*', 'sell_buy_id="' . $sell_id . '"', 'stock');

		foreach ($val as $key => $value) {

			$stock['st_table_id'] = $value['st_id'];
			$stock['sell_buy_id'] = $value['sell_buy_id'];
			$stock['p_id'] = $value['p_id'];

			$stock['st_open'] = $value['st_open'];

			$stock['st_in'] = $value['st_in'];
			$stock['st_out'] = $value['st_out'];
			$stock['st_close'] = $value['st_close'];
			$stock['type'] = $value['type'];
			$stock['created_at'] = date('Y-m-d H:i:s');

			$this->admin_model->insert('stock_history', $stock);
		}

		$sell_id = $this->input->post('sell_id');
		$p_id = $this->input->post('p_id');
		$sell_price = $this->input->post('sell_price');
		$sell_qty = $this->input->post('sell_qty');

		// "<pre>";print_r($sell_qty);die();

		for ($i = 0; $i < count($p_id); $i++) {
			$prev_qty = 0;
			$get_p_data = $this->admin_model->select_with_where2('p_current_stock', 'id =' . $p_id[$i], 'product');

			$get_sell_qty = $this->admin_model->select_with_where2('*', 'sell_id="' . $sell_id . '" AND p_id=' . $p_id[$i], 'sell_details');

			if ($get_sell_qty != null) {
				$prev_qty = $get_p_data[0]['p_current_stock'] + $get_sell_qty[0]['sell_qty'];
			} else {
				$prev_qty = $get_p_data[0]['p_current_stock'];
			}

			$data_update['p_current_stock'] = $get_p_data[0]['p_current_stock'];

			if ($get_sell_qty != null) {
				if (($prev_qty + $get_sell_qty[0]['sell_qty']) >= $sell_qty[$i]) {
					$data_update['p_current_stock'] = $prev_qty - $sell_qty[$i];
				}
			} else {
				if ($prev_qty  >= $sell_qty[$i]) {
					$data_update['p_current_stock'] = $prev_qty - $sell_qty[$i];
				}
			}


			$this->admin_model->update_function('id', $p_id[$i], 'product', $data_update);
		}


		$sell_qty = $this->input->post('sell_qty');
		$p_id = $this->input->post('p_id');
		$credit = 0;
		for ($i = 0; $i < count($p_id); $i++) {
			$credit += $sell_price[$i] * $sell_qty[$i];
		}

		$sell_data1['user_id'] = $login_id;
		$sell_data1['credit'] = $credit;
		$sell_data1['debit'] = $this->input->post('total_paid');
		$sell_data1['discount'] = $this->input->post('discount');
		$sell_data1['vat'] = $this->input->post('vat');
		$sell_data1['net_total'] = ($credit + $this->input->post('vat')) - $this->input->post('discount');
		$sell_data1['created_at'] = date('Y-m-d H:i:s');

		$this->admin_model->update_function2('sell_id="' . $sell_id . '"', 'sell', $sell_data1);

		$sell_id = $this->input->post('sell_id');
		$p_id = $this->input->post('p_id');
		$sell_price = $this->input->post('sell_price');
		$sell_qty = $this->input->post('sell_qty');

		for ($i = 0; $i < count($p_id); $i++) {

			if ($this->admin_model->check_row('*', 'sell_id="' . $sell_id . '" AND p_id="' . $p_id[$i] . '"', 'sell_details')) {

				$sd_data1['p_id'] = $p_id[$i];
				$sd_data1['sell_price'] = $sell_price[$i];
				$sd_data1['sell_qty'] = $sell_qty[$i];
				$this->admin_model->update_function2('sell_id="' . $sell_id . '" AND p_id="' . $p_id[$i] . '" ', 'sell_details', $sd_data1);
			} else {
				$sd_data1['sell_id'] = $sell_id;
				$sd_data1['p_id'] = $p_id[$i];
				$sd_data1['sell_price'] = $sell_price[$i];
				$sd_data1['sell_qty'] = $sell_qty[$i];
				$sd_data1['created_at'] = date('Y-m-d H:i:s');

				$this->admin_model->insert('sell_details', $sd_data1);
			}
		}

		for ($i = 1; $i < count($all_delete_p_id); $i++) {




			$this->admin_model->delete_function_cond('sell_details', 'sell_id="' . $sell_id . '" AND p_id="' . $all_delete_p_id[$i] . '"');
		}


		for ($i = 0; $i < count($p_id); $i++) {
			if ($this->admin_model->check_row('*', 'sell_buy_id="' . $sell_id . '" AND p_id="' . $p_id[$i] . '" AND type=2', 'stock')) {

				$get_last_val = $this->admin_model->get_last_row('stock', 'p_id=' . $p_id[$i]);
				$stock1['st_open'] = 0;
				if (count($get_last_val) > 0) {
					$stock1['st_open'] = $get_last_val[0]['st_close'];
				}
				$stock1['st_in'] = 0;
				$stock1['st_out'] = $sell_qty[$i];
				$stock1['st_close'] = $stock['st_open'] - $stock['st_out'];

				// $stock['created_at']=date('Y-m-d H:i:s');
				$this->admin_model->update_function2('sell_buy_id="' . $sell_id . '" AND p_id="' . $p_id[$i] . '" AND type=2', 'stock', $stock1);
			} else {
				$stock1['sell_buy_id'] = $sell_id;
				$stock1['p_id'] = $p_id[$i];
				$get_last_val = $this->admin_model->get_last_row('stock', 'p_id=' . $p_id[$i]);
				$stock1['st_open'] = 0;
				if (count($get_last_val) > 0) {
					$stock1['st_open'] = $get_last_val[0]['st_close'];
				}
				$stock1['st_in'] = 0;
				$stock1['st_out'] = $sell_qty[$i];
				$stock1['st_close'] = $stock['st_open'] - $stock['st_out'];
				$stock1['type'] = 2;
				$stock1['created_at'] = date('Y-m-d H:i:s');

				$this->admin_model->insert('stock', $stock1);
			}
		}

		$pay_data1['amount'] = $this->input->post('total_paid');
		$pay_data1['payment_type'] = 1;
		$pay_data1['type'] = 2;
		$this->admin_model->update_function2('sell_buy_id="' . $sell_id . '" AND type=2', 'payment', $pay_data1);

		$val = $this->admin_model->select_with_where2('*', 'sell_id="' . $sell_id . '"', 'sell');

		$due_data['status'] = 2;
		$due_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$due_data['operator_id'] = $this->session->userdata['logged_in']['id'];

		$this->admin_model->update_function2('order_id="' . $val[0]['sell_code'] . '" and due_type=2', 'due_collection', $due_data);

		$d_data['old_due'] = $credit;
		$d_data['order_id'] = $val[0]['sell_code'];
		$d_data['total_amount'] = $credit;
		$d_data['supp_cust_id'] = $val[0]['cust_id'];																																																								// $d_data['unload_cost']=$this->input->post('unload_cost');
		$d_data['current_due'] = $this->input->post('due');
		$d_data['paid_due'] = $this->input->post('total_paid');

		// $d_data['discount_ref']=$this->input->post('discount_ref');;
		$d_data['due_type'] = 2;
		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$this->load->admin_model->insert('pharmacy_due_collection', $d_data);

		$this->cart->destroy();

		redirect('admin/sell_product_list', 'refresh');
	}




	public function sell_product_list($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Sell Product List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		// $data['all_sell_product_list']=$this->admin_model->select_join_where_five_sum_one_group_by('credit','net_total','debit','discount','vat','*,s.created_at','sell s','customer c','s.cust_id=c.id','date(s.created_at)="'.date('Y-m-d').'"','c.p_id');

		$data['all_sell_product_list'] = $this->admin_model->select_join_where_left('*,s.created_at', 'sell s', 'customer c', 's.cust_id=c.id', 'date(s.updated_at)="' . date('Y-m-d') . '"');

		$this->load->view('pharmacy/sell_product_list', $data);
	}


	public function sell_product_list_day_wise_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$dept_id = $this->input->post('dept_id');

		redirect('admin/sell_product_list_day_wise_report_next/' . $start_date . '/' . $end_date . '/' . $dept_id);
	}

	public function sell_product_list_day_wise_report_next($start_date = '', $end_date = '', $dept_id = '')
	{
		if ($dept_id == "all") {

			$data['all_sell_product_list'] = $this->admin_model->select_join_where_left('*,s.created_at', 'sell s', 'customer c', 's.cust_id=c.id', 'date(s.created_at) between "' . $start_date . '" and "' . $end_date . '"');
		} else {

			$data['all_sell_product_list'] = $this->admin_model->select_join_where_left('*,s.created_at', 'sell s', 'customer c', 's.cust_id=c.id', 'date(s.created_at) between "' . $start_date . '" and "' . $end_date . '" and s.patient_type ="' . $dept_id . '"');
		}



		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('pharmacy/sell_product_list_day_wise_report', $data);
	}



	public function purchase_product_list_day_wise_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		redirect('admin/purchase_product_list_day_wise_report_next/' . $start_date . '/' . $end_date);
	}

	public function purchase_product_list_day_wise_report_next($start_date = '', $end_date = '')
	{
		$data['all_sell_product_list'] = $this->admin_model->select_join_where('*,b.created_at', 'buy b', 'supplier s', 'b.supp_id=s.id', 'date(b.created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('pharmacy/purchase_product_list_day_wise_report', $data);
	}

	public function sell_product($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Sell Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['flag'] = "";

		$this->cart->destroy();

		$data['product_list'] = $this->admin_model->select_three_join_where_group_by('*,product.id,buy_details.created_at', 'product', 'unit_info', 'unit_info.id=product.p_unit_id', 'buy_details', 'product.id=buy_details.p_id', 'product.status=1 and date(buy_details.expire_date) >= "' . date('Y-m-d') . '" and buy_details.status=1 and buy_details.current_stock > 0', 'buy_details.p_id,buy_details.expire_date,');

		$data['customer_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'customer');

		$data['opd_customer_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'opd_patient_info');

		$data['ipd_customer_list'] = $this->admin_model->select_with_where2('*', 'status=1 and type != 3', 'ipd_patient_info');

		$data['director_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'director');

		$data['uhid_customer_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'uhid');


		$this->load->view('pharmacy/sell_product', $data);
	}


	public function stock()
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Stock Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$data['product_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'product');
		$this->load->view('pharmacy/stock', $data);
	}

	public function get_stock_chart()
	{
		$p_id = $this->input->post('p_id');

		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');


		if ($p_id == 0) {
			$data['stock_details'] = $this->admin_model->get_stock_report($from_date, $to_date);
			// "<pre>";print_r($data['stock_details']);die();
		} else {
			$data['stock_details'] = $this->admin_model->get_stock_report_individual_product($from_date, $to_date, $p_id);
		}

		$this->load->view('pharmacy/stock_ajax', $data);
	}

	public function add_sell_cart()
	{

		$value = $this->admin_model->select_with_where2('current_stock', 'status=1 and  p_id="' . $_POST["p_id"] . '" and expire_date="' . $_POST["expire_date"] . '"', 'buy_details');

		$data['flag'] = "";

		if ($value[0]['current_stock'] > 0) {

			foreach ($this->cart->contents() as $item) {
				if ($item['id'] == $_POST["p_id"] && $item['qty'] + 1 > $value[0]['current_stock']) {
					$data['flag'] = "No Stock";
					echo $this->load->view('pharmacy/sell_cart_details', $data);
					return;
				}

				if ($item['id'] == $_POST["p_id"] && $item['options']['expire_date'] != $_POST['expire_date']) {

					$data['flag'] = "Not possible";
					echo $this->load->view('pharmacy/sell_cart_details', $data);
					return;
				}
			}


			$value = array(
				"id"  => $_POST["p_id"],
				"name"  => $_POST["p_name"],
				"qty"  => $_POST["quantity"],
				"price"  => $_POST["p_price"],
				"options" => array("expire_date" => $_POST["expire_date"], "batch_id" => $_POST["batch_id"])
			);

			$val = $this->cart->insert($value);
			echo $this->load->view('pharmacy/sell_cart_details', $data);
		} else {
			$data['flag'] = "No Stock";
			echo $this->load->view('pharmacy/sell_cart_details', $data);
			return;
		}



		// "<pre>";print_r($this->cart->contents());die();



	}

	public function add_order_cart()
	{
		$value = array(
			"id"  => $_POST["p_id"],
			"name"  => $_POST["p_name"],
			"qty"  => 1,
			"price"  => 0,
			"options" => array("comp_name" => $_POST["comp_name"], "comp_id" => $_POST["comp_id"], "unit" => $_POST["unit"], "unit_id" => $_POST["unit_id"])
		);

		$val = $this->cart->insert($value);
		echo $this->load->view('pharmacy/order_cart_details');
	}

	public function remove_order_cart()
	{
		$row_id = $_POST["row_id"];
		$val = array(
			'rowid' => $row_id,
			'qty' => 0
		);
		$this->cart->update($val);
		echo $this->load->view('pharmacy/order_cart_details');
	}

	public function update_order_cart($value = '')
	{
		$row_id = $_POST["row_id"];
		$val = array(
			'rowid' => $row_id,
			'qty' => $_POST['qty']
		);

		$this->cart->update($val);
		echo $this->load->view('pharmacy/order_cart_details');
	}



	public function remove_sell_cart()
	{
		$data['flag'] = "";
		$row_id = $_POST["row_id"];
		$val = array(
			'rowid' => $row_id,
			'qty' => 0
		);
		$this->cart->update($val);
		echo $this->load->view('pharmacy/sell_cart_details', $data);
	}
	public function update_sell_cart()
	{
		$row_id = $_POST["row_id"];

		$value = $this->admin_model->select_with_where2('current_stock', 'status=1 and  p_id="' . $_POST["p_id"] . '" and expire_date="' . $_POST["expire_date"] . '"', 'buy_details');

		$data['flag'] = "";

		if ($value[0]['current_stock'] > 0) {

			foreach ($this->cart->contents() as $item) {
				if ($item['id'] == $_POST["p_id"] && $_POST['qty'] > $value[0]['current_stock']) {
					$data['flag'] = "No Stock";
					echo $this->load->view('pharmacy/sell_cart_details', $data);
					return;
				}
			}


			$value = array(

				'rowid' => $row_id,
				'qty' => $_POST['qty'],
				'price' => $_POST['price']
			);

			$this->cart->update($value);
			echo $this->load->view('pharmacy/sell_cart_details', $data);
		} else {
			$data['flag'] = "No Stock";
			echo $this->load->view('pharmacy/sell_cart_details', $data);
			return;
		}
	}

	public function get_all_mobile_no_other()
	{
		$data = $this->admin_model->select_with_where('mobile_no', 1, 'customer', 'status');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}
	public function get_product_details_ajax($value = '')
	{
		$data = $this->admin_model->select_join_where('*', 'product', 'unit_info', 'unit_info.id=product.p_unit_id', 'product.id="' . $_POST['p_id'] . '" AND product.status=1');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function get_all_supplier($value = '')
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1', 'supplier');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}


	public function get_specific_customer_details($value = '')
	{
		$data['cust_info'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $_POST['cust_id'] . '"', 'customer');

		$data['director_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'director');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function update_customer($value = '')
	{
		$data = array(
			'cust_name' => $_POST['cust_name'],
			'cust_phone' => $_POST['cust_phone'],
			'cust_address' => $_POST['cust_address'],
			// 'type' =>$_POST['type_id'],
			'ref_dir_id' => $_POST['dir_id'],
			'ref_dir_name' => $_POST['dir_name']
		);

		$this->admin_model->update_function('id', $_POST['cust_id'], 'customer', $data);
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function update_supplier($value = '')
	{
		$data = array(
			'supp_name' => $_POST['supp_name'],
			'supp_phone' => $_POST['supp_phone'],
			'supp_address' => $_POST['supp_address']
		);
		$this->admin_model->update_function('id', $_POST['supp_id'], 'supplier', $data);
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function update_unit($value = '')
	{
		$data = array(
			'unit' => $_POST['u_name'],

		);
		$this->admin_model->update_function('id', $_POST['u_id'], 'unit_info', $data);
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function update_rack($value = '')
	{
		$data = array(
			'rack_title' => $_POST['u_name'],

		);
		$this->admin_model->update_function('id', $_POST['u_id'], 'rack', $data);
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function update_pro($value = '')
	{
		$data = array(
			'p_category_name' => $_POST['u_name'],

		);
		$this->admin_model->update_function('id', $_POST['u_id'], 'product_category', $data);
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function update_gen($value = '')
	{
		$data = array(
			'generic_name' => $_POST['u_name'],

		);
		$this->admin_model->update_function('id', $_POST['u_id'], 'generic_info', $data);
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function update_com($value = '')
	{
		$data = array(
			'comp_name' => $_POST['u_name'],

		);
		$this->admin_model->update_function('id', $_POST['u_id'], 'company', $data);
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function update_dir($value = '')
	{
		$data = array(
			'director_name' => $_POST['u_name'],
			'designation' => $_POST['u_des'],

		);
		$this->admin_model->update_function('id', $_POST['u_id'], 'director', $data);
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}



	public function delete_customer($value = '')
	{
		$data = array('status' => 2);
		$this->admin_model->update_function('id', $_POST['cust_id'], 'customer', $data);
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function delete_pro($value = '')
	{
		$data = array('status' => 2);
		$this->admin_model->update_function('id', $_POST['u_id'], 'product_category', $data);
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function delete_supplier($value = '')
	{
		$data = array('status' => 2);
		$this->admin_model->update_function('id', $_POST['supp_id'], 'supplier', $data);
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}
	public function delete_unit($value = '')
	{
		$data = array('status' => 2);
		$this->admin_model->update_function('id', $_POST['u_id'], 'unit_info', $data);
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function delete_rack($value = '')
	{
		$data = array('status' => 0);
		$this->admin_model->update_function('id', $_POST['u_id'], 'rack', $data);
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}

	public function delete_gen($value = '')
	{
		$data = array('status' => 2);
		$this->admin_model->update_function('id', $_POST['u_id'], 'generic_info', $data);;
		echo json_encode($data);
	}
	public function delete_com($value = '')
	{
		$data = array('status' => 2);
		$this->admin_model->update_function('id', $_POST['u_id'], 'company', $data);;
		echo json_encode($data);
	}

	public function delete_dir($value = '')
	{
		$data = array('status' => 2);
		$this->admin_model->update_function('id', $_POST['u_id'], 'director', $data);;
		echo json_encode($data);
	}

	public function delete_product($value = '')
	{
		$data = array('status' => 2);
		$this->admin_model->update_function('id', $_POST['pro_id'], 'product', $data);

		echo json_encode($data);
	}
	public function get_specific_supplier_details($value = '')
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $_POST['supp_id'] . '"', 'supplier');;
		echo json_encode($data);
	}

	public function get_specific_unit_details($value = '')
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $_POST['u_id'] . '"', 'unit_info');

		echo json_encode($data);
	}

	public function get_specific_rack_details($value = '')
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $_POST['u_id'] . '"', 'rack');

		echo json_encode($data);
	}

	public function get_specific_pro_details($value = '')
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $_POST['u_id'] . '"', 'product_category');;
		echo json_encode($data);
	}

	public function get_specific_gen_details($value = '')
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $_POST['u_id'] . '"', 'generic_info');;
		echo json_encode($data);
	}

	public function get_specific_com_details($value = '')
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $_POST['u_id'] . '"', 'company');;
		echo json_encode($data);
	}

	public function get_specific_dir_details($value = '')
	{
		$data = $this->admin_model->select_with_where2('*', 'id="' . $_POST['u_id'] . '"', 'director');

		echo json_encode($data);
	}

	public function purchase_return($buy_code = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchase Return';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['buy_code'] = $buy_code;
		$data['all_purchase_code'] = $this->admin_model->select_with_where2('*', 'status=1 and cost_total <= debit', 'buy');

		$this->load->view('pharmacy/return_purchage', $data);
	}

	public function sales_return($sell_code = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Sales Return';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$data['sell_code'] = $sell_code;

		$data['all_sale_code'] = $this->admin_model->select_with_where2('*', 'status=1 and net_total <= debit', 'sell');;
		$this->load->view('pharmacy/sales_return', $data);
	}


	public function stock_details_pdf($from_date, $to_date, $p_id)
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchage Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		if ($p_id == 0) {
			$data['stock_details'] = $this->admin_model->get_stock_report($from_date, $to_date);
		} else {
			$data['stock_details'] = $this->admin_model->get_stock_report_individual_product($from_date, $to_date, $p_id);
		}


		$this->load->view('pharmacy/stock_details_pdf', $data);
	}

	public function product_wise_stock_details_pdf($p_id)
	{
		$data['active'] = 'product_wise_stock_details_pdf';
		$data['page_title'] = 'Product Stock';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		if ($p_id == 0) {
			$data['stock_details'] = $this->admin_model->select_join_where2_group_by('*', 'product p', 'buy_details s', 'p.id=s.p_id', 'p.status=1 and s.status=1', 's.p_id,s.batch_id,s.expire_date');;
		} else {
			$data['stock_details'] = $this->admin_model->select_join_where2_group_by('*', 'product p', 'buy_details s', 'p.id=s.p_id', 'p.status=1 and s.status=1 and p.id="' . $p_id . '"', 's.p_id,s.batch_id,s.expire_date');;
		}

		$this->load->view('pharmacy/product_wise_stock_pdf', $data);
	}

	public function company_wise_stock_details_pdf($c_id)
	{
		$data['active'] = 'company_wise_stock_details_pdf';
		$data['page_title'] = 'Compnay Wise Stock';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		if ($c_id == 0) {
			$data['stock_details'] = $this->admin_model->select_three_join_where_group_by('*,p.created_at', 'company c', 'product p', 'p.p_company_id=c.id', 'buy_details s', 'p.id=s.p_id', 'p.status=1 and s.status=1', 's.p_id,s.batch_id,s.expire_date');;
		} else {
			$data['stock_details'] = $this->admin_model->select_three_join_where_group_by('*,p.created_at', 'company c', 'product p', 'p.p_company_id=c.id', 'buy_details s', 'p.id=s.p_id', 'p.status=1 and s.status=1 and p.p_company_id="' . $c_id . '"', 's.p_id,s.batch_id,s.expire_date');
		}


		$this->load->view('pharmacy/company_wise_stock_pdf', $data);
	}

	public function product_stock($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Product Wise Stock';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['product_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'product');


		$this->load->view('pharmacy/product_wise_stock', $data);
	}

	public function company_stock($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Company Wise Stock';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['company_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'company');




		$this->load->view('pharmacy/company_wise_stock', $data);
	}

	public function get_product_stock($value = '')
	{
		$p_id = $_POST["p_id"];
		if ($p_id == 0) {
			$data['stock_details'] = $this->admin_model->select_join_where2_group_by('*', 'product p', 'buy_details s', 'p.id=s.p_id', 'p.status=1 and s.status=1', 's.p_id,s.batch_id,s.expire_date');;
		} else {
			$data['stock_details'] = $this->admin_model->select_join_where2_group_by('*', 'product p', 'buy_details s', 'p.id=s.p_id', 'p.status=1 and  s.status=1 and p.id="' . $p_id . '"', 's.p_id,s.expire_date');;
		}

		$this->load->view('pharmacy/product_wise_stock_ajax', $data);
	}

	public function get_company_stock($value = '')
	{
		$c_id = $_POST["c_id"];
		if ($c_id == 0) {
			$data['stock_details'] = $this->admin_model->select_three_join_where_group_by('*,p.created_at', 'company c', 'product p', 'p.p_company_id=c.id', 'buy_details s', 'p.id=s.p_id', 'p.status=1 and s.status=1', 's.p_id,s.batch_id,s.expire_date');;
		} else {
			$data['stock_details'] = $this->admin_model->select_three_join_where_group_by('*,p.created_at', 'company c', 'product p', 'p.p_company_id=c.id', 'buy_details s', 'p.id=s.p_id', 'p.status=1 and s.status=1 and p.p_company_id="' . $_POST['c_id'] . '"', 's.p_id,s.batch_id,s.expire_date');
		}

		$this->load->view('pharmacy/company_wise_stock_ajax', $data);
	}

	public function outstanding_supplier($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Due Supplier';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		// $data['supplier_due']=$this->admin_model->select_join_where_order('*,b.created_at','supplier s','buy b','b.supp_id=s.id','s.status=1 AND b.credit > b.debit','b.buy_id','desc'); 

		$this->load->view('pharmacy/outstanding_supplier', $data);
	}


	public function outstanding_supplier_dt($value = '')
	{
		$select_column = '*,b.created_at';
		$condition = "s.status=1 AND b.credit > b.debit";

		$order_column = array('buy_id', 'supp_name', 'bill_no', 'buy_code', 'b.created_at', 'credit');

		$search_column = array('supp_name', 'bill_no', 'buy_code', 'b.created_at', 'credit');

		$fetch_data = $this->admin_model->make_datatables_two_table_join('buy b', $condition, $select_column, $order_column, $search_column, 'supplier s', 'b.supp_id=s.id', 'buy_id');
		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->bill_no;
			$sub_array[] = $row->buy_code;
			$sub_array[] = date("d-m-Y h:i a", strtotime($row->created_at));
			$sub_array[] = $row->supp_name;
			$sub_array[] = $row->credit;
			$sub_array[] = $row->unload_cost;
			$sub_array[] = $row->cost_total;
			$sub_array[] = $row->debit;
			$sub_array[] = $row->cost_total - $row->debit;

			$sub_array[] = '<a href="admin/purchage_product_details/' . $row->buy_id . '" type="button" class="btn btn-success btn-xs supplier_edit_button">View Details</a>';
			$sub_array[] = $row->operator_name;

			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('buy b', $condition, $select_column, 'supplier s', 'b.supp_id=s.id'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
				'buy b',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'supplier s',
				'b.supp_id=s.id',
				'buy_id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}



	public function outstanding_customer($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Due Customer';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		// $data['customer_due']=$this->admin_model->select_join_where_order('*,s.created_at','customer c','sell s','s.cust_id=c.id','c.status=1 AND s.credit > s.debit','s.sell_id','desc'); 
		$this->load->view('pharmacy/outstanding_customer', $data);
	}


	public function outstanding_customer_dt($value = '')
	{
		$select_column = '*,s.created_at';
		$condition = "c.status=1 AND s.credit > s.debit";

		$order_column = array('sell_id', 'bill_no', 'sell_code', 's.created_at', 'cust_name', 'credit');

		$search_column = array('sell_id', 'bill_no', 'sell_code', 's.created_at', 'cust_name', 'credit');

		$fetch_data = $this->admin_model->make_datatables_two_table_join('sell s', $condition, $select_column, $order_column, $search_column, 'customer c', 's.cust_id=c.id', 'sell_id');
		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;

			$sub_array[] = $row->sell_code;
			$sub_array[] = date("d-m-Y h:i a", strtotime($row->created_at));
			$sub_array[] = $row->cust_name;
			$sub_array[] = $row->credit;
			$sub_array[] = $row->discount;
			$sub_array[] = $row->delivery_cost;
			$sub_array[] = $row->net_total;
			$sub_array[] = $row->debit;
			$sub_array[] = $row->net_total - $row->debit;

			$sub_array[] = '<a href="admin/sell_product_details/' . $row->sell_id . '" type="button" class="btn btn-success btn-xs supplier_edit_button">View Details</a>';

			$sub_array[] = $row->operator_name;


			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('sell s', $condition, $select_column, 'customer c', 's.cust_id=c.id'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
				'sell s',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'customer c',
				's.cust_id=c.id',
				'sell_id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	public function get_all_purchage_bill($value = '')
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1 and cost_total <= debit', 'buy');

		echo json_encode($data);
	}

	public function get_all_sale_bill($value = '')
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1', 'sell');;
		echo json_encode($data);
	}

	public function get_all_sale_bill_full_paid($value = '')
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1 and net_total=debit', 'sell');;
		echo json_encode($data);
	}

	public function get_purchage_info_by_bill($value = '')
	{

		$data['buy_details'] = $this->admin_model->select_join_five_table2('*,b.created_at,b.buy_id', 'buy b', 'supplier s', 'buy_details d', 'product p', 'unit_info u', 'b.supp_id=s.id', 'b.buy_id=d.buy_id', 'p.id=d.p_id', 'u.id=p.p_unit_id', 'b.status=1 and b.buy_code="' . $_POST['buy_code'] . '"');

		$last_ret_id = $this->admin_model->get_last_row2('return_product', 'buy_sell_code="' . $_POST['buy_code'] . '" AND type=1');

		if ($last_ret_id != null) {
			$data['return_info'] = $this->admin_model->select_join_where('*', 'return_product r', 'return_product_det d', 'r.id=d.ret_id', 'r.id="' . $last_ret_id[0]['id'] . '" and r.type=1');

			$data['total_charge'] = $this->admin_model->get_charge_sum_where('charge', 'return_product', 'buy_sell_code="' . $data['buy_details'][0]['buy_code'] . '" and type=1');
		} else {
			$data['return_info'] = null;
		}



		if ($data['buy_details'] != null) {
			echo  $this->load->view('pharmacy/return_purchage_details', $data);
		}
	}

	public function get_sale_info_by_bill($value = '')
	{
		// $data[]=$this->admin_model->select_join_where('*,buy.created_at','buy','supplier','buy.buy_id=supplier.id','buy.bill_no='.$_POST['bill_no']); 
		$data['sell_details'] = $this->admin_model->select_join_five_table2('*,s.created_at,s.sell_id', 'sell s', 'customer c', 'sell_details d', 'product p', 'unit_info u', 's.cust_id=c.id', 's.sell_id=d.sell_id', 'p.id=d.p_id', 'u.id=p.p_unit_id', 's.sell_code="' . $_POST['sell_code'] . '"');

		$last_ret_id = $this->admin_model->get_last_row2('return_product', 'buy_sell_code="' . $_POST['sell_code'] . '" AND type=2');

		if ($last_ret_id != null) {
			$data['return_info'] = $this->admin_model->select_join_where('*', 'return_product r', 'return_product_det d', 'r.id=d.ret_id', 'r.id="' . $last_ret_id[0]['id'] . '" and r.type=2');

			$data['total_charge'] = $this->admin_model->get_charge_sum_where('charge', 'return_product', 'buy_sell_code="' . $data['sell_details'][0]['sell_code'] . '" and type=2');
		} else {
			$data['return_info'] = null;
		}


		if ($data['sell_details'] != null) {
			echo  $this->load->view('pharmacy/sales_return_details', $data);
		}
	}


	public function insert_ret_purchase_data($value = '')
	{
		$buy_id = $this->input->post("buy_id");
		$ret_id = $this->input->post("ret_id");
		$prev_ret_qty = $this->input->post("prev_ret_qty");

		// if updates delete all data

		$buy_qty = $this->input->post("buy_qty");

		// delete from return table

		$this->admin_model->delete_function_cond('return_product', 'type=1 and sell_buy_id = "' . $buy_id . '"');

		$this->admin_model->delete_function_cond('return_product_det', 'type=1 and ret_id = "' . $ret_id . '"');

		//delete from stock table

		$this->admin_model->delete_function_cond('stock', 'type=3 and sell_buy_id = "' . $buy_id . '"');

		$p_id = $this->input->post("p_id");
		// "<pre>";print_r($p_id);
		$up_qty = $this->input->post("up_qty");
		$expire_date = $this->input->post("expire_date");
		// "<pre>";print_r($up_qty);die();


		$buy_price = $this->input->post("buy_price");

		// "<pre>";print_r($buy_price);

		for ($i = 0; $i < count($p_id); $i++) {

			$current_qty = $this->admin_model->select_with_where2('current_stock', 'p_id="' . $p_id[$i] . '" and status=1 and expire_date="' . $expire_date[$i] . '"', 'buy_details');

			// "<pre>";print_r($current_qty);print_r($prev_ret_qty[$i]);print_r($up_qty[$i]);die();


			$data_update['current_stock'] = $prev_ret_qty[$i] + $current_qty[0]['current_stock'] - $up_qty[$i];



			$this->admin_model->update_function2('p_id="' . $p_id[$i] . '"  and expire_date="' . $expire_date[$i] . '"', 'buy_details', $data_update);
		}

		$value1['is_return'] = 2;

		$this->load->admin_model->update_function2('buy_id="' . $buy_id . '"', 'buy', $value1);


		$buy_info = $this->load->admin_model->select_with_where2('*', 'buy_id="' . $buy_id . '"', 'buy');

		$buy_info_total_qty = $this->load->admin_model->get_charge_sum_where('buy_qty', 'buy_details', 'buy_id="' . $buy_id . '"');

		$last_ret_id = $this->admin_model->get_last_row2('return_product', 'buy_sell_code="' . $buy_info[0]['buy_code'] . '" AND type=1 and status=1');

		$value2['status'] = 2;

		$this->load->admin_model->update_function2('buy_sell_code="' . $buy_info[0]['buy_code'] . '" and type=1', 'return_product', $value2);


		$total_amount = 0;
		$total_qty = 0;

		for ($i = 0; $i < count($up_qty); $i++) {
			$total_amount += $up_qty[$i] * $buy_price[$i];
			$total_qty += $up_qty[$i];
		}


		$ret_data['total_amount'] = $total_amount;

		// if($buy_info[0]['cost_total'] <= $buy_info[0]['debit'])
		// {
		// 	$total_ret_paid=0;
		// }

		// else if($buy_info[0]['cost_total']+$this->input->post('charge')-$total_amount > $buy_info[0]['debit'])
		// {
		// 	$total_ret_paid=$buy_info[0]['debit']-$buy_info[0]['credit']-;
		// }
		// else
		// {
		// 	$total_ret_paid=0;
		// }



		// $ret_data['total_paid']=$total_ret_paid;
		$ret_data['current_total_amount'] = $total_amount;
		$ret_data['current_total_charge'] = $this->input->post('charge');
		$ret_data['supp_cust_id'] = $buy_info[0]['supp_id'];
		$ret_data['buy_sell_code'] = $buy_info[0]['buy_code'];
		$ret_data['sell_buy_id'] = $buy_id;
		$ret_data['type'] = 1;
		$ret_data['charge'] = $this->input->post('charge');
		// $ret_data['note']=$this->input->post('note');
		$ret_data['created_at'] = date('Y-m-d H:i:s');


		$ret_id = $this->admin_model->insert_ret('return_product', $ret_data);

		// $up_qty=$this->input->post('up_qty');

		for ($i = 0; $i < count($p_id); $i++) {

			// if($up_qty[$i]!=0)
			// {

			$bd_data['ret_id'] = $ret_id;
			$bd_data['p_id'] = $p_id[$i];

			if ($last_ret_id != null) {

				$last_ret_qty = $this->load->admin_model->select_with_where2('*', 'p_id="' . $p_id[$i] . '" AND ret_id="' . $last_ret_id[0]['id'] . '"', 'return_product_det');

				$bd_data['total_qty'] = $up_qty[$i] + $last_ret_qty[0]['total_qty'];
			} else {
				$bd_data['total_qty'] = $up_qty[$i];
			}


			$bd_data['ret_qty'] = $up_qty[$i];
			$bd_data['price'] = $buy_price[$i];
			$bd_data['type'] = 1;
			$bd_data['created_at'] = date('Y-m-d H:i:s');

			$this->admin_model->insert('return_product_det', $bd_data);

			// }
		}

		for ($i = 0; $i < count($p_id); $i++) {

			if ($up_qty[$i] != 0) {
				$stock['sell_buy_id'] = $buy_id;
				$stock['p_id'] = $p_id[$i];

				$get_last_val = $this->admin_model->get_last_row('stock', 'p_id="' . $p_id[$i] . '" and expire_date="' . $expire_date[$i] . '"');

				$stock['st_open'] = 0;
				if (count($get_last_val) > 0) {
					$stock['st_open'] = $get_last_val[0]['st_close'];
				}

				$stock['st_out'] = $up_qty[$i];
				$stock['st_in'] = 0;
				$stock['st_close'] = $stock['st_open'] - $stock['st_out'];
				$stock['type'] = 3;
				$stock['expire_date'] = $expire_date[$i];
				$stock['created_at'] = date('Y-m-d H:i:s');

				$this->admin_model->insert('stock', $stock);
			}
		}

		redirect("admin/purchage_product_details/" . $buy_id);
	}


	public function insert_ret_sale_data($value = '')
	{

		$p_id = $this->input->post("p_id");

		$up_qty = $this->input->post("up_qty");

		$sell_id = $this->input->post("sell_id");

		$sell_price = $this->input->post("sell_price");

		$prev_ret_qty = $this->input->post("prev_ret_qty");

		$expire_date = $this->input->post("expire_date");


		// if updates delete all data

		$buy_qty = $this->input->post("buy_qty");

		// delete from return table

		$this->admin_model->delete_function_cond('return_product', 'type=2 and sell_buy_id = "' . $sell_id . '"');

		$this->admin_model->delete_function_cond('return_product_det', 'type=2 and ret_id = "' . $ret_id . '"');

		//delete from stock table

		$this->admin_model->delete_function_cond('stock', 'type=4 and sell_buy_id = "' . $sell_id . '"');

		for ($i = 0; $i < count($p_id); $i++) {

			$current_qty = $this->admin_model->select_with_where2('current_stock', 'p_id="' . $p_id[$i] . '" and status=1 and expire_date="' . $expire_date[$i] . '"', 'buy_details');

			// "<pre>";print_r($current_qty);print_r($prev_ret_qty[$i]);print_r($up_qty[$i]);die();


			$data_update['current_stock'] = $prev_ret_qty[$i] + $current_qty[0]['current_stock'] + $up_qty[$i];



			$this->admin_model->update_function2('p_id="' . $p_id[$i] . '"  and expire_date="' . $expire_date[$i] . '"', 'buy_details', $data_update);
		}

		$value1['is_return'] = 2;

		$this->load->admin_model->update_function2('sell_id="' . $sell_id . '"', 'sell', $value1);



		$sell_info = $this->load->admin_model->select_with_where2('*', 'sell_id="' . $sell_id . '"', 'sell');

		$sell_info_total_qty = $this->load->admin_model->get_charge_sum_where('sell_qty', 'sell_details', 'sell_id="' . $sell_id . '"');

		$last_ret_id = $this->admin_model->get_last_row2('return_product', 'buy_sell_code="' . $sell_info[0]['sell_code'] . '" and status=1 and type=2');

		$value2['status'] = 2;

		$this->load->admin_model->update_function2('buy_sell_code="' . $sell_info[0]['sell_code'] . '" and type=2', 'return_product', $value2);

		$total_amount = 0;
		$total_qty = 0;

		for ($i = 0; $i < count($up_qty); $i++) {
			$total_amount += $up_qty[$i] * $sell_price[$i];
			$total_qty += $up_qty[$i];
		}

		$per_discount = $sell_info[0]['discount'] / $sell_info_total_qty[0]['sell_qty'];
		$per_vat = $sell_info[0]['vat'] / $sell_info_total_qty[0]['sell_qty'];

		$total_ret_discount = $per_discount * $total_qty;
		$total_ret_vat = $per_vat * $total_qty;

		$ret_data['current_total_amount'] = $total_amount;
		$ret_data['current_total_charge'] = $this->input->post('charge');
		$ret_data['current_total_vat'] = round($total_ret_vat);
		$ret_data['current_total_discount'] = round($total_ret_discount);

		$ret_data['total_amount'] = $total_amount;

		$ret_data['total_vat'] = round($total_ret_vat);
		$ret_data['total_discount'] = round($total_ret_discount);

		$ret_data['supp_cust_id'] = $sell_info[0]['cust_id'];
		$ret_data['buy_sell_code'] = $sell_info[0]['sell_code'];
		$ret_data['sell_buy_id'] = $sell_id;
		$ret_data['type'] = 2;
		$ret_data['charge'] = $this->input->post('charge');
		$ret_data['created_at'] = date('Y-m-d H:i:s');


		$ret_id = $this->admin_model->insert_ret('return_product', $ret_data);

		// $up_qty=$this->input->post('up_qty');

		// "<pre>";print_r($up_qty);die();


		for ($i = 0; $i < count($up_qty); $i++) {

			if ($up_qty != 0) {

				$bd_data['ret_id'] = $ret_id;
				$bd_data['p_id'] = $p_id[$i];



				if ($last_ret_id != null) {

					$last_ret_qty = $this->load->admin_model->select_with_where2('*', 'p_id="' . $p_id[$i] . '" AND ret_id="' . $last_ret_id[0]['id'] . '"', 'return_product_det');

					$bd_data['total_qty'] = $up_qty[$i] + $last_ret_qty[0]['total_qty'];
				} else {
					$bd_data['total_qty'] = $up_qty[$i];
				}


				$bd_data['ret_qty'] = $up_qty[$i];
				$bd_data['price'] = $sell_price[$i];
				$bd_data['type'] = 2;
				$bd_data['created_at'] = date('Y-m-d H:i:s');

				$this->admin_model->insert('return_product_det', $bd_data);
			}
		}

		for ($i = 0; $i < count($p_id); $i++) {

			if ($up_qty[$i] != 0) {
				$stock['sell_buy_id'] = $sell_id;
				$stock['p_id'] = $p_id[$i];

				$get_last_val = $this->admin_model->get_last_row('stock', 'p_id="' . $p_id[$i] . '" and expire_date="' . $expire_date[$i] . '"');

				$stock['st_open'] = 0;
				if (count($get_last_val) > 0) {
					$stock['st_open'] = $get_last_val[0]['st_close'];
				}

				$stock['st_out'] = 0;
				$stock['st_in'] = $up_qty[$i];
				$stock['st_close'] = $stock['st_open'] + $stock['st_in'];
				$stock['type'] = 4;
				$stock['created_at'] = date('Y-m-d H:i:s');

				$this->admin_model->insert('stock', $stock);
			}
		}

		redirect("admin/sell_product_details/" . $sell_id);
	}

	// update_return_info Sale

	public function update_return_info($sell_code = '', $flag = '')
	{
		$last_ret_id = $this->admin_model->get_last_row2('return_product', 'buy_sell_code="' . $sell_code . '" and status=1 and type=2');

		$cust_info = $this->load->admin_model->select_with_where2('*', 'id="' . $last_ret_id[0]['supp_cust_id'] . '"', 'customer');

		if (isset($_POST['refund_btn'])) {

			$value2['status'] = 2;

			$this->load->admin_model->update_function2('buy_sell_code="' . $sell_code . '"', 'return_product', $value2);

			$ret_data['current_total_amount'] = $last_ret_id[0]['current_total_amount'];
			$ret_data['current_total_charge'] = $last_ret_id[0]['current_total_charge'];
			$ret_data['current_total_vat'] = $last_ret_id[0]['current_total_vat'];
			$ret_data['current_total_discount'] = $last_ret_id[0]['current_total_discount'];
			$ret_data['current_total_paid'] = $this->input->post('update_return') + $last_ret_id[0]['current_total_paid'];


			$ret_data['total_amount'] = 0;
			$ret_data['total_paid'] = $this->input->post('update_return');
			$ret_data['total_vat'] = 0;
			$ret_data['total_discount'] = 0;

			$ret_data['supp_cust_id'] = $last_ret_id[0]['supp_cust_id'];
			$ret_data['buy_sell_code'] = $sell_code;
			$ret_data['sell_buy_id'] = $last_ret_id[0]['sell_buy_id'];
			$ret_data['type'] = 2;
			$ret_data['charge'] = 0;
			$ret_data['created_at'] = date('Y-m-d H:i:s');


			$value3['ret_id'] = $this->admin_model->insert_ret('return_product', $ret_data);

			$this->load->admin_model->update_function2('ret_id="' . $last_ret_id[0]['id'] . '"', 'return_product_det', $value3);

			if ($flag == 'bill_info') {
				redirect('admin/billing_details_for_one_customer/' . $last_ret_id[0]['supp_cust_id'] . '/' . $cust_info[0]['type']);
			} else {

				redirect('admin/sell_product_details/' . $last_ret_id[0]['sell_buy_id']);
			}
		} else {
			$this->update_cust_payment($last_ret_id[0]['sell_buy_id'], $last_ret_id[0]['supp_cust_id'], $flag);
		}
	}

	public function update_return_info_purchase($purchase_code = '')
	{
		$last_ret_id = $this->admin_model->get_last_row2('return_product', 'buy_sell_code="' . $purchase_code . '" and status=1 and type=1');

		if (isset($_POST['refund_btn'])) {

			$value2['status'] = 2;

			$this->load->admin_model->update_function2('buy_sell_code="' . $purchase_code . '"', 'return_product', $value2);


			$ret_data['current_total_amount'] = $last_ret_id[0]['total_amount'];
			$ret_data['current_total_charge'] = $last_ret_id[0]['charge'];
			$ret_data['current_total_paid'] = $last_ret_id[0]['total_paid'] + $this->input->post('update_return');

			$ret_data['total_paid'] = $this->input->post('update_return');
			$ret_data['supp_cust_id'] = $last_ret_id[0]['supp_cust_id'];
			$ret_data['buy_sell_code'] = $purchase_code;
			$ret_data['sell_buy_id'] = $last_ret_id[0]['sell_buy_id'];
			$ret_data['type'] = 1;
			$ret_data['charge'] = 0;
			$ret_data['created_at'] = date('Y-m-d H:i:s');

			// "<pre>";print_r($ret_data['total_paid']);die();


			$value3['ret_id'] = $this->admin_model->insert_ret('return_product', $ret_data);

			$this->load->admin_model->update_function2('ret_id="' . $last_ret_id[0]['id'] . '"', 'return_product_det', $value3);

			redirect('admin/purchage_product_details/' . $last_ret_id[0]['sell_buy_id']);
		} else {
			$this->update_supp_payment($last_ret_id[0]['sell_buy_id'], $last_ret_id[0]['supp_cust_id']);
		}
	}

	public function add_rack($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Add Rack';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data["rack_all_info"] = $this->admin_model->select_with_where2('*', 'status=1', 'rack');

		$this->load->view('pharmacy/add_rack', $data);
	}



	public function add_unit($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Add Unit';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data["unit_all_info"] = $this->admin_model->select_with_where2('*', 'status=1', 'unit_info');

		$this->load->view('pharmacy/add_unit', $data);
	}

	public function insert_unit($value = '')
	{

		$val = array('unit' => $this->input->post("unit_name"));
		$this->admin_model->insert("unit_info", $val);

		redirect('admin/add_unit');;
	}

	public function insert_rack($value = '')
	{

		$val = array('rack_title' => $this->input->post("rack_name"));
		$this->admin_model->insert("rack", $val);

		redirect('admin/add_rack');;
	}

	public function add_gen($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchage Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		// $data["all_generic"]=$this->admin_model->select_with_where2('*','status=1','generic_info'); 

		$this->load->view('pharmacy/add_generic_name', $data);
	}

	public function add_gen_dt($value = '')
	{
		$select_column = "*,id";
		$order_column = array('id', 'generic_name');
		$search_column = array('id', 'generic_name');

		$condition = 'status=1';

		$fetch_data = $this->admin_model->make_datatables('generic_info', $condition, $select_column, $order_column, $search_column, 'id');
		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = '<span class="badge badge-secondary">' . $row->generic_name . '</span>';


			$sub_array[] = '<button type="button" id="gen_edit_' . $row->id . '" class="btn btn-success btn-xs up_gen_edit_button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>

	 		<button type="button" id="gen_delete_' . $row->id . '" class="btn btn-danger btn-xs up_gen_delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
			$data[] = $sub_array;
			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data('*', 'generic_info', $condition),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data(
				'generic_info',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	public function insert_gen($value = '')
	{

		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchage Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$val = array('generic_name' => $this->input->post("gen_name"));
		$this->admin_model->insert("generic_info", $val);

		redirect('admin/add_gen');
	}

	public function add_com($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchage Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data["all_com"] = $this->admin_model->select_with_where2('*', 'status=1', 'company');

		$this->load->view('pharmacy/add_company_name', $data);
	}

	public function add_com_dt($value = '')
	{
		$select_column = "*,id";
		$order_column = array('id', 'comp_name');
		$search_column = array('id', 'comp_name');

		$condition = 'status=1';

		$fetch_data = $this->admin_model->make_datatables('company', $condition, $select_column, $order_column, $search_column, 'id');
		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = '<span class="badge badge-secondary">' . $row->comp_name . '</span>';


			$sub_array[] = '<button type="button" id="com_edit_' . $row->id . '" class="btn btn-success btn-xs up_com_edit_button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>

	 		<button type="button" id="com_delete_' . $row->id . '" class="btn btn-danger btn-xs up_com_delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
			$data[] = $sub_array;
			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data('*', 'company', $condition),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data(
				'company',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}


	public function add_dir($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchage Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data["all_dir"] = $this->admin_model->select_with_where2('*', 'status=1', 'director');

		$this->load->view('pharmacy/add_director', $data);
	}

	public function insert_com($value = '')
	{

		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchage Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$val = array('comp_name' => $this->input->post("com_name"));
		$this->admin_model->insert("company", $val);

		redirect('admin/add_com');
	}


	public function insert_dir($value = '')
	{

		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchage Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$val = array(
			'director_name' => $this->input->post("dir_name"),
			'designation' => $this->input->post("des"),
			'status' => 1,
		);
		$this->admin_model->insert("director", $val);

		redirect('admin/add_dir');
	}

	public function add_pro_cat($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchage Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data["all_pro_cat"] = $this->admin_model->select_with_where2('*', 'status=1', 'product_category');

		$this->load->view('pharmacy/add_product_category', $data);
	}

	public function insert_pro_cat($value = '')
	{

		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchage Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$val = array('p_category_name' => $this->input->post("pro_name"));
		$this->admin_model->insert("product_category", $val);

		redirect('admin/add_pro_cat');
	}

	public function update_supp_payment($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Purchage Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$buy_id = $this->uri->segment(3);
		$supp_id = $this->uri->segment(4);

		$val = $this->admin_model->select_with_where2('*', 'buy_id="' . $buy_id . '"', 'buy');

		$debit = $val[0]['debit'] + $this->input->post('update_payment_supp');


		$val1 = array('debit' => $debit);
		$this->load->admin_model->update_function('buy_id', $buy_id, 'buy', $val1);

		$d_data['old_due'] = $this->input->post('due');
		$d_data['order_id'] = $val[0]['buy_code'];
		$d_data['total_amount'] = $val[0]['credit'];
		$d_data['supp_cust_id'] = $val[0]['supp_id'];
		// $d_data['unload_cost']=$this->input->post('unload_cost');
		$d_data['current_due'] = $this->input->post('due') - $this->input->post('update_payment_supp');
		$d_data['paid_due'] = $this->input->post('update_payment_supp');;
		$d_data['due_type'] = 1;
		$d_data['created_at'] = date("Y-m-d H:i:s");

		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];

		$this->load->admin_model->insert('pharmacy_due_collection', $d_data);

		$insert_pay = array(
			'payment_type' => 1,
			'sell_buy_id' => $buy_id,
			'cust_supp_id' => $supp_id,
			'amount' => $this->input->post('update_payment_supp'),
			'type' => 1,
			'user_id' => $this->session->userdata['logged_in']['id'],
			'created_at' => date('Y-m-d H:i:s')
		);

		$this->load->admin_model->insert('payment', $insert_pay);

		redirect("admin/purchage_product_details/" . $buy_id, 'refresh');
	}

	public function update_cust_payment($sell_id = '', $cust_id = '', $flag = '')
	{


		$sell_id = $sell_id;
		$cust_id = $cust_id;

		$val = $this->admin_model->select_with_where2('*', 'sell_id="' . $sell_id . '"', 'sell');

		$cust_type = $this->admin_model->select_with_where2('*', 'id="' . $cust_id . '"', 'customer');

		$debit = $val[0]['debit'] + $this->input->post('update_payment_cust');


		$val1 = array('debit' => $debit);
		$this->load->admin_model->update_function('sell_id', $sell_id, 'sell', $val1);

		$d_data['is_due_collection'] = 0;

		if (date("Y-m-d", strtotime($val[0]['created_at'])) != date('Y-m-d')) {
			$d_data['is_due_collection'] = 1;
		}


		$d_data['old_due'] = $this->input->post('due');
		$d_data['order_id'] = $val[0]['sell_code'];
		$d_data['total_amount'] = $val[0]['credit'];;
		$d_data['supp_cust_id'] = $val[0]['cust_id'];;

		$d_data['current_due'] = $this->input->post('due') - $this->input->post('update_payment_cust');
		$d_data['paid_due'] = $this->input->post('update_payment_cust');;
		$d_data['due_type'] = 2;
		$d_data['created_at'] = date('Y-m-d H:i:s');

		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$this->load->admin_model->insert('pharmacy_due_collection', $d_data);

		$insert_pay = array(
			'payment_type' => 1,
			'sell_buy_id' => $sell_id,
			'cust_supp_id' => $cust_id,
			'amount' => $this->input->post('update_payment_cust'),
			'type' => 2,
			'user_id' => $this->session->userdata['logged_in']['id'],
			'created_at' => date('Y-m-d H:i:s')
		);

		$this->load->admin_model->insert('payment', $insert_pay);

		if ($flag == "bill_info") {

			redirect("admin/billing_details_for_one_customer/" . $cust_id . "/" . $cust_type[0]['type'], 'refresh');
		} else {
			redirect("admin/sell_product_details/" . $sell_id, 'refresh');
		}
	}

	public function full_paid_supp($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Full Paid Supplier';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		// $data['supplier_due']=$this->admin_model->select_join_where_order('*,b.created_at','supplier s','buy b','b.supp_id=s.id','s.status=1 AND b.credit <= b.debit','b.buy_id','desc'); 
		$this->load->view('pharmacy/full_paid_supplier', $data);
	}

	public function full_paid_supp_dt($value = '')
	{
		$select_column = '*,b.created_at';
		$condition = "s.status=1 AND b.credit <= b.debit";

		$order_column = array('buy_id', 'supp_name', 'bill_no', 'buy_code', 'b.created_at', 'credit');

		$search_column = array('supp_name', 'bill_no', 'buy_code', 'b.created_at', 'credit');

		$fetch_data = $this->admin_model->make_datatables_two_table_join('buy b', $condition, $select_column, $order_column, $search_column, 'supplier s', 'b.supp_id=s.id', 'buy_id');
		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->bill_no;
			$sub_array[] = $row->buy_code;
			$sub_array[] = date("d-m-Y h:i a", strtotime($row->created_at));
			$sub_array[] = $row->supp_name;
			$sub_array[] = $row->credit;
			$sub_array[] = $row->unload_cost;
			$sub_array[] = $row->cost_total;
			$sub_array[] = $row->debit;
			$sub_array[] = $row->cost_total - $row->debit;

			$sub_array[] = '<a href="admin/purchage_product_details/' . $row->buy_id . '" type="button" class="btn btn-success btn-xs supplier_edit_button">View Details</a>';
			$sub_array[] = $row->operator_name;


			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('buy b', $condition, $select_column, 'supplier s', 'b.supp_id=s.id'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
				'buy b',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'supplier s',
				'b.supp_id=s.id',
				'buy_id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}


	public function full_paid_cust($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Full Paid Customer';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		// $data['customer_due']=$this->admin_model->select_join_where('*,s.created_at','customer c','sell s','s.cust_id=c.id','c.status=1 AND s.credit <= s.debit','s.sell_id','desc'); 
		$this->load->view('pharmacy/full_paid_customer', $data);
	}

	public function full_paid_cust_dt($value = '')
	{
		$select_column = '*,s.created_at';
		$condition = "c.status=1 AND s.credit <= s.debit";

		$order_column = array('sell_id', 'bill_no', 'sell_code', 's.created_at', 'cust_name', 'credit');

		$search_column = array('sell_id', 'bill_no', 'sell_code', 's.created_at', 'cust_name', 'credit');

		$fetch_data = $this->admin_model->make_datatables_two_table_join('sell s', $condition, $select_column, $order_column, $search_column, 'customer c', 's.cust_id=c.id', 'sell_id');
		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;

			$sub_array[] = $row->sell_code;
			$sub_array[] = date("d-m-Y h:i a", strtotime($row->created_at));
			$sub_array[] = $row->cust_name;
			$sub_array[] = $row->credit;
			$sub_array[] = $row->discount;
			$sub_array[] = $row->delivery_cost;
			$sub_array[] = $row->net_total;
			$sub_array[] = $row->debit;
			$sub_array[] = $row->net_total - $row->debit;

			$sub_array[] = '<a href="admin/sell_product_details/' . $row->sell_id . '" type="button" class="btn btn-success btn-xs supplier_edit_button">View Details</a>';

			$sub_array[] = $row->operator_name;


			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('sell s', $condition, $select_column, 'customer c', 's.cust_id=c.id'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
				'sell s',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'customer c',
				's.cust_id=c.id',
				'sell_id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}



	public function edit_sale()
	{
		$data['active'] = 'edit_sale';
		$data['page_title'] = 'Edit Sale Invoice';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['all_sell_code'] = $this->admin_model->select_with_where2('*', 'status=1 and is_return=1', 'sell');



		$this->load->view('pharmacy/edit_sale', $data);
	}

	public function edit_sale_next($value = '')
	{

		$sell_id = $this->input->post('sell_code');

		if ($sell_id != null) {
			$data['sell_id'] = $sell_id;
		} else {
			$data['sell_id'] = "";
		}

		$data['customer_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'customer');

		$data['product_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'product');

		$data['sell_details'] = $this->admin_model->select_join_five_table2('*,s.created_at,s.sell_id', 'sell s', 'customer c', 'sell_details sd', 'product p', 'unit_info u', 'c.id=s.cust_id', 's.sell_id=sd.sell_id', 'p.id=sd.p_id', 'u.id=p.p_unit_id', 's.sell_id="' . $sell_id . '"');
	}

	public function edit_sell_invoice($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Edit Invoice';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$sell_id = $this->input->get('sell_code');

		if ($sell_id != null) {
			$data['sell_id'] = $sell_id;
		} else {
			$data['sell_id'] = "";
		}

		$data['sell_details'] = $this->admin_model->select_join_five_table2('*,s.created_at,d.created_at as c_date,s.sell_id,s.ref_dir_id,c.p_id', 'sell s', 'customer c', 'sell_details d', 'product p', 'unit_info u', 's.cust_id=c.id', 's.sell_id=d.sell_id', 'p.id=d.p_id', 'u.id=p.p_unit_id', 's.sell_id="' . $sell_id . '" and s.status=1');

		// "<pre>";print_r($data['sell_details']);die();

		$data['flag'] = "";
		$this->cart->destroy();


		$data['product_list'] = $this->admin_model->select_three_join_where_group_by('*,product.id,buy_details.created_at', 'product', 'unit_info', 'unit_info.id=product.p_unit_id', 'buy_details', 'product.id=buy_details.p_id', 'product.status=1 and date(buy_details.expire_date) >= "' . date('Y-m-d') . '" and buy_details.status=1 and buy_details.current_stock > 0', 'buy_details.p_id,buy_details.expire_date,');

		$data['customer_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'customer');

		$data['opd_customer_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'opd_patient_info');

		$data['ipd_customer_list'] = $this->admin_model->select_with_where2('*', 'status=1 and type != 3', 'ipd_patient_info');

		$data['director_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'director');

		$data['uhid_customer_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'uhid');

		$this->load->view('pharmacy/edit_product_invoice', $data);
	}


	public function insert_sell_data_edit($value = '')
	{
		$sell_id = $this->uri->segment(3);
		$sell_code = $this->uri->segment(4);


		//delete from stock table

		$this->admin_model->delete_function_cond('stock', 'sell_buy_id = "' . $sell_id . '"');

		//delete from payment table

		$this->admin_model->delete_function_cond('payment', 'sell_buy_id = "' . $sell_id . '"');


		//delete from sell details

		$this->admin_model->delete_function_cond('sell_details', ' sell_id = "' . $sell_id . '"');

		//delete from due_collection

		$this->admin_model->delete_function_cond('pharmacy_due_collection', 'order_id = "' . $sell_code . '"');

		$login_id = $this->session->userdata['logged_in']['id'];
		$sell_code = 'inv-000001';
		$get_last_sell_code = $this->admin_model->get_last_sell_code();

		if (count($get_last_sell_code) > 0) {
			$sell_code = $get_last_sell_code[0]['sell_code'];
			$sell_code_explode = explode('-', $sell_code);
			$sell_code_int = $sell_code_explode[1];
			$sell_code_number = sprintf("%'.06d", ($sell_code_int + 1));
			$sell_code = $sell_code_explode[0] . '-' . $sell_code_number;
		}


		$p_id = $this->input->post('p_id');
		$sell_price = $this->input->post('sell_price');
		$sell_qty = $this->input->post('sell_qty');
		$credit = 0;

		for ($i = 0; $i < count($p_id); $i++) {
			$credit += $sell_price[$i] * $sell_qty[$i];
		}

		$ref_dir_id = explode('#', $this->input->post('ref_dir_id'));

		$cust_gen_id = 1;

		$cust_info = $this->admin_model->get_last_row2('customer', 'status=1');

		if ($cust_info != null) {
			$cust_gen_id = $cust_info[0]['cust_gen_id'] + 1;
		}

		$expire_date = $this->input->post('expire_date');


		// optradio 3 and 4 only phar pateint 

		// fresh new cust

		if ($this->input->post('optradio') == 4) {

			$patient_data['cust_name'] = $this->input->post('patient_name');
			$patient_data['cust_gen_id'] = $cust_gen_id;
			$patient_data['cust_phone'] = $this->input->post('mobile_no');
			$patient_data['cust_address'] = $this->input->post('address');
			$patient_data['type'] = 3;
			$patient_data['type_in_word'] = "others";
			$patient_data['ref_dir_id'] = $ref_dir_id[0];
			$patient_data['ref_dir_name'] = $ref_dir_id[1];
			$patient_data['created_at'] = date('Y-m-d H:i:s');
			$cust_id = $this->admin_model->insert_ret('customer', $patient_data);

			$sell_data['cust_id'] = $cust_id;
			$sell_data['patient_type'] = 3; // 3 -> only phar customer 
		}

		// uhid
		else if ($this->input->post('optradio') == 5) {

			$already_phar_cust = $this->admin_model->select_with_where2('*', 'p_id="' . $this->input->post('uhid_customer_id') . '" and type=4', 'customer');


			$patient_data['cust_name'] = $this->input->post('patient_name');

			$patient_data['cust_phone'] = $this->input->post('mobile_no');
			$patient_data['cust_address'] = $this->input->post('address');
			$patient_data['type'] = 4;
			$patient_data['type_in_word'] = "uhid";

			$patient_data['p_id'] = $this->input->post('uhid_customer_id');
			$sell_data['patient_type'] = 4;

			if ($already_phar_cust == null) {
				// $patient_data['ref_dir_id']=$ref_dir_id[0];
				// $patient_data['ref_dir_name']=$ref_dir_id[1];
				$patient_data['cust_gen_id'] = $cust_gen_id;
				$patient_data['created_at'] = date('Y-m-d H:i:s');
				$cust_id = $this->admin_model->insert_ret('customer', $patient_data);
				$sell_data['cust_id'] = $cust_id;
			} else {
				$patient_data['updated_at'] = date('Y-m-d H:i:s');
				$this->admin_model->update_function2('id="' . $already_phar_cust[0]['id'] . '"', 'customer', $patient_data);

				$cust_id = $already_phar_cust[0]['id'];

				$sell_data['cust_id'] = $already_phar_cust[0]['id'];
			}
		}

		// opd
		else if ($this->input->post('optradio') == 1) {

			$already_phar_cust = $this->admin_model->select_with_where2('*', 'p_id="' . $this->input->post('opd_cust_id') . '" and type=1', 'customer');

			$patient_data['cust_name'] = $this->input->post('patient_name');

			$patient_data['cust_phone'] = $this->input->post('mobile_no');
			$patient_data['cust_address'] = $this->input->post('address');
			$patient_data['type'] = 1;
			$patient_data['type_in_word'] = "opd";
			$patient_data['p_id'] = $this->input->post('opd_cust_id');

			$sell_data['patient_type'] = 1;
			if ($already_phar_cust == null) {
				$patient_data['cust_gen_id'] = $cust_gen_id;
				// $patient_data['ref_dir_id']=$ref_dir_id[0];
				// $patient_data['ref_dir_name']=$ref_dir_id[1];
				$patient_data['created_at'] = date('Y-m-d H:i:s');
				$cust_id = $this->admin_model->insert_ret('customer', $patient_data);
				$sell_data['cust_id'] = $cust_id;
			} else {
				$patient_data['updated_at'] = date('Y-m-d H:i:s');
				$this->admin_model->update_function2('id="' . $already_phar_cust[0]['id'] . '"', 'customer', $patient_data);

				$sell_data['cust_id'] = $already_phar_cust[0]['id'];
				$cust_id = $already_phar_cust[0]['id'];
			}
		}
		// ipd
		elseif ($this->input->post('optradio') == 2) {
			$already_phar_cust = $this->admin_model->select_with_where2('*', 'p_id="' . $this->input->post('ipd_cust_id') . '" and type=2', 'customer');

			$patient_data['cust_name'] = $this->input->post('patient_name');

			$patient_data['cust_phone'] = $this->input->post('mobile_no');
			$patient_data['cust_address'] = $this->input->post('address');
			$patient_data['type'] = 2;
			$patient_data['type_in_word'] = "ipd";

			$patient_data['p_id'] = $this->input->post('ipd_cust_id');

			$sell_data['patient_type'] = 2;

			if ($already_phar_cust == null) {
				$patient_data['cust_gen_id'] = $cust_gen_id;
				// $patient_data['ref_dir_id']=$ref_dir_id[0];
				// $patient_data['ref_dir_name']=$ref_dir_id[1];
				$patient_data['created_at'] = date('Y-m-d H:i:s');
				$cust_id = $this->admin_model->insert_ret('customer', $patient_data);

				$sell_data['cust_id'] = $cust_id;
			} else {
				$patient_data['updated_at'] = date('Y-m-d H:i:s');
				$this->admin_model->update_function2('id="' . $already_phar_cust[0]['id'] . '"', 'customer', $patient_data);

				$cust_id = $already_phar_cust[0]['id'];

				$cust_sell_det = $this->admin_model->select_with_where2('*', 'cust_id="' . $cust_id . '"', 'sell');

				$sell_id = $cust_sell_det[0]['sell_id'];

				$sell_data['cust_id'] = $already_phar_cust[0]['id'];
				$sell_data['patient_type'] = 2;

				// update sell table
				$sell_data['credit'] = $credit + $cust_sell_det[0]['credit']; //total amount
				$sell_data['debit'] = $this->input->post('total_paid') + $cust_sell_det[0]['debit'];
				$sell_data['discount'] = round($this->input->post('discount')) + $cust_sell_det[0]['discount'];
				$sell_data['vat'] = round($this->input->post('vat')) + $cust_sell_det[0]['vat'];
				$sell_data['net_total'] = $sell_data['credit'] + $sell_data['vat'] - $sell_data['discount'];
				$sell_id = $cust_sell_det[0]['sell_id'];
				$this->admin_model->update_function2('sell_id="' . $sell_id . '"', 'sell', $sell_data);

				// insert due collection for IPD

				$d_data['order_id'] = $cust_sell_det[0]['sell_code'];
				$d_data['old_due'] = $cust_sell_det[0]['net_total'] - $cust_sell_det[0]['debit'];
				$d_data['total_amount'] = $credit;
				$d_data['supp_cust_id'] = $cust_sell_det[0]['cust_id'];
				$d_data['vat'] = $this->input->post('vat');
				$d_data['discount'] = $this->input->post('discount');
				$d_data['current_due'] = $d_data['old_due'] - $this->input->post('total_paid');
				$d_data['paid_due'] = $this->input->post('total_paid');

				$d_data['due_type'] = 2;
				$d_data['created_at'] = date('Y-m-d H:i:s');
				$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
				$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];
				$this->load->admin_model->insert_ret('pharmacy_due_collection', $d_data);

				// insert into sell details for IPD


				$p_id = $this->input->post('p_id');
				$sell_price = $this->input->post('sell_price');
				$sell_qty = $this->input->post('sell_qty');

				for ($i = 0; $i < count($p_id); $i++) {
					$sd_data['sell_id'] = $sell_id;
					$sd_data['sell_code'] = $cust_sell_det['0']['sell_code'];
					$sd_data['p_id'] = $p_id[$i];
					$sd_data['sell_price'] = $sell_price[$i];
					$sd_data['sell_qty'] = $sell_qty[$i];
					$sd_data['created_at'] = date('Y-m-d H:i:s');
					$sd_data['expire_date'] = $expire_date[$i];

					$this->admin_model->insert('sell_details', $sd_data);
				}

				// insert into payment for IPD

				$pay_data['user_id'] = $login_id;
				$pay_data['sell_buy_id'] = $sell_id;
				$pay_data['cust_supp_id'] = $this->input->post('cust_id');
				$pay_data['amount'] = $this->input->post('total_paid');
				$pay_data['payment_type'] = 1;

				$pay_data['type'] = 2;
				$pay_data['created_at'] = date('Y-m-d H:i:s');

				$payment_id = $this->admin_model->insert_ret('payment', $pay_data);

				// insert into stock for IPD


				for ($i = 0; $i < count($p_id); $i++) {
					$stock['sell_buy_id'] = $sell_id;
					$stock['p_id'] = $p_id[$i];
					$stock['expire_date'] = $expire_date[$i];

					$get_last_val = $this->admin_model->get_last_row('stock', 'p_id="' . $p_id[$i] . '" and expire_date="' . $expire_date[$i] . '"');

					$stock['st_open'] = 0;
					if (count($get_last_val) > 0) {
						$stock['st_open'] = $get_last_val[0]['st_close'];
					}
					$stock['st_in'] = 0;
					$stock['st_out'] = $sell_qty[$i];
					$stock['st_close'] = $stock['st_open'] - $stock['st_out'];
					$stock['type'] = 2;
					$stock['created_at'] = date('Y-m-d H:i:s');

					$this->admin_model->insert('stock', $stock);
				}
				// update product/buy det table


				for ($i = 0; $i < count($p_id); $i++) {


					$prev_qty = $this->admin_model->select_with_where2('current_stock', 'p_id="' . $p_id[$i] . '" and status=1 and expire_date="' . $expire_date[$i] . '"', 'buy_details');

					if ($prev_qty[0]['current_stock'] == 0) {
						$data_update['current_stock'] = $buy_qty[$i];
					} else {
						$data_update['current_stock'] = $prev_qty[0]['current_stock'] - $sell_qty[$i];
					}


					$this->admin_model->update_function2('p_id="' . $p_id[$i] . '" and expire_date="' . $expire_date[$i] . '" and  date(buy_details.expire_date) >= "' . date('Y-m-d') . '" and buy_details.current_stock > 0', 'buy_details', $data_update);
				}

				$this->cart->destroy();

				redirect('admin/sell_product_list', 'refresh');

				// >>>>>>>>>>> ipd done  <<<<<<<<<
			}
		} else {
			$sell_data['cust_id'] = $this->input->post('cust_id');
			$sell_data['patient_type'] = 3; //phar customer

			$cust_id = $this->input->post('cust_id');
		}

		$sell_data['user_id'] = $login_id;
		$sell_data['credit'] = $credit; //total amount
		$sell_data['debit'] = $this->input->post('total_paid');
		$sell_data['discount'] = round($this->input->post('discount'));
		$sell_data['vat'] = round($this->input->post('vat'));
		$sell_data['net_total'] = ($credit + $this->input->post('vat')) - $this->input->post('discount');
		$sell_data['created_at'] = date('Y-m-d H:i:s');
		$sell_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$sell_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$sell_data['ref_dir_id'] = $ref_dir_id[0];
		$sell_data['ref_dir_name'] = $ref_dir_id[1];

		$this->admin_model->update_function2('sell_id="' . $sell_id . '"', 'sell', $sell_data);

		// insert into due collection

		$d_data['old_due'] = $credit;
		$d_data['order_id'] = $sell_code;
		$d_data['total_amount'] = $credit;
		$d_data['supp_cust_id'] = $cust_id;
		$d_data['vat'] = $this->input->post('vat');
		$d_data['discount'] = $this->input->post('discount');
		$d_data['current_due'] = $sell_data['net_total'] - $this->input->post('total_paid');
		$d_data['paid_due'] = $this->input->post('total_paid');

		$d_data['due_type'] = 2;
		$d_data['created_at'] = date('Y-m-d H:i:s');
		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$this->load->admin_model->insert_ret('pharmacy_due_collection', $d_data);


		// insert into sell details


		$p_id = $this->input->post('p_id');
		$sell_price = $this->input->post('sell_price');
		$sell_qty = $this->input->post('sell_qty');


		for ($i = 0; $i < count($p_id); $i++) {
			$sd_data['sell_id'] = $sell_id;
			$sd_data['sell_code'] = $sell_code;
			$sd_data['p_id'] = $p_id[$i];
			$sd_data['sell_price'] = $sell_price[$i];
			$sd_data['sell_qty'] = $sell_qty[$i];
			$sd_data['created_at'] = date('Y-m-d H:i:s');
			$sd_data['expire_date'] = $expire_date[$i];

			$this->admin_model->insert('sell_details', $sd_data);
		}


		// insert into payment

		$pay_data['user_id'] = $login_id;
		$pay_data['sell_buy_id'] = $sell_id;
		$pay_data['cust_supp_id'] = $this->input->post('cust_id');
		$pay_data['amount'] = $this->input->post('total_paid');
		$pay_data['payment_type'] = 1;

		$pay_data['type'] = 2;
		$pay_data['created_at'] = date('Y-m-d H:i:s');

		$payment_id = $this->admin_model->insert_ret('payment', $pay_data);


		// insert into stock


		for ($i = 0; $i < count($p_id); $i++) {
			$stock['sell_buy_id'] = $sell_id;
			$stock['p_id'] = $p_id[$i];
			$stock['expire_date'] = $expire_date[$i];
			$get_last_val = $this->admin_model->get_last_row('stock', 'p_id=' . $p_id[$i]);
			$stock['st_open'] = 0;
			if (count($get_last_val) > 0) {
				$stock['st_open'] = $get_last_val[0]['st_close'];
			}
			$stock['st_in'] = 0;
			$stock['st_out'] = $sell_qty[$i];
			$stock['st_close'] = $stock['st_open'] - $stock['st_out'];
			$stock['type'] = 2;
			$stock['created_at'] = date('Y-m-d H:i:s');

			$this->admin_model->insert('stock', $stock);
		}

		// update product det table


		for ($i = 0; $i < count($p_id); $i++) {


			$prev_qty = $this->admin_model->select_with_where2('current_stock', 'p_id="' . $p_id[$i] . '" and status=1 and expire_date="' . $expire_date[$i] . '"', 'buy_details');

			if ($prev_qty[0]['current_stock'] == 0) {
				$data_update['current_stock'] = $buy_qty[$i];
			} else {
				$data_update['current_stock'] = $prev_qty[0]['current_stock'] - $sell_qty[$i];
			}


			$this->admin_model->update_function2('p_id="' . $p_id[$i] . '" and expire_date="' . $expire_date[$i] . '" and  date(buy_details.expire_date) >= "' . date('Y-m-d') . '" and buy_details.current_stock > 0', 'buy_details', $data_update);
		}

		$this->cart->destroy();

		redirect('admin/sell_product_list', 'refresh');
	}


	public function edit_purchase()
	{
		$data['active'] = 'edit_purchase';
		$data['page_title'] = 'Edit Purchase Invoice';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$buy_id = $this->input->post('purchase_code');

		if ($buy_id != null) {
			$data['buy_id'] = $buy_id;
		} else {
			$data['buy_id'] = "";
		}

		$data['supplier_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'supplier');

		$data['product_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'product');

		$data['all_purchase_code'] = $this->admin_model->select_with_where2('*', 'status=1 and is_return=1', 'buy');

		$data['buy_details'] = $this->admin_model->select_join_five_table2('*,b.created_at,b.buy_id', 'buy b', 'supplier s', 'buy_details d', 'product p', 'unit_info u', 'b.supp_id=s.id', 'b.buy_id=d.buy_id', 'p.id=d.p_id', 'u.id=p.p_unit_id', 'b.buy_id="' . $buy_id . '"');

		$this->load->view('pharmacy/edit_purchase', $data);
	}



	public function edit_purchase_post($value = '')
	{
		$buy_id = $this->input->post('buy_id');
		$buy_code = $this->input->post('buy_code');
		// delete all table first

		// $this->admin_model->delete_function_cond('buy','buy_id="'.$this->input->post('buy_id').'"');
		$this->admin_model->delete_function_cond('buy_details', 'buy_id="' . $buy_id . '"');


		$this->admin_model->delete_function_cond('pharmacy_due_collection', 'order_id="' . $buy_id . '" and due_type=1');
		$this->admin_model->delete_function_cond('payment', 'sell_buy_id="' . $buy_id . '" and type=1');
		$this->admin_model->delete_function_cond('stock', 'sell_buy_id="' . $buy_id . '" and type=1');

		$login_id = $this->session->userdata['logged_in']['id'];
		$buy_data['user_id'] = $login_id;
		// $buy_data['buy_code']=$buy_code;
		$buy_data['supp_id'] = $this->input->post('supp_id');
		$buy_data['bill_no'] = $this->input->post('bill_no');
		$buy_data['credit'] = $this->input->post('credit');
		$buy_data['debit'] = $this->input->post('debit');
		$buy_data['unload_cost'] = $this->input->post('unload_cost');

		$buy_data['created_at'] = date('Y-m-d H:i:s');
		$buy_data['cost_total'] = $buy_data['credit'] + $buy_data['unload_cost'];
		$buy_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$buy_data['operator_name'] = $this->session->userdata['logged_in']['username'];

		$this->admin_model->update_function2('buy_id="' . $buy_id . '"', 'buy', $buy_data);

		$p_id = $this->input->post('p_id');
		$buy_price = $this->input->post('buy_price');
		$buy_qty = $this->input->post('buy_qty');

		for ($i = 0; $i < count($p_id); $i++) {
			$bd_data['buy_id'] = $buy_id;
			$bd_data['p_id'] = $p_id[$i];
			$bd_data['buy_price'] = $buy_price[$i];
			$bd_data['buy_qty'] = $buy_qty[$i];
			$bd_data['created_at'] = date('Y-m-d H:i:s');
			$bd_data['expire_date'] = $this->input->post('expire_date');

			$this->admin_model->insert('buy_details', $bd_data);
		}

		$d_data['old_due'] = $this->input->post('credit');
		$d_data['order_id'] = $buy_code;
		$d_data['total_amount'] = $this->input->post('credit');
		$d_data['supp_cust_id'] = $this->input->post('supp_id');
		$d_data['unload_cost'] = $this->input->post('unload_cost');
		$d_data['current_due'] = $buy_data['cost_total'] - $this->input->post('debit');
		$d_data['paid_due'] = $this->input->post('debit');
		$d_data['due_type'] = 1;
		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$d_data['created_at'] = date('Y-m-d H:i:s');
		$this->load->admin_model->insert_ret('pharmacy_due_collection', $d_data);


		$pay_data['user_id'] = $login_id;
		$pay_data['sell_buy_id'] = $buy_id;
		$pay_data['cust_supp_id'] = $this->input->post('supp_id');
		$pay_data['amount'] = $buy_data['debit'];
		$pay_data['payment_type'] = 1;
		$pay_data['type'] = 1;
		$pay_data['created_at'] = date('Y-m-d H:i:s');

		$payment_id = $this->admin_model->insert_ret('payment', $pay_data);

		for ($i = 0; $i < count($p_id); $i++) {
			$stock['sell_buy_id'] = $buy_id;
			$stock['p_id'] = $p_id[$i];

			$get_last_val = $this->admin_model->get_last_row('stock', 'p_id=' . $p_id[$i]);
			$stock['st_open'] = 0;
			if (count($get_last_val) > 0) {
				$stock['st_open'] = $get_last_val[0]['st_close'];
			}
			$stock['st_in'] = $buy_qty[$i];
			$stock['st_out'] = 0;
			$stock['st_close'] = $stock['st_open'] + $stock['st_in'];
			$stock['type'] = 1;
			$stock['created_at'] = date('Y-m-d H:i:s');

			$this->admin_model->insert('stock', $stock);
		}

		//quantity update in product table

		for ($i = 0; $i < count($p_id); $i++) {
			$prev_qty = 0;
			$p_start_qty = 0;
			$get_p_data = $this->admin_model->select_with_where2('*', 'id =' . $p_id[$i], 'product');
			if ($get_p_data[0]['p_opening_qty'] == 0) {
				$start_data['p_opening_qty'] = $buy_qty[$i];
				$this->admin_model->update_function('id', $p_id[$i], 'product', $start_data);
			}

			$prev_qty = $get_p_data[0]['p_current_stock'];

			$data_update['p_current_stock'] = $prev_qty + $buy_qty[$i];

			$this->admin_model->update_function('id', $p_id[$i], 'product', $data_update);
		}

		redirect('admin/edit_purchase', 'refresh');
	}




	public function get_info_by_invoice($value = '')
	{



		$data = $this->admin_model->select_join_where('*', 'sell s', 'customer c', 's.cust_id=c.id', 's.sell_code="' . $_POST['bill_no'] . '"');

		$val = $this->admin_model->select_join_where('*', 'sell_details s', 'product p', 's.p_id=p.id', 's.sell_id="' . $data[0]['sell_id'] . '"');

		$this->cart->destroy();

		foreach ($val as $key => $value) {

			$value = array(
				"id"  => $value["p_id"],
				"name"  => $value["p_name"],
				"qty"  => $value["sell_qty"],
				"price"  => $value["sell_price"]

			);

			$val = $this->cart->insert($value);
		}

		$data['flag'] = "";

		echo $this->load->view('pharmacy/sell_cart_details', $data);
	}

	public function get_cust_info_by_bill($value = '')
	{
		$data = $this->admin_model->select_join_where('*', 'sell s', 'customer c', 's.cust_id=c.id', 's.sell_code="' . $_POST['bill_no'] . '"');
		echo json_encode($data);
	}




	// public function add_invoice_cart($value='')
	// {


	// 	$data = array
	// 	(
	// 		"id"  => $_POST["p_id"],
	// 		"name"  => $_POST["p_name"],
	// 		"qty"  => $_POST["quantity"],
	// 		"price"  => $_POST["p_price"]

	// 	);

	// 	$val=$this->cart->insert($data); 


	// 	echo $this->load->view('pharmacy/invoice_cart_details');
	// }


	// public function edit_remove_sell_cart()
	// {
	// 	$row_id=$_POST["row_id"];
	// 	$data=array(
	// 		'rowid' => $row_id,
	// 		'qty'=> 0 );
	// 	$this->cart->update($data);
	// 	echo $this->load->view('pharmacy/invoice_cart_details');
	// }


	// public function update_invoice_cart($value='')
	// {

	// 	$row_id=$_POST["row_id"];
	// 	$data=array(

	// 		'rowid' => $row_id,
	// 		'qty'=> $_POST['qty']);
	// 	$this->cart->update($data);

	// 	echo $this->load->view('pharmacy/invoice_cart_details');

	// }

	public function transaction_summary($value = '')
	{
		$data['active'] = 'transaction_summary';
		$data['page_title'] = 'Purchase Each Transaction Summary';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['allcompany'] = $this->admin_model->select_with_where2('*', 'status=1', 'supplier');

		$this->load->view('pharmacy/day_wise_purchase_report', $data);
	}

	public function transaction_summary_report($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$company_id = $this->input->post('company_id');

		redirect('admin/transaction_summary_report_next/' . $start_date . '/' . $end_date . '/' . $company_id);
	}

	public function transaction_summary_report_next($start_date = '', $end_date = '', $company_id = '')
	{
		$start_date = $start_date;
		$end_date = $end_date;
		$company_id = $company_id;



		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$data['company_id'] = $company_id;




		if ($company_id == "all") {
			// we use  return_product status both 1 and  2
			$data['all_purchased_product_list'] = $this->admin_model->select_three_join_where_left_order_sum('r.total_paid', 'r.total_amount', 'r.charge', '*,buy.created_at', 'buy', 'supplier', 'buy.supp_id=supplier.id', 'return_product r', 'buy.buy_code=r.buy_sell_code', 'date(buy.created_at) between "' . $start_date . '" and "' . $end_date . '"  and r.type=1 or r.type is null', 'buy.created_at', 'DESC', 'buy.buy_id');

			// "<pre>";print_r($data['all_purchased_product_list']);die();
		} else {
			// we use  return_product status both 1 and  2

			$data['all_purchased_product_list'] = $this->admin_model->select_three_join_where_left_order_sum('r.total_paid', 'r.total_amount', 'r.charge', '*,buy.created_at', 'buy', 'supplier', 'buy.supp_id=supplier.id', 'return_product r', 'buy.buy_code=r.buy_sell_code', 'date(buy.created_at) between "' . $start_date . '" and "' . $end_date . '" and r.type=1 or r.type is null and supp_id="' . $company_id . '"', 'buy.created_at', 'DESC', 'buy.buy_id');
		}

		$this->load->view('pharmacy/purchase_his_details', $data);
	}


	// >>

	public function day_wise_purchase_each_transaction($value = '')
	{
		$data['active'] = 'day_wise_purchase';
		$data['page_title'] = 'Day Wise Purchase Report Each Transaction';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['allcompany'] = $this->admin_model->select_with_where2('*', 'status=1', 'supplier');

		$this->load->view('pharmacy/day_wise_purchase_each_transaction', $data);
	}

	public function day_wise_purchase_each_transaction_report($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$company_id = $this->input->post('company_id');

		redirect('admin/day_wise_purchase_each_transaction_report_next/' . $start_date . '/' . $end_date . '/' . $company_id);
	}

	public function day_wise_purchase_each_transaction_report_next($start_date = '', $end_date = '', $company_id = '')
	{
		$start_date = $start_date;
		$end_date = $end_date;
		$company_id = $company_id;

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['company_id'] = $company_id;


		if ($company_id == "all") {

			$data['all_purchased_product_list'] = $this->admin_model->select_three_join_where('*,b.created_at', 'buy b', 'pharmacy_due_collection p', 'p.order_id=b.buy_code', 'supplier s', 's.id=b.supp_id', 'b.status=1 and p.due_type=1 and date(b.created_at) between "' . $start_date . '" and "' . $end_date . '"');
		} else {


			$data['all_purchased_product_list'] = $this->admin_model->select_three_join_where('*,b.created_at', 'buy b', 'pharmacy_due_collection p', 'p.order_id=b.buy_code', 'supplier s', 's.id=b.supp_id', 'b.status=1 and p.due_type=1 and date(b.created_at) between "' . $start_date . '" and "' . $end_date . '" and b.supp_id="' . $company_id . '"');
		}

		$this->load->view('pharmacy/day_wise_purchase_each_transaction_report', $data);
	}


	public function day_wise_sale_each_transaction($value = '')
	{
		$data['active'] = 'day_wise_sale';
		$data['page_title'] = 'Day Wise Sale Report Each Transaction';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['allcompany'] = $this->admin_model->select_with_where2('*', 'status=1', 'supplier');

		$this->load->view('pharmacy/day_wise_sale_each_transaction', $data);
	}

	public function day_wise_sale_each_transaction_report($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		redirect('admin/day_wise_sale_each_transaction_report_next/' . $start_date . '/' . $end_date);
	}

	public function day_wise_sale_each_transaction_report_next($start_date = '', $end_date = '')
	{
		$start_date = $start_date;
		$end_date = $end_date;

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$data['all_sale_product_list'] = $this->admin_model->select_three_join_where('*,s.created_at', 'sell s', 'pharmacy_due_collection p', 'p.order_id=s.sell_code', 'customer c', 'c.id=s.cust_id', 's.status=1 and p.due_type=2 and date(s.created_at) between "' . $start_date . '" and "' . $end_date . '"');


		$this->load->view('pharmacy/day_wise_sale_each_transaction_report', $data);
	}

	public function day_wise_sale($value = '')
	{
		$data['active'] = 'day_wise_sale_report';
		$data['page_title'] = 'Day Wise Sale Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		// $data['customer']=$this->admin_model->select_with_where2('*','status=1','customer');

		$this->load->view('pharmacy/day_wise_sale_report', $data);
	}


	public function sale_day_wise_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$dept_id = $this->input->post('dept_id');

		redirect('admin/sale_day_wise_report_next/' . $start_date . '/' . $end_date . '/' . $dept_id);
	}

	public function sale_day_wise_report_next($start_date = '', $end_date = '', $dept_id = '')
	{

		$start_date = $start_date;
		$end_date = $end_date;

		if ($dept_id == "all") {

			$data['all_sell_product_list'] = $this->admin_model->select_join_three_table2('*,s.created_at', 'sell s', 'customer c', 'return_product r', 's.cust_id=c.id', 's.sell_id=r.sell_buy_id', 'date(s.created_at) between "' . $start_date . '" and "' . $end_date . '" and r.status=1');

			$data['from_date'] = $start_date;
			$data['end_date'] = $end_date;

			if ($data['all_sell_product_list'] != null) {
				$data['type_word'] = 'All';
			}
		} else {

			$data['all_sell_product_list'] = $this->admin_model->select_join_three_table2('*,s.created_at', 'sell s', 'customer c', 'return_product r', 's.cust_id=c.id', 's.sell_id=r.sell_buy_id', 'date(s.created_at) between "' . $start_date . '" and "' . $end_date . '" and s.patient_type ="' . $dept_id . '" and r.status=1');

			$data['from_date'] = $start_date;
			$data['end_date'] = $end_date;
			$data['type_word'] = "";

			if ($data['all_sell_product_list'] != null) {
				$data['type_word'] = $data['all_sell_product_list'][0]['type_in_word'];
			}
		}


		$this->load->view('pharmacy/sale_his_details', $data);
	}

	public function dir_wise_collection($value = '')
	{
		$data['active'] = 'dir_wise_collection';
		$data['page_title'] = 'Director Wise Collection';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['director_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'director');

		$this->load->view('pharmacy/dir_wise_collection', $data);
	}

	public function dir_wise_collection_report($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$dir_id = $this->input->post('dir_id');

		redirect('admin/dir_wise_collection_report_next/' . $start_date . '/' . $end_date . '/' . $dir_id);
	}

	public function dir_wise_collection_report_next($start_date, $end_date, $dir_id)
	{
		$data["dir_wise_collection"] = $this->admin_model->select_join_where('*', 'customer c', 'sell s', 'c.id=s.cust_id', 'date(s.created_at) between "' . $start_date . '" and "' . $end_date . '" and c.ref_dir_id="' . $dir_id . '"');

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['dir_name'] = $this->admin_model->select_with_where2('*', 'id="' . $dir_id . '"', 'director');;

		$this->load->view('pharmacy/dir_wise_collection_report', $data);
	}



	public function day_wise_collection_pharmacy($value = '')
	{
		$data['active'] = 'day_wise_collection_pharmacy';
		$data['page_title'] = 'Pharmacy Day Wise Collection';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data["sell_info"] = $this->admin_model->get_three_charge_sum_where_group_by_join('*,p.created_at', 'p.paid_due', 'p.discount', 'p.vat', 'p.order_id', 'customer c', 'pharmacy_due_collection p', 'c.id=p.supp_cust_id', 'date(p.created_at)="' . date('Y-m-d') . '" AND p.due_type=2');

		$this->load->view('pharmacy/day_wise_collection_pharmacy', $data);
	}

	public function day_wise_collection_pharmacy_report($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		redirect('admin/day_wise_collection_pharmacy_report_next/' . $start_date . '/' . $end_date);
	}

	public function day_wise_collection_pharmacy_report_next($start_date, $end_date)
	{

		$data["sell_info"] = $this->admin_model->get_three_charge_sum_where_group_by_join('*,p.created_at', 'p.paid_due', 'p.discount', 'p.vat', 'p.order_id', 'customer c', 'pharmacy_due_collection p', 'c.id=p.supp_cust_id', 'date(p.created_at)between "' . $start_date . '" and "' . $end_date . '" AND p.due_type=2');

		// "<pre>";print_r($data["doc_wise_collection"]);die();

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;


		$this->load->view('pharmacy/day_wise_collection_pharmacy_report', $data);
	}

	//************ Pharmacy  Module Ends ***********************

	//************ user profile ***********************


	public function change_password($entry_id)
	{
		$entry_id = $entry_id;
		$data['active'] = 'Manage Profile';
		$data['page_title'] = 'Change Password';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['entry_id'] = $entry_id;
		$this->load->view('profile/edit_password', $data);
	}
	public function password_change()
	{
		$entry_id = $this->input->post('entry_id');
		$reg_data['password'] = $this->encryptIt($this->input->post('password'));
		$this->admin_model->update_function('id', $entry_id, 'login', $reg_data);
		$this->session->set_flashdata('Successfully', 'Pin and Password Update Done');
		redirect('admin/index', 'refresh');
	}


	// ************************* User End *******************


	// ********************** Doctor  Management *******************

	public function add_doc()
	{


		$data['active'] = 'doc_list';
		$data['page_title'] = 'Doctor List';


		$data['marketing_officer_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'marketing_officer');

		$data['doc_cat'] = $this->admin_model->select_with_where2('*', 'status=1', 'doc_category');

		$this->load->view('doctor/doctor_add_form', $data);
	}
	public function doc_add_post()
	{

		$doc_cat = explode('#', $this->input->post('doc_cat'));

		$data['hospital_id'] = $this->input->post('hospital_id');
		$data['doctor_title'] = $this->input->post('doc_name');
		$data['doctor_degree'] = $this->input->post('doc_experience');
		$data['doctor_type'] = $this->input->post('doctor_type');
		$data['doc_cat'] = $doc_cat[0];
		$data['doc_cat_id'] = $doc_cat[1];

		$data['address'] = $this->input->post('address');
		$data['doc_mobile_no'] = $this->input->post('mobile_no');
		$data['marketing_officer_id'] = $this->input->post('marketing_officer_id');
		$data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$data['operator_id'] = $this->session->userdata['logged_in']['id'];


		$id = $this->admin_model->insert_ret('doctor', $data);

		$data_gen['gen_id'] = "D-" . $id;


		$this->admin_model->update_function('doctor_id', $id, 'doctor', $data_gen);


		$this->session->set_flashdata('Successfully', 'Doctor Inserted Successfully Done');

		if ($_FILES['doc_img']['name']) {
			$name_generator = $this->name_generator($_FILES['doc_img']['name'], $id);
			$i_ext = explode('.', $_FILES['doc_img']['name']);
			$target_path = $name_generator . '.' . end($i_ext);;
			$size = getimagesize($_FILES['doc_img']['tmp_name']);

			if (move_uploaded_file($_FILES['doc_img']['tmp_name'], 'uploads/doctor_image/' . $target_path)) {
				$doc_img = $target_path;
			}

			$data_logo['profile_img'] = $doc_img;
			$this->admin_model->update_function('doctor_id', $id, 'doctor', $data_logo);
		}



		redirect("admin/all_doc_list", "refresh");
	}




	public function doc_edit($doc_id)
	{
		$doc_id = $doc_id;
		$data['active'] = 'doc_list';
		$data['page_title'] = 'Doctor List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['doctor_details'] = $this->admin_model->select_with_where2('*', 'doctor_id="' . $doc_id . '"', 'doctor');

		$data['address'] = $data['doctor_details'][0]['address'];
		$data['doctor_id'] = $data['doctor_details'][0]['doctor_id'];
		$data['doctor_title'] = $data['doctor_details'][0]['doctor_title'];
		$data['doctor_degree'] = $data['doctor_details'][0]['doctor_degree'];

		$data['doctor_type'] = $data['doctor_details'][0]['doctor_type'];


		$data['doc_mobile_no'] = $data['doctor_details'][0]['doc_mobile_no'];
		$data['doc_img'] = $data['doctor_details'][0]['profile_img'];
		$data['marketing_officer_id'] = $data['doctor_details'][0]['marketing_officer_id'];

		$data['marketing_officer_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'marketing_officer');
		$data['doc_cat'] = $this->admin_model->select_with_where2('*', 'status=1', 'doc_category');

		$this->load->view('doctor/doc_edit_form', $data);
	}
	public function doc_dlt($doc_id)
	{

		$data['status'] = 2;
		$this->admin_model->update_function2('doctor_id="' . $doc_id . '"', 'doctor', $data);
		$this->session->set_flashdata('Successfully', 'Doctor Delete Successfully Done');
		redirect("admin/all_doc_list", "refresh");
	}

	public function doc_edit_post()
	{

		$data['address'] = $this->input->post('address');
		$data['doctor_id'] = $this->input->post('doctor_id');
		$data['doctor_title'] = $this->input->post('doc_name');
		$data['doctor_degree'] = $this->input->post('doc_experience');
		$data['doc_mobile_no'] = $this->input->post('mobile_no');
		$data['marketing_officer_id'] = $this->input->post('marketing_officer_id');
		$data['doctor_type'] = $this->input->post('doctor_type');

		if ($_FILES['doc_img']['name']) {
			$name_generator = $this->name_generator($_FILES['doc_img']['name'], $data['doctor_id']);
			$i_ext = explode('.', $_FILES['doc_img']['name']);
			$target_path = $name_generator . '.' . end($i_ext);;
			$size = getimagesize($_FILES['doc_img']['tmp_name']);

			if (move_uploaded_file($_FILES['doc_img']['tmp_name'], 'uploads/doctor_image/' . $target_path)) {
				$doc_img = $target_path;
			}

			$data['profile_img'] = $doc_img;
		}


		$this->admin_model->update_function('doctor_id', $data['doctor_id'], 'doctor', $data);
		$this->session->set_flashdata('Successfully', 'Doctor Delete Successfully Done');
		redirect("admin/all_doc_list", "refresh");
	}

	public function all_doc_list($type = "")
	{


		$data['active'] = 'doc_list';
		$data['page_title'] = 'Doctor List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['doctor_list'] = $this->admin_model->select_where_left_join('*', 'doctor d', 'marketing_officer m', 'd.marketing_officer_id=m.id', 'd.status=1');

		$this->load->view('doctor/doctor_list', $data);
	}

	public function mbbs_doc_list($type = "")
	{


		$data['active'] = 'doc_list';
		$data['page_title'] = 'Doctor List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['doctor_list'] = $this->admin_model->select_where_left_join('*', 'doctor d', 'marketing_officer m', 'd.marketing_officer_id=m.id', 'd.status=1 and doctor_type=1');

		$this->load->view('doctor/doctor_list', $data);
	}

	public function qc_doc_list($type = "")
	{


		$data['active'] = 'doc_list';
		$data['page_title'] = 'Doctor List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['doctor_list'] = $this->admin_model->select_where_left_join('*', 'doctor d', 'marketing_officer m', 'd.marketing_officer_id=m.id', 'd.status=1 and doctor_type=2');

		$this->load->view('doctor/doctor_list', $data);
	}


	public function add_doc_category($value = '')
	{
		$data['active'] = 'add_doc_category';
		$data['page_title'] = 'Doctor Category';

		$this->load->view('doctor/add_doc_category', $data);
	}

	public function add_doc_category_post($value = '')
	{
		$val['category'] = $this->input->post('doc_cat');
		$val['created_at'] = date('Y-m-d');
		$val['operator_name'] = $this->session->userdata['logged_in']['username'];
		$val['operator_id'] = $this->session->userdata['logged_in']['id'];


		$id = $this->admin_model->insert_ret('doc_category', $val);


		redirect('admin/add_doc_category', 'refresh');
	}

	public function doc_category_list($value = '')
	{
		$data['active'] = 'doc_category_list';
		$data['page_title'] = 'Doctor Category List';

		$data['doctor_cat'] = $this->admin_model->select_with_where2('*', 'status=1', 'doc_category');

		$this->load->view('doctor/doc_category_list', $data);
	}

	public function delete_doc_cat($id = '')
	{

		$this->admin_model->delete_function_cond('doc_category', 'id="' . $id . '"');

		redirect('admin/doc_category_list', 'refresh');
	}

	public function edit_doc_cat($id = '')
	{
		$data['active'] = 'edit_doc_cat';
		$data['page_title'] = 'Edit Doctor Category';


		$data['doctor_cat'] = $this->admin_model->select_with_where2('*', 'status=1 and id = "' . $id . '"', 'doc_category');

		$this->load->view('doctor/edit_doc_cat', $data);
	}

	public function edit_doc_cat_post($id = '')
	{
		$val['category'] = $_POST['doc_cat'];

		$this->load->admin_model->update_function2('id="' . $id . '"', 'doc_category', $val);
		redirect('admin/doc_category_list', 'refresh');
	}




	// ********************* Doctor Management END ****************







	// ************** Operation Module***************


	// public function operation_list()
	// {
	// 	$data['active']='Operation List';
	// 	$data['page_title']='Manage Operation List';
	// 	$data['admin_type']=$this->session->userdata['logged_in']['role'];



	// 	$data['operation']=$this->admin_model->select_with_where2('*','operation_status=1','operation_info'); 
	// 	$this->load->view('ipd/operation_list',$data);

	// }

	// public function add_new_operation()
	// {
	// 	$data['active']='Add Operation';
	// 	$data['page_title']='Manage Operation';
	// 	$data['admin_type']=$this->session->userdata['logged_in']['role'];



	// 	$this->load->view('ipd/add_operation',$data);
	// } 

	// public function add_operation_post()
	// {


	// 	$data['user_id']=$this->input->post('user_id'); 
	// 	$data['hospital_id']=$this->input->post('hospital_id');
	// 	$data['operation_name']=$this->input->post('operation_name'); 
	// 	$data['price']=$this->input->post('operation_price');  
	// 	$data['created_at']=date('Y-m-d H:i:s');   
	// 	$this->admin_model->insert_ret('operation_info',$data); 
	// 	$this->session->set_flashdata('Successfully','Operation Successfully Done..!'); 
	// 	redirect('admin/operation_list','refresh'); 
	// } 


	// public function edit_operation($operation_id)
	// {
	// 	$operation_id=$operation_id;
	// 	$data['active']='Add Operation';
	// 	$data['page_title']='Manage Operation';
	// 	$data['admin_type']=$this->session->userdata['logged_in']['role'];


	// 	$data['operation']=$this->admin_model->select_with_where2('*','id="'.$operation_id.'"','operation_info');
	// 	$data['opearion_id']=$data['operation'][0]['id'];
	// 	$data['price']=$data['operation'][0]['price'];
	// 	$data['operation_name']=$data['operation'][0]['operation_name'];

	// 	;
	// 	$this->load->view('ipd/edit_operation',$data);
	// } 

	// public function edit_operation_post()
	// {

	// 	$operation_id=$this->input->post('operation_id'); 
	// 	$data['user_id']=$this->input->post('user_id'); 
	// 	$data['hospital_id']=$this->input->post('hospital_id');
	// 	$data['operation_name']=$this->input->post('operation_name'); 
	// 	$data['price']=$this->input->post('operation_price');  
	// 	$data['updated_at']=date('Y-m-d H:i:s');   
	// 	$this->admin_model->update_function2('id="'.$operation_id.'"','operation_info',$data); 
	// 	$this->session->set_flashdata('Successfully','Operation Successfully Updated..!'); 
	// 	redirect('admin/operation_list','refresh'); 
	// } 


	// public function delete_operation($operation_id)
	// {

	// 	$operation_id=$operation_id; 
	// 	$data['operation_status']=2;
	// 	$data['updated_at']=date('Y-m-d H:i:s');   
	// 	$this->admin_model->update_function2('id="'.$operation_id.'"','operation_info',$data); 
	// 	$this->session->set_flashdata('Successfully','Operation Successfully Deleted..!'); 
	// 	redirect('admin/operation_list','refresh'); 
	// }  





	// public function add_ipd_patient_operation()
	// {
	// 	$data['active']='Add Operation';
	// 	$data['page_title']='Manage Operation';
	// 	$data['admin_type']=$this->session->userdata['logged_in']['role'];


	// 	$data['doctor_list']=$this->admin_model->select_all_decending('doctor');
	// 	$data['operation_list']=$this->admin_model->select_all_decending('operation_info');
	// 	$data['operation_patient_list']=$this->admin_model->select_all_decending('operation_patient_list');
	// 	$this->load->view('ipd/add_ipd_patient_operation',$data);

	// }  




	// public function search_ipd_patient($patient_id)
	// {
	// 	$patient_id=$patient_id;

	// 	$data['patient_det']=$this->admin_model->select_with_where2('*','patient_info_id="'.$patient_id.'"','ipd_patient_info');      	
	// 	if(count($data['patient_det'])>0)
	// 	{
	// 		$data['patient_info_id']=$data['patient_det'][0]['patient_info_id'];
	// 		$id=$data['patient_det'][0]['id'];
	// 		$patient_name=$data['patient_det'][0]['patient_name'];
	// 		$data['email']=$data['patient_det'][0]['email'];
	// 		$data['ref_doctor_name']=$data['patient_det'][0]['ref_doctor_name'];
	// 		$mobile_no=$data['patient_det'][0]['mobile_no'];
	// 		$data['ref_doc_name_t']=$data['patient_det'][0]['ref_doc_name_t'];

	// 		$parents_name=$data['patient_det'][0]['parents_name'];
	// 		$parents_contact=$data['patient_det'][0]['parents_contact'];
	// 		$parents_address=$data['patient_det'][0]['parents_address'];

	// 		$gurdian_name=$data['patient_det'][0]['gurdian_name'];
	// 		$gurdian_add=$data['patient_det'][0]['gurdian_add'];
	// 		$gurdian_contact=$data['patient_det'][0]['gurdian_contact'];
	// 		echo "<input class='form-control form-control-sm' value='$id' type='hidden'name='patient_mid'>
	// 		"; 

	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Patient Name</label>
	// 		<div class='col-sm-10'>	
	// 		<input class='form-control form-control-sm' value='$patient_name' name='patient_name'>
	// 		</div>                               
	// 		</div>"; 
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Patient Mobile No</label>
	// 		<div class='col-sm-10'>	
	// 		<input class='form-control form-control-sm' value='$mobile_no' name='mobile_no'>
	// 		</div>                               
	// 		</div>"; 
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Parents Name</label>
	// 		<div class='col-sm-10'>	
	// 		<input class='form-control form-control-sm' value='$parents_name' name='parents_name'>
	// 		</div>                               
	// 		</div>"; 
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Parents Mobile No</label>
	// 		<div class='col-sm-10'>	
	// 		<input class='form-control form-control-sm' value='$parents_contact' name='parents_contact'>
	// 		</div>                               
	// 		</div>";                        
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Parents Address</label>
	// 		<div class='col-sm-10'>	
	// 		<textarea name='parents_address'class='form-control'>$parents_address</textarea>
	// 		</div>                               
	// 		</div>";  
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Gurdian Name</label>
	// 		<div class='col-sm-10'>	
	// 		<input class='form-control form-control-sm' value='$gurdian_name' name='gurdian_name'>
	// 		</div>                               
	// 		</div>";  
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Gurdian Mobile No</label>
	// 		<div class='col-sm-10'>	
	// 		<input class='form-control form-control-sm' value='$gurdian_contact' name='gurdian_contact'>
	// 		</div>                               
	// 		</div>";  

	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Gurdian Address</label>
	// 		<div class='col-sm-10'>

	// 		<textarea name='gurdian_add'class='form-control'>$gurdian_add</textarea> 
	// 		</div>

	// 		</div>";  

	// 	} 
	// 	else
	// 	{
	// 		echo "No Data found..!";
	// 	}



	// } 


	// public function search_operation_cost($operationid)
	// {
	// 	$operationid=$operationid;

	// 	$data['operation_det']=$this->admin_model->select_with_where2('*','id="'.$operationid.'"','operation_info');      	
	// 	if(count($data['operation_det'])>0)
	// 	{

	// 		$operation_title=$data['operation_det'][0]['operation_name']; 
	// 		$operation_price=$data['operation_det'][0]['price']; 
	// 		echo "<input class='form-control form-control-sm' id='operation_title' value='$operation_title' name='operation_title' type='hidden' readonly>";		
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Operation Cost</label>
	// 		<div class='col-sm-10'>
	// 		<input class='form-control form-control-sm' id='Operation_cost' value='$operation_price' name='Operation_cost' onkeyup='sum();' readonly>
	// 		</div>

	// 		</div>";
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Operation Discount</label>
	// 		<div class='col-sm-10'>
	// 		<input class='form-control form-control-sm' id='discount_operation' name='discount' onkeyup='sum();'>
	// 		</div>

	// 		</div>";
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Total </label>
	// 		<div class='col-sm-10'>
	// 		<input class='form-control form-control-sm' id='total_operation' name='total' onkeyup='sum_n()' readonly >
	// 		</div>

	// 		</div>";
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Discount Ref</label>
	// 		<div class='col-sm-10'>
	// 		<input class='form-control form-control-sm' name='discount_ref' >
	// 		</div>

	// 		</div>";

	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Advance</label>
	// 		<div class='col-sm-10'>
	// 		<input class='form-control form-control-sm' id='advance' name='advance' onkeyup='sum_n()'>
	// 		</div>

	// 		</div>"; 
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Due</label>
	// 		<div class='col-sm-10'>
	// 		<input class='form-control form-control-sm' id='due' name='due' readonly>
	// 		</div>

	// 		</div>";

	// 		echo "<div class='form-group><div class='col-sm-10'><button type='submit' class='btn btn-success'>Submit</button>
	// 		</div> </div>";

	// 	}
	// 	else
	// 	{

	// 	}
	// }


	// public function operation_entry()
	// {

	// 	$data['add_by']=$this->input->post('user_id');	
	// 	$data['hospital_id']=$this->input->post('hospital_id');	
	// 	$data['patient_id']=$this->input->post('patient_mid');
	// 	$data['patient_info_id']=$this->input->post('patient_id');
	// 	$data['operation_id']=$this->input->post('operation_id');

	//        // "<pre>";print_r($data);die();
	// 	$data['ref_doc_name']=$this->input->post('ref_doc_name');
	// 	$data['ref_doc_name_q']=$this->input->post('ref_doc_name_q');
	// 	$data['patient_name']=$this->input->post('patient_name');
	// 	$data['mobile_no']=$this->input->post('mobile_no');		
	// 	$data['parents_name']=$this->input->post('parents_name');	
	// 	$data['parents_contact']=$this->input->post('parents_contact');	
	// 	$data['parents_address']=$this->input->post('parents_address');	
	// 	$data['gurdian_name']=$this->input->post('gurdian_name');	
	// 	$data['operation_cost']=$this->input->post('operation_cost');
	// 	$data['discount']=$this->input->post('discount');
	// 	$data['discount_ref']=$this->input->post('discount_ref');
	// 	$data['total']=$this->input->post('total');
	// 	$data['advance']=$this->input->post('advance');
	// 	$data['due']=$this->input->post('due');
	// 	$data['created_at']=date('Y-m-d H:i:s'); 
	// 	$data['updated_at']=date('Y-m-d H:i:s'); 
	// 	$data['Operation_title']=$this->input->post('operation_title');
	//        //below for operation account entry


	// 	$due=$data['due'];
	// 	$servcie=$this->load->admin_model->insert_ret('operation_patient_list',$data);

	// 	if($due!=0)
	// 	{
	// 		$due_data['total_due']=$this->input->post('due');
	// 		$due_data['total_amnt']=$this->input->post('total');
	// 		$due_data['total_paid']=$this->input->post('advance');
	// 		$due_data['recv_by']=$this->input->post('user_id');
	// 		$due_data['patient_id']=$this->input->post('patient_mid');
	// 		$due_data['patient_info_id']=$this->input->post('patient_id');
	// 		$due_data['add_date']=date('Y-m-d');
	// 		$due_data['service_type']=1;  
	// 		$due_data['service_id']=$servcie;  
	// 		$this->load->admin_model->insert('ipd_patient_due_history',$due_data);	
	// 	}
	// 	redirect('admin/add_ipd_patient_operation','refresh');

	//        //upper for operation account entry  

	// } 



	// public function add_ipd_patient_service()
	//    {
	// $data['active']='Add Service';
	// $data['page_title']='Manage Service';
	// $data['admin_type']=$this->session->userdata['logged_in']['role'];
	// if($data['admin_type']==3)
	// {
	// 	$data['username']=$this->session->userdata['logged_in']['username'];
	// 	$data['hospital_id']=$this->session->userdata['logged_in']['hospital_id'];
	// 	$id=$data['hospital_id'];
	// 	$data['hospital']=$this->admin_model->select_with_where2('*','hospital_id="'.$id.'"','hospital');
	// 	$data['hospital_ttile']=$data['hospital'][0]['hospital_title'];
	//    }
	//        else
	//    {

	// 	$data['username']=$this->session->userdata['logged_in']['username'];
	// 	$data['hospital_id']="";
	// 	$id="";
	// 	$data['hospital']="";
	// 	$data['hospital_ttile']="Admin";

	//    } 	
	//      $data['doctor_list']=$this->admin_model->select_all_decending('doctor');
	//      $data['service_info']=$this->admin_model->select_all_decending('service_info');
	//      $data['service_patient_list']=$this->admin_model->select_all_decending('service_patient_list');
	//      $this->load->view('ipd/add_ipd_patient_service',$data);

	//    }


	// public function search_service_cost($operationid)
	// {
	// 	$service_id=$operationid;
	// 	$data['service_det']=$this->admin_model->select_with_where2('*','id="'.$service_id.'"','service_info');      	
	// 	if(count($data['service_det'])>0)
	// 	{
	// 		

	// 		

	// 		$service_title=$data['service_det'][0]['service_name']; 
	// 		$service_cost=$data['service_det'][0]['service_price']; 
	// 		echo "<input class='form-control form-control-sm' id='service_title' value='$service_title' name='service_title' type='hidden' readonly>";		
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Service Cost</label>
	// 		<div class='col-sm-10'>
	// 		<input class='form-control form-control-sm' id='service_cost' value='$service_cost' name='service_cost' onkeyup='sum()' readonly>
	// 		</div>

	// 		</div>";
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Service Discount</label>
	// 		<div class='col-sm-10'>
	// 		<input class='form-control form-control-sm' id='s_discount' name='discount' onkeyup='sum()'>
	// 		</div>

	// 		</div>";
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Total </label>
	// 		<div class='col-sm-10'>
	// 		<input class='form-control form-control-sm' id='total' name='total' readonly onkeyup='sum_n()'>
	// 		</div>

	// 		</div>";
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Discount Ref</label>
	// 		<div class='col-sm-10'>
	// 		<input class='form-control form-control-sm' name='discount_ref' >
	// 		</div>

	// 		</div>";

	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Advance</label>
	// 		<div class='col-sm-10'>
	// 		<input class='form-control form-control-sm' id='advance' onkeyup='sum_n()' name='advance' >
	// 		</div>

	// 		</div>"; 
	// 		echo "<div class='form-group>             
	// 		<label for='' class='col-sm-12 control-label'>Due</label>
	// 		<div class='col-sm-10'>
	// 		<input class='form-control form-control-sm' name='due' id='due' readonly>
	// 		</div>

	// 		</div>"; 
	// 		echo "<div class='form-group><div class='col-sm-10'><button type='submit' class='btn btn-success'>Submit</button>
	// 		</div> </div>";

	// 	}
	// 	else
	// 	{

	// 	}
	// }    

	// public function service_patient_entry()
	// {

	// 	$data['add_by']=$this->input->post('user_id');	
	// 	$data['hospital_id']=$this->input->post('hospital_id');	
	// 	$data['patient_id']=$this->input->post('patient_mid');
	// 	$data['patient_info_id']=$this->input->post('patient_id');
	// 	$data['service_id']=$this->input->post('service_id');
	// 	$data['ref_doc_name']=$this->input->post('ref_doc_name');
	// 	$data['ref_doc_name_q']=$this->input->post('ref_doc_name_q');
	// 	$data['patient_name']=$this->input->post('patient_name');
	// 	$data['mobile_no']=$this->input->post('mobile_no');		
	// 	$data['parents_name']=$this->input->post('parents_name');	
	// 	$data['parents_contact']=$this->input->post('parents_contact');	
	// 	$data['parents_address']=$this->input->post('parents_address');	
	// 	$data['gurdian_name']=$this->input->post('gurdian_name');	
	// 	$data['service_cost']=$this->input->post('service_cost');
	// 	$data['discount']=$this->input->post('discount');
	// 	$data['discount_ref']=$this->input->post('discount_ref');
	// 	$data['total']=$this->input->post('total');
	// 	$data['advance']=$this->input->post('advance');
	// 	$data['due']=$this->input->post('due');
	// 	$data['created_at']=date('Y-m-d H:i:s'); 
	// 	$data['updated_at']=date('Y-m-d H:i:s'); 
	// 	$data['service_title']=$this->input->post('service_title');
	//        //below for operation account entry
	// 	$due=$data['due'];
	// 	$servcie=$this->load->admin_model->insert_ret('service_patient_list',$data);
	// 	if($due!=0)
	// 	{
	// 		$due_data['total_due']=$this->input->post('due');
	// 		$due_data['total_amnt']=$this->input->post('total');
	// 		$due_data['total_paid']=$this->input->post('advance');
	// 		$due_data['recv_by']=$this->input->post('user_id');
	// 		$due_data['patient_id']=$this->input->post('patient_mid');
	// 		$due_data['patient_info_id']=$this->input->post('patient_id');
	// 		$due_data['add_date']=date('Y-m-d');
	// 		$due_data['service_type']=2;  
	// 		$due_data['service_id']=$servcie;  
	// 		$this->load->admin_model->insert('ipd_patient_due_history',$due_data);	
	// 	}

	// 	redirect('admin/add_ipd_patient_service','refresh');

	//        //upper for operation account entry  

	// } 


	// public function operation_due_collection($order_id,$patient_info_id,$patient_id,$order_type)
	// {

	// 	$data['order_id']=$order_id;
	// 	$data['patient_info_id']=$patient_info_id;
	// 	$data['patient_id']=$patient_id;
	// 	$data['order_type']=$order_type;
	// 	$data['active']='Due Collection';
	// 	$data['page_title']='Manage Due Collection';
	// 	$data['admin_type']=$this->session->userdata['logged_in']['role'];


	// 	if($order_type==1)
	// 	{

	// 		$data['operation_de']=$this->admin_model->select_with_where2('*','opid="'.$order_id.'"','operation_patient_list'); 
	// 		$data['patient_name']=$data['operation_de'][0]['patient_name'];
	// 		$data['mobile_no']=$data['operation_de'][0]['mobile_no'];
	// 		$data['operation_title']=$data['operation_de'][0]['operation_title'];
	// 		$data['operation_cost']=$data['operation_de'][0]['operation_cost'];
	// 		$data['advance']=$data['operation_de'][0]['advance'];
	// 		$data['due']=$data['operation_de'][0]['due'];

	// 		$data['ipd_patient_due_history']=$this->admin_model->select_with_where2('*','service_id="'.$order_id.'"','ipd_patient_due_history');  

	// 		$data['due_id']=$data['ipd_patient_due_history'][0]['due_id'];
	// 		$this->load->view('ipd/due_collection',$data);

	// 	}
	// 	elseif($order_type==2)
	// 	{
	// 		$data['service_de']=$this->admin_model->select_with_where2('*','sid="'.$order_id.'"','service_patient_list'); 
	// 		$data['patient_name']=$data['service_de'][0]['patient_name'];
	// 		$data['mobile_no']=$data['service_de'][0]['mobile_no'];
	// 		$data['operation_title']=$data['service_de'][0]['operation_title'];
	// 		$data['operation_cost']=$data['service_de'][0]['operation_cost'];
	// 		$data['advance']=$data['service_de'][0]['advance'];
	// 		$data['due']=$data['service_de'][0]['due'];
	// 		$data['ipd_patient_due_history']=$this->admin_model->select_with_where2('*','service_id="'.$order_id.'"','ipd_patient_due_history');  
	// 		$data['due_id']=$data['ipd_patient_due_history'][0]['due_id'];
	//  // $this->load->view('ipd/due_collection', $data, FALSE);	
	// 		$this->load->view('ipd/due_collection',$data);
	// 	}




	// }



	// ************************ Operation/service END ************






	// **************** Accounting Module Starts ******************

	public function head_list()
	{

		$data['active'] = 'head_list';
		$data['page_title'] = 'Account Head List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		// $data['acc_head']=$this->admin_model->select_join('acc_head_title,acc_head_code,group_title,current_balance,opening_balance,head_id','acc_head','acc_group','acc_group.groupid=acc_head.group_id');   


		// $data['acc_head']=$this->admin_model->select_join_where('*','acc_head h','acc_group g','h.group_id=g.groupid','head_status=1');


		$this->load->view('account/acc_head_list', $data);
	}

	public function head_list_dt($value = '')
	{
		$select_column = '*';
		$condition = "head_status=1";

		$order_column = array('head_id', 'acc_head_title', 'acc_head_code', 'group_title');

		$search_column = array('head_id', 'acc_head_title', 'acc_head_code', 'group_title');

		$fetch_data = $this->admin_model->make_datatables_two_table_join('acc_head h', $condition, $select_column, $order_column, $search_column, 'acc_group g', 'h.group_id=g.groupid', 'head_id');
		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = '<span>' . $row->acc_head_title . '</span>';
			$sub_array[] = '<span >' . $row->acc_head_code . '</span>';
			$sub_array[] = '<span >' . $row->group_title . '</span>';

			$sub_array[] = '<span><a href="admin/edit_acc_head/' . $row->head_id . '">Edit</a></span><span class="ml-3"><a href="admin/delete_head/' . $row->head_id . '">Delete</a></span>';

			$sub_array[] = '<span >' . date("d-m-Y", strtotime($row->add_date_time)) . '</span>';


			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('acc_head h', $condition, $select_column, 'acc_group g', 'h.group_id=g.groupid'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
				'acc_head h',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'acc_group g',
				'h.group_id=g.groupid',
				'head_id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	public function add_acc_head()
	{

		$data['active'] = 'Acc_head';
		$data['page_title'] = 'Manage Acc Head';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		// $data['acc_head']=$this->admin_model->select_join('acc_head_title,acc_head_code,group_title,current_balance,opening_balance,groupid','acc_head','acc_group','acc_group.groupid=acc_head.group_id');   
		$data['group'] = $this->admin_model->select_all('acc_group');

		$this->load->view('account/add_acc_head', $data);
	}



	public function acc_head_add_post()
	{
		$add_by = $this->input->post('add_by');
		$acc_head_title = $this->input->post('acc_head_title');
		$hospital_id = $this->input->post('hospital_id');
		$open_balance = $this->input->post('open_balance');
		$group_id = $this->input->post('group_id');
		$acc_cod = $this->input->post('acc_code');

		$data = array(
			'acc_head_title' => $acc_head_title,
			'acc_head_code' => $acc_cod,
			'hospital_id' => $hospital_id,
			'add_date' => date('Y-m-d'),
			'add_date_time' => date('Y-m-d H:i:s'),
			'group_id' => $group_id,
			'opening_balance' => $open_balance,
			'add_by' => $add_by
		);

		$this->load->admin_model->insert_ret('acc_head', $data);

		$this->session->set_flashdata('Successfully', 'A/C Head Successfully Added');
		redirect('admin/head_list', 'refresh');
	}
	public function edit_acc_head($acc_head_id)
	{
		$acc_head_id = $acc_head_id;

		$data['active'] = 'Acc_head';
		$data['page_title'] = 'Manage Acc Head';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['acc_head'] = $this->admin_model->select_join_where('acc_head_title,acc_head_code,group_title,current_balance,opening_balance,groupid,head_id', 'acc_head', 'acc_group', 'acc_group.groupid=acc_head.group_id', 'head_id="' . $acc_head_id . '"');

		$data['head_id'] = $data['acc_head'][0]['head_id'];
		$data['acc_head_title'] = $data['acc_head'][0]['acc_head_title'];
		$data['acc_head_code'] = $data['acc_head'][0]['acc_head_code'];
		$data['groupid'] = $data['acc_head'][0]['groupid'];
		$data['group_title'] = $data['acc_head'][0]['group_title'];
		$data['opening_balance'] = $data['acc_head'][0]['opening_balance'];
		$data['group'] = $this->admin_model->select_all('acc_group');
		$this->load->view('account/edit_acc_head', $data);
	}

	public function delete_head($value = '')
	{
		$head_id = $this->uri->segment(3);

		$val['head_status'] = 2;

		$this->load->admin_model->update_function2('head_id="' . $head_id . '"', 'acc_head', $val);

		redirect('admin/head_list', 'refresh');
	}


	public function edit_head_add_post()
	{
		$acc_head_id = $this->input->post('acc_head_id');
		$acc_head_title = $this->input->post('acc_head_title');
		$open_balance = $this->input->post('open_balance');
		$group_id = $this->input->post('group_id');
		$acc_code = $this->input->post('acc_code');

		$data = array(

			'acc_head_code' => $acc_code,
			'acc_head_title' => $acc_head_title,
			'group_id' => $group_id,
			'opening_balance' => $open_balance

		);

		$this->load->admin_model->update_function2('head_id="' . $acc_head_id . '"', 'acc_head', $data);

		$this->session->set_flashdata('Successfully', 'A/C Head Successfully Added');
		redirect('admin/head_list', 'refresh');
	}

	public function income_pdf($income_id = '')
	{
		$data['income_info'] = $this->admin_model->select_join_three_table2('*,ai.id', 'acc_head h', 'acc_group g', 'add_income_expense ai', 'h.group_id=g.groupid', 'ai.acc_head_id=h.head_id', 'g.groupid=3 AND ai.status=1 and ai.id="' . $income_id . '"');

		$data['flag'] = 'INCOME';

		$this->load->view('account/income_expense_asset_pdf', $data);
	}


	public function expense_pdf($expense_id = '')
	{
		$data['income_info'] = $this->admin_model->select_join_three_table2('*,ai.id', 'acc_head h', 'acc_group g', 'add_income_expense ai', 'h.group_id=g.groupid', 'ai.acc_head_id=h.head_id', 'g.groupid=4 AND ai.status=1 and ai.id="' . $expense_id . '"');

		$data['flag'] = 'EXPENSE';

		$this->load->view('account/income_expense_asset_pdf', $data);
	}


	public function asset_pdf($asset_id = '')
	{
		$data['income_info'] = $this->admin_model->select_join_three_table2('*,ai.id', 'acc_head h', 'acc_group g', 'add_income_expense ai', 'h.group_id=g.groupid', 'ai.acc_head_id=h.head_id', 'g.groupid=1 AND ai.status=1 and ai.id="' . $asset_id . '"');

		$data['flag'] = 'ASSET';

		$this->load->view('account/income_expense_asset_pdf', $data);
	}




	public function income_list()
	{

		$data['active'] = 'income_list';
		$data['page_title'] = 'Income List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['acc_head_info_inc'] = $this->admin_model->select_with_where2('*', 'group_id=3 AND head_status=1', 'acc_head');

		$data['acc_head_income'] = $this->admin_model->select_with_where2('*', 'group_id=3', 'acc_head');

		$this->load->view('account/income_list', $data);
	}


	public function income_list_dt($value = '')
	{
		$select_column = '*,ai.id';
		$order_column = array('id', 'acc_head_title', 'acc_head_code', 'challan_no', 'income_expense_purpose', 'group_title', 'total_amount');

		$search_column = array('id', 'acc_head_title', 'acc_head_code', 'challan_no', 'income_expense_purpose', 'group_title', 'total_amount');


		$condition = "g.groupid=3 AND ai.status=1 and date(ai.created_at)='" . date('Y-m-d') . "'";


		$fetch_data = $this->admin_model->make_datatables_three_table_join('acc_head h', $condition, $select_column, $order_column, $search_column, 'acc_group g', 'h.group_id=g.groupid', 'add_income_expense ai', 'ai.acc_head_id=h.head_id', 'ai.id');



		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->acc_head_title;
			$sub_array[] = $row->acc_head_code;
			$sub_array[] = $row->challan_no;
			$sub_array[] = $row->income_expense_purpose;
			$sub_array[] = $row->inc_exp_ref;

			$paid_by = "";


			if ($row->paid_by == 1) {
				$paid_by = "Cash";
			} elseif ($row->paid_by == 2) {
				$paid_by = "Check";
			} else {
				$paid_by = "Bkash";
			}

			$sub_array[] = $paid_by;
			$sub_array[] = $row->total_paid;
			$sub_array[] = date('d-m-Y h:i:s a', strtotime($row->created_at));
			$sub_array[] = $row->operator_name;

			$sub_array[] = '<span><a href="admin/income_pdf/' . $row->id . '">Print</a></span>';

			$sub_array[] = '<span><a href="admin/edit_income/' . $row->id . '">Edit</a></span><span class="ml-3"><a href="admin/delete_income/' . $row->id . '">Delete</a></span>';

			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_three_table_join('acc_head h', $condition, $select_column, 'acc_group g', 'h.group_id=g.groupid', 'add_income_expense ai', 'ai.acc_head_id=h.head_id'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_three_table_join(
				'acc_head h',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'acc_group g',
				'h.group_id=g.groupid',
				'add_income_expense ai',
				'ai.acc_head_id=h.head_id',
				'ai.id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}



	public function income_list_date_wise()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$income_head_id = $this->input->post('income_head_id');

		redirect('admin/income_list_date_wise_next/' . $start_date . '/' . $end_date . '/' . $income_head_id);
	}

	public function income_list_date_wise_next($start_date, $end_date, $income_head_id)
	{

		$data['acc_head_income'] = $this->admin_model->select_with_where2('*', 'group_id=3', 'acc_head');

		if ($income_head_id != "all") {
			$data['acc_head'] = $this->admin_model->select_join_three_table2('*,ai.id', 'acc_head h', 'acc_group g', 'add_income_expense ai', 'h.group_id=g.groupid', 'ai.acc_head_id=h.head_id', 'g.groupid=3 AND ai.status=1 and h.head_id="' . $income_head_id . '"');

			$data['flag'] = "";

			// "<pre>";print_r($data["test_count"]);die();
		} else {

			$data['acc_head'] = $this->admin_model->select_join_three_table2('*', 'acc_head h', 'acc_group g', 'add_income_expense ai', 'h.group_id=g.groupid', 'ai.acc_head_id=h.head_id', 'g.groupid=3 AND ai.status=1');
			$data['flag'] = "all";
		}



		// "<pre>";print_r($data["ipd_collection_info"]);die();

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('account/income_list_date_wise_report', $data);
	}



	public function add_income_post($value = '')
	{
		$data['active'] = 'account';
		$data['page_title'] = 'Add Income';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['acc_head_info_inc'] = $this->admin_model->select_with_where2('*', 'group_id=3 AND head_status=1', 'acc_head');


		$val = array(
			'acc_head_id' => $this->input->post('acc_head'),
			'challan_no' => $this->input->post('challan_no'),
			'income_expense_purpose' => $this->input->post('income_expense_purpose'),
			'total_amount' => $this->input->post('amount'),
			'total_paid' => $this->input->post('amount'),
			'paid_by' => $this->input->post('optradio'),
			'bank_acc_no' => $this->input->post('acc_no'),
			'check_no' => $this->input->post('check_no'),
			'check_pass_date' => $this->input->post('check_pass_date'),

			'bkash_no' => $this->input->post('bkash_no'),
			'tx_id' => $this->input->post('tx_id'),
			'inc_exp_ref' => $this->input->post('income_ref'),
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],
			'type' => 1,
			'created_at' => date('Y-m-d H:i:s'),


		);




		$inc_exp_id = $this->load->admin_model->insert_ret('add_income_expense', $val);

		$autogenerated_id = $inc_exp_id;
		$autogenerated_id = sprintf("%'.06d", ($autogenerated_id));
		$autogenerated_id = $autogenerated_id . '_' . date('YmdHis') . '_' . $this->session->userdata['logged_in']['hospital_id'];

		$autogenerated_id = array('auto_gen_id' => $autogenerated_id);

		$this->load->admin_model->update_function('id', $inc_exp_id, 'add_income_expense', $autogenerated_id);

		redirect('admin/income_list');
	}

	public function expense_list()
	{

		$data['active'] = 'expense_list';
		$data['page_title'] = 'Expense List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['acc_head_income'] = $this->admin_model->select_with_where2('*', 'group_id=4', 'acc_head');
		$data['acc_head_info_exp'] = $this->admin_model->select_with_where2('*', 'group_id=4 AND head_status=1', 'acc_head');

		$this->load->view('account/expense_list', $data);
	}

	public function expense_list_dt($value = '')
	{
		$select_column = '*,ai.id';
		$order_column = array('id', 'acc_head_title', 'acc_head_code', 'challan_no', 'income_expense_purpose', 'group_title', 'total_amount');

		$search_column = array('id', 'acc_head_title', 'acc_head_code', 'challan_no', 'income_expense_purpose', 'group_title', 'total_amount');


		$condition = "g.groupid=4 AND ai.status=1 and date(ai.created_at)='" . date('Y-m-d') . "'";


		$fetch_data = $this->admin_model->make_datatables_three_table_join('acc_head h', $condition, $select_column, $order_column, $search_column, 'acc_group g', 'h.group_id=g.groupid', 'add_income_expense ai', 'ai.acc_head_id=h.head_id', 'ai.id');



		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->acc_head_title;
			$sub_array[] = $row->acc_head_code;
			$sub_array[] = $row->challan_no;
			$sub_array[] = $row->income_expense_purpose;
			$sub_array[] = $row->inc_exp_ref;

			$paid_by = "";


			if ($row->paid_by == 1) {
				$paid_by = "Cash";
			} elseif ($row->paid_by == 2) {
				$paid_by = "Check";
			} else {
				$paid_by = "Bkash";
			}

			$sub_array[] = $paid_by;
			$sub_array[] = $row->total_paid;
			$sub_array[] = date('d-m-Y h:i:s a', strtotime($row->created_at));
			$sub_array[] = $row->operator_name;

			$sub_array[] = '<span><a href="admin/expense_pdf/' . $row->id . '">Print</a></span>';

			$sub_array[] = '<span><a href="admin/edit_expense/' . $row->id . '">Edit</a></span><span class="ml-3"><a href="admin/delete_expense/' . $row->id . '">Delete</a></span>';

			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_three_table_join('acc_head h', $condition, $select_column, 'acc_group g', 'h.group_id=g.groupid', 'add_income_expense ai', 'ai.acc_head_id=h.head_id'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_three_table_join(
				'acc_head h',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'acc_group g',
				'h.group_id=g.groupid',
				'add_income_expense ai',
				'ai.acc_head_id=h.head_id',
				'ai.id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	public function expense_list_date_wise()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$expense_head_id = $this->input->post('income_head_id');

		redirect('admin/expense_list_date_wise_next/' . $start_date . '/' . $end_date . '/' . $expense_head_id);
	}

	public function expense_list_date_wise_next($start_date, $end_date, $expense_head_id)
	{

		$data['acc_head_income'] = $this->admin_model->select_with_where2('*', 'group_id=4', 'acc_head');

		if ($expense_head_id != "all") {
			$data['acc_head'] = $this->admin_model->select_join_three_table2('*,ai.id', 'acc_head h', 'acc_group g', 'add_income_expense ai', 'h.group_id=g.groupid', 'ai.acc_head_id=h.head_id', 'g.groupid=4 AND ai.status=1 and h.head_id="' . $expense_head_id . '"');

			$data['flag'] = "";

			// "<pre>";print_r($data["test_count"]);die();
		} else {

			$data['acc_head'] = $this->admin_model->select_join_three_table2('*', 'acc_head h', 'acc_group g', 'add_income_expense ai', 'h.group_id=g.groupid', 'ai.acc_head_id=h.head_id', 'g.groupid=4 AND ai.status=1');
			$data['flag'] = "all";
		}


		// "<pre>";print_r($data["ipd_collection_info"]);die();

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('account/income_list_date_wise_report', $data);
	}

	public function add_expense_post($value = '')
	{

		$val = array(
			'acc_head_id' => $this->input->post('acc_head'),
			'challan_no' => $this->input->post('challan_no'),
			'income_expense_purpose' => $this->input->post('income_expense_purpose'),
			'total_amount' => $this->input->post('amount'),
			'total_paid' => $this->input->post('amount'),
			'paid_by' => $this->input->post('optradio'),
			'bank_acc_no' => $this->input->post('acc_no'),
			'check_no' => $this->input->post('check_no'),
			'check_pass_date' => $this->input->post('check_pass_date'),

			'bkash_no' => $this->input->post('bkash_no'),
			'tx_id' => $this->input->post('tx_id'),
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],
			'type' => 2,
			'created_at' => date('Y-m-d H:i:s'),
			'inc_exp_ref' => $this->input->post('expense_ref')


		);

		$inc_exp_id = $this->load->admin_model->insert_ret('add_income_expense', $val);

		$autogenerated_id = $inc_exp_id;
		$autogenerated_id = sprintf("%'.06d", ($autogenerated_id));
		$autogenerated_id = $autogenerated_id . '_' . date('YmdHis') . '_' . $this->session->userdata['logged_in']['hospital_id'];

		$autogenerated_id = array('auto_gen_id' => $autogenerated_id);

		$this->load->admin_model->update_function('id', $inc_exp_id, 'add_income_expense', $autogenerated_id);

		redirect('admin/expense_list', 'refresh');
	}



	public function asset_list()
	{

		$data['active'] = 'asset_list';
		$data['page_title'] = 'Asset List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['acc_head_info_asset'] = $this->admin_model->select_with_where2('*', 'group_id=1 AND head_status=1', 'acc_head');
		$data['acc_head_income'] = $this->admin_model->select_with_where2('*', 'group_id=1', 'acc_head');



		$this->load->view('account/asset_list', $data);
	}


	public function asset_list_dt($value = '')
	{
		$select_column = '*,ai.id';
		$order_column = array('id', 'acc_head_title', 'acc_head_code', 'challan_no', 'income_expense_purpose', 'group_title', 'total_amount');

		$search_column = array('id', 'acc_head_title', 'acc_head_code', 'challan_no', 'income_expense_purpose', 'group_title', 'total_amount');


		$condition = "g.groupid=1 AND ai.status=1";


		$fetch_data = $this->admin_model->make_datatables_three_table_join('acc_head h', $condition, $select_column, $order_column, $search_column, 'acc_group g', 'h.group_id=g.groupid', 'add_income_expense ai', 'ai.acc_head_id=h.head_id', 'ai.id');



		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->acc_head_title;
			$sub_array[] = $row->acc_head_code;
			$sub_array[] = $row->challan_no;
			$sub_array[] = $row->income_expense_purpose;
			$sub_array[] = $row->inc_exp_ref;

			$paid_by = "";


			if ($row->paid_by == 1) {
				$paid_by = "Cash";
			} elseif ($row->paid_by == 2) {
				$paid_by = "Check";
			} else {
				$paid_by = "Bkash";
			}

			$sub_array[] = $paid_by;
			$sub_array[] = $row->per_amount;
			$sub_array[] = $row->qty;
			$sub_array[] = $row->total_paid;
			$sub_array[] = date('d-m-Y h:i:s a', strtotime($row->created_at));
			$sub_array[] = $row->operator_name;

			$sub_array[] = '<span><a href="admin/asset_pdf/' . $row->id . '">Print</a></span>';

			$sub_array[] = '<span><a href="admin/edit_asset/' . $row->id . '">Edit</a></span><span class="ml-3"><a href="admin/delete_asset/' . $row->id . '">Delete</a></span>';

			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_three_table_join('acc_head h', $condition, $select_column, 'acc_group g', 'h.group_id=g.groupid', 'add_income_expense ai', 'ai.acc_head_id=h.head_id'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_three_table_join(
				'acc_head h',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'acc_group g',
				'h.group_id=g.groupid',
				'add_income_expense ai',
				'ai.acc_head_id=h.head_id',
				'ai.id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	public function asset_list_date_wise()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$asset_head_id = $this->input->post('asset_head_id');

		redirect('admin/asset_list_date_wise_next/' . $start_date . '/' . $end_date . '/' . $asset_head_id);
	}

	public function asset_list_date_wise_next($start_date, $end_date, $asset_head_id)
	{

		$data['acc_head_income'] = $this->admin_model->select_with_where2('*', 'group_id=1', 'acc_head');

		if ($asset_head_id != "all") {
			$data['acc_head'] = $this->admin_model->select_join_three_table2('*,ai.id', 'acc_head h', 'acc_group g', 'add_income_expense ai', 'h.group_id=g.groupid', 'ai.acc_head_id=h.head_id', 'g.groupid=1 AND ai.status=1 and h.head_id="' . $asset_head_id . '"');

			$data['flag'] = "";

			// "<pre>";print_r($data["test_count"]);die();
		} else {

			$data['acc_head'] = $this->admin_model->select_join_three_table2('*', 'acc_head h', 'acc_group g', 'add_income_expense ai', 'h.group_id=g.groupid', 'ai.acc_head_id=h.head_id', 'g.groupid=1 AND ai.status=1');
			$data['flag'] = "all";
		}



		// "<pre>";print_r($data["ipd_collection_info"]);die();

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('account/income_list_date_wise_report', $data);
	}



	public function add_asset_post($value = '')
	{
		$data['active'] = 'account';
		$data['page_title'] = 'Add Expense';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];







		$val = array(
			'acc_head_id' => $this->input->post('acc_head'),
			'challan_no' => $this->input->post('challan_no'),
			'income_expense_purpose' => $this->input->post('income_expense_purpose'),
			'per_amount' => $this->input->post('per_amount'),
			'qty' => $this->input->post('qty'),
			'total_amount' => $this->input->post('total_amount'),
			'total_paid' => $this->input->post('total_amount'),
			'paid_by' => $this->input->post('optradio'),
			'bank_acc_no' => $this->input->post('acc_no'),
			'check_no' => $this->input->post('check_no'),
			'check_pass_date' => $this->input->post('check_pass_date'),

			'bkash_no' => $this->input->post('bkash_no'),
			'tx_id' => $this->input->post('tx_id'),
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],
			'type' => 3,
			'created_at' => date('Y-m-d H:i:s'),
			'inc_exp_ref' => $this->input->post('inc_exp_ref')


		);

		$inc_exp_id = $this->load->admin_model->insert_ret('add_income_expense', $val);

		$autogenerated_id = $inc_exp_id;
		$autogenerated_id = sprintf("%'.06d", ($autogenerated_id));
		$autogenerated_id = $autogenerated_id . '_' . date('YmdHis') . '_' . $this->session->userdata['logged_in']['hospital_id'];

		$autogenerated_id = array('auto_gen_id' => $autogenerated_id);

		$this->load->admin_model->update_function('id', $inc_exp_id, 'add_income_expense', $autogenerated_id);


		redirect('admin/asset_list');
	}


	public function expense_due_list($value = '')
	{
		$data['active'] = 'account';
		$data['page_title'] = 'Add Expense';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];




		$data['exp_due_info'] = $this->admin_model->select_join_where('*', 'add_income_expense', 'acc_head', 'acc_head_id=head_id', 'total_amount!=total_paid AND type=2');

		// "<pre>";print_r($data['exp_due_info']);die();

		$this->load->view('account/expense_due_list', $data);
	}

	public function income_due_list($value = '')
	{
		$data['active'] = 'account';
		$data['page_title'] = 'Add Expense';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];




		$data['inc_due_info'] = $this->admin_model->select_join_where('*', 'add_income_expense', 'acc_head', 'acc_head_id=head_id', 'total_amount!=total_paid AND type=1');

		$this->load->view('account/income_due_list', $data);
	}


	public function each_income_details($value = '')
	{
		$data['active'] = 'account';
		$data['page_title'] = 'Add Expense';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$inc_exp_id = $this->uri->segment(3);


		$data['inc_due_details'] = $this->admin_model->select_join_where('*', 'add_income_expense', 'acc_head', 'acc_head_id=head_id', 'id="' . $inc_exp_id . '"');

		$this->load->view('account/each_income_details', $data);
	}



	public function update_income_expense_due($value = '')
	{

		$data['active'] = 'account';
		$data['page_title'] = 'Add Expense';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];




		$inc_exp_id = $this->uri->segment(3);

		$total_paid = $this->admin_model->select_with_where2('*', 'id="' . $inc_exp_id . '"', 'add_income_expense');

		$total_paid = $total_paid[0]['total_paid'] + $this->input->post('update_inc_exp');

		$val = array('total_paid' => $total_paid);

		$this->admin_model->update_function('id', $inc_exp_id, 'add_income_expense', $val);

		redirect('admin/each_income_details/' . $inc_exp_id . '');
	}


	public function paid_income_list($value = '')
	{
		$data['active'] = 'account';
		$data['page_title'] = 'Add Expense';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];




		$data['inc_due_info'] = $this->admin_model->select_join_where('*', 'add_income_expense', 'acc_head', 'acc_head_id=head_id', 'total_amount=total_paid AND type=1');

		$this->load->view('account/paid_income_list', $data);
	}

	public function paid_expense_list($value = '')
	{
		$data['active'] = 'account';
		$data['page_title'] = 'Add Expense';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];




		$data['exp_due_info'] = $this->admin_model->select_join_where('*', 'add_income_expense', 'acc_head', 'acc_head_id=head_id', 'total_amount=total_paid AND type=2');

		$this->load->view('account/paid_expense_list', $data);
	}

	public function date_wise_report($value = '')
	{
		$data['active'] = 'account';
		$data['page_title'] = 'Add Expense';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$this->load->view('account/date_wise_report', $data);
	}


	public function date_wise_report_details($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$type_id = $this->input->post('inc_exp');

		redirect('admin/date_to_date_report/' . $start_date . '/' . $end_date . '/' . $type_id);
	}

	public function date_to_date_report($start_date, $end_date, $type_id)
	{
		$data['active'] = 'pathology_list';
		$data['page_title'] = 'OPD Daywise amount Collection';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data["inc_exp_info"] = $this->admin_model->select_join_where('*,add_income_expense.created_at', 'acc_head', 'add_income_expense', 'head_id=acc_head_id', 'add_income_expense.type="' . $type_id . '" AND add_income_expense.created_at between "' . $start_date . '" and "' . $end_date . '"');


		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['type'] = $type_id;

		$this->load->view('account/date_wise_report_print_view', $data);
	}

	public function headwise_income_report($value = '')
	{
		$data['active'] = 'pathology_list';
		$data['page_title'] = 'OPD Daywise amount Collection';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['all_head'] = $this->admin_model->select_all('acc_head');

		$this->load->view('account/headwise_income_report', $data);
	}

	public function headwise_expense_report($value = '')
	{
		$data['active'] = 'pathology_list';
		$data['page_title'] = 'Head Wise Expense Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['all_head'] = $this->admin_model->select_all('acc_head');

		$this->load->view('account/headwise_expense_report', $data);
	}


	public function head_date_wise_income_report_details($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$head_id = $this->input->post('head_id');

		redirect('admin/head_date_wise_income_report_details_next/' . $start_date . '/' . $end_date . '/' . $head_id);
	}

	public function head_date_wise_income_report_details_next($start_date, $end_date, $head_id)
	{
		$data['active'] = 'pathology_list';
		$data['page_title'] = 'Head Wise Income Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		if ($head_id == "all") {
			$data["inc_info"] = $this->admin_model->select_join_where('*,add_income_expense.created_at', 'acc_head', 'add_income_expense', 'head_id=acc_head_id', 'type=1');
		} else {


			$data["inc_info"] = $this->admin_model->select_join_where('*,add_income_expense.created_at', 'acc_head', 'add_income_expense', 'head_id=acc_head_id', 'type=1 AND add_income_expense.acc_head_id="' . $head_id . '" AND add_income_expense.created_at between "' . $start_date . '" and "' . $end_date . '"');
		}




		$data['head'] = $this->admin_model->select_with_where2('*', 'head_id="' . $head_id . '"', 'acc_head');




		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		if ($data['head'] == null) {
			$data['head'] = "all";
		} else {
			$data['head'] = $data['head'][0]['acc_head_title'];
		}


		$this->load->view('account/head_date_wise_income_report_details', $data);
	}

	public function head_date_wise_expense_report_details($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$head_id = $this->input->post('head_id');

		redirect('admin/head_date_wise_expense_report_details_next/' . $start_date . '/' . $end_date . '/' . $head_id);
	}

	public function head_date_wise_expense_report_details_next($start_date, $end_date, $head_id)
	{
		$data['active'] = 'pathology_list';
		$data['page_title'] = 'Head Wise Income Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		if ($head_id == "all") {
			$data["exp_info"] = $this->admin_model->select_join_where('*,add_income_expense.created_at', 'acc_head', 'add_income_expense', 'head_id=acc_head_id', 'type=2');
		} else {


			$data["exp_info"] = $this->admin_model->select_join_where('*,add_income_expense.created_at', 'acc_head', 'add_income_expense', 'head_id=acc_head_id', 'type=2 AND add_income_expense.acc_head_id="' . $head_id . '" AND add_income_expense.created_at between "' . $start_date . '" and "' . $end_date . '"');
		}




		$data['head'] = $this->admin_model->select_with_where2('*', 'head_id="' . $head_id . '"', 'acc_head');




		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		if ($data['head'] == null) {
			$data['head'] = "all";
		} else {
			$data['head'] = $data['head'][0]['acc_head_title'];
		}


		$this->load->view('account/head_date_wise_expense_report_details', $data);
	}


	public function headwise_income_expense_report($value = '')
	{
		$data['active'] = 'pathology_list';
		$data['page_title'] = 'Head Wise Income Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['all_head'] = $this->admin_model->select_all('acc_head');

		$this->load->view('account/headwise_income_expense_report', $data);
	}


	public function headwise_income_expense_report_details($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$head_id = $this->input->post('head_id');

		redirect('admin/headwise_income_expense_report_details_next/' . $start_date . '/' . $end_date . '/' . $head_id);
	}

	public function headwise_income_expense_report_details_next($start_date, $end_date, $head_id)
	{
		$data['active'] = 'pathology_list';
		$data['page_title'] = 'Head Wise Income Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		if ($head_id == "all") {
			$data['total_income'] = $this->admin_model->get_charge_sum_where_group_by_join('acc_head_title', 'total_paid', 'add_income_expense i', 'type=1 AND i.created_at between "' . $start_date . '" and "' . $end_date . '"', 'acc_head_id', 'acc_head a', 'a.head_id=i.acc_head_id');

			// "<pre>";print_r($data['total_income']);die();

			$data['total_expense'] = $this->admin_model->get_charge_sum_where_group_by_join('acc_head_title', 'total_paid', 'add_income_expense i', 'type=2 AND i.created_at between "' . $start_date . '" and "' . $end_date . '"', 'acc_head_id', 'acc_head a', 'a.head_id=i.acc_head_id');
		} else {

			$data['total_income'] = $this->admin_model->get_charge_sum_where_group_by_join('acc_head_title', 'total_paid', 'add_income_expense i', 'type=1 AND i.created_at between "' . $start_date . '" and "' . $end_date . '" AND head_id="' . $head_id . '" ', '', 'acc_head a', 'a.head_id=i.acc_head_id');

			// "<pre>";print_r($data['total_income']);die();

			$data['total_expense'] = $this->admin_model->get_charge_sum_where_group_by_join('acc_head_title', 'total_paid', 'add_income_expense i', 'type=2 AND i.created_at between "' . $start_date . '" and "' . $end_date . '" AND head_id="' . $head_id . '" ', '', 'acc_head a', 'a.head_id=i.acc_head_id');
		}



		$data['head'] = $this->admin_model->select_with_where2('*', 'head_id="' . $head_id . '"', 'acc_head');


		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		if ($data['head'] == null) {
			$data['head'] = "all";
		} else {
			$data['head'] = $data['head'][0]['acc_head_title'];
		}


		$this->load->view('account/headwise_income_expense_report_details', $data);
	}

	public function groupwise_report()
	{
		$data['active'] = 'pathology_list';
		$data['page_title'] = 'Head Wise Income Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];




		$data['acc_group'] = $this->admin_model->select_all('acc_group');
		$this->load->view('account/group_wise_report', $data);
	}

	public function group_wise_report_details()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$groupid = $this->input->post('groupid');
		$data['from_date'] = $this->input->post('start_date');
		$data['end_date'] = $this->input->post('end_date');
		if ($groupid == "all") {
			$data['acc_group'] = $this->admin_model->allgroup($groupid, $start_date, $end_date);
		} else {
			$data['acc_group'] = $this->admin_model->allgroup($groupid, $start_date, $end_date);
		}

		$this->load->view('account/group_wise_report_details', $data, FALSE);
	}

	public function group_wise_report_details_all()
	{
		$data['acc_group'] = $this->admin_model->allgroup_det();
		$this->load->view('account/group_wise_report_details_all', $data, FALSE);
	}


	public function date_wise_due_collection($value = '')
	{
		$data['active'] = 'Accounts';
		$data['page_title'] = 'Head Wise Income Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['cat'] = $this->uri->segment(3);

		// outdoor

		$data['outdoor_total_amount'] = $this->admin_model->get_charge_sum_where('total_amount', 'opd_patient_test_order_info', 'date(created_at)="' . date('Y-m-d') . '" AND status=1');

		$data['outdoor_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'due_type=1 AND date(created_at)="' . date('Y-m-d') . '" AND status=1');

		$data['outdoor_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'due_collection', 'due_type=1 AND date(created_at)="' . date('Y-m-d') . '" AND status=1');

		$data['outdoor_discount_expense'] = $this->admin_model->get_charge_sum_where('discount', 'due_collection', 'due_type=1 AND date(created_at)="' . date('Y-m-d') . '" AND status=1');

		$data['outdoor_commission_expense'] = $this->admin_model->get_charge_sum_where('paid_com', 'commission_payment', 'date(created_at)="' . date('Y-m-d') . '" AND doc_type=2 AND status=1');

		// $data['outdoor_other_expense']=$this->admin_model->get_charge_sum_where('total_amount','add_income_expense','acc_head_id=6 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'"');


		// Indoor

		$data['indoor_total_amount'] = $this->admin_model->get_charge_sum_where('total_amount', 'ipd_final_bill', 'date(created_at)="' . date('Y-m-d') . '"');

		$data['indoor_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'due_type=2 AND date(created_at)="' . date('Y-m-d') . '"');

		$data['indoor_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'due_collection', 'due_type=2 AND date(created_at)="' . date('Y-m-d') . '"');

		$data['indoor_discount_expense'] = $this->admin_model->get_charge_sum_where('discount', 'due_collection', 'due_type=2 AND date(created_at)="' . date('Y-m-d') . '"');

		// Indoor Diagnostic Service

		$data['indoor_diag_total_amount'] = $this->admin_model->get_charge_sum_where('total_amount', 'ipd_patient_order_info', 'date(created_at)="' . date('Y-m-d') . '"');

		$data['indoor_diag_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'due_type=3 AND date(created_at)="' . date('Y-m-d') . '"');

		$data['indoor_diag_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'due_collection', 'due_type=3 AND date(created_at)="' . date('Y-m-d') . '"');

		$data['indoor_diag_discount_expense'] = $this->admin_model->get_charge_sum_where('discount', 'due_collection', 'due_type=3 AND date(created_at)="' . date('Y-m-d') . '"');

		// $data['indoor_commission_expense']=$this->admin_model->get_charge_sum_where('total_amount','add_income_expense','acc_head_id=12 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'"'); 

		// $data['indoor_other_expense']=$this->admin_model->get_charge_sum_where('total_amount','add_income_expense','acc_head_id=13 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'"');

		// pharmacy

		$data['pharmacy_total_amount'] = $this->admin_model->get_charge_sum_where('credit', 'sell', 'date(created_at)="' . date('Y-m-d') . '"');

		$data['pharmacy_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'pharmacy_due_collection', 'date(created_at)="' . date('Y-m-d') . '" AND due_type=2 AND status=1');

		$data['pharmacy_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'sell', 'date(created_at)="' . date('Y-m-d') . '"');

		$data['pharmacy_discount_expense'] = $this->admin_model->get_charge_sum_where('discount', 'sell', 'date(created_at)="' . date('Y-m-d') . '"');

		// $data['pharmacy_commission_expense']=$this->admin_model->get_charge_sum_where('total_amount','add_income_expense','acc_head_id=19 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'"');

		$data['pharmacy_supplier_expense'] = $this->admin_model->get_charge_sum_where('paid_due', 'pharmacy_due_collection', 'date(created_at)="' . date('Y-m-d') . '" AND due_type=1 AND status=1');

		$data['pharmacy_unload_expense'] = $this->admin_model->get_charge_sum_where('unload_cost', 'buy', 'date(created_at)="' . date('Y-m-d') . '"');



		// other head income

		$data['others_total_income'] = $this->admin_model->get_charge_sum_where_group_by_join('*', 'ai.total_paid', 'add_income_expense ai', 'ai.type=1 AND date(created_at)="' . date('Y-m-d') . '"', 'ai.acc_head_id', 'acc_head ah', 'ah.head_id=ai.acc_head_id');


		// other head expense

		$data['others_total_expense'] = $this->admin_model->get_charge_sum_where_group_by_join('*', 'ai.total_paid', 'add_income_expense ai', 'ai.type=2 AND date(created_at)="' . date('Y-m-d') . '"', 'ai.acc_head_id', 'acc_head ah', 'ah.head_id=ai.acc_head_id');




		$this->load->view('account/date_wise_due_collection', $data);
	}



	public function date_wise_due_collection_report($value = '')
	{


		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		// $cat=$this->input->post('cat');

		// "<pre>";print_r($cat);die();

		// $head_id=$this->input->post('head_id');

		redirect('admin/date_wise_due_collection_report_next/' . $start_date . '/' . $end_date);
	}

	public function date_wise_due_collection_report_next($start_date, $end_date)
	{
		$data['active'] = 'Accounts';
		$data['page_title'] = 'Head Wise Income Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		// $data['cat']=$cat;

		//Outdoor


		$data['outdoor_total_amount'] = $this->admin_model->get_charge_sum_where('total_amount', 'opd_patient_test_order_info', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '" AND status=1');

		$data['outdoor_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'due_type=1 AND date(created_at)between "' . $start_date . '" and "' . $end_date . '" AND status=1');

		$data['outdoor_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'due_collection', 'due_type=1 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '" AND status=1');

		$data['outdoor_discount_expense'] = $this->admin_model->get_charge_sum_where('discount', 'due_collection', 'due_type=1 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '" AND status=1');

		$data['outdoor_commission_expense'] = $this->admin_model->get_charge_sum_where('paid_com', 'commission_payment', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '" AND doc_type=2 AND status=1');

		// $data['outdoor_other_expense']=$this->admin_model->get_charge_sum_where('total_amount','add_income_expense','acc_head_id=6 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'"');


		// Indoor


		$data['indoor_total_amount'] = $this->admin_model->get_charge_sum_where('total_amount', 'ipd_final_bill', 'date(created_at)="' . date('Y-m-d') . '"');

		$data['indoor_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'due_type=2 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['indoor_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'due_collection', 'due_type=2 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['indoor_discount_expense'] = $this->admin_model->get_charge_sum_where('discount', 'due_collection', 'due_type=2 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		// Indoor Diagnostic Service

		$data['indoor_diag_total_amount'] = $this->admin_model->get_charge_sum_where('total_amount', 'ipd_patient_order_info', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['indoor_diag_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'due_type=3 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['indoor_diag_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'due_collection', 'due_type=3 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['indoor_diag_discount_expense'] = $this->admin_model->get_charge_sum_where('discount', 'due_collection', 'due_type=3 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		// pharmacy

		// pharmacy

		$data['pharmacy_total_amount'] = $this->admin_model->get_charge_sum_where('credit', 'sell', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['pharmacy_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'pharmacy_due_collection', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '" AND due_type=2 AND status=1 and is_due_collection=0');

		$data['pharmacy_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'sell', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['pharmacy_discount_expense'] = $this->admin_model->get_charge_sum_where('discount', 'sell', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		// $data['pharmacy_commission_expense']=$this->admin_model->get_charge_sum_where('total_amount','add_income_expense','acc_head_id=19 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'"');

		$data['pharmacy_supplier_expense'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '" AND due_type=2 AND status=1');

		$data['pharmacy_unload_expense'] = $this->admin_model->get_charge_sum_where('unload_cost', 'buy', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		// $data['pharmacy_other_expense']=$this->admin_model->get_charge_sum_where('total_amount','add_income_expense','acc_head_id=22 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'"');



		// other head income

		$data['others_total_income'] = $this->admin_model->get_charge_sum_where_group_by_join('*', 'ai.total_paid', 'add_income_expense ai', 'ai.type=1 AND date(ai.created_at) between "' . $start_date . '" and "' . $end_date . '"', 'ai.acc_head_id', 'acc_head ah', 'ah.head_id=ai.acc_head_id');


		// other head expense

		$data['others_total_expense'] = $this->admin_model->get_charge_sum_where_group_by_join('*', 'ai.total_paid', 'add_income_expense ai', 'ai.type=2 AND date(ai.created_at) between "' . $start_date . '" and "' . $end_date . '"', 'ai.acc_head_id', 'acc_head ah', 'ah.head_id=ai.acc_head_id');


		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;


		$this->load->view('account/date_wise_due_collection_report', $data);
	}




	public function date_wise_balance_sheet($value = '')
	{
		$data['active'] = 'Accounts';
		$data['page_title'] = strtoupper($this->uri->segment(3)) . ' Balance Sheet';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['cat'] = $this->uri->segment(3);

		// outdoor

		$data['outdoor_total_amount'] = $this->admin_model->get_charge_sum_where('total_amount', 'opd_patient_test_order_info', 'date(created_at)="' . date('Y-m-d') . '" AND status=1');

		$data['outdoor_total_paid'] = $this->admin_model->get_charge_sum_where('paid_amount', 'opd_patient_test_order_info', 'date(created_at)="' . date('Y-m-d') . '" AND status=1');

		$data['outdoor_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'due_type=1 AND date(created_at)="' . date('Y-m-d') . '" AND status=1');

		$data['outdoor_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'due_collection', 'due_type=1 AND date(created_at)="' . date('Y-m-d') . '" AND status=1');

		$data['outdoor_discount_expense'] = $this->admin_model->get_charge_sum_where_join('*', 'discount', 'due_collection d', 'due_type=1 AND date(o.created_at)="' . date('Y-m-d') . '" AND date(d.created_at)="' . date('Y-m-d') . '" AND d.status=1 AND o.status=1', 'opd_patient_test_order_info o', 'o.test_order_id=d.order_id');

		// "<pre>";print_r($data['outdoor_discount_expense']);die();

		$data['outdoor_commission_expense'] = $this->admin_model->get_charge_sum_where('paid_com', 'commission_payment', 'date(created_at)="' . date('Y-m-d') . '" AND doc_type IN (1,2) AND status=1');

		// $data['outdoor_other_expense']=$this->admin_model->get_charge_sum_where('total_amount','add_income_expense','acc_head_id=6 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'"');


		// Indoor

		$data['indoor_total_amount'] = $this->admin_model->get_charge_sum_where('total_amount', 'ipd_final_bill', 'date(created_at)="' . date('Y-m-d') . '"');

		$data['indoor_total_adm_fee'] = $this->admin_model->get_charge_sum_where('admission_fee', 'ipd_final_bill', 'date(created_at)="' . date('Y-m-d') . '"');

		// $data['indoor_total_paid']=$this->admin_model->get_charge_sum_where('total_paid','ipd_final_bill','date(created_at)="'.date('Y-m-d').'"');

		$data['indoor_total_paid'] = $this->admin_model->get_charge_sum_where_join_no_selector('paid_due', 'due_collection d', 'd.status=1 and d.due_type=2 AND date(d.created_at)="' . date('Y-m-d') . '" and date(i.released_date)="' . date('Y-m-d') . '" and date(i.released_date)!=""', 'ipd_final_bill i', 'd.patient_id=i.p_id');

		// today current collection
		$data['indoor_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'status=1 and due_type=2 and date(created_at)="' . date('Y-m-d') . '"');

		// today due collection
		$data['indoor_due_collection'] = $this->admin_model->get_charge_sum_where_join_no_selector('paid_due', 'due_collection d', 'd.status=1 and d.due_type=2 AND date(d.created_at)="' . date('Y-m-d') . '" and is_due_collection=1', 'ipd_final_bill i', 'd.patient_id=i.p_id');

		$data['indoor_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'due_collection', 'status=1 and due_type=2 AND date(created_at)="' . date('Y-m-d') . '"');

		$data['indoor_adm_fee_income'] = $this->admin_model->get_charge_sum_where('admission_fee_paid', 'due_collection', 'status=1 and due_type=2 AND date(created_at)="' . date('Y-m-d') . '"');

		$data['indoor_discount_expense'] = $this->admin_model->get_charge_sum_where('discount', 'due_collection', 'status=1 and due_type=2 AND date(created_at)="' . date('Y-m-d') . '"');

		$data['indoor_advance_payment'] = $this->admin_model->get_charge_sum_where('advance_payment', 'due_collection', 'status=1 and due_type=2 AND date(created_at)="' . date('Y-m-d') . '"');

		$data['operation_expense'] = $this->admin_model->get_charge_sum_where('paid_cost', 'service_payment_details', 'date(created_at)="' . date('Y-m-d') . '"');


		// Indoor Diagnostic Service

		$data['indoor_diag_total_amount'] = $this->admin_model->get_charge_sum_where('total_amount', 'outdoor_service_order_info', 'date(created_at)="' . date('Y-m-d') . '"');

		$data['indoor_diag_total_paid'] = $this->admin_model->get_charge_sum_where('total_paid', 'outdoor_service_order_info', 'date(created_at)="' . date('Y-m-d') . '"');


		$data['indoor_diag_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'status=1 and due_type=3 AND date(created_at)="' . date('Y-m-d') . '"');

		$data['indoor_diag_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'due_collection', 'status=1 and due_type=3 AND date(created_at)="' . date('Y-m-d') . '"');

		$data['indoor_diag_discount_expense'] = $this->admin_model->get_charge_sum_where('total_discount', 'outdoor_service_order_info', 'status=1 and date(created_at)="' . date('Y-m-d') . '"');


		// $data['indoor_commission_expense']=$this->admin_model->get_charge_sum_where('total_amount','add_income_expense','acc_head_id=12 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'"'); 

		// $data['indoor_other_expense']=$this->admin_model->get_charge_sum_where('total_amount','add_income_expense','acc_head_id=13 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'"');

		// pharmacy

		$data['pharmacy_total_amount'] = $this->admin_model->get_charge_sum_where('credit', 'sell', 'date(created_at)="' . date('Y-m-d') . '"');

		$data['pharmacy_total_paid'] = $this->admin_model->get_charge_sum_where('debit', 'sell', 'date(created_at)="' . date('Y-m-d') . '"');

		$data['pharmacy_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'pharmacy_due_collection', 'date(created_at)="' . date('Y-m-d') . '" AND due_type=2 AND status=1');

		$data['pharmacy_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'sell', 'date(created_at)="' . date('Y-m-d') . '"');

		$data['pharmacy_discount_expense'] = $this->admin_model->get_charge_sum_where('discount', 'sell', 'date(created_at)="' . date('Y-m-d') . '"');

		// $data['pharmacy_commission_expense']=$this->admin_model->get_charge_sum_where('total_amount','add_income_expense','acc_head_id=19 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'"');

		$data['pharmacy_supplier_expense'] = $this->admin_model->get_charge_sum_where('paid_due', 'pharmacy_due_collection', 'date(created_at)="' . date('Y-m-d') . '" AND due_type=1 AND status=1');

		$data['pharmacy_unload_expense'] = $this->admin_model->get_charge_sum_where('unload_cost', 'buy', 'date(created_at)="' . date('Y-m-d') . '"');

		$data['total_sales_return_paid'] = $this->admin_model->get_charge_sum_where('total_paid', 'return_product', 'date(created_at)="' . date('Y-m-d') . '" and type=2');

		$data['total_purchase_return_paid'] = $this->admin_model->get_charge_sum_where('total_paid', 'return_product', 'date(created_at)="' . date('Y-m-d') . '" and type=1');

		// $data['pharmacy_other_expense']=$this->admin_model->get_charge_sum_where('total_amount','add_income_expense','acc_head_id=22 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'"');



		// other head income

		$data['others_total_income'] = $this->admin_model->get_charge_sum_where_group_by_join('*', 'ai.total_paid', 'add_income_expense ai', 'ai.type=1 AND ai.status=1 AND date(created_at)="' . date('Y-m-d') . '"', 'ai.acc_head_id', 'acc_head ah', 'ah.head_id=ai.acc_head_id');


		// other head expense

		$data['others_total_expense'] = $this->admin_model->get_charge_sum_where_group_by_join('*', 'ai.total_paid', 'add_income_expense ai', 'ai.type=2 AND ai.status=1 AND date(created_at)="' . date('Y-m-d') . '"', 'ai.acc_head_id', 'acc_head ah', 'ah.head_id=ai.acc_head_id');




		$this->load->view('account/date_wise_balance_sheet', $data);
	}


	public function date_wise_balance_sheet_report($value = '')
	{


		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		$cat = $this->input->post('cat');

		// "<pre>";print_r($cat);die();

		// $head_id=$this->input->post('head_id');

		redirect('admin/date_wise_balance_sheet_report_next/' . $start_date . '/' . $end_date . '/' . $cat);
	}

	public function date_wise_balance_sheet_report_next($start_date, $end_date, $cat)
	{
		$data['active'] = 'pathology_list';
		$data['page_title'] = 'Head Wise Income Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['cat'] = $cat;

		//Outdoor


		$data['outdoor_total_amount'] = $this->admin_model->get_charge_sum_where('total_amount', 'opd_patient_test_order_info', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '" AND status=1');

		$data['outdoor_total_paid'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '" AND status=1 AND is_due_collection=0 AND due_type=1');

		$data['outdoor_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'due_type=1 AND date(created_at)between "' . $start_date . '" and "' . $end_date . '" AND status=1');

		$data['outdoor_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'due_collection', 'due_type=1 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '" AND status=1');

		// $data['outdoor_discount_expense']=$this->admin_model->get_charge_sum_where('discount','due_collection','due_type=1 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'" AND status=1');

		$data['outdoor_discount_expense'] = $this->admin_model->get_charge_sum_where('total_discount', 'opd_patient_test_order_info o', 'o.status=1 AND date(o.created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['outdoor_commission_expense'] = $this->admin_model->get_charge_sum_where('paid_com', 'commission_payment', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '" AND doc_type IN (1,2) AND status=1');

		$data['outdoor_due_collection'] = $this->admin_model->get_charge_sum_where_join('*', 'd.paid_due', 'due_collection d', 'd.status=1 and d.due_type=1 AND p.status=1 AND date(d.created_at) between "' . $start_date . '" AND  "' . $end_date . '" AND d.is_due_collection=1', 'opd_patient_test_order_info p', 'p.test_order_id=d.order_id');

		// "<pre>";print_r($data['outdoor_due_collection']);die();



		// $data['outdoor_other_expense']=$this->admin_model->get_charge_sum_where('total_amount','add_income_expense','acc_head_id=6 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'"');


		// Indoor


		$data['indoor_total_amount'] = $this->admin_model->get_charge_sum_where('total_amount', 'ipd_final_bill', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['indoor_total_paid'] = $this->admin_model->get_charge_sum_where('total_paid', 'ipd_final_bill', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['indoor_total_adm_fee'] = $this->admin_model->get_charge_sum_where('admission_fee', 'ipd_final_bill', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['indoor_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'due_type=2 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '" and status=1');

		$data['indoor_adm_fee_income'] = $this->admin_model->get_charge_sum_where('admission_fee_paid', 'due_collection', 'due_type=2 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '" and status=1');

		$data['indoor_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'due_collection', 'due_type=2 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '" and status=1');

		$data['indoor_discount_expense'] = $this->admin_model->get_charge_sum_where('discount', 'due_collection', 'due_type=2 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '" and status=1');

		$data['operation_expense'] = $this->admin_model->get_charge_sum_where('paid_cost', 'service_payment_details', 'date(created_at)="' . date('Y-m-d') . '"');

		$data['indoor_due_collection'] = $this->admin_model->get_charge_sum_where_join('*', 'd.paid_due', 'due_collection d', 'd.status=1 and d.due_type=2 AND date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '" AND p.status=1 AND p.type=3 AND d.is_due_collection=1', 'ipd_patient_info p', 'p.id=d.patient_id');

		// Indoor Diagnostic Service

		$data['indoor_diag_total_amount'] = $this->admin_model->get_charge_sum_where('total_amount', 'outdoor_service_order_info', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['indoor_diag_total_paid'] = $this->admin_model->get_charge_sum_where('total_paid', 'outdoor_service_order_info', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['indoor_diag_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'due_collection', 'due_type=3 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '" and status=1');

		$data['indoor_diag_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'due_collection', 'due_type=3 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '" and status=1');

		$data['indoor_diag_discount_expense'] = $this->admin_model->get_charge_sum_where('discount', 'due_collection', 'due_type=3 AND date(created_at) between "' . $start_date . '" and "' . $end_date . '" and status=1');

		$data['indoor_diag_due_collection'] = $this->admin_model->get_charge_sum_where_join('*', 'd.paid_due', 'due_collection d', 'd.status=1 and d.due_type=3 AND date(d.created_at) between "' . $start_date . '" AND "' . $end_date . '" AND date(p.created_at) != date(d.created_at)', 'outdoor_service_order_info p', 'p.reg_id=d.order_id');


		// pharmacy

		$data['pharmacy_total_amount'] = $this->admin_model->get_charge_sum_where('credit', 'sell', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		// $data['pharmacy_total_paid']=$this->admin_model->get_charge_sum_where('debit','sell','date(created_at) between "'.$start_date.'" and "'.$end_date.'"');

		$data['pharmacy_total_paid'] = $this->admin_model->get_charge_sum_where('paid_due', 'pharmacy_due_collection', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '" AND status=1 AND is_due_collection=0 AND due_type=2');

		$data['pharmacy_net_income'] = $this->admin_model->get_charge_sum_where('paid_due', 'pharmacy_due_collection', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '" AND due_type=2 AND status=1');

		$data['pharmacy_vat_income'] = $this->admin_model->get_charge_sum_where('vat', 'sell', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['pharmacy_discount_expense'] = $this->admin_model->get_charge_sum_where('discount', 'sell', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '"');

		// $data['pharmacy_commission_expense']=$this->admin_model->get_charge_sum_where('total_amount','add_income_expense','acc_head_id=19 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'"');

		$data['pharmacy_supplier_expense'] = $this->admin_model->get_charge_sum_where('paid_due', 'pharmacy_due_collection', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '" AND due_type=1 AND status=1');

		$data['pharmacy_unload_expense'] = $this->admin_model->get_charge_sum_where('unload_cost', 'pharmacy_due_collection', 'date(created_at) between "' . $start_date . '" and "' . $end_date . '" and due_type=1');

		$data['pharmacy_due_collection'] = $this->admin_model->get_charge_sum_where_join('*', 'd.paid_due', 'pharmacy_due_collection d', 'd.status=1 and d.due_type=2 AND p.status=1 AND date(d.created_at) between "' . $start_date . '" AND  "' . $end_date . '" AND d.is_due_collection=1', 'sell p', 'p.sell_code=d.order_id');

		// $data['pharmacy_other_expense']=$this->admin_model->get_charge_sum_where('total_amount','add_income_expense','acc_head_id=22 AND date(created_at) between "'.$start_date.'" and "'.$end_date.'"');



		// other head income

		$data['others_total_income'] = $this->admin_model->get_charge_sum_where_group_by_join('*', 'ai.total_paid', 'add_income_expense ai', 'ai.type=1 AND ai.status=1 AND  date(ai.created_at) between "' . $start_date . '" and "' . $end_date . '"', 'ai.acc_head_id', 'acc_head ah', 'ah.head_id=ai.acc_head_id');


		// other head expense

		$data['others_total_expense'] = $this->admin_model->get_charge_sum_where_group_by_join('*', 'ai.total_paid', 'add_income_expense ai', 'ai.type=2 AND ai.status=1 AND date(ai.created_at) between "' . $start_date . '" and "' . $end_date . '"', 'ai.acc_head_id', 'acc_head ah', 'ah.head_id=ai.acc_head_id');


		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;


		$this->load->view('account/date_wise_balance_sheet_report', $data);
	}



	public function other_asset_report($value = '')
	{
		$data['active'] = 'other_asset_report';
		$data['page_title'] = 'Other Asset Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];




		$data["asset"] = $this->admin_model->select_join_where('*,add_income_expense.created_at', 'acc_head', 'add_income_expense', 'head_id=acc_head_id', 'type=3 AND add_income_expense.status=1 AND date(add_income_expense.created_at)="' . date('Y-m-d') . '"');


		$this->load->view('account/other_asset_report', $data);
	}


	public function other_asset_report_date_wise($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');


		redirect('admin/other_asset_report_date_wise_next/' . $start_date . '/' . $end_date);
	}

	public function other_asset_report_date_wise_next($start_date, $end_date)
	{

		$data["asset"] = $this->admin_model->select_join_where('*,add_income_expense.created_at', 'acc_head', 'add_income_expense', 'head_id=acc_head_id', 'type=3 AND add_income_expense.status=1 AND date(add_income_expense.created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;



		$this->load->view('account/other_asset_report_date_wise', $data);
	}



	public function other_expense_report($value = '')
	{
		$data['active'] = 'acc';
		$data['page_title'] = 'Other Expense';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];




		$data["exp_info"] = $this->admin_model->select_join_where('*,add_income_expense.created_at', 'acc_head', 'add_income_expense', 'head_id=acc_head_id', 'type=2 AND add_income_expense.status=1 AND date(add_income_expense.created_at)="' . date('Y-m-d') . '"');


		$this->load->view('account/other_expense_report', $data);
	}


	public function other_expense_report_date_wise($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$head_id = $this->input->post('head_id');

		redirect('admin/other_expense_report_date_wise_next/' . $start_date . '/' . $end_date);
	}

	public function other_expense_report_date_wise_next($start_date, $end_date)
	{

		$data["exp_info"] = $this->admin_model->select_join_where('*,add_income_expense.created_at', 'acc_head', 'add_income_expense', 'head_id=acc_head_id', 'type=2 AND add_income_expense.status=1 AND date(add_income_expense.created_at) between "' . $start_date . '" and "' . $end_date . '"');

		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;



		$this->load->view('account/other_expense_report_date_wise', $data);
	}

	public function other_income_report($value = '')
	{
		$data['active'] = 'acc';
		$data['page_title'] = 'Other Income Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data["inc_info"] = $this->admin_model->select_join_where('*,add_income_expense.created_at', 'acc_head', 'add_income_expense', 'head_id=acc_head_id', 'type=1  AND add_income_expense.status=1 AND date(add_income_expense.created_at)="' . date('Y-m-d') . '"');


		$this->load->view('account/other_income_report', $data);
	}

	public function date_wise_balance_sheet_others_income()
	{
		redirect('admin/date_wise_balance_sheet/income');
	}

	public function date_wise_balance_sheet_others_expense()
	{
		redirect('admin/date_wise_balance_sheet/expense');
	}

	public function date_wise_balance_sheet_acc()
	{
		redirect('admin/date_wise_balance_sheet/acc');
	}


	public function other_income_report_date_wise($value = '')
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		redirect('admin/other_income_report_date_wise_next/' . $start_date . '/' . $end_date);
	}

	public function other_income_report_date_wise_next($start_date, $end_date)
	{


		$data["inc_info"] = $this->admin_model->select_join_where('*,add_income_expense.created_at', 'acc_head', 'add_income_expense', 'head_id=acc_head_id', 'type=1 AND add_income_expense.status=1 AND date(add_income_expense.created_at) between "' . $start_date . '" and "' . $end_date . '"');


		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;

		$this->load->view('account/other_income_report_date_wise', $data);
	}


	// ***************** Edit Expense ,Asset, income**********

	public function edit_expense($value = '')
	{
		$data['active'] = 'acc';
		$data['page_title'] = 'Edit Expense';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['acc_head_info_exp'] = $this->admin_model->select_with_where2('*', 'group_id=4 AND head_status=1', 'acc_head');

		$exp_id = $this->uri->segment(3);

		$data['exp_info'] = $this->admin_model->select_with_where2('*', 'id="' . $exp_id . '"', 'add_income_expense');


		$this->load->view('account/edit_expense', $data);
	}


	public function update_expense($value = '')
	{

		$exp_id = $this->uri->segment(3);

		$val = array(
			'acc_head_id' => $this->input->post('acc_head'),
			'challan_no' => $this->input->post('challan_no'),
			'income_expense_purpose' => $this->input->post('income_expense_purpose'),
			'total_amount' => $this->input->post('amount'),
			'total_paid' => $this->input->post('amount'),
			'paid_by' => $this->input->post('optradio'),
			'bank_acc_no' => $this->input->post('acc_no'),
			'check_no' => $this->input->post('check_no'),
			'check_pass_date' => $this->input->post('check_pass_date'),

			'bkash_no' => $this->input->post('bkash_no'),
			'tx_id' => $this->input->post('tx_id'),
			// 'operated_name'=>$this->session->userdata['logged_in']['username'],
			// 'operated_id'=>$this->session->userdata['logged_in']['id'],
			// 'type'=>2,
			'updated_at' => date('Y-m-d H:i:s'),
			'inc_exp_ref' => $this->input->post('expense_ref')


		);

		$this->load->admin_model->update_function2('id="' . $exp_id . '"', 'add_income_expense', $val);

		redirect('admin/expense_list', 'refresh');
	}

	public function delete_expense($value = '')
	{
		$exp_id = $this->uri->segment(3);

		$val['status'] = 2;

		$this->load->admin_model->update_function2('id="' . $exp_id . '"', 'add_income_expense', $val);

		redirect('admin/expense_list', 'refresh');
	}



	public function edit_income($value = '')
	{
		$data['active'] = 'acc';
		$data['page_title'] = 'Edit Income';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['acc_head_info_inc'] = $this->admin_model->select_with_where2('*', 'group_id=3 AND head_status=1', 'acc_head');

		$inc_id = $this->uri->segment(3);

		$data['inc_info'] = $this->admin_model->select_with_where2('*', 'id="' . $inc_id . '"', 'add_income_expense');


		$this->load->view('account/edit_income', $data);
	}


	public function update_income($value = '')
	{
		$inc_id = $this->uri->segment(3);
		$val = array(
			'acc_head_id' => $this->input->post('acc_head'),
			'challan_no' => $this->input->post('challan_no'),
			'income_expense_purpose' => $this->input->post('income_expense_purpose'),
			'total_amount' => $this->input->post('amount'),
			'total_paid' => $this->input->post('amount'),
			'paid_by' => $this->input->post('optradio'),
			'bank_acc_no' => $this->input->post('acc_no'),
			'check_no' => $this->input->post('check_no'),
			'check_pass_date' => $this->input->post('check_pass_date'),

			'bkash_no' => $this->input->post('bkash_no'),
			'tx_id' => $this->input->post('tx_id'),
			// 'operated_name'=>$this->session->userdata['logged_in']['username'],
			// 'operated_id'=>$this->session->userdata['logged_in']['id'],
			// 'type'=>1,
			'updated_at' => date('Y-m-d H:i:s'),
			'inc_exp_ref' => $this->input->post('expense_ref')


		);

		$this->load->admin_model->update_function2('id="' . $inc_id . '"', 'add_income_expense', $val);

		redirect('admin/income_list', 'refresh');
	}




	public function delete_income($value = '')
	{
		$inc_id = $this->uri->segment(3);

		$val['status'] = 2;

		$this->load->admin_model->update_function2('id="' . $inc_id . '"', 'add_income_expense', $val);

		redirect('admin/income_list', 'refresh');
	}




	public function edit_asset($value = '')
	{
		$data['active'] = 'acc';
		$data['page_title'] = 'Edit Asset';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['acc_head_info_asset'] = $this->admin_model->select_with_where2('*', 'group_id=1 AND head_status=1', 'acc_head');

		$inc_id = $this->uri->segment(3);

		$data['asset_info'] = $this->admin_model->select_with_where2('*', 'id="' . $inc_id . '"', 'add_income_expense');


		$this->load->view('account/edit_asset', $data);
	}


	public function update_asset($value = '')
	{
		$asset_id = $this->uri->segment(3);
		$val = array(
			'acc_head_id' => $this->input->post('acc_head'),
			'challan_no' => $this->input->post('challan_no'),
			'income_expense_purpose' => $this->input->post('income_expense_purpose'),
			'total_amount' => $this->input->post('amount'),
			'total_paid' => $this->input->post('amount'),
			'paid_by' => $this->input->post('optradio'),
			'bank_acc_no' => $this->input->post('acc_no'),
			'check_no' => $this->input->post('check_no'),
			'check_pass_date' => $this->input->post('check_pass_date'),

			'bkash_no' => $this->input->post('bkash_no'),
			'tx_id' => $this->input->post('tx_id'),
			// 'operated_name'=>$this->session->userdata['logged_in']['username'],
			// 'operated_id'=>$this->session->userdata['logged_in']['id'],
			// 'type'=>2,
			'updated_at' => date('Y-m-d H:i:s'),
			'inc_exp_ref' => $this->input->post('inc_exp_ref')


		);

		$this->load->admin_model->update_function2('id="' . $asset_id . '"', 'add_income_expense', $val);

		redirect('admin/asset_list', 'refresh');
	}




	public function delete_asset($value = '')
	{
		$asset_id = $this->uri->segment(3);

		$val['status'] = 2;

		$this->load->admin_model->update_function2('id="' . $asset_id . '"', 'add_income_expense', $val);

		redirect('admin/asset_list', 'refresh');
	}





	// **************** Accounts Module END ******************


	// **************** Pathology Module  **************

	public function pathology_report_lock_unlock($value = '')
	{
		$data['active'] = 'pathology_report_lock_unlock';
		$data['page_title'] = 'Pathology Lock/Unlock';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['report_lock'] = $this->admin_model->select_all('report_lock');

		$this->load->view('pathlogy/pathology_report_lock_unlock', $data);
	}

	public function pathology_report_lock_unlock_post($value = '')
	{

		$report_lock = $this->admin_model->select_all('report_lock');

		if ($_POST['opd'] == "opd" && $_POST['ipd'] == "") {


			if ($report_lock[0]['flag'] == 0) {
				$val['flag'] = 1;
				$this->admin_model->update_function2('id=1', 'report_lock', $val);
			} else {
				$val['flag'] = 0;
				$this->admin_model->update_function2('id=1', 'report_lock', $val);
			}
		} else {

			if ($report_lock[0]['flag_ipd'] == 0) {
				$val['flag_ipd'] = 1;
				$this->admin_model->update_function2('id=1', 'report_lock', $val);
			} else {
				$val['flag_ipd'] = 0;
				$this->admin_model->update_function2('id=1', 'report_lock', $val);
			}
		}

		redirect('admin/pathology_report_lock_unlock', 'refresh');
	}


	public function pathology_list()
	{
		$data['active'] = 'pathology_list';
		$data['page_title'] = 'Pathology List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$this->load->view('pathlogy/pathology_list', $data);
	}


	public function pathology_list_dt($value = '')
	{
		$opd_order_data = $this->admin_model->select_with_where2('*', 'status=1', 'opd_patient_test_order_info');

		$select_column = 'pathologoy_id,pathologoy.patient_id,order_id,pdate,padate,delivery_date,diagnostic_test_group.test_id,delievery_status,patient_name,sub_test_title,delievery_status,diagnostic_test_subgroup.id as subtestid,
	 	test_title,diagnostic_test_group.speciman,diagnostic_test_group.specimen_id,ref_doctor_name,opd_patient_info.quack_doc_name,patient_info_id,payment_status,is_ipd_patient';

		$order_column = array('pathologoy_id', 'pathologoy.patient_id', 'patient_name', 'order_id', 'sub_test_title', 'test_title', 'diagnostic_test_group.speciman');

		$search_column = array('patient_name', 'order_id', 'sub_test_title', 'test_title', 'patient_info_id', 'diagnostic_test_group.speciman');

		$fetch_data = $this->admin_model->make_datatables_five_table_join('opd_patient_info', 'opd_patient_info.status=1 and pathologoy.status=1', $select_column, $order_column, $search_column, 'pathologoy', 'pathologoy.patient_id=opd_patient_info.id', 'diagnostic_test_subgroup', 'pathologoy.test_id=diagnostic_test_subgroup.id', 'diagnostic_test_group', 'diagnostic_test_subgroup.mtest_id=diagnostic_test_group.test_id', 'opd_patient_test_order_info', 'opd_patient_test_order_info.id=pathologoy.order_id', 'pathologoy_id');

		$report_lock = $this->admin_model->select_all('report_lock');

		// "<pre>";print_r($report_lock);die();

		$data = array();

		$i = $_POST['start'];

		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = $row->patient_info_id;
			$sub_array[] = $row->patient_name;
			foreach ($opd_order_data as $key => $value) {
				if ($value['id'] == $row->order_id) {
					$sub_array[] = $value['test_order_id'];
				}
			}

			$sub_array[] = $row->sub_test_title;
			$sub_array[] = $row->test_title;
			$sub_array[] = $row->speciman;
			$sub_array[] = $row->payment_status;
			$sub_array[] = $row->pdate;



			$dst = $row->delievery_status;

			$s_id = $row->specimen_id;
			// $s_val=$row->speciman;

			// if($s_val==null)
			// {
			// 	$s_val="default";
			// }

			if ($dst == "1") {
				$delivery_title = "<span style='color:green;font-size:14px;font-weight:bold'>Receive</span>";
				$dst = $dst;
			} elseif ($dst == "2") {
				$delivery_title = "<span style='color:blue;font-size:14px;font-weight:bold'>Sent to Lab</span>";
				$dst = $dst;
			} elseif ($dst == "3") {
				$delivery_title = "<span style='color:red;font-size:14px;font-weight:bold'>On Reception</span>";
				$dst = $dst;
			} elseif ($dst == "4") {
				$delivery_title = "<span style='color:yellow;font-size:14px;font-weight:bold'>Delivered</span>";
				$dst = $dst;
			} else {
				$delivery_title = "<span style='color:green;font-size:14px;font-weight:bold'>Receive</span>";
				$dst = 1;
			}

			$sub_array[] = $delivery_title;
			$report = "";

			// 0 = unlock and 1 =lock

			if ($report_lock[0]['flag'] == 0 && $row->is_ipd_patient == 0) {

				if ($dst > 2) {


					$sub_array[] = '<a href="admin/add_report/' . $row->test_id . '/' . $row->subtestid . '/' . $row->pathologoy_id . '" class="btn btn-primary btn-sm">Report Provide</a>';


					$sub_array[] = '<a href="admin/view_report/' . $s_id . '/' . $row->test_id . '/' . $row->subtestid . '/' . $row->pathologoy_id . '" target="_blank" class="btn btn-primary btn-sm">Report Print</a>';
				} else {

					$sub_array[] = '<a href="admin/add_report/' . $row->test_id . '/' . $row->subtestid . '/' . $row->pathologoy_id . '" class="btn btn-primary btn-sm">Report Provide</a>';

					$sub_array[] = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">Report Print</a>';
				}

				$data[] = $sub_array;
				$i++;
			} elseif ($report_lock[0]['flag_ipd'] == 0 && $row->is_ipd_patient == 1) {

				if ($dst > 2) {


					$sub_array[] = '<a href="admin/add_report/' . $row->test_id . '/' . $row->subtestid . '/' . $row->pathologoy_id . '" class="btn btn-primary btn-sm">Report Provide</a>';


					$sub_array[] = '<a href="admin/view_report/' . $s_id . '/' . $row->test_id . '/' . $row->subtestid . '/' . $row->pathologoy_id . '" target="_blank" class="btn btn-primary btn-sm">Report Print</a>';
				} else {

					$sub_array[] = '<a href="admin/add_report/' . $row->test_id . '/' . $row->subtestid . '/' . $row->pathologoy_id . '" class="btn btn-primary btn-sm">Report Provide</a>';

					$sub_array[] = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">Report Print</a>';
				}

				$data[] = $sub_array;
				$i++;
			} else {
				if ($dst > 2 && $row->payment_status == "paid") {


					$sub_array[] = '<a href="admin/add_report/' . $row->test_id . '/' . $row->subtestid . '/' . $row->pathologoy_id . '" class="btn btn-primary btn-sm">Report Provide</a>';


					$sub_array[] = '<a href="admin/view_report/' . $s_id . '/' . $row->test_id . '/' . $row->subtestid . '/' . $row->pathologoy_id . '" target="_blank" class="btn btn-primary btn-sm">Report Print</a>';
				} else {

					$sub_array[] = '<a href="admin/add_report/' . $row->test_id . '/' . $row->subtestid . '/' . $row->pathologoy_id . '" class="btn btn-primary btn-sm">Report Provide</a>';

					$sub_array[] = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">Report Print</a>';
				}


				$data[] = $sub_array;

				$i++;
			}
		}


		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_five_table_join('opd_patient_info', 'opd_patient_info.status=1 and pathologoy.status=1', $select_column, 'pathologoy', 'pathologoy.patient_id=opd_patient_info.id', 'diagnostic_test_subgroup', 'pathologoy.test_id=diagnostic_test_subgroup.id', 'diagnostic_test_group', 'diagnostic_test_subgroup.mtest_id=diagnostic_test_group.test_id', 'opd_patient_test_order_info', 'opd_patient_test_order_info.id=pathologoy.order_id'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_five_table_join(
				'opd_patient_info',
				'opd_patient_info.status=1 and pathologoy.status=1',
				$select_column,
				$order_column,
				$search_column,
				'pathologoy',
				'pathologoy.patient_id=opd_patient_info.id',
				'diagnostic_test_subgroup',
				'pathologoy.test_id=diagnostic_test_subgroup.id',
				'diagnostic_test_group',
				'diagnostic_test_subgroup.mtest_id=diagnostic_test_group.test_id',
				'opd_patient_test_order_info',
				'opd_patient_test_order_info.id=pathologoy.order_id',
				'pathologoy_id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	public function add_report_multi($patient_info_id, $test_group_id, $specimen_id, $order_id, $state = "")
	{

		// "<pre>";print_r($this->uri->segment(2));die();

		$data['prev_module'] = $state;

		$data['active'] = 'add_report_multi';
		$data['page_title'] = 'Add Group Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['ipatient_info_id'] = $patient_info_id;
		$data['igroupid'] = $test_group_id;
		$data['order_id'] = $order_id;
		$data['specimen_id'] = $specimen_id;

		$data['pathology'] = $this->admin_model->select_join_pathology_where('is_ipd_patient,payment_status,is_heading,pathologoy_id,pathologoy.patient_id,order_id,pdate,padate,delivery_date,pathologoy.test_id,delievery_status,patient_name,sub_test_title,delievery_status,diagnostic_test_group.test_id,diagnostic_test_subgroup.ref_val,diagnostic_test_group.speciman,o.ref_doc_name,o.quack_doc_name,test_template,
	 		diagnostic_test_subgroup.unit,test_title,diagnostic_test_group.speciman,ref_doctor_name,opd_patient_info.quack_doc_name,opd_patient_info.age,gender,opd_patient_info.patient_info_id', 'pathologoy', 'opd_patient_info', 'pathologoy.patient_id=opd_patient_info.id', 'diagnostic_test_subgroup', 'pathologoy.test_id=diagnostic_test_subgroup.id', 'diagnostic_test_group', 'diagnostic_test_subgroup.mtest_id=diagnostic_test_group.test_id', 'opd_patient_test_order_info o', 'o.id=pathologoy.order_id', 'patient_info_id="' . $patient_info_id . '" and diagnostic_test_group.test_id="' . $test_group_id . '" and order_id="' . $order_id . '"');

		foreach ($data['pathology'] as $key => $value) {
			if ($value['is_heading'] == 1) {
				$data['heading'] = 'yes';
			} else {
				$data['heading'] = 'no';
			}
		}

		// "<pre>";print_r($data['pathology']);die();

		$multi_result = $this->admin_model->select_with_where2('multi_path_id', 'order_id="' . $order_id . '" and itestid="' . $test_group_id . '"', 'multi_result');


		if (count($multi_result) > 0) {
			$data['multi_result_val'] = $this->admin_model->select_with_where2('mresult', 'multi_path_id="' . $multi_result[0]['multi_path_id'] . '"', 'multi_result');
		} else {
			$data['multi_result_val'] = array();
		}





		$data['doc_info'] = $this->admin_model->select_with_where2('ref_doc_id,ref_doc_name,quack_doc_name,quack_doc_id', 'id="' . $data['pathology'][0]['order_id'] . '"', 'opd_patient_test_order_info');

		$data['order_info'] = $this->admin_model->select_with_where2('*', 'id="' . $data['pathology'][0]['order_id'] . '"', 'opd_patient_test_order_info');

		$data['cabin_ipd_info'] = $this->admin_model->select_join_three_table2('*', 'opd_patient_test_order_info o', 'ipd_patient_info i', 'room r', 'o.ipd_patient_id=i.id', 'i.cabin_no=r.id', 'o.id="' . $data['pathology'][0]['order_id'] . '"');


		$data['patient_name'] = $data['pathology'][0]['patient_name'];
		$data['patient_info_id'] = $data['pathology'][0]['patient_info_id'];
		$data['Age'] = $data['pathology'][0]['age'];
		$data['ref_doctor_name'] = $data['doc_info'][0]['ref_doc_name'];
		$data['quack_doctor_name'] = $data['doc_info'][0]['quack_doc_name'];
		$data['gender'] = $data['pathology'][0]['gender'];
		$data['pdate'] = $data['pathology'][0]['pdate'];
		$data['delivery_date'] = $data['pathology'][0]['delivery_date'];
		$data['itestid'] = $data['pathology'][0]['sub_test_title'];
		$data['test_title'] = $data['pathology'][0]['test_title'];
		$data['test_id'] = $data['pathology'][0]['test_id'];
		$data['test_template'] = $data['pathology'][0]['test_template'];
		$data['specimen'] = $data['pathology'][0]['speciman'];
		$data['unit'] = $data['pathology'][0]['test_id'];
		$data['test_order_id'] = $data['pathology'][0]['order_id'];
		$data['payment_status'] = $data['pathology'][0]['payment_status'];
		$data['is_ipd_patient'] = $data['pathology'][0]['is_ipd_patient'];


		$data['doc_designation'] = $this->admin_model->select_with_where2('*', 'doctor_id="' . $data['doc_info'][0]['ref_doc_id'] . '"', 'doctor');

		if ($data['doc_designation'] != null) {
			$data['designation'] = '(<span>' . $data['doc_designation'][0]['doctor_degree'] . '</span>)';
		} else {
			$data['designation'] = "";
		}

		$data['quack_doc_designation'] = $this->admin_model->select_with_where2('*', 'doctor_id="' . $data['doc_info'][0]['quack_doc_id'] . '"', 'doctor');

		if ($data['quack_doc_designation'] != null) {
			$data['quack_designation'] = '(<span style="font-size:13px;">' . $data['quack_doc_designation'][0]['doctor_degree'] . '</span>)';
		} else {
			$data['quack_designation'] = "";
		}



		$this->load->view('pathlogy/add_report_multi_seba', $data);
	}


	public function add_report_multi_custom($patient_info_id, $test_group_id, $order_id, $specimen_id)
	{

		$data['active'] = 'add_report_multi_custom';
		$data['page_title'] = 'Add Group Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['ipatient_info_id'] = $patient_info_id;
		$data['igroupid'] = $test_group_id;
		$data['order_id'] = $order_id;
		$data['specimen_id'] = $specimen_id;

		$data['pathology'] = $this->admin_model->select_join_pathology_where('is_ipd_patient,payment_status,is_heading,pathologoy_id,pathologoy.patient_id,order_id,pdate,padate,delivery_date,pathologoy.test_id,delievery_status,patient_name,sub_test_title,delievery_status,diagnostic_test_group.test_id,diagnostic_test_subgroup.ref_val,diagnostic_test_group.speciman,o.ref_doc_name,o.quack_doc_name,test_template,
	 		diagnostic_test_subgroup.unit,test_title,diagnostic_test_group.speciman,ref_doctor_name,opd_patient_info.quack_doc_name,opd_patient_info.age,gender,opd_patient_info.patient_info_id', 'pathologoy', 'opd_patient_info', 'pathologoy.patient_id=opd_patient_info.id', 'diagnostic_test_subgroup', 'pathologoy.test_id=diagnostic_test_subgroup.id', 'diagnostic_test_group', 'diagnostic_test_subgroup.mtest_id=diagnostic_test_group.test_id', 'opd_patient_test_order_info o', 'o.id=pathologoy.order_id', 'patient_info_id="' . $patient_info_id . '" and diagnostic_test_group.test_id="' . $test_group_id . '" and order_id="' . $order_id . '"');



		$multi_result = $this->admin_model->select_with_where2('multi_path_id', 'order_id="' . $order_id . '" and itestid="' . $test_group_id . '"', 'multi_result_combine');


		if (count($multi_result) > 0) {
			$data['multi_result_val'] = $this->admin_model->select_with_where2('mresult_combine', 'multi_path_id="' . $multi_result[0]['multi_path_id'] . '"', 'multi_result_combine');
		} else {
			$data['multi_result_val'][0]['mresult_combine'] = "";
		}


		$data['doc_info'] = $this->admin_model->select_with_where2('ref_doc_id,ref_doc_name,quack_doc_name,quack_doc_id', 'id="' . $data['pathology'][0]['order_id'] . '"', 'opd_patient_test_order_info');

		$data['order_info'] = $this->admin_model->select_with_where2('*', 'id="' . $data['pathology'][0]['order_id'] . '"', 'opd_patient_test_order_info');

		$data['cabin_ipd_info'] = $this->admin_model->select_join_three_table2('*', 'opd_patient_test_order_info o', 'ipd_patient_info i', 'room r', 'o.ipd_patient_id=i.id', 'i.cabin_no=r.id', 'o.id="' . $data['pathology'][0]['order_id'] . '"');


		$template = $this->input->post('group_report');

		$store_group_id = $this->input->post('store_group_id');


		$temp_tem = "";
		$temp_id = "";

		for ($i = 0; $i < count($template); $i++) {

			$temp_tem .= $template[$i];
			$temp_id .= $store_group_id[$i] . ',';
		}


		$data['test_template'] = $temp_tem;
		$data['patient_name'] = $data['pathology'][0]['patient_name'];
		$data['patient_info_id'] = $data['pathology'][0]['patient_info_id'];
		$data['Age'] = $data['pathology'][0]['age'];
		$data['ref_doctor_name'] = $data['doc_info'][0]['ref_doc_name'];
		$data['quack_doctor_name'] = $data['doc_info'][0]['quack_doc_name'];
		$data['gender'] = $data['pathology'][0]['gender'];
		$data['pdate'] = $data['pathology'][0]['pdate'];
		$data['delivery_date'] = $data['pathology'][0]['delivery_date'];
		$data['itestid'] = $data['pathology'][0]['sub_test_title'];
		$data['test_title'] = $data['pathology'][0]['test_title'];
		$data['test_id'] = $data['pathology'][0]['test_id'];
		$data['specimen'] = $data['pathology'][0]['speciman'];
		$data['unit'] = $data['pathology'][0]['test_id'];
		$data['test_order_id'] = $data['pathology'][0]['order_id'];
		$data['payment_status'] = $data['pathology'][0]['payment_status'];
		$data['is_ipd_patient'] = $data['pathology'][0]['is_ipd_patient'];
		$data['store_group_id'] = substr($temp_id, 0, -1);

		$data['doc_designation'] = $this->admin_model->select_with_where2('*', 'doctor_id="' . $data['doc_info'][0]['ref_doc_id'] . '"', 'doctor');

		if ($data['doc_designation'] != null) {
			$data['designation'] = '(<span>' . $data['doc_designation'][0]['doctor_degree'] . '</span>)';
		} else {
			$data['designation'] = "";
		}

		$data['quack_doc_designation'] = $this->admin_model->select_with_where2('*', 'doctor_id="' . $data['doc_info'][0]['quack_doc_id'] . '"', 'doctor');

		if ($data['quack_doc_designation'] != null) {
			$data['quack_designation'] = '(<span style="font-size:13px;">' . $data['quack_doc_designation'][0]['doctor_degree'] . '</span>)';
		} else {
			$data['quack_designation'] = "";
		}


		$this->load->view('pathlogy/add_report_multi_seba_custom', $data);
	}


	public function add_report_multi_ajax()
	{
		$test_group_id = $this->input->post('group_id');
		$order_id = $this->input->post('order_id');
		$patient_info_id = $this->input->post('p_id');


		$data['pathology'] = $this->admin_model->select_join_pathology_where('add_machine_text,payment_status,is_heading,pathologoy_id,pathologoy.patient_id,order_id,pdate,padate,delivery_date,pathologoy.test_id,delievery_status,patient_name,sub_test_title,delievery_status,diagnostic_test_group.test_id,diagnostic_test_subgroup.ref_val,diagnostic_test_group.speciman,o.ref_doc_name,o.quack_doc_name,test_template,
	 		diagnostic_test_subgroup.unit,test_title,diagnostic_test_group.speciman,ref_doctor_name,opd_patient_info.quack_doc_name,opd_patient_info.age,gender,opd_patient_info.patient_info_id', 'pathologoy', 'opd_patient_info', 'pathologoy.patient_id=opd_patient_info.id', 'diagnostic_test_subgroup', 'pathologoy.test_id=diagnostic_test_subgroup.id', 'diagnostic_test_group', 'diagnostic_test_subgroup.mtest_id=diagnostic_test_group.test_id', 'opd_patient_test_order_info o', 'o.id=pathologoy.order_id', 'patient_info_id="' . $patient_info_id . '" and diagnostic_test_group.test_id="' . $test_group_id . '" and order_id="' . $order_id . '"');

		echo json_encode($data);
	}


	public function add_report($groupid, $testid, $pathologoy_id)
	{
		$data['group_name'] = $this->admin_model->select_with_where2('*', 'test_id="' . $groupid . '"', 'diagnostic_test_group');

		$data['ispeciman'] = $data['group_name'][0]['speciman'];
		$data['igroupid'] = $data['group_name'][0]['test_title'];
		$data['iitestid'] = $testid;
		$data['ipathologoy_id'] = $pathologoy_id;

		$data['active'] = 'pathology_list';
		$data['page_title'] = 'Add Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['pathology'] = $this->admin_model->select_join_pathology_where('pathologoy_id,pathologoy.patient_id,order_id,pdate,padate,delivery_date,pathologoy.test_id,delievery_status,patient_name,sub_test_title,delievery_status,
	 		test_title,diagnostic_test_group.speciman,o.ref_doc_name,o.quack_doc_name,opd_patient_info.age,opd_patient_info.gender,unit,opd_patient_info.patient_info_id,test_template', 'pathologoy', 'opd_patient_info', 'pathologoy.patient_id=opd_patient_info.id', 'diagnostic_test_subgroup', 'pathologoy.test_id=diagnostic_test_subgroup.id', 'diagnostic_test_group', 'diagnostic_test_subgroup.mtest_id=diagnostic_test_group.test_id', 'opd_patient_test_order_info o', 'o.id=pathologoy.order_id', 'pathologoy_id="' . $pathologoy_id . '"');

		$data['patient_name'] = $data['pathology'][0]['patient_name'];
		$data['patient_info_id'] = $data['pathology'][0]['patient_info_id'];
		$data['Age'] = $data['pathology'][0]['age'];
		$data['ref_doctor_name'] = $data['pathology'][0]['ref_doc_name'];
		$data['quack_doctor_name'] = $data['pathology'][0]['quack_doc_name'];
		$data['gender'] = $data['pathology'][0]['gender'];
		$data['pdate'] = $data['pathology'][0]['pdate'];
		$data['delivery_date'] = $data['pathology'][0]['delivery_date'];
		$data['itestid'] = $data['pathology'][0]['sub_test_title'];
		$data['specimen'] = $data['pathology'][0]['speciman'];
		$data['unit'] = $data['pathology'][0]['unit'];
		$data['test_template'] = $data['pathology'][0]['test_template'];
		$data['test_order_id'] = $data['pathology'][0]['order_id'];



		$data['doc_info'] = $this->admin_model->select_with_where2('ref_doc_id,ref_doc_name,quack_doc_name,quack_doc_id', 'id="' . $data['pathology'][0]['order_id'] . '"', 'opd_patient_test_order_info');

		$data['order_info'] = $this->admin_model->select_with_where2('*', 'id="' . $data['pathology'][0]['order_id'] . '"', 'opd_patient_test_order_info');

		$data['doc_designation'] = $this->admin_model->select_with_where2('*', 'doctor_id="' . $data['doc_info'][0]['ref_doc_id'] . '"', 'doctor');

		$data['quack_doc_designation'] = $this->admin_model->select_with_where2('*', 'doctor_id="' . $data['doc_info'][0]['quack_doc_id'] . '"', 'doctor');

		if ($data['doc_designation'] != null) {
			$data['designation'] = '(<span>' . $data['doc_designation'][0]['doctor_degree'] . '</span>)';
		} else {
			$data['designation'] = "";
		}

		if ($data['quack_doc_designation'] != null) {
			$data['quack_designation'] = '(<span style="font-size:13px;">' . $data['quack_doc_designation'][0]['doctor_degree'] . '</span>)';
		} else {
			$data['quack_designation'] = "";
		}




		$this->load->view('pathlogy/add_report_seba', $data);
	}

	public function view_report($specimen_id, $groupid, $testid, $pathologoy_id)
	{

		$data['active'] = 'view_report';
		$data['page_title'] = 'View Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['pathology'] = $this->admin_model->select_with_where2('*', 'pathologoy_id="' . $pathologoy_id . '"', 'pathologoy');

		$data['description'] = $data['pathology'][0]['description'];

		$data['technologist_info'] = $this->admin_model->select_with_where2('*', 'specimen_id="' . $specimen_id . '"', 'add_technologist');

		$this->load->view('pathlogy/view_report_seba', $data, FALSE);
	}
	public function report_publish()
	{
		$data['pathologoy_id'] = $this->input->post('pathologoy_id');
		$data['delivery_date'] = $this->input->post('delievry_date');
		$data['speciman'] = $this->input->post('speciman');
		$data['group_id'] = $this->input->post('group_id');
		$data['description'] = $this->input->post('result');
		$data['delievery_status'] = 3;
		$this->admin_model->update_function('pathologoy_id', $data['pathologoy_id'], 'pathologoy', $data);
		//$this->session->set_userdata('scc_alt', $this->lang->line('update_scc_msg'));
		$this->session->set_flashdata('Successfully', 'Result Published Done');
		redirect('admin/pathology_list', 'refresh');
	}

	public function search_pathology()
	{
		$data['active'] = 'search_pathology';
		$data['page_title'] = 'Search Pathology';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$this->load->view('pathlogy/pathology_search', $data);
	}

	public function search_pathology_custom()
	{
		$data['active'] = 'search_pathology_custom';
		$data['page_title'] = 'Search Pathology Custom';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$this->load->view('pathlogy/pathology_search_custom', $data);
	}

	public function search_pathology_list()
	{

		$data['active'] = 'search_pathology';
		$data['page_title'] = 'Search Pathology';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$flag = $this->uri->segment(3);

		if ($flag != null) {
			$patient_id = $flag;
		} else {
			$patient_id = $this->input->post('patient_id');
			$data['patient_id'] = $patient_id;
		}

		$data['report_lock'] = $this->admin_model->select_all('report_lock');

		$data['pathology'] = $this->admin_model->pathology_group_wise_report_patient_id($patient_id);

		// "<pre>";print_r($data['pathology']);die();

		$this->load->view('pathlogy/pathology_search_d', $data);
	}

	public function search_pathology_list_custom()
	{

		$data['active'] = 'search_pathology';
		$data['page_title'] = 'Search Pathology Custom';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$flag = $this->uri->segment(3);



		if ($flag != null) {
			$order_id = $flag;
		} else {
			$order_id = $this->input->post('order_id');
			$data['order_id'] = $order_id;
		}

		$data['pathology'] = $this->admin_model->pathology_group_wise_report($order_id);

		$data['report_lock'] = $this->admin_model->select_all('report_lock');

		// "<pre>";print_r($data['pathology']);die();

		if ($data['pathology'] == null) {
			$this->session->set_flashdata('no_data', 'No Patient Order Found');
			redirect('admin/search_pathology_custom', 'refresh');
		}

		$this->load->view('pathlogy/pathology_search_d_custom', $data);
	}




	public function report_publish_multi($specimen_id = '', $payment_status = '', $prev_module = '')
	{


		$data['patient_info_id'] = $this->input->post('patient_info_id');
		$data['itestid'] = $this->input->post('itestid');
		$data['order_id'] = $this->input->post('order_id');

		$patient_id = $this->admin_model->select_with_where2('*,patient_id', 'status=1 and id="' . $data['order_id'] . '"', 'opd_patient_test_order_info');

		$pathology = $this->admin_model->select_with_where2('itestid,patient_info_id,multi_path_id', 'order_id="' . $data['order_id'] . '" and itestid="' . $data['itestid'] . '"', 'multi_result');

		$val['is_multi_print'] = 1;

		$this->admin_model->update_function2('order_id="' . $data['order_id'] . '" and group_id="' . $data['itestid'] . '"', 'pathologoy', $val);

		// "<pre>";print_r($pathology);die();

		$data['mresult'] = $this->input->post('mresult');
		// "<pre>";print_r($data['mresult']);die();

		if (count($pathology) > 0) {
			$m_path_id = $pathology[0]['multi_path_id'];
			$data['multi_path_id'] = $m_path_id;
			$pathid = $m_path_id;

			$this->admin_model->update_function('multi_path_id', $pathid, 'multi_result', $data);
		} else {
			$m_path_id = $this->admin_model->insert_ret('multi_result', $data);
		}

		$this->session->set_flashdata('Successfully', 'Result Published Done');

		$report_lock = $this->admin_model->select_all('report_lock');

		if ($payment_status == "paid") {
			redirect('admin/view_report_m/' . $m_path_id . '/' . $specimen_id, 'refresh');
		} elseif ($report_lock[0]['flag'] == 0 && $patient_id[0]['is_ipd_patient'] == 0) {
			redirect('admin/view_report_m/' . $m_path_id . '/' . $specimen_id, 'refresh');
		} elseif ($report_lock[0]['flag_ipd'] == 0 && $patient_id[0]['is_ipd_patient'] == 1) {
			redirect('admin/view_report_m/' . $m_path_id . '/' . $specimen_id, 'refresh');
		}

		if ($prev_module == 'custom') {
			redirect('admin/search_pathology_list_custom/' . $patient_id[0]['test_order_id']);
		} else {
			redirect('admin/search_pathology_list/' . $patient_id[0]['patient_id']);
		}
	}


	public function report_publish_multi_custom($specimen_id = '', $payment_status = '')
	{

		$data['patient_info_id'] = $this->input->post('patient_info_id');
		$data['itestid'] = $this->input->post('itestid');
		$data['order_id'] = $this->input->post('order_id');

		$patient_id = $this->admin_model->select_with_where2('*,patient_id', 'status=1 and id="' . $data['order_id'] . '"', 'opd_patient_test_order_info');

		$pathology = $this->admin_model->select_with_where2('itestid,patient_info_id,multi_path_id', 'order_id="' . $data['order_id'] . '" and itestid="' . $data['itestid'] . '"', 'multi_result_combine');

		$val['is_multi_print'] = 3;

		$this->admin_model->update_function2('order_id="' . $data['order_id'] . '"', 'pathologoy', $val);


		$this->admin_model->update_function2('order_id="' . $data['order_id'] . '" and group_id="' . $data['itestid'] . '"', 'pathologoy', $val);

		$val1['combined_group_id'] = $this->input->post('store_group_id');

		$this->admin_model->update_function2('order_id="' . $data['order_id'] . '"', 'pathologoy', $val1);

		// "<pre>";print_r($pathology);die();

		$str = preg_replace('/\s\s+/', ' ', $this->input->post('mresult_combine'));

		$data['mresult_combine'] = str_replace('</div> </div>', '</div>', $str);

		$val['is_multi_print'] = 1;

		// "<pre>";print_r($data['mresult_combine']);die();

		if (count($pathology) > 0) {
			$m_path_id = $pathology[0]['multi_path_id'];
			$data['multi_path_id'] = $m_path_id;
			$pathid = $m_path_id;

			$this->admin_model->update_function('multi_path_id', $pathid, 'multi_result_combine', $data);
		} else {
			$m_path_id = $this->admin_model->insert_ret('multi_result_combine', $data);
		}

		$this->session->set_flashdata('Successfully', 'Result Published Done');

		$report_lock = $this->admin_model->select_all('report_lock');

		if ($payment_status == "paid") {
			redirect('admin/view_report_m_custom/' . $m_path_id . '/' . $specimen_id, 'refresh');
		} elseif ($report_lock[0]['flag'] == 0 && $patient_id[0]['is_ipd_patient'] == 0) {
			redirect('admin/view_report_m_custom/' . $m_path_id . '/' . $specimen_id, 'refresh');
		} elseif ($report_lock[0]['flag_ipd'] == 0 && $patient_id[0]['is_ipd_patient'] == 1) {
			redirect('admin/view_report_m_custom/' . $m_path_id . '/' . $specimen_id, 'refresh');
		}

		redirect('admin/search_pathology_list_custom/' . $patient_id[0]['patient_id']);
	}

	public function dlt_old_combine_report($order_id = '')
	{
		$data['mresult_combine'] = "";
		$this->admin_model->update_function('order_id', $order_id, 'multi_result_combine', $data);

		$val['combined_group_id'] = "";
		$this->admin_model->update_function('order_id', $order_id, 'pathologoy', $val);

		redirect('admin/search_pathology_custom', 'refresh');
	}

	public function view_report_m_custom($mid, $specimen_id)
	{
		$data['pathology'] = $this->admin_model->select_with_where2('*', 'multi_path_id="' . $mid . '"', 'multi_result_combine');

		// "<pre>";print_r($data['pathology']);die();
		$data['description'] = $data['pathology'][0]['mresult_combine'];

		$data['technologist_info'] = $this->admin_model->select_with_where2('*', 'specimen_id="' . $specimen_id . '"', 'add_technologist');


		$this->load->view('pathlogy/view_report_m_seba', $data);
	}



	public function view_report_m($mid, $specimen_id)
	{
		$data['pathology'] = $this->admin_model->select_with_where2('*', 'multi_path_id="' . $mid . '"', 'multi_result');

		// "<pre>";print_r($data['pathology']);die();
		$data['description'] = $data['pathology'][0]['mresult'];

		$data['technologist_info'] = $this->admin_model->select_with_where2('*', 'specimen_id="' . $specimen_id . '"', 'add_technologist');


		$this->load->view('pathlogy/view_report_m_seba', $data);
	}

	public function view_report_order_id($patient_id, $test_id, $oid)
	{

		$data['active'] = 'view_report_order_id';
		$data['page_title'] = 'View Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['pathology'] = $this->admin_model->select_with_where2('*', 'order_id="' . $oid . '" and itestid="' . $test_id . '" and patient_info_id="' . $patient_id . '"', 'multi_result');

		// "<pre>";print_r($data['pathology']);die();

		$data['technologist_info'] = $this->admin_model->select_with_where2('*', 'id=1', 'add_technologist');

		if ($data['pathology'] == null) {
			$this->load->view('pathlogy/no_data_found', $data);
		} else {
			$data['description'] = $data['pathology'][0]['mresult'];
			$this->load->view('pathlogy/view_report_m_seba', $data);
		}
	}



	public function testlist()
	{
		$data['active'] = 'Test List';
		$data['page_title'] = 'Manage Test List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['testlist'] = $this->admin_model->select_join('sub_test_title,price,diagnostic_test_group.test_title,diagnostic_test_subgroup.id', 'diagnostic_test_subgroup', 'diagnostic_test_group', 'diagnostic_test_group.test_id=diagnostic_test_subgroup.mtest_id');

		$this->load->view('pathlogy/testlist', $data);
	}

	public function test_edit($testid)
	{
		$testid = $testid;
		$data['active'] = 'Test List';
		$data['page_title'] = 'Manage Test List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['testlist'] = $this->admin_model->select_join_where('add_machine_text,is_heading,sub_test_title,price,diagnostic_test_group.test_title,diagnostic_test_subgroup.id,diagnostic_test_subgroup.unit,diagnostic_test_subgroup.test_template', 'diagnostic_test_subgroup', 'diagnostic_test_group', 'diagnostic_test_group.test_id=diagnostic_test_subgroup.mtest_id', 'id="' . $testid . '"');

		$data['sub_test_title'] = $data['testlist'][0]['sub_test_title'];
		$data['add_machine_text'] = $data['testlist'][0]['add_machine_text'];
		$data['subtestid'] = $data['testlist'][0]['id'];
		$data['test_title'] = $data['testlist'][0]['test_title'];
		$data['unit'] = $data['testlist'][0]['unit'];
		$data['test_template'] = $data['testlist'][0]['test_template'];
		$data['is_heading'] = $data['testlist'][0]['is_heading'];

		$this->load->view('pathlogy/seba_testedit', $data);
	}

	public function edit_test()
	{
		$subtestid = $this->input->post('subtestid');
		$template = $this->input->post('template');
		$heading = $this->input->post('heading');
		$data['test_template'] = $template;
		$data['is_heading'] = $heading;
		$this->load->admin_model->update_function2('id="' . $subtestid . '"', 'diagnostic_test_subgroup', $data);

		redirect('admin/testlist', 'refresh');
	}

	public function technologist_list($value = '')
	{
		$data['active'] = 'Test List';
		$data['page_title'] = 'Technologist List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['technologist_list'] = $this->admin_model->select_join_where('*,s.id', 'add_specimen s', 'add_technologist t', 's.id=t.specimen_id', 's.status=1');


		$this->load->view('pathlogy/technologist_list', $data);
	}

	public function edit_technologist($value = '')
	{
		$data['active'] = 'Test List';
		$data['page_title'] = 'Edit Technologist List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$id = $this->uri->segment(3);

		$data['technologist_list'] = $this->admin_model->select_with_where2('*', 'id="' . $id . '"', 'add_technologist');

		$data['specimen_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'add_specimen');

		// "<pre>";print_r($data['specimen_list']);die();

		$this->load->view('pathlogy/edit_technologist', $data);
	}

	public function update_technologist($value = '')
	{
		$data['active'] = 'Test List';
		$data['page_title'] = 'Manage Test List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$id = $this->uri->segment(3);

		// "<pre>";print_r($id);die();

		$val = array(
			'checked_by_name' => $this->input->post('checked_by'),
			'checked_by_designation' => $this->input->post('checked_by_designation'),
			'checked_by_address' => $this->input->post('checked_by_address'),
			'checked_add_1' => $this->input->post('checked_add_1'),
			'checked_add_2' => $this->input->post('checked_add_2'),

			'prepared_by_name' => $this->input->post('prepared_by'),
			'prepared_by_designation' => $this->input->post('prepared_by_designation'),
			'prepared_by_address' => $this->input->post('prepared_by_address'),
			'prepared_add_1' => $this->input->post('prepared_add_1'),
			'prepared_add_2' => $this->input->post('prepared_add_2'),

			'technologist_name' => $this->input->post('technologist_name'),
			'technologist_designation' => $this->input->post('technologist_designation'),
			'technologist_address' => $this->input->post('technologist_address'),
			'technologist_add_1' => $this->input->post('technologist_add_1'),
			'technologist_add_2' => $this->input->post('technologist_add_2'),

		);

		$this->load->admin_model->update_function2('id="' . $id . '"', 'add_technologist', $val);

		redirect('admin/technologist_list', 'refresh');
	}

	// **************** Pathology Module End  **************


	// Manage Share Holder Starts


	public function add_share_holder($value = '')
	{

		$data['active'] = 'share_holder';
		$data['page_title'] = 'Manage Share Holder';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['share_holder_type'] = $this->admin_model->select_all('share_holder_type');

		$data['relation'] = $this->admin_model->select_all('relation_info');



		$this->form_validation->set_error_delimiters('<div>', '</div>');
		//Validating Name Field
		$this->form_validation->set_rules('hospital_title', 'Hospital Title', 'required');


		// $this->form_validation->set_rules('director', 'Director', 'required');
		// $this->form_validation->set_rules('telephone', 'Telephone', 'required');
		// $this->form_validation->set_rules('file1', 'Hospital Logo', 'required');
		// $this->form_validation->set_rules('email', 'Email', 'required');
		// $this->form_validation->set_rules('fax', 'Fax', 'required');
		// $this->form_validation->set_rules('address_1', 'Address No 1', 'required');
		// $this->form_validation->set_rules('address_2', 'Address No 2', 'required');
		// $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required');
		// $this->form_validation->set_rules('country', 'Country', 'required');
		// // $this->form_validation->set_rules('branch', 'Branch', 'required');
		// $this->form_validation->set_rules('division', 'Division', 'required');
		// $this->form_validation->set_rules('district', 'District', 'required');
		// $this->form_validation->set_rules('area', 'Area', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('share_holder/add_share_holder', $data);
		} else {
			$share_holder_image = 'default_share_holder_image.png';
			$verification_image = 'default_verification_image.png';
			$signature_image = 'default_signature_image.png';


			$val = array(
				'hospital_title' => $this->input->post('hospital_title'),
				'share_holder_name' => $this->input->post('share_holder_name'),
				'father_name' => $this->input->post('father_name'),
				'mother_name' => $this->input->post('mother_name'),
				'nominee_name' => $this->input->post('nominee_name'),
				'relation_id' => $this->input->post('relation_id'),
				'signature_image' => $signature_image,
				'share_holder_image' => $share_holder_image,
				'verification_image' => $verification_image,
				'email' => $this->input->post('email'),
				'nid_number' => $this->input->post('nid_number'),
				'address_1' => $this->input->post('address_1'),
				'address_2' => $this->input->post('address_2'),
				'mobile_no' => $this->input->post('mobile_no'),
				'passport_number' => $this->input->post('passport_number'),
				// 'branch_id' => $this->input->post('branch'),
				'first_installment' => $this->input->post('installment'),
				'type_id' => $this->input->post('gratuity_type'),

				'created_at' => date('Y-m-d H:i:s')
			);

			$id = $this->admin_model->insert_ret('share_holder_member', $val);



			if ($_FILES['share_holder_image']['name']) {
				$name_generator = $this->name_generator($_FILES['share_holder_image']['name'], $id);
				$i_ext = explode('.', $_FILES['share_holder_image']['name']);
				$target_path = $name_generator . '.' . end($i_ext);;
				$size = getimagesize($_FILES['share_holder_image']['tmp_name']);

				if (move_uploaded_file($_FILES['share_holder_image']['tmp_name'], 'uploads/share_holder/share_holder_image' . $target_path)) {
					$share_holder_image = $target_path;
				}

				$data_logo1['share_holder_image'] = $share_holder_image;
				$this->admin_model->update_function('id', $id, 'share_holder_member', $data_logo1);
			}


			if ($_FILES['verification_image']['name']) {
				$name_generator = $this->name_generator($_FILES['verification_image']['name'], $id);
				$i_ext = explode('.', $_FILES['verification_image']['name']);
				$target_path = $name_generator . '.' . end($i_ext);;
				$size = getimagesize($_FILES['verification_image']['tmp_name']);

				if (move_uploaded_file($_FILES['verification_image']['tmp_name'], 'uploads/share_holder/verification_image' . $target_path)) {
					$verification_image = $target_path;
				}

				$data_logo2['verification_image'] = $verification_image;
				$this->admin_model->update_function('id', $id, 'share_holder_member', $data_logo2);
			}

			if ($_FILES['signature_image']['name']) {
				$name_generator = $this->name_generator($_FILES['signature_image']['name'], $id);
				$i_ext = explode('.', $_FILES['signature_image']['name']);
				$target_path = $name_generator . '.' . end($i_ext);;
				$size = getimagesize($_FILES['signature_image']['tmp_name']);

				if (move_uploaded_file($_FILES['signature_image']['tmp_name'], 'uploads/share_holder/signature_image' . $target_path)) {
					$signature_image = $target_path;
				}

				$data_logo3['signature_image'] = $signature_image;
				$this->admin_model->update_function('id', $id, 'share_holder_member', $data_logo3);
			}



			$data['message'] = 'Data Inserted Successfully';
			$this->load->view('share_holder/add_share_holder', $data);
		}
		// $this->load->view(); 




	}


	public function share_holder_type($value = '')
	{
		$data['active'] = 'share_holder';
		$data['page_title'] = 'Manage Share Holder';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$this->form_validation->set_error_delimiters('<div>', '</div>');
		//Validating Name Field
		// $this->form_validation->set_rules('title_id', 'Title', 'required');

		$this->form_validation->set_rules('amount', 'Amount', 'required');


		// $this->form_validation->set_rules('director', 'Director', 'required');
		// $this->form_validation->set_rules('telephone', 'Telephone', 'required');
		// $this->form_validation->set_rules('file1', 'Hospital Logo', 'required');
		// $this->form_validation->set_rules('email', 'Email', 'required');
		// $this->form_validation->set_rules('fax', 'Fax', 'required');
		// $this->form_validation->set_rules('address_1', 'Address No 1', 'required');
		// $this->form_validation->set_rules('address_2', 'Address No 2', 'required');
		// $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required');
		// $this->form_validation->set_rules('country', 'Country', 'required');
		// // $this->form_validation->set_rules('branch', 'Branch', 'required');
		// $this->form_validation->set_rules('division', 'Division', 'required');
		// $this->form_validation->set_rules('district', 'District', 'required');
		// $this->form_validation->set_rules('area', 'Area', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('share_holder/share_holder_type', $data);
		} else {


			$val = array(
				'title' => $this->input->post('title'),
				'amount' => $this->input->post('amount'),

				'return_amount' => $this->input->post('return_amount'),
				'gratuity_type' => $this->input->post('gratuity_type'),

				'created_at' => date('Y-m-d H:i:s')
			);

			$id = $this->admin_model->insert_ret('share_holder_type', $val);

			$this->load->view('share_holder/share_holder_type', $data);
		}
	}

	// <<<<<<<<<<<<<<<  Manage Appoinment Module Starts  >>>>>>>>>>>>>>>>>


	public function add_appointment_prescription($appointment_id = '')
	{
		$data['active'] = 'add_appointment_prescription';
		$data['page_title'] = 'Add Prescription';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['appointment_id'] = $appointment_id;

		// "<pre>";print_r($data['appointment_id']);die();

		$data['product_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'product');

		$data['test_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'diagnostic_test_subgroup');

		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['dose_schedule_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'dose_schedule');

		$data['appointment_list'] = $this->admin_model->select_with_where2('*', 'appointment_status=1', 'doc_appointment');

		$data['prescription_info'] = $this->admin_model->select_five_join_where_left('*,da.id,a.id as pr_id,a.description', 'doc_appointment da', 'appointment_prescription_details a', 'local_patient_info l', 'product pd', 'doctor d', 'product_category pc', 'da.id=a.appointment_id', 'l.id=da.appointed_p_id', 'pd.id=a.medicine_id', 'd.doctor_id=da.doc_id', 'pc.id=pd.p_cat_id', 'l.status=1 and da.appointment_status=1 and da.id="' . $appointment_id . '"');

		$this->load->view('appointment/add_appointment_prescription', $data);
	}

	public function add_appointment_prescription_post($value = '')
	{


		$appointment_id = $this->input->post('appointment_id');
		$val['doc_id'] = $this->input->post('doctor_id');
		$val['note'] = $this->input->post('note');
		$val['cc'] = $this->input->post('cc');
		$val['general_exam'] = $this->input->post('general_exam');
		$val['advice'] = $this->input->post('advice');
		$val['note'] = $this->input->post('note');
		$val['bp'] = $this->input->post('bp');
		$val['spo2'] = $this->input->post('spo2');
		$val['diagnosis'] = $this->input->post('diagnosis');
		$val['pulse'] = $this->input->post('pulse');
		$val['weight'] = $this->input->post('weight');
		$val['created_at'] = date('Y-m-d h:i:s');

		$tests = $this->input->post('test_id');

		for ($i = 0; $i < count($tests); $i++) {

			$var = explode('#', $tests[$i]);

			$tests_id[$i] = $var[0];
			$tests_name[$i] = $var[1];
		}

		$val['test_name'] = implode(',', $tests_name);
		$val['test_id'] = implode(',', $tests_id);

		$this->admin_model->update_function2('id="' . $appointment_id . '"', 'doc_appointment', $val);


		// delete all first 

		$this->admin_model->delete_function_cond('appointment_prescription_details', 'appointment_id="' . $appointment_id . '"');

		$med_id = $this->input->post('med_id');
		$unknown_medicine_name = $this->input->post('unknown_medicine_name');
		$type = $this->input->post('type');

		$dose_qty = $this->input->post('dose_qty');

		$max_day = $this->input->post('max_day');
		$description = $this->input->post('description');



		for ($i = 0; $i < count($med_id); $i++) {

			if ($med_id[$i] != "") {
				$val = explode('#', $med_id[$i]);
				$data['medicine_id'] = $val[0];
				$data['medicine_name'] = $val[1];
			} else {
				$data['medicine_id'] = 0;
				$data['medicine_name'] = $unknown_medicine_name[$i];
			}

			$data['type'] = $type[$i];
			$data['dose_qty'] = $dose_qty[$i];
			$data['max_day'] = $max_day[$i];
			$data['description'] = $description[$i];
			$data['appointment_id'] = $appointment_id;
			$data['created_at'] = date('Y-m-d h:i:s');;


			$daily_dose = $this->input->post('day_dose_' . $i);;

			$data['daily_dose'] = implode(',', $daily_dose);


			$this->admin_model->insert_ret('appointment_prescription_details', $data);
		}

		redirect('admin/appointment_list');
	}



	public function attendant_list($value = '')
	{
		$data['active'] = 'add_doc_schedule';
		$data['page_title'] = 'Add Doctor Schedule';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['attendant_list'] = $this->admin_model->select_with_where2('*', 'hospital_id="' . $this->session->userdata['logged_in']['hospital_id'] . '" AND FIND_IN_SET("' . $this->session->userdata['logged_in']['id'] . '",assigned_for)', 'login');

		$this->load->view('appointment/attendant_list', $data);
	}

	public function delete_attendant($value = '')
	{
		$data['attendant_info'] = $this->admin_model->select_with_where2('*', 'id="' . $_POST['id'] . '"', 'login');

		$val['assigned_for'] = $this->removeFromString($data['attendant_info'][0]['assigned_for'], $this->session->userdata['logged_in']['id']);

		$val['doc_id'] = $this->removeFromString($data['attendant_info'][0]['doc_id'], $this->session->userdata['logged_in']['doc_id']);

		if ($val['assigned_for'] == null) {
			$val['role'] = $this->removeFromString($data['attendant_info'][0]['role'], 11);
		}


		// "<pre>";print_r($val['assigned_for']);die();

		$this->admin_model->update_function2('id="' . $_POST['id'] . '"', 'login', $val);
	}

	function removeFromString($str, $item)
	{
		$parts = explode(',', $str);

		// "<pre>";print_r($parts);die();

		if (count($parts) == 1) {
			return null;
		}

		while (($i = array_search($item, $parts)) !== false) {
			unset($parts[$i]);
		}

		return implode(',', $parts);
	}


	public function add_attendant($value = '')
	{
		$data['active'] = 'add_doc_schedule';
		$data['page_title'] = 'Add attendant';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['user_list'] = $this->admin_model->select_with_where2('*', 'hospital_id="' . $this->session->userdata['logged_in']['hospital_id'] . '" AND role not in(0,3)', 'login');


		$this->load->view('appointment/add_attendant', $data);
	}


	public function add_attendant_post($value = '')
	{

		$user_list = $this->input->post('user_list');

		// "<pre>";print_r($user_list);die();

		for ($i = 0; $i < count($user_list); $i++) {

			$user_info = $this->admin_model->select_with_where2('*', 'id="' . $user_list[$i] . '"', 'login');


			if (!in_array(11, explode(',', $user_info[0]['role']))) {
				if ($user_info[0]['role'] != null) {
					$val['role'] = $user_info[0]['role'] . ',' . '11';
				} else {
					$val['role'] = '11';
				}

				$this->admin_model->update_function2('id="' . $user_list[$i] . '"', 'login', $val);
			}

			if (!in_array($this->session->userdata['logged_in']['id'], explode(',', $user_info[0]['assigned_for']))) {
				if ($user_info[0]['assigned_for'] != null) {

					$val['assigned_for'] = $user_info[0]['assigned_for'] . ',' . $this->session->userdata['logged_in']['id'];
				} else {

					$val['assigned_for'] = $this->session->userdata['logged_in']['id'];
				}

				$this->admin_model->update_function2('id="' . $user_list[$i] . '"', 'login', $val);
			}


			if (!in_array($this->session->userdata['logged_in']['doc_id'], explode(',', $user_info[0]['doc_id']))) {
				if ($user_info[0]['doc_id'] != null) {

					$val['doc_id'] = $user_info[0]['doc_id'] . ',' . $this->session->userdata['logged_in']['doc_id'];
				} else {

					$val['doc_id'] = $this->session->userdata['logged_in']['doc_id'];
				}

				$this->admin_model->update_function2('id="' . $user_list[$i] . '"', 'login', $val);
			}





			// "<pre>";print_r($val['role']);die();





		}



		redirect('admin/add_attendant');
	}

	public function add_doc_schedule()
	{
		$data['active'] = 'add_doc_schedule';
		$data['page_title'] = 'Add Doctor Schedule';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$doc_id = $this->uri->segment(3);



		$data['doc_id'] = $doc_id;

		if ($data['admin_type'] != 0 && $data['admin_type'] != 1) {
			$data['doc_info'] = $this->admin_model->select_with_where2('*', 'doctor_id in("' . $this->session->userdata['logged_in']['doc_id'] . '")', 'doctor');
		} else {
			$data['doc_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

			$data['room'] = $this->admin_model->select_with_where2('*', 'status=1 and type=2', 'room');
		}


		$this->load->view('appointment/add_doc_schedule', $data);
	}

	public function get_all_doc_info_by_doc_id()
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1 and doctor_id="' . $_POST['doc_id'] . '"', 'doctor');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}


	public function add_doc_schedule_post()
	{

		$week_day = $this->input->post('week_day');
		$start = $this->input->post('global_from');
		$end = $this->input->post('global_to');
		$username = $this->session->userdata['logged_in']['username'];

		for ($i = 0; $i < count($week_day); $i++) {


			$dlt_status['schedule_status'] = 2;

			$this->admin_model->update_function2('doc_id="' . $this->input->post('doc_id') . '" and schedule_day="' . $week_day[$i] . '"', 'doctor_schedule', $dlt_status);

			// if($this->admin_model->select_with_where2('*','doc_id="'.$this->input->post('doc_id').'" and schedule_day="'.$week_day[$i].'" and schedule_status=1','doctor_schedule')!=null)
			// {
			// 	$data['start_time']=date("H:i", strtotime($start));
			// 	$data['end_time']=date("H:i", strtotime($end));
			// 	$data['doc_fee_new']=$this->input->post('dr_fee_new');
			// 	$data['doc_fee_old']=$this->input->post('dr_fee_old');
			// 	$data['doc_fee_report']=$this->input->post('dr_fee_report');

			// 	// $data['time_per_patient']=$this->input->post('time_per_patient');
			// 	$data['operated_by']=$username;
			// 	$data['updated_at']=date('Y-m-d H:i:s');


			// }
			// else
			// {
			$data['doc_id'] = $this->input->post('doc_id');
			$data['room_id'] = $this->input->post('cabin_no');
			$data['schedule_day'] = $week_day[$i];
			$data['start_time'] = date("H:i", strtotime($start));
			$data['end_time'] = date("H:i", strtotime($end));
			$data['doc_fee_new'] = $this->input->post('dr_fee_new');
			$data['doc_fee_old'] = $this->input->post('dr_fee_old');
			$data['doc_fee_report'] = $this->input->post('dr_fee_report');

			$data['schedule_status'] = 1;

			$data['operated_by'] = $username;
			$data['created_at'] = date('Y-m-d H:i:s');

			$this->admin_model->insert_ret('doctor_schedule', $data);
			// }



		}

		redirect('admin/doc_schedule_list');
	}


	public function doc_schedule_list($value = '')
	{
		$data['active'] = 'doc_schedule_list';
		$data['page_title'] = 'Doctor Schedule List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		// $data['doc_schedule_info']=$this->admin_model->doc_schedule_list();

		// "<pre>";print_r($data['doc_schedule_info']);die();

		$this->load->view('appointment/doc_schedule_list', $data);
	}

	public function doc_schedule_list_dt($value = '')
	{
		// $select_column=array("id", "service_name", "service_price");
		$order_column = array('id', null, 'doctor_title', null, null, null, null, null, null, null);

		$fetch_data = $this->admin_model->make_datatables_doc_schedule_list($order_column);
		// "<pre>";print_r(count($fetch_data));die();

		$data = array();

		$i = $_POST['start'];



		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = '<a href="admin/edit_doc_schedule/' . $row->doc_id . '"  type="button" id="" class="btn btn-success btn-xs edit_button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

	 		<a style="margin-top:5px;" href="javascript:void(0);" onclick="dlt_confirm(' . $row->doc_id . ');" type="button" class="btn btn-danger btn-xs delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';

			$sub_array[] = '<span  class="">' . $row->doctor_title . '</span>';

			$sub_array[] = '<span style="color:black" href="javascript:void(0)"  onclick="confirmation(' . $row->saturday_id . ')"    from_to">' . $row->saturday . '</span>';
			$sub_array[] = '<span href="javascript:void(0)"  onclick="confirmation(' . $row->sunday_id . ')"    from_to">' . $row->sunday . '</span>';
			$sub_array[] = '<span href="javascript:void(0)"  onclick="confirmation(' . $row->monday_id . ')"    from_to">' . $row->monday . '</span>';
			$sub_array[] = '<span href="javascript:void(0)"  onclick="confirmation(' . $row->tuesday_id . ')"    from_to">' . $row->tuesday . '</span>';
			$sub_array[] = '<span href="javascript:void(0)"  onclick="confirmation(' . $row->wednesday_id . ')"    from_to">' . $row->wednesday . '</span>';
			$sub_array[] = '<span href="javascript:void(0)"  onclick="confirmation(' . $row->thursday_id . ')"   from_to">' . $row->thursday . '</span>';
			$sub_array[] = '<span href="javascript:void(0)"  onclick="confirmation(' . $row->friday_id . ')"    from_to">' . $row->friday . '</span>';


			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_doc_schedule_list(),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_doc_schedule_list(
				$order_column
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}



	public function add_appointment($value = '')
	{
		$data['active'] = 'add_appointment';
		$data['page_title'] = 'Add Appoinment';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['doc_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['uhid'] = $this->admin_model->select_with_where2('*', 'status=1', 'uhid');

		$data['all_blood_group'] = $this->admin_model->select_with_where2('*', 'status=1', 'blood_group');

		$this->load->view('appointment/add_appointment', $data);
	}

	public function get_uhid_info()
	{

		$val = explode('#', $_POST['uhid']);
		$data = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $val[1] . '"', 'uhid');

		echo json_encode($data);
	}

	public function get_uhid_info_by_id()
	{

		$val = $_POST['uhid'];
		$data = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $val . '"', 'uhid');

		echo json_encode($data);
	}

	public function get_uhid_info_all()
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1', 'uhid');

		echo json_encode($data);
	}


	public function get_available_schedule($value = '')
	{
		$data['schedule_info'] = $this->admin_model->select_with_where2('*, DATE_FORMAT(start_time, "%H:%i") as start_time, DATE_FORMAT(end_time, "%H:%i") as end_time', 'doc_id="' . $_POST['doc_id'] . '" AND schedule_day="' . $_POST['day'] . '" and schedule_status=1', 'doctor_schedule');



		if ($data['schedule_info'] != null) {
			$data['appointment_info'] = $this->admin_model->select_join_where('*,DATE_FORMAT(d.start_time, "%H:%i") as start_time, DATE_FORMAT(d.end_time, "%H:%i") as end_time', 'doc_appointment d', 'doctor_schedule ds', 'd.schedule_id=ds.id', 'd.doc_id="' . $_POST['doc_id'] . '" AND date(appointment_date)="' . $_POST['event_date1'] . '" AND appointment_status=1');

			// "<pre>";print_r($data['appointment_info']);die();

			if ($data['appointment_info'] == null) {
				$data['serial'] = 1;
			} else {
				$data['serial'] = $data['appointment_info'][count($data['appointment_info']) - 1]['serial_no'] + 1;
			}
		}


		echo json_encode($data);
	}


	public function add_appointment_post($value = '')
	{

		$val = $_POST['uhid'];
		$value = explode('#', $val);


		if ($val == "" || $this->admin_model->check_row('*', 'uhid="' . $value[1] . '"', 'local_patient_info') == false) {

			$Day = $this->input->post('Day');
			$Month = $this->input->post('Month');
			$Year = $this->input->post('Year');

			if (($Day != 0) and ($Month != 0) and ($Year != 0)) {
				$age = $Day . " D " . $Month . " M " . $Year . " Y";
			} elseif (($Day == 0) and ($Month != 0) and ($Year != 0)) {
				$age = $Year . " Y " . $Month . " M";
			} elseif (($Day != 0) and ($Month == 0) and ($Year != 0)) {
				$age = $Day . " D " . $Year . " Y";
			} elseif (($Day != 0) and ($Month != 0) and ($Year == 0)) {
				$age = $Day . " D " . $Month . " M";
			} elseif (($Day == 0) and ($Month == 0) and ($Year != 0)) {
				$age = $Year . " Y";
			} elseif (($Day == 0) and ($Month != 0) and ($Year == 0)) {
				$age = $Month . " M";
			} elseif (($Day != 0) and ($Month == 0) and ($Year == 0)) {
				$age = $Day . " D";
			} else {
				// $age="0 D 0 M 0 Y";
				$age = "";
			}


			$fileName = "default.png";

			$data = array(
				'patient_name' => $this->input->post('patient_name'),
				'mobile_no' => $this->input->post('mobile_no'),
				'address' => $this->input->post('patient_address'),
				'gender' => $this->input->post('gender'),
				'patient_type' => $this->input->post('patient_type'),
				'uhid' => $this->input->post('uhid'),
				'blood_group' => $this->input->post('blood_group'),
				'age' => $age,
				'patient_image' => $fileName,
				'created_at' => date('Y-m-d')
			);

			$id = $this->admin_model->insert_ret('local_patient_info', $data);


			if ($this->input->post('image') != "") {
				$img = $_POST['image'];
				$folderPath = "uploads/appointment_patient_img/";

				$image_parts = explode(";base64,", $img);
				$image_type_aux = explode("image/", $image_parts[0]);
				$image_type = $image_type_aux[1];

				$image_base64 = base64_decode($image_parts[1]);
				$fileName = uniqid() . '.png';

				$file = $folderPath . $fileName;
				file_put_contents($file, $image_base64);

				$data_logo['patient_image'] = $fileName;

				$this->admin_model->update_function('id', $id, 'local_patient_info', $data_logo);
			} else if ($_FILES['file']['name'] != "") {
				$name_generator = $this->name_generator($_FILES['file']['name'], $id);
				$i_ext = explode('.', $_FILES['file']['name']);
				$target_path = $name_generator . '.' . end($i_ext);;
				$size = getimagesize($_FILES['file']['tmp_name']);

				if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/appointment_patient_img/' . $target_path)) {
					$fileName = $target_path;
				}

				$data_logo['patient_image'] = $fileName;

				$this->admin_model->update_function('id', $id, 'local_patient_info', $data_logo);
			}
		} else {

			$p_info = $this->admin_model->select_with_where2('*', 'status=1 and uhid="' . $value[1] . '"', 'local_patient_info');

			$id = $p_info[0]['id'];

			$Day = $this->input->post('Day');
			$Month = $this->input->post('Month');
			$Year = $this->input->post('Year');

			if (($Day != 0) and ($Month != 0) and ($Year != 0)) {
				$age = $Day . " D " . $Month . " M " . $Year . " Y";
			} elseif (($Day == 0) and ($Month != 0) and ($Year != 0)) {
				$age = $Year . " Y " . $Month . " M";
			} elseif (($Day != 0) and ($Month == 0) and ($Year != 0)) {
				$age = $Day . " D " . $Year . " Y";
			} elseif (($Day != 0) and ($Month != 0) and ($Year == 0)) {
				$age = $Day . " D " . $Month . " M";
			} elseif (($Day == 0) and ($Month == 0) and ($Year != 0)) {
				$age = $Year . " Y";
			} elseif (($Day == 0) and ($Month != 0) and ($Year == 0)) {
				$age = $Month . " M";
			} elseif (($Day != 0) and ($Month == 0) and ($Year == 0)) {
				$age = $Day . " D";
			} else {
				// $age="0 D 0 M 0 Y";
				$age = "";
			}


			$fileName = "default.png";

			$data = array(
				'patient_name' => $this->input->post('patient_name'),
				'mobile_no' => $this->input->post('mobile_no'),
				'address' => $this->input->post('patient_address'),
				'gender' => $this->input->post('gender'),
				'patient_type' => $this->input->post('patient_type'),
				'uhid' => $this->input->post('uhid'),
				'blood_group' => $this->input->post('blood_group'),
				'age' => $age,
				'patient_image' => $fileName,
				'created_at' => date('Y-m-d')
			);

			$this->admin_model->update_function2('id="' . $id . '"', 'local_patient_info', $data);


			if ($this->input->post('image') != "") {
				$img = $_POST['image'];
				$folderPath = "uploads/appointment_patient_img/";

				$image_parts = explode(";base64,", $img);
				$image_type_aux = explode("image/", $image_parts[0]);
				$image_type = $image_type_aux[1];

				$image_base64 = base64_decode($image_parts[1]);
				$fileName = uniqid() . '.png';

				$file = $folderPath . $fileName;
				file_put_contents($file, $image_base64);

				$data_logo['patient_image'] = $fileName;

				$this->admin_model->update_function('id', $id, 'local_patient_info', $data_logo);
			} else if ($_FILES['file']['name'] != "") {
				$name_generator = $this->name_generator($_FILES['file']['name'], $id);
				$i_ext = explode('.', $_FILES['file']['name']);
				$target_path = $name_generator . '.' . end($i_ext);;
				$size = getimagesize($_FILES['file']['tmp_name']);

				if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/appointment_patient_img/' . $target_path)) {
					$fileName = $target_path;
				}

				$data_logo['patient_image'] = $fileName;

				$this->admin_model->update_function('id', $id, 'local_patient_info', $data_logo);
			}
		}

		$time_info = explode('-', $this->input->post('save_time'));


		$doc_name = explode('#', $this->input->post('doc_name'));
		$ref_doc_name = explode('#', $this->input->post('ref_doc_name'));

		$val = array(
			'appointed_p_id' => $id,
			'uhid' => $this->input->post('uhid'),
			'doc_id' => $doc_name[0],
			'doc_name' => $doc_name[1],
			'doc_designation' => $doc_name[2],
			'ref_doc_id' => $ref_doc_name[0],
			'ref_doc_name' => $ref_doc_name[1],
			'ref_doc_designation' => $ref_doc_name[2],
			'schedule_id' => $this->input->post('schedule_id'),
			'start_time' => $time_info[0],
			'end_time' => $time_info[1],
			'appointment_date' => $this->input->post('event_date1'),
			'appointment_time' => $this->input->post('app_save_time'),
			'serial_no' => $this->input->post('serial_no'),
			'ref_doc_id' => $this->input->post('ref_doc_name'),
			'operator_name' => $this->session->userdata['logged_in']['username'],
			'operator_id' => $this->session->userdata['logged_in']['id'],
			'created_at' => date('Y-m-d H:i:s')
		);

		$appointment_id = $this->admin_model->insert_ret('doc_appointment', $val);

		$appointment_gen_id['appointment_gen_id'] = sprintf("%'.06d", ($appointment_id));

		$this->admin_model->update_function('id', $appointment_id, 'doc_appointment', $appointment_gen_id);


		// insert into appointment_payment table
		$data1 = array(
			'appointment_id' => $appointment_id,
			'total_amount' => $this->input->post('total_amount'),
			'discount' => $this->input->post('discount'),
			'net_amount' => $this->input->post('net_amount'),
			'total_paid' => $this->input->post('total_paid'),
			'due' => $this->input->post('due'),
			'created_at' => date('Y-m-d')
		);

		$appointment_payment_id = $this->admin_model->insert_ret('appointment_payment', $data1);

		$doc_info = $this->admin_model->select_with_where2('*', 'doctor_id="' . $val['doc_id'] . '"', 'doctor');

		// "<pre>";print_r($doc_info);die();

		$contact = "88" . $data['mobile_no'];
		$sms = "Dear Mr. " . $data['patient_name'] . ", You have an appoinment With " . $doc_info[0]['doctor_title'] . " at " . date_format(date_create($val['appointment_date']), "D, d M Y") . " from " . date("g:i a", strtotime($val['start_time'])) . "-" . date("g:i a", strtotime($val['end_time'])) . "and Your serial no is " . $val['serial_no'] . " !";

		$send = $this->sendsms_library->send_single_sms('Chatkhil', $contact, $sms);

		redirect("admin/appointment_list");
	}


	public function appointment_list($uhid = '')
	{
		$data['active'] = 'appointment_list';
		$data['page_title'] = 'Appoinment List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$doc_id = $this->session->userdata['logged_in']['doc_id'];

		if ($uhid != "") {
			$data['appointment_info'] = $this->admin_model->select_join_four_table2_sum_group_by('*,a.id as id,a.created_at,date(appointment_date) as appointment_date,TIME_FORMAT(a.start_time,"%h:%i %p") as start_time,TIME_FORMAT(a.end_time,"%h:%i %p") as end_time', 'doctor_schedule ds', 'doc_appointment a', 'local_patient_info l', 'appointment_payment ap', 'ds.id=a.schedule_id', 'a.appointed_p_id=l.id', 'ap.appointment_id=a.id', 'appointment_status=1 and l.uhid="' . $uhid . '"', 'total_amount', 'discount', 'total_paid', 'net_amount', 'a.id');
		} else {
			$data['appointment_info'] = $this->admin_model->select_join_four_table2_sum_group_by('*,a.id as id,a.created_at,date(appointment_date) as appointment_date,TIME_FORMAT(a.start_time,"%h:%i %p") as start_time,TIME_FORMAT(a.end_time,"%h:%i %p") as end_time', 'doctor_schedule ds', 'doc_appointment a', 'local_patient_info l', 'appointment_payment ap', 'ds.id=a.schedule_id', 'a.appointed_p_id=l.id', 'ap.appointment_id=a.id', 'appointment_status=1 and date(a.created_at)="' . date('Y-m-d') . '"', 'total_amount', 'discount', 'total_paid', 'net_amount', 'a.id');
		}



		$data['doc_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		if ($doc_id != 0) {
			$data['appointment_info'] = $this->admin_model->select_join_four_table2_sum_group_by('*,a.id as id,a.created_at,date(appointment_date) as appointment_date,TIME_FORMAT(a.start_time,"%h:%i %p") as start_time,TIME_FORMAT(a.end_time,"%h:%i %p") as end_time', 'doctor_schedule ds', 'doc_appointment a', 'local_patient_info l', 'appointment_payment ap', 'ds.id=a.schedule_id', 'a.appointed_p_id=l.id', 'ap.appointment_id=a.id', 'a.doc_id="' . $doc_id . '" and appointment_status=1 and date(a.created_at)="' . date('Y-m-d') . '"', 'total_amount', 'discount', 'total_paid', 'net_amount', 'a.id');

			$data['doc_info'] = $this->admin_model->select_with_where2('*', 'status=1 and doctor_id="' . $doc_id . '"', 'doctor');
		}

		// "<pre>";print_r($data['appointment_info']);die();

		$this->load->view('appointment/appointment_list', $data);
	}


	public function appointment_list_datewise_report()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$doc_id = $this->input->post('doc_name');

		redirect('admin/appointment_list_datewise_report_next/' . $start_date . '/' . $end_date . '/' . $doc_id);


		// $data['comission_list']=$this->admin_model->select_three_join('doc_commission.id,patient_info_id,patient_name,age,gender,mobile_no,opd_patient_test_order_info.patient_id,doc_commission.patient_id,total_commission,doc_commission.paid_amount,doc_commission.status,doc_commission.paid_amount,doc_commission.doc_name','opd_patient_info','opd_patient_test_order_info','opd_patient_info.id=opd_patient_test_order_info.patient_id','doc_commission','doc_commission.patient_id=opd_patient_info.id');

		// redirect('admin/opd_doc_com_pview',$data);

	}

	public function appointment_list_datewise_report_next($start_date, $end_date, $doc_id)
	{

		$data['active'] = '';
		$data['page_title'] = 'Doc Commission Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		if ($doc_id == 0) {

			$data['appointment_info'] = $this->admin_model->select_join_four_table2_sum_group_by('*,a.id as id,a.created_at,date(appointment_date) as appointment_date,TIME_FORMAT(a.start_time,"%h:%i %p") as start_time,TIME_FORMAT(a.end_time,"%h:%i %p") as end_time', 'doctor_schedule ds', 'doc_appointment a', 'local_patient_info l', 'appointment_payment ap', 'ds.id=a.schedule_id', 'a.appointed_p_id=l.id', 'ap.appointment_id=a.id', 'appointment_status=1 and DATE(a.created_at) between "' . $start_date . '" and "' . $end_date . '"', 'total_amount', 'discount', 'total_paid', 'net_amount', 'a.id');

			$data['doc_id'] = "All";

			$data['doc_info'] = $this->admin_model->select_join_where_group_by('*', 'doc_appointment a', 'doctor d', 'd.doctor_id=a.doc_id', 'd.status=1 and a.appointment_status=1 and date(a.created_at) between "' . $start_date . '" AND "' . $end_date . '"', 'd.doctor_id');


			// "<pre>";print_r($data['comission_summary']);die();

		} else {
			$data['appointment_info'] = $this->admin_model->select_join_four_table2_sum_group_by('*,a.id as id,a.created_at,date(appointment_date) as appointment_date,TIME_FORMAT(a.start_time,"%h:%i %p") as start_time,TIME_FORMAT(a.end_time,"%h:%i %p") as end_time', 'doctor_schedule ds', 'doc_appointment a', 'local_patient_info l', 'appointment_payment ap', 'ds.id=a.schedule_id', 'a.appointed_p_id=l.id', 'ap.appointment_id=a.id', 'appointment_status=1 and DATE(a.created_at) between "' . $start_date . '" and "' . $end_date . '" and a.doc_id="' . $doc_id . '"', 'total_amount', 'discount', 'total_paid', 'net_amount', 'a.id');


			$data['doc_id'] = "";

			$data['doc_info'] = $this->admin_model->select_with_where2('*', 'doctor_id="' . $doc_id . '"', 'doctor');
		}



		$data['from_date'] = $start_date;
		$data['end_date'] = $end_date;


		$this->load->view('appointment/appointment_list_datewise_report', $data);
	}





	public function appointment_pay_details($appointment_id = '')
	{
		$data['active'] = 'appointment_payment';
		$data['page_title'] = 'Appoinment Payment';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['appointment_info'] = $this->admin_model->select_join_four_table2_sum_group_by('*,a.id as id,a.created_at,date(appointment_date) as appointment_date,TIME_FORMAT(a.start_time,"%h:%i %p") as start_time,TIME_FORMAT(a.end_time,"%h:%i %p") as end_time', 'doctor_schedule ds', 'doc_appointment a', 'local_patient_info l', 'appointment_payment ap', 'ds.id=a.schedule_id', 'a.appointed_p_id=l.id', 'ap.appointment_id=a.id', 'appointment_status=1 and a.id="' . $appointment_id . '"', 'total_amount', 'discount', 'total_paid', 'net_amount', 'a.id');

		$this->load->view('appointment/appointment_pay_details', $data);
	}

	public function pay_appointment_fee($appointment_id = '')
	{
		$val['total_paid'] = $this->input->post('update_payment');
		$val['appointment_id'] = $appointment_id;
		$this->admin_model->insert_ret('appointment_payment', $val);

		redirect('admin/appointment_list', 'refresh');
	}

	public function appointment_receipt($appointment_id = '')
	{
		$data['appointment_info'] = $this->admin_model->select_join_five_table2_sum_group_by('*,a.id as id,a.created_at,date(appointment_date) as appointment_date,TIME_FORMAT(a.start_time,"%h:%i %p") as start_time,TIME_FORMAT(a.end_time,"%h:%i %p") as end_time', 'doctor_schedule ds', 'doc_appointment a', 'local_patient_info l', 'appointment_payment ap', 'doctor d', 'ds.id=a.schedule_id', 'a.appointed_p_id=l.id', 'ap.appointment_id=a.id', 'd.doctor_id=a.doc_id', 'appointment_status=1 and a.id="' . $appointment_id . '"', 'total_amount', 'discount', 'total_paid', 'net_amount', 'a.id');



		$data['room_info'] = $this->admin_model->select_join_three_table2_left('*', 'room r', 'cabin_class c', 'cabin_sub_class cs', 'r.cabin_class_id=c.id', 'r.cabin_sub_class_id=cs.id', 'r.id= "' . $data['appointment_info'][0]['room_id'] . '"');

		// echo "<pre>";print_r($data['room_info']);die();

		$data["day_info"] = $this->admin_model->select_with_where2('*', 'id="' . $data['appointment_info'][0]['schedule_id'] . '"', 'doctor_schedule');

		$data["uhid_info"] = $this->admin_model->select_with_where2('*', 'id="' . $data['appointment_info'][0]['uhid'] . '"', 'uhid');

		$this->load->view('appointment/appointment_receipt', $data);
	}



	public function appointment_prescription($appointment_id = '')
	{
		$data['appointment_info'] = $this->admin_model->select_six_join_where_left('*,da.id,a.id as pr_id,a.description', 'doc_appointment da', 'appointment_prescription_details a', 'local_patient_info l', 'product pd', 'doctor d', 'product_category pc', 'generic_info g', 'da.id=a.appointment_id', 'l.id=da.appointed_p_id', 'pd.id=a.medicine_id', 'd.doctor_id=da.doc_id', 'pc.id=pd.p_cat_id', 'pd.p_generic_id=g.id', 'l.status=1 and da.appointment_status=1 and da.id="' . $appointment_id . '"');

		if ($data['appointment_info'] != "") {

			$data["blood_group_info"] = $this->admin_model->select_with_where2('*', 'id="' . $data['appointment_info'][0]['blood_group'] . '"', 'blood_group');
		}

		$this->load->view('appointment/appointment_prescription', $data);
	}



	// public function appointment_list_dt($value='')
	// {
	// 	$select_column=array('*,a.id as id,a.created_at,date(appointment_date) as appointment_date,TIME_FORMAT(a.start_time,"%h:%i %p") as start_time,TIME_FORMAT(a.end_time,"%h:%i %p") as end_time');
	// 	$order_column=array('a.id','patient_name','doctor_title','mobile_no',null,null);

	// 	$search_column=array('patient_name','doctor_title','mobile_no','schedule_day','appointment_date','a.start_time','a.end_time');

	// 	$fetch_data = $this->admin_model->make_datatables_four_table_join('doctor_schedule ds','schedule_status=1 AND appointment_status=1 and date(a.created_at)="'.date('Y-m-d').'"',$select_column,$order_column,$search_column,'doc_appointment a','ds.id=a.schedule_id','local_patient_info l','a.appointed_p_id=l.id','doctor d','a.doc_id=d.doctor_id','a.id');  
	// 	$data = array();  

	// 	$i=$_POST['start'];




	// // "<pre>";print_r($this->admin_model->get_all_data_four_table_join('doctor_schedule ds','schedule_status=1 AND appointment_status=1',$select_column,'doc_appointment a','ds.id=a.schedule_id','local_patient_info l','a.appointed_p_id=l.id','doctor d','a.doc_id=d.doctor_id'));die();

	// 	foreach($fetch_data as $key => $row)  
	// 	{  
	// 		$sub_array = array();  
	// 		$sub_array[] = $i+1;  
	// 		$sub_array[] = $row->patient_name;  
	// 		$sub_array[] = $row->doctor_title;  
	// 		$sub_array[] = $row->mobile_no;  
	// 		$sub_array[] = $row->schedule_day.', '.date('d-m-Y', strtotime($row->appointment_date)).' '.$row->start_time.'-'.$row->end_time;  
	// 		$sub_array[] = date('d-m-Y', strtotime($row->created_at));  

	// 		$sub_array[] = '<button type="button" data-id="'.$row->id.'" class="btn btn-danger btn-xs delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';  
	// 		$data[] = $sub_array;

	// 		$i++;

	// 	}  

	// 	$output = array(  
	// 		"draw"                   =>      intval($_POST["draw"]),  
	// 		"recordsTotal"          =>      $this->admin_model->get_all_data_four_table_join('doctor_schedule ds','schedule_status=1 AND appointment_status=1 and date(a.created_at)="'.date('Y-m-d').'"',$select_column,'doc_appointment a','ds.id=a.schedule_id','local_patient_info l','a.appointed_p_id=l.id','doctor d','a.doc_id=d.doctor_id'),  
	// 		"recordsFiltered"     =>     $this->admin_model->get_filtered_data_four_table_join('doctor_schedule ds','schedule_status=1 AND appointment_status=1 and date(a.created_at)="'.date('Y-m-d').'"',$select_column,$order_column,$search_column,'doc_appointment a','ds.id=a.schedule_id','local_patient_info l','a.appointed_p_id=l.id','doctor d','a.doc_id=d.doctor_id','a.id'
	// 	),  
	// 		"data"                    =>     $data  
	// 	);  
	// 	echo json_encode($output);
	// }


	public function delete_appointment($value = '')
	{
		$val['appointment_status'] = 2;

		$this->load->admin_model->update_function2('id="' . $_POST['appointment_id'] . '"', 'doc_appointment', $val);

		redirect('admin/appointment_list', 'refresh');
	}


	public function edit_doc_schedule($doc_id = '')
	{
		$data['active'] = 'edit_doc_schedule';
		$data['page_title'] = 'Edit Doctor Schedule';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['doc_info'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');

		$data['all_schedule_info'] = $this->admin_model->select_with_where2('*', 'doc_id="' . $doc_id . '" AND schedule_status=1', 'doctor_schedule');

		$data['room'] = $this->admin_model->select_with_where2('*', 'status=1', 'room');


		$this->load->view('appointment/edit_doc_schedule', $data);
	}


	// public function edit_doc_schedule_post($value='')
	// {

	// 	$day=$this->input->post('day');
	// 	$start=$this->input->post('from_time');
	// 	$end=$this->input->post('to_time');

	// 	$username=$this->session->userdata['logged_in']['username'];

	// 	for ($i=0; $i < count($day); $i++) 
	// 	{ 
	// 		$data['doc_id']=$this->input->post('doc_id');
	// 		$data['schedule_day']=$day[$i];
	// 		$data['start_time']=date("H:i", strtotime($start[$i]));
	// 		$data['end_time']=date("H:i", strtotime($end[$i]));
	// 		$data['schedule_status']=1;
	// 		$data['time_per_patient']=$this->input->post('time_per_patient');
	// 		$data['operated_by']=$username;
	// 		$data['created_at']=date('Y-m-d H:i:s');

	// 		$this->admin_model->insert_ret('doctor_schedule',$data);

	// 	}

	// 	redirect('admin/add_doc_schedule');
	// }

	public function delete_doc_schedule($id)
	{
		$val['schedule_status'] = 2;

		$this->load->admin_model->update_function2('doc_id="' . $id . '"', 'doctor_schedule', $val);

		redirect('admin/doc_schedule_list');
	}

	public function delete_individual_doc_schedule($id)
	{
		$val['schedule_status'] = 2;

		$this->load->admin_model->update_function2('id="' . $id . '"', 'doctor_schedule', $val);

		redirect('admin/doc_schedule_list');
	}



	public function get_all_schedule_by_doc_id($value = '')
	{


		$data['all_schedule_info'] = $this->admin_model->select_with_where2('*', 'doc_id="' . $_POST['doc_id'] . '" AND schedule_status=1', 'doctor_schedule');

		$data['options'] = '<option value="day_1">Saturday</option>
	 	<option value="day_2">Sunday</option>
	 	<option value="day_3">Monday</option>
	 	<option value="day_4">Tuesday</option>
	 	<option value="day_5">Wednesday</option>
	 	<option value="day_6">Thursday</option>
	 	<option value="day_7">Friday</option>';



		echo json_encode($data);
	}

	// Manage Appoinment Module Ends


	// Shahed Code Starts


	// Manage HR Module Starts

	//Manage Staff Designation Start

	public function add_staff_groups()
	{

		$data['active'] = 'add_staff_groups';
		$data['page_title'] = 'Add Staff Groups';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$this->load->view('hr_management/add_staff_groups', $data);
	}

	public function staff_groups_add_post()
	{

		$data['group_name'] = $this->input->post('group_name');
		$data['created_at'] = date('Y-m-d H:i:s');

		$id = $this->admin_model->insert_ret('sh_tbl_groups', $data);
		$this->session->set_flashdata('Successfully', 'Staff Designation Inserted Successfully Done');

		redirect("admin/staff_group_list", "refresh");
	}

	public function staff_group_list()
	{

		$data['active'] = 'all_staff_group_list';
		$data['page_title'] = 'Staff Group List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['staff_group_list'] = $this->admin_model->select_with_where2('*', 'status="1"', 'sh_tbl_groups');
		$this->load->view('hr_management/staff_group_list', $data);
	}

	public function staff_groups_edit($staff_gr_id)
	{

		$data['active'] = 'staff_groups_edit';
		$data['page_title'] = 'Staff Groups Edit';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['staff_group_details'] = $this->admin_model->select_with_where2('*', 'id="' . $staff_gr_id . '"', 'sh_tbl_groups');

		$data['group_name'] = $data['staff_group_details'][0]['group_name'];

		$this->load->view('hr_management/staff_groups_edit', $data);
	}

	public function staff_groups_edit_post()
	{

		$data['group_name'] = $this->input->post('group_name');

		$this->admin_model->update_function('id', $_POST['staff_gr_id'], 'sh_tbl_groups', $data);
		$this->session->set_flashdata('Successfully', 'Staff Designation Update Successfully Done');
		redirect("admin/staff_group_list", "refresh");
	}

	public function staff_group_dlt($staff_gr_id)
	{

		$data['status'] = 2;
		$this->admin_model->update_function2('id="' . $staff_gr_id . '"', 'sh_tbl_groups', $data);
		$this->session->set_flashdata('Successfully', 'Staff Designation Delete Successfully Done');
		redirect("admin/staff_group_list", "refresh");
	}




	public function add_staff_designation()
	{

		$data['active'] = 'Hr_staff_designation';
		$data['page_title'] = 'Add Designation';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$this->load->view('hr_management/designation/add_designation', $data);
	}

	public function staff_designation_add_post()
	{

		$data['name'] = $this->input->post('designation');
		$data['details'] = $this->input->post('details');
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$data['operator_id'] = $this->session->userdata['logged_in']['id'];


		$id = $this->admin_model->insert_ret('sh_tbl_designation', $data);
		$this->session->set_flashdata('Successfully', 'Staff Designation Inserted Successfully Done');

		redirect("admin/all_staff_designation_list", "refresh");
	}

	public function all_staff_designation_list()
	{

		$data['active'] = 'staff_designation_list';
		$data['page_title'] = 'Staff Designation List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['staff_designation_list'] = $this->admin_model->select_with_where2('*', 'status="1"', 'sh_tbl_designation');
		$this->load->view('hr_management/designation/staff_designation_list', $data);
	}

	public function staff_designation_edit($staff_des_id)
	{
		$staff_des_id = $staff_des_id;
		$data['active'] = 'staff_designation_list';
		$data['page_title'] = 'Staff Designation Edit';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['staff_designation_details'] = $this->admin_model->select_with_where2('*', 'id="' . $staff_des_id . '"', 'sh_tbl_designation');

		$data['staff_des_id'] = $data['staff_designation_details'][0]['id'];
		$data['name'] = $data['staff_designation_details'][0]['name'];
		$data['details'] = $data['staff_designation_details'][0]['details'];

		$this->load->view('hr_management/designation/staff_registation_edit', $data);
	}


	public function staff_designation_edit_post()
	{

		$staff_des_id = $this->input->post('staff_des_id');
		$data['name'] = $this->input->post('designation');
		$data['details'] = $this->input->post('details');
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$data['operator_id'] = $this->session->userdata['logged_in']['id'];


		$this->admin_model->update_function('id', $staff_des_id, 'sh_tbl_designation', $data);
		$this->session->set_flashdata('Successfully', 'Staff Designation Update Successfully Done');
		redirect("admin/all_staff_designation_list", "refresh");
	}


	public function staff_designation_dlt($staff_des_id)
	{

		$data['status'] = 2;
		$this->admin_model->update_function2('id="' . $staff_des_id . '"', 'sh_tbl_designation', $data);
		$this->session->set_flashdata('Successfully', 'Staff Designation Delete Successfully Done');
		redirect("admin/all_staff_designation_list", "refresh");
	}
	//Manage Staff Designation End


	public function staff_registation()
	{

		$data['active'] = 'Hr_head';
		$data['page_title'] = 'Staff Registration';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['designation_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'sh_tbl_designation');

		$data['group_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'sh_tbl_groups');


		$this->load->view('hr_management/staff/staff_registation', $data);
	}
	public function staff_add_post()
	{
		//$data['hospital_id']=$this->input->post('hospital_id'); 
		$data['first_name'] = $this->input->post('first_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['father_name'] = $this->input->post('father_name');
		$data['mother_name'] = $this->input->post('mother_name');
		$data['designation_id'] = $this->input->post('designation_id');
		$data['email'] = $this->input->post('email');
		$data['mobile'] = $this->input->post('mobile_no');
		$data['rate_type'] = $this->input->post('rate_type');
		$data['permanent'] = $this->input->post('permanent');
		$data['present'] = $this->input->post('present');
		$data['blood_group'] = $this->input->post('blood_group');
		$data['nid_no'] = $this->input->post('nid_no');
		$data['total_salary'] = $this->input->post('total_salary');
		$data['joining_date'] = $this->input->post('joining_date');
		$data['group_id'] = $this->input->post('group_id');

		$data['from_duty_time'] = date("H:i", strtotime($this->input->post('from_duty_time')));
		$data['to_duty_time'] = date("H:i", strtotime($this->input->post('to_duty_time')));


		$data['created_at'] = date('Y-m-d H:i:s');
		$data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$data['operator_id'] = $this->session->userdata['logged_in']['id'];


		$id = $this->admin_model->insert_ret('sh_tbl_staff', $data);
		$this->session->set_flashdata('Successfully', 'Staff Inserted Successfully Done');

		if ($_FILES['staff_img']['name']) {
			$name_generator = $this->name_generator($_FILES['staff_img']['name'], $id);
			$i_ext = explode('.', $_FILES['staff_img']['name']);
			$target_path = $name_generator . '.' . end($i_ext);;
			$size = getimagesize($_FILES['staff_img']['tmp_name']);

			if (move_uploaded_file($_FILES['staff_img']['tmp_name'], 'uploads/staff_images/' . $target_path)) {
				$staff_img = $target_path;
			}

			$data_logo['profile_image'] = $staff_img;
			$this->admin_model->update_function('staff_id', $id, 'sh_tbl_staff', $data_logo);
		}
		redirect("admin/all_staff_list", "refresh");
	}

	//all staff list
	public function all_staff_list($type = "")
	{
		$data['active'] = 'staff_list';
		$data['page_title'] = 'Staff List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['staff_list'] = $this->admin_model->select_where_left_join('*', 'sh_tbl_staff stf', 'marketing_officer m', 'stf.designation_id=m.id', 'stf.status=1');

		$this->load->view('hr_management/staff/staff_list', $data);
	}

	public function staff_edit($staff_id)
	{
		$staff_id = $staff_id;
		$data['active'] = 'staff_list';
		$data['page_title'] = 'Staff Edit';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['staff_details'] = $this->admin_model->select_with_where2('*', 'staff_id="' . $staff_id . '"', 'sh_tbl_staff');

		$data['group_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'sh_tbl_groups');

		$data['staff_id'] = $data['staff_details'][0]['staff_id'];
		$data['first_name'] = $data['staff_details'][0]['first_name'];
		$data['last_name'] = $data['staff_details'][0]['last_name'];
		$data['father_name'] = $data['staff_details'][0]['father_name'];
		$data['mother_name'] = $data['staff_details'][0]['mother_name'];
		$data['staff_mobile_no'] = $data['staff_details'][0]['mobile'];
		$data['email'] = $data['staff_details'][0]['email'];
		$data['rate_type'] = $data['staff_details'][0]['rate_type'];
		$data['permanent'] = $data['staff_details'][0]['permanent'];
		$data['present'] = $data['staff_details'][0]['present'];
		$data['staff_img'] = $data['staff_details'][0]['profile_image'];
		$data['designation_id'] = $data['staff_details'][0]['designation_id'];
		$data['blood_group'] = $data['staff_details'][0]['blood_group'];
		$data['nid_no'] = $data['staff_details'][0]['nid_no'];
		$data['total_salary'] = $data['staff_details'][0]['total_salary'];

		$data['from_duty_time'] = date("g:i a", strtotime($data['staff_details'][0]['from_duty_time']));
		$data['to_duty_time'] = date("g:i a", strtotime($data['staff_details'][0]['to_duty_time']));
		$data['joining_date'] = date("Y-m-d", strtotime($data['staff_details'][0]['joining_date']));


		$data['group_id'] = $data['staff_details'][0]['group_id'];


		$data['designation_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'sh_tbl_designation');

		$this->load->view('hr_management/staff/staff_registation_edit', $data);
	}

	public function staff_edit_post()
	{

		$data['staff_id'] = $this->input->post('staff_id');
		$data['first_name'] = $this->input->post('first_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['father_name'] = $this->input->post('father_name');
		$data['mother_name'] = $this->input->post('mother_name');
		$data['designation_id'] = $this->input->post('designation_id');
		$data['email'] = $this->input->post('email');
		$data['mobile'] = $this->input->post('mobile_no');
		$data['rate_type'] = $this->input->post('rate_type');
		$data['permanent'] = $this->input->post('permanent');
		$data['present'] = $this->input->post('present');
		$data['blood_group'] = $this->input->post('blood_group');
		$data['nid_no'] = $this->input->post('nid_no');
		$data['total_salary'] = $this->input->post('total_salary');
		$data['group_id'] = $this->input->post('group_id');
		$data['joining_date'] = $this->input->post('joining_date') == "" ? $this->input->post('joining_date_2') : $this->input->post('joining_date');

		$data['from_duty_time'] = $this->input->post('from_duty_time') == "" ? date("H:i", strtotime($this->input->post('from_duty_time_2'))) : date("H:i", strtotime($this->input->post('from_duty_time')));

		$data['to_duty_time'] = $this->input->post('to_duty_time') == "" ? date("H:i", strtotime($this->input->post('to_duty_time_2'))) : date("H:i", strtotime($this->input->post('to_duty_time')));

		if ($_FILES['staff_img']['name']) {
			$name_generator = $this->name_generator($_FILES['staff_img']['name'], $data['staff_id']);
			$i_ext = explode('.', $_FILES['staff_img']['name']);
			$target_path = $name_generator . '.' . end($i_ext);;
			$size = getimagesize($_FILES['staff_img']['tmp_name']);

			if (move_uploaded_file($_FILES['staff_img']['tmp_name'], 'uploads/staff_images/' . $target_path)) {
				$staff_img = $target_path;
			}

			$data_logo['profile_image'] = $staff_img;
			$this->admin_model->update_function('staff_id', $data['staff_id'], 'sh_tbl_staff', $data_logo);
		}
		$this->admin_model->update_function('staff_id', $data['staff_id'], 'sh_tbl_staff', $data);
		$this->session->set_flashdata('Successfully', 'Staff Update Successfully Done');
		redirect("admin/all_staff_list", "refresh");
	}

	public function staff_dlt($staff_id)
	{
		$data['status'] = 2;
		$this->admin_model->update_function2('staff_id="' . $staff_id . '"', 'sh_tbl_staff', $data);
		$this->session->set_flashdata('Successfully', 'Staff Delete Successfully Done');
		redirect("admin/all_staff_list", "refresh");
	}

	public function staff_view($staff_id)
	{
		$staff_details = $this->admin_model->select_join_where('*', 'sh_tbl_staff s', 'sh_tbl_groups g', 's.group_id=g.id', 'staff_id="' . $staff_id . '"');


		$data['staff_details'] = $staff_details;
		$this->load->view('hr_management/staff/staff_view', $data);
	}
	// Manage HR Module Ends

	//Manage Salary Start

	public function getStaffList()
	{

		$id = trim($_POST['staffID']);

		$this->db->where('staff_id', $id);

		$result = $this->db->get('sh_tbl_staff')->row();
		$ara = array(
			"staff" => $result
		);
		echo json_encode($ara);
	}

	public function staff_salary_generate($type = "")
	{
		$data['active'] = 'staff_list';
		$data['page_title'] = 'Staff Salary Generate List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['staff_list_show'] = $this->admin_model->select_where_left_join('*', 'sh_tbl_staff stf', 'sh_tbl_designation m', 'stf.designation_id=m.id', 'stf.status=1');
		//echo $this->db->last_query();
		$this->load->view('hr_management/salary_generate/staff_salary_generate', $data);
	}

	public function staff_salary_generay_add_post()
	{
		$data['staff_id'] = $this->input->post('staff_id');
		$data['designation_id'] = $this->admin_model->anyName_Staff('staff_id', $data['staff_id'], 'designation_id');
		$generated_date = $this->input->post('generated_date');
		$data['generated_date'] = $generated_date;
		$data['salary_type'] = $this->input->post('salary_type');
		$data['basic_salary'] = $this->input->post('basic_salary');
		$month = $this->input->post('month');
		$year = date('Y', strtotime($generated_date));
		$data['t_working_days'] = $this->input->post('workingdays');
		$data['t_presents'] = $this->input->post('presents');
		$data['t_absent'] = $this->input->post('absent');
		$data['t_late'] = $this->input->post('late');
		$data['t_overtime'] = $this->input->post('over_time');
		$data['t_absent_amount'] = $this->input->post('absent_salary');
		$data['t_late_amount'] = $this->input->post('late_salary');
		$data['t_overtime_amount'] = $this->input->post('over_time_salary');
		$data['perdaysalary'] = $this->input->post('perdaysalary');
		$data['total_payble_salary'] = $this->input->post('t_salary');
		$data['payment_type'] = $this->input->post('salary_pay_method');
		if ($data['payment_type'] == 'due') {
			$data['pay_status'] = '1';
		} else if ($data['payment_type'] == 'bank') {
			$data['pay_status'] = '2';
			$data['bank_name'] = $this->input->post('bank_name');
			$data['cheque_no'] = $this->input->post('cheque_no');
			$data['payment_salary'] = $this->input->post('t_salary');
			$data['payment_date'] = $generated_date;
		} else {
			$data['pay_status'] = '2';
			$data['payment_salary'] = $this->input->post('t_salary');
			$data['payment_date'] = $generated_date;
		}
		$data['month_year'] = $year . '-' . $month;
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$generated_id = $this->admin_model->anyName_Staff_Salary_Generate('staff_id', $data['staff_id'], 'month_year', $data['month_year'], 'salary_gen_id');

		if (empty($generated_id)) {
			$id = $this->admin_model->insert_ret('sh_tbl_staff_salary_genrate', $data);
			$this->session->set_flashdata('Successfully', 'Successfully Inserted');
			redirect("admin/staff_salary_generate", "refresh");
		} else {
			$this->session->set_flashdata('Unsuccessfull', 'Already Generated For this month');
			redirect("admin/staff_salary_generate", "refresh");
		}
	}

	public function all_staff_payment_list($type = "")
	{
		$data['active'] = 'staff_list';
		$data['page_title'] = 'Staff Payment List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['staff_payment_list'] = $this->admin_model->select_where_left_join('*', 'sh_tbl_staff_salary_genrate stfsal', 'sh_tbl_staff stf', 'stfsal.staff_id=stf.staff_id', 'stf.status=1');
		$this->load->view('hr_management/salary_payment/staff_payment_list', $data);
	}

	public function all_staff_payment_list_by_search($type = "")
	{
		$data['active'] = 'staff_list';
		$data['page_title'] = 'Staff Payment List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$generated_date = date('Y-m', strtotime($this->input->post('generated_date')));
		$whrecol = "stfsal.month_year='" . $generated_date . "'";
		$data['staff_payment_list'] = $this->admin_model->select_where_left_join('*', 'sh_tbl_staff_salary_genrate stfsal', 'sh_tbl_staff stf', 'stfsal.staff_id=stf.staff_id', $whrecol);
		//echo $this->db->last_query();
		$this->load->view('hr_management/salary_payment/staff_payment_list', $data);
	}

	public function payment_complete()
	{
		$salary_gen_id = $this->input->post('salary_gen_id');
		$total_payble_salary = $this->input->post('total_payble_salary');
		$pay_status = $this->input->post('pay_status');
		$length = count($salary_gen_id);

		for ($i = 0; $i < $length; $i++) {

			$data = array(
				"payment_date" => date('Y-m-d'),
				"payment_salary" => $total_payble_salary[$i],
				"payment_type" => "cash",
				"pay_status" => "2",
			);
			if ($pay_status[$i] == '1') {
				$this->admin_model->update_function('salary_gen_id', $salary_gen_id[$i], 'sh_tbl_staff_salary_genrate', $data);
			}
		}
		redirect("admin/all_staff_payment_list", "refresh");
	}
	public function staff_salary_generate_pay($salary_gen_id)
	{
		$salary_gen_id = $salary_gen_id;
		$data['active'] = 'staff_salary_gen_list';
		$data['page_title'] = 'Staff Payment';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['staff_salary_gendetails'] = $this->admin_model->select_with_where2('*', 'salary_gen_id="' . $salary_gen_id . '"', 'sh_tbl_staff_salary_genrate');

		$data['salary_gen_id'] = $data['staff_salary_gendetails'][0]['salary_gen_id'];
		$data['staff_id'] = $data['staff_salary_gendetails'][0]['staff_id'];
		$data['designation_id'] = $data['staff_salary_gendetails'][0]['designation_id'];
		$data['generated_date'] = $data['staff_salary_gendetails'][0]['generated_date'];
		$data['payment_date'] = $data['staff_salary_gendetails'][0]['payment_date'];
		$data['month_year'] = $data['staff_salary_gendetails'][0]['month_year'];
		$data['bank_name'] = $data['staff_salary_gendetails'][0]['bank_name'];
		$data['cheque_no'] = $data['staff_salary_gendetails'][0]['cheque_no'];
		$data['basic_salary'] = $data['staff_salary_gendetails'][0]['basic_salary'];
		$data['t_working_days'] = $data['staff_salary_gendetails'][0]['t_working_days'];
		$data['t_presents'] = $data['staff_salary_gendetails'][0]['t_presents'];
		$data['t_absent'] = $data['staff_salary_gendetails'][0]['t_absent'];
		$data['t_late'] = $data['staff_salary_gendetails'][0]['t_late'];
		$data['t_overtime'] = $data['staff_salary_gendetails'][0]['t_overtime'];
		$data['t_absent_amount'] = $data['staff_salary_gendetails'][0]['t_absent_amount'];
		$data['t_late_amount'] = $data['staff_salary_gendetails'][0]['t_late_amount'];
		$data['t_overtime_amount'] = $data['staff_salary_gendetails'][0]['t_overtime_amount'];
		$data['salary_type'] = $data['staff_salary_gendetails'][0]['salary_type'];
		$data['payment_type'] = $data['staff_salary_gendetails'][0]['payment_type'];
		$data['perdaysalary'] = $data['staff_salary_gendetails'][0]['perdaysalary'];
		$data['total_payble_salary'] = $data['staff_salary_gendetails'][0]['total_payble_salary'];
		$data['payment_salary'] = $data['staff_salary_gendetails'][0]['payment_salary'];
		$data['pay_status'] = $data['staff_salary_gendetails'][0]['pay_status'];
		$data['staff_list_show'] = $this->admin_model->select_where_left_join('*', 'sh_tbl_staff stf', 'sh_tbl_designation m', 'stf.designation_id=m.id', 'stf.status=1');

		$this->load->view('hr_management/salary_generate/staff_salary_generate_pay', $data);
	}
	public function staff_salary_generate_payslip($salary_gen_id)
	{
		$salary_gen_id = $salary_gen_id;
		$data['active'] = 'staff_salary_gen_list';
		$data['page_title'] = 'Staff Payment';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['staff_salary_gendetails'] = $this->admin_model->select_with_where2('*', 'salary_gen_id="' . $salary_gen_id . '"', 'sh_tbl_staff_salary_genrate');

		$data['salary_gen_id'] = $data['staff_salary_gendetails'][0]['salary_gen_id'];
		$data['staff_id'] = $data['staff_salary_gendetails'][0]['staff_id'];
		$data['designation_id'] = $data['staff_salary_gendetails'][0]['designation_id'];
		$data['generated_date'] = $data['staff_salary_gendetails'][0]['generated_date'];
		$data['payment_date'] = $data['staff_salary_gendetails'][0]['payment_date'];
		$data['month_year'] = $data['staff_salary_gendetails'][0]['month_year'];
		$data['bank_name'] = $data['staff_salary_gendetails'][0]['bank_name'];
		$data['cheque_no'] = $data['staff_salary_gendetails'][0]['cheque_no'];
		$data['basic_salary'] = $data['staff_salary_gendetails'][0]['basic_salary'];
		$data['t_working_days'] = $data['staff_salary_gendetails'][0]['t_working_days'];
		$data['t_presents'] = $data['staff_salary_gendetails'][0]['t_presents'];
		$data['t_absent'] = $data['staff_salary_gendetails'][0]['t_absent'];
		$data['t_late'] = $data['staff_salary_gendetails'][0]['t_late'];
		$data['t_overtime'] = $data['staff_salary_gendetails'][0]['t_overtime'];
		$data['t_absent_amount'] = $data['staff_salary_gendetails'][0]['t_absent_amount'];
		$data['t_late_amount'] = $data['staff_salary_gendetails'][0]['t_late_amount'];
		$data['t_overtime_amount'] = $data['staff_salary_gendetails'][0]['t_overtime_amount'];
		$data['salary_type'] = $data['staff_salary_gendetails'][0]['salary_type'];
		$data['payment_type'] = $data['staff_salary_gendetails'][0]['payment_type'];
		$data['perdaysalary'] = $data['staff_salary_gendetails'][0]['perdaysalary'];
		$data['total_payble_salary'] = $data['staff_salary_gendetails'][0]['total_payble_salary'];
		$data['payment_salary'] = $data['staff_salary_gendetails'][0]['payment_salary'];
		$data['pay_status'] = $data['staff_salary_gendetails'][0]['pay_status'];
		$data['staff_list_show'] = $this->admin_model->select_where_left_join('*', 'sh_tbl_staff stf', 'sh_tbl_designation m', 'stf.designation_id=m.id', 'stf.status=1');

		$this->load->view('hr_management/salary_payment/staff_salary_generate_payslip', $data);
	}


	public function payment_complete_single()
	{
		$data['salary_gen_id'] = $this->input->post('salary_gen_id');
		$payment_date = $this->input->post('payment_date');
		$data['payment_date'] = $payment_date;
		$data['total_payble_salary'] = $this->input->post('t_salary');
		$data['payment_type'] = $this->input->post('salary_pay_method');
		if ($data['payment_type'] == 'due') {
			$data['pay_status'] = '1';
		} else if ($data['payment_type'] == 'bank') {
			$data['pay_status'] = '2';
			$data['bank_name'] = $this->input->post('bank_name');
			$data['cheque_no'] = $this->input->post('cheque_no');
			$data['payment_salary'] = $this->input->post('t_salary');
			$data['payment_date'] = $payment_date;
		} else {
			$data['pay_status'] = '2';
			$data['payment_salary'] = $this->input->post('t_salary');
			$data['payment_date'] = $payment_date;
		}
		$id = $this->admin_model->update_function2('salary_gen_id="' . $data['salary_gen_id'] . '"', 'sh_tbl_staff_salary_genrate', $data);
		$this->session->set_flashdata('Successfully', 'Successfully Inserted');
		redirect("admin/all_staff_payment_list", "refresh");
	}

	public function all_staff_salary_payment_report($value = '')
	{
		$data['active'] = 'staff_salary_payment_report';
		$data['page_title'] = 'Staff Salary Payment Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['staff_list_show'] = $this->admin_model->select_with_where2('*', 'status=1', 'sh_tbl_staff');

		$this->load->view('hr_management/salary_payment/salary_payment_report', $data);
	}

	public function all_staff_salary_payment_report_view()
	{
		$month_year = "";

		if (!empty($_GET['staff_id'])) {
			$this->db->where('staff_id', $_GET['staff_id']);
		}

		if (!empty($_GET['generated_date']) && !empty($_GET['month'])) {
			$year = date('Y', strtotime($_GET['generated_date']));
			$month_year = $year . '-' . $_GET['month'];
			$this->db->where('month_year', $month_year);
		}

		$result = $this->db->get('sh_tbl_staff_salary_genrate');
		$data['all_payment'] = $result->result_array();

		$data['months_year'] = $month_year;

		$this->load->view('hr_management/salary_payment/salary_payment_report_view', $data);
	}

	//Manage Salary End


	// <<<<<<<<<<<<<<< Ambulace Module Start<<<<<<<<<<<<<<<<<<<<<
	// <<<<<<<<<<<<<<< Ambulace Module Start<<<<<<<<<<<<<<<<<<<


	//Ambulance Management Start
	public function ambulance_receipt_registation()
	{
		$data['active'] = 'Ambulance_head';
		$data['page_title'] = 'Ambulance Receipt Registration';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['ambulance_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'tbl_ambulance');
		$data['opd_patient_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'opd_patient_info');
		$data['ipd_patient_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'ipd_patient_info');
		$data['uhid_patient_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'uhid');
		$max = $this->admin_model->getTripNo();
		$data['sexAll'] = $this->admin_model->getSex();
		$data['max_trip_no'] = $max + 1;
		$this->load->view('ambulance_management/ambulance_receipt/ambulance_receipt_registation', $data);
	}



	public function add_ambulance($value = '')
	{
		$data['active'] = 'add_ambulance';
		$data['page_title'] = 'Add Ambulance';

		$this->load->view('ambulance_management/add_ambulance', $data);
	}

	public function add_ambulance_post($value = '')
	{
		$val['ambulance_no'] = $this->input->post('ambulance_no');
		$val['created_at'] = date('Y-m-d');
		$val['operator_name'] = $this->session->userdata['logged_in']['username'];
		$val['operator_id'] = $this->session->userdata['logged_in']['id'];

		$id = $this->admin_model->insert_ret('tbl_ambulance', $val);

		$rows = $this->admin_model->select_with_where2('*', 'status=1', 'tbl_ambulance');

		$gen_id['gen_id'] = "AMB-" . sprintf("%'.06d", (count($rows)));

		$this->admin_model->update_function('ambulance_id', $id, 'tbl_ambulance', $gen_id);

		redirect('admin/add_ambulance', 'refresh');
	}

	public function ambulance_list($value = '')
	{
		$data['active'] = 'ambulance_list';
		$data['page_title'] = 'Ambulance List';

		$data['ambulance_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'tbl_ambulance');

		$this->load->view('ambulance_management/ambulance_list', $data);
	}

	public function delete_ambulance($id = '')
	{

		$this->admin_model->delete_function_cond('tbl_ambulance', 'ambulance_id="' . $id . '"');

		redirect('admin/ambulance_list', 'refresh');
	}

	public function edit_ambulance($id = '')
	{
		$data['active'] = 'edit_ambulance';
		$data['page_title'] = 'Edit Ambulance';


		$data['ambulance_info'] = $this->admin_model->select_with_where2('*', 'status=1 and ambulance_id = "' . $id . '"', 'tbl_ambulance');

		$this->load->view('ambulance_management/edit_ambulance', $data);
	}

	public function edit_ambulance_post($id = '')
	{
		$val['ambulance_no'] = $_POST['ambulance_no'];

		$this->load->admin_model->update_function2('ambulance_id="' . $id . '"', 'tbl_ambulance', $val);
		redirect('admin/ambulance_list', 'refresh');
	}


	//Ambulance reciept create_function
	//Ambulance reciept create_function


	public function ambulance_add_post()
	{
		//$data['hospital_id']=$this->input->post('hospital_id'); 
		$data['trip_no'] = $this->input->post('trip_no');
		$data['date'] = $this->input->post('date');
		$data['sex'] = $this->input->post('sex');
		$data['age'] = $this->input->post('age');
		$patient_type = $this->input->post('patient_type');
		$data['patient_type'] = $patient_type;

		if ($patient_type == 1) {
			$data['other_dept_p_id'] = $this->input->post('opd_patient_id_select');
		} else if ($patient_type == 2) {
			$data['other_dept_p_id'] = $this->input->post('ipd_patient_id_select');
		} else if ($patient_type == 4) {
			$data['other_dept_p_id'] = $this->input->post('uhid_patient_id_select');
		} else {
			$data['other_dept_p_id'] = 0;
		}


		$data['patient_name'] = $this->input->post('patient_name');
		$data['gardian_name'] = $this->input->post('gardian_name');
		$data['patient_mobile_no'] = $this->input->post('patient_mobile_no');

		$data['ambulance_id'] = $this->input->post('ambulance_no');
		$data['road_name'] = $this->input->post('road_name');

		$data['distance'] = $this->input->post('distance');
		$data['total_recieve'] = $this->input->post('fuel_cost') + $this->input->post('road_cost') + $this->input->post('service_maintance_cost');
		$data['fuel_cost'] = $this->input->post('fuel_cost');
		$data['road_cost'] = $this->input->post('road_cost');
		$data['service_maintance_cost'] = $this->input->post('service_maintance_cost');

		$data['total_cost'] = $this->input->post('fuel_cost') + $this->input->post('road_cost') + $this->input->post('service_maintance_cost');

		$data['comments'] = $this->input->post('comments');
		$data['driver_name'] = $this->input->post('driver_name');
		$data['driver_mobile_no'] = $this->input->post('driver_mobile_no');
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$data['operator_id'] = $this->session->userdata['logged_in']['id'];

		$id = $this->admin_model->insert_ret('sh_tbl_ambulance_reciept', $data);
		$this->session->set_flashdata('Successfully', 'Successfully Done');

		redirect("admin/ambulance_reciept_report_view?amb_reciept_id=" . $id);
	}

	public function ambulance_reciept_report_view($amb_reciept_id = '')
	{

		$data['ambulance_reciept'] = $this->admin_model->select_join_where('*,am.ambulance_no', 'sh_tbl_ambulance_reciept ar', 'tbl_ambulance am', 'ar.ambulance_id=am.ambulance_id', 'am.status=1 and amb_reciept_id="' . $amb_reciept_id . '"');

		$this->load->view('ambulance_management/ambulance_report/ambulance_reciept_report_view', $data);
	}

	public function ambulance_receipt_list()
	{
		$data['active'] = 'ambulance_reciept_list';
		$data['page_title'] = 'Ambulance Reciept List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['ambulance_reciept_list'] = $this->admin_model->select_join_where('*,am.ambulance_no', 'sh_tbl_ambulance_reciept ar', 'tbl_ambulance am', 'ar.ambulance_id=am.ambulance_id', 'am.status=1');

		$this->load->view('ambulance_management/ambulance_receipt/ambulance_receipt_list', $data);
	}

	public function ambulance_receipt_edit($amb_reciept_id)
	{
		$data['active'] = 'Ambulance_head';
		$data['page_title'] = 'Ambulance Receipt Registration Edit';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		$data['sexAll'] = $this->admin_model->getSex();
		$amb_reciept_id = $amb_reciept_id;

		$data['ambulance_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'tbl_ambulance');
		$data['opd_patient_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'opd_patient_info');
		$data['ipd_patient_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'ipd_patient_info');
		$data['uhid_patient_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'uhid');
		$max = $this->admin_model->getTripNo();
		$data['max_trip_no'] = $max + 1;

		$data['ambulance_details'] = $this->admin_model->select_join_where('*,am.ambulance_no', 'sh_tbl_ambulance_reciept ar', 'tbl_ambulance am', 'ar.ambulance_id=am.ambulance_id', 'am.status=1 and amb_reciept_id ="' . $amb_reciept_id . '"');

		$data['trip_no'] = $data['ambulance_details'][0]['trip_no'];
		$data['amb_reciept_id'] = $data['ambulance_details'][0]['amb_reciept_id'];
		$data['patient_type'] = $data['ambulance_details'][0]['patient_type'];
		$data['patient_name'] = $data['ambulance_details'][0]['patient_name'];
		$data['gardian_name'] = $data['ambulance_details'][0]['gardian_name'];
		$data['patient_mobile_no'] = $data['ambulance_details'][0]['patient_mobile_no'];
		$data['ambulance_id'] = $data['ambulance_details'][0]['ambulance_id'];
		$data['road_name'] = $data['ambulance_details'][0]['road_name'];
		$data['distance'] = $data['ambulance_details'][0]['distance'];
		$data['total_recieve'] = $data['ambulance_details'][0]['total_recieve'];
		$data['fuel_cost'] = $data['ambulance_details'][0]['fuel_cost'];
		$data['road_cost'] = $data['ambulance_details'][0]['road_cost'];
		$data['service_maintance_cost'] = $data['ambulance_details'][0]['service_maintance_cost'];
		$data['date'] = $data['ambulance_details'][0]['date'];
		$data['sex'] = $data['ambulance_details'][0]['sex'];
		$data['age'] = $data['ambulance_details'][0]['age'];
		$data['comments'] = $data['ambulance_details'][0]['comments'];
		$data['driver_name'] = $data['ambulance_details'][0]['driver_name'];
		$data['driver_mobile_no'] = $data['ambulance_details'][0]['driver_mobile_no'];

		$this->load->view('ambulance_management/ambulance_receipt/ambulance_receipt_registation_edit', $data);
	}

	public function ambulance_receipt_edit_post()
	{

		$id = $data['amb_reciept_id'] = $this->input->post('amb_reciept_id');
		$data['trip_no'] = $this->input->post('trip_no');
		$data['date'] = $this->input->post('date');
		$data['sex'] = $this->input->post('sex');
		$data['age'] = $this->input->post('age');
		$patient_type = $this->input->post('patient_type');
		$data['patient_type'] = $patient_type;

		if ($patient_type == 1) {
			$data['other_dept_p_id'] = $this->input->post('opd_patient_id_select');
		} else if ($patient_type == 2) {
			$data['other_dept_p_id'] = $this->input->post('ipd_patient_id_select');
		} else if ($patient_type == 4) {
			$data['other_dept_p_id'] = $this->input->post('uhid_patient_id_select');
		} else {
			$data['other_dept_p_id'] = 0;
		}


		$data['patient_name'] = $this->input->post('patient_name');


		$data['gardian_name'] = $this->input->post('gardian_name');
		$data['patient_mobile_no'] = $this->input->post('patient_mobile_no');

		$data['ambulance_id'] = $this->input->post('ambulance_no');
		$data['road_name'] = $this->input->post('road_name');

		$data['distance'] = $this->input->post('distance');
		$data['total_recieve'] = $this->input->post('fuel_cost') + $this->input->post('road_cost') + $this->input->post('service_maintance_cost');
		$data['fuel_cost'] = $this->input->post('fuel_cost');
		$data['road_cost'] = $this->input->post('road_cost');
		$data['service_maintance_cost'] = $this->input->post('service_maintance_cost');

		$data['total_cost'] = $this->input->post('fuel_cost') + $this->input->post('road_cost') + $this->input->post('service_maintance_cost');

		$data['comments'] = $this->input->post('comments');
		$data['driver_name'] = $this->input->post('driver_name');
		$data['driver_mobile_no'] = $this->input->post('driver_mobile_no');
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$data['operator_id'] = $this->session->userdata['logged_in']['id'];

		$this->admin_model->update_function('amb_reciept_id', $data['amb_reciept_id'], 'sh_tbl_ambulance_reciept', $data);
		$this->session->set_flashdata('Successfully', 'Ambulance Update Successfully Done');

		redirect("admin/ambulance_reciept_report_view?amb_reciept_id=" . $id);
	}

	public function ambulance_receipt_dlt($amb_reciept_id)
	{
		$data['status'] = 2;
		$this->admin_model->update_function2('amb_reciept_id="' . $amb_reciept_id . '"', 'sh_tbl_ambulance_reciept', $data);
		$this->session->set_flashdata('Successfully', 'Delete Successfully Done');
		redirect("admin/ambulance_receipt_list", "refresh");
	}

	public function ambulance_all_receipt_report($value = '')
	{
		$data['active'] = 'ambulance_all_reciept_report';
		$data['page_title'] = 'Ambulance All Receipt Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['director_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'sh_tbl_staff');

		$this->load->view('ambulance_management/ambulance_report/ambulance_all_receipt_report', $data);
	}

	public function ambulance_all_receipt_report_view()
	{
		$month_year = "";

		if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {

			$start_date = date('Y-m-d', strtotime($_GET['start_date']));
			$end_date = date('Y-m-d', strtotime($_GET['end_date']));
		}

		$data['ambulance_reciept'] = $this->admin_model->select_join_where('*,am.ambulance_no', 'sh_tbl_ambulance_reciept ar', 'tbl_ambulance am', 'ar.ambulance_id=am.ambulance_id', 'am.status=1 and date(ar.created_at) between "' . $start_date . '" and "' . $end_date . '"');


		$data['uhid_info'] = $this->admin_model->select_with_where2('*', 'status=1 and id="' . $data['ambulance_reciept'][0]['uhid'] . '"', 'uhid');


		$this->load->view('ambulance_management/ambulance_report/ambulance_all_receipt_report_view', $data);
	}
	//Ambulance Management End
	//Emergency Management Start
	public function emergency_receipt_registation()
	{
		$data['active'] = 'Emergency_head';
		$data['page_title'] = 'Emergency Receipt Registration';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['ambulance_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'tbl_ambulance');
		$data['opd_patient_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'opd_patient_info');
		$data['ipd_patient_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'local_patient_info');
		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');
		$data['department_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'sh_tbl_department');
		$max = $this->admin_model->getEmergencyNo();
		$data['sexAll'] = $this->admin_model->getSex();
		$data['max_emergency_no'] = $max + 1;
		$this->load->view('emergency_management/emergency_reciept/emergency_receipt_registation', $data);
	}

	//Emergenccy reciept create_function
	public function emergency_add_post()
	{
		//$data['hospital_id']=$this->input->post('hospital_id'); 
		$data['emergency_no'] = $this->input->post('emergency_no');
		$data['date'] = $this->input->post('date');
		$data['sex'] = $this->input->post('sex');
		$data['age'] = $this->input->post('age');
		$patient_type = $this->input->post('patient_type');
		$data['patient_type'] = $patient_type;

		if ($patient_type == 1) {
			$patient_name = $this->input->post('patient_name1');
		} else if ($patient_type == 2) {
			$patient_name = $this->input->post('patient_name2');
		} else {
			$patient_name = $this->input->post('patient_name3');
		}
		$data['patient_name'] = $patient_name;

		$data['relation_patient'] = $this->input->post('relation_patient');
		$data['diagnosis'] = $this->input->post('diagnosis');

		$data['service_doctor'] = $this->input->post('service_doctor');
		$data['gardian_name'] = $this->input->post('gardian_name');
		$data['doctor_fee'] = $this->input->post('doctor_fee');
		$data['other_cost'] = $this->input->post('other_cost');
		$data['mobile_no'] = $this->input->post('mobile_no');
		$data['hospital_amount'] = $this->input->post('hospital_amount');
		$data['refered_doctor'] = $this->input->post('refered_doctor');
		$data['department'] = $this->input->post('department');
		$data['comments'] = $this->input->post('comments');
		$data['discount_amount'] = $this->input->post('discount_amount');
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$data['operator_id'] = $this->session->userdata['logged_in']['id'];

		$id = $this->admin_model->insert_ret('sh_tbl_emergency_reciept', $data);
		$this->session->set_flashdata('Successfully', 'Successfully Done');

		redirect("admin/emergency_reciept_report_view?emrg_reciept_id=" . $id);
	}

	public function emergency_reciept_report_view()
	{
		if (!empty($_GET['emrg_reciept_id'])) {
			$this->db->where('emergency_reciept_id', $_GET['emrg_reciept_id']);
		}
		$this->db->where('status', 1);
		$result = $this->db->get('sh_tbl_emergency_reciept');
		$data['emergency_reciept'] = $result->result_array();
		$this->load->view('emergency_management/emergency_report/emergency_reciept_report_view', $data);
	}

	public function emergency_receipt_list()
	{
		$data['active'] = 'emergency_reciept_list';
		$data['page_title'] = 'Emergency Reciept List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$this->db->where('status', 1);
		$result = $this->db->get('sh_tbl_emergency_reciept');
		$data['emergency_reciept_list'] = $result->result_array();
		$this->load->view('emergency_management/emergency_reciept/emergency_receipt_list', $data);
	}

	public function emergency_receipt_edit($emergency_reciept_id)
	{

		$emergency_reciept_id = $emergency_reciept_id;
		$data['sexAll'] = $this->admin_model->getSex();
		$data['active'] = 'emergency_list';
		$data['page_title'] = 'Emergency List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['opd_patient_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'opd_patient_info');
		$data['ipd_patient_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'local_patient_info');
		$data['doctor_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'doctor');
		$data['department_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'sh_tbl_department');
		$max = $this->admin_model->getEmergencyNo();
		$data['max_emergency_no'] = $max + 1;

		$data['emergency_details'] = $this->admin_model->select_with_where2('*', 'emergency_reciept_id="' . $emergency_reciept_id . '"', 'sh_tbl_emergency_reciept');
		$data['emergency_no'] = $data['emergency_details'][0]['emergency_no'];
		$data['emergency_reciept_id'] = $data['emergency_details'][0]['emergency_reciept_id'];
		$data['patient_type'] = $data['emergency_details'][0]['patient_type'];
		$data['patient_name'] = $data['emergency_details'][0]['patient_name'];
		$data['relation_patient'] = $data['emergency_details'][0]['relation_patient'];
		$data['diagnosis'] = $data['emergency_details'][0]['diagnosis'];
		$data['service_doctor'] = $data['emergency_details'][0]['service_doctor'];
		$data['gardian_name'] = $data['emergency_details'][0]['gardian_name'];
		$data['doctor_fee'] = $data['emergency_details'][0]['doctor_fee'];
		$data['other_cost'] = $data['emergency_details'][0]['other_cost'];
		$data['mobile_no'] = $data['emergency_details'][0]['mobile_no'];
		$data['hospital_amount'] = $data['emergency_details'][0]['hospital_amount'];
		$data['refered_doctor'] = $data['emergency_details'][0]['refered_doctor'];
		$data['department'] = $data['emergency_details'][0]['department'];
		$data['date'] = $data['emergency_details'][0]['date'];
		$data['sex'] = $data['emergency_details'][0]['sex'];
		$data['age'] = $data['emergency_details'][0]['age'];
		$data['comments'] = $data['emergency_details'][0]['comments'];
		$data['discount_amount'] = $data['emergency_details'][0]['discount_amount'];

		$this->load->view('emergency_management/emergency_reciept/emergency_receipt_registation_edit', $data);
	}


	public function emergency_receipt_edit_post()
	{
		$id = $data['emergency_reciept_id'] = $this->input->post('emergency_reciept_id');
		$data['emergency_no'] = $this->input->post('emergency_no');
		$data['date'] = $this->input->post('date');
		$data['sex'] = $this->input->post('sex');
		$data['age'] = $this->input->post('age');
		$patient_type = $this->input->post('patient_type');
		$data['patient_type'] = $patient_type;

		if ($patient_type == 1) {
			$patient_name = $this->input->post('patient_name1');
		} else if ($patient_type == 2) {
			$patient_name = $this->input->post('patient_name2');
		} else {
			$patient_name = $this->input->post('patient_name3');
		}
		$data['patient_name'] = $patient_name;

		$data['relation_patient'] = $this->input->post('relation_patient');
		$data['diagnosis'] = $this->input->post('diagnosis');

		$data['service_doctor'] = $this->input->post('service_doctor');
		$data['gardian_name'] = $this->input->post('gardian_name');
		$data['doctor_fee'] = $this->input->post('doctor_fee');
		$data['other_cost'] = $this->input->post('other_cost');
		$data['hospital_amount'] = $this->input->post('hospital_amount');
		$data['refered_doctor'] = $this->input->post('refered_doctor');
		$data['department'] = $this->input->post('department');
		$data['mobile_no'] = $this->input->post('mobile_no');
		$data['comments'] = $this->input->post('comments');
		$data['discount_amount'] = $this->input->post('discount_amount');
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$this->admin_model->update_function('emergency_reciept_id', $data['emergency_reciept_id'], 'sh_tbl_emergency_reciept', $data);
		$this->session->set_flashdata('Successfully', 'Staff Update Successfully Done');

		redirect("admin/emergency_reciept_report_view?emrg_reciept_id=" . $id);
	}
	public function emergency_receipt_dlt($emergency_reciept_id)
	{
		$data['status'] = 2;
		$this->admin_model->update_function2('emergency_reciept_id="' . $emergency_reciept_id . '"', 'sh_tbl_emergency_reciept', $data);
		$this->session->set_flashdata('Successfully', 'Delete Successfully Done');
		redirect("admin/emergency_receipt_list", "refresh");
	}


	public function emergency_all_receipt_report($value = '')
	{
		$data['active'] = 'emergency_all_reciept_report';
		$data['page_title'] = 'Emergency All Receipt Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['director_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'sh_tbl_staff');

		$this->load->view('emergency_management/emergency_report/emergency_all_receipt_report', $data);
	}

	public function emergency_all_receipt_report_view()
	{

		if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {

			$start_date = date('Y-m-d', strtotime($_GET['start_date']));
			$end_date = date('Y-m-d', strtotime($_GET['end_date']));

			$this->db->where('date >=', $start_date);
			$this->db->where('date <=', $end_date);
		}

		$result = $this->db->get('sh_tbl_emergency_reciept');
		$data['all_payment'] = $result->result_array();
		$this->load->view('emergency_management/emergency_report/emergency_all_receipt_report_view', $data);
	}

	//Emergency Management End
	//Lab Management Start

	public function lab_product_list($value = '')
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Lab Product List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		// $data['product']=$this->admin_model->select_join_three_table2('*,p.id','company c','product p','unit_info u','c.id=p.p_company_id','u.id=p_unit_id','p.status=1');	

		$this->load->view('lab_management/lab_product/lab_product_list', $data);
	}


	public function lab_product_list_dt($value = '')
	{

		$select_column = '*,p.id';
		$order_column = array('p.id', 'p_code', 'p_name', 'comp_name', 'p_buy_price', 'p_current_stock', 'unit');

		$search_column = array('p.id', 'p_code', 'p_name', 'comp_name', 'p_buy_price', 'p_current_stock', 'unit');


		$condition = "p.status=1";

		$fetch_data = $this->admin_model->make_datatables_three_table_join('company c', $condition, $select_column, $order_column, $search_column, 'sh_tbl_lab_product p', 'c.id=p.p_company_id', 'unit_info u', 'u.id=p_unit_id', 'p.id');


		$data = array();

		$i = $_POST['start'];


		$medicine = "";

		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = '<span class="badge badge-secondary">' . $row->p_code . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->p_name . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->comp_name . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->p_buy_price . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->unit . '</span>';



			$stock = "";

			if ($row->p_current_stock > $row->p_reorder_qty) {
				$stock = '<div class="badge badge-success">
	 			' . $row->p_current_stock . '&nbsp;
	 			<i class="ace-icon fa fa-arrow-up"></i>
	 			</div>';
			} else {
				$stock = '<td align="center"><div class="badge badge-danger" >
	 			' . $row->p_current_stock . '&nbsp;
	 			<i class="ace-icon fa fa-arrow-down"></i>
	 			</div></td>';
			}

			$sub_array[] = $stock;

			$sub_array[] = '<a href="admin/lab_edit_product/' . $row->id . '" type="button" class="btn btn-success btn-xs supplier_edit_button">View Details / Edit</a>';

			$sub_array[] = '<button type="button" id="' . $row->id . '"class="btn btn-danger btn-xs product_delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';



			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_three_table_join('company c', $condition, $select_column, 'sh_tbl_lab_product p', 'c.id=p.p_company_id', 'unit_info u', 'u.id=p_unit_id'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_three_table_join(
				'company c',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'sh_tbl_lab_product p',
				'c.id=p.p_company_id',
				'unit_info u',
				'u.id=p_unit_id',
				'p.id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	//Add Product



	public function lab_add_product($value = '')
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Add Lab product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['all_unit'] = $this->admin_model->select_with_where2('*', 'status=1', 'unit_info');
		$data['all_generic_name'] = $this->admin_model->select_with_where2('*', 'status=1', 'generic_info');
		$data['all_product_category'] = $this->admin_model->select_with_where2('*', 'status=1', 'product_category');
		$data['all_company_name'] = $this->admin_model->select_with_where2('*', 'status=1', 'company');



		$this->form_validation->set_error_delimiters('<div>', '</div>');

		$this->form_validation->set_rules('p_name', 'Product Name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('lab_management/lab_product/lab_add_product', $data);
		} else {

			$product_image = "default.jpg";

			$p_code = '000001';
			$get_last_product_code = $this->admin_model->get_last_product_code();


			if (count($get_last_product_code) > 0) {
				$p_code = (int)$get_last_product_code[0]['p_code'];
				$p_code = sprintf("%'.06d\n", ($p_code + 1));
			}

			$val = array(
				'p_code' => $p_code,
				'p_img' => $product_image,
				'p_name' => $this->input->post('p_name'),
				'p_unit_id' => $this->input->post('p_unit'),
				'p_generic_id' => $this->input->post('p_generic_name'),																																																															// 'pack_size_id' =>$this->input->post('p_pack_size'),
				'p_buy_price' => $this->input->post('p_buy_price'),
				'p_sell_price' => $this->input->post('p_sell_price'),
				'p_cat_id' => $this->input->post('p_category'),
				'p_reorder_qty' => $this->input->post('p_alert_qty'),
				'p_company_id' => $this->input->post('company_name'),
				'created_at' => date('Y-m-d H:i:s')

			);

			$img_id = $this->admin_model->insert_ret('sh_tbl_lab_product', $val);

			if ($_FILES['p_img']['name']) {
				$name_generator = $this->name_generator($_FILES['p_img']['name'], $img_id);
				$i_ext = explode('.', $_FILES['p_img']['name']);
				$target_path = $name_generator . '.' . end($i_ext);;
				$size = getimagesize($_FILES['p_img']['tmp_name']);

				if (move_uploaded_file($_FILES['p_img']['tmp_name'], 'uploads/lab_product_image/' . $target_path)) {
					$product_image = $target_path;
				}

				$data_logo['p_img'] = $product_image;
				$this->admin_model->update_function('id', $img_id, 'sh_tbl_lab_product', $data_logo);
			};
			redirect("admin/lab_product_list");
		}
	}

	//delete product


	public function lab_delete_product($value = '')
	{
		$data = array('status' => 2);
		$this->admin_model->update_function('id', $_POST['pro_id'], 'sh_tbl_lab_product', $data);

		echo json_encode($data);
	}

	//edit product


	public function lab_edit_product($value = '')
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Edit Lab Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$product_id = $this->uri->segment(3);

		$data['all_product_info'] = $this->admin_model->select_with_where2('*', 'id="' . $product_id . '" AND status=1', 'sh_tbl_lab_product');

		$data['all_unit'] = $this->admin_model->select_with_where2('*', 'status=1', 'unit_info');
		$data['all_generic_name'] = $this->admin_model->select_with_where2('*', 'status=1', 'generic_info');
		$data['all_product_category'] = $this->admin_model->select_with_where2('*', 'status=1', 'product_category');
		$data['all_company_name'] = $this->admin_model->select_with_where2('*', 'status=1', 'company');
		$data['all_pack_size'] = $this->admin_model->select_with_where2('*', 'status=1', 'pack_size_info');

		$this->form_validation->set_error_delimiters('<div>', '</div>');
		$this->form_validation->set_rules('p_name', 'Product Name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('lab_management/lab_product/lab_edit_product', $data);
		} else {
			$product_image = "Default_image";
			if ($_FILES['p_img']['name']) {
				$name_generator = $this->name_generator($_FILES['p_img']['name'], $product_id);
				$i_ext = explode('.', $_FILES['p_img']['name']);
				$target_path = $name_generator . '.' . end($i_ext);;
				$size = getimagesize($_FILES['p_img']['tmp_name']);

				if (move_uploaded_file($_FILES['p_img']['tmp_name'], 'uploads/lab_product_image/' . $target_path)) {
					$product_image = $target_path;
				}
			}


			$val = array(
				'p_img' => $product_image,
				'p_name' => $this->input->post('p_name'),
				'p_unit_id' => $this->input->post('p_unit'),
				'p_generic_id' => $this->input->post('p_generic_name'),
				'pack_size_id' => $this->input->post('p_pack_size'),
				'p_buy_price' => $this->input->post('p_buy_price'),
				'p_sell_price' => $this->input->post('p_sell_price'),
				'p_cat_id' => $this->input->post('p_category'),
				'p_reorder_qty' => $this->input->post('p_alert_qty'),
				'p_company_id' => $this->input->post('company_name'),
				'updated_at' => date('Y-m-d H:i:s')

			);
			$this->admin_model->update_function('id', $product_id, 'sh_tbl_lab_product', $val);

			$data['all_product_info'] = $this->admin_model->select_with_where2('*', 'id="' . $product_id . '" AND status=1', 'sh_tbl_lab_product');

			$data['message'] = "update Successfully";
			$this->load->view('lab_management/lab_product/lab_edit_product', $data);
		}
	}


	public function lab_in_product_list($value = '')
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Lab Purchase Product List';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['all_purchased_product_list'] = $this->admin_model->select_join_order('*,sh_tbl_lab_in_product.created_at ', 'sh_tbl_lab_in_product', 'supplier', 'supp_id=id', 'sh_tbl_lab_in_product.buy_id', 'desc');


		$this->load->view('lab_management/lab_in_product/lab_in_product_list', $data);
	}


	public function lab_in_product($value = '')
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Lab In Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['product_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'sh_tbl_lab_product');



		$data['supplier_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'supplier');


		$this->load->view('lab_management/lab_in_product/lab_in_product', $data);
	}


	public function get_last_lab_bill_no($value = '')
	{
		$data = $this->admin_model->get_last_row3('buy_id', 'sh_tbl_lab_in_product', 'status=1');
		echo json_encode($data);
	}

	public function get_lab_product_details_ajax($value = '')
	{
		$data = $this->admin_model->select_join_where('*', 'sh_tbl_lab_product', 'unit_info', 'unit_info.id=sh_tbl_lab_product.p_unit_id', 'sh_tbl_lab_product.id="' . $_POST['p_id'] . '" AND sh_tbl_lab_product.status=1');
		//echo "<pre>";print_r($data['hospital_title']);die();
		echo json_encode($data);
	}



	public function insert_lab_in_product()
	{
		$login_id = $this->session->userdata['logged_in']['id'];
		$buy_code = 'lab-p-000001';
		$get_last_buy_code = $this->admin_model->get_last_lab_in_code();

		if (count($get_last_buy_code) > 0) {
			$buy_code = $get_last_buy_code[0]['buy_code'];
			$buy_code_explode = explode('-', $buy_code);
			$buy_code_int = $buy_code_explode[1];
			$buy_code_number = sprintf("%'.06d\n", ($buy_code_int + 1));
			$buy_code = $buy_code_explode[0] . '-' . $buy_code_number;
		}

		$buy_data['user_id'] = $login_id;
		$buy_data['buy_code'] = $buy_code;
		$buy_data['supp_id'] = $this->input->post('supp_id');
		$buy_data['bill_no'] = $this->input->post('bill_no');
		$buy_data['credit'] = $this->input->post('credit');
		$buy_data['debit'] = $this->input->post('debit');
		$buy_data['unload_cost'] = $this->input->post('unload_cost');
		$buy_data['created_at'] = date('Y-m-d H:i:s');
		$buy_data['cost_total'] = $buy_data['credit'] + $buy_data['unload_cost'];
		$buy_data['operator_id'] = $this->session->userdata['logged_in']['id'];
		$buy_data['operator_name'] = $this->session->userdata['logged_in']['username'];

		$buy_id = $this->admin_model->insert_ret('sh_tbl_lab_in_product', $buy_data);

		$p_id = $this->input->post('p_id');
		$buy_price = $this->input->post('buy_price');
		$buy_qty = $this->input->post('buy_qty');

		for ($i = 0; $i < count($p_id); $i++) {
			$bd_data['buy_id'] = $buy_id;
			$bd_data['p_id'] = $p_id[$i];
			$bd_data['buy_price'] = $buy_price[$i];
			$bd_data['buy_qty'] = $buy_qty[$i];
			$bd_data['created_at'] = date('Y-m-d H:i:s');

			$this->admin_model->insert('sh_tbl_lab_in_product_details', $bd_data);
		}


		for ($i = 0; $i < count($p_id); $i++) {
			$stock['sell_buy_id'] = $buy_id;
			$stock['p_id'] = $p_id[$i];

			$get_last_val = $this->admin_model->get_last_row('sh_tbl_stock', 'p_id=' . $p_id[$i]);
			$stock['st_open'] = 0;
			if (count($get_last_val) > 0) {
				$stock['st_open'] = $get_last_val[0]['st_close'];
			}
			$stock['st_in'] = $buy_qty[$i];
			$stock['st_out'] = 0;
			$stock['st_close'] = $stock['st_open'] + $stock['st_in'];
			$stock['type'] = 1;
			$stock['created_at'] = date('Y-m-d H:i:s');

			$this->admin_model->insert('sh_tbl_stock', $stock);
		}

		//quantity update in product table

		for ($i = 0; $i < count($p_id); $i++) {
			$prev_qty = 0;
			$p_start_qty = 0;
			$get_p_data = $this->admin_model->select_with_where2('*', 'id =' . $p_id[$i], 'sh_tbl_lab_product');
			if ($get_p_data[0]['p_opening_qty'] == 0) {
				$start_data['p_opening_qty'] = $buy_qty[$i];
				$this->admin_model->update_function('id', $p_id[$i], 'sh_tbl_lab_product', $start_data);
			}

			$prev_qty = $get_p_data[0]['p_current_stock'];

			$data_update['p_current_stock'] = $prev_qty + $buy_qty[$i];

			$this->admin_model->update_function('id', $p_id[$i], 'sh_tbl_lab_product', $data_update);
		}

		redirect('admin/lab_in_product_list', 'refresh');
	}

	public function lab_in_product_details($value = '')
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Lab In Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$buy_id = $this->uri->segment(3);

		$data['buy_details'] = $this->admin_model->select_join_five_table2('*,b.created_at,b.buy_id', 'sh_tbl_lab_in_product b', 'supplier s', 'sh_tbl_lab_in_product_details d', 'sh_tbl_lab_product p', 'unit_info u', 'b.supp_id=s.id', 'b.buy_id=d.buy_id', 'p.id=d.p_id', 'u.id=p.p_unit_id', 'b.buy_id="' . $buy_id . '"');

		$this->load->view('lab_management/lab_in_product/lab_in_product_details', $data);
	}


	public function lab_in_product_details_pdf($value = '')
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Lab In Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$buy_id = $this->uri->segment(3);

		$data['buy_details'] = $this->admin_model->select_join_five_table2('*,b.created_at,b.buy_id', 'sh_tbl_lab_in_product b', 'supplier s', 'sh_tbl_lab_in_product_details d', 'sh_tbl_lab_product p', 'unit_info u', 'b.supp_id=s.id', 'b.buy_id=d.buy_id', 'p.id=d.p_id', 'u.id=p.p_unit_id', 'b.buy_id="' . $buy_id . '"');

		$this->load->view('lab_management/lab_in_product/lab_in_product_details_pdf', $data);
	}



	public function update_lab_in_supp_payment($value = '')
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Lab In Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$buy_id = $this->uri->segment(3);
		$supp_id = $this->uri->segment(4);

		$val = $this->admin_model->select_with_where2('*', 'buy_id="' . $buy_id . '"', 'sh_tbl_lab_in_product');

		$debit = $val[0]['debit'] + $this->input->post('update_payment_supp');


		$val1 = array('debit' => $debit);
		$this->load->admin_model->update_function('buy_id', $buy_id, 'sh_tbl_lab_in_product', $val1);

		$d_data['old_due'] = $this->input->post('due');
		$d_data['order_id'] = $val[0]['buy_code'];
		$d_data['total_amount'] = $val[0]['credit'];
		$d_data['supp_cust_id'] = $val[0]['supp_id'];
		// $d_data['unload_cost']=$this->input->post('unload_cost');
		$d_data['current_due'] = $this->input->post('due') - $this->input->post('update_payment_supp');
		$d_data['paid_due'] = $this->input->post('update_payment_supp');;;
		$d_data['due_type'] = 3;

		$d_data['operator_name'] = $this->session->userdata['logged_in']['username'];
		$d_data['operator_id'] = $this->session->userdata['logged_in']['id'];

		$this->load->admin_model->insert('pharmacy_due_collection', $d_data);

		$insert_pay = array(
			'payment_type' => 1,
			'sell_buy_id' => $buy_id,
			'cust_supp_id' => $supp_id,
			'amount' => $this->input->post('update_payment_supp'),
			'type' => 3,
			'user_id' => $this->session->userdata['logged_in']['id'],
			'created_at' => date('Y-m-d H:i:s')
		);

		$this->load->admin_model->insert('payment', $insert_pay);

		redirect("admin/lab_in_product_details/" . $buy_id, 'refresh');
	}

	//lab supplier detials



	public function lab_outstanding_supplier($value = '')
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Due Supplier Lab';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];
		if ($data['admin_type'] == 3) {
			$data['username'] = $this->session->userdata['logged_in']['username'];
			$data['hospital_id'] = $this->session->userdata['logged_in']['hospital_id'];
			$id = $data['hospital_id'];
			$data['hospital'] = $this->admin_model->select_with_where2('*', 'hospital_id="' . $id . '"', 'hospital');
			$data['hospital_ttile'] = $data['hospital']['0']['hospital_title'];
		} else {
			$data['username'] = $this->session->userdata['logged_in']['username'];
			$data['hospital_id'] = "";
			$id = "";
			$data['hospital'] = "";
			$data['hospital_ttile'] = "Admin";
		}

		// $data['supplier_due']=$this->admin_model->select_join_where_order('*,b.created_at','supplier s','buy b','b.supp_id=s.id','s.status=1 AND b.credit > b.debit','b.buy_id','desc'); 

		$this->load->view('lab_management/lab_in_product/lab_outstanding_supplier', $data);
	}


	public function lab_outstanding_supplier_dt($value = '')
	{
		$select_column = '*,b.created_at';
		$condition = "s.status=1 AND b.credit > b.debit";

		$order_column = array('buy_id', 'supp_name', 'bill_no', 'buy_code', 'b.created_at', 'credit');

		$search_column = array('supp_name', 'bill_no', 'buy_code', 'b.created_at', 'credit');

		$fetch_data = $this->admin_model->make_datatables_two_table_join('sh_tbl_lab_in_product b', $condition, $select_column, $order_column, $search_column, 'supplier s', 'b.supp_id=s.id', 'buy_id');
		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = '<span class="badge badge-secondary">' . $row->bill_no . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->buy_code . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->created_at . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->supp_name . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->credit . '</span>';

			$sub_array[] = '<a href="admin/lab_in_product_details/' . $row->buy_id . '" type="button" class="btn btn-success btn-xs supplier_edit_button">View Details</a>';


			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('sh_tbl_lab_in_product b', $condition, $select_column, 'supplier s', 'b.supp_id=s.id'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
				'sh_tbl_lab_in_product b',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'supplier s',
				'b.supp_id=s.id',
				'buy_id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}



	public function lab_full_paid_supp($value = '')
	{
		$data['active'] = 'pharmacy';
		$data['page_title'] = 'Full Paid Supplier Lab';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		// $data['supplier_due']=$this->admin_model->select_join_where_order('*,b.created_at','supplier s','buy b','b.supp_id=s.id','s.status=1 AND b.credit <= b.debit','b.buy_id','desc'); 
		$this->load->view('lab_management/lab_in_product/lab_full_paid_supplier', $data);
	}

	public function lab_full_paid_supp_dt($value = '')
	{
		$select_column = '*,b.created_at';
		$condition = "s.status=1 AND b.credit <= b.debit";

		$order_column = array('buy_id', 'supp_name', 'bill_no', 'buy_code', 'b.created_at', 'credit');

		$search_column = array('supp_name', 'bill_no', 'buy_code', 'b.created_at', 'credit');

		$fetch_data = $this->admin_model->make_datatables_two_table_join('sh_tbl_lab_in_product b', $condition, $select_column, $order_column, $search_column, 'supplier s', 'b.supp_id=s.id', 'buy_id');
		$data = array();

		$i = $_POST['start'];


		foreach ($fetch_data as $key => $row) {
			$sub_array = array();
			$sub_array[] = $i + 1;
			$sub_array[] = '<span class="badge badge-secondary">' . $row->bill_no . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->buy_code . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->created_at . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->supp_name . '</span>';
			$sub_array[] = '<span class="badge badge-secondary">' . $row->credit . '</span>';

			$sub_array[] = '<a href="admin/lab_in_product_details/' . $row->buy_id . '" type="button" class="btn btn-success btn-xs supplier_edit_button">View Details</a>';


			$data[] = $sub_array;

			$i++;
		}

		$output = array(
			"draw"                   =>      intval($_POST["draw"]),
			"recordsTotal"          =>      $this->admin_model->get_all_data_two_table_join('sh_tbl_lab_in_product b', $condition, $select_column, 'supplier s', 'b.supp_id=s.id'),
			"recordsFiltered"     =>     $this->admin_model->get_filtered_data_two_table_join(
				'sh_tbl_lab_in_product b',
				$condition,
				$select_column,
				$order_column,
				$search_column,
				'supplier s',
				'b.supp_id=s.id',
				'buy_id'
			),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	// Edit full lab invoice


	public function lab_edit_product_invoice($value = '')
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Lab Edit Invoice';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$this->cart->destroy();

		$data['product_list'] = $this->admin_model->select_join('*,sh_tbl_lab_product.id', 'sh_tbl_lab_product', 'unit_info', 'unit_info.id=sh_tbl_lab_product.p_unit_id');
		$data['sell_info'] = $this->admin_model->select_all('sell');

		$this->load->view('lab_management/lab_in_product/lab_edit_product_invoice', $data);
	}

	//Lab in Return


	public function lab_in_return($bill_no = '')
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Lab In Return';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		$data['bill_no'] = $bill_no;

		$this->load->view('lab_management/lab_in_product/lab_in_return', $data);
	}

	public function get_all_lab_in_bill($value = '')
	{
		$data = $this->admin_model->select_with_where2('*', 'status=1', 'sh_tbl_lab_in_product');

		echo json_encode($data);
	}

	public function get_lab_in_info_by_bill($value = '')
	{

		$data['buy_details'] = $this->admin_model->select_join_five_table2('*,b.created_at,b.buy_id', 'sh_tbl_lab_in_product b', 'supplier s', 'sh_tbl_lab_in_product_details d', 'sh_tbl_lab_product p', 'unit_info u', 'b.supp_id=s.id', 'b.buy_id=d.buy_id', 'p.id=d.p_id', 'u.id=p.p_unit_id', 'b.bill_no="' . $_POST['bill_no'] . '"');

		$last_ret_id = $this->admin_model->get_last_row2('sh_tbl_lab_return_product', 'buy_sell_bill_no="' . $_POST['bill_no'] . '" AND type=1');

		if ($last_ret_id != null) {
			$data['return_info'] = $this->admin_model->select_join_where('*', 'sh_tbl_lab_return_product r', 'sh_tbl_lab_return_product_det d', 'r.id=d.ret_id', 'r.id="' . $last_ret_id[0]['id'] . '"');

			$data['total_charge'] = $this->admin_model->get_charge_sum_where('charge', 'sh_tbl_lab_return_product', 'buy_sell_bill_no="' . $data['buy_details'][0]['bill_no'] . '"');
		} else {
			$data['return_info'] = null;
		}



		if ($data['buy_details'] != null) {
			$this->load->view('lab_management/lab_in_product/lab_in_return_details', $data);
		}
	}


	public function insert_ret_lab_in_data($value = '')
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Return Lab Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$p_id = $this->input->post("p_id");
		// "<pre>";print_r($p_id);
		$up_qty = $this->input->post("up_qty");
		// "<pre>";print_r($up_qty);die();
		$buy_id = $this->input->post("buy_id");

		$buy_price = $this->input->post("buy_price");

		// "<pre>";print_r($buy_price);

		for ($i = 0; $i < count($p_id); $i++) {

			$current_stock = $this->load->admin_model->select_with_where2('*', 'id="' . $p_id[$i] . '"', 'sh_tbl_lab_product');

			$up_current_stock = $current_stock[0]['p_current_stock'] - $up_qty[$i];


			$val = array('p_current_stock' => $up_current_stock);

			$this->load->admin_model->update_function2('id="' . $p_id[$i] . '"', 'sh_tbl_lab_product', $val);
		}

		// $p_id=$this->uri->segment(4);
		$buy_info = $this->load->admin_model->select_with_where2('*', 'buy_id="' . $buy_id . '"', 'sh_tbl_lab_in_product');

		$last_ret_id = $this->admin_model->get_last_row2('sh_tbl_lab_return_product', 'buy_sell_bill_no="' . $buy_info[0]['bill_no'] . '" AND type=1');
		$ret_data['supp_cust_id'] = $buy_info[0]['supp_id'];
		$ret_data['buy_sell_bill_no'] = $buy_info[0]['bill_no'];
		$ret_data['sell_buy_id'] = $buy_id;
		$ret_data['type'] = 1;
		$ret_data['charge'] = $this->input->post('charge');
		$ret_data['note'] = $this->input->post('note');
		$ret_data['created_at'] = date('Y-m-d H:i:s');


		$ret_id = $this->admin_model->insert_ret('sh_tbl_lab_return_product', $ret_data);

		$up_qty = $this->input->post('up_qty');

		for ($i = 0; $i < count($up_qty); $i++) {

			$bd_data['ret_id'] = $ret_id;
			$bd_data['p_id'] = $p_id[$i];



			if ($last_ret_id != null) {

				$last_ret_qty = $this->load->admin_model->select_with_where2('*', 'p_id="' . $p_id[$i] . '" AND ret_id="' . $last_ret_id[0]['id'] . '"', 'sh_tbl_lab_return_product_det');

				$bd_data['total_qty'] = $up_qty[$i] + $last_ret_qty[0]['total_qty'];
			} else {
				$bd_data['total_qty'] = $up_qty[$i];
			}


			$bd_data['ret_qty'] = $up_qty[$i];
			$bd_data['price'] = $buy_price[$i];
			$bd_data['type'] = 1;
			$bd_data['created_at'] = date('Y-m-d H:i:s');

			$this->admin_model->insert('sh_tbl_lab_return_product_det', $bd_data);
		}

		for ($i = 0; $i < count($p_id); $i++) {

			if ($up_qty[$i] != null) {
				$stock['sell_buy_id'] = $buy_id;
				$stock['p_id'] = $p_id[$i];

				$get_last_val = $this->admin_model->get_last_row('sh_tbl_stock', 'p_id=' . $p_id[$i]);
				$stock['st_open'] = 0;
				if (count($get_last_val) > 0) {
					$stock['st_open'] = $get_last_val[0]['st_close'];
				}

				$stock['st_out'] = $up_qty[$i];
				$stock['st_in'] = 0;
				$stock['st_close'] = $stock['st_open'] - $stock['st_out'];
				$stock['type'] = 3;
				$stock['created_at'] = date('Y-m-d H:i:s');

				$this->admin_model->insert('sh_tbl_stock', $stock);
			}
		}

		redirect("admin/lab_in_return");
	}

	//lab stock

	public function lab_stock()
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Lab Stock Report';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['product_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'sh_tbl_lab_product');
		$this->load->view('lab_management/lab_stock/lab_stocks', $data);
	}


	public function get_lab_stock_chart()
	{
		$p_id = $this->input->post('p_id');

		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');


		if ($p_id == 0) {
			$data['stock_details'] = $this->admin_model->get_lab_stock_report($from_date, $to_date);																																																									// "<pre>";print_r($data['stock_details']);die();
		} else {
			$data['stock_details'] = $this->admin_model->get_lab_stock_report_individual_product($from_date, $to_date, $p_id);
		}

		$this->load->view('lab_management/lab_stock/lab_stock_ajax', $data);
	}


	public function lab_stock_details_pdf($from_date, $to_date, $p_id)
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Lab Stock Product';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		if ($p_id == 0) {
			$data['stock_details'] = $this->admin_model->get_lab_stock_report($from_date, $to_date);
		} else {
			$data['stock_details'] = $this->admin_model->get_lab_stock_report_individual_product($from_date, $to_date, $p_id);
		}


		$this->load->view('lab_management/lab_stock/lab_stock_details_pdf', $data);
	}

	//lab product


	public function lab_product_stock($value = '')
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Product Wise Lab Stock';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];



		$data['product_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'sh_tbl_lab_product');

		$this->load->view('lab_management/lab_stock_product_wise/product_wise_lab_stock', $data);
	}


	public function get_product_lab_stock($value = '')
	{
		$p_id = $_POST["p_id"];
		if ($p_id == 0) {
			$data['stock_details'] = $this->admin_model->select_with_where2('*', 'status=1 ', 'sh_tbl_lab_product');;
		} else {
			$data['stock_details'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $p_id . '"', 'sh_tbl_lab_product');;
		}

		$this->load->view('lab_management/lab_stock_product_wise/product_wise_lab_stock_ajax', $data);
	}

	public function product_wise_lab_stock_details_pdf($p_id)
	{
		$data['active'] = 'product_wise_lab_stock_details_pdf';
		$data['page_title'] = 'Product Wise Lab Stock';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		if ($p_id == 0) {
			$data['stock_details'] = $this->admin_model->select_with_where2('*', 'status=1 ', 'sh_tbl_lab_product');;
		} else {
			$data['stock_details'] = $this->admin_model->select_with_where2('*', 'status=1 AND id="' . $p_id . '"', 'sh_tbl_lab_product');;
		}


		$this->load->view('lab_management/lab_stock_product_wise/product_wise_lab_stock_pdf', $data);
	}

	//company product list



	public function lab_company_stock($value = '')
	{
		$data['active'] = 'lab';
		$data['page_title'] = 'Company Wise Lab Stock';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];


		$data['company_list'] = $this->admin_model->select_with_where2('*', 'status=1', 'company');
		$this->load->view('lab_management/lab_stock_company_wise/company_wise_lab_stock', $data);
	}

	public function get_company_lab_stock($value = '')
	{
		$c_id = $_POST["c_id"];
		if ($c_id == 0) {
			$data['stock_details'] = $this->admin_model->select_join_where('*,p.created_at', 'company c', 'sh_tbl_lab_product p', 'p.p_company_id=c.id', 'p.status=1');;
		} else {
			$data['stock_details'] = $this->admin_model->select_join_where('*,p.created_at', 'company c', 'sh_tbl_lab_product p', 'p.p_company_id=c.id', 'p.status=1 AND p.p_company_id="' . $_POST['c_id'] . '"');
		}

		$this->load->view('lab_management/lab_stock_company_wise/company_wise_lab_stock_ajax', $data);
	}


	public function company_wise_lab_stock_details_pdf($c_id)
	{
		$data['active'] = 'company_wise_stock_details_pdf';
		$data['page_title'] = 'Compnay Wise Stock';
		$data['admin_type'] = $this->session->userdata['logged_in']['role'];

		if ($c_id == 0) {
			$data['stock_details'] = $this->admin_model->select_join_where('*,p.created_at', 'company c', 'sh_tbl_lab_product p', 'p.p_company_id=c.id', 'p.status=1');
		} else {
			$data['stock_details'] = $this->admin_model->select_join_where('*,p.created_at', 'company c', 'sh_tbl_lab_product p', 'p.p_company_id=c.id', 'p.status=1 AND p.p_company_id="' . $c_id . '"');
		}

		$this->load->view('lab_management/lab_stock_company_wise/company_wise_lab_stock_pdf', $data);
	}
	//Lab Management End

	// Shahed Code Ends


}
