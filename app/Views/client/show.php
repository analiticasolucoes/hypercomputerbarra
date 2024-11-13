<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exibir Cliente</title>
    <base href="https://hypercomputerbarra.com.br/">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<main class="container pt-3">
    <header class="text-center">
        <h2>Detalhes - Cliente</h2>
        <p class="lead">Visualize abaixo os dados do cliente cadastrado.<br>Caso precise alterar alguma das informações, utilize o botão "Editar" logo abaixo.</p>
    </header>
    <form class="form-group row g-3 d-flex" id="uploadForm" enctype="multipart/form-data" action="/client/edit/form" method="post">
        <div class="col-md-12">
            <label for="nome" class="form-label fw-semibold">Nome Completo:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $cliente->getNome();?>" disabled>
        </div>
        <div class="col-sm-4 col-md-2 col-lg-2">
            <label for="cpf" class="form-label fw-semibold">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" oninput="formatarCPF(this)" onblur="validarCPF(this)" value="<?php echo $cliente->getCpf();?>" disabled>
        </div>
        <div class="col-sm-4 col-md-2 col-lg-2">
            <label for="data-nascimento" class="form-label fw-semibold">Data de Nascimento:</label>
            <input type="text" class="form-control" id="data-nascimento" name="data-nascimento" placeholder="01/01/1900" onblur="validarDataNascimento(this)" value="<?php echo $cliente->getDataNascimento();?>" disabled>
        </div>
        <div class="col-sm-4 col-md-6 col-lg-8">
            <label for="email" class="form-label fw-semibold">E-mail:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="usuario@servidor.com.br" value="<?php echo $cliente->getEmail();?>" disabled>
        </div>
        <div class="col-sm-4 col-md-6 col-lg-2">
            <label for="celular" class="form-label fw-semibold">Celular:</label>
            <input type="text" class="form-control" id="celular" name="celular" placeholder="21 99999-9999" value="<?php echo $cliente->getCelular();?>" disabled>
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold" for="gridCheck">Preferencia de contato:</label>
        </div>
        <div class="col-3 form-check form-check-inline">
            <input type="checkbox" class="form-check-input mx-1" id="ligacao" name="ligacao" <?php if($cliente->getPreferenciaContato() == 1 || $cliente->getPreferenciaContato() == 3) echo "checked ";?>disabled>
            <label class="form-check-label" for="ligacao">Ligação</label>
        </div>
        <div class="col-2 form-check">
            <input type="checkbox" class="form-check-input" id="mensagem" name="mensagem" <?php if($cliente->getPreferenciaContato() >= 2) echo "checked ";?>disabled>
            <label class="form-check-label" for="mensagem">Mensagem</label>
        </div>
        <div class="col-sm-6 col-md-10 col-lg-10">
            <label for="rua" class="form-label fw-semibold">Rua:</label>
            <input type="text" class="form-control" id="rua" name="rua" placeholder="Av./Rua/Estrada ..." value="<?php echo $cliente->getRua();?>" disabled>
        </div>
        <div class="col-sm-6 col-md-2 col-lg-2">
            <label for="numero" class="form-label fw-semibold">Número:</label>
            <input type="text" class="form-control" id="numero" name="numero" placeholder="101A" value="<?php echo $cliente->getNumero();?>" disabled>
        </div>
        <div class="col-12 col-md-6">
            <label for="bairro" class="form-label fw-semibold">Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Barra" value="<?php echo $cliente->getBairro();?>" disabled>
        </div>
        <div class="col-12 col-md-6">
            <label for="complemento" class="form-label fw-semibold">Complemento:</label>
            <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Ed. Plaza Sol" value="<?php echo $cliente->getComplemento();?>" disabled>
        </div>
        <div class="col-6 py-1">
            <label for="country" class="form-label fw-semibold fw-semibold">Estado:</label>
            <select class="form-select" id="estado" name="estado" onchange="carregarCidades()" disabled>
                <option value=""><?php echo $cidade->getEstado()->getNome();?></option>
            </select>
        </div>
        <div class="col-4 py-1">
            <label for="state" class="form-label fw-semibold fw-semibold">Cidade:</label>
            <select class="form-select" id="cidade" name="cidade" disabled>
                <option value=""><?php echo $cidade->getNome();?></option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="cep" class="form-label fw-semibold fw-semibold">CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000" value="<?php echo substr($cliente->getCep(), 0, -3)."-".substr($cliente->getCep(), -3);?>" disabled>
        </div>
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseZero" aria-expanded="false" aria-controls="flush-collapseZero">
                        <span class="fw-bold">Ordens de Serviço do Cliente</span>
                    </button>
                </h2>
                <div id="flush-collapseZero" class="accordion-collapse collapse show " data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body row d-flex">
                        <div class="table-responsive small mt-2 min-vh-75">
                            <table id="tabela" class="table table-hover table-sm align-middle pb-2">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            Criado em
                                            <svg class="bi" width="16" height="16">
                                                <use xlink:href="#sort-down" />
                                            </svg>
                                        </th>
                                        <th scope="col">
                                            Nº OS
                                            <svg class="bi" width="16" height="16">
                                                <use xlink:href="#sort-down" />
                                            </svg>
                                        </th>
                                        <th scope="col">
                                            Cliente
                                            <svg class="bi" width="16" height="16">
                                                <use xlink:href="#sort-down" />
                                            </svg>
                                        </th>
                                        <th scope="col">
                                            Equipamento
                                            <svg class="bi" width="16" height="16">
                                                <use xlink:href="#sort-down" />
                                            </svg>
                                        </th>
                                        <th scope="col">
                                            Estágio
                                            <svg class="bi" width="16" height="16">
                                                <use xlink:href="#sort-down" />
                                            </svg>
                                        </th>
                                        <th scope="col">
                                            Status
                                            <svg class="bi" width="16" height="16">
                                                <use xlink:href="#sort-down" />
                                            </svg>
                                        </th>
                                        <th scope="col">
                                            Nº dias
                                            <svg class="bi" width="16" height="16">
                                                <use xlink:href="#sort-down" />
                                            </svg>
                                        </th>
                                        <th scope="col">
                                            Valor (R$)
                                            <svg class="bi" width="16" height="16">
                                                <use xlink:href="#sort-down" />
                                            </svg>
                                        </th>
                                        <th scope="col">
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input" type="checkbox" value="" id="checkAll" onclick="checkAllCheckboxes()">
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>
                                <tbody class="table-group-divider">
                                <?php
                                if (@$osList) :
                                    foreach ($osList as $os) : ?>
                                    <tr class="p-2">
                                        <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="../os/show?id=<?php echo $os['id']; ?>"><?php echo $os['created_at']; ?></td>
                                        <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="../os/show?id=<?php echo $os['id']; ?>"><?php echo $os['id']; ?></td>
                                        <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="../os/show?id=<?php echo $os['id']; ?>"><?php echo $os['cliente']; ?></td>
                                        <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="../os/show?id=<?php echo $os['id']; ?>"><?php echo $os['equipamento']; ?></td>
                                        <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="../os/show?id=<?php echo $os['id']; ?>">
                                            <span class="badge text-bg-dark">
                                                <?php if ($os['estagio'] == "CADASTRADO") : ?>
                                                Aguardando Diagnóstico
                                                <?php endif; ?>
                                                <?php if ($os['estagio'] == "DIAGNOSTICADO") : ?>
                                                Aguardando Orçamento
                                                <?php endif; ?>
                                                <?php if ($os['estagio'] == "ORCADO") : ?>
                                                Aguardando Reparo
                                                <?php endif; ?>
                                                <?php if ($os['estagio'] == "REPARADO") : ?>
                                                Aguardando Faturamento
                                                <?php endif; ?>
                                                <?php if ($os['estagio'] == "FATURADO") : ?>
                                                Aguardando Pagamento
                                                <?php endif; ?>
                                                <?php if ($os['estagio'] == "PAGO") : ?>
                                                Aguardando Liberação
                                                <?php endif; ?>
                                                <?php if ($os['estagio'] == "CONCLUIDO") : ?>
                                                Concluído
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                        <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="../os/show?id=<?php echo $os['id']; ?>">
                                        <?php if ($os['status'] == "No prazo") : ?>
                                            <span class="badge text-bg-primary">
                                        <?php endif; ?>
                                        <?php if ($os['status'] == "Parada") : ?>
                                            <span class="badge text-bg-danger">
                                        <?php endif; ?>
                                        <?php if ($os['status'] == "Atrasada") : ?>
                                            <span class="badge text-bg-warning">
                                        <?php endif; ?>
                                                <?= $os['status'];?>
                                            </span>
                                        </td>
                                        <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="../os/show?id=<?php echo $os['id']; ?>"><?php echo $os['n_dias']; ?></td>
                                        <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="../os/show?id=<?php echo $os['id']; ?>"><?php echo $os['valor_total']; ?></td>
                                        <td class="p-2">
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach;
                                else : ?>
                                    <tr class="p-2">
                                        <td class="p-2 text-center" colspan="9">Nenhum resultado disponível.</td>
                                    </tr>
                                <?php
                                endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 my-4 d-flex justify-content-center">
            <a href="/user/dashboard" class="btn btn-outline-primary me-4">Voltar</a>
            <button type="button" class="btn btn-outline-primary me-4" onclick="newOS()">Nova OS</button>
            <a href="/client/edit?id=<?php echo $cliente->getId();?>" class="btn btn-primary">Editar</a>
        </div>
    </form>
</main>
</body>
<script>
    function newOS() {
        sessionStorage.setItem('id', <?php echo $cliente->getId(); ?>);
        sessionStorage.setItem('nome', '<?php echo $cliente->getNome(); ?>');
        sessionStorage.setItem('cpf', '<?php echo $cliente->getCpf(); ?>');
        window.location.href = '/os/add/step/2';
    }
</script>
</html>