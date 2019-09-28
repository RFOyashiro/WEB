<?php
    require 'utils.inc.php';
    session_start();

    $op1 = $_POST['op1'];
    $op2 = $_POST['op2'];
    $op = $_POST['op'];
    header('Location: /TP2/Calculator.php?op1=' . $op1 . '&op=' . $op . '&op2=' . $op2);
    end_page();
?>