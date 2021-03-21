<?php


namespace App\Framework\Cookies;

class Cookie implements CookieInterface
{

    public function set(string $name, string $value = "", array $options = []): bool
    {
        return setcookie($name, $value, $this->parseOptions($options));
    }

    public function setRaw(string $name, string $value = "", array $options = []): bool
    {
        return setrawcookie($name, $value, $this->parseOptions($options));
    }

    public function delete(string $name): bool
    {
        return setcookie($name, "", 1);
    }

    public function get(string $name)
    {
        return array_key_exists($name, $_COOKIE) ? $_COOKIE[$name] : null;
    }

    public function getAll(): array
    {
        return $_COOKIE;
    }

    /**
     * @param array $options
     * @return array
     * @throws CookieOptionsException
     */
    private function parseOptions(array $options): array
    {
        // default values for options
        $validOptions = ["expires" => 0, "path" => "", "domain" => "", "secure" => false, "httponly" => false, "samesite" => ''];
        // check the options given
        foreach ($options as $key => $value) {
            if (array_key_exists($key, $validOptions)) {
                $validOptions[$key] = $value;
            } else {
                throw new CookieOptionsException("Unrecognized key '$key' found in the options array");
            }
        }
        return $validOptions;
    }

}
