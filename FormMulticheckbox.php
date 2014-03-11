<?php


class Multicheckbox
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
        $attributes['name'] = $name.'[]';
        $attributes['type'] = 'checkbox';

        return sprintf(
            $template,
            $this->renderOptions($options, $value, $attributes)
        );
	}
	
	private function renderOptions($options, $value, $attributes)
	{
		$template      = '<label><input %s value="%s" %s>%s</label>';
		$values = is_array($value) ?  $value:array($value);
		
		foreach($options as $key => $val)
		{
			$optionStrings[] = sprintf(
				$template,
				in_array($key, $values) ? 'checked="checked"':'',
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