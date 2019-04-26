<?php
include("../classes/autoload.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#v-carusel').jcarousel({
                scroll: 1
            });
        });

        jQuery(document).ready(function() {
            jQuery('#video-carusel').jcarousel({
                scroll: 1
            });
        });
    </script>


</head>

<body>


<!-- шапка сайта -->

<div id="header">

    <?
    include('header.php');
    ?>

</div>

<!-- тело сайта -->

<div id="wrapper">

    <!-- левая часть -->
    <?
    include('leftblock.php');
    ?>
    <!-- правая часть -->
    <?
    include('rightblock.php');
    ?>

</div>

<!-- подвал сайта -->
<div class="clear"></div>
<div id="footer">
    &copy; 2013 - 2014 SFS GROUP | <a href="#">студинфо.ру</a> <br>
</div>
</body>

</html>
