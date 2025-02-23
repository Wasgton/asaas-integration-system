# Perfect Pay
* Autor: Wasgton Rodrigues Junior

Projeto desenvolvido como avaliação para a  **Perfect Pay**, utilizando Laravel.


#### Introdução

- O Projeto é um sistema desenvolvido em PHP utilizando o framework **Laravel (v11.43.0)**. Este sistema fornece opções de pagamento e processamento de transações integrando com a API da Asaas.
---

#### Como rodar localmente

#### Pré-requisitos
Certifique-se de ter as dependências abaixo instaladas:
- [x] Docker;
- [x] Docker compose.

#### Executando
1. Clone o repositório:
```shell
git clone https://github.com/Wasgton/asaas-integration-system.git
```

2. Inicie os containers via `docker-compose`:
```shell
docker-compose up -d
```

3. Instale as dependencias do `npm`:
```shell
npm install 
```

4. Execute do build do front-end:
```shell
npm run build 
```

5. Acesse o container PHP usando o comando:
```shell
docker-compose exec php bash
```

6. Para facilitar a execução, o projeto inclui um comando personalizado no composer. Execute:
```shell
composer install
```

Esta etapa instalará todas as dependências, configurará o `.env` automaticamente (baseado no `.env.example`) e executará as migrations necessárias.

###### _Nota_: Por se tratar de um teste deixei as configurações do `.env.example` alinhadas com as definições do arquivo `docker-compose.yml`, tornando o fluxo inicial mais ágil.

7. Adicione o ASAAS_API_KEY com o token da sua conta. 
Ex.:
````
ASAAS_API_KEY=$aact_MzkwODA2MWY2OGM3MWRlMDU2NWM3MzJlNzZmNGZhZGY6OmNjODhlZjE1LTA2OGQtNDlhZi1hZmRhLTg0ZDhmOTI3NDdmZDo6JGFhY2hfNDFlYTgwM2YtNjNlNi00MGY4L3123D3dasdaDg12312dasd3M2UxYzY0Mzdj
ASAAS_BASE_URL=https://sandbox.asaas.com/api/v3/
````

---

#### Testes
Os testes são escritos utilizando **PHPUnit**, garantindo a qualidade do código antes de produção. Para rodar os testes, utilize:

```shell
php artisan test
```

Ou, para um relatório mais detalhado com cobertura do código:

```shell
php artisan test --coverage
```

> Nota: Os testes requerem que o banco de dados esteja configurado e funcional.


---

## Conceitos Utilizados
O desenvolvimento deste projeto utilizou boas práticas e conceitos modernos, incluindo:
- **Desenvolvimento Orientado a Testes (TDD)**: Facilita validação incremental das funcionalidades, garantindo maior segurança nas entregas.
- **Princípios SOLID**: Melhorando a extensibilidade, manutenção e clareza do código.
- **Padrão de Projeto Strategy**: Este padrão foi utilizado para promover a flexibilidade do código ao lidar com
  diferentes comportamentos de forma intercambiável. No contexto deste projeto, o padrão Strategy foi aplicado, na escolha de diferentes métodos de pagamento (como cartões de crédito, débito e PIX)
- **Factory Method**: Ele simplifica a inicialização dos objetos e garante que cada tipo de pagamento seja instanciado corretamente por uma lógica consistente.
- **Service Repository Pattern**: O padrão Service Repository foi utilizado neste projeto como uma camada intermediária
  entre o modelo de dados e a lógica de negócios. Esse padrão contribui para a organização e separação de
  responsabilidades do código, permitindo que:

    - Os **Repositories** atuam como abstrações que lidam diretamente com a interação com o banco de dados, como
      consultas ou manipulação de dados.
    - Os **Services** concentrem a lógica de negócios do sistema, chamando os repositórios e executando as regras
      necessárias para cada funcionalidade.

  Essa divisão facilita não apenas a manutenção e testabilidade do código, mas também o reaproveitamento de lógica de
  negócios em diferentes partes do sistema.

---

## Pontos a melhorar:

- **Cobertura de testes ampliada**: Expandir a cobertura dos testes unitários e de integração para assegurar que todas
  as funcionalidades estejam devidamente validadas.

- **Gerenciamento de e logs**: Integrar um sistema robusto para rastreamento e gerenciamento logs como Sentry ou Monolog, visando facilitar a depuração e manutenção.

- **Internacionalização (i18n)**: Introduzir suporte a multi-idiomas para ampliar o alcance do sistema em diferentes
  regiões.

- **Adicionar opção de parcelamento no cartão de crédito.**
- **Adicionar mecanismo para atualizar status de pagamento de boleto.**


Projeto desenvolvido utilizando **Laravel**, buscando conciliar práticas modernas de desenvolvimento de software com recursos eficientes para aplicativos de alta performance.