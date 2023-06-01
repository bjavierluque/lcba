<?php
    $fecha_hoy = date("Y-m-d");
    $fecha_min = date("Y-m-d", strtotime($fecha_hoy . "- 1 year"));
    $onLoad="";

    include("templates/header-top.php");
?>

    <div>
        <p align="center">
            <img src="media/icon_process.png" height="100">
            <label class="form_label">Tu pago se encuentra en proceso.</label>
        </p>
    </div>

    <?php include("templates/header-bottom.php"); ?>