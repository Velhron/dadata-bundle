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
     * @var array ФИО (для индивидуальных предпринимателей)
     */
    public $fio;

    /**
     * @var string Код ОКАТО
     */
    public $okato;

    /**
     * @var string Код ОКТМО
     */
    public $oktmo;

    /**
     * @var string Код ОКПО
     */
    public $okpo;

    /**
     * @var string Код ОКОГУ
     */
    public $okogu;

    /**
     * @var string Код ОКФС
     */
    public $okfs;

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
     * @var AddressResponse Адрес
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
     * @var array Правопредшественники (только для юр. лиц)
     */
    public $predecessors;

    /**
     * @var array Правопреемники (только для юр. лиц)
     */
    public $successors;

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

    /**
     * @var EmailResponse[] Адреса эл. почты
     */
    public $emails;

    /**
     * @var PhoneResponse[] Телефоны
     */
    public $phones;

    public function __construct(array $data)
    {
        parent::__construct($data);

        if (isset($data['data']['address'])) {
            $this->address = new AddressResponse($data['data']['address']);
        }

        if (isset($data['data']['emails']) && is_array($data['data']['emails'])) {
            foreach ($data['data']['emails'] as $email) {
                $this->emails[] = new EmailResponse($email);
            }
        }

        if (isset($data['data']['phones']) && is_array($data['data']['phones'])) {
            foreach ($data['data']['phones'] as $phone) {
                $this->phones[] = new PhoneResponse($phone);
            }
        }
    }
}
