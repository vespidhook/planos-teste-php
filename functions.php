<?php 

function jsonToArray() {
    
    $json = file_get_contents('json/precos.json');
    $json = json_decode($json, true);
    $precos = array();
    foreach($json as $j) {
        $precos[$j['codigo']][$j["minimo_vidas"]]["faixa1"] = $j["faixa1"];
        $precos[$j['codigo']][$j["minimo_vidas"]]["faixa2"] = $j["faixa2"];
        $precos[$j['codigo']][$j["minimo_vidas"]]["faixa3"] = $j["faixa3"];
    }

    foreach($precos as $key => $value)
        arsort($precos[$key]);

    return $precos;
}

function precos($registro, $n) {        
    $valores = null;
    $json_precos = jsonToArray(); 
    foreach($json_precos[$registro] as $minimo => $faixas) {
        if($n >= $minimo)
            $valores = $faixas;
    }
    
    return $valores;
}

function format_beneficiarios($input_beneficiarios) {
   
    $beneficiarios = array();
    foreach (array_keys($input_beneficiarios) as $fieldKey) {
        foreach ($input_beneficiarios[$fieldKey] as $key=>$value) {
            $beneficiarios[$key][$fieldKey] = $value;
        }
    } 

    return $beneficiarios;
}

?>