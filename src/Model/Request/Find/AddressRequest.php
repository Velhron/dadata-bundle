<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Find;

class AddressRequest extends FindRequest
{
    /**
     * @var string На каком языке вернуть результат (ru / en)
     */
    protected $language;
}
