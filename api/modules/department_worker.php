<?php
header('Content-type:application/json');

// register an adopter
function registerDepartmentWorker()
{
	$conn = connect_db();

    //required fields
	$name = isescape('name');
    $username = isescape('username');
    $gender = isescape('gender');
	$telephone = isescape('telephone');
    $email_address = isescape('email_address');
    $image = "default.png";
    $password = isescape('password');

    //rehashed password
    $reharshed = password_hash($password, PASSWORD_DEFAULT);

    //sql query
    $sql = $conn->prepare("INSERT INTO department_worker (name, username, gender, telephone, email_address, image, password) VALUES (?,?,?,?,?,?,?)");
		$sql->bind_param("ssissss", $a, $b, $c, $d, $e, $f, $g);
		$a = $name;
		$b = $username;
		$c = $gender;
		$d = $telephone;
		$e = $email_address;
		$f = $image;
        $g = $reharshed;

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
			'message' => 'Department Worker has been Registered'
		));
		exit();
	}
}



	//get all department_workers
    function getAllDepartmentWorkers()
    {
        $conn = connect_db();
        $sql = "SELECT * FROM department_worker";
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
                    'message' => 'There are no department_workers registered'
                ));
                exit();
            }
        }
    }


    //get department_worker by id
    function getDepartmentWorkerById($id = '')
{
	$conn = connect_db();
	$sql = "SELECT * FROM department_worker WHERE id=$id LIMIT 1";
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
				'message' => 'Department Worker not registered'
			));
			exit();
		}
	}
}


	//update department worker data
	function updateDepartmentWorker($id = '')
	{
		$conn = connect_db();
		
        //required fields
        $name = isescape('name');
        $gender = isescape('gender');
        $telephone = isescape('telephone');
        $email_address = isescape('email_address');
    
    //sql query
    $sql = $conn->prepare("UPDATE department_worker SET name=?, gender=?, telephone=?, email_address=? WHERE id=?");
		$sql->bind_param("sissi", $a, $b, $c, $d, $e);
		$a = $name;
		$b = $gender;
		$c = $telephone;
		$d = $email_address;
		$e = $id;
	
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
				'message' => 'Department worker\'s data has been updated'
			));
			exit();
		}
	
	
	}

	//delete department worker
	function deleteDepartmentWorker($id = '')
	{
		$conn = connect_db();

		$sql = $conn->prepare("DELETE FROM department_worker WHERE id=? LIMIT 1");
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
				'message' => 'Department worker has been removed From the System'
			));
			exit();

		}
    }
    function dwLogin()
	{
		$conn = connect_db();

		$username = isescape('username');
		$password = isescape('password');

		$loginSql = "SELECT * FROM department_worker WHERE username ='$username' LIMIT 1";
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
				$_SESSION['ocas-user_account'] ='department_worker';

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
function dwPassword($id){
	$conn = connect_db();
		
        //required fields
        $password = isescape('password');
		   //rehashed password
		   $reharshed = password_hash($password, PASSWORD_DEFAULT);
    //sql query
    $sql = $conn->prepare("UPDATE department_worker SET password=? WHERE id=?");
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
				'message' => 'Department Worker\'s password has been updated'
			));
			exit();
		}
}

function setDwPhoto($id = '')
{
	$conn = connect_db();
	if (isset($_FILES['user_image'])) {

		$uploadedFile = uploadPhoto('user_image', '../uploads');

		$sql = $conn->prepare("UPDATE department_worker SET image=? WHERE id=? ");
		$sql->bind_param("si", $a, $b);
		$a = $uploadedFile;
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
				'message' => 'user_image Updated'
			));
			exit();
		}
	}
	else {
		echo json_encode(array(
			'status' => 'error',
			'message' => 'user_image is required'
		));
		exit();
	}

}


?>