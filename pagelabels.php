<?
	if ($report == 'clients')
		$query = 'SELECT CEILING(CAST(COUNT(*) as decimal(20,2))/'.$pagelimit.') as PageCnt FROM testDB.dbo.customer';
	else
		$query = 'SELECT CEILING(CAST(COUNT(*) as decimal(20,2))/'.$pagelimit.') as PageCnt FROM testDB.dbo.[order]';
	$res = sqlsrv_query($conn,$query);
	sqlsrv_fetch($res);
	$pagecnt = sqlsrv_get_field($res, 0);
	$i = 1;
	$pagelabel = "";
	while($i <= $pagecnt)
	{
		if ($i==$page) $label="<b>".$i."</b>"; else $label = $i;
		$pagelabel = $pagelabel.'<a href="'.$_SERVER['PHP_SELF'].'?report='.$report.'&page='.$i.'&pagelimit='.$pagelimit.'">'.$label."</a>\n";
		$i = $i + 1;
	}
	echo "Pages: ".$pagelabel."<br>";
?>