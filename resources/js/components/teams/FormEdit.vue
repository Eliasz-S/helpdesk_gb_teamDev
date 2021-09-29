<template>
    <section>
        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" v-on:click="isComponentModalActive = true">
            <i class="fa fa-pencil-square-o sbadge badge-sm bg-gradient-primary color-white text-white px-1 rounded h6" aria-hidden="true"></i>
        </a>

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
                    v-bind="formData"
                    @close="props.close"
                    @save-data="saveData"
                ></modal-form>
            </template>
        </b-modal>
    </section>
</template>

<script>
const ModalForm = {
    props: ['selected', 'userList'],
    template: `
        <form action="">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title">Edit team {{ selected.id }}</p>
                <button
                    type="button"
                    class="delete"
                    @click="$emit('close')"/>
            </header>

            <section class="modal-card-body">
                <b-field label="Name">
                    <b-input
                        type="text"
                        v-model="selected.name"
                        required>
                    </b-input>
                </b-field>

                <b-field label="Description">
                    <b-input
                        maxlength="200"
                        type="textarea"
                        v-model="selected.description"
                        required>
                    </b-input>
                </b-field>

                <b-field label="Teamlead">
                    <b-select placeholder="Select a teamlead">
                        <option
                            v-for="user in userList"
                            :value="user.id"
                            :key="user.id">
                            {{ user.name }}
                        </option>
                    </b-select>
                </b-field>
            </section>

            <footer class="modal-card-foot">
                <b-button
                    label="Close"
                    @click="$emit('close')"/>
                <b-button
                    type="is-primary"
                    label="Save"
                    @click="$emit('save-data', selected), $emit('close')"/>
            </footer>
        </div>
        </form>
    `
}

export default {
    props: ['formData'],
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
            // this.isComponentModalActive=false
            this.$emit('edit-record', data)
        }
    }
}
</script>

<style scoped>
section {
    display: inline-block;
}
</style>
