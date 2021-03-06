<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends REST_Controller {

	public function login()
	{
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|max_length[256]');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[256]');
		return Validation::validate($this, '', '', function($token, $output)
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$login = $this->Users->login($email, $password);
			if ($login != false) {
				$token = array();
				$token['pid'] = $login->pid;
				$output['status'] = TRUE;
				$output['email'] = $email;
				$output['user'] = $login->user;
				$output['first_name'] = $login->first_name;
				$output['last_name'] = $login->last_name;
				$output['token'] = JWT::encode($token, $this->config->item('jwt_key'), 'HS512');
			}
			else
			{
				$output['status'] = FALSE;
				$output['errors'] = '{"type": "invalid"}';
			}
			return $output;
		});
	}

	public function register()
	{
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]|max_length[256]');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[256]');
		return Validation::validate($this, '', '', function($token, $output)
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$this->Users->register($email, $password);
			$output['status'] = true;
			return $output;
		});
	}

	public function permissions()
	{
		$this->form_validation->set_rules('resource', 'resource', 'required');
		return Validation::validate($this, 'user', 'read', function($token, $output)
		{
			$resource = $this->input->post('resource');
			$acl = new ACL();
			$permissions = $acl->userPermissions($token->id, $resource);
			$output['status'] = true;
			$output['resource'] = $resource;
			$output['permissions'] = $permissions;
			return $output;
		});
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */