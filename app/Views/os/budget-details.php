<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Orçamento</title>
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
        <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0"></script>
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
        <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
            <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
            <symbol id="check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
        </svg>
        <main class="container pt-3">
            <header class="text-center">
                <h2>Orçamento - Ordem de Serviço</h2>
                <p class="lead">Utilize o formulário abaixo para informar o orçamento do equipamento.</p>
            </header>
            <section>
                <form class="form-group needs-validation row d-flex" id="os-budget-form" enctype="multipart/form-data" action="/os/budget/form" method="post" novalidate>
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
                            <div id="flush-collapseFour" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body row d-flex">
                                    <div class="col-12 PY-1 form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input mx-1" id="garantia" name="garantia">
                                        <label class="form-check-label" for="garantia">Garantia</label>
                                    </div>
                                    <div class="col-12 py-1">
                                        <label for="valor-servico" class="form-label fw-semibold">Valor do Serviço (R$):</label>
                                        <input type="text" class="form-control w-50" id="valor-servico" name="valor-servico" placeholder="0,00" inputmode="numeric" pattern="[0-9]*" value="{valor_servico}" onfocus="this.value=''" onchange="atualizarValorTotal()">
                                    </div>
                                    <div class="col-12 py-1">
                                        <label for="valor-pecas" class="form-label fw-semibold">Valor das Peças (R$):</label>
                                        <input type="text" class="form-control w-50" id="valor-pecas" name="valor-pecas" placeholder="0,00" inputmode="numeric" pattern="[0-9]*" value="{valor_peca}" onfocus="this.value=''" onchange="atualizarValorTotal()">
                                    </div>
                                    <div class="col-12 py-1">
                                        <label for="valor-total" class="form-label fw-semibold">Valor Total (R$):</label>
                                        <input type="text" class="form-control w-50" id="valor-total" name="valor-total" placeholder="0,00" inputmode="numeric" pattern="[0-9]*" value="{valor_total}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <div class="col-12 my-4 d-flex justify-content-center">
                <a href="javascript:window.history.back();" class="btn btn-outline-primary me-4">Voltar</a>
                <button type="button" id="cancel-button" class="btn btn-outline-warning me-4" data-order-id="{os_id}" onclick="$('#modalConfirmRecuse').modal('show')">Recusar</button>
                <button type="button" id="approve-button" class="btn btn-outline-primary me-4" data-order-id="{os_id}" data-modal-target="#modalConfirmApprove" onclick="validBudget(this)">Aprovar</button>
                <button type="button" id="submit-button" class="btn btn-primary" data-modal-target="#modalConfirmBudget" onclick="validBudget(this)">Enviar</button>
            </div>
        </main>
        <!-- Info Alert -->
        <div id="info-alert" class="alert alert-success alert-fixed-top text-center d-flex align-items-center justify-content-center d-none" role="alert">
            <svg class="bi flex-shrink-0 mx-4" role="img" aria-label="Success:" width="24" height="24"><use xlink:href="#check-circle-fill"/></svg>
            <div class="alert-message"></div>
        </div>
        <!-- Error Alert -->
        <div id="error-alert" class="alert alert-danger alert-fixed-top text-center d-flex align-items-center justify-content-center d-none" role="alert">
            <svg class="bi flex-shrink-0 mx-4" role="img" aria-label="Danger:" width="24" height="24"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div class="alert-message"></div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalConfirmApprove" tabindex="-1" aria-labelledby="modalConfirmApprove" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalConfirmApprove">Aprovar Orçamento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Deseja <strong>aprovar o orçamento</strong> para este equipamento?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" onclick="approveBudget({os_id})" >Aprovar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalConfirmRecuse" tabindex="-1" aria-labelledby="modalConfirmRecuse" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalConfirmRecuse">Recusar Orçamento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Deseja <strong>recusar o orçamento</strong> para este equipamento e <strong>cancelar a ordem de serviço</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-danger" onclick="recuseBudget()">Recusar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalConfirmBudget" tabindex="-1" aria-labelledby="modalConfirmBudget" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalConfirmBudget">Enviar Orçamento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Deseja <strong>enviar o orçamento</strong> deste equipamento para o cliente?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" onclick="submit()">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalChooseNextStep" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalChooseNextStep" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalChooseNextStep">Orçamento Aprovado</h1>
                    </div>
                    <div class="modal-body">
                        Orçamento aprovado com sucesso! Deseja <strong>avançar para a etapa de reparo</strong> agora?
                    </div>
                    <div class="modal-footer">
                        <a href="/user/dashboard" class="btn btn-secondary">Fechar</a>
                        <a id="modal-next-step-link" href="/os/repair/details?id={os_id}" class="btn btn-primary">Avançar</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        function converterParaFloat(valor) {
            // Remove os pontos de separação de milhares
            var valorSemPontos = valor.replace(/\./g, '');
            // Substitui a vírgula decimal por ponto
            var valorComPonto = valorSemPontos.replace(',', '.');

            return parseFloat(valorComPonto);
        }

        var cleaveServico = new Cleave('#valor-servico', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.',
            numeralDecimalScale: 2,
            numeralIntegerScale: null,
            numeralPositiveOnly: true,
            rawValueTrimPrefix: true,
        });
        var cleavePecas = new Cleave('#valor-pecas', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.',
            numeralDecimalScale: 2,
            numeralIntegerScale: null,
            numeralPositiveOnly: true,
            rawValueTrimPrefix: true,
        });

        function atualizarValorTotal() {
            // Obter valores brutos
            var valorServicoBruto = cleaveServico.getRawValue();
            var valorPecasBruto = cleavePecas.getRawValue();

            // Substituir vírgula por ponto para parseFloat
            var valorServico = parseFloat(valorServicoBruto.replace(',', '.')) || 0;
            var valorPecas = parseFloat(valorPecasBruto.replace(',', '.')) || 0;

            var total = valorServico + valorPecas;

            // Atualizar o campo valor-total
            document.getElementById('valor-total').value = total.toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            // Atualizar os campos valor-servico e valor-pecas
            document.getElementById('valor-servico').value = valorServico.toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            document.getElementById('valor-pecas').value = valorPecas.toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        // Adicionar evento de escuta para atualizar o valor total quando os campos mudarem
        document.getElementById('valor-servico').addEventListener('blur', atualizarValorTotal);
        document.getElementById('valor-pecas').addEventListener('blur', atualizarValorTotal);
        atualizarValorTotal();

        document.addEventListener('DOMContentLoaded', function() {
            let valorTotal = document.getElementById("valor-total").value;
            let approveButton = $('#approve-button');

            if(converterParaFloat(valorTotal) === 0.0) {
                approveButton.addClass('disabled');
            }
        });
    </script>
    <script>
        const errorAlert = $('#error-alert');
        const infoAlert = $('#info-alert');

        function showAlert(alertElement, alertMessage) {
            // Definir o conteúdo da mensagem de alerta
            alertElement.find('.alert-message').html(alertMessage);
            
            // Mostrar o alerta
            alertElement.removeClass('d-none').show();
            
            // Ocultar o alerta após 3 segundos
            setTimeout(function() {
                alertElement.fadeOut(function() {
                    alertElement.addClass('d-none');
                });
            }, 3000);
        }

        function hideAlert(alertElement) {
            alertElement.addClass('d-none').hide();
        }

        function validBudget(button) {
            let modalTarget = button.getAttribute("data-modal-target");
            let total = parseFloat(document.getElementById('valor-total').value);
            let garantiaCheck = document.getElementById("garantia");

            if (total <= 0.0 && !garantiaCheck.checked) {
                showAlert(errorAlert, 'É obrigatório <strong>informar um valor para peças ou serviço</strong> antes de salvar o orçamento.');
                return;
            } else {
                hideAlert(errorAlert);
                $(modalTarget).modal('show');
            }
        }

        function recuseBudget() {
            let orderId = document.getElementById('cancel-button').getAttribute('data-order-id');

            if (orderId) {
                fetch('/os/cancel', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: orderId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert(infoAlert, 'Orçamento recusado e ordem de serviço cancelada com sucesso.');
                        setTimeout(() => {
                            window.location.href = '/os/budget';
                        }, 3000);
                    } else {
                        showAlert(errorAlert, 'Erro ao recusar o orçamento para a ordem de serviço: ' + data.message);
                    }
                })
                .catch(error => console.error('Erro:', error));
            }
        }

        function approveBudget(orderId) {
            fetch('/os/budget/approve', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: orderId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        $('#modalChooseNextStep').modal('show');
                    } else {
                        showAlert(errorAlert, 'Erro ao aprovar o orçamento para a ordem de serviço: ' + data.message);
                    }
                })
                .catch(error => {
                    showAlert(errorAlert, 'Erro ao aprovar o orçamento: ' + error.message);
                    console.error('Erro:', error);
                });
        }

        function submit() {
            let form = document.getElementById('os-budget-form');

            // Criar um objeto FormData para armazenar os dados do formulário
            let formData = new FormData(form);

            // Converter FormData para um objeto JSON
            let formObject = {};
            formData.forEach((value, key) => {
                formObject[key] = value;
            });

            // Enviar os dados usando fetch
            fetch('/os/budget/form', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formObject)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $('#modalConfirmBudget').modal('hide');
                    showAlert(infoAlert, "Orçamento enviado com sucesso!");
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                } else {
                    showAlert(errorAlert, 'Erro ao enviar orçamento para o cliente: ' + data.message);
                }
            })
            .catch(error => console.error('Erro:', error));
        }
    </script>
</html>