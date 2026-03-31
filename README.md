# Taskit

Aplicação web para **gestão de projetos e tarefas** com foco em organização visual, acompanhamento de progresso e uma interface moderna inspirada em dashboards mobile.

---

## ✨ Visão geral

O `Taskit` permite que usuários autenticados:

- criem e editem projetos;
- adicionem tarefas vinculadas a cada projeto;
- acompanhem status como **a fazer**, **em andamento** e **concluído**;
- visualizem métricas rápidas no `dashboard`;
- gerenciem tudo em um layout consistente com identidade visual lilás/card-based.

---

## 🚀 Funcionalidades principais

### Autenticação
- login, registro e recuperação de senha com `Laravel Breeze`;
- área protegida para cada usuário;
- edição de perfil.

### Projetos
- CRUD completo de projetos;
- visualização de detalhes do projeto;
- contagem de tarefas por status;
- progresso geral por projeto.

### Tarefas
- CRUD completo de tarefas dentro de cada projeto;
- vínculo aninhado com rotas do tipo `projects.tasks.*`;
- validação de acesso por usuário/projeto;
- organização por status.

### Interface
- landing page pública personalizada;
- dashboard com cards de resumo;
- telas redesenhadas de projetos e tarefas;
- estilização com `Tailwind CSS` + `Vite`.

---

## 🧱 Stack utilizada

| Camada | Tecnologia |
|---|---|
| Backend | `PHP 8.3`, `Laravel 13` |
| Frontend | `Blade`, `Tailwind CSS`, `Alpine.js` |
| Build | `Vite` |
| Auth | `Laravel Breeze` |
| Testes | `Pest` / `PHPUnit` |

---

## 📂 Estrutura principal

```text
app/Http/Controllers/
resources/views/
  dashboard.blade.php
  welcome.blade.php
  projects/
    index.blade.php
    show.blade.php
    create.blade.php
    edit.blade.php
    tasks/
routes/web.php
```

---

## ▶️ Como rodar o projeto

### 1. Instalar dependências
```bash
composer install
npm install
```

### 2. Configurar ambiente
```bash
copy .env.example .env
php artisan key:generate
```

> Se preferir usar `SQLite`, crie o arquivo `database/database.sqlite` e ajuste o `.env`.

### 3. Rodar migrations
```bash
php artisan migrate
```

### 4. Subir ambiente de desenvolvimento
```bash
composer run dev
```

Isso inicia:
- servidor Laravel
- fila/listener
- logs com `pail`
- Vite em modo dev

---

## 🛠️ Comandos úteis

```bash
# Rodar frontend em produção
npm run build

# Executar testes
php artisan test

# Limpar e recachear views
php artisan view:clear
php artisan view:cache
```

---

## 🔐 Rotas principais

| Rota | Descrição |
|---|---|
| `/` | Landing page pública |
| `/login` | Login |
| `/register` | Cadastro |
| `/dashboard` | Resumo geral do usuário |
| `/projects` | Lista de projetos |
| `/projects/{project}` | Detalhes do projeto |
| `/projects/{project}/tasks` | Lista de tarefas do projeto |

---

## ✅ Status atual

Validação mais recente do projeto:

- `npm run build` → **ok**
- `php artisan test` → **30 testes passando**

---

## 📌 Objetivo do projeto

Este projeto foi construído para demonstrar um fluxo completo de **gestão de projetos e tarefas** com Laravel, unindo:

- autenticação;
- autorização por usuário;
- CRUD aninhado;
- dashboard visual;
- interface refinada e consistente.

---

## 📄 Licença

Projeto disponível sob a licença `MIT`.
