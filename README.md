# Processo Seletivo – Back-End Teste Técnico

Este é um projeto de teste técnico para um processo seletivo de Back-End, desenvolvido com o framework Laravel 10.

## Instruções de Execução Local

### Pré-requisitos

- Docker Desktop instalado e em execução
- Composer instalado globalmente
- Git instalado

### Passos para Executar o Projeto

1. Clone o repositório do GitHub:

   ```bash
   git clone https://github.com/edRibeiro/back-end-teste-tecnico.git
   ```

2. Acesse o diretório do projeto:

   ```bash
   cd back-end-teste-tecnico
   ```

3. Instale as dependências do Composer:

   ```bash
   composer install
   ```

4. Copie o arquivo de exemplo `.env.example` e renomeie-o para `.env`:

   ```bash
   cp .env.example .env
   ```

5. Gere a chave de aplicativo Laravel:

   ```bash
   php artisan key:generate
   ```

6. Execute o Docker Sail para iniciar o ambiente de desenvolvimento:

   ```bash
   ./vendor/bin/sail up -d
   ```

7. Execute as migrações do banco de dados e os seeds (se houver):

   ```bash
   ./vendor/bin/sail artisan migrate --seed
   ```

8. O projeto Laravel agora deve estar em execução. Você pode acessá-lo em seu navegador em `http://localhost`.

### Parar e Desmontar o Ambiente Docker Sail

Para parar e desmontar o ambiente Docker Sail, execute o seguinte comando:

```bash
./vendor/bin/sail down
```

Isso desligará e removerá todos os contêineres do ambiente de desenvolvimento Docker Sail.

### Comandos Úteis do Docker Sail

- `./vendor/bin/sail shell`: Acessa o shell do contêiner principal do Docker Sail.
- `./vendor/bin/sail artisan migrate`: Executa todas as migrações pendentes.
- `./vendor/bin/sail artisan db:seed`: Executa os seeders de banco de dados.
