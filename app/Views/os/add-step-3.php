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
    <style>
        .alert-fixed-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050; /* Superior ao modal do Bootstrap */
            border-radius: 0;
        }
    </style>
</head>
<body>
<main class="container pt-3">
    <header class="text-center">
        <h2>Cadastramento - Ordem de Serviço</h2>
        <p class="lead">Utilize o formulário abaixo para cadastrar uma nova ordem de serviço.</p>
    </header>
    <nav class="d-flex justify-content-center" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Cliente</li>
            <li class="breadcrumb-item"><a class="link-underline link-underline-opacity-0 link-dark" href="/os/add/step/2">Equipamento</a></li>
            <li class="breadcrumb-item active fw-bold" aria-current="page">Resumo</li>
        </ol>
    </nav>
    <section>
        <form class="form-group needs-validation row d-flex" id="os-add-form" enctype="multipart/form-data" action="/os/add/form" method="post" novalidate>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Dados do Cliente
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body row d-flex">
                            <input type="text" class="form-control" id="id" name="id" hidden>
                            <div class="col-md-12">
                                <label for="nome" class="form-label fw-semibold">Nome Completo:</label>
                                <input type="text" class="form-control" id="nome" name="nome" readonly>
                            </div>
                            <div class="col-sm-4 col-md-2 col-lg-2">
                                <label for="cpf" class="form-label fw-semibold">CPF:</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" readonly>
                            </div>
                            <div id="cpf-feedback" hidden>Número de CPF invalido!</div>
                            <div class="col-sm-4 col-md-2 col-lg-2">
                                <label for="data-nascimento" class="form-label fw-semibold">Data de Nascimento:</label>
                                <input type="text" class="form-control" id="data-nascimento" name="data-nascimento" readonly>
                            </div>
                            <div class="col-sm-4 col-md-6 col-lg-8">
                                <label for="email" class="form-label fw-semibold">E-mail:</label>
                                <input type="text" class="form-control" id="email" name="email" readonly>
                            </div>
                            <div class="col-sm-4 col-md-6 col-lg-2">
                                <label for="celular" class="form-label fw-semibold">Celular:</label>
                                <input type="text" class="form-control" id="celular" name="celular" readonly>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="gridCheck">Preferencia de contato:</label>
                            </div>
                            <div class="col-3 form-check form-check-inline">
                                <input type="checkbox" class="form-check-input mx-1" id="ligacao" name="ligacao" disabled>
                                <label class="form-check-label" for="ligacao">Ligação</label>
                            </div>
                            <div class="col-2 form-check">
                                <input type="checkbox" class="form-check-input" id="mensagem" name="mensagem" disabled>
                                <label class="form-check-label" for="mensagem">Mensagem</label>
                            </div>
                            <div class="col-sm-6 col-md-10 col-lg-10">
                                <label for="endereco" class="form-label fw-semibold">Endereço:</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" readonly>
                            </div>
                            <div class="col-sm-6 col-md-2 col-lg-2">
                                <label for="numero" class="form-label fw-semibold">Número:</label>
                                <input type="text" class="form-control" id="numero" name="numero" readonly>
                            </div>
                            <div class="col-12">
                                <label for="complemento" class="form-label fw-semibold">Complemento:</label>
                                <input type="text" class="form-control" id="complemento" name="complemento" readonly>
                            </div>
                            <div class="col-6 py-1">
                                <label for="country" class="form-label fw-semibold fw-semibold">Estado:</label>
                                <select class="form-select" id="estado" name="estado" disabled></select>
                            </div>
                            <div class="col-4 py-1">
                                <label for="state" class="form-label fw-semibold fw-semibold">Cidade:</label>
                                <select class="form-select" id="cidade" name="cidade" disabled></select>
                            </div>
                            <div class="col-md-2">
                                <label for="cep" class="form-label fw-semibold fw-semibold">CEP:</label>
                                <input type="text" class="form-control" id="cep" name="cep" readonly>
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
                            <div class="col-12 py-1">
                                <label for="data-abertura" class="form-label fw-semibold">Data e Hora:</label>
                                <input type="text" class="form-control w-auto" id="data-abertura" name="data-abertura" readonly>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                                <label for="tipo-equipamento" class="form-label fw-semibold">Equipamento:</label>
                                <input type="text" class="form-control" id="tipo-equipamento" name="tipo-equipamento" readonly required>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                                <label for="marca" class="form-label fw-semibold">Marca:</label>
                                <input type="text" class="form-control" id="marca" name="marca" readonly required>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                                <label for="modelo" class="form-label fw-semibold">Modelo:</label>
                                <input type="text" class="form-control" id="modelo" name="modelo" readonly required>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                                <label for="serie" class="form-label fw-semibold">Série:</label>
                                <input type="text" class="form-control" id="serie" name="serie" readonly>
                            </div>
                            <div class="col-12 py-1">
                                <label for="firstName" class="form-label fw-semibold">Possue senha?</label>
                                <div class="form-check form-check-inline ms-3">
                                    <input class="form-check-input" type="checkbox" id="checkbox-senha" disabled>
                                    <label class="form-check-label" for="inlineCheckbox1">Sim</label>
                                </div>
                                <input type="text" class="form-control" id="senha" name="senha" readonly>
                            </div>
                            <div class="col-12 py-1">
                                <label for="firstName" class="form-label fw-semibold">Defeito:</label>
                                <textarea class="form-control" id="diagnostico" name="diagnostico" style="height: 100px" readonly></textarea>
                            </div>
                            <div class="col-12 py-1">
                                <label for="firstName" class="form-label fw-semibold">Acessório(s):</label>
                                <textarea class="form-control" id="acessorio" name="acessorio" style="height: 100px" readonly></textarea>
                            </div>
                            <div class="col-12 py-1">
                                <label for="firstName" class="form-label fw-semibold">Observação(ões):</label>
                                <textarea class="form-control" id="observacao" name="observacao" style="height: 100px" readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-12 my-4 d-flex justify-content-center">
            <a onclick="dashboardBack()" class="btn btn-outline-primary me-4">Dashboard</a>
            <a href="/os/add/step/1" class="btn btn-outline-primary me-4">Cliente</a>
            <a href="/os/add/step/2" class="btn btn-outline-primary me-4">Equipamento</a>
            <button type="submit" id="submitButton" class="btn btn-primary">
                <span id="submitButtonText">Cadastrar</span>
                <span id="submitButtonSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
            <!-- <button type="submit" class="btn btn-primary">Cadastrar</button> -->
        </div>
        </form>
    </section>
</main>
<!-- Alert -->
<div id="errorAlert" class="alert alert-danger alert-fixed-top text-center d-flex align-items-center justify-content-center d-none" role="alert">
    <svg class="bi flex-shrink-0 mx-4" role="img" aria-label="Danger:" width="24" height="24"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>É obrigatório informar o <strong>Equipamento, Marca e Modelo!</strong> Retorne à página do Equipamento e verifique o preenchimento dos campos antes de cadastrar a Ordem de Serviço.</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalConfirmAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalConfirmAdd" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalConfirmAdd">Ordem de Serviço Cadastrada</h1>
            </div>
            <div class="modal-body">
                Ordem de Serviço cadastrada com sucesso!
                ID: <span id="modal-diagnosis-id-span"></span><br>
                Deseja <strong>realizar o diagnóstico do equipamento</strong> agora?
            </div>
            <div class="modal-footer">
                <a href="/user/dashboard" class="btn btn-secondary">Fechar</a>
                <a id="modal-diagnosis-link" href="" class="btn btn-primary">Diagnosticar</a>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    function recoveryData() {
        const dataHora = sessionStorage.getItem('data');
        const equipamento = sessionStorage.getItem('equipamento');
        const marca = sessionStorage.getItem('marca');
        const modelo = sessionStorage.getItem('modelo');
        const serie = sessionStorage.getItem('serie');
        const senha = sessionStorage.getItem('senha');
        const diagnostico = sessionStorage.getItem('diagnostico');
        const acessorio = sessionStorage.getItem('acessorio');
        const observacao = sessionStorage.getItem('observacao');

        const id = sessionStorage.getItem('id');

        procurarCliente(id);

        document.getElementById('data-abertura').value = dataHora;
        document.getElementById('tipo-equipamento').value = equipamento;
        document.getElementById('marca').value = marca;
        document.getElementById('modelo').value = modelo;
        document.getElementById('serie').value = serie;

        document.getElementById('senha').value = senha;
        if(senha)
            document.getElementById('checkbox-senha').checked = true;

        document.getElementById('diagnostico').value = diagnostico;
        document.getElementById('acessorio').value = acessorio;
        document.getElementById('observacao').value = observacao;
    }

    function preencherCliente(data) {
        data.forEach(cliente => {
            document.getElementById("id").value = cliente.id;
            document.getElementById("nome").value = cliente.nome;
            document.getElementById("cpf").value = cliente.cpf;
            document.getElementById("data-nascimento").value = cliente.dataNascimento;
            document.getElementById("email").value = cliente.email;
            document.getElementById("celular").value = cliente.celular;

            if(cliente.preferenciaContato === 3) {
                document.getElementById("ligacao").checked = true;
                document.getElementById("mensagem").checked = true;
            }
            if(cliente.preferenciaContato === 2) {
                document.getElementById("ligacao").checked = false;
                document.getElementById("mensagem").checked = true;
            }
            if(cliente.preferenciaContato === 1) {
                document.getElementById("ligacao").checked = true;
                document.getElementById("mensagem").checked = false;
            }
            if(cliente.preferenciaContato === 0) {
                document.getElementById("ligacao").checked = false;
                document.getElementById("mensagem").checked = false;
            }
            document.getElementById("endereco").value = cliente.rua;
            document.getElementById("numero").value = cliente.numero;
            document.getElementById("complemento").value = cliente.complemento;

            document.getElementById("cep").value = cliente.cep;

            procurarCidade(cliente.cidade);
        });
    }

    function procurarCliente(id) {
        var rota = "/client/search/json?id=" + id;

        // Fazer uma solicitação ao backend
        fetch(rota) // A rota no backend com o valor selecionado
            .then(response => response.json())
            .then(data => {
                preencherCliente(data);
            })
            .catch(error => console.error('Erro ao procurar cliente:', error));
    }

    function preencherCidade(data) {
        data.forEach(cidade => {
            const selectEstado = document.getElementById('estado');
            const selectCidade = document.getElementById('cidade');
            const estadoOption = document.createElement('option');
            const cidadeOption = document.createElement('option');

            estadoOption.value = cidade.estado.id;
            estadoOption.text = `${cidade.estado.nome}`;
            selectEstado.appendChild(estadoOption);

            cidadeOption.value = cidade.id;
            cidadeOption.text = `${cidade.nome}`;
            selectCidade.appendChild(cidadeOption);
        });
    }

    function procurarCidade(id) {
        var rota = "/cidade/search?id=" + id;

        // Fazer uma solicitação ao backend
        fetch(rota) // A rota no backend com o valor selecionado
            .then(response => response.json())
            .then(data => {
                preencherCidade(data);
            })
            .catch(error => console.error('Erro ao procurar cidade do cliente:', error));
    }

    function dashboardBack() {
        sessionStorage.clear();
        window.location.href = '/user/dashboard';
    }

    // Carregar dados armazenados
    document.addEventListener('DOMContentLoaded', function() {
        recoveryData();
    });

    document.getElementById('os-add-form').addEventListener('submit', function(event) {
        event.preventDefault();  // Prevenir envio tradicional do formulário

        let equipamento = document.getElementById("tipo-equipamento").value;
        let marca = document.getElementById("marca").value;
        let modelo = document.getElementById("modelo").value;
        
        var errorAlert = $('#errorAlert');

        if(equipamento === "" || marca === "" || modelo === "") {
            errorAlert.removeClass('d-none').show();

            // Ocultar o alerta após 3 segundos
            setTimeout(function() {
                errorAlert.fadeOut(function() {
                    errorAlert.addClass('d-none');
                });
            }, 3000);
            return;
        } else {
            errorAlert.addClass('d-none').hide();
            $('#modalConfirmDiagnosis').modal('show');
        }
        
        const button = document.getElementById("submitButton");
        const buttonText = document.getElementById("submitButtonText");
        const buttonSpinner = document.getElementById("submitButtonSpinner");

        // Mostra o spinner e desabilita o botão
        buttonSpinner.classList.remove("d-none");
        buttonText.textContent = 'Cadastrando...';
        button.disabled = true;
        
        let form = document.getElementById('os-add-form');

        // Criar um objeto FormData para armazenar os dados do formulário
        let formData = new FormData(form);

        // Converter FormData para um objeto JSON
        let formObject = {};
        formData.forEach((value, key) => {
            formObject[key] = value;
        });

        // Enviar os dados usando fetch
        fetch('/os/add/form', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formObject)
        })
            .then(response => response.json())
            .then(data => {
                console.log('Resposta do servidor:', data);
                if (data.success) {
                    var link = document.getElementById("modal-diagnosis-link");
                    var span = document.getElementById("modal-diagnosis-id-span");

                    link.href = "/os/diagnosis/details?id="+data.id;
                    span.innerText = data.id;
                    sessionStorage.clear();
                    $('#modalConfirmAdd').modal('show');
                } else {
                    alert('Erro ao cadastrar a nova ordem de serviço: ' + data.message);
                }
            })
            .catch(error => console.error('Erro:', error))
            .finally(() => {
                // Remove o estado de loading e reativa o botão
                buttonSpinner.classList.add("d-none");
                buttonText.textContent = 'Cadastrar';
                button.disabled = false;
            });
    });
</script>
</html>