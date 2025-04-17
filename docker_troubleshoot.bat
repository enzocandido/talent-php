@echo off
echo === Diagnosticando Problemas do Docker no TALENT ===
echo.

REM Verifica se o Docker está rodando
docker info > nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo [ERRO] O Docker não está rodando. Por favor, inicie o Docker Desktop.
    goto :end
)

echo [OK] Docker está rodando.
echo.

REM Verifica portas em uso
echo Verificando portas em uso...
netstat -aon | findstr ":8000" > nul
if %ERRORLEVEL% EQU 0 (
    echo [AVISO] A porta 8000 está em uso. O servidor web pode não iniciar.
) else (
    echo [OK] Porta 8000 está livre.
)

netstat -aon | findstr ":3307" > nul
if %ERRORLEVEL% EQU 0 (
    echo [AVISO] A porta 3307 está em uso. O banco de dados pode não iniciar.
) else (
    echo [OK] Porta 3307 está livre.
)

netstat -aon | findstr ":8081" > nul
if %ERRORLEVEL% EQU 0 (
    echo [AVISO] A porta 8081 está em uso. O PHPMyAdmin pode não iniciar.
) else (
    echo [OK] Porta 8081 está livre.
)
echo.

REM Verifica status dos containers
echo Verificando status dos containers...
docker ps --format "{{.Names}}: {{.Status}}"
echo.

REM Oferece comandos úteis
echo === Comandos úteis para solucionar problemas ===
echo.
echo 1. Para ver logs de todos os containers:
echo    docker-compose logs
echo.
echo 2. Para ver logs de um container específico:
echo    docker-compose logs webserver
echo    docker-compose logs db
echo    docker-compose logs phpmyadmin
echo.
echo 3. Para reiniciar todos os containers:
echo    docker-compose restart
echo.
echo 4. Para parar e remover todos os containers:
echo    docker-compose down
echo.
echo 5. Para reconstruir os containers:
echo    docker-compose up -d --build
echo.

:end
echo.
echo Pressione qualquer tecla para sair...
pause > nul 