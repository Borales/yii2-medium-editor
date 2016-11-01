<?php

namespace borales\medium;

/**
 * Trait for custom ActiveField class
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
    public function editor($options, $editorSettings)
    {
        return $this->widget(Widget::className(), [
            'options' => $options,
            'settings' => $editorSettings
        ]);
    }
}