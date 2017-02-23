<?
	function statuslist($conn, $elementname, $currentstatus)
	{
		$query = 'SELECT * FROM [testDB].[dbo].[status] ORDER BY id';
		$res = sqlsrv_query($conn,$query);
		$list = "<select name='".$elementname."' onchange=\"this.style.color='red'\" onblur=\"this.style.color='black'\">";
		while($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC))
		{
			if ($row['name']==$currentstatus) $selected = " selected "; else $selected = "";
			$list .= "<option value=".$row['id'].$selected.">".$row['name'];
		}
		$list .= "</select>";
		return $list;
	}
	
	function currencylist($conn, $elementname)
	{
		$query = 'SELECT * FROM [testDB].[dbo].[currency] ORDER BY id';
		$res = sqlsrv_query($conn,$query);
		$list = "<select name='".$elementname."'>";
		while($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC))
		{
			$list .= "<option value=".$row['id'].">".$row['alias'];
		}
		$list .= "</select>";
		return $list;
	}
	
	function customerlist($conn, $elementname)
	{
		$query = 'SELECT * FROM [testDB].[dbo].[customer] ORDER BY name';
		$res = sqlsrv_query($conn,$query);
		$list = "<select name='".$elementname."'>";
		while($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC))
		{
			$list .= "<option value=".$row['id'].">".$row['name'];
		}
		$list .= "</select>";
		return $list;
	}

?>