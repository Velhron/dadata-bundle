<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Service;

use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Velhron\DadataBundle\Exception\DadataException;
use Velhron\DadataBundle\Exception\InvalidConfigException;
use Velhron\DadataBundle\Model\Request\AbstractRequest;
use Velhron\DadataBundle\Model\Request\Clean\CleanRequest;
use Velhron\DadataBundle\Model\Response\AbstractResponse;
use Velhron\DadataBundle\Model\Response\Clean\AddressResponse;
use Velhron\DadataBundle\Model\Response\Clean\BirthdateResponse;
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
     * @throws DadataException|InvalidConfigException
     */
    private function handle(string $method, string $query): AbstractResponse
    {
        /* @var CleanRequest $request */
        $request = $this->requestFactory->create($method);
        $request->setQuery($query);

        $responseData = $this->query($request);

        return $this->responseFactory->create($method, $responseData);
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

    /**
     * Стандартизация адреса.
     *
     * - Разбивает адрес по отдельным полям (регион, город, улица, дом, квартира) согласно КЛАДР/ФИАС.
     * - Определяет корректный индекс по данным Почты России.
     * - Определяет округ и район города, геокоординаты, метро, площадь и стоимость квартиры.
     * - Достает коды КЛАДР, ФИАС, ОКАТО, ОКТМО и ИФНС.
     *
     * @param string $query Текст запроса
     *
     * @return AddressResponse Стандартизованный объект
     *
     * @throws DadataException|InvalidConfigException
     */
    public function cleanAddress(string $query): AddressResponse
    {
        /** @var AddressResponse $response */
        $response = $this->handle('cleanAddress', $query);

        return $response;
    }

    /**
     * Стандартизация телефона.
     *
     * Проверяет телефон по справочнику Россвязи.
     * Определяет оператора с учётом переноса номеров, заполняет страну, город и часовой пояс.
     *
     * @param string $query Текст запроса
     *
     * @return PhoneResponse Стандартизованный объект
     *
     * @throws DadataException|InvalidConfigException
     */
    public function cleanPhone(string $query): PhoneResponse
    {
        /** @var PhoneResponse $response */
        $response = $this->handle('cleanPhone', $query);

        return $response;
    }

    /**
     * Стандартизация паспорта.
     *
     * Проверяет паспорт по справочнику недействительных паспортов МВД.
     *
     * @param string $query Текст запроса
     *
     * @return PassportResponse Стандартизованный объект
     *
     * @throws DadataException|InvalidConfigException
     */
    public function cleanPassport(string $query): PassportResponse
    {
        /** @var PassportResponse $response */
        $response = $this->handle('cleanPassport', $query);

        return $response;
    }

    /**
     * Стандартизация даты рождения.
     *
     * @param string $query Текст запроса
     *
     * @return BirthdateResponse Стандартизованный объект
     *
     * @throws DadataException|InvalidConfigException
     */
    public function cleanBirthdate(string $query): BirthdateResponse
    {
        /** @var BirthdateResponse $response */
        $response = $this->handle('cleanBirthdate', $query);

        return $response;
    }

    /**
     * Стандартизация автомобиля.
     *
     * @param string $query Текст запроса
     *
     * @return VehicleResponse Стандартизованный объект
     *
     * @throws DadataException|InvalidConfigException
     */
    public function cleanVehicle(string $query): VehicleResponse
    {
        /** @var VehicleResponse $response */
        $response = $this->handle('cleanVehicle', $query);

        return $response;
    }

    /**
     * Стандартизация ФИО.
     *
     * Разбивает ФИО из строки по отдельным полям (фамилия, имя, отчество). Определяет пол и склоняет по падежам.
     *
     * @param string $query Текст запроса
     *
     * @return NameResponse Стандартизованный объект
     *
     * @throws DadataException|InvalidConfigException
     */
    public function cleanName(string $query): NameResponse
    {
        /** @var NameResponse $response */
        $response = $this->handle('cleanName', $query);

        return $response;
    }

    /**
     * Стандартизация e-mail.
     *
     * Исправляет опечатки и проверяет на одноразовый адрес.
     * Классифицирует адреса на личные, корпоративные и «ролевые».
     *
     * @param string $query Текст запроса
     *
     * @return EmailResponse Стандартизованный объект
     *
     * @throws DadataException|InvalidConfigException
     */
    public function cleanEmail(string $query): EmailResponse
    {
        /** @var EmailResponse $response */
        $response = $this->handle('cleanEmail', $query);

        return $response;
    }
}
