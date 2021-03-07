<?php declare(strict_types=1);

namespace Palmtree\WordPress\Shortcode;

interface ShortcodeInterface
{
    public function getKey(): string;

    /** @param array|string $atts */
    public function getOutput($atts): string;
}
