<?
	if($_POST['update'])
	{
		$res2 = sqlsrv_query($conn,$query);
		while($row2 = sqlsrv_fetch_array($res2, SQLSRV_FETCH_ASSOC))
		{
			if ($report=='clients')
				$query2 = "UPDATE testDB.dbo.customer SET name = '".$_POST['name'.$row2['id']]."', born = '".$_POST['born'.$row2['id']]."' WHERE ID = ".$row2['id'];
			else
				$query2 = "UPDATE testDB.dbo.[order] SET [status] = ".$_POST['status'.$row2['id']]." WHERE ID = ".$row2['id'];
			sqlsrv_query($conn,$query2);
		}
		echo "<script>window.location.href='http://localhost".$_SERVER['REQUEST_URI']."'</script>";	
	}
	if ($_POST['update']) $_POST['update'] = null;
	
	if($_POST['delete'])
	{
		
		$res2 = sqlsrv_query($conn,$query);
		while($row2 = sqlsrv_fetch_array($res2, SQLSRV_FETCH_ASSOC))
		{
			if($_POST['del'.$row2['id']])
			{
				if ($report=='clients')
				{
					$query2 = "DELETE testDB.dbo.[order] WHERE customer = ".$row2['id'];
					sqlsrv_query($conn,$query2);
					$query2 = "DELETE testDB.dbo.customer WHERE ID = ".$row2['id'];
					sqlsrv_query($conn,$query2);
				}
				else
				{
					$query2 = "DELETE testDB.dbo.[order] WHERE ID = ".$row2['id'];
					sqlsrv_query($conn,$query2);
				}
				
			}
		}
		echo "<script>window.location.href='http://localhost".$_SERVER['REQUEST_URI']."'</script>";	
	}
	if ($_POST['delete']) $_POST['delete'] = null;
	
	
	if($_POST['add'])
	{
		if ($report=='clients')
		{
			$query2 = "insert into [testDB].[dbo].[customer](name,born) values('".$_POST['name']."','".$_POST['born']."')";
		}
		else
		{
			$query2 = "insert into [testDB].[dbo].[order](customer,dateAdded,status,price,currency) values(".$_POST['customer'].",getdate(),".$_POST['status'].",cast(replace('".$_POST['price']."',',','.') as decimal(20,4)),".$_POST['currency'].")";
		}
		sqlsrv_query($conn,$query2);
		echo "<script>window.location.href='http://localhost".$_SERVER['REQUEST_URI']."'</script>";
	}
	if ($_POST['add']) $_POST['add'] = null;
?>