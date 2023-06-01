<?php
    $fecha_hoy = date("Y-m-d");
    $fecha_min = date("Y-m-d", strtotime($fecha_hoy . "- 1 year"));
    $onLoad="";

    include("templates/header-top.php");
?>

    <div>
        <p align="center">
            <img src="media/icon_ok.png" height="100"><br>
            <label class="form_label">
                Tu pago ya fue ingresado. Gracias!<br><br>
                Confirmanos tu pago mediante <a href="https://www.instagram.com/leathercruising.ba/" target="IG">DM en Instagram</a> o WhatsApp a los organizadores.<br><br>
            </label>
            
        </p>
    </div>

    <?php include("templates/header-bottom.php"); ?>