<?php
    $fecha_hoy = date("Y-m-d");
    $fecha_min = date("Y-m-d", strtotime($fecha_hoy . "- 1 year"));
    $onLoad="";

    include("templates/header-top.php");
?>

    <div>
        <p>
            <label class="form_label">CAPACIDAD LIMITADA. Reservá tu lugar comprando la entrada anticipada via Mercado Pago<sup>1</sup>:<br>
                <a href="faq">Preguntas Frecuentes</a><br><br>
                Entrada de <b>$ 2000</b> (con 1 consumición):<br>
                <script src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"data-preference-id="198456543-f704ee40-6eb8-43de-9f65-c4bbb808d9e4" data-source="button"></script>
                <br><br>

                Entrada de <b>$ 3750</b> (barra libre):<br>
                <script src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"data-preference-id="198456543-f704ee40-6eb8-43de-9f65-c4bbb808d9e4" data-source="button"></script>
                <br>
            </label>
        </p>

        <p>
            <label class="form_label"><br>
                1. En caso de optar por otro medio de pago, envianos un <a href="https://www.instagram.com/leathercruising.ba/" target="IG">DM en Instagram</a> o un WhatsApp a los organizadores.<br>
            </label>
        </p>
    </div>

    <?php include("templates/header-bottom.php"); ?>