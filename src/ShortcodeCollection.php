<?php declare(strict_types=1);

namespace Palmtree\WordPress\Shortcode;

use Palmtree\Collection\Map;

class ShortcodeCollection
{
    /** @var Map<string, ShortcodeInterface> */
    private $map;
    /** @var string */
    private $prefix = '';

    public function __construct(array $items = [])
    {
        add_action('init', function () {
            $this->registerShortcodes();
        });

        $this->map = new Map(ShortcodeInterface::class);

        $this->map->add($items);
    }

    public function set(string $key, ShortcodeInterface $shortcode): self
    {
        $this->map->set($key, $shortcode);

        return $this;
    }

    public function get(string $key): ShortcodeInterface
    {
        return $this->map->get($key);
    }

    public function setPrefix(string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    private function registerShortcodes(): void
    {
        foreach ($this->map as $shortcode) {
            /* @var ShortcodeInterface $shortcode */
            add_shortcode($this->getPrefix() . $shortcode->getKey(), [$shortcode, 'getOutput']);
        }
    }
}
