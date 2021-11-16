<template>
    <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <img src="images/logo.png" style="width:150px" alt="logo" />
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 text-dark">
            <li>
                <router-link to="/" class="nav-link px-2 text-dark">Home</router-link>
            </li>
            <li v-if="getUser !== null">
                <router-link to="/manage-products" class="nav-link px-2 text-dark">Manage Products</router-link>
            </li>
        </ul>

        <div class="col-md-3 text-end d-flex justify-content-end" v-if="getUser === null">
            <router-link to="/login"> <button type="button" class="btn btn-outline-dark mr-2">Login</button>
            </router-link>
            <router-link to="/sign-up"><button type="button" class="btn btn-warning">Sign-up</button></router-link>
        </div>
        <div class="col-md-3 text-end d-flex justify-content-end" v-else>
            <button type="button" class="btn btn-danger" @click="logout">Logout</button>
        </div>
    </header>
</template>
<script>
    import {
        mapGetters
    } from 'vuex'
    export default {
        data() {
            return {

            }
        },
        computed: {
            ...mapGetters(['getUser']),
        },
        methods: {
            logout() {
                this.$store.commit('resetUserState')
                 this.$router.push({name: 'Home'})
            }
        }
    }

</script>
