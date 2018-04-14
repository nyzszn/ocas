<?php
header('Content-type:application/json');

// register an adopter
function registerAdopter()
{
	$conn = connect_db();

    //required fields
	$first_name = isescape('first_name');
    $last_name = isescape('last_name');
    $middle_name = isescape('middle_name');
	$telephone = isescape('telephone');
    $residence = isescape('residence');
    $email_address = isescape('email_address');
    $nationality = isescape('nationality');
    $gender = isescape('gender');
    $user_image = 'default.png';
    $username = isescape('username');
    $password = isescape('password');
    //rehashed password
    $reharshed = password_hash($password, PASSWORD_DEFAULT);

    
    //$date_added = NOW();

    //sql query
    $sql = $conn->prepare("INSERT INTO adopter (first_name, last_name, middle_name, telephone, residence, email_address, nationality, gender, user_image, username, password)
    VALUES (?,?,?,?,?,?,?,?,?,?,?)");
		$sql->bind_param("sssssssisss", $a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k);
		$a = $first_name;
		$b = $last_name;
		$c = $middle_name;
		$d = $telephone;
		$e = $residence;
		$f = $email_address;
        $g = $nationality;
        $h = $gender;
        $i = $user_image;
        $j = $username;
        $k = $reharshed;


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
			'message' => 'Adopter has been Registered'
		));
		exit();
	}
}



	//get all Adopters
    function getAllAdopters()
    {
        $conn = connect_db();
        $sql = "SELECT * FROM adopter";
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
                    'message' => 'There are no adopters registered'
                ));
                exit();
            }
        }
    }

    //get dhild by id
    function getAdopterById($id = '')
{
	$conn = connect_db();
	$sql = "SELECT * FROM adopter WHERE id=$id LIMIT 1";
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
				'message' => 'Adopter not registered'
			));
			exit();
		}
	}
}

	//update child data
	function updateAdopter($id = '')
	{
		$conn = connect_db();
		
        //required fields
        $first_name = isescape('first_name');
        $last_name = isescape('last_name');
        $middle_name = isescape('middle_name');
        $telephone = isescape('telephone');
        $residence = isescape('residence');
        $email_address = isescape('email_address');
        $nationality = isescape('nationality');
        $gender = isescape('gender');
    
    //sql query
    $sql = $conn->prepare("UPDATE adopter SET first_name=?, last_name=?, middle_name=?, telephone=?, residence=?, email_address=?, nationality=?, gender=? WHERE id=?");
		$sql->bind_param("sssssssii", $a, $b, $c, $d, $e, $f, $g, $h, $i);
		$a = $first_name;
		$b = $last_name;
		$c = $middle_name;
		$d = $telephone;
		$e = $residence;
		$f = $email_address;
        $g = $nationality;
        $h = $gender;
        $i = $id;
	
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
				'message' => 'Adopter\'s data has been updated'
			));
			exit();
		}
	
	
	}

	//delete child
	function deleteAdopter($id = '')
	{
		$conn = connect_db();

		$sql = $conn->prepare("DELETE FROM adopter WHERE id=? LIMIT 1");
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
				'message' => 'Adopter has been removed From the System'
			));
			exit();

		}
	}
	
	function adopterLogin()
	{
		$conn = connect_db();

		$username = isescape('username');
		$password = isescape('password');

		$loginSql = "SELECT * FROM adopter WHERE username ='$username' LIMIT 1";
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
				$_SESSION['ocas-user_account'] ='adopter';

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
 
function adopterPassword($id){
	$conn = connect_db();
		
        //required fields
        $password = isescape('password');
		   //rehashed password
		   $reharshed = password_hash($password, PASSWORD_DEFAULT);
    //sql query
    $sql = $conn->prepare("UPDATE adopter SET password=? WHERE id=?");
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
				'message' => 'Adopter\'s password has been updated'
			));
			exit();
		}
}
function setAdopterPhoto($id = '')
{
	$conn = connect_db();
	if (isset($_FILES['user_image'])) {

		$uploadedFile = uploadPhoto('user_image', '../uploads');

		$sql = $conn->prepare("UPDATE adopter SET user_image=? WHERE id=? ");
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