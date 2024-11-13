<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistemas de Ordens de Serviço">
    <meta name="author" content="Leandro Souza Ferreira">
    <title>Dashboard - Hyper Computer</title>
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
    <link href="../css/dashboard.css" rel="stylesheet">
</head>

<body data-bs-theme="light">
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
    </symbol>
    <symbol id="calendar3" viewBox="0 0 16 16">
        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
    </symbol>
    <symbol id="cart" viewBox="0 0 16 16">
        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </symbol>
    <symbol id="chevron-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
    </symbol>
    <symbol id="door-closed" viewBox="0 0 16 16">
        <path d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z" />
        <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z" />
    </symbol>
    <symbol id="file-earmark" viewBox="0 0 16 16">
        <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
    </symbol>
    <symbol id="file-earmark-zip" viewBox="0 0 16 16">
        <path d="M5 7.5a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v.938l.4 1.599a1 1 0 0 1-.416 1.074l-.93.62a1 1 0 0 1-1.11 0l-.929-.62a1 1 0 0 1-.415-1.074L5 8.438zm2 0H6v.938a1 1 0 0 1-.03.243l-.4 1.598.93.62.929-.62-.4-1.598A1 1 0 0 1 7 8.438z" />
        <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1h-2v1h-1v1h1v1h-1v1h1v1H6V5H5V4h1V3H5V2h1V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z" />
    </symbol>
    <symbol id="gear-wide-connected" viewBox="0 0 16 16">
        <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5zm0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065l.087-.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8 4.617 4.322zm.344 7.646.087.065-.087-.065z" />
    </symbol>
    <symbol id="graph-up" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z" />
    </symbol>
    <symbol id="house-fill" viewBox="0 0 16 16">
        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
    </symbol>
    <symbol id="list" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
    </symbol>
    <symbol id="people" viewBox="0 0 16 16">
        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
    </symbol>
    <symbol id="plus-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
    </symbol>
    <symbol id="puzzle" viewBox="0 0 16 16">
        <path d="M3.112 3.645A1.5 1.5 0 0 1 4.605 2H7a.5.5 0 0 1 .5.5v.382c0 .696-.497 1.182-.872 1.469a.459.459 0 0 0-.115.118.113.113 0 0 0-.012.025L6.5 4.5v.003l.003.01c.004.01.014.028.036.053a.86.86 0 0 0 .27.194C7.09 4.9 7.51 5 8 5c.492 0 .912-.1 1.19-.24a.86.86 0 0 0 .271-.194.213.213 0 0 0 .039-.063v-.009a.112.112 0 0 0-.012-.025.459.459 0 0 0-.115-.118c-.375-.287-.872-.773-.872-1.469V2.5A.5.5 0 0 1 9 2h2.395a1.5 1.5 0 0 1 1.493 1.645L12.645 6.5h.237c.195 0 .42-.147.675-.48.21-.274.528-.52.943-.52.568 0 .947.447 1.154.862C15.877 6.807 16 7.387 16 8s-.123 1.193-.346 1.638c-.207.415-.586.862-1.154.862-.415 0-.733-.246-.943-.52-.255-.333-.48-.48-.675-.48h-.237l.243 2.855A1.5 1.5 0 0 1 11.395 14H9a.5.5 0 0 1-.5-.5v-.382c0-.696.497-1.182.872-1.469a.459.459 0 0 0 .115-.118.113.113 0 0 0 .012-.025L9.5 11.5v-.003a.214.214 0 0 0-.039-.064.859.859 0 0 0-.27-.193C8.91 11.1 8.49 11 8 11c-.491 0-.912.1-1.19.24a.859.859 0 0 0-.271.194.214.214 0 0 0-.039.063v.003l.001.006a.113.113 0 0 0 .012.025c.016.027.05.068.115.118.375.287.872.773.872 1.469v.382a.5.5 0 0 1-.5.5H4.605a1.5 1.5 0 0 1-1.493-1.645L3.356 9.5h-.238c-.195 0-.42.147-.675.48-.21.274-.528.52-.943.52-.568 0-.947-.447-1.154-.862C.123 9.193 0 8.613 0 8s.123-1.193.346-1.638C.553 5.947.932 5.5 1.5 5.5c.415 0 .733.246.943.52.255.333.48.48.675.48h.238l-.244-2.855zM4.605 3a.5.5 0 0 0-.498.55l.001.007.29 3.4A.5.5 0 0 1 3.9 7.5h-.782c-.696 0-1.182-.497-1.469-.872a.459.459 0 0 0-.118-.115.112.112 0 0 0-.025-.012L1.5 6.5h-.003a.213.213 0 0 0-.064.039.86.86 0 0 0-.193.27C1.1 7.09 1 7.51 1 8c0 .491.1.912.24 1.19.07.14.14.225.194.271a.213.213 0 0 0 .063.039H1.5l.006-.001a.112.112 0 0 0 .025-.012.459.459 0 0 0 .118-.115c.287-.375.773-.872 1.469-.872H3.9a.5.5 0 0 1 .498.542l-.29 3.408a.5.5 0 0 0 .497.55h1.878c-.048-.166-.195-.352-.463-.557-.274-.21-.52-.528-.52-.943 0-.568.447-.947.862-1.154C6.807 10.123 7.387 10 8 10s1.193.123 1.638.346c.415.207.862.586.862 1.154 0 .415-.246.733-.52.943-.268.205-.415.39-.463.557h1.878a.5.5 0 0 0 .498-.55l-.001-.007-.29-3.4A.5.5 0 0 1 12.1 8.5h.782c.696 0 1.182.497 1.469.872.05.065.091.099.118.115.013.008.021.01.025.012a.02.02 0 0 0 .006.001h.003a.214.214 0 0 0 .064-.039.86.86 0 0 0 .193-.27c.14-.28.24-.7.24-1.191 0-.492-.1-.912-.24-1.19a.86.86 0 0 0-.194-.271.215.215 0 0 0-.063-.039H14.5l-.006.001a.113.113 0 0 0-.025.012.459.459 0 0 0-.118.115c-.287.375-.773.872-1.469.872H12.1a.5.5 0 0 1-.498-.543l.29-3.407a.5.5 0 0 0-.497-.55H9.517c.048.166.195.352.463.557.274.21.52.528.52.943 0 .568-.447.947-.862 1.154C9.193 5.877 8.613 6 8 6s-1.193-.123-1.638-.346C5.947 5.447 5.5 5.068 5.5 4.5c0-.415.246-.733.52-.943.268-.205.415-.39.463-.557H4.605z" />
    </symbol>
    <symbol id="search" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
    </symbol>
    <symbol id="topic" viewBox="0 0 16 16">
        <path d="M4 3.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5z" />
        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1" />
    </symbol>
    <symbol id="x-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
    </symbol>
    <symbol id="building" viewBox="0 0 16 16">
        <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z" />
        <path d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z" />
    </symbol>
    <symbol id="1-circle" viewBox="0 0 16 16">
        <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M9.283 4.002V12H7.971V5.338h-.065L6.072 6.656V5.385l1.899-1.383z" />
    </symbol>
    <symbol id="2-circle" viewBox="0 0 16 16">
        <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M6.646 6.24v.07H5.375v-.064c0-1.213.879-2.402 2.637-2.402 1.582 0 2.613.949 2.613 2.215 0 1.002-.6 1.667-1.287 2.43l-.096.107-1.974 2.22v.077h3.498V12H5.422v-.832l2.97-3.293c.434-.475.903-1.008.903-1.705 0-.744-.557-1.236-1.313-1.236-.843 0-1.336.615-1.336 1.306" />
    </symbol>
    <symbol id="3-circle" viewBox="0 0 16 16">
        <path d="M7.918 8.414h-.879V7.342h.838c.78 0 1.348-.522 1.342-1.237 0-.709-.563-1.195-1.348-1.195-.79 0-1.312.498-1.348 1.055H5.275c.036-1.137.95-2.115 2.625-2.121 1.594-.012 2.608.885 2.637 2.062.023 1.137-.885 1.776-1.482 1.875v.07c.703.07 1.71.64 1.734 1.917.024 1.459-1.277 2.396-2.93 2.396-1.705 0-2.707-.967-2.754-2.144H6.33c.059.597.68 1.06 1.541 1.066.973.006 1.6-.563 1.588-1.354-.006-.779-.621-1.318-1.541-1.318" />
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8" />
    </symbol>
    <symbol id="4-circle" viewBox="0 0 16 16">
        <path d="M7.519 5.057q.33-.527.657-1.055h1.933v5.332h1.008v1.107H10.11V12H8.85v-1.559H4.978V9.322c.77-1.427 1.656-2.847 2.542-4.265ZM6.225 9.281v.053H8.85V5.063h-.065c-.867 1.33-1.787 2.806-2.56 4.218" />
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8" />
    </symbol>
    <symbol id="5-circle" viewBox="0 0 16 16">
        <path d="M1 8a7 7 0 1 1 14 0A7 7 0 0 1 1 8m15 0A8 8 0 1 0 0 8a8 8 0 0 0 16 0m-8.006 4.158c-1.57 0-2.654-.902-2.719-2.115h1.237c.14.72.832 1.031 1.529 1.031.791 0 1.57-.597 1.57-1.681 0-.967-.732-1.57-1.582-1.57-.767 0-1.242.45-1.435.808H5.445L5.791 4h4.705v1.103H6.875l-.193 2.343h.064c.17-.258.715-.68 1.611-.68 1.383 0 2.561.944 2.561 2.585 0 1.687-1.184 2.806-2.924 2.806Z" />
    </symbol>
    <symbol id="change-email" viewBox="0 0 16 16">
        <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z" />
        <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648m-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z" />
    </symbol>
    <symbol id="change-senha" viewBox="0 0 16 16">
        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1" />
    </symbol>
    <symbol id="diagnosis" viewBox="0 0 16 16">
        <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z" />
        <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z" />
        <path d="M9.979 5.356a.5.5 0 0 0-.968.04L7.92 10.49l-.94-3.135a.5.5 0 0 0-.926-.08L4.69 10H4.5a.5.5 0 0 0 0 1H5a.5.5 0 0 0 .447-.276l.936-1.873 1.138 3.793a.5.5 0 0 0 .968-.04L9.58 7.51l.94 3.135A.5.5 0 0 0 11 11h.5a.5.5 0 0 0 0-1h-.128z" />
    </symbol>
    <symbol id="budget" viewBox="0 0 16 16">
        <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z" />
        <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118z" />
    </symbol>
    <symbol id="sort-down" viewBox="0 0 16 16">
        <path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z" />
    </symbol>
    <symbol id="sort-up" viewBox="0 0 16 16">
        <path d="M3.5 12.5a.5.5 0 0 1-1 0V3.707L1.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.5.5 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L3.5 3.707zm3.5-9a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z" />
    </symbol>
    <symbol id="cash-coin" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
        <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
        <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
    </symbol>
    <symbol id="arrow-left-short" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
    </symbol>
    <symbol id="arrow-right-short" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
    </symbol>
    <symbol id="report" viewBox="0 0 16 16">
        <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5" />
        <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
    </symbol>
    <symbol id="check-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
        <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
    </symbol>
    <symbol id="wallet" viewBox="0 0 16 16">
        <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
    </symbol>
    <symbol id="dash-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8" />
    </symbol>
    <symbol id="repair" viewBox="0 0 16 16">
        <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3q0-.405-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708M3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z"/>
    </symbol>
    <symbol id="message" viewBox="0 0 16 16">
        <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
        <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
    </symbol>
    <symbol id="telephone" viewBox="0 0 16 16">
        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
    </symbol>
</svg>

<header class="navbar sticky-top bg-primary flex-md-nowrap py-2 mb-1 ps-3 shadow">
    <h4 class="text-white py-1 m-0">Ordens de Serviço</h4>
    <ul class="navbar-nav flex-row d-md-none">
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <svg class="bi">
                    <use xlink:href="#list" />
                </svg>
            </button>
        </li>
    </ul>
</header>
<div class="container-fluid">
    <div class="row">
        <aside class="sidebar border border-right col-lg-2 p-0 bg-body-tertiary">
            <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarMenuLabel">Dashboard - <?php echo $perfil; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                    <ul class="nav flex-column bg-body-tertiary">
                        <li class="nav-item ms-3 bg-body-tertiary">
                            <div class="accordion accordion-flush bg-body-tertiary" id="accordionFlushExample">
                                <div class="accordion-item bg-body-tertiary">
                                    <h2 class="accordion-header bg-body-tertiary">
                                        <button class="accordion-button bg-body-tertiary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            <svg class="bi me-2">
                                                <use xlink:href="#topic" />
                                            </svg>
                                            Ordens de Serviço
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="/os/add/step/1">
                                                <svg class="bi">
                                                    <use xlink:href="#plus-circle" />
                                                </svg>
                                                Nova
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="/os/diagnosis">
                                                <svg class="bi">
                                                    <use xlink:href="#diagnosis" />
                                                </svg>
                                                Diagnóstico
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="/os/budget">
                                                <svg class="bi">
                                                    <use xlink:href="#budget" />
                                                </svg>
                                                Orçamento
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="/os/repair">
                                                <svg class="bi">
                                                    <use xlink:href="#repair" />
                                                </svg>
                                                Reparo
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="/os/charge">
                                                <svg class="bi">
                                                    <use xlink:href="#cash-coin" />
                                                </svg>
                                                Faturamento
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="/os/payment">
                                                <svg class="bi">
                                                    <use xlink:href="#wallet" />
                                                </svg>
                                                Pagamento
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="/os/release">
                                                <svg class="bi">
                                                    <use xlink:href="#check-circle" />
                                                </svg>
                                                Liberar
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="/os/canceled">
                                                <svg class="bi">
                                                    <use xlink:href="#x-circle" />
                                                </svg>
                                                Canceladas
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="/os/search">
                                                <svg class="bi">
                                                    <use xlink:href="#search" />
                                                </svg>
                                                Pesquisar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item bg-body-tertiary">
                                    <h2 class="accordion-header bg-body-tertiary">
                                        <button class="accordion-button bg-body-tertiary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTree" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            <svg class="bi me-2">
                                                <use xlink:href="#building" />
                                            </svg>
                                            Clientes
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="/client/add">
                                                <svg class="bi">
                                                    <use xlink:href="#plus-circle" />
                                                </svg>
                                                Novo
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="/client/search">
                                                <svg class="bi">
                                                    <use xlink:href="#search" />
                                                </svg>
                                                Pesquisar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item bg-body-tertiary">
                                    <h2 class="accordion-header bg-body-tertiary">
                                        <button class="accordion-button bg-body-tertiary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            <svg class="bi me-2">
                                                <use xlink:href="#file-earmark" />
                                            </svg>
                                            Relatórios
                                        </button>
                                    </h2>
                                    <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">

                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="#" onclick="openModal('/os/report/repair-cost')" data-route="/os/report/repair-cost" data-bs-toggle="modal" data-bs-target="#modalPeriodoRelatorio">
                                                <svg class="bi">
                                                    <use xlink:href="#report" />
                                                </svg>
                                                Custo de reparo
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="#" onclick="openModal('/os/report/technical-performance')" data-route="/os/report/technical-performance" data-bs-toggle="modal" data-bs-target="#modalPeriodoRelatorio">
                                                <svg class="bi">
                                                    <use xlink:href="#report" />
                                                </svg>
                                                Desempenho técnico
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="#" onclick="openModal('/os/report/os-status')" data-route="/os/report/os-status" data-bs-toggle="modal" data-bs-target="#modalPeriodoRelatorio">
                                                <svg class="bi">
                                                    <use xlink:href="#report" />
                                                </svg>
                                                Status das OS
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="#" onclick="openModal('/os/report/customer-os')" data-route="/os/report/customer-os" data-bs-toggle="modal" data-bs-target="#modalPeriodoRelatorio">
                                                <svg class="bi">
                                                    <use xlink:href="#report" />
                                                </svg>
                                                OS por cliente
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="#" onclick="openModal('/os/report/payments')" data-route="/os/report/payments" data-bs-toggle="modal" data-bs-target="#modalPeriodoRelatorio">
                                                <svg class="bi">
                                                    <use xlink:href="#report" />
                                                </svg>
                                                Pagamentos
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="#" onclick="openModal('/os/report/birthdays')" data-route="/os/report/birthdays" data-bs-toggle="modal" data-bs-target="#modalPeriodoRelatorio">
                                                <svg class="bi">
                                                    <use xlink:href="#report" />
                                                </svg>
                                                Aniversariantes
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <hr class="my-3">

                    <ul class="nav flex-column ms-3 mb-auto">
                        <?php if($perfil === "Administrador"):?>
                        <li class="nav-item">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item bg-body-tertiary">
                                    <h2 class="accordion-header bg-body-tertiary">
                                        <button class="accordion-button bg-body-tertiary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            <svg class="bi me-2">
                                                <use xlink:href="#people" />
                                            </svg>
                                            Usuários
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="/user/add">
                                                <svg class="bi">
                                                    <use xlink:href="#plus-circle" />
                                                </svg>
                                                Novo
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="/user/list">
                                                <svg class="bi">
                                                    <use xlink:href="#search" />
                                                </svg>
                                                Ver todos
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item bg-body-tertiary">
                                    <h2 class="accordion-header bg-body-tertiary">
                                        <button class="accordion-button bg-body-tertiary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseOne">
                                            <svg class="bi me-2">
                                                <use xlink:href="#gear-wide-connected" />
                                            </svg>
                                            Configurações
                                        </button>
                                    </h2>
                                    <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="/user/change_password">
                                                <svg class="bi">
                                                    <use xlink:href="#change-senha" />
                                                </svg>
                                                Alterar senha
                                            </a>
                                            <a class="nav-link d-flex align-items-center text-bg-light gap-2 h6" href="/user/change_email">
                                                <svg class="bi">
                                                    <use xlink:href="#change-email" />
                                                </svg>
                                                Alterar e-mail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item pb-3">
                            <a class="nav-link d-flex align-items-center gap-2 link-dark" href="/logout">
                                <svg class="bi">
                                    <use xlink:href="#door-closed" />
                                </svg>
                                Sair
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <main class="ms-sm-auto col-lg-10 px-md-4 bg-body" style="background-color: #ECECEC;">
            <div class="d-flex flex-wrap flex-md-nowrap justify-content-between pt-3 pb-2 mb-3 border-bottom">
                <h2 class="fs-5 text text-center">Dashboard - <?php echo $perfil; ?></h2><br>
                <h3 class="fs-5 text"> Seja bem-vindo, <?php echo $username; ?></h3>
            </div>
            <div class="table-responsive small border rounded p-2 mb-2 bg-body">
                <div class="btn-toolbar d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="text-dark">Ordens de Serviço recentes</h2>
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary disabled">Exportar</button>
                    </div>
                </div>
                <table id="tabela" class="table table-hover table-sm align-middle pb-2">
                    <thead>
                    <tr>
                        <th scope="col">
                            Criado em
                            <svg class="bi">
                                <use xlink:href="#sort-down" />
                            </svg>
                        </th>
                        <th scope="col">
                            Nº OS
                            <svg class="bi">
                                <use xlink:href="#sort-down" />
                            </svg>
                        </th>
                        <th scope="col">
                            Contato
                            <svg class="bi d-none">
                                <use xlink:href="#sort-down" />
                            </svg>
                        </th>
                        <th scope="col">
                            Cliente
                            <svg class="bi">
                                <use xlink:href="#sort-down" />
                            </svg>
                        </th>
                        <th scope="col">
                            Equipamento
                            <svg class="bi">
                                <use xlink:href="#sort-down" />
                            </svg>
                        </th>
                        <th scope="col">
                            Estágio
                            <svg class="bi">
                                <use xlink:href="#sort-down" />
                            </svg>
                        </th>
                        <th scope="col">
                            Status
                            <svg class="bi">
                                <use xlink:href="#sort-down" />
                            </svg>
                        </th>
                        <th scope="col">
                            Nº dias
                            <svg class="bi">
                                <use xlink:href="#sort-down" />
                            </svg>
                        </th>
                        <th scope="col">
                            Valor (R$)
                            <svg class="bi">
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
                    <?php
                    if (@$listaOS) :
                        foreach ($listaOS as $os) :
                            ?>
                            <tr class="p-2">
                                <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/os/show?id=<?php echo $os['id']; ?>"><?php echo $os['created_at']; ?></td>
                                <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/os/show?id=<?php echo $os['id']; ?>"><?php echo $os['id']; ?></td>
                                <td class="p-2">
                                    <a class="d-inline-block" data-bs-toggle="tooltip" data-bs-title="<?= $os['tooltipMessage']?>">
                                        <svg width="16" height="16">
                                            <use xlink:href="#message" />
                                        </svg>
                                    </a>
                                    <a class="d-inline-block" data-bs-toggle="tooltip" data-bs-title="<?= $os['tooltipTelephone']?>">
                                        <svg width="16" height="16">
                                            <use xlink:href="#telephone" />
                                        </svg>
                                    </a>
                                </td>
                                <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/os/show?id=<?php echo $os['id']; ?>"><?php echo $os['cliente']; ?></td>
                                <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/os/show?id=<?php echo $os['id']; ?>"><?php echo $os['equipamento']; ?></td>
                                <td class="p-2"><a class="link-dark link-underline link-underline-opacity-0" href="/os/show?id=<?php echo $os['id']; ?>">
                                    <?php if ($os['estagio'] == "CADASTRADO") : ?>
                                    <span class="badge bg-color-one">
                                        Aguardando Diagnóstico
                                    <?php endif; ?>
                                    <?php if ($os['estagio'] == "DIAGNOSTICADO") : ?>
                                    <span class="badge bg-color-two">
                                        Aguardando Orçamento
                                    <?php endif; ?>
                                    <?php if ($os['estagio'] == "ORCADO") : ?>
                                    <span class="badge bg-color-tree">
                                        Aguardando Reparo
                                    <?php endif; ?>
                                    <?php if ($os['estagio'] == "REPARADO") : ?>
                                    <span class="badge bg-color-four">
                                        Aguardando Faturamento
                                    <?php endif; ?>
                                    <?php if ($os['estagio'] == "FATURADO") : ?>
                                    <span class="badge bg-color-seven">
                                        Aguardando Pagamento
                                    <?php endif; ?>
                                    <?php if ($os['estagio'] == "PAGO") : ?>
                                    <span class="badge bg-color-six">
                                        Aguardando Liberação
                                    <?php endif; ?>
                                    <?php if ($os['estagio'] == "CONCLUIDO") : ?>
                                    <span class="badge bg-color-five">
                                        Concluído
                                    <?php endif; ?>
                                        <?php if ($os['estagio'] == "CANCELADO") : ?>
                                    <span class="badge bg-color-nine">
                                        Cancelada
                                    <?php endif; ?>
                                    </span>
                                </td>
                                <td class="p-2">
                                    <a class="link-dark link-underline link-underline-opacity-0" href="/os/show?id=<?php echo $os['id']; ?>">
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
                                    </a>
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
            </div>
            <div class="container-fluid">
                <div class="row d-flex align-items-center justify-content-end">
                    <div class="col-12 col-md-12 pb-2 py-0 mb-2 border rounded bg-body">
                        <label for="dateRange"><strong>Período:</strong></label>
                        <select class="form-select w-auto" id="dateRange" onchange="updateStatistics(this.value)">
                            <option value="15">Últimos 15 dias</option>
                            <option value="30">Últimos 30 dias</option>
                            <option value="90">Últimos 3 meses</option>
                            <option value="180">Últimos 6 meses</option>
                            <option value="365">Últimos 12 meses</option>
                        </select>
                    </div>
                </div>
                <div class="row d-flex align-items-center justify-content-between">
                    <div class="col-12 col-md-4 pb-2 py-0 mb-2 border rounded bg-body">
                        <h3 class="text-center fw-semibold">OS</h3>
                        <h5 class="text-center fw-semibold">por Estágio</h5>
                        <canvas class="align-self-center" id="chart-donut"></canvas>
                    </div>
                    <div class="col-12 col-md-4 pb-2 py-0 mb-2 border rounded bg-body">
                        <h3 class="text-center fw-semibold">OS</h3>
                        <h5 class="text-center fw-semibold">por Status</h5>
                        <canvas class="align-self-center" id="chart-polar"></canvas>
                    </div>
                    <div class="col-12 col-md-4 pb-2 py-0 mb-2 border rounded bg-body">
                        <h3 class="text-center fw-semibold">OS</h3>
                        <h5 class="text-center fw-semibold">Orçamentos</h5>
                        <canvas class="align-self-center" id="chart-pizza"></canvas>
                    </div>
                </div>
                <div class="row d-flex align-items-stretch justify-content-between">
                    <div class="col-12 col-md-4 p-0 mb-2 rounded bg-body">
                        <div class="card h-100">
                            <div id="card-custo-medio" class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <h4 class="card-text"><strong>R$ 0,00</strong></h4>
                                <h5 class="card-title">Custo médio</h5>
                                <h6>por ordem de serviço</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 p-0 mb-2 rounded bg-body">
                        <div class="card h-100">
                            <div id="card-total-servicos" class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <h4 class="card-text"><strong>R$ 0,00</strong></h4>
                                <h5 class="card-title">Valor Total de Serviços</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 p-0 mb-2 rounded bg-body">
                        <div class="card h-100">
                            <div id="card-total-pecas" class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <h4 class="card-text"><strong>R$ 0,00</strong></h4>
                                <h5 class="card-title">Valor Total de Peças</h5>
                            </div>
                        </div>
                    </div>
                    </div>
                <div class="row d-flex align-items-stretch justify-content-between">
                    <div class="col-12 col-md-4 p-0 mb-2">
                        <div class="card h-100">
                            <div id="card-media-atendimento" class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <h4 class="card-text"><strong>0</strong></h4>
                                <p class="card-text pt-0"><strong>dias úteis</strong></p>
                                <h5 class="card-title"><span class="text-center fs-5">Tempo Médio</span></h5>
                                <h6>de Atendimento</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 p-0 mb-2 rounded bg-body">
                        <div class="card h-100">
                            <div id="card-taxa-conclusao" class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <h4 class="card-text"><strong>0%</strong></h4>
                                <h5 class="card-title">Taxa de conclusão</h5>
                                <h6>dentro do prazo</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 p-0 mb-2 rounded bg-body">
                        <div class="card h-100">
                            <div id="card-taxa-cancelamento" class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <h4 class="card-text"><strong>0%</strong></h4>
                                <h5 class="card-title">Taxa de cancelamento</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-12 border rounded bg-body">
                        <h3 class="text-center pt-2 fw-semibold">Ordens de Serviço cadastradas</h3>
                        <h4 class="text-center">últimos 6 meses</h4>
                        <canvas class="align-self-center p-2" id="chart-bar"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<footer>
    <div class="container-fluid row d-flex justify-content-between p-4">
        <div class="col-6 text-center">Copyright © 2024 | Todos os direitos reservados.</div>
        <div class="col-6 text-center">Desenvolvido por <strong><a class="link-underline link-underline-opacity-0" href="https://analiticasolucoes.com.br" target="_blank">Analitica Soluções</a></strong></div>
    </div>
</footer>
<!-- Modal -->
<div class="modal fade" id="modalPeriodoRelatorio" tabindex="-1" aria-labelledby="modalPeriodoRelatorio" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content w-auto">
            <div class="modal-header">
                <h3 class="modal-title">Período do Relatório</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex row justify-content-center">
                <div class="row">
                    <div class="col-12">
                        <p>Use as caixas de seleção abaixo para informar o período desejado no relatório:</p>
                    </div>
                </div>
                <div class="row d-flex flex-row justify-content-center">
                    <div id="date-picker-start" class="col-12 col-md-4 border rounded mb-3 w-auto">
                        <div id="calendar-header" class="align-items-end mt-2 mb-2">
                            <h4 class="text-center">Data inicial</h4>
                        </div>
                        <div id="calendar-header-start" class="d-flex flex-row align-items-baseline justify-content-between mb-2">
                            <button class="btn btn-primary me-2" onclick="changeMonth('start', -1)">
                                <svg class="bi">
                                    <use xlink:href="#arrow-left-short" />
                                </svg>
                            </button>
                            <h5 id="month-year-start" class="month-year d-inline mx-2"></h5>
                            <button class="btn btn-primary ms-2" onclick="changeMonth('start', 1)">
                                <svg class="bi">
                                    <use xlink:href="#arrow-right-short" />
                                </svg>
                            </button>
                        </div>
                        <div id="calendar-start"></div>
                    </div>
                    <div id="date-picker-end" class="col-12 col-md-4 border rounded mb-2 w-auto">
                        <div id="calendar-header" class="align-items-end mt-2 mb-2">
                            <h4 class="text-center">Data final</h4>
                        </div>
                        <div id="calendar-header-end" class="d-flex flex-row align-items-center justify-content-between mb-2">
                            <button class="btn btn-primary me-2" onclick="changeMonth('end', -1)">
                                <svg class="bi">
                                    <use xlink:href="#arrow-left-short" />
                                </svg>
                            </button>
                            <h5 id="month-year-end" class="month-year d-inline mx-2"></h5>
                            <button class="btn btn-primary ms-2" onclick="changeMonth('end', 1)">
                                <svg class="bi">
                                    <use xlink:href="#arrow-right-short" />
                                </svg>
                            </button>
                        </div>
                        <div id="calendar-end"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button id="submit-button" type="button" class="btn btn-primary" onclick="submitDates()">Gerar Relatório</button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous"></script>
<script src="https://getbootstrap.com/docs/5.3/examples/dashboard/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    const today = new Date();
    const calendars = {
        start: {
            currentYear: today.getFullYear(),
            currentMonth: today.getMonth(),
            selectedDayElement: null,
            selectedDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
            divId: 'date-picker-start',
            headerId: 'month-year-start',
            calendarId: 'calendar-start'
        },
        end: {
            currentYear: today.getFullYear(),
            currentMonth: today.getMonth(),
            selectedDayElement: null,
            selectedDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
            divId: 'date-picker-end',
            headerId: 'month-year-end',
            calendarId: 'calendar-end'
        }
    };

    const monthNames = [
        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
    ];

    let reportRoute = ""; // Variável global para armazenar a rota do relatório

    function openModal(route) {
        reportRoute = route; // Definindo a rota do relatório
        $('#modalPeriodoRelatorio').modal('show');
    }

    function updateHeader(calendarType) {
        const calendar = calendars[calendarType];
        const monthYear = document.getElementById(calendar.headerId);
        monthYear.innerText = `${monthNames[calendar.currentMonth]} ${calendar.currentYear}`;
    }

    function generateCalendar(calendarType) {
        const calendar = calendars[calendarType];
        const calendarElement = document.getElementById(calendar.calendarId);

        calendarElement.innerHTML = ''; // Limpar calendário anterior
        const table = document.createElement('table');
        table.classList.add('calendar-table', 'table', 'table-bordered');

        const daysOfWeek = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
        let tr = document.createElement('tr');

        // Cabeçalho com os dias da semana
        for (let day of daysOfWeek) {
            let th = document.createElement('th');
            th.innerText = day;
            tr.appendChild(th);
        }
        table.appendChild(tr);

        const firstDayOfMonth = new Date(calendar.currentYear, calendar.currentMonth, 1).getDay();
        const lastDateOfMonth = new Date(calendar.currentYear, calendar.currentMonth + 1, 0).getDate();
        const lastDayOfLastMonth = new Date(calendar.currentYear, calendar.currentMonth, 0).getDate();

        tr = document.createElement('tr');
        let dayCount = 0;

        // Dias do mês anterior
        for (let i = firstDayOfMonth; i > 0; i--) {
            let td = document.createElement('td');
            td.innerText = lastDayOfLastMonth - i + 1;
            td.classList.add('prev-month');
            tr.appendChild(td);
            dayCount++;
        }

        // Dias do mês atual
        for (let i = 1; i <= lastDateOfMonth; i++) {
            if (dayCount === 7) {
                table.appendChild(tr);
                tr = document.createElement('tr');
                dayCount = 0;
            }
            let td = document.createElement('td');
            td.innerText = i;

            const currentDate = new Date(calendar.currentYear, calendar.currentMonth, i);
            if (currentDate > today) {
                td.classList.add('future-day');
            } else {
                td.classList.add('current-month');
                td.onclick = function() {
                    selectDay(calendarType, td, i);
                };
                // Definir data atual como selecionada
                if (currentDate.toDateString() === today.toDateString() && calendar.selectedDate === null) {
                    td.classList.add('selected');
                    calendar.selectedDayElement = td;
                    calendar.selectedDate = currentDate;
                }
            }

            tr.appendChild(td);
            dayCount++;
        }

        // Dias do mês seguinte
        let nextMonthDay = 1;
        while (dayCount > 0 && dayCount < 7) {
            let td = document.createElement('td');
            td.innerText = nextMonthDay++;
            td.classList.add('next-month');
            tr.appendChild(td);
            dayCount++;
        }
        table.appendChild(tr);

        calendarElement.appendChild(table);
        updateHeader(calendarType);
    }

    function selectDay(calendarType, td, day) {
        const calendar = calendars[calendarType];
        if (calendar.selectedDayElement) {
            calendar.selectedDayElement.classList.remove('selected');
        }
        if (calendar.selectedDayElement === td) {
            calendar.selectedDayElement = null;
            calendar.selectedDate = null;
        } else {
            td.classList.add('selected');
            calendar.selectedDayElement = td;
            calendar.selectedDate = new Date(calendar.currentYear, calendar.currentMonth, day);
        }
    }

    function changeMonth(calendarType, delta) {
        const calendar = calendars[calendarType];
        calendar.currentMonth += delta;
        if (calendar.currentMonth > 11) {
            calendar.currentMonth = 0;
            calendar.currentYear++;
        } else if (calendar.currentMonth < 0) {
            calendar.currentMonth = 11;
            calendar.currentYear--;
        }
        generateCalendar(calendarType);
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        const year = date.getFullYear();
        const month = ('0' + (date.getMonth() + 1)).slice(-2);
        const day = ('0' + date.getDate()).slice(-2);
        const hours = ('0' + date.getHours()).slice(-2);
        const minutes = ('0' + date.getMinutes()).slice(-2);
        const seconds = ('0' + date.getSeconds()).slice(-2);
        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }

    function submitDates() {
        const startDate = calendars.start.selectedDate;
        const endDate = calendars.end.selectedDate;

        if (!startDate || !endDate) {
            alert("Por favor, selecione ambas as datas.");
            return;
        }

        if (startDate > endDate) {
            alert("A data inicial deve ser anterior à data final.");
            return;
        }

        if (!reportRoute) {
            alert("Rota do relatório não definida.");
            return;
        }

        const formattedStartDate = formatDate(startDate);
        const formattedEndDate = formatDate(endDate);

        fetch(reportRoute, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                formattedStartDate,
                formattedEndDate
            })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao obter resposta do servidor.');
                }

                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    throw new Error('Resposta do servidor não esperada.');
                }
            })
            .then(data => {
                if (Object.keys(data).length === 0) {
                    // JSON vazio, mostrar mensagem de alerta
                    alert("Não existe relatório disponível para os dados informados! Altere o período desejado e tente novamente.");
                } else if (data.filePath) {
                    // Fazer o download do arquivo usando o caminho fornecido
                    const downloadUrl = '/file/download?path='+data.filePath + '/' + data.fileName;
                    window.location.href = downloadUrl;
                } else {
                    throw new Error('Caminho do arquivo não encontrado na resposta.');
                }
            })
            .catch(error => {
                alert("Ocorreu um erro ao processar a requisição.");
                console.error(error);
            });
    }

    // Gerar calendários para o mês atual
    generateCalendar('start');
    generateCalendar('end');
</script>
<script>
    const chartDonut = document.getElementById('chart-donut').getContext('2d');
    const chartPolar = document.getElementById('chart-polar').getContext('2d');
    const chartPizza = document.getElementById('chart-pizza').getContext('2d');

    let donutChart;
    let polarChart;
    let pizzaChart;

    function createDonutChart(data) {
        if (donutChart) {
            donutChart.destroy();
        }

        donutChart = new Chart(chartDonut, {
            type: 'doughnut',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Qtd OS',
                    data: data.data,
                    backgroundColor: [
                        'rgb(13, 110, 253)',
                        'rgb(214, 51, 132)',
                        'rgb(102, 16, 242)',
                        'rgb(220, 53, 69)',
                        'rgb(253, 126, 20)',
                        'rgb(111, 66, 193)',
                        'rgb(255, 193, 7)',
                        'rgb(25, 135, 84)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    function createPolarChart(data) {
        if (polarChart) {
            polarChart.destroy();
        }

        polarChart = new Chart(chartPolar, {
            type: 'polarArea',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'OS por Status',
                    data: data.data,
                    backgroundColor: [
                        'rgb(255,193,7)', //Amarelo
                        'rgb(13,110,253)', //Azul
                        'rgb(220,53,69)', //Vermelho
                        'rgb(25,135,84)' //Verde
                    ]
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    function createPizzaChart(data) {
        if (pizzaChart) {
            pizzaChart.destroy();
        }

        pizzaChart = new Chart(chartPizza, {
            type: 'pie',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Qtd Orçamentos',
                    data: data.data,
                    backgroundColor: [
                        'rgb(212, 42, 42)', //Vermelho
                        'rgb(64, 128, 190)', //Azul
                        'rgb(255, 205, 86)' //Amarelo
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    function createMediaAtendimento(data) {
        document.getElementById('card-media-atendimento').querySelector('h4').innerHTML = "<strong>" + Math.round(data.data) + "</strong>";
    }

    function createTaxaConclusao(data) {
        const taxaConclusao = parseFloat(data.data);
        document.getElementById('card-taxa-conclusao').querySelector('h4').innerHTML = "<strong>" + taxaConclusao.toFixed(1) + "%</strong>";
    }

    function createTaxaCancelamento(data) {
        const taxaCancelamento = parseFloat(data.data);
        document.getElementById('card-taxa-cancelamento').querySelector('h4').innerHTML = "<strong>" + taxaCancelamento.toFixed(1) + "%</strong>";
    }

    function createCustoMedio(data) {
        const custoMedio = parseFloat(data.data);
        document.getElementById('card-custo-medio').querySelector('h4').innerHTML = "<strong>R$ " + custoMedio.toFixed(2) + "</strong>";
    }

    function createTotalServicos(data) {
        const totalServicos = parseFloat(data.data);
        document.getElementById('card-total-servicos').querySelector('h4').innerHTML = "<strong>R$ " + totalServicos.toFixed(2) + "</strong>";
    }

    function createTotalPecas(data) {
        const totalPecas = parseFloat(data.data);
        document.getElementById('card-total-pecas').querySelector('h4').innerHTML = "<strong>R$ " + totalPecas.toFixed(2) + "</strong>";
    }

    function updateChart(chartType, selectedValue) {
        let url;
        let createChartFunction;

        switch (chartType) {
            case 'donut':
                url = `../os/statistics/donut?periodo=${selectedValue}`;
                createChartFunction = createDonutChart;
                break;
            case 'polar':
                url = `../os/statistics/polar?periodo=${selectedValue}`;
                createChartFunction = createPolarChart;
                break;
            case 'pizza':
                url = `../os/statistics/pizza?periodo=${selectedValue}`;
                createChartFunction = createPizzaChart;
                break;
            case 'media-atendimento':
                url = `../os/statistics/media-atendimento?periodo=${selectedValue}`;
                createChartFunction = createMediaAtendimento;
                break;
            case 'taxa-conclusao':
                url = `../os/statistics/taxa-conclusao?periodo=${selectedValue}`;
                createChartFunction = createTaxaConclusao;
                break;
            case 'taxa-cancelamento':
                url = `../os/statistics/taxa-cancelamento?periodo=${selectedValue}`;
                createChartFunction = createTaxaCancelamento;
                break;
            case 'custo-medio':
                url = `../os/statistics/custo-medio?periodo=${selectedValue}`;
                createChartFunction = createCustoMedio;
                break;
            case 'total-servicos':
                url = `../os/statistics/total-servicos?periodo=${selectedValue}`;
                createChartFunction = createTotalServicos;
                break;
            case 'total-pecas':
                url = `../os/statistics/total-pecas?periodo=${selectedValue}`;
                createChartFunction = createTotalPecas;
                break;
            default:
                return;
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const formattedData = transformData(data);
                createChartFunction(formattedData);
            })
            .catch(error => console.error('Erro ao buscar dados:', error));
    }

    function transformData(jsonInput) {
        const labels = [];
        const data = [];

        jsonInput.forEach(item => {
            for (const key in item) {
                labels.push(key);
                data.push(item[key]);
            }
        });

        return {
            labels: labels,
            data: data
        };
    }

    function updateStatistics(selectedValue) {
        updateChart('donut', selectedValue);
        updateChart('polar', selectedValue);
        updateChart('pizza', selectedValue);
        updateChart('media-atendimento', selectedValue);
        updateChart('taxa-conclusao', selectedValue);
        updateChart('taxa-cancelamento', selectedValue);
        updateChart('custo-medio', selectedValue);
        updateChart('total-servicos', selectedValue);
        updateChart('total-pecas', selectedValue);
    }

    // Inicializar gráficos com periodo padrão (últimos 15 dias)
    updateChart('donut', 15);
    updateChart('polar', 15);
    updateChart('pizza', 15);
    updateChart('media-atendimento', 15);
    updateChart('taxa-conclusao', 15);
    updateChart('taxa-cancelamento', 15);
    updateChart('custo-medio', 15);
    updateChart('total-servicos', 15);
    updateChart('total-pecas', 15);

    function getUltimosSeisMeses() {
        const labelsBar = [];
        const date = new Date();
        const nomesMeses = [
            'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ];

        for (let i = 5; i >= 0; i--) {
            // Criar uma nova data para cada um dos últimos 6 meses
            const mes = new Date(date.getFullYear(), date.getMonth() - i, 1);
            const nomeMes = nomesMeses[mes.getMonth()];
            const ano = mes.getFullYear();
            labelsBar.push(`${nomeMes}/${ano}`);
        }

        return labelsBar;
    }

    const chartBar = document.getElementById('chart-bar');
    const labelsBar = getUltimosSeisMeses();

    function chargeChartBarData() {
        fetch(`../os/statistics/os-ultimos-seis-meses`)
            .then(response => response.json())
            .then(data => {
                const formattedData = transformData(data);
                const growthRates = calculateGrowthRates(formattedData.data);
                createChartBar(formattedData.data, growthRates);
            })
            .catch(error => console.error('Erro ao buscar dados:', error));
    }

    function calculateGrowthRates(data) {
        const growthRates = [null]; // Initialize with null for the first month
        for (let i = 1; i < data.length; i++) {
            const previous = data[i - 1];
            const current = data[i];

            if (previous != 0) {
                const growthRate = ((current - previous) / previous) * 100;
                growthRates.push(growthRate.toFixed(2)); // Fix to 2 decimal places
            } else {
                const growthRate = (current != 0) ? 100 : 0; // Assuming 100% growth if previous was 0 and current is not 0
                growthRates.push(growthRate.toFixed(2));
            }
        }
        return growthRates;
    }

    function createChartBar(data, growthRates) {
        new Chart(chartBar, {
            type: 'bar',
            data: {
                labels: labelsBar,
                datasets: [{
                    label: 'Qtd de OS abertas',
                    data: data,
                    borderWidth: 1
                },
                    {
                        label: 'Taxa de crescimento (%)',
                        data: growthRates,
                        type: 'line',
                        yAxisID: 'y1',
                        order: 0
                    }
                ]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        position: 'left'
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        grid: {
                            drawOnChartArea: false // only want the grid lines for one axis to show up
                        },
                        ticks: {
                            callback: function(value) {
                                return value + '%'; // Append % sign to ticks
                            }
                        }
                    }
                }
            }
        });
    }

    chargeChartBarData();
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
    $(function () {
        $('[data-bs-toggle="tooltip"]').tooltip()
    })
</script>
</html>