#!/bin/bash

echo "=== Diagnosticando Problemas do Docker no TALENT ==="
echo

# Verifica se o Docker está rodando
if ! docker info > /dev/null 2>&1; then
    echo "❌ [ERRO] O Docker não está rodando. Por favor, inicie o Docker."
    exit 1
fi

echo "✅ [OK] Docker está rodando."
echo

# Verifica portas em uso
echo "Verificando portas em uso..."
if lsof -i :8000 > /dev/null 2>&1; then
    echo "⚠️ [AVISO] A porta 8000 está em uso. O servidor web pode não iniciar."
else
    echo "✅ [OK] Porta 8000 está livre."
fi

if lsof -i :3307 > /dev/null 2>&1; then
    echo "⚠️ [AVISO] A porta 3307 está em uso. O banco de dados pode não iniciar."
else
    echo "✅ [OK] Porta 3307 está livre."
fi

if lsof -i :8081 > /dev/null 2>&1; then
    echo "⚠️ [AVISO] A porta 8081 está em uso. O PHPMyAdmin pode não iniciar."
else
    echo "✅ [OK] Porta 8081 está livre."
fi
echo

# Verifica status dos containers
echo "Verificando status dos containers..."
docker ps --format "table {{.Names}}\t{{.Status}}"
echo

# Oferece comandos úteis
echo "=== Comandos úteis para solucionar problemas ==="
echo
echo "1. Para ver logs de todos os containers:"
echo "   docker-compose logs"
echo
echo "2. Para ver logs de um container específico:"
echo "   docker-compose logs webserver"
echo "   docker-compose logs db"
echo "   docker-compose logs phpmyadmin"
echo
echo "3. Para reiniciar todos os containers:"
echo "   docker-compose restart"
echo
echo "4. Para parar e remover todos os containers:"
echo "   docker-compose down"
echo
echo "5. Para reconstruir os containers:"
echo "   docker-compose up -d --build"
echo 