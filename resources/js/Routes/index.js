import Home from '../Pages/HomePage.vue'
import Login from '../Pages/Login.vue'
import ManageProduct from '../Pages/ManageProducts.vue'
import Product from '../Pages/Login.vue'
import SignUp from '../Pages/SignUp.vue'
import Email from '../Pages/Email.vue'
import Stripe from '../Pages/StripeCheckOut.vue'

export const routes = [
    {
		path: '/',
        component: Home
    },
    {
		path: '/login',
        component: Login
    },
    {
		path: '/manage-products',
        component: ManageProduct
    },
    {
		path: '/product',
        component: Product
    },
    {
		path: '/sign-up',
        component: SignUp
    },
    {
		path: '/email',
        component: Email
    },
    {
		path: '/stripe-check-out',
        component: Stripe
    },

];