<template>
    <div class="flex items-center justify-between">
        <Link :href="route('home')" class="hidden md:block" >
            <img style="width:185px;" src='/images/pet.png' alt='Logo'>
        </Link>
        <Link :href="route('home')" class="md:hidden ">
            <img style="width:40px;" src='/images/pet-sm.png' alt='Logo'>
        </Link>
        <div class="flex items-center justify-end">

            <Link :href="route('shop.index')" class="block text-gray-800 py-2 pr-8 px-4 rounded-full flex items-center cursor-pointer hover:text-orange-500">
                <p class="text-lg">Shop</p>
            </Link>

            <Link :href="route('payment.checkout')" class='cursor-pointer hover-link  mr-8 flex  items-center' >
                <div class='flex justify-center'>
                    <div class='flex items-center text-4xl relative'>
                        <i class="las la-shopping-cart"></i>
                        <div class="absolute" style="top:-7px;right:-11px;" v-if="cart.length > 0">
                            <div class="flex h-5 w-5 block relative ">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-500 opacity-75"></span>
                                <span style="font-size: 10px" class="relative inline-flex rounded-full h-5 w-5 bg-cyan-600 block flex justify-center items-center text-white font-semibold">{{cart.length}}</span>
                            </div>
                        </div>

                    </div>

                </div>
            </Link>

            <Link :href="route('dashboard')" v-if="$page.props.auth.user" class="hidden md:flex  bg-orange-400 py-2 px-4 rounded-full  items-center text-white cursor-pointer hover:bg-orange-500">
                <p class="pl-1"> <strong>Hi,</strong>  {{$page.props.auth.user.name}}</p>
            </Link>
            <Link v-else :href="route('login')" class="hidden md:flex  bg-orange-400 py-2 px-4 rounded-full  items-center text-white cursor-pointer hover:bg-orange-500">
                <p ><i class="las la-user"></i></p>
                <p class="pl-1">Sign In</p>
            </Link>

            <div v-if="$page.props.auth.user">

                    <div @click.prevent="logout"   class="bg-orange-400 py-2 px-3 rounded-full flex items-center text-white cursor-pointer hover:bg-orange-500 ml-2">
                        <p ><i class="las la-power-off"></i></p>
                    </div>

            </div>


            <Link v-if="!$page.props.auth.user" :href="route('login')" class="md:hidden block bg-orange-400 py-2 px-3 rounded-full flex items-center text-white cursor-pointer hover:bg-orange-500">
                <p ><i class="las la-user"></i></p>
            </Link>


        </div>
    </div>
</template>

<script>
import {router} from "@inertiajs/vue3";

export default {
    name: "TopNav",
    data(){
        return{
            cart:[],
            cartTotal:0,
        }
    },
    methods:{
        removeCartItem(item){
            this.emitter.emit("my-cart-remove-item",{ product:item});
        },
       logout() {
            router.post(route('logout'));
        }
    },
    mounted() {
        this.emitter.on("my-cart", e => {
            this.cart = e.cart
            this.cartTotal = e.total
        });
    }
}
</script>

<style scoped>

</style>
