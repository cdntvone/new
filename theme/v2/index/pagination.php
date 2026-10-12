<?php

class CSSPagination
{
	private $totalrows;
	private $rowsperpage;
	private $website;
	private $separate;
	private $page;
	private $sql;
		
	public function __construct($totalrows, $rowsperpage, $website, $separate = '')
	{
		$this->totalrows = $totalrows;
		$this->website = $website;
		$this->rowsperpage = $rowsperpage;
		$this->separate = $separate;
	}
	
	public function setPage($page)
	{
		if (!$page) { $this->page=1; } else  { $this->page = $page; }
	}
	
	public function getLimit()
	{
		return ($this->page - 1) * $this->rowsperpage;
	}
	
	private function getLastPage()
	{
		return ceil($this->totalrows / $this->rowsperpage);
	}
	
	public function showPage()
	{
		$pagination = "";
		$lpm1 = $this->getLastPage() - 1;
		$page = $this->page;
		$prev = $this->page - 1;
		$next = $this->page + 1;
		$iprev = "<span aria-hidden=\"true\">&laquo;";
		$inext = "<span aria-hidden=\"true\">&raquo;";

		$pagination .= "
		     <nav aria-label=\"page-navigation\">";
		$pagination .= "
		         <ul class=\"pagination justify-content-center mb-0 py-2\">";
			
		if ($this->getLastPage() > 1)
		{
			if ($page > 1) 
				$pagination .= '
					<li class="page-item"><a class="page-link" rel="nofollow" href='.$this->website.$this->separate.'page='.$prev.'> &laquo;</a></li>';
			else
				$pagination .= '
					<li class="page-item disabled"><a class="page-link" rel="nofollow" href="#"> &laquo;</a></li>';
			
			
			if ($this->getLastPage() < 9)
			{	
				for ($counter = 1; $counter <= $this->getLastPage(); $counter++)
				{
					if ($counter == $page)
						$pagination .= '
					<li class="page-item active"><a class="page-link" rel="nofollow" href="#">'.$counter.'</a></li>';
					else
						$pagination .= '
					<li class="page-item"><a class="page-link" rel="nofollow" href='.$this->website.$this->separate.'page='.$counter.'>'.$counter.'</a></li>';					
				}
			}
			
			elseif($this->getLastPage() >= 9)
			{
				if($page < 4)		
				{
					for ($counter = 1; $counter < 6; $counter++)
					{
						if ($counter == $page)
							$pagination .= "
					<li class=\"page-item active\"><a class=\"page-link\" rel=\"nofollow\" id=\"no-link\" href=\"#\">".$counter."</a></li>";
						else
							$pagination .= '
					<li class="page-item"><a class="page-link" rel="nofollow" href="'.$this->website.$this->separate.'page='.$counter.'">'.$counter.'</a></li>';					
					}
					//$pagination .= "...";
					$pagination .= '
					<li class="page-item"><a class="page-link" rel="nofollow"  href="'.$this->website.$this->separate.'page='.$lpm1.'">'.$lpm1.'</a></li>';
					$pagination .= '
					<li class="page-item"><a class="page-link" rel="nofollow"  href="'.$this->website.$this->separate.'page='.$this->getLastPage().'">'.$this->getLastPage().'</a></li>';		
				}
				elseif($this->getLastPage() - 3 > $page && $page > 1)
				{
					$pagination .= '
					<li class="page-item"><a class="page-link" rel="nofollow" href="'.$this->website.$this->separate.'page=1">1</a></li>';
					$pagination .= '
					<li class="page-item"><a class="page-link" rel="nofollow" href="'.$this->website.$this->separate.'page=2">2</a></li>';
					//$pagination .= "...";
					for ($counter = $page - 1; $counter <= $page + 1; $counter++)
					{
						if ($counter == $page)
							$pagination .= "
					<li class=\"page-item active\"><a class=\"page-link\" rel=\"nofollow\" id=\"no-link\" href=\"#\">".$counter."</a></li>";
						else
							$pagination .= '
					<li class="page-item"><a class="page-link" rel="nofollow" href="'.$this->website.$this->separate.'page='.$counter.'">'.$counter.'</a></li>';					
					}
					$pagination .= "
					<li class=\"page-item disabled\"><a class=\"page-link\" rel=\"nofollow\" style=\"color:#202529\" id=\"no-link\" href='#'>...</a></li>";
					$pagination .= '
					<li class="page-item"><a class="page-link" rel="nofollow" href="'.$this->website.$this->separate.'page='.$lpm1.'">'.$lpm1.'</a></li>';
					$pagination .= '
					<li class="page-item"><a class="page-link" rel="nofollow" href="'.$this->website.$this->separate.'page='.$this->getLastPage().'">'.$this->getLastPage().'</a></li>';		
				}
				else
				{
					$pagination .= '
					<li class="page-item"><a class="page-link" rel="nofollow" href="'.$this->website.$this->separate.'page=1">1</a></li>';
					$pagination .= '
					<li class="page-item"><a class="page-link" rel="nofollow" href="'.$this->website.$this->separate.'page=2">2</a></li>';
					$pagination .= "
					<li class=\"page-item disabled\"><a class=\"page-link\" rel=\"nofollow\" href='#'>...</a></li>";
					for ($counter = $this->getLastPage() - 4; $counter <= $this->getLastPage(); $counter++)
					{
						if ($counter == $page)
							$pagination .= "
					<li class=\"page-item active\"><a class=\"page-link\" rel=\"nofollow\" id=\"no-link\" href=\"#\">".$counter."</a></li>";
						else
							$pagination .= '
					<li class="page-item"><a class="page-link" rel="nofollow" href="'.$this->website.$this->separate.'page='.$counter.'">'.$counter.'</a>';					
					}
				}
			}
		
		if ($page < $counter - 1) 
			$pagination .= '
					<li class="page-item"><a class="page-link" rel="nofollow" href="'.$this->website.$this->separate.'page='.$next.'">&raquo;</a></li>';
		else
			$pagination .= "
					<li class=\"page-item disabled\"><a class=\"page-link\" rel=\"nofollow\" href=\"#\">".$inext."</a></li>";
		$pagination .= "
				</ul>
	   		</nav>\n";			
		}	
					
		return $pagination;
	}
}
?>