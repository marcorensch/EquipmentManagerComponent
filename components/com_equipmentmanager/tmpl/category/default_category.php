<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_equipmentmanager
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use NXD\Component\Equipmentmanager\Site\Helper\RouteHelper;

?>
<div class="uk-margin-large">
    <h2 class="uk-h2"><?php echo $category->title;?></h2>
    <hr>
    <?php if($category->equipment):?>
        <?php include 'default_equipment.php' ?>
    <?php endif;?>
</div>

