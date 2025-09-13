# HyperComputer Barra

![Status](https://img.shields.io/badge/Status-Em%20Produção-green)
![PHP](https://img.shields.io/badge/PHP-8.0+-blue)
![Framework](https://img.shields.io/badge/Framework-MVC-purple)
![License](https://img.shields.io/badge/License-Proprietary-red)

## 🖥️ Sobre o Sistema

**HyperComputer Barra** é um sistema web robusto desenvolvido pela Analítica Soluções, construído com arquitetura MVC moderna e integração com serviços avançados como Twilio para comunicação e TCPDF para geração de documentos.

### 🎯 Características Principais
- Arquitetura MVC completa
- Sistema de mensageria integrado
- Geração de relatórios em PDF
- Integração com APIs Twilio
- Sistema de backup automatizado
- Gerenciamento de usuários e clientes
- Interface administrativa avançada

## 🏗️ Arquitetura do Sistema

O sistema utiliza uma arquitetura MVC robusta com separação clara de responsabilidades e padrões de desenvolvimento modernos:

### 📁 Estrutura Completa do Projeto

```
hypercomputerbarra/
├── app/                           # Core da aplicação
│   ├── backup/                   # Sistema de backup
│   │   ├── export/              # Exportação de dados
│   │   └── import/              # Importação de dados
│   ├── Controllers/             # Controladores MVC
│   ├── Core/                    # Núcleo do framework
│   ├── cronjobs/               # Tarefas agendadas
│   ├── docs/                   # Documentação do sistema
│   ├── Models/                 # Modelos de dados
│   ├── reports/                # Sistema de relatórios
│   ├── Repositories/           # Camada de acesso a dados
│   ├── Services/               # Serviços de negócio
│   ├── sql/                    # Scripts SQL
│   ├── Src/                    # Bibliotecas externas
│   │   ├── TCPDF/             # Geração de PDFs
│   │   │   ├── config/        # Configurações TCPDF
│   │   │   ├── examples/      # Exemplos de uso
│   │   │   ├── fonts/         # Fontes para PDF
│   │   │   ├── include/       # Arquivos de inclusão
│   │   │   └── tools/         # Ferramentas TCPDF
│   │   └── Twilio/            # Integração Twilio
│   │       ├── Base/          # Classes base Twilio
│   │       ├── Exceptions/    # Tratamento de exceções
│   │       ├── Http/          # Cliente HTTP
│   │       ├── Jwt/           # Autenticação JWT
│   │       ├── Rest/          # APIs REST Twilio
│   │       │   ├── Api/       # API principal
│   │       │   ├── Chat/      # Serviços de chat
│   │       │   ├── Messaging/ # Sistema de mensagens
│   │       │   ├── Voice/     # Serviços de voz
│   │       │   └── Video/     # Serviços de vídeo
│   │       ├── Security/      # Segurança
│   │       ├── TaskRouter/    # Roteamento de tarefas
│   │       └── TwiML/         # Twilio Markup Language
│   └── Views/                  # Camada de apresentação
│       ├── client/            # Views de clientes
│       ├── messages/          # Views de mensagens
│       ├── os/                # Views do sistema
│       ├── templates/         # Templates globais
│       │   └── reports/       # Templates de relatórios
│       └── user/              # Views de usuários
├── config/                     # Configurações do sistema
├── public_html/               # Diretório público
│   ├── css/                  # Folhas de estilo
│   ├── favicon/              # Ícones do site
│   └── img/                  # Imagens do sistema
└── vendor/                    # Dependências do Composer
```

## 🚀 Funcionalidades Principais

### 🏛️ **Arquitetura MVC**
- **Controllers:** Lógica de controle e roteamento
- **Models:** Modelagem de dados e regras de negócio
- **Views:** Interface do usuário e templates
- **Repositories:** Padrão Repository para acesso a dados
- **Services:** Camada de serviços de negócio

### 📱 **Integração Twilio**
- **Mensageria:** SMS e WhatsApp
- **Chamadas de Voz:** Sistema de telefonia
- **Chat:** Conversas em tempo real
- **Vídeo:** Conferências e chamadas de vídeo
- **Autenticação:** Sistema JWT integrado
- **TaskRouter:** Distribuição inteligente de tarefas

### 📄 **Geração de Documentos (TCPDF)**
- **Relatórios PDF:** Geração dinâmica de documentos
- **Múltiplas Fontes:** Suporte a várias tipografias
- **Código de Barras:** Geração automática
- **Templates:** Sistema de templates para PDFs
- **Configuração Flexível:** Personalização completa

### 🔄 **Sistema de Backup**
- **Export/Import:** Exportação e importação de dados
- **Backup Automatizado:** Rotinas de backup via cronjobs
- **Recuperação:** Sistema de restauração de dados
- **Versionamento:** Controle de versões de backup

### 📊 **Sistema de Relatórios**
- **Relatórios Dinâmicos:** Geração sob demanda
- **Templates Personalizáveis:** Layouts flexíveis
- **Múltiplos Formatos:** PDF, Excel, CSV
- **Filtros Avançados:** Seleção de dados específicos

### 👥 **Gestão de Usuários**
- **Perfis de Cliente:** Gestão completa de clientes
- **Sistema de Usuários:** Controle de acesso
- **Mensageria Interna:** Sistema de comunicação
- **Dashboards Personalizados:** Interface por perfil

## 🛠️ Tecnologias e Dependências

### **Backend:**
- **PHP** 8.0+
- **Arquitetura MVC** personalizada
- **MySQL** para persistência de dados
- **Composer** para gerenciamento de dependências

### **Bibliotecas Principais:**
- **TCPDF** - Geração de PDFs avançados
- **Twilio SDK** - Comunicação multicanal
- **Custom MVC Framework** - Framework proprietário

### **Frontend:**
- **HTML5/CSS3** com design responsivo
- **JavaScript** para interatividade
- **Templates** modulares e reutilizáveis

## 📋 Pré-requisitos

### **Servidor:**
- **PHP** 8.0 ou superior
- **MySQL** 5.7+ ou MariaDB 10.3+
- **Apache** ou **Nginx**
- **Composer** instalado globalmente

### **Extensões PHP Necessárias:**
```bash
php-mysqli
php-pdo
php-mbstring
php-curl
php-gd
php-json
php-xml
php-zip
php-openssl
```

### **Configurações Twilio:**
- Conta ativa no Twilio
- Account SID e Auth Token
- Números de telefone configurados
- Webhook URLs configuradas

## 🚀 Instalação

### 1. **Clone o Repositório**
```bash
git clone https://github.com/analiticasolucoes/hypercomputerbarra.git
cd hypercomputerbarra
```

### 2. **Configuração do Ambiente**
```bash
# Instale as dependências
composer install

# Configure permissões
chmod -R 755 app/backup/
chmod -R 755 public_html/
chmod -R 644 config/
```

### 3. **Configuração do Banco de Dados**
```sql
-- Crie o banco de dados
CREATE DATABASE hypercomputer_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Execute os scripts SQL
source app/sql/database_structure.sql;
source app/sql/initial_data.sql;
```

### 4. **Configuração de Ambiente**
```bash
# Configure arquivo de configuração
cp config/config.example.php config/config.php

# Edite as configurações
nano config/config.php
```

### 5. **Configuração do Twilio**
```php
// config/twilio.php
return [
    'account_sid' => 'seu_account_sid',
    'auth_token' => 'seu_auth_token',
    'phone_number' => '+5527XXXXXXXXX'
];
```

### 6. **Configuração de Cronjobs**
```bash
# Adicione no crontab
crontab -e

# Exemplo de cronjobs
0 2 * * * /usr/bin/php /path/to/app/cronjobs/backup_daily.php
0 */6 * * * /usr/bin/php /path/to/app/cronjobs/cleanup_temp.php
```

## 🔧 Configuração do Servidor Web

### **Apache (.htaccess)**
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ public_html/index.php?url=$1 [QSA,L]

# Proteção de diretórios sensíveis
<Directory "app/">
    Require all denied
</Directory>

<Directory "config/">
    Require all denied
</Directory>
```

### **Nginx**
```nginx
server {
    listen 80;
    root /path/to/hypercomputerbarra/public_html;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?url=$uri&$args;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Bloquear acesso a diretórios sensíveis
    location ~ ^/(app|config|vendor)/ {
        deny all;
    }
}
```

## 📊 Módulos do Sistema

### 🏠 **Core (app/Core/)**
- **Router:** Sistema de roteamento de URLs
- **Database:** Camada de abstração do banco
- **Auth:** Sistema de autenticação
- **Validation:** Validação de dados
- **Session:** Gerenciamento de sessões

### 🎛️ **Controllers (app/Controllers/)**
- **UserController:** Gestão de usuários
- **ClientController:** Gestão de clientes
- **MessageController:** Sistema de mensagens
- **ReportController:** Geração de relatórios
- **BackupController:** Operações de backup

### 💾 **Models (app/Models/)**
- **User:** Modelo de usuários
- **Client:** Modelo de clientes
- **Message:** Modelo de mensagens
- **Report:** Modelo de relatórios
- **SystemLog:** Logs do sistema

### 🔄 **Services (app/Services/)**
- **TwilioService:** Integração com Twilio
- **PDFService:** Geração de PDFs
- **BackupService:** Operações de backup
- **NotificationService:** Sistema de notificações
- **ReportService:** Geração de relatórios

### 📱 **Views (app/Views/)**
- **Layout Principal:** Template base do sistema
- **Dashboard:** Painéis administrativos
- **Formulários:** Interfaces de entrada de dados
- **Relatórios:** Templates de relatórios
- **Mensagens:** Interface de comunicação

## 🔐 Segurança

### **Medidas Implementadas:**
- **Validação de Entrada:** Sanitização de todos os dados
- **Prepared Statements:** Proteção contra SQL Injection
- **CSRF Protection:** Tokens de proteção CSRF
- **Session Security:** Configurações seguras de sessão
- **File Upload Security:** Validação rigorosa de uploads
- **Access Control:** Sistema de permissões por módulo

### **Configurações de Segurança:**
```php
// config/security.php
return [
    'password_policy' => [
        'min_length' => 8,
        'require_uppercase' => true,
        'require_lowercase' => true,
        'require_numbers' => true,
        'require_symbols' => true
    ],
    'session' => [
        'timeout' => 1800, // 30 minutos
        'secure' => true,
        'httponly' => true
    ],
    'csrf' => [
        'enabled' => true,
        'token_lifetime' => 3600
    ]
];
```

## 📈 Performance e Otimização

### **Estratégias de Performance:**
- **Cache de Queries:** Cache inteligente de consultas
- **Lazy Loading:** Carregamento sob demanda
- **Database Indexing:** Índices otimizados
- **Asset Minification:** Compressão de CSS/JS
- **CDN Ready:** Preparado para CDN

### **Monitoramento:**
- **System Logs:** Logs detalhados do sistema
- **Performance Metrics:** Métricas de desempenho
- **Error Tracking:** Rastreamento de erros
- **Usage Analytics:** Análise de uso

## 🧪 Desenvolvimento e Testes

### **Ambiente de Desenvolvimento:**
```bash
# Configuração para desenvolvimento
cp config/config.dev.php config/config.php

# Servidor de desenvolvimento
php -S localhost:8000 -t public_html/
```

### **Estrutura de Testes:**
- **Unit Tests:** Testes unitários dos modelos
- **Integration Tests:** Testes de integração
- **API Tests:** Testes das APIs Twilio
- **E2E Tests:** Testes end-to-end

### **Padrões de Código:**
- **PSR-12:** Padrão de codificação PHP
- **MVC Pattern:** Arquitetura Model-View-Controller
- **Repository Pattern:** Padrão Repository
- **Service Layer:** Camada de serviços
- **Dependency Injection:** Injeção de dependências

## 📚 Documentação Adicional

### **Documentos Disponíveis:**
- `app/docs/` - Documentação técnica completa
- **API Reference** - Documentação das APIs
- **Database Schema** - Esquema do banco de dados
- **Deployment Guide** - Guia de implantação
- **Troubleshooting** - Solução de problemas

### **Guias Específicos:**
- **Twilio Integration Guide** - Integração com Twilio
- **PDF Generation Guide** - Geração de PDFs
- **Backup & Recovery** - Backup e recuperação
- **Security Best Practices** - Melhores práticas de segurança

## 🤖 Automação (Cronjobs)

### **Tarefas Automatizadas:**
```bash
# app/cronjobs/
├── backup_daily.php      # Backup diário
├── cleanup_temp.php      # Limpeza de arquivos temporários
├── send_notifications.php # Envio de notificações
├── generate_reports.php   # Geração automática de relatórios
└── sync_external_data.php # Sincronização de dados externos
```

### **Configuração de Crontab:**
```bash
# Backup diário às 2h
0 2 * * * /usr/bin/php /path/to/app/cronjobs/backup_daily.php

# Limpeza a cada 6 horas
0 */6 * * * /usr/bin/php /path/to/app/cronjobs/cleanup_temp.php

# Relatórios semanais (domingo às 8h)
0 8 * * 0 /usr/bin/php /path/to/app/cronjobs/generate_reports.php
```

## 📞 Suporte e Contato

**Analítica Soluções**
- 🌐 Website: [analiticasolucoes.com.br](https://analiticasolucoes.com.br)
- 📧 Email: contato@analiticasolucoes.com.br
- 📱 Telefone: (27) 98882-6711
- 💬 Suporte Técnico: suporte@analiticasolucoes.com.br

## 🤝 Contribuição

### **Como Contribuir:**
1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-feature`)
3. Siga os padrões de código estabelecidos
4. Adicione testes para novas funcionalidades
5. Commit suas mudanças (`git commit -m 'Adiciona nova feature'`)
6. Push para a branch (`git push origin feature/nova-feature`)
7. Abra um Pull Request

### **Guidelines:**
- Seguir PSR-12 para código PHP
- Documentar todas as funções públicas
- Incluir testes para novas features
- Manter compatibilidade com versões anteriores

## 📄 Licença

Este projeto é propriedade da **Analítica Soluções**. Todos os direitos reservados.

## 📝 Changelog

### **Versão 3.0.0** - (2025-09-12)
- Integração completa com Twilio SDK
- Sistema de backup automatizado
- Nova arquitetura MVC
- Melhorias de performance

### **Versão 2.1.0** - (2025-08-01)
- Implementação do sistema de relatórios
- Integração TCPDF aprimorada
- Sistema de cronjobs
- Otimizações de segurança

### **Versão 2.0.0** - (2025-06-15)
- Refatoração completa da arquitetura
- Implementação do padrão Repository
- Sistema de serviços
- Nova interface de usuário

---

**Desenvolvido com ❤️ pela equipe Analítica Soluções**

*"HyperComputer Barra - Soluções tecnológicas avançadas"*