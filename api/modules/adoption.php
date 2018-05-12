<?php
header('Content-type:application/json');

// register an adopter
function adopt()
{
	$conn = connect_db();

    //required fields
	$adopter_id = isescape('adopter_id');
    $child_id = isescape('child_id');
	$marital = isescape('marital');
	$proffession = isescape('proffession');
	$income = isescape('income');
	$reason = isescape('reason');
	$language = isescape('language');
	$status = 0;
	$department_worker_id = 0;

   //sql query
	checkIfAdopted($adopter_id, $child_id);
	
    $sql = $conn->prepare("INSERT INTO adoption (adopter_id, child_id, department_worker_id, status, marital, proffession, income, reason, language) VALUES (?,?,?,?,?,?,?,?,?)");
		$sql->bind_param("iiiississ", $a, $b, $c, $d, $e, $f, $g, $h, $i);
		$a = $adopter_id;
		$b = $child_id;
		$c = $department_worker_id;
		$d = $status;
		$e = $marital;
		$f = $proffession;
		$g = $income; 
		$h = $reason;
		$i = $language;

		//updateChildStatus($child_id, $status);
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
		//SELECT adoption.id, adopter.first_name AS adopter_f, adopter.last_name AS adopter_l, adopter.middle_name  AS adopter_m, child.first_name  AS child_f, child.last_name  AS child_l, child.middle_name  AS child_m, adoption.status, adoption.remarks FROM adoption INNER JOIN adopter ON adopter.id = adoption.adopter_id INNER JOIN child on child.id = adoption.child_id WHERE adoption.department_worker_id =0
        $sql = "SELECT adoption.id, adopter.first_name AS adopter_f, child.adopted, adopter.last_name AS adopter_l, adopter.middle_name  AS adopter_m, child.first_name  AS child_f, child.last_name  AS child_l, child.middle_name  AS child_m, adoption.status, adoption.remarks FROM adoption INNER JOIN adopter ON adopter.id = adoption.adopter_id INNER JOIN child on child.id = adoption.child_id WHERE adoption.department_worker_id =0";
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

		//get all my adoptions
function getAllMyAdoptions($id)
    {
        $conn = connect_db();
        $sql = "SELECT adoption.id, adoption.adopter_id, adoption.child_id, adopter.first_name AS adopter_f, child.adopted, adopter.last_name AS adopter_l, adopter.middle_name  AS adopter_m, child.first_name  AS child_f, child.last_name  AS child_l, child.middle_name  AS child_m, adoption.status, adoption.remarks FROM adoption INNER JOIN adopter ON adopter.id = adoption.adopter_id INNER JOIN child on child.id = adoption.child_id WHERE adoption.department_worker_id =$id";
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

	function checkIfAdopted($adopter_id, $child_id)
    {
        $conn = connect_db();
        $sql = "SELECT id  FROM adoption WHERE adopter_id=$adopter_id AND child_id=$child_id";
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
                    'status' => 'failed',
                    'message' => 'You Have already applied to adopt this child'
                ));
                exit();
            }
            else if ($result->num_rows <= 0) {
    
                return true;
            }
        }
    }

    //get by id
    function getAdoptionById($id = '')
{
	$conn = connect_db();
	//SELECT adoption.id, adopter.first_name AS adopter_f, adopter.last_name AS adopter_l, adopter.middle_name  AS adopter_m, child.first_name  AS child_f, child.last_name  AS child_l, child.middle_name  AS child_m, adoption.status, adoption.remarks FROM adoption INNER JOIN adopter ON adopter.id = adoption.adopter_id INNER JOIN child on child.id = adoption.child_id WHERE adoption.id =1 LIMIT 1
	$sql = "SELECT adoption.marital, adoption.proffession, adoption.income, adoption.reason, adoption.language, adoption.id, adoption.child_id, adoption.adopter_id, child.date_of_birth AS c_date_of_birth, child.adopted, child.about, child.sex AS child_gender, child.date_added, adopter.first_name AS adopter_f, adopter.user_image AS adopter_image, child.user_image AS child_image, adopter.last_name AS adopter_l, adopter.telephone, adopter.residence, adopter.nationality, adopter.gender AS adopter_gender, adopter.middle_name  AS adopter_m, child.first_name  AS child_f, child.last_name  AS child_l, child.middle_name  AS child_m, adoption.status, adoption.remarks FROM adoption INNER JOIN adopter ON adopter.id = adoption.adopter_id INNER JOIN child on child.id = adoption.child_id WHERE adoption.id=$id LIMIT 1";
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

    //get dhild by id
    function getAdoptionByAdopter($id = '')
{
	$conn = connect_db();
	//SELECT adoption.id, adopter.first_name AS adopter_f, adopter.last_name AS adopter_l, adopter.middle_name  AS adopter_m, child.first_name  AS child_f, child.last_name  AS child_l, child.middle_name  AS child_m, adoption.status, adoption.remarks FROM adoption INNER JOIN adopter ON adopter.id = adoption.adopter_id INNER JOIN child on child.id = adoption.child_id WHERE adoption.department_worker_id =$id
	$sql = "SELECT adoption.id, child.first_name  AS child_f, child.adopted, child.last_name  AS child_l, child.middle_name  AS child_m, adoption.status, adoption.remarks FROM adoption INNER JOIN adopter ON adopter.id = adoption.adopter_id INNER JOIN child on child.id = adoption.child_id WHERE adopter_id = $id ";
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
    function checkIfnotAdoptedByAnother($adopter= '', $child='')
{
	$conn = connect_db();
	//SELECT adoption.id, adopter.first_name AS adopter_f, adopter.last_name AS adopter_l, adopter.middle_name  AS adopter_m, child.first_name  AS child_f, child.last_name  AS child_l, child.middle_name  AS child_m, adoption.status, adoption.remarks FROM adoption INNER JOIN adopter ON adopter.id = adoption.adopter_id INNER JOIN child on child.id = adoption.child_id WHERE adoption.department_worker_id =$id
	$sql = "SELECT adoption.id FROM adoption INNER JOIN child on child.id = adoption.child_id AND child.adopted =2 WHERE adopter_id !=$adopter AND child_id =$child";
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
				'status' => 'failed',
				'message' => 'Child has already been adopted'
			));
			exit();
		}
		else if ($result->num_rows <= 0) {

			return true;
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
		$child = isescape('child');
		$adopter = isescape('adopter');
        $department_worker_id = isescape('department_worker_id');
		if($status==2 || $status =="2"){
			checkIfnotAdoptedByAnother($adopter, $child);
			updateChildStatus($id, $status);
		}
		else{
			updateChildStatus($id, 0);
		}
    
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
		//update child data
		function updateChildStatus($id = '', $status='')
		{
			$conn = connect_db();
			//required data
		
		
			$sql = $conn->prepare("UPDATE child SET adopted=? WHERE id=? ");
			$sql->bind_param("ii", $a, $b);
			$a = $status;
			$b = $id;
			if (!$sql->execute()) {
				echo json_encode(array(
					'status' => 'error',
					'message' => mysqli_error($conn)
				));
				exit();
			}
			else {
				return true;
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