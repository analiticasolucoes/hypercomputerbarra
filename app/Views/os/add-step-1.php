<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nova Ordem de Serviço</title>
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
            tr.selected {
                font-weight: bold;
            }
            .disabled {
                pointer-events: none;
                color: grey;
                text-decoration: none;
            }
            .hover-pointer {
                cursor: pointer;
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
                    <li class="breadcrumb-item active fw-bold" aria-current="page">Cliente</li>
                    <li class="breadcrumb-item">Equipamento</li>
                    <li class="breadcrumb-item">Resumo</li>
                </ol>
            </nav>
            <header class="d-flex row d-flex align-items-center">
                <div class="col-12"> 
                    <label for="firstName" class="form-label fw-semibold fw-semibold">Cliente:</label>
                </div>
                <div class="col-12 col-md-1  mt-2 w-auto">
                    <select class="form-select" name="criterio-busca" id="criterio-busca">
                        <option value="nome" default>Nome</option>
                        <option value="cpf">CPF</option>
                    </select>
                </div>
                <div class="col-12 col-md-8 mt-2">
                    <input type="text" class="form-control pt-sm-1" placeholder="Informe o nome ou CPF do cliente para localizar seu cadastro." id="parametro-busca" name="parametro-busca">
                </div>
                <div class="col-12 col-md-2 mt-2">
                    <button type="button" class="btn btn-outline-danger" onclick="procurarCliente()">Procurar</button>
                    <a class="btn btn-outline-success ms-2" href="/client/add">Novo</a>
                    <div class="invalid-feedback">
                        Não foi encontrado nenhum cadastro de cliente com o termo informado!
                    </div>
                </div>
            </header>
            <!-- Tabela para exibir os resultados -->
            <div class="table-responsive mt-4" id="tabela-resultados">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="fw-semibold" scope="col">Nome</th>
                            <th class="fw-semibold" scope="col">CPF</th>
                        </tr>
                    </thead>
                    <tbody id="corpo-tabela">
                        <!-- Aqui serão inseridos os resultados da busca -->
                    </tbody>
                </table>
            </div>
            <div class="col-12 d-flex justify-content-center my-4">
                <a href="/user/dashboard" class="btn btn-outline-primary me-4">Voltar</a>
                <button id="next-button" onclick="proximaEtapa()" class="btn btn-primary disabled">Avançar</button>
            </div>
        </main>
    </body>
    <script>
        const link = document.getElementById('next-button');
        const table = document.getElementById('tabela-resultados');

        function procurarCliente() {
            var criterioBusca = document.getElementById("criterio-busca");
            var parametroBusca = document.getElementById("parametro-busca");
            document.getElementById('next-button').classList.add('disabled');
            var criterioSelecionado = criterioBusca.value;
            var rota = "";

            if (parametroBusca.value === "") {
                alert("Por favor, informe um parametro para busca.");
                return;
            }

            if(criterioSelecionado === "nome")
                rota = "/client/search/json?nome=" + parametroBusca.value;
            if(criterioSelecionado === "cpf")
                rota = "/client/search/json?cpf=" + parametroBusca.value;

            // Fazer uma solicitação ao backend
            fetch(rota) // A rota no backend com o valor selecionado
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        preencherTabelaVazia();
                    } else {
                        preencherTabela(data);
                    }
                })
                .catch(error => console.error('Erro ao procurar clientes:', error));
        }

        function preencherTabela(data) {
            var corpoTabela = document.getElementById("corpo-tabela");
            corpoTabela.innerHTML = ""; // Limpar a tabela antes de preencher
            data.forEach(cliente => {
                var newRow = corpoTabela.insertRow();
                var cell1 = newRow.insertCell(0);
                var cell2 = newRow.insertCell(1);
                newRow.setAttribute("class", "hover-pointer");
                cell1.parentNode.setAttribute("id", cliente.id);
                cell1.setAttribute("id", "nome");
                cell1.innerHTML = cliente.nome;
                cell2.setAttribute("id", "cpf");
                cell2.innerHTML = cliente.cpf;
            });
        }

        function preencherTabelaVazia() {
            var corpoTabela = document.getElementById("corpo-tabela");
            corpoTabela.innerHTML = ""; // Limpar a tabela antes de preencher

            var newRow = corpoTabela.insertRow();
            var cell1 = newRow.insertCell(0);
            cell1.colSpan = 2; // Definir a largura da célula para ocupar todas as colunas
            cell1.innerHTML = "Nenhum cliente localizado.";
            cell1.parentNode.setAttribute('class','empty');
            link.classList.add('disabled');
        }

        document.addEventListener('DOMContentLoaded', function() {
            recoveryData();
            table.addEventListener('click', function(event) {
                const target = event.target;
                const tr = target.closest('tr');

                // Ignorar o cabeçalho da tabela
                if (tr && tr.parentNode.tagName === 'TBODY') {
                    // Remover a seleção de qualquer linha previamente selecionada
                    const selected = table.querySelector('tr.selected');
                    const empty = table.querySelector('tr.empty');

                    if (selected) {
                        selected.classList.remove('selected');
                        link.classList.add('disabled');
                        deleteData();
                    } else if(!empty) {
                        // Adicionar a classe de seleção à linha clicada
                        tr.classList.add('selected');

                        // Habilitar o link
                        link.classList.remove('disabled');
                        saveData(tr);
                    }
                }
            });
        });

        function saveData(selected) {
            const nome = selected.firstChild.innerText;
            const id = selected.id;
            const cpf = selected.lastChild.innerText;

            sessionStorage.setItem('id', id);
            sessionStorage.setItem('nome', nome);
            sessionStorage.setItem('cpf', cpf);
        }

        function recoveryData() {
            const id = sessionStorage.getItem('id');
            const nome = sessionStorage.getItem('nome');
            const cpf = sessionStorage.getItem('cpf');

            if (id) {
                var data = [{"id": id, "nome": nome, "cpf": cpf}];
                preencherTabela(data);
            }
        }

        function deleteData() {
            sessionStorage.removeItem("id");
            sessionStorage.removeItem("nome");
            sessionStorage.removeItem("cpf");
        }

        function proximaEtapa() {
            window.location.href = '/os/add/step/2';
        }
    </script>
</html>