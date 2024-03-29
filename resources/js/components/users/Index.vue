<template>
<div class="col-12">
    <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between">
            <h6>User List</h6>

            <Add v-bind:formProps=getFormProps()
                v-on:save-data="addNewUser" />
        </div>

        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <b-table
                    :data="users"
                    :selected.sync="selected"
                    :paginated="isPaginated"
                    :per-page="perPage"
                    :current-page.sync="currentPage"
                    :pagination-simple="isPaginationSimple"
                    :pagination-position="paginationPosition"
                    :default-sort-direction="defaultSortDirection"
                    :pagination-rounded="isPaginationRounded"
                    :sort-icon="sortIcon"
                    :sort-icon-size="sortIconSize"
                    default-sort="user.first_name"
                    aria-next-label="Next page"
                    aria-previous-label="Previous page"
                    aria-page-label="Page"
                    aria-current-label="Current page"
                    class="table align-items-center mb-2">

                    <b-loading :is-full-page="isFullPage" v-model="isLoading"></b-loading>

                    <b-table-column field="id" label="#ID" width="100" searchable sortable v-slot="props">
                        <div class="d-flex px-2 py-3">
                            <p class="text-xs font-weight-bold mb-0">
                                {{ props.row.id }}
                            </p>
                        </div>
                    </b-table-column>

                    <b-table-column field="name" label="Login" searchable sortable v-slot="props">
                        <div class="d-flex px-2 py-1">
                            <img :src="'../admin/img/team-3.jpg'" class="avatar avatar-sm me-3" alt="user1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ props.row.name }}
                                    <span v-if="props.row.first_name">
                                        | {{ props.row.first_name }} {{ props.row.last_name }}
                                    </span>
                                </h6>
                                <p class="text-xs text-secondary mb-0">{{ props.row.email }}</p>
                            </div>
                        </div>
                    </b-table-column>

                    <b-table-column field="user_role.description" label="Role" searchable sortable v-slot="props">
                        <div class="d-flex px-2 py-2">
                            <span class="badge badge-sm bg-gradient-success">
                                {{ props.row.user_role.description }}
                            </span>
                        </div>
                    </b-table-column>

                    <b-table-column field="team" label="Teams" searchable sortable v-slot="props">
                        <div class="d-flex flex-column px-2 py-2">
                            <span v-for="team in props.row.team" :key="team.id">
                                {{ team.name }}
                            </span>
                        </div>
                    </b-table-column>

                    <b-table-column field="created_at" label="Date Of Addition" searchable sortable v-slot="props">
                        <div class="d-flex px-2 py-3">
                            <p class="text-xs font-weight-bold mb-0">
                                {{ props.row.created_at | dateFormat }}
                            </p>
                        </div>
                    </b-table-column>

                    <b-table-column field="is_enabled" label="Active" searchable sortable v-slot="props">
                        <label for="checkbox" @change="editData(props.row)">
                            <input type="checkbox" id="checkbox" v-model="props.row.is_enabled">
                        </label>
                    </b-table-column>

                    <b-table-column v-slot="props">
                        <Edit
                            v-bind:formProps=getFormProps()
                            v-on:save-data="editData" />
                        &nbsp; | &nbsp;
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" @click="deleteMessage(props.row.id)">
                            <i class="fa fa-trash sbadge badge-sm bg-gradient-danger color-white text-white px-1 rounded h6" aria-hidden="true"></i>
                        </a>
                    </b-table-column>

                </b-table>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios'
import Edit from './Edit.vue'
import Add from './Add.vue'

var moment = require('moment')

export default {
    data() {
        return {
            users: [],
            roles: [],
            teams: [],
            selected: {},
            isPaginated: true,
            isPaginationSimple: false,
            isPaginationRounded: false,
            paginationPosition: 'bottom',
            defaultSortDirection: 'asc',
            sortIcon: 'arrow-up',
            sortIconSize: 'is-small',
            currentPage: 1,
            perPage: 12,

            isError: false,
            alertTimeout: 15000,

            isLoading: true,
            isFullPage: false
        }
    },
    mounted() {
        this.getUsers()
    },
    filters: {
        dateFormat:
            function(value) {
                return moment(value).format('LLL');
            }
    },
    methods: {
        getFormProps() {
            return {
                selected: this.selected,
                roleList: this.roles,
                teamList: this.teams
            }
        },
        setPaginated() {
            //console.log(this.users)
            this.isPaginated = this.users.length > this.perPage
        },
        getUsers() {
            this.isLoading = true
            axios
              .get('/api/users')
              .then(response => {
                this.users = response.data.users
                this.roles = response.data.roles
                this.teams = response.data.teams
                // console.log(response)
                this.setPaginated()
              })
              .catch(error => {
                  console.log(error)
                  this.errored = true
              })
              .finally(() => this.isLoading = false)
        },
        editData(selected) {
            this.isLoading = true
            selected.oldTeam = selected.team
            console.log(selected)
            axios.put(`/api/users/${selected.id}`, selected)
                .then(response => {
                    if (response.statusText = "OK") {
                        //console.log(response)
                        this.setAlert('Запись успешно изменена!')
                        this.getUsers()
                    }
                }).catch(error => {
                    this.setAlert(
                        'Произошла ошибка сохранения. Попробуйте повторить позже!'
                        ,error
                        ,true
                    )
                })
                .finally(() => {
                    this.isLoading = false
                })
        },
        addNewUser(newUserData) {
            this.isLoading = true
            axios
                .post('/api/users', newUserData)
                .then(response => {
                    this.getUsers()
                    if (response.statusText = "OK") {
                        this.setAlert('Запись успешно добавлена!')
                        this.getUsers()
                    }
                })
                .catch(error => {
                    this.setAlert(
                        'Произошла ошибка добавления. Попробуйте повторить позже!'
                        ,error
                        ,true
                    )
                })
                .finally(() => {
                    this.isLoading = false
                })
        },
        deleteMessage(id){
            this.$buefy.dialog.confirm({
                title: 'Deleting user',
                message: 'Are you sure you want to <b>delete</b> the user <b>#'+id+' ?</b>',
                confirmText: 'Delete',
                type: 'is-danger',
                hasIcon: true,
                onConfirm: () => this.deleteUser(id)
            })
        },
        deleteUser(id) {
            this.isLoading = true
            axios
                .delete(`/api/users/${id}`)
                .then(response => {
                    this.getUsers()
                    if (response.status = 200) {
                        this.setAlert('Запись успешно удалена!')
                        this.getUsers()
                    }
                })
                .catch(error => {
                  this.setAlert(
                        'Произошла ошибка удаления. Есть связанные записи или сервер не доступен!'
                        ,error
                        ,true
                    )
                })
                .finally(() => this.isLoading = false)
        },
        setAlert(message, error = null, isError = null) {
            if(error) console.error(error)
            const notif = this.$buefy.notification.open({
                duration: this.alertTimeout,
                message: message,
                position: 'is-bottom-right',
                type: (isError ? 'is-warning' : 'is-success'),
                hasIcon: true
            })
        }
    },
    components: {
        Edit,
        Add
    }
}
</script>
