<?php
session_start();
require_once("dbmenu.php");
$db_handle = new DBController();

if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if(!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM menu WHERE code='" . $_GET["code"] . "'");
                $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
                
                if(!empty($_SESSION["cart_item"])) {
                    if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                                if($productByCode[0]["code"] == $k) {
                                    if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                                    }
                                    $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
        break;
        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                        if($_GET["code"] == $k)
                            unset($_SESSION["cart_item"][$k]);				
                        if(empty($_SESSION["cart_item"]))
                            unset($_SESSION["cart_item"]);
                }
            }
        break;
        case "empty":
            unset($_SESSION["cart_item"]);
        break;	
    }
    }


?>

<html>
<head>
    <title>POS</title>
    <link rel="stylesheet" href="css/backgroundcss.css">
    <link rel="stylesheet" href="css/pos.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

</body>

<div class="header">
                <div class="header-products">
                        <div class="header-item" onclick="dDropdown()">Drinks</div>
                            <div class="header-dropdown-item" onclick="dReset()"><i class="fa fa-angle-double-left" style="font-size:36px;color:white"></i></div>
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

<div id="shopping-cart">
    <div id="shopping-modal">
        <span class="close" onclick="cartClose()">&times;</span>
		<div class="txt-heading">Shopping Cart</div>

		<a id="btnEmpty" href="admin.php?action=empty">Empty Cart</a>
		<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>
		<form method="post" action="">
		<table class="tbl-cart" cellpadding="10" cellspacing="1">
			<tbody>
				<tr>
					<th style="text-align:left;">Name</th>
					<th style="text-align:left;">Code</th>
					<th style="text-align:right;" width="5%">Quantity</th>
					<th style="text-align:right;" width="10%">Unit Price</th>
					<th style="text-align:right;" width="10%">Price</th>
					<th style="text-align:center;" width="5%">Remove</th>
				</tr>
				<?php		
    				foreach ($_SESSION["cart_item"] as $item){
        			$item_price = $item["quantity"]*$item["price"];
				?>
				<tr>
					<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?>
					</td>
					<td><?php echo $item["code"]; ?></td>
					<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
					<td style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
					<td style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
					<td style="text-align:center;"><a href="admin.php?action=remove&code=<?php echo $item["code"]; ?>"
							class="btnRemoveAction"><img src="IMAGES\icon-delete.png" style="max-height:30px" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

				<tr>
					<td colspan="2" align="right">Total:</td>
					<td align="right"><?php echo $total_quantity; ?></td>
					<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong>
					</td>
					<td></td>
				</tr>
				<tr>	
					<td colspan="6" style="text-align:center;"><input type="submit" name="buy" value="BUY"></td>
				</tr>
			</tbody>
		</table>
		<?php
} else {
?>
		<div class="no-records">Your Cart is Empty</div>
		<?php 
}
?>
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
			<form method="post" action="admin.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
				<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
						style="max-height:150px"></div>
				<div class="product-tile-footer">
					<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
					<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
					<br>
					<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to basket" class="btnAddAction" /></div>
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
			<form method="post" action="admin.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
				<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
						style="max-height:150px"></div>
				<div class="product-tile-footer">
					<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
					<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
					<br>
					<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to basket" class="btnAddAction" /></div>
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
			<form method="post" action="admin.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
				<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
						style="max-height:150px"></div>
				<div class="product-tile-footer">
					<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
					<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
					<br>
					<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to basket" class="btnAddAction" /></div>
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
			<form method="post" action="admin.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
				<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
						style="max-height:150px"></div>
				<div class="product-tile-footer">
					<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
					<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
					<br>
					<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to basket" class="btnAddAction" /></div>
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
			<form method="post" action="admin.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
				<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
						style="max-height:150px"></div>
				<div class="product-tile-footer">
					<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
					<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
					<br>
					<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to basket" class="btnAddAction" /></div>
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
			<form method="post" action="admin.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
				<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
						style="max-height:150px"></div>
				<div class="product-tile-footer">
					<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
					<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
					<br>
					<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to basket" class="btnAddAction" /></div>
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
			<form method="post" action="admin.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
				<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
						style="max-height:150px"></div>
				<div class="product-tile-footer">
					<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
					<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
					<br>
					<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to basket" class="btnAddAction" /></div>
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
			<form method="post" action="admin.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
				<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
						style="max-height:150px"></div>
				<div class="product-tile-footer">
					<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
					<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
					<br>
					<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to basket" class="btnAddAction" /></div>
				</div>
			</form>
		</div>
		<?php
		}
	}
	?>


</div>


<button onclick="cartShow()" id="myBtn" title="Cart"><img src="https://img.icons8.com/material-outlined/24/000000/shopping-cart--v1.png"/></button>



<script>
    function dDropdown(){
        $(".header-dropdown-item").toggleClass("header-dropdown-display-trigger");
        $(".header-item").toggleClass("header-item-display-trigger");
    }
    function dReset(){
        $(".header-dropdown-item").toggleClass("header-dropdown-display-trigger");
        $(".header-item").toggleClass("header-item-display-trigger");
    }

    function sDrinks(){
        $(".softdrinks").show();
        $(".alch").hide();
        $(".app").hide();
        $(".bbq").hide();
        $(".steaks").hide();
        $(".pasta").hide();
        $(".pizza").hide();
        $(".salad").hide();
    }

    function aDrinks(){
        $(".softdrinks").hide();
        $(".alch").show();
        $(".app").hide();
        $(".bbq").hide();
        $(".steaks").hide();
        $(".pasta").hide();
        $(".pizza").hide();
        $(".salad").hide();
    }

    function app(){
        $(".softdrinks").hide();
        $(".app").show();
        $(".bbq").hide();
        $(".steaks").hide();
        $(".pasta").hide();
        $(".pizza").hide();
        $(".salad").hide();
    }
    function bbq(){
        $(".softdrinks").hide();
        $(".alch").hide();
        $(".app").hide();
        $(".bbq").show();
        $(".steaks").hide();
        $(".pasta").hide();
        $(".pizza").hide();
        $(".salad").hide();
    }
    function steaks(){
        $(".softdrinks").hide();
        $(".alch").hide();
        $(".app").hide();
        $(".bbq").hide();
        $(".steaks").show();
        $(".pasta").hide();
        $(".pizza").hide();
        $(".salad").hide();
    }
    function pasta(){
        $(".softdrinks").hide();
        $(".alch").hide();
        $(".app").hide();
        $(".bbq").hide();
        $(".steaks").hide();
        $(".pasta").show();
        $(".pizza").hide();
        $(".salad").hide();
    }
    function pizza(){
        $(".softdrinks").hide();
        $(".alch").hide();
        $(".app").hide();
        $(".bbq").hide();
        $(".steaks").hide();
        $(".pasta").hide();
        $(".pizza").show();
        $(".salad").hide();
    }
    function salad(){
        $(".softdrinks").hide();
        $(".alch").hide();
        $(".app").hide();
        $(".bbq").hide();
        $(".steaks").hide();
        $(".pasta").hide();
        $(".pizza").hide();
        $(".salad").show();
    }

    function cartShow(){
        $("#shopping-cart").show();
    }

    function cartClose(){
        $("#shopping-cart").hide();
    }
</script>

</html>