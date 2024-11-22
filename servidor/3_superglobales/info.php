<?php
//Metodo usado
echo "Método de solicitud: " . $_SERVER['REQUEST_METHOD'] .
"<br>";

//Obtenemos el info sobre el navegador usado, SO...
echo "Agente de usuario: " . $_SERVER['HTTP_USER_AGENT'] .
"<br>";

//IP
echo "Dirección IP del cliente: " . $_SERVER['REMOTE_ADDR'] .
"<br>";
?>