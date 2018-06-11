<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Html::img('./img/kpi.png', ['alt' => Yii::$app->name, 'style' => "height:40px; width:auto; margin-top:-8px;"]),
                // 'brandLabel' => Html::img('./img/logo.png ', ['alt'=>Yii::$app->name ]),
                'brandUrl' => Yii::$app->homeUrl,
                'innerContainerOptions' => ['class' => 'container-fluid',
                    'style' => 'padding-left: 50px; padding-right: 50px;'],
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top','style'=>'background-color: #317ecc;',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => [
                    //['label' => 'Home', 'url' => ['/site/index']],
                    //['label' => 'About', 'url' => ['/site/about']],                   
                    //['label' => '<i class="glyphicon glyphicon-sort"></i> 2561', 'url' => ['/kpi/kpi/index']],
                    
                    [
                        "visible" => !Yii::$app->user->isGuest,
                        'label' => '<i class="glyphicon glyphicon-sort"></i> ปี',
                        'items' => [
                            ["label" => "2561", "url" => ['/kpi/kpi/index']],
                            ["label" => "2560", "url" => ['/kpi/kpi/index']],
                            ["label" => "2559", "url" => ['/kpi/kpi/index']],
                            
                        ],
                    ],
                    [
                        "visible" => !Yii::$app->user->isGuest,
                        'label' => '<i class="glyphicon glyphicon-cog"></i> ข้อมูลKPI',
                        'items' => [
                            ["label" => "หน่วยงานkpi", "url" => ["/kpi/kpidepart/index"]],
                            ["label" => "ความถี่", "url" => ["/kpi/kpiperiod/index"]],
                            ["label" => "ประเภทkpi", "url" => ["/kpi/kpitype/index"]],
                            ["label" => "ประเภทหมวด", "url" => ["/kpi/k-mond/index"]],
                            ["label" => "ประเภทโครงการ", "url" => ["/kpi/k-kong/index"]],
                            ["label" => "ประเภทแผนที่", "url" => ["/kpi/k-pan/index"]],
                            ["label" => "ประเภทการแสดงผล", "url" => ["/kpi/k-level/index"]],
                        ],
                    ],
                    [
                        "visible" => !Yii::$app->user->isGuest,
                        'label' => '<i class="glyphicon glyphicon-cog"></i> ข้อมูลพื้นฐาน',
                        'items' => [
                            ['label' => 'หน่วยงาน', 'url' => ['/departments/index']],
                            ['label' => 'กลุ่มงาน', 'url' => ['/groups/index']],
                            ['label' => 'ตำแหน่ง', 'url' => ['/positions/index']],
                            ['label' => 'อาชีพ', 'url' => ['/occupations/index']],
                            '<li class="divider"></li>',
                            ['label' => '<i class="glyphicon glyphicon-user"></i> สมาชิก', 'url' => ['/users/index']],
                        ],
                    ],
                    Yii::$app->user->isGuest ?
                            ['label' => 'Login', 'url' => ['/user/security/login']] :
                            [
                        'label' => '<i class="glyphicon glyphicon-user"></i> (' . Yii::$app->user->identity->username . ')',
                        'items' => [
                            ['label' => 'ข้อมูลส่วนตัว <i class="glyphicon glyphicon-briefcase"></i>', 'url' => ['/users/indexuser']],
                            ['label' => 'Logout <i class="glyphicon glyphicon-log-out"></i>', 'url' => ['/site/logout'], 'linkOptions' => ['data' => ['method' => 'post']]],
                        ]
                            ],
                ],
            ]);
            NavBar::end();
            ?>

            <div class="container-fluid" style="padding: 35px;">
                <br>
            <?php //
//            Breadcrumbs::widget([
//                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//            ])
            ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; medico <?php// date('Y') ?></p>

                <p class="pull-right"><a href="http://scriptsoft.co.th/" target="_blank"> power by medico </a></p>
            </div>
        </footer>

<?php $this->endBody() ?>
    </body>
</html>
        <?php $this->endPage() ?>
