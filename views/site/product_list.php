<?php
    use yii\helpers\Html;
?>
<a class="btn btn-primary" href="<?=Yii::$app->urlManager->createUrl(["site/add-product"])?>">Add new prodact</a >
<br/>

<table class='table filtered-table' data-toggle="table" data-pagination="true" data-search="true"
       data-page-size="25">    <thead>
    <tr>
        <th data-sortable="true" data-field="id" scope="col">id</th>
        <th data-sortable="true" data-field="name" scope="col">Name</th>
        <th data-sortable="true" data-field="price" scope="col">Price &#8381;</th>
        <th data-sortable="true" data-field="quantity" scope="col">Available quantity</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($product_list as $product): ; ?>
        <tr>
            <td scope="row"><?= Html::encode($product->id) ?></td>
            <td><?= Html::encode($product->name) ?></td>
            <td><?= Html::encode($product->price) ?> &#8381;</td>
            <td> <?= Html::encode($product->available_quantity) ?></td>
            <td>
                <a class="btn btn-danger" href="<?=Yii::$app->urlManager->createUrl(["site/delete-product"])?>&id=<?=$product->id?>"><i class="glyphicon glyphicon-trash"></i></a>
                <a class="btn btn-primary" href="<?=Yii::$app->urlManager->createUrl(["site/edit-product"])?>&id=<?=$product->id?>"><i class="glyphicon glyphicon-pencil"></i></a>
            </td>
        </tr>
    <?php endforeach ?>


    </tbody>
</table>


