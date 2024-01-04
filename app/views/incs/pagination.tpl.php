<div class="pagination">
    <?php foreach($links as $link): ?>
      <?php if($link['type'] === 'link'): ?>
        <a href="<?= $link['link'] ?>" class='pagination__item<?= $link['active'] ? ' active' : '' ?>'><?= $link['number'] ?></a>
      <?php elseif ($link['type'] === 'fake'): ?>
        <span  class='pagination__item pagination__item--fake'>...</span>
      <?php endif; ?>
    <?php endforeach ?>
</div>