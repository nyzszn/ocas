<?php
header('Content-type:application/json');

// register a child
function registerChild()
{
	$conn = connect_db();

    //required fields
	$first_name = isescape('first_name');
	$last_name = isescape('last_name');
	$image = 'default.png';
	$sex = isescape('sex');
	$date_of_birth = isescape('date_of_birth');
    $about = isescape('about');
    $middle_name = isescape('middle_name');
    //$date_added = NOW();

    //sql query
	$sql = "INSERT INTO child (first_name, last_name, user_image, sex, date_of_birth, about, middle_name, date_added)
    VALUES ('$first_name', '$last_name', '$image', '$sex', '$date_of_birth', '$about', '$middle_name', CURRENT_DATE())";

    //execute sql query
	$result = mysqli_query($conn, $sql);

    //housekeeping
	if (!$result) {
		echo json_encode(array(
			'status' => 'error',
			'message' => mysqli_error($conn)
		));
		exit();
	}
	else {
		echo json_encode(array(
			'status' => 'success',
			'message' => 'Child is Registered'
		));
		exit();
	}
}


	//get all Children
    function getAllChildren()
    {
        $conn = connect_db();
        $sql = "SELECT * FROM child WHERE adopted != 2";
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
                    'message' => 'There are no children registered'
                ));
                exit();
            }
        }
	}
	
		//get all Children
    function getAllChildrenEvenAdopted()
    {
        $conn = connect_db();
        $sql = "SELECT * FROM child";
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
                    'message' => 'There are no children registered'
                ));
                exit();
            }
        }
	}
	

    //get dhild by id
    function getChildById($id = '')
{
	$conn = connect_db();
	$sql = "SELECT * FROM child WHERE id=$id";
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
				'message' => 'Child not registered'
			));
			exit();
		}
	}
}

	//update child data
	function updateChild($id = '')
	{
		$conn = connect_db();
		
		//required data
		$first_name = isescape('first_name');
		$last_name = isescape('last_name');
		$sex = isescape('sex');
		$date_of_birth = isescape('date_of_birth');
    	$about = isescape('about');
    	$middle_name = isescape('middle_name');
	
	
	
		$sql = $conn->prepare("UPDATE child SET first_name=?, last_name=?, sex=?, date_of_birth=?, about=?, middle_name=? WHERE id=? ");
		$sql->bind_param("ssisssi", $a, $b, $c, $d, $e, $f, $g);
		$a = $first_name;
		$b = $last_name;
		$c = $sex;
		$d = $date_of_birth;
		$e = $about;
		$f = $middle_name;
		$g = $id;
	
	
	
	
	
	
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
				'message' => 'Child data has been updated'
			));
			exit();
		}
	
	
	}

	//delete child
	function deleteChild($id = '')
	{
		$conn = connect_db();

		$sql = $conn->prepare("DELETE FROM child WHERE id=? LIMIT 1");
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
				'message' => 'Child has been removed From the System'
			));
			exit();

		}
	}
	function setChildPhoto($id = '')
{
	$conn = connect_db();
	if (isset($_FILES['user_image'])) {

		$uploadedFile = uploadPhoto('user_image', '../uploads');

		$sql = $conn->prepare("UPDATE child SET user_image=? WHERE id=? ");
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