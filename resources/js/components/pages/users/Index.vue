<template>
<div class="col-12">
    <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between">
            <h6>User List</h6>
        </div>
        <!-- <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="25px">#ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Login</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Of Addition</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ user.id }}</p>
                            </td>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                        <img :src="'../admin/img/team-3.jpg'" class="avatar avatar-sm me-3" alt="user1">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ user.name }}
                                            <span v-if="user.first_name">
                                              | {{ user.first_name }} {{ user.last_name }}
                                            </span>
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">{{ user.email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-sm bg-gradient-success">{{ user.user_role.description }}</span>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0">{{ user.created_at }}</p>
                            </td>
                            <td class="align-middle">
                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                    <i class="fa fa-pencil-square-o sbadge badge-sm bg-gradient-primary color-white text-white px-1 rounded h6" aria-hidden="true"></i>
                                </a>
                                &nbsp; | &nbsp;
                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                    <i class="fa fa-trash sbadge badge-sm bg-gradient-danger color-white text-white px-1 rounded h6" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> -->
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

            <b-table-column>
                <Edit 
                    v-bind:formProps="selected"
                    v-on:save-data="editData"
                />
                <!-- <a href="javascript:;" class="text-secondary font-weight-bold text-xs" v-on:click="isComponentModalActive = true">
                    <i class="fa fa-pencil-square-o sbadge badge-sm bg-gradient-primary color-white text-white px-1 rounded h6" aria-hidden="true"></i>
                </a> -->
                &nbsp; | &nbsp;
                <a href="javascript:;" class="text-secondary font-weight-bold text-xs">
                    <i class="fa fa-trash sbadge badge-sm bg-gradient-danger color-white text-white px-1 rounded h6" aria-hidden="true"></i>
                </a>
            </b-table-column>

        </b-table>
    </div>
</div>
</template>

<script>
import axios from 'axios'
import Edit from '../../pages/users/Edit.vue'

var moment = require('moment')

export default {
    data() {
        return {
            users: [],
            loading: true,
            errored: false,
            selected: {},
            //table
            isPaginated: true,
            isPaginationSimple: false,
            isPaginationRounded: false,
            paginationPosition: 'bottom',
            defaultSortDirection: 'asc',
            sortIcon: 'arrow-up',
            sortIconSize: 'is-small',
            currentPage: 1,
            perPage: 5,
            user: {
                id: '',
                name: '',
                user_role: '',
                created_at: '',
                first_name: '',
                last_name: ''
            },
        }
    },
    mounted() {
        this.getUsers()
    },
    filters: {
        dateFormat:
            function(value) 
            {
                return moment(value).format('LLL');
            }
    },
    methods: {
        getUsers() {
            axios
              .get('/api/users')
              .then(response => {
                this.users = response.data
                // console.log(response)  
              })
              .catch(error => {
                  console.log(error)
                  this.errored = true
              })
              .finally(() => this.loading = false)
        },
        editData(selected) {
            console.log(selected)
        }
    },
    components: {
        Edit
    }
}
</script>
