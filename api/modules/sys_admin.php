<?php
header('Content-type:application/json');

// register an sys admin
function registerSysAdmin()
{
	$conn = connect_db();

    //required fields
	$username = isescape('username');
    $password = isescape('password');
    $full_names = isescape('full_names');
	$email = isescape('email');

    //rehashed password
    $reharshed = password_hash($password, PASSWORD_DEFAULT);

    //sql query
    $sql = $conn->prepare("INSERT INTO system_admin (username, password, full_names, email) VALUES (?,?,?,?)");
		$sql->bind_param("ssss", $a, $b, $c, $d);
		$a = $username;
		$b = $reharshed;
		$c = $full_names;
		$d = $email;
		

       //housekeeping
	if (!$sql->execute()) {
		echo json_encode(array(
			'status' => 'error',
			'message' => mysqli_error($conn)
		));
		exit();
	}
	else {
		echo json_encode(array(
			'status' => 'success',
			'message' => 'System Admin has been Registered'
		));
		exit();
	}
}







    //get department_worker by id
    function getSysAdminById($id = '')
{
	$conn = connect_db();
	$sql = "SELECT * FROM system_admin WHERE id=$id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if (!$result) {

		echo json_encode(array(
			'status' => 'error',
			'message' => mysqli_error($conn)
		));
		exit();
	}
	else {

		if ($result->num_rows > 0) {

			echo json_encode(array(
				'status' => 'success',
				'data' => $result->fetch_all(MYSQLI_ASSOC)
			));
			exit();
		}
		else if ($result->num_rows <= 0) {

			echo json_encode(array(
				'status' => 'failed',
				'message' => 'System Admin not registered'
			));
			exit();
		}
	}
}


	//update Sys admin
	function updateSysAdmin($id = '')
	{
		$conn = connect_db();
		
        //required fields
        $full_names = isescape('full_names');
        $email = isescape('email');
    
    //sql query
    $sql = $conn->prepare("UPDATE system_Admin SET full_names=?, email=? WHERE id=?");
		$sql->bind_param("ssi", $a, $b, $c);
		$a = $full_names;
		$b = $email;
		$c = $id;
		
	
		if (!$sql->execute()) {
			echo json_encode(array(
				'status' => 'error',
				'message' => mysqli_error($conn)
			));
			exit();
		}
		else {
			echo json_encode(array(
				'status' => 'success',
				'message' => 'System Admin\'s data has been updated'
			));
			exit();
		}
	
	
    }
    
    

	//delete system admin
	function deleteSysAdmin($id = '')
	{
		$conn = connect_db();

		$sql = $conn->prepare("DELETE FROM system_Admin WHERE id=? LIMIT 1");
		$sql->bind_param("i", $id);
		$id = $id;

		if (!$sql->execute()) {
			echo json_encode(array(
				'status' => 'error',
				'message' => mysqli_error($conn)
			));
			exit();
		}
		else {

			echo json_encode(array(
				'status' => 'success',
				'message' => 'System Admin has been removed From the System'
			));
			exit();

		}
	}
	function adminLogin()
	{
		$conn = connect_db();

		$username = isescape('username');
		$password = isescape('password');

		$loginSql = "SELECT * FROM system_admin WHERE username ='$username' LIMIT 1";
		$result = $conn->query($loginSql);

		if (!$result) {
			echo json_encode(array(
				'status' => 'error',
				'message' => mysqli_error($conn)
			));
			exit();
		}
		else if ($result->num_rows === 1) {

			$user = $result->fetch_array(MYSQLI_ASSOC);

			if (password_verify($password, $user['password'])) {
				$_SESSION['ocas-user_id'] = $user['id'];
				$_SESSION['ocas-user_name'] = $user['username'];
				$_SESSION['ocas-user_account'] ='admin';

				echo json_encode(array(
					'status' => 'success'

				));
				exit();

			}
			else {

				echo json_encode(array(
					'status' => 'failed',
					'message' => 'Password combination does not match the Username: ' . $user['username']
				));
				exit();
			}
		}
		else {

			echo json_encode(array(
				'status' => 'failed',
				'message' => 'Username does not exist'
			));
			exit();
		}

}

function saPassword($id){
	$conn = connect_db();
		
        //required fields
        $password = isescape('password');
		   //rehashed password
		   $reharshed = password_hash($password, PASSWORD_DEFAULT);
    //sql query
    $sql = $conn->prepare("UPDATE system_Admin SET password=? WHERE id=?");
		$sql->bind_param("si", $a, $b);
		$a = $reharshed;
		$b = $id;
	
	
		if (!$sql->execute()) {
			echo json_encode(array(
				'status' => 'error',
				'message' => mysqli_error($conn)
			));
			exit();
		}
		else {
			echo json_encode(array(
				'status' => 'success',
				'message' => 'System Admin\'s password has been updated'
			));
			exit();
		}
}


    


?>