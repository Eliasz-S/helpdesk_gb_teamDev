<template>
    <section>
      <b-loading :is-full-page="isFullPage" v-model="isLoading"></b-loading>
      <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
              <h6>Ticket List</h6>

            <div
                v-if="alert"
                class="alert"
                v-bind:class="[isError ? errorClass : successClass]"
                @click="alert='', isError=false"
            >
                {{ alert }}
            </div>

            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <b-table
                    :data="tickets"
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
                    default-sort="id"
                    aria-next-label="Next page"
                    aria-previous-label="Previous page"
                    aria-page-label="Page"
                    aria-current-label="Current page"

                    :opened-detailed="defaultOpenedDetails"
                    detailed
                    detail-key="id"
                    :detail-transition="transitionName"
                    @details-open="(row) => $buefy.toast.open(`Expanded ${row.customer_user.first_name}`)"
                    :show-detail-icon="showDetailIcon"
                    class="table align-items-center mb-0">

                    <b-table-column field="id" label="#ID" width="40" numeric v-slot="props"  header-class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        {{ props.row.id }}
                    </b-table-column>

                    <b-table-column field="customer" label="Name" sortable v-slot="props">
                        <div class="d-flex px-2 py-1">
                            <div>
                                <img :src="'../admin/img/team-3.jpg'" class="avatar avatar-sm me-3" alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ props.row.customer_user.name }}
                                    <span v-if="props.row.customer_user.first_name">
                                        | {{ props.row.customer_user.first_name }} {{ props.row.customer_user.last_name }}
                                    </span>
                                </h6>
                                <p class="text-xs text-secondary mb-0">{{ props.row.customer_user.email }}</p>
                            </div>
                        </div>
                    </b-table-column>

                    <b-table-column field="subject" label="Subject" sortable v-slot="props"  header-class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        <p class="text-xs font-weight-bold mb-0">{{ props.row.subject }}</p>
                    </b-table-column>

                    <b-table-column field="priority" label="Priority" sortable centered v-slot="props"  header-class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        <span class="badge badge-sm bg-gradient-danger" v-if="props.row.ticket_priority.description == 'high'">{{ props.row.ticket_priority.description }}</span>
                        <span class="badge badge-sm bg-gradient-primary" v-else>{{ props.row.ticket_priority.description }}</span>
                    </b-table-column>

                     <b-table-column field="status" label="Status" sortable centered v-slot="props"  header-class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        <span class="badge badge-sm bg-gradient-success" v-if="props.row.ticket_status.description == 'free'">{{ props.row.ticket_status.description }}</span>
                        <span class="badge badge-sm bg-gradient-warning" v-else-if="props.row.ticket_status.description == 'busy'">{{ props.row.ticket_status.description }}</span>
                        <span class="badge badge-sm bg-gradient-primary" v-else >{{ props.row.ticket_status.description }}</span>
                    </b-table-column>

                    <b-table-column field="created_at" label="Date Of Addition" sortable centered v-slot="props"  header-class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        <span class="text-secondary text-xs font-weight-bold">{{ props.row.created_at | dateFormat }}</span>
                    </b-table-column>
                    <b-table-column>
                      <Edit
                          v-bind:formProps=getFormProps()
                          v-on:save-data="editData"
                      />
                      &nbsp; | &nbsp;
                      <a href="javascript:;" data-toggle="tooltip" data-original-title="Edit user" class="text-secondary font-weight-bold text-xs">
                        <i aria-hidden="true" class="fa fa-trash sbadge badge-sm bg-gradient-danger color-white text-white px-1 rounded h6"></i>
                      </a>
                    </b-table-column>

                    <template #detail="props">
                        <article>
                            <div class="media" v-if="props.row.ticket_status.description === 'busy'">
                            <div class="media-content">
                                  <div class="content row col-md-12">
                                      <div class="d-flex flex-column justify-content-center col-md-3">
                                        <img :src=" '../admin/img/team-3.jpg'" alt="user1" class="avatar avatar-sm me-3 mb-2">
                                        <h6 class="mb-0 text-sm">Staff: {{ props.row.staff_user.name  }}</h6>
                                        <p class="text-xs text-secondary mb-0">{{ props.row.staff_user.email }}</p>
                                        <p class="text-xs text-secondary mb-0">Type: {{ props.row.ticket_type.descrition }}</p>
                                      </div>
                                      <div class="form-group col-md-9">
                                        <textarea class="form-control" rows="3" :placeholder="props.row.message.message"></textarea>
                                      </div>
                                  </div>
                            </div>
                            </div>
                            <div class="media" v-else>
                              <div class="media-content">
                                  <div class="content row col-md-12">
                                      <div class="d-flex flex-column justify-content-center col-md-3">
                                          <h6 class="mb-0 text-sm">Staff: none</h6>
                                        <p class="text-xs text-secondary mb-0">Status: {{ props.row.ticket_status.description }}</p>
                                      </div>
                                      <div class="form-group col-md-9">
                                        <textarea class="form-control" rows="3" :placeholder="props.row.message.message"></textarea>
                                      </div>
                                  </div>
                              </div>
                            </div>
                        </article>
                    </template>
                </b-table>
              </div>
            </div>
        </div>
      </div>
    </section>
</template>

<script>
import axios from 'axios'
import Edit from './Edit'

var moment = require('moment')

export default {
    data() {
        return {
            tickets: [],
            status: [],
            priority: [],
            type: [],
            staff_user: [],
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
            edit: false,
            errored: false,
            defaultOpenedDetails: [1],
            showDetailIcon: true,
            useTransition: false,
            isLoading: true,
            isFullPage: true,
            //alerts
            isError: false,
            alert: '',
            alertTimeout: 7000,
            errorClass: 'alert-danger',
            successClass: 'alert-success',
        }
    },
    mounted() {
        this.getTickets()
    },
    filters: {
        dateFormat:
            function(value)
            {
                return moment(value).format('LLL');
            }
    },
    methods: {
        getFormProps() {
            return {
                selected: this.selected,
                statusList: this.status,
                priorityList: this.priority,
                typeList: this.type,
                staffList: this.staff_user,
            }
        },
        getTickets() {
            axios
            .get('/api/tickets')
            .then(response => {
              this.tickets = response.data.tickets
              this.status = response.data.status
              this.priority = response.data.priority
              this.type = response.data.type
              this.staff_user = response.data.staff_user
                console.log(response)
            })
            .catch(error => {
                console.log(error)
                this.errored = true
            })
            .finally(() => this.isLoading = false)
        },
        editData(selected) {
            this.isLoading = true
            axios
                .put(`/api/tickets/${selected.id}`, this.selected)
                .then(response => {
                    this.getTickets()
                    console.log(response)
                    if (response.statusText = "OK") {
                        this.setAlert('Запись успешно изменена!')
                        this.getTickets()
                    }
                })
                .catch(error => {
                    console.log(error)
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
        setAlert(message, error = null, isError = null) {
            if(error) console.error(error)
            if(isError) this.isError = true
            this.$buefy.dialog.alert('Ticket updated')

            setTimeout(() => {
                this.isError = false
                this.alert = ''
            }, this.alertTimeout);
        }
    },
    components: {
        Edit
    },
    computed: {
        transitionName() {
            if (this.useTransition) {
                return 'fade'
            }
        },
    },
}
</script>
