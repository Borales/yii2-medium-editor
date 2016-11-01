<?php
/**
 * @copyright Copyright (c) 2016 Alexandr Bordun
 * @link https://yiiframework.com.ua/
 * @license https://opensource.org/licenses/MIT MIT License
 */

namespace borales\medium;

use yii\widgets\ActiveField;

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
     * @return ActiveField
     */
    public function mediumEditor($options = array())
    {
        return $this->widget(Widget::className(), $options);
    }
}