<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Media extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		//$backkey = $_SERVER['HTTP_JSESSIONID'];
		$backkey = "XXYUJAHAH1123444ASDF";
		$this->load->helper('file');
		$this->load->library('encrypt');
		$string = read_file('./media/mp3/song-encrypt.mp3');
		$decrypted_file = $this->encrypt->decode($string, $backkey);
		
		if ( ! write_file('./media/mp3/song-dencrypt.mp3', $decrypted_file))
		{
			die( 'Unable to write the file');
		}
		else
		{
			 echo 'File written!';
		}
		//
		//ob_start(); 
		//header("Content-Type: audio/mpeg"); 
		//print $decypted_file;
		//ob_end_flush(); 
		
		ob_start(); 
		header("Expires: Mon, 20 Dec 1977 00:00:00 GMT"); 
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		header("Cache-Control: no-store, no-cache, must-revalidate"); 
		header("Cache-Control: post-check=0, pre-check=0", false); 
		header("Pragma: no-cache"); 
		header("Content-Type: application/octer-stream"); 
		print $decrypted_file;
		ob_end_flush(); 
		
	}
	
	public function encrypt()
	{
		echo "Testing controller";
		$this->load->helper('file');
		$this->load->library('encrypt');
		$key = "XXYUJAHAH1123444ASDF";
		$string = read_file('./media/mp3/song.mp3');
		$encrypted_file = $this->encrypt->encode($string, $key);
		
		if ( ! write_file('./media/mp3/song-encrypt.mp3', $encrypted_file))
		{
			 echo 'Unable to write the file';
		}
		else
		{
			 echo 'File written!';
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */