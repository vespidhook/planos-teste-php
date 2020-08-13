<?php
include "header.php";
include "functions.php";

$msg = "";

if (empty($_POST)) {
    header("Location: index.php"); exit();
}
else {
    $registro = $_POST['registro'];
    $plano = $_POST['plano'];
    $codigo = $_POST['codigo'];
    if ($registro == "" or !$registro or $plano == "" or !$plano or $codigo == "" or !$codigo)
        header("Location: index.php?erro");
    
    if(!isset($_POST['beneficiario']))
        header("Location: index.php?null");
        
    $beneficiarios = format_beneficiarios($_POST['beneficiario']);
    $precos = precos($codigo, count($beneficiarios));

    $total = 0;
    foreach($beneficiarios as $i => $b){
        if(0 <= $b['idade'] and $b['idade'] < 18) {
            $total += $precos['faixa1'];
            $beneficiarios[$i]['preco'] = $precos['faixa1'];
        }
        elseif(18 <= $b['idade'] and $b['idade'] < 41) {
            $total += $precos['faixa2'];
            $beneficiarios[$i]['preco'] = $precos['faixa2'];
        }
        else {
            $total += $precos['faixa3'];
            $beneficiarios[$i]['preco'] = $precos['faixa3'];
        }
    }
}

?>
    <h2 class="text-center">Simulação no <?php echo $plano;?></h2>
    <div class="container"> 
    
        <table class="table">        
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Idade</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($beneficiarios as $b) {
                        echo "<tr>
                        <td>".$b['nome']."</td>
                        <td>".$b['idade']."</td>
                        <td>R$".number_format((float)$b['preco'], 2, '.', '')."</td>
                        </tr>";
                    }
                ?>
                <tr>
                    <td><b>Total:</b></td>
                    <td></td>
                    <td><b>R$<?php echo number_format((float)$total, 2, '.', '');?></b></td>
                </tr>
                
            </tbody>
            </table>
            
        </div>
            <div class="container"> 
                <form method="get" action="/">
                    <button type="submit" class="btn btn-dark btn-lg btn-block">Nova simulação</button>
                </form>
            </div> 

<?php
include "footer.php";
?>