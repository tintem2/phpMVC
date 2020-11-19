<?php
class SachModel extends Database
{
	/**
	 * lay tat cac cuon sach
	 * @return [Array] [cac cuon sach]
	 */
	function getAll()
	{
		return $this->selectQuery('select * from sach' );
	}

/**
 * [get10Random lay n cuon sach ngau nhien]
 * @param  integer $n [so sach can lay]
 * @return [type]     [Array]
 */
	function get10Random($n=10)
	{
		return $this->selectQuery('select * from sach order by rand() limit 0,10');
	}

	
	function searchBook($keyword)
	{
		$sql="select * from sach where tensach like ? or mota like ? ";
		$arr= ["%$keyword%", "%$keyword%"];
		return $this->selectQuery($sql, $arr);
	}

	function getSachLoai($idloai)
	{
		return $this->selectQuery("select * from sach where maloai=?", [$idloai]);
	}

	function chitiet($id)
	{
		$data= $this->selectQuery("select * from sach where masach=?", [$id]);
		//print_r($data);
		//if ($data)
		return $data?$data[0]:false;
		//return false;
	}

	function getLoai()
	{
		return $this->selectQuery('select * from loai');
	}
	function getNhaxb()
	{
		return $this->selectQuery('select * from nhaxb');
	}

	//------------------
	function saveUpdate()
	{
		/*print_r($_POST);
		print_r($_FILES);
		exit;*/


		$masach = postIndex('masach');
		$data =[postIndex('tensach'), postIndex('gia'),  postIndex('maloai'), postIndex('manxb')];
		$sql="update sach set tensach=?, gia=?, maloai=?, manxb=? ";

		if ($_FILES['hinh']['error']==0)
		{
			$img = $masach. '_'.time().'_'. $_FILES['hinh']['name'];
			$des = 'assets/images/book/'. $img;
			move_uploaded_file($_FILES['hinh']['tmp_name'], $des);
			$sql.=', hinh=?';
			$data[]=$img;
		}

		$sql .=" where masach = ? ";
		$data[] = $masach;
		/*echo $sql;
		print_r($data);
		exit;*/
		return $this->updateQuery($sql, $data);
	}
	
	function saveInsert()
	{
		/*print_r($_POST);
		print_r($_FILES);
		exit;*/

		$masach = postIndex('masach');
		
		$data =[postIndex('masach'),postIndex('tensach'), postIndex('gia'),  postIndex('maloai'), postIndex('manxb')];
		

		if ($_FILES['hinh']['error']==0)
		{
			$img = $masach. '_'.time().'_'. $_FILES['hinh']['name'];
			$des = IMG_BOOK. $img;
			move_uploaded_file($_FILES['hinh']['tmp_name'], $des);
			
			$data[]=$img;
		}
		else 
			$data[]='';

		$sql="insert into sach(masach, tensach, gia, maloai, manxb, hinh) values(?,?,?,?,?,?)";
		/*insert into sach(masach, tensach, gia, hinh, manxb, maloai) 
values('1','22',3, '4','gd', 'th')*/
		/*echo $sql;
		print_r($data);
		exit;*/
		return $this->updateQuery($sql, $data);
	}
	
	/**
	 * [deleteSach Xoa 1 cuon sach trong table sach]
	 * @param  [string] $masach [Ma sach]
	 * @return [int]         [so dong xoa duoc]
	 */
	function deleteSach($masach)
	{
		/*
		- lay hinh
		- xoa hinh
		- xoa sach trong table sach
		 */
		$data =  $this->chitiet($masach);
		$hinh = $data['hinh'];
		//echo $hinh;
		unlink (IMG_BOOK.$hinh);//xoa hinh
		$sql="delete from sach where masach=?";
		$arr=[$masach];
		return $this->updateQuery($sql, $arr);
	}
}