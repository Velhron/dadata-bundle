<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Service;

use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Velhron\DadataBundle\Exception\DadataException;
use Velhron\DadataBundle\Model\Request\AbstractRequest;
use Velhron\DadataBundle\Model\Request\Geolocate\GeolocateRequest;
use Velhron\DadataBundle\Model\Request\Iplocate\IplocateRequest;
use Velhron\DadataBundle\Model\Request\Suggest\SuggestRequest;
use Velhron\DadataBundle\Model\Response\AbstractResponse;
use Velhron\DadataBundle\Model\Response\Iplocate\IplocateResponse;
use Velhron\DadataBundle\Model\Response\Suggest\AddressResponse;
use Velhron\DadataBundle\Model\Response\Suggest\BankResponse;
use Velhron\DadataBundle\Model\Response\Suggest\EmailResponse;
use Velhron\DadataBundle\Model\Response\Suggest\FioResponse;
use Velhron\DadataBundle\Model\Response\Suggest\FmsUnitResponse;
use Velhron\DadataBundle\Model\Response\Suggest\FnsUnitResponse;
use Velhron\DadataBundle\Model\Response\Suggest\PartyResponse;
use Velhron\DadataBundle\Model\Response\Suggest\PostalUnitResponse;

class DadataSuggest extends AbstractService
{
    /**
     * Обработчик для API подсказок.
     *
     * @throws DadataException
     */
    private function suggest(string $method, string $query, array $options = []): array
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
     * Обработчик для API обратного геокодирования (по координатам).
     *
     * @throws DadataException
     */
    private function geolocate(string $method, float $latitude, float $longitude, array $options = []): array
    {
        $requestClass = $this->resolver->getMatchedRequest($method);
        $responseClass = $this->resolver->getMatchedResponse($method);

        /* @var GeolocateRequest $request */
        $request = new $requestClass();
        $request->fillOptions(array_merge([
            'lat' => $latitude,
            'lon' => $longitude,
        ], $options));

        $responseData = $this->query($request);
        foreach ($responseData['suggestions'] ?? [] as $suggestion) {
            $data[] = new $responseClass($suggestion);
        }

        return $data ?? [];
    }

    /**
     * Обработчик для API по IP-адресу.
     *
     * @throws DadataException
     */
    private function iplocate(string $method, string $ip, array $options = []): ?IplocateResponse
    {
        $requestClass = $this->resolver->getMatchedRequest($method);
        $responseClass = $this->resolver->getMatchedResponse($method);

        /* @var IplocateRequest $request */
        $request = new $requestClass();
        $request
            ->setQuery($ip)
            ->fillOptions($options);

        $responseData = $this->query($request);

        return isset($responseData['location']) ? new $responseClass($responseData['location']) : null;
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
        return $this->suggest('suggestAddress', $query, $options);
    }

    /**
     * Адрес по координатам.
     *
     * Находит ближайшие адреса (дома, улицы, города) по географическим координатам. Только для России.
     *
     * @param float $latitude  - широта
     * @param float $longitude - долгота
     * @param array $options   - дополнительные параметры запроса
     *
     * @return AddressResponse[]
     *
     * @throws DadataException
     */
    public function geolocateAddress(float $latitude, float $longitude, array $options = []): array
    {
        return $this->geolocate('geolocateAddress', $latitude, $longitude, $options);
    }

    /**
     * Город по IP-адресу.
     *
     * - Определяет город по IP-адресу в России
     * - Поддерживает как IPv4, так и IPv6 адреса
     * - Возвращает детальную информацию о городе, в том числе почтовый индекс
     *
     * @param string $ip      - ip-адрес
     * @param array  $options - дополнительные параметры запроса
     *
     * @return AddressResponse|null
     *
     * @throws DadataException
     */
    public function iplocateAddress(string $ip, array $options = []): ?AbstractResponse
    {
        return $this->iplocate('iplocateAddress', $ip, $options);
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
        return $this->suggest('suggestParty', $query, $options);
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
        return $this->suggest('suggestBank', $query, $options);
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
        return $this->suggest('suggestFio', $query, $options);
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
        return $this->suggest('suggestEmail', $query, $options);
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
        return $this->suggest('suggestFias', $query, $options);
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
        return $this->suggest('suggestFmsUnit', $query, $options);
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
        return $this->suggest('suggestPostalUnit', $query, $options);
    }

    public function geolocatePostalUnit(float $latitude, float $longitude, array $options = []): array
    {
        return $this->geolocate('geolocatePostalUnit', $latitude, $longitude, $options);
    }

    /**
     * Подсказки по справочнику "Налоговые инспекции".
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
        return $this->suggest('suggestFnsUnit', $query, $options);
    }

    /**
     * {@inheritdoc}
     */
    protected function query(AbstractRequest $request): array
    {
        try {
            $response = $this->httpClient->request($request->getMethod(), $request->getUrl(), [
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
}
