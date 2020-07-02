<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Service;

use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Velhron\DadataBundle\Exception\DadataException;
use Velhron\DadataBundle\Model\Request\AbstractRequest;
use Velhron\DadataBundle\Model\Request\Clean\AddressRequest;
use Velhron\DadataBundle\Model\Request\Clean\BirthdateRequest;
use Velhron\DadataBundle\Model\Request\Clean\CleanRequest;
use Velhron\DadataBundle\Model\Request\Clean\NameRequest;
use Velhron\DadataBundle\Model\Request\Clean\PassportRequest;
use Velhron\DadataBundle\Model\Request\Clean\PhoneRequest;
use Velhron\DadataBundle\Model\Request\Clean\VehicleRequest;
use Velhron\DadataBundle\Model\Response\Clean\AddressResponse;
use Velhron\DadataBundle\Model\Response\Clean\CleanResponse;
use Velhron\DadataBundle\Model\Response\Clean\NameResponse;
use Velhron\DadataBundle\Model\Response\Clean\PassportResponse;
use Velhron\DadataBundle\Model\Response\Clean\PhoneResponse;
use Velhron\DadataBundle\Model\Response\Clean\VehicleResponse;

class DadataClean extends AbstractService
{
    /**
     * Обработчик для API стандартизации.
     *
     * @param string $method - метод
     * @param string $query  - текст запроса
     *
     * @throws DadataException
     */
    public function handle(string $method, string $query): CleanResponse
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
     * @throws DadataException
     */
    public function cleanAddress(string $query): AddressResponse
    {
        $request = (new AddressRequest())->setQuery($query);
        $result = $this->query($request);

        return new AddressResponse($result);
    }

    /**
     * Стандартизация телефона.
     *
     * @throws DadataException
     */
    public function cleanPhone(string $query): PhoneResponse
    {
        $request = (new PhoneRequest())->setQuery($query);
        $result = $this->query($request);

        return new PhoneResponse($result);
    }

    /**
     * Стандартизация паспорта.
     *
     * @throws DadataException
     */
    public function cleanPassport(string $query): PassportResponse
    {
        $request = (new PassportRequest())->setQuery($query);
        $result = $this->query($request);

        return new PassportResponse($result);
    }

    /**
     * Стандартизация даты рождения.
     *
     * @throws DadataException
     */
    public function cleanBirthdate(string $query): PassportResponse
    {
        $request = (new BirthdateRequest())->setQuery($query);
        $result = $this->query($request);

        return new PassportResponse($result);
    }

    /**
     * Стандартизация автомобиля.
     *
     * @throws DadataException
     */
    public function cleanVehicle(string $query): VehicleResponse
    {
        $request = (new VehicleRequest())->setQuery($query);
        $result = $this->query($request);

        return new VehicleResponse($result);
    }

    /**
     * Стандартизация ФИО.
     *
     * @throws DadataException
     */
    public function cleanName(string $query): NameResponse
    {
        $request = (new NameRequest())->setQuery($query);
        $result = $this->query($request);

        return new NameResponse($result);
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
