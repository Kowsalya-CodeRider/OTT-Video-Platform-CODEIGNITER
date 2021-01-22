<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ott extends CI_Controller {
	
	public function index()
	{
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}
	
	public function movies()
	{
		if($this->session->userdata('logged_in')==TRUE)
		{
			$data['movies'] = $this->ott_model->getmovies();
			$this->load->view('header');
			$this->load->view('navbar');
			$this->load->view('ott_view',$data);
			$this->load->view('footer');
		}
		else
		{
			echo '<center><h3>Invalid Session</h3><br /><a href="'.base_url().'">Go to Login</a></center>';
		}
	}
	
	public function logincheck()
	{
		$a_email = $this->security->xss_clean($this->input->post('a_email'));
		$a_password = $this->security->xss_clean(md5($this->input->post('a_password')));
		$data = array('a_email' => $a_email, 'a_password' => $a_password);
		$logincheck = $this->ott_model->checklogin($data);
		$rowcount = $logincheck->num_rows();
		$rowdata = $logincheck->row();
		if($rowcount>0)
		{
			$sessiondata = array(
									'a_name'  	  => $rowdata->a_name,
									'admin_email' => $rowdata->a_email,
									'a_id'		  => $rowdata->a_password,
									'logged_in'   => TRUE
								);
			$this->session->set_userdata($sessiondata);
			redirect('Ott/movies');
		}
		else
		{
			$data['error'] = 'Invalid Credentials';
			$this->load->view('header');
			$this->load->view('login',$data);
			$this->load->view('footer');
		}
	}
	
	public function add_movie()
	{
		if($this->session->userdata('logged_in')==TRUE)
		{
			$data['genre'] = $this->ott_model->getgenre();
			$this->load->view('header');
			$this->load->view('navbar');
			$this->load->view('add_movie',$data);
			$this->load->view('footer');
		}
		else
		{
			echo '<center><h3>Invalid Session</h3><br /><a href="'.base_url().'">Go to Login</a></center>';
		}
	}
	
	public function insertmovie()
	{
		if($this->session->userdata('logged_in')==TRUE)
		{
		$m_name = $this->input->post('m_name');
		$m_description = $this->input->post('m_description');
		$m_genre = $this->input->post('m_genre');
		$m_language = $this->input->post('m_language');
		$m_year = $this->input->post('m_year');
		$m_status = $this->input->post('m_status');
		$url = $this->input->post('m_vedio_link_1');			
		if(!empty($url))
		{  
			parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );     
			$m_vedio_link = $my_array_of_vars['v'];
			$is_link = 1;	
			$thumdata = ' ';
		}
		else
		{
			$_FILES['file']['name']     = $_FILES['m_vedio_link']['name']; 
			$_FILES['file']['type']     = $_FILES['m_vedio_link']['type']; 
			$_FILES['file']['tmp_name'] = $_FILES['m_vedio_link']['tmp_name']; 
			$_FILES['file']['error']     = $_FILES['m_vedio_link']['error']; 
			$_FILES['file']['size']     = $_FILES['m_vedio_link']['size']; 
			 
			$uploadPath = './movies/'; 
			$config['upload_path'] = $uploadPath; 
			$config['allowed_types'] = 'mp4'; 
			$this->load->library('upload', $config); 
			$this->upload->initialize($config); 
			  
			
			if ( ! $this->upload->do_upload('file'))
			{
				$error = $this->upload->display_errors();
				$errordata['error'] = strip_tags($error);
				$errordata['output'] = 0;
				print_r(json_encode($errordata));die;
			}
			else
			{
				$fileData = $this->upload->data(); 
				$uploadData['file_name'] = $fileData['file_name']; 				
				$filedata = $uploadData['file_name'];
			}
			if(!empty($_FILES['m_thumbnail']['name']))
			{
				$_FILES['file']['name']     = $_FILES['m_thumbnail']['name']; 
				$_FILES['file']['type']     = $_FILES['m_thumbnail']['type']; 
				$_FILES['file']['tmp_name'] = $_FILES['m_thumbnail']['tmp_name']; 
				$_FILES['file']['error']     = $_FILES['m_thumbnail']['error']; 
				$_FILES['file']['size']     = $_FILES['m_thumbnail']['size']; 
				 
				$uploadPath = './images/'; 
				$config['upload_path'] = $uploadPath; 
				$config['allowed_types'] = 'jpg|png|jpeg|gif'; 
				$this->load->library('upload', $config); 
				$this->upload->initialize($config); 
				  
				
				if ( ! $this->upload->do_upload('file'))
				{
					$error = $this->upload->display_errors();
					$errordata['error'] = strip_tags($error);
					$errordata['output'] = 0;
					print_r(json_encode($errordata));die;
				}
				else
				{
					$fileData = $this->upload->data(); 
					$uploadData['file_name'] = $fileData['file_name']; 				
					$thumdata = $uploadData['file_name'];
					$m_vedio_link = $filedata;
					$is_link = 0;
				}
			}
			else
			{
				$m_vedio_link = $filedata;
				$is_link = 0;
				$thumdata = 'demo.png';
			}
		}
		
		$mdata = $this->security->xss_clean(array(
						'm_name' 		=> $m_name,
						'm_description' => $m_description,
						'm_genre' 		=> $m_genre,
						'm_language' 	=> $m_language,
						'm_year' 		=> $m_year,
						'm_status' 		=> $m_status,
						'm_vedio_link'  => $m_vedio_link,
						'is_link'		=> $is_link,
						'm_thumdata'	=> $thumdata
					));
		$this->db->insert('movies',$mdata);
		redirect('Ott/movies');
		}
		else
		{
			echo '<center><h3>Invalid Session</h3><br /><a href="'.base_url().'">Go to Login</a></center>';
		}
	}
	
	public function deletemovie()
	{
		if($this->session->userdata('logged_in')==TRUE)
		{
		$m_id = $this->input->post('mid');
		$this->ott_model->moviedelete($m_id);
		echo 1;
		}
		else
		{
			echo '<center><h3>Invalid Session</h3><br /><a href="'.base_url().'">Go to Login</a></center>';
		}
	}
	
	public function viewmovie($m_id)
	{
		if($this->session->userdata('logged_in')==TRUE)
		{
			$data['movie'] = $this->ott_model->movieview($m_id);
			if(empty($data['movie']))
			{
				echo '<center class="text-danger"><h4><b>Invalid Movie Id</b></h4><br /><a href="'.base_url().'Ott/movies" class="btn btn-info">Go to Movies</a></center>';die;
			}
			else
			{
				$this->load->view('header');
				$this->load->view('navbar');
				$this->load->view('movieview',$data);
				$this->load->view('footer');
			}
		}
		else
		{
			echo '<center><h3>Invalid Session</h3><br /><a href="'.base_url().'">Go to Login</a></center>';
		}
	}
	
	public function movieupdate($m_id)
	{
		if($this->session->userdata('logged_in')==TRUE)
		{
		$data['movie'] = $this->ott_model->movieview($m_id);
		if(empty($data['movie']))
		{
			echo '<center class="text-danger"><h4><b>Invalid Movie Id</b></h4><br /><a href="'.base_url().'Ott/movies" class="btn btn-info">Go to Movies</a></center>';die;
		}
		else
		{
			$data['genre'] = $this->ott_model->getgenre();
			$this->load->view('header');
			$this->load->view('navbar');
			$this->load->view('movieedit',$data);
			$this->load->view('footer');
		}
		}
		else
		{
			echo '<center><h3>Invalid Session</h3><br /><a href="'.base_url().'">Go to Login</a></center>';
		}
	}
	
	public function editmovie()
	{
		if($this->session->userdata('logged_in')==TRUE)
		{
		$m_name = $this->input->post('m_name');
		$m_description = $this->input->post('m_description');
		$m_genre = $this->input->post('m_genre');
		$m_language = $this->input->post('m_language');
		$m_year = $this->input->post('m_year');
		$m_status = $this->input->post('m_status');
		$url = $this->input->post('m_vedio_link_1');
		if(!empty($url))
		{  
			parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );     
			$m_vedio_link = $my_array_of_vars['v'];
			$is_link = 1;	
			$thumdata = ' ';
		}
		else
		{
			if(!empty($_FILES['m_vedio_link']['name']))
			{
				$_FILES['file']['name']     = $_FILES['m_vedio_link']['name']; 
				$_FILES['file']['type']     = $_FILES['m_vedio_link']['type']; 
				$_FILES['file']['tmp_name'] = $_FILES['m_vedio_link']['tmp_name']; 
				$_FILES['file']['error']     = $_FILES['m_vedio_link']['error']; 
				$_FILES['file']['size']     = $_FILES['m_vedio_link']['size']; 
				 
				$uploadPath = './movies/'; 
				$config['upload_path'] = $uploadPath; 
				$config['allowed_types'] = 'mp4'; 
				$this->load->library('upload', $config); 
				$this->upload->initialize($config); 
				  
				
				if ( ! $this->upload->do_upload('file'))
				{
					$error = $this->upload->display_errors();
					$errordata['error'] = strip_tags($error);
					$errordata['output'] = 0;
					print_r(json_encode($errordata));die;
				}
				else
				{
					$fileData = $this->upload->data(); 
					$uploadData['file_name'] = $fileData['file_name']; 				
					$filedata = $uploadData['file_name'];
				}
				$m_vedio_link = $filedata;
				$is_link = 0;
			}
			else
			{
				$m_vedio_link = $this->input->post('movie_file');
				$is_link = 0;
			}
			if(!empty($_FILES['m_thumbnail']['name']))
			{
				$_FILES['file']['name']     = $_FILES['m_thumbnail']['name']; 
				$_FILES['file']['type']     = $_FILES['m_thumbnail']['type']; 
				$_FILES['file']['tmp_name'] = $_FILES['m_thumbnail']['tmp_name']; 
				$_FILES['file']['error']     = $_FILES['m_thumbnail']['error']; 
				$_FILES['file']['size']     = $_FILES['m_thumbnail']['size']; 
				 
				$uploadPath = './images/'; 
				$config['upload_path'] = $uploadPath; 
				$config['allowed_types'] = 'jpg|png|jpeg|gif'; 
				$this->load->library('upload', $config); 
				$this->upload->initialize($config); 
				  
				
				if ( ! $this->upload->do_upload('file'))
				{
					$error = $this->upload->display_errors();
					$errordata['error'] = strip_tags($error);
					$errordata['output'] = 0;
					print_r(json_encode($errordata));die;
				}
				else
				{
					$fileData = $this->upload->data(); 
					$uploadData['file_name'] = $fileData['file_name']; 				
					$thumdata = $uploadData['file_name'];
					
				}
			}
			else
			{
				$thumdata = $this->input->post('movie_thumdata');
			}
		}
		
		$mdata = $this->security->xss_clean(array(
						'm_name' 		=> $m_name,
						'm_description' => $m_description,
						'm_genre' 		=> $m_genre,
						'm_language' 	=> $m_language,
						'm_year' 		=> $m_year,
						'm_status' 		=> $m_status,
						'm_vedio_link'  => $m_vedio_link,
						'is_link'		=> $is_link,
						'm_thumdata'	=> $thumdata
					));
		$this->db->update('movies',$mdata);
		redirect('Ott/movies');
		}
		else
		{
			echo '<center><h3>Invalid Session</h3><br /><a href="'.base_url().'">Go to Login</a></center>';
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Ott/index');
	}
}
