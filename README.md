<div align="center">

# 🌊 SurfCrew School

### Do primeiro registo à próxima onda.

**Aplicação web para a gestão de uma escola de surf**  
Primeiro projeto académico completo de **Jayelli Braga**

`PHP` · `MySQL` · `PDO` · `HTML5` · `CSS3` · `Bootstrap 5`

[Objetivo](#objetivo) · [Funcionalidades](#funcionalidades-implementadas) · [Capturas](#capturas-de-ecrã) · [Instalação](#instalação-e-execução) · [Aprendizagens](#aprendizagens-e-desafios)

</div>

![Página inicial do SurfCrew School](https://github.com/user-attachments/assets/5deef7c9-9256-41ab-a9c0-5a7752c1b019)

## Sobre o projeto

O **SurfCrew School** é o meu primeiro projeto académico completo, desenvolvido individualmente para colocar em prática os conhecimentos de programação web. Reúne uma interface para apresentar uma escola de surf, uma área de aluno e um painel administrativo, com informação guardada numa base de dados MySQL.

Este projeto marca a passagem dos exercícios isolados para uma aplicação com várias páginas, autenticação, sessões, formulários e relações entre dados.

## Objetivo

Centralizar a consulta e a gestão de aulas de uma escola de surf. Os visitantes podem conhecer a escola e consultar horários e preços; os alunos podem criar conta, consultar aulas e gerir as suas inscrições; a administração pode organizar as aulas e os utilizadores.

O cenário escolhido permitiu trabalhar um fluxo completo: **conhecer a escola → criar conta → iniciar sessão → escolher uma aula → consultar a inscrição**.

## Funcionalidades implementadas

| Área | O que permite fazer |
| --- | --- |
| Página pública | Apresentar a escola, a localização, os horários e os preços. |
| Registo e login | Criar uma conta de aluno, autenticar o utilizador e terminar a sessão. |
| Área do aluno | Consultar e editar o perfil, aceder ao mapa de aulas e às próprias inscrições. |
| Mapa de aulas | Consultar data, hora, duração, local, nível, instrutor, estado e vagas disponíveis. |
| Inscrições | Inscrever e desinscrever o aluno de uma aula; apresentar mensagem quando já existe uma inscrição. |
| As minhas aulas | Consultar as aulas em que o aluno está inscrito, o estado da aula e o estado da inscrição. |
| Gestão de aulas | Criar, listar, editar e remover aulas pelo painel administrativo. |
| Gestão de utilizadores | Criar, listar, editar e remover utilizadores; distinguir alunos, instrutores e administradores. |
| Inscrição pela administração | Associar utilizadores a aulas através da área de gestão. |

O registo utiliza `password_hash()` e o login utiliza `password_verify()`. A comunicação com a base de dados é feita através de PDO, com consultas preparadas nos fluxos de registo, login e inscrições.

**Estado da recuperação de palavra-passe:** existe uma página com o formulário, mas o envio de email e a reposição da palavra-passe ainda não estão implementados.

## Tecnologias utilizadas

| Tecnologia | Utilização no projeto |
| --- | --- |
| HTML5 | Estrutura das páginas e formulários. |
| CSS3 | Identidade visual, cores, cartões e apresentação dos conteúdos. |
| Bootstrap 5 | Grelha, componentes de interface e navegação; inclui o JavaScript do Bootstrap. |
| PHP | Processamento de formulários, sessões, autenticação e lógica da aplicação. |
| MySQL / SQL | Armazenamento e consulta de utilizadores, aulas e inscrições. |
| PDO | Ligação entre o PHP e a base de dados. |
| XAMPP / Apache | Ambiente de execução local. |

## Capturas de ecrã

Capturas reais da aplicação, organizadas pelo percurso do utilizador. Clique numa imagem para a abrir no tamanho original.

### Conhecer a escola

| Horários | Preços e acesso às aulas |
| --- | --- |
| ![Horários de verão e inverno](https://github.com/user-attachments/assets/77dc4c83-3ca3-4608-bca2-393ce1d9b217) | ![Preços e mapa de aulas na página pública](https://github.com/user-attachments/assets/7f5b499e-91e8-434e-b538-e76e11783696) |

### Entrar na aplicação

| Login | Criar conta |
| --- | --- |
| ![Formulário de login](https://github.com/user-attachments/assets/589e64ce-01b1-488b-8b04-1dd445dbf0b7) | ![Formulário de criação de conta](https://github.com/user-attachments/assets/e98438d2-f77e-41ac-bfbb-789ff63d4bba) |

### Área do aluno

![Perfil do aluno e acesso ao dashboard](https://github.com/user-attachments/assets/fe936df6-06af-4d84-bc41-d6894ace621b)

| Mapa de aulas | As minhas aulas |
| --- | --- |
| ![Aulas disponíveis e opção de inscrição ou desinscrição](https://github.com/user-attachments/assets/9bc56750-bf7b-4400-8143-ad36d620e365) | ![Aulas e inscrições do aluno](https://github.com/user-attachments/assets/b09dc121-4f05-4c16-a5bb-bf8004cd42a3) |

### Área administrativa

![Painel do administrador](https://github.com/user-attachments/assets/62aa8e46-3599-4f61-9f1d-e4fe5ea6130c)

| Utilizadores | Aulas |
| --- | --- |
| ![Lista de utilizadores com ações de gestão](https://github.com/user-attachments/assets/6b3e1e2d-56fc-423c-b8f0-6b8568433d49) | ![Lista de aulas com ações de gestão](https://github.com/user-attachments/assets/07fb1315-ce1d-432f-80a6-d6cc02a0cef6) |

<details>
<summary><strong>Ver formulário de criação de aula</strong></summary>

![Criação de aula com instrutor, data, hora, local, nível, vagas e estado](https://github.com/user-attachments/assets/77fc09c7-5bad-421e-a2b1-337000790b19)

</details>

## Instalação e execução

### Requisitos

- XAMPP ou ambiente equivalente com Apache, PHP e MySQL/MariaDB.
- PHP com a extensão `pdo_mysql` ativa; PHP 8 é recomendado.
- Navegador e acesso ao phpMyAdmin, ou outro cliente MySQL.
- Ligação à Internet para carregar o Bootstrap a partir do CDN e os conteúdos externos da página.

### 1. Colocar os ficheiros no servidor local

Descarregue o projeto. Coloque a pasta que contém `index.php`, `admin/`, `auth/` e `assets/` no diretório público do Apache, com o nome **surfscrewschool**.

No XAMPP para Windows, a estrutura deverá ser:

```text
C:/xampp/htdocs/surfscrewschool/index.php
```

Se obtiver os ficheiros através do repositório GitHub, a pasta da aplicação pode estar identificada como `surfcrew/`: copie o seu conteúdo para `htdocs/surfscrewschool/`.

### 2. Iniciar os serviços

No painel do XAMPP, inicie **Apache** e **MySQL**. Abra `http://localhost/phpmyadmin/`.

### 3. Importar a base de dados

Importe o ficheiro:

```text
src/database/sql/tabela.sql
```

**Atenção:** o script contém `DROP DATABASE IF EXISTS SURF`, seguido da criação da base de dados. Execute-o num ambiente de teste: uma base de dados `SURF` já existente será apagada.

O script cria a estrutura das tabelas, mas não inclui contas nem aulas de demonstração.

### 4. Configurar a ligação

Em `src/includes/db.php`, adapte estes valores ao seu ambiente:

```php
$host = 'localhost';
$port = 3306;
$db = 'SURF';
$user = 'root';
$pass = '';
```

Use o nome exato da base de dados criada pelo script. A distinção entre `SURF` e `surf` pode depender do sistema operativo e da configuração do MySQL.

Em `src/includes/head.php`, confirme o endereço base:

```php
$base_url = 'http://localhost/surfscrewschool/';
```

Se utilizar outra pasta ou porta do Apache, ajuste este endereço.

### 5. Abrir e experimentar

Aceda a:

```text
http://localhost/surfscrewschool/
```

Crie uma conta pela página **Criar Conta** e inicie sessão. O novo registo tem o tipo `Aluno`.

Para experimentar a área administrativa numa instalação local, altere o campo `Tipo` da sua conta de teste para `Admin`, através do phpMyAdmin, e volte a iniciar sessão. No painel, crie um utilizador do tipo `Instrutor` antes de criar uma aula associada a esse instrutor.

Crie aulas com datas atuais ou futuras: o mapa de aulas apresenta as aulas a partir da data corrente. As capturas de ecrã ilustram uma instalação com dados de teste já preenchidos.

## Organização dos ficheiros

| Pasta ou ficheiro | Conteúdo |
| --- | --- |
| `admin/` | Operações de gestão de aulas e utilizadores. |
| `auth/` | Registo, login, logout e formulário de recuperação de palavra-passe. |
| `assets/` | Folhas de estilo e imagens da aplicação. |
| `pages/` | Página inicial, horários/preços, mapa de aulas e inscrições do aluno. |
| `user/` | Perfil do aluno e painel administrativo. |
| `src/includes/` | Ligação à base de dados, cabeçalho, navegação e rodapé. |
| `src/database/sql/` | Script SQL e documentação do modelo de dados. |
| Capturas de ecrã | Imagens reais alojadas nos anexos do GitHub e apresentadas neste README. |
| `index.php` | Entrada da aplicação. |

## Aprendizagens e desafios

Ao desenvolver o SurfCrew, trabalhei a ligação entre a interface e a base de dados: receber os dados de um formulário, processá-los em PHP, executar consultas SQL e apresentar o resultado ao utilizador.

Os principais desafios e aprendizagens deste primeiro projeto foram:

- **Autenticação e sessões:** manter o utilizador identificado entre páginas e encaminhá-lo para a área correspondente ao seu tipo de conta.
- **Relações entre dados:** associar alunos, instrutores, aulas e inscrições através de identificadores e consultas com `JOIN`.
- **Operações CRUD:** criar, consultar, atualizar e remover informação através de formulários e tabelas de gestão.
- **Inscrições e vagas:** calcular vagas disponíveis, identificar inscrições existentes e apresentar diferentes estados das aulas.
- **Organização:** reutilizar componentes partilhados, como a navegação e o rodapé, e organizar as páginas por área.
- **Interface:** combinar uma identidade visual ligada ao surf com formulários, cartões e painéis construídos com CSS e Bootstrap.

O resultado representa a minha primeira experiência a reunir estas partes numa aplicação académica completa e serve como registo da minha evolução em desenvolvimento web.

## Contexto académico

Desenvolvido individualmente por **[Jayelli Braga](https://github.com/jay-braga)** no âmbito da aprendizagem de programação web.

**Primeiro projeto académico completo · PHP e MySQL · Desenvolvimento web full-stack**

## Licença

Este repositório está disponível sob a [licença MIT](LICENSE).
