@echo off
echo === Configurando ambiente TALENT ===

echo [DEBUG] Verificando Docker...
REM Verifica se o Docker está instalado
docker --version > nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo Docker nao encontrado. Por favor, instale o Docker antes de continuar.
    echo Visite https://docs.docker.com/get-docker/ para instrucoes.
    exit /b 1
)

echo [DEBUG] Verificando Docker Compose...
REM Verifica se o Docker Compose está instalado
docker-compose --version > nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo Docker Compose nao encontrado. Por favor, instale o Docker Compose antes de continuar.
    echo Visite https://docs.docker.com/compose/install/ para instrucoes.
    exit /b 1
)

echo [DEBUG] Verificando XAMPP...
REM Verifica se o XAMPP está rodando
tasklist /FI "IMAGENAME eq xampp-control.exe" 2>NUL | find /I /N "xampp-control.exe">NUL
if "%ERRORLEVEL%"=="0" (
    echo [AVISO] O XAMPP parece estar em execucao. Recomendamos fechar o XAMPP antes de continuar.
    echo Deseja continuar mesmo assim? (S/N)
    set /p RESP=
    if /I "%RESP%" NEQ "S" exit /b 1
)

echo [DEBUG] Verificando arquivo .env...
REM Cria o arquivo .env se não existir
if not exist .env (
    echo Criando arquivo .env a partir do modelo...
    copy .env.example .env
    echo [OK] Arquivo .env criado com sucesso!
) else (
    echo [OK] Arquivo .env ja existe.
)

echo [DEBUG] Iniciando containers Docker...
REM Inicia os containers Docker
echo Iniciando os containers Docker...
docker-compose up -d

echo [DEBUG] Verificando resultado...
REM Verifica se os containers foram iniciados com sucesso
if %ERRORLEVEL% EQU 0 (
    echo [OK] Containers Docker iniciados com sucesso!
    echo.
    echo === Ambiente TALENT configurado com sucesso! ===
    echo.
    echo Voce pode acessar a aplicacao nos seguintes enderecos:
    echo - Site: http://localhost:8000
    echo - PHPMyAdmin: http://localhost:8081 (usuario: root, senha: root)
    echo.
    echo Para parar o ambiente, execute: docker-compose down
) else (
    echo [ERRO] Erro ao iniciar os containers Docker.
    echo.
    echo Possiveis solucoes:
    echo 1. Verifique se as portas 8000, 3307 e 8081 estao disponiveis
    echo 2. Se o XAMPP estiver em execucao, feche-o e tente novamente
    echo 3. Para ver detalhes do erro, execute: docker-compose logs
    echo.
)

echo [DEBUG] Finalizando script...
echo.
echo Pressione qualquer tecla para sair...
pause > nul 