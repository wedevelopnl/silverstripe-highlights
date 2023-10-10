# silverstripe-highlights
This module creates a `.Highlight` method on all SS DBStrings to provide the ability to highlight custom texts by placing it between shortcodes that are configurable by yourself.

## Requirements
* See `composer.json` requirement

## Installation
* `composer require wedevelopnl/silverstripe-highlights`

Next, you'll need to run a `dev/build` with a `flush=all` to allow this module to work properly.

## License
See [License](LICENSE)

## Maintainers
* [WeDevelop](https://www.wedevelop.nl/) <development@wedevelop.nl>

## Configuration
```yml
SilverStripe\ORM\FieldType\DBString:
    shortcode_start: '['
    shortcode_end: ']'
    css_class_name: 'highlight'
```

## Example
### Input
```html
This is a [large] content string which outputs HTML around the word 'large'.
```

### Output
```html
This is a <span class="highlight">large</span> content string which outputs HTML around the word 'large'.
```

## Development and contribution
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
See read our [contributing](CONTRIBUTING.md) document for more information.
