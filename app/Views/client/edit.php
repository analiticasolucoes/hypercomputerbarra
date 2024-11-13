<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alterar Cliente</title>
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
        <h2>Edição - Cliente</h2>
        <p class="lead">Utilize o formulário abaixo para editar as informações do cliente.</p>
    </header>
    <form class="form-group row g-3 d-flex" id="uploadForm" enctype="multipart/form-data" action="/client/edit/form" method="post">
        <input type="text" id="id" name="id" value="<?php echo $clienteToEdit->getId(); ?>" hidden>
        <div class="col-md-12">
            <label for="nome" class="form-label fw-semibold">Nome Completo:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $clienteToEdit->getNome(); ?>" required>
        </div>
        <div class="col-sm-4 col-md-2 col-lg-2">
            <label for="cpf" class="form-label fw-semibold">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" oninput="formatarCPF(this)" onblur="validarCPF(this)" value="<?php echo $clienteToEdit->getCpf(); ?>" required>
        </div>
        <div class="col-12 z-3" id="cpf-feedback" hidden>Número de CPF invalido!</div>
        <div class="col-sm-4 col-md-2 col-lg-2">
            <label for="data-nascimento" class="form-label fw-semibold">Data de Nascimento:</label>
            <input type="text" class="form-control" id="data-nascimento" name="data-nascimento" placeholder="01/01/1900" onblur="validarDataNascimento(this)" value="<?php echo $clienteToEdit->getDataNascimento(); ?>" required>
        </div>
        <div class="col-12 z-3" id="data-nascimento-feedback" hidden>Data de nascimento invalida!</div>
        <div class="col-sm-4 col-md-6 col-lg-8">
            <label for="email" class="form-label fw-semibold">E-mail:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="usuario@servidor.com.br" value="<?php echo $clienteToEdit->getEmail(); ?>" required>
        </div>
        <div class="col-sm-4 col-md-6 col-lg-2">
            <label for="celular" class="form-label fw-semibold">Celular:</label>
            <input type="text" class="form-control" id="celular" name="celular" placeholder="21 99999-9999" value="<?php echo $clienteToEdit->getCelular(); ?>" required>
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold" for="gridCheck">Preferencia de contato:</label>
        </div>
        <div class="col-3 form-check form-check-inline">
            <input type="checkbox" class="form-check-input mx-1" id="ligacao" name="ligacao"<?php if($clienteToEdit->getPreferenciaContato() == 1 || $clienteToEdit->getPreferenciaContato() == 3) echo " checked"; ?>>
            <label class="form-check-label" for="ligacao">Ligação</label>
        </div>
        <div class="col-2 form-check">
            <input type="checkbox" class="form-check-input" id="mensagem" name="mensagem"<?php if($clienteToEdit->getPreferenciaContato() >= 2) echo " checked"; ?>>
            <label class="form-check-label" for="mensagem">Mensagem</label>
        </div>
        <div class="col-sm-6 col-md-10 col-lg-10">
            <label for="rua" class="form-label fw-semibold">Rua:</label>
            <input type="text" class="form-control" id="rua" name="rua" placeholder="Av./Rua/Estrada ..." value="<?php echo $clienteToEdit->getRua(); ?>" required>
        </div>
        <div class="col-sm-6 col-md-2 col-lg-2">
            <label for="numero" class="form-label fw-semibold">Número:</label>
            <input type="text" class="form-control" id="numero" name="numero" placeholder="101A" value="<?php echo $clienteToEdit->getNumero(); ?>" required>
        </div>
        <div class="col-12 col-md-6">
            <label for="bairro" class="form-label fw-semibold">Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Barra" value="<?php echo $clienteToEdit->getBairro();?>">
        </div>
        <div class="col-12">
            <label for="complemento" class="form-label fw-semibold">Complemento:</label>
            <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Ed. Plaza Sol" value="<?php echo $clienteToEdit->getComplemento(); ?>">
        </div>
        <div class="col-6 py-1">
            <label for="country" class="form-label fw-semibold fw-semibold">Estado:</label>
            <select class="form-select" id="estado" name="estado" onchange="carregarCidades()" required>
                <option value="1"<?php if($cidade->getEstado()->getId() == 1) echo " selected"; ?>>Acre</option>
                <option value="2"<?php if($cidade->getEstado()->getId() == 2) echo " selected"; ?>>Alagoas</option>
                <option value="3"<?php if($cidade->getEstado()->getId() == 3) echo " selected"; ?>>Amapá</option>
                <option value="4"<?php if($cidade->getEstado()->getId() == 4) echo " selected"; ?>>Amazonas</option>
                <option value="5"<?php if($cidade->getEstado()->getId() == 5) echo " selected"; ?>>Bahia</option>
                <option value="6"<?php if($cidade->getEstado()->getId() == 6) echo " selected"; ?>>Ceará</option>
                <option value="7"<?php if($cidade->getEstado()->getId() == 7) echo " selected"; ?>>Distrito Federal</option>
                <option value="8"<?php if($cidade->getEstado()->getId() == 8) echo " selected"; ?>>Espírito Santo</option>
                <option value="9"<?php if($cidade->getEstado()->getId() == 9) echo " selected"; ?>>Goiás</option>
                <option value="10"<?php if($cidade->getEstado()->getId() == 10) echo " selected"; ?>>Maranhão</option>
                <option value="11"<?php if($cidade->getEstado()->getId() == 11) echo " selected"; ?>>Mato Grosso</option>
                <option value="12"<?php if($cidade->getEstado()->getId() == 12) echo " selected"; ?>>Mato Grosso do Sul</option>
                <option value="13"<?php if($cidade->getEstado()->getId() == 13) echo " selected"; ?>>Minas Gerais</option>
                <option value="14"<?php if($cidade->getEstado()->getId() == 14) echo " selected"; ?>>Pará</option>
                <option value="15"<?php if($cidade->getEstado()->getId() == 15) echo " selected"; ?>>Paraíba</option>
                <option value="16"<?php if($cidade->getEstado()->getId() == 16) echo " selected"; ?>>Paraná</option>
                <option value="17"<?php if($cidade->getEstado()->getId() == 17) echo " selected"; ?>>Pernambuco</option>
                <option value="18"<?php if($cidade->getEstado()->getId() == 18) echo " selected"; ?>>Piauí</option>
                <option value="19"<?php if($cidade->getEstado()->getId() == 19) echo " selected"; ?>>Rio de Janeiro</option>
                <option value="20"<?php if($cidade->getEstado()->getId() == 20) echo " selected"; ?>>Rio Grande do Norte</option>
                <option value="21"<?php if($cidade->getEstado()->getId() == 21) echo " selected"; ?>>Rio Grande do Sul</option>
                <option value="22"<?php if($cidade->getEstado()->getId() == 22) echo " selected"; ?>>Rondônia</option>
                <option value="23"<?php if($cidade->getEstado()->getId() == 23) echo " selected"; ?>>Roraima</option>
                <option value="24"<?php if($cidade->getEstado()->getId() == 24) echo " selected"; ?>>Santa Catarina</option>
                <option value="25"<?php if($cidade->getEstado()->getId() == 25) echo " selected"; ?>>São Paulo</option>
                <option value="26"<?php if($cidade->getEstado()->getId() == 26) echo " selected"; ?>>Sergipe</option>
                <option value="27"<?php if($cidade->getEstado()->getId() == 27) echo " selected"; ?>>Tocantins</option>
            </select>
            <div class="invalid-feedback">
                Por favor, selecione um estado válido!
            </div>
        </div>
        <div class="col-4 py-1">
            <label for="state" class="form-label fw-semibold fw-semibold">Cidade:</label>
            <select class="form-select" id="cidade" name="cidade" required>
                <?php echo '<option value="'.$cidade->getId().'">'.$cidade->getNome().'</option>';?>
            </select>
            <div class="invalid-feedback">
                Por favor, selecione uma cidade válida!
            </div>
        </div>
        <div class="col-md-2">
            <label for="cep" class="form-label fw-semibold fw-semibold">CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000" value="<?php echo $clienteToEdit->getCep(); ?>" required>
        </div>
        <div class="col-12 my-4 d-flex justify-content-center">
            <a href="/user/dashboard" class="btn btn-outline-primary mx-4">Voltar</a>
            <button class="btn btn-primary" type="submit">Salvar</button>
        </div>
    </form>
</main>
</body>
<script>
    function carregarCidades() {
        var selectEstados = document.getElementById("estado");
        var selectCidades = document.getElementById("cidade");
        var valorSelecionado = selectEstados.value;

        // Limpar as opções existentes
        selectCidades.innerHTML = "";

        // Fazer uma solicitação ao backend
        fetch("/cidade/all/get?estado_id=" + valorSelecionado) // A rota no backend com o valor selecionado
            .then(response => response.json())
            .then(data => {
                // Preencher o segundo select com os resultados da consulta
                data.forEach(cidade => {
                    var option = document.createElement("option");
                    option.text = cidade.nome;
                    option.value = cidade.id;
                    selectCidades.appendChild(option);
                });

            })
            .catch(error => console.error('Erro ao carregar cidades:', error));
    }
    function formatarCPF(campo) {
        var cpf = campo.value.replace(/\D/g, '');
        if (cpf.length === 11) {
            cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
        }
        campo.value = cpf;
    }
    function validarCPF(campo) {
        var cpf = campo.value.replace(/\D/g, '');
        var feedbackDiv = document.getElementById("cpf-feedback");

        // Verifica se o CPF possui 11 dígitos
        if (cpf.length !== 11) {
            // Exibe mensagem de erro
            campo.style.border = "1px solid red"; // Adiciona a borda vermelha
            feedbackDiv.textContent = "Número de CPF inválido! O CPF deve conter 11 números.";
            feedbackDiv.hidden = false;

            // Define o foco no campo
            campo.focus();
        } else {
            // CPF válido, esconde o feedback
            feedbackDiv.hidden = true;
            campo.style.border = "1px solid #ced4da"; // Retorna a borda ao estilo padrão
        }
    }

    function validarDataNascimento(data) {
        var feedbackDiv = document.getElementById("data-nascimento-feedback");
        // Regex para verificar o formato da data
        var regex = /^(\d{2})\/(\d{2})\/(\d{4})$/;
        if (!regex.test(data.value)) {
            data.style.border = "1px solid red"; // Adiciona a borda vermelha
            feedbackDiv.textContent = "Data de nascimento inválida! A data deve ser informada no formato dd/mm/aaaa.";
            feedbackDiv.hidden = false;
            return;
        }

        var partes = data.value.split('/');
        var dia = parseInt(partes[0], 10);
        var mes = parseInt(partes[1], 10) - 1; // Meses em JavaScript são 0-11
        var ano = parseInt(partes[2], 10);

        var dataObjeto = new Date(ano, mes, dia);

        // Verificar se a data é válida
        if (dataObjeto.getFullYear() !== ano || dataObjeto.getMonth() !== mes || dataObjeto.getDate() !== dia) {
            data.style.border = "1px solid red"; // Adiciona a borda vermelha
            feedbackDiv.textContent = "Data de nascimento inválida! A data deve ser informada no formato dd/mm/aaaa.";
            feedbackDiv.hidden = false;
            return;
        }

        // Verificar se a data não está no futuro
        var hoje = new Date();
        if (dataObjeto > hoje) {
            data.style.border = "1px solid red"; // Adiciona a borda vermelha
            feedbackDiv.textContent = "Data de nascimento inválida! A data informada não pode ser maior do que a data atual.";
            feedbackDiv.hidden = false;
            return;
        }
        feedbackDiv.hidden = true;
        data.style.border = "1px solid #ced4da";
    }
</script>
</html>
