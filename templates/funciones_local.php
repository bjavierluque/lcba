<?php
    $onLoad="";
    
    $cn = mysqli_connect('localhost', 'root', '', 'lcba');    if ($cn == false) {
        die("No se pudo conectar a la base de datos");
    }


    function LimpiarRequest($cadena)
    {
        $result = "";
        if (isset($cadena)) {
            $a = array("'", "`", "´", "(", ")", ",");
            $b = array("", "", "", "", "", "");
            $result = str_replace($a, $b, $cadena);
            $result = strip_tags(trim($result));
        }
        return $result;
    }
?>
