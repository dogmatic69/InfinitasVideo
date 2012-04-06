<?php
    /**
     * Blog Comments admin edit posts
     *
     * this is the page for admins to edit blog posts
     *
     * Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     *
     * Licensed under The MIT License
     * Redistributions of files must retain the above copyright notice.
     *
     * @filesource
     * @copyright     Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     * @link          http://infinitas-cms.org
     * @package       blog
     * @subpackage    blog.views.posts.admin_edit
     * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
     */
?>
<div class="dashboard"> <?php
    echo $this->Form->create(null, array('type' => 'file'));
        echo $this->Infinitas->adminEditHead();

		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('url');
		echo $this->Form->input('preview', array('type' => 'file'));
    echo $this->Form->end(); ?>
</div>