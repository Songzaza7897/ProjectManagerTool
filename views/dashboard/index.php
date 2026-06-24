<?php

/** @var yii\web\View $this */
/** @var array $stats */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Dashboard';
$name = Yii::$app->user->identity->fullName ?: Yii::$app->user->identity->username;
?>
<div class="page-container dashboard-page">
    <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
        <div class="alert alert-<?= $type === 'success' ? 'success' : 'info' ?> alert-dismissible fade show" role="alert">
            <?= Html::encode($message) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>

    <div class="page-heading dashboard-heading">
        <div>
            <p class="page-date"><?= date('l, F j') ?></p>
            <h1>Good morning, <?= Html::encode($name) ?></h1>
            <p class="page-subtitle">Here is what is moving across your workspace today.</p>
        </div>
        <a class="btn btn-dark heading-action" href="<?= Url::to(['/project/index']) ?>">
            <i data-lucide="plus"></i><span>New project</span>
        </a>
    </div>

    <section class="stat-grid" aria-label="Workspace summary">
        <?php foreach ($stats as $stat): ?>
            <article class="stat-card stat-<?= Html::encode($stat['tone']) ?>">
                <span class="stat-icon"><i data-lucide="<?= Html::encode($stat['icon']) ?>"></i></span>
                <div>
                    <p><?= Html::encode($stat['label']) ?></p>
                    <strong><?= Html::encode($stat['value']) ?></strong>
                </div>
                <span class="stat-trend"><i data-lucide="trending-up"></i> 8%</span>
            </article>
        <?php endforeach; ?>
    </section>

    <section class="dashboard-main-grid" id="analytics">
        <article class="surface-card chart-card">
            <div class="section-heading">
                <div>
                    <h2>Task status</h2>
                    <p>Distribution across all active projects</p>
                </div>
                <button class="icon-button light-button" type="button" title="More options"><i data-lucide="ellipsis"></i></button>
            </div>
            <div class="donut-wrap">
                <div class="donut-chart">
                    <div class="donut-center"><strong>84</strong><span>Total tasks</span></div>
                </div>
                <div class="chart-legend">
                    <span><i class="legend-dot done"></i>Done <strong>36</strong></span>
                    <span><i class="legend-dot progress"></i>In progress <strong>24</strong></span>
                    <span><i class="legend-dot review"></i>Review <strong>14</strong></span>
                    <span><i class="legend-dot todo"></i>To do <strong>10</strong></span>
                </div>
            </div>
        </article>

        <article class="surface-card chart-card">
            <div class="section-heading">
                <div>
                    <h2>Project progress</h2>
                    <p>Completion rate by project</p>
                </div>
                <select class="form-select form-select-sm chart-select" aria-label="Chart period">
                    <option>This month</option>
                    <option>This quarter</option>
                </select>
            </div>
            <div class="bar-chart" aria-label="Project completion chart">
                <div class="bar-grid"><span>100</span><span>75</span><span>50</span><span>25</span><span>0</span></div>
                <div class="bar-set">
                    <div class="bar-item"><div class="bar" style="height: 72%"><span>72%</span></div><small>PM Tool</small></div>
                    <div class="bar-item"><div class="bar bar-accent" style="height: 86%"><span>86%</span></div><small>Mobile App</small></div>
                    <div class="bar-item"><div class="bar" style="height: 64%"><span>64%</span></div><small>CRM</small></div>
                </div>
            </div>
        </article>
    </section>

    <section class="dashboard-bottom-grid" id="activity">
        <article class="surface-card list-card">
            <div class="section-heading">
                <div><h2>Upcoming tasks</h2><p>Due in the next seven days</p></div>
                <a href="<?= Url::to(['/project/board']) ?>">View board</a>
            </div>
            <div class="task-list">
                <div class="task-list-item"><span class="task-check"></span><div><strong>Dashboard UI design</strong><small>PM Tool · Tomorrow</small></div><span class="priority high">High</span></div>
                <div class="task-list-item"><span class="task-check"></span><div><strong>Calendar module</strong><small>PM Tool · 20 Aug</small></div><span class="priority medium">Medium</span></div>
                <div class="task-list-item"><span class="task-check"></span><div><strong>Analytics page</strong><small>CRM · 22 Aug</small></div><span class="priority low">Low</span></div>
            </div>
        </article>

        <article class="surface-card activity-card">
            <div class="section-heading"><div><h2>Recent activity</h2><p>Latest workspace updates</p></div></div>
            <div class="activity-list">
                <div class="activity-item"><span class="activity-avatar avatar-blue">J</span><div><strong>John assigned TASK-021</strong><small>12 minutes ago</small></div></div>
                <div class="activity-item"><span class="activity-avatar avatar-green">A</span><div><strong>Alice uploaded wireframe.png</strong><small>40 minutes ago</small></div></div>
                <div class="activity-item"><span class="activity-avatar avatar-coral">D</span><div><strong>David changed task status</strong><small>1 hour ago</small></div></div>
            </div>
        </article>

        <article class="surface-card schedule-card" id="schedule">
            <div class="section-heading"><div><h2>Schedule</h2><p>August 2026</p></div><button class="icon-button light-button" type="button" title="Open calendar"><i data-lucide="calendar-days"></i></button></div>
            <div class="week-row"><span>Mon</span><span>Tue</span><span class="today">Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span></div>
            <div class="date-row"><span>5</span><span>6</span><span class="today">7</span><span>8</span><span>9</span><span>10</span><span>11</span></div>
            <div class="schedule-events">
                <p><i class="event-dot teal"></i><strong>15</strong> Milestone review</p>
                <p><i class="event-dot coral"></i><strong>20</strong> Dashboard due</p>
                <p><i class="event-dot blue"></i><strong>25</strong> Final review</p>
            </div>
        </article>
    </section>
</div>