<?php

declare(strict_types=1);

namespace WeDevelop\Highlights\Extension;

use SilverStripe\Core\Extension;
use SilverStripe\ORM\FieldType\DBString;
use SilverStripe\View\Parsers\HTMLValue;

/**
 * @method DBString getOwner()
 * @property ?string $Highlight
 */
class DBStringExtension extends Extension
{
    /** @config */
    private static string $shortcode_start = '[';

    /** @config */
    private static string $shortcode_end = ']';

    /** @config */
    private static string $css_class_name = 'highlight';

    /**
     * @config
     * @var array<string, string>
     */
    private static array $casting = [
        'Highlight' => 'Text',
    ];

    public function Highlight(): HTMLValue
    {
        return HTMLValue::create(preg_replace('/' . $this->createRegex() . '/U', $this->createElement(), $this->getOwner()->getValue()) ?? '');
    }

    private function createElement(): string
    {
        return sprintf('<span class="%s">$1</span>', $this->getConfig('css_class_name'));
    }

    private function createRegex(): string
    {
        return sprintf('%s(.+)%s', preg_quote($this->getConfig('shortcode_start'), '/'), preg_quote($this->getConfig('shortcode_end'), '/'));
    }

    private function getConfig(string $name): string
    {
        return $this->getOwner()->config()->get($name);
    }
}
