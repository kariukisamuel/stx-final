import Home from '../Pages/HomePage.vue'
import Login from '../Pages/Login.vue'
import ManageProduct from '../Pages/ManageProducts.vue'
import Product from '../Pages/Product.vue'
import SignUp from '../Pages/SignUp.vue'
import Email from '../Pages/Email.vue'
import Stripe from '../Pages/StripeCheckOut.vue'
import ThankYou from '../Pages/ThankYou.vue'
import Cookies from 'js-cookie'


function authenticationGuard(to, from, next) {
    let isAuthenticated = false;
    let cookies = Cookies.get()

    if (cookies.vuex !== undefined) {
        let parsedCookie = JSON.parse(cookies.vuex)
        if (parsedCookie.user != null)
            isAuthenticated = true;
        else
            isAuthenticated = false;

        if (isAuthenticated)
            next(); // allow to enter route
        else 
            next('/login'); // go to '/login';
    }
    else{
        next('/login'); // go to '/login';
    }
}


export const routes = [{
        path: '/',
        component: Home,
        name: 'Home',

    },
    {
        path: '/login',
        component: Login,
        name: 'Login',
    },
    {
        path: '/manage-products',
        component: ManageProduct,
        beforeEnter: authenticationGuard,
        name: 'ManageProducts',

    },
    {
        path: '/product',
        component: Product,
        name: 'Product',
    },
    {
        path: '/sign-up',
        component: SignUp,
        name: 'SignUp',
        
    },
    {
        path: '/email',
        component: Email,
        name: 'Email',
    },
    {
        path: '/stripe-check-out',
        component: Stripe,
        name: 'Stripe',
    },
    {
        path: '/stripe-success',
        component: ThankYou,
        name: 'success',
    },

];
