<?php


use common\helper\Constants;
use common\helper\HelperMethods;
use common\models\user\User;
use common\models\user\UserRoles;

$user = User::findOne(Yii::$app->user->id);
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php
                $imgSrc = Constants::USER_DEFAULT;
                ?>
                <img src="<?=$imgSrc?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=$user->username?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <?=dmstr\widgets\Menu::widget(
            [

                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Dashboard', 'options' => ['class' => 'header']],
                    ['label' => 'Admins', 'visible' => Yii::$app->user->identity->isRoot(), 'icon' => 'users', 'url' => ['/user/index?type=' . HelperMethods::convertStringToUrlString(User::TYPE_ADMIN)],],
                    ['label' => 'Articles', 'icon' => 'list', 'url' => ['/article']],
                    ['label' => 'Categories', 'icon' => 'list', 'url' => ['/categorie']],
                    ['label' => 'Requests', 'icon' => 'ticket', 'url' => ['/request']],
                    ['label' => 'Pending Requests', 'icon' => 'ticket', 'url' => ['/request', 'status' => 'pending']],
                    [
                        'label' => Yii::t('app', 'Translation'),
                        'visible' => Yii::$app->user->can('manageTranslation'),
                        'icon' => 'language',
                        'items' => [
                            ['label' => Yii::t('app', 'Translation Messages'), 'icon' => 'list', 'url' => ['/i18n']],
                            ['label' => Yii::t('app', 'Translate Category'), 'icon' => 'list', 'url' => ['/translate-category/index']],
                        ]
                    ],
                    [
                        'label' => Yii::t('app', 'Permissions'),
                        'visible' => Yii::$app->user->can('managePermissions'),
                        'icon' => 'shield',
                        'url' => ['/permissions'],
                        'items' => [
                            ['label' => Yii::t('app', 'Assignment'), 'icon' => 'list', 'url' => ['/permissions/assignment']],
                            ['label' => Yii::t('app', 'Permission'), 'icon' => 'list', 'url' => ['/permissions/permission']],
                            ['label' => Yii::t('app', 'Role'), 'icon' => 'list', 'url' => ['/permissions/role']],
                        ]
                    ],
                ]
            ]
        )?>

    </section>

</aside>
