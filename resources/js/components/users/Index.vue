<template>
<div class="col-12">
    <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between">
            <h6>User List</h6>

            <div
                v-if="alert"
                class="alert"
                v-bind:class="[isError ? errorClass : successClass]"
                @click="alert='', isError=false"
            >
                {{ alert }}
            </div>

            <Add
                v-bind:formProps=getFormProps()
                v-on:save-data="addNewUser"
            />

        </div>
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
            aria-current-label="Current page">

            <b-loading :is-full-page="isFullPage" v-model="isLoading"></b-loading>

            <b-table-column field="id" label="#ID" width="40" sortable v-slot="props">
                <div class="d-flex px-2 py-3">
                    <p class="text-xs font-weight-bold mb-0">
                        {{ props.row.id }}
                    </p>
                </div>
            </b-table-column>

            <b-table-column field="name" label="Login" sortable v-slot="props">
                <div class="d-flex px-2 py-1">
                    <div>
                        <img :src="'../admin/img/team-3.jpg'" class="avatar avatar-sm me-3" alt="user1">
                    </div>
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

            <b-table-column field="user_role.description" label="Role" sortable v-slot="props">
                <div class="d-flex px-2 py-2">
                    <span class="badge badge-sm bg-gradient-success">
                        {{ props.row.user_role.description }}
                    </span>
                </div>
            </b-table-column>

            <b-table-column field="created_at" label="Date Of Addition" sortable v-slot="props">
                <div class="d-flex px-2 py-3">
                    <p class="text-xs font-weight-bold mb-0">
                        {{ props.row.created_at | dateFormat }}
                    </p>
                </div>
            </b-table-column>

            <b-table-column field="is_enabled" label="Active" sortable v-slot="props">
                <label for="checkbox" @change="editData(props.row)">
                    <input type="checkbox" id="checkbox" v-model="props.row.is_enabled">
                </label>
            </b-table-column>

            <b-table-column v-slot="props">
                <Edit
                    v-bind:formProps=getFormProps()
                    v-on:save-data="editData"
                />
                &nbsp; | &nbsp;
                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" @click="deleteUser(props.row.id)">
                    <i class="fa fa-trash sbadge badge-sm bg-gradient-danger color-white text-white px-1 rounded h6" aria-hidden="true"></i>
                </a>
            </b-table-column>

        </b-table>
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
            // loading: true,
            // errored: false,
            selected: {},
            //buefy table params
            isPaginated: true,
            isPaginationSimple: false,
            isPaginationRounded: false,
            paginationPosition: 'bottom',
            defaultSortDirection: 'asc',
            sortIcon: 'arrow-up',
            sortIconSize: 'is-small',
            currentPage: 1,
            perPage: 7,
            //alerts
            isError: false,
            alert: '',
            alertTimeout: 7000,
            errorClass: 'alert-danger',
            successClass: 'alert-success',
            //loading
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
                roleList: this.roles
            }
        },
        getUsers() {
            this.isLoading = true
            axios
              .get('/api/users')
              .then(response => {
                this.users = response.data.users
                this.roles = response.data.roles
              })
              .catch(error => {
                  console.log(error)
                  this.errored = true
              })
              .finally(() => this.isLoading = false)
        },
        editData(selected) {
            this.isLoading = true
            axios.put(`/api/users/${selected.id}`, selected)
                .then(response => {
                    if (response.statusText = "OK") {
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
                        'Произошла добавления. Попробуйте повторить позже!'
                        ,error
                        ,true
                    )
                })
                .finally(() => {
                    this.isLoading = false
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
            if(isError) this.isError = true
            this.alert = message

            setTimeout(() => {
                this.isError = false
                this.alert = ''
            }, this.alertTimeout);
        }
    },
    components: {
        Edit,
        Add
    }
}
</script>
