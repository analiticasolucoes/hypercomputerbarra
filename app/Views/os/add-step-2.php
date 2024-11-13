<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adicionar Ordem de Serviço</title>
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
                <h2>Cadastramento - Ordem de Serviço</h2>
                <p class="lead">Utilize o formulário abaixo para cadastrar uma nova ordem de serviço.</p>
            </header>
            <nav class="d-flex justify-content-center" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="link-underline link-underline-opacity-0 link-dark" onclick="etapaAnterior()">Cliente</a></li>
                    <li class="breadcrumb-item active fw-bold" aria-current="page">Equipamento</li>
                    <li class="breadcrumb-item">Resumo</li>
                </ol>
            </nav>
            <form class="form-group needs-validation row d-flex" id="uploadForm" enctype="multipart/form-data" action="/os/add/form" method="post" novalidate>
                <div class="col-12 py-1">
                    <label for="data-abertura" class="form-label fw-semibold">Data e Hora:</label>
                    <input type="text" class="form-control w-auto" id="data-abertura" name="data-abertura" readonly>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                    <label for="tipo-equipamento" class="form-label fw-semibold">Equipamento:</label>
                    <input type="text" class="form-control" id="tipo-equipamento" name="tipo-equipamento" required>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                    <label for="marca" class="form-label fw-semibold">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca" required>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                    <label for="modelo" class="form-label fw-semibold">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                    <label for="serie" class="form-label fw-semibold">Série:</label>
                    <input type="text" class="form-control" id="serie" name="serie">
                </div>
                <div class="col-12 py-1">
                    <label for="firstName" class="form-label fw-semibold">Possue senha?</label>
                    <div class="form-check form-check-inline ms-3">
                        <input class="form-check-input" type="checkbox" id="checkbox-senha" onchange="habilitarSenha()" value="true">
                        <label class="form-check-label" for="inlineCheckbox1">Sim</label>
                    </div>
                    <input type="text" class="form-control" id="senha" name="senha" disabled>
                </div>
                <div class="col-12 py-1">
                    <label for="firstName" class="form-label fw-semibold">Defeito:</label>
                    <textarea class="form-control" placeholder="Descreva o(s) defeito(s) apresentado(s) pelo equipamento." id="diagnostico" name="diagnostico" style="height: 100px"></textarea>
                </div>
                <div class="col-12 py-1">
                    <label for="firstName" class="form-label fw-semibold">Acessório(s):</label>
                    <textarea class="form-control" placeholder="Informe o(s) acessório(s) do equipamento." id="acessorio" name="acessorio" style="height: 100px"></textarea>
                </div>
                <div class="col-12 py-1">
                    <label for="firstName" class="form-label fw-semibold">Observação(ões):</label>
                    <textarea class="form-control" placeholder="Informe a(s) observação(ões) sobre o reparo." id="observacao" name="observacao" style="height: 100px"></textarea>
                </div>
                <div class="col-12 my-4 d-flex justify-content-center">
                    <a onclick="dashboardBack()" class="btn btn-outline-primary">Dashboard</a>
                    <a onclick="etapaAnterior()" class="btn btn-outline-primary mx-4">Cliente</a>
                    <a onclick="proximaEtapa()" class="btn btn-primary">Avançar</a>
                </div>
            </form>
        </main>
    </body>
    <script>
        // Função para exibir a data e hora atual
        function exibirDataHora(data) {
            // Obtenha a referência do elemento onde deseja exibir a data
            const elementoDataHora = document.getElementById('data-abertura');
            elementoDataHora.value = data;
            sessionStorage.setItem('data', data);
        }

        function gerarDataHora() {
            // Crie um objeto Date para representar a data e hora atual
            const dataHoraAtual = new Date();

            // Obtenha os componentes da data/hora
            const dia = dataHoraAtual.getDate();
            const mes = dataHoraAtual.getMonth() + 1; // Os meses são zero-indexed, então adicionamos 1
            const ano = dataHoraAtual.getFullYear();
            const hora = dataHoraAtual.getHours();
            const minutos = dataHoraAtual.getMinutes();
            const segundos = dataHoraAtual.getSeconds();

            // Formate a data/hora conforme necessário
            const dataFormatada = `${dia}/${mes}/${ano} ${hora}:${minutos}`;

            // Defina o conteúdo do elemento como a data formatada
            exibirDataHora(dataFormatada);
        }

        function habilitarSenha() {
            var checkbox = document.getElementById('checkbox-senha');
            var campoTexto = document.getElementById('senha');
            
            if (checkbox.checked) {
                campoTexto.disabled = false;
            } else {
                campoTexto.disabled = true;
            }
        }

        function saveData() {
            const equipamento = document.getElementById('tipo-equipamento');
            const marca = document.getElementById('marca');
            const modelo = document.getElementById('modelo');
            const serie = document.getElementById('serie');
            const senha = document.getElementById('senha');
            const diagnostico = document.getElementById('diagnostico');
            const acessorio = document.getElementById('acessorio');
            const observacao = document.getElementById('observacao');

            sessionStorage.setItem('equipamento', equipamento.value);
            sessionStorage.setItem('marca', marca.value);
            sessionStorage.setItem('modelo', modelo.value);
            sessionStorage.setItem('serie', serie.value);
            sessionStorage.setItem('senha', senha.value);
            sessionStorage.setItem('diagnostico', diagnostico.value);
            sessionStorage.setItem('acessorio', acessorio.value);
            sessionStorage.setItem('observacao', observacao.value);
        }

        function recoveryData() {
            const dataHora = sessionStorage.getItem('data');
            const equipamento = sessionStorage.getItem('equipamento');
            const marca = sessionStorage.getItem('marca');
            const modelo = sessionStorage.getItem('modelo');
            const serie = sessionStorage.getItem('serie');
            const senha = sessionStorage.getItem('senha');
            const acessorio = sessionStorage.getItem('acessorio');
            const observacao = sessionStorage.getItem('observacao');

            if(dataHora) {
                exibirDataHora(dataHora);
            } else {
                gerarDataHora();
            }

            document.getElementById('tipo-equipamento').value = equipamento;
            document.getElementById('marca').value = marca;
            document.getElementById('modelo').value = modelo;
            document.getElementById('serie').value = serie;

            if(senha) {
                document.getElementById('senha').value = senha;
                document.getElementById('senha').disabled = false;
                document.getElementById('checkbox-senha').checked = true;
            }
            
            document.getElementById('acessorio').value = acessorio;
            document.getElementById('observacao').value = observacao;
        }

        function proximaEtapa() {
            saveData();
            window.location.href = '/os/add/step/3';
        }

        function etapaAnterior() {
            saveData();
            window.location.href = '/os/add/step/1';
        }

        function dashboardBack() {
            sessionStorage.clear();
            window.location.href = '/user/dashboard';
        }

        // Carregar dados armazenados
        document.addEventListener('DOMContentLoaded', function() {
            recoveryData();
        });
    </script>
</html>
