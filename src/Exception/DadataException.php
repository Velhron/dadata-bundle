<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Exception;

use Exception;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

class DadataException extends Exception
{
    public function __construct(ExceptionInterface $exception)
    {
        switch ($exception->getCode()) {
            case 400:
                $message = 'Некорректный запрос (невалидный JSON или XML)';
                break;
            case 401:
                $message = 'В запросе отсутствует API-ключ';
                break;
            case 403:
                $message = 'В запросе указан несуществующий API-ключ. Или не подтверждена почта. Или исчерпан дневной лимит по количеству запросов';
                break;
            case 405:
                $message = 'Неправильный метод запроса';
                break;
            case 413:
                $message = 'Слишком большая длина запроса или слишком много условий';
                break;
            case 429:
                $message = 'Слишком много запросов в секунду или новых соединений в минуту';
                break;
            default:
                $message = 'Произошла внутренняя ошибка сервиса';
                break;
        }

        parent::__construct($message, $exception->getCode(), $exception);
    }
}
