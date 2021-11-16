<template>

    <div class="container my-5">

        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="w-50 card p-5">
                <h5>Pay With Stripe</h5>
                <stripe-element-card ref="elementsRef" :pk="publishableKey" :amount="amount" locale="en"
                    @token="tokenCreated" @loading="loading = $event">
                </stripe-element-card>
                <button class="btn btn-dark btn-block my-5" @click="submit">Pay ${{amount / 100}}</button>
            </div>
        </div>
    </div>




</template>

<script>
    import {
        StripeElementCard
    } from '@vue-stripe/vue-stripe';


    export default {
        name: 'Test',
        components: {
            StripeElementCard
        },
        data: () => ({
            loading: false,
            amount: 1000,
            publishableKey: 'pk_test_TYooMQauvdEDq54NiTphI7jx', //process.env.PUBLISHABLE_KEY, 
            token: null,
            charge: null
        }),

        methods: {
            submit() {
                console.log('submit called. . . ', this.token, this.charge,

                )
                this.$refs.elementsRef.submit();

            },
            tokenCreated(token) {
                this.token = token;
                // for additional charge objects go to https://stripe.com/docs/api/charges/object
                this.charge = {
                    source: token.id,
                    amount: this
                        .amount, // the amount you want to charge the customer in cents. $100 is 1000 (it is strongly recommended you use a product id and quantity and get calculate this on the backend to avoid people manipulating the cost)
                    description: this
                        .description // optional description that will show up on stripe when looking at payments
                }
                this.sendTokenToServer(this.charge);
            },
            sendTokenToServer(charge) {
                // Send to charge to your backend server to be processed
                // Documentation here: https://stripe.com/docs/api/charges/create

            }
        }

    }

</script>
