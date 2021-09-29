<template>
    <section>
        <b-button icon-left="plus" type="is-info" v-on:click="isComponentModalActive = true">
            New ticket
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
                    v-bind="formProps" 
                    v-on:save-data="saveData" 
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
        data() {
            return {
                subject: '',
                status_id: '',
                priority_id: '',
                type_id: '',
                staff_id: '',
                message: '',
            }
        },
        template: `
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Create ticket</p>
                </header>
                <section class="modal-card-body pr-4">

                    <b-field horizontal label="Subject" message="Please enter a subject">
                        <b-input name="subject" required type="text" v-model="subject"></b-input>
                    </b-field>

                    <b-field horizontal label="Staff">
                            <b-select placeholder="staff" v-model="staff_id" expanded icon="user-cog">
                                <option value="1">None</option>
                                <option
                                    v-for="staff in staffList"
                                    :value="staff.id"
                                    :key="staff.id">
                                    {{ staff.email }}
                                </option>
                            </b-select>
                    </b-field>

                    <b-field horizontal label="Detail">

                        <b-field label="Status">
                            <b-select placeholder="Status" v-model="status_id" required expanded>
                                <option
                                    v-for="status in statusList"
                                    :value="status.id"
                                    :key="status.id">
                                    {{ status.code }}
                                </option>
                            </b-select>
                        </b-field>

                        <b-field label="Priority">
                            <b-select placeholder="Priority" v-model="priority_id" required expanded>
                                <option
                                    v-for="priority in priorityList"
                                    :value="priority.id"
                                    :key="priority.id">
                                    {{ priority.code }}
                                </option>
                            </b-select>
                        </b-field>

                        <b-field label="Type">
                            <b-select placeholder="Type" v-model="type_id" required expanded>
                                <option
                                    v-for="type in typeList"
                                    :value="type.id"
                                    :key="type.id">
                                    {{ type.code }}
                                </option>
                            </b-select>
                        </b-field>
                    </b-field>

                    <b-field horizontal label="Message">
                        <b-input name="message" required type="textarea" v-model="message"></b-input>
                    </b-field>
                    
                </section>
                <footer class="modal-card-foot">
                    <b-button
                        label="Close"
                        @click="$parent.close()" />
                    <b-button
                        label="Create"
                        type="is-primary"
                        v-on:click="saveData" />
                </footer>
            </div>
        `,
        methods: {
            saveData() {
                this.$emit('save-data', {
                    subject: this.subject,
                    staff_id: this.staff_id,
                    priority_id: this.priority_id,
                    type_id: this.type_id,
                    message: this.message,
                    status_id: this.status_id
                })

                this.subject    = ''
                this.staff_id   = ''
                this.message   = ''
                this.status_id  = ''
                this.priority_id= ''
                this.type_id    = ''
            }
        },
    }

    export default {
        props: ['formProps'],
        components: {
            ModalForm
        },
        data() {
            return {
                isComponentModalActive: false,
                formProps: {
                }
            }
        },
        methods: {
            saveData(newTicketData) {
                this.isComponentModalActive= false
                this.$emit('save-data', newTicketData)
            }
        }
    }
</script>