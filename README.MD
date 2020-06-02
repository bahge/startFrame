# startFrameWork

## Porque?
Diversos vídeos, post's e leitura me levaram até aqui.

Um miniFrameWork em php com painel administrativo funcional e SQL de ajuda, com instalação do autoload das classes por composer.

Os js, css e fonts auxiliares (JQuery, Bootstrap e Font-awesome) foram baixados nas opções de código livre direto nos sites e disponibilizo aqui pois não foi testadas em outras versões e nessas anexadas estão funcionais.

Be Happy !!

## Como instalar - passo a passo

1. Clonar o repositório;
1. Descompactar na pasta de projetos;
1. Instalar o composer;
    * Na pasta do projeto executar:
    > composer init

    > composer install

1. Criar um banco de dados;
1. Executar o sql **bdMysql.sql** ele criará o banco de dados *users* e o usuário admin inicial
    > login: admin@123

    > pass: 123

1. Preencha o arquivo **cfg.php**: na pasta *web/config*:
    > URL -> endereço do host;

    > DB_HOST -> endereço host do banco de dados;

    > DB_USER -> usuário do banco de dados;

    > DB_PASS -> senha do banco de dados;

    > DB_NAME -> nome da database do banco de dados;

1. Acesse o endereço de host e **BE HAPPY**!

## Funções da versão

A primeira a gente nunca esquece!

Basicamente esta primeira versão apenas aplica a estrutura de MVC a um **controle administrativo de usuário**. 

### Cenas dos próximos capítulos
A proposta para a segunda versão, será adicionar uma camada de *configurações personalizadas*, com o envio de e-mail e geração de botão de contatos, WhattApp e telefone.

Caso ainda não me sigam ative o **Follow** para seguir assim saberão das novidades do FrameWork.

## Funções úteis

### dd -> dar dump :)
A função dd adicionada ao **cfg.php**, 

