<?php use_helper('Date') ?>
<?php use_helper('Thumb') ?>
<div class="part">
  <h1>
    Derniers articles
    <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($asso->getLogin(), 0x04)): ?>
      <span class="titleaction"><i class="icon-plus icon-white"></i> <a href="<?php echo url_for('article_new', $asso) ?>">Ajouter un article</a></span>
    <?php endif ?>
  </h1>
  <div id="articles">
    <?php if($articles->count() > 0): ?>
      <div id="article_list">
        <?php foreach($articles as $article) : ?>
          <div class="article">
            <h2 style="background: <?php echo $article->getPole()->getCouleur() ?>"><?php echo $article->getName() ?>
              <span class="sub">
                <?php echo format_date($article->getCreatedAt(), 'P', 'fr'); ?>
                <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($article->getAsso()->getLogin(), 0x04)): ?>
                  <i class="icon-edit icon-white"></i> <a href="<?php echo url_for('article/edit?id=' . $article->getId()) ?>">Éditer</a>
                <?php endif ?>
              </span>
            </h2>
            <?php if($article->getImage()): ?>
              <?php echo showThumb($article->getImage(), 'articles', array('width'=>250, 'height'=>150, 'class' => 'affiche'), 'scale') ?><br />
            <?php endif; ?>
            <p>
              <?php if($article->getSummary()): ?>
                <?php echo nl2br($article->getSummary()) ?> <a href="<?php echo url_for('article/show?id='.$article->getId()) ?>">En savoir plus...</a>
              <?php else: ?>
                <?php echo nl2br($article->getText(ESC_XSSSAFE)) ?>
              <?php endif; ?>
            </p>
            <br style="clear: both;" />
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      Cette association n'a pas encore publié d'article.
    <?php endif ?>
  </div>
</div>
