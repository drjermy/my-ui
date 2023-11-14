<?php

namespace MyUi\Support;

class Attr
{
    private array $attrs = [];

    public function add(string $value, bool $test = true): self
    {
        if ($test === true) {
            $this->attrs[] = $value;
        }

        return $this;
    }

    public function __toString(): string
    {
        $string = implode(' ', $this->attrs);

        $string = preg_replace('/\s{2,}/', ' ', $string);

        return trim($string);
    }
}
