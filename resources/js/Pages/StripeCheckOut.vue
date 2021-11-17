<template>

    <div class="container my-5">

        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="w-50 card p-5">
                <h5 class="text-center mb-3">Pay With Stripe</h5>
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
                    <label>Email</label>
                    <input type="text" class="form-control" :value="getEmail">
                </div>
                <div class="mb-3">
                    <label>Card Details</label>
                    <stripe-element-card ref="stripeRef" :pk="publishableKey" locale="en"
                        :hidePostalCode="hidePostalCode" @token="tokenCreated">
                    </stripe-element-card>
                </div>
                <button class="btn btn-dark btn-block my-2" @click="submit" :disabled="processing">
                    <span v-if="processing">Processing...</span>
                    <span v-else>Pay ${{getPrice}}</span>
                </button>
            </div>
        </div>
    </div>




</template>

<script>
    import {
        StripeElementCard
    } from '@vue-stripe/vue-stripe';

    import {
        mapGetters
    } from 'vuex'

    export default {
        name: 'Stripe',
        components: {
            StripeElementCard
        },
        data: () => ({
            publishableKey: 'pk_test_51JuFtbLu2uOjyahsq3sYgTXvsANcHtHYnIMFFWpfsC6vEOWGpKXuJr3ZfrXLka6rl8bquqQSYciK2IgHEeXIMlkm00NJPG1ECv',
            token: null,
            charge: null,
            hidePostalCode: true,
            responseMessage: '',
            processing: false
        }),
        computed: {
            ...mapGetters(['getEmail', 'getPrice', 'getUser'])
        },
        methods: {
            submit() {
                this.$refs.stripeRef.submit();
            },
            tokenCreated(token) {
                this.processing = true;
                this.token = token;
                this.charge = {
                    source: token.id,
                }
                this.sendTokenToServer(this.charge);
            },
            async sendTokenToServer(charge) {
                let response = await axios.post('stripe-payments', {
                    token: charge.source,
                    amount: this.getPrice,
                    currency: 'usd',
                    email: this.getEmail,
                    payment_interval: 0
                })
                this.responseMessage = response.data

                if (response.data.success) {
   
                        axios.post('send-mail', {
                            to: this.getEmail,
                            email_title: `Succesful payment Of ${this.getPrice} dollars has been made to Staxo group`,
                            email_body: 'Hello,'
                        })
                        this.$router.push({
                            name: 'success'
                        })
                
                }
            }
        }

    }

</script>
