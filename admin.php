<?php
session_start();
require_once("dbmenu.php");
$db_handle = new DBController();

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
                            <div class="header-dropdown-item">Soft drinks</div>
                            <div class="header-dropdown-item">Alcohol</div>
                        <div class="header-item">Appetisers</div>
                        <div class="header-item">BBQ</div>
                        <div class="header-item">Steaks</div>
                        <div class="header-item">Pasta</div>
                        <div class="header-item">Pizza</div>
                        <div class="header-item">Salad</div>
                </div>
</div>


<div id="product-grid">
		<?php
				$product_array = $db_handle->runQuery("SELECT * FROM menu WHERE food='soft' ORDER BY id ASC");
				if (!empty($product_array)) { 
				foreach($product_array as $key=>$value){
			?>
		<div class="product-item softdrinks">
			<form method="post" action="store.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
				<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"
						style="max-height:150px"></div>
				<div class="product-tile-footer">
					<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
					<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
					<br>
					<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
				</div>
			</form>
		</div>
		<?php
		}
	}
	?>


</div>


<script>
    function dDropdown(){
        $(".header-dropdown-item").toggleClass("header-dropdown-display-trigger");
        $(".header-item").toggleClass("header-item-display-trigger");
    }
    function dReset(){
        $(".header-dropdown-item").toggleClass("header-dropdown-display-trigger");
        $(".header-item").toggleClass("header-item-display-trigger");
    }
</script>

</html>