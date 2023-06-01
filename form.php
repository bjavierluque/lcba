<?php
    include("templates/funciones.php");

    $fecha_hoy = date("Y-m-d");
    $fecha_min = date("Y-m-d", strtotime($fecha_hoy . "- 1 year"));
    $mensaje = ""; $action = ""; $registros = 0; $QueryBuscarTelefono = ""; $Query=""; $query_INSERT = "";
    if ($action==""){$onLoad="onLoad='document.form1.Nombre.focus();'";}

    $reg_ID=0;
    $Nombre = ""; $NombreRegistrado = "";
    $Contacto = "";
    $Campera = 0; $Camperas = "";
    $Camisa = 0; $Camisas = "";
    $Chaleco = 0; $Chalecos = "";
    $Pantalon = 0; $Pantalons = "";
    $Chaps = 0; $Chapss = "";
    $Botas = 0; $Botass = "";
    $Arnes = 0; $Arness = "";
    $MuirCap = 0; $MuirCaps = "";
    $Otro = "";
    $Pago = 0; $Pagos = "";


    if (!empty($_REQUEST["action"])) {$action = LimpiarRequest($_REQUEST["action"]);}
    if (!empty($_REQUEST["Nombre"])) {$Nombre = LimpiarRequest($_REQUEST["Nombre"]); $NombreRegistrado = $Nombre." , ";}
    if (!empty($_REQUEST["Contacto"])) {$Contacto = LimpiarRequest($_REQUEST["Contacto"]);}
    if (!empty($_REQUEST["Campera"])) {$Campera = 1; $Camperas = "checked";}
    if (!empty($_REQUEST["Camisa"])) {$Camisa = 1; $Camisas = "checked";}
    if (!empty($_REQUEST["Chaleco"])) {$Chaleco = 1; $Chalecos = "checked";}
    if (!empty($_REQUEST["Pantalon"])) {$Pantalon = 1; $Pantalons = "checked";}
    if (!empty($_REQUEST["Chaps"])) {$Chaps = 1; $Chapss = "checked";}
    if (!empty($_REQUEST["Botas"])) {$Botas = 1; $Botass = "checked";}
    if (!empty($_REQUEST["Arnes"])) {$Arnes = 1; $Arness = "checked";}
    if (!empty($_REQUEST["MuirCap"])) {$MuirCap = 1; $MuirCaps = "checked";}
    if (!empty($_REQUEST["Otro"])) {$Otro = LimpiarRequest($_REQUEST["Otro"]);}
    //if (!empty($_REQUEST["Pago"])) {$Pago = 1; $Pagos = "checked";}


    switch ($action) {
        case "reg":
            if (!empty($Contacto)) {
                $Contacto = str_replace(" ", "", $Contacto);
                $Contacto = str_replace("-", "", $Contacto);
                $QueryBuscarTelefono = "SELECT * FROM registrados_22_nov 
                WHERE (registrados_22_nov.reg_Telefono = '" . $Contacto . "');";
                //echo $QueryBuscarTelefono."<br><br>";
                $Query = $cn->query($QueryBuscarTelefono);
                if ($fila = mysqli_fetch_array($Query)) {
                    $reg_ID = $fila["reg_ID"];
                }    
            }
            
            if ($reg_ID==0){
                $query_INSERT = "INSERT INTO registrados_22_nov (`reg_ID`, `reg_Nombre`, `reg_Telefono`, `reg_Pago`, `reg_elemento_Campera`, `reg_elemento_Camisa`, `reg_elemento_Chaleco`, `reg_elemento_Pantalon`, `reg_elemento_Chaps`, `reg_elemento_Botas`, `reg_elemento_Arnes`, `reg_elemento_MuirCap`, `reg_elemento_Otro`) 
                VALUES (NULL, '".$Nombre."', '".$Contacto."', '".$Pago."', '".$Campera."', '".$Camisa."', '".$Chaleco."', '".$Pantalon."', '".$Chaps."', '".$Botas."', '".$Arnes."', '".$MuirCap."', '".$Otro."');";
                $cn->query($query_INSERT);
            }else{
                $query_INSERT = "UPDATE registrados_22_nov SET 
                reg_Nombre = '$Nombre', 
                reg_Telefono = '$Contacto', 
                reg_Pago = '$Pago', 
                reg_elemento_Campera = '$Campera', 
                reg_elemento_Camisa = '$Camisa', 
                reg_elemento_Chaleco = '$Chaleco', 
                reg_elemento_Pantalon = '$Pantalon', 
                reg_elemento_Chaps = '$Chaps', 
                reg_elemento_Botas = '$Botas', 
                reg_elemento_Arnes = '$Arnes', 
                reg_elemento_MuirCap = '$MuirCap', 
                reg_elemento_Otro = '$Otro' 
                WHERE registrados_22_nov.reg_ID = '$reg_ID';";
                $cn->query($query_INSERT);
            }
            //echo $query_INSERT;

            //if ($Pago == 1){$action="pay";}else{$action="end";}
            $action="pay";
            break;

        default:

    }

    include("templates/header-top.php");
    
    switch ($action) {
        
        case "":?>
            <FORM class="form" name="form1" id="form1" method="POST" action="form?action=reg" onsubmit="return validar_form1(this);">

                <div>
                    <p>
                        <label class="form_label">No te pierdas el último <a href="https://www.instagram.com/p/CjvuYaFuviP/" target="IG">LEATHER CRUISING</a> del año!<br>
                        Hacé tu reserva aquí y, a continuación, podrás adquirir tu entrada.<br>
                        <a href="faq">Preguntas Frecuentes</a></label>
                    </p>

                    <p>
                        <label for="Nombre" class="form_label">Tu Nombre *</label>
                        <input  type="text" name="Nombre" id="Nombre" value="<?php echo $Nombre ?>" placeholder="Nombre" maxlenght=20 />
                    </p>

                    <p>
                        <label for="Contacto" class="form_label">Tu WhatsApp *</label>
                        <input  type="text" name="Contacto" id="Contacto" value="<?php echo $Contacto ?>" placeholder="Sin 0 ni 15" maxlenght=13 />
                    </p>

                    <p>&nbsp;</p>

                    <p>
                        <label for="sin_Forma" class="form_label">
                            Con qué prendas o elementos de cuero asistirás?
                        </label>
                    </p>

                    <p>
                        <input class="form_check" type="checkbox" id="Campera" name="Campera" <?php echo $Camperas ?>>&nbsp;
                        <label for="Campera" class="form_label">Campera de cuero</label>
                    </p>

                    <p>
                        <input class="form_check" type="checkbox" id="Camisa" name="Camisa" <?php echo $Camisas ?>>&nbsp;
                        <label for="Camisa" class="form_label">Camisa de cuero</label>
                    </p>

                    <p>
                        <input class="form_check" type="checkbox" id="Chaleco" name="Chaleco" <?php echo $Chalecos ?>>&nbsp;
                        <label for="Chaleco" class="form_label">Chaleco de cuero</label>
                    </p>

                    <p>
                        <input class="form_check" type="checkbox" id="Pantalon" name="Pantalon" <?php echo $Pantalons ?>>&nbsp;
                        <label for="Pantalon" class="form_label">Pantalón de cuero</label>
                    </p>

                    <p>
                        <input class="form_check" type="checkbox" id="Chaps" name="Chaps" <?php echo $Chapss ?>>&nbsp;
                        <label for="Chaps" class="form_label">Chaps de cuero</label>
                    </p>

                    <p>
                        <input class="form_check" type="checkbox" id="Botas" name="Botas" <?php echo $Botass ?>>&nbsp;
                        <label for="Botas" class="form_label">Botas o Borcegos</label>
                    </p>

                    <p>
                        <input class="form_check" type="checkbox" id="Arnes" name="Arnes" <?php echo $Arness ?>>&nbsp;
                        <label for="Arnes" class="form_label">Arnés de cuero</label>
                    </p>

                    <p>
                        <input class="form_check" type="checkbox" id="MuirCap" name="MuirCap" <?php echo $MuirCaps ?>>&nbsp;
                        <label for="MuirCap" class="form_label">Muir Cap</label>
                    </p>

                    <p>
                        <label for="Otro" class="form_label">Otros</label>
                        <textarea name="Otro" id="Otro" placeholder="Otros elementos de cuero" rows="2"><?php echo $Otro ?></textarea>
                    </p>

                    <p>&nbsp;</p>
                    <p>
                        <input type="submit" name="bEnviar" value="Enviar" />
                    </p>
                </div>
            </FORM>
            
            <?php
            break;
            
        case "pay":
            ?>
            <div>
                <p class="form_label">
                    <img src="media/icon_ok.png" height="70" style="vertical-align: middle;"><b><?php echo $NombreRegistrado?></b>Gracias por registrarte en el <b>Leather Cruising BA</b>.<br>
                </p>

                <p>
                    <label class="form_label">Reservá tu lugar comprando la entrada anticipada via Mercado Pago<sup>1</sup>:<br>
                        <a href="faq">Preguntas Frecuentes</a><br><br>
                        Entrada de <b>$ 500</b> (sin consumición):<br>
                        <script src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"data-preference-id="198456543-7df57c46-27af-4017-be45-af3d2477bf10" data-source="button"></script>
                        <br><br>
                        
                        Entrada de <b>$ 1000</b> (con 2 consumiciones):<br>
                        <script src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"data-preference-id="198456543-98df676b-6bd2-46a0-9a00-b358dc6fd965" data-source="button"></script>
                        <br><br>
                        
                        Entrada de <b>$ 1500</b> (barra libre):<br>
                        <script src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"data-preference-id="198456543-3ed95c90-14b0-45b7-b39f-ff992c16b177" data-source="button"></script>
                        <br>
                    </label>
                </p>

                <p>
                    <label class="form_label"><br>
                        1. En caso de optar por otro medio de pago, envianos un <a href="https://www.instagram.com/leathercruising.ba/" target="IG">DM en Instagram</a> o un WhatsApp a los organizadores.<br>
                    </label>
                </p>
            </div>

            <?php
            break;

        default:
    }
    ?>


    <?php include("templates/header-bottom.php"); ?>


    <script type="text/javascript">
        
        function validar_form1(form1) {
            var Nombre = document.form1.Nombre.value.length;
            var Contacto = document.form1.Contacto.value.length;

            if (Nombre == 0) {
                Swal.fire('Nombre requerido', 'Indique su nombre.', 'error');
                document.form1.Nombre.focus();
                return false;
            }

            if (Contacto == 0) {
                Swal.fire('WhatsApp requerido', 'Indique su WhatsApp para ser contactado.', 'error');
                document.form1.Contacto.focus();
                return false;
            }
        }

    </script>