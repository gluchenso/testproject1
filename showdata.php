<?
	if ($report=='clients')
		$query = 'SELECT * 
				  FROM (
						SELECT id, name, convert(varchar(10),born,104) born, ROW_NUMBER() OVER(ORDER BY ID) sort 
						FROM testDB.dbo.customer
						) gg 
				  WHERE sort > '.$pagelimit*($page-1).' AND sort <= '.$pagelimit*$page;
	else
		$query = 'SELECT *
				  FROM (
						SELECT o.id,
							 c.name customer,
							 convert(varchar(10),dateAdded,104)+\' \'+convert(varchar(10),dateAdded,108) dateAdd,
							 st.name [status],
							 price,
							 cr.alias currency,
							 ROW_NUMBER() OVER(ORDER BY o.ID) sort
						FROM [testDB].[dbo].[order] o
							LEFT JOIN [testDB].[dbo].[customer] c ON c.id = o.customer
							LEFT JOIN [testDB].[dbo].currency cr ON cr.id = o.currency
							LEFT JOIN [testDB].[dbo].[status] st ON st.id = o.[status]
						) gg
					WHERE sort > '.$pagelimit*($page-1).' AND sort <= '.$pagelimit*$page;

		
	$res = sqlsrv_query($conn,$query);
	echo "<form action='' method='POST'>";
	echo "<p><input  type='submit' name='update' value='update data in db'></p>";
	
	if ($report=='clients')
		echo "<table><tr><td>del</td><td>id</td><td>name</td><td>birth</td></tr>";
	else
		echo "<table><tr><td>del</td><td>id</td><td>customer</td><td>dateAdd</td><td>status</td><td>price</td><td>currency</td></tr>";
	
	while($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC))
	{
		if ($report=='clients')
			echo "<tr><td><input type='checkbox' name='del".$row['id']."'></td><td><input value='".$row['id']."' readonly /></td>"."<td><input name='name".$row['id']."' value='".$row['name']."' size=50 onkeyup=\"this.style.color='red'\" onchange=\"this.style.color='black'\" /></td>"."<td><input name='born".$row['id']."' value='".$row['born']."'  onkeyup=\"this.style.color='red'\" onchange=\"this.style.color='black'\" /></td>"."</tr>";
		else
			echo "<tr><td><input type='checkbox' name='del".$row['id']."'></td><td><input value='".$row['id']."' readonly /></td><td><input value='".$row['customer']."' readonly /></td><td><input value='".$row['dateAdd']."' readonly /></td><td>".statuslist($conn,"status".$row['id'],$row['status'])."</td><td><input value='".$row['price']."' readonly /></td><td><input value='".$row['currency']."' readonly /></td></tr>";
			
	}
	echo "</table>";
	echo "<p><input  type='submit' name='delete' value='delete selected data in db'></p>";
	
	if ($report=='clients')
	{
		echo "<table><tr><td>name</td><td>birth</td></tr>";
		echo "<tr><td><input name='name'></td><td><input name='born'></td></tr>";
		echo "</table>";
		echo "<p><input  type='submit' name='add' value='add new data in db'></p>";
	}
	else
	{
		echo "<table><td>customer</td><td>status</td><td>price</td><td>currency</td></tr>";
		echo "<tr><td>".customerlist($conn,"customer")."</td><td>".statuslist($conn,"status","")."</td><td><input name='price'></td><td>".currencylist($conn,"currency")."</td></tr>";
		echo "</table>";
		echo "<p><input  type='submit' name='add' value='add new data in db'></p>";
	}
	
	echo "</form>";
?>