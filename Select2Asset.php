<?php
namespace mdm\select2;
/**
 * Description of Select2Asset
 *
 * @author MDMunir
 */
class Select2Asset extends \yii\web\AssetBundle
{
	/**
	 * @inheritdoc
	 */
	public $sourcePath = '@mdm/select2/assets';
	/**
	 * @inheritdoc
	 */
	public $css = [
		'select2.css',
	];
	/**
	 * @inheritdoc
	 */
	public $js = [
		'select2.js',
	];
	/**
	 * @inheritdoc
	 */
	public $depends = [
		'yii\web\YiiAsset',
	];
}