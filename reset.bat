@echo off
echo === TALENT - Reset Completo ===
echo.

echo Parando e removendo todos os containers...
docker-compose down -v
echo.

echo Removendo volumes Docker...
docker volume prune -f
echo.

echo Removendo imagens nao utilizadas...
docker image prune -f
echo.

echo Limpando o arquivo .env...
if exist .env (
    del .env
    echo Arquivo .env removido.
)
echo.

echo Criando novo arquivo .env...
copy .env.example .env
echo.

echo Iniciando os containers novamente...
docker-compose up -d
echo.

echo Reinicializacao concluida!
echo Voce pode acessar a aplicacao em:
echo - Site: http://localhost:8000
echo - PHPMyAdmin: http://localhost:8081 (usuario: root, senha: root)
echo.

echo Pressione qualquer tecla para sair...
pause > nul