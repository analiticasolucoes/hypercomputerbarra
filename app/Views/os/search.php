<!doctype html>
<html lang="pt-br">
<head>
    <title>Pesquisar Ordem de Serviço</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema de Tópicos, Estados e Municípios">
    <meta name="author" content="Leandro Souza Ferreira">
    <base href="https://hypercomputerbarra.com.br/">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://getbootstrap.com/docs/5.3/assets/js/color-modes.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="container-fluid pt-2" data-bs-theme="light">
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="sort-down" viewBox="0 0 16 16">
        <path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z" />
    </symbol>
    <symbol id="sort-up" viewBox="0 0 16 16">
        <path d="M3.5 12.5a.5.5 0 0 1-1 0V3.707L1.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.5.5 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L3.5 3.707zm3.5-9a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z" />
    </symbol>
</svg>
<header class="">
    <header class="text-center">
        <h2>Pesquisa de Ordem de Serviço</h2>
        <p class="lead">Utilize o formulário abaixo para pesquisar ordens de serviço.</p>
    </header>
    <form id="search-form" role="pesquisar" action="/os/search/result" method="POST">
        <input type="text" id="page" name="page" value="<?php echo $page; ?>" hidden>
        <div class="form-row">
            <div class="form-group col-md-3 py-2">
                <label class="form-label" for="searchOption">Critério de Pesquisa:</label>
                <select class="form-control form-select w-auto" id="searchOption" name="searchOption">
                    <option value="1"<?php if($action == "result" && $search['searchOption'] == 1) echo "selected"; ?>>Nº OS</option>
                    <option value="2"<?php if($action == "result" && $search['searchOption'] == 2) echo "selected"; ?>>Equipamento</option>
                    <option value="3"<?php if($action == "result" && $search['searchOption'] == 3) echo "selected"; ?>>Nome do Cliente</option>
                    <option value="4"<?php if($action == "result" && $search['searchOption'] == 4) echo "selected"; ?>>CPF do Cliente</option>
                </select>
            </div>
            <div class="form-group col-md-12 py-2" id="nameField">
                <input type="text" class="form-control" id="inputSearch" name="inputSearch" placeholder="Pesquisar aqui..." value="<?php if($action == "result") echo $search['inputSearch']; ?>">
            </div>
        </div>
        <div class="form-group col-md-3 align-self-end py-2">
            <button type="submit" class="btn btn-outline-success btn-block">Pesquisar</button>
        </div>
    </form>
</header>
<div class="col-12 mt-2 d-flex justify-content-end">
    <a href="#" class="btn btn-sm btn-outline-secondary disabled">Exportar</a>
</div>
<main class="table-responsive small mt-2 min-vh-75">
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
        <?php if($action == "result"): ?>
            <?php $rota = "";
            foreach ($resultadoPaginado as $os) :
                if ($os['estagio'] ==  "CADASTRADO") $rota = "diagnosis";
                if ($os['estagio'] ==  "DIAGNOSTICADO") $rota = "budget";
                if ($os['estagio'] ==  "ORCADO") $rota = "charge";
                if ($os['estagio'] ==  "REPARADO") $rota = "repair";
                if ($os['estagio'] ==  "FATURADO") $rota = "show";
                if ($os['estagio'] ==  "PAGO") $rota = "show";
                if ($os['estagio'] ==  "CONCLUIDO") $rota = "show";
                if ($os['estagio'] ==  "CANCELADO") $rota = "show"; ?>
                <tr class="p-2">
                    <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/os/show?id=<?php echo $os['id']; ?>"><?php echo $os['created_at']; ?></td>
                    <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/os/show?id=<?php echo $os['id']; ?>"><?php echo $os['id']; ?></td>
                    <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/os/show?id=<?php echo $os['id']; ?>"><?php echo $os['cliente']; ?></td>
                    <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/os/show?id=<?php echo $os['id']; ?>"><?php echo $os['equipamento']; ?></td>
                    <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/os/show?id=<?php echo $os['id']; ?>">
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
                                Aguardando Retirada
                            <?php endif; ?>
                            <?php if ($os['estagio'] == "CONCLUIDO") : ?>
                                Concluído
                            <?php endif; ?>
                            <?php if ($os['estagio'] == "CANCELADO") : ?>
                                Cancelado
                            <?php endif; ?>
                        </span>
                    </td>
                    <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/os/show?id=<?php echo $os['id']; ?>">
                            <?php if ($os['status'] == "No prazo") : ?>
                                <span class="badge text-bg-primary">
                            No prazo
                        </span>
                            <?php endif; ?>
                            <?php if ($os['status'] == "Parada") : ?>
                                <span class="badge text-bg-danger">
                            Parada
                        </span>
                            <?php endif; ?>
                            <?php if ($os['status'] == "Atrasada") : ?>
                                <span class="badge text-bg-warning">
                            Atrasada
                        </span>
                            <?php endif; ?>
                    </td>
                    <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/os/show?id=<?php echo $os['id']; ?>"><?php echo $os['n_dias']; ?></td>
                    <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/os/show?id=<?php echo $os['id']; ?>"><?php echo $os['valor_total']; ?></td>
                    <td class="p-2">
                        <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        </div>
                    </td>
                </tr>
            <?php
            endforeach;
        else : ?>
            <tr class="p-2">
                <td class="p-2 text-center" colspan="9">Nenhum resultado disponível.</td>
            </tr>
        <?php
        endif; ?>
        </tbody>
    </table>
</main>
<?php if($action == "result"): ?>
    <nav class="page navigation d-flex justify-content-center align-items-center" aria-label="Page navigation">
        <ul class="pagination pt-3">
            <?php foreach($navigation as $navItem): ?>
                <li class="page-item<?php if(!$navItem['active']) echo " disabled"; ?>">
                    <a class="page-link link-dark" href="/os/search/result?searchOption=<?php echo $search['searchOption']; ?>&inputSearch=<?php echo $search['inputSearch']; ?>&page=<?php echo $navItem['page']; ?>">
                        <?php echo $navItem['label']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
<?php endif; ?>
<div class="col-12 my-4 d-flex justify-content-center">
    <a href="/user/dashboard" class="btn btn-primary mx-4">Voltar</a>
</div>
<footer>
    <div class="container-fluid row d-flex justify-content-between p-4">
        <div class="col-6 text-center">Copyright © 2024 | Todos os direitos reservados.</div>
        <div class="col-6 text-center">Desenvolvido por <strong><a class="link-dark link-underline link-underline-opacity-0" href="https://analiticasolucoes.com.br" target="_blank">Analitica Soluções</a></strong></div>
    </div>
</footer>
</body>
<script>
    function ordenarTabela(colIndex) {
        let order = toggleSortOrder(colIndex);
        const tbody = document.querySelector('#tabela tbody');
        let rows = Array.from(tbody.querySelectorAll('tr'));

        rows = ordenarArray(rows, colIndex, order);

        rows.forEach(row => tbody.appendChild(row));
    }

    function toggleSortOrder(colIndex) {
        const headerCell = document.querySelector(`#tabela th:nth-child(${colIndex + 1})`);
        const sortIcon = headerCell.querySelector('.bi');
        const isAscending = headerCell.classList.toggle('asc');
        headerCell.classList.toggle('desc', !isAscending);
        const tabela = document.getElementById('tabela');
        const allSortIcons = tabela.querySelectorAll('.bi');

        allSortIcons.forEach(icon => {
            if (icon !== sortIcon) {
                icon.innerHTML = '<use xlink:href="#sort-up"/>';
            }
        });

        sortIcon.innerHTML = isAscending ? '<use xlink:href="#sort-up"/>' : '<use xlink:href="#sort-down"/>';

        return isAscending ? "asc" : "desc";
    }

    // Adicionando eventos de clique aos ícones de ordenação
    const tabela = document.getElementById('tabela');
    const sortIcons = tabela.querySelectorAll('.bi');
    sortIcons.forEach((icon, index) => {
        icon.addEventListener('click', () => {
            switch (index) {
                case 0:
                    ordenarTabela(0);
                    break;
                case 1:
                    ordenarTabela(1);
                    break;
                case 2:
                    ordenarTabela(2);
                    break;
                case 3:
                    ordenarTabela(3);
                    break;
                case 4:
                    ordenarTabela(4);
                    break;
                case 5:
                    ordenarTabela(5);
                    break;
                case 6:
                    ordenarTabela(6);
                    break;
                case 7:
                    ordenarTabela(7);
                    break;
                case 8:
                    ordenarTabela(8);
                    break;
            }
        });
    });

    function ordenarArray(array, coluna, ordem) {
        // Função de comparação para ordenar em ordem crescente
        const compararCrescente = (a, b) => {
            if (a.cells[coluna].textContent < b.cells[coluna].textContent) return -1;
            if (a.cells[coluna].textContent > b.cells[coluna].textContent) return 1;
            return 0;
        };

        // Função de comparação para ordenar em ordem crescente (números)
        const compararNumerosCrescente = (a, b) => {
            if (parseFloat(a.cells[coluna].textContent) < parseFloat(b.cells[coluna].textContent)) return -1;
            if (parseFloat(a.cells[coluna].textContent) > parseFloat(b.cells[coluna].textContent)) return 1;
            return 0;
        };

        // Função de comparação para ordenar em ordem decrescente
        const compararDecrescente = (a, b) => {
            if (a.cells[coluna].textContent > b.cells[coluna].textContent) return -1;
            if (a.cells[coluna].textContent < b.cells[coluna].textContent) return 1;
            return 0;
        };

        // Função de comparação para ordenar em ordem decrescente (números)
        const compararNumerosDecrescente = (a, b) => {
            if (parseFloat(a.cells[coluna].textContent) > parseFloat(b.cells[coluna].textContent)) return -1;
            if (parseFloat(a.cells[coluna].textContent) < parseFloat(b.cells[coluna].textContent)) return 1;
            return 0;
        };

        // Função de comparação para datas no formato DD/MM/YYYY
        const compararDatas = (a, b) => {
            const dataA = new Date(a.cells[coluna].textContent.split('/').reverse().join('/'));
            const dataB = new Date(b.cells[coluna].textContent.split('/').reverse().join('/'));
            return ordem === 'asc' ? dataA - dataB : dataB - dataA;
        };

        // Identifica o tipo dos dados do array
        let tipo = typeof(array[0].cells[coluna].textContent);

        if (!isNaN(parseFloat(array[0].cells[coluna].textContent)) && !isNaN(parseInt(array[0].cells[coluna].textContent))) //se for numero
            tipo = "number";
        if (array[0].cells[coluna].textContent.match(/\d{2}\/\d{2}\/\d{4}/)) //se for data
            tipo = "date"

        let comparar;

        // Define a função de comparação com base no tipo dos dados
        switch (tipo) {
            case 'string':
                comparar = ordem === 'asc' ? compararCrescente : compararDecrescente;
                break;
            case 'number':
                comparar = ordem === 'asc' ? compararNumerosCrescente : compararNumerosDecrescente;
                break;
            case 'date':
                comparar = compararDatas;
                break;
            default:
                return 'Tipo de array não suportado';
        }

        // Retorna o array ordenado
        return array.slice().sort(comparar);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous"></script>
<script src="https://getbootstrap.com/docs/5.3/examples/dashboard/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>