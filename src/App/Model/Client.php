<?php

namespace App\Model;

class Client {
    private int $id;
    private string $name;
    private string $email;
    private string $city;
    private string $state;

    public function __construct($name = '', $email = '', $city = '', $state = '') {
        $this->name = $name;
        $this->email = $email;
        $this->city = $city;
        $this->state = $state;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'city' => $this->city,
            'state' => $this->state
        ];
    }
}