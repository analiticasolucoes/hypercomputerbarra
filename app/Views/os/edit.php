<!DOCTYPE html>
<html>
    <head>
        <title>Alterar Ordem de Serviço</title>
        <link rel="apple-touch-icon" sizes="180x180" href="../../../favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../../../favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../../favicon/favicon-16x16.png">
        <link rel="manifest" href="../../../favicon/site.webmanifest">
        <link rel="mask-icon" href="../../../favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>
    <body>
        <main class="container pt-3">
            <header class="text-center">
                <h2>Alteração - Ordem de Serviço</h2>
                <p class="lead">Utilize o formulário abaixo para alterar uma ordem de serviço.</p>
            </header>
            <section>
                <form class="form-group needs-validation row d-flex" id="os-edit-form" enctype="multipart/form-data" action="/os/edit/form" method="post" novalidate>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseZero" aria-expanded="false" aria-controls="flush-collapseZero">
                                    Dados da Ordem de Serviço
                                </button>
                            </h2>
                            <div id="flush-collapseZero" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body row d-flex">
                                    <input type="text" class="form-control" id="id" name="id" value="<?php echo $osToEdit->getId(); ?>" hidden>
                                    <div class="col-12 py-1">
                                        <label for="n-os" class="form-label fw-semibold">Nº OS:</label>
                                        <input type="text" class="form-control bg-secondary-subtle w-auto" id="n-os" name="n-os" value="<?php echo $osToEdit->getId(); ?>" readonly>
                                    </div>
                                    <div class="col-12 py-1">
                                        <label for="data-abertura" class="form-label fw-semibold">Criada em:</label>
                                        <input type="text" class="form-control bg-secondary-subtle w-auto" id="data-criacao" name="data-criacao" value="<?php echo $dataCriacao; ?>" readonly>
                                    </div>
                                    <div class="col-12 py-1">
                                        <label for="data-abertura" class="form-label fw-semibold">Estágio:</label>
                                        <?php 
                                        $estagio = null;
                                        if($osToEdit->getEstagio() == "CADASTRADO") $estagio = "Aguardando Diagnóstico";
                                        if($osToEdit->getEstagio() == "DIAGNOSTICADO") $estagio = "Aguardando Orçamento";
                                        if($osToEdit->getEstagio() == "ORCADO") $estagio = "Aguardando Faturamento";
                                        if($osToEdit->getEstagio() == "FATURADO") $estagio = "Aguardando Pagamento";
                                        if($osToEdit->getEstagio() == "PAGO") $estagio = "Aguardando Retirada";
                                        if($osToEdit->getEstagio() == "CONCLUIDO") $estagio = "Finalizado";
                                        ?>
                                        <input type="text" class="form-control bg-secondary-subtle w-auto" id="estagio" name="estagio" value="<?php echo $estagio; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Dados do Cliente
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body row d-flex">
                                    <div class="col-md-12">
                                        <label for="nome" class="form-label fw-semibold">Nome Completo:</label>
                                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $osToEdit->getCliente()->getNome(); ?>" disabled>
                                    </div>
                                    <div class="col-sm-4 col-md-2 col-lg-2">
                                        <label for="cpf" class="form-label fw-semibold">CPF:</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $osToEdit->getCliente()->getCPF(); ?>" disabled>
                                    </div>
                                    <div id="cpf-feedback" hidden>Número de CPF invalido!</div>
                                    <div class="col-sm-4 col-md-2 col-lg-2">
                                        <label for="data-nascimento" class="form-label fw-semibold">Data de Nascimento:</label>
                                        <input type="text" class="form-control" id="data-nascimento" name="data-nascimento" value="<?php echo $osToEdit->getCliente()->getDataNascimento(); ?>" disabled>
                                    </div>
                                    <div class="col-sm-4 col-md-6 col-lg-8">
                                        <label for="email" class="form-label fw-semibold">E-mail:</label>
                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $osToEdit->getCliente()->getEmail(); ?>" disabled>
                                    </div>
                                    <div class="col-sm-4 col-md-6 col-lg-2">
                                        <label for="celular" class="form-label fw-semibold">Celular:</label>
                                        <input type="text" class="form-control" id="celular" name="celular" value="<?php echo $osToEdit->getCliente()->getCelular(); ?>" disabled>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold" for="gridCheck">Preferencia de contato:</label>
                                    </div>
                                    <div class="col-3 form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input mx-1" id="ligacao" name="ligacao" <?php if($osToEdit->getCliente()->getPreferenciaContato() == 1 || $osToEdit->getCliente()->getPreferenciaContato() == 3) echo "checked"; ?> disabled>
                                        <label class="form-check-label" for="ligacao">Ligação</label>
                                    </div>
                                    <div class="col-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="mensagem" name="mensagem" <?php if($osToEdit->getCliente()->getPreferenciaContato() >= 2) echo "checked"; ?> disabled>
                                        <label class="form-check-label" for="mensagem">Mensagem</label>
                                    </div>
                                    <div class="col-sm-6 col-md-10 col-lg-10">
                                        <label for="endereco" class="form-label fw-semibold">Endereço:</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $osToEdit->getCliente()->getRua(); ?>" disabled>
                                    </div>
                                    <div class="col-sm-6 col-md-2 col-lg-2">
                                        <label for="numero" class="form-label fw-semibold">Número:</label>
                                        <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $osToEdit->getCliente()->getNumero(); ?>" disabled>
                                    </div>
                                    <div class="col-12">
                                        <label for="complemento" class="form-label fw-semibold">Complemento:</label>
                                        <input type="text" class="form-control" id="complemento" name="complemento" value="<?php echo $osToEdit->getCliente()->getComplemento(); ?>" disabled>
                                    </div>
                                    <div class="col-6 py-1">
                                        <label for="country" class="form-label fw-semibold fw-semibold">Estado:</label>
                                        <select class="form-select" id="estado" name="estado" disabled>
                                            <option><?php echo $cidade->getEstado()->getNome(); ?></option>
                                        </select>
                                    </div>
                                    <div class="col-4 py-1">
                                        <label for="state" class="form-label fw-semibold fw-semibold">Cidade:</label>
                                        <select class="form-select" id="cidade" name="cidade" disabled>
                                            <option><?php echo $cidade->getNome(); ?></option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="cep" class="form-label fw-semibold fw-semibold">CEP:</label>
                                        <input type="text" class="form-control" id="cep" name="cep" value="<?php echo $osToEdit->getCliente()->getCep(); ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Dados do Equipamento
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body row d-flex">
                                    <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                                        <label for="tipo-equipamento" class="form-label fw-semibold">Equipamento:</label>
                                        <input type="text" class="form-control" id="tipo-equipamento" name="tipo-equipamento" value="<?php echo $osToEdit->getEquipamento(); ?>">
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                                        <label for="marca" class="form-label fw-semibold">Marca:</label>
                                        <input type="text" class="form-control" id="marca" name="marca" value="<?php echo $osToEdit->getMarca(); ?>">
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                                        <label for="modelo" class="form-label fw-semibold">Modelo:</label>
                                        <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $osToEdit->getModelo(); ?>">
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                                        <label for="serie" class="form-label fw-semibold">Série:</label>
                                        <input type="text" class="form-control" id="serie" name="serie" value="<?php echo $osToEdit->getSerie(); ?>">
                                    </div>
                                    <div class="col-12 py-1">
                                        <label for="firstName" class="form-label fw-semibold">Possue senha?</label>
                                        <div class="form-check form-check-inline ms-3">
                                            <input class="form-check-input" type="checkbox" id="checkbox-senha" onchange="habilitarSenha()">
                                            <label class="form-check-label" for="inlineCheckbox1">Sim</label>
                                        </div>
                                        <input type="text" class="form-control" id="senha" name="senha" value="<?php if($osToEdit->getSenha() != "") echo $osToEdit->getSenha(); ?>" <?php if($osToEdit->getSenha() == "") echo "disabled"; ?>>
                                    </div>
                                    <div class="col-12 py-1">
                                        <label for="firstName" class="form-label fw-semibold">Acessório(s):</label>
                                        <textarea class="form-control" id="acessorio" name="acessorio" style="height: 100px"><?php echo $osToEdit->getAcessorio(); ?></textarea>
                                    </div>
                                    <div class="col-12 py-1">
                                        <label for="firstName" class="form-label fw-semibold">Diagnóstico:</label>
                                        <textarea class="form-control bg-secondary-subtle" id="diagnostico" name="diagnostico" style="height: 100px" disabled><?php echo $osToEdit->getDiagnostico(); ?></textarea>
                                    </div>
                                    <div class="col-12 py-1">
                                        <label for="firstName" class="form-label fw-semibold">Solução(ões):</label>
                                        <textarea class="form-control bg-secondary-subtle" id="solucao" name="solucao" style="height: 100px" disabled><?php echo $osToEdit->getSolucao(); ?></textarea>
                                    </div>
                                    <div class="col-12 py-1">
                                        <label for="firstName" class="form-label fw-semibold">Observação(ões):</label>
                                        <textarea class="form-control" id="observacao" name="observacao" style="height: 100px"><?php echo $osToEdit->getObservacao(); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-4 d-flex justify-content-center">
                        <a href="/user/dashboard" class="btn btn-outline-primary me-4">Voltar</a>
                        <button class="btn btn-primary" type="submit">Salvar</button>
                    </div>
                </form>
            </section>
        </main>
    </body>
    <script>
        function habilitarSenha() {
            var checkbox = document.getElementById('checkbox-senha');
            var campoTexto = document.getElementById('senha');
            
            if (checkbox.checked) {
                campoTexto.disabled = false;
            } else {
                campoTexto.disabled = true;
            }
        }
    </script>
</html>