# TALENT - Plataforma de Compartilhamento de Talentos

TALENT é uma plataforma onde os usuários podem compartilhar seus talentos através de vídeos, participar de campeonatos e interagir com outros usuários.

## Requisitos de Sistema

- Docker e Docker Compose
- Git

## Configuração do Ambiente

### Usando Docker (Recomendado)

1. Clone o repositório:

   ```
   git clone https://github.com/enzocandido/talent-php.git
   cd talent-php
   ```

2. Escolha um dos scripts de instalação:

   **Para instalação normal:**

   ```
   setup_simple.bat  # No Windows
   ```

   **Se encontrar problemas:**

   ```
   reset.bat  # No Windows - Limpa tudo e reinicia
   ```

3. Acesse a aplicação:
   - Site: http://localhost:8000
   - PHPMyAdmin: http://localhost:8081 (usuário: root, senha: root)

### Parando o Ambiente

```
docker-compose down
```

### Usando XAMPP (Método Alternativo)

1. Instale o XAMPP (https://www.apachefriends.org/download.html)
2. Clone o repositório na pasta htdocs do XAMPP:
   ```
   git clone https://github.com/enzocandido/talent-php.git C:/xampp/htdocs/talent-php
   ```
3. Inicie o Apache e MySQL no painel de controle do XAMPP
4. Importe o arquivo 'talentdb.sql' no phpMyAdmin
5. Acesse a aplicação em http://localhost/talent-php/talent

## Estrutura do Projeto

- `/app` - Arquivos de configuração da aplicação
- `/talent` - Arquivos principais da aplicação
- `talentdb.sql` - Esquema do banco de dados

## Funcionalidades

- Compartilhamento de vídeos de talentos
- Campeonatos com prêmios
- Sistema de curtidas e favoritos
- Perfis de usuários
- Categorização de talentos

## Desenvolvimento

- Para fazer alterações no banco de dados, modifique o arquivo talentdb.sql
- Após modificações, reinicie os containers Docker:
  ```
  docker-compose down && docker-compose up -d
  ```

## Conta de Administrador Padrão

- Usuário: admin
- Email: admin@talent.com
- Senha: (consulte o arquivo SQL para a senha hasheada)

## Solução de Problemas

Se encontrar problemas para iniciar os containers Docker, temos várias ferramentas para ajudar:

### Scripts de Diagnóstico:

- `check_status.bat` - Verifica o status dos containers e portas em uso
- `logs.bat` - Visualiza os logs de cada serviço
- `reset.bat` - Reinicia tudo do zero (limpa containers, volumes e imagens)

### Problemas Comuns:

1. **Portas em uso**: Verifique se as portas 8000, 3307 e 8081 estão disponíveis. Use o script `check_status.bat` para verificar.

2. **Problemas com XAMPP**: Se você estiver usando o XAMPP simultaneamente, desligue-o antes de iniciar o Docker.

3. **Problemas com caracteres especiais no Windows**: Os scripts foram adaptados para evitar caracteres especiais que podem causar problemas no CMD do Windows.

4. **Docker não iniciando**: Certifique-se de que o Docker Desktop esteja em execução antes de executar os scripts.

5. **Logs de erro detalhados**: Use o script `logs.bat` para visualizar os logs detalhados.
