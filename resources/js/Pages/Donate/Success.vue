<template>
    <Head title="Checkout" />

    <div class="-mt-2 bg-orange-50">
        <div class="container mx-auto lg:px-0 px-4">
            <div class="flex justify-center h-48 p-12 text-center mt-24">
                <div>
                    <p class="text-6xl"><i class="las la-check-circle"></i></p>
                    <p class="text-5xl mt-4">Thank you for your donation.</p>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
import Layout from "../../Layouts/Layout.vue";

export default {
    name: "DonateSuccess",
    layout:[Layout],
}
</script>

<style scoped>

</style>
