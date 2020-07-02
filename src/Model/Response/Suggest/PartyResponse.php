<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Suggest;

class PartyResponse extends SuggestResponse
{
    /**
     * @var string ИНН
     */
    public $inn;

    /**
     * @var string КПП
     */
    public $kpp;

    /**
     * @var string ОГРН
     */
    public $ogrn;

    /**
     * @var string Дата выдачи ОГРН
     */
    public $ogrnDate;

    /**
     * @var string Уникальный идентификатор в Дадате
     */
    public $hid;

    /**
     * @var string Тип организации
     */
    public $type;

    /**
     * @var array Наименование
     */
    public $name;

    /**
     * @var string Код ОКПО
     */
    public $okpo;

    /**
     * @var string Код ОКВЭД
     */
    public $okved;

    /**
     * @var string Версия справочника ОКВЭД (2001 или 2014)
     */
    public $okvedType;

    /**
     * @var array Организационно-правовая форма
     */
    public $opf;

    /**
     * @var array Руководитель
     */
    public $management;

    /**
     * @var string Количество филиалов
     */
    public $branchCount;

    /**
     * @var string Тип подразделения
     */
    public $branchType;

    /**
     * @var string Адрес
     */
    public $address;

    /**
     * @var string Состояние
     */
    public $state;

    /**
     * @var string Среднесписочная численность работников
     */
    public $employeeCount;

    /**
     * @var array Коды ОКВЭД дополнительных видов деятельности
     */
    public $okveds;

    /**
     * @var string Сведения о налоговой, ПФР и ФСС
     */
    public $authorities;

    /**
     * @var string Гражданство ИП
     */
    public $citizenship;

    /**
     * @var array Учредители компании
     */
    public $founders;

    /**
     * @var array Руководители компании
     */
    public $managers;

    /**
     * @var string Уставной капитал компании
     */
    public $capital;

    /**
     * @var string Налоговый режим, доходы, расходы, долги и штрафы
     */
    public $finance;

    /**
     * @var string Документы и реестры
     */
    public $documents;

    /**
     * @var array Лицензии
     */
    public $licenses;

    public function __construct(array $data)
    {
        $this->value = $data['value'] ?? null;
        $this->unrestrictedValue = $data['unrestricted_value'] ?? null;

        foreach ($data['data'] as $property => $value) {
            $camelCaseProperty = $this->toCamelCase($property);
            if (property_exists(self::class, $camelCaseProperty)) {
                $this->{$camelCaseProperty} = $value;
            }
        }
    }
}
