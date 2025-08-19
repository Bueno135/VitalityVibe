# VitalityVibe - Sistema de Acompanhamento Nutricional

## 📌 Visão Geral
O **VitalityVibe** é um sistema web projetado para otimizar o atendimento entre nutricionistas e seus clientes, oferecendo um acompanhamento alimentar eficiente e personalizado. O projeto visa facilitar a gestão de planos alimentares, a comunicação entre profissionais e pacientes e a personalização de dietas conforme as necessidades individuais.

## 🎯 Objetivo do Projeto
Criar uma plataforma intuitiva e eficiente que permita aos nutricionistas gerenciar clientes, criar e acompanhar planos alimentares, monitorar restrições dietéticas e facilitar a comunicação para um atendimento mais próximo e personalizado.

## 🛠️ Tecnologias Utilizadas
- **Back-end:** PHP
- **Front-end:** HTML, CSS, JavaScript (com Tailwind CSS)
- **Banco de Dados:** MySQL
- **Armazenamento de Sessões:** Local Storage e sessões PHP

## 🔍 Funcionalidades Principais
### 📋 Para Nutricionistas:
- Cadastro e gerenciamento de clientes
- Criação de planos alimentares personalizados
- Registro de composições nutricionais
- Envio de mensagens e acompanhamento remoto

### 🍎 Para Clientes:
- Acesso ao plano alimentar prescrito
- Registro de refeições e acompanhamento de consumo
- Monitoramento de metas calóricas
- Registro de alergias e restrições alimentares
- Comunicação com o nutricionista

## 🏗️ Estrutura do Banco de Dados
O sistema conta com tabelas bem definidas para otimizar o gerenciamento de dados:
- **Cliente:** Armazena informações dos pacientes
- **Nutricionista:** Dados dos profissionais cadastrados
- **Prato & Ingredientes:** Para definição dos alimentos recomendados
- **PlanoAlimentar:** Relacionado aos clientes e seus respectivos planos
- **Contrato_Cliente_Nutricionista_PlanoAlimentar:** Responsável por estabelecer a relação entre cliente, nutricionista e plano alimentar
- **Mensagens:** Para troca de informações entre cliente e nutricionista

## 🔗 Fluxo de Funcionamento
1. O nutricionista faz login e cadastra clientes.
2. Cria um plano alimentar personalizado para cada paciente.
3. O cliente acessa seu plano e registra suas refeições.
4. O sistema permite o acompanhamento e ajustes conforme necessário.
5. A comunicação entre nutricionista e cliente é facilitada via mensagens dentro da plataforma.

## 📈 Diferenciais do Projeto
- Interface moderna e responsiva
- Sistema seguro com controle de sessões
- Facilidade na personalização de dietas
- Comunicação direta entre nutricionista e paciente

## 🚀 Próximos Passos
- Implementação de relatórios gráficos sobre a evolução nutricional do cliente
- Integração com APIs para sugestão automática de receitas saudáveis
- Implementação de um sistema de notificações e lembretes

## 📢 Conclusão
O **VitalityVibe** se apresenta como uma solução eficiente para nutricionistas e clientes, garantindo um acompanhamento mais próximo e eficaz na jornada alimentar. Com futuras melhorias e otimizações, a plataforma tem potencial para se tornar uma ferramenta essencial no segmento de saúde e nutrição.

