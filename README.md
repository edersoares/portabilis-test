# Instruções

O código desse projeto consiste num CRUD básico de alunos, sem nenhum teste ou regra de negócio. Foram usadas somente algumas ferramentas e bibliotecas básicas:
- Slim Framework
- Phinx (migrations)
- Illuminate Database (ORM)
- Phpdotenv (Configuração)

Esperamos que um desenvolvedor sênior possa refatorar o código desse projeto, fazendo uso de boas práticas e padrões (PSRs) e o cubra com testes.
  
Sinta-se à vontade pra melhorar o que achar necessário nesse código. Estaremos avaliando qualquer melhoria feita no projeto

## Instalação

Execute os passos abaixo para instalação:

```bash
# clone o repositório
git clone https://github.com/edersoares/portabilis-test.git

# entre no diretório do repositório
cd portabilis-test

# instale as dependências
composer install

# copie o arquivo de configuração
cp .env.example .env

# crie um banco de dados para desenvolvimento
touch database/database.sqlite

# crie um banco de dados para testes
touch database/database.sqlite

# rode as migrations
./vendor/bin/phinx migrate
```

Para testar a aplicação:

```bash
# rode os testes
./vendor/bin/phpunit
```

Para executar a aplicação via Docker:

```bash
# crie as imagens
docker-compose build

# levante os containers
docker-compose up
```
Para executar a aplicação via servidor embutido do PHP, altere o arquivo `.env` para:

```bash
DB_DRIVER = sqlite
DB_HOST = 
DB_PORT = 
DB_NAME = database.sqlite
DB_USER = 
DB_PASS = 
```

E execute o servidor embutido:

```bash
php -S localhost:8080 -t public
```

Acesse http://localhost para ambos os casos.