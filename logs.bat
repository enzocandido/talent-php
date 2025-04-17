@echo off
echo === TALENT - Visualizador de Logs ===
echo.

echo Selecione uma opcao:
echo 1. Ver todos os logs
echo 2. Ver logs do servidor web
echo 3. Ver logs do banco de dados
echo 4. Ver logs do PHPMyAdmin
echo 5. Sair
echo.

set /p OPCAO=Opcao: 

if "%OPCAO%"=="1" (
    echo.
    echo === Logs de todos os servicos ===
    docker-compose logs
    pause
    goto :eof
)

if "%OPCAO%"=="2" (
    echo.
    echo === Logs do servidor web ===
    docker-compose logs webserver
    pause
    goto :eof
)

if "%OPCAO%"=="3" (
    echo.
    echo === Logs do banco de dados ===
    docker-compose logs db
    pause
    goto :eof
)

if "%OPCAO%"=="4" (
    echo.
    echo === Logs do PHPMyAdmin ===
    docker-compose logs phpmyadmin
    pause
    goto :eof
)

if "%OPCAO%"=="5" (
    goto :eof
)

echo Opcao invalida!
pause 