<template>
    <div class="col-sm-12 col-md-6 col-lg-3 mr-auto bg-white my-3  border-right border-left">
        <img :src="image" alt="boot" class="img-fluid" />
        <div class="text-center">
            <h5 class="product-title">{{title}}</h5>
            <p class="text-secondary">{{price}}</p>
            <router-link :to="slug"><button type="button" class="btn btn-dark btn-lg btn-block my-2">View More</button></router-link>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['image', 'title', 'price', 'slug']
    }

</script>
