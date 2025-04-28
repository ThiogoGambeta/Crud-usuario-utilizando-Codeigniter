<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rota para a lista de usuários
$routes->get('/usuarios', 'UsuarioController::index'); // Para listar os usuários

// Rota para mostrar o formulário de adicionar
$routes->get('/usuarios/adicionar', 'UsuarioController::adicionar'); // Para mostrar o formulário

// Rota para salvar um novo usuário
$routes->post('/usuarios/salvar', 'UsuarioController::salvar'); // Para salvar um novo usuário

// Rota para editar um usuário
$routes->get('/usuarios/editar/(:num)', 'UsuarioController::editar/$1'); // Para editar um usuário específico (id)

// Rota para excluir um usuário
$routes->get('/usuarios/excluir/(:num)', 'UsuarioController::excluir/$1'); // Para excluir um usuário específico (id)

$routes->post('/usuarios/atualizar/(:num)', 'UsuarioController::atualizar/$1');