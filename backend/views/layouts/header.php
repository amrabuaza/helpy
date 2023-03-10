<?php

use common\helper\Constants;
use common\models\user\User;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */
$user = User::findOne(Yii::$app->user->id);
?>

<header class="main-header">

    <?=Html::a('<span class="logo-mini">Helpy</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo'])?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php
                            $imgSrc = Constants::USER_DEFAULT;
                        ?>
                        <img src="<?=$imgSrc?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?=$user->username?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?=$imgSrc?>" class="img-circle"
                                 alt="User Image"/>
                            <p>
                                <?=
                                $user->first_name . " " . $user->last_name;
                                ?>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?=Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                )?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
