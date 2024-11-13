<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adicionar Usuário</title>
    <base href="https://hypercomputerbarra.com.br/">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <main class="container pt-3">
        <header class="text-center">
            <h2>Cadastramento de Usuário</h2>
            <p class="lead">Utilize o formulário abaixo para cadastrar um novo usuário para acessar o sistema.</p>
        </header>
        <form id="add-form-user" action="/user/add/form" method="post" class="form-group row">
            <div class="col-12 py-1">
                <label class="form-label" for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
                <span id="erro-nome" style="color: red;"></span>
            </div>
            <div class="col-12 py-1">
                <label class="form-label" for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="col-12 py-1">
                <label class="form-label" for="email-confirm">Confirme o e-mail:</label>
                <input type="email" id="email-confirm" name="email-confirm" class="form-control" required>
                <span id="erro-email" style="color: red;"></span>
            </div>
            <div class="form-check col-12 py-1 px-3">
                <label class="form-label" for="email-confirm">Perfil:</label>
                <div class="form-check col-12 py-1">    
                    <input class="form-check-input" type="radio" name="perfil" id="flexRadioDefault1" value="ADMINISTRADOR" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                    Administrador
                    </label>
                </div>
                <div class="form-check col-12 py-1">
                    <input class="form-check-input" type="radio" name="perfil" id="flexRadioDefault2" value="ATENDENTE">
                    <label class="form-check-label" for="flexRadioDefault2">
                    Atendente
                    </label>
                </div>
                <div class="form-check col-12 py-1">
                    <input class="form-check-input" type="radio" name="perfil" id="flexRadioDefault3" value="TECNICO">
                    <label class="form-check-label" for="flexRadioDefault3">
                    Técnico
                    </label>
                </div>
            </div>
            <div class="col-12 my-4 d-flex justify-content-center">
                <a class="btn btn-outline-primary mx-4" href="/user/dashboard">Voltar</a>
                <button class="btn btn-primary" type="submit">Cadastrar</button>
            </div>
        </form>
    </main>
    <script>
        $(document).ready(function() {
            $('#nome').blur(function() {
                var nome = $(this).val();
                validarNome(nome);
            });

            $('#add-form-user').submit(function(event) {
                event.preventDefault(); // Impede o envio padrão do formulário
                var nome = $('#nome').val();
                validarNome(nome).then(function(isValid) {
                    if (isValid) {
                        $('#add-form-user')[0].submit(); // Envia o formulário se a validação for bem-sucedida
                    }
                });
            });

            function validarNome(nome) {
                return new Promise(function(resolve, reject) {
                    // Requisição AJAX para verificar se o nome já existe no banco de dados
                    $.ajax({
                        url: '/user/get/name',
                        method: 'POST',
                        data: { nome: nome },
                        success: function(response) {
                            if (response == 1) {
                                $('#erro-nome').text('Este nome de usuário já está em uso, informe um nome diferente para o usuário.');
                                console.log("ERRO: Ja existe um usuario no sistema com este nome!");
                                resolve(false);
                            } else {
                                $('#erro-nome').text('');
                                console.log("Nome de usuario válido!");
                                resolve(true);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Erro na requisição AJAX:', error);
                            reject(false);
                        }
                    });
                });
            }
        });
    </script>
    <script>
        document.getElementById('email-confirm').addEventListener('blur', function() {
            var email = document.getElementById('email').value;
            var confirmarEmail = this.value;
    
            if (email !== confirmarEmail) {
                document.getElementById('erro-email').innerText = 'Os e-mails não correspondem.';
            } else {
                document.getElementById('erro-email').innerText = '';
            }
        });
    </script>
</body>
</html>
