<v-admin-form-state :form-data="values" />

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
            }
        },
        data() {
            return {
                originalFormData: JSON.parse(JSON.stringify(this.formData)),
                isFormDirty: false,
            };
        },
        watch: {
            formData: {
                handler(newVal) {
                    this.markDirty();
                },
                deep: true
            }
        },
        mounted() {
            this.$emitter.on('change-form-state', (formData) => {
                this.formData = formData;
                this.markDirty();
            });

            document.querySelectorAll('a[href*="?channel"], a[href*="?locale"]').forEach(link => {
                link.addEventListener('click', this.handleLinkClick);
            });

            // window.addEventListener('beforeunload', this.handleBeforeUnload);
        },
        beforeUnmount() {
            document.querySelectorAll('a[href*="?channel"], a[href*="?locale"]').forEach(link => {
                link.removeEventListener('click', this.handleLinkClick);
            });

            // window.removeEventListener('beforeunload', this.handleBeforeUnload);
        },
        methods: {
            markDirty() {
                this.originalFormData.status = "1";
                this.isFormDirty = JSON.stringify(this.formData) !== JSON.stringify(this.originalFormData);
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
@endpushOnce
