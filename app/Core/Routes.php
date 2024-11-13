<?php

namespace App\Core;

class Routes
{
    public static function loadRoutes()
    {
        return [
            '/' => [
                'controller' => 'LoginController',
                'method' => 'index',
                'public' => true
            ],
            '/login' => [
                'controller' => 'LoginController',
                'method' => 'login',
                'public' => true
            ],
            '/logout' => [
                'controller' => 'LoginController',
                'method' => 'logout',
                'public' => false
            ],
            '/forgot_password' => [
                'controller' => 'LoginController',
                'method' => 'forgotPassword',
                'public' => true
            ],
            '/forgot_password/form' => [
                'controller' => 'LoginController',
                'method' => 'forgotPasswordHandler',
                'public' => true
            ],
            '/reset_password' => [
                'controller' => 'LoginController',
                'method' => 'resetPassword',
                'public' => true
            ],
            '/reset_password/form' => [
                'controller' => 'LoginController',
                'method' => 'resetPasswordHandler',
                'public' => true
            ],
            '/change_password' => [
                'controller' => 'LoginController',
                'method' => 'changePassword',
                'public' => false
            ],
            '/change_password/form' => [
                'controller' => 'LoginController',
                'method' => 'changePasswordHandler',
                'public' => false
            ],
            '/user/inactive' => [
                'controller' => 'UserController',
                'method' => 'inactive',
                'public' => false
            ],
            '/user/dashboard' => [
                'controller' => 'DashboardController',
                'method' => 'index',
                'public' => false
            ],
            '/user/profile' => [
                'controller' => 'DashboardController',
                'method' => 'profile',
                'public' => false
            ],
            '/user/add' => [
                'controller' => 'UserController',
                'method' => 'index',
                'public' => false
            ],
            '/user/add/form' => [
                'controller' => 'UserController',
                'method' => 'addHandler',
                'public' => false
            ],
            '/user/list' => [
                'controller' => 'UserController',
                'method' => 'list',
                'public' => false
            ],
            '/user/edit' => [
                'controller' => 'UserController',
                'method' => 'edit',
                'public' => false
            ],
            '/user/edit/form' => [
                'controller' => 'UserController',
                'method' => 'editHandler',
                'public' => false
            ],
            '/user/get/name' => [
                'controller' => 'UserController',
                'method' => 'getUserByName',
                'public' => false
            ],
            '/user/change_password' => [
                'controller' => 'UserController',
                'method' => 'changePassword',
                'public' => false
            ],
            '/user/change_password/form' => [
                'controller' => 'UserController',
                'method' => 'changePasswordHandler',
                'public' => false
            ],
            '/user/change_email' => [
                'controller' => 'UserController',
                'method' => 'changeEmail',
                'public' => false
            ],
            '/user/change_email/form' => [
                'controller' => 'UserController',
                'method' => 'changeEmailHandler',
                'public' => false
            ],
            '/cidade/all/get' => [
                'controller' => 'CidadeController',
                'method' => 'listarCidadesPorEstado',
                'public' => false
            ],
            '/file/download' => [
                'controller' => 'ArquivoController',
                'method' => 'download',
                'public' => false
            ],
            '/file/delete' => [
                'controller' => 'ArquivoController',
                'method' => 'destroy',
                'public' => false
            ],
            '/os/add/step/1' => [
                'controller' => 'OSController',
                'method' => 'index',
                'public' => false
            ],
            '/os/add/step/2' => [
                'controller' => 'OSController',
                'method' => 'addSecoundStep',
                'public' => false
            ],
            '/os/add/step/3' => [
                'controller' => 'OSController',
                'method' => 'addThirdStep',
                'public' => false
            ],
            '/os/add/form' => [
                'controller' => 'OSController',
                'method' => 'addHandler',
                'public' => false
            ],
            '/os/details' => [
                'controller' => 'OSController',
                'method' => 'details',
                'public' => false
            ],
            '/os/edit' => [
                'controller' => 'OSController',
                'method' => 'edit',
                'public' => false
            ],
            '/os/edit/form' => [
                'controller' => 'OSController',
                'method' => 'editHandler',
                'public' => false
            ],
            '/os/cancel' => [
                'controller' => 'OSController',
                'method' => 'cancel',
                'public' => false
            ],
            '/os/search' => [
                'controller' => 'OSController',
                'method' => 'search',
                'public' => false
            ],
            '/os/search/result' => [
                'controller' => 'OSController',
                'method' => 'searchHandler',
                'public' => false
            ],
            '/os/show' => [
                'controller' => 'OSController',
                'method' => 'show',
                'public' => false
            ],
            '/os/diagnosis' => [
                'controller' => 'OSController',
                'method' => 'diagnosis',
                'public' => false
            ],
            '/os/diagnosis/details' => [
                'controller' => 'OSController',
                'method' => 'diagnosisDetails',
                'public' => false
            ],
            '/os/diagnosis/form' => [
                'controller' => 'OSController',
                'method' => 'diagnosisHandler',
                'public' => false
            ],
            '/os/budget' => [
                'controller' => 'OSController',
                'method' => 'budget',
                'public' => false
            ],
            '/os/budget/details' => [
                'controller' => 'OSController',
                'method' => 'budgetDetails',
                'public' => false
            ],
            '/os/budget/form' => [
                'controller' => 'OSController',
                'method' => 'budgetHandler',
                'public' => false
            ],
            '/os/budget/approve' => [
                'controller' => 'OSController',
                'method' => 'budgetApprove',
                'public' => false
            ],
            '/os/budget/email/approve' => [
                'controller' => 'OSController',
                'method' => 'budgetEmailApprove',
                'public' => true
            ],
            '/os/repair' => [
                'controller' => 'OSController',
                'method' => 'repair',
                'public' => false
            ],
            '/os/repair/details' => [
                'controller' => 'OSController',
                'method' => 'repairDetails',
                'public' => false
            ],
            '/os/repair/form' => [
                'controller' => 'OSController',
                'method' => 'repairHandler',
                'public' => false
            ],
            '/os/charge' => [
                'controller' => 'OSController',
                'method' => 'charge',
                'public' => false
            ],
            '/os/charge/details' => [
                'controller' => 'OSController',
                'method' => 'chargeDetails',
                'public' => false
            ],
            '/os/charge/form' => [
                'controller' => 'OSController',
                'method' => 'chargeHandler',
                'public' => false
            ],
            '/os/payment' => [
                'controller' => 'OSController',
                'method' => 'payment',
                'public' => false
            ],
            '/os/payment/details' => [
                'controller' => 'OSController',
                'method' => 'paymentDetails',
                'public' => false
            ],
            '/os/payment/form' => [
                'controller' => 'OSController',
                'method' => 'paymentHandler',
                'public' => false
            ],
            '/os/release' => [
                'controller' => 'OSController',
                'method' => 'release',
                'public' => false
            ],
            '/os/release/details' => [
                'controller' => 'OSController',
                'method' => 'releaseDetails',
                'public' => false
            ],
            '/os/release/form' => [
                'controller' => 'OSController',
                'method' => 'releaseHandler',
                'public' => false
            ],
            '/os/canceled' => [
                'controller' => 'OSController',
                'method' => 'canceled',
                'public' => false
            ],
            '/os/warranty' => [
                'controller' => 'OSController',
                'method' => 'warranty',
                'public' => false
            ],
            '/os/receipt' => [
                'controller' => 'OSController',
                'method' => 'receipt',
                'public' => false
            ],
            '/os/report/repair-cost' => [
                'controller' => 'OSController',
                'method' => 'repairCostReport',
                'public' => false
            ],
            '/os/report/technical-performance' => [
                'controller' => 'OSController',
                'method' => 'technicalPerformanceReport',
                'public' => false
            ],
            '/os/report/os-status' => [
                'controller' => 'OSController',
                'method' => 'statusOSReport',
                'public' => false
            ],
            '/os/report/customer-os' => [
                'controller' => 'OSController',
                'method' => 'customerOSReport',
                'public' => false
            ],
            '/os/report/payments' => [
                'controller' => 'OSController',
                'method' => 'paymentsReport',
                'public' => false
            ],
            '/os/report/birthdays' => [
                'controller' => 'OSController',
                'method' => 'birthdaysReport',
                'public' => false
            ],
            '/os/statistics/donut' => [
                'controller' => 'OSController',
                'method' => 'donutDataGenerate',
                'public' => false
            ],
            '/os/statistics/pizza' => [
                'controller' => 'OSController',
                'method' => 'pizzaDataGenerate',
                'public' => false
            ],
            '/os/statistics/polar' => [
                'controller' => 'OSController',
                'method' => 'polarDataGenerate',
                'public' => false
            ],
            '/os/statistics/media-atendimento' => [
                'controller' => 'OSController',
                'method' => 'mediaAtendimentoDataGenerate',
                'public' => false
            ],
            '/os/statistics/taxa-conclusao' => [
                'controller' => 'OSController',
                'method' => 'taxaConclusaoDataGenerate',
                'public' => false
            ],
            '/os/statistics/taxa-cancelamento' => [
                'controller' => 'OSController',
                'method' => 'taxaCancelamentoDataGenerate',
                'public' => false
            ],
            '/os/statistics/custo-medio' => [
                'controller' => 'OSController',
                'method' => 'custoMedioDataGenerate',
                'public' => false
            ],
            '/os/statistics/total-servicos' => [
                'controller' => 'OSController',
                'method' => 'valorTotalServicos',
                'public' => false
            ],
            '/os/statistics/total-pecas' => [
                'controller' => 'OSController',
                'method' => 'valorTotalPecas',
                'public' => false
            ],
            '/os/statistics/os-ultimos-seis-meses' => [
                'controller' => 'OSController',
                'method' => 'ultimosSeisMesesDataGenerate',
                'public' => false
            ],
            '/client/add' => [
                'controller' => 'ClienteController',
                'method' => 'index',
                'public' => false
            ],
            '/client/add/form' => [
                'controller' => 'ClienteController',
                'method' => 'addHandler',
                'public' => false
            ],
            '/client/show' => [
                'controller' => 'ClienteController',
                'method' => 'show',
                'public' => false
            ],
            '/client/edit' => [
                'controller' => 'ClienteController',
                'method' => 'edit',
                'public' => false
            ],
            '/client/edit/form' => [
                'controller' => 'ClienteController',
                'method' => 'editHandler',
                'public' => false
            ],
            '/client/search' => [
                'controller' => 'ClienteController',
                'method' => 'search',
                'public' => false
            ],
            '/client/search/result' => [
                'controller' => 'ClienteController',
                'method' => 'searchHandler',
                'public' => false
            ],
            '/client/search/json' => [
                'controller' => 'ClienteController',
                'method' => 'searchClienteJSon',
                'public' => false
            ],
            '/cidade/search' => [
                'controller' => 'CidadeController',
                'method' => 'searchCidade',
                'public' => false
            ],
        ];
    }
}