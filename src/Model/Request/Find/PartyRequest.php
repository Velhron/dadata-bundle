<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Find;

class PartyRequest extends FindRequest
{
    /**
     * @var string КПП для поиска по филиалам
     */
    protected $kpp;

    /**
     * @var string Головная организация (MAIN) или филиал (BRANCH)
     */
    protected $branch_type;

    /**
     * @var string Юр. лицо (LEGAL) или индивидуальный предприниматель (INDIVIDUAL)
     */
    protected $type;

    /**
     * {@inheritdoc}
     */
    protected function getMethodUrl(): string
    {
        return 'party';
    }
}
