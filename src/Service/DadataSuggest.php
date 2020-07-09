<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Service;

use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Velhron\DadataBundle\Exception\DadataException;
use Velhron\DadataBundle\Model\Request\AbstractRequest;
use Velhron\DadataBundle\Model\Request\Suggest\SuggestRequest;
use Velhron\DadataBundle\Model\Response\Find\DeliveryResponse;
use Velhron\DadataBundle\Model\Response\Suggest\AddressResponse;
use Velhron\DadataBundle\Model\Response\Suggest\BankResponse;
use Velhron\DadataBundle\Model\Response\Suggest\CarBrandResponse;
use Velhron\DadataBundle\Model\Response\Suggest\CountryResponse;
use Velhron\DadataBundle\Model\Response\Suggest\CurrencyResponse;
use Velhron\DadataBundle\Model\Response\Suggest\EmailResponse;
use Velhron\DadataBundle\Model\Response\Suggest\FioResponse;
use Velhron\DadataBundle\Model\Response\Suggest\FmsUnitResponse;
use Velhron\DadataBundle\Model\Response\Suggest\FnsUnitResponse;
use Velhron\DadataBundle\Model\Response\Suggest\MetroResponse;
use Velhron\DadataBundle\Model\Response\Suggest\Okpd2Response;
use Velhron\DadataBundle\Model\Response\Suggest\Okved2Response;
use Velhron\DadataBundle\Model\Response\Suggest\PartyResponse;
use Velhron\DadataBundle\Model\Response\Suggest\PostalUnitResponse;
use Velhron\DadataBundle\Model\Response\Suggest\RegionCourtResponse;

class DadataSuggest extends AbstractService
{
    /**
     * Обработчик для API подсказок.
     *
     * @throws DadataException
     */
    private function handle(string $method, string $query, array $options = []): array
    {
        $requestClass = $this->resolver->getMatchedRequest($method);
        $responseClass = $this->resolver->getMatchedResponse($method);

        /* @var SuggestRequest $request */
        $request = new $requestClass();
        $request
            ->setQuery($query)
            ->fillOptions($options);

        $responseData = $this->query($request);
        foreach ($responseData['suggestions'] ?? [] as $suggestion) {
            $data[] = new $responseClass($suggestion);
        }

        return $data ?? [];
    }

    /**
     * {@inheritdoc}
     */
    protected function query(AbstractRequest $request): array
    {
        try {
            $response = $this->httpClient->request('POST', $request->getUrl(), [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => "Token {$this->token}",
                ],
                'body' => json_encode($request->getBody()),
            ]);

            return json_decode($response->getContent(), true) ?? [];
        } catch (ExceptionInterface $exception) {
            throw new DadataException($exception);
        }
    }

    /**
     * Подсказки по адресам.
     *
     * Ищет адреса по любой части адреса от региона до дома.
     * Например: «тверская нижний 12» → «Нижегородская обл, г Нижний Новгород, ул Тверская, д 12».
     * Также ищет по почтовому индексу («105568» → «г Москва, ул Магнитогорская»).
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return AddressResponse[]
     *
     * @throws DadataException
     */
    public function suggestAddress(string $query, array $options = []): array
    {
        return $this->handle('suggestAddress', $query, $options);
    }

    /**
     * Подсказки по организациям.
     *
     * Ищет компании и индивидуальных предпринимателей:
     * - по ИНН, ОГРН и КПП;
     * - названию (полному и краткому);
     * - ФИО (для индивидуальных предпринимателей);
     * - ФИО руководителя компании;
     * - адресу до улицы.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return PartyResponse[]
     *
     * @throws DadataException
     */
    public function suggestParty(string $query, array $options = []): array
    {
        return $this->handle('suggestParty', $query, $options);
    }

    /**
     * Подсказки по банкам.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return BankResponse[]
     *
     * @throws DadataException
     */
    public function suggestBank(string $query, array $options = []): array
    {
        return $this->handle('suggestBank', $query, $options);
    }

    /**
     * Подсказки по ФИО.
     *
     * Подсказывает ФИО одной строкой или отдельно фамилию, имя, отчество.
     * Исправляет клавиатурную раскладку («fynjy» → «Антон»).
     * Определяет пол.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return FioResponse[]
     *
     * @throws DadataException
     */
    public function suggestFio(string $query, array $options = []): array
    {
        return $this->handle('suggestFio', $query, $options);
    }

    /**
     * Подсказки по E-mail.
     *
     * Подсказывает локальную (до «собачки») и доменную (после «собачки») части эл. почты.
     * Исправляет опечатки (yadex.ru → yandex.ru).
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return EmailResponse[]
     *
     * @throws DadataException
     */
    public function suggestEmail(string $query, array $options = []): array
    {
        return $this->handle('suggestEmail', $query, $options);
    }

    /**
     * Подсказки по ФИАС.
     *
     * Ищет адреса строго по ФИАС.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return AddressResponse[]
     *
     * @throws DadataException
     */
    public function suggestFias(string $query, array $options = []): array
    {
        return $this->handle('suggestFias', $query, $options);
    }

    /**
     * Подсказки по справочнику "Кем выдан паспорт".
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return FmsUnitResponse[]
     *
     * @throws DadataException
     */
    public function suggestFmsUnit(string $query, array $options = []): array
    {
        return $this->handle('suggestFmsUnit', $query, $options);
    }

    /**
     * Подсказки по справочнику "Отделения почты России".
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return PostalUnitResponse[]
     *
     * @throws DadataException
     */
    public function suggestPostalUnit(string $query, array $options = []): array
    {
        return $this->handle('suggestPostalUnit', $query, $options);
    }

    /**
     * Подсказки по справочнику "Налоговые инспекции".
     *
     * Справочник инспекций Налоговой службы.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return FnsUnitResponse[]
     *
     * @throws DadataException
     */
    public function suggestFnsUnit(string $query, array $options = []): array
    {
        return $this->handle('suggestFnsUnit', $query, $options);
    }

    /**
     * Подсказки по справочнику "Мировые суды".
     *
     * Справочник мировых судов России.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return RegionCourtResponse[]
     *
     * @throws DadataException
     */
    public function suggestRegionCourt(string $query, array $options = []): array
    {
        return $this->handle('suggestRegionCourt', $query, $options);
    }

    /**
     * Подсказки по справочнику "Станции метро".
     *
     * Справочник станций метро в Москве, Санкт-Петербурге и других городах России.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return MetroResponse[]
     *
     * @throws DadataException
     */
    public function suggestMetro(string $query, array $options = []): array
    {
        return $this->handle('suggestMetro', $query, $options);
    }

    /**
     * Подсказки по справочнику "Марки автомобилей".
     *
     * Справочник марок автомобилей на английском и русском языках.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return CarBrandResponse[]
     *
     * @throws DadataException
     */
    public function suggestCarBrand(string $query, array $options = []): array
    {
        return $this->handle('suggestCarBrand', $query, $options);
    }

    /**
     * Подсказки по справочнику "Страны".
     *
     * Справочник стран мира по стандарту ISO 3166.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return CountryResponse[]
     *
     * @throws DadataException
     */
    public function suggestCountry(string $query, array $options = []): array
    {
        return $this->handle('suggestCountry', $query, $options);
    }

    /**
     * Подсказки по справочнику "Валюты".
     *
     * Справочник валют по стандарту ISO 4217.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return CurrencyResponse[]
     *
     * @throws DadataException
     */
    public function suggestCurrency(string $query, array $options = []): array
    {
        return $this->handle('suggestCurrency', $query, $options);
    }

    /**
     * Подсказки по справочнику "Виды деятельности (ОКВЭД 2)".
     *
     * Общероссийский классификатор видов экономической деятельности.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return Okved2Response[]
     *
     * @throws DadataException
     */
    public function suggestOkved2(string $query, array $options = []): array
    {
        return $this->handle('suggestOkved2', $query, $options);
    }

    /**
     * Подсказки по справочнику "Виды продукции (ОКПД 2)".
     *
     * Общероссийский классификатор продукции по видам экономической деятельности.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return Okpd2Response[]
     *
     * @throws DadataException
     */
    public function suggestOkpd2(string $query, array $options = []): array
    {
        return $this->handle('suggestOkpd2', $query, $options);
    }

    /**
     * Адрес по коду КЛАДР или ФИАС.
     *
     * Находит адрес по коду КЛАДР или ФИАС.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return AddressResponse[]
     *
     * @throws DadataException
     */
    public function findAddress(string $query, array $options = []): array
    {
        return $this->handle('findAddress', $query, $options);
    }

    /**
     * Почтовое отделение по индексу.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return PostalUnitResponse[]
     *
     * @throws DadataException
     */
    public function findPostalUnit(string $query, array $options = []): array
    {
        return $this->handle('findPostalUnit', $query, $options);
    }

    /**
     * Идентификатор города в СДЭК, Boxberry и DPD.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return DeliveryResponse[]
     *
     * @throws DadataException
     */
    public function findDelivery(string $query, array $options = []): array
    {
        return $this->handle('findDelivery', $query, $options);
    }

    /**
     * Организация по ИНН или ОГРН.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return PartyResponse[]
     *
     * @throws DadataException
     */
    public function findParty(string $query, array $options = []): array
    {
        return $this->handle('findParty', $query, $options);
    }

    /**
     * Банк по БИК, SWIFT, ИНН или регистрационному номеру.
     *
     * Находит банк по любому из идентификаторов:
     * - БИК,
     * - SWIFT,
     * - ИНН,
     * - ИНН + КПП (для филиалов),
     * - регистрационному номеру, присвоенному Банком России.
     *
     * Ищет только по точному совпадению.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return BankResponse[]
     *
     * @throws DadataException
     */
    public function findBank(string $query, array $options = []): array
    {
        return $this->handle('findBank', $query, $options);
    }

    /**
     * Адрес в ФИАС по идентификатору.
     *
     * @param string $query   - текст запроса
     * @param array  $options - дополнительные параметры запроса
     *
     * @return AddressResponse[]
     *
     * @throws DadataException
     */
    public function findFias(string $query, array $options = []): array
    {
        return $this->handle('findFias', $query, $options);
    }
}
