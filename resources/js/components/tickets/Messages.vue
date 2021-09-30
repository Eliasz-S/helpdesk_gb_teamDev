<template>
    <section>
        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" v-on:click="isComponentModalActive = true">
            <i class="fa fa-comments sbadge badge-sm bg-gradient-warning color-white text-white px-1 rounded h6" aria-hidden="true"></i>
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
                    v-on:save-data="saveData"
                    @close="props.close">
                </modal-form>
            </template>
        </b-modal>
    </section>
</template>

<script>
    const ModalForm = {
        props: ['selected','message'],
        template: `
                <div class="modal-card">
                    <header class="modal-card-head d-flex justify-content-between bg-primary">
                        <p class="modal-card-title text-white">Chat story</p>
                        <button
                            type="button"
                            class="delete"
                            @click="$emit('close')"/>
                    </header>

                    <section id="modal" class="modal-card-body">
                        <ul v-model="selected.message">
                            <li v-for="message in selected.message" v-bind:value="message.message" v-bind:key="message.message.id">
                                <div class="d-flex flex-row p-3" v-if="message.created_by == 'Customer'">
                                    <img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" style="height: 50px !important;width: 50px !important;">
                                    <div class="chat ml-2 p-3 w-60" style="white-space: pre-wrap;">
                                        <p class="p-2 pl-4 bg-light rounded">{{ message.message }}</p>
                                    </div>
                                </div>

                                <div class="d-flex flex-row p-3 justify-content-end" v-else> 
                                    <div class="bg-white mr-2 p-3 w-60" style="white-space: pre-wrap;">
                                        <p class="p-2 pr-4 bg-light rounded"><span class="text-muted">{{ message.message }}</span></p>
                                    </div>
                                    <img src="https://img.icons8.com/color/48/000000/circled-user-male-skin-type-7.png" style="height: 50px !important;width: 50px !important;">
                                </div>
                            </li>
                        </ul>
                    </section>
                    <footer class="modal-card-foot">
                    </footer>
                </div>
        `,
        methods: {
            saveData() {
                this.$emit('save-data', {
                    message: this.message
                })
                this.message    = ''
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
                isComponentModalActive: false,
                formProps: {
                }
            }
        },
        methods: {
            saveData(newMessageData) {
                this.$emit('save-data', newMessageData)
            }
        }
    }
</script>

<style scoped>
    section {
        display: inline-block;
    }
</style>