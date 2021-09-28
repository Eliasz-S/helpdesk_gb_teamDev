<template>
    <dev>
<!--        <navbar-left></navbar-left>-->
        <router-view></router-view>
    </dev>
</template>

<script>
    // import NavbarLeft from './NavbarLeft'

    export default {
        // components: {
        //     NavbarLeft,
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

</style>
