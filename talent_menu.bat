@echo off
:MENU
cls
echo ===================================
echo      TALENT - MENU PRINCIPAL      
echo ===================================
echo.
echo Selecione uma opcao:
echo.
echo  1. Instalar/Iniciar (Simplificado)
echo  2. Verificar Status
echo  3. Ver Logs
echo  4. Reiniciar Tudo (Reset)
echo  5. Parar Containers
echo  6. Sair
echo.
set /p OPCAO=Opcao: 

if "%OPCAO%"=="1" (
    call setup_simple.bat
    goto MENU
)

if "%OPCAO%"=="2" (
    call check_status.bat
    goto MENU
)

if "%OPCAO%"=="3" (
    call logs.bat
    goto MENU
)

if "%OPCAO%"=="4" (
    call reset.bat
    goto MENU
)

if "%OPCAO%"=="5" (
    echo Parando containers...
    docker-compose down
    pause
    goto MENU
)

if "%OPCAO%"=="6" (
    exit /b 0
)

echo Opcao invalida!
timeout /t 3 >nul
goto MENU 