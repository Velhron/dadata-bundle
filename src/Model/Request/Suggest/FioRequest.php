<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class FioRequest extends SuggestRequest
{
    /**
     * @var string Пол (UNKNOWN / MALE / FEMALE)
     */
    protected $gender;

    /**
     * @var array Подсказки по части ФИО
     */
    protected $parts;
}
