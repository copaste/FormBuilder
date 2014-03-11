<?php

class Form
{
	/**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
		'action' => '',
        'method' => 'get',
    );
	
	protected $inputTypes = array(
		'text'           => true,
        'button'         => true,
        'file'           => true,
        'hidden'         => true,
        'image'          => true,
        'password'       => true,
        'reset'          => true,
        'submit'         => true,
        'color'          => true,
        'date'           => true,
        'datetime'       => true,
        'datetime-local' => true,
        'email'          => true,
        'month'          => true,
        'number'         => true,
        'range'          => true,
        'search'         => true,
        'tel'            => true,
        'time'           => true,
        'url'            => true,
        'week'           => true,
	);
	
	/**
     * Seed elements
     *
     * @var array
     */
    protected $elements = array();
	
	public function __construct($name = null)
	{
		$this->attributes['name'] = $name!==null ? $name:'';
	}
	
	/**
     * Generate an opening form tag
     *
     * @param  null|FormInterface $form
     * @return string
     */
	public function openTag()
	{
		$form = "";
		foreach($this->attributes as $key => $val)
		{
			$form .= $key.'="'.$val.'" ';
		}
		return "<form " . $form . ">"; 
	}
	
	/**
     * Generate a closing form tag
     *
     * @return string
     */
	public function closeTag()
	{
		return "</form>";
	}
	
	/**
     * Add form element and its attributes
     *
     * @return 0
     */
	public function add(array $element)
	{
		 $this->elements[$element['name']] = $element;
	}
	
	public function get($name)
	{
		$attributes = '';
		if( array_key_exists($name, $this->elements) )
		{
			if(! isset($this->elements[$name]['attributes']) )
				die('You have to set element type!');
			
			$fieldType = ucfirst($this->elements[$name]['attributes']['type']);
			$type = strtolower($this->elements[$name]['attributes']['type']);
			if(isset($this->inputTypes[$type]))
			{
				$fieldType = 'Input';
			}
			$field = new $fieldType();

			return $field->render($this->elements[$name]);
		}
		return false;
	}
	
	public function setAttribute($key, $value)
	{
		$this->attributes[$key] = $value;
	}
	
	public function setAttributes(array $attributes = array())
	{
		foreach($attributes as $key => $value)
		{
			$this->attributes[$key] = $value;
		}
	}
	
	public function elementAttributes($name, array $attributes)
	{
		$this->elements[$name]['attributes'] = array_merge($this->elements[$name]['attributes'], $attributes);
	}
	
	public function bind(array $data)
	{
		foreach($this->elements as $key => $val)
		{
			$this->elements[$key]['value'] = isset($data[$key]) ? $data[$key]:null;
		}
	}
}

/**
 * Auto load function, load all advanced input fields. DO NOT REMOVE!!!
 *
 * @return null
 */
function __autoload($class_name) 
{
	include 'Form' . $class_name . '.php';
}