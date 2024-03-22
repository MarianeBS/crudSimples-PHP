## CRUD PHP

Neste projeto, estou utilizando Docker. No entanto, caso opte por utilizar XAMPP, o arquivo principal do projeto está localizado na pasta "src/". É essa pasta que deve ser aberta no XAMPP para acessar e executar o projeto.

## Inicialização do Projeto

Para começar a usar o Projeto Mega, você precisa ter o Composer instalado. Se você ainda não tem o Composer, visite [Get Composer](https://getcomposer.org/) para instruções de instalação.

Uma vez que o Composer esteja instalado, clone o repositório e instale as dependências:

```bash
cd src
composer install
```

## Estrutura Banco de Dados

```sql
CREATE TABLE clientes (
    cliente_id int NOT NULL AUTO_INCREMENT,
    nome varchar(255) DEFAULT NULL,
    email varchar(255) DEFAULT NULL,
    cidade varchar(255) DEFAULT NULL,
    estado varchar(2) DEFAULT NULL,
    PRIMARY KEY (cliente_id)
);
```

```sql
CREATE TABLE `mega` (
  `id` int NOT NULL AUTO_INCREMENT,
  `num1` char(2) DEFAULT NULL,
  `num2` char(2) DEFAULT NULL,
  `num3` char(2) DEFAULT NULL,
  `num4` char(2) DEFAULT NULL,
  `num5` char(2) DEFAULT NULL,
  `num6` char(2) DEFAULT NULL,
  `data` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

## Demo

<img src="https://github.com/MarianeBS/crudSimples-PHP/blob/develop/demo.gif" style="width:48px;height:48px;">
