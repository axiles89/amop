<?php
/**
 * CounterAsset.php
 *
 * @package app\assets
 * @date: 06.11.2015 21:20
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\assets;


use yii\web\AssetBundle;

/**
 * Class CounterAsset
 * @package app\assets
 */
class CounterAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $basePath = '@webroot';
    /**
     * @var string
     */
    public $baseUrl = '@web';

    /**
     * @var array
     */
    public $js = [
        'js/counter.js'
    ];

    /**
     * @var array
     */
    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    /**
     * @var array
     */
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    /**
     * @var array
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\bootstrap\BootstrapPluginAsset',
        'app\assets\AppAsset'
    ];
}