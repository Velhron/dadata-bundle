<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Clean;

use Velhron\DadataBundle\Model\Request\AbstractRequest;

abstract class CleanRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    public function getBody(): array
    {
        return [$this->query];
    }
}
