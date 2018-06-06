<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/8/31
 * Time: 18:12
 */

namespace app\models;


use yii\helpers\VarDumper;

class HomePageModule extends Model
{
    public $store_id;

    private $module_list = [
        [
            'name' => 'banner',
        ],
        [
            'name' => 'search',
        ],
        [
            'name' => 'nav',
        ],
        [
            'name' => 'topic',
        ],
        [
            'name' => 'coupon',
        ],
        [
            'name' => 'cat',
        ],
        [
            'name' => 'miaosha',
        ],
        [
            'name' => 'pintuan',
        ],
    ];

    /**
     */
    public function search($store_module_list = false, $with_content = true)
    {
        if ($store_module_list) {
            $store = Store::findOne($this->store_id);
            $module_list = json_decode($store->home_page_module, true);
            $module_list = $module_list ? $module_list : [];
        } else {
            $module_list = $this->module_list;
            $module_list = array_merge($module_list, $this->getCatList());
            $module_list = array_merge($module_list, $this->getBlockList());
        }
        foreach ($module_list as $i => $item) {
            $content = $this->getContent($item['name']);
            $module_list[$i]['content'] = $content ? $content : '<div style="padding: 1rem;text-align: center;color: #888">无内容</div>';
        }
        return $module_list;
    }

    private function getCatList()
    {
        $list = Cat::find()->where([
            'store_id' => $this->store_id,
            'is_delete' => 0,
            'parent_id' => 0,
        ])->orderBy('addtime DESC')->select('id')->all();
        $new_list = [];
        foreach ($list as $item) {
            $new_list[] = [
                'name' => 'single_cat-' . $item->id,
            ];
        }
        return $new_list;
    }

    private function getBlockList()
    {
        $list = HomeBlock::find()->where([
            'store_id' => $this->store_id,
            'is_delete' => 0,
        ])->orderBy('addtime DESC')->all();
        $new_list = [];
        foreach ($list as $item) {
            $new_list[] = [
                'name' => 'block-' . $item->id,
            ];
        }
        return $new_list;
    }

    private function getContent($name)
    {
        $content = false;
        switch ($name) {
            case 'banner': {
                $content = \Yii::$app->view->render('/store/home-page-module/' . $name . '.php');
                break;
            }
            case 'search': {
                $content = \Yii::$app->view->render('/store/home-page-module/' . $name . '.php');
                break;
            }
            case 'nav': {
                $content = \Yii::$app->view->render('/store/home-page-module/' . $name . '.php');
                break;
            }
            case 'cat': {
                $content = \Yii::$app->view->render('/store/home-page-module/' . $name . '.php');
                break;
            }
            case 'coupon': {
                $content = \Yii::$app->view->render('/store/home-page-module/' . $name . '.php');
                break;
            }
            case 'topic': {
                $content = \Yii::$app->view->render('/store/home-page-module/' . $name . '.php');
                break;
            }
            case 'miaosha': {
                $content = \Yii::$app->view->render('/store/home-page-module/' . $name . '.php');
                break;
            }
            case 'pintuan': {
                $content = \Yii::$app->view->render('/store/home-page-module/' . $name . '.php');
                break;
            }
            default: {
                $names = explode('-', $name);
                $name = $names[0];
                $id = $names[1];
                if ($name == 'block') {//自定义首页板块
                    $block = HomeBlock::findOne($id);
                    $content = \Yii::$app->view->render('/store/home-page-module/' . $name . '.php', [
                        'block' => $block,
                    ]);
                }
                if ($name == 'single_cat') {//单个分类
                    $cat = Cat::findOne($id);
                    $content = \Yii::$app->view->render('/store/home-page-module/cat.php', [
                        'cat' => $cat,
                    ]);
                }
                break;
            }
        }
        return $content;
    }


}