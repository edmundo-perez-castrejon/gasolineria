<table border=0 width="80%">
    <thead>
        <th align="left">Clave de cliente</th>
        <th align="left">Razon social</th>
        <th align="left">Usuario</th>
        <th align="left">Password</th>
    </thead>

<?php

foreach($users as $u){
    $u->cliente->get();
    echo '<tr>';
    echo "<td>".$u->cliente->clave_cliente."</td>";
    echo "<td>".$u->cliente->razon_social."</td>";
    echo "<td>".$u->username."</td>";
    echo "<td>".$u->password."</td>";
    echo '</tr>';
}
?>
</table>