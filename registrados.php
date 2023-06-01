<?php
    include("templates/funciones.php");
    $fecha_hoy = date("Y-m-d");
    $fecha_min = date("Y-m-d", strtotime($fecha_hoy . "- 1 year"));

    $registros = $cn->query("SELECT * FROM `registrados_22_nov` ORDER BY reg_ID;");

    include("templates/header-top.php");
?>

    <p><label class="form_label"><h1><b>REGISTRADOS HASTA AHORA</b></h1></label><br></p>
    
    <p style="vertical-align: top;">
        <?php
        if (!$registros->num_rows == 0)
            {?>
                <table class="table table-responsive font-weight-bold text-white text-center" style="background: rgb(4,0,51);background: linear-gradient(90deg, rgba(4,0,51,1) 0%, rgba(43,0,47,1) 35%, rgba(4,0,51,1) 100%);">
                    <th class="text-center font-size-h2" style="vertical-align: top;">NOMBRE</th>
                    <th class="text-center font-size-h2" style="vertical-align: top;">TELÉFONO</th>
                    <th class="text-center font-size-h2" style="vertical-align: top;">QUÉ TIENE?</th>
                    <th class="text-center font-size-h2" style="vertical-align: top;">OTROS</th>
                    <?php
                        while ($fila = mysqli_fetch_array($registros)) {
                            $reg_ID = $fila["reg_ID"];
                            $reg_Nombre = $fila["reg_Nombre"];
                            $reg_Telefono = $fila["reg_Telefono"];
                            $reg_elemento_Campera = $fila["reg_elemento_Campera"];
                            $reg_elemento_Camisa = $fila["reg_elemento_Camisa"];
                            $reg_elemento_Chaleco = $fila["reg_elemento_Chaleco"];
                            $reg_elemento_Pantalon = $fila["reg_elemento_Pantalon"];
                            $reg_elemento_Chaps = $fila["reg_elemento_Chaps"];
                            $reg_elemento_Botas = $fila["reg_elemento_Botas"];
                            $reg_elemento_Arnes = $fila["reg_elemento_Arnes"];
                            $reg_elemento_MuirCap = $fila["reg_elemento_MuirCap"];
                            $reg_elemento_Otro = $fila["reg_elemento_Otro"];
                            if (!empty($reg_elemento_Otro)){$reg_elemento_Otro="<li>".$reg_elemento_Otro;}
                            
                            $reg_elementos="<ul>";
                            if ($reg_elemento_Campera==1){$reg_elementos="<li>Campera";}
                            if ($reg_elemento_Camisa==1){$reg_elementos=$reg_elementos."<li>Camisa";}
                            if ($reg_elemento_Chaleco==1){$reg_elementos=$reg_elementos."<li>Chaleco";}
                            if ($reg_elemento_Pantalon==1){$reg_elementos=$reg_elementos."<li>Pantalón";}
                            if ($reg_elemento_Chaps==1){$reg_elementos=$reg_elementos."<li>Chaps";}
                            if ($reg_elemento_Botas==1){$reg_elementos=$reg_elementos."<li>Botas";}
                            if ($reg_elemento_Arnes==1){$reg_elementos=$reg_elementos."<li>Arnés";}
                            if ($reg_elemento_MuirCap==1){$reg_elementos=$reg_elementos."<li>Muir Cap";}
                            $reg_elementos=$reg_elementos."</ul>";
                            ?>
                            <!-- Break -->
                            <tr>
                                <td class="font-size-h6" style="vertical-align: top;" align="left"><?php echo $reg_Nombre ?></td>
                                <td class="font-size-h6" style="vertical-align: top;" align="left"><?php echo $reg_Telefono ?></td>
                                <td class="font-size-h6" style="vertical-align: top;" align="left"><?php echo $reg_elementos ?></td>
                                <td class="font-size-h6" style="vertical-align: top;" align="left"><?php echo $reg_elemento_Otro ?></td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
            <?php
        }?>

    </p>

    <?php include("templates/header-bottom.php"); ?>