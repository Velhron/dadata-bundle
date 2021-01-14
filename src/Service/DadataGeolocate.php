<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Service;

use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Velhron\DadataBundle\Exception\DadataException;
use Velhron\DadataBundle\Exception\InvalidConfigException;
use Velhron\DadataBundle\Model\Request\AbstractRequest;
use Velhron\DadataBundle\Model\Request\Geolocate\GeolocateRequest;
use Velhron\DadataBundle\Model\Response\Suggest\AddressResponse;
use Velhron\DadataBundle\Model\Response\Suggest\PostalUnitResponse;

class DadataGeolocate extends AbstractService
{
    /**
     * Обработчик для API обратного геокодирования (по координатам).
     *
     * @throws DadataException|InvalidConfigException
     */
    private function handle(string $method, float $latitude, float $longitude, array $options = []): array
    {
        /* @var GeolocateRequest $request */
        $request = $this->requestFactory->create($method);

        $request->fillOptions(array_merge([
            'lat' => $latitude,
            'lon' => $longitude,
        ], $options));

        $responseData = $this->query($request);
        foreach ($responseData['suggestions'] ?? [] as $suggestion) {
            $data[] = $this->responseFactory->create($method, $suggestion);
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
     * @throws DadataException|InvalidConfigException
     */
    public function geolocateAddress(float $latitude, float $longitude, array $options = []): array
    {
        return $this->handle('geolocateAddress', $latitude, $longitude, $options);
    }

    /**
     * Почтовое отделение по координатам.
     *
     * @param float $latitude  - широта
     * @param float $longitude - долгота
     * @param array $options   - дополнительные параметры запроса
     *
     * @return PostalUnitResponse[]
     *
     * @throws DadataException|InvalidConfigException
     */
    public function geolocatePostalUnit(float $latitude, float $longitude, array $options = []): array
    {
        return $this->handle('geolocatePostalUnit', $latitude, $longitude, $options);
    }
}
