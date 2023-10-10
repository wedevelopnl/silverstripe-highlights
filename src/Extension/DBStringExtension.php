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
        $regex = sprintf('/\%s(.+)%s/', $this->getOwner()->config()->get('shortcode_start'), $this->getOwner()->config()->get('shortcode_end'));
        $class = sprintf('<span class="%s">$1</span>', $this->getOwner()->config()->get('css_class_name'));

        $value = preg_replace($regex, $class, $this->getOwner()->getValue());

        return HTMLValue::create($value);
    }
}
