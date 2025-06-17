<template>
  <div class="container-fluid h-100" role="region" aria-label="Workflow Canvas">
    <div class="row h-100">
      <div class="col-12">
        <!-- Replace VueFlow with a Bootstrap card list for stages and transitions -->
        <div class="card mb-3">
          <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <span>Workflow Stages</span>
            <button class="btn btn-success btn-sm" @click="addStage">Add Stage</button>
          </div>
          <ul class="list-group list-group-flush">
            <li v-for="stage in stages" :key="stage.id" class="list-group-item d-flex justify-content-between align-items-center">
              <span>{{ stage.title }}</span>
              <button class="btn btn-danger btn-sm" @click="removeStage(stage.id)">Remove</button>
            </li>
          </ul>
        </div>
        <div class="card">
          <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <span>Workflow Transitions</span>
            <button class="btn btn-success btn-sm" @click="addTransition">Add Transition</button>
          </div>
          <ul class="list-group list-group-flush">
            <li v-for="transition in transitions" :key="transition.id" class="list-group-item d-flex justify-content-between align-items-center">
              <span>{{ transition.title }}</span>
              <button class="btn btn-danger btn-sm" @click="removeTransition(transition.id)">Remove</button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'WorkflowCanvas',
  computed: {
    stages() {
      return this.$store.state.workflow.stages || [];
    },
    transitions() {
      return this.$store.state.workflow.transitions || [];
    }
  },
  methods: {
    addStage() {
      // Placeholder: implement add stage logic
      this.$store.commit('addStage', { id: Date.now(), title: 'New Stage' });
    },
    removeStage(id) {
      this.$store.commit('removeStage', id);
    },
    addTransition() {
      // Placeholder: implement add transition logic
      this.$store.commit('addTransition', { id: Date.now(), title: 'New Transition' });
    },
    removeTransition(id) {
      this.$store.commit('removeTransition', id);
    }
  }
}
</script>
