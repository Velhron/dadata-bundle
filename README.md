# Symfony DaData

## Описание

Symfony DaDataBundle предназначен для работы с REST API сайта [ДаДата](https://dadata.ru).

## Установка

Данный бандл может быть установлен с помощью [Composer](https://getcomposer.org).

### Приложения, которые используют Symfony Flex

Откройте командную консоль, перейдите в каталог вашего проекта и выполните:

```bash
composer require velhron/dadata-bundle
```

### Приложения, которые не используют Symfony Flex

#### Шаг #1: Загрузка бандла

Откройте командную консоль, перейдите в каталог вашего проекта и выполните следующую команду, чтобы загрузить последнюю 
стабильную версию этого пакета:

```bash
composer require velhron/dadata-bundle
```

#### Шаг #2: Активация бандла

Включите пакет, добавив его в список зарегистрированных пакетов в файле `app/AppKernel.php` вашего проекта:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Velhron\DadataBundle\VelhronDadataBundle(),
        );

        // ...
    }

    // ...
}
```

## Конфигурация

Создайте файл конфигурации `config/packages/dadata.yaml`

### Пример

```yaml
velhron_dadata:
    token: 'token'
    secret: 'secret'
```