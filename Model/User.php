<?php

namespace Model;

class User implements \JsonSerializable {
    private string $username;
    private string $email;
    private string $password;
    private ?int $id;

    public function __construct(string $username, string $email, string $password, ?int $id = null) 
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
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

    public function getUsername(): string 
    {
        return $this->username;
    }

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function getPassword(): string 
    {
        return $this->password;
    }

    public function setId(?int $newId): static 
    {
        if (is_null($this->id)) {
            $this->id = $newId;
        }
        return $this;
    }

    public function setUsername(string $newUsername): static 
    {
        if (!$this->username != $newUsername) {
            $this->username = $newUsername;
        }

        return $this;
    }

    public function setEmail(string $newEmail): static 
    {
        if (!$this->email != $newEmail) {
            $this->email = $newEmail;
        }
        return $this;
    }

    public function setPassword(string $newPassword): static 
    {
        if (!$this->password != $newPassword) {
            $this->password = $newPassword;
        }
        return $this;
    }

    public function jsonSerialize()
    {
        $props = get_object_vars($this);

        return $props;
    }
}