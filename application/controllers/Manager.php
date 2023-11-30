<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {
	private $userData;

	public function __construct(){
		parent::__construct();

		$this->userData = $this->session->userdata();

        //check manager access
        if(!isset($this->userData['level']) OR $this->userData['level'] == 0){
            redirect(base_url());
        }
	}

	public function users(){
		//check for lvl 2 user for edit
		if($this->userData['level'] < 2){
            redirect(base_url());
        }

        $viewData = [];

        $start = (int)$this->input->get('per_page');
        $limit = $this->config->item('per_page');

        $viewData['items'] = $this->db->limit($limit, $start)->get('users')->result();

		$this->pagination->initialize([
			'base_url'		=> base_url('index.php/manager/users'),
			'total_rows'	=> $this->db->count_all_results('users')
		]);
		$viewData['pagination'] = $this->pagination->create_links();

        $this->render('manager/users', $viewData);
    }

	public function delete_user($id){
		$item = $this->db->select('email')->where('id',$id)->get('users')->row();
		if(is_object($item)){
			$this->db->delete('users',array('id' => $id ));
			$this->add_alert('success','User delete successful.');
		}
		redirect(base_url('index.php/manager/users'));
	}

	public function edit_user($id){
		$viewData = [];

		$user = $this->db->where('id',$id)->get('users')->row();
		if(!is_object($user)){
			show_404();
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim|min_length[3]|max_length[20]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|min_length[3]|max_length[20]');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]|max_length[10]');
		$this->form_validation->set_rules('level', 'Level', 'required|trim|numeric[2]');
		
		if ($this->form_validation->run())
        {
			$data = [
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'level' => $this->input->post('level'),
				'password' => $this->input->post('password')
				//cannot be encypted? 
			];

			$this->db->where('id', $id)->update('users',$data);	
			$this->add_alert('success','User successfully updated.');
			redirect(base_url('index.php/manager/users'));	
        }
		$viewData['user'] = $user;

		$this->render('manager/edit_user', $viewData);
	}

    public function items(){
        $viewData = [];

        $start = (int)$this->input->get('per_page');
        $limit = $this->config->item('per_page');

        $viewData['items'] = $this->db->limit($limit, $start)->get('items')->result();

		$this->pagination->initialize([
			'base_url'		=> base_url('index.php/manager/items'),
			'total_rows'	=> $this->db->count_all_results('items')
		]);
		$viewData['pagination'] = $this->pagination->create_links();

        $this->render('manager/items', $viewData);
    }

	public function categories(){
        $viewData = [];

        $start = (int)$this->input->get('per_page');
        $limit = $this->config->item('per_page');

        $viewData['items'] = $this->db->limit($limit, $start)->get('categories')->result();

		$this->pagination->initialize([
			'base_url'		=> base_url('index.php/manager/categories'),
			'total_rows'	=> $this->db->count_all_results('categories')
		]);
		$viewData['pagination'] = $this->pagination->create_links();

        $this->render('manager/categories', $viewData);
    }

	public function add_category(){
		$viewData = [];

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|max_length[30]');

		if ($this->form_validation->run())
		{
			$insertData = [
				'title'			=> $this->input->post('title'),
			];
			$this->db->insert('categories',$insertData);
			$this->add_alert('success','New category successfully added.');
			redirect(base_url('index.php/manager/categories'));
		}
		$this->render('manager/add_category', $viewData);
	}
	
	public function delete_category($id){
		$item = $this->db->select('title')->where('id',$id)->get('categories')->row();
		if(is_object($item)){
			$this->db->delete('categories',array('id' => $id ));
			$this->add_alert('success','Category delete successful.');
		}
		redirect(base_url('index.php/manager/categories'));
	}

	public function edit_category($id){
		$viewData = [];

		$item = $this->db->where('id',$id)->get('categories')->row();
		if(!is_object($item)){
			show_404();
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|max_length[30]');

		if ($this->form_validation->run())
		{
			$data = [
				'title'			=> $this->input->post('title'),
			];
			$this->db->where('id', $id)->update('categories',$data);
			$this->add_alert('success','Category successfully updated.');
			redirect(base_url('index.php/manager/categories'));
		}
		$viewData['item'] = $item;
		$this->render('manager/edit_category', $viewData);
	}

	public function edit_item($item_id){
		$viewData = [];

		$item = $this->db->where('id',$item_id)->get('items')->row();
		if(!is_object($item)){
			show_404();
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric|greater_than[0]');
		$this->form_validation->set_rules('category_id', 'category_id', 'required');
		
		if ($this->form_validation->run())
        {
			$updateData = [
				'title'			=> $this->input->post('title'),
				'price'			=> $this->input->post('price'),
				'description'	=> $this->input->post('description'),
				'category_id'	=> $this->input->post('category_id'),
				'image'			=> $upload['data']
			];

            $upload = $this->do_upload();
			if(isset($upload['error'])){
				$viewData['error'] = $upload['error'];
			}else{
				$updateData['image'] = $upload['data'];
			}
			
			$this->db->where('id', $item_id)->update('items',$updateData);	
			$this->add_alert('success','Item successfully updated.');
			redirect(base_url('index.php/manager/items'));	
        }
		$viewData['item'] = $item;

		$this->render('manager/edit_item', $viewData);
	}

	public function delete_item($item_id){
		$item =$this->db->select('title')->where('id',$item_id)->get('items')->row();
		if(is_object($item)){
			$this->db->delete('items',array('id' => $item_id ));
			$this->add_alert('success','Item delete successful.');
		}
		redirect(base_url('index.php/manager/items'));
	}

	public function add_item(){
		$viewData = [];

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric|greater_than[0]');
		$this->form_validation->set_rules('category_id', 'category_id', 'required');
		
		if ($this->form_validation->run())
        {
            $upload = $this->do_upload();
			if(isset($upload['error'])){
				$viewData['error'] = $upload['error'];
			}else{
				$insertData = [
					'title'			=> $this->input->post('title'),
					'price'			=> $this->input->post('price'),
					'description'	=> $this->input->post('description'),
					'category_id'	=> $this->input->post('category_id'),
					'image'			=> $upload['data']
				];
				$this->db->insert('items',$insertData);
				$this->add_alert('success','New item successfully added.');
			}
        }
		$this->render('manager/add_item', $viewData);
	}

	private function do_upload(){
		$config = [
			'upload_path'	=> './uploads/',
			'allowed_types'	=> 'gif|jpg|png',
			'max_size'		=> 1024,
			'encrypt_name'	=> true
		];

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('image'))
        {
        	return array('error' => $this->upload->display_errors($this->config->item('error_prefix'),$this->config->item('error_suffix')));
        }
        else
        {
            return array('data' => $this->upload->data('file_name'));
        }
    }

	private function add_alert($type, $message){
		$alert = ['type' => $type, 'message' => $message];
		$this->session->set_flashdata('alert', $alert);
	}

	private function render($page, $data = []){
		$categories = $this->db->get('categories')->result();
		$headerData = [
			'categories'	=> $categories,
			'user'			=> $this->userData,
			'alert'			=> $this->session->flashdata('alert')
		];

		$this->load->view('inc/header', $headerData);
		$this->load->view($page, $data);
		$this->load->view('inc/footer');
	}
}
