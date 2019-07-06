<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Teachers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('common', 'Create Teacher'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'firstname',
            'lastname',
            'middlename',
            //'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {assign} {update} {delete}',
                'buttons' => [
                    'assign' => function ($url, $model, $key){
                        return Html::a('<span class="glyphicon glyphicon-plus"></span>', '#', [
                            'class' => 'assign-group-btn',
                            'data' => [
                                'url' => Url::to(['/teacher-group/create']),
                                'id' => $key,
                            ]
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>

</div>

<?php 
Modal::begin([
    'id' => 'assign-group-modal',
    'header' => '',
    'size' => 'modal-md'
]);
Modal::end();

$js = <<<JS
    $('.assign-group-btn').on('click', function(){
        let modal = $('#assign-group-modal');
        modal.modal('toggle', $(this));
        modal.find('.modal-body').load($(this).data('url'));
    });

    $('#assign-group-modal').on('shown.bs.modal', function (event) {
        console.log(event);
        var modal = $(this);
        let id = $(event.relatedTarget).data('id');
        modal.find('.modal-body input#teachergroup-teacher_id').val(id);
    });
    
JS;

$this->registerJs($js);

?>
