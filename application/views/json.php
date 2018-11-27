<?php
    $json = array();
    $json['success'] = $success;
    $json['data'] = $data;
    $json['token'] = $token;
    echo json_encode($json);
?>
