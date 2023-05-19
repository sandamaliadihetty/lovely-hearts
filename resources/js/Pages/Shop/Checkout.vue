<template>
    <Head title="Checkout" />

    <div class="-mt-2 bg-orange-50">
        <div class="container mx-auto lg:px-0 px-4">
            <div class="mt-12">
                <p class="text-2xl font-bold" style="font-family: 'Commissioner'">Review the cart</p>
            </div>

            <div v-if="cart.length === 0" class="mt-12">
                <p class="text-3xl font-bold">Shopping cart is empty.</p>
            </div>

            <div class="mt-12">
                <div class="flex items-center service  pb-4 " v-for="item in cart" :key="item.id">
                    <div class="w-3/12">
                        <div class="rounded-md cursor-pointer image h-20 w-20 relative bg-cover " :style="'background:url(' + item.image + ')'"></div>
                    </div>
                    <div class="w-6/12 truncate">
                        <p class="block truncate">{{ item.title }}</p>
                    </div>
                    <div class="w-2/12">
                        <div class="flex items-center justify-start">
                            <p class=" font-bold">{{item.price/100}} EUR</p>
                        </div>
                    </div>
                    <div class="w-1/12 text-xs" @click.prevent="removeCartItem(item)">
                        <div class="flex items-center justify-end">
                            <i class="las la-times cursor-pointer text-gray-500 dark:text-white hover:text-red-500"></i>
                        </div>
                    </div>

                </div>
            </div>


            <div v-if="cart.length > 0" class="flex justify-end mt-12">
                <p class="text-lg"> <span class="font-bold pr-8">Total:</span>  <span>{{cartTotal/100}} EUR</span> </p>
            </div>

            <div v-if="cart.length > 0" class="flex justify-end mt-8" >
                <div  class=" flex  bg-orange-400 py-2 px-4 rounded-full  items-center text-white cursor-pointer hover:bg-orange-500" @click.prevent="checkout">
                    <p class="pl-1">Pay With Stripe</p>
                </div>
            </div>




        </div>
    </div>
</template>

<script>
import Layout from "../../Layouts/Layout.vue";

export default {
    name: "Checkout",
    layout:[Layout],
    props:['customerAddress','customerHasPaymentMethod','billingPortal'],
    data(){
        return{
            cart:[],
            cartTotal:0,
            address: this.customerAddress,
            paymentMethod: this.paymentMethod,
            portal: this.billingPortal,
            isCheckoutProcessing:false,
            paymentSuccess:false
        }
    },
    methods:{
        checkout(){
            if(this.isCheckoutProcessing === false){
                this.isCheckoutProcessing = true
                this.$inertia.post('/payment/checkout',{cart:this.cart},{
                    onSuccess: res => {
                        localStorage.removeItem('my-cart')
                        this.paymentSuccess= true
                        this.isCheckoutProcessing = false

                    }
                })
            }

        },
        calCartTotal(){
            try{
                let total = 0
                this.cart.forEach(e => {
                    total += e.price
                })
                this.cartTotal = total
                return total
            }catch (error) {

            }

        },
        initCart(){
            try{
                if(localStorage.getItem('my-cart') !== null){
                    let oldCart = localStorage.getItem('my-cart')
                    this.cart = JSON.parse(oldCart)
                    let cTotal = this.calCartTotal()
                    this.emitter.emit("my-cart",{ cart:this.cart,total:cTotal});
                }else{
                    this.cart = []
                    let cTotal = 0
                    this.emitter.emit("my-cart",{ cart:this.cart,total:cTotal});
                }
            }catch (error) {

            }
        },
        removeCartItem(item){
            this.emitter.emit("my-cart-remove-item",{ product:item});
        }
    },
    mounted() {

        this.initCart()

        this.emitter.on("my-cart", e => {
            this.cart = e.cart
            this.cartTotal = e.total
        });
    }
}
</script>

<style scoped>
.service .image{
    background-position: center !important;
    background-size: cover !important;
    background-repeat: no-repeat !important;
}
</style>
