import { reactive, readonly } from 'vue';

export default {
  install(app) {
    // Private reactive state (like Redux store state)
    // Use reactive object with a single `formData` ref
    const state = reactive({
      formData: {}
    });

    // Actions to modify state (like Redux actions)
    const actions = {
      initializeFormData(initialData = {}) {
        // Replace whole formData object to trigger reactivity once
        state.formData = { ...initialData };
      },
      updateField(key, value) {
        // Update single field reactively
        state.formData[key] = value;
      },
      resetFormData() {
        // Reset formData to empty object
        state.formData = {};
      },
      setFormData(newData = {}) {
        // Replace whole formData object for better performance
        state.formData = { ...newData };
      },
      getFormData() {
        // Return shallow copy to prevent external mutations
        return { ...state.formData };
      }
    };

    // Expose readonly reactive state + actions globally
    app.config.globalProperties.$formManager = {
      state: readonly(state),
      ...actions
    };
  }
};
