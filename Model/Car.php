<?php

namespace Model;

class Car implements \JsonSerializable {
    private string $brand;
    private float $price;
    private ?string $carname;
    private ?int $id;

    public function __construct(string $brand, float $price, ?string $carname = null, ?int $id = null) 
    {
        $this->brand = $brand;
        $this->price = $price;
        $this->carname = $carname;
        $this->id = $id;
    }

    public function getProps(): array
    {
        return get_object_vars($this);
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getBrand(): string 
    {
        return $this->brand;
    }

    public function getCarname(): ?string 
    {
        return $this->carname;
    }

    public function getPrice(): float 
    {
        return $this->price;
    }

    public function setId(?int $newId): static 
    {
        if (is_null($this->id)) {
            $this->id = $newId;
        }
        return $this;
    }

    public function setBrand(string $newBrand): static 
    {
        if (!$this->brand != $newBrand) {
            $this->brand = $newBrand;
        }

        return $this;
    }

    public function setCarname(?string $newCarname): static 
    {
        if (!$this->carname != $newCarname) {
            $this->carname = $newCarname;
        }
        return $this;
    }

    public function setprice(float $newPrice): static 
    {
        if (!$this->price != $newPrice) {
            $this->price = $newPrice;
        }
        return $this;
    }

    public function jsonSerialize()
    {
        $props = get_object_vars($this);

        return $props;
    }
}