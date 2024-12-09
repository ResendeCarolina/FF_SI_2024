# TO-DO List para o Projeto Fast & Furious Cars Inc.

## Funcionalidades Obrigatórias

### Etapa 1: Configuração Inicial e Registro______________________________Carolina
- [x] Configurar ambiente de desenvolvimento (PHP, PostgreSQL, PHPStorm, ONDA)
- [x] Configurar conexão com a base de dados PostgreSQL
- [x] Implementar o sistema de **Registro de Cliente**
  - [x] Formulário de registro com campos: Nome, Email, Senha
  - [x] Geração de saldo fictício no momento do registro

### Etapa 2: Autenticação de Usuário__________________________________Carolina
- [x] Implementar o sistema de **Login e Logout** para Clientes
  - [x] Exibir o nome do cliente em todas as páginas após o login
- [x] Implementar o sistema de **Login e Logout** para Administradores
  - [x] Exibir o nome do administrador em todas as páginas após o login

### Etapa 3: Funcionalidades do Cliente______________________________Maria
- [x] **Listar Carros Disponíveis** para reserva
  - [x] Página que mostra todos os carros disponíveis com detalhes básicos
- [x] **Reserva de Carros** para clientes
  - [x] Formulário para solicitar uma reserva indicando o carro e o período de tempo desejado
  - [ ] Verificação de disponibilidade do carro para o período selecionado
- [x] **Visualizar Histórico de Reservas**
  - [x] Listar reservas passadas e futuras do cliente

### Etapa 4: Pesquisa e Filtros________________________________Carolina
- [x] Implementar **Pesquisa e Filtros de Carros**
  - [x] Filtro por marca, número de lugares, custo máximo por dia, etc.
  - [x] Opção de ordenação dos resultados (por preço, marca, etc.)

### Etapa 5: Funcionalidades do Administrador_________________________Maria
- [x] **Visualizar todos os Carros** com detalhes e estatísticas
  - [x] Número de reservas e períodos de reserva para cada carro
- [x] **Adicionar Novo Carro** ao sistema
  - [x] Formulário de criação com detalhes do carro e custo diário para novas reservas
- [x] **Alterar Visibilidade do Carro**
  - [ ] Função para ocultar carros que não estão alugados ou têm reservas futuras
  - [x] Função para tornar um carro oculto visível novamente
- [x] **Alterar Custo de Reserva de um Carro**
  - [x] Implementar histórico de preços para rastrear alterações ao longo do tempo

### Etapa 6: Estatísticas Administrativas__________________Maria
- [x] **Visualizar Estatísticas Gerais do Sistema**
  - [x] Total de carros
  - [x] Total de utilizadores que já reservaram carros
  - [x] Número médio de reservas por utilizador
  - [x] Custo médio de um carro com base nos preços atuais
  - [x] Uma estatística adicional relevante (ex.: carro mais reservado)

## Funcionalidades Opcionais (Melhorias)

### Melhorias na Experiência do Cliente
- [ ] **Sistema de Notificações** para informar status de reservas
- [ ] **Avaliação de Carros** pelos clientes (nota e comentários)
- [ ] **Histórico Completo de Transações** para clientes, incluindo valores pagos e saldo atual
- [ ] **Pesquisa Avançada** com mais opções, como cor, ano, e local do carro

### Melhorias na Gestão pelo Administrador
- [ ] **Relatório Detalhado** de Utilização de Carros (uso, ocupação média)
- [ ] **Painel de Controle Gráfico** com gráficos de reservas e de uso da frota
- [ ] **Gestão de Usuários** - Ferramenta para bloquear clientes em caso de má conduta
- [ ] **Gestão de Promoções** - Possibilidade de criar promoções de preço para períodos específicos

### Integração e Automação
- [ ] **Integração com Email** para enviar confirmações de reserva e notificações
- [ ] **Sistema de Feedback** para melhorar o serviço com base nas avaliações dos clientes
- [ ] **Automação de Limpeza de Dados** para remover reservas antigas ou inativas

---

## Ordem de Implementação Recomendada

1. Configuração Inicial e Registro
2. Autenticação de Usuário (Login e Logout)
3. Funcionalidades do Cliente (Listar Carros, Reservar, Visualizar Histórico)
4. Pesquisa e Filtros de Carros
5. Funcionalidades do Administrador (Visualizar Carros, Adicionar Carro, Alterar Visibilidade e Preço)
6. Estatísticas Administrativas

**Funcionalidades Opcionais** podem ser implementadas após as obrigatórias, se houver tempo, seguindo a ordem de prioridade para melhorias da experiência do cliente e facilidades para o administrador.

---

Essa lista fornece um guia completo das funcionalidades obrigatórias e opcionais para o projeto, estruturadas para um fluxo de desenvolvimento eficiente. 
