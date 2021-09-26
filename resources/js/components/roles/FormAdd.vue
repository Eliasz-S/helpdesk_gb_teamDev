<template>
    <section>
        <b-button type="is-info" v-on:click="isComponentModalActive = true" rounded>
            Add role
        </b-button>

        <b-modal
            v-model="isComponentModalActive"
            has-modal-card
            trap-focus
            :destroy-on-hide="false"
            aria-role="dialog"
            aria-label="Example Modal"
            aria-modal>
            <template #default="props">
                <modal-form
                    @close="props.close"
                    @save-data="saveData"
                ></modal-form>
            </template>
        </b-modal>
    </section>
</template>

<script>
const ModalForm = {
    data() {
        return {
            'code': '',
            'description': ''
        }
    },
    template: `
        <form action="">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title">Add user role</p>
                <button
                    type="button"
                    class="delete"
                    @click="$emit('close')"/>
            </header>

            <section class="modal-card-body">
                <b-field label="Code">
                    <b-input
                        type="text"
                        v-model="code"
                        required>
                    </b-input>
                </b-field>

                <b-field label="Description">
                    <b-input
                        maxlength="200"
                        type="textarea"
                        v-model="description"
                        required>
                    </b-input>
                </b-field>
            </section>

            <footer class="modal-card-foot">
                <b-button
                    label="Close"
                    @click="$emit('close')" />
                <b-button
                    type="is-primary"
                    label="Save"
                    @click="saveData" />
            </footer>
        </div>
        </form>
    `,
    methods: {
        saveData() {
            this.$emit('save-data', {
                code: this.code,
                description: this.description
            })

            this.code = ''
            this.description = ''
        }
    },
}

// --------------------------------------------------------
export default {
    components: {
        ModalForm
    },
    data() {
        return {
            isComponentModalActive: false
        }
    },
    methods: {
        saveData({code, description}) {
            this.isComponentModalActive=false
            let formProps = {
                code: code,
                description: description
            }
            this.$emit('add-record', formProps)
        }
    }
}
</script>

<style scoped>
    section {
        display: inline-block;
    }
</style>
