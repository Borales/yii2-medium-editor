<?php
/**
 * @copyright Copyright (c) 2016 Alexandr Bordun
 * @link https://yiiframework.com.ua/
 * @license https://opensource.org/licenses/MIT MIT License
 */

namespace borales\medium;

/**
 * Trait for custom ActiveField class
 *
 * @author Alexandr Bordun <bordun.alexandr@gmail.com>
 * @link https://yiiframework.com.ua/
 * @package borales\medium
 */
trait MediumEditorTrait
{
    /**
     * Render Medium Editor widget
     * @param array $options
     * @param array $editorSettings
     * @return string
     */
    public function mediumEditor($options, $editorSettings)
    {
        return $this->widget(Widget::className(), [
            'options' => $options,
            'settings' => $editorSettings
        ]);
    }
}