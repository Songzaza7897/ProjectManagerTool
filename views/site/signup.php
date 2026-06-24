<?php

/** @var yii\web\View $this */
/** @var app\models\SignupForm $model */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Create account';
$this->params['authPage'] = true;
?>
<main class="auth-shell auth-shell-signup">
    <section class="auth-visual signup-visual" aria-label="PM Tool benefits">
        <a class="auth-brand" href="<?= Url::to(['/site/index']) ?>">
            <span class="brand-mark"><i data-lucide="panels-top-left"></i></span>
            <span>PM Tool</span>
        </a>

        <div class="auth-visual-content">
            <span class="eyebrow">Start organized</span>
            <h1>Give every project a clear path to done.</h1>
            <p>Create a shared place for plans, priorities, conversations, and progress.</p>

            <ul class="auth-benefits">
                <li><i data-lucide="check"></i><span><strong>Visual project boards</strong>See the current state of every task.</span></li>
                <li><i data-lucide="check"></i><span><strong>Useful reporting</strong>Understand workload and momentum.</span></li>
                <li><i data-lucide="check"></i><span><strong>One source of truth</strong>Keep the whole team in context.</span></li>
            </ul>
        </div>

        <p class="auth-footnote">Your account is stored locally for this prototype.</p>
    </section>

    <section class="auth-form-panel signup-panel">
        <div class="auth-form-wrap">
            <div class="auth-heading">
                <span class="mobile-auth-brand"><i data-lucide="panels-top-left"></i> PM Tool</span>
                <h2>Create your account</h2>
                <p>Set up your workspace access in a minute.</p>
            </div>

            <?php $form = ActiveForm::begin([
                'id' => 'signup-form',
                'options' => ['class' => 'auth-form'],
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'inputOptions' => ['class' => 'form-control'],
                    'errorOptions' => ['class' => 'invalid-feedback d-block'],
                ],
            ]); ?>

            <div class="row g-3">
                <div class="col-sm-6">
                    <?= $form->field($model, 'fullName')->textInput([
                        'autofocus' => true,
                        'autocomplete' => 'name',
                        'placeholder' => 'Your name',
                    ]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'username')->textInput([
                        'autocomplete' => 'username',
                        'placeholder' => 'Choose a username',
                    ]) ?>
                </div>
            </div>

            <?= $form->field($model, 'email')->textInput([
                'type' => 'email',
                'autocomplete' => 'email',
                'placeholder' => 'name@company.com',
            ]) ?>

            <div class="row g-3">
                <div class="col-sm-6">
                    <?= $form->field($model, 'password')->passwordInput([
                        'autocomplete' => 'new-password',
                        'placeholder' => 'At least 6 characters',
                    ]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'passwordConfirm')->passwordInput([
                        'autocomplete' => 'new-password',
                        'placeholder' => 'Repeat password',
                    ]) ?>
                </div>
            </div>

            <?= $form->field($model, 'agree', [
                'template' => "<div class=\"form-check\">{input} {label}</div>\n{error}",
            ])->checkbox([
                'class' => 'form-check-input',
                'labelOptions' => ['class' => 'form-check-label'],
                'uncheck' => 0,
            ]) ?>

            <?= Html::submitButton('<span>Create account</span><i data-lucide="arrow-right"></i>', [
                'class' => 'btn btn-dark btn-lg auth-submit',
            ]) ?>

            <?php ActiveForm::end(); ?>

            <p class="auth-switch">
                Already have an account? <a href="<?= Url::to(['/site/login']) ?>">Sign in</a>
            </p>
        </div>
    </section>
</main>
