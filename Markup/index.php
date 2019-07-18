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
				<a href="create.html" class="btn btn-success">Add User</a>
				
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Username</th>
							<th>Email</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody>
						<?php 

							//Создать массив с данными
							//Использовать цикл foreach для table row
							//Вставить данные из массива
							//Использовать echo для вывода на экран

							$data = [
								['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
								['id' => 2, 'name' => 'Joseph Doe', 'email' => 'joseph@example.com'],
								['id' => 3, 'name' => 'Jane Doe', 'email' => 'jane@example.com']
							];

							foreach($data as $user):
						?>
							<tr>
								<td><?= $user['id']; ?></td>
								<td><?= $user['name']; ?></td>
								<td><?= $user['email']; ?></td>
								<td>
									<a href="edit.html?id=<?= $user['id']; ?>" class="btn btn-warning">Edit</a>
									<a href="?id=<?= $user['id']; ?>" onclick="return confirm('are you sure?')" class="btn btn-danger">Delete</a>
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