<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesquisar - Cliente</title>
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
<body class="container-fluid pt-2">
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
            <h2>Pesquisa de Clientes</h2>
            <p class="lead">Utilize o formulário abaixo para pesquisar clientes.</p>
        </header>
        <form id="search-form" role="pesquisar" action="/client/search/result" method="POST">
            <input type="text" id="page" name="page" value="<?php echo $page; ?>" hidden>
            <div class="form-row">
                <div class="form-group col-md-3 py-2">
                    <label class="form-label" for="searchOption">Critério de Pesquisa:</label>
                    <select class="form-control form-select w-auto" id="searchOption" name="searchOption">
                        <option value="1"<?php if($action == "result" && $search['searchOption'] == 1) echo "selected"; ?>>Nome</option>
                        <option value="2"<?php if($action == "result" && $search['searchOption'] == 2) echo "selected"; ?>>CPF</option>
                    </select>
                </div>
                <div class="form-group col-md-12 py-2" id="nameField">
                    <input type="text" class="form-control" id="inputSearch" name="inputSearch" placeholder="Pesquisar aqui..." value="<?php if($action == "result") echo $search['inputSearch']; ?>" required>
                </div>
            </div>
            <div class="form-group col-md-3 align-self-end py-2">
                <button type="button" class="btn btn-outline-success btn-block" onclick="validateForm()">Pesquisar</button>
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
                        CPF
                        <svg class="bi" width="16" height="16">
                            <use xlink:href="#sort-down" />
                        </svg>
                    </th>
                    <th scope="col">
                        Nome
                        <svg class="bi" width="16" height="16">
                            <use xlink:href="#sort-down" />
                        </svg>
                    </th>
                    <th scope="col">
                        E-mail
                        <svg class="bi" width="16" height="16">
                            <use xlink:href="#sort-down" />
                        </svg>
                    </th>
                    <th scope="col">
                        Celular
                        <svg class="bi" width="16" height="16">
                            <use xlink:href="#sort-down" />
                        </svg>
                    </th>
                    <th scope="col">
                        Data de Nascimento
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
                <?php foreach($resultadoPaginado as $cliente): ?>
                <tr class="p-2">
                    <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/client/show?id=<?php echo $cliente->getId();?>"><?php echo $cliente->getCpf();?></td>
                    <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/client/show?id=<?php echo $cliente->getId();?>"><?php echo $cliente->getNome();?></td>
                    <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/client/show?id=<?php echo $cliente->getId();?>"><?php echo $cliente->getEmail();?></td>
                    <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/client/show?id=<?php echo $cliente->getId();?>"><?php echo $cliente->getCelular();?></td>
                    <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/client/show?id=<?php echo $cliente->getId();?>"><?php echo $cliente->getDataNascimento();?></td>
                    <td class="p-2">
                        <a class="link-dark link-underline link-underline-opacity-0" href="/client/show?id=<?php echo $cliente->getId();?>">
                            <div class="form-check d-flex justify-content-center">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </div>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr class="p-2">
                    <td class="p-2 text-center" colspan="6">Nenhum resultado encontrado.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </main>
    </div>
    <?php if($action == "result"): ?>
    <nav class="page navigation d-flex justify-content-center align-items-center" aria-label="Page navigation">
        <ul class="pagination pt-3">
        <?php foreach($navigation as $navItem): ?>
            <li class="page-item<?php if(!$navItem['active']) echo " disabled"; ?>">
                <a class="page-link link-dark" href="/client/search/result?searchOption=<?php echo $search['searchOption']; ?>&inputSearch=<?php echo $search['inputSearch']; ?>&page=<?php echo $navItem['page']; ?>">
                    <?php echo $navItem['label']; ?>
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
    </nav>
    <?php endif; ?>
    <div class="col-12 my-2 d-flex justify-content-center">
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
<script>
    function checkAllCheckboxes() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var checkAllCheckbox = document.getElementById('checkAll');

        // Se o botão de "Marcar Todos" estiver marcado, marque todos os checkboxes
        if (checkAllCheckbox.checked) {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true;
            });
        } else {
            // Caso contrário, desmarque todos os checkboxes
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
    }
</script>
<script>
    function validateForm() {
        var field = document.getElementById('inputSearch').value;
        var searchOption = document.getElementById('searchOption').value;

        // Verifica se a opção selecionada é a de valor 2
        if (searchOption === '2') {
            // Remove pontos (".") e traços ("-")
            var cleanedField = field.replace(/[.-]/g, '');

            // Regex para verificar se contém exatamente 11 dígitos
            var regex = /^\d{11}$/;

            if (!regex.test(cleanedField)) {
                alert('O campo deve conter exatamente 11 números.');
                return;
            }
        }
        document.getElementById("search-form").submit();
    }

</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous"></script>
<script src="https://getbootstrap.com/docs/5.3/examples/dashboard/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>