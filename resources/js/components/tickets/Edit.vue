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
                    v-bind="formProps" 
                    v-on:save-data="editData" 
                    @close="props.close"
                >
                </modal-form>
            </template>
        </b-modal>
    </section>
</template>

<script>
    const ModalForm = {
        props: ['selected','statusList','priorityList', 'typeList', 'staffList'],
        template: `
                <div class="modal-card" style="width: auto">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Edit ticket</p>
                        <button
                            type="button"
                            class="delete"
                            @click="$emit('close')"/>
                    </header>

                    <section class="modal-card-body">

                        <b-field label="Status">
                            <b-select placeholder="Status" v-model=selected.status_id expanded>
                                <option
                                    v-for="status in statusList"
                                    :value="status.id"
                                    :key="status.id">
                                    {{ status.code }}
                                </option>
                            </b-select>
                        </b-field>

                        <b-field label="Priority">
                            <b-select placeholder="Priority" v-model=selected.priority_id expanded>
                                <option
                                    v-for="priority in priorityList"
                                    :value="priority.id"
                                    :key="priority.id">
                                    {{ priority.code }}
                                </option>
                            </b-select>
                        </b-field>

                        <b-field label="Type">
                            <b-select placeholder="Type" v-model=selected.type_id expanded>
                                <option
                                    v-for="type in typeList"
                                    :value="type.id"
                                    :key="type.id">
                                    {{ type.code }}
                                </option>
                            </b-select>
                        </b-field>

                        <b-field label="Staff">
                            <b-select placeholder="staff" v-model=selected.staff_id expanded>
                                <option
                                    v-for="staff in staffList"
                                    :value="staff.id"
                                    :key="staff.id">
                                    {{ staff.name }}
                                </option>
                            </b-select>
                        </b-field>


                    </section>

                    <footer class="modal-card-foot">
                        <b-button
                            label="Close"
                            @click="$emit('close')" />
                        <b-button
                            label="Save"
                            type="is-primary"
                            v-on:click="$emit('save-data', selected), $emit('close')" />
                    </footer>
                </div>
        `
    }

    export default {
        props: ['formProps'],
        components: {
            ModalForm
        },
        data() {
            return {
                isComponentModalActive: false
            }
        },
        methods: {
            editData(selected) {
                this.$emit('save-data', selected)
            }
        }
    }
</script>

<style scoped>
    section {
        display: inline-block;
    }
</style>