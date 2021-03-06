![tests](https://github.com/jeyroik/extas-player-current/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-player-current/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a>

# Описание

Пакет содержит обёртку для получения текущего авторизованного пользователя с помощью плагинов.

Содержание
- Установка
- Использование
    - Подключение своего способа авторизации
        - Пример
            - Плагин
            - Запись в extas-совместимой конфигурации
            - Установка плагина
    - Применение

# Установка

`composer require jeyroik/extas-player-current:*`

# Использование

## Подключение своего способа авторизации

Чтобы подключить свой способ авторизации пользователя необходимо лишь реализовать плагин.

Стадия = `extas.player.current`
Вход: `\extas\interfaces\players\IPlayer`
Выход: `void`

### Пример

#### Плагин

```php
namespace my\extas\plugins;

use \extas\components\plugins\Plugin;
use \extas\interfaces\players\IPlayer;
use \extas\interfaces\players\IPlayerRepository;

class PluginCookieCurrentPlayer extends Plugin
{
    public function __invoke(IPlayer &$player)
    {
        if (isset($_COOKIE['extas.player'])) {
            $playerName = $_COOKIE['extas.player'];
            /**
             * var $playerRepo IPlayerRepository
             */
            $playerRepo = SystemContainer::getItem(IPlayerRepository::class);
            $currentPlayer = $playerRepo->one([IPlayer::FIELD__NAME => $playerName]);
            $currentPlayer && ($player = $currentPlayer);
        }
    }
}
```

#### Запись в extas-совместимой конфигурации

```json
{
  "plugins": [
    {
      "class": "my\\extas\\plugins\\PluginCookieCurrentPlayer",
      "stage": "extas.player.current"
    }
  ]
}
```

#### Установка

`# /vendor/bin/extas i`

## Применение

```php
setcookie('extas.player', 'jeyroik', time() + 3000, '/');

use \extas\components\players\Current;

echo Current::player()->getName(); // jeyroik
```