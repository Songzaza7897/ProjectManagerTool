<?php
/** @var string $content */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);

$isAuthPage = isset($this->params['authPage']) && $this->params['authPage'];
$route = Yii::$app->controller->route;
$isActive = function ($prefix) use ($route) {
    return strpos($route, $prefix) === 0 ? ' active' : '';
};
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title ?: 'PM Tool') ?></title>
    <?php $this->head() ?>
</head>

<body class="<?= $isAuthPage ? 'auth-body' : 'app-body' ?>">
<?php $this->beginBody() ?>

<?php if ($isAuthPage): ?>
    <?= $content ?>
<?php else: ?>
    <div class="app-shell">
        <header class="app-topbar">
            <button class="icon-button sidebar-toggle d-lg-none" type="button" aria-label="Open navigation" data-sidebar-toggle>
                <i data-lucide="menu"></i>
            </button>
            <a class="app-brand" href="<?= Url::to(['/dashboard/index']) ?>">
                <span class="brand-mark"><i data-lucide="panels-top-left"></i></span>
                <span>PM Tool</span>
            </a>

            <div class="dropdown ms-auto">
                <button class="profile-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="profile-avatar"><i data-lucide="user-round"></i></span>
                    <span class="profile-copy d-none d-sm-block">
                        <strong><?= Html::encode(Yii::$app->user->isGuest ? 'Guest' : Yii::$app->user->identity->username) ?></strong>
                        <small><?= Yii::$app->user->isGuest ? 'Visitor' : 'Workspace admin' ?></small>
                    </span>
                    <i class="profile-chevron d-none d-sm-block" data-lucide="chevron-down"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <?php if (Yii::$app->user->isGuest): ?>
                        <li><a class="dropdown-item" href="<?= Url::to(['/site/login']) ?>">Login</a></li>
                        <li><a class="dropdown-item" href="<?= Url::to(['/site/signup']) ?>">Create account</a></li>
                    <?php else: ?>
                        <li><span class="dropdown-item-text text-muted small">Signed in as <?= Html::encode(Yii::$app->user->identity->username) ?></span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <?= Html::beginForm(['/site/logout'], 'post') ?>
                            <?= Html::submitButton('<i data-lucide="log-out"></i><span>Logout</span>', [
                                'class' => 'dropdown-item dropdown-action',
                            ]) ?>
                            <?= Html::endForm() ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </header>

        <aside class="app-sidebar" data-sidebar>
            <nav class="sidebar-nav" aria-label="Main navigation">
                <a class="sidebar-link<?= $isActive('dashboard/') ?>" href="<?= Url::to(['/dashboard/index']) ?>">
                    <i data-lucide="layout-dashboard"></i><span>Dashboard</span>
                </a>
                <a class="sidebar-link<?= $isActive('project/') ?>" href="<?= Url::to(['/project/index']) ?>">
                    <i data-lucide="folder-kanban"></i><span>Projects</span>
                </a>
                <a class="sidebar-link" href="<?= Url::to(['/project/board']) ?>">
                    <i data-lucide="circle-check-big"></i><span>Tasks</span>
                </a>
                <a class="sidebar-link" href="<?= Url::to(['/project/view', 'id' => 1]) ?>#schedule">
                    <i data-lucide="calendar-days"></i><span>Calendar</span>
                </a>
                <a class="sidebar-link" href="<?= Url::to(['/project/view', 'id' => 1]) ?>#activity">
                    <i data-lucide="clock-3"></i><span>Time Tracking</span>
                </a>
                <a class="sidebar-link" href="<?= Url::to(['/dashboard/index']) ?>#analytics">
                    <i data-lucide="chart-no-axes-column-increasing"></i><span>Analytics</span>
                </a>
                <a class="sidebar-link" href="<?= Url::to(['/project/view', 'id' => 1]) ?>#team">
                    <i data-lucide="users"></i><span>Team</span>
                </a>
                <a class="sidebar-link" href="<?= Url::to(['/dashboard/index']) ?>#activity">
                    <i data-lucide="bell"></i><span>Notifications</span>
                    <span class="nav-badge">3</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="sidebar-help-icon"><i data-lucide="circle-help"></i></div>
                <div><strong>Need help?</strong><small>View workspace guide</small></div>
            </div>
        </aside>

        <button class="sidebar-backdrop" type="button" aria-label="Close navigation" data-sidebar-backdrop></button>

        <main class="app-content">
            <?= $content ?>
        </main>
    </div>
<?php endif; ?>

<?php
$this->registerJs(<<<JS
if (window.lucide) {
    window.lucide.createIcons({ attrs: { 'stroke-width': 1.8 } });
}
var sidebar = document.querySelector('[data-sidebar]');
var sidebarToggle = document.querySelector('[data-sidebar-toggle]');
var sidebarBackdrop = document.querySelector('[data-sidebar-backdrop]');
function toggleSidebar(forceOpen) {
    if (!sidebar) return;
    var shouldOpen = typeof forceOpen === 'boolean' ? forceOpen : !sidebar.classList.contains('is-open');
    sidebar.classList.toggle('is-open', shouldOpen);
    document.body.classList.toggle('sidebar-open', shouldOpen);
}
if (sidebarToggle) sidebarToggle.addEventListener('click', function () { toggleSidebar(); });
if (sidebarBackdrop) sidebarBackdrop.addEventListener('click', function () { toggleSidebar(false); });
JS
);
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
