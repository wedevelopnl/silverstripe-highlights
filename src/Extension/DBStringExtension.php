<?php

namespace WeDevelop\Highlights\Extension;

use SilverStripe\Core\Extension;
use SilverStripe\ORM\FieldType\DBString;
use SilverStripe\View\Parsers\HTMLValue;

/**
 * @method DBString getOwner()
 */
class DBStringExtension extends Extension
{
    private static string $shortcode_start = '[';

    private static string $shortcode_end = ']';

    private static string $css_class_name = 'highlight';

    private static array $casting = [
        'Highlight' => 'Text',
    ];

    public function Highlight(): HTMLValue
    {
        return HTMLValue::create(preg_replace($this->createRegex(), $this->createElement(), $this->getOwner()->getValue()));
    }

    private function createElement(): string
    {
        return sprintf('<span class="%s">$1</span>', $this->getConfig('css_class_name'));
    }

    private function createRegex(): string
    {
        return sprintf('/\%s(.+)%s/', $this->getConfig('shortcode_start'), $this->getConfig('shortcode_end'));
    }

    private function getConfig(string $name): string
    {
        return $this->getOwner()->config()->get($name);
    }
}
