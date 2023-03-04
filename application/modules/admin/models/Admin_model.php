<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');  

class Admin_model extends CI_Model 

{

    public function take_second_last_row_patient_timeline($patient_id='')
    {
        $query = $this->db->query("SELECT *  From (select * from patient_timeline where patient_id = $patient_id  ORDER BY id DESC LIMIT 2) AS x                    
            ORDER BY id LIMIT 1;");

       // "<pre>";print_r($query->row()->price);die();
        return $query->result_array();
    }


    ////// Basic Model Function Starts ///////

    public function get_all_role($value='')
    {
     $query = $this->db->query("SELECT *, GROUP_CONCAT(p.display_name) as permission_name FROM permission_role pr join permissions p on pr.permission_id=p.id join role r on r.id=pr.role_id GROUP BY pr.role_id;");

       // "<pre>";print_r($query->row()->price);die();
     return $query->result_array();

 }

 public function get_all_additional_test_comma_join($value='')
 {
     $query=$this->db->query("SELECT *, ds.group_id, GROUP_CONCAT(d.test_title) as test_title FROM diagnostic_test_subgroup ds INNER JOIN diagnostic_test_group d ON FIND_IN_SET(d.test_id, ds.group_id) > 0 where d.status=1 and ds.status=1 and ds.type=2 GROUP BY ds.id");

     return $query->result_array();
 }


 public function select_all_test($table_name)
 {
    $this->db->select('*');
    $this->db->from($table_name);
    $where1 = '(status!=' . 2 . ')';
    $this->db->where($where1);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}

public function select_join_pathology_desc($selector,$table_name,$join_table1,$join_condition1,$join_table2,$join_condition2,$join_table3,$join_condition3)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);     
    $this->db->join($join_table3,$join_condition3);
    $this->db->order_by('pathologoy_id', 'DESC');
    $result=$this->db->get();
    return $result->result_array();
}
public function select_five_join_where($selector,$table_name,$join_table,$join_table2,$join_table3,$join_table4,$join_condition,$join_condition2,$join_condition3,$join_condition4,$condition)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $this->db->join($join_table2,$join_condition2);
    $this->db->join($join_table3,$join_condition3);
    $this->db->join($join_table4,$join_condition4);
        //$this->db->order_by($order_col,$order_action);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}


public function select_five_join_where_group_by($selector,$table_name,$join_table,$join_table2,$join_table3,$join_table4,$join_condition,$join_condition2,$join_condition3,$join_condition4,$condition,$group_selector)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $this->db->join($join_table2,$join_condition2);
    $this->db->join($join_table3,$join_condition3);
    $this->db->join($join_table4,$join_condition4);
        //$this->db->order_by($order_col,$order_action);
    $this->db->group_by($group_selector);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_six_join_where($selector,$table_name,$join_table,$join_table2,$join_table3,$join_table4,$join_table5,$join_condition,$join_condition2,$join_condition3,$join_condition4,$join_condition5,$condition)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $this->db->join($join_table2,$join_condition2);
    $this->db->join($join_table3,$join_condition3);
    $this->db->join($join_table4,$join_condition4);
    $this->db->join($join_table5,$join_condition5);
        //$this->db->order_by($order_col,$order_action);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}


public function select_five_join_where_left($selector,$table_name,$join_table,$join_table2,$join_table3,$join_table4,$join_table5,$join_condition,$join_condition2,$join_condition3,$join_condition4,$join_condition5,$condition)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition,'LEFT');
    $this->db->join($join_table2,$join_condition2,'LEFT');
    $this->db->join($join_table3,$join_condition3,'LEFT');
    $this->db->join($join_table4,$join_condition4,'LEFT');
    $this->db->join($join_table5,$join_condition5,'LEFT');
        //$this->db->order_by($order_col,$order_action);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_six_join_where_left($selector,$table_name,$join_table,$join_table2,$join_table3,$join_table4,$join_table5,$join_table6,$join_condition,$join_condition2,$join_condition3,$join_condition4,$join_condition5,$join_condition6,$condition)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition,'LEFT');
    $this->db->join($join_table2,$join_condition2,'LEFT');
    $this->db->join($join_table3,$join_condition3,'LEFT');
    $this->db->join($join_table4,$join_condition4,'LEFT');
    $this->db->join($join_table5,$join_condition5,'LEFT');
    $this->db->join($join_table6,$join_condition6,'LEFT');
        //$this->db->order_by($order_col,$order_action);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function get_last_row_no_where($table_name,$order_column) 
{
    $this->db->select('*');
    $this->db->from($table_name);
    $this->db->order_by($order_column,"desc");
    $this->db->limit(1);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}

public function get_last_id($selector,$tablename)
{
    $this->db->select_max($selector);
        // $this->db->MAX($selector);
    $this->db->from($tablename);
    $result = $this->db->get();
    return $result->result_array();
}

public function select_with_where_test($selector, $condition, $tablename,$columnname)
{
    $this->db->select($selector);
    $this->db->from($tablename);
    $where1 = '('.$columnname.'='. $condition . ')';
    $this->db->where($where1);
    $where2 = '(status!=' . 2 . ')';
    $this->db->where($where2);
    $result = $this->db->get();
    return $result->result();
}
public function select_two_where_join($selector,$table_name,$join_table,$join_condition,$columnname1,$condition1,$columnname2,$condition2)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $where1 = '('.$columnname1.'='. $condition1 . ')';
    $where2 = '('.$columnname2.'='. $condition2 . ')';
        // $where1 = '(d.status!=' . 2 . ')';
        // $where2 = '(d.test_id=' . $condition . ')';
    $this->db->where($where1);
    $this->db->where($where2);
    $result=$this->db->get();
    return $result->result_array();
}

public function get_last_row2($table_name,$condition)
{
    $this->db->select('*');
    $this->db->from($table_name);
    $where = '(' . $condition . ')';
    $this->db->where($where);
    $this->db->order_by('id',"desc");
    $this->db->limit(1);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}

public function get_last_row3($order_id,$table_name,$condition)
{
    $this->db->select('*');
    $this->db->from($table_name);
    $where = '(' . $condition . ')';
    $this->db->where($where);
    $this->db->order_by($order_id,"DESC");
    $this->db->limit(1);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}

public function get_charge_sum_where($selector,$tablename,$condition)
{
    $this->db->select_sum($selector);
        // $this->db->MAX($selector);
    $this->db->from($tablename);
    $where = '('. $condition .')';
    $this->db->where($where);
    $result = $this->db->get();
    return $result->result_array();
}

public function get_sum_ipd_service($patient_id)
{
 $query = $this->db->query("SELECT sum(price* qty) as price FROM service_details where p_id='".$patient_id."'");

       // "<pre>";print_r($query->row()->price);die();
 return $query->row()->price;
}

public function get_charge_sum_where_group_by($selector,$tablename,$condition,$group_selector)
{
    $this->db->select_sum($selector);
    $this->db->from($tablename);
    $where = '('. $condition .')';
    $this->db->where($where);
    $this->db->group_by($group_selector);
    $result = $this->db->get();
    return $result->result_array();
}


public function get_two_charge_sum_where_group_by_join($selector,$selector1,$selector2,$group_selector,$tablename,$join_table,$join_condition,$condition)
{
    $this->db->select($selector);
    $this->db->select_sum($selector1);
    $this->db->select_sum($selector2);

    $this->db->group_by($group_selector);
    $this->db->from($tablename);
    $this->db->join($join_table,$join_condition);
    $where = '('. $condition .')';
    $this->db->where($where);
    $result = $this->db->get();
    return $result->result_array();
}




public function get_three_charge_sum_where_group_by_join($selector,$selector1,$selector2,$selector3,$group_selector,$tablename,$join_table,$join_condition,$condition)
{
    $this->db->select($selector);
    $this->db->select_sum($selector1);
    $this->db->select_sum($selector2);
    $this->db->select_sum($selector3);

    $this->db->group_by($group_selector);
    $this->db->from($tablename);
    $this->db->join($join_table,$join_condition);
    $where = '('. $condition .')';
    $this->db->where($where);

    $result = $this->db->get();
    return $result->result_array();
}

public function get_three_charge_sum_where_group_by_join_two($selector,$selector1,$selector2,$selector3,$group_selector,$tablename,$join_table,$join_condition,$join_table1,$join_condition1,$condition)
{
    $this->db->select($selector);
    $this->db->select_sum($selector1);
    $this->db->select_sum($selector2);
    $this->db->select_sum($selector3);

    $this->db->group_by($group_selector);
    $this->db->from($tablename);
    $this->db->join($join_table,$join_condition);
    $this->db->join($join_table1,$join_condition1);
    $where = '('. $condition .')';
    $this->db->where($where);

    $result = $this->db->get();
    return $result->result_array();
}

public function get_four_charge_sum_where_group_by_join_two($selector,$selector1,$selector2,$selector3,$selector4,$group_selector,$tablename,$join_table,$join_condition,$join_table1,$join_condition1,$condition)
{
    $this->db->select($selector);
    $this->db->select_sum($selector1);
    $this->db->select_sum($selector2);
    $this->db->select_sum($selector3);
    $this->db->select_sum($selector4);

    $this->db->group_by($group_selector);
    $this->db->from($tablename);
    $this->db->join($join_table,$join_condition);
    $this->db->join($join_table1,$join_condition1);
    $where = '('. $condition .')';
    $this->db->where($where);

    $result = $this->db->get();
    return $result->result_array();
}



public function get_three_charge_sum_where_group_by_three_join($selector,$selector1,$selector2,$selector3,$group_selector,$tablename,$join_table,$join_condition,$join_table1,$join_condition1,$join_table2,$join_condition2,$condition)
{
    $this->db->select($selector);
    $this->db->select_sum($selector1);
    $this->db->select_sum($selector2);
    $this->db->select_sum($selector3);

    $this->db->group_by($group_selector);
    $this->db->from($tablename);
    $this->db->join($join_table,$join_condition);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);
    $where = '('. $condition .')';
    $this->db->where($where);

    $result = $this->db->get();
    return $result->result_array();
}

public function get_charge_sum_where_group_by_join($selector,$sum_selector,$tablename,$condition,$group_by_selector,$join_table,$join_condition)
{
    $this->db->select($selector);
    $this->db->select_sum($sum_selector);
    $this->db->join($join_table,$join_condition);
        // $this->db->MAX($selector);
    $this->db->from($tablename);
    $where = '('. $condition .')';
    $this->db->where($where);
    $this->db->group_by($group_by_selector);
    $result = $this->db->get();
    return $result->result_array();
}

public function get_charge_sum_where_join($selector,$sum_selector,$tablename,$condition,$join_table,$join_condition)
{
    $this->db->select($selector);
    $this->db->select_sum($sum_selector);
    $this->db->join($join_table,$join_condition);
        // $this->db->MAX($selector);
    $this->db->from($tablename);
    $where = '('. $condition .')';
    $this->db->where($where);
    // $this->db->group_by($group_by_selector);
    $result = $this->db->get();
    return $result->result_array();
}

public function get_charge_sum_where_join_no_selector($sum_selector,$tablename,$condition,$join_table,$join_condition)
{
    $this->db->select_sum($sum_selector);
    $this->db->join($join_table,$join_condition);
        // $this->db->MAX($selector);
    $this->db->from($tablename);
    $where = '('. $condition .')';
    $this->db->where($where);
    // $this->db->group_by($group_by_selector);
    $result = $this->db->get();
    return $result->result_array();
}



public function get_charge_sum_where_group_by_two_join($selector,$sum_selector,$tablename,$condition,$group_by_selector,$join_table1,$join_condition1,$join_table2,$join_condition2)
{
    $this->db->select($selector);
    $this->db->select_sum($sum_selector);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);
        // $this->db->MAX($selector);
    $this->db->from($tablename);
    $where = '('. $condition .')';
    $this->db->where($where);
    $this->db->group_by($group_by_selector);
    $result = $this->db->get();
    return $result->result_array();
}


public function get_charge_sum_where_group_by_four_join($selector,$sum_selector,$tablename,$condition,$group_by_selector,$join_table1,$join_condition1,$join_table2,$join_condition2,$join_table3,$join_condition3,$join_table4,$join_condition4)
{
    $this->db->select($selector);
    $this->db->select_sum($sum_selector);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);
    $this->db->join($join_table3,$join_condition3);
    $this->db->join($join_table4,$join_condition4);
        // $this->db->MAX($selector);
    $this->db->from($tablename);
    $where = '('. $condition .')';
    $this->db->where($where);
    $this->db->group_by($group_by_selector);
    $result = $this->db->get();
    return $result->result_array();
}


public function select_join_three_table($selector,$table_name,$join_table1,$join_table2,$join_condition1,$join_condition2,$columnname1,$condition1,$columnname2,$condition2)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);
        // $where1 = '(d.status!=' . 2 . ')';
        // $where2 = '(ds.id=' . $condition . ')';
    $where1 = '('.$columnname1.'='. $condition1 . ')';
    $where2 = '('.$columnname2.'='. $condition2 . ')';
    $this->db->where($where1);
    $this->db->where($where2);
    $result=$this->db->get();
    return $result->result_array();
}



public function select_join_four_table($selector,$table_name,$join_table1,$join_table2,$join_table3,$join_condition1,$join_condition2,$join_condition3,$columnname1,$condition1,$columnname2,$condition2)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);

    $this->db->join($join_table3,$join_condition3);
        // $where1 = '(d.status!=' . 2 . ')';
        // $where2 = '(ds.id=' . $condition . ')';
    $where1 = '('.$columnname1.'='. $condition1 . ')';
    $where2 = '('.$columnname2.'='. $condition2 . ')';
    $this->db->where($where1);
    $this->db->where($where2);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_four_table2($selector,$table_name,$join_table1,$join_table2,$join_table3,$join_condition1,$join_condition2,$join_condition3,$condition)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);

    $this->db->join($join_table3,$join_condition3);
    $where = '('. $condition .')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_four_table2_limit_order($selector,$table_name,$join_table1,$join_table2,$join_table3,$join_condition1,$join_condition2,$join_condition3,$condition,$order_by)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);

    $this->db->join($join_table3,$join_condition3);
    $this->db->limit(5,0);
    $this->db->order_by($order_by,"desc");
    $where = '('. $condition .')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}



public function select_join_pathology($selector,$table_name,$join_table1,$join_condition1,$join_table2,$join_condition2,$join_table3,$join_condition3)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);     
    $this->db->join($join_table3,$join_condition3);
    $result=$this->db->get();
    return $result->result_array();
}

public function get_rlease_row($selector,$tablename,$condition)
{
    $this->db->select($selector);
        // $this->db->MAX($selector);
    $this->db->from($tablename);
    $where = '('.$condition .')';
    $this->db->where($where);
    $result = $this->db->get();
    return $result->result_array();
}

    // **************** Opd Model Starts ***************//


public function insert($tablename,$data)
{
    $this->db->insert($tablename,$data);
}
public function check_row($selector,$condition,$tablename) 
{
    $this->db->select('*');
    $this->db->from($tablename);
    $where = '('.$condition .')';
    $this->db->where($where);
    $query = $this->db->get();
    if ($query->num_rows()>0) {
        return true;
    } else {
        return false;
    }
}


// DataTable one table starts

function make_query($table,$condition,$select_column,$order_column,$search_column,$order_by)  
{  

    $this->db->select($select_column);  
    $this->db->from($table);  

    $where =$condition;
    

    if(isset($_POST["search"]["value"]))  
    {  
     $this->db->group_start();
     foreach ($search_column as $key => $value) {

        if($key < 1)
        {
            $this->db->like($value, $_POST["search"]["value"]);  

        }
        else
        {

            $this->db->or_like($value, $_POST["search"]["value"]);  
        }

    }

    $this->db->group_end();
    $this->db->where($where); 
}  
if(isset($_POST["order"]))  
{  

    $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
}  
else  
{  

    $this->db->order_by($order_by, 'DESC');  
}  


}  

function make_datatables($table,$condition,$select_column,$order_column,$search_column,$order_by){   
 $this->make_query($table,$condition,$select_column,$order_column,$search_column,$order_by);  
 if($_POST["length"] != -1)  
 {  
    $this->db->limit($_POST['length'], $_POST['start']);  
}   

$query = $this->db->get();  
return $query->result();  
}  
function get_filtered_data($table,$condition,$select_column,$order_column,$search_column,$order_by){  
 $this->make_query($table,$condition,$select_column,$order_column,$search_column,$order_by);  

 $query = $this->db->get();  
 return $query->num_rows();  
}       
function get_all_data($selector,$table,$condition)  
{  
    $where = '('.$condition .')';
    $this->db->select($selector);  
    $this->db->from($table);
    $this->db->where($where);  
    return $this->db->count_all_results();  
}

// DataTable one table Ends  


// DataTable two table starts

function make_query_two_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$order_by)  
{  

    $this->db->select($select_column);  
    $this->db->from($table);
    $this->db->join($join_table,$join_condition,'LEFT');  

    $where = '('.$condition.')';


    if(isset($_POST["search"]["value"]))  
    {  

        $this->db->group_start();
        foreach ($search_column as $key => $value) {

            if($key < 1)
            {

                $this->db->like($value, $_POST["search"]["value"]);  

            }
            else
            {


                $this->db->or_like($value, $_POST["search"]["value"]);  
            }

        }

        $this->db->group_end();
        $this->db->where($where);

    }

    if(isset($_POST["order"]))  
    {  

        $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
    }  
    else  
    {  
            // $this->db->where($where); 
        $this->db->order_by($order_by, 'DESC');  
    }  


    

}  

function make_datatables_two_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$order_by){   
 $this->make_query_two_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$order_by);  
 if($_POST["length"] != -1)  
 {  
    $this->db->limit($_POST['length'], $_POST['start']);  
}   

$query = $this->db->get();  
return $query->result();  
}  
function get_filtered_data_two_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$order_by){  
 $this->make_query_two_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$order_by);  

 $query = $this->db->get();  
 return $query->num_rows();  
}       
function get_all_data_two_table_join($table,$condition,$select_column,$join_table,$join_condition)  
{  
    $where = '('.$condition .')';
    $this->db->select($select_column);  
    $this->db->from($table);
    $this->db->join($join_table,$join_condition,'LEFT');  
    $this->db->where($where);  
    return $this->db->count_all_results();  
}



// DataTable Two table Ends 


// DataTable three table join starts

function make_query_three_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$join_table1,$join_condition1,$order_by)  
{  

   $this->db->select($select_column);  
   $this->db->from($table);
   $this->db->join($join_table,$join_condition);  
   $this->db->join($join_table1,$join_condition1);  

   $where = '('.$condition.')';


   if(isset($_POST["search"]["value"]))  
   {  

    $this->db->group_start();
    foreach ($search_column as $key => $value) {

        if($key < 1)
        {

            $this->db->like($value, $_POST["search"]["value"]);  

        }
        else
        {


            $this->db->or_like($value, $_POST["search"]["value"]);  
        }
    }

    $this->db->group_end();
    $this->db->where($where);

}

if(isset($_POST["order"]))  
{  
    $this->db->where($where); 
    $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
}  
else  
{  
            // $this->db->where($where); 
    $this->db->order_by($order_by, 'DESC');  
}  




}  

function make_datatables_three_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$join_table1,$join_condition1,$order_by){

 $this->make_query_three_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$join_table1,$join_condition1,$order_by);  
 if($_POST["length"] != -1)  
 {  
    $this->db->limit($_POST['length'], $_POST['start']);  
}   

$query = $this->db->get();  
return $query->result();  
}  
function get_filtered_data_three_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$join_table1,$join_condition1,$order_by){

 $this->make_query_three_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$join_table1,$join_condition1,$order_by);  

 $query = $this->db->get();  
 return $query->num_rows();  
}       
function get_all_data_three_table_join($table,$condition,$selector,$join_table,$join_condition,$join_table1,$join_condition1)  
{  
    $where = '('.$condition .')';
    $this->db->select($selector);  
    $this->db->from($table);
    $this->db->join($join_table,$join_condition);  
    $this->db->join($join_table1,$join_condition1);  
    $this->db->where($where);  
    return $this->db->count_all_results();  
}  

// DataTable three table join Ends


// DataTable Four table join starts

function make_query_four_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$join_table1,$join_condition1,$join_table2,$join_condition2,$order_by)  
{  

    $this->db->select($select_column);  
    $this->db->from($table);
    $this->db->join($join_table,$join_condition,'LEFT');  
    $this->db->join($join_table1,$join_condition1,'LEFT');    
    $this->db->join($join_table2,$join_condition2,'LEFT');    


    $where = '('.$condition .')';


    if(isset($_POST["search"]["value"]))  
    {  

        $this->db->group_start();


        foreach ($search_column as $key => $value) {

            if($key < 1)
            {
                $this->db->like($value, $_POST["search"]["value"]);  

            }
            else
            {


                $this->db->or_like($value, $_POST["search"]["value"]);  
            }
            
        }

        $this->db->group_end();
        $this->db->where($where); 

        
    }  
    if(isset($_POST["order"]))  
    {  
        $this->db->where($where); 
        $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
    }  
    else  
    {  
        $this->db->where($where); 
        $this->db->order_by($order_by, 'DESC');  
    }  


}  

function make_datatables_four_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$join_table1,$join_condition1,$join_table2,$join_condition2,$order_by){   
 $this->make_query_four_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$join_table1,$join_condition1,$join_table2,$join_condition2,$order_by);  

 if($_POST["length"] != -1)  
 {  
    $this->db->limit($_POST['length'], $_POST['start']);  
}   

$query = $this->db->get();  
return $query->result();  
}  



function get_filtered_data_four_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$join_table1,$join_condition1,$join_table2,$join_condition2,$order_by){  

 $this->make_query_four_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$join_table1,$join_condition1,$join_table2,$join_condition2,$order_by);  

 $query = $this->db->get();  
 return $query->num_rows();  
}   


function get_all_data_four_table_join($table,$condition,$select_column,$join_table,$join_condition,$join_table1,$join_condition1,$join_table2,$join_condition2)  
{  
    $where = '('.$condition .')';
    $this->db->select($select_column);  
    $this->db->from($table);
    $this->db->join($join_table,$join_condition);  
    $this->db->join($join_table1,$join_condition1);    
    $this->db->join($join_table2,$join_condition2); 

    $this->db->where($where);  
    return $this->db->count_all_results();  
}  

// DataTable Four table join Ends


// DataTable Five table join starts

function make_query_five_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$join_table1,$join_condition1,$join_table2,$join_condition2,$join_table3,$join_condition3,$order_by)  
{  

 $this->db->select($select_column);  
 $this->db->from($table);
 $this->db->join($join_table,$join_condition,'LEFT');  
 $this->db->join($join_table1,$join_condition1,'LEFT');    
 $this->db->join($join_table2,$join_condition2,'LEFT');    
 $this->db->join($join_table3,$join_condition3,'LEFT');    


 $where = '('.$condition .')';


 if(isset($_POST["search"]["value"]))  
 {  

    $this->db->group_start();


    foreach ($search_column as $key => $value) {

        if($key < 1)
        {
            $this->db->like($value, $_POST["search"]["value"]);  

        }
        else
        {


            $this->db->or_like($value, $_POST["search"]["value"]);  
        }

    }

    $this->db->group_end();
    $this->db->where($where); 


}  
if(isset($_POST["order"]))  
{  
    $this->db->where($where); 
    $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
}  
else  
{  
    $this->db->where($where); 
    $this->db->order_by($order_by, 'DESC');  
}  



}  

function make_datatables_five_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$join_table1,$join_condition1,$join_table2,$join_condition2,$join_table3,$join_condition3,$order_by){   
 $this->make_query_five_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$join_table1,$join_condition1,$join_table2,$join_condition2,$join_table3,$join_condition3,$order_by);

 if($_POST["length"] != -1)  
 {  
    $this->db->limit($_POST['length'], $_POST['start']);  
}   

$query = $this->db->get();  
return $query->result();  
}  


function get_filtered_data_five_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$join_table1,$join_condition1,$join_table2,$join_condition2,$join_table3,$join_condition3,$order_by){  
 $this->make_query_five_table_join($table,$condition,$select_column,$order_column,$search_column,$join_table,$join_condition,$join_table1,$join_condition1,$join_table2,$join_condition2,$join_table3,$join_condition3,$order_by);  

 $query = $this->db->get();  
 return $query->num_rows();  
}  


function get_all_data_five_table_join($table,$condition,$select_column,$join_table,$join_condition,$join_table1,$join_condition1,$join_table2,$join_condition2,$join_table3,$join_condition3)  
{  
   $where = '('.$condition .')';
   $this->db->select($select_column);  
   $this->db->from($table);
   $this->db->join($join_table,$join_condition);  
   $this->db->join($join_table1,$join_condition1);    
   $this->db->join($join_table2,$join_condition2); 
   $this->db->join($join_table3,$join_condition3); 

   $this->db->where($where);  
   return $this->db->count_all_results();  
}  

// DataTable Five table join Ends





function update_data($user_id, $data)  
{  
 $this->db->where("id", $user_id);  
 $this->db->update("test", $data);  
}  
function fetch_single_user($user_id)  
{  
 $this->db->where("id", $user_id);  
 $query=$this->db->get('test');  
 return $query->result();  
}  
function delete_single_user($user_id)  
{  
  $data=array('content_type' =>2);
  $this->db->where("id", $user_id);  
  $this->db->update("test",$data);  

}  

public function insert_ret($tablename, $tabledata)
{
    $this->db->insert($tablename, $tabledata);
    return $this->db->insert_id();
}

public function update_function($columnName, $columnVal, $tableName, $data)
{
    $this->db->where($columnName, $columnVal);
    $this->db->update($tableName, $data);
}
public function update_function2($condition, $tableName, $data)
{
   $where = '( ' . $condition . ' )';
   $this->db->where($where);
   $this->db->update($tableName, $data);
}


public function delete_function_cond($tableName, $cond)
{
    $where = '( ' . $cond . ' )';
    $this->db->where($where);
    $this->db->delete($tableName);
}
public function delete_function($tableName, $columnName, $columnVal)
{
    $this->db->where($columnName, $columnVal);
    $this->db->delete($tableName);
}

public function select_all($table_name)
{
    $this->db->select('*');
    $this->db->from($table_name);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}

public function select_all_decending($table_name)
{
    $this->db->select('*');
    $this->db->from($table_name);
    $this->db->order_by('created_at','DESC');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}

public function select_all_acending($table_name,$col_name)
{
    $this->db->select('*');
    $this->db->from($table_name);
    $this->db->order_by($col_name,'ASC');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}

public function select_condition_decending($table_name,$condition)
{
    $this->db->select('*');
    $this->db->from($table_name);
    $where = '(' . $condition . ')';
    $this->db->where($where);
    $this->db->order_by('created_at','DESC');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}


public function select_with_where($selector, $condition, $tablename,$columnname)
{
    $this->db->select($selector);
    $this->db->from($tablename);
    $where = '('.$columnname.'='. $condition . ')';
    $this->db->where($where);
    $result = $this->db->get();
    return $result->result_array();
}

public function select_with_where_two_sum($selector, $sum_selector1,$sum_selector2,$condition, $tablename)
{
    $this->db->select($selector);
    $this->db->select_sum($sum_selector1);
    $this->db->select_sum($sum_selector2);
    $this->db->from($tablename);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $result = $this->db->get();
    return $result->result_array();
}

public function select_with_where_group_by($selector, $condition, $tablename,$group_by_selector)
{
    $this->db->select($selector);
    $this->db->from($tablename);
    $where = '('. $condition . ')';
    $this->db->where($where);
    $this->db->group_by($group_by_selector);
    $result = $this->db->get();
    return $result->result_array();
}

public function select_with_where_opd_patient($selector,$condition,$tablename,$columnname)
{
    $this->db->select($selector);
    $this->db->from($tablename);
    $where = '('.$columnname.'='. $condition . ')';
    $this->db->where($where);
    $this->db->order_by('id','DESC');
    $result = $this->db->get();
    return $result->result_array();
}


public function select_with_where2($selector, $condition, $tablename)
{
    $this->db->select($selector);
    $this->db->from($tablename);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $result = $this->db->get();
    return $result->result_array();
}

public function select_with_where2_limit_order($selector, $condition, $tablename,$order_by)
{
    $this->db->select($selector);
    $this->db->from($tablename);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $this->db->order_by('id','DESC');
    $this->db->limit('5','0');
    $result = $this->db->get();
    return $result->result_array();
}


public function select_with_where2_group_by($selector, $condition, $tablename,$group_by_selector)
{
    $this->db->select($selector);
    $this->db->from($tablename);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $this->db->group_by($group_by_selector);
    $result = $this->db->get();
    return $result->result_array();
}
public function select_with_where_monthly()
{
    $SQL="select  * from opd_patient_info where date_format(created_at,'%m')=date_format(now(),'%m')";
    echo $SQL;
    $query = $this->db->query($SQL);
    return $query->result_array();

}

public function select_daywise_opd_report($sdate,$edate)
{


    $sql="select diagnostic_test_subgroup.id,count(diagnostic_test_subgroup.id)as total_test,sub_test_title,
    sub_test_price,quk_ref_com,(sub_test_price*count(diagnostic_test_subgroup.id))as total_price,
    (quk_ref_com*count(diagnostic_test_subgroup.id))as total_price_qc
    from opd_patient_test_details_info
    inner join diagnostic_test_subgroup on opd_patient_test_details_info.patient_sub_test_id=diagnostic_test_subgroup.id
    where  date_format(opd_patient_test_details_info.created_at,'%Y-%m-%d') between '$sdate' and '$edate'
    group by diagnostic_test_subgroup.id";

    $query = $this->db->query($sql);
    return $query->result_array();


}
public function select_daywise_ipd_operation_report($sdate,$edate,$operation_title)
{

  if($operation_title==0)
  {
    $sql="select count(operation_id) as cnt,operation_id,operation_cost,total,advance,due,operation_name,discount,date_format(operation_patient_list.created_at,'%Y-%m-%d') as cdate
    from operation_patient_list 
    inner join operation_info on operation_info.id=operation_patient_list.operation_id
    where date_format(operation_patient_list.created_at,'%Y-%m-%d') between '$sdate' and '$edate'
    group by operation_id";
}
else
{
    $sql="select count(operation_id) as cnt,operation_id,operation_cost,total,advance,due,operation_name,discount ,date_format(operation_patient_list.created_at,'%Y-%m-%d') as cdate
    from operation_patient_list=$operation_title
    inner join operation_info on operation_info.id=operation_patient_list.operation_id
    where date_format(operation_patient_list.created_at,'%Y-%m-%d') between '$sdate' and '$edate'
    and operation_id=$operation_title
    group by operation_id";   
}

$query = $this->db->query($sql);
return $query->result_array();


}

public function select_daywise_ipd_service_report($sdate,$edate,$service_title)
{

  if($service_title==0)
  {
    $sql="select count(service_id) as cnt,service_id,service_cost,total,advance,due,service_name,
    date_format(service_patient_list.created_at,'%Y-%m-%d') as cdate,discount
    from service_patient_list 
    inner join service_info on service_info.id=service_patient_list.sid
    where date_format(service_patient_list.created_at,'%Y-%m-%d') between '$sdate' and '$edate'
    group by service_id
    ";
}
else
{   

    $sql=" select count(service_id) as cnt,service_id,service_cost,total,advance,due,service_name,
    date_format(service_patient_list.created_at,'%Y-%m-%d') as cdate,discount
    from service_patient_list 
    inner join service_info on service_info.id=service_patient_list.sid
    where date_format(service_patient_list.created_at,'%Y-%m-%d') between '$sdate' and '$edate'
    and  service_id=$service_title
    group by service_id";   
}

$query = $this->db->query($sql);
return $query->result_array();


}

public function select_with_where2_decending($selector, $condition, $tablename,$order_col)
{
    $this->db->select($selector);
    $this->db->from($tablename);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $this->db->order_by($order_col,'DESC');
    $result = $this->db->get();
    return $result->result_array();
}
public function select_three_join($selector,$table_name,$join_table,$join_condition,$join_table2,$join_condition2)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $this->db->join($join_table2,$join_condition2);
        //$this->db->order_by($order_col,$order_action);
    $result=$this->db->get();
    return $result->result_array();
}
public function select_three_join_where($selector,$table_name,$join_table,$join_condition,$join_table2,$join_condition2,$condition)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $this->db->join($join_table2,$join_condition2);
        //$this->db->order_by($order_col,$order_action);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_three_join_where_limit($selector,$table_name,$join_table,$join_condition,$join_table2,$join_condition2,$condition)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $this->db->join($join_table2,$join_condition2);
        //$this->db->order_by($order_col,$order_action);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $this->db->limit(1);
    $result=$this->db->get();
    return $result->result_array();
}
public function select_with_where_condition_two($selector, $condition1, $tablename,$columnname1,$condition2,$columnname2)
{
    $this->db->select($selector);
    $this->db->from($tablename);
    $where1 = '('.$columnname1.'='. $condition1 . ')';
    $where2 = '('.$columnname2.'='. $condition2 . ')';
    $this->db->where($where1);
    $this->db->where($where2);
    $result = $this->db->get();
    return $result->result_array();
}

public function select_join($selector,$table_name,$join_table,$join_condition)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_where($selector,$table_name,$join_table,$join_condition,$condition)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_where_left($selector,$table_name,$join_table,$join_condition,$condition)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition,'LEFT');
    $where = '('.$condition . ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_where_sample_tag($selector,$table_name,$join_table,$join_condition,$condition,$id_list)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $this->db->where_in('o.id',$id_list);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_where_five_sum_one_group_by($sum_selector1,$sum_selector2,$sum_selector3,$sum_selector4,$sum_selector5,$selector,$table_name,$join_table,$join_condition,$condition,$group_by_selector)
{
    $this->db->select($selector);
    $this->db->select_sum($sum_selector1);
    $this->db->select_sum($sum_selector2);
    $this->db->select_sum($sum_selector3);
    $this->db->select_sum($sum_selector4);
    $this->db->select_sum($sum_selector5);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $this->db->group_by($group_by_selector);
    $result=$this->db->get();
    return $result->result_array();
}



public function select_join_where_group_by($selector,$table_name,$join_table,$join_condition,$condition,$group_by)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $this->db->group_by($group_by);
    $result=$this->db->get();
    return $result->result_array();
}



public function select_join_where_order($selector,$table_name,$join_table,$join_condition,$condition,$order_column,$order)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $this->db->order_by($order_column, $order);
    $result=$this->db->get();
    return $result->result_array();
}




public function select_one_where_join($selector,$table_name,$join_table,$join_condition,$columnname,$condition)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $where = '('.$columnname.'=' .$condition.')';
    $this->db->where($where);
        //$this->db->order_by($order_col,$order_action);
    $result=$this->db->get();
    return $result->result_array();
}
public function select_three_where_join($selector,$table_name,$join_table,$join_condition,$columnname1,$condition1,$columnname2,$condition2,$columnname3,$condition3)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $where1 = '('.$columnname1.'=' .$condition1.')';
    $where2 = '('.$columnname2.'=' .$condition2.')';
    $where3 = '('.$columnname3.'=' .$condition3.')';


    $this->db->where($where1);
    $this->db->where($where2);
    $this->db->where($where3);

    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_three_table2($selector,$table_name,$join_table1,$join_table2,$join_condition1,$join_condition2,$condition)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);
    $where = '('.$condition.')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_three_order_table2($selector,$table_name,$join_table1,$join_table2,$join_condition1,$join_condition2,$condition,$order_col,$order_action)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);
    $where = '('.$condition.')';
    $this->db->where($where);
    $this->db->order_by($order_col,$order_action);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_three_table2_left($selector,$table_name,$join_table1,$join_table2,$join_condition1,$join_condition2,$condition)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1,'LEFT');
    $this->db->join($join_table2,$join_condition2,'LEFT');
    $where = '('.$condition.')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_three_table2_left_group_by($selector,$table_name,$join_table1,$join_table2,$join_condition1,$join_condition2,$condition,$group_by_selector)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1,'LEFT');
    $this->db->join($join_table2,$join_condition2,'LEFT');
    $where = '('.$condition.')';
    $this->db->where($where);
    $this->db->group_by($group_by_selector);
    $result=$this->db->get();
    return $result->result_array();
}




public function select_join_three_table2_no_where($selector,$table_name,$join_table1,$join_table2,$join_condition1,$join_condition2)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);

    $result=$this->db->get();
    return $result->result_array();
}
public function select_four_where_join($selector,$table_name,$join_table,$join_condition,$columnname1,$condition1,$columnname2,$condition2,$columnname3,$condition3,$columnname4,$condition4)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $where1 = '('.$columnname1.'=' .$condition1.')';
    $where2 = '('.$columnname2.'=' .$condition2.')';
    $where3 = '('.$columnname3.'=' .$condition3.')';
    $where4 = '('.$columnname4.'=' .$condition4.')';

    $this->db->where($where1);
    $this->db->where($where2);
    $this->db->where($where3);
    $this->db->where($where4);
        //$this->db->order_by($order_col,$order_action);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_four_join_where($selector,$table_name,$join_table,$join_table2,$join_table3,$join_condition,$join_condition2,$join_condition3,$condition)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $this->db->join($join_table2,$join_condition2);
    $this->db->join($join_table3,$join_condition3);
        //$this->db->order_by($order_col,$order_action);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_order($selector,$table_name,$join_table,$join_condition,$order_column,$order)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $this->db->order_by($order_column,$order);
    $result=$this->db->get();
    return $result->result_array();
}
public function select_join_order_where($selector,$table_name,$join_table,$join_condition,$order_column,$condition,$order)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $this->db->order_by($order_column,$order);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_where_left_join($selector,$table_name,$join_table,$join_condition,$condition)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition,'LEFT');
    $where = '(' . $condition . ')';
    $this->db->where($where);
        //$this->db->order_by($order_col,$order_action);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_where_left_join_order($selector,$table_name,$join_table,$join_condition,$condition, $order_col, $order_action)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition,'LEFT');
    $where = '(' . $condition . ')';
    $this->db->where($where);
    $this->db->order_by($order_col,$order_action);
    $result=$this->db->get();
    return $result->result_array();
}


public function select_where_right_join_group_by($selector,$table_name,$join_table,$join_condition,$condition,$group_by_selector)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition,'RIGHT');
    $where = '(' . $condition . ')';
    $this->db->where($where);
    $this->db->group_by($group_by_selector);
    $result=$this->db->get();
    return $result->result_array();
}


public function select_where_right_join($selector,$table_name,$join_table,$join_condition,$condition)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition,'RIGHT');
    $where = '(' . $condition . ')';
    $this->db->where($where);
        // $this->db->group_by($group_by_selector);
    $result=$this->db->get();
    return $result->result_array();
}



public function select_where_left_join_loop($selector,$table_name,$join_table,$join_condition,$join_table2,$join_condition2,$condition)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition,'LEFT');
    $this->db->join($join_table2,$join_condition2,'LEFT');
    $where = '(' . $condition . ')';
    $this->db->where($where);
        //$this->db->order_by($order_col,$order_action);
    $result=$this->db->get();
    return $result->result_array();
}
    ////// Basic Model Function End ///////




public function columns($database, $table)
{
        //$query = "SELECT COLUMN_NAME, DATA_TYPE, IS_NULLABLE, COLUMN_DEFAULT, COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS  WHERE table_name = '$table'AND table_schema = '$database'";  
    $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE table_name = '$table'
    AND table_schema = '$database'";    
    $result = $this->db->query($query) or die ("Schema Query Failed"); 
    $result=$result->result_array();
    return $result;
}

// For access menu and submenu
public function get_menu_list($login_id)
{
    $this->db->select('*');
    $this->db->from('menu_for_admin');
    $this->db->where('menu_for_admin.user_id',$login_id); 
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}

public function get_sub_menu_list($login_id)
{
    $this->db->select('*');
    $this->db->from('sub_menu_for_admin');
    $this->db->where('sub_menu_for_admin.user_id',$login_id); 
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}


// For access menu and submenu

public function get_due_list($selector,$table_name,$join_table,$join_condition,$join_table2,$join_condition2,$group_by,$condition)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition,'LEFT');
    $this->db->join($join_table2,$join_condition2,'LEFT');
    $this->db->group_by($group_by); 
    $where = '(' . $condition . ')';
    $this->db->where($where);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}

// For BUY and SELL details
public function sell_details($sell_id)
{
    $this->db->select('*,sell.created_at as sell_date');
    $this->db->from('sell');
    $this->db->join('sell_details','sell_details.sell_id=sell.sell_id','LEFT');
    $this->db->join('customer','sell.cust_id=customer.cust_id','LEFT');
    $this->db->join('product','sell_details.p_id=product.p_id','LEFT');
    $this->db->join('unit','product.p_unit_id=unit.unit_id','LEFT');
    $this->db->where('sell.sell_id',$sell_id); 
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}


public function buy_details($buy_id)
{
    $this->db->select('*,buy.created_at as buy_date');
    $this->db->from('buy');
    $this->db->join('buy_details','buy_details.buy_id=buy.buy_id','LEFT');
    $this->db->join('supplier','buy.supp_id=supplier.supp_id','LEFT');
    $this->db->join('product','buy_details.p_id=product.p_id','LEFT');
    $this->db->join('unit','product.p_unit_id=unit.unit_id','LEFT');
    $this->db->where('buy.buy_id',$buy_id); 
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}

// For BUY and SELL details
// For header nav notification 
public function check_product_alert()
{
    $this->db->select('*');
    $this->db->from('product');
    $this->db->where('p_alert_qty > p_qty'); 
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}

// For header nav notification End

// Index page bar chart
public function get_monthly_report_for_chart($selector,$table_name,$group_by)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->group_by($group_by);  
    $result=$this->db->get();
    return $result->result_array();
}


// For daily Report
public function get_daily_report_info($selector,$table_name,$join_table,$join_condition,$join_type,$like_col,$like_val)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition,$join_type);
        // $where = '(' . $condition . ')';
        // $this->db->where($where);
    $this->db->like($like_col, $like_val, 'after');  
    $result=$this->db->get();
    return $result->result_array();
}

// For monthly and yearly report
public function get_monthly_report_info($selector,$table_name,$join_table,$join_condition,$join_type,$like_col,$like_val,$like_type,$group_by_val)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition,$join_type);
        // $where = '(' . $condition . ')';
        // $this->db->where($where);
    $this->db->like($like_col, $like_val, $like_type);  
    $this->db->group_by($group_by_val);  
    $result=$this->db->get();
    return $result->result_array();
}

public function get_report_info_group($selector,$table_name,$join_table,$join_condition,$join_type,$like_col,$like_val,$like_type,$group_name)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition,$join_type);
        // $where = '(' . $condition . ')';
        // $this->db->where($where);
    $this->db->like($like_col, $like_val, $like_type);  
    $this->db->group_by($group_name);  
    $result=$this->db->get();
    return $result->result_array();
}

public function count_amount($selector,$table_name,$like_col, $like_val, $like_type,$group_name)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->like($like_col, $like_val, $like_type);
    $this->db->group_by($group_name);   
    $result=$this->db->get();
    return $result->result_array();
}


public function get_last_buy_code()
{
    $this->db->select('buy_code');
    $this->db->from('buy');
    $this->db->order_by('buy_id',"desc");
    $this->db->limit(1);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}

public function get_last_row($table_name,$condition)
{
    $this->db->select('*');
    $this->db->from($table_name);
    $where = '(' . $condition . ')';
    $this->db->where($where);
    $this->db->order_by('created_at',"desc");
    $this->db->limit(1);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}

public function get_last_sell_code()
{
    $this->db->select('sell_code');
    $this->db->from('sell');
    $this->db->order_by('sell_id',"desc");
    $this->db->limit(1);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}
public function select_join_five_table2($selector,$table_name,$join_table1,$join_table2,$join_table3,$join_table4,$join_condition1,$join_condition2,$join_condition3,$join_condition4,$condition)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);

    $this->db->join($join_table3,$join_condition3);
    $this->db->join($join_table4,$join_condition4);
        // $where1 = '(d.status!=' . 2 . ')';
        // $where2 = '(ds.id=' . $condition . ')';
    $where= '('. $condition. ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_five_table2_group_by($selector,$table_name,$join_table1,$join_table2,$join_table3,$join_table4,$join_condition1,$join_condition2,$join_condition3,$join_condition4,$condition,$group_selector)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);

    $this->db->join($join_table3,$join_condition3);
    $this->db->join($join_table4,$join_condition4);
    $where= '('. $condition. ')';
    $this->db->where($where);
    $this->db->group_by($group_selector);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_five_table2_group_by_sum($selector,$selector_sum1,$table_name,$join_table1,$join_table2,$join_table3,$join_table4,$join_condition1,$join_condition2,$join_condition3,$join_condition4,$condition,$group_selector)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->select_sum($selector_sum1);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);

    $this->db->join($join_table3,$join_condition3);
    $this->db->join($join_table4,$join_condition4);
    $where= '('. $condition. ')';
    $this->db->where($where);
    $this->db->group_by($group_selector);
    $result=$this->db->get();
    return $result->result_array();
}


public function get_last_product_code()
{
    $this->db->select('p_code');
    $this->db->from('sh_tbl_lab_product');
    $this->db->order_by('id',"desc");
    $this->db->limit(1);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}

// public function get_stock_report($from_date,$to_date)
// {
//     $query  ="SET @total := 0, @openstock := 0,@closestock:=0,@mypid:=0";
//     $this->db->query($query);
//     $query2 = "SELECT *, product.id,p_current_stock as remain,p_name,@openstock :=st_open as stock_open,
//     @total:=(SELECT sum(st_in-st_out) as st_open FROM stock st where st.p_id=stock.p_id AND DATE(st.created_at)=DATE(stock.created_at) AND DATE(st.created_at) between '$from_date' AND '$to_date') as total,
//     sum(st_in) as stock_in,sum(st_out) as stock_out,(@openstock+@total) as stock_close,DATE(stock.created_at) as st_date FROM stock join product on product.id=stock.p_id WHERE DATE(stock.created_at) between '$from_date' and '$to_date' group by DATE(stock.created_at),stock.p_id order by DATE(stock.created_at),stock.p_id";  
//         //$query="SELECT sum(st_in-st_out) as st_open from stock where DATE(created_at) between '$from_date' AND '$to_date' Group BY DATE(created_at)"; 
//     $result = $this->db->query($query2) or die ("Schema Query Failed"); 
//     $result=$result->result_array();
//     return $result;
// }

public function get_stock_report($from_date,$to_date)
{
    $query  ="SET @total := 0, @openstock := 0,@closestock:=0,@mypid:=0";
    $this->db->query($query);
    $query2 = "SELECT *, product.id,p_current_stock as remain,p_name,@openstock :=st_open as stock_open,
    @total:=(SELECT sum(st_in-st_out) as st_open FROM stock st where st.p_id=stock.p_id AND DATE(st.created_at)=DATE(stock.created_at) AND DATE(st.expire_date)=DATE(stock.expire_date) AND DATE(st.created_at) between '$from_date' AND '$to_date') as total,
    sum(st_in) as stock_in,sum(st_out) as stock_out,(@openstock+@total) as stock_close,DATE(stock.created_at) as st_date FROM stock join product on product.id=stock.p_id WHERE DATE(stock.created_at) between '$from_date' and '$to_date' group by DATE(stock.created_at),stock.p_id,DATE(stock.expire_date) order by DATE(stock.created_at),stock.p_id";  
        //$query="SELECT sum(st_in-st_out) as st_open from stock where DATE(created_at) between '$from_date' AND '$to_date' Group BY DATE(created_at)"; 
    $result = $this->db->query($query2) or die ("Schema Query Failed"); 
    $result=$result->result_array();
    return $result;
}

public function get_stock_report_individual_product($from_date,$to_date,$p_id)
{
    $query  =   "SET @total := 0, @openstock := 0,@closestock:=0,@mypid:=0";
    $this->db->query($query);
    $query2 = "SELECT *, product.id,p_current_stock as remain,p_name,@openstock :=st_open as stock_open,
    @total:=(SELECT sum(st_in-st_out) as st_open FROM stock st where st.p_id=stock.p_id AND DATE(st.created_at)=DATE(stock.created_at) AND DATE(st.expire_date)=DATE(stock.expire_date) AND DATE(st.created_at) between '$from_date' AND '$to_date') as total,
    sum(st_in) as stock_in,sum(st_out) as stock_out,(@openstock+@total) as stock_close,DATE(stock.created_at) as st_date FROM stock join product on product.id=stock.p_id WHERE DATE(stock.created_at) between '$from_date' and '$to_date' AND stock.p_id='$p_id' group by DATE(stock.created_at),stock.p_id,DATE(stock.expire_date) order by DATE(stock.created_at),stock.p_id";  
        //$query="SELECT sum(st_in-st_out) as st_open from stock where DATE(created_at) between '$from_date' AND '$to_date' Group BY DATE(created_at)"; 
    $result = $this->db->query($query2) or die ("Schema Query Failed"); 
    $result=$result->result_array();
    return $result;
}
public function pathology_group_wise_report($order_id)
{
   $sql="select diagnostic_test_group.test_id,GROUP_CONCAT(sub_test_title) as sub_test_title,is_multi_print,payment_status,pathologoy_id,combined_group_id,pathologoy.patient_id,pathologoy.order_id,pdate,padate,delivery_date,pathologoy.test_id,opd_patient_test_order_info.id as o_id,delievery_status,
   patient_name,delievery_status,diagnostic_test_subgroup.id as subtestid,test_title,diagnostic_test_group.test_id,diagnostic_test_group.speciman,diagnostic_test_group.specimen_id,ref_doctor_name,opd_patient_test_order_info.quack_doc_name,opd_patient_test_order_info.test_order_id,opd_patient_test_order_info.is_ipd_patient,opd_patient_test_order_info.created_at,patient_info_id,count(diagnostic_test_group.test_id) as total_t
   from pathologoy inner join opd_patient_info on pathologoy.patient_id=opd_patient_info.id
   inner join opd_patient_test_order_info on 
   pathologoy.order_id=opd_patient_test_order_info.id
   inner join diagnostic_test_subgroup on pathologoy.test_id=diagnostic_test_subgroup.id
   inner join diagnostic_test_group on diagnostic_test_subgroup.mtest_id=diagnostic_test_group.test_id
   where opd_patient_test_order_info.test_order_id='$order_id' and opd_patient_info.status=1 and opd_patient_test_order_info.status=1 and pathologoy.status=1
   group by diagnostic_test_group.test_id, pathologoy.order_id";  
   $result = $this->db->query($sql) or die ("Schema Query Failed"); 
   $result=$result->result_array();
   return $result; 
}

public function pathology_group_wise_report_patient_id($patient_id)
{
   $sql="select diagnostic_test_group.test_id,GROUP_CONCAT(sub_test_title) as sub_test_title,is_multi_print,payment_status,pathologoy_id,combined_group_id,pathologoy.patient_id,pathologoy.order_id,pdate,padate,delivery_date,pathologoy.test_id,opd_patient_test_order_info.id as o_id,delievery_status,
   patient_name,delievery_status,diagnostic_test_subgroup.id as subtestid,test_title,diagnostic_test_group.test_id,diagnostic_test_group.speciman,diagnostic_test_group.specimen_id,ref_doctor_name,opd_patient_test_order_info.quack_doc_name,opd_patient_test_order_info.test_order_id,opd_patient_test_order_info.is_ipd_patient,opd_patient_test_order_info.created_at,patient_info_id,count(diagnostic_test_group.test_id) as total_t
   from pathologoy inner join opd_patient_info on pathologoy.patient_id=opd_patient_info.id
   inner join opd_patient_test_order_info on 
   pathologoy.order_id=opd_patient_test_order_info.id
   inner join diagnostic_test_subgroup on pathologoy.test_id=diagnostic_test_subgroup.id
   inner join diagnostic_test_group on diagnostic_test_subgroup.mtest_id=diagnostic_test_group.test_id
   where opd_patient_info.id='$patient_id' and opd_patient_info.status=1 and opd_patient_test_order_info.status=1 and pathologoy.status=1
   group by diagnostic_test_group.test_id, pathologoy.order_id";  
   $result = $this->db->query($sql) or die ("Schema Query Failed"); 
   $result=$result->result_array();
   return $result; 
}
public function allgroup($groupid,$start_date,$end_date)
{
    $parameter=$groupid;
    if($parameter=="all")
    {
        $sql="select sum(total_amount) as tamnt,sum(total_paid)as tpaid,acc_group.groupid as grpid,group_title
        from add_income_expense inner join acc_head on  add_income_expense.acc_head_id=acc_head.head_id
        inner join acc_group on acc_group.groupid=acc_head.group_id
        where add_income_expense.created_at between '$start_date' and '$end_date'
        group by acc_group.groupid";
    }
    else
    {
        $sql="select sum(total_amount) as tamnt,sum(total_paid)as tpaid,acc_group.groupid as grpid,group_title
        from add_income_expense inner join acc_head on  add_income_expense.acc_head_id=acc_head.head_id
        inner join acc_group on acc_group.groupid=acc_head.group_id where acc_group.groupid=$parameter
        and add_income_expense.created_at between '$start_date' and '$end_date'
        group by acc_group.groupid";     
    }

    $result = $this->db->query($sql) or die ("Schema Query Failed"); 
    $result=$result->result_array();
    return $result; 
}
public function allgroup_det()
{


    $sql="select sum(total_amount) as tamnt,sum(total_paid)as tpaid,acc_group.groupid as grpid,group_title
    from add_income_expense inner join acc_head on  add_income_expense.acc_head_id=acc_head.head_id
    inner join acc_group on acc_group.groupid=acc_head.group_id
    group by acc_group.groupid";

    $result = $this->db->query($sql) or die ("Schema Query Failed"); 
    $result=$result->result_array();
    return $result; 
}  


// public function select_join_pathology_where($selector,$table_name,$join_table1,$join_condition1,$join_table2,$join_condition2,$join_table3,$join_condition3,$join_table4,$join_condition4,$condition)
// {
//         // $this->db->distinct($selector);
//     $this->db->select($selector);
//     $this->db->from($table_name);
//     $this->db->join($join_table1,$join_condition1);
//     $this->db->join($join_table2,$join_condition2);     
//     $this->db->join($join_table3,$join_condition3);
//     $this->db->join($join_table4,$join_condition4);
//     $where = '('.$condition .')';
//     $this->db->where($where);
//     $result=$this->db->get();
//     return $result->result_array();
// }

public function make_query_doc_schedule_list($order_column)
{
    $query="SELECT s.id,s.doc_id,d.doctor_title
    ,
    MAX(
        CASE WHEN schedule_day = 'Saturday' THEN id END ) as saturday_id,
    MAX(
        CASE WHEN schedule_day = 'Sunday' THEN id END ) as sunday_id,
    MAX(
        CASE WHEN schedule_day = 'Monday' THEN id END ) as monday_id,
    MAX(
        CASE WHEN schedule_day = 'Tuesday' THEN id END ) as tuesday_id,
    MAX(
        CASE WHEN schedule_day = 'Wednesday' THEN id END ) as wednesday_id,
    MAX(
        CASE WHEN schedule_day = 'Thursday' THEN id END ) as thursday_id,
    MAX(
        CASE WHEN schedule_day = 'Friday' THEN id END ) as friday_id,
    MAX(
        CASE WHEN schedule_day = 'Saturday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END
        ) as saturday
    , MAX(CASE WHEN schedule_day = 'Sunday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as sunday
    , MAX(CASE WHEN schedule_day = 'Monday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as monday
    , MAX(CASE WHEN schedule_day = 'Tuesday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as tuesday
    , MAX(CASE WHEN schedule_day = 'Wednesday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as wednesday
    , MAX(CASE WHEN schedule_day = 'Thursday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as thursday
    , MAX(CASE WHEN schedule_day = 'Friday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as friday

    FROM doctor_schedule s JOIN doctor d
    on s.doc_id=d.doctor_id where s.schedule_status=1";


    if($this->session->userdata['logged_in']['doc_id'] != 0)  
    {
        $query .= " and s.doc_id = '".$this->session->userdata['logged_in']['doc_id']."'"; 
    }

    if(isset($_POST["search"]["value"]))  
    {  

        $query .= " and  doctor_title LIKE '%".$_POST["search"]["value"]."%'";    
        
        
    } 

    if(isset($_POST["order"]))  
    {  

        // "<pre>";print_r($_POST['order']['0']['column']);die();
        $query.=" GROUP BY s.doc_id order by ".$order_column[$_POST['order']['0']['column']]." ".$_POST['order']['0']['dir']."";

    }  
    else
    {
        $query .=" GROUP BY s.doc_id order by s.id desc";    
        
        

    }

    return $query;
    
}




function make_datatables_doc_schedule_list($order_column){  

    $query=$this->make_query_doc_schedule_list($order_column);
    
    if($_POST["length"] != -1)  
    {  
        $query.=' LIMIT '.$_POST['start'].', '.$_POST['length'].'';
    }

    $result = $this->db->query($query) or die ("Schema Query Failed"); 
    $result=$result->result();
    return $result;  


}  
function get_filtered_data_doc_schedule_list($order_column){  
 $query=$this->make_query_doc_schedule_list($order_column);

 $result = $this->db->query($query) or die ("Schema Query Failed"); 
 $result=count($result->result_array());
 return $result;
}       
function get_all_data_doc_schedule_list()  
{  
    $query = "SELECT s.id,s.doc_id,d.doctor_title
    ,
    MAX(
        CASE WHEN schedule_day = 'Saturday' THEN id END ) as saturday_id,
    MAX(
        CASE WHEN schedule_day = 'Sunday' THEN id END ) as sunday_id,
    MAX(
        CASE WHEN schedule_day = 'Monday' THEN id END ) as monday_id,
    MAX(
        CASE WHEN schedule_day = 'Tuesday' THEN id END ) as tuesday_id,
    MAX(
        CASE WHEN schedule_day = 'Wednesday' THEN id END ) as wednesday_id,
    MAX(
        CASE WHEN schedule_day = 'Thursday' THEN id END ) as thursday_id,
    MAX(
        CASE WHEN schedule_day = 'Friday' THEN id END ) as friday_id,
    MAX(
        CASE WHEN schedule_day = 'Saturday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END
        ) as saturday
    , MAX(CASE WHEN schedule_day = 'Sunday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as sunday
    , MAX(CASE WHEN schedule_day = 'Monday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as monday
    , MAX(CASE WHEN schedule_day = 'Tuesday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as tuesday
    , MAX(CASE WHEN schedule_day = 'Wednesday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as wednesday
    , MAX(CASE WHEN schedule_day = 'Thursday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as thursday
    , MAX(CASE WHEN schedule_day = 'Friday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as friday

    FROM doctor_schedule s JOIN doctor d
    on s.doc_id=d.doctor_id where s.schedule_status=1";    

    if($this->session->userdata['logged_in']['doc_id'] != 0)  
    {
        $query .= " and s.doc_id = '".$this->session->userdata['logged_in']['doc_id']."' GROUP BY s.doc_id"; 
    }
    else 
    {
     $query .= " GROUP BY s.doc_id";
 }

 $result = $this->db->query($query) or die ("Schema Query Failed"); 
 $result=count($result->result_array());
 return $result;
} 


public function doc_schedule_list()
{

    $query = "SELECT s.id,s.doc_id,d.doctor_title
    ,
    MAX(
        CASE WHEN schedule_day = 'Saturday' THEN id END ) as saturday_id,
    MAX(
        CASE WHEN schedule_day = 'Sunday' THEN id END ) as sunday_id,
    MAX(
        CASE WHEN schedule_day = 'Monday' THEN id END ) as monday_id,
    MAX(
        CASE WHEN schedule_day = 'Tuesday' THEN id END ) as tuesday_id,
    MAX(
        CASE WHEN schedule_day = 'Wednesday' THEN id END ) as wednesday_id,
    MAX(
        CASE WHEN schedule_day = 'Thursday' THEN id END ) as thursday_id,
    MAX(
        CASE WHEN schedule_day = 'Friday' THEN id END ) as friday_id,
    MAX(
        CASE WHEN schedule_day = 'Saturday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END
        ) as saturday
    , MAX(CASE WHEN schedule_day = 'Sunday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as sunday
    , MAX(CASE WHEN schedule_day = 'Monday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as monday
    , MAX(CASE WHEN schedule_day = 'Tuesday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as tuesday
    , MAX(CASE WHEN schedule_day = 'Wednesday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as wednesday
    , MAX(CASE WHEN schedule_day = 'Thursday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as thursday
    , MAX(CASE WHEN schedule_day = 'Friday' THEN CONCAT(TIME_FORMAT(start_time,'%h:%i %p'),'-',TIME_FORMAT(end_time,'%h:%i %p')) END) as friday

    FROM doctor_schedule s JOIN doctor d
    on s.doc_id=d.doctor_id where s.schedule_status=1
    GROUP BY s.doc_id";    
    $result = $this->db->query($query) or die ("Schema Query Failed"); 
    $result=$result->result_array();
    return $result;
}

public function select_join_four_table2_sum_group_by($selector,$table_name,$join_table1,$join_table2,$join_table3,$join_condition1,$join_condition2,$join_condition3,$condition,$sum_selector1,$sum_selector2,$sum_selector3,$sum_selector4,$group_selector)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->select_sum($sum_selector1);
    $this->db->select_sum($sum_selector2);
    $this->db->select_sum($sum_selector3);
    $this->db->select_sum($sum_selector4);
    // $this->db->select_sum($sum_selector5);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);
    $this->db->join($join_table3,$join_condition3);


    $this->db->group_by($group_selector);
        // $this->db->group_by(array("o.id", "dt.test_id"));

    $where= '('. $condition. ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_four_table2_five_sum_group_by($selector,$table_name,$join_table1,$join_table2,$join_table3,$join_condition1,$join_condition2,$join_condition3,$condition,$sum_selector1,$sum_selector2,$sum_selector3,$sum_selector4,$sum_selector5,$group_selector)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->select_sum($sum_selector1);
    $this->db->select_sum($sum_selector2);
    $this->db->select_sum($sum_selector3);
    $this->db->select_sum($sum_selector4);
    $this->db->select_sum($sum_selector5);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);
    $this->db->join($join_table3,$join_condition3);


    $this->db->group_by($group_selector);
        // $this->db->group_by(array("o.id", "dt.test_id"));

    $where= '('. $condition. ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}


public function select_join_five_table2_sum_group_by($selector,$table_name,$join_table1,$join_table2,$join_table3,$join_table4,$join_condition1,$join_condition2,$join_condition3,$join_condition4,$condition,$sum_selector1,$sum_selector2,$sum_selector3,$sum_selector4,$group_selector)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->select_sum($sum_selector1);
    $this->db->select_sum($sum_selector2);
    $this->db->select_sum($sum_selector3);
    $this->db->select_sum($sum_selector4);
    // $this->db->select_sum($sum_selector5);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);
    $this->db->join($join_table3,$join_condition3);
    $this->db->join($join_table4,$join_condition4,'left');
    // $this->db->join($join_table5,$join_condition5,'left');


    $this->db->group_by($group_selector);
        // $this->db->group_by(array("o.id", "dt.test_id"));

    $where= '('. $condition. ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}


public function select_join_nine_table2_sum_group_by($selector,$table_name,$join_table1,$join_table2,$join_table3,$join_table4,$join_table5,$join_table6,$join_table7,$join_table8,$join_condition1,$join_condition2,$join_condition3,$join_condition4,$join_condition5,$join_condition6,$join_condition7,$join_condition8,$condition,$sum_selector1,$sum_selector2,$sum_selector3,$sum_selector4,$group_selector)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->select_sum($sum_selector1);
    $this->db->select_sum($sum_selector2);
    $this->db->select_sum($sum_selector3);
    $this->db->select_sum($sum_selector4);
    // $this->db->select_sum($sum_selector5);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1,'left');
    $this->db->join($join_table2,$join_condition2,'left');
    $this->db->join($join_table3,$join_condition3,'left');
    $this->db->join($join_table4,$join_condition4,'left');
    $this->db->join($join_table5,$join_condition5,'left');
    $this->db->join($join_table6,$join_condition6,'left');
    $this->db->join($join_table7,$join_condition7,'left');
    $this->db->join($join_table8,$join_condition8,'left');


    $this->db->group_by($group_selector);
        // $this->db->group_by(array("o.id", "dt.test_id"));

    $where= '('. $condition. ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}


public function select_join_four_table2_sum_count($selector,$table_name,$join_table1,$join_table2,$join_table3,$join_condition1,$join_condition2,$join_condition3,$condition)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);

    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);

    $this->db->join($join_table3,$join_condition3);


        // $this->db->group_by($group_selector);


    
    $where= '('. $condition. ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();

        // $result=$this->db->count_all_results();

        // return $result;
}

public function select_join_five_table2_sum_six_count_group_by($selector,$table_name,$join_table1,$join_table2,$join_table3,$join_table4,$join_condition1,$join_condition2,$join_condition3,$join_condition4,$condition,$sum_selector1,$sum_selector2,$sum_selector3,$sum_selector4,$sum_selector5,$sum_selector6,$group_selector)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->select_sum($sum_selector1);
    $this->db->select_sum($sum_selector2);
    $this->db->select_sum($sum_selector3);
    $this->db->select_sum($sum_selector4);
    $this->db->select_sum($sum_selector5);
    $this->db->select_sum($sum_selector6);
    // $this->db->count_all_results($count_selector);

    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);

    $this->db->join($join_table3,$join_condition3);
    $this->db->join($join_table4,$join_condition4);

    $this->db->group_by($group_selector);
    // $this->db->group_by($group_selector1);


    $where= '('. $condition. ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_five_table2_sum_six_count_group_by_two($selector,$table_name,$join_table1,$join_table2,$join_table3,$join_table4,$join_condition1,$join_condition2,$join_condition3,$join_condition4,$condition,$sum_selector1,$sum_selector2,$sum_selector3,$sum_selector4,$sum_selector5,$sum_selector6,$group_selector,$group_selector1)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->select_sum($sum_selector1);
    $this->db->select_sum($sum_selector2);
    $this->db->select_sum($sum_selector3);
    $this->db->select_sum($sum_selector4);
    $this->db->select_sum($sum_selector5);
    $this->db->select_sum($sum_selector6);
    // $this->db->count_all_results($count_selector);

    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);

    $this->db->join($join_table3,$join_condition3);
    $this->db->join($join_table4,$join_condition4);

    $this->db->group_by($group_selector);
    $this->db->group_by($group_selector1);


    $where= '('. $condition. ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_five_table2_count($selector,$table_name,$join_table1,$join_table2,$join_table3,$join_table4,$join_condition1,$join_condition2,$join_condition3,$join_condition4,$condition,$group_selector)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);

    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);

    $this->db->join($join_table3,$join_condition3);
    $this->db->join($join_table4,$join_condition4);

    $this->db->group_by($group_selector);
    // $this->db->group_by($group_selector1);


    $where= '('. $condition. ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}


public function select_join_where_sum_group_by($selector,$sum_selector,$table_name,$join_table,$join_condition,$condition,$group_by_selector1,$group_by_selector2)
{

    $this->db->select($selector);
    $this->db->select_sum($sum_selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $this->db->group_by($group_by_selector1);
    $this->db->group_by($group_by_selector2);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_where2_sum_group_by($selector,$sum_selector,$table_name,$join_table,$join_condition,$condition,$group_by_selector)
{

    $this->db->select($selector);
    $this->db->select_sum($sum_selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $this->db->group_by($group_by_selector);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_where2_group_by($selector,$table_name,$join_table,$join_condition,$condition,$group_by_selector)
{

    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $this->db->group_by($group_by_selector);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_join_three_table2_group_by_sum($sum_selector,$selector,$table_name,$join_table1,$join_table2,$join_condition1,$join_condition2,$condition,$group_by_selector)
{
        // $this->db->distinct($selector);
    $this->db->select_sum($sum_selector);
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);
    $where = '('.$condition.')';
    $this->db->where($where);
    $this->db->group_by($group_by_selector);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_three_join_where_group_by($selector,$table_name,$join_table,$join_condition,$join_table2,$join_condition2,$condition,$group_selector)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition);
    $this->db->join($join_table2,$join_condition2);

        //$this->db->order_by($order_col,$order_action);
    $this->db->group_by($group_selector);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_three_join_where_group_by_one_left_sum($selector,$selector_sum,$table_name,$join_table,$join_condition,$join_table2,$join_condition2,$condition,$group_selector)
{
    $this->db->select($selector);
    $this->db->select_sum($selector_sum);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition,'LEFT');
    $this->db->join($join_table2,$join_condition2);

        //$this->db->order_by($order_col,$order_action);
    $this->db->group_by($group_selector);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function select_with_where_orer_by_desc2($selector, $condition, $tablename)
{
    $this->db->select($selector);
    $this->db->from($tablename);
    $where = '('. $condition . ')';
    $this->db->where($where);
    $this->db->order_by('id','DESC');
    $result = $this->db->get();
    return $result->result_array();
}

public function select_four_join_left_where_order($selector,$table_name,$join_table,$join_condition,$join_table2,$join_condition2,$join_table3,$join_condition3,$cond,$order_col,$order_action)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition,'LEFT');
    $this->db->join($join_table2,$join_condition2,'LEFT');
    $this->db->join($join_table3,$join_condition3,'LEFT');
    $this->db->order_by($order_col,$order_action);
    $where = '('.$cond . ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
}

public function count_with_where($selector, $condition, $tablename)
{
    $this->db->select($selector);
    $this->db->from($tablename);
    $where = '(' . $condition . ')';
    $this->db->where($where);
    $result = $this->db->get();
    return $result->num_rows();
}   

public function exclude_one_from_three_join($value='')
{
    $query = $this->db->query("if (select count(*) from return_product r where r.status=1 and r.type=1) > 0
        begin
        select * from buy b inner join supplier s on b.supp_id=s.id inner join return_product r on b.buy_code=r.buy_sell_code
        end
        else
        begin
        select * from buy b join supplier s on b.sipp_id=s.id
        end");

    return $query->result_array();
}

public function select_three_join_where_left_order($selector,$table_name,$join_table,$join_condition,$join_table2,$join_condition2,$condition,$order_col,$order_action)
{
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table,$join_condition,'LEFT');
    $this->db->join($join_table2,$join_condition2,'LEFT');
    $this->db->order_by($order_col,$order_action);
    $where = '('.$condition . ')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
} 

public function select_three_join_where_left_order_sum($sum_selector1,$sum_selector2,$sum_selector3,$selector,$table_name,$join_table,$join_condition,$join_table2,$join_condition2,$condition,$order_col,$order_action,$group_selector)
{
  $this->db->select($selector);
  $this->db->select_sum($sum_selector1); 
  $this->db->select_sum($sum_selector2); 
  $this->db->select_sum($sum_selector3); 
  $this->db->from($table_name);
  $this->db->join($join_table,$join_condition,'LEFT');
  $this->db->join($join_table2,$join_condition2,'LEFT');
  $this->db->order_by($order_col,$order_action);
  $where = '('.$condition . ')';
  $this->db->where($where);
  $this->db->group_by($group_selector);
  $result=$this->db->get();
  return $result->result_array();
} 

public function select_three_join_where_left_order_four_sum($sum_selector1,$sum_selector2,$sum_selector3,$sum_selector4,$selector,$table_name,$join_table,$join_condition,$join_table2,$join_condition2,$condition,$order_col,$order_action,$group_selector)
{
  $this->db->select($selector);
  $this->db->select_sum($sum_selector1); 
  $this->db->select_sum($sum_selector2); 
  $this->db->select_sum($sum_selector3); 
  $this->db->select_sum($sum_selector4); 
  $this->db->from($table_name);
  $this->db->join($join_table,$join_condition);
  $this->db->join($join_table2,$join_condition2);
  $this->db->order_by($order_col,$order_action);
  $where = '('.$condition . ')';
  $this->db->where($where);
  $this->db->group_by($group_selector);
  $result=$this->db->get();
  return $result->result_array();
} 


public function select_four_join_where_left_order_sum($sum_selector1,$sum_selector2,$sum_selector3,$selector,$table_name,$join_table,$join_condition,$join_table2,$join_condition2,$join_table3,$join_condition3,$condition,$order_col,$order_action,$group_selector)
{
  $this->db->select($selector);
  $this->db->select_sum($sum_selector1); 
  $this->db->select_sum($sum_selector2); 
  $this->db->select_sum($sum_selector3); 
  $this->db->from($table_name);
  $this->db->join($join_table,$join_condition);
  $this->db->join($join_table2,$join_condition2);
  $this->db->join($join_table3,$join_condition3);
  $this->db->order_by($order_col,$order_action);
  $where = '('.$condition . ')';
  $this->db->where($where);
  $this->db->group_by($group_selector);
  $result=$this->db->get();
  return $result->result_array();
} 

public function select_join_pathology_where($selector,$table_name,$join_table1,$join_condition1,$join_table2,$join_condition2,$join_table3,$join_condition3,$join_table4,$join_condition4,$condition)
{
        // $this->db->distinct($selector);
    $this->db->select($selector);
    $this->db->from($table_name);
    $this->db->join($join_table1,$join_condition1);
    $this->db->join($join_table2,$join_condition2);     
    $this->db->join($join_table3,$join_condition3);
    $this->db->join($join_table4,$join_condition4);
    // $this->db->join($join_table4,$join_condition4);
    $where = '('.$condition .')';
    $this->db->where($where);
    $result=$this->db->get();
    return $result->result_array();
} 


/*Shahed Model Code Start*/

public function anyName_Staff_Salary_Generate($col,$id,$col1,$id1,$name){
    $this->db->where($col,$id);
    $this->db->where($col1,$id1);
    $info=$this->db->get('sh_tbl_staff_salary_genrate');
    foreach($info->result_array() as $val){

        return $val[$name];

    }
}
public function anyName_Staff($col,$id,$name){
    $this->db->where($col,$id);
    $info=$this->db->get('sh_tbl_staff');
    foreach($info->result_array() as $val){

        return $val[$name];

    }
}
public function anyName_Designation($col,$id,$name){
    $this->db->where($col,$id);
    $info=$this->db->get('sh_tbl_designation');
    foreach($info->result_array() as $val){

        return $val[$name];

    }
}

public function getTripNo(){        
    $this->db->select_max('trip_no','trip_no');
    $info=$this->db->get('sh_tbl_ambulance_reciept');
    foreach($info->result_array() as $val){
        return $val['trip_no'];
    }
}

public function getEmergencyNo(){       
    $this->db->select_max('emergency_no','emergency_no');
    $info=$this->db->get('sh_tbl_emergency_reciept');
    foreach($info->result_array() as $val){
        return $val['emergency_no'];
    }
}
public function anyName_Opd_patient_list($col,$id,$name){
    $this->db->where($col,$id);
    $info=$this->db->get('opd_patient_info');
    foreach($info->result_array() as $val){

        return $val[$name];

    }
}
public function anyName_Ipd_patient_list($col,$id,$name){
    $this->db->where($col,$id);
    $info=$this->db->get('local_patient_info');
    foreach($info->result_array() as $val){

        return $val[$name];

    }
}
public function anyName_Doctor_list($col,$id,$name){
    $this->db->where($col,$id);
    $info=$this->db->get('doctor');
    foreach($info->result_array() as $val){

        return $val[$name];

    }
}
public function anyName_Department_list($col,$id,$name){
    $this->db->where($col,$id);
    $info=$this->db->get('sh_tbl_department');
    foreach($info->result_array() as $val){

        return $val[$name];

    }
}

public function get_last_lab_in_code()
{
    $this->db->select('buy_code');
    $this->db->from('sh_tbl_lab_in_product');
    $this->db->order_by('buy_id',"desc");
    $this->db->limit(1);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
}
public function anyName_ambulence_list($col,$id,$name){
    $this->db->where($col,$id);
    $info=$this->db->get('tbl_ambulance');
    foreach($info->result_array() as $val){

        return $val[$name];

    }
}


public function get_lab_stock_report($from_date,$to_date)
{
    $query  ="SET @total := 0, @openstock := 0,@closestock:=0,@mypid:=0";
    $this->db->query($query);
    $query2 = "SELECT *, sh_tbl_lab_product.id,p_current_stock as remain,p_name,@openstock :=st_open as stock_open,
    @total:=(SELECT sum(st_in-st_out) as st_open FROM sh_tbl_stock st where st.p_id=sh_tbl_stock.p_id AND DATE(st.created_at)=DATE(sh_tbl_stock.created_at) AND DATE(st.created_at) between '$from_date' AND '$to_date') as total,
    sum(st_in) as stock_in,sum(st_out) as stock_out,(@openstock+@total) as stock_close,DATE(sh_tbl_stock.created_at) as st_date FROM sh_tbl_stock join sh_tbl_lab_product on sh_tbl_lab_product.id=sh_tbl_stock.p_id WHERE DATE(sh_tbl_stock.created_at) between '$from_date' and '$to_date' group by DATE(sh_tbl_stock.created_at),sh_tbl_stock.p_id order by DATE(sh_tbl_stock.created_at),sh_tbl_stock.p_id";  
        //$query="SELECT sum(st_in-st_out) as st_open from sh_tbl_stock where DATE(created_at) between '$from_date' AND '$to_date' Group BY DATE(created_at)"; 
    $result = $this->db->query($query2) or die ("Schema Query Failed"); 
    $result=$result->result_array();
    return $result;
}



public function get_lab_stock_report_individual_product($from_date,$to_date,$p_id)
{
    $query  =   "SET @total := 0, @openstock := 0,@closestock:=0,@mypid:=0";
    $this->db->query($query);
    $query2 = "SELECT *, sh_tbl_lab_product.id,p_current_stock as remain,p_name,@openstock :=st_open as stock_open,
    @total:=(SELECT sum(st_in-st_out) as st_open FROM sh_tbl_stock st where st.p_id=sh_tbl_stock.p_id AND DATE(st.created_at)=DATE(sh_tbl_stock.created_at) AND DATE(st.created_at) between '$from_date' AND '$to_date') as total,
    sum(st_in) as stock_in,sum(st_out) as stock_out,(@openstock+@total) as stock_close,DATE(sh_tbl_stock.created_at) as st_date FROM sh_tbl_stock join sh_tbl_lab_product on sh_tbl_lab_product.id=sh_tbl_stock.p_id WHERE DATE(sh_tbl_stock.created_at) between '$from_date' and '$to_date' AND sh_tbl_stock.p_id='$p_id' group by DATE(sh_tbl_stock.created_at),sh_tbl_stock.p_id order by DATE(sh_tbl_stock.created_at),sh_tbl_stock.p_id";  
        //$query="SELECT sum(st_in-st_out) as st_open from sh_tbl_stock where DATE(created_at) between '$from_date' AND '$to_date' Group BY DATE(created_at)"; 
    $result = $this->db->query($query2) or die ("Schema Query Failed"); 
    $result=$result->result_array();
    return $result;
}

public function getAge(){
    $ageAll = array(
        "5" => "5","6" => "6","7" => "7","8" => "8","9" => "9","10" => "10",
        "11" => "11","12" => "12","13" => "13","14" => "15","16" => "16","17" => "17",
        "20" => "20","21" => "21","22" => "22","23" => "23","24" => "24","25" => "25",
        "26" => "26","27" => "27","28" => "28","29" => "29","30" => "30","31" => "31",
    );
    return $ageAll;
}

public function getSex(){
    $sexAll = array(
        "Male" => "Male","Female" => "Female","Others" => "Others"
    );
    return $sexAll;
}
/*Shahed Model Code End*/


}
?>