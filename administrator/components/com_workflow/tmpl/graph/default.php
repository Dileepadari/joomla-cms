<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_workflow
 *
 * @copyright   (C) 2025 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       DEPLOY_VERSION
 */

\defined('_JEXEC') or die;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->getDocument()->getWebAssetManager();
$wa->useScript('keepalive')->useScript('com_workflow.workflowgraph');

// Enqueue Vue Flow and related CSS assets
$wa->registerAndUseStyle('vueflow-core', 'https://unpkg.com/@vue-flow/core/dist/style.css');
$wa->registerAndUseStyle('vueflow-theme', 'https://unpkg.com/@vue-flow/core/dist/theme-default.css');
$wa->registerAndUseStyle('vueflow-controls', 'https://unpkg.com/@vue-flow/controls/dist/style.css');
$wa->registerAndUseStyle('vueflow-minimap', 'https://unpkg.com/@vue-flow/minimap/dist/style.css');

// Get the URI for the JavaScript module
$script = $wa->getAsset('script', name: 'com_workflow.workflowgraph')->getUri(true);
?>

<div id="workflow-graph-root"></div>
<script type="module" src="<?php echo $script ?>"></script>
