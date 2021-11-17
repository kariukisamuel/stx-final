<template>
    <main>
        <div class="container my-5">

            <div class="row">
                <div class="col-md-6">
                    <img :src="product.product_image" alt="boot" class="img-fluid" />

                </div>
                <div class="p-3 col-md-6">

                    <h5 class="product-title">{{product.product_name}}</h5>
                    <!-- <p>Brand: <span class="text-secondary">Fashion</span></p> -->
                    <p>{{product.product_description}}</p>
                    <div class="border-bottom w-100"></div>
                    <h5 class="my-2">$ {{product.product_price}}</h5>
                    <div class="my-3">
                        <button type="button" class="btn btn-dark btn-lg btn-block my-2"
                            @click="navigateToEmail">Buy</button>

                    </div>


                </div>

            </div>
        </div>
    </main>
</template>
<script>
    export default {
        mounted() {
            this.id = this.$route.query.id
            this.fetchProduct(this.id)
        },
        data() {
            return {
                product: '',
                id: ''
            }
        },
        methods: {
            async fetchProduct() {
                let products = await axios.get(`products/${this.id}`)
                this.product = products.data.data
            },
            navigateToEmail() {
                this.$store.commit('saveTotalPrice', this.product.product_price)
                this.$router.push({
                    name: 'Email',
                });
            }
        }

    }

</script>
