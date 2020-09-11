<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <router-link class="navbar-brand text-light" :to="{ name: 'home'}">
        frame-manager <span style="font-size: .8rem;">(demo)</span>
    </router-link>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        </div>
    </div>
    </nav>
</template>

<script>
export default {
    name: 'navbar'
}
</script>