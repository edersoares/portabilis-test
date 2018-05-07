# Instruções

O código desse projeto consiste num CRUD básico de alunos, sem nenhum teste ou regra de negócio. Foram usadas somente algumas ferramentas e bibliotecas básicas:
- Slim Framework
- Phinx (migrations)
- Illuminate Database (ORM)
- Phpdotenv (Configuração)

Esperamos que um desenvolvedor sênior possa refatorar o código desse projeto, fazendo uso de boas práticas e padrões (PSRs) e o cubra com testes.
  
Sinta-se à vontade pra melhorar o que achar necessário nesse código. Estaremos avaliando qualquer melhoria feita no projeto

## Instalação

Execute os passos abaixo para instalar, testar e executar a aplicação:

```bash
# clone o repositório
git clone https://github.com/edersoares/portabilis-test.git

# entre no diretório do repositório
cd portabilis-test

# instale as dependências
composer install

# copie o arquivo de configuração
cp .env.example .env

# crie um banco de dados para testes
touch database/database.sqlite

# rode as migrations
./vendor/bin/phinx migrate

# rode os testes
./vendor/bin/phpunit
```