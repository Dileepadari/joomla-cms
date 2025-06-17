<template>
  <div class="workflow-graph-container container-fluid vh-100 d-flex flex-row">
    <div class="col-12 p-0">
      <div class="workflow-graph-title-bar border-bottom shadow-sm py-3 px-4">
        <WorkflowTitlebar />
      </div>
      <div id="canvas-pane" class="flex-grow-1 p-0 overflow-hidden">
        <div id="workflow-graph" class="h-100 w-100 position-relative">
          <div class="flex flex-1 overflow-hidden">
            <!-- Canvas Area -->
            <main
              class="flex-1 relative"
              id="main-canvas"
              role="main"
              aria-label="Workflow Canvas"
            >
              <WorkflowCanvas />
            </main>

<!--            &lt;!&ndash; Right Sidebar &ndash;&gt;-->
<!--            <Transition name="slide">-->
<!--              <aside-->
<!--                v-if="showEditPanel"-->
<!--                class="w-96 border-l border-gray-200 bg-white"-->
<!--                role="complementary"-->
<!--                aria-label="Edit Panel"-->
<!--              >-->
<!--                <WorkflowEditPanel v-if="$store.state.workflow.isEditingWorkflow" />-->
<!--                <StageEditPanel v-if="$store.state.workflow.isEditingStage" />-->
<!--                <TransitionEditPanel v-if="$store.state.workflow.isEditingTransition" />-->
<!--              </aside>-->
<!--            </Transition>-->

<!--            <Transition name="slide">-->
<!--              <aside-->
<!--                v-if="$store.state.workflow.showOverview"-->
<!--                class="w-80 border-l border-gray-200 bg-white"-->
<!--                role="complementary"-->
<!--                aria-label="Workflow Overview"-->
<!--              >-->
<!--                <WorkflowOverview />-->
<!--              </aside>-->
<!--            </Transition>-->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import WorkflowTitlebar from './titlebar/titlebar.vue';
import WorkflowCanvas from './canvas/WorkflowCanvas.vue';

export default {
  name: 'WorkflowGraphApp',
  components: {
    WorkflowTitlebar,
    WorkflowCanvas,
  },
  data() {
    return {
      // The full height of the app in px
      fullHeight: '',
    }
  }
}
</script>
