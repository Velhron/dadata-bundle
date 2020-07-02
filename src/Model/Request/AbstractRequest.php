<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request;

abstract class AbstractRequest
{
    /**
     * @var string Текст запроса
     */
    protected $query;

    /**
     * HTTP-метод запроса.
     */
    abstract public function getMethod(): string;

    /**
     * Тело запроса.
     */
    abstract public function getBody(): array;

    /**
     * Базовый URL-адрес API.
     */
    abstract protected function getBaseUrl(): string;

    /**
     * Вызываемый метод API для URL.
     */
    abstract protected function getMethodUrl(): string;

    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->getBaseUrl().$this->getMethodUrl();
    }
}
