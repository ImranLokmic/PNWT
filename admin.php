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