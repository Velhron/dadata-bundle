<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Service;

use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Velhron\DadataBundle\Exception\DadataException;
use Velhron\DadataBundle\Model\Request\AbstractRequest;
use Velhron\DadataBundle\Model\Request\Clean\CleanRequest;
use Velhron\DadataBundle\Model\Response\Clean\AddressResponse;
use Velhron\DadataBundle\Model\Response\Clean\EmailResponse;
use Velhron\DadataBundle\Model\Response\Clean\NameResponse;
use Velhron\DadataBundle\Model\Response\Clean\PassportResponse;
use Velhron\DadataBundle\Model\Response\Clean\PhoneResponse;
use Velhron\DadataBundle\Model\Response\Clean\VehicleResponse;

class DadataClean extends AbstractService
{
    /**
     * Обработчик для API стандартизации.
     *
     * @throws DadataException
     */
    private function handle(string $method, string $query)
    {
        $requestClass = $this->resolver->getMatchedRequest($method);
        $responseClass = $this->resolver->getMatchedResponse($method);

        /* @var CleanRequest $request */
        $request = new $requestClass();
        $request->setQuery($query);

        $responseData = $this->query($request);

        return new $responseClass($responseData);
    }

    /**
     * Стандартизация адреса.
     *
     * - Разбивает адрес по отдельным полям (регион, город, улица, дом, квартира) согласно КЛАДР/ФИАС.
     * - Определяет корректный индекс по данным Почты России.
     * - Определяет округ и район города, геокоординаты, метро, площадь и стоимость квартиры.
     * - Достает коды КЛАДР, ФИАС, ОКАТО, ОКТМО и ИФНС.
     *
     * @throws DadataException
     */
    public function cleanAddress(string $query): AddressResponse
    {
        return $this->handle('cleanAddress', $query);
    }

    /**
     * Стандартизация телефона.
     *
     * @throws DadataException
     */
    public function cleanPhone(string $query): PhoneResponse
    {
        return $this->handle('cleanPhone', $query);
    }

    /**
     * Стандартизация паспорта.
     *
     * @throws DadataException
     */
    public function cleanPassport(string $query): PassportResponse
    {
        return $this->handle('cleanPassport', $query);
    }

    /**
     * Стандартизация даты рождения.
     *
     * @throws DadataException
     */
    public function cleanBirthdate(string $query): PassportResponse
    {
        return $this->handle('cleanBirthdate', $query);
    }

    /**
     * Стандартизация автомобиля.
     *
     * @throws DadataException
     */
    public function cleanVehicle(string $query): VehicleResponse
    {
        return $this->handle('cleanVehicle', $query);
    }

    /**
     * Стандартизация ФИО.
     *
     * @throws DadataException
     */
    public function cleanName(string $query): NameResponse
    {
        return $this->handle('cleanName', $query);
    }

    /**
     * Стандартизация e-mail.
     *
     * @throws DadataException
     */
    public function cleanEmail(string $query): EmailResponse
    {
        return $this->handle('cleanEmail', $query);
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
                    'Authorization' => "Token {$this->token}",
                    'X-Secret' => $this->secret,
                ],
                'body' => json_encode($request->getBody()),
            ]);

            $result = json_decode($response->getContent(), true);

            return (1 === count($result)) ? array_shift($result) : $result;
        } catch (ExceptionInterface $exception) {
            throw new DadataException($exception);
        }
    }
}
