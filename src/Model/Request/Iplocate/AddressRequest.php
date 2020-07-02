<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Iplocate;

class AddressRequest extends IplocateRequest
{
    /**
     * {@inheritdoc}
     */
    public function getMethodUrl(): string
    {
        return 'address';
    }
}
