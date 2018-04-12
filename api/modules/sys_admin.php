<?php
header('Content-type:application/json');

// register an sys admin
function registerSysAdmin()
{
	$conn = connect_db();

    //required fields
	$username = isescape('name');
    $password = isescape('username');
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
    


?>