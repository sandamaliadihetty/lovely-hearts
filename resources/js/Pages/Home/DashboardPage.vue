<template>
    <Head title="Dashboard" />

    <div class="-mt-2 bg-orange-50">
        <div class="container mx-auto lg:px-0 px-4">

            <div class="lg:flex justify-between mt-12">
                <div class="lg:pl-4 lg:w-3/12">

                    <div>
                       <p @click.prevent="page = 'orders'" class="font-bold text-lg cursor-pointer hover:text-orange-800 " :class="page === 'orders' ? 'text-cyan-600' : 'text-gray-700'  ">My Orders</p>

                        <p @click.prevent="page = 'adoptions'" class="mt-4 font-bold text-lg cursor-pointer hover:text-orange-800 " :class="page === 'adoptions' ? 'text-cyan-600' : 'text-gray-700'  ">My Pets</p>

                        <p @click.prevent="page = 'donations'" class="mt-4 font-bold text-lg cursor-pointer hover:text-orange-800 " :class="page === 'donations' ? 'text-cyan-600' : 'text-gray-700'  ">My Donations</p>
                    </div>


                </div>
                <div class="lg:w-9/12">
                    <div v-if="page === 'orders'">
                        <p class="text-3xl font-bold"  style="font-family: 'Commissioner'">My Orders</p>
                        <div v-if="myOrders.data.length === 0">
                            <p class="text-xl mt-8">No orders found.</p>
                        </div>
                        <div class="mt-12">
                            <div v-for="o in myOrders.data" :key="o.id" class="lg:flex justify-between border-gray-300 rounded-lg p-6 border border-solid mb-4">
                                <div class="lg:w-9/12 lg:pr-4">
                                    <p> <span class="font-semibold">Order No: </span>{{o.payment_no}}</p>
                                    <p class="capitalize"> <span class="font-semibold">Status: </span>{{o.status}}</p>
                                    <p class="capitalize"> <span class="font-semibold">Amount: </span>{{o.amount/100}} EUR</p>
                                    <p class="capitalize"> <span class="font-semibold">Placed On: </span>{{o.created_at}}</p>
                                    <p></p>

                                </div>
                                <div class="lg:w-3/12 lg:flex items-center justify-center">
                                    <a class="block" target="_blank" v-if="o.receipt !== null" :href="o.receipt">Invoice</a>

                                </div>

                            </div>
                        </div>
                    </div>


                    <div v-if="page === 'adoptions'">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-3xl font-bold"  style="font-family: 'Commissioner'">My Pets</p>
                            </div>
                            <div>
                                <div class="flex ">
                                    <Link :href="route('adopt.create')" class="bg-cyan-600 py-3 px-8 rounded-full text-white cursor-pointer hover:bg-cyan-700 flex items-center">
                                        <p class="pl-1">Register A Pet</p>
                                    </Link>
                                </div>
                            </div>
                        </div>


                        <div v-if="myPets.data.length === 0">
                            <p class="text-xl mt-8">No pets found.</p>
                        </div>
                        <div class="mt-12">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div v-for="p in myPets.data" :key="p.id">
                                    <div class="h-[350px] bg-cover rounded-lg" :style="`background-image: url(${p.image});`"></div>

                                    <div class="flex items-center justify-between">
                                        <div class=" truncate pr-2">
                                            <p class="mt-2 truncate font-bold text-lg">{{p.name}}</p>
                                            <p class="truncate font-bold text-lg">Age: {{p.age}} | Breed: {{p.breed}}</p>
                                            <p class="truncate font-bold text-lg">{{p.location}}</p>
                                            <p class="truncate font-bold text-lg">{{p.status === 0 ? 'In review' : 'Active'}}</p>
                                            <p class="text-gray-600 truncate">{{p.description}}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div v-if="page === 'donations'">
                        <p class="text-3xl font-bold"  style="font-family: 'Commissioner'">My Donations</p>
                        <div v-if="myDonations.data.length === 0">
                            <p class="text-xl mt-8">No donations found.</p>
                        </div>
                        <div class="mt-12">
                            <div v-for="d in myDonations.data" :key="d.id" class="lg:flex justify-between border-gray-300 rounded-lg p-6 border border-solid mb-4">
                                <div class="lg:w-9/12 lg:pr-4">
                                    <p> <span class="font-semibold">Donation No: </span>{{d.donation_no}}</p>
                                    <p class="capitalize"> <span class="font-semibold">Status: </span>{{d.status}}</p>
                                    <p class="capitalize"> <span class="font-semibold">Amount: </span>{{d.amount/100}} EUR</p>
                                    <p class="capitalize"> <span class="font-semibold">Placed On: </span>{{d.created_at}}</p>
                                    <p></p>

                                </div>
                                <div class="lg:w-3/12 lg:flex items-center justify-center">
                                    <a class="block" target="_blank" v-if="d.receipt !== null" :href="d.receipt">Invoice</a>

                                </div>

                            </div>
                        </div>
                    </div>




                </div>
            </div>










        </div>


    </div>
</template>

<script>
import Layout from "../../Layouts/Layout.vue";

export default {
    name: "DashboardPage",
    layout:[Layout],
    props:['orders','pets','donations'],
    data(){
        return{
            page:'orders',
            myOrders:this.orders,
            myPets:this.pets,
            myDonations:this.donations
        }
    }
}
</script>

<style scoped>

</style>
