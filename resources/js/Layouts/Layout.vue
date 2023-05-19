<template>
    <div class="min-h-screen bg-orange-50">
        <div>
            <div class="container mx-auto py-4 px-4">
                <TopNav />
            </div>
        </div>

        <div class=" text-gray-800 ">
            <slot />
        </div>
    </div>
</template>

<script>
import TopNav from "../Shared/Nav/TopNav.vue";

export default {
    name: "Layout",
    components: {TopNav},
    data(){
        return{
            cart:[],
            cartTotal:0,
        }
    },
    methods:{
        setLocalStorageProducts(){
            try{
                if(localStorage.getItem('my-cart') !== null){
                    localStorage.removeItem('my-cart')
                    localStorage.setItem('my-cart',JSON.stringify(this.cart))
                }else{
                    localStorage.setItem('my-cart',JSON.stringify(this.cart))
                }
            }catch (error) {

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
        addToCart(product){
            this.cart.push(product)
            this.setLocalStorageProducts()
            let cTotal = this.calCartTotal()
            this.emitter.emit("my-cart",{ cart:this.cart,total: cTotal});
            this.$toast.success('Added to the cart successfully.')
        }

    },
    mounted() {

        this.initCart();

        this.emitter.on("product-added-to-cart", e => {
            this.addToCart(e.product)
        });

        this.emitter.on("get-cart", e => {
            this.initCart()
        });

        this.emitter.on("my-cart-remove-item", e => {
            for (var i =0; i < this.cart.length; i++)
                if (this.cart[i].id === e.product.id) {
                    this.cart.splice(i,1);
                    break;
                }
            this.setLocalStorageProducts()
            let cTotal = this.calCartTotal()
            this.emitter.emit("my-cart",{ cart:this.cart,total:cTotal});
        });
    }
}
</script>

<style scoped>

</style>
