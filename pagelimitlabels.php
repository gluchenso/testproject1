<?
	
	if ($report=="clients") 
	{
		$pagelimitcnt = 20;
		$step = 5;
		$i = 5;
	}
	else
	{
		$pagelimitcnt = 100;
		$step = 10;
		$i = 20;
	}

	$pagelimitlabel="";
	while($i <= $pagelimitcnt)
	{
		if ($i==$pagelimit) $label="<b>".$i."</b>"; else $label = $i;
		$pagelimitlabel = $pagelimitlabel.'<a href="'.$_SERVER['PHP_SELF'].'?report='.$report.'&pagelimit='.$i.'">'.$label."</a>\n";
		$i = $i + $step;
	}
	echo "Rows on page: ".$pagelimitlabel."<br>";
?>