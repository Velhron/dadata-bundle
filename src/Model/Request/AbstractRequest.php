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
     * Базовый URL-адрес API.
     */
    abstract protected function getBaseUrl(): string;

    /**
     * Вызываемый метод API для URL.
     */
    abstract protected function getMethodUrl(): string;

    /**
     * Тело запроса.
     */
    abstract public function getBody(): array;

    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->getBaseUrl().$this->getMethodUrl();
    }

    public function fillOptions(array $data): self
    {
        foreach (get_object_vars($this) as $property => $value) {
            if (isset($data[$property])) {
                $this->{$property} = $data[$property];
            }
        }

        return $this;
    }
}
