# Medium Editor for Yii2

[![Latest Version](https://img.shields.io/github/tag/Borales/yii2-medium-editor.svg?style=flat-square&label=release)](https://github.com/Borales/yii2-medium-editor/tags)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/borales/yii2-medium-editor.svg?style=flat-square)](https://packagist.org/packages/borales/yii2-medium-editor)

Renders Medium.com WYSIWYG editor ([yabwe/medium-editor](https://github.com/yabwe/medium-editor)) widget.

- [Installation](#installation)
- [Assets](#assets)
- [Usage](#usage)
- [Licence](#license)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ php composer.phar require "borales/yii2-medium-editor" "*"
```

or add

```
"borales/yii2-medium-editor": "*"
```

to the `require` section of your `composer.json` file.

## Assets

> By default - this extension doesn't provide any source files for Medium Editor itself.
It uses public CDN instead ([jsdelivr.com](http://www.jsdelivr.com/)). And by default - it
uses the latest version of the Medium Editor plugin.

However, you can change these settings by checking the following configuration of your application (`config/main.php`):

```php
return [
    // ... other settings
    'components' => [
        // ... other settings
        'assetManager' => [
            'bundles' => [
                'borales\medium\Asset' => [
                    // set `bootstrap` theme for Medium Editor widget as a default one
                    'theme' => 'bootstrap',
                    // switch Medium Editor sources from the "latest" to the specific version
                    'useLatest' => false,
                    // use specific version of Medium Editor plugin with "useLatest=false"
                    'cdnVersion' => '5.22.1',
                ],
            ]
        ],
    ]
]
```

> The default **specified** version for Medium Editor plugin is `5.22.1`.

In case if you want to use Medium Editor plugin from local sources - you can do that
by adding `bower-asset/medium-editor` package to your `composer.json` file and adding this line
to your local configuration:

```php
return [
    // ... other settings
    'components' => [
        // ... other settings
        'assetManager' => [
            'bundles' => [
                'borales\medium\Asset' => [
                    // use Medium Editor plugin sources from this path
                    'sourcePath' => '@bower/medium-editor/dist',
                ],
            ]
        ],
    ]
]
```

## Usage

### as a standalone widget for a Model

```php
echo \borales\medium\Widget::widget([
    'model' => $model,
    'attribute' => 'text',
]);
```

### as a standalone widget for a custom variable

```php
echo \borales\medium\Widget::widget([
    'name' => 'my_custom_var',
    'value' => '<p>Some custom text!</p>',
]);
```

### as a widget with extra Medium Editor settings

```php
echo \borales\medium\Widget::widget([
    'model' => $model,
    'attribute' => 'text',
    'theme' => 'tim', // Set a theme for this specific widget
    'settings' => [
        'buttons' => ['bold', 'italic', 'quote'],
    ],
]);
```

> [Here](https://github.com/yabwe/medium-editor/blob/master/OPTIONS.md) you can check the full list of Medium Editor options.

### as an ActiveForm widget
 
```php
echo $form->field($model, 'text')->widget(\borales\medium\Widget::className());
```

### as an ActiveForm widget with settings

```php
echo $form->field($model, 'text')->widget(\borales\medium\Widget::className(), [
    'theme' => 'mani',
    'settings' => [
        'buttons' => ['bold', 'italic', 'quote'],
    ],
]);
```

### as an ActiveField method (via `MediumEditorTrait`)

In case if you use your custom `ActiveField` class - you can use `MediumEditorTrait` in your class:

```php
namespace app\components;

class ActiveField extends \yii\widgets\ActiveField
{
    use \borales\medium\MediumEditorTrait;
}
```

And after that - call `mediumEditor()` method to render Medium Editor widget like this 
(and you can also pass Medium Editor settings as in above examples):

```php
echo $form->field($model, 'text')->mediumEditor()
```

## License

MIT License. Please see [License File](LICENSE) for more information.
