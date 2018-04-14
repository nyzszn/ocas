<?php
header('Content-type:application/json');
if (!isset($_SESSION)) {
	session_start();
}
	function welcome(){
		echo json_encode(array(
			'status'=>'success',
			'message'=>'Welcome to the Online child adoption System Api.'
		));
		exit();
	}
	function isescape($elem = '')
	{
		$conn = connect_db();
		if (isset($_POST[$elem]) && !empty($_POST[$elem]))
		{
			$elem = mysqli_real_escape_string($conn, $_POST[$elem]);
			return $elem;
		}
		else
		{
			echo json_encode(array(
				'status' => 'error',
				'message' => $elem . ' is not provided'
			));
			exit();
		}
	}
	
	
	function uploadPhoto($file = '', $upload_dir='')
	{
		
		$check = getimagesize($_FILES[$file]["tmp_name"]);
		if ($check !== false)
		{
			
			$tmp_file    = $_FILES[$file]['tmp_name'];
			$target_file = basename($_FILES[$file]['name']);
			
			$location    = "";
			if (file_exists($upload_dir . "/" . $target_file))
			{
				$random_digits = rand(0000, 9999);
				$target_file   = basename($random_digits . $target_file);
				if (copy($tmp_file, $upload_dir . "/" . $target_file))
				{
					$location = $target_file;
					return $location;
				}
			}
				else
				{
					//moving uploaded file
					if (move_uploaded_file($tmp_file, $upload_dir . "/" . $target_file))
					{
						$location = $target_file;
						
						return $location;
					}
					
					
				}
				
				
			
		}
		else
		{
			echo json_encode(array(
				'status' => 'error',
				'message' => 'Image can\'t be uploaded'
			));
			exit();
		}
	}
	
		function uploadDocument($file = '', $upload_dir='')
	{
		
		$check = filesize($_FILES[$file]["tmp_name"]);
		if ($check !== false)
		{
			
			$tmp_file    = $_FILES[$file]['tmp_name'];
			$target_file = basename($_FILES[$file]['name']);
			
			$location    = "";
			if (file_exists($upload_dir . "/" . $target_file))
			{
				$random_digits = rand(0000, 9999);
				$target_file   = basename($random_digits . $target_file);
				if (copy($tmp_file, $upload_dir . "/" . $target_file))
				{
					$location = $target_file;
					return $location;
				}
			}
				else
				{
					//moving uploaded file
					if (move_uploaded_file($tmp_file, $upload_dir . "/" . $target_file))
					{
						$location = $target_file;
						
						return $location;
					}
					
					
				}
				
				
			
		}
		else
		{
			echo json_encode(array(
				'status' => 'error',
				'message' => 'File can\'t be uploaded'
			));
			exit();
		}
	}
	function logout()
{

	$_SESSION = array();
	session_destroy();

	echo json_encode(array(
		'status' => 'success',
		'message' => 'Logged out successfully'
	));
	exit();



}
?>