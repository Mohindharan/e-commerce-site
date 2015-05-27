<?php
class feeds{
	public function query($from,$to)
	{
		$con = mysqli_connect("localhost","root","","inventory") or die('error');
		$query = "select * from items where id>$from and id<$to";
		$result = mysqli_query($con,$query);
		$count = mysqli_num_rows($result);
		$data = '';
		if($count>0)
		{
			while($row =mysqli_fetch_array($result))
			{
				$id = $row['id'];
				$feed = $row['item'];
				$qty=$row['quantity'];
				$data = $data.'
				
				
	<div class="col-md-3 box btn-default"  onclick="addpop(\''.$row["id"].'\',\''.$row["item"].'\')" >
	<img src='.$row["img"].' class="img-circle box-thumb"/>
	<h3 class="box-name"> '.$row["item"].'</h3>
	<h4 class="qt"> Quantity</h2><h3 class="box-qty ">'.$row["quantity"].'
	</h3>
	</div>		
	
	
		
	';
			}
			$data=$data.'<div class="final" val="'.$id.'" ></div>';
			return $data;
		}
		else{
			
		}
		
	}
public function prequery($from="0",$to="0",$cate="all")
	{
		$con = mysqli_connect("localhost","root","","inventory") or die('error');
		if($cate=="all")
		{
			$query = "select * from items";	
		}
		else{
			
			$query = "SELECT * FROM items WHERE category='$cate' ";	
			}	
			
		$result = mysqli_query($con,$query);
		$count = mysqli_num_rows($result);
		$data = '';
		if($count>0)
		{
			while($row =mysqli_fetch_array($result))
			{
				$id = $row['id'];
				$feed = $row['item'];
				$qty=$row['quantity'];
				$data = $data.'<div class="col-md-3 box btn-default"  onclick="addpop(\''.$row["id"].'\',\''.$row["item"].'\')" >
		<img src='.$row["img"].' class="img-circle box-thumb"/>
		<h3 class="box-name"> '.$row["item"].'</h3>
		<h4 class="qt"> Quantity</h2><h3 class="box-qty ">'.$row["quantity"].'
		</h3>
</div>

';
			}
			$data=$data.'<div class="final" val="'.$id.'" ></div>';
			return $data;
		}
		else{
			echo '<blockquote> No products at this Section. </blockquote>';
		}
		
	}	
	
	public function main()
	{
		if(isset($_POST['from']))
		{
			$from=$_POST['from'];
			$to = $from+6;
			$data = $this->query($from,$to);
			echo $data;
		}else
		{
			$data = $this->query(0,6);
			return $data;
		}
	}
	
}	
$obj = new Feeds();
$data=$obj->main();

?>
