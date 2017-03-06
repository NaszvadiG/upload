<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order_model extends CI_Model {

	private $table = 'orders';
    private $column_order = array('o.id'); //set column field database for datatable orderable
    private $column_search = array('o.domain'); //set column field database for datatable searchable just firstname , lastname , and email are searchable
    private $order = array('o.id' => 'desc'); // default order 

    public function __construct()
    {
    	parent::__construct();
    }

    private function _get_datatables_query($term=''){ 
	    //term is value of $_REQUEST['search']['value']
	    $col_select = array(
	    	'o.id AS "order_id"',
	    	'CONCAT(m.first_name, " ", m.last_name) AS "name"',
	    	'o.domain AS "domain"',
	    	'a.key AS "api_key"',
	    	'a.created_at AS "date"',
	    	'o.price AS "price"',
	    	'o.status AS "status"'
	    	);
	    $column = $col_select;
	    $this->db->select($col_select);
	    $this->db->from('orders o');
	    $this->db->join('api_keys a', 'o.id = a.order_id','left');
	    $this->db->join('members m', 'o.user_id = m.id', 'left');
	    $this->db->like('o.id', $term);
	    $this->db->or_like('m.first_name', $term);
	    $this->db->or_like('m.last_name', $term);
	    $this->db->or_like('o.domain', $term);
        if(isset($_REQUEST['order'])) // here order processing
        {
        	$this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
        	$order = $this->order;
        	$this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables(){
    	$term = $_REQUEST['search']['value'];   
    	$this->_get_datatables_query($term);
    	if($_REQUEST['length'] != -1)
    		$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
    	$query = $this->db->get();
    	return $query->result(); 
    }

    function count_filtered(){
    	$term = $_REQUEST['search']['value']; 
    	$this->_get_datatables_query($term);
    	$query = $this->db->get();
    	return $query->num_rows();  
    }

    public function count_all(){
    	$this->db->from($this->table);
    	return $this->db->count_all_results();  
    }
    
    public function update($where, $data)
    {
        $this->db->update($this->table, array('status' => 1, 'updated_at' => date('Y:m:d H:i:')), $where);
    	$this->db->update('api_keys', $data, $where);
    	return $this->db->affected_rows();
    }

}