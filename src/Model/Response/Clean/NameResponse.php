<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Clean;

class NameResponse extends CleanResponse
{
    /**
     * @var string ФИО в родительном падеже (кого?)
     */
    public $resultGenitive;

    /**
     * @var string ФИО в дательном падеже (кому?)
     */
    public $resultDative;

    /**
     * @var string ФИО в творительном падеже (кем?)
     */
    public $resultAblative;

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
     * Возможные значения:
     * М - мужской
     * Ж - женский
     * НД - не удалось однозначно определить
     */
    public $gender;
}
