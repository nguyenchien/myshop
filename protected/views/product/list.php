<?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemsTagName'=>'ul',
        'itemsCssClass'=>'product-list list',
        'itemView'=>'item',
        'summaryText'=>''
    ));