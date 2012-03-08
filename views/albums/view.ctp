<header>
    <hgroup>
        <h1><?php __d('photon', 'Album');?>: <?php echo $album['Album']['title']; ?></h1>
        <h3><?php echo $album['Album']['description']; ?></h3>
    </hgroup>
</header>
<?php echo $this->element('gallery'); ?>
<footer>
	<nav id="pagination"><?php echo $html->link(__d('photon','Back', true), '/gallery'); ?></nav>
</footer>