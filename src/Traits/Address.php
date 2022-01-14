<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Traits;

trait Address
{
    /**
     * @var string Индекс
     */
    public $postalCode;

    /**
     * @var string Страна
     */
    public $country;

    /**
     * @var string ISO-код страны (двухсимвольный)
     */
    public $countryIsoCode;

    /**
     * @var string Федеральный округ
     */
    public $federalDistrict;

    /**
     * @var string Код ФИАС региона
     */
    public $regionFiasId;

    /**
     * @var string Код КЛАДР региона
     */
    public $regionKladrId;

    /**
     * @var string ISO-код региона
     */
    public $regionIsoCode;

    /**
     * @var string Регион с типом
     */
    public $regionWithType;

    /**
     * @var string Тип региона (сокращенный)
     */
    public $regionType;

    /**
     * @var string Тип региона
     */
    public $regionTypeFull;

    /**
     * @var string Регион
     */
    public $region;

    /**
     * @var string Код ФИАС района в регионе
     */
    public $areaFiasId;

    /**
     * @var string Код КЛАДР района в регионе
     */
    public $areaKladrId;

    /**
     * @var string Район в регионе с типом
     */
    public $areaWithType;

    /**
     * @var string Тип района в регионе (сокращенный)
     */
    public $areaType;

    /**
     * @var string Тип района в регионе
     */
    public $areaTypeFull;

    /**
     * @var string Район в регионе
     */
    public $area;

    /**
     * @var string Код ФИАС города
     */
    public $cityFiasId;

    /**
     * @var string Код КЛАДР города
     */
    public $cityKladrId;

    /**
     * @var string Город с типом
     */
    public $cityWithType;

    /**
     * @var string Тип города (сокращенный)
     */
    public $cityType;

    /**
     * @var string Тип города
     */
    public $cityTypeFull;

    /**
     * @var string Город
     */
    public $city;

    /**
     * @var string Код ФИАС района города (заполняется, только если район есть в ФИАС)
     */
    public $cityDistrictFiasId;

    /**
     * @var string Код КЛАДР района города (не заполняется)
     */
    public $cityDistrictKladrId;

    /**
     * @var string Район города с типом
     */
    public $cityDistrictWithType;

    /**
     * @var string Тип района города (сокращенный)
     */
    public $cityDistrictType;

    /**
     * @var string Тип района города
     */
    public $cityDistrictTypeFull;

    /**
     * @var string Район города
     */
    public $cityDistrict;

    /**
     * @var string Код ФИАС нас. пункта
     */
    public $settlementFiasId;

    /**
     * @var string Код КЛАДР нас. пункта
     */
    public $settlementKladrId;

    /**
     * @var string Населенный пункт с типом
     */
    public $settlementWithType;

    /**
     * @var string Тип населенного пункта (сокращенный)
     */
    public $settlementType;

    /**
     * @var string Тип населенного пункта
     */
    public $settlementTypeFull;

    /**
     * @var string Населенный пункт
     */
    public $settlement;

    /**
     * @var string Код ФИАС улицы
     */
    public $streetFiasId;

    /**
     * @var string Код КЛАДР улицы
     */
    public $streetKladrId;

    /**
     * @var string Улица с типом
     */
    public $streetWithType;

    /**
     * @var string Тип улицы (сокращенный)
     */
    public $streetType;

    /**
     * @var string Тип улицы
     */
    public $streetTypeFull;

    /**
     * @var string Улица
     */
    public $street;

    /**
     * @var string Код ФИАС дома
     */
    public $houseFiasId;

    /**
     * @var string Код КЛАДР дома
     */
    public $houseKladrId;

    /**
     * @var string Тип дома (сокращенный)
     */
    public $houseType;

    /**
     * @var string Тип дома
     */
    public $houseTypeFull;

    /**
     * @var string Дом
     */
    public $house;

    /**
     * @var string Тип корпуса/строения (сокращенный)
     */
    public $blockType;

    /**
     * @var string Тип корпуса/строения
     */
    public $blockTypeFull;

    /**
     * @var string Корпус/строение
     */
    public $block;

    /**
     * @var string Подъезд
     */
    public $entrance;

    /**
     * @var string Этаж
     */
    public $floor;

    /**
     * @var string Тип квартиры (сокращенный)
     */
    public $flatType;

    /**
     * @var string Тип квартиры
     */
    public $flatTypeFull;

    /**
     * @var string Квартира
     */
    public $flat;

    /**
     * @var string Абонентский ящик
     */
    public $postalBox;

    /**
     * @var string Код ФИАС
     */
    public $fiasId;

    /**
     * @var string Уровень детализации, до которого адрес найден в ФИАС
     *
     * 0 — страна
     * 1 — регион
     * 3 — район
     * 4 — город
     * 5 — район города
     * 6 — населенный пункт
     * 7 — улица
     * 8 — дом
     * 65 — планировочная структура
     * -1 — иностранный или пустой
     */
    public $fiasLevel;

    /**
     * @var string Код КЛАДР
     */
    public $kladrId;

    /**
     * @var string Идентификатор объекта в базе GeoNames. Для российских адресов не заполняется
     */
    public $geonameId;

    /**
     * @var string Признак центра района или региона
     *
     * 1 — центр района (Московская обл, Одинцовский р-н, г Одинцово)
     * 2 — центр региона (Новосибирская обл, г Новосибирск)
     * 3 — центр района и региона (Томская обл, г Томск)
     * 4 — центральный район региона (Тюменская обл, Тюменский р-н)
     * 0 — ничего из перечисленного (Московская обл, г Балашиха)
     */
    public $capitalMarker;

    /**
     * @var string Код ОКАТО
     */
    public $okato;

    /**
     * @var string Код ОКТМО
     */
    public $oktmo;

    /**
     * @var string Код ИФНС для физических лиц
     */
    public $taxOffice;

    /**
     * @var string Код ИФНС для организаций
     */
    public $taxOfficeLegal;

    /**
     * @var array Список исторических названий объекта нижнего уровня
     *
     * Если подсказка до улицы — это прошлые названия этой улицы, если до города — города
     */
    public $historyValues;

    /**
     * @var string Координаты: широта
     */
    public $geoLat;

    /**
     * @var string Координаты: долгота
     */
    public $geoLon;

    /**
     * @var string Код точности координат
     *
     * 0 — точные координаты
     * 1 — ближайший дом
     * 2 — улица
     * 3 — населенный пункт
     * 4 — город
     * 5 — координаты не определены
     */
    public $qcGeo;

    /**
     * @var string Годится ли адрес для доставки корреспонденции
     *
     * 0  — Пригоден для почтовой рассылки
     * 1  — Нет региона
     * 2  — Нет города
     * 3  — Нет улицы
     * 4  — Нет дома
     * 5  — Нет квартиры. Подходит для юридических лиц или частных владений
     * 6  — Адрес неполный
     * 7  — Иностранный адрес
     * 8  — До почтового отделения — абонентский ящик или адрес до востребования. Подходит для писем, но не для курьерской доставки
     * 9  — Сначала проверьте, правильно ли Дадата разобрала исходный адрес
     * 10 — Дома нет в ФИАС
     */
    public $qcComplete;

    /**
     * @var string Признак наличия дома в ФИАС
     *
     * 2  — Дом найден в ФИАС
     * 10 — Дом не найден в ФИАС
     */
    public $qcHouse;

    /**
     * @var string Код проверки
     *
     * 0 — Адрес распознан уверенно
     * 1 — Остались «лишние» части
     * 2 — Адрес пустой или заведомо «мусорный»
     * 3 — Есть альтернативные варианты
     */
    public $qc;

    /**
     * @var string Иерархический код адреса в ФИАС (СС+РРР+ГГГ+ППП+СССС+УУУУ+ДДДД)
     */
    public $fiasCode;

    /**
     * @var string Признак актуальности адреса в ФИАС
     *
     * 0    — актуальный
     * 1–50 — переименован
     * 51   — переподчинен
     * 99   — удален
     */
    public $fiasActualityState;

    /**
     * @var string Административный округ (только для Москвы)
     */
    public $cityArea;

    /**
     * @var string Внутри кольцевой?
     */
    public $beltwayHit;

    /**
     * @var string Расстояние от кольцевой в километрах
     */
    public $beltwayDistance;

    /**
     * @var string Площадь квартиры
     */
    public $flatArea;

    /**
     * @var string Рыночная стоимость м²
     */
    public $squareMeterPrice;

    /**
     * @var string Рыночная стоимость квартиры
     */
    public $flatPrice;

    /**
     * @var string Часовой пояс
     *
     * Часовой пояс города для России, часовой пояс страны — для иностранных адресов.
     * Если у страны несколько поясов, вернёт минимальный и максимальный через слеш: UTC+5/UTC+6.
     */
    public $timezone;

    /**
     * @var array Список ближайших станций метро (до трёх штук)
     */
    public $metro;
}
