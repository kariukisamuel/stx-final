<template>
    <div class="col-sm-12 col-md-6 col-lg-3 mr-auto bg-white my-3  border-right border-left">
        <img :src="image" alt="boot" class="img-fluid" />
        <div class="text-center">
            <h5 class="product-title">{{title}}</h5>
            <p class="text-secondary">${{price}}</p>
            <button type="button" class="btn btn-dark btn-lg btn-block my-2" @click="getProduct(slug)">View</button>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['id','image', 'title', 'price', 'slug'],
        methods: {
            getProduct(slug) {
                console.log('yes')
                this.$router.push({
                    name: 'Product',
                    query: {
                        slug: slug,
                        id: this.id
                    }
                });
            }
        }
    }

</script>
