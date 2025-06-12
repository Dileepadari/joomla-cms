<template>
  <div class="workflow-graph-container container-fluid vh-100 d-flex flex-column">
    <div class="workflow-graph-menu-bar row border-bottom shadow-sm py-3 px-4">
      <WorkflowToolbar />
    </div>
    <div class="workflow-graph-inner-container row flex-grow-1">
      <!-- Workflow graph canvas goes here -->
    </div>
  </div>
</template>

<script>
import WorkflowToolbar from './toolbar/toolbar.vue'

export default {
  name: 'WorkflowGraphApp',
  components: {
    WorkflowToolbar
  },
  data() {
    return {
      // The full height of the app in px
      fullHeight: '',
    }
  }
}
</script>
