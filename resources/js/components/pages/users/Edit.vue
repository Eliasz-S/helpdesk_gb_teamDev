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
                <modal-form v-bind="formProps" @close="props.close"></modal-form>
            </template>
        </b-modal>
    </section>
</template>

<script>
    const ModalForm = {
        props: ['name', 'email', 'first_name', 'last_name'],
        template: `
            <form action="">
                <div class="modal-card" style="width: auto">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Edit user data</p>
                        <button
                            type="button"
                            class="delete"
                            @click="$emit('close')"/>
                    </header>

                    <section class="modal-card-body">
                        <b-field label="Login">
                            <b-input
                                type="text"
                                :value="name"
                                required>
                            </b-input>
                        </b-field>

                        <b-field label="Email">
                            <b-input
                                type="email"
                                :value="email"
                                required>
                            </b-input>
                        </b-field>

                        <b-field label="First Name">
                            <b-input
                                type="text"
                                :value="first_name">
                            </b-input>
                        </b-field>

                        <b-field label="Last Name">
                            <b-input
                                type="text"
                                :value="last_name">
                            </b-input>
                        </b-field>
                    </section>

                    <footer class="modal-card-foot">
                        <b-button
                            label="Close"
                            @click="$emit('close')" />
                        <b-button
                            label="Save"
                            type="is-primary"
                            @click="saveData" />
                    </footer>
                </div>
            </form>
        `,
        methods: {
            saveData() {
                let selected = {
                    // name: name,  TODO: разобраться с переменными
                    email: 'email',
                    // first_name: first_name,
                    // last_name: last_name
                }
                console.log(selected)
                // $emit('save-data', 'selected')
            }
        }
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
        }
    }
</script>

<style scoped>
    section {
        display: inline-block;
    }
</style>