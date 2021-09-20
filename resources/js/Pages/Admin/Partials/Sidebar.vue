<template>
    <aside class="sidenav bg-cover navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-left ms-3 shadow-md" id="sidenav-main" style="background-image: url('/img/sidebar-16.jpg'); background-position: center;">
        <span class="mask bg-gradient-dark" style="z-index: -1;"></span>
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute right-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <Link class="navbar-brand m-0 text-white" :href="route('razas.index')">
                <i class="fas fa-home"></i>
                <span class="ms-1 font-weight-bold text-lg">Menú</span>
            </Link>
        </div>
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <Link :href="route('razas.index')" class="nav-link" :class="{ 'active' : route().current('razas.*') }">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-tag fa-lg"></i>
                        </div>
                        <span class="nav-link-text ms-1">Razas</span>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link :href="route('usuarios.index')" class="nav-link" :class="{ 'active' : route().current('usuarios.*') }">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <span class="nav-link-text ms-1">Usuarios</span>
                    </Link>
                </li>
            </ul>
        </div>
    </aside>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Logo,
        Link,
    },

    data() {
        return {
        }
    },

    mounted() {
        //console.log(route());
        console.log(route().current());
    },
}
</script>