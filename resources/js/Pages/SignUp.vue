<template>
    <main>
        <div class="container my-5">

            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="w-50 card p-5">
                    <h5 class="text-center">Sign Up</h5>
                    <div class="alert alert-danger" role="alert" v-if="responseMessage.success == false">

                        {{Object.values(responseMessage.message)}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success" role="alert" v-if="responseMessage.success">

                        {{responseMessage.message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="mb-3">
                        <label for="user" class="form-label">User Name</label>
                        <input type="user" v-model="name" class="form-control" id="user" placeholder="John Doe">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" v-model="email" class="form-control" id="email"
                            placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" v-model="password" class="form-control" id="password"
                            placeholder="**********">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm Password</label>
                        <input type="password" v-model="confirm_password" class="form-control" id="password"
                            placeholder="**********">
                    </div>
                    <button type="button" @click="createUser" class="btn btn-dark btn-block">Sign Up</button>

                    <div class="header-center my-2">
                        <p>Or</p>
                    </div>
                    <router-link to="/login">
                        <button type="button" class="btn btn-block mt-3 btn-outline-dark">Login</button>
                    </router-link>


                </div>
            </div>
        </div>
    </main>
</template>
<script>
    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
                confirm_password: '',
                responseMessage: '',
            }
        },
        methods: {
            async createUser() {
                let user = await axios.post('register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    confirm_password: this.confirm_password,
                })

                this.responseMessage = user.data

                if (this.responseMessage.success) {
                    this.$store.commit('saveUser', this.name)
                    this.$store.commit('saveToken', this.token)
                    this.$router.push('/manage-products')
                }

            }

        }

    }

</script>
