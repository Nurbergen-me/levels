<?php 

	$pdo = new PDO('mysql:host=localhost;dbname=management;charset=utf8', 'root', '');


	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$newFileName = $_GET['newFileName'];

		if(!empty($newFileName)) {
			unlink("uploads/$newFileName");
		};


		$sql ="DELETE FROM users WHERE id='$id'";

		$pdo ->query($sql);
		// if(empty($data)) {
		// 	header("Location: /404.php");

		// };
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
			<div class="col-md-12">
				<h1>User management</h1>
				<a href="create.php" class="btn btn-success">Add User</a>
				
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Username</th>
							<th>Email</th>
							<th>File name</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody>
						<?php 


							$sql ="SELECT * FROM users";
							$statement =$pdo ->query($sql);
							$data = $statement ->fetchAll(PDO::FETCH_ASSOC);

							foreach($data as $user):
						?>
							<tr>
								<td><?= $user['id']; ?></td>
								<td><?= $user['name']; ?></td>
								<td><?= $user['email']; ?></td>
								<td><?= $user['newFileName']; ?></td>
								<td>
									<a href="edit.php?id=<?= $user['id']. '&newFileName=' .$user['newFileName']; ?>" class="btn btn-warning">Edit</a>
									<a href="?id=<?= $user['id']. '&newFileName=' .$user['newFileName']; ?>" onclick="return confirm('are you sure?')" class="btn btn-danger">Delete</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>