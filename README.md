# 🚀 TaskFlow - Gestão Inteligente de Tarefas

![Status](https://img.shields.io/badge/Status-Conclu%C3%ADdo-brightgreen)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

O **TaskFlow** é um sistema completo de gerenciamento de tarefas (To-Do List Avançado) desenvolvido para ajudar na organização e produtividade. O foco do projeto foi aplicar o padrão MVC (Model-View-Controller) e garantir a persistência de dados segura.



## 🛠️ Funcionalidades Principais

- **CRUD Completo:** Criação, leitura, atualização e exclusão de tarefas.
- **Persistência de Dados:** Integração robusta com MySQL para armazenamento seguro.
- **Interface Responsiva:** Painel administrativo moderno construído com Tailwind CSS.
- **Filtros e Status:** Organização de tarefas por prioridade ou status de conclusão.
- **Segurança:** Tratamento de inputs para evitar SQL Injection (nativo do Eloquent ORM).

## 🏗️ Arquitetura Técnica

- **Backend:** PHP com Framework **Laravel 10/11**, utilizando o motor de templates Blade.
- **Banco de Dados:** **MySQL** com relacionamentos estruturados.
- **Frontend:** **Tailwind CSS** para uma UI limpa e focada na experiência do usuário (UX).
- **ORM:** **Eloquent** para manipulação simplificada do banco de dados.

## 📂 Estrutura do Projeto

```text
├── app/                # Lógica do Core (Models e Controllers)
├── database/           # Migrations e Seeders do MySQL
├── public/             # Arquivos estáticos (CSS/JS compilados)
├── resources/views/    # Interfaces Blade com Tailwind
└── routes/             # Definição das rotas da aplicação
