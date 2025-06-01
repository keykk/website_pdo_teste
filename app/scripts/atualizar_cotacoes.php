<?php
/**
 * Script para atualizar cotações e previsão do tempo
 * Este script seria executado periodicamente via cron para manter os dados atualizados
 */

// Carregar configurações
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

/**
 * Função para obter cotações de API externa
 * 
 * @return array
 */
function obterCotacoesAPI() {
    // Em um ambiente real, aqui seria feita uma requisição para uma API externa
    // Como é uma simulação, retornamos dados estáticos
    return [
        [
            'cultura' => 'Soja',
            'valor' => 'R$ ' . number_format(rand(14000, 16000) / 100, 2, ',', '.'),
            'variacao' => (rand(-100, 200) / 100) . '%',
            'tendencia' => rand(0, 1) ? 'alta' : 'baixa'
        ],
        [
            'cultura' => 'Milho',
            'valor' => 'R$ ' . number_format(rand(7000, 8000) / 100, 2, ',', '.'),
            'variacao' => (rand(-100, 200) / 100) . '%',
            'tendencia' => rand(0, 1) ? 'alta' : 'baixa'
        ],
        [
            'cultura' => 'Café',
            'valor' => 'R$ ' . number_format(rand(120000, 130000) / 100, 2, ',', '.'),
            'variacao' => (rand(-100, 200) / 100) . '%',
            'tendencia' => rand(0, 1) ? 'alta' : 'baixa'
        ],
        [
            'cultura' => 'Algodão',
            'valor' => 'R$ ' . number_format(rand(37000, 39000) / 100, 2, ',', '.'),
            'variacao' => (rand(-100, 200) / 100) . '%',
            'tendencia' => rand(0, 1) ? 'alta' : 'baixa'
        ]
    ];
}

/**
 * Função para obter previsão do tempo de API externa
 * 
 * @return array
 */
function obterPrevisaoTempoAPI() {
    // Em um ambiente real, aqui seria feita uma requisição para uma API externa
    // Como é uma simulação, retornamos dados estáticos
    $condicoes = ['sol', 'parcialmente nublado', 'nublado', 'chuva', 'tempestade'];
    $icones = ['fa-sun', 'fa-cloud-sun', 'fa-cloud', 'fa-cloud-rain', 'fa-cloud-bolt'];
    
    return [
        [
            'cidade' => 'São Paulo',
            'estado' => 'SP',
            'temperatura' => rand(18, 32) . '°C',
            'condicao' => $condicoes[rand(0, 4)],
            'icone' => $icones[rand(0, 4)]
        ],
        [
            'cidade' => 'Cuiabá',
            'estado' => 'MT',
            'temperatura' => rand(25, 38) . '°C',
            'condicao' => $condicoes[rand(0, 4)],
            'icone' => $icones[rand(0, 4)]
        ],
        [
            'cidade' => 'Curitiba',
            'estado' => 'PR',
            'temperatura' => rand(12, 28) . '°C',
            'condicao' => $condicoes[rand(0, 4)],
            'icone' => $icones[rand(0, 4)]
        ],
        [
            'cidade' => 'Goiânia',
            'estado' => 'GO',
            'temperatura' => rand(22, 35) . '°C',
            'condicao' => $condicoes[rand(0, 4)],
            'icone' => $icones[rand(0, 4)]
        ]
    ];
}

// Obter dados atualizados
$cotacoes = obterCotacoesAPI();
$previsao = obterPrevisaoTempoAPI();

// Em um ambiente real, aqui seria feita a atualização no banco de dados
// Como é uma simulação, apenas exibimos os dados
echo "Cotações atualizadas:\n";
print_r($cotacoes);

echo "\nPrevisão do tempo atualizada:\n";
print_r($previsao);

echo "\nDados atualizados com sucesso!\n";
