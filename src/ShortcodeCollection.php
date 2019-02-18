<?php

namespace Palmtree\WordPress\Shortcode;

use Palmtree\Collection\Map;

/**
 * @method ShortcodeInterface get(string $key)
 */
class ShortcodeCollection extends Map
{
    protected $prefix = '';

    public function __construct($items = [])
    {
        add_action('init', function () {
            $this->registerShortcodes();
        });

        parent::__construct(ShortcodeInterface::class);

        $this->add($items);
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    protected function registerShortcodes()
    {
        foreach ($this->all() as $shortcode) {
            /** @var ShortcodeInterface $shortcode */
            add_shortcode($this->getPrefix() . $shortcode->getKey(), [$shortcode, 'getOutput']);
        }
    }
}
