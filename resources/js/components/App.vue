<template>
    <div>
<!--        <b-breadcrumb :items="items"></b-breadcrumb>-->
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        // data() {
        //     return {
        //         items: [
        //             {
        //                 text: 'Admin',
        //                 href: '#'
        //             },
        //             {
        //                 text: 'Manage',
        //                 href: '#'
        //             },
        //             {
        //                 text: 'Library',
        //                 active: true
        //             }
        //         ]
        //     }
        // },
        mounted() {

        }
    }
</script>

<style lang="scss">

// Buefy overriding colors
$primary: #167df0;
$selectedBg: #e7e7e7;
$color_black: #222;

nav.pagination {
    a.pagination-link.is-current {
        background-color: $primary;
    }
}

.table > tbody {
    tr.is-selected {
        background-color: $selectedBg;
    }
}

tr.is-selected td {
    color: $color_black !important;
}
input.input {
    min-width: 100px;
}
.b-table .table th {
    padding: 5px;
}

</style>
