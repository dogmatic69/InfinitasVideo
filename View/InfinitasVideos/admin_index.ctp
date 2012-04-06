<?php
    /**
     * Infinitas Videos admin index
     *
     * this is the page for admins to view all the videos on the site.
     *
     * Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     *
     * Licensed under The MIT License
     * Redistributions of files must retain the above copyright notice.
     *
     * @filesource
     * @copyright     Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     * @link          http://infinitas-cms.org
     * @package       Videos
     * @subpackage    Videos.View.posts.admin_index
     * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
     */

    echo $this->Form->create(null, array('action' => 'mass'));
        $massActions = $this->Infinitas->massActionButtons(
            array(
                'add',
                'edit',
                'copy',
                'delete'
            )
        );
	echo $this->Infinitas->adminIndexHead($filterOptions, $massActions);
?>
<div class="table">
    <table class="listing" cellpadding="0" cellspacing="0">
        <?php
            echo $this->Infinitas->adminTableHeader(
                array(
                    $this->Form->checkbox('all') => array(
                        'class' => 'first',
                        'style' => 'width:25px;'
                    ),
                    $this->Paginator->sort('name'),
                    __d('videos', 'Embed') => array(
                        'style' => 'width:130px;'
                    ),
					__d('videos', 'Link'),
					__d('videos', 'Image'),
                    $this->Paginator->sort('modified'),
                )
            );

            foreach($infinitasVideos as $infinitasVideo) { ?>
				<tr class="<?php echo $this->Infinitas->rowClass(); ?>">
					<td><?php echo $this->Infinitas->massActionCheckBox($infinitasVideo); ?>&nbsp;</td>
					<td><?php echo $this->Html->adminQuickLink($infinitasVideo['InfinitasVideo']); ?>&nbsp;</td>
					<td><?php echo sprintf('module:Videos.video#%s=100x100', $infinitasVideo['InfinitasVideo']['slug']); ?>&nbsp;</td>
					<td><?php echo $infinitasVideo['InfinitasVideo']['url']; ?>&nbsp;</td>
					<td><?php echo $infinitasVideo['InfinitasVideo']['preview']; ?>&nbsp;</td>
					<td><?php echo CakeTime::niceShort($infinitasVideo['InfinitasVideo']['modified']);?>&nbsp;</td>
				</tr> <?php
            }
        ?>
    </table>
    <?php echo $this->Form->end(); ?>
</div>
<?php echo $this->element('pagination/admin/navigation'); ?>