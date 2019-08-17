<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}
	
	public function index()
	{
		$data['title'] = 'Profile';
		$data['subtitle'] = '';
		$data['user']= $this->ion_auth->user()->row();
		// /$data['grup'] = $this->ion_auth->get_users_groups($user->id)->result();
        $data['crumb'] = [
            'Profile' => '',
        ];
        //$this->layout->set_privilege(1);
        
        //edit profile
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $data['user']->id)))
		{
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($data['user']->id)->row();
		
		

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'trim|required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'trim|required');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'trim|required');

		if (isset($_POST) && !empty($_POST))
		{
			
			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'company' => $this->input->post('company'),
					'phone' => $this->input->post('phone'),
					
				);

				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}

				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					// Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData))
					{

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp)
						{
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
				}

				// check to see if we are updating the user
				if ($this->ion_auth->update($user->id, $data))
				{
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->update_image($user->id);
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					$this->redirectUser();

				}
				else
				{
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					$this->redirectUser();

				}

			}
		}

		// display the edit user form
		// $data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$data['user'] = $user;
		
		

		$data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
			'class' => 'form-control'
			
		);
		$data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
			'class' => 'form-control'
			
		);
		$data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
			'class' => 'form-control'
		);
		$data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
			'class' => 'form-control'
		);
		$data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password',
			'class' => 'form-control'
		);
		$data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password',
			'class' => 'form-control'
		);
		
			


		$data['user'] = $this->ion_auth->user($data['user']->id)->row();
        //$data['page'] = 'auth/edit_user';
        $data['page'] = 'profile';
        //$this->load->view('template/backend', $data);
		//$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'edit_user', $data);
		$this->load->view('template/backend', $data);
	}

	public function redirectUser(){
		if ($this->ion_auth->is_admin()){
			redirect('users', 'refresh');
		}
		redirect('/', 'refresh');
	}


	public function update_image($user_id)
	{
		if($_FILES['userfile']['tmp_name']!=""){

	 		if($_FILES['userfile']['size'] > 0 && $_FILES['userfile']['error'] == 0 && ($_FILES['userfile']['type'] == "image/jpeg" || $_FILES['userfile']['type'] == "image/png")) 
	 		{  
	            $photo['filename'] = $_FILES['userfile']['name'];
	            $photo['filesize'] = $_FILES['userfile']['size'];
	            $photo['filetype'] = 'image/jpeg';
	            $tmpName  = $_FILES['userfile']['tmp_name'];
	            $fp      = fopen($tmpName, 'r');
	            $content = fread($fp, filesize($tmpName));
	            fclose($fp);
	            if(!get_magic_quotes_gpc()) {
	                $photo['filename'] = addslashes($photo['filename']);
	            }

	            // get originalsize of image
	            $im = imagecreatefromstring($content);
	            $width = imagesx($im);
	            $height = imagesy($im);            
	            // Set thumbnail-height to 180 pixels
	            $imgh = 300;                                          
	            // calculate thumbnail-height from given width to maintain aspect ratio
	            $imgw = $width / $height * $imgh;                                          
	            // create new image using thumbnail-size
	            $thumb=imagecreatetruecolor($imgw,$imgh);                  
	            // copy original image to thumbnail
	            imagecopyresampled($thumb,$im,0,0,0,0,$imgw,$imgh,ImageSX($im),ImageSY($im)); //makes thumb

	            $thumbsdir = ini_get('upload_tmp_dir') ;
	            imagejpeg($thumb, $thumbsdir.$photo['filename'], 80);  //imagejpeg($resampled, $fileName, $quality);            
	            $instr = fopen($thumbsdir.$photo['filename'],"rb");  //need to move this to a safe directory
	            $image = fread($instr,filesize($thumbsdir.$photo['filename']));

	            $photo['filecontent']  = $image;
	            //unlink($thumbsdir.$photo['filename']);
	           	$image = base64_encode($photo['filecontent']); //die();
	            $image_name = addslashes($photo['filename']);
				$additional_data['foto']=$image;
				$additional_data['foto_nama']=$image_name;

				$this->db->where('id',$user_id);
				$res = $this->db->update('users',$additional_data);
				if($res)
				{
					return true;
				}
				else
				{
					return false;
				}
	        } 
	        else
	        {
	        	return false;
	        } 	
		}
	}	
}
