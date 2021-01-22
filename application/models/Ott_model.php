<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ott_model extends CI_Model {

	public function checklogin($data)
	{
		$a_email    = $data['a_email'];
		$a_password = $data['a_password'];
		return $this->db->where('a_email',$a_email,'a_password',$a_password)->get('login');
	}
	
	public function getgenre()
	{
		return $this->db->get('genre')->result_array();
	}
	
	public function getmovies()
	{
		return $this->db->join('genre', 'movies.m_genre =genre.g_id', 'left')->get('movies')->result_array();
	}
	
	public function moviedelete($mid)
	{
		$this->db->where('m_id', $mid);
        $this->db->delete('movies'); 
	}
	
	public function movieview($mid)
	{
		return $this->db->where('m_id',$mid)->join('genre', 'movies.m_genre =genre.g_id', 'left')->get('movies')->row();
	}
}
