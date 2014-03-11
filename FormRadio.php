<?php


class Radio
{

	public function render($elementOptions)
	{
		$template = '%s';
		$name   = $elementOptions['name'];
		if (empty($name) && $name !== 0) {
			throw new Exception(sprintf(
				'%s requires that the element has an assigned name; none discovered',
				__METHOD__
			));
		}

		$options = isset($elementOptions['value_options']) ? $elementOptions['value_options']:null;
		$value = isset($elementOptions['value']) ? $elementOptions['value']:null;

        $attributes = $elementOptions['attributes'];
		if(isset($elementOptions['options']['label']))
		{
			$label = htmlspecialchars($elementOptions['options']['label']);
			$template = '<fieldset><legend>'. $label .'</legend>%s</fieldset>';
		}
		
        $attributes['name'] = $name;

        return sprintf(
            $template,
            $this->renderOptions($options, $value, $attributes)
        );
		
	
	}
	
	private function renderOptions($options, $value, $attributes)
	{
		$template      = '<label><input %s value="%s" %s>%s</label>';
		$values = isset($value) ? $value:null;
		
		foreach($options as $key => $val)
		{
			$optionStrings[] = sprintf(
				$template,
				($key==$value) ? 'checked="checked"':'',
				$key,
				$this->createAttributesString($attributes),
				$val
			);
			
		}
		return implode("\n", $optionStrings);
	}
	
	private function createAttributesString($attributes)
	{
		$attributesString = '';
		foreach($attributes as $key => $val)
		{
			$attributesString .= $key.'="'.$val.'" ';
		}
		return $attributesString;
	}
}
