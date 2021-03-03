# Sistema de Controle de Tarefas
    Projeto de um CRUD para acompanhamento de tarefas.
## Ferramentas
    Laravel Framework 8.25.0
    PHP 7.4.13
    Vuejs @vue/cli 4.5.11
    Servidor XAMP
## Como executar
    Install packages: npm install
    Obsergações!!!
    Antes de Executar os comandos abaixo, certifique que exista um banco chamado sistask,
    as configurações de usuario e senha estao informadas no arquivo .env caso seja necessário mudar de acordo com sua máquina.
    cp .env.example .env  ----- Criar arquivo de configuração caso não exista
    php artisan key:generate ----- Gerar chave da aplicação
    Database: php artisan migrate
    Seeds: php artisan db:seed
    Comando Reduzido Banco de Dados (Opcional): php artisan migrate:fresh --seed
    Vuejs Front: npm run watch
    Api Laravel Start: php artisan serve

## Acesso Inicial 
    Ao executar o server acessar a rota inicial: 
    http://localhost:8000/home