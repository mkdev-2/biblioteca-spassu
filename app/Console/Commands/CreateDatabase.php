<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Exception;

class CreateDatabase extends Command
{
    /**
     * O nome e a assinatura do comando.
     *
     * @var string
     */
    protected $signature = 'db:create';

    /**
     * A descrição do comando.
     *
     * @var string
     */
    protected $description = 'Cria o banco de dados principal e de teste especificados nas configurações do .env e .env.testing';

    /**
     * Execute o comando.
     *
     * @return int
     */
    public function handle()
    {
        $this->createDatabase(env('DB_DATABASE'), 'banco de dados principal');
        $this->loadEnvTesting();   
        $this->createDatabase(getenv('DB_DATABASE'), 'banco de dados de teste');

        return 0;
    }

    /**
     * Criar o banco de dados se ele não existir.
     *
     * @param string $database
     * 
     * @return void
     */
    protected function createDatabase($database, $type)
    {
        if (! $database) {
            $this->error("Nenhum nome de $type especificado no arquivo .env");
            return;
        }

        $defaultConnection = Config::get('database.default');
        $config = Config::get("database.connections.{$defaultConnection}");
        $config['database'] = null;
        Config::set("database.connections.{$defaultConnection}", $config);

        try {
            $this->info("Conectando ao MySQL para criar o banco de dados '$database' ($type)...");
            DB::statement("CREATE DATABASE IF NOT EXISTS `$database`");
            $this->info("Banco de dados '$database' ($type) criado com sucesso!");
        } catch (Exception $e) {
            $this->error("Erro ao criar o $type: " . $e->getMessage());
        } finally {
            $config['database'] = $database;
            Config::set("database.connections.{$defaultConnection}", $config);
        }
    }

    /**
     * Carregar o arquivo .env.testing e definir manualmente as variáveis de ambiente.
     *
     * @return void
     */
    protected function loadEnvTesting()
    {
        if (file_exists(base_path('.env.testing'))) {
            $this->info("Carregando manualmente as variáveis do .env.testing...");
    
            putenv('DB_CONNECTION=mysql');
            putenv('DB_DATABASE=teste_biblioteca');
            putenv('DB_USERNAME=root');
            putenv('DB_PASSWORD=');
    
            $this->info('Banco de dados de teste configurado: ' . getenv('DB_DATABASE'));
        } else {
            $this->error(".env.testing não encontrado!");
        }
    }
}