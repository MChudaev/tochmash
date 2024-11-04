<?php
use yii\helpers\Html;
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
        <img src="<?/*=$assetDir*/?>/admin/img/logo-toch.png" alt="Logo" class="brand-image elevation-3" style="opacity: .8">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Администратор</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
					['label' => 'Заявки', 'icon' => 'window-restore', 'url' => ['requests/index']],
					['label' => 'Материалы', 'icon' => 'scroll', 'url' => ['materials/index']],
                    ['label' => 'Типы доставки', 'icon' => 'truck', 'url' => ['delivery-types/index']],
					['label' => 'Детали', 'icon' => 'cogs', 'url' => ['details/index']],
					['label' => 'Тип закупки', 'icon' => 'shopping-basket', 'url' => ['purchase-types/index']],
					['label' => 'Заказчики', 'icon' => 'user-friends', 'url' => ['customers/index']],
					['label' => 'Сотрудники', 'icon' => 'users', 'url' => ['employees/index']],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>