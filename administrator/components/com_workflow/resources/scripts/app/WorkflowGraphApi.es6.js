import Event from './Event.es6.js';

class WorkflowGraphApi {
  constructor() {
    const options = Joomla.getOptions('com_workflow', {});
    if (!options.apiBaseUrl) {
      throw new TypeError('Workflow API baseUrl is not defined');
    }
    this.baseUrl = options.apiBaseUrl;

    if (!options.extension) {
      throw new TypeError('Workflow API extension is not defined');
    }
    this.extension = options.extension;
    this.csrfToken = Joomla.getOptions('csrf.token');
    if (!this.csrfToken) {
      console.warn('CSRF token not found');
    }
  }

  /**
   * Generic request method with better error handling
   */
  async makeRequest(url, options = {}) {
    const defaultOptions = {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
      },
    };

    // add csrf for all request as data [token] = 1
    if (this.csrfToken) {
      if (!options.data) {
        options.data = {};
      }
      options.data[this.csrfToken] = '1';
    }

    const config = { ...defaultOptions, ...options };

    if (options.data instanceof FormData) {
      delete config.headers['Content-Type'];
    }
    return new Promise((resolve, reject) => {
      Joomla.request({
        url: `${this.baseUrl}${url}&extension=${this.extension}`,
        ...config,
        onSuccess: (response) => {
          resolve(response);
        },
        onError: (xhr) => {
          let message = 'Network error';
          try {
            const errorData = JSON.parse(xhr.responseText);
            message = errorData.message || message;
          } catch (e) {
            message = xhr.statusText || message;
          }
          reject(new Error(message));
        }
      });
    });
  }

  async getWorkflow(id) {
    try {
      const response = await this.makeRequest(`&task=graph.getWorkflow&id=${id}&format=json`);
      const data = typeof response === 'string' ? JSON.parse(response) : response;

      if (data.success === false) {
        WorkflowGraph.Event.fire('onWorkflowError', { error: data.message || 'Failed to load workflow' });
        return;
      }

      return data.data || data;
    } catch (error) {
      WorkflowGraph.Event.fire('onWorkflowError', { error: error.message });
      throw error;
    }
  }

  async getStages(workflowId) {
    try {
      const response = await this.makeRequest(`&task=graph.getStages&workflow_id=${workflowId}&format=json`);
      const data = typeof response === 'string' ? JSON.parse(response) : response;

      if (data.success === false) {
        WorkflowGraph.Event.fire('onStagesError', { error: data.message || 'Failed to load stages' });
        return;
      }

      return data.data || data;
    } catch (error) {
      WorkflowGraph.Event.fire('onStagesError', { error: error.message });
      throw error;
    }
  }

  async getTransitions(workflowId) {
    try {
      const response = await this.makeRequest(`&task=graph.getTransitions&workflow_id=${workflowId}&format=json`);
      const data = typeof response === 'string' ? JSON.parse(response) : response;

      if (data.success === false) {
        WorkflowGraph.Event.fire('onTransitionsError', { error: data.message || 'Failed to load transitions' });
        return;
      }

      return data.data || data;
    } catch (error) {
      WorkflowGraph.Event.fire('onTransitionsError', { error: error.message });
      throw error;
    }
  }

  async deleteStage(id, workflowId) {
    try {
      const formData = new FormData();
      formData.append('cid[]', id);
      formData.append('workflow_id', workflowId);

      if (this.csrfToken) {
        formData.append(this.csrfToken, '1');
      }

      const response = await this.makeRequest(`&task=stages.trash&format=raw`, {
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false
      });

      if (response.success === false) {
        WorkflowGraph.Event.fire('onStageError', { error: response.message || 'Failed to delete stage' });
        return false;
      }

      return true;
    } catch (error) {
      WorkflowGraph.Event.fire('onStageError', { error: error.message });
      throw error;
    }
  }

  async deleteTransition(id, workflowId) {
    try {
      const formData = new FormData();
      formData.append('cid[]', id);
      formData.append('workflow_id', workflowId);

      if (this.csrfToken) {
        formData.append(this.csrfToken, '1');
      }

      await this.makeRequest(`&task=transitions.trash&format=raw`, {
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false
      });

      WorkflowGraph.Event.fire('onTransitionDeleted', { id });
      return true;
    } catch (error) {
      WorkflowGraph.Event.fire('onTransitionError', { error: error.message });
      throw error;
    }
  }

  // async updateStagePosition(stageId, position) {
  //   try {
  //     const stage = { id: stageId, position: position };
  //     return await this.saveStage(stage);
  //   } catch (error) {
  //     WorkflowGraph.WorkflowGraph.Event.fire('onStageError', { error: error.message });
  //     throw error;
  //   }
  // }
}

export default new WorkflowGraphApi();
