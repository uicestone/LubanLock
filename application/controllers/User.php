<?php
class User extends LB_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	function index($id = NULL){
		
		switch ($this->input->method) {
			case 'GET':
				if(is_null($id)){
					$this->query();
				}
				else{
					$this->get($id);
				}
				break;
			
			case 'POST':
				$this->add();
				break;
			
			case 'PUT':
				$this->update($id);
				break;
			
			case 'DELETE':
				$this->remove($id);
				break;
		}
	}
	
	function get($id){
		
		$args=$this->input->get();
		
		$user = $this->user->get($id, $args);
		
		$this->output->set_output($user);
	}
	
	function query(){
		
		$args=$this->input->get();
		
		$result = $this->user->query($args);

		$this->output->set_output($result['data']);
		$this->output->set_header('List-Total: ' . $result['info']['total']);
		$this->output->set_header('List-From: ' . $result['info']['from']);
		$this->output->set_header('List-To: ' . $result['info']['to']);
		$this->output->set_status_header(200, 'OK, '.$result['info']['total'].' Users in Total, '.$result['info']['from'].'-'.$result['info']['to'].' Listed');
	}
	
	function add(){
		$user_id = $this->user->add($this->input->data(), $this->input->get());
		$this->get($user_id);
	}
	
	function update($id){
		$this->user->id = $id;
		$this->user->update($this->input->data());
		$this->get($id);
	}
	
	function remove($id){
		$this->user->id = $id;
		$this->user->remove();
	}
	
	function logout(){
		$this->user->sessionLogout();
		redirect();
	}
	
	function login(){
		
		if(!is_null($this->input->post_get('login'))){
			$user = $this->user->verify($this->input->get_post('username'), $this->input->get_post('password'));
			$this->user->sessionLogin($user['id']);
			redirect();
		}
		
		if(!is_null($this->input->post_get('signup'))){

			$user_id=$this->user->add(array(
				'name'=>$this->input->post('username'),
				'password'=>$this->input->post('password'),
				'email'=>$this->input->post('email')
			));

			$this->user->sessionLogin($user_id);

			redirect(urldecode($this->input->post('forward')));

		}
		
		$this->load->view('login', compact('alert'));
		
	}
	
	function signUp(){
		$this->output->title='新用户注册';
		$this->load->view('user/signup');
		$this->load->view('user/signup_sidebar',true,'sidebar');
	}
	
	function profile(){
		
		$people=array_merge_recursive($this->people->get($this->session->user_id),$this->input->sessionPost('people'));
		$people_meta=array_merge_recursive(array_column($this->people->getMeta($this->session->user_id),'content','name'),$this->input->sessionPost('people'));
		$this->load->addViewArrayData(compact('people','people_meta'));
		
		$this->output->title='用户资料';
		$this->load->view('user/profile');
		$this->load->view('user/profile_sidebar',true,'sidebar');
	}
	
	function config($item = null){
		
		switch($this->input->method){
			case 'GET':
				break;
			
			case 'POST':
				$data = $this->input->data();
				
				if(is_array($data)){
					foreach($data as $key => $value){
						$this->user->config($key, $value);
					}
				}
				else{
					$this->user->config($item, $data);
				}
				
				break;
		}
		
		$config = is_null($item) ? $this->user->config() : array($item=>$this->user->config($item));
		
		$this->output->set_output((object)$config);
		
	}
	
}
?>
