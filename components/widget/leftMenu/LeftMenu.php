<?php
/**
 * LeftMenu.php
 *
 * @package app\components\widget\leftMenu
 * @date: 14.09.2015 21:14
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\components\widget\leftMenu;


use app\assets\CounterAsset;
use yii\base\InvalidConfigException;
use yii\base\Widget;

/**
 * ¬иджет главного меню
 * Class LeftMenu
 * @package app\components\widget\leftMenu
 */
class LeftMenu extends Widget
{
    public $user;
    public $menu = [];

    /**
     * Initializes the object.
     * This method is invoked at the end of the constructor after the object is initialized with the
     * given configuration.
     */
    public function init()
    {
        CounterAsset::register($this->getView());
        parent::init();
    }

    /**
     * Executes the widget.
     * @return string the result of widget execution to be outputted.
     */
    public function run()
    {
        // ѕункты меню €вл€ютс€ об€зательными аргументами
        if (!isset($this->menu['item'])) {
            throw new InvalidConfigException("Missing config item");
        }

        // ¬ыставл€ем активный пункт меню по имени с учетом вложенности
        foreach ($this->menu['item'] as $keyItem => $valueItem) {

            if (!isset($valueItem['name']) or !isset($valueItem['label']) or !isset($valueItem['icon_class'])) {
                throw new InvalidConfigException("Missing required config item.name or item.label or item.icon_class");
            }

            if (isset($this->menu['active']) and $valueItem['name'] == $this->menu['active']) {
                $this->menu['item'][$keyItem]['active'] = true;
            }

            // ≈сли у меню есть подменю, то провер€ем на активность и его
            if (isset($valueItem['item'])) {
                foreach ($valueItem['item'] as $keyItem2 => $valueItem2) {
                    if (!isset($valueItem2['name']) or !isset($valueItem2['label']) or !isset($valueItem2['icon_class'])) {
                        throw new InvalidConfigException("Missing required config item.name or item.label or item.icon_class");
                    }

                    // ≈сли нашли активное подменю, то устанавливаем признак активности и его родителю дл€ открытие select блока
                    if (isset($this->menu['active']) and $valueItem2['name'] === $this->menu['active']) {
                        $this->menu['item'][$keyItem]['active'] = true;
                        $this->menu['item'][$keyItem]['item'][$keyItem2]['active'] = true;
                    }
                }
            }
        }

        return $this->render('index.tpl', [
            'user' => $this->user,
            'menu' => $this->menu
        ]);
    }


}