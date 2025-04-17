@echo off
echo === TALENT - Script de configuracao simplificado ===

REM Cria o arquivo .env se não existir
if not exist .env (
    echo Criando arquivo .env...
    copy .env.example .env
)

REM Inicia os containers Docker
echo Iniciando Docker...
docker-compose up -d

REM Verifica o resultado
echo.
echo Se os containers foram iniciados com sucesso, voce pode acessar:
echo - Site: http://localhost:8000
echo - PHPMyAdmin: http://localhost:8081 (usuario: root, senha: root)
echo.
echo Para ver o status dos containers, execute: docker-compose ps
echo Para ver logs de erro, execute: docker-compose logs
echo Para parar o ambiente, execute: docker-compose down
echo.

echo Pressione qualquer tecla para sair...
pause > nul 