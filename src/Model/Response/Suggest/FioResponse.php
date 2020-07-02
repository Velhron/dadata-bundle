<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Suggest;

class FioResponse extends SuggestResponse
{
    /**
     * @var string Фамилия
     */
    public $surname;

    /**
     * @var string Имя
     */
    public $name;

    /**
     * @var string Отчество
     */
    public $patronymic;

    /**
     * @var string Пол
     *
     * MALE    — мужской
     * FEMALE  — женский
     * UNKNOWN — не удалось однозначно определить
     */
    public $gender;

    /**
     * @var string Код проверки
     *
     * 0 — все части ФИО известны
     * 1 — в ФИО есть неизвестная часть
     */
    public $qc;
}
