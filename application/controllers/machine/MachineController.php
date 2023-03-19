 
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

            redirect(base_url('machine/show'));

            // $this->load->view('machine/show',$data);
            // redirect('MachineController/show','show');
        } else {
            $this->machine();
        }


        // var_dump($data);
    }


    public function show()
    {
        $data['active'] = 'add_report_multi';
        $data['page_title'] = 'Machine Name Show';

        $this->db->select('*');
        $this->db->from('machine');
        $query = $this->db->get();
        $data['machines'] = $query->result_array();

        $this->load->view('machine/show', $data);
    }

    // public function edit($id = ''){
    //     $this->db->where('id', $id);
    //     $query = $this->db->get('machine');
    //     $data['machine'] = $query->result_array();

    //     $this->load->view('machine/edit',$data);

    // }

    public function edit($id = '')
    {
        $data['active'] = 'add_report_multi';
        $data['page_title'] = 'Machine Name Update';
        if ($id === '') {
            show_error('Invalid ID specified');
            return;
        }

        $query = $this->db->get_where('machine', array('id' => $id));

        if ($query->num_rows() === 0) {
            show_error('Machine not found');
            return;
        }

        $data['machine'] = $query->row_array();

        $this->load->view('machine/edit', $data);
    }

    public function update($id)
    {
        $data = array(
            'machine_name' => $this->input->post('machine_name'),
        );
    
        // swap the order of update and where clauses
        $this->db->where('id',$id);
        $this->db->update('machine', $data);
    
        // redirect after the update statement
        redirect(base_url('machine/show'));
    }
    
    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('machine');
        // redirect after the update statement
        redirect(base_url('machine/show'));
    }
}
