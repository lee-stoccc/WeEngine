<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/12/19
 * Time: 11:53
 */

namespace app\modules\mch\controllers;


use app\models\AdminPermission;
use app\models\We7Db;
use app\models\We7UserAuth;
use app\modules\mch\models\We7AuthForm;
use yii\data\Pagination;
use yii\db\Query;
use yii\helpers\VarDumper;

class We7Controller extends Controller
{
    public function actionAuth()
    {
        if (\Yii::$app->request->isPost) {
            $form = new We7AuthForm();
            $form->attributes = \Yii::$app->request->post();
            return $this->renderJson($form->save());
        } else {
            $query = new Query();
            $query->select('u.uid,u.username,u.joindate,ua.auth')
                ->from(['u' => We7Db::getTableName('users')])
                ->leftJoin(['ua' => We7UserAuth::tableName()], 'u.uid=ua.we7_user_id');
            $count = $query->count();
            $pagination = new Pagination(['totalCount' => $count,]);
            $list = $query->limit($pagination->limit)->offset($pagination->offset)->orderBy('u.uid DESC')->all();
            foreach ($list as $i => $item) {
                $list[$i]['auth'] = $item['auth'] ? json_decode($item['auth'], true) : null;
            }
            return $this->render('auth', [
                'list' => $list,
                'permission_list' => AdminPermission::getList(),
                'pagination' => $pagination,
            ]);
        }
    }
}