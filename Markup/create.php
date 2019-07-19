<?php 

	$pdo = new PDO('mysql:host=localhost;dbname=management', 'root', '');


	$newFileName = '';


	//Принимаем файл и переименуем

	if(!empty($_FILES['file']['name'])) {

		$file = $_FILES['file'];
		$temp = explode(".", $_FILES["file"]["name"]);
		$newFileName = uniqid() . '.' . end($temp);

		$path = "uploads/";
		$path = $path.$newFileName;
		move_uploaded_file( $_FILES['file']['tmp_name'] , $path);
	}

	// Принимаем данные из формы и отправляем в БД

	if(!empty($_POST['name'] and $_POST['email'] and $_POST['password'] and $_POST['valid']) and $_POST['password'] == $_POST['valid']) {

		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);

		$sql = "INSERT INTO users (name, email, newFileName, password) VALUES ('$name', '$email', '$newFileName', '$password')";

		$pdo ->query($sql);

		header("Location: /index.php");


	} else if(empty($_POST['name']) and empty($_POST['email']) and empty($_POST['password']) and empty($_POST['valid'])) {
		echo '';

	} else if(empty($_POST['name']) or empty($_POST['email']) or empty($_POST['password']) or empty($_POST['valid'])) {
		echo 'Поля не заполнены!';

	} else if($_POST['password'] != $_POST['valid']) {
		echo 'Пароли не совпали!';
	};

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Homepage</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1>Add User</h1>
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" class="form-control" name="name">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input type="email" class="form-control" name="email">
					</div>
					<div class="form-group">
						<label for="">File</label>
						<input type="file" class="form-control" name="file">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" class="form-control" name="password">
					</div>
					<div class="form-group">
						<label for="">Password (repeat)</label>
						<input type="password" class="form-control" name="valid">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>