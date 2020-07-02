<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\General;

class StatResponse
{
    /**
     * @var string Дата
     */
    public $date;

    /**
     * @var int Статистика использования сервиса поиска дублей
     */
    public $merging;

    /**
     * @var int Статистика использования сервиса подсказок
     */
    public $suggestions;

    /**
     * @var int Статистика использования сервиса стандартизации
     */
    public $clean;

    public function __construct(array $data)
    {
        $this->date = $data['date'];
        $this->merging = $data['services']['merging'] ?? null;
        $this->suggestions = $data['services']['suggestions'] ?? null;
        $this->clean = $data['services']['clean'] ?? null;
    }
}
