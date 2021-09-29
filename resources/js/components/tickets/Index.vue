<template>
    <section>
      <b-loading :is-full-page="isFullPage" v-model="isLoading"></b-loading>
      <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
              <h6>Ticket List</h6>

                <Add v-bind:formProps=getFormProps() v-on:save-data="addNewTicket" />
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
                    class="table align-items-center mb-2">

                    <b-table-column field="id" label="#ID" width="40" numeric v-slot="props"  header-class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        {{ props.row.id }}
                    </b-table-column>

                    <b-table-column field="customer" label="Name" sortable v-slot="props">
                        <div class="d-flex px-2 py-1">
                            <div style="width:45px;height:36px;">
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
                        <span class="badge badge-sm bg-gradient-warning" v-else-if="props.row.ticket_status.description == 'busy'">
                            {{ props.row.ticket_status.description }}
                            <b-progress type="is-warning is-small"></b-progress>
                        </span>
                        <span class="badge badge-sm bg-gradient-primary" v-else >{{ props.row.ticket_status.description }}</span>
                    </b-table-column>

                    <b-table-column field="created_at" label="Date Of Addition" sortable centered v-slot="props"  header-class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        <span class="text-secondary text-xs font-weight-bold">{{ props.row.created_at | dateFormat }}</span>
                    </b-table-column>
                    <b-table-column  field="id" v-slot="props">
                        <Edit
                            v-bind:formProps=getFormProps()
                            v-on:save-data="editData"
                        />
                        &nbsp; | &nbsp;
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" @click="deleteTicket(props.row.id)">
                            <i class="fa fa-trash sbadge badge-sm bg-gradient-danger color-white text-white px-1 rounded h6" aria-hidden="true"></i>
                        </a>
                    </b-table-column>

                    <template #detail="props">
                        <article v-if="props.row.message">
                            <div class="media" v-if="props.row.ticket_status.description === 'busy'">
                            <div class="media-content">
                                  <div class="content row col-md-12">
                                      <div class="d-flex flex-column justify-content-center col-md-3">
                                        <img :src=" '../admin/img/team-3.jpg'" alt="user1" class="avatar avatar-sm me-3 mb-2">
                                        <h6 class="mb-0 text-sm">Staff: {{ props.row.staff_user.name  }}</h6>
                                        <p class="text-xs text-secondary mb-0">Type: {{ props.row.ticket_type.description }}</p>
                                        <p class="text-xs text-secondary mb-0">Status: {{ props.row.ticket_status.description }}</p>
                                      </div>
                                      <div class="form-group col-md-9">
                                        <p class="has-text-weight-bold mb-2 text-xs text-secondary mb-0">Type: {{ props.row.ticket_type.description }}</p>
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
                                        <p class="text-xs text-secondary mb-0">Type: {{ props.row.ticket_type.description }}</p>
                                        <p class="text-xs text-secondary mb-0">Status: {{ props.row.ticket_status.description }}</p>
                                      </div>
                                      <div class="form-group col-md-9">
                                        <p class="has-text-weight-bold mb-2 text-xs text-secondary mb-0">Type: {{ props.row.ticket_type.description }}</p>
                                        <textarea class="form-control" rows="3" :placeholder="props.row.message.message"></textarea>
                                      </div>
                                  </div>
                              </div>
                            </div>
                        </article>
                        <article v-else>
                            <div class="media">
                              <div class="media-content">
                                  <div class="content row col-md-12">
                                      <div class="d-flex justify-content-left col-md-12">
                                        <p class="text-xs text-secondary mb-0 mr-2"><span class="has-text-weight-bold text-dark mr-1">Staff:</span> none</p>
                                        <p class="text-xs text-secondary mb-0 mx-2"><span class="has-text-weight-bold text-dark mr-1">Type:</span> {{ props.row.ticket_type.description }}</p>
                                        <p class="text-xs text-secondary mb-0 mx-2"><span class="has-text-weight-bold text-dark mr-1">Status:</span> {{ props.row.ticket_status.description }}</p>
                                        <p class="text-xs text-secondary mb-0 mx-2"><span class="has-text-weight-bold text-dark mr-1">Message:</span>No message</p>
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
import route from '../../route'
import Edit from './Edit.vue'
import Add from './Add.vue'

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
            isPaginated: true,
            isPaginationSimple: false,
            isPaginationRounded: false,
            paginationPosition: 'bottom',
            defaultSortDirection: 'asc',
            sortIcon: 'arrow-up',
            sortIconSize: 'is-small',
            currentPage: 1,
            perPage: 10,
            edit: false,
            errored: false,
            defaultOpenedDetails: [1],
            showDetailIcon: true,
            useTransition: false,
            isLoading: true,
            isFullPage: false,

            isError: false,
            alertTimeout: 15000,
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
        setPaginated() {
            this.isPaginated = this.tickets.length > this.perPage
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
              this.customer_user = response.data.customer_user
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
            console.log(selected)
            axios.put(`/api/tickets/${selected.id}`, selected)
                .then(response => {
                    if (response.statusText = "OK") {
                        this.getTickets()
                        this.setAlert('Ticket successfully updated!')
                    }
                }).catch(error => {
                    this.setAlert(
                        'Something went wrong! Try later'
                        ,error
                        ,true
                    )
                })
                .finally(() => {
                    this.isLoading = false
                })
        },
        addNewTicket(newTicketData) {
            console.log(newTicketData)
            this.isLoading = true
            axios
                .post('/api/tickets', newTicketData)
                .then(response => {
                    this.getTickets()
                    console.log(response)
                    if (response.statusText = "OK") {
                        this.setAlert('Ticket created!')
                        this.getTickets()
                    }
                })
                .catch(error => {
                    console.log(error)
                    this.setAlert(
                        'Something went wrong! Try later'
                        ,error
                        ,true
                    )
                })
                .finally(() => {
                    this.isLoading = false
                })
        },
        deleteTicket(id) {
            this.isLoading = true
            axios
                .delete(`/api/tickets/${id}`)
                .then(response => {
                    this.getTickets()
                    if (response.status = 200) {
                        this.setAlert('Ticket successfully deleted!')
                        this.getTickets()
                    }
                })
                .catch(error => {
                  this.setAlert(
                        'Something went wrong! Try later'
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
