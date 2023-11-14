<?php

namespace MyUi\Support;

use TailwindMerge\TailwindMerge;

class Attr
{
    private array $attrs = [];

    private bool $merge = false;

    public function add(string $value, bool $test = true): self
    {
        if ($test === true) {
            $this->attrs[] = $value;
        }

        return $this;
    }

    public function match(string $key, array $attrs, string $defaultKey = null, bool $test = true): self
    {
        if ($test === true) {
            if (array_key_exists($key, $attrs)) {
                $this->attrs[] = $attrs[$key];
            } else {
                if (isset($defaultKey) && array_key_exists($defaultKey, $attrs)) {
                    $this->attrs[] = $attrs[$defaultKey];
                }
            }
        }

        return $this;
    }

    public function merge(): self
    {
        $this->merge = true;

        return $this;
    }

    public function __toString(): string
    {
        $string = implode(' ', $this->attrs);

        $string = trim(preg_replace('/\s{2,}/', ' ', $string));

        if ($this->merge) {
            $tw = TailwindMerge::instance();
            $string = $tw->merge($string);
        }

        return $string;
    }
}
