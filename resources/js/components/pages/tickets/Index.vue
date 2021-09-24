<template>
    <section>
      <b-loading :is-full-page="isFullPage" v-model="isLoading" :can-cancel="true"></b-loading>
      <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
              <h6>Ticket List</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <b-table
                    :data="tickets"
                    ref="table"
                    paginated
                    per-page="25"
                    :opened-detailed="defaultOpenedDetails"
                    detailed
                    detail-key="id"
                    :detail-transition="transitionName"
                    @details-open="(row) => $buefy.toast.open(`Expanded ${row.user.first_name}`)"
                    :show-detail-icon="showDetailIcon"
                    aria-next-label="Next page"
                    aria-previous-label="Previous page"
                    aria-page-label="Page"
                    aria-current-label="Current page"
                    class="table align-items-center mb-0">
                    <b-table-column field="id" label="ID" width="40" numeric v-slot="props"  header-class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        {{ props.row.id }}
                    </b-table-column>

                    <b-table-column field="customer_name" label="Name" sortable v-slot="props"  header-class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    <template v-if="showDetailIcon">
                          <div class="d-flex px-2 py-1">
                            <div>
                                <img :src=" '../admin/img/team-3.jpg'" alt="user1" class="avatar avatar-sm me-3">
                            </div> 
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ props.row.customer_name }}</h6>
                              <p class="text-xs text-secondary mb-0">{{ props.row.customer_email }}</p>
                            </div>
                          </div>
                        </template>
                        <template v-else>
                            <a @click="props.toggleDetails(props.row)">
                                {{ props.row.name }}
                            </a>
                        </template>
                    </b-table-column>

                    <b-table-column field="subject" label="Subject" sortable v-slot="props"  header-class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        <p class="text-xs font-weight-bold mb-0">{{ props.row.subject }}</p>
                    </b-table-column>

                    <b-table-column field="priority" label="Priority" sortable centered v-slot="props"  header-class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        <span class="badge badge-sm bg-gradient-danger" v-if="props.row.priority == 'high'">{{ props.row.priority }}</span>
                        <span class="badge badge-sm bg-gradient-primary" v-else>{{ props.row.priority }}</span>
                    </b-table-column>

                    <b-table-column field="status" label="Status" sortable centered v-slot="props"  header-class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        <span class="badge badge-sm bg-gradient-success" v-if="props.row.status == 'free'">{{ props.row.status }}</span>
                        <span class="badge badge-sm bg-gradient-warning" v-if="props.row.status == 'busy'">{{ props.row.status }}</span>
                    </b-table-column>

                    <b-table-column field="created_at" label="Date Of Addition" sortable centered v-slot="props"  header-class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        <span class="text-secondary text-xs font-weight-bold">{{ props.row.created_at | dateFormat }}</span>
                    </b-table-column>
                    <b-table-column>
                      <a href="javascript:;" data-toggle="tooltip" data-original-title="Edit user" class="text-secondary font-weight-bold text-xs">
                        <i aria-hidden="true" class="fa fa-pencil-square-o sbadge badge-sm bg-gradient-primary color-white text-white px-1 rounded h6"></i>
                      </a>
                      &nbsp; | &nbsp;
                      <a href="javascript:;" data-toggle="tooltip" data-original-title="Edit user" class="text-secondary font-weight-bold text-xs">
                        <i aria-hidden="true" class="fa fa-trash sbadge badge-sm bg-gradient-danger color-white text-white px-1 rounded h6"></i>
                      </a>
                    </b-table-column>

                    <template #detail="props">
                        <article>
                            <div class="media" v-if="props.row.status === 'busy'">
                            <div class="media-content">
                                  <div class="content row col-md-12">
                                      <div class="d-flex flex-column justify-content-center col-md-3">
                                        <img :src=" '../admin/img/team-3.jpg'" alt="user1" class="avatar avatar-sm me-3 mb-2">
                                        <h6 class="mb-0 text-sm">Staff: {{ props.row.staff_name }}</h6>
                                        <p class="text-xs text-secondary mb-0">{{ props.row.staff_email }}</p>
                                      </div>
                                      <div class="form-group col-md-9">
                                        <textarea class="form-control" rows="3" :placeholder="props.row.message"></textarea>
                                      </div>
                                  </div>
                            </div>
                            </div>
                            <div class="media" v-else>
                              <div class="media-content">
                                  <div class="content row col-md-12">
                                      <div class="d-flex flex-column justify-content-center col-md-3">
                                          <h6 class="mb-0 text-sm">Staff: none</h6>
                                        <p class="text-xs text-secondary mb-0">Status: {{ props.row.status }}</p>
                                      </div>
                                      <div class="form-group col-md-9">
                                        <textarea class="form-control" rows="3" :placeholder="props.row.message"></textarea>
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
import route from '../../../route'

var moment = require('moment')

export default {
    data() {
        return {
            tickets: [],
            ticket: {
                id: '',
                customer_name: '',
                customer_email: '',
                staff_name: '',
                staff_email: '',
                subject: '',
                description: '',
                created_at: '',
                priority: '',
                status: '',
                message: '',
            },
            ticket_id: '',
            pagination: {},
            edit: false,
            errored: false,
            defaultOpenedDetails: [1],
            showDetailIcon: true,
            useTransition: false,
            isLoading: true,
            isFullPage: true
        }
    },
    mounted() {
        this.getTickets()
    },
    filters: {
        dateFormat:
            function(value) 
            {
                return moment(value).lang('en').format('LLL');
            }
    },
    methods: {
        getTickets() {
            axios
            .get('/api/tickets')
            .then(response => this.tickets = response.data.data)
            .catch(error => {
                console.log(error)
                this.errored = true
            })
            .finally(() => this.isLoading = false)
        },
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
