<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_workflow
 *
 * @copyright   (C) 2025 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       _DEPLOY_VERSION_
 */

namespace Joomla\Component\Workflow\Administrator\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Model class for Graphical View of the workflow
 *
 * @since  _DEPLOY_VERSION_
 */
class GraphModel extends AdminModel
{
    /**
     * Auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @return  void
     *
     * @since  _DEPLOY_VERSION_
     */
    public function populateState()
    {
        parent::populateState();

        $app       = Factory::getApplication();
        $context   = $this->option . '.' . $this->name;
        $extension = $app->getUserStateFromRequest($context . '.filter.extension', 'extension', null, 'cmd');

        $this->setState('filter.extension', $extension);
    }

    /**
     * Method to get the name of the model.
     *
     * @return  string  The name of the model.
     *
     * @since   _DEPLOY_VERSION_
     */
    public function getName()
    {
        return 'workflow'; // TODO: change it to to handdle dynamically
    }


    /**
     * Abstract method for getting the form from the model.
     *
     * @param   array    $data      Data for the form.
     * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
     *
     * @return  Form|boolean A Form object on success, false on failure
     *
     * @since   _DEPLOY_VERSION_
     */
    public function getForm($data = [], $loadData = true)
    {
        // Load the form.
        return false;
    }

    /**
     * Method to get a table object, load it if necessary.
     *
     * @param   string  $name    The table name. Optional.
     * @param   string  $prefix  A prefix for the table class name. Optional.
     * @param   array   $options An optional associative array of configuration settings.
     *
     * @return  \Joomla\CMS\Table\Table|boolean  A Table object or false on failure
     *
     * @since   _DEPLOY_VERSION_
     */
    public function getTable($name = '', $prefix = '', $options = [])
    {
        return parent::getTable($name, $prefix, $options); // TODO: Change the logic
    }
}
