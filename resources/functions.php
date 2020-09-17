<?php 
	
	$upload_dicrectory = "uploads";
	function redirect($location)
	{
		header("Location: $location");
	}


	function last_id()
	{
		global $connection;
		return mysqli_insert_id($connection);
	}

	function set_message($msg)
	{
		if(!empty($msg))
		{
			$_SESSION['message'] = $msg;
		}
		else
		{
			$msg = "";
		}
	}

	function display_message()
	{
		if (isset($_SESSION['message'])) 
		{
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		}
	}



	function query($sql)
	{
		global $connection;

		return mysqli_query($connection, $sql);
	}

	function confirm($result)
	{
		global $connection;

		if (!$result) 
		{
			die("QUERY FAILED " .mysqli_error($connection));
		}
	}

	function escape_string($string)
	{
		global $connection;

		return mysqli_real_escape_string($connection,$string);
	}

	function fetch_array($result)
	{
		return mysqli_fetch_array($result);
	}

	/*******************FRONT END FUNCTIONS************************/


	function get_products()
	{
		$query = query("SELECT * FROM products");
		confirm($query);
		while($row = fetch_array($query))
		{
			$product_image=display_image($row['product_image']);
			$product = <<<DELIMETER
			<div class="col-sm-4 col-lg-4 col-md-4">
				<div class="thumbnail">
					<a href="item.php?id={$row['product_id']}"><img src="../resources/{$product_image}" alt=""></a>
					<div class="caption">
						<h4 class="pull-right">&#36;{$row['product_price']}</h4>
						<h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a></h4>
						<p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
						<a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
					</div>
				</div>
			</div>			
			DELIMETER;

			echo $product;
		}

	}


	function get_categories()
	{
			$query = query("SELECT * FROM categories");
    		confirm($query);

    		while ($row = fetch_array($query)) 
    		{
				$category_link = <<<DELIMETER
				<a href="category.php?id={$row['cat_id']}" class="list-group-item">{$row["cat_title"]}</a>
				DELIMETER;
				echo $category_link;
    		}
	}

	function get_products_in_cat_page()
	{
		$query = query("SELECT * FROM products WHERE product_category_id=".escape_string($_GET['id'])." ");
		confirm($query);
		while ($row = fetch_array($query)) 
		{
			$product_image = display_image($row['product_image']);
			$product_cat = <<<DELIMETER
			<div class="col-md-3 col-sm-6 hero-feature">
			    <div class="thumbnail">
			        <img src="../resources/{$product_image}" alt="">
			        <div class="caption">
			            <h3>{$row['product_title']}</h3>
			            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
			            <p>
			                <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
			            </p>
			        </div>
			    </div>
			</div>			
			DELIMETER;
			echo $product_cat;
		}
	}


		function get_products_in_shop_page()
	{
		$query = query("SELECT * FROM products ");
		confirm($query);
		while ($row = fetch_array($query)) 
		{
			$product_image = display_image($row['product_image']);
			$product_shop = <<<DELIMETER
			<div class="col-md-3 col-sm-6 hero-feature">
			    <div class="thumbnail">
			        <img src="../resources/{$product_image}" alt="">
			        <div class="caption">
			            <h3>{$row['product_title']}</h3>
			            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
			            <p>
			                <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
			            </p>
			        </div>
			    </div>
			</div>			
			DELIMETER;
			echo $product_shop;
		}
	}


	function login_user()
	{
		if (isset($_POST['submit'])) 
		{
			
			$username = escape_string($_POST['username']);
			$password = escape_string($_POST['password']);

			$query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'");
			confirm($query);

			if (mysqli_num_rows($query) == 0) 
			{
				set_message("Invaild Username and password");
				redirect("login.php");
			}
			else
			{	
				$_SESSION['username'] = $username;
				redirect("admin");
			}
		}
	}

	function send_message()
	{
		if (isset($_POST['submit'])) 
		{
			extract($_POST);
			$to 		= "someEmailAddress@gmail.com";
			$form_name 	= $name;
			$Subject 	= $subject;
			$Email 		= $email;
			$Message 	= $message;
			$headers	= "From: {$form_name} {$Email}";
			$result 	= mail($to, $Subject, $Message, $headers);
			if (!$result) 
			{
				echo "ERROR";
			}
			else
			{
				echo "SENT";
			}

		}
	}


function get_item()
{
	$query = query("SELECT * FROM products WHERE product_id = ".escape_string($_GET['id'])." ");
	confirm($query);

while ($row = fetch_array($query)) 
{
$row['product_price'];
$product_image = display_image($row['product_image']);
$product_item =<<<DELIMETER
<div class="col-md-9">
<div class="row">

<div class="col-md-7">
<img class="img-responsive" src="../resources/{$product_image}" alt="">

</div>

<div class="col-md-5">

<div class="thumbnail">


<div class="caption-full">
<h4><a href="#">{$row['product_title']}</a> </h4>
<hr>
<h4 class="">&#36;{$row['product_price']}</h4>

<div class="ratings">

<p>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star-empty"></span>
4.0 stars
</p>
</div>

<p>{$row['short_desc']}</p>


<form action="">
<div class="form-group">
<a href="../resources/cart.php?add=echo {$row['product_id']}" class="btn btn-primary">ADD</a>
</div>
</form>

</div>

</div>

</div>


</div><!--Row For Image and Short Description-->


<hr>


<!--Row for Tab Panel-->

<div class="row">

<div role="tabpanel">

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="home">

<p></p>

<p>{$row['product_description']}</p>

</div>
<div role="tabpanel" class="tab-pane" id="profile">

<div class="col-md-6">

<h3>2 Reviews From </h3>

<hr>

<div class="row">
<div class="col-md-12">
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star-empty"></span>
Anonymous
<span class="pull-right">10 days ago</span>
<p>This product was great in terms of quality. I would definitely buy another!</p>
</div>
</div>

<hr>

<div class="row">
<div class="col-md-12">
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star-empty"></span>
Anonymous
<span class="pull-right">12 days ago</span>
<p>I've alredy ordered another one!</p>
</div>
</div>

<hr>

<div class="row">
<div class="col-md-12">
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star-empty"></span>
Anonymous
<span class="pull-right">15 days ago</span>
<p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
</div>
</div>

</div>


<div class="col-md-6">
<h3>Add A review</h3>

<form action="" class="form-inline">
<div class="form-group">
<label for="">Name</label>
<input type="text" class="form-control" >
</div>
<div class="form-group">
<label for="">Email</label>
<input type="test" class="form-control">
</div>

<div>
<h3>Your Rating</h3>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
</div>

<br>

<div class="form-group">
<textarea name="" id="" cols="60" rows="10" class="form-control"></textarea>
</div>

<br>
<br>
<div class="form-group">
<input type="submit" class="btn btn-primary" value="SUBMIT">
</div>
</form>

</div>

</div>

</div>

</div>


</div><!--Row for Tab Panel-->




</div>
DELIMETER;
echo $product_item;
	}
}

	/*******************BACK END FUNCTIONS************************/

function display_orders()
{
	$query = query("SELECT * FROM orders");
	confirm($query);

	while($row = fetch_array($query))
	{
		$orders = <<<DELIMETER
		<tr>
			<td>{$row['order_id']}</td>
			<td>{$row['order_amount']}</td>
			<td>{$row['order_transaction']}</td>
			<td>{$row['order_currency']}</td>
			<td>{$row['order_status']}</td>
			<td>
			<a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a>
			</td>
		</tr>
		DELIMETER;
		echo $orders;
	}
}


function get_products_in_admin()
{
	$query=query("SELECT * FROM products");
	confirm($query);
	
	
	while($row = fetch_array($query))
	{
		$cat_title=show_product_category_title($row['product_category_id']);
		$product_image=display_image($row['product_image']);
		$product=<<<DELIMETER
		<tr>
		    <td>{$row['product_id']}</td>
		    <td>{$row['product_title']}</td>
		    <td>{$cat_title}</td>
		    <td>{$row['product_price']}</td>
		    <td>{$row['product_quantity']}</td>
		    <td>
		    <a href="index.php?edit_product&id={$row['product_id']}"><img src="../../resources/{$product_image}" alt="" width="120"></a>
		    </td>
		    <td>
		    <a class="btn btn-success" href="index.php?edit_product&id={$row['product_id']}"><span class="glyphicon glyphicon-edit"></span> Edit</a>
			<a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span> Delete</a>
			</td>
		</tr>
		DELIMETER;
		echo $product;
	}


}

function add_product()
{
	if (isset($_POST['publish'])) 
	{
		extract($_POST);
		print_r($_POST);
		$product_title 				= escape_string($product_title);
		$product_category_id 		= escape_string($product_category_id);
		$product_price 				= escape_string($product_price);
		$product_description		= escape_string($product_description);
		$short_desc 				= escape_string($short_desc);
		$product_quantity 			= escape_string($product_quantity);
		$product_image				= escape_string($_FILES['file']['name']);
		$image_temp_location		= escape_string($_FILES['file']['temp_name']);

		move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY .DS. $product_image);

		$query = query("INSERT INTO products(product_title,product_category_id,product_price,product_description,short_desc,product_quantity,product_image) values('{$product_title}','{$product_category_id}','{$product_price}','{$product_description}','{$short_desc}','{$product_quantity}','{$product_image}') ");
		$last_id=last_id();
		confirm($query);
		set_message("New product with id {$last_id} was Added");
		redirect("index.php?products");

	}
}
	

function show_categories_add_product_page()
{
	$query = query("SELECT * FROM categories");
	confirm($query);

	while ($row = fetch_array($query)) 
	{
		$categories_options = <<<DELIMETER
		<option value="{$row['cat_id']}">{$row['cat_title']}</option>
		DELIMETER;
		echo $categories_options;
	}
}

function show_product_category_title($product_category_id)
{
	$category_query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");
	confirm($category_query);

	while ($row = fetch_array($category_query)) 
	{
		return $row['cat_title'];
	}
}	


function display_image($picture)
{
	global $upload_dicrectory;
	return $upload_dicrectory .DS. $picture;
}

function update_product()
{
	if (isset($_POST['update'])) 
	{
		extract($_POST);
		$product_title 				= escape_string($product_title);
		$product_category_id 		= escape_string($product_category_id);
		$product_price 				= escape_string($product_price);
		$product_description		= escape_string($product_description);
		$short_desc 				= escape_string($short_desc);
		$product_quantity 			= escape_string($product_quantity);
		$product_image				= escape_string($_FILES['file']['name']);
		$image_temp_location		= escape_string($_FILES['file']['tmp_name']);


		if (empty($product_image)) 
		{
			$get_pic = query("SELECT product_image FROM products WHERE product_id = ".escape_string($_GET['id'])."");
			confirm($get_pic);
			while ($pic = fetch_array($get_pic)) 
			{
				$product_image = $pic['product_image'];
			}
		}

		move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY .DS. $product_image);

		$query = "UPDATE products SET ";
		$query .= "product_title            = '{$product_title}'        , ";
		$query .= "product_category_id      = '{$product_category_id}'  , ";
		$query .= "product_price            = '{$product_price}'        , ";
		$query .= "product_description      = '{$product_description}'  , ";
		$query .= "short_desc               = '{$short_desc}'           , ";
		$query .= "product_quantity         = '{$product_quantity}'     , ";
		$query .= "product_image            = '{$product_image}'          ";
		$query .= "WHERE product_id=" . escape_string($_GET['id']);

		$send_update_query = query($query);
		confirm($send_update_query);
		set_message("Product was been updated ");
		redirect("index.php?products");

	}
}


function show_catgories_in_admin()
{
	$query =query("SELECT * from categories");
	confirm($query);
	while ($row = fetch_array($query)) 
	{
		$category=<<<DELIMETER
		<tr>
			<td>{$row['cat_id']}</td>
			<td>{$row['cat_title']}</td>
			<td>
			<a class="btn btn-danger" href="../../resources/templates/back/delete_category.php?id={$row['cat_id']}"><span class="glyphicon glyphicon-remove"></span> Delete</a>
			</td>
		</tr>
		DELIMETER;
		echo $category;
	}
}


function add_category()
{
	if (isset($_POST['add_category'])) 
	{
		$cat_title = escape_string($_POST['cat_title']);
		if (empty($cat_title)) 
		{
			
			set_message("Category Field is empty ");

		}
		else
		{
		$insert_query = query("INSERT INTO categories(cat_title) values('{$cat_title}')");
		confirm($insert_query);
		redirect("index.php?categories");
		}
	}
}

function display_users()
{
	$query = query("SELECT * FROM users");
	confirm($query);
	while ($row = fetch_array($query)) 
	{
		extract($row);
		$users=<<<DELIMETER
		<tr>
			<td>{$user_id}</td>
			<td>{$username}</td>
			<td>{$email}</td>
			<td>{$password}</td>
			<td>
			<a class="btn btn-primary" href="index.php?edit_user&id={$row['user_id']}"><span class="glyphicon glyphicon-edit"></span> Edit</a>
			<a class="btn btn-danger" href="../../resources/templates/back/delete_users.php?id={$row['user_id']}"><span class="glyphicon glyphicon-remove"></span> Delete</a>
			</td>
		</tr>
		DELIMETER;
		echo $users;
	}
}


function add_user()
{
	if (isset($_POST['add_user'])) 
	{
		extract($_POST);
		$username 	= escape_string($username);
		$email  	= escape_string($email);
		$password	= escape_string($password);
		/*$user_photo	= escape_string($_FILES['file']['name']);
		$photo_temp	= escape_string($_FILES['file']['tmp_name']);
		move_uploaded_file($photo_temp, UPLOAD_DIRECTORY .DS. $user_photo);*/

		$query = query("INSERT INTO users(username,email,password) values('{$username}','{$email}','	{$password}')");

		confirm($query);
		set_message("USER CREATED");
		redirect("index.php?users");
	}
}


function update_user()
{
	if (isset($_POST['update_user'])) 
	{
		$username 	= escape_string($_POST['username']);
		$email 		= escape_string($_POST['email']);
		$password	= escape_string($_POST['password']);
		

		$query = "UPDATE users SET ";
		$query .= "username            		= '{$username}'     , ";
		$query .= "email      				= '{$email}' 		, ";
		$query .= "password           		= '{$password}'       ";
		$query .= "WHERE user_id=" . escape_string($_GET['id']);

		$send_update_query = query($query);
		confirm($send_update_query);
		set_message("password was been updated ");
		redirect("index.php?users");

	}
}


function get_report()
{
	$query = query("SELECT * FROM reports");
	confirm($query);
	while ($row = fetch_array($query)) 
	{
		$report=<<<DELIMETER
		<tr>
			<td>{$row['report_id']}</td>
			<td>{$row['product_id']}</td>
			<td>{$row['order_id']}</td>
			<td>{$row['product_price']}</td>
			<td>{$row['product_title']}</td>
			<td>{$row['product_quantity']}</td>
			<td>
			<a class="btn btn-danger" href="../../resources/templates/back/delete_report.php?id={$row['report_id']}"><span class="glyphicon glyphicon-remove"></span> Delete</a>
			</td>
		</tr>
		DELIMETER;
		echo $report;
	}
}


function add_slide()
{

	if (isset($_POST['add_slide'])) 
	{
		$slide_title 		=escape_string($_POST['slide_title']);
		$slide_image 		=escape_string($_FILES['file']['name']);
		$slide_image_loc 	=escape_string($_FILES['file']['tmp_name']);

		if (empty($slide_title) || empty($slide_image)) 
		{
			echo "<p class='bg-danger'> This Field cannot be empty</p>";
		}
		else
		{
			move_uploaded_file($slide_image_loc, UPLOAD_DIRECTORY .DS. $slide_image);
			$query =query("INSERT INTO slides(slide_title,slide_image) values('{$slide_title}','{$slide_image}')");
			confirm($query);
			set_message("Slide Added");
			redirect("index.php?slides");
		}	

	}
}

function get_current_slide_in_admin()
{
	$query = query("SELECT * From slides ORDER BY slide_id DESC LIMIT 1");
	confirm($query);
	while ($row = fetch_array($query)) 
	{
		$slide_image = display_image($row['slide_image']);
		$slide_active =<<<DELIMETER
			<img class="img-responsive" src="../../resources/{$slide_image}" alt="">
		DELIMETER;
		echo $slide_active;
	}

}

function get_active()
{

	$query = query("SELECT * From slides ORDER BY slide_id DESC LIMIT 1");
	confirm($query);
	while ($row = fetch_array($query)) 
	{
		$slide_image = display_image($row['slide_image']);
		$slide_active =<<<DELIMETER
		<div class="item active">
			<img class="slide-image" src="../resources/{$slide_image}" alt="">
		</div>
		DELIMETER;
		echo $slide_active;
	}

}


function get_slides()
{
	$query = query("SELECT * From slides");
	confirm($query);
	while ($row = fetch_array($query)) 
	{
		$slide_image = display_image($row['slide_image']);

		$slides =<<<DELIMETER
		<div class="item">
			<img class="slide-image" src="../resources/{$slide_image}" alt="">
		</div>
		DELIMETER;
		echo $slides;
	}
}

function get_slide_thumbnails()
{
	$query = query("SELECT * From slides ORDER BY slide_id ASC");
	confirm($query);
	while ($row = fetch_array($query)) 
	{
		$slide_image = display_image($row['slide_image']);
		$slide_thumb_admin =<<<DELIMETER
		<div class="col-xs-6 col-md-3">
			<a href="index.php?delete_slide_id={$row['slide_id']}">
				<img class="img-responsive" src="../../resources/{$slide_image}"  alt="">
			</a>
		</div>
		DELIMETER;
		echo $slide_thumb_admin;
	}
}


 ?>