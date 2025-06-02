
<v-admin-form-state
    :form-data="values"
    {{ $attributes }}
> </v-admin-form-state>

@pushOnce('scripts')
<script type="text/x-template" id="v-admin-form-state-template">
    <div style="display: none;"></div> <!-- Empty template (no visual) -->
</script>

<script type="module">
    app.component('v-admin-form-state', {
        template: '#v-admin-form-state-template',
        props: {
            formData: {
                type: Object,
                required: true
            },
            trackBy: {
                type: String,
                default: 'a[href*="?channel"], a[href*="?locale"]'
            },
        },
        data() {
            return {
                originalFormData: null,
                isFormDirty: false,
            };
        },
        watch: {
            formData: {
                handler(newVal) {
                    this.$formManager.setFormData(this.formData);
                    const formNewData = this.$formManager.getFormData();
                    
                    this.markDirty(formNewData);
                },
                deep: true
            }
        },
        mounted() {
            this.originalFormData = this.$formManager.getFormData();

            this.$emitter.on('change-form-state', (formNewData) => {
                this.markDirty(formNewData);
            });

            document.querySelectorAll(this.trackBy).forEach(link => {
                link.addEventListener('click', this.handleLinkClick);
            });

            // Todo: need to future implement a way to handle beforeunload event
            // window.addEventListener('beforeunload', this.handleBeforeUnload);
        },
        beforeUnmount() {
            document.querySelectorAll(this.trackBy).forEach(link => {
                link.removeEventListener('click', this.handleLinkClick);
            });

            // Todo: need to future implement a way to handle beforeunload event
            // window.removeEventListener('beforeunload', this.handleBeforeUnload);
        },
        methods: {
            markDirty(formData) {
                this.isFormDirty = JSON.stringify(formData) !== JSON.stringify(this.originalFormData);
                console.log('Form dirty state:', this.isFormDirty);
            },
            handleBeforeUnload(event) {
                if (this.isFormDirty) {
                    event.preventDefault();
                    event.returnValue = ''; // Required for some browsers
                }
            },
            handleLinkClick(event) {
                if (this.isFormDirty) {
                    const confirmLeave = confirm('You have unsaved changes. Do you want to leave without saving?');
                    if (!confirmLeave) {
                        event.preventDefault();
                    }
                }
            }
        }
    });
</script>
@endPushOnce
