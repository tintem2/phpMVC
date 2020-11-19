<?php
class UserModel extends Database
{
	
	/**
	 * [getAdmin lay thong tin cua quan tri co username=u, mk=p]
	 * @param  [type] $u [username]
	 * @param  [type] $p [password - da ma hoa md5]
	 * @return [type]    [array 1 chieu thong tin, hoac false neu khong co]
	 */
	function getAdmin($u, $p)
	{
		$data= $this->selectQuery("select * from quantri where username=? and matkhau=? ", [$u, $p]);
		
		return $data?$data[0]:false;
		
	}

	function getKhachhang($email, $matkhau)
	{
		$data= $this->selectQuery("select * from khachhang where email=? and matkhau=? ", [$email, $matkhau]);
		//print_r($data); exit;
		return $data?$data[0]:false;
		
	}

	function saveDonHang()
	{
		//save table don hang - hoa don
		$sql="INSERT INTO `hoadon` (`mahd`, `email`, `ngayhd`, `tennguoinhan`, `diachinguoinhan`, `ngaynhan`, `dienthoainguoinhan`) 
		   VALUES (?, ?, NOW(), ?, ?, '0000-00-00', ?);";
		 $mahd = $_SESSION['userLogin']['email'] .'_'.time();
		$arr =[ $mahd ,  $_SESSION['userLogin']['email'], postIndex('tennguoinhan'), postIndex('diachinguoinhan'), postIndex('dienthoainguoinhan')  ];
		//print_r($arr);
		$this->updateQuery($sql, $arr);

		$tam = isset($_SESSION['cart'])?$_SESSION['cart']:[];
		//print_r($tam);
		$data=[];//thong tin cac sp trong gio hang
		$m = new SachModel();
		foreach ($tam as $id => $sl) 
		{
			$sach= $m->chitiet($id);//lay chi tiet 1 sp
			if (!$sach) continue;
			$sach['soluong']= $sl;
			$data[]= $sach;

		}

		foreach ($data as $key => $value) {
			$sql ="INSERT INTO `chitiethd` (`mahd`, `masach`, `soluong`, `gia`) 
			VALUES (?, ?, ?, ?);";
			$arr = [$mahd, $value['masach'], $value['soluong'], $value['gia']];
			$this->updateQuery($sql, $arr);
		}

		unset($_SESSION['cart']);
		header('location:index.php');
	}

	function doimatkhau($email, $pw)
	{
		return $this->updateQuery('update khachhang set matkhau=? where email=?', [$pw, $email]);
	}
}