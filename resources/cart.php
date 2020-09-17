<?php require_once("config.php") ?>


<?php 

	if (isset($_GET['add'])) 
	{
		$query = query("SELECT * FROM products WHERE product_id= ".escape_string($_GET['add'])." ");
		confirm($query);
		while ($row = fetch_array($query)) 
		{
			if ($row['product_quantity'] != $_SESSION['product_'.$_GET['add']]) 
			{
				$_SESSION['product_'.$_GET['add']]+=1;
				redirect("../public/checkout.php");
			}
			else
			{
				set_message("We only have  " .$row['product_quantity']." "."{$row['product_title']}"."Available");
				redirect("../public/checkout.php");
			}
		}
	}

	if (isset($_GET['remove'])) 
	{
		$_SESSION['product_' .$_GET['remove']]--;

		if ($_SESSION['product_'.$_GET['remove']]<1) 
		{
			unset($_SESSION['item_total']);
			unset($_SESSION['item_quantity']);
			redirect("../public/checkout.php");
		}
		else
		{
			redirect("../public/checkout.php");
		}
	}

	if (isset($_GET['delete']))
	{
		$_SESSION['product_'.$_GET['delete']]='0';
		unset($_SESSION['item_total']);
		unset($_SESSION['item_quantity']);
		redirect("../public/checkout.php");
	}


	function cart()
	{	
		$total = 0;
		$item_quantity=0;
		$item_name =  1;
		$item_number = 1;
		$amount = 1;
		$quantity = 1;
		foreach ($_SESSION as $name => $value) 
		{	

			if ($value > 0) 
			{
			
				if(substr($name,0,8) == "product_")
				{
					  $lenght = strlen($name)-8;
					  $id = substr($name, 8 , $lenght);

					$query = query("SELECT * FROM products where product_id = ".escape_string($id)." ");
					confirm($query);

					while($row = fetch_array($query))
					{
						$sub = $row['product_price']*$value;
						$item_quantity+=$value;	
						$product_image = display_image($row['product_image']);
						$product =<<<DELIMETER
						<tr>
							<td>{$row['product_title']}</td>
							<td>&#36; {$row['product_price']}</td>
							<td>{$value}</td>
							<td>&#36; {$sub}</td>
							<td>
								<img width="50" src="../resources/{$product_image}" alt="">
							</td>
							<td>
								<a class='btn btn-warning' href="../resources/cart.php?remove={$row['product_id']}"><span class='glyphicon glyphicon-minus'></span></a>
								<a class='btn btn-success' href="../resources/cart.php?add={$row['product_id']}"><span class='glyphicon glyphicon-plus'></span></a>
								<a class='btn btn-danger' href="../resources/cart.php?delete={$row['product_id']}"><span class='glyphicon glyphicon-remove'></span></a>
							</td>
						</tr>
						<input type="hidden" name"item_name_{$item_name}" value="{$row['product_title']}">
						<input type="hidden" name"item_number_{$item_number}" value="{$row['product_id']}">
						<input type="hidden" name"amount_{$amount}" value="{$row['product_price']}">
						<input type="hidden" name"quantity_{$quantity}" value="{$value}">
						DELIMETER;
						echo $product;
						$item_number++;
						$item_name++;
						$amount++;
						$quantity++;
						$_SESSION['item_total']=$total += $sub;
						$_SESSION['item_quantity']=$item_quantity;
					}
				}

			}
			
			
		}
			
		
	}



	function show_paypal()
	{

		if (isset($_SESSION['item_quantity'])) 
		{
			$paypal_button=<<<DELIMETER
			<input type="submit" name="submit" value="Buy Now" class="btn btn-warning">
			DELIMETER;

			return $paypal_button;
		}
		
	}


	function proccess_transaction()
	{	
		if (isset($_POST['submit'])) 
 		{

		     $amount=$_SESSION['item_total'];
		     $currency="US";    
		     $transaction="123456789";
		     $status="complete";
			 $total = 0;
			 $item_quantity=0;
		
		foreach ($_SESSION as $name => $value) 
		{	

			if ($value > 0) 
			{
			
				if(substr($name,0,8) == "product_")
				{
					  $lenght = strlen($name)-8;
					  $id = substr($name, 8 , $lenght);


				     $send_order = query("INSERT INTO orders(order_amount,order_transaction,order_status,order_currency) VALUES('{$amount}','{$transaction}','{$status}','{$currency}') ");

				     $last_id=last_id();
				     confirm($send_order);

					$query = query("SELECT * FROM products where product_id = ".escape_string($id)." ");
					confirm($query);

					while($row = fetch_array($query))
					{
						$product_price = $row['product_price'];
						$product_title = $row['product_title'];
						$sub = $row['product_price']*$value;
						$item_quantity+=$value;
						

					$insert_report = query("INSERT INTO reports(product_id,order_id,product_price,product_title,product_quantity) VALUES('{$id}','{$last_id}','{$product_price}','{$product_title}','{$value}') ");

					confirm($insert_report);	
						
					}

						
						$total += $sub;
						$item_quantity;
				}

			}
			
			
		}
		session_destroy();	
	  }
	   else
	   {
	     redirect("index.php");
	   }
	}


 ?>