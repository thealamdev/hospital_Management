 
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MachineController extends MX_Controller
{
    public function machine()
    {
        $data['active'] = 'add_report_multi';
        $data['page_title'] = 'Machine Name Store';
        $this->load->view('machine/machine', $data);
    }
 

    public function store()
    {
        $this->form_validation->set_rules('machine_name', 'Machine Name', 'required');

        if ($this->form_validation->run() == true) {
            $data = [
                'machine_name' => $this->input->post('machine_name')
            ];

            $this->load->model('machineModel', 'mac');
            $this->mac->insert($data);
            $this->show();
        } else {
            $this->machine();
        }


        // var_dump($data);
    }

    
    public function show()
    {
        $data['active'] = 'add_report_multi';
        $data['page_title'] = 'Machine Name Show';
        
        // $this->db->select('*');
        // $this->db->from('machine');
        // $query = $this->db->get();
        // $data['machines'] = $query->result();
        
        $this->load->view('machine/show', $data);
        
    }
    
}
