<?php namespace App\Framework\Cookies;

interface CookieInterface
{

    public function set(string $name, string $value = "", array $options = []): bool;

    public function setRaw(string $name, string $value = "", array $options = []): bool;

    public function delete(string $name): bool;

    public function get(string $name);

    public function getAll(): array;
}
