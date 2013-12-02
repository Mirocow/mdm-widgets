<?php

namespace mdm\select2;

use \yii\widgets\InputWidget;
use yii\helpers\Html;

/**
 * Description of Select2
 *
 * @author MDMunir
 */
class Select2 extends InputWidget
{

	/**
	 * @var array the HTML attributes for the input tag.
	 */
	public $options = [];

	public $data;
	
	public $multiple = false;
	
	private $_select2Options = [];


	/**
	 * 
	 * @throws InvalidConfigException
	 */
	public function init()
	{
		parent::init();
		if (!isset($this->options['id'])) {
			$this->options['id'] = $this->hasModel() ? Html::getInputId($this->model, $this->attribute) : $this->getId();
		}
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		if ($this->hasModel()) {
			if($this->data !== null){
				echo Html::activeDropDownList($this->model, $this->attribute,  $this->data, $this->options);
			}
		} else {
			if($this->data !== null){
				echo Html::dropDownList($this->name, $this->value,  $this->data, $this->options);
			}
		}
		$this->registerClientScript();
	}

	/**
	 * Registers the needed JavaScript.
	 */
	public function registerClientScript()
	{
		$options = $this->getClientOptions();
		$options = empty($options) ? '' : Json::encode($options);
		$js = '';
//		if (is_array($this->charMap) && !empty($this->charMap)) {
//			$js .= 'jQuery.mask.definitions=' . Json::encode($this->charMap) . ";\n";
//		}
		$id = $this->options['id'];
		$js .= "jQuery(\"#{$id}\").select2({$options});";
		$view = $this->getView();
		Select2Asset::register($view);
		$view->registerJs($js);
	}

	/**
	 * @return array the options for the text field
	 */
	protected function getClientOptions()
	{
		return [];
		$options = [];
		if ($this->placeholder !== null) {
			$options['placeholder'] = $this->placeholder;
		}

		if ($this->completed !== null) {
			if ($this->completed instanceof JsExpression) {
				$options['completed'] = $this->completed;
			} else {
				$options['completed'] = new JsExpression($this->completed);
			}
		}

		return $options;
	}

	public function __set($name, $value)
	{
		if($this->canSetProperty($name)){
			parent::__set($name, $value);
		}
		$this->_select2Options[$name] = $value;
	}
	
	public function __get($name)
	{
		if($this->canGetProperty($name)){
			return parent::__get($name);
		}
		return isset($this->_select2Options[$name])?$this->_select2Options[$name]:null;
	}
}