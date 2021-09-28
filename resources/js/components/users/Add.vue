<template>
    <section>
        <b-button icon-left="plus" type="is-info" v-on:click="isComponentModalActive = true">
            Add user
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
        props: ['roleList'],
        data() {
            return {
                name: '',
                email: '',
                first_name: '',
                last_name: '',
                user_role_id: 4
            }
        },
        template: `
                <div class="modal-card" style="width: auto">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Add new user</p>
                        <button
                            type="button"
                            class="delete"
                            @click="$emit('close')"/>
                    </header>

                    <section class="modal-card-body">

                        <b-field label="Login">
                            <b-input
                                type="text"
                                v-model="name"
                                required>
                            </b-input>
                        </b-field>

                        <b-field label="Email">
                            <b-input
                                type="email"
                                v-model="email"
                                required>
                            </b-input>
                        </b-field>

                        <b-field label="First Name">
                            <b-input
                                type="text"
                                v-model="first_name">
                            </b-input>
                        </b-field>

                        <b-field label="Last Name">
                            <b-input
                                type="text"
                                v-model="last_name">
                            </b-input>
                        </b-field>

                        <b-field label="User Role">
                            <b-select placeholder="Select a role" v-model="user_role_id">
                                <option
                                    v-for="role in roleList"
                                    :value="role.id"
                                    :key="role.id">
                                    {{ role.code }}
                                </option>
                            </b-select>
                        </b-field>

                    </section>

                    <footer class="modal-card-foot">
                        <b-button
                            label="Close"
                            @click="$emit('close')" />
                        <b-button
                            label="Add user"
                            type="is-primary"
                            v-on:click="saveData" />
                    </footer>
                </div>
        `,
        methods: {
            saveData() {
                this.$emit('save-data', {
                    name: this.name,
                    email: this.email,
                    first_name: this.first_name,
                    last_name: this.last_name,
                    user_role_id: this.user_role_id
                })

                this.name = ''
                this.email= ''
                this.first_name= ''
                this.last_name= ''
                this.user_role_id= 4
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
                isComponentModalActive: false
            }
        },
        methods: {
            saveData(newUserData) {
                this.isComponentModalActive= false
                this.$emit('save-data', newUserData)
            }
        }
    }
</script>

<style scoped>
    section {
        display: inline-block;
    }
</style>
