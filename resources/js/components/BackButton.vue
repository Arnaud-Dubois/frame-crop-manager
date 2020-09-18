<template>
    <router-link class="d-inline-block my-4" :to="{ name: 'home' }">
        <ArrowLeftShort class="d-inline"/> Back to Gallery
    </router-link>
</template>

<script>
export default {
    name: 'back-button'
}
</script>