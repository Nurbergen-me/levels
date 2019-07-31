<?php 

	$pdo = new PDO('mysql:host=localhost;dbname=management', 'root', '');


	$newFileName = $_GET['newFileName'];

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

		$sql ="UPDATE users SET name='$name', email='$email', newFileName='$newFileName', password='$password' WHERE id='$id'";

		$pdo ->query($sql);

		header("Location: /index.php");


	} else if(!empty($_POST['name'] and $_POST['email']) and empty($_POST['password']) and empty($_POST['valid'])) {

		$name = $_POST['name'];
		$email = $_POST['email'];
		$id =$_GET['id'];

		$sql ="UPDATE users SET name='$name', email='$email', newFileName='$newFileName' WHERE id='$id'";

		$pdo ->query($sql);

		header("Location: /index.php");


	} else if(empty($_POST['name']) and empty($_POST['email']) and empty($_POST['password']) and empty($_POST['valid'])) {
		echo '';

	} else if(empty($_POST['name']) or empty($_POST['email']) or empty($_POST['password']) or empty($_POST['valid'])) {
		echo 'Поля не заполнены!';

	} else if($_POST['password'] != $_POST['valid']) {
		echo 'Пароли не совпали!';
	};



	//для Value

	if(isset($_GET['id'])) {
		$id = $_GET['id'];

		$sql = "SELECT * FROM users WHERE id='$id'";
		$statement = $pdo ->query($sql);
		$data = $statement ->fetch(PDO::FETCH_ASSOC);

		if(empty($data)) {
			header("Location: /404.php");

		};
	}

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
				<h1>Edit User ID <?php echo $id; ?></h1>
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" class="form-control" name="name" value="<?php echo $data['name'] ?>">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input type="email" class="form-control" name="email" value="<?php echo $data['email'] ?>">
					</div>
					<div class="form-group">
						<label for="">File</label>
						<input type="file" class="form-control" name="file">
						<?php if(!empty($data['newFileName'])) {
							echo  "<img src=\"uploads/$data[newFileName]\" style=\"max-width: 100px;\">";
						}; ?>
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
						<button type="submit" class="btn btn-warning">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>