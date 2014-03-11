<?php


class Input
{

	public function render($elementOptions)
	{
		$template = '<input %s>';
		$name   = $elementOptions['name'];
		if (empty($name) && $name !== 0) {
			throw new Exception(sprintf(
				'%s requires that the element has an assigned name; none discovered',
				__METHOD__
			));
		}
		

        $attributes = $elementOptions['attributes'];	
        $attributes['name'] = $name;
		$attributes['value'] = isset($elementOptions['value']) ? htmlspecialchars($elementOptions['value']):null;
		if(isset($elementOptions['options']['label']))
		{
			$label = htmlspecialchars($elementOptions['options']['label']);
			$for = isset($elementOptions['options']['for']) ? 'for="' .$name . '"':'';
			$template = '<label '. $for .'><span>'. $label . '</span><input %s></label>';
		}
		
        return sprintf(
            $template,
            $this->createAttributesString($attributes)
        );
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