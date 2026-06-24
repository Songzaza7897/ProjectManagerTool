<?php

/** @var yii\web\View $this */
/** @var array $project */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $project['name'];
?>
<div class="page-container project-detail-page">
    <div class="project-context-bar">
        <?= $this->render('_tabs', ['active' => 'overview']) ?>
        <div class="toolbar-search compact-search">
            <i data-lucide="search"></i>
            <input type="search" class="form-control" placeholder="Search this project" aria-label="Search this project">
        </div>
    </div>

    <section class="project-hero">
        <div class="project-identity">
            <div class="project-symbol project-symbol-large">P</div>
            <div>
                <span class="status-pill"><i></i><?= Html::encode($project['status']) ?></span>
                <h1><?= Html::encode($project['name']) ?></h1>
                <p><?= Html::encode($project['description']) ?></p>
            </div>
        </div>
        <div class="project-actions">
            <a class="btn btn-outline-dark" href="<?= Url::to(['/project/board', 'id' => $project['id']]) ?>"><i data-lucide="kanban"></i> Open board</a>
            <button class="icon-button light-button" type="button" title="Project options"><i data-lucide="ellipsis"></i></button>
        </div>
    </section>

    <section class="detail-stat-grid">
        <article><span class="detail-icon orange"><i data-lucide="square-check-big"></i></span><div><small>Total tasks</small><strong>84</strong></div></article>
        <article><span class="detail-icon green"><i data-lucide="badge-check"></i></span><div><small>Completed</small><strong>62</strong></div></article>
        <article id="team"><span class="detail-icon blue"><i data-lucide="users"></i></span><div><small>Members</small><strong><?= Html::encode($project['members']) ?></strong></div></article>
        <article><span class="detail-icon violet"><i data-lucide="chart-no-axes-column-increasing"></i></span><div><small>Progress</small><strong><?= Html::encode($project['progress']) ?>%</strong></div></article>
    </section>

    <section class="project-overview-grid">
        <article class="surface-card project-summary">
            <div class="section-heading"><div><h2>Project details</h2><p>Key dates and ownership</p></div></div>
            <dl class="detail-list">
                <div><dt>Status</dt><dd><span class="status-pill"><i></i><?= Html::encode($project['status']) ?></span></dd></div>
                <div><dt>Created</dt><dd><?= Html::encode($project['date']) ?></dd></div>
                <div><dt>Due date</dt><dd>30 Sep 2026</dd></div>
                <div><dt>Project lead</dt><dd><span class="mini-avatar">A</span> Alice Morgan</dd></div>
            </dl>
        </article>

        <article class="surface-card project-health">
            <div class="section-heading"><div><h2>Progress</h2><p>Overall task completion</p></div><strong class="health-value"><?= Html::encode($project['progress']) ?>%</strong></div>
            <div class="progress large-progress" role="progressbar" aria-valuenow="<?= Html::encode($project['progress']) ?>" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: <?= Html::encode($project['progress']) ?>%"></div>
            </div>
            <div class="health-breakdown">
                <span><i class="legend-dot done"></i><strong>62</strong> Done</span>
                <span><i class="legend-dot progress"></i><strong>14</strong> In progress</span>
                <span><i class="legend-dot todo"></i><strong>8</strong> To do</span>
            </div>
        </article>
    </section>

    <section class="surface-card milestone-section" id="schedule">
        <div class="section-heading"><div><h2>Upcoming milestones</h2><p>Important dates for this project</p></div><button class="btn btn-sm btn-outline-dark"><i data-lucide="plus"></i> Add milestone</button></div>
        <div class="milestone-list">
            <div><span class="milestone-date"><strong>20</strong>Aug</span><span><strong>Dashboard delivery</strong><small>Design and frontend implementation</small></span><span class="milestone-state warning">In progress</span></div>
            <div><span class="milestone-date"><strong>05</strong>Sep</span><span><strong>Internal testing</strong><small>Team acceptance and issue review</small></span><span class="milestone-state neutral">Planned</span></div>
            <div><span class="milestone-date"><strong>30</strong>Sep</span><span><strong>Version 1 release</strong><small>Production launch</small></span><span class="milestone-state neutral">Planned</span></div>
        </div>
    </section>

    <section class="surface-card activity-section" id="activity">
        <div class="section-heading"><div><h2>Recent activity</h2><p>Latest updates from the project team</p></div></div>
        <div class="activity-list horizontal-activity">
            <div class="activity-item"><span class="activity-avatar avatar-blue">J</span><div><strong>John completed Database schema</strong><small>Today at 10:24</small></div></div>
            <div class="activity-item"><span class="activity-avatar avatar-green">A</span><div><strong>Alice moved TASK-005 to In progress</strong><small>Yesterday at 16:40</small></div></div>
            <div class="activity-item"><span class="activity-avatar avatar-coral">M</span><div><strong>Mali joined the project</strong><small>18 Aug at 09:15</small></div></div>
        </div>
    </section>
</div>
