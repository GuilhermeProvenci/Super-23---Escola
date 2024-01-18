<?php
// Configurações do Banco de Dados
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'escola');
define('DB_CHARSET', 'utf8');

// Relatórios de Erros
error_reporting(E_ALL);
ini_set('display_errors', 0); // Configurar para 0 em um ambiente de produção

// Fuso Horário
date_default_timezone_set('America/Sao_Paulo'); // Configurar para seu fuso horário

// Configuração de Sessão
ini_set('session.cookie_httponly', 1); // Ajuda a mitigar sequestro de sessão

// Cabeçalhos de Segurança
header('Content-Security-Policy: default-src "self"');

// Outras Configurações Específicas da Aplicação
// 


// Carregar Dependências do Composer (se estiver usando o Composer)
require_once __DIR__ . '/vendor/autoload.php';

// Constantes ou Configurações Personalizadas
// define('SOME_CONSTANT', 'some_value');

// Chaves de API ou Segredos
// define('API_KEY', 'sua_chave_api');
?>