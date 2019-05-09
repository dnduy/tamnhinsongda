
<link href="css/style.css" type="text/css" rel="stylesheet"> 

 

<?php if ($_GET["com"]=="lien-he") {?>
<link href="css/style_contact.css" type="text/css" rel="stylesheet">
<?php }?>


<?php if ($_GET["com"]!="" || $_GET["com"]!="index" || $_GET["com"]!="lien-he") {?>
<link href="css/style_baiviet.css" type="text/css" rel="stylesheet">
<?php }?>


<?php if ($template=="product_detail") {?>
<link href="css/style_product_detail.css" type="text/css" rel="stylesheet">
<?php }?>

