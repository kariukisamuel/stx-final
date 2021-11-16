<template>
    <main>
        <div class="container p-2">

            <div class="row">

                <product-card :id="product.id" :image="product.product_image" :title="product.product_name" :price="product.product_price" :slug="product.product_slug" v-for="(product,index) in products.data" :key="index">
                </product-card>


            </div>
        </div>
    </main>
</template>
<script>
    import ProductCard from '../components/ProductCard.vue'
    export default {
        components: {
            ProductCard
        },
        data() {
            return {
                products: '',
            }
        },
        mounted() {
            this.fetchProduct()
        },
        methods: {
            async fetchProduct() {
                let products = await axios.get('products')
                this.products = products.data
            },
        }
    }

</script>
