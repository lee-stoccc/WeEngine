<?php




error_reporting(3);
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');


require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
defined('YII_RUN') or define('YII_RUN', true);
defined('WE7_MODULE_NAME') or define('WE7_MODULE_NAME', 'zjhj_mall');

$config = require(__DIR__ . '/../config/web.php');
$app = new yii\web\Application($config);
try {
    $app->db->createCommand("SET SESSION sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'")->execute();
} catch (Exception $e) {
}
$app->run();

if (file_exists(\Yii::$app->runtimePath . '/logs/app.log')) {
    unlink(\Yii::$app->runtimePath . '/logs/app.log');
}
header('Location: https://cloud.suyongw.com/pt_micro/core/web/index.php?r=mch%2Fstore%2Findex');