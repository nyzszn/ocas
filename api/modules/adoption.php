<?php
header('Content-type:application/json');

// register an adopter
function adopt()
{
	$conn = connect_db();

    //required fields
	$adopter_id = isescape('adopter_id');
    $child_id = isescape('child_id');
    $status = 0;

   //sql query
    $sql = $conn->prepare("INSERT INTO adoption (adopter_id, child_id, status) VALUES (?,?,?)");
		$sql->bind_param("iii", $a, $b, $c);
		$a = $adopter_id;
		$b = $child_id;
		$c = $status;



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
			'message' => 'Adopter process has been initiiated'
		));
		exit();
	}
}



	//get all adoptions
    function getAllAdoptions()
    {
        $conn = connect_db();
        $sql = "SELECT * FROM adoption";
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
                    'message' => 'There are no adoptions available'
                ));
                exit();
            }
        }
    }

    //get dhild by id
    function getAdoptionById($id = '')
{
	$conn = connect_db();
	$sql = "SELECT * FROM adoption WHERE id=$id LIMIT 1";
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
				'message' => 'Adoption is not available'
			));
			exit();
		}
	}
}


	//update child data
	function updateAdoption($id = '')
	{
		$conn = connect_db();
		
        //required fields
        $status = isescape('status');
        $remarks = isescape('remarks');
        $department_worker_id = isescape('department_worker_id');
    
    //sql query
    $sql = $conn->prepare("UPDATE adoption SET status=?, remarks=?, department_worker_id=? WHERE id=?");
		$sql->bind_param("isii", $a, $b, $c, $d);
		$a = $status;
		$b = $remarks;
        $c = $department_worker_id;
        $d = $id;
        
		
	
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
				'message' => 'Adoption details have been updated'
			));
			exit();
		}
	
	
	}

   
	//delete adoption
	function deleteAdoption($id = '')
	{
		$conn = connect_db();

		$sql = $conn->prepare("DELETE FROM adoption WHERE id=? LIMIT 1");
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
				'message' => 'Adoption process has been canceled'
			));
			exit();

		}
    }
    
  

?>