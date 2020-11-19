<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>doi mat khau</title>
</head>
<body>
	<form action="index.php?controller=UserController&action=doimatkhau2" method="post" id=frm>
		<table>
			<tr>
				<td>Mat khau cu</td>
				<td>
					<input type="password" name="pw1" id='pw1'>
				</td>
			</tr>
			<tr>
				<td>Mkhau moi</td>
				<td>
					<input type="password" name="pw2" id='pw2'>
				</td>
			</tr>
			<tr>
				<td>Nhap lai mkhau moi</td>
				<td>
					<input type="password" name="pw3"  id='pw3'>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="button" value="Thay doi - ajax" onClick="doiMatKhau();">
					<input type="submit" value="Thay doi - thuong">
				</td>
				
			</tr>
			<tr>
				<td colspan="2">
					<div id="thongbao"></div>
				</td>
			</tr>
		</table>
	</form>
	<script src="assets/jquery-3.5.1.min.js"></script>
	<script>
		function doiMatKhau()
		{
			//noidung = 'pw1='+$('#pw1').val()+'&pw2='+$('#pw2').val()+'&pw3='+ $('#pw3').val();
			noidung = $('#frm').serializeArray();
			//console.log(noidung);return;
			$.ajax({
			//	url: 'index.php?controller=UserController&action=doimatkhau3',
				url: 'index.php?controller=UserController&action=doimatkhau2',
				data: noidung,
				type:'POST',
				success:function(s)
				{
					//alert(s);
					$("#thongbao").html(s);
				}
			});
		}
	</script>
</body>
</html>