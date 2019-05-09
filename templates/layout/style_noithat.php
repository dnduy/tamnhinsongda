
<link href="css/style_noithat.css" type="text/css" rel="stylesheet"> 

<?php if ($_GET["com"]=="lien-he") {?>
<link href="css/style_contact.css" type="text/css" rel="stylesheet">
<?php }?>


<?php if ($_GET["com"]!="" || $_GET["com"]!="index" || $_GET["com"]!="lien-he") {?>
<link href="css/style_baiviet_noithat.css" type="text/css" rel="stylesheet">
<?php }?>


<?php if ($template=="product_detail") {?>
<link href="css/style_noithat_detail.css" type="text/css" rel="stylesheet">
<?php }?>

