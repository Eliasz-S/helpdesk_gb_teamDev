<template>
    <section>
        <b-button icon-left="plus" type="is-info" v-on:click="isComponentModalActive = true">
            Add team
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
            'name': '',
            'description': '',
        }
    },
    template: `
        <form action="">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title">Add team</p>
                <button
                    type="button"
                    class="delete"
                    @click="$emit('close')"/>
            </header>

            <section class="modal-card-body">
                <b-field label="Name">
                    <b-input
                        type="text"
                        v-model="name"
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
                name: this.name,
                description: this.description,
            })

            this.name = ''
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
        saveData(data) {
            this.isComponentModalActive=false
            this.$emit('add-record', data)
        }
    }
}
</script>

<style scoped>
    section {
        display: inline-block;
    }
</style>
