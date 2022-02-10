<?php

namespace App\Core\Session;

interface SessionInterface
{
    public function get(string $key);

    public function set(string $key, $value): self;

    public function forget(string $key): void;

    public function flush(): void;

    public function has(string $key): bool;
}