<?php 

include("../connection.php");

if (isset($_POST['page'])) {
	$page = $_POST['page'];
}else{
	$page = 1;
}

$pagination = "";


$limit = 34;
$start = ($page - 1)* $page;

$pages = mysqli_query($connect,"SELECT count(id) AS id FROM products");

while ($row = mysqli_fetch_array($pages)) {
	$total = $row['id'];
	$count = ceil($total / $limit);

   for ($i=1; $i <=$count ; $i++) { 
   	
$pagination .= "

  <ul class='pagination mx-4'>
    
             <a id='".$i."' href='' class='page-link '>".$i."</a>
          
     </div>
    
";
   }

}






$query = "SELECT * FROM products LIMIT $start, $limit";
$res = mysqli_query($connect,$query);

$output = "";
if (mysqli_num_rows($res) < 1) {
	$output .= "<h1 class='text-center'>NO DATA IN THE DB</h1>";
}else{

	while ($row = mysqli_fetch_array($res)) {
		 
		 $output .= "
             <div class='card' style='width: 20rem; margin:auto; margin-bottom:10px; '>
				<form method='post'>
					<img src=".$row['image']." class='card-img-top' height='200px'>
					<h3 class='mx-3 text-center'>".$row['name']."</h3>
					<h3 class='mx-3 text-center'>$".$row['price']."</h3>
					<span class='text-warning' style='margin-left: 100px;'>
						<i class='fa fa-star'></i>
						<i class='fa fa-star'></i>
						<i class='fa fa-star'></i>
						<i class='fa fa-star'></i>
						<i class='fa fa-star'></i>
					</span>
					<input type='hidden' name='id' value='".$row['id']."' id='".$row['id']."'>
					<input type='hidden' name='name' value='".$row['name']."' id='name".$row['id']."'>
					<input type='hidden' name='price' value='".$row['price']."' id='price".$row['id']."'>

					<button type='button' class='btn btn-secondary' data-container='body' data-toggle='popover' data-placement='bottom' data-content='".$row['description']."'>
					Description
                    </button>
					
					<form class='form-inline'>
                        <div class='form-group mx-sm-3 mb-2'>
                         Quantity <input type='text' class='form-control w-25' placeholder='1' name='quantity' id='quantity".$row['id']."'>
						<input type='submit' name='add' id='".$row['id']."' class='btn btn-warning my-2 add_cart' value='Add To Cart' style='margin-left: 100px;'>
                        </div>
                    </form>
					
				</form>
				</div>

		 ";
	}
}




$data['output'] = $output;
$data['pagination'] = $pagination;


echo json_encode($data);


 ?>