<?php
session_start();
require_once("dbmenu.php");
$db_handle = new DBController();
?>
<html>

<head>
	<title>POS</title>
	<link rel="stylesheet" href="css/backgroundcss.css">
	<link rel="stylesheet" href="css/admin.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

</body>

<div class="header">
	<div class="header-products">
		<div class="header-item" onclick="dDropdown()">Drinks</div>
		<div class="header-dropdown-item" onclick="dReset()"><i class="fa fa-angle-double-left"
				style="font-size:36px;color:white"></i></div>
		<div class="header-dropdown-item" onclick="sDrinks()">Soft drinks</div>
		<div class="header-dropdown-item" onclick="aDrinks()">Alcohol</div>
		<div class="header-item" onclick="app()">Appetisers</div>
		<div class="header-item" onclick="bbq()">BBQ</div>
		<div class="header-item" onclick="steaks()">Steaks</div>
		<div class="header-item" onclick="pasta()">Pasta</div>
		<div class="header-item" onclick="pizza()">Pizza</div>
		<div class="header-item" onclick="salad()">Salad</div>
	</div>
</div>

<div id="add-item-menu">
		<div class="login-box">
			<form id="additem" method="post" action="add.php">
				<div class="user-box">
					<input type="text" name="pname" required="">
					<label>Product Name</label>
				</div>
				<div class="user-box">
					<input type="text" name="code" required="">
					<label>Code</label>
				</div>
				<div class="user-box">
					<input type="number" name="price" required="">
					<label>Price</label>
				</div>
				<div class="user-box">
					<input type="radio" name="food" value="soft" required="">
					<label>Soft Drinks</label>
				</div>
				<div class="user-box">
					<input type="radio" name="food" value="alch" required="">
					<label>Alchohol</label>
				</div>
				<div class="user-box">
					<input type="radio" name="food" value="app" required="">
					<label>Appetisers</label>
				</div>
				<div class="user-box">
					<input type="radio" name="food" value="bbq" required="">
					<label>BBQ</label>
				</div>
				<div class="user-box">
					<input type="radio" name="food" value="steaks" required="">
					<label>Steaks</label>
				</div>
				<div class="user-box">
					<input type="radio" name="food" value="pasta" required="">
					<label>Pasta</label>
				</div>
				<div class="user-box">
					<input type="radio" name="food" value="pizza" required="">
					<label>Pizza</label>
				</div>
				<div class="user-box">
					<input type="radio" name="food" value="salad" required="">
					<label>Salad</label>
				</div>
				<a href="#" onclick="addItemSubmit()" value="submit">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					Submit
				</a>
				<span class="close" onclick="closeItem()">&times;</span>
			</form>
		</div>
	
</div>

<div id="product-grid">
	<?php
				$product_array = $db_handle->runQuery("SELECT * FROM menu WHERE food='soft' ORDER BY id ASC");
				if (!empty($product_array)) { 
				foreach($product_array as $key=>$value){
			?>
	<div class="product-item softdrinks">
		<form method="post" action="remove.php?code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
					style="max-height:150px;max-width:240px;"></div>
			<div class="product-tile-footer">
				<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
				<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
				<br>
				<div class="cart-action"><input type="submit" value="REMOVE" class="btnAddAction" /></div>
			</div>
		</form>
	</div>
	<?php
		}
	}
	?>


</div>

<div id="product-grid">
	<?php
				$product_array = $db_handle->runQuery("SELECT * FROM menu WHERE food='alch' ORDER BY id ASC");
				if (!empty($product_array)) { 
				foreach($product_array as $key=>$value){
			?>
	<div class="product-item alch">
		<form method="post" action="remove.php?code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
					style="max-height:150px;max-width:240px;"></div>
			<div class="product-tile-footer">
				<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
				<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
				<br>
				<div class="cart-action"><input type="submit" value="REMOVE" class="btnAddAction" /></div>
			</div>
		</form>
	</div>
	<?php
		}
	}
	?>


</div>

<div id="product-grid">
	<?php
				$product_array = $db_handle->runQuery("SELECT * FROM menu WHERE food='app' ORDER BY id ASC");
				if (!empty($product_array)) { 
				foreach($product_array as $key=>$value){
			?>
	<div class="product-item app">
		<form method="post" action="remove.php?code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
					style="max-height:150px;max-width:240px;"></div>
			<div class="product-tile-footer">
				<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
				<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
				<br>
				<div class="cart-action"><input type="submit" value="REMOVE" class="btnAddAction" /></div>
			</div>
		</form>
	</div>
	<?php
		}
	}
	?>


</div>

<div id="product-grid">
	<?php
				$product_array = $db_handle->runQuery("SELECT * FROM menu WHERE food='bbq' ORDER BY id ASC");
				if (!empty($product_array)) { 
				foreach($product_array as $key=>$value){
			?>
	<div class="product-item bbq">
		<form method="post" action="remove.php?code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
					style="max-height:150px;max-width:240px;"></div>
			<div class="product-tile-footer">
				<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
				<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
				<br>
				<div class="cart-action"><input type="submit" value="REMOVE" class="btnAddAction" /></div>
			</div>
		</form>
	</div>
	<?php
		}
	}
	?>


</div>

<div id="product-grid">
	<?php
				$product_array = $db_handle->runQuery("SELECT * FROM menu WHERE food='steaks' ORDER BY id ASC");
				if (!empty($product_array)) { 
				foreach($product_array as $key=>$value){
			?>
	<div class="product-item steaks">
		<form method="post" action="remove.php?code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
					style="max-height:150px;max-width:240px;"></div>
			<div class="product-tile-footer">
				<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
				<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
				<br>
				<div class="cart-action"><input type="submit" value="REMOVE" class="btnAddAction" /></div>
			</div>
		</form>
	</div>
	<?php
		}
	}
	?>


</div>

<div id="product-grid">
	<?php
				$product_array = $db_handle->runQuery("SELECT * FROM menu WHERE food='pasta' ORDER BY id ASC");
				if (!empty($product_array)) { 
				foreach($product_array as $key=>$value){
			?>
	<div class="product-item pasta">
		<form method="post" action="remove.php?code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
					style="max-height:150px;max-width:240px;"></div>
			<div class="product-tile-footer">
				<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
				<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
				<br>
				<div class="cart-action"><input type="submit" value="REMOVE" class="btnAddAction" /></div>
			</div>
		</form>
	</div>
	<?php
		}
	}
	?>


</div>

<div id="product-grid">
	<?php
				$product_array = $db_handle->runQuery("SELECT * FROM menu WHERE food='pizza' ORDER BY id ASC");
				if (!empty($product_array)) { 
				foreach($product_array as $key=>$value){
			?>
	<div class="product-item pizza">
		<form method="post" action="remove.php?code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
					style="max-height:150px;max-width:240px;"></div>
			<div class="product-tile-footer">
				<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
				<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
				<br>
				<div class="cart-action"><input type="submit" value="REMOVE" class="btnAddAction" /></div>
			</div>
		</form>
	</div>
	<?php
		}
	}
	?>


</div>

<div id="product-grid">
	<?php
				$product_array = $db_handle->runQuery("SELECT * FROM menu WHERE food='salad' ORDER BY id ASC");
				if (!empty($product_array)) { 
				foreach($product_array as $key=>$value){
			?>
	<div class="product-item salad">
		<form method="post" action="remove.php?code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
					style="max-height:150px;max-width:240px;"></div>
			<div class="product-tile-footer">
				<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
				<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
				<br>
				<div class="cart-action"><input type="submit" value="REMOVE" class="btnAddAction" /></div>
			</div>
		</form>
	</div>
	<?php
		}
	}
	?>


</div>


<button onclick="addItem()" id="myBtn" title="Cart"><img
		src="https://img.icons8.com/ios-filled/50/000000/plus-math.png" /></button>



<script>
	$(document).ready(function () {
		$(".softdrinks").hide();
		$(".alch").hide();
		$(".app").hide();
		$(".bbq").hide();
		$(".steaks").hide();
		$(".pasta").hide();
		$(".pizza").hide();
		$(".salad").hide();
	});


	function dDropdown() {
		$(".header-dropdown-item").toggleClass("header-dropdown-display-trigger");
		$(".header-item").toggleClass("header-item-display-trigger");
	}

	function dReset() {
		$(".header-dropdown-item").toggleClass("header-dropdown-display-trigger");
		$(".header-item").toggleClass("header-item-display-trigger");
	}

	function sDrinks() {
		$(".softdrinks").show();
		$(".alch").hide();
		$(".app").hide();
		$(".bbq").hide();
		$(".steaks").hide();
		$(".pasta").hide();
		$(".pizza").hide();
		$(".salad").hide();
	}

	function aDrinks() {
		$(".softdrinks").hide();
		$(".alch").show();
		$(".app").hide();
		$(".bbq").hide();
		$(".steaks").hide();
		$(".pasta").hide();
		$(".pizza").hide();
		$(".salad").hide();
	}

	function app() {
		$(".softdrinks").hide();
		$(".alch").hide();
		$(".app").show();
		$(".bbq").hide();
		$(".steaks").hide();
		$(".pasta").hide();
		$(".pizza").hide();
		$(".salad").hide();
	}

	function bbq() {
		$(".softdrinks").hide();
		$(".alch").hide();
		$(".app").hide();
		$(".bbq").show();
		$(".steaks").hide();
		$(".pasta").hide();
		$(".pizza").hide();
		$(".salad").hide();
	}

	function steaks() {
		$(".softdrinks").hide();
		$(".alch").hide();
		$(".app").hide();
		$(".bbq").hide();
		$(".steaks").show();
		$(".pasta").hide();
		$(".pizza").hide();
		$(".salad").hide();
	}

	function pasta() {
		$(".softdrinks").hide();
		$(".alch").hide();
		$(".app").hide();
		$(".bbq").hide();
		$(".steaks").hide();
		$(".pasta").show();
		$(".pizza").hide();
		$(".salad").hide();
	}

	function pizza() {
		$(".softdrinks").hide();
		$(".alch").hide();
		$(".app").hide();
		$(".bbq").hide();
		$(".steaks").hide();
		$(".pasta").hide();
		$(".pizza").show();
		$(".salad").hide();
	}

	function salad() {
		$(".softdrinks").hide();
		$(".alch").hide();
		$(".app").hide();
		$(".bbq").hide();
		$(".steaks").hide();
		$(".pasta").hide();
		$(".pizza").hide();
		$(".salad").show();
	}

	function addItem() {
		$("#add-item-menu").show();
	}

	function closeItem() {
		$("#add-item-menu").hide();
	}

	function addItemSubmit(){
    document.getElementById('additem').submit();
    return false;
    }
</script>

</html>