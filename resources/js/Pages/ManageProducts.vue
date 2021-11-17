<template>
    <main>
        <div class="container my-5">
            <button type="button" class="btn btn-outline-dark me-2" data-toggle="modal" data-target="#addModal">Add
                New Product <i class="fas fa-plus"></i></button>
            <div class="d-flex justify-content-end my-3">

                <div class="modal  fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Add Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
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
                                <form enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="file">Photo/Image</label>
                                        <input type="file" class="form-control-file" id="file" ref="productImage"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="productTitle">Product Title</label>
                                        <input type="text" class="form-control" id="productTitle"
                                            v-model="productTitle">
                                    </div>
                                    <div class="form-group">
                                        <label for="productDesc">Product Description</label>
                                        <textarea class="form-control" rows="5" v-model="productDescription"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="productPrice">Product Price</label>
                                        <input type="text" class="form-control" id="productPrice"
                                            v-model="productPrice">
                                    </div>
                                    <div class="d-flex">
                                        <button type="button" @click="saveProduct"
                                            class="btn btn-dark btn-block mr-3">Save</button>
                                        <button type="button" class="btn btn-warning"
                                            data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal  fade" :id="`editModal${product.id}`" tabindex="-1" aria-labelledby="editModalLabel"
                    aria-hidden="true" v-for="(product,index) in products.data" :key="index">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
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
                                <form enctype="multipart/form-data">
                                    <div class="form-group">

                                        <label for="file">Photo/Image</label>
                                        <div class="d-flex">
                                            <input type="file" class="form-control-file" id="file"
                                                :ref="`updateProductImage${product.id}`" required>

                                            <img class="img-thumbnail" style="width:150px"
                                                v-bind:src="product.product_image" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="productTitle">Product Title</label>
                                        <input type="text" class="form-control" id="productTitle"
                                            :value="product.product_name" :ref="`updateProductTitle${product.id}`">
                                    </div>
                                    <div class="form-group">
                                        <label for="productDesc">Product Description</label>
                                        <textarea class="form-control" rows="5" :value="product.product_description"
                                            :ref="`updateProductDescription${product.id}`"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="productPrice">Product Price</label>
                                        <input type="text" class="form-control" id="productPrice"
                                            :value="product.product_price" :ref="`updateProductPrice${product.id}`">
                                    </div>
                                    <div class="d-flex">
                                        <button type="button" @click="updateProduct(product.id)"
                                            class="btn btn-dark btn-block mr-3">Save</button>
                                        <button type="button" class="btn btn-warning"
                                            data-dismiss="modal">Cancel</button>
                                    </div>
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
                        <th scope="col">Product Slug</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Description</th>
                        <th scope="col">Product Price(Kshs)</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody v-if="products">
                    <tr v-for="(product,index) in products.data" :key="index">
                        <th scope="row">{{index + 1}}</th>
                        <td>{{product.product_slug}}</td>
                        <td><img :src="product.product_image" style="width:150px"></td>
                        <td>{{product.product_name}}</td>
                        <td>{{product.product_description}}</td>
                        <td>{{product.product_price}}</td>
                        <td>
                            <i class="fas fa-edit p-2" data-toggle="modal" :data-target="`#editModal${product.id}`"></i>
                            <i class="fas fa-trash-alt p-2" @click="deleteProduct(product.id)"></i>
                        </td>
                    </tr>

                </tbody>
                <tbody v-else>
                    <tr>
                        <td colspan="7">
                            <i class="far fa-question-circle"></i>
                            <p>No Products</p>
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
        mounted() {
            this.fetchProduct()
        },
        data() {
            return {
                productTitle: '',
                productDescription: '',
                productPrice: '',
                responseMessage: '',
                products: '',
                editForm: {
                    productTitle: '',
                    productDescription: '',
                    productPrice: '',
                }
            }
        },
        computed: {
            ...mapGetters([
                'getToken'
            ])
        },
        methods: {
            async saveProduct() {
                console.log('saveProduct')
                var formData = new FormData();
                let productImage = this.$refs.productImage
                formData.append('product_image', productImage.files[0])
                formData.append('product_name', this.productTitle)
                formData.append('product_description', this.productDescription)
                formData.append('product_price', this.productPrice)
                console.log(formData)
                let product = await axios.post('/products', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        Authorization: `Bearer ${this.getToken}`
                    }
                })
                this.responseMessage = product.data
                this.productTitle = '',
                    this.productDescription = '',
                    this.productPrice = '',
                    this.fetchProduct()

            },
            async fetchProduct() {
                let products = await axios.get('products')
                this.products = products.data
            },

            async updateProduct(id) {
                var formData = new FormData();

                let productImageRef = 'updateProductImage' + id
                let productPriceRef = 'updateProductPrice' + id
                let productDescriptionRef = 'updateProductDescription' + id
                let productTitleRef = 'updateProductTitle' + id


                let productImage = this.$refs[productImageRef]
                let productPrice = this.$refs[productPriceRef]
                let productDescription = this.$refs[productDescriptionRef]
                let productTitle = this.$refs[productTitleRef]



                if (productImage[0].files[0] != undefined) {
                    formData.append('product_image', productImage[0].files[0])
                }
                formData.append('product_name', productTitle[0].value)
                formData.append('product_description', productDescription[0].value)
                formData.append('product_price', productPrice[0].value)
                let product = await axios.post(`/products/${id}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        Authorization: `Bearer ${this.getToken}`
                    }
                })
                this.responseMessage = product.data
                this.fetchProduct()
            },

            async deleteProduct(id) {


                this.$swal({
                    title: 'Are you sure you want to delete this product?',
                    text: 'You can\'t revert your action',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes Delete it!',
                    cancelButtonText: 'No, Keep it!',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    if (result.value) {
                        axios.delete(`/products/${id}`, {
                            headers: {
                                Authorization: `Bearer ${this.getToken}`
                            }
                        }).then((product) => {
                            this.responseMessage = product.data
                            this.products = ''
                            this.fetchProduct()
                        })
                        this.$swal('Deleted', 'You successfully deleted this product', 'success')
                    } else {
                        this.$swal('Cancelled', 'Your product is still intact', 'info')
                    }
                })

            }

        }
    }

</script>
