<?php

use yii\helpers\Url;
?>
<li class="<?= isset($category['children']) ? 'dropdown' : '' ?>">
    <a href="<?= Url::to(['category/view', 'id' => $category['id']]) ?>" <?= isset($category['children']) ? "class='dropdown data-toggle='dropdown'" : '' ?>>
        <?= $category['title'] ?>
    </a>
    <? if (isset($category['children'])) : ?>
        <div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
            <div class="w3ls_vegetables">
                <ul>
                    <?= $this->getMenuHtml($category['children']) ?>
                </ul>
            </div>
        </div>
    <? endif; ?>
</li>