<?php  

require_once 'dbConfig.php';

function getAllapplicants($pdo) {
	$sql = "SELECT * FROM applicants_data
			ORDER BY first_name ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getApplicantByID($pdo, $applicant_id) {
	$sql = "SELECT * from applicants_data WHERE applicant_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$applicant_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function searchForAapplicant($pdo, $searchQuery) {
	$sql = "SELECT * FROM applicants_data WHERE 
			CONCAT(first_name, last_name, contact_number, gender, age,
				address, role, speciality, nationality, date_added) 
			LIKE ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%" . $searchQuery . "%"]);

    //FOR ACTIVITY LOGS RECORD
	// Check if the same query has been logged recently, this will prevent the records of search from multiplying
	$recentLogCheck = $pdo->prepare(
		"SELECT * FROM activity_logs 
		 WHERE username = ? AND action = 'Searched applicants' 
		 AND details = ? 
		 AND timestamp >= NOW() - INTERVAL 1 MINUTE"
	);
	$recentLogCheck->execute([$_SESSION['username'], "Search query: $searchQuery"]);
	
	if ($recentLogCheck->rowCount() === 0) {
		// Log the search activity
		$action = "Searched applicants";
		$details = "Search query: $searchQuery";
		$logStmt = $pdo->prepare(
			"INSERT INTO activity_logs (username, action, details) VALUES (?, ?, ?)"
		);
		$logStmt->execute([$_SESSION['username'], $action, $details]);
	}

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

//CRUD FUNCTIONALITIES
function insertNewApplicant($pdo, $first_name, $last_name, $contact_number, 
	$gender, $age, $address, $role, $speciality, $nationality) {

	$sql = "INSERT INTO applicants_data
			(
				first_name,
				last_name,
				contact_number,
				gender,
                age,
				address,
				role,
                speciality,
				nationality
			)
			VALUES (?,?,?,?,?,?,?,?,?)
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([
		$first_name, $last_name, $contact_number, 
	$gender, $age, $address, $role, $speciality, $nationality
	]);

	//FOR ACTIVITY LOGS RECORD
	$action = "Inserted new applicant";
    $details = "First Name: $first_name, Last Name: $last_name";
    $logStmt = $pdo->prepare("INSERT INTO activity_logs (username, action, details) VALUES (?, ?, ?)");
    $logStmt->execute([$_SESSION['username'], $action, $details]);


	if ($executeQuery) {
		return true;
	}

}

function editApplicant($pdo, $first_name, $last_name, $contact_number, 
$gender, $age, $address, $role, $speciality, $nationality, $applicant_id) {

	$sql = "UPDATE applicants_data
				SET first_name = ?,
					last_name = ?,
					contact_number = ?,
					gender = ?,
                    age = ?,
					address = ?,
					role = ?,
					speciality = ?,
					nationality = ?
				WHERE applicant_id = ? 
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $contact_number, 
    $gender, $age, $address, $role, $speciality, $nationality, $applicant_id]);

	//FOR ACTIVITY LOGS RECORD
	$action = "Edited an applicant";
    $details = "Edited Applicant ID Number: $applicant_id";
    $logStmt = $pdo->prepare("INSERT INTO activity_logs (username, action, details) VALUES (?, ?, ?)");
    $logStmt->execute([$_SESSION['username'], $action, $details]);

	if ($executeQuery) {
		return true;
	}

}


function deleteApplicant($pdo, $applicant_id) {
	$sql = "DELETE FROM applicants_data
			WHERE applicant_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$applicant_id]);

	//FOR ACTIVITY LOGS RECORD
	$action = "Deleted applicant";
    $details = "Deleted Applicant ID Number: $applicant_id";
    $logStmt = $pdo->prepare("INSERT INTO activity_logs (username, action, details) VALUES (?, ?, ?)");
    $logStmt->execute([$_SESSION['username'], $action, $details]);

	if ($executeQuery) {
		return true;
	}
}

//FOR LOGIN/REGISTER


function checkIfUserExists($pdo, $username) {
	$response = array();
	$sql = "SELECT * FROM user_accounts WHERE username = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {

		$userInfoArray = $stmt->fetch();

		if ($stmt->rowCount() > 0) {
			$response = array(
				"result"=> true,
				"status" => "200",
				"userInfoArray" => $userInfoArray
			);
		}

		else {
			$response = array(
				"result"=> false,
				"status" => "400",
				"message"=> "User doesn't exist from the database"
			);
		}
	}

	return $response;

}

function insertNewUser($pdo, $username, $first_name, $last_name, $password) {
	$response = array();
	$checkIfUserExists = checkIfUserExists($pdo, $username); 

	if (!$checkIfUserExists['result']) {

		$sql = "INSERT INTO user_accounts (username, first_name, last_name, password) 
		VALUES (?,?,?,?)";

		$stmt = $pdo->prepare($sql);

		if ($stmt->execute([$username, $first_name, $last_name, $password])) {
			$response = array(
				"status" => "200",
				"message" => "User successfully inserted!"
			);
		}

		else {
			$response = array(
				"status" => "400",
				"message" => "An error occured with the query!"
			);
		}
	}

	else {
		$response = array(
			"status" => "400",
			"message" => "User already exists!"
		);
	}

	return $response;
}

function getUserIDByUsername($pdo, $username) {
    $sql = "SELECT user_id FROM user_accounts WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $row = $stmt->fetch();
    return $row ? $row['user_id'] : null;
}

//FOR ACTIVITY_LOGS
function insertAnActivityLog($pdo, $operation, $branch_id, $address, 
		$head_manager, $contact_number, $username) {

	$sql = "INSERT INTO activity_logs (operation, branch_id, address, 
		head_manager, contact_number, username) VALUES(?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$operation, $branch_id, $address, 
		$head_manager, $contact_number, $username]);

	if ($executeQuery) {
		return true;
	}

}

function getAllActivityLogs($pdo) {
	$sql = "SELECT * FROM activity_logs 
			ORDER BY timestamp DESC";
	$stmt = $pdo->prepare($sql);
	if ($stmt->execute()) {
		return $stmt->fetchAll();
	}
}



?>