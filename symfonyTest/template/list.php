<!-- 主页的实现-->
<?php $title = 'List of Posts'?>
<?php ob_start() ?> <!-- 放入缓存中能够使下面的页面不立即显示 -->
    <h1>List of Posts</h1>
    <ul>
        <?php foreach ($posts as $post): ?>
        <li>
            <a href="/show.php?id=<?= $post['Car_num'] ?>">
                <?= $post['Car_logo'] ?>
            </a>
        </li>
        <?php endforeach ?>
    </ul>
<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?> <!--以layout.php为模板 -->