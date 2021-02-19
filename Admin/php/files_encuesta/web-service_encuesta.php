<?php
    require_once '../../../Server/conexion/conexion.php';
        $contador=0;
        $Ecuesta= new OpenConexion();
        $pre=$Ecuesta->Conn->prepare('select * from encuesta order by idencuesta');
        $pre->execute();
        $variable=$pre->fetchAll(PDO::FETCH_ASSOC);
    foreach ($variable as  $data) {
    //while ($data=pg_fetch_array($pre)) {
            
        if ($data['status'] > 0) {
            $valor='Deshabilitar';
            $update='0';
            $clase='btn-info';
        } else {
            $valor='Habilitar';
            $update='1';
            $clase='btn-danger';
        }

            echo "<tr>
            <td>".++$contador."</td>
            <td>".$data['nom_encuesta']."</td>
            <td>".$data['descripcion']."</td>
            <td><input type='button' class=' mostrar_encuesta btn btn-success btn-block' value='Mostrar' data-toggle='modal' data-id_encuesta='".$data['idencuesta']."' data-target='.bd-example-modal-lg'></td>
            <td><button data-id_encuesta='".$data['idencuesta']."' data-id_valor='".$update."' class='status btn ".$clase." btn-block'>".$valor."</button></td>
            <td><button id='Encuesta_resuelta-{$data['idencuesta']}' class='btn btn-block btn-warning manejador'>Encuestadores</button></td>
            </tr>";
}
?>