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

    private static array $casting = [
        'Highlight' => 'Text',
    ];

    public function Highlight(): HTMLValue
    {
        $regex = sprintf('/\%s(.+)%s/', self::getOwner()->config()->get('shortcode_start'), self::getOwner()->config()->get('shortcode_end'));
        $value = preg_replace($regex, '<span class="is-highlighted">$1</span>', $this->getOwner()->getValue());

        return HTMLValue::create($value);
    }
}
