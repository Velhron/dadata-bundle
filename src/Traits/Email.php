<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Traits;

trait Email
{
    /**
     * @var string Локальная часть адреса (то, что до «собачки»)
     */
    public $local;

    /**
     * @var string Домен (то, что после «собачки»)
     */
    public $domain;
}
