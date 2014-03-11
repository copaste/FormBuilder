<?php


class Select
{

	public function render($elementOptions)
	{
		$template = '<select %s>%s</select>';
		$name   = $elementOptions['name'];
		if (empty($name) && $name !== 0) {
			throw new Exception(sprintf(
				'%s requires that the element has an assigned name; none discovered',
				__METHOD__
			));
		}

		$options = isset($elementOptions['value_options']) ? $elementOptions['value_options']:null;
		$emptyOption = isset($elementOptions['empty_option']) ? $elementOptions['empty_option']:null;
		$value = isset($elementOptions['value']) ? $elementOptions['value']:null;
		
        if ($emptyOption!== null) {
            $options = array('' => $emptyOption) + $options;
        }

        $attributes = $elementOptions['attributes'];
    //    $value      = $attributes['value']; //$this->validateMultiValue($element->getValue(), $attributes);
		
        $attributes['name'] = $name;
        if (array_key_exists('multiple', $attributes) && $attributes['multiple']) {
            $attributes['name'] .= '[]';
        }
		
		if(isset($elementOptions['options']['label']))
		{
			$label = htmlspecialchars($elementOptions['options']['label']);
			$for = isset($elementOptions['options']['for']) ? 'for="' .$name . '"':'';
			$template = '<label '. $for .'><span>'. $label . '</span><select %s>%s</select></label>';
		}

        return sprintf(
            $template,
            $this->createAttributesString($attributes),
            $this->renderOptions($options, $value)
        );
	}
	
	private function renderOptions($options, $value)
	{
		$template      = '<option %s value="%s">%s</option>';
		$values = is_array($value) ?  $value:array($value);
		foreach($options as $key => $val)
		{
			$optionStrings[] = sprintf(
                $template,
                in_array($key, $values) ? 'selected="selected"':'',
				$key,
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
