# Symfony DaData

[![Build Status](https://travis-ci.com/Velhron/dadata-bundle.svg?token=tDXe7dqwQ2esgAZeQapf&branch=master)](https://travis-ci.com/Velhron/dadata-bundle)

## Описание

Symfony DaDataBundle предназначен для работы с API сервиса [ДаДата](https://dadata.ru).

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
    # Если у вас инфраструктура состоит из n-сервисов, которые обращаются в dadata, то для контроля запросов в dadata
    # в одной точке, Вам возможно потребуется прокси-кеш. Для замены оригинальных url от dadata на Ваш прокси, можете
    # заполнить следующие необязательные параметры
    #base_general_url: 'https://proxy_dadata.ru/proxy/v2'
    #base_cleaner_url: 'https://cleaner.proxy_dadata.ru/proxy/v1/clean'
    #base_suggestions_url: 'https://suggestions.proxy_dadata.ru/suggestions/proxy/4_1/rs'
```

## Использование

Прежде всего, необходимо подключить для работы нужный вам сервис. Например:

```php
<?php

// ...

use Velhron\DadataBundle\Service\DadataSuggest;

class BaseController extends AbstractController
{
    private $dadataSuggest;

    public function __construct(DadataSuggest $dadataSuggest)
    {
        $this->dadataSuggest = $dadataSuggest;
    }
}
```

Всего сервисов - 5, а именно:
1. `DadataSuggest` - [подсказки](https://dadata.ru/api/suggest/)
2. `DadataClean` - [стандартизация](https://dadata.ru/api/clean/)
3. `DadataGeolocate` - [обратное геокодирование](https://dadata.ru/api/geolocate/)
4. `DadataIplocate` - [город по IP-адресу](https://dadata.ru/api/iplocate/)
5. `DadataGeneral` - остальные методы

Все доступные методы можно посмотреть в самих классах.

Дополнительные параметры обычно передаются вторым параметром в виде ассоциативного массива. 
Все параметры аналогичны тем, что указаны на сайте ДаДаты.

### [API подсказок](https://dadata.ru/api/suggest/)

Например, подсказки по адресам:

```php
$response = $dadataSuggest->suggestAddress('москва хабар', ['count' => 10]);
$address = $response[0]->value;
```

Подсказки по организациям:

```php
$response = $dadataSuggest->suggestParty('сбербанк', ['count' => 2]);
$inn = $response[0]->inn;
```

### [API стандартизации](https://dadata.ru/api/clean/)

Например, стандартизация ФИО:

```php
$response = $dadataClean->cleanName('Срегей владимерович иванов');
$name = $response->result;
```

### [Обратное геокодирование](https://dadata.ru/api/geolocate/)

Например, адрес по координатам:

```php
$response = $dadataGeolocate->geolocateAddress(55.878, 37.653);
$address = $response[0]->value;
```

### [Город по IP-адресу](https://dadata.ru/api/iplocate/)

Получение города по IP адресу:

```php
$response = $dadataIplocate->iplocateAddress('46.226.227.20');
$city = $response->value;
```

### [Адрес по коду КЛАДР или ФИАС](https://dadata.ru/api/find-address/)

Получение адреса по коду КЛАДР:

```php
$response = $dadataSuggest->findAddress('77000000000268400');
$address = $response[0]->value;
```

### [Поиск аффилированных компаний](https://dadata.ru/api/find-affiliated/)

```php
$response = $dadataSuggest->findAffiliatedParty('7736207543');
$value = $response[0]->value;
```

## Лицензия

[MIT License](https://opensource.org/licenses/mit-license) © Velhron