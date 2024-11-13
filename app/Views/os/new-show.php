<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhar Ordem de Serviço</title>
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
        body {
            background-color: #fff;
        }
        .timeline::before {
            content: '';
            position: absolute;
            width: 4px;
            background-color: #ddd;
            top: 0;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
        .timeline-step {
            position: relative;
            width: 50%;
            padding: 10px 20px;
        }
        .timeline-step.left {
            left: 0;
        }
        .timeline-step.right {
            left: 50%;
        }
        .timeline-step .content {
            background-color: #fff;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 8px;
            position: relative;
        }
        .timeline-step .content::before {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            top: 50%;
            right: -20px;
            border: 10px solid #ddd;
        }
        .timeline-step.right .content::before {
            left: -20px;
            border-right-color: #ddd;
        }
        .timeline-step .marker {
            width: 25px;
            height: 25px;
            background-color: #fff;
            border: 4px solid #ddd;
            position: absolute;
            left: 100%;
            top: 49%;
            transform: translateX(-50%);
            border-radius: 50%;
            z-index: 1;
        }
        .timeline-step.right .marker {
            left: 0;
        }
        .completed .marker {
            border-color: #28a745;
        }
        .current .marker {
            border-color: #007bff;
        }
        .canceled .marker {
            border-color: #dc3545;
        }
        .timeline-step.completed .content {
            border: 2px solid #28a745;
        }
        .timeline-step.completed .content::before {
            border-color: #28a745;
        }
        .timeline-step.current .content {
            border: 2px solid #007bff;
        }
        .timeline-step.current .content::before {
            border-color: #007bff;
        }
        .timeline-step.canceled .content {
            border: 2px solid #dc3545;
        }
        .timeline-step.canceled .content::before {
            border-color: #dc3545;
        }
        .timeline-step.completed .timeline-step-status::before {
            content: "Concluído";
        }
        .timeline-step.current .timeline-step-status::before {
            content: "Em andamento";
        }
        .timeline-step:not(.completed):not(.current) .timeline-step-status::before {
            content: " ";
        }
        .timeline-step-status::before {
            display: block;
        }
    </style>
</head>
<body>
<main class="container pt-3">
    <header class="text-center">
        <h2>Detalhe - Ordem de Serviço</h2>
        <p class="lead">Visualize abaixo os detalhes da ordem de serviço e seu estágio atual.</p>
    </header>
    <section>
        <form class="form-group needs-validation row d-flex" id="os-add-form" enctype="multipart/form-data" action="/os/add/form" method="post" novalidate>
            <input type="text" class="form-control" id="id" name="id" value="{os_id}" hidden>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseZero" aria-expanded="false" aria-controls="flush-collapseZero">
                            <span class="fw-bold">Dados da Ordem de Serviço</span>
                        </button>
                    </h2>
                    <div id="flush-collapseZero" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body row d-flex">
                            <div class="col-12 py-1">
                                <label for="numero_os" class="form-label fw-semibold">Número OS:</label>
                                <input type="text" class="form-control w-auto" id="numero_os" name="numero_os" value="{os_id}" readonly>
                            </div>
                            <div class="col-12 py-1">
                                <label for="created_at" class="form-label fw-semibold">Data de Cadastramento:</label>
                                <input type="text" class="form-control w-auto" id="created_at" name="created_at" value="{created_at}" readonly>
                            </div>
                            <div class="col-12 py-1">
                                <label for="tipo_os" class="form-label fw-semibold">Tipo:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" {tipo_os_nova} disabled>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Nova
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" {tipo_os_garantia} disabled>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Garantia (OS Anterior: {id_os_anterior})
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <span class="fw-bold">Dados do Cliente</span>
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body row d-flex">
                            <div class="col-md-12">
                                <label for="nome" class="form-label fw-semibold">Nome Completo:</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{cliente_nome}" readonly>
                            </div>
                            <div class="col-sm-4 col-md-2 col-lg-2">
                                <label for="cpf" class="form-label fw-semibold">CPF:</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" value="{cliente_cpf}" readonly>
                            </div>
                            <div class="col-sm-4 col-md-2 col-lg-2">
                                <label for="data-nascimento" class="form-label fw-semibold">Data de Nascimento:</label>
                                <input type="text" class="form-control" id="data-nascimento" name="data-nascimento" value="{cliente_data_nascimento}" readonly>
                            </div>
                            <div class="col-sm-4 col-md-6 col-lg-8">
                                <label for="email" class="form-label fw-semibold">E-mail:</label>
                                <input type="text" class="form-control" id="email" name="email" value="{cliente_email}" readonly>
                            </div>
                            <div class="col-sm-4 col-md-6 col-lg-2">
                                <label for="celular" class="form-label fw-semibold">Celular:</label>
                                <input type="text" class="form-control" id="celular" name="celular" value="{cliente_celular}" readonly>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="gridCheck">Preferencia de contato:</label>
                            </div>
                            <div class="col-3 form-check form-check-inline">
                                <input type="checkbox" class="form-check-input mx-1" id="ligacao" name="ligacao" {preferencia_ligacao} disabled>
                                <label class="form-check-label" for="ligacao">Ligação</label>
                            </div>
                            <div class="col-2 form-check">
                                <input type="checkbox" class="form-check-input" id="mensagem" name="mensagem" {preferencia_mensagem} disabled>
                                <label class="form-check-label" for="mensagem">Mensagem</label>
                            </div>
                            <div class="col-sm-6 col-md-10 col-lg-10">
                                <label for="endereco" class="form-label fw-semibold">Endereço:</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" value="{cliente_rua}" readonly>
                            </div>
                            <div class="col-sm-6 col-md-2 col-lg-2">
                                <label for="numero" class="form-label fw-semibold">Número:</label>
                                <input type="text" class="form-control" id="numero" name="numero" value="{cliente_numero}" readonly>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="bairro" class="form-label fw-semibold">Bairro:</label>
                                <input type="text" class="form-control" id="bairro" name="bairro" value="{cliente_bairro}" readonly>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="complemento" class="form-label fw-semibold">Complemento:</label>
                                <input type="text" class="form-control" id="complemento" name="complemento" value="{cliente_complemento}" readonly>
                            </div>
                            <div class="col-6 py-1">
                                <label for="estado" class="form-label fw-semibold">Estado:</label>
                                <input type="text" class="form-control" id="estado" name="estado" value="{cliente_estado}" readonly>
                            </div>
                            <div class="col-6 py-1">
                                <label for="cidade" class="form-label fw-semibold">Cidade:</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" value="{cliente_cidade}" readonly>
                            </div>
                            <div class="col-md-2">
                                <label for="cep" class="form-label fw-semibold">CEP:</label>
                                <input type="text" class="form-control" id="cep" name="cep" value="{cliente_cep}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            <span class="fw-bold">Dados do Equipamento</span>
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body row d-flex">
                            <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                                <label for="tipo-equipamento" class="form-label fw-semibold">Equipamento:</label>
                                <input type="text" class="form-control" id="tipo-equipamento" name="tipo-equipamento" value="{equipamento_tipo}" readonly>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                                <label for="marca" class="form-label fw-semibold">Marca:</label>
                                <input type="text" class="form-control" id="marca" name="marca" value="{equipamento_marca}" readonly>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                                <label for="modelo" class="form-label fw-semibold">Modelo:</label>
                                <input type="text" class="form-control" id="modelo" name="modelo" value="{equipamento_modelo}" readonly>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 py-1">
                                <label for="serie" class="form-label fw-semibold">Série:</label>
                                <input type="text" class="form-control" id="serie" name="serie" value="{equipamento_serie}" readonly>
                            </div>
                            <div class="col-12 py-1">
                                <label for="firstName" class="form-label fw-semibold">Possue senha?</label>
                                <div class="form-check form-check-inline ms-3">
                                    <input class="form-check-input" type="checkbox" id="checkbox-senha" {equipamento_checkbox_senha} disabled>
                                    <label class="form-check-label" for="inlineCheckbox1">Sim</label>
                                </div>
                                <input type="text" class="form-control" id="senha" name="senha" value="{equipamento_senha}" readonly>
                            </div>
                            <div class="col-12 py-1">
                                <label for="acessorio" class="form-label fw-semibold">Acessório(s):</label>
                                <textarea class="form-control" id="acessorio" name="acessorio" style="height: 100px" readonly>{equipamento_acessorio}</textarea>
                            </div>
                            <div class="col-12 py-1">
                                <label for="observacao" class="form-label fw-semibold">Observação(ões):</label>
                                <textarea class="form-control" id="observacao" name="observacao" style="height: 100px" readonly>{equipamento_observacao}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTree" aria-expanded="false" aria-controls="flush-collapseTree">
                            <span class="fw-bold">Dados do Diagnóstico</span>
                        </button>
                    </h2>
                    <div id="flush-collapseTree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body row d-flex">
                            <div class="col-12 py-1">
                                <label for="diagnostico" class="form-label fw-semibold">Diagnóstico:</label>
                                <textarea class="form-control" id="diagnostico" name="diagnostico" style="height: 100px" readonly>{diagnostico}</textarea>
                            </div>
                            <div class="col-12 py-1">
                                <label for="solucao" class="form-label fw-semibold">Solução(ões):</label>
                                <textarea class="form-control" id="solucao" name="solucao" style="height: 100px" readonly>{solucao}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                            <span class="fw-bold">Dados do Orçamento</span>
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body row d-flex">
                            <div class="col-12 col-lg-4 py-1">
                                <label for="valor-pecas" class="form-label fw-semibold">Valor da(s) Peça(s):</label>
                                <input type="text" class="form-control w-50" id="valor-pecas" name="valor-pecas" value="{valor_peca}" readonly>
                            </div>
                            <div class="col-12 col-lg-4 py-1">
                                <label for="valor-servico" class="form-label fw-semibold">Valor do Serviço (Mão de Obra):</label>
                                <input type="text" class="form-control w-50" id="valor-servico" name="valor-servico" value="{valor_servico}" readonly>
                            </div>
                            <div class="col-12 col-lg-4 py-1">
                                <label for="valor-total" class="form-label fw-semibold">Valor Total:</label>
                                <input type="text" class="form-control w-50" id="valor-total" name="valor-total" value="{valor_total}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                            <span class="fw-bold">Dados do Reparo Executado</span>
                        </button>
                    </h2>
                    <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body row d-flex">
                            <div class="col-12 py-1">
                                <label for="reparo-pecas" class="form-label fw-semibold">Peça(s) Substituída(s):</label>
                                <textarea class="form-control" id="reparo-pecas" name="reparo-pecas" style="height: 100px" readonly></textarea>
                            </div>
                            <div class="col-12 py-1">
                                <label for="observacao" class="form-label fw-semibold">Observação(ões):</label>
                                <textarea class="form-control" id="observacao" name="observacao" style="height: 100px" readonly>{equipamento_observacao}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <h2 class="text-center" >Histórico da Ordem de Serviço</h2>
    <div class="timeline position-relative my-5">
        <div id="cancelamento-step" class="timeline-step right canceled {cancelamento_status}">
            <div class="content">
                <h3>Cancelamento</h3>
                <p class="timeline-step-status fw-semibold">
                    <span class="fw-semibold">Ordem de serviço cancelada em {updated_at}</span>
                </p>
            </div>
            <div class="marker"></div>
        </div>
        <div id="recebimento-step" class="timeline-step left {recebimento_status}">
            <div class="content">
                <h3>Recebimento</h3>
                <p class="timeline-step-status fw-semibold">
                    <span class="fw-semibold"></span>
                </p>
            </div>
            <div class="marker"></div>
        </div>
        <div id="diagnostico-step" class="timeline-step right {diagnostico_status}">
            <div class="content">
                <h3>Diagnóstico</h3>
                <p class="timeline-step-status fw-semibold">
                    <span class="fw-semibold"></span>
                </p>
                <div class="d-flex flex-column flex-lg-row">
                    <button type="button" class="btn btn-primary btn-sm mb-2 me-lg-1" onclick="window.location.href='/os/diagnosis/details?id={os_id}';">Acessar</button>
                </div>
            </div>
            <div class="marker"></div>
        </div>
        <div id="orcamento-step" class="timeline-step left {orcamento_status}">
            <div class="content">
                <h3>Orçamento</h3>
                <p class="timeline-step-status fw-semibold">
                    <span class="fw-semibold"></span>
                </p>
                <div class="d-flex flex-column flex-lg-row">
                    <button type="button" class="btn btn-primary btn-sm mb-2 me-lg-1" onclick="window.location.href='/os/budget/details?id={os_id}';">Acessar</button>
                </div>
            </div>
            <div class="marker"></div>
        </div>
        <div id="reparo-step" class="timeline-step right {reparo_status}">
            <div class="content">
                <h3>Reparo</h3>
                <p class="timeline-step-status fw-semibold">
                    <span class="fw-semibold"></span>
                </p>
                <div class="d-flex flex-column flex-lg-row">
                    <button type="button" class="btn btn-primary btn-sm mb-2 me-lg-1" onclick="window.location.href='os/repair/details?id={os_id}';">Acessar</button>
                </div>
            </div>
            <div class="marker"></div>
        </div>
        <div id="faturamento-step" class="timeline-step left {faturamento_status}">
            <div class="content">
                <h3>Faturamento</h3>
                <p class="timeline-step-status fw-semibold">
                    <span class="fw-semibold"></span>
                </p>
                <div class="d-flex flex-column flex-lg-row">
                    <button type="button" class="btn btn-outline-secondary btn-sm mb-2 me-lg-1 disabled">Imprimir Nota Fiscal</button>
                    <button type="button" class="btn btn-primary btn-sm mb-2 me-lg-1" onclick="window.location.href='os/charge/details?id={os_id}';">Faturar</button>
                </div>
            </div>
            <div class="marker"></div>
        </div>
        <div id="pagamento-step" class="timeline-step right {pagamento_status}">
            <div class="content">
                <h3>Pagamento</h3>
                <p class="timeline-step-status fw-semibold">
                    <span class="fw-semibold"></span>
                </p>
                <div class="d-flex flex-column flex-lg-row">
                    <button type="button" class="btn btn-primary btn-sm mb-2 me-lg-1" onclick="window.location.href='os/payment/details?id={os_id}';">Acessar</button>
                </div>
            </div>
            <div class="marker"></div>
        </div>
        <div id="liberacao-step" class="timeline-step left {liberacao_status}">
            <div class="content">
                <h3>Liberação</h3>
                <p class="timeline-step-status fw-semibold">
                    <span class="fw-semibold"></span>
                </p>
                <div class="d-flex flex-column flex-lg-row">
                    <button id="comprovante-entrega-button" type="button" class="btn btn-outline-secondary btn-sm mb-2 me-lg-1 disabled" onclick="window.location.href='os/receipt?id={os_id}';">Comprovante de Entrega</button>
                    <button id="certificado-garantia-button" type="button" class="btn btn-outline-secondary btn-sm mb-2 me-lg-1 disabled" onclick="window.location.href='os/warranty?id={os_id}';">Certificado de Garantia</button>
                    <button id="liberar-equipamento-button" type="button" class="btn btn-primary btn-sm mb-2 me-lg-1" onclick="window.location.href='os/release/details?id={os_id}';">Liberar Equipamento</button>
                </div>
            </div>
            <div class="marker"></div>
        </div>
        <div class="timeline-step right {finalizacao_status}">
            <div class="content">
                <h3>Finalização</h3>
                <p class="timeline-step-status fw-semibold">
                    <span class="fw-semibold"></span>
                </p>
            </div>
            <div class="marker"></div>
        </div>
    </div>
    <div class="col-12 my-4 d-flex justify-content-center">
        <a href="/user/dashboard" class="btn btn-outline-primary me-4">Dashboard</a>
        <a href="javascript:window.history.back();" class="btn btn-outline-primary">Voltar</a>
    </div>
    <!--Modal's-->
    <div class="modal fade" id="modalCancelOS" tabindex="-1" aria-labelledby="modalCancelOS" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalCancelOS">Cancelar Ordem de Serviço</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Você tem certeza que deseja cancelar esta ordem de serviço?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-danger" onclick='cancelOS({os_id})'>Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function cancelOS(id) {
        fetch('/os/cancel', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: id
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Ordem de serviço cancelada com sucesso.');
                    window.location.href = '/os/show?id='+id;
                } else {
                    alert('Erro ao cancelar a ordem de serviço: ' + data.message);
                }
            })
            .catch(error => console.error('Erro:', error));
    }
</script>
<script>
    /* Funcao que desabilita os botoes das etapas concluidas */
    $(document).ready(function() {
        $('.timeline-step').each(function() {
            if ($(this).hasClass('current')) {
                $(this).find('button').prop('disabled', false);
            } else {
                $(this).find('button').prop('disabled', true);
            }
        });
    });
    $(document).ready(function() {
        $('#liberacao-step').each(function() {
            var $step = $(this);
            if ($step.hasClass('completed')) {
                $step.find('#comprovante-entrega-button, #certificado-garantia-button').each(function() {
                    $(this).prop('disabled', false);
                    $(this).removeClass('disabled');
                });
            } else {
                $step.find('#comprovante-entrega-button, #certificado-garantia-button').each(function() {
                    $(this).prop('disabled', true);
                    $(this).addClass('disabled');
                });
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>