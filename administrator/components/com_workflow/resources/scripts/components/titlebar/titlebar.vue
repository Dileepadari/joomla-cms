<template>
  <div class="workflow-graph-titlebar row align-items-center flex-wrap">
    <!-- Left section -->
    <div class="col-md-6 d-flex flex-column">
      <h1 class="h2 mb-2">{{ title }}</h1>
      <div class="d-flex align-items-center flex-wrap">
        <span
          class="badge me-2 mb-1"
          :class="published ? 'bg-success text-white' : 'bg-warning text-dark'"
        >
          {{ published ? 'Enabled' : 'Disabled' }}
        </span>
        <span class="me-2 mb-1">{{ stagesCount }} stages</span>
        <span class="me-2 mb-1">{{ transitionsCount }} transitions</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'WorkflowTitlebar',
  computed: {
    // Computed properties mapping state
    title() {
      return this.$store.state.workflow.title;
    },
    published() {
      return this.$store.state.workflow.published;
    },
    stagesCount() {
      return this.$store.state.workflow.stages.length;
    },
    transitionsCount() {
      return this.$store.state.workflow.transitions.length;
    },
    canSave() {
      return !!this.title && this.stagesCount > 0;
    }
  }
};
</script>
