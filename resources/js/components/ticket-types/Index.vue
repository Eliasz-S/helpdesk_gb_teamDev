<template>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h2>Ticket types</h2>

                <FormAdd v-on:add-record="addRecord" />
            </div>
            <b-table
                :data="data"

                :paginated="isPaginated"
                :per-page="perPage"
                :current-page.sync="currentPage"
                :pagination-simple="isPaginationSimple"
                :pagination-position="paginationPosition"
                :pagination-rounded="isPaginationRounded"
                aria-next-label="Next page"
                aria-previous-label="Previous page"
                aria-page-label="Page"
                aria-current-label="Current page"

                :sort-icon="sortIcon"
                :sort-icon-size="sortIconSize"
                :default-sort-direction="defaultSortDirection"
                default-sort="id"

                :selected.sync="selected"
                class="table align-items-center mb-2">

                <b-loading :is-full-page="isFullPage" v-model="isLoading"></b-loading>

                <b-table-column field="id" label="#ID" width="40" sortable v-slot="props">
                    <div class="d-flex px-2 py-3">
                        <p class="text-xs font-weight-bold mb-0">
                            {{ props.row.id }}
                        </p>
                    </div>
                </b-table-column>

                <b-table-column field="code" label="Code" sortable v-slot="props">
                    <div class="d-flex px-2 py-2">
                            <span class="badge badge-sm bg-gradient-success">
                                {{ props.row.code }}
                            </span>
                    </div>
                </b-table-column>

                <b-table-column field="description" label="Description" sortable v-slot="props">
                    <div class="d-flex px-2 py-3">
                        <p class="text-xs font-weight-bold mb-0">
                            {{ props.row.description }}
                        </p>
                    </div>
                </b-table-column>

                <b-table-column field="is_active" label="Active" sortable v-slot="props">
                    <div class="d-flex px-2 py-3">
                        <label @change="editRecord(props.row)" class="text-xs font-weight-bold mb-0">
                            <input type="checkbox" id="checkbox" v-model="props.row.is_active">
                        </label>
                    </div>
                </b-table-column>

                <b-table-column field="id" v-slot="props">
                    <FormEdit
                        :formData=getFormData()
                        @edit-record="editRecord"
                    />
                    &nbsp; | &nbsp;
                    <a class="text-secondary font-weight-bold text-xs"
                       v-on:click="delRecord(props.row.id)"
                       href="javascript:;">
                        <i class="fa fa-trash sbadge badge-sm bg-gradient-danger color-white text-white px-1 rounded h6" aria-hidden="true"></i>
                    </a>
                </b-table-column>
            </b-table>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
// import moment from "moment";
// import route from '../../route'
import FormEdit from "./FormEdit";
import FormAdd from "./FormAdd";

export default {
    components: {
        FormEdit,
        FormAdd
    },
    data() {
        return {
            isPaginated: true,
            isPaginationSimple: false,
            isPaginationRounded: false,
            paginationPosition: 'bottom',

            defaultSortDirection: 'desc',

            currentPage: 1,
            perPage: 12,

            sortIcon: 'arrow-up',
            sortIconSize: 'is-small',

            selected: {},
            data: [],

            isError: false,
            alertTimeout: 15000,

            isLoading: true,
            isFullPage: false
        }
    },
    mounted() {
        this.getData()
    },
    // filters: {
    //     dateFormat(value) {
    //         return moment(value).format('LLL')
    //     }
    // },
    methods: {
        getFormData() {
            return {
                selected: this.selected
            }
        },
        getData() {
            axios.get('/api/ticket-types')
                .then(response => {
                    this.data = response.data
                    this.setPaginated()
                })
                .catch(error => {
                    console.log(error)
                    this.isError = true
                })
                .finally(() => this.isLoading = false)
        },
        setPaginated() {
            this.isPaginated = this.data.length > this.perPage
        },
        addRecord(newRecord) {
            this.isLoading = true
            axios.post('/api/ticket-types', newRecord)
                .then(response => {
                    if (response.statusText = "OK") {
                        this.setAlert('Запись успешно добавлена!')
                        this.getData()
                    }
                }).catch(error => {
                    this.setAlert(
                        'Произошла ошибка добавления. Попробуйте повторить позже!'
                        ,error
                        ,true
                    )
                })
        },
        editRecord(record) {
            this.isLoading = true
            axios.put('/api/ticket-types/'+record.id, record)
                .then(response => {
                    if (response.statusText = "OK") {
                        this.setAlert('Запись успешно изменена!')
                        this.getData()
                    }
                }).catch(error => {
                    this.setAlert(
                        'Произошла ошибка сохранения. Попробуйте повторить позже!'
                        ,error
                        ,true
                    )
                })
                .finally(() => this.isLoading = false)
        },
        delRecord(rowID) {
            this.isLoading = true
            axios.delete('/api/ticket-types/'+rowID)
                .then(response => {
                    if (response.status = 200) {
                        this.setAlert('Запись успешно удалена!')
                        this.getData()
                    }
                }).catch(error => {
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
    }
}
</script>
