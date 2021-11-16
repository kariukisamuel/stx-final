<template>
    <main>
        <div class="container my-5">

            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="w-50 card p-5">
                    <h5 class="text-center">Login</h5>
                 
                    <div class="alert alert-success" v-if="typeof responseMessage == 'object' && responseMessage.success ">
                        {{responseMessage.message}}

                    </div>
                    <div class="alert alert-danger" v-if="typeof responseMessage == 'object' && !responseMessage.success ">
                        {{responseMessage.message}}
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" v-model="email"
                            placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" v-model="password"
                            placeholder="**********">
                    </div>
                    <button type="button" @click="authenticate" class="btn btn-dark btn-block">Login</button>
                    <div class="text-center my-2">
                        <a href="" class="text-decoration-none text-dark">Forgot Password?</a>
                    </div>

                    <div class="header-center">
                        <p>Or</p>
                    </div>

                    <router-link to="/sign-up">
                        <button type="button" class="btn btn-block mt-3 btn-outline-dark">Sign Up</button>
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
                email: '',
                password: '',
                responseMessage: '',
                token: '',
                user:''
            }
        },
        methods: {
            async authenticate() {
                let user = await axios.post('/login', {
                    email: this.email,
                    password: this.password
                })
                this.responseMessage = user.data
                this.token= user.data.data.token
                this.name= user.data.data.name
                if(user.data.success){
                      this.$store.commit('saveUser', this.name)
                      this.$store.commit('saveToken', this.token)
                      this.$router.push('/manage-products')
                }
            }
        }
    }

</script>
