<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Service;

use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Velhron\DadataBundle\Exception\DadataException;
use Velhron\DadataBundle\Exception\InvalidConfigException;
use Velhron\DadataBundle\Model\Request\AbstractRequest;
use Velhron\DadataBundle\Model\Request\General\StatRequest;
use Velhron\DadataBundle\Model\Response\General\StatResponse;

class DadataGeneral extends AbstractService
{
    /**
     * {@inheritdoc}
     */
    protected function query(AbstractRequest $request): array
    {
        try {
            $response = $this->httpClient->request('GET', $request->getUrl(), [
                'headers' => [
                    'Authorization' => "Token {$this->token}",
                    'X-Secret' => $this->secret,
                ],
                'query' => $request->getBody(),
            ]);

            return json_decode($response->getContent(), true) ?? [];
        } catch (ExceptionInterface $exception) {
            throw new DadataException($exception);
        }
    }

    /**
     * Возвращает текущий баланс счета.
     *
     * Возвращает сумму в рублях с точностью до копеек, десятичный разделитель — точка.
     *
     * @return float Текущий баланс счета
     *
     * @throws DadataException|InvalidConfigException
     */
    public function balance(): float
    {
        $responseData = $this->query($this->requestFactory->create('balance'));

        return $responseData['balance'] ?? 0.0;
    }

    /**
     * Возвращает агрегированную статистику за конкретный день по каждому из сервисов: стандартизация, подсказки, поиск дублей.
     *
     * Дата должна быть задана в формате YYYY-MM-DD. По умолчанию, сегодня.
     *
     * @param string|null $date Дата в формате YYYY-MM-DD
     *
     * @return StatResponse Статистика
     *
     * @throws DadataException|InvalidConfigException
     */
    public function stat(string $date = null): StatResponse
    {
        /** @var StatRequest $request */
        $request = $this->requestFactory->create('stat');
        $request->date = $date;
        $responseData = $this->query($request);

        return new StatResponse($responseData);
    }

    /**
     * Возвращает даты актуальности справочников (ФИАС, ЕГРЮЛ, банки и другие).
     *
     * @return array Информация по датам актуальности справочников
     *
     * @throws DadataException|InvalidConfigException
     */
    public function version(): array
    {
        return $this->query($this->requestFactory->create('version'));
    }
}
