<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Clean;

use Velhron\DadataBundle\Traits\Email;

class EmailResponse extends CleanResponse
{
    use Email;

    /**
     * @var string Стандартизованный email
     */
    public $email;

    /**
     * @var string Тип адреса
     */
    public $type;
}
