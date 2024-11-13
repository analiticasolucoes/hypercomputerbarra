<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reparo</title>
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
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="sort-down" viewBox="0 0 16 16">
            <path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z" />
        </symbol>
        <symbol id="sort-up" viewBox="0 0 16 16">
            <path d="M3.5 12.5a.5.5 0 0 1-1 0V3.707L1.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.5.5 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L3.5 3.707zm3.5-9a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z" />
        </symbol>
    </svg>
    <main class="container-fluid pt-3">
        <header class="text-center">
            <h2>Reparo - Ordem de Serviço</h2>
            <p class="lead">Utilize o formulário abaixo para visualizar as ordens de serviço que aguardam reparo.</p>
        </header>
        <div class="table-responsive small rounded p-2 mb-3 bg-body">
            <table id="tabela" class="table table-hover table-sm pb-2">
                <thead>
                    <tr>
                        <th scope="col">
                            Criado em
                            <svg class="bi" width="16" height="16">
                                <use xlink:href="#sort-down" />
                            </svg>
                        </th>
                        <th scope="col">
                            # OS
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
                            <a class="link-dark link-underline link-underline-opacity-0" href="#">
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="checkbox" value="" id="checkAll" onclick="checkAllCheckboxes()">
                                </div>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    if(@$listaOS):
                        foreach($resultadoPaginado as $os):?>
                    <tr class="p-2">
                        <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="os/repair/details?id=<?php echo $os['id'];?>"><?php echo $os['created_at'];?></td>
                        <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="os/repair/details?id=<?php echo $os['id'];?>"><?php echo $os['id'];?></td>
                        <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="os/repair/details?id=<?php echo $os['id'];?>"><?php echo $os['cliente'];?></td>
                        <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="os/repair/details?id=<?php echo $os['id'];?>"><?php echo $os['equipamento'];?></td>
                        <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="os/repair/details?id=<?php echo $os['id'];?>">
                            <?php if($os['status'] == "No prazo"): ?>
                            <span class="badge text-bg-primary">
                                No prazo
                            </span>
                            <?php endif; ?>
                            <?php if($os['status'] == "Parada"): ?>
                            <span class="badge text-bg-danger">
                                Parada
                            </span>
                            <?php endif; ?>
                            <?php if($os['status'] == "Atrasada"): ?>
                            <span class="badge text-bg-warning">
                                Atrasada
                            </span>
                            <?php endif; ?>
                        </td>
                        <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="os/repair/details?id=<?php echo $os['id'];?>"><?php echo $os['n_dias'];?></td>
                        <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="os/repair/details?id=<?php echo $os['id'];?>"><?php echo number_format((float)$os['valor_total'], 2, ',', '.');?></td>
                        <td class="p-2">
                            <a class="link-dark link-underline link-underline-opacity-0" href="os/repair/details?id=<?php echo $os['id'];?>">
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </a>
                        </td>
                    </tr>
                    <?php
                        endforeach;
                    else:?>
                    <tr class="p-2">
                        <td class="p-2 text-center" colspan="7">Nenhum resultado disponível.</td>
                    </tr>
                    <?php
                    endif;?>
                </tbody>
            </table>
        </div>
        <nav class="page navigation d-flex justify-content-center align-items-center" aria-label="Page navigation">
            <ul class="pagination pt-3">
                <?php foreach($navigation as $navItem): ?>
                    <li class="page-item<?php if(!$navItem['active']) echo " disabled"; ?>">
                        <a class="page-link link-dark" href="/os/repair?page=<?php echo $navItem['page']; ?>">
                            <?php echo $navItem['label']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <div class="col-12 d-flex justify-content-center my-4">
            <a href="/user/dashboard" class="btn btn-outline-primary mx-4">Voltar</a>
        </div>
    </main>
</body>
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
</html>