<template>
    <main>
        <div class="container my-5">

            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="w-50 card p-5">
                    <h5 class="text-center">Please Enter Your Email To Proceed To Checkout</h5>
                    <div class="mb-3">
                        <input type="email" class="form-control" v-model="email" id="email" placeholder="name@example.com">
                    </div>
                    <button type="button" class="btn btn-block mt-3 btn-outline-dark" @click="checkOut">Proceed To Check Out</button>
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
            }
        },
        methods:{
               checkOut(){
                     this.$store.commit('saveEmail', this.email);
                     this.$router.push({name:'Stripe'})
               }
        }
    }

</script>
