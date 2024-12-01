<?php require_once 'core/handleforms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getApplicantByID = getApplicantByID($pdo, $_GET['applicant_id']); ?>
	<h1>Edit the user!</h1>
	<form action="core/handleforms.php?applicant_id=<?php echo $_GET['applicant_id']; ?>" method="POST">
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="first_name" value="<?php echo $getApplicantByID['first_name']; ?>">
		</p>
		<p>
			<label for="firstName">Last Name</label> 
			<input type="text" name="last_name" value="<?php echo $getApplicantByID['last_name']; ?>">
		</p>
		<p>
			<label for="firstName">Contact Number</label> 
			<input type="text" name="contact_number" value="<?php echo $getApplicantByID['contact_number']; ?>">
		</p>
		<p>
			<label for="firstName">Gender</label> 
			<input type="text" name="gender" value="<?php echo $getApplicantByID['gender']; ?>">
		</p>
        <p>
			<label for="firstName">Age</label> 
			<input type="text" name="age" value="<?php echo $getApplicantByID['age']; ?>">
		</p>
		<p>
			<label for="firstName">Address</label> 
			<input type="text" name="address" value="<?php echo $getApplicantByID['address']; ?>">
		</p>
		<p>
			<label for="firstName">Role in the company</label> 
			<input type="text" name="role" value="<?php echo $getApplicantByID['role']; ?>">
		</p>
        <p>
			<label for="firstName">Speciality or Expertise</label> 
			<input type="text" name="speciality" value="<?php echo $getApplicantByID['speciality']; ?>">
		</p>
		<p>
			<label for="firstName">Nationality</label> 
			<input type="text" name="nationality" value="<?php echo $getApplicantByID['nationality']; ?>">
            <input type="submit" value="Save" name="editApplicantBtn">
		</p>
	</form>
</body>
</html>