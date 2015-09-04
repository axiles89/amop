<?php
/**
 * ICheckAsset.php
 *
 * @package app\assets\plugin
 * @date: 03.09.2015 20:58
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\assets\plugin;


use yii\web\AssetBundle;

class ICheckAsset extends AssetBundle
{
    public $skin = "blue";

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];

    public $js = [
        'js/plugin/iCheck/icheck.js'
    ];

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];


    public function init() {
        if ($this->skin) {
            $this->css[] = "css/plugin/iCheck/square/$this->skin.css";
        }
        parent::init();
    }

}