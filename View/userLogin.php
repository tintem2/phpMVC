<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>

	<form action="index.php?controller=UserController&action=userLogin2" method="post">
		<table>
			<tr>
				<td>UserName</td>
				<td>
					<input type="email" name="email">
				</td>
			</tr>
			<tr>
				<td>Mat khau</td>
				<td>
					<input type="password" name="matkhau">
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<input type="submit">	
				</td>
				
			</tr>
		</table>
	</form>
</body>
</html>