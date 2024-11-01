# TO-DO List para o Projeto Fast & Furious Cars Inc.

## Funcionalidades Obrigatórias

### Etapa 1: Configuração Inicial e Registro
- [ ] Configurar ambiente de desenvolvimento (PHP, PostgreSQL, PHPStorm, ONDA)
- [ ] Configurar conexão com a base de dados PostgreSQL
- [ ] Implementar o sistema de **Registro de Cliente**
  - [ ] Formulário de registro com campos: Nome, Email, Senha
  - [ ] Geração de saldo fictício no momento do registro

### Etapa 2: Autenticação de Usuário
- [ ] Implementar o sistema de **Login e Logout** para Clientes
  - [ ] Exibir o nome do cliente em todas as páginas após o login
- [ ] Implementar o sistema de **Login e Logout** para Administradores
  - [ ] Exibir o nome do administrador em todas as páginas após o login

### Etapa 3: Funcionalidades do Cliente
- [ ] **Listar Carros Disponíveis** para reserva
  - [ ] Página que mostra todos os carros disponíveis com detalhes básicos
- [ ] **Reserva de Carros** para clientes
  - [ ] Formulário para solicitar uma reserva indicando o carro e o período de tempo desejado
  - [ ] Verificação de disponibilidade do carro para o período selecionado
- [ ] **Visualizar Histórico de Reservas**
  - [ ] Listar reservas passadas e futuras do cliente

### Etapa 4: Pesquisa e Filtros
- [ ] Implementar **Pesquisa e Filtros de Carros**
  - [ ] Filtro por marca, número de lugares, custo máximo por dia, etc.
  - [ ] Opção de ordenação dos resultados (por preço, marca, etc.)

### Etapa 5: Funcionalidades do Administrador
- [ ] **Visualizar todos os Carros** com detalhes e estatísticas
  - [ ] Número de reservas e períodos de reserva para cada carro
- [ ] **Adicionar Novo Carro** ao sistema
  - [ ] Formulário de criação com detalhes do carro e custo diário para novas reservas
- [ ] **Alterar Visibilidade do Carro**
  - [ ] Função para ocultar carros que não estão alugados ou têm reservas futuras
  - [ ] Função para tornar um carro oculto visível novamente
- [ ] **Alterar Custo de Reserva de um Carro**
  - [ ] Implementar histórico de preços para rastrear alterações ao longo do tempo

### Etapa 6: Estatísticas Administrativas
- [ ] **Visualizar Estatísticas Gerais do Sistema**
  - [ ] Total de carros
  - [ ] Total de utilizadores que já reservaram carros
  - [ ] Número médio de reservas por utilizador
  - [ ] Custo médio de um carro com base nos preços atuais
  - [ ] Uma estatística adicional relevante (ex.: carro mais reservado)

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
