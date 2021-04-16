<?php

include (__DIR__ . '/../services/DAOCart.php');

function listCartItems($cartFigures) {
    $query = "";
    $ans = "";

    $query = "SELECT * FROM figures WHERE";
    foreach ($cartFigures as $key => $value) {
        $query .= " figureName = '".$value."' OR";
    }

    $query = substr($query, 0, -3);
    $ans = executor($query);

    return $ans;
}

function substractStock($cartFigures) {
    foreach ($cartFigures as $key => $value) {
        $query = "";
        $query = "UPDATE figures SET stock = stock-".$value[1]." WHERE figureName = '".$value[0]."';";
        executorNoReturn($query);
    }
}

switch ($_POST['action']) {
    case 'list':
        echo json_encode(listCartItems($_POST['cartFigures']));
        break;

    case 'substractStock':
        substractStock($_POST['cartFigures']);
        break;
    
    default:
        break;
    }