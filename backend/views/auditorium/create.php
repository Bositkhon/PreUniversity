<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Auditorium */

$this->title = Yii::t('common', 'Create Auditorium');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Auditoria'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auditorium-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
