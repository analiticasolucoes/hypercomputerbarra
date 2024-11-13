<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Adicionar Cliente</title>
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
                <h2>Cadastramento - Cliente</h2>
                <p class="lead">Utilize o formulário abaixo para cadastrar um(a) novo(a) cliente.</p>
            </header>
            <form class="form-group row g-3 d-flex" id="client-add-form" enctype="multipart/form-data" action="/client/add/form" method="post">
                <div class="col-md-12">
                    <label for="nome" class="form-label fw-semibold">Nome Completo:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="col-sm-4 col-md-2 col-lg-2">
                    <label for="cpf" class="form-label fw-semibold">CPF:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" oninput="formatarCPF(this)" onblur="validarCPF(this)" required>
                </div>
                <div class="col-12 z-3" id="cpf-feedback" hidden>Número de CPF invalido!</div>
                <div class="col-sm-4 col-md-2 col-lg-2">
                    <label for="data-nascimento" class="form-label fw-semibold">Data de Nascimento:</label>
                    <input type="text" class="form-control" id="data-nascimento" name="data-nascimento" placeholder="01/01/1900" oninput="formatarDataNascimento(this)" onblur="validarDataNascimento(this)" required>
                </div>
                <div class="col-12 z-3" id="data-nascimento-feedback" hidden>Data de nascimento invalida!</div>
                <div class="col-sm-4 col-md-6 col-lg-8">
                    <label for="email" class="form-label fw-semibold">E-mail:</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="usuario@servidor.com.br" required>
                </div>
                <div class="col-sm-4 col-md-6 col-lg-2">
                    <label for="celular" class="form-label fw-semibold">Celular:</label>
                    <input type="text" class="form-control" id="celular" name="celular" placeholder="21 99999-9999" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold" for="gridCheck">Preferencia de contato:</label>
                </div>
                <div class="col-3 form-check form-check-inline">
                    <input type="checkbox" class="form-check-input mx-1" id="ligacao" name="ligacao" checked>
                    <label class="form-check-label" for="ligacao">Ligação</label>
                </div>
                <div class="col-2 form-check">
                    <input type="checkbox" class="form-check-input" id="mensagem" name="mensagem" checked>
                    <label class="form-check-label" for="mensagem">Mensagem</label>
                </div>
                <div class="col-sm-6 col-md-10 col-lg-10">
                    <label for="rua" class="form-label fw-semibold">Rua:</label>
                    <input type="text" class="form-control" id="rua" name="rua" placeholder="Av./Rua/Estrada ..." required>
                </div>
                <div class="col-sm-6 col-md-2 col-lg-2">
                    <label for="numero" class="form-label fw-semibold">Número:</label>
                    <input type="text" class="form-control" id="numero" name="numero" placeholder="101A" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="bairro" class="form-label fw-semibold">Bairro:</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Barra" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="complemento" class="form-label fw-semibold">Complemento:</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Ed. Plaza Sol">
                </div>
                <div class="col-6 py-1">
                    <label for="estado" class="form-label fw-semibold fw-semibold">Estado:</label>
                    <select class="form-select" id="estado" name="estado" onchange="carregarCidades()" required>
                        <option value="">Selecionar...</option>
                        <option value="1">Acre</option>
                        <option value="2">Alagoas</option>
                        <option value="3">Amapá</option>
                        <option value="4">Amazonas</option>
                        <option value="5">Bahia</option>
                        <option value="6">Ceará</option>
                        <option value="7">Distrito Federal</option>
                        <option value="8">Espírito Santo</option>
                        <option value="9">Goiás</option>
                        <option value="10">Maranhão</option>
                        <option value="11">Mato Grosso</option>
                        <option value="12">Mato Grosso do Sul</option>
                        <option value="13">Minas Gerais</option>
                        <option value="14">Pará</option>
                        <option value="15">Paraíba</option>
                        <option value="16">Paraná</option>
                        <option value="17">Pernambuco</option>
                        <option value="18">Piauí</option>
                        <option value="19">Rio de Janeiro</option>
                        <option value="20">Rio Grande do Norte</option>
                        <option value="21">Rio Grande do Sul</option>
                        <option value="22">Rondônia</option>
                        <option value="23">Roraima</option>
                        <option value="24">Santa Catarina</option>
                        <option value="25">São Paulo</option>
                        <option value="26">Sergipe</option>
                        <option value="27">Tocantins</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, selecione um estado válido!
                    </div>
                </div>
                <div class="col-6 col-md-4 py-1">
                    <label for="cidade" class="form-label fw-semibold fw-semibold">Cidade:</label>
                    <select class="form-select" id="cidade" name="cidade" required>
                        <option value="">Selecionar...</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, selecione uma cidade válida!
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <label for="cep" class="form-label fw-semibold fw-semibold">CEP:</label>
                    <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000" required>
                </div>
                <div class="col-12 my-4 d-flex justify-content-center">
                    <a href="/user/dashboard" class="btn btn-outline-primary mx-4">Voltar</a>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </main>
        <!-- Modal -->
        <div class="modal fade" id="modalConfirmAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalConfirmAdd" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalConfirmAdd">Cliente Cadastrado</h1>
                    </div>
                    <div class="modal-body">
                        Cliente cadastrado com sucesso! Deseja <strong>cadastrar uma nova ordem de serviço</strong> para este cliente?
                    </div>
                    <div class="modal-footer">
                        <a href="/user/dashboard" class="btn btn-secondary">Fechar</a>
                        <a href="/os/add/step/2" class="btn btn-primary">Cadastrar</a>
                    </div>
                </div>
            </div>
        </div>
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
        function formatarDataNascimento(campo) {
            let value = campo.value.replace(/\D/g, ''); // Remove caracteres não numéricos
            if (value.length >= 3 && value.length <= 4) {
                value = value.replace(/^(\d{2})(\d{1,2})/, '$1/$2'); // Adiciona barra após o dia
            } else if (value.length >= 5) {
                value = value.replace(/^(\d{2})(\d{2})(\d{1,4})/, '$1/$2/$3'); // Adiciona barra após o mês
            }
            campo.value = value;
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
        function formatCEP() {
            let cep = document.getElementById("cep");
            let valor = cep.value;

            // Remover todos os hífens do valor
            let valorSemCaractere = valor.replace(/-/g, '');

            // Inserir o hífen após os primeiros 5 caracteres
            if (valorSemCaractere.length > 5) {
                let parte1 = valorSemCaractere.substring(0, 5);
                let parte2 = valorSemCaractere.substring(5);
                cep.value = parte1 + "-" + parte2;
            } else {
                cep.value = valorSemCaractere;
            }
        }

        window.addEventListener('DOMContentLoaded', (event) => {
            let cep = document.getElementById('cep');
            cep.addEventListener('input', formatCEP);
        });
    </script>
    <script>
        function newOS(id, nome, cpf) {
            sessionStorage.setItem('id', id);
            sessionStorage.setItem('nome', nome);
            sessionStorage.setItem('cpf', cpf);
        }

        document.getElementById('client-add-form').addEventListener('submit', function(event) {
            event.preventDefault();  // Prevenir envio tradicional do formulário

            let form = document.getElementById('client-add-form');

            // Criar um objeto FormData para armazenar os dados do formulário
            let formData = new FormData(form);

            // Converter FormData para um objeto JSON
            let formObject = {};
            formData.forEach((value, key) => {
                formObject[key] = value;
            });

            // Enviar os dados usando fetch
            fetch('/client/add/form', {
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
                        newOS(data.cliente.id, data.cliente.nome, data.cliente.cpf);
                        $('#modalConfirmAdd').modal('show');
                    } else {
                        alert('Erro ao cadastrar o novo cliente: ' + data.message);
                    }
                })
                .catch(error => console.error('Erro:', error));
        });
    </script>
</html>