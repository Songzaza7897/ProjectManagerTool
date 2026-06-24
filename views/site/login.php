<?php

/** @var yii\web\View $this */
/** @var app\models\LoginForm $model */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Login';
$this->params['authPage'] = true;
?>
<main class="auth-shell">
    <section class="auth-visual" aria-label="Project workspace preview">
        <a class="auth-brand" href="<?= Url::to(['/site/index']) ?>">
            <span class="brand-mark"><i data-lucide="panels-top-left"></i></span>
            <span>PM Tool</span>
        </a>

        <div class="auth-visual-content">
            <span class="eyebrow">One workspace. Clear progress.</span>
            <h1>Move projects forward with less friction.</h1>
            <p>Plan the work, keep your team aligned, and see what needs attention at a glance.</p>

            <div class="auth-preview" aria-hidden="true">
                <div class="preview-top">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="preview-body">
                    <div class="preview-nav"></div>
                    <div class="preview-board">
                        <div class="preview-column"><span></span><b></b><b></b></div>
                        <div class="preview-column"><span></span><b></b></div>
                        <div class="preview-column"><span></span><b></b><b></b></div>
                    </div>
                </div>
            </div>
        </div>

        <p class="auth-footnote">Built for focused teams and ambitious work.</p>
    </section>

    <section class="auth-form-panel">
        <div class="auth-form-wrap">
            <div class="auth-heading">
                <span class="mobile-auth-brand"><i data-lucide="panels-top-left"></i> PM Tool</span>
                <h2>Welcome back</h2>
                <p>Sign in to continue to your workspace.</p>
            </div>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'auth-form'],
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'inputOptions' => ['class' => 'form-control form-control-lg'],
                    'errorOptions' => ['class' => 'invalid-feedback d-block'],
                ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput([
                'autofocus' => true,
                'autocomplete' => 'username',
                'placeholder' => 'Enter your username',
            ]) ?>

            <div class="password-label-row">
                <label for="loginform-password">Password</label>
                <a href="#" title="Password recovery is not connected in this demo">Forgot password?</a>
            </div>
            <?= $form->field($model, 'password', [
                'template' => "{input}\n{error}",
            ])->passwordInput([
                'autocomplete' => 'current-password',
                'placeholder' => 'Enter your password',
            ]) ?>

            <?= $form->field($model, 'rememberMe', [
                'template' => "<div class=\"form-check\">{input} {label}</div>\n{error}",
            ])->checkbox([
                'class' => 'form-check-input',
                'labelOptions' => ['class' => 'form-check-label'],
                'uncheck' => 0,
            ]) ?>

            <?= Html::submitButton('<span>Sign in</span><i data-lucide="arrow-right"></i>', [
                'class' => 'btn btn-dark btn-lg auth-submit',
                'name' => 'login-button',
            ]) ?>

            <?php ActiveForm::end(); ?>

            <p class="auth-switch">
                New to PM Tool? <a href="<?= Url::to(['/site/signup']) ?>">Create an account</a>
            </p>
            <div class="demo-credentials">
                Demo access: <code>admin</code> / <code>admin</code>
            </div>
        </div>
    </section>
</main>
