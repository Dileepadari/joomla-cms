<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_workflow
 *
 * @copyright   (C) 2025 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Workflow\Administrator\Controller;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * The workflow Graphical View controller
 *
 * @since DEPLOY_VERSION
 */
class GraphController extends AdminController
{
    /**
     * The workflow in where the stage belongs to
     *
     * @var    integer
     * @since  DEPLOY_VERSION
     */
    protected $workflowId;

    /**
     * The extension
     *
     * @var    string
     * @since  DEPLOY_VERSION
     */
    protected $extension;

    /**
     * The section of the current extension
     *
     * @var    string
     * @since  DEPLOY_VERSION
     */
    protected $section;

    /**
     * The prefix to use with controller messages.
     *
     * @var    string
     * @since  DEPLOY_VERSION
     */
    protected $text_prefix = 'COM_WORKFLOW_GRAPH';

    /**
     * Constructor.
     *
     * @param   array                 $config   An optional associative array of configuration settings.
     * @param   ?MVCFactoryInterface  $factory  The factory.
     * @param   ?CMSApplication       $app      The Application for the dispatcher
     * @param   ?Input                $input    Input
     *
     * @since   DEPLOY_VERSION
     * @throws  \InvalidArgumentException when no extension or workflow id is set
     */
    public function __construct(array $config = [], ?MVCFactoryInterface $factory = null, $app = null, $input = null)
    {
        parent::__construct($config, $factory, $app, $input);

        // If workflow id is not set try to get it from input or throw an exception
        if (empty($this->workflowId)) {
            $this->workflowId = $this->input->getInt('workflow_id');

            if (empty($this->workflowId)) {
                throw new \InvalidArgumentException(Text::_('COM_WORKFLOW_ERROR_WORKFLOW_ID_NOT_SET'));
            }
        }

        // If extension is not set try to get it from input or throw an exception
        if (empty($this->extension)) {
            $extension = $this->input->getCmd('extension');

            $parts = explode('.', $extension);

            $this->extension = array_shift($parts);

            if (!empty($parts)) {
                $this->section = array_shift($parts);
            }

            if (empty($this->extension)) {
                throw new \InvalidArgumentException(Text::_('COM_WORKFLOW_ERROR_EXTENSION_NOT_SET'));
            }
        }
    }

    /**
     * Proxy for getModel
     *
     * @param   string  $name    The model name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  The array of possible config values. Optional.
     *
     * @return  \Joomla\CMS\MVC\Model\BaseDatabaseModel  The model.
     *
     * @since  DEPLOY_VERSION
     */
    public function getModel($name = 'Graph', $prefix = 'Administrator', $config = ['ignore_request' => true])
    {
        return parent::getModel($name, $prefix, $config);
    }


    /**
     * Displays the graphical view of the workflow.
     *
     * This method sets up the view for the workflow graph and assigns the corresponding model to it.
     * It then delegates the display logic to the parent class's `display` method.
     *
     * @param   boolean  $cachable   If true, the view output will be cached. Default is false.
     * @param   array    $urlparams  An associative array of safe URL parameters and their variable types.
     *
     * @return  mixed    The rendered view or parent display output.
     *
     * @since   DEPLOY_VERSION
     */
    public function display($cachable = false, $urlparams = array())
    {
        $view = $this->getView('graph', 'html');
        $view->setModel($this->getModel('Graph'), true);

        return parent::display($cachable, $urlparams);
    }

}
