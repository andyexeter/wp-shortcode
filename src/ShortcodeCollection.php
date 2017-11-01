<?php

namespace Palmtree\WordPress\Shortcode;

use Palmtree\Collection\Collection;

class ShortcodeCollection extends Collection
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
