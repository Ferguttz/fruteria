<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border: 1px solid;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    if (isset($_REQUEST['cliente'])) {
        $_SESSION['cliente'] = $_REQUEST['cliente'];
    }

    if (!isset($_SESSION['cliente'])) {
        include_once 'bienvenida.php';
        exit();
    }

    if (!isset($_REQUEST['accion'])) {
        include_once 'compra.php';
        $_SESSION['lista'] = [];
    } else {
        switch ($_REQUEST['accion']) {
            case ' Anotar ':
                $compraRealizada = "Este es su pedido:<br>";
                
                Anotar($_REQUEST,$_SESSION['lista']);
                $compraRealizada .= Mostar($_SESSION['lista']);
                include_once 'compra.php';
                break;

            case ' Terminar ';
                $compraRealizada = "Este es su pedido:<br>";
                $compraRealizada .= Mostar($_SESSION['lista']);
                include_once 'despedida.php';
                session_destroy();
                break;
        }
    }

    function Anotar($compra,&$lista) {
        if (!key_exists($compra['fruta'],$lista) ) {
            $lista [$compra['fruta']] = $compra['cantidad'];
            
        } else {
            $lista[$compra['fruta']] += $compra['cantidad'];
        }

        return;
    }

    function Mostar($lista) : string {
        $msg = "<table>";

        foreach ($lista as $fruta => $cantidad) {
            $msg .= "<tr><td><b>$fruta</b> $cantidad</td></tr>";
        }

        $msg .= "<table>";
        return $msg;
    }

    ?>
</body>
</html>