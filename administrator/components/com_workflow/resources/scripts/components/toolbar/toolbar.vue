<template>
  <div class="row gx-3 gy-2 align-items-center flex-wrap">
    <div class="col-md-6 d-flex flex-column">
      <h1 class="h4 mb-2">General Publishing Workflow</h1>
      <div class="d-flex align-items-center flex-wrap">
        <span class="badge bg-warning text-dark me-2 mb-1">Disabled</span>
        <span v-if="workflowStore.lastSaved" class="text-muted small mb-1">
          Last saved: {{ formatDate(workflowStore.lastSaved) }}
        </span>
      </div>
    </div>
    <div class="col-md-6 d-flex justify-content-md-end justify-content-start align-items-center gap-2 flex-wrap">
      <button class="btn btn-outline-secondary" @click="undoAction">
        <span aria-hidden="true" class="icon-undo"></span> Undo
      </button>
      <button class="btn btn-outline-secondary" @click="redoAction">
        <span aria-hidden="true" class="icon-redo"></span> Redo
      </button>
      <button class="btn btn-outline-secondary" @click="openStages">
        <span aria-hidden="true" class="icon-list-view"></span> Stages
      </button>
      <button class="btn btn-outline-secondary" @click="showShortcuts">
        <span aria-hidden="true" class="fa fa-keyboard"></span> Shortcuts
      </button>
      <button class="btn btn-outline-secondary">
        <span aria-hidden="true" class="icon-eye"></span> Preview
      </button>
      <button class="btn btn-primary" @click="saveWorkflow" :disabled="!workflowStore.canSave">
        <span aria-hidden="true" class="icon-save"></span> Save Workflow
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'WorkflowToolbar',
  methods: {
    formatDate(date) {
      return new Date(date).toLocaleString();
    },
    undoAction() {
      // implement undo logic
      console.log('Undo action triggered');
    },
    redoAction() {
      // implement redo logic
      console.log('Redo action triggered');
    },
    openStages() {
      // open stages panel/modal
      console.log('Open stages clicked');
    },
    showShortcuts() {
      // display keyboard shortcuts modal
      console.log('Show shortcuts clicked');
    },
    saveWorkflow() {
      // implement save logic
      console.log('Save workflow clicked');
    }
  },
  computed: {
    workflowStore() {
      // Have to replace this mock with actual Pinia store if
      return {
        lastSaved: Date.now(),
        canSave: true
      };
    }
  }
};
</script>
