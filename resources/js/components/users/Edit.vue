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
        props: ['selected', 'roleList', 'teamList'],
        data() {
            return {
                selectedTeams: []
            }
        },
        template: `
            <div class="modal-card" style="width: auto">
                <header class="modal-card-head">
                    <p class="modal-card-title">Edit user data</p>
                    <button
                        type="button"
                        class="delete"
                        @click="$emit('close')"/>
                </header>

                <section class="modal-card-body">

                    <b-field horizontal label="Login">
                        <b-input
                            type="text"
                            v-model="selected.name"
                            required>
                        </b-input>
                    </b-field>

                    <b-field horizontal label="Email">
                        <b-input
                            type="email"
                            v-model="selected.email"
                            required>
                        </b-input>
                    </b-field>

                    <b-field horizontal label="First Name">
                        <b-input
                            type="text"
                            v-model="selected.first_name">
                        </b-input>
                    </b-field>

                    <b-field horizontal label="Last Name">
                        <b-input
                            type="text"
                            v-model="selected.last_name">
                        </b-input>
                    </b-field>

                    <b-field horizontal label="User Role">
                        <b-select placeholder="Select a role" v-model=selected.user_role_id>
                            <option
                                v-for="role in roleList"
                                :value="role.id"
                                :key="role.id">
                                {{ role.code }}
                            </option>
                        </b-select>
                    </b-field>

                    <b-field horizontal label="Add to team">
                        <b-select
                            multiple
                            v-model=selectedTeams
                        >
                            <option
                                v-for="team in teamList"
                                :value="team.id"
                                :key="team.id">
                                {{ team.name }}
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
                        v-on:click="$emit('save-data', selected, selectedTeams), $emit('close')" />
                </footer>
            </div>
        `
    }

    export default {
        components: {
            ModalForm
        },
        props: ['formProps'],
        data() {
            return {
                isComponentModalActive: false
            }
        },
        methods: {
            editData(selected, teams) {
                selected.team = teams
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