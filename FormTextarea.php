<?php


class Textarea
{

	public function render($elementOptions)
	{
		$template = '<textarea %s>%s</textarea>';
		$name   = $elementOptions['name'];
		if (empty($name) && $name !== 0) {
			throw new Exception(sprintf(
				'%s requires that the element has an assigned name; none discovered',
				__METHOD__
			));
		}
		

        $attributes = $elementOptions['attributes'];	
        $attributes['name'] = $name;
		$value = isset($elementOptions['value']) ? htmlspecialchars($elementOptions['value']):null;
		if(isset($elementOptions['options']['label']))
		{
			$label = htmlspecialchars($elementOptions['options']['label']);
			$for = isset($elementOptions['options']['for']) ? 'for="' .$name . '"':'';
			$template = '<label '. $for .'><span>'. $label . '</span><textarea %s>%s</textarea></label>';
		}

        return sprintf(
            $template,
            $this->createAttributesString($attributes),
			$value
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