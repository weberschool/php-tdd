# TDD e PHP: Primeiros Passos

## Preparando o ambiente

Antes de iniciar qualquer projeto é necessário instalar e preparar seu ambiente de desenvolvimento. No caso do PHP, a primeira coisa é ter ele instalado e configurado corretamente. Isso inclui adicionar o caminho do executável do PHP a sua variável de ambiente PATH.

Além do PHP, usaremos o [Composer](getcomposer.org), uma ferramente essencial para quem trabalha com PHP, pois ela facilita o processo de instalação e gerenciamento de dependências dos nossos projetos.

### Verificando se tudo foi instalado corretamente

Abra o terminal (shell), digite os comandos `php -v` e `composer --version` e veja se as respostas foram  parecidas com isto:
```
$ php -v
PHP 7.0.1 (cli) (built: Dec 26 2015 19:13:09) ( NTS )
Copyright (c) 1997-2015 The PHP Group
Zend Engine v3.0.0, Copyright (c) 1998-2015 Zend Technologies
    with Zend OPcache v7.0.6-dev, Copyright (c) 1999-2015, by Zend Technologies
    with Xdebug v2.4.1, Copyright (c) 2002-2016, by Derick Rethans

$ composer --version
Composer version 1.4.1 2017-03-10 09:29:45
```

## phpspec

O [phpspec](http://www.phpspec.net/en/stable/) é o framework PHP que nos ajuda a construir testes automatizados através de uma abordagem conhecida como Behaviour driven development (BDD), que é a construção de testes no nível de especificação e história de usuários.

> Visite o site do [phpspec](http://www.phpspec.net/en/stable/) para mais detalhes.

A maneira mais simples de instala-lo em nosso projeto é utilizando o Composer, para isso, crie um arquivo `composer.json` no diretório raiz do projeto e execute `composer install`.

Você deverá ter uma resposta parecida com essa:
```
$ composer install
Loading composer repositories with package information
Updating dependencies (including require-dev)
Package operations: 20 installs, 0 updates, 0 removals
  - Installing symfony/yaml (v3.2.8): Loading from cache
  - Installing symfony/process (v3.2.8): Downloading (100%)
  - Installing symfony/finder (v3.2.8): Downloading (100%)
  - Installing symfony/event-dispatcher (v3.2.8): Downloading (100%)
  - Installing psr/log (1.0.2): Loading from cache
  - Installing symfony/debug (v3.2.8): Loading from cache
  - Installing symfony/polyfill-mbstring (v1.3.0): Loading from cache
  - Installing symfony/console (v3.2.8): Loading from cache
  - Installing sebastian/recursion-context (3.0.0): Loading from cache
  - Installing sebastian/exporter (3.1.0): Loading from cache
  - Installing doctrine/instantiator (1.0.5): Loading from cache
  - Installing sebastian/diff (1.4.1): Loading from cache
  - Installing sebastian/comparator (2.0.0): Loading from cache
  - Installing webmozart/assert (1.2.0): Loading from cache
  - Installing phpdocumentor/reflection-common (1.0): Loading from cache
  - Installing phpdocumentor/type-resolver (0.2.1): Loading from cache
  - Installing phpdocumentor/reflection-docblock (3.1.1): Loading from cache
  - Installing phpspec/prophecy (v1.7.0): Loading from cache
  - Installing phpspec/php-diff (v1.1.0): Downloading (100%)
  - Installing phpspec/phpspec (3.4.0): Downloading (100%)
symfony/event-dispatcher suggests installing symfony/dependency-injection ()
symfony/event-dispatcher suggests installing symfony/http-kernel ()
symfony/console suggests installing symfony/filesystem ()
phpspec/phpspec suggests installing phpspec/nyan-formatters (Adds Nyan formatters)
Writing lock file
Generating autoload files
```

Oba! Se chegou até aqui é sinal que deu tudo certo com seu ambiente de desenvolvimento. Sinta-se preparado para criar seus primeiros testes utilizando o phpspec! As próximas seções irão guia-lo na construção desses testes, começando com exemplos bem simples e avançando com o tempo. Happy coding!

## Criando seu primeiro teste com o phpspec

O phpspec possui um CLI (Command Line Interactive) que agiliza muito nosso trabalho, e criar um arquivo de teste com ela é algo bem simples. 

```
$ bin/phpspec describe FizzBuzz
```
> Após o comando, espera-se que seja criado o arquivo `spec/FizzBuzzSpec.php`.

Ele tem a seguinte estrutura:

```
<?php

namespace spec;

use FizzBuzz;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FizzBuzzSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FizzBuzz::class);
    }
}
```

> Existem duas coisas importantes aqui. Primeiro, o phpspec só considera como um comportamento do teste os metódos iniciados com `it_` e `its_`. E segundo, é recomendado escrever métodos separados por undercore (_) ao invés de CamelCasing. Por quê? Não acha `mais_facil_ler_assim_assim` do que utilizando `CamelCasingAssimDessaManeira`? Nós achamos que sim, por isso, criaremos dessa maneira a partir de agora.

### Executando os testes

Agora que já temos nossa especificação de teste criado, chegou a hora de executa-lo. Obviamente ele irá falhar, pois ainda não criamos nossa classe `FizzBuzz`.

No terminal, digite `bin/phpspec run` e veja o resultado abaixo:

![phpspec run](http://i.imgur.com/JJ8tsbT.png)

Uma funcionalidade legal do phpspec é que ele sugere a criação da classe quando ela não existe, normalmente na primeira vez. Perceba que na imagem acima, após executar o teste, ele pergunta se você deseja criar a classe `FizzBuzz`. Viu? Diga se isso não é cool :)

Agora que já temos a classe `FizzBuzz`, a brincadeira começa a ficar interessante, vamos então escrever as especificações da nossa classe.

### Teste de Mesa

O objetivo do FizzBuzz é exibir uma lista de números de 1 à 100, sendo que:

* Números múltiplos de 3 deve aparecer a palavra `fizz`;
* Números múltiplos de 5 deve aparecer a palavra `buzz`;
* E, números múliplos de 3 e 5 deve aparecer a palavra `fizzbuzz`;

Exemplo:
```
1, 2, fizz, 4, buzz, fizz, 7, 8, fizz, buzz, 11, fizz, 13, 14, fizzbuzz, 16,...
```