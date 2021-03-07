<?php declare(strict_types=1);

namespace Palmtree\WordPress\Shortcode;

abstract class AbstractShortcode implements ShortcodeInterface
{
    /** @var string */
    protected $key;
    /** @var array */
    protected $defaults = [];

    abstract public function getOutput(array $atts): string;

    public function getDefaults(): array
    {
        return $this->defaults;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getAttributes($attributes = ''): array
    {
        return shortcode_atts($this->getDefaults(), $attributes, $this->getKey());
    }
}
