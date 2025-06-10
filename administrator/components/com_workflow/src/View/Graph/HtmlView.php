<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_workflow
 *
 * @copyright   (C) 2025 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Workflow\Administrator\View\Graph;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\Component\Workflow\Administrator\Model\GraphModel;
use Joomla\Component\Workflow\Administrator\Helper\GraphHelper;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Basic view class to display the entire workflow graph
 *
 * @since  DEPLOY_VERSION
 */
class HtmlView extends BaseHtmlView
{
    /**
     * Display the view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  void
     *
     * @since  4.0.0
     */

    protected $state;
    protected $stages = [];
    protected $transitions = [];
    protected $workflow;

    public function display($tpl = null)
    {
        /** @var GraphModel $model */
        $model = $this->getModel();

        $workflowId = Factory::getApplication()->input->getInt('workflow_id');
        // $this->stages = $model->getStages($workflowId);
        // $this->transitions = $model->getTransitions($workflowId);
        // $this->workflow = $model->getTable()->load($workflowId);

        // Error handling
        if ($errors = $model->getErrors()) {
            throw new \Exception(implode("\n", $errors), 500);
        }

        $this->addToolbar();
        parent::display($tpl);
    }


    protected function addToolbar()
    {
        ToolbarHelper::title(Text::_('COM_WORKFLOW_WORKFLOWS_EDIT'), 'diagram');
//        ToolbarHelper::save('workflow.save');
//        ToolbarHelper::cancel('workflow.cancel', 'JTOOLBAR_CLOSE');
    }

    public function getStages()
    {
        return $this->stages;
    }

    public function getTransitions()
    {
        return $this->transitions;
    }

    public function getWorkflow()
    {
        return $this->workflow;
    }
}
