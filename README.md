# ⚡ Aplicativo Plan - API e DB #

### Stack utilizada

- PHP (Laravel)
- PostgreSQL
- PgAdmin
- Nginx

### Ambiente de desenvolvimento

- Instale o docker no WSL(Windows Subsystem for Linux) com Ubuntu LTS 

### Permissões
```
sudo chmod -R 777 src
```
O comando está concedendo permissões completas de leitura, escrita e execução para todos os usuários em todos os arquivos e pastas dentro do diretório "src" e seus subdiretórios. O laravel precisará que isto seja executado para poder operar corretamente.

### Configurando ambiente e construindo containers

Criando o diretório de volumes do PostgreSQL.

```
mkdir database database/postgre-sql
```

Criando containers

```
sudo docker compose up -d
```

Executando migrações do Laravel

Acesse o diretório

```
cd src/
```

Copie o arquivo Env

```
cp .env.example .env
```

Crie uma nova chave para a aplicação

```
sudo docker compose exec php php artisan key:generate
```
obs: 
- logo após deverá preencher o arquivo env com as configurações do banco de dados conforme descrito no final deste arquivo.
- No arquivo env, em configurações do banco de dados, o DB_CONNECTION deverá ser "pgsql".

Execute a migração

```
sudo docker compose exec php php artisan migrate --seed
```

### Visualizar Base de dados com pgAdmin
#### Registrando o servidor da base de dados

Após criado os containers do postgreSQL e pgAdmin, navegue até `http://localhost:3400/` e efetue o login com usuário `localdev@example.com`e senha `localdev`

Navege até Servers > Register > Server para preecher os campos necessarios de conexão.

| Campo  | Valor |
| --- | --- |
| General > Name | plan | 
| Connection > Host name/address | pgsql |
| Connection > Port | 5432 |
| Connection > Maintenance database | db_plan_eletro |
| Connection > Username | localdev |
| Connection > Password | localdev@123 |

### Rotas

| Rota  | Função |
| --- | --- |
| http://localhost:3000/api/eletro/listing | Listagem |
| http://localhost:3000/api/eletro/show/{id} | Visualizar |
| http://localhost:3000/api/eletro/store | Cadastrar |
| http://localhost:3000/api/eletro/update/{id} | Atualizar |
| http://localhost:3000/api/eletro/delete/{id} | Deletar |
| http://localhost:3000/api/marca/listing | Listagem das marcas |
  
### Portas
| Serviço  | Porta |
| --- | --- |
| Nginx | 3000 |
| PHP | 9000 |
| PostgreSQL | 5432 |
| PgAdmin | 3400 |

## 🚀 Sobre o desenvolvedor

Este projeto é desenvolvido e mantido por Paulo Teixeira.
