<template>
    <div v-if="links.length > 3" >
        <div class="flex flex-wrap">
            <template v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null" class="mr-1  px-4 py-3 flex justify-center items-center text-xs leading-4 dark:text-white text-gray-500  " v-html="link.label" />
                <div v-else>
                    <Link v-if="link.label.search('Previous') !== -1  || link.label.search('Next') !== -1 " class="mr-1  px-4 py-3 flex justify-center items-center text-xs leading-4 text-gray-500   hover:text-cyan-700    focus:text-cyan-700" :class="{ 'text-cyan-700': link.active }" :href="link.url" v-html="link.label" />
                </div>

            </template>
        </div>
    </div>
</template>

<script>
export default {
    name: "PaginationSimple",
    props: ['links'],
}
</script>

<style scoped>

</style>
