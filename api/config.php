<?php
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
	function connect_db(){
		static $db;

		if(!isset($db))
		{
			$db_array=parse_ini_file("api.ini",true);
			$db=new mysqli($db_array['host_name'],$db_array['username'],$db_array['password'],$db_array['database']);

			if(!$db)
			{
				die($db->error);
			}

			else
			{
				return $db;
			}
		}

		else
		{
			return $db;
		}
			
	}
	
	function sanitize($db,$data)
	{
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		$data=mysqli_real_escape_string($db,$data);
		return $data;
	}
	
	function val_dob($dob)
	{
		$val_dob=explode('/',$dob);
			if(count($val_dob)==3)
			{
				if(!checkdate($val_dob[0], $val_dob[1], $val_dob[2]))
				{
					$errors['date']="Invalid date,Please provide a valid date";
				}

				else
				{
					$dob=date('Y-m-d', strtotime(str_replace('-', '/', $dob)));
					return $dob;
				}
			}
	}

?>