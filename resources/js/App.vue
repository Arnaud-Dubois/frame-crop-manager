<template>
    <div>
        <Navbar/>
        <div class="container">
            <div class="mt-4">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from './components/Navbar'
    export default {
        name: 'app',
        components: {
            Navbar
        }
    }
</script>