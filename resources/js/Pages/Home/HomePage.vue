<template>
    <Head title="Home" />

    <div class="-mt-2 bg-orange-50">
        <div class="container mx-auto lg:px-0 px-4">
           <div class="lg:flex justify-between items-center mt-12">
               <div class="lg:w-6/12 text-center lg:text-start">
                   <p class="font-black text-6xl lg:text-7xl" style="font-family: 'Commissioner'">We Seek Your Love & Affection</p>
                   <p class="mt-8 ">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. </p>

                   <div class="flex mt-8 justify-center lg:justify-start ">
                       <Link :href="route('adopt.index')" class="bg-orange-400 py-3 px-8 rounded-full text-white cursor-pointer hover:bg-orange-500 flex items-center">
                           <p class="pl-1">Adopt A Pet</p>
                       </Link>
                   </div>
               </div>
               <div class="lg:w-6/12 flex lg:justify-end justify-center pt-12 lg:pt-0 ">
                   <img src="/images/main.png" alt="pet" style="width: 450px">
               </div>
           </div>

        </div>
    </div>

    <div class="mt-24 bg-cyan-600 ">
        <div class="container mx-auto lg:px-0 px-4">
            <div class="lg:flex items-center justify-between py-12 relative">
                <div class="lg:w-3/12 flex justify-center lg:justify-start ">
                    <img src="/images/dog-1.png" alt="dog" class="lg:absolute" style="height: 160px; bottom:0px">
                </div>
                <div class="lg:w-6/12 pt-8 lg:pt-0">
                    <p class="text-center  text-white text-2xl" >How can you help</p>
                    <p class="text-center font-black  text-white text-4xl" style="font-family: 'Commissioner'" >Together, we can make a difference!</p>

                </div>
                <div class="lg:w-3/12 pt-8 lg:pt-0">
                    <div class="flex justify-center lg:justify-end ">
                        <div @click.prevent="checkout" class="bg-white py-3 px-8 rounded-full text-cyan-500 cursor-pointer hover:bg-cyan-700 hover:text-white flex items-center">
                            <p class="pl-1">Donate Now - 20 EUR</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <div class="mt-44">
        <div class="container mx-auto lg:px-0 px-4">

            <div class="lg:flex justify-center">
                <div class="lg:w-4/12 lg:pr-8">
                    <p class="font-black text-4xl text-center lg:text-start" style="font-family: 'Commissioner'">Our Services</p>

                    <div class="mt-8">
                        <p class="text-xl pb-2 border-b-2 border-gra-50"><i class="las la-check-circle"></i> Pet grooming </p>
                        <p class="text-xl  py-2 border-b-2 border-gra-50"><i class="las la-check-circle"></i> Pet sitting </p>
                        <p class="text-xl  py-2 border-b-2 border-gra-50"><i class="las la-check-circle"></i> Veterinary services</p>
                        <p class="text-xl  py-2 border-b-2 border-gra-50"><i class="las la-check-circle"></i> Pet training</p>
                        <p class="text-xl py-2"><i class="las la-check-circle"></i> Pet boarding </p>
                    </div>

                </div>
                <div class="lg:w-4/12 mt-8 lg:mt-0">
                    <div>
                        <img src="/images/pet-1.png" alt="dog" class="rounded-lg" style="height: 400px;">
                    </div>

                </div>
                <div class="lg:w-4/12 pl-8 mt-8 lg:mt-0">
                    <p class="font-black text-4xl" style="font-family: 'Commissioner'">How We Started</p>
                    <p class="text-lg mt-8">Once upon a time, there was a local animal shelter that was home to many furry friends in need of a forever home. One day, a kind-hearted person walked into the shelter looking for a new companion and stumbled upon a little dog with big, soulful eyes. The dog's tail wagged excitedly as the person approached, and in that moment, they knew they had found their perfect match....</p>
                    <div class="flex mt-8 justify-center lg:justify-start ">
                        <Link href="#" class="bg-orange-400 py-3 px-8 rounded-full text-white cursor-pointer hover:bg-orange-500 flex items-center">
                            <p class="pl-1">Learn more</p>
                        </Link>
                    </div>



                </div>

            </div>





        </div>

    </div>

    <div class="mt-44 bg-orange-200">
        <div class="container mx-auto lg:px-0 px-4">
            <div class="py-4 lg:flex justify-between">
                <div class="lg:w-3/12 text-center lg:text-start">
                    <div class="flex lg:justify-start justify-center">
                        <img style="width:185px;" src='/images/pet.png' alt='Logo'>
                    </div>

                    <p style="font-family: 'Commissioner'" class="font-bold mt-4 text-lg">Opening Times</p>
                    <p  class="font-bold mt-4 text-lg">Monday - Saturday <br>9:00 to 17:00</p>
                    <p  class="font-bold mt-2 text-lg">Sunday - Closed</p>
                </div>
                <div class="lg:w-3/12 px-4 text-center lg:text-start">
                    <p style="font-family: 'Commissioner'" class="font-bold mt-4 text-lg">Contact</p>
                    <p class="mt-4">Lovely Hearts</p>
                    <p>2nd Cross Lane</p>
                    <p>Galle, Sri Lanka</p>
                    <p>+94 77 1875 1544</p>
                    <p>info@lovely-hearts.lk</p>
                </div>
                <div class="lg:w-3/12 px-4 text-center lg:text-start">
                    <p style="font-family: 'Commissioner'" class="font-bold mt-4 text-lg">Quick Links</p>
                    <p class="mt-4 cursor-pointer">Shop</p>
                    <p class="mt-1 cursor-pointer">Donate</p>
                    <p class="mt-1 cursor-pointer">News</p>
                    <p class="mt-1 cursor-pointer">About Us</p>
                </div>
                <div class="lg:w-3/12 text-center lg:text-start">
                    <p style="font-family: 'Commissioner'" class="font-bold mt-4 text-lg">Social Links</p>
                    <div class="flex justify-center lg:justify-start mt-4 ">
                       <p class="text-3xl cursor-pointer pr-2"><i class="lab la-facebook-f"></i></p>
                        <p class="text-4xl cursor-pointer pr-2"><i class="lab la-instagram"></i></p>
                        <p class="text-4xl cursor-pointer pr-2"><i class="lab la-youtube"></i></p>
                        <p class="text-4xl cursor-pointer"><i class="lab la-twitter"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-orange-500">
        <div class="container mx-auto lg:px-0 px-4 py-2">
            <div class="lg:flex justify-between items-center text-center lg:text-start">
                <p class="text-sm text-white ">All Right reserved - 2023</p>
                <p class="text-sm text-white ">Privacy Policy</p>
            </div>

        </div>
    </div>


</template>

<script>
import Layout from "../../Layouts/Layout.vue";

export default {
    name: "HomePage",
    layout:[Layout],
    data(){
        return{
            isCheckoutProcessing:false,
        }
    },
    methods:{
        checkout(){
            if(this.isCheckoutProcessing === false){
                this.isCheckoutProcessing = true
                this.$inertia.post('/donation',{},{
                    onSuccess: res => {
                        this.isCheckoutProcessing = false
                    }
                })
            }
        }
    }
}
</script>

<style scoped>

</style>
