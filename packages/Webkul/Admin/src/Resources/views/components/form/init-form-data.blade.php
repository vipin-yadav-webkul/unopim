
<v-admin-init-form-data :form-data="values" :set-values="setValues" :additional-data='@json($additionalValues ?? [])' ></v-admin-init-form-data>

@pushOnce('scripts')
<script type="module">
    app.component('v-admin-init-form-data', {
        props: {
            formData: {
                type: Object,
                required: true
            },
            additionalData: {
                type: Object,
                required: true
            },
            setValues: {
                type: Function,
                required: true
            }
        },
        mounted() {
            this.setDefaultValues(this.additionalData);
            this.$formManager.initializeFormData(this.formData);
        },
        methods: {
            setDefaultValues(newValues) {
                this.setValues({
                ...this.formData,
                ...newValues
                });
            },
        }
    });
</script>
@endPushOnce
