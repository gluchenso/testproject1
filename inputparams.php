<?
	if (isset($_GET['report'])) 
		$report=($_GET['report']); 
	else 
		$report='clients';
	
	if (isset($_GET['page'])) 
		$page=($_GET['page']); 
	else 
		$page=1;
	
	if (isset($_GET['pagelimit'])) 
		$pagelimit=($_GET['pagelimit']); 
	else 
		{
		if ($report=='clients') 
			$pagelimit=5;
		else 
			$pagelimit=20;
		}
?>