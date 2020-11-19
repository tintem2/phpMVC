<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div>Hien thi gio hang
	<hr>
	<table>
		<tr>
			<td>stt</td>
			<td>ten sach</td>
			<td>Gia</td>
			<td>SL</td>
			<td>Thanh tien</td>
		</tr>
		<?php
		foreach ($data as $key => $value) {
			?>
			<tr>
			<td></td>
			<td><?php echo $value['tensach'] ?></td>
			<td><?php echo $value['gia'] ?></td>
			<td><?php echo $value['soluong'] ?></td>
			<td><?php echo $value['gia']*$value['soluong'] ?></td>
		</tr>
			<?php
		}
		?>

	</table>
	</div>
	<hr>
	<div>Hien thi form cho nguoi nhan hang <hr>
	<form action="index.php?controller=UserController&action=finish" method="post">
		<table>
			<tr>
				<td>Ten nhan</td>
				<td>
					<input type="text" name="tennguoinhan">
				</td>
			</tr>
			<tr>
				<td>dia chi nhan</td>
				<td>
					<input type="text" name="diachinguoinhan">
				</td>
			</tr>
			<tr>
				<td>Dthoai </td>
				<td>
					<input type="text" name="dienthoainguoinhan">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="Hoan Thanh">
				</td>
				
			</tr>
		</table>
	</form>
	</div>
</body>
</html>