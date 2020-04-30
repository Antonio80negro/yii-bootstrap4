<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap4;

/**
 * Button renders a bootstrap button.
 *
 * For example,
 *
 * ```php
 * echo Button::widget()
 *     ->label('Action')
 *     ->icon('play-circle')
 *     ->options(['class' => 'btn-lg']);
 * ```
 */
class Button extends Widget
{
    private string $tagName = 'button';

    private string $label = 'Button';
    
    private string $icon = '';

    private bool $encodeLabels = true;

    private array $options = [];

    protected function run(): string
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = "{$this->getId()}-button";
        }

        Html::addCssClass($this->options, ['widget' => 'btn']);

        $this->registerPlugin('button', $this->options);
        if(empty($this->icon)){
            $this->encodeLabels = true;
            $this->label = '<span class="glyphicon glyphicon-'.$this->icon.'"></span>'.$this->label;
        }
        
        return Html::tag(
            $this->tagName,
            $this->encodeLabels ? Html::encode($this->label) : $this->label,
            $this->options
        );
    }

    /**
     * Whether the label should be HTML-encoded.
     */
    public function encodeLabels(bool $value): self
    {
        $this->encodeLabels = $value;

        return $this;
    }

    /**
     * The button label
     */
    public function label(string $value): self
    {
        $this->label = $value;

        return $this;
    }
    
    /**
     * The button icon (bootstrap icons allowed)
     * @param string $iconName if empty no icon will be rendered 
     */
    public function icon(string $iconName): self
    {
        $this->icon = $iconName;
        
        return $this;
    }


    /**
     * The HTML attributes for the widget container tag. The following special options are recognized.
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function options(array $value): self
    {
        $this->options = $value;

        return $this;
    }

    /**
     * The tag to use to render the button.
     */
    public function tagName(string $value): self
    {
        $this->tagName = $value;

        return $this;
    }
}
