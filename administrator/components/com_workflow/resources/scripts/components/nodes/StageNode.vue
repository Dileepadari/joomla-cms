<template>
  <div
    class="stage-node card p-3 border shadow-sm position-relative"
    :class="{ 'shadow': isSelected, 'hover-shadow': !isSelected }"
    :style="stageStyle"
  >
    <!-- VueFlow Handles -->
    <Handle type="target" :position="Position.Top" class="w-25 h-25 bg-primary position-absolute top-0 start-50 translate-middle-x" />
    <Handle type="source" :position="Position.Bottom" class="w-25 h-25 bg-primary position-absolute bottom-0 start-50 translate-middle-x" />
    <Handle type="target" :position="Position.Left" class="w-25 h-25 bg-primary position-absolute top-50 start-0 translate-middle-y" />
    <Handle type="source" :position="Position.Right" class="w-25 h-25 bg-primary position-absolute top-50 end-0 translate-middle-y" />

    <!-- Color Indicator -->
    <span
      class="position-absolute top-0 end-0 mt-2 me-2 rounded-circle d-block"
      style="width: 10px; height: 10px;"
      :style="badgeStyle"
    ></span>
  </div>
</template>

<script>
import { Handle, Position } from '@vue-flow/core'

export default {
  name: 'StageNode',
  components: {
    Handle,
  },
  props: {
    stage: {
      type: Object,
      required: true
    },
    data: {
      type: Object,
      required: true
    },
    isSelected: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    Position() {
      return Position;
    },
    stageStyle() {
      return {
        borderColor: '#6366F1',
        borderWidth: this.isSelected ? '3px' : '2px'
      };
    },
    badgeStyle() {
      return {
        backgroundColor: '#6366F1'
      };
    }
  }
}
</script>
