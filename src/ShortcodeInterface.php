<?php declare(strict_types=1);

namespace Palmtree\WordPress\Shortcode;

interface ShortcodeInterface
{
    public function getKey(): string;

    public function getOutput(array $atts): string;
}
