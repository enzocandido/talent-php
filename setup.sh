#!/bin/bash

# Script para configurar o ambiente de desenvolvimento do projeto TALENT

echo "=== Configurando o ambiente TALENT ==="

# Verifica se o Docker está instalado
if ! command -v docker &> /dev/null
then
    echo "Docker não encontrado. Por favor, instale o Docker antes de continuar."
    echo "Visite https://docs.docker.com/get-docker/ para instruções."
    exit 1
fi

# Verifica se o Docker Compose está instalado
if ! command -v docker-compose &> /dev/null
then
    echo "Docker Compose não encontrado. Por favor, instale o Docker Compose antes de continuar."
    echo "Visite https://docs.docker.com/compose/install/ para instruções."
    exit 1
fi

# Verifica se o XAMPP está rodando (apenas no Linux)
if [ "$(uname)" == "Linux" ]; then
    if pgrep -x "xampp" > /dev/null || pgrep -x "httpd" > /dev/null || pgrep -x "apache2" > /dev/null; then
        echo "⚠️ [AVISO] O XAMPP ou Apache parece estar em execução. Recomendamos fechar antes de continuar."
        read -p "Deseja continuar mesmo assim? (S/N): " -n 1 -r
        echo
        if [[ ! $REPLY =~ ^[Ss]$ ]]; then
            exit 1
        fi
    fi
fi

# Cria o arquivo .env se não existir
if [ ! -f .env ]; then
    echo "Criando arquivo .env a partir do modelo..."
    cp .env.example .env
    echo "✅ [OK] Arquivo .env criado com sucesso!"
else
    echo "✅ [OK] Arquivo .env já existe."
fi

# Inicia os containers Docker
echo "Iniciando os containers Docker..."
docker-compose up -d

# Verifica se os containers foram iniciados com sucesso
if [ $? -eq 0 ]; then
    echo "✅ [OK] Containers Docker iniciados com sucesso!"
    echo ""
    echo "=== Ambiente TALENT configurado com sucesso! ==="
    echo ""
    echo "Você pode acessar a aplicação nos seguintes endereços:"
    echo "- Site: http://localhost:8000"
    echo "- PHPMyAdmin: http://localhost:8081 (usuário: root, senha: root)"
    echo ""
    echo "Para parar o ambiente, execute: docker-compose down"
else
    echo "❌ [ERRO] Erro ao iniciar os containers Docker."
    echo ""
    echo "Possíveis soluções:"
    echo "1. Verifique se as portas 8000, 3307 e 8081 estão disponíveis"
    echo "2. Se o XAMPP estiver em execução, feche-o e tente novamente"
    echo "3. Para ver detalhes do erro, execute: docker-compose logs"
    echo ""
fi 