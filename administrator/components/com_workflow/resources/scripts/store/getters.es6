// Sometimes we may need to compute derived state based on store state,
/**
 * Get the currently selected stage
 * @param state
 * @returns {*}
 */
export function getSelectedStage(state) {
	return state.workflow.stages.find((stage) => stage.id === state.workflow.selectedStageId);
}

/**
 * Get the currently selected transition
 * @param state
 * @returns {*}
 */
export function getSelectedTransition(state) {
	return state.workflow.transitions.find((transition) => transition.id === state.workflow.selectedTransitionId);
}

/**
 * Whether or not all items
 * @param state
 * @param getters
 * @returns Array
 */
export const getSelectedWorkflowItems = (state, getters) => [
	...getters.getSelectedStage.items,
	...getters.getSelectedTransition.items,
];
