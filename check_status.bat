@echo off
echo === TALENT - Verificacao de Status ===
echo.

echo Status dos containers Docker:
docker-compose ps
echo.

echo Containers em execucao:
docker ps
echo.

echo Verificando portas em uso:
echo - Porta 8000 (Web Server):
netstat -ano | findstr :8000
echo.

echo - Porta 3307 (MySQL):
netstat -ano | findstr :3307
echo.

echo - Porta 8081 (PHPMyAdmin):
netstat -ano | findstr :8081
echo.

echo Pressione qualquer tecla para ver os logs...
pause > nul

echo.
echo Ultimas 20 linhas de logs:
docker-compose logs --tail=20
echo.

echo Pressione qualquer tecla para sair...
pause > nul 