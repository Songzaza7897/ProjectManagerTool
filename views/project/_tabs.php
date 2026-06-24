<?php

use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var string $active */
?>
<nav class="project-tabs" aria-label="Project sections">
    <a class="<?= $active === 'overview' ? 'active' : '' ?>" href="<?= Url::to(['/project/view', 'id' => 1]) ?>">Overview</a>
    <a class="<?= $active === 'board' ? 'active' : '' ?>" href="<?= Url::to(['/project/board', 'id' => 1]) ?>">Board</a>
    <a href="<?= Url::to(['/project/view', 'id' => 1]) ?>#schedule">Calendar</a>
    <a href="<?= Url::to(['/project/view', 'id' => 1]) ?>#team">Team</a>
    <a href="<?= Url::to(['/project/view', 'id' => 1]) ?>#activity">Activity</a>
</nav>
