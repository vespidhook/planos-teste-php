<?php
include "header.php";
?>
        <div>
            <div class="content">
                <?php 
                    if(isset($_GET['erro'])) 
                        echo '<div class="warning"><p>Erro ao processar o seu pedido. Verifique as informações do plano.</p></div>';
                    if(isset($_GET['null'])) 
                        echo '<div class="warning"><p>Nenhum beneficiário inserido.</p></div>';
                ?>                     

                <div class="container">        
                <form method="POST" action="simulacao.php">
                <h1 class="text-center">Simulação</h1>   
                    <h3>Escolha o plano</h3>
                    <div class="form-row">                        
                        <div class="form-group col-md-4"> 
                            <input type="text" class="form-control" id="registro" name="registro" placeholder="Digite..." >
                        </div>                        
                            <div class="form-group col-md-4">
                                <input hidden type="text" class="form-control" id="plano" name="plano" placeholder="Plano" >
                            </div>
                        </div>
                    <input hidden id="codigo" name="codigo" placeholder="Código" readonly>

                    <hr>

                    <h3>Beneficiários</h3>
                        <div id="beneficiarios">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label>Nome do beneficiario</label>
                                    <input type="text" class="form-control" name="beneficiario[nome][]" required>
                                </div>                                
                                <div class="form-group col-md-2">
                                <label>Idade</label>
                                    <input type="number" class="form-control" name="beneficiario[idade][]" required><br>
                                </div>                                
                                </div>
                            </div>
                            <input type='button' class="btn btn-primary add" value="Adicionar beneficiário">
                            <button type='submit' class="btn btn-success finalizar" name="finalizar">Finalizar</button>

                        </div>                   
                    
                </form>
                </div>
            </div>
        </div>
        </div>


<?php
include "footer.php";
?>