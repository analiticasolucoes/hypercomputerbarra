<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alterar Usuário</title>
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
            <h2>Alteração de Usuário</h2>
            <p class="lead">Utilize o formulário abaixo para alterar um usuário cadastrado no sistema.</p>
        </header>
        <form id="add-form-user" action="/user/edit/form" method="post" class="form-group row">
            <input type="text" id="id" name="id" value="<?php echo $userToEdit->getId(); ?>" hidden>
            <div class="col-12 py-1">
                <label class="form-label fw-semibold" for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $userToEdit->getNome(); ?>" required>
                <span id="erro-nome" style="color: red;"></span>
            </div>
            <div class="col-12 py-1">
                <label class="form-label fw-semibold" for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $userToEdit->getEmail(); ?>" disabled>
            </div>
            <div class="form-check col-12 py-1 px-3">
                <label class="form-label fw-semibold" for="email-confirm">Perfil:</label>
                <div class="form-check col-12 py-1">    
                    <input class="form-check-input" type="radio" name="perfil" id="flexRadioDefault1" value="ADMINISTRADOR"<?php if($userToEdit->getPerfil() === "ADMINISTRADOR") echo "checked"; ?>>
                    <label class="form-check-label" for="flexRadioDefault1">
                    Administrador
                    </label>
                </div>
                <div class="form-check col-12 py-1">
                    <input class="form-check-input" type="radio" name="perfil" id="flexRadioDefault2" value="ATENDENTE"<?php if($userToEdit->getPerfil() === "ATENDENTE") echo "checked"; ?>>
                    <label class="form-check-label" for="flexRadioDefault2">
                    Atendente
                    </label>
                </div>
                <div class="form-check col-12 py-1">
                    <input class="form-check-input" type="radio" name="perfil" id="flexRadioDefault3" value="TECNICO"<?php if($userToEdit->getPerfil() === "TECNICO") echo "checked"; ?>>
                    <label class="form-check-label" for="flexRadioDefault3">
                    Técnico
                    </label>
                </div>
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold" for="gridCheck">Ativo:</label>
            </div>
            <div class="col-3 form-check form-check-inline">
                <input type="checkbox" class="form-check-input mx-1" id="ativo" name="ativo"<?php if($userToEdit->getAtivo()) echo "checked"; ?>>
                <label class="form-check-label" for="ativo">Ativo</label>
            </div>
            <div class="col-12 my-4 d-flex justify-content-center">
                <a class="btn btn-outline-primary mx-4" href="/user/list">Voltar</a>
                <button class="btn btn-primary" type="submit">Salvar</button>
            </div>
        </form>
    </main>
</body>
</html>
