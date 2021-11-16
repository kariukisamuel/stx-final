<template>
    <main>
        <div class="container my-5">
            <button type="button" class="btn btn-outline-dark me-2" data-toggle="modal" data-target="#exampleModal">Add
                New Product</button>
            <div class="d-flex justify-content-end my-3">

                <div class="modal  fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="file">Photo/Image</label>
                                        <input type="file" class="form-control-file" id="file" ref="productImage" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="productTitle">Product Title</label>
                                        <input type="text" class="form-control" id="productTitle"
                                            v-model="productTitle">
                                    </div>
                                    <div class="form-group">
                                        <label for="productDesc">Product Description</label>
                                        <textarea class="form-control" id="productDesc" rows="3"
                                            v-model="productDescription"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="productPrice">Product Price</label>
                                        <input type="text" class="form-control" id="productPrice"
                                            v-model="productPrice">
                                    </div>
                                    <button type="button" @click="saveProduct"
                                        class="btn btn-dark btn-block">Save</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Title</th>
                        <th scope="col">Product Description</th>
                        <th scope="col">Product Price(Kshs)</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><img src="images/sport-shoe.png"></td>
                        <td>Fashion Men's Boots</td>
                        <td>Galaxy A12 combines streamlined design aesthetics with classic colors. Refined curves make
                            it
                            comfortable to hold and provides easy screen navigation. Choose from Black, Red and Blue
                            colors.
                            Expand your view to the 6.5-inch Infinity-V Display of Galaxy A12 and see what you've been
                            missing. Thanks to HD+ technology, your everyday content looks sharp, crisp and clear.
                            Similar
                            to human eye sight, the 5MP Ultra Wide Camera sees the world with a 123-degree angle of
                            view,
                            adding more perspective to everything you shoot. Place your order for this amazing product
                            from
                            Jumia Kenya and have it delivered to your doorstep at an amazing price</td>
                        <td>3000</td>
                        <td>
                            <i class="fas fa-edit p-2"></i>
                            <i class="fas fa-trash-alt p-2"></i>
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>
    </main>
</template>
<script>
    import {
        mapGetters
    } from 'vuex'
    export default {

        data() {
            return {
                productTitle: '',
                productDescription: '',
                productPrice: ''
            }
        },
        computed: {
            ...mapGetters([
                'getToken'
            ])
        },
        methods: {
            async saveProduct() {
                var formData = new FormData();
                let productImage = this.$refs.productImage
                formData.append('productImage', productImage.files[0])
                formData.append('productTitle', this.productTitle)
                formData.append('productDescription', this.productDescription)
                formData.append('productPrice', this.productPrice)
                let product = await axios.post('/products', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        Authorization: `Bearer ${getToken}` 
                    }
                })
                console.log()

            }

        }
    }

</script>
