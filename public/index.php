<?php

# output buffer (Buffer de saída)

# como funciona

$data = ["name" => "Fernando"];

ob_start(); # activa o buffer de saída

extract($data);

require 'home.php';

$content = ob_get_contents(); # captura o conteúdo entre ob_start() e ob_end_clean()

ob_end_clean(); # encerra o buffer e limpa a memória

var_dump($content);