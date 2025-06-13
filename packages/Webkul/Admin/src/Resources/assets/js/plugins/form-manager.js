import { reactive, readonly } from 'vue';

export default {
  install(app, options = {}) {
    const state = reactive({
      formData: {},
      ...options.initialState
    });

    const actions = {
      initializeFormData(initialData = {}) {
        state.formData = { ...initialData };
      },
      updateField(key, value) {
        state.formData[key] = value;
      },
      resetFormData() {
        state.formData = {};
      },
      setFormData(newData = {}) {
        state.formData = { ...newData };
      }
    };

    const getters = {
      getField(key) {
        return state.formData[key];
      },
      getFormData() {
        return { ...state.formData };
      }
    };

    const extensions = options.extend?.({ state, actions, getters }) || {};

    app.config.globalProperties.$formManager = {
      state: readonly(state),
      ...actions,
      ...getters,
      ...extensions
    };
  }
};
