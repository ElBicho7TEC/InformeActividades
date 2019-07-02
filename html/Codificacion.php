<?php 
function codificar($dato) {
            $resultado = $dato;
            $arrayLetras = array('M', 'A', 'R', 'C', 'O', 'S');
            $limite = count($arrayLetras) - 1;
            $num = mt_rand(0, $limite);
            for ($i = 1; $i <= $num; $i++) {
                $resultado = base64_encode($resultado);
            }
            $resultado = $resultado . '+' . $arrayLetras[$num];
            $resultado = base64_encode($resultado);
            return $resultado;
        }