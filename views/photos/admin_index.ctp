<div class="photos index">
    <h2><?php echo $title_for_layout; ?></h2>

    <table cellpadding="0" cellspacing="0">
    <?php
        $tableHeaders =  $html->tableHeaders(array(
                                            __('Picture', true),
											__('URL', true),
                                            __('Embedding', true),                                          
                                            __('Actions', true),
                                            ));
        echo $tableHeaders;

        $rows = array();
        foreach ($photos as $photo) {
           	$actions = $html->link(__d('photon','Album', true), array('controller' => 'albums', 'action' => 'edit', $photo['Photo']['album_id'], '#album-images'));
			$actions .= ' ' . $layout->adminRowActions($photo['Photo']['id']);

            $rows[] = array(
                        $this->Html->image('photos/'.$photo['Photo']['small']),
                        '<a href="/img/photos/' . $photo['Photo']['large'] . '">/img/photos/' . $photo['Photo']['large'] . '</a>',
                        'Insert [Image:' . $photo['Photo']['id'] . '] into your node.',
                        $actions,
                      );
        }

        echo $html->tableCells($rows);
        echo $tableHeaders;
    ?>
    </table>
</div>

<div class="paging"><?php echo $paginator->numbers(); ?></div>
<div class="counter"><?php echo $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true))); ?></div>