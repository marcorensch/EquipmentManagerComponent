<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_equipmentmanager
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;

?>

<li>
    <div>
        <h2 class="uk-h2"><?php echo $package->title; ?></h2>
        <p><?php echo $package->description; ?></p>
        <?php echo '<pre>' . var_export($package, true) . '</pre>'; ?>
    </div>

</li>