<template>
    <div>
        <Navbar/>
        <div class="container">
            <div class="mt-4">
                <router-view></router-view>
            </div>
        </div>
        <TheFooter/>
    </div>
</template>

<script>
import Navbar from './components/Navbar'
import TheFooter from './components/TheFooter'
    export default {
        name: 'app',
        components: {
            Navbar,
            TheFooter
        }
    }
</script>